<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\General;
use App\Http\Controllers\Home;
use App\Http\Controllers\teknisi;
use App\Http\Controllers\Penilai;
use App\Http\Controllers\Pimpinan;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::post('/postlogin', [LoginController::class, 'postLogin']);
Route::get('/logout', [LoginController::class, 'logout']);
// Route::get('/', [Home::class, 'home']);
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/customer/{id_servisan}', [General::class, 'customer']);

Route::get('/tentang_aplikasi', [Home::class, 'tentangAplikasi']);


Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
});

// GENERAL CONTROLLER ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:Administrator,teknisi,pimpinan']], function () {

    Route::get('/dashboard', [General::class, 'dashboard']);
    Route::get('/profile', [General::class, 'profile']);
    Route::get('/bantuan', [General::class, 'bantuan']);

    Route::post('/ubah_foto_profile', [General::class, 'ubahFotoProfile']);
    Route::post('/ubah_role', [General::class, 'ubahRole']);
});

// ADMIN ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:user']], function () {
});


// ADMIN ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:Administrator,teknisi']], function () {
    Route::group(['prefix' => 'admin'], function () {
        // GET REQUEST

        Route::get('/pengguna', [Admin::class, 'pengguna']);
        Route::get('/fetch_data', [Admin::class, 'fetchData']);
        Route::get('/fetch_data_pembelian', [Admin::class, 'fetchDataPembelian']);

        Route::get('/keluarkan/{id_servisan}', [Admin::class, 'keluarkanServisan']);

        Route::post('/search_barang', [Admin::class, 'searchBarang']);
        Route::post('/get_all_barang', [Admin::class, 'getAllBarang']);
        Route::post('/save_penyesuaian_barang', [Admin::class, 'savePenyesuaianBarang']);


        // CRUD PENGGUNA
        Route::post('/create_pengguna', [Admin::class, 'createPengguna']);
        Route::post('/update_pengguna', [Admin::class, 'updatePengguna']);
        Route::post('/delete_pengguna', [Admin::class, 'deletePengguna']);


        // CRUD PEMBELIAN
        Route::get('/tanda_terima', [Admin::class, 'tandaTerima']);
        Route::post('/create_tanda_terima', [Admin::class, 'createTandaTerima']);
        Route::post('/update_tanda_terima', [Admin::class, 'updateTandaTerima']);
        Route::post('/delete_tanda_terima', [Admin::class, 'deleteTandaTerima']);
    });
});
// ADMIN ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:teknisi,pimpinan']], function () {
    Route::group(['prefix' => 'teknisi'], function () {
        // GET REQUEST


    });
});


Route::group(['middleware' => ['auth', 'ceklevel:pimpinan']], function () {
    Route::group(['prefix' => 'pimpinan'], function () {
        Route::get("/data_penjualan", [teknisi::class, 'dataPenjualan']);
        Route::get("/grafik_pemasukan", [Pimpinan::class, 'grafikPemasukan']);
    });
});
