@extends('layouts.app', ['title' => 'Data Transaksi Barang'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Transaksi Barang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Modules</a></div>
                    <div class="breadcrumb-item">DataTables</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Transaksi</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Kode Transaksi</th>
                                                <th>Kode Barang</th>
                                                <th>Jumlah</th>
                                                <th>Entitas</th>
                                                <th>Satuan</th>
                                                <th>Lokasi</th>
                                                <th>Kategori</th>
                                                <th>Spesifikasi</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $i => $item)
                                                <tr>
                                                    <td>{{ $i + 1 }}</td>
                                                    <td>{{ $item->transaksi_tanggal }}</td>
                                                    <td>{{ $item->kode_masuk ?? $item->kode_keluar }}</td>
                                                    <td>
                                                        {{ $item->kode }}<br>
                                                        <h6>{{ $item->barang->nama }}</h6>
                                                    </td>
                                                    <td>{{ $item->jumlah }}</td>
                                                    <td><h6> {{ $item->entitas }} </h6></td>
                                                    <td>{{ $item->satuan }}</td>
                                                    <td>{{ $item->lokasi }}</td>
                                                    <td>{{ $item->barang->kategori->nama }}</td>
                                                    <td>{!! $item->spesifikasi !!}</td>
                                                    <td>
                                                        {{-- <a href="{{ route('transaksi.show', $item->id) }}"
                                                            class="btn btn-primary">Detail</a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    @endpush
@endsection
