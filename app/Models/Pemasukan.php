<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode',
        'kode_masuk',
        'jumlah',
        'spesifikasi',
        'lokasi',
        'satuan',
        'nama_pemasok',
        'catatan',
        'tgl_terima',
    ];

    public function barang() {
        return $this->hasOne(Barang::class, 'kode', 'kode');
    }

    public function getTransaksiTanggalAttribute()
    {
        return $this->tgl_terima;
    }

    public function getEntitasAttribute()
    {
        return 'Nama Pemasok: ' . $this->nama_pemasok;
    }
}
