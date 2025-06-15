<?php

use App\Http\Controllers\AfterLogin\BerandaController;
use App\Http\Controllers\AfterLogin\PlaystationAfterController;
use App\Http\Controllers\BeforeLogin\PlaystationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RentalController;
use Illuminate\Support\Facades\Auth;
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

// Route utama - redirect berdasarkan status login
Route::get('/', function () {
    if (Auth::guard('penyewa')->check()) {
        return redirect()->route('beranda.login');
    }
    return redirect()->route('beranda');
});

// Route untuk guest (sebelum login)
Route::middleware('guest:penyewa')->group(function () {
    // Halaman publik
    Route::view('/beranda', 'front.beranda')->name('beranda');
    Route::view('/tentang-kami', 'front.tentangkami')->name('tentang.kami');
    Route::get('/paket-harga', [PlaystationController::class, 'index'])->name('paket.harga');
    Route::view('/testimoni', 'front.testimoni')->name('testimoni');
    Route::view('/kontak', 'front.kontak')->name('kontak');

    // Authentication
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'masuk'])->name('login.masuk');

    Route::get('/daftar', [RegisterController::class, 'index'])->name('daftar.index');
    Route::post('/daftar', [RegisterController::class, 'store'])->name('daftar.store');
});

// Route untuk user yang sudah login
Route::middleware('auth.penyewa')->group(function () {
    // Halaman setelah login
    Route::view('/dashboard/beranda', 'frontend.beranda')->name('beranda.login');
    Route::view('/dashboard/tentang-kami', 'frontend.tentangkami')->name('tentangkami.login');
    Route::get('/dashboard/paket-harga', [PlaystationAfterController::class, 'index'])->name('paket.harga.login');
    Route::view('/dashboard/testimoni', 'frontend.testimoni')->name('testimoni.login');
    Route::view('/dashboard/kontak', 'frontend.kontak')->name('kontak.login');
    Route::view('/dashboard/cek-pesanan', 'frontend.checkout.cek_pesanan')->name('cekpesanan.login');

    // Dashboard utama
    Route::get('/dashboard', function () {
        return redirect()->route('beranda.login');
    })->name('dashboard.index');

    // Route Rental - Tambahkan di sini
    Route::prefix('dashboard/rental')->name('rental.')->group(function () {
        Route::get('/', [RentalController::class, 'index'])->name('index');
        Route::get('/create', [RentalController::class, 'create'])->name('create');
        Route::post('/store', [RentalController::class, 'store'])->name('store');
        Route::get('/show/{id}', [RentalController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [RentalController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [RentalController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [RentalController::class, 'destroy'])->name('destroy');

        // Route tambahan untuk rental (sesuaikan dengan kebutuhan)
        Route::get('/history', [RentalController::class, 'history'])->name('history');
        Route::post('/cancel/{id}', [RentalController::class, 'cancel'])->name('cancel');
        Route::post('/confirm/{id}', [RentalController::class, 'confirm'])->name('confirm');
    });
    // Checkout Routes
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/{penyewaan_id}', [CheckoutController::class, 'show'])->name('show');
        Route::post('/store', [CheckoutController::class, 'store'])->name('store');
        Route::post('/process', [CheckoutController::class, 'store'])->name('process');
    });

    // Pembayaran Routes
    Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/success/{pembayaran_id}', [CheckoutController::class, 'success'])->name('success');
    });
    // Tambahkan route ini di dalam grup route untuk penyewa
    Route::get('/checkout/detail/{pby_id}', [CheckoutController::class, 'detail'])
        ->name('checkout.detail');
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Route::get('/paket-harga', [PlaystationController::class, 'index'])->name('paket.harga');
// Route::get('/paket-harga', [PlaystationAfterController::class, 'index'])->name('paket.harga.login');
