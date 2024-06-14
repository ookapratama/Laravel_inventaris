@extends('layouts.app', ['title' => 'Edit Barang'])
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
                <form action="{{ route('barang.update') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Nama Barang</label>
                                                <input required value="{{ $data->nama }}" type="text" name="nama" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Kategori Barnag</label>
                                                <select name="kategori_id" id="" class="form-control">
                                                    <option value="">-- Pilih Kategori --</option>
                                                    @foreach ($kategori as $item)
                                                        <option {{ $data->kategori_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jumlah Barang</label>
                                                <input required name="stok" type="number" value="{{ $data->stok }}" class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <label>Satuan Barang</label>
                                            <select name="satuan" id="" class="form-control">
                                                <option value="">-- Pilih Satuan -- </option>
                                                <option {{ $data->satuan == 'pcs' ? 'selected' : '' }} value="pcs">pcs</option>
                                                <option {{ $data->satuan == 'dos' ? 'selected' : '' }} value="dos">dos</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Spesifikasi</label>
                                                <textarea required name="deskripsi" class="summernote-simple">{{ $data->deskripsi }}</textarea>
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
