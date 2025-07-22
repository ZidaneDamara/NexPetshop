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
        Schema::create('mutasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hewan_id')->constrained('hewans')->onDelete('cascade');
            $table->integer('jumlah');
            $table->enum('tipe_mutasi', ['masuk', 'keluar']); // 'masuk' for stock in, 'keluar' for stock out
            $table->nullableMorphs('referensi'); // Polymorphic relation for order, etc.
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasis');
    }
};
