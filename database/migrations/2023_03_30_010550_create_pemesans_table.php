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
        Schema::create('pemesans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->string('email');
            $table->string('nohp');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('alamat');
            $table->string('tanggal_pemesanan')->nullable();
            $table->string('kodepos');
            $table->boolean('status_pembayaran')->default(false);
            $table->boolean('status_pemesanan')->default(false);
            $table->integer('harga_pesanan');
            $table->string('metode_pembayaran')->default('BRI');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesans');
    }
};