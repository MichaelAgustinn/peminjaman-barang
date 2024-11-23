@extends('layout')

@section('konten')

<h4>Edit Barang</h4>

<form action="{{ route('barang.update', $barang->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Digunakan untuk metode PUT -->
    
    <label>Nama Barang</label>
    <input type="text" name="nama_barang" value="{{ $barang->nama }}" class="form-control mb-2">
    
    <label>Gambar Barang</label>
    <!-- Menampilkan gambar lama jika ada -->
    @if($barang->gambar)
        <img src="{{ asset($barang->gambar) }}" alt="Gambar Barang" class="img-thumbnail mb-2" width="150">
    @endif
    <input type="file" name="gambar_barang" class="form-control mb-2">
    
    <label>Kategori Barang</label>
    <input type="text" name="kategori_barang" value="{{ $barang->kategori }}" class="form-control mb-2">
    
    <label>Stok Barang</label>
    <input type="number" name="stok_barang" value="{{ $barang->stok }}" class="form-control mb-2">
    
    <button class="btn btn-primary">Save</button>
</form>

@endsection