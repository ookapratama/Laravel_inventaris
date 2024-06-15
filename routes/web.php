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

        Route::get('/general', 'DashboardController@index')->name('dashboard');

        Route::prefix('barang')->group(function () {
            Route::get('/', 'BarangController@index')->name('barang.index');
            Route::get('/create', 'BarangController@create')->name('barang.create');
            Route::post('/store', 'BarangController@store')->name('barang.store');
            Route::get('/edit/{id}', 'BarangController@edit')->name('barang.edit');
            Route::put('/update', 'BarangController@update')->name('barang.update');
            Route::put('/status/{id}', 'BarangController@status')->name('barang.status');
        });

        Route::prefix('masuk')->group(function () {
            Route::get('/', 'PemasukanController@index')->name('masuk.index');
            Route::get('/create', 'PemasukanController@create')->name('masuk.create');
            Route::post('/store', 'PemasukanController@store')->name('masuk.store');
            Route::get('/edit/{id}', 'PemasukanController@edit')->name('masuk.edit');
            Route::put('/update', 'PemasukanController@update')->name('masuk.update');
            Route::delete('/destroy/{id}', 'PemasukanController@destroy')->name('masuk.destroy');
        });

        Route::prefix('keluar')->group(function () {
            Route::get('/', 'PengeluaranController@index')->name('keluar.index');
            Route::get('/create', 'PengeluaranController@create')->name('keluar.create');
            Route::post('/store', 'PengeluaranController@store')->name('keluar.store');
            Route::get('/edit/{id}', 'PengeluaranController@edit')->name('keluar.edit');
            Route::put('/update', 'PengeluaranController@update')->name('keluar.update');
            Route::delete('/destroy/{id}', 'PengeluaranController@destroy')->name('keluar.destroy');
        });

        Route::prefix('transaksi')->group(function () {
            Route::get('/', 'TransaksiController@index')->name('transaksi.index');
            Route::get('/show/{id}', 'TransaksiController@show')->name('transaksi.show');
        });



        // Blank
        Route::get('blank', function () {
            return view('pages.blank.layout-blank', ['menu' => 'blank']);
        })->name('blank');
    });
});
