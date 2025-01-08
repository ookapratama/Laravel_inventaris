<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BarangExport;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    private function generateKodeBarang()
    {
        // Ambil barang terakhir berdasarkan ID
        $lastBarang = Barang::orderBy('id', 'desc')->first();

        // Jika tidak ada data, buat kode pertama
        if (!$lastBarang) {
            return 'BRG-0001';
        }

        // Ambil ID terakhir dan tambahkan 1
        $lastId = $lastBarang->id;
        $nextId = $lastId + 1;

        // Format kode barang
        $kodeBarang = 'BRG-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        return $kodeBarang;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Barang::orderByDesc('id')->get();

        return view('pages.barang.index', ['menu' => 'barang'], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::get();
        return view('pages.barang.create', ['menu' => 'barang'], compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $req = $request->all();
        $req['kode'] = $this->generateKodeBarang();
        $req['status'] = 'aktif';
        Barang::create($req);
        return redirect()->route('barang.index')->with('message', 'store');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode)
    {
        $data = Barang::where('kode', $kode)->first();
        $view =  view('pages.barang.detail', compact('data'))->render();
        // dd($view);
        return response()->json(['html' => $view, 'status' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Barang::find($id);
        $kategori = Kategori::get();
        return view('pages.barang.edit', ['menu' => 'barang'], compact('data', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = Barang::find($request->id);
        $data->update($request->all());
        return redirect()->route('barang.index')->with('message', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function status(Request $request, $id)
    {
        $data = Barang::find($id);
        // $data['status'] = 'tidak aktif';

        $data['status'] = $request->status;
        $data->save();
        return response()->json(true);
    }

    public function export(Request $request)
    {
        $mulai = $request->input('mulai');
        $sampai = $request->input('sampai');

        $filename = 'Barang_Export_' . now()->format('Ymd_His') . '.xlsx';
        if ($mulai && $sampai) {
            $tes = Barang::whereBetween('created_at', [$mulai, $sampai])
            ->get([
                'kode', 'nama', 'deskripsi', 'stok', 'satuan', 'kategori_id', 'created_at', 'updated_at'
            ]);
        }
        else {
            $tes = Barang::all([
                'kode', 'nama', 'deskripsi', 'stok', 'satuan', 'kategori_id', 'created_at', 'updated_at'
            ]);
        }
        // dd($tes);

        return Excel::download(new BarangExport($mulai, $sampai), $filename);
    }
}
