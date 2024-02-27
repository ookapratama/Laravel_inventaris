<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'dashboard/ecommerce');

// Dashboard
Route::prefix('dashboard')->group(function () {

    Route::get('ecommerce', function () {
        return view('pages.dashboard.dashboard-ecommerce', ['menu' => 'dashboard']);
    })->name('dashboard.ecommerce');

    Route::get('general', function () {
        return view('pages.dashboard.dashboard-general', ['menu' => 'dashboard']);
    })->name('dashboard.general');
});

// Features
Route::prefix('feature')->group(function () {

    Route::get('activities', function () {
        return view('pages.features.feature-activities', ['menu' => 'features']);
    })->name('feature.activites');

    Route::get('post-create', function () {
        return view('pages.features.feature-post-create', ['menu' => 'features']);
    })->name('feature.post-create');
    
    Route::get('posts', function () {
        return view('pages.features.feature-posts', ['menu' => 'features']);
    })->name('feature.posts');
    
    Route::get('profile', function () {
        return view('pages.features.feature-profile', ['menu' => 'features']);
    })->name('feature.profile');
    
    Route::get('settings', function () {
        return view('pages.features.feature-settings', ['menu' => 'features']);
    })->name('feature.settings');

    Route::get('setting-detail', function () {
        return view('pages.features.feature-setting-detail', ['menu' => 'features']);
    })->name('feature.setting-detail');

    Route::get('tickets', function () {
        return view('pages.features.feature-tickets', ['menu' => 'features']);
    })->name('feature.tickets');

});

// Layouts
Route::prefix('layout')->group(function () {

    Route::get('default', function () {
        return view('pages.layouts.layout-default', ['menu' => 'layout']);
    })->name('layout.default');

    Route::get('transparent', function () {
        return view('pages.layouts.layout-transparent', ['menu' => 'layout']);
    })->name('layout.transparent');

    Route::get('top-navigation', function () {
        return view('pages.layouts.layout-top-navigation', ['menu' => 'layout']);
    })->name('layout.top-navigation');
    
});

// Blank
Route::get('blank', function () {
    return view('pages.blank.layout-blank', ['menu' => 'blank']);
})->name('blank');

// Bootstrap
Route::prefix('bootstrap')->group(function () {

    Route::get('alert', function () {
        return view('pages.bootstrap.alert', ['menu' => 'bootstrap']);
    })->name('bootstrap.alert');

    Route::get('badge', function () {
        return view('pages.bootstrap.badge', ['menu' => 'bootstrap']);
    })->name('bootstrap.badge');

    Route::get('breadcrumb', function () {
        return view('pages.bootstrap.breadcrumb', ['menu' => 'bootstrap']);
    })->name('bootstrap.breadcrumb');
    
});