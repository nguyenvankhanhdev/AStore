<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
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
                $newUser = new User();
                $newUser->name = $google_user->getName();
                $newUser->email = $google_user->getEmail();
                $newUser->google_id = $google_user->getId();
                $newUser->role = 'user';
                $newUser->save();
                Auth::login($newUser);
                return redirect()->intended(RouteServiceProvider::HOME)->withSuccess('Đăng nhập thành công');
            } else {
                Auth::login($user);
                return redirect()->intended(RouteServiceProvider::HOME)->withSuccess('Đăng nhập thành công');
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
                return redirect()->intended(RouteServiceProvider::HOME)->withSuccess('Đăng nhập thành công');
            } else {
                Auth::login($user);
                return redirect()->intended(RouteServiceProvider::HOME)->withSuccess('Đăng nhập thành công');
            }
        } catch (\Exception $e) {
            dd('Something wrong' . $e->getMessage());
        }
    }
}
