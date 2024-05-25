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
        Schema::create('nomor_antrian', function (Blueprint $table) {
            $table->id('nomor_antrian_id');
            $table->unsignedBigInteger('layanan_id');
            $table->integer('nomor_antrian');
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->foreign('layanan_id')->references('layanan_id')->on('layanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomor_antrian');
    }
};
