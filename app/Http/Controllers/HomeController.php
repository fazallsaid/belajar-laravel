<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function tampilBarang(){
        $barang = Barang::all();
        return view('barang', compact('barang'));
    }

    public function tambahBarang(){
        return view('tambah_barang');
    }

    function prosesTambahBarang(Request $request){
        $nama_barang = $request->input('nama_barang');
        $deskripsi = $request->input('deskripsi');
        $harga = $request->input('harga');
        $stok = $request->input('stok');
        //tambahkan variabel untuk menangkap input file
        $foto_barang = $request->file('foto_barang');

        //tambahkan variabel untuk mendapatkan nama file nya
        $thumb = $foto_barang->getClientOriginalName();

        //tentukan jalur untuk menyimpan filenya
        //contoh: kita akan menyimpan file nya di folder public->foto_barang
        $path = public_path() . '/foto_barang';

        //selanjutnya kita akan membuat kondisi
        if(!File::exists($path)){ //jika path nya tidak ada, ditandai dengan tanda seru (!)
            //maka kita buat folder baru
            File::makeDirectory($path, 0755, true, true);
            //dan file nya kita simpan disini
            $foto_barang->move($path, $thumb);
        }else{ //kalau misalnya sudah ada folder, tinggal kita simpan saja filenya
            $foto_barang->move($path, $thumb);
        }

        $barang = new Barang;
        $barang->nama_barang = $nama_barang;
        $barang->deskripsi = $deskripsi;
        $barang->harga = $harga;
        $barang->stok = $stok;
        $barang->foto_barang = $thumb; //kita tambahkan field foto_barang di dalam proses penyimpanan
        $barang->save();

        if($barang){
            return redirect('barang');
        }else{
            return redirect('barang')->with('error','Aduh, ada kesalahan!');
        }
    }

    public function editBarang($id_barang){
        $barang = Barang::where('barang_id', $id_barang)->first();
        return view('edit_barang', compact('barang'));
    }

    function editBarangProcess(Request $request){
        //identifikasi inputan yang akan dimasukkan
        $id_barang = $request->input('id_barang');
        $nama_barang = $request->input('nama_barang');
        $deskripsi = $request->input('deskripsi');
        $harga = $request->input('harga');
        $stok = $request->input('stok');
        $foto_barang = $request->file('foto_barang');

        //buat jalur
        $path = public_path() . '/foto_barang';

        //ambil data sebelumnya dari database
        $query = Barang::where('id_barang',$id_barang)->first();

        //buat variabel untuk meng-identifikasi kolom foto_barang
        $foto_lama = $query->foto_barang;


        //buat kondisi apakah variabel $foto_barang terisi file atau tidak
        if($foto_barang){ //jika variabel $foto_barang terisi
            
            //maka kita akan mengambil nama file nya
            $thumb = $foto_barang->getClientOriginalName();

            //lalu, kita akan menghapus foto lama
            File::delete($path . '/' . $foto_lama);

            //setelah itu, kita akan upload foto baru
            $foto_barang->move($path, $thumb);
        } //jika tidak terisi, maka tidak terjadi efek apa apa.

        //selanjutnya, kita buat proses update data di database
        //kita akan memakai variabel $query
        $query->nama_barang = $nama_barang;
        $query->deskripsi = $deskripsi;
        $query->harga = $harga;
        $query->stok = $stok;
        $query->foto_barang = $thumb; //kita hanya memasukkan nama file nya saja.
        $query->save();

        if($query){
            return redirect('barang');
        }else{
            echo "Barang tidak dapat diubah";
            return redirect('barang');
        }
    }


}
