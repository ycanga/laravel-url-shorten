<?php

use App\Http\Controllers\Api\ShortenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// free to use for everyone without authentication.
Route::post('/shorten', [ShortenController::class, 'store'])->name('shorten.store')->middleware('ip-control');
Route::get('/detail/{shortUrl}', [ShortenController::class, 'show'])->name('shorten.show');

// faqs
Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');