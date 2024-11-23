<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Interface</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <style>
        .card {
            margin: 20px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center my-4">Daftar Barang</h1>
    <div class="row">

    @foreach ($barang as $no=>$data)

        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset($data->gambar) }}" alt="Gambar Barang" style="width: auto; max-height: 200px; object-fit: contain;">
                <div class="card-body">
                    <h5 class="card-title">{{ $data->nama }}</h5>
                    <p class="card-text">{{ $data->kategori }}</p>
                    <a href="#" class="btn btn-primary">Pinjam</a>
                </div>
            </div>
        </div>

    @endforeach

        
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>