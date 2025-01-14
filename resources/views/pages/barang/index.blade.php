@extends('layouts.app', ['title' => 'Data Barang'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>DataTables</h1>
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
                                <h4>Barang DataTables</h4>
                                <a href="{{ route('barang.create') }}" class="btn btn-success justi my-3 p-2">+ Tambah
                                    Barang</a>
                            </div>
                            <div class="card-header d-flex justify-content-between">
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
                                            <button class="btn btn-primary  p-2" type="submit"><i class="fas fa-sticky-note pr-1"></i> Filter & Download
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
                                                <th>Tanggl Input Barang</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Spesifikasi</th>
                                                <th>Stok</th>
                                                <th>Kategori</th>
                                                <th>Satuan</th>
                                                {{-- <th>Lokasi</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $i => $item)
                                                <tr>
                                                    <td>
                                                        {{ ++$i }}
                                                    </td>
                                                    <td width="100">{{ date('d-M-Y', strtotime($item->created_at)) }}</td>
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
                                                    {{-- <td>
                                                        <div
                                                            class="badge badge-{{ $item->status == 'aktif' ? 'success' : 'danger' }}">
                                                            {{ $item->status }}</div>
                                                    </td> --}}
                                                    <td>
                                                        {{-- <a href="#" class="btn btn-primary" onclick="detailBarang({{$item->id}})" id="detail-barang">Detail</a> --}}
                                                        <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning">Edit</a>
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
                </div>

            </div>
        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
        <script src="{{ asset('library/prismjs/prism.js') }}"></script>
        <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
    @endpush
@endsection
