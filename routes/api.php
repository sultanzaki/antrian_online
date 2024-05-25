<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntrianController;

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

Route::post('create-new-antrian/{layananId}', [AntrianController::class, 'createNomorAntrian']);
Route::post('panggil-antrian/{loketId}', [AntrianController::class, 'panggilNomorAntrianSelanjutnya']);
Route::post('panggil-ulang-antrian/{loketId}', [AntrianController::class, 'panggilUlangNomorAntrian']);
Route::post('selesai-antrian/{loketId}', [AntrianController::class, 'selesaiNomorAntrian']);

