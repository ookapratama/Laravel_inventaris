@extends('layouts.app', ['title' => 'Tambah Barang'])
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
                <form action="{{ route('barang.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 ">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Nama Barang</label>
                                                <input required  type="text" name="nama" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
                                        {{-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jumlah Barang</label>
                                            </div>
                                            
                                        </div> --}}
                                        <input readonly required value="0" name="stok" type="hidden" class="form-control">
                                        <div class="col-md-3">
                                            <label>Satuan Barang</label>
                                            <select name="satuan" id="" class="form-control">
                                                <option value="">-- Pilih Satuan -- </option>
                                                <option value="pcs">pcs</option>
                                                <option value="dos">dos</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Spesifikasi</label>
                                                <textarea required name="deskripsi" class="summernote-simple"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="card-footer text-right">
                                    <a class="btn btn-warning" href="{{ route('barang.index') }}">Kembali</a>
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
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
