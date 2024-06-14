<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode',
        'jenis_transaksi',
        'jumlah',
        'tgl_transaksi',
        'entitas',
        'catatan',

    ];
}
