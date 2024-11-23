@extends('layout')

@section('konten')

<h4>Tambah Barang</h4>

<form action="{{ route('barang.submit') }}" method="post" enctype="multipart/form-data">
    @csrf
    <label>Nama Barang</label>
    <input type="text" name="nama_barang" class="form-control mb-2">
    <label>Gambar Barang</label>
    <input type="file" name="gambar_barang" class="form-control mb-2">
    <label>Kategori Barang</label>
    <input type="text" name="kategori_barang" class="form-control mb-2">
    <label>Stok Barang</label>
    <input type="number" name="stok_barang" class="form-control mb-2">

    <button class="btn btn-primary">tambah</button>
</form>

@endsection