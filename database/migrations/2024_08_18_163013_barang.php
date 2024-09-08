<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('barang_id');
            $table->string('nama_barang');
            $table->integer('harga');
            $table->integer('stok');
            $table->text('deskripsi');
            $table->text('foto_barang');
            $table->timestamps();
        });

        Schema::create('cart', function (Blueprint $table) {
            $table->increments('id_cart');
            $table->integer('barang_id'); //disesuaikan dengan id barang kalian
            $table->integer('qty'); //jumlah barang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
        Schema::dropIfExists('cart');
    }
};
