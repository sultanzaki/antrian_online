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
        Schema::create('counter_rate_tables', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('mata_uang');
            $table->string('tenor_1_bulan');
            $table->string('tenor_3_bulan');
            $table->string('tenor_6_bulan');
            $table->string('tenor_12_bulan');
            $table->string('tenor_24_bulan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counter_rate_tables');
    }
};
