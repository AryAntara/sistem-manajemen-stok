<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', function () {
    return view('pages.dashboard');
});
Route::
        namespace('Auth')->group(function () {
            Route::prefix('/login')->group(function () {
                Route::get('/', fn() => view('pages.login'));
                Route::post('/', [LoginController::class, 'authenticate'])->name('auth.login');
            });

            Route::get('/logout', [LoginController::class,'logout'])->name('auth.logout');
        });

Route::prefix('/menu-karyawan')->group(function () {
    Route::get('/', [StaffController::class, 'index'])->name('staff');
});

Route::get('/dashboard', fn() => view('pages.dashboard'))->name('dashboard');
