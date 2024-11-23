<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/barang', [BarangController::class, 'tampil'])->name('barang.tampil');
Route::get('/barang/tambah', [BarangController::class, 'tambah'])->name('barang.tambah');
Route::post('/barang/submit', [BarangController::class, 'submit'])->name('barang.submit');
Route::get('/barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
// Route::post('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::post('/barang/delete/{id}', [BarangController::class, 'delete'])->name('barang.delete');
Route::put('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
