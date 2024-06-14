<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

// Auth
Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::get('/', 'AuthController@login')->name('login');
    Route::post('/login', 'AuthController@login_action')->name('login_action');
    Route::get('/logout', function () {
        Session::flush();
        return redirect()->route('login');
    })->name('logout');
});


Route::group(['prefix' => '', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'ValidasiUser'], function () {

    Route::redirect('/', 'dashboard/general');

    // Dashboard
    Route::prefix('dashboard')->group(function () {

        Route::get('general', function () {
            return view('pages.dashboard.dashboard-general', ['menu' => 'dashboard']);
        })->name('dashboard');


        // Blank
        Route::get('blank', function () {
            return view('pages.blank.layout-blank', ['menu' => 'blank']);
        })->name('blank');
    });
});
