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
        Schema::create('laporan_polisi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('lp_no')->unique();
            $table->text('tindak_pidana');
            $table->dateTime('tanggal_kejadian');
            $table->string('tempat_kejadian');
            $table->string('korban');
            $table->string('terlapor');
            $table->string('saksi');
            $table->text('uraian');
            $table->string('sttlp');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_polisis');
    }
};
