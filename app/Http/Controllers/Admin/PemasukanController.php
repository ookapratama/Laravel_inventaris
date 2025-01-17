<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PemasukanExport;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pemasukan::orderByDesc('id')->get();
        // foreach($data as $i => $item) {
        //     // dump($item->barang);
        //     foreach($item->barang as $b) {
        //         dump($b->kategori->nama);
        //     } 
        // }
        // dd(true);


        // $barang = Barang::get();
        // foreach($barang as $i => $item) {
        //     dump($item->kategori->nama);
        // }
        return view('pages.pemasukan.index', ['menu' => 'pemasukan'], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::orderByDesc('id')->get();
        $barang = Barang::orderByDesc('id')->get();
        return view('pages.pemasukan.create', ['menu' => 'pemasukan'], compact('kategori', 'barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $barang = Barang::where(['kode' => $request->kode])->first();
        // if ($request->jumlah > $barang->stok) return redirect()->back()->with('message', 'stok error');

        $id = Pemasukan::max('id') + 1;
        $kodeMasuk = 'BRG-M-' . str_pad($id, 4, '0', STR_PAD_LEFT);

        $barangMasuk = new Pemasukan();

        // tambah barang pemasukan
        $barangMasuk->kode_masuk = $kodeMasuk;
        $barangMasuk->kode = $request->kode;
        // $barangMasuk->nama = $request->nama;
        // $barangMasuk->kategori = $request->kategori;
        $barangMasuk->jumlah = $request->jumlah;
        $barangMasuk->satuan = $request->satuan;
        $barangMasuk->lokasi = $request->lokasi;
        $barangMasuk->tgl_terima = $request->tgl_terima;
        $barangMasuk->nama_pemasok = $request->nama_pemasok;
        $barangMasuk->spesifikasi = $request->spesifikasi;
        // dd($barangMasuk);
        $barangMasuk->save();
        // dd($request->all());
        return redirect()->route('masuk.index')->with('message', 'store');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode)
    {
        $data = Pemasukan::where('kode_masuk', $kode)->first();
        $view =  view('pages.pemasukan.detail', compact('data'))->render();
        // dd($view);
        return response()->json(['html' => $view, 'status' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Pemasukan::find($id);
        $kategori = Kategori::orderByDesc('id')->get();
        $barang = Barang::orderByDesc('id')->get();
        return view('pages.pemasukan.edit', ['menu' => 'pemasukan'], compact('data', 'kategori', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $data = Pemasukan::find($request->id);
        $data->update($request->all());

        return redirect()->route('masuk.index')->with('message', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function hapus(string $id)
    {
        $data = Pemasukan::find($id);
        dump($data);
        $data->delete();
        return response()->json($data);
    }

    public function export(Request $request)
    {

        $filename = 'Barang_Masuk_Export_' . now()->format('Ymd_His') . '.xlsx';
        $tes = Pemasukan::all();

        return Excel::download(new PemasukanExport(), $filename);
    }
}
