@extends('layouts.app', ['title' => 'Inventaris Dashboard'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/weathericons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/weathericons/css/weather-icons-wind.min.css') }}">

        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Barang</h4>
                            </div>
                            <div class="card-body">
                                {{ $data['barang']->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-history"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Transaksi</h4>
                            </div>
                            <div class="card-body">
                                {{ $data['transaksi']->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-outdent"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Barang Masuk</h4>
                            </div>
                            <div class="card-body">
                                {{ $data['masuk']->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-truck-loading"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Barang Keluar</h4>
                            </div>
                            <div class="card-body">
                                {{ $data['keluar']->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Data Barang</h4>
                            <form action="{{ route('barang.export.excel') }}" method="POST">
                            <div class=" d-flex">
                                    @csrf
                                    <div class="btn-group">
                                        <div class="form-group">
                                            <label for="">Mulai dari : </label>
                                            <input class="form-control" type="date" name="mulai" id="">
                                        </div>
                                    </div>
                                    <div class="mx-3">
                                        <div class="form-group">
                                            <label for="">Sampai tanggal : </label>
                                            <input class="form-control" type="date" name="sampai" id="">
                                        </div>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-success  p-2" type="submit"><i class="fas fa-sticky-note pr-1"></i> Export
                                            Excel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Tanggal Barang</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Spesifikasi</th>
                                            <th>Stok</th>
                                            <th>Kategori</th>
                                            <th>Satuan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['barang'] as $i => $item)
                                            <tr>
                                                <td>
                                                    {{ ++$i }}
                                                </td>
                                                <td>{{  $item->created_at->format('m-d-Y') }}</td>
                                                <td>{{ $item->kode }}</td>
                                                <td class="align-middle">
                                                    {{ $item->nama }}
                                                </td>
                                                <td>
                                                    {!! $item->deskripsi !!}
                                                </td>
                                                <td>{{ $item->stok }}</td>
                                                <td>{{ $item->kategori->nama }}
                                                </td>
                                                <td>
                                                    <div class="badge badge-info">{{ $item->satuan }}</div>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-primary"
                                                        onclick="detailBarang({{ $item->id }})"
                                                        id="detail-barang">Detail</a>
                                                    {{-- <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning">Edit</a> --}}
                                                    {{-- @if ($item->status == 'tidak aktif')
                                                        <button onclick="setStatus({{ $item->id }}, 'barang', 'aktif')"
                                                            class="btn btn-info">Aktifkan barang</button>
                                                    @else
                                                        <button onclick="setStatus({{ $item->id }}, 'barang', 'tidak aktif')"
                                                            class="btn btn-danger">Nonaktifkan barang</button>
                                                    @endif --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Transaksi Barang Masuk dan Keluar</h4>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['transaksi'] as $i => $item)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $item->transaksi_tanggal }}</td>
                                                <td>{{ $item->kode_masuk ?? $item->kode_keluar }}</td>
                                                <td>
                                                    {{ $item->kode }}<br>
                                                    <h6>{{ $item->barang->nama }}</h6>
                                                </td>
                                                <td>{{ $item->jumlah }}</td>
                                                <td>
                                                    <h6> {{ $item->entitas }} </h6>
                                                </td>
                                                <td>{{ $item->satuan }}</td>
                                                <td>{{ $item->lokasi }}</td>
                                                <td>{{ $item->barang->kategori->nama }}</td>
                                                <td>{!! $item->spesifikasi !!}</td>
                                                <td>
                                                    <a href="{{ route('transaksi.show', $item->id) }}"
                                                        class="btn btn-primary">Detail</a>
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

            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Barang Masuk</h4>
                        </div>
                        <div class="card-body pt-2 pb-2">
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
                                        @foreach ($data['masuk'] as $i => $item)
                                            <tr>
                                                <td>
                                                    {{ ++$i }}
                                                </td>
                                                <td>{{ $item->kode_masuk }} </td>
                                                <td>{{ $item->tgl_terima }}</td>
                                                <td width="100">{{ $item->kode }} <br>
                                                    <h6>{{ $item->barang->nama }}</h6>
                                                </td>
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
                                                    <a href="{{ route('masuk.edit', $item->id) }}"
                                                        class="btn btn-primary">Detail</a>
                                                    {{-- <a href="{{ route('masuk.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                                    <button onclick="deleteData({{ $item->id }}, 'masuk')"
                                                        class="btn btn-danger">Hapus</button> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Barang Keluar</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Kode Barang Keluar</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Kode Barang</th>
                                            <th>Jumlah</th>
                                            <th>Nama Penerima</th>
                                            <th>Satuan</th>
                                            <th>Department</th>
                                            <th>Kategori</th>
                                            <th>Spesifikasi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['keluar'] as $i => $item)
                                            <tr>
                                                <td>
                                                    {{ ++$i }}
                                                </td>
                                                <td>{{ $item->kode_keluar }}</td>
                                                <td>{{ $item->tgl_keluar }}</td>
                                                <td width="100">
                                                    {{ $item->kode }} <br>
                                                    <h6>{{ $item->barang->nama }}</h6>
                                                </td>
                                                <td>
                                                    {{ $item->jumlah }}
                                                </td>
                                                <td>
                                                    {{ $item->nama_penerima }}
                                                </td>
                                                <td width="50">
                                                    {{ $item->satuan }}
                                                </td>
                                                <td>
                                                    {{ $item->department }}
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
                                                    <a href="{{ route('keluar.edit', $item->id) }}"
                                                        class="btn btn-primary">Detail</a>
                                                    {{-- <a href="{{ route('keluar.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                                    <button onclick="deleteData({{ $item->id }}, 'keluar')"
                                                        class="btn btn-danger">Hapus</button> --}}
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


        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
        <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
        <script src="{{ asset('library/prismjs/prism.js') }}"></script>
        <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="{{ asset('js/page/index-0.js') }}"></script>
    @endpush
@endsection
