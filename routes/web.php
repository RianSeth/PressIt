<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\LandingController;
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

Route::controller(LandingController::class)->group(function() {
    Route::get('/book/{id}', 'create')->name('book');
    Route::post('/book/store', 'store')->name('bookstore');
    Route::get('/booking/list', 'list')->name('booking');
    Route::put('/booking/cancel/{id}', 'cancel')->name('bookcancel');
    Route::get('/booking/edit/{id}', 'edit')->name('bookedit');
    Route::put('/booking/update/{id}', 'update')->name('bookupdate');
    Route::get('/booking/payment/{id}', 'editPay')->name('bookpay');
    Route::put('/booking/paymenting/{id}', 'updatePay')->name('bookpayupdate');
});

// Route::get('/admin', 'AdminController@index')->middleware('admin');

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    // Route::get('/home', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});