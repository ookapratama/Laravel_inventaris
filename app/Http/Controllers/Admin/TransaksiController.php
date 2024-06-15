<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Transaksi::get();

        $dataMasuk = Pemasukan::get();
        $dataKeluar = Pengeluaran::get();

        $data = $dataMasuk->merge($dataKeluar);
        
        $data = $data->sortByDesc('transaksi_tanggal');
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
}
