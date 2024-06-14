<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode',
        'jumlah',
        'spesifikasi',
        'satuan',
        'department',
        'nama_penerima',
        'catatan',
        'tgl_keluar',
        'kategori_id',
    ];
}
