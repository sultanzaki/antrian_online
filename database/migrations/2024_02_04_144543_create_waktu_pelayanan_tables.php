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
        Schema::create('waktu_pelayanan_tables', function (Blueprint $table) {
            $table->id('waktu_pelayanan_id');
            $table->unsignedBigInteger('layanan_id');
            $table->unsignedBigInteger('loket_id')->nulable();
            $table->unsignedBigInteger('nomor_antrian_id');
            $table->time('waktu_mulai_tunggu')->nullable();
            $table->time('waktu_selesai_tunggu')->nullable();
            $table->time('total_waktu_tunggu')->nullable();
            $table->time('waktu_mulai_pelayanan')->nullable();
            $table->time('waktu_selesai_pelayanan')->nullable();
            $table->time('total_waktu_pelayanan')->nullable();
            $table->timestamps();

            $table->foreign('layanan_id')->references('layanan_id')->on('layanan');
            $table->foreign('loket_id')->references('loket_id')->on('loket_pelayanan');
            $table->foreign('nomor_antrian_id')->references('nomor_antrian_id')->on('nomor_antrian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waktu_pelayanan_tables');
    }
};
