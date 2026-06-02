<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KasirController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Halaman Dashboard (Kasir)
Route::get('/dashboard', [KasirController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Proses Simpan Transaksi ke Database
Route::post('/checkout', [KasirController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('checkout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';