<?php

use App\Http\Controllers\LoginController;
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
Route::prefix('/login')->group(function () {
    Route::get('/', fn() => view('pages.login'));
    Route::post('/', [LoginController::class, 'authenticate' ]);
});

Route::get('/menu-karyawan', fn () => view('pages.menu-karyawan'));

