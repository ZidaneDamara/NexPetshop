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
        Schema::table('hewans', function (Blueprint $table) {
            $table->foreignId('pemasok_id')->nullable()->constrained('pemasoks')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hewans', function (Blueprint $table) {
            $table->dropForeign(['pemasok_id']);
            $table->dropColumn('pemasok_id');
        });
    }
};
