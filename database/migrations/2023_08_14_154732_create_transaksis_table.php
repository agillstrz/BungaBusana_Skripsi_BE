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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->uuid('pemesan_id');
            $table->string('tanggal_pemesanan')->default('menunggu');
            $table->string('status_pembayaran')->default('Pending');
            $table->string('status_pemesanan')->default('Pending');
            $table->integer('harga_pesanan');
            $table->string('metode_pembayaran')->default('menunggu');
            $table->string('url_midtrans')->nullable();
            $table->timestamps();
            $table->foreign('pemesan_id')->references('id')->on('pemesans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};