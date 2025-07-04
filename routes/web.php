<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use Milon\Barcode\DNS1D;

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


Route::get('/', function () {
    return redirect()->route('barang.index');
})->middleware('auth');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Route untuk generate barcode (harus di luar group middleware)
Route::get('/barcode/{kode}', function ($kode) {
    return response(DNS1D::getBarcodePNG($kode, 'C128'), 200)
        ->header('Content-Type', 'image/png');
})->name('barcode.generate');


Route::middleware(['auth', 'role:admin,kasir'])->group(function () {
    Route::resource('/barang', BarangController::class);
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/laporan', [TransaksiController::class, 'laporan'])->name('laporan.index');
});
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');



