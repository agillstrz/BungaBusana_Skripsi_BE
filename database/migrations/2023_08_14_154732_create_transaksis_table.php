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
            $table->string('tanggal_pemesanan')->nullable();
            $table->string('status_pembayaran')->default('Pending');
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
        Schema::dropIfExists('transaksis');
    }
};