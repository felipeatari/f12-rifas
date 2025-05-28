<?php

use App\Http\Middleware\VerifyTypeUser;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SortitionController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sorteio/{slug}', [SortitionController::class, 'index']);
Route::get('/acessar', [AccountController::class, 'access'])->name('access');

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
            'affiliate' => redirect()->route('affiliate.index'),
            // 'client'    => redirect()->route('client'),
            default     => abort(403),
        };
    })->name('painel');

    Route::get('/logout', [AccountController::class, 'logout'])->name('logout');

    Route::prefix('afiliado')->name('affiliate.')->middleware(VerifyTypeUser::class)->group(function() {
        Route::get('/', [AffiliateController::class, 'index'])->name('index');
        Route::get('/cadastrar-sorteio', [AffiliateController::class, 'create'])->name('create');
        Route::post('/cadastrar-sorteio', [AffiliateController::class, 'store'])->name('store');
        Route::get('/editar-sorteio/{id}', [AffiliateController::class, 'edit'])->name('edit');
        Route::put('/editar-sorteio/{id}', [AffiliateController::class, 'update'])->name('update');
        Route::get('/vendas', [AffiliateController::class, 'sellers'])->name('sellers');
    });

    // Route::get('/cliente', function() {
    //     dd('Cliente');
    // })->name('client')->middleware(VerifyTypeUser::class);
});
