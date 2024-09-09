<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengguna::insert([
            'email' => 'admin@contoh.com',
            'username' => 'adminpusat',
            'password' => Hash::make('admin12'),
            'nama_user' => 'Admin Utama',
            'no_hp' => '0895386138202',
            'role' => 'admin',
        ]);

        Pengguna::insert([
            'email' => 'customer@contoh.com',
            'username' => 'customer',
            'password' => Hash::make('customernih'),
            'nama_user' => 'Ini Customer',
            'no_hp' => '0898392039432',
            'role' => 'customer',
        ]);
    }
}
