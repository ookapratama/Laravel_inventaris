@extends('layouts.app', ['title' => 'Data Kategori'])

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
                                <h4>Kateogri DataTables</h4>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('kategori.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Nama Kategori</label>
                                            <input type="text" name="nama" class="form-control" id="">
                                        </div>
                                        <div class="col-md">
                                            <button type="submit" class="btn btn-success  mt-4 p-2">+
                                                Tambah Kategori</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Nama Kategori</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $i => $item)
                                                <tr>
                                                    <td>
                                                        {{ ++$i }}
                                                    </td>
                                                    <td>{{ $item->nama }}</td>

                                                    <td>
                                                        <a href="{{ route('kategori.edit', $item->id) }}"
                                                            class="btn btn-warning">Edit</a>
                                                            <button onclick="deleteData({{ $item->id }}, 'kategori')"
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
        <script src="{{ asset('library/prismjs/prism.js') }}"></script>
        <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
    @endpush
@endsection
