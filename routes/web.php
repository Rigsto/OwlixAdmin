<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrderController;
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
        Route::get('omset', [HomeController::class, 'omsetOwlix'])->name('omset');

        Route::get('order', [OrderController::class, 'index'])->name('order.index');
        Route::get('order/{id}', [OrderController::class, 'show'])->name('order.show');
    }
);
