@extends('layouts.app', ['title' => 'Edit Kategori'])
@section('content')
    @push('styles')
        <!-- Summernote CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">

    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Form Kategori</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
                    <div class="breadcrumb-item">Form</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                
                            </div>
                            <div class="card-body">
                                <form action="{{ route('kategori.update') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <div class="barang" id="barang1">
                                        <h2>Kategori</h2>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Nama Kategori</label>
                                                    <input type="text"  name="nama" id="nama" required value="{{ $data->nama }}" class="form-control nama-barang ">
                                                    
                                                </div>
                                            </div>

                                    </div>
                                    <div class="card-footer text-right">
                                      <a href="{{ route('kategori.index') }}" class="btn btn-warning" >Kembali</a>
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
        <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                let counter = 1;

                // Initialize Summernote on the initial element
                $('.summernote-simple').summernote({
                    height: 100
                });

                // Populate Nama Barang and Kategori Barang when Kode Barang is selected
                $(document).on('change', '.kode-barang', function() {
                    const kodeBarang = $(this);
                    const namaBarang = kodeBarang.closest('.barang').find('.nama-barang');
                    const kategoriBarang = kodeBarang.closest('.barang').find('.kategori-barang');
                    const satuanBarang = kodeBarang.closest('.barang').find('.satuan-barang');
                    const selectedOption = kodeBarang.find('option:selected');
                    const nama = selectedOption.data('nama');
                    const kategori = selectedOption.data('kategori');
                    const satuan = selectedOption.data('satuan');
                    console.log(satuan)

                    namaBarang.val(nama);
                    kategoriBarang.val(kategori);
                    satuanBarang.val(satuan);
                });

                $('#tambahItem').on('click', function(e) {
                    e.preventDefault();
                    counter++;

                    // Clone the original form
                    let newItem = $('#barang1').clone().attr('id', 'barang' + counter);

                    // Reset the values in the clone
                    newItem.find('input, select').val('');
                    
                    // Handle Summernote specifically
                    newItem.find('.note-editor').remove(); // Remove the Summernote editor wrapper
                    newItem.find('.summernote-simple').each(function() {
                        let originalId = $(this).attr('id');
                        let newId = originalId + counter;
                        $(this).attr('id', newId); // Change the ID for the cloned textarea
                        $(this).removeClass('note-editing-area').summernote({ // Reinitialize Summernote
                            height: 100
                        });
                    });

                    // Update the IDs of the cloned elements
                    newItem.find('.kode-barang').attr('id', 'kode' + counter);
                    newItem.find('.nama-barang').attr('id', 'nama' + counter);
                    newItem.find('.kategori-barang').attr('id', 'kategori' + counter);
                    newItem.find('.jumlah-barang').attr('id', 'jumlah' + counter);
                    newItem.find('.satuan-barang').attr('id', 'satuan' + counter);
                    newItem.find('.lokasi-barang').attr('id', 'lokasi' + counter);
                    newItem.find('.tgl-terima').attr('id', 'tgl_terima' + counter);
                    newItem.find('.nama-pemasok').attr('id', 'nama_pemasok' + counter);

                    // Append the cloned form
                    newItem.appendTo('#barangClone');
                });

                $('#kurangItem').on('click', function(e) {
                    e.preventDefault();
                    if (counter > 1) {
                        $('#barang' + counter).remove();
                        counter--;
                    }
                });
            });
        </script>
    @endpush
@endsection
