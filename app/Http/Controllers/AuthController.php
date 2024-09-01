<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }

    function login(Request $request){
        //buat variabel untuk mendapatkan value dari form
        $email = htmlspecialchars($request->input('email'));
        $password = htmlspecialchars($request->input('password'));

        //cek database
        $user = Admin::where('email', $email)->first();

        //buatlah kondisi
        if($user && Hash::check($password, $user->password)){ //jika email dan password ada dan terenkripsi
            //buat sesi
            $request->session()->put('admin', true); //sesi pertama untuk menentukan apakah sesi masih valid atau tidak
            $request->session()->put('id_admin', $user->id_admin); //sesi kedua untuk mengambil id login yang akan login

            //arahkan ke barang
            return redirect('/');
        }else{ //jika tidak ada
            //berikan peringatan
            echo "Email atau password Anda salah. Silakan diulang kembali.";
        }
    }

    // public function register(){
    //     return view('register');
    // }

    // function reg(Request $request){
    //     //buat variabel untuk mendapatkan value dari form
    //     $email = htmlspecialchars($request->input('email'));
    //     $password = htmlspecialchars($request->input('password'));
    //     $nama_admin = htmlspecialchars($request->input('nama_admin'));

    //     //enkripsi password agar tidak mudah dikenali
    //     $HashedPass = Hash::make($password);

    //     //inisialisasi model untuk proses register
    //     $admin = new Admin;

    //     //pasangkan variabel email, password dan nama admin
    //     //sesuai dengan fieldnya
    //     $admin->email = $email;

    //     //khusus password, pasangkan dengan variabel HashedPass
    //     $admin->password = $HashedPass;

    //     $admin->nama_admin = $nama_admin;
    //     $admin->save();

    //     //kembalikan ke halaman login
    //     return redirect('login');
    // }

// public function logout(Request $request)
// {
//     // Hapus sesi admin dan id_admin
//     $request->session()->forget('admin');
//     $request->session()->forget('id_admin');

//     // Arahkan ke halaman login setelah logout
//     return redirect('login');
// }
}
