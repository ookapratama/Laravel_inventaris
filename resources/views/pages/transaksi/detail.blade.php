<div class="invoice-print">
    <div class="row">
        <div class="col-lg-12">
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <address>
                        <strong>Jenis Transaksi :</strong><br>
                        Tanggal Transaksi :<br>
                        Koda - Nama Barang :<br>
                        Jumlah Transaksi Barang :<br>
                        Entitas (Pemasok/Penerima) : <br>
                        Lokasi Barang : <br>
                        @if ($data['jenis_transaksi'] == 'Barang Keluar')
                            Department : <br>
                        @endif
                        Kategori Barang : <br>
                    </address>
                </div>
                <div class="col-md-6 text-md-right">
                    <address>
                        <strong>{{ $data['jenis_transaksi'] }}</strong><br>
                        {{ date('d-m-Y', strtotime($data['tgl_transaksi'])) }}<br>
                        {{ $data['kode_barang'] . ' - ' . $data['nama_barang'] }}<br>
                        {{ $data['jumlah'] . ' ' . $data['satuan'] }} <br>
                        {{ $data['entitas'] }} <br>
                        {{ $data['lokasi'] }} <br>
                        @if ($data['jenis_transaksi'] == 'Barang Keluar')
                            {{ $data['department'] }} <br>
                        @endif
                        {{ $data['kategori'] }} <br>
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <address>
                        <strong>Spesifikasi :</strong><br>
                        {!! $data['spesifikasi'] !!}
                    </address>
                </div>
            </div>
        </div>
    </div>

</div>
