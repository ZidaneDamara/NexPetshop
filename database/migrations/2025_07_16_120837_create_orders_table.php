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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nomor_pesanan')->unique();
            $table->text('alamat_pengiriman');
            $table->string('telepon_penerima')->nullable();
            $table->foreignId('rekening_pembayaran_id')->nullable()->constrained('rekening_pembayarans')->onDelete('set null');
            $table->string('bukti_transfer')->nullable(); // Path to proof of transfer image
            $table->bigInteger('total_harga');
            $table->enum('status', ['pending', 'diproses', 'selesai', 'dibatalkan'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
