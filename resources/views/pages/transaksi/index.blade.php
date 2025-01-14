@extends('layouts.app', ['title' => 'Data Transaksi Barang'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.css') }}">
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
                            <div class="card-header">
                                <h4>Transaksi Barang Masuk dan Keluar</h4>
                            </div>
                            <form action="{{ route('transaksi.export.excel') }}" method="POST">
                                @csrf
                                <div class="p-3">
                                    <button class="btn btn-success  p-2" type="submit"><i
                                            class="fas fa-sticky-note pr-1"></i>
                                        Download Excel</button>
                                </div>
                            </form>
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
                                                <th>Entitas (Pemasok/Penerima)</th>
                                                <th>Satuan</th>
                                                <th>Lokasi</th>
                                                <th>department</th>
                                                <th>Kategori</th>
                                                <th>Spesifikasi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $i => $item)
                                                {{-- {{dump($item->lokasi_transaksi)}} --}}
                                                <tr>
                                                    <td>{{ $i + 1 }}</td>
                                                    <td>{{ $item->tgl_transaksi }}</td>
                                                    <td>{{ $item->kode_transaksi }}</td>
                                                    <td>
                                                        {{ $item->kode }}<br>
                                                        <h6>{{ $item->nama }}</h6>
                                                    </td>
                                                    <td>{{ $item->jumlah }}</td>
                                                    <td>
                                                        <h6>
                                                            {{ $item->nama_entitas }}
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-info">{{ $item->satuan }}</div>
                                                    </td>
                                                    <td>{{ $item->lokasi_transaksi }}</td>
                                                    <td>{{ $item->department ?? 'Tidak Diketahui' }}</td>
                                                    <td>{{ $item->nama_kategori }}</td>
                                                    <td>{!! $item->spesifikasi !!}</td>
                                                    <td>
                                                        <button data-toggle="custom-modal" data-id="{{ $item->id_barang }}"
                                                            data-table="transaksi" data-kode="{{ $item->kode_transaksi }}"
                                                            data-nama="{{ $item->nama }}" class="btn btn-primary">
                                                            Detail
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{-- {{dd(true)}} --}}
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

    {{-- modal detail --}}
    @include('components.modalAjax.modal')


    </div>
    {{-- @include('components.modalAjax.modal') --}}
    @push('scripts')
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
        <script src="{{ asset('library/prismjs/prism.js') }}"></script>
        <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
        {{-- <script>
            $("#modal-2").fireModal({
                body: 'Modal body text goes here.',
                center: true
            });
        </script> --}}
    @endpush
@endsection
