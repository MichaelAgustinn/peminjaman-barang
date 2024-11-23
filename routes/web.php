<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [BarangController::class, 'tampil'])->name('barang.tampil');
Route::get('/admin/tambah', [BarangController::class, 'tambah'])->name('barang.tambah');
Route::post('/admin/submit', [BarangController::class, 'submit'])->name('barang.submit');
Route::get('/admin/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
Route::post('/admin/delete/{id}', [BarangController::class, 'delete'])->name('barang.delete');
Route::put('/admin/update/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::get('/', [BarangController::class, 'index'])->name('barang.index');
