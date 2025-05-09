<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KaryawanAssetController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('dashboard');
    // return view('welcome');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');
    Route::get('/assets/{id}/edit', [AssetController::class, 'edit'])->name('assets.edit');
    Route::post('/assets/{id}/update', [AssetController::class, 'update'])->name('assets.update');
    Route::delete('/assets/{id}', [AssetController::class, 'destroy'])->name('assets.destroy');
    Route::resource('assets', AssetController::class);
    Route::resource('detail-assets', \App\Http\Controllers\DetailAssetController::class);
    Route::resource('assets', AssetController::class)->except(['show']);
});

Route::resource('karyawans', KaryawanController::class);
Route::get('/laporan/karyawan', [App\Http\Controllers\KaryawanController::class, 'laporan'])->name('karyawan.laporan');
Route::get('/laporan/karyawan/pdf', [App\Http\Controllers\KaryawanController::class, 'exportPdf'])->name('laporan.karyawan.pdf');

// Route::resource('karyawan-asset', KaryawanAssetController::class);
Route::resource('karyawan-asset', KaryawanAssetController::class)->names([
    'index' => 'karyawan_asset.index',
    'create' => 'karyawan_asset.create',
    'store' => 'karyawan_asset.store',
    'edit' => 'karyawan_asset.edit',
    'update' => 'karyawan_asset.update',
    'destroy' => 'karyawan_asset.destroy',
    'show' => 'karyawan_asset.show',
]);

Route::resource('pengembalian-asset', \App\Http\Controllers\PengembalianAssetController::class);
Route::get('/laporan/peminjaman', [KaryawanAssetController::class, 'laporan'])->name('laporan.peminjaman');
Route::get('/laporan/peminjaman/pdf', [KaryawanAssetController::class, 'exportPdf'])->name('laporan.peminjaman.pdf');
Route::get('/laporan/asset', [AssetController::class, 'laporan'])->name('laporan.asset');
Route::get('/laporan/asset/pdf', [AssetController::class, 'exportPdf'])->name('laporan.asset.pdf');