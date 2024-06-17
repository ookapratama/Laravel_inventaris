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



        // dd($data);
        return view('pages.transaksi.index', ['menu' => 'transaksi'], compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode)
    {
        // dd($kode);
        $masuk = Pemasukan::where('kode_masuk', $kode)->first();
        if ($masuk) {
            $data = [
                'jenis_transaksi' => 'Barang Masuk',
                'kode_transaksi' => $masuk->kode_masuk,
                'tgl_transaksi' => $masuk->tgl_terima,
                'kode_barang' => $masuk->kode,
                'nama_barang' => $masuk->barang->nama, 
                'jumlah' => $masuk->jumlah,
                'entitas' => $masuk->nama_pemasok,
                'satuan' => $masuk->satuan,
                'lokasi' => $masuk->lokasi,
                'department' => null, 
                'kategori' => $masuk->barang->kategori->nama, 
                'spesifikasi' => $masuk->spesifikasi,
                'id_barang' => $masuk->barang->id, 
            ];
        } else {
            
            $keluar = Pengeluaran::where('kode_keluar', $kode)->first();
    
            if ($keluar) {
                $data = [
                    'jenis_transaksi' => 'Barang Keluar',
                    'kode_transaksi' => $keluar->kode_keluar,
                    'tgl_transaksi' => $keluar->tgl_keluar,
                    'kode_barang' => $keluar->kode,
                    'nama_barang' => $keluar->barang->nama, 
                    'jumlah' => $keluar->jumlah,
                    'entitas' => $keluar->nama_penerima,
                    'satuan' => $keluar->satuan,
                    'lokasi' => $keluar->lokasi,
                    'department' => $keluar->department,
                    'kategori' => $keluar->barang->kategori->nama, 
                    'spesifikasi' => $keluar->spesifikasi,
                    'id_barang' => $keluar->barang->id, 
                ];
            } else {
                
                return response()->json([
                    'status' => 'not_found',
                    'message' => 'Kode tidak ditemukan di tabel pemasukan atau pengeluaran.'
                ]);
            }
        }

        $view =  view('pages.transaksi.detail', compact('data'))->render();
        // dd($view);
        return response()->json(['html' => $view, 'status' => true]);
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
