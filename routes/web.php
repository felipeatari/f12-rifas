<?php

use App\Http\Middleware\VerifyTypeUser;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SortitionController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sorteio/{slug}', [SortitionController::class, 'index']);
Route::get('/acessar', [AccountController::class, 'register'])->name('register');

Route::middleware('guest')->group(function($route) {
    Route::get('/login', [AccountController::class, 'login'])->name('login');
    Route::get('/conta', [AccountController::class, 'register'])->name('register');
    Route::post('/authenticate', [AccountController::class, 'authenticate'])->name('authenticate');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/minha-conta', function () {
        $user = Auth::user();

        return match ($user->type) {
            'admin'     => redirect()->route('admin'),
            'affiliate' => redirect()->route('affiliate'),
            'client'    => redirect()->route('client'),
            default     => abort(403),
        };
    })->name('painel');

    Route::get('/logout', [AccountController::class, 'logout'])->name('logout');

    Route::get('/afiliado', [AffiliateController::class, 'index'])->name('affiliate')->middleware(VerifyTypeUser::class);

    Route::get('/cliente', function() {
        dd('Cliente');
    })->name('client')->middleware(VerifyTypeUser::class);
});
