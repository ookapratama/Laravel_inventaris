<?php

namespace App\Exports;

use App\Models\Pengeluaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class PengeluaranExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pengeluaran::all();
    }

    public function headings(): array
    {
        return [
            'Kode Transaksi',
            'Nama Barang',
            'Deskripsi',
            'Stok',
            'Satuan',
            'Department',
            'Nama Penerima',
            'Kategori',
            'Tanggal Keluar Barang',
        ];
    }

    public function map($item): array
    {
        return [
            $item->kode_keluar,
            $item->barang->nama,
            strip_tags(html_entity_decode($item->spesifikasi)), 
            strval($item->jumlah),
            $item->satuan,
            $item->department,
            $item->nama_penerima,
            $item->barang->kategori->nama,
            $item->tgl_keluar 
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                  'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF4CAF50']]]
        ];
    }

    // Adjust column widths based on the maximum length of data in each column
    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 20,
            'C' => 30,
            'D' => 10,
            'E' => 20,
            'F' => 15,
            'G' => 15,
            'H' => 15,
            'I' => 20,
        ];
    }
}