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
        Schema::create('m_personel', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('m_jabatan_id');
            $table->uuid('m_pangkat_id');
            $table->uuid('m_kelompok_id');

            $table->string('nama');
            $table->string('nrp')->unique();
            $table->timestamps();

            $table->foreign('m_jabatan_id')
                ->on('m_jabatan')
                ->references('id');
            $table->foreign('m_pangkat_id')
                ->on('m_pangkat')
                ->references('id');
            $table->foreign('m_kelompok_id')
                ->on('m_kelompok')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_personel');
    }
};
