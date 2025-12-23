<?php

use App\Http\Controllers\Api\ShortenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// protected routes with api key authentication
Route::middleware(['api','api-key-auth'])->post('/shorten', [ShortenController::class, 'store']);


Route::get('/detail/{shortUrl}', [ShortenController::class, 'show'])->name('shorten.show');

// faqs
Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');

Route::prefix('auth')->group(function () {
    // Route::post('/login', [LoginController::class, 'login'])->name('api.login');
    Route::post('/register', [RegisterController::class, 'register'])->name('api.register');
});