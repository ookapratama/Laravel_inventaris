<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode',
        'kode_keluar',
        'jumlah',
        'spesifikasi',
        'satuan',
        'department',
        'nama_penerima',
        'catatan',
        'tgl_keluar',
    ];

    public function barang() {
        return $this->hasOne(Barang::class, 'kode', 'kode');
    }

    public function getTransaksiTanggalAttribute()
    {
        return $this->tgl_keluar;
    }

    public function getEntitasAttribute()
    {
        return 'Nama Penerima: ' . $this->nama_penerima;
    }
}
