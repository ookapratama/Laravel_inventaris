<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'kode',
        'deskripsi',
        'stok',
        'status',
        'satuan',
        'kategori_id',
    ];


    public function kategori() {
        return $this->hasOne(Kategori::class, 'id', 'kategori_id');
    }
}
