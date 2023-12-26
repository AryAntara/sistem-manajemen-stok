<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

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
    return redirect(route('dashboard'));
});

Route::
        namespace('Auth')->group(function () {
            Route::prefix('/login')->group(function () {
                Route::get('/', fn() => view('pages.login'));
                Route::post('/', [LoginController::class, 'authenticate'])->name('auth.login');
            });

            Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');
        });

Route::prefix('/menu-karyawan')->group(function () {
    Route::get('/', [StaffController::class, 'index'])->name('staff');
    Route::get('/{staff_id}', [StaffController::class, 'delete'])->name('staff.delete');
    Route::post('/new', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/update/{id}', [StaffController::class, 'update'])->name('staff.update');
});

Route::prefix('/product')->group(function(){
    Route::get('/', [ProductController::class,'index'])->name('product');
    Route::post('/new', [ProductController::class,'create'])->name('product.create');
    Route::get('/{id}', [ProductController::class,'delete'])->name('product.delete');
    Route::post('/update/{id}', [ProductController::class,'update'])->name('product.update');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
