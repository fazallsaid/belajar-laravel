<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }

    function login(Request $request){
        $email = htmlspecialchars($request->input('email'));
        $pass = htmlspecialchars($request->input('password'));

        $user = Pengguna::where('email',$email)->first();

        if($user && Hash::check($pass, $user->password)){
            if($user->role == "admin"){
                $request->session()->put('admin',true);
                $request->session()->put('id_admin', $user->id_user);

                return redirect('dashboard');
            }else{
                $request->session()->put('customer', true);
                $request->session()->put('id_customer', $user->id_user);

                return redirect('home');
            }
        }
    }

    public function register(){
        return view('register');
    }

    function reg(Request $request){
        //buat variabel untuk mendapatkan value dari form
        $email = htmlspecialchars($request->input('email'));
        $username = htmlspecialchars($request->input('username'));
        $password = htmlspecialchars($request->input('password'));
        $nama_user = htmlspecialchars($request->input('nama_user'));
        $role = "customer";

        //enkripsi password agar tidak mudah dikenali
        $HashedPass = Hash::make($password);

        //inisialisasi model untuk proses register
        $user = new Pengguna;
        $user->email = $email;
        $user->username = $username;
        $user->password = $HashedPass;
        $user->nama_user = $nama_user;
        $user->role = $role;
        $user->save();

        //kembalikan ke halaman login
        return redirect('login');
    }

public function logout(Request $request)
{
    $usr = $request->session('customer');
    $usrid = $request->session('id_customer');

    if($usr && $usrid){
        $request->session()->forget('customer');
        $request->session()->forget('id_customer');
    }else{
        $request->session()->forget('admin');
        $request->session()->forget('id_admin');
    }

    return redirect('/');
}
}
