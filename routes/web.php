<?php

use App\Http\Controllers\ShortenController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('index');
})->name('home');

// Shorten URL routes
Route::get('/{shortUrl}', [ShortenController::class, 'show'])->name('shorten.show');

// Locale change route
Route::get('locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale.change');

Route::get('/example', function () {
    return view('example');
});
