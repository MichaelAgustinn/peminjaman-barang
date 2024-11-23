@extends('layout')

@section('konten')

<div class="d-flex">
    <h4>List Barang</h4>
    <div class="ms-auto">
        <a class="btn btn-success" href="{{ route('barang.tambah') }}">tambah barang</a>
    </div>
</div>

<table class="table">
    <tr>
        <th>no</th>
        <th>nama</th>
        <th>gambar</th>
        <th>kategori</th>
        <th>stok</th>
        <th>Aksi</th>
    </tr>
    @foreach ($barang as $no=>$data)
    <tr>
        <td>{{ $no+1 }}</td>
        <td>{{ $data->nama }}</td>
        <td>
            <img src="{{ asset($data->gambar) }}" alt="Gambar Barang" style="width: 200px; height: auto; object-fit: contain;">
        </td>        
        <td>{{ $data->kategori }}</td>
        <td>{{ $data->stok }}</td>
        <td>
            <a href="{{ route('barang.edit', $data->id) }} " class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('barang.delete', $data->id) }}" method="post" onsubmit="return confirmDelete()">
                @csrf
                @method('POST')
                <button class="btn btn-sm btn-danger">HAPUS</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<script>
    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus gambar?");
    }
</script>

@endsection