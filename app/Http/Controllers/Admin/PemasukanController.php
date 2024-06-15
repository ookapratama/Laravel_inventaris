<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pemasukan::get();
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
        $kategori = Kategori::get();
        $barang = Barang::get();
        return view('pages.pemasukan.create', ['menu' => 'pemasukan'], compact('kategori', 'barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        foreach ($request->kode as $key => $value) {

            $id = Pemasukan::max('id') + 1;
            $kodeMasuk = 'BRG-M-' . str_pad($id, 4, '0', STR_PAD_LEFT);

            $barangMasuk = new Pemasukan();

            // tambah barang pemasukan
            $barangMasuk->kode_masuk = $kodeMasuk;
            $barangMasuk->kode = $request->kode[$key];
            // $barangMasuk->nama = $request->nama[$key];
            // $barangMasuk->kategori = $request->kategori[$key];
            $barangMasuk->jumlah = $request->jumlah[$key];
            $barangMasuk->satuan = $request->satuan[$key];
            $barangMasuk->lokasi = $request->lokasi[$key];
            $barangMasuk->tgl_terima = $request->tgl_terima[$key];
            $barangMasuk->nama_pemasok = $request->nama_pemasok[$key];
            $barangMasuk->spesifikasi = $request->spesifikasi[$key];
            // dd($barangMasuk);
            $barangMasuk->save();
        }
        // dd($request->all());
        return redirect()->route('masuk.index')->with('message','store');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Pemasukan::find($id);
        $kategori = Kategori::get();
        $barang = Barang::get();
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
    public function destroy(string $id)
    {
        $data = Pemasukan::find($id);
        $data->delete();
        return response()->json($data);
    }
}
