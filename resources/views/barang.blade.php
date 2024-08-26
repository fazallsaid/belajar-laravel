<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            @forelse($barang as $brg)
            <div class="col-md-4">
                <div class="card">
                    @if($brg->foto_barang)
                    <img src="{{asset('foto_barang/' . $brg->foto_barang)}}" class="card-img-top" alt="{{$brg->nama_barang}}">
                    @else
                    <img src="{{asset('not_found.jpeg')}}" class="card-img-top" alt="{{$brg->nama_barang}}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{$brg->nama_barang}}</h5>
                        <p class="card-text">{{$brg->deskripsi}}</p>
                        <p class="card-text">{{$brg->harga}}</p>
                        <a href="#" class="btn btn-primary">Detail</a>
                        <a href="{{url('/barang/edit/' . $brg->barang_id)}}" class="btn btn-success">Edit</a>
                        <form action="{{url('barang/delete')}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="barang_id" value="{{$brg->barang_id}}">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                         </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12 text-center">
                <p>Barang tidak ditemukan.</p>
            </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
