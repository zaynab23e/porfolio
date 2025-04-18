<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\AuthController;

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


Route::get('/login', [AuthController::class, 'loginAdmin'])->name('login');
Route::post('/login', [AuthController::class, 'loginAdminDashboard'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logoutAdmin'])->name('logout');
Route::get('/dashboard', [ImageController::class, 'index'])->name('images.index');
Route::post('/images', [ImageController::class, 'store'])->name('images.store');  
Route::delete('/images/{id}', [ImageController::class, 'destroy'])->name('images.destroy');
