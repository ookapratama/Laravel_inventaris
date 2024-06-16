<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransaksiExport;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('barangs')
        ->join('pemasukans', 'barangs.kode', '=', 'pemasukans.kode')
        ->join('pengeluarans', 'barangs.kode', '=', 'pengeluarans.kode')
        ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
        ->select(
            'barangs.*',
            'kategoris.nama as nama_kategori',
            'pemasukans.kode_masuk as kode_masuk',
            'pemasukans.jumlah as jumlah_masuk',
            'pemasukans.tgl_terima as tgl_terima',
            'pemasukans.lokasi as lokasi_masuk',
            'pemasukans.nama_pemasok as nama_pemasok',
            'pemasukans.jumlah as jumlah_masuk',
            'pemasukans.spesifikasi as spesifikasi_masuk',
            'pengeluarans.kode_keluar as kode_keluar',
            'pengeluarans.jumlah as jumlah_keluar',
            'pengeluarans.tgl_keluar as tgl_keluar',
            'pengeluarans.department as department',
            'pengeluarans.nama_penerima as nama_penerima',
            'pengeluarans.spesifikasi as spesifikasi_keluar',
            'pengeluarans.jumlah as jumlah_keluar'
        )
        ->get();
            // dd($data);
        // $dataMasuk = Pemasukan::get();
        // $dataKeluar = Pengeluaran::get();


        // $data = $dataMasuk->merge($dataKeluar);
        // $data = $data->sortByDesc('transaksi_tanggal');

        // dd($data);
        return view('pages.transaksi.index', ['menu' => 'transaksi'], compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function export(Request $request)
    {
        $data = DB::table('barangs')
        ->join('pemasukans', 'barangs.kode', '=', 'pemasukans.kode')
        ->join('pengeluarans', 'barangs.kode', '=', 'pengeluarans.kode')
        ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
        ->select(
            'barangs.*',
            'kategoris.nama as nama_kategori',
            'pemasukans.kode_masuk as kode_masuk',
            'pemasukans.jumlah as jumlah_masuk',
            'pemasukans.tgl_terima as tgl_terima',
            'pemasukans.lokasi as lokasi_masuk',
            'pemasukans.nama_pemasok as nama_pemasok',
            'pemasukans.jumlah as jumlah_masuk',
            'pemasukans.spesifikasi as spesifikasi_masuk',
            'pengeluarans.kode_keluar as kode_keluar',
            'pengeluarans.jumlah as jumlah_keluar',
            'pengeluarans.tgl_keluar as tgl_keluar',
            'pengeluarans.department as department',
            'pengeluarans.nama_penerima as nama_penerima',
            'pengeluarans.spesifikasi as spesifikasi_keluar',
            'pengeluarans.jumlah as jumlah_keluar'
        )
        ->get();
        // dd($data);
        $filename = 'Transaksi_Export_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new TransaksiExport(), $filename);
    }
}
