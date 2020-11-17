<?php

use App\Http\Controllers\Admin\CSController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::group(
    ['namespace'=>'Auth', 'as' => 'auth.'],
    function (){
        Route::get('/', [LoginController::class, 'showLoginForm'])->name('showLogin');
        Route::post('login', [LoginController::class, 'login'])->name('login');

        Route::get('yokbikinadminyok', [RegisterController::class, 'showRegister'])->name('showRegister');
        Route::post('yokbikinadminyok', [RegisterController::class, 'register'])->name('register');

        Route::post('lagout', [LoginController::class, 'logout'])->name('logout');
    }
);

Route::group(
    ['namespace'=>'Admin', 'as' => 'admin.', 'middleware' => 'auth', 'prefix' => 'admin'],
    function (){
        Route::get('home', [HomeController::class, 'home'])->name('home');
        Route::get('user/zone/{id}', [HomeController::class, 'userZone'])->name('zone');

        Route::get('omset', [FinanceController::class, 'omset'])->name('omset');
        Route::get('order', [FinanceController::class, 'getAllOrder'])->name('order.index');
        Route::get('order/{id}', [FinanceController::class, 'getOrder'])->name('order.show');
        Route::get('saldo/penarikan', [FinanceController::class, 'getAllPenarikanSaldo'])->name('saldo.penarikan');
        Route::get('saldo/pengembalian', [FinanceController::class, 'getAllPengembalianSaldo'])->name('saldo.pengembalian');
        Route::get('voucher', [FinanceController::class, 'getAllVoucher'])->name('voucher');
        Route::get('subscribe', [FinanceController::class, 'subscribe'])->name('subscribe');
        Route::get('donasi', [FinanceController::class, 'getAllDonasi'])->name('donasi.index');
        Route::get('donasi/create', [FinanceController::class, 'addDonasi'])->name('donasi.create');
        Route::get('donasi/{id}', [FinanceController::class, 'getDonasi'])->name('donasi.show');
        Route::delete('donasi/{id}', [FinanceController::class, 'deleteDonasi'])->name('donasi.delete');

        Route::get('categories', [CSController::class, 'category'])->name('categories');
        Route::post('category/toko', [CSController::class, 'storeCategoryToko'])->name('category.toko.store');
        Route::post('category/item', [CSController::class, 'storeCategoryItem'])->name('category.item.store');
        Route::patch('category/toko/{id}', [CSController::class, 'updateCategoryToko'])->name('category.toko.update');
        Route::patch('category/item/{id}', [CSController::class, 'updateCategoryItem'])->name('category.item.update');
        Route::delete('category/toko/{id}', [CSController::class, 'deleteCategoryToko'])->name('category.toko.delete');
        Route::delete('category/item/{id}', [CSController::class, 'deleteCategoryItem'])->name('category.item.delete');
    }
);
