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

        if ($user->type === 'admin' and $route !== 'admin') {
            return redirect()->route('admin');
        } elseif ($user->type === 'affiliate' and $route !== 'affiliate') {
            return redirect()->route('affiliate');
        } elseif ($user->type === 'client' and $route !== 'client') {
            return redirect()->route('client');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
