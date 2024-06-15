@extends('layouts.app', ['title' => 'Data Barang Masuk'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Barang Masuk</h1>
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
                                <h4>Barang Masuk </h4>
                                <a href="{{ route('masuk.create') }}" class="btn btn-success justi my-3 p-2">+ Tambah
                                    Barang</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Kode Barang Masuk</th>
                                                <th>Tanggal Terima</th>
                                                <th>Kode Barang</th>
                                                <th>Jumlah</th>
                                                <th>Lokasi Barang</th>
                                                <th>Nama Pemasok</th>
                                                <th>Satuan</th>
                                                <th>Kategori</th>
                                                <th>Spesifikasi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $i => $item)
                                                <tr>
                                                    <td>
                                                        {{ ++$i }}
                                                    </td>
                                                    <td >{{ $item->kode_masuk }} </td>
                                                    <td>{{ $item->tgl_terima }}</td>
                                                    <td width="100">{{ $item->kode }} <br> <h6>{{ $item->barang->nama }}</h6></td>
                                                    <td width="50">
                                                        {{ $item->jumlah }}
                                                    </td>
                                                    <td>
                                                        {{ $item->lokasi }}
                                                    </td>
                                                    <td>
                                                        {{ $item->nama_pemasok }}
                                                    </td>
                                                    <td width="50">
                                                        {{ $item->satuan }}
                                                    </td>
                                                    

                                                    <td>
                                                        {{ $item->barang->kategori->nama }}
                                                    </td>
                                                    {{-- @foreach ($item->barang as $b)
                                                        <td>
                                                            {{ $b->kategori->nama == '' ? '-' : $b->kategori->nama }}
                                                        </td>
                                                    @endforeach --}}
                                                    <td>
                                                        {!! $item->spesifikasi !!}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('masuk.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                                        <button onclick="deleteData({{ $item->id }}, 'masuk')"
                                                            class="btn btn-danger">Hapus</button>
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
