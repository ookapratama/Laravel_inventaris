<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataMasuk = Pemasukan::get();
        $dataKeluar = Pengeluaran::get();

        // $transaksi = DB::table('barangs')
        // ->join('pemasukans', 'barangs.kode', '=', 'pemasukans.kode')
        // ->join('pengeluarans', 'barangs.kode', '=', 'pengeluarans.kode')
        // ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
        // ->select(
        //     'barangs.*',
        //     'kategoris.nama as nama_kategori',
        //     // pemasukan
        //     'pemasukans.kode_masuk as kode_masuk',
        //     'pemasukans.jumlah as jumlah_masuk',
        //     'pemasukans.tgl_terima as tgl_terima',
        //     'pemasukans.lokasi as lokasi_masuk',
        //     'pemasukans.nama_pemasok as nama_pemasok',
        //     'pemasukans.jumlah as jumlah_masuk',
        //     'pemasukans.spesifikasi as spesifikasi_masuk',
        //     // pengeluaran
        //     'pengeluarans.kode_keluar as kode_keluar',
        //     'pengeluarans.jumlah as jumlah_keluar',
        //     'pengeluarans.tgl_keluar as tgl_keluar',
        //     'pengeluarans.department as department',
        //     'pengeluarans.nama_penerima as nama_penerima',
        //     'pengeluarans.spesifikasi as spesifikasi_keluar',
        //     'pengeluarans.jumlah as jumlah_keluar',
        //     'pengeluarans.lokasi as lokasi_keluar',
        // )
        // ->get();

        $transaksi = DB::table('barangs')
            ->join('pemasukans', 'barangs.kode', '=', 'pemasukans.kode')
            ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
            ->select(
                'barangs.id as id_barang',
                'barangs.kode as kode',
                'barangs.nama as nama',
                // DB::raw("'Barang Masuk' as jenis_transaksi"),
                'kategoris.nama as nama_kategori',
                'pemasukans.kode_masuk as kode_transaksi',
                'barangs.kode as kode_barang',
                'barangs.nama as nama_barang',
                'pemasukans.jumlah as jumlah',
                'pemasukans.tgl_terima as tgl_transaksi',
                'pemasukans.satuan as satuan',
                'pemasukans.lokasi as lokasi_transaksi',
                'pemasukans.catatan as department',
                'pemasukans.nama_pemasok as nama_entitas',
                'pemasukans.spesifikasi as spesifikasi'
            )
            ->union(
                DB::table('barangs')
                    ->join('pengeluarans', 'barangs.kode', '=', 'pengeluarans.kode')
                    ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
                    ->select(
                        'barangs.id as id_barang',
                        'barangs.kode as kode',
                        'barangs.nama as nama',
                        // DB::raw("'Barang Keluar' as jenis_transaksi"),
                        'kategoris.nama as nama_kategori',
                        'pengeluarans.kode_keluar as kode_transaksi',
                        'barangs.kode as kode_barang',
                        'barangs.nama as nama_barang',
                        'pengeluarans.jumlah as jumlah',
                        'pengeluarans.tgl_keluar as tgl_transaksi',
                        'pengeluarans.satuan as satuan',
                        'pengeluarans.lokasi as lokasi_transaksi',
                        'pengeluarans.department as department',
                        'pengeluarans.nama_penerima as nama_entitas',
                        'pengeluarans.spesifikasi as spesifikasi'
                    )
            )
            // ->whereNotNull('pemasukans.kode_masuk') // Filter hanya data pemasukan yang ada
            // ->orWhereNotNull('pengeluarans.kode_keluar') // Filter hanya data pengeluaran yang ada
            ->get();

            
                        
        // dd($transaksi);
        $data  = array(
            'barang'    => Barang::get(),
            'transaksi' => $transaksi,
            'masuk'     => $dataMasuk,
            'keluar'    => $dataKeluar,
        );

        return view('pages.dashboard.index', ['menu' => 'dashboard'], compact('data'));
    }
}
