<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataMasuk = Pemasukan::get();
        $dataKeluar = Pengeluaran::get();

        $transaksi = $dataMasuk->merge($dataKeluar);
        $data  = array(
            'barang'    => Barang::get(),
            'transaksi' => $transaksi,
            'masuk'     => $dataMasuk,
            'keluar'    => $dataKeluar,
        );

        return view('pages.dashboard.index', ['menu' => 'dashboard'], compact('data'));

    }
}
