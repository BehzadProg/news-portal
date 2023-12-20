<?php

use App\Http\Controllers\Admin\AdminAuthenticationController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('login' , [AdminAuthenticationController::class , 'login'])->name('login');

Route::group(['middleware' => ['admin']],function () {

    Route::get('dashboard' , [DashboardController::class , 'index'])->name('dashboard');
});
