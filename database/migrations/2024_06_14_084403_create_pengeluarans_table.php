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
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('kode_keluar');
            $table->integer('jumlah')->unsigned();
            $table->text('spesifikasi');
            $table->enum('satuan', ['pcs', 'dos']);
            $table->string('department');
            $table->string('nama_penerima');
            $table->string('catatan')->nullable();
            $table->date('tgl_keluar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluarans');
    }
};
