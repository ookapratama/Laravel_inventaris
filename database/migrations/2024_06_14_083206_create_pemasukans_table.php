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
        Schema::create('pemasukans', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->integer('jumlah');
            $table->text('spesifikasi');
            $table->string('lokasi');
            $table->string('satuan');
            $table->string('nama_pemasok');
            $table->string('catatan');
            $table->date('tgl_terima');
            $table->string('kategori_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukans');
    }
};
