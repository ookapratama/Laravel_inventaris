<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
        CREATE TRIGGER tr_tbl_barang_keluar AFTER INSERT ON `pengeluarans` FOR EACH ROW
        BEGIN 
            UPDATE barangs SET stok = stok - NEW.jumlah WHERE kode = NEW.kode;
        END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER `tr_tbl_barang_keluar`');
    }
};
