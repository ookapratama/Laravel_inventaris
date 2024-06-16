<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BarangExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $mulai;
    protected $sampai;

    public function __construct($mulai = null, $sampai = null)
    {
        $this->mulai = $mulai;
        $this->sampai = $sampai;
    }

    public function collection()
    {
        if ($this->mulai && $this->sampai) {
            return Barang::whereBetween('created_at', [$this->mulai, $this->sampai])
                ->with('kategori') 
                ->get();
        }

        return Barang::with('kategori')->get();
    }

    public function headings(): array
    {
        return [
            'Kode Barang',
            'Nama Barang',
            'Deskripsi',
            'Stok',
            'Satuan',
            'Kategori',
            'Tanggal Dibuat',
        ];
    }

    public function map($item): array
    {
        return [
            $item->kode,
            $item->nama,
            strip_tags($item->deskripsi), 
            strval($item->stok),
            $item->satuan,
            $item->kategori->nama,
            $item->created_at->format('m-d-Y'), 
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
        ];
    }
}
