<!DOCTYPE html>
<html>
    <head>
        <title>Edit Barang</title>
    </head>
    <body>
        <h2>Edit {{$barang->nama_barang}}</h2>
        <form action="{{url('barang/edit/process/' . $barang->id_barang)}}" method="POST">
            <label>Nama Barang</label>
            <br/>
            <input type="text" name="nama_barang" value="{{$barang->nama_barang}}">
            <br/>
            <label>Deskripsi</label>
            <br/>
            <textarea name="deskripsi" rows="10">{{$barang->deskripsi}}</textarea>
            <br/>
            <label>Harga</label>
            <br/>
            <input type="number" name="harga" value="{{$barang->harga}}">
            <br/>
            <label>Stok</label>
            <br/>
            <input type="number" name="stok" value="{{$barang->stok}}">
            <br/>
            <button type="submit">Simpan</button>
        </form>
    </body>
</html>
