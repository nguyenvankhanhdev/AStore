<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\View\View;
class AuthenticateSessionController extends Controller
{
    public function index():View
    {
        return view('backend.auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->regenerateToken();

        $request->authenticate();

        $request->session()->regenerate();

        if($request->user()->role === 'admin') {
            return redirect()->route('admin.dashboard.index')->with('success', 'Đăng nhập thành công');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('products.index');
    }
}
