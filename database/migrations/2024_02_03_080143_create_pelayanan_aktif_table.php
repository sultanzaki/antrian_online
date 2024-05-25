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
        Schema::create('pelayanan_aktif', function (Blueprint $table) {
            $table->id('pelayanan_aktif_id');
            $table->unsignedBigInteger('loket_id');
            $table->unsignedBigInteger('nomor_antrian_id');
            $table->timestamps();

            $table->foreign('loket_id')->references('loket_id')->on('loket_pelayanan');
            $table->foreign('nomor_antrian_id')->references('nomor_antrian_id')->on('nomor_antrian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelayanan_aktif');
    }
};
