<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('/register', [AuthController::class, 'register']); 
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', 'auth:admin']], function () {
    Route::post('/logout', [AuthController::class, 'logout']); 
    Route::post('store_images', [ImageController::class, 'store']);
    Route::get('images/api', [ImageController::class, 'indexApi']);
    Route::delete('images/{id}', [ImageController::class, 'destroyApi']);
});

