<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
    <style>
        .navbar-nav {
            margin-left: auto;
        }
        .nav-item {
            margin-left: 10px;
        }
        .nav-link {
            color: #333;
        }
        .nav-link:hover {
            color: #555;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Online Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('login')}}">Signin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('register')}}">Signup</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-shopping-cart"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <h1 class="text-center mb-4">Konfirmasi Pesanan</h1>
            </div>
        </div>
        <div class="row">
            <form action="{{ url('submit-order') }}" method="POST">
                @csrf
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ringkasan Pesanan</h5>
                        <p class="card-text">Detail pesanan Anda:</p>
                        @php
                        $subtotal = 0;
                        @endphp
                        @foreach($trans as $transaction)
                        <p class="card-text">{{$transaction->nama_barang ?? 'N/A'}} (x{{$transaction->qty ?? 'N/A'}})</p>
                        <hr/>
                        @php
                            $subtotal = $transaction->harga ?? 'N/A' * $transaction->qty ?? 'N/A';
                            $total = $total =+ $subtotal;
                        @endphp
                        @endforeach
                        <hr/>
                        <h4>Total Pesanan: Rp {{ number_format($total, 0, ',', '.') }}</h4>
                        <button type="submit" class="btn btn-primary">Buat Pesanan</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/91500c2459.js" crossorigin="anonymous"></script>
</body>
</html>
