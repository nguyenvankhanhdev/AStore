<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Mail;
use Socialite;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\View\View;

class AuthenticateSessionController extends Controller
{

    public function index(): View
    {
        return view('backend.auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {

        $request->session()->regenerateToken();

        $request->authenticate();

        $request->session()->regenerate();

        if ($request->user()->role === 'admin') {

            return redirect()->route('admin.dashboard.index')->withSuccess('Đăng nhập thành công');
        }
        return redirect()->intended(RouteServiceProvider::HOME)->withSuccess('Đăng nhập thành công');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home')->withSuccess('Đăng xuất thành công');
    }


    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callBackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google_id', $google_user->getId())->first();
            if (!$user) {
                $newUser = User::updateOrCreate(
                    ['email' => $google_user->getEmail()],
                    [
                        'name' => $google_user->getName(),
                        'google_id' => $google_user->getId(),
                        'role' => 'user',
                    ]
                );
                $newUser->save();
                Auth::login($newUser);
                return redirect()->route('home')->withSuccess('Đăng nhập thành công');
            } else {
                Auth::login($user);
                return redirect()->route('home')->withSuccess('Đăng nhập thành công');
            }
        } catch (\Exception $e) {
            dd("Something wrong! " . $e->getMessage());
        }
    }
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
            $user = User::where('github_id', $githubUser->id)->first();
            if (!$user) {
                $newUser = new User();
                $newUser->name = $githubUser->name;
                $newUser->email = $githubUser->email;
                $newUser->github_id = $githubUser->id;
                $newUser->role = 'user';
                $newUser->save();
                Auth::login($newUser);
                return redirect()->route('home')->withSuccess('Đăng nhập thành công');
            } else {
                Auth::login($user);
                return redirect()->route('home')->withSuccess('Đăng nhập thành công');
            }
        } catch (\Exception $e) {
            dd('Something wrong' . $e->getMessage());
        }
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
            'new_password' => 'required|min:8|',
        ]);

        $user = User::where('otp', $request->otp)
                    ->where('otp_expires_at', '>', now())
                    ->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP không hợp lệ hoặc đã hết hạn.',
            ]);
        }
        $user->password = bcrypt($request->new_password);
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Mật khẩu đã được đặt lại thành công.',
        ]);
    }


    public function sendOtp(Request $request)
    {
        \Log::info($request->email);
        try {
            $otp = rand(100000, 999999);
            $user = User::where('email', $request->email)->first();
            $user->otp = $otp;
            $user->otp_expires_at = now()->addMinutes(10);
            $user->save();
            \Log::info($user);
            Mail::send('frontend.emails.send_otp', ['otp' => $otp], function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Mã OTP của bạn');
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Mã OTP đã được gửi đến email của bạn.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không thể gửi OTP, vui lòng thử lại sau.',
            ]);
        }
    }

}
