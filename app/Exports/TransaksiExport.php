<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransaksiExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{

    public function collection()
    {
        return DB::table('barangs')
            ->join('pemasukans', 'barangs.kode', '=', 'pemasukans.kode')
            ->join('pengeluarans', 'barangs.kode', '=', 'pengeluarans.kode')
            ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
            ->select(
                DB::raw("'Pemasukan' as jenis_transaksi"),
                'pemasukans.kode_masuk as kode_transaksi',
                'barangs.kode as kode_barang',
                'barangs.nama as nama_barang',
                'pemasukans.jumlah as jumlah',
                'pemasukans.tgl_terima as tanggal_transaksi',
                'pemasukans.lokasi as lokasi',
                'pemasukans.nama_pemasok as nama_pemasok',
                'pemasukans.spesifikasi as spesifikasi'
            )
            ->union(
                DB::table('barangs')
                    ->join('pengeluarans', 'barangs.kode', '=', 'pengeluarans.kode')
                    ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
                    ->select(
                        DB::raw("'Pengeluaran' as jenis_transaksi"),
                        'pengeluarans.kode_keluar as kode_transaksi',
                        'barangs.kode as kode_barang',
                        'barangs.nama as nama_barang',
                        'pengeluarans.jumlah as jumlah',
                        'pengeluarans.tgl_keluar as tanggal_transaksi',
                        'pengeluarans.department as lokasi',
                        'pengeluarans.nama_penerima as nama_pemasok',
                        'pengeluarans.spesifikasi as spesifikasi'
                    )
            )
            ->whereNotNull('pemasukans.kode_masuk') // Filter hanya data pemasukan yang ada
            ->orWhereNotNull('pengeluarans.kode_keluar') // Filter hanya data pengeluaran yang ada
            ->get();
    }

    public function headings(): array
    {
        return [
            'Jenis Transaksi',
            'Kode Transaksi',
            'Kode Barang',
            'Nama Barang',
            'Jumlah',
            'Tanggal Transaksi',
            'Lokasi',
            'Nama Pemasok/Penerima',
            'Spesifikasi',
        ];
    }


    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']], // Styling font tebal dan warna putih
                'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF4CAF50']], // Warna latar belakang hijau
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15, // Lebar kolom A
            'B' => 20, // Lebar kolom B
            'C' => 15, // Lebar kolom C
            'D' => 25, // Lebar kolom D
            'E' => 10, // Lebar kolom E
            'F' => 15, // Lebar kolom F
            'G' => 15, // Lebar kolom G
            'H' => 25, // Lebar kolom H
            'I' => 30, // Lebar kolom I
        ];
    }
}
