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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_keluar')->nullable();

            // Lokasi absen masuk & keluar
            $table->string('lokasi_masuk')->nullable(); 
            $table->string('lokasi_keluar')->nullable();

            // Status kehadiran
            $table->enum('status', ['hadir', 'terlambat', 'alpha', 'izin', 'sakit'])
                  ->default('alpha');

            // Flag untuk deteksi fake GPS
            $table->boolean('is_fake_gps')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
