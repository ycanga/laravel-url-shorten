<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

Route::get('logout', function () {
    auth()->logout();
    return redirect()->route('home');
})->name('logout')->middleware('auth');