<?php

use App\Http\Controllers\Admin\AdminAuthenticationController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('login' , [AdminAuthenticationController::class , 'login'])->name('login');
Route::post('login' , [AdminAuthenticationController::class , 'handleLogin'])->name('handle.login');
Route::post('logout' , [AdminAuthenticationController::class , 'logout'])->name('logout');

/** forgot password Routes */
Route::get('forgot-password', [AdminAuthenticationController::class, 'forgotPassword'])->name('password.request');
Route::post('forgot-password', [AdminAuthenticationController::class, 'sendResetLink'])->name('password.email');

Route::get('reset-password/{token}', [AdminAuthenticationController::class, 'create'])->name('password.reset');

Route::post('reset-password', [AdminAuthenticationController::class, 'store'])->name('password.store');

Route::group(['middleware' => ['admin']],function () {

    Route::get('dashboard' , [DashboardController::class , 'index'])->name('dashboard');
});
