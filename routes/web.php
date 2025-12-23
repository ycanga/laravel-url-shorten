<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ShortenController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', [HomePageController::class, 'index'])->name('home');

// Shorten URL routes

// Locale change route
Route::get('locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale.change');

// Authentication routes
Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');

    Route::get('logout', function () {
        auth()->logout();
        return redirect()->route('home');
    })->name('logout')->middleware('auth');
});

require __DIR__ . '/user.php';

//! KISA LİNK URL EN ALTTA OLMALI
Route::get('/{shortUrl}', [ShortenController::class, 'show'])->name('shorten.show');
