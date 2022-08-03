<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [AuthController::class, 'index'])->middleware('guest');
// Route::get('/', [AuthController::class, 'index'])->name('index');
Route::post('/cek_login', [AuthController::class, 'cek_login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth', 'checkLevel:admin']], function () {

    //Data Master (User)
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::post('/user/{id}/update', [UserController::class, 'update']);
    Route::get('/user/{id}/destroy', [UserController::class, 'destroy']);
    Route::get('/user/cetak', [UserController::class, 'cetak_user']);

    //Data Master (Kategori)
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::post('/kategori/store', [KategoriController::class, 'store']);
    Route::post('/kategori/{id}/update', [KategoriController::class, 'update']);
    Route::get('/kategori/{id}/destroy', [KategoriController::class, 'destroy']);
    Route::get('/kategori/cetak', [KategoriController::class, 'cetak_kategori']);

    //Data Master (Barang)
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/store', [BarangController::class, 'store']);
    Route::post('/barang/{id}/update', [BarangController::class, 'update']);
    Route::get('/barang/{id}/destroy', [BarangController::class, 'destroy']);
    Route::get('/barang/cetak', [BarangController::class, 'cetak_barang']);

    //Data Laporan
    // Route::get('/lap-barang-masuk', [LaporanController::class, 'lap_barang_masuk']);
    // Route::get('/lap-barang-masuk/cetak', [LaporanController::class, 'cetak_barang_masuk']);

    // Route::get('/lap-barang-keluar', [LaporanController::class, 'lap_barang_keluar']);
    // Route::get('/lap-barang-keluar/cetak', [LaporanController::class, 'cetak_barang_keluar']);

    // Route::get('/lap-user', [LaporanController::class, 'lap_user']);
    // Route::get('/lap-user/cetak', [LaporanController::class, 'cetak_user']);

    // Route::get('/lap-barang', [LaporanController::class, 'lap_barang']);
    // Route::get('/lap-barang/cetak', [LaporanController::class, 'cetak_barang']);

    // Route::get('/lap-kategori', [LaporanController::class, 'lap_kategori']);
    // Route::get('/lap-kategori/cetak', [LaporanController::class, 'cetak_kategori']);
});

Route::group(['middleware' => ['auth', 'checkLevel:gudang']], function () {
    Route::get('/home', [HomeController::class, 'home']);

    //Data Transaksi (Barang Masuk)
    Route::get('/barang-masuk', [BarangMasukController::class, 'index']);
    Route::get('/barang-masuk/ajax', [BarangMasukController::class, 'ajax']);
    Route::get('/barang-masuk/add', [BarangMasukController::class, 'add']);
    Route::post('/barang-masuk/store', [BarangMasukController::class, 'store']);
    Route::get('/barang-masuk/cetak', [BarangMasukController::class, 'cetak_barang_masuk']);


    //Data Transaksi (Barang Keluar)
    Route::get('/barang-keluar', [BarangKeluarController::class, 'index']);
    Route::get('/barang-keluar/ajax', [BarangKeluarController::class, 'ajax']);
    Route::get('/barang-keluar/add', [BarangKeluarController::class, 'add']);
    Route::post('/barang-keluar/store', [BarangKeluarController::class, 'store']);
    Route::get('/barang-keluar/cetak', [BarangKeluarController::class, 'cetak_barang_keluar']);
});
