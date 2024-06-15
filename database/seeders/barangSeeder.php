<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class barangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brg = [
            [
                'nama'          => 'Kipas angin',
                'kode'          => 'BRG-0001',
                'spesifikasi'   => 'Kabel rusak',
                'status'        => 'aktif',
                'satuan'        => 'pcs',
                'kategori_id'   => '1',
            ],
            [
                'nama'          => 'Air gelas',
                'kode'          => 'BRG-0002',
                'spesifikasi'   => 'Aman',
                'status'        => 'aktif',
                'satuan'        => 'dos',
                'kategori_id'   => '2',
            ],
            [
                'nama'          => 'Laptop',
                'kode'          => 'BRG-0003',
                'spesifikasi'   => 'Layar glitch',
                'status'        => 'aktif',
                'satuan'        => 'pcs',
                'kategori_id'   => '1',
            ],
            [
                'nama'          => 'Dompet',
                'kode'          => 'BRG-0004',
                'spesifikasi'   => 'Kosong isi nya',
                'status'        => 'aktif',
                'satuan'        => 'pcs',
                'kategori_id'   => '3',
            ],
        ];

        foreach ($brg as $v) {
            Barang::create([
                'nama' => $v['nama'],
                'kode' => $v['kode'],
                'deskripsi' => $v['spesifikasi'],
                'stok' => 0,
                'status' => $v['status'],
                'satuan' => $v['satuan'],
                'kategori_id' => $v['kategori_id'],
            ]);
        };
    }
}
