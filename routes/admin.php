<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FooterInfoController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SocialCountController;
use App\Http\Controllers\Admin\LocalizationController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\FooterGridOneController;
use App\Http\Controllers\Admin\FooterGridTwoController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\FooterGridThreeController;
use App\Http\Controllers\Admin\HomeSectionSettingController;
use App\Http\Controllers\Admin\AdminAuthenticationController;

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
    Route::get('pending-news' , [NewsController::class , 'pendingNews'])->name('pending-news');
    Route::put('approve-news' , [NewsController::class , 'approveNews'])->name('approve-news');
    Route::resource('news' , NewsController::class);

    /** News Section Setting routes */
    Route::get('home-section-setting' , [HomeSectionSettingController::class , 'index'])->name('home-section-setting.index');
    Route::put('home-section-setting' , [HomeSectionSettingController::class , 'update'])->name('home-section-setting.update');

    /** Social Count routes */
    Route::resource('social-count' , SocialCountController::class);

    /** Social Links routes */
    Route::resource('social-link' , SocialLinkController::class);

    /** Advertisement route */
    Route::get('advertisement' , [AdvertisementController::class ,'index'])->name('advertisement.index');
    Route::put('advertisement/update' , [AdvertisementController::class ,'update'])->name('advertisement.update');

    /** Footer Info route */
    Route::resource('footer-info' , FooterInfoController::class)->only('index' , 'store');
    /** Footer Grid One route */
    Route::post('footer-grid-one-title' , [FooterGridOneController::class , 'handleTitle'])->name('footer-grid-one-title');
    Route::resource('footer-grid-one' , FooterGridOneController::class);
    /** Footer Grid Two route */
    Route::post('footer-grid-two-title' , [FooterGridTwoController::class , 'handleTitle'])->name('footer-grid-two-title');
    Route::resource('footer-grid-two' , FooterGridTwoController::class);
    /** Footer Grid Two route */
    Route::post('footer-grid-three-title' , [FooterGridThreeController::class , 'handleTitle'])->name('footer-grid-three-title');
    Route::resource('footer-grid-three' , FooterGridThreeController::class);

    /** About route */
    Route::get('about' , [AboutController::class , 'index'])->name('about.index');
    Route::put('about' , [AboutController::class , 'update'])->name('about.update');

    /** Contact route */
    Route::get('contact' , [ContactController::class , 'index'])->name('contact.index');
    Route::put('contact' , [ContactController::class , 'update'])->name('contact.update');
    /** Contact Message route */
    Route::get('contact-message' , [ContactController::class , 'contactMessage'])->name('contact-message.index');
    Route::post('contact-reply-message' , [ContactController::class , 'replyMessage'])->name('contact.send-reply');
    Route::put('contact-message-seen' , [ContactController::class , 'hasSeen'])->name('contact.seen');
    Route::delete('contact-message/{id}/destroy' , [ContactController::class , 'destroyMessage'])->name('contact-message.destroy');

    /** Setting route */
    Route::get('setting' , [SettingController::class , 'index'])->name('setting.index');
    Route::put('general-setting-update' , [SettingController::class , 'genralSettingUpdate'])->name('general-setting.update');
    Route::get('setting-change-view-list' , [SettingController::class , 'changeViewList'])->name('setting-change-view-list');
    Route::put('seo-setting' , [SettingController::class , 'SeoSettingUpdate'])->name('seo-setting.update');
    Route::put('appearance-setting' , [SettingController::class , 'appearanceSetting'])->name('appearance-setting.update');

    /** Role And Permission Route */
    Route::get('role' , [RolePermissionController::class , 'index'])->name('role.index');
    Route::get('role/create' , [RolePermissionController::class , 'create'])->name('role.create');
    Route::post('role/create' , [RolePermissionController::class , 'store'])->name('role.store');
    Route::get('role/{id}/edit' , [RolePermissionController::class , 'edit'])->name('role.edit');
    Route::put('role/{id}/update' , [RolePermissionController::class , 'update'])->name('role.update');
    Route::delete('role/{id}/destroy' , [RolePermissionController::class , 'destroy'])->name('role.destroy');

    /** Role User Route */
    Route::resource('role-users' , RoleUserController::class);

    /** Localization Route */
    Route::get('admin-localization' , [LocalizationController::class , 'adminIndex'])->name('admin-localization.index');
    Route::get('frontend-localization' , [LocalizationController::class , 'frontendIndex'])->name('frontend-localization.index');
});
