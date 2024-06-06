<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Livewire\PemesanansList;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/', [LandingController::class, 'index'])->name('dashboard');

Route::middleware(['auth.redirect', 'update.pemesanan.status', 'checkuserstatus'])->group(function() {
    Route::controller(LandingController::class)->group(function() {
        Route::get('/update/kadaluarsa', 'updatePemesananStatus');
        Route::get('/book/{id}', 'create')->name('book');
        Route::post('/book/store', 'store')->name('bookstore');
        Route::get('/booking/list', 'list')->name('booking');
        Route::put('/booking/cancel/{id}', 'cancel')->name('bookcancel');
        Route::get('/booking/edit/{id}', 'edit')->name('bookedit');
        Route::put('/booking/update/{id}', 'update')->name('bookupdate');
        Route::get('/booking/payment/{id}', 'editPay')->name('bookpay');
        Route::put('/booking/paymenting/{id}', 'updatePay')->name('bookpayupdate');
        Route::get('/infouser', 'pengguna')->name('akun');
        Route::post('/changeinfo', 'changeinfo')->name('changeinfo');
        Route::get('/{record}/pdf', 'download')->name('pemesanan.invoice')->middleware(['checkusertype:admin']);
    });
});

Route::controller(DashboardController::class)->middleware(['checkusertype:admin'])->group(function() {
    Route::get('/create/customer', 'createcust')->name('createcust');
    Route::post('/create/paket', 'createpack')->name('createpack');
    Route::post('/create/order/{id}', 'create')->name('create');
    Route::post('/create/store', 'store')->name('createstore');
    Route::get('/{record}/edit', 'edit')->name('edit');
    Route::put('/update/{id}', 'update')->name('update');
    Route::get('/{record}/cancel', 'cancel')->name('cancel');
    Route::get('/{record}/refund', 'refund')->name('refund');
    Route::put('/refund/{id}', 'refundPay')->name('refundpay');
    Route::get('/close-tab', function () {
        return view('pages.dashboard.closetab');
    })->name('close-tab');
    Route::get('/banned', 'banned')->name('banned');
})->middleware(['update.pemesanan.status']);

// Route::get('/daftar-pemesanans', PemesanansList::class)->name('daftar-pemesanans');
// Route::get('/admin', 'AdminController@index')->middleware('admin');

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    // Route::get('/home', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});