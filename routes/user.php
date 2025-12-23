<?php

use App\Http\Controllers\User\ApiKeyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('api-keys', [ApiKeyController::class, 'index'])->name('api.keys');
    Route::post('api-keys', [ApiKeyController::class, 'store'])->name('api.keys.store');
    Route::delete('api-keys/{id}', [ApiKeyController::class, 'destroy'])->name('api-keys.destroy');
});

Route::get('logout', function () {
    auth()->logout();
    return redirect()->route('home');
})->name('logout')->middleware('auth');
