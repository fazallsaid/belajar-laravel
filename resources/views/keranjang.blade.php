<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container-fluid {
            max-width: 100%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .cart-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 10px;
        }
        .cart-item .info {
            flex: 1;
            margin-left: 10px;
        }
        .cart-item .info h5 {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .cart-item .info p {
            font-size: 14px;
            color: #666;
        }
        .cart-item .price {
            font-weight: bold;
            color: #333;
        }
        .cart-item .quantity {
            display: flex;
            align-items: center;
        }
        .cart-item .quantity input {
            width: 50px;
            height: 30px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 0 5px;
        }
        .total {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: #f7f7f7;
            border-top: 1px solid #ddd;
        }
        .total h4 {
            font-weight: bold;
        }
        .total .total-price {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h2 class="text-center mb-4">Keranjang Belanja</h2>
        @php
            $total = 0;
        @endphp
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Foto Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cart as $item)
                <tr>
                    <td><img src="{{asset('foto_barang/' . $item->foto_barang)}}" alt="{{$item->nama_barang}}" style="width: 30%;"></td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>
                        <input type="number" name="qty" value="{{ $item->qty }}" class="form-control" onkeyup="updateQty({{ $item->id_cart }}, this.value)">
                    </td>
                    <td>Rp {{ number_format($item->harga * $item->qty, 0, ',', '.') }}</td>
                </tr>
                @php
                    $total += $item->harga * $item->qty;
                @endphp
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada barang di keranjang Anda.</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total</th>
                    <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
        <div class="text-center mt-4">
            <form action="{{url('/order/process')}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Checkout</button>
            </form>
            <a href="{{url('/')}}" class="btn btn-primary">Lanjut Belanja</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxPMoFkaXCwL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        function updateQty(id, qty) {
            $.ajax({
                url: "{{url('cart/update')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id_cart": id,
                    "qty": qty
                },
                success: function(data) {
                    if(data.success) {
                        location.reload();
                        console.log('berhasil');
                    } else {
                        alert('Gagal mengupdate jumlah barang.');
                    }
                }
            });
        }
    </script>
</body>
</html>
