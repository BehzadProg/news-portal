<?php

use App\Http\Controllers\Admin\AdminAuthenticationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
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

    /** admin profile routes */
    Route::put('profile-password-update/{id}' , [ProfileController::class , 'updatePassword'])->name('profile-update-password');
    Route::resource('profile' , ProfileController::class);

    /** language routes */
    Route::resource('language' , LanguageController::class);

    /** category routes */
    Route::resource('category' , CategoryController::class);

    /** News routes */
    Route::get('fetch-category' , [NewsController::class , 'fetchNewsCategory'])->name('fetch-category');
    Route::get('toggle-news-status' , [NewsController::class , 'toggleNewsStatus'])->name('toggle-news-status');
    Route::get('copy-news' , [NewsController::class , 'copyNews'])->name('copy-news');
    Route::post('paste-news' , [NewsController::class , 'pasteNews'])->name('paste-news');
    Route::resource('news' , NewsController::class);
});
