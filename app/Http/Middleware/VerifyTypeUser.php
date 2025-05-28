<?php

namespace App\Http\Middleware;

use App\Enums\UserTypeEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class VerifyTypeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $route = Route::currentRouteName();

        return match (true) {
            $user->type === 'admin' && $route !== 'admin' => redirect()->route('admin'),
            $user->type === 'affiliate.index' && $route !== 'affiliate.index' => redirect()->route('affiliate.index'),
            // $user->type === 'client' && $route !== 'client' => redirect()->route('client'),
            default => $next($request),
        };
    }
}
