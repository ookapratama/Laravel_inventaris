<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class kategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ktg = [
            [
                'nama' => 'Elektronik',
            ],
            [
                'nama' => 'Makanan',
            ],
            [
                'nama' => 'Seragam',
            ],
        ];

        foreach ($ktg as $v) {
            Kategori::create([
                'nama' => $v['nama'],
            ]);
        };
    }
}
