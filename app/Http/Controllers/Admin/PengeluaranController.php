<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PengeluaranExport;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pengeluaran::orderByDesc('id')->get();
        return view('pages.pengeluaran.index', ['menu' => 'keluar'], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::orderByDesc('id')->get();
        $barang = Barang::orderByDesc('id')->get();
        return view('pages.pengeluaran.create', ['menu' => 'keluar'], compact('kategori', 'barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $barang = Barang::where(['kode' => $request->kode])->first();
        if ($request->jumlah > $barang->stok) return redirect()->back()->with('message', 'stok error');

        $id = Pengeluaran::max('id') + 1;
        $kodeKeluar = 'BRG-K-' . str_pad($id, 4, '0', STR_PAD_LEFT);

        $barangKeluar = new Pengeluaran();

        // tambah barang peKeluaran
        $barangKeluar->kode_keluar = $kodeKeluar;
        $barangKeluar->kode = $request->kode;
        $barangKeluar->lokasi = $request->lokasi;
        // $barangKeluar->kategori = $request->kategori;
        $barangKeluar->jumlah = $request->jumlah;
        $barangKeluar->satuan = $request->satuan;
        $barangKeluar->department = $request->department;
        $barangKeluar->tgl_keluar = $request->tgl_keluar;
        $barangKeluar->nama_penerima = $request->nama_penerima;
        $barangKeluar->spesifikasi = $request->spesifikasi;
        // dd($barangKeluar);
        $barangKeluar->save();
        // dd($request->all());
        return redirect()->route('keluar.index')->with('message', 'store');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode)
    {
        $data = Pengeluaran::where('kode_keluar', $kode)->first();
        $view =  view('pages.pengeluaran.detail', compact('data'))->render();
        // dd($view);
        return response()->json(['html' => $view, 'status' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $data = Pengeluaran::find($id);
        $kategori = Kategori::orderByDesc('id')->get();
        $barang = Barang::orderByDesc('id')->get();
        return view('pages.pengeluaran.edit', ['menu' => 'keluar'], compact('data', 'kategori', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $barang = Barang::where(['kode' => $request->kode])->first();
        if ($request->jumlah > $barang->stok) return redirect()->back()->with('message', 'stok error');
         // dd($request->all());
         $data = Pengeluaran::find($request->id);
         $data->update($request->all());
 
         return redirect()->route('keluar.index')->with('message', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function hapus(string $id)
    {
        $data = Pengeluaran::find($id);
        $data->delete();
        return response()->json($data);
    }

    public function export(Request $request)
    {

        $filename = 'Barang_Keluar_Export_' . now()->format('Ymd_His') . '.xlsx';
        $tes = Pengeluaran::all();

        return Excel::download(new PengeluaranExport(), $filename);
    }

}
