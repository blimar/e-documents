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
        Schema::create('laporan_dumas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no');
            $table->string('nama_pengadu');
            $table->string('nama_teradu');
            $table->text('kronologi');
            $table->text('barang_bukti');
            $table->text('modus');
            $table->string('satker');
            $table->string('foto')->nullable();
            $table->dateTime('waktu_dilaporkan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_dumas');
    }
};
