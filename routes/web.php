<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Api\ShortenController;
use App\Http\Controllers\WebShortenController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', [HomePageController::class, 'index'])->name('home');

// Shorten URL routes
// free to use for everyone without authentication.
Route::post('/free/shorten', [ShortenController::class, 'store'])->name('shorten.store')->middleware('ip-control');

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
});

require __DIR__ . '/user.php';

//! KISA LİNK URL EN ALTTA OLMALI
Route::get('/{shortUrl}', [WebShortenController::class, 'show'])->name('shorten.show');
