<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hewans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('ras');
            $table->enum('jenis_kelamin', ['jantan', 'betina']);
            $table->integer('umur');
            $table->text('deskripsi')->nullable();
            $table->integer('harga');
            $table->integer('stok')->default(1);
            $table->string('status_kesehatan')->nullable();
            $table->boolean('sudah_vaksin')->default(false);
            $table->string('gambar')->nullable();
            $table->string('berat')->nullable();
            $table->string('warna')->nullable();
            $table->foreignId('kategori_hewan_id')->constrained('kategori_hewans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hewans');
    }
};