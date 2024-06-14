@extends('layouts.app', ['title' => 'Tambah Barang Masuk'])
@section('content')
    @push('styles')
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Form Barang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
                    <div class="breadcrumb-item">Form</div>
                </div>
            </div>

            <div class="section-body">
                <form action="{{ route('masuk.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 ">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Kode Barang</label>
                                                <select required class="form-control">
                                                    <option>-- Pilih Kode Barang --</option>
                                                    <option>Option 1</option>
                                                    <option>Option 2</option>
                                                    <option>Option 3</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Barang</label>
                                                <input readonly required value="Papan" type="text" name="nama" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Kategori Barnag</label>
                                                <select name="kategori_id" id="" class="form-control">
                                                    <option value="">-- Pilih Kategori --</option>
                                                    @foreach ($kategori as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Jumlah Barang</label>
                                                <input required type="text" class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <label>Satuan Barang</label>
                                            <select name="satuan" id="" class="form-control">
                                                <option value="">-- Pilih Satuan -- </option>
                                                <option value="pcs">pcs</option>
                                                <option value="dos">dos</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Lokasi Barang Masuk</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-md-5">

                                            <div class="form-group">
                                                <label>Tanggal Masuk</label>
                                                <input required type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nama Pemasok</label>
                                                <input type="text" required name="nama_pemasok" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Catatan</label>
                                                <input type="text" required name="catatan" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Spesifikasi</label>
                                                <textarea required name="spesifikasi" class="summernote-simple"></textarea>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    <button class="btn btn-secondary" type="reset">Reset</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </section>
    </div>

    @push('scripts')
    @endpush
@endsection
