<!DOCTYPE html>
<html>
    <head>
        <title>Tambah Barang</title>
    </head>
    <body>
        <h2>Tambah Barang Baru</h2>
        <form action="{{url('barang/tambah/process')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label>Nama Barang</label>
            <br/>
            <input type="text" name="nama_barang">
            <br/>
            <label>Deskripsi</label>
            <br/>
            <textarea name="deskripsi" rows="10"></textarea>
            <br/>
            <label>Harga</label>
            <br/>
            <input type="number" name="harga" id="">
            <br/>
            <label>Stok</label>
            <br/>
            <input type="number" name="stok" id="">
            <br/>
            <label>Foto Barang</label>
            <br/>
            <input type="file" name="foto_barang" id="">
            <br/>
            <br/>
            <button type="submit">Tambahkan</button>
        </form>
    </body>
</html>
