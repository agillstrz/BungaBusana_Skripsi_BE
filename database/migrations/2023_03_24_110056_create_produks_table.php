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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->integer('rating')->default(0);
            $table->string('nama');
            $table->longText('deskripsi');
            $table->integer('harga');
            $table->string('foto');
            $table->string('foto2')->nullable();
            $table->string('foto3')->nullable();
            $table->boolean('ukuran_S')->default(true);
            $table->boolean('ukuran_M')->default(true);
            $table->boolean('ukuran_L')->default(true);
            $table->boolean('ukuran_XL')->default(true);
            $table->integer('stok')->default(100);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};