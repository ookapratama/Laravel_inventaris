<div class="invoice-print">
    <div class="row">
        <div class="col-lg-12">
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <address>
                        <strong>Kode - Nama Barang :</strong><br>
                        Tanggal Barang Keluar :<br>
                        Jumlah Barang Keluar :<br>
                        Lokasi Barang :<br>
                        Nama Penerima :<br>
                        Department :<br>
                        Kategori :<br>
                    </address>
                </div>
                <div class="col-md-6 text-md-right">
                    <address>
                        <strong>{{ $data->barang->kode . ' - ' . $data->barang->nama }}</strong><br>
                        {{ $data->tgl_keluar }}<br>
                        {{ $data->jumlah . ' ' . $data->satuan }}<br>
                        {{ $data->lokasi }}<br>
                        {{ $data->nama_penerima }}<br>
                        {{ $data->department }}<br>
                        {{ $data->barang->kategori->nama }}<br>
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <address>
                        <strong>Spesifikasi :</strong><br>
                        {!! $data->spesifikasi !!}
                    </address>
                </div>
            </div>
        </div>
    </div>

</div>
