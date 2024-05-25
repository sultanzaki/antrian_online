<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\DashboardController;

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
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [AntrianController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::post('create-new-antrian/{layananId}', [AntrianController::class, 'createNomorAntrian']);
Route::post('panggil-antrian/{loketId}', [AntrianController::class, 'panggilNomorAntrianSelanjutnya']);
Route::post('panggil-ulang-antrian/{loketId}', [AntrianController::class, 'panggilUlangNomorAntrian']);
Route::post('selesai-antrian/{loketId}', [AntrianController::class, 'selesaiNomorAntrian']);
Route::get('/touchscreen', function () {
    return view('touchscreen');
})->name('touchscreen');
Route::get('/tv', [AntrianController::class, 'tv'])->name('tv');


Route::get('/dashboard/edit', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard.edit');
Route::post('store-valas', [DashboardController::class, 'storeValas'])->name('store-valas');
Route::post('store-counter-rate', [DashboardController::class, 'storeCounterRate'])->name('store-counter-rate');
Route::post('store-video', [DashboardController::class, 'storeVideo'])->name('store-video');


require __DIR__.'/auth.php';
