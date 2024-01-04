<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\RoleStaffController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;

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
                Route::get('/', fn() => view('pages.login'))->name('login');
                Route::post('/', [LoginController::class, 'authenticate'])->name('auth.login');
            });

            Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');
        });
    // Route::group(['middleware' => 'auth'], function () {
    Route::prefix('/menu-karyawan')->group(function () {
        Route::get('/', [StaffController::class, 'index'])->name('staff');
        Route::get('/delete/{staff_id}', [StaffController::class, 'delete'])->name('staff.delete');
        Route::post('/new', [StaffController::class, 'create'])->name('staff.create');
        Route::post('/update/{id}', [StaffController::class, 'update'])->name('staff.update');
    });

    Route::prefix('/product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product');
        Route::post('/new', [ProductController::class, 'create'])->name('product.create');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
    });

    Route::prefix('/stock')->group(function () {
        Route::get('/', [StockController::class, 'index'])->name('stock');
        Route::post('/new', [StockController::class, 'create'])->name('stock.create');
        Route::get('/delete/{id}/{type}', [StockController::class, 'delete'])->name('stock.delete');
        Route::get('/publish/{id}/{type}', [StockController::class, 'publish'])->name('stock.publish');
        Route::post('/update/{id}/{type}', [StockController::class, 'update'])->name('stock.update');
    });

    Route::prefix('/role-staff')->group(function () {
        Route::get('/', [RoleStaffController::class, 'index'])->name('roleStaff');
        Route::post('/new', [RoleStaffController::class, 'create'])->name('roleStaff.create');
        Route::get('/delete/{id}', [RoleStaffController::class, 'delete'])->name('roleStaff.delete');
        Route::get('/publish/{id}', [RoleStaffController::class, 'publish'])->name('roleStaff.publish');
        Route::post('/update/{id}', [RoleStaffController::class, 'update'])->name('roleStaff.update');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });
