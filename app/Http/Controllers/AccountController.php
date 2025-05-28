<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AccountController extends Controller
{
    public function login(Request $request)
    {
        return view('account.login');
    }

    public function register(Request $request)
    {
        return view('account.register');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'credentials' => 'Credencias inválidas.',
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();
        $route = Route::currentRouteName();

        return match ($user->type) {
            'admin'     => redirect()->route('admin'),
            'affiliate' => redirect()->route('affiliate.index'),
            // 'client'    => redirect()->route('client'),
            default     => abort(403),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
