<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/item', [\App\Http\Controllers\Api\ItemController::class, 'getItem']);
    Route::post('/transaksi', [\App\Http\Controllers\Api\TransaksiController::class, 'store']);
    Route::get('/transaksi', [\App\Http\Controllers\Api\TransaksiController::class, 'get']);
    Route::get('/transaksi/invoice', [\App\Http\Controllers\Api\TransaksiController::class, 'invoice']);
});
