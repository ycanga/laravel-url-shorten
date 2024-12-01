<?php

use App\Http\Controllers\Api\ShortenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// free to use for everyone without authentication.
Route::post('/shorten', [ShortenController::class, 'store'])->name('shorten.store')->middleware('ip-control');
Route::get('/{shortUrl}', [ShortenController::class, 'show'])->name('shorten.show');