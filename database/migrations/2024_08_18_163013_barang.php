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
            $table->integer('barang_id');
            $table->integer('qty');
            $table->timestamps();
        });

        Schema::create('transaction', function (Blueprint $table) {
            $table->increments('id_transaction');
            $table->text('trans_code');
            $table->integer('barang_id');
            $table->integer('qty');
            $table->integer('total');
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
        Schema::dropIfExists('transaction');
    }
};
