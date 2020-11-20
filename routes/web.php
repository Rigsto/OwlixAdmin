<?php

use App\Http\Controllers\Admin\CustomerService\CategoryController;
use App\Http\Controllers\Admin\CustomerService\MadingController;
use App\Http\Controllers\Admin\CustomerService\PushNotifController;
use App\Http\Controllers\Admin\Finance\OrderController;
use App\Http\Controllers\Admin\Finance\VoucherController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SettingsController;
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

        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    }
);

Route::group(
    ['namespace'=>'Admin', 'as' => 'admin.', 'middleware' => 'auth', 'prefix' => 'admin'],
    function (){
        Route::get('home', [HomeController::class, 'home'])->name('home');
        Route::get('user/zone/{id}', [HomeController::class, 'userZone'])->name('zone');

        // Finance
        Route::group(
            ['namespace'=>'Finance'],
            function (){
                Route::get('order', [OrderController::class, 'getAllOrder'])->name('order.index');
                Route::get('order/{id}', [OrderController::class, 'getOrder'])->name('order.show');

                Route::get('voucher', [VoucherController::class, 'getAllVoucher'])->name('voucher');
                Route::post('voucher', [VoucherController::class, 'storeVoucher'])->name('voucher.store');
                Route::patch('voucher/{id}', [VoucherController::class, 'updateVoucher'])->name('voucher.update');
                Route::delete('voucher/{id}}', [VoucherController::class, 'deleteVoucher'])->name('voucher.delete');
            }
        );

        Route::get('omset', [FinanceController::class, 'omset'])->name('omset');
        Route::get('saldo/penarikan', [FinanceController::class, 'getAllPenarikanSaldo'])->name('saldo.penarikan');
        Route::get('saldo/pengembalian', [FinanceController::class, 'getAllPengembalianSaldo'])->name('saldo.pengembalian');
        Route::get('subscribe', [FinanceController::class, 'subscribe'])->name('subscribe');
        Route::get('donasi', [FinanceController::class, 'getAllDonasi'])->name('donasi.index');
        Route::get('donasi/create', [FinanceController::class, 'addDonasi'])->name('donasi.create');
        Route::get('donasi/{id}', [FinanceController::class, 'getDonasi'])->name('donasi.show');
        Route::delete('donasi/{id}', [FinanceController::class, 'deleteDonasi'])->name('donasi.delete');

        // Customer Service
        Route::group(
            ['namespace'=>'CustomerService'],
            function (){
                Route::get('info', [MadingController::class, 'index'])->name('info');
                Route::post('info', [MadingController::class, 'store'])->name('info.store');
                Route::patch('info/{id}', [MadingController::class, 'update'])->name('info.update');
                Route::delete('info/{id}', [MadingController::class, 'delete'])->name('info.delete');

                Route::get('notif', [PushNotifController::class, 'index'])->name('notif');
                Route::post('notif', [PushNotifController::class, 'store'])->name('notif.store');
                Route::patch('notif/{id}', [PushNotifController::class, 'update'])->name('notif.update');
                Route::delete('notif/{id}', [PushNotifController::class, 'delete'])->name('notif.delete');

                Route::get('categories', [CategoryController::class, 'category'])->name('categories');
                Route::post('category/toko', [CategoryController::class, 'storeCategoryToko'])->name('category.toko.store');
                Route::post('category/item', [CategoryController::class, 'storeCategoryItem'])->name('category.item.store');
                Route::patch('category/toko/{id}', [CategoryController::class, 'updateCategoryToko'])->name('category.toko.update');
                Route::patch('category/item/{id}', [CategoryController::class, 'updateCategoryItem'])->name('category.item.update');
                Route::delete('category/toko/{id}', [CategoryController::class, 'deleteCategoryToko'])->name('category.toko.delete');
                Route::delete('category/item/{id}', [CategoryController::class, 'deleteCategoryItem'])->name('category.item.delete');
            }
        );

        Route::get('suspend/account', [SettingsController::class, 'index'])->name('suspend');
    }
);
