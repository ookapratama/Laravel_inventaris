<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode',
        'kode_transaksi',
        'jumlah',
        'tgl_transaksi',
        'entitas',
        'catatan',

    ];

    public function masuk() {
        return $this->hasOne(Pemasukan::class, 'kode_masuk', 'kode_transaksi');
    } 

    public function keluar() {
        return $this->hasOne(Pengeluaran::class, 'kode_keluar', 'kode_transaksi');
    } 
}
