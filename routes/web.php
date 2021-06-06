<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\Environment\Runtime;

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

Auth::routes();
Route::post('/postLogin', [TestController::class, 'index'])->name('postLogin');
Route::get('/logout', [TestController::class, 'logout'])->name('logout');
Route::get('/', function () {
    $barangs = Barang::where('terjual', '!=', 0)->orderBy('terjual', 'desc')->paginate(3);
    return view('welcome', compact('barangs'));
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/pesanan/{id}', [PesananController::class, 'index']);
Route::get('/barang/delete/{id}', [PesananController::class, 'hapus_br']);
Route::get('/barang/editget/{id}', [PesananController::class, 'edit_br']);
Route::put('/barang/editpost/{id}', [PesananController::class, 'update_br'])->name('edit_post');
Route::post('/pesanan/order/{id}', [PesananController::class, 'update']);
Route::get('/keranjang', [PesananController::class, 'keranjang']);
Route::delete('/cancel-order/{id}', [PesananController::class, 'destroy']);
Route::get('/order', [PesananController::class, 'order']);
Route::get('/order-transfer', [PesananController::class, 'invoice_transfer']);
Route::get('/order-transfer/{id}', [PesananController::class, 'invoice_view']);

// CONTROLER USER
Route::get('/profile', [UserController::class, 'index']);
Route::get('/history', [UserController::class, 'history']);
Route::get('/history/{id}', [UserController::class, 'detail']);
Route::get('/edit', [UserController::class, 'edit_profile']);
Route::patch('/edit/{id}/update', [UserController::class, 'update']);

//CONTROLLER ADMIN
Route::get('dashboard', [AdminController::class, 'index']);
Route::get('datapelanggan', [AdminController::class, 'datapelanggan']);
Route::get('datatransaksi', [AdminController::class, 'datatransaksi']);
Route::get('terimaorder/{id}', [AdminController::class, 'terima_order']);
Route::post('tambahbarang', [AdminController::class, 'store']);
