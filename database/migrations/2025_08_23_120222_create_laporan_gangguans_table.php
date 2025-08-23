<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_gangguan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('lp_no')->unique();
            $table->string('nama_pelapor');
            $table->string('korban');
            $table->string('terlapor');
            $table->string('saksi');
            $table->string('pasal');
            $table->text('barang_bukti');
            $table->text('uraian_kejadian');
            $table->dateTime('waktu_kejadian');
            $table->string('tempat_kejadian');
            $table->dateTime('waktu_dilaporkan');
            $table->string('satker');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_gangguan');
    }
};
