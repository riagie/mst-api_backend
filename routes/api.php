<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/barang', [ApiController::class, 'showBarang']);
Route::get('/customer', [ApiController::class, 'showCustomer']);
Route::get('/barang_with_diskon', [ApiController::class, 'showBarangWithDiskon']);
Route::get('/transaksi', [ApiController::class, 'showTransaksi']);
Route::post('/transaksi', [ApiController::class, 'inputTransaksi']);
