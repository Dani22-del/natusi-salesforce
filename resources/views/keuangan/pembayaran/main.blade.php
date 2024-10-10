@extends('components.app')

@section('css')

@endsection

@section('content')
    <div class="row gy-4">
        <h4 class="fw-bold mb-2 py-3">
            <span class="text-muted fw-light">Keuangan /</span> Pembayaran
        </h4>
        <div class="main-page card p-3">
            <div class="card-datatable text-nowrap p-3">
                <div class="col-lg-3 col-sm-6 col-12 mb-4">
                    <div class="demo-inline-spacing">
                        <button type="button" onclick="addPembayaran()" class="btn btn-primary"><i
                            class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru</button>
                        <button type="button" onclick="detailStock()" class="btn btn-sm btn-warning"><i
                                class="mdi mdi-import me-1"></i> Import</button>
                        <button type="button" onclick="detailStock()" class="btn btn-sm btn-secondary"><i
                                class="mdi mdi-export me-1"></i> Export</button>
                        <button type="button" onclick="detailProduk()" class="btn btn-sm btn-danger"><i
                                class="mdi mdi-delete me-1"></i> Hapus Semua</button>
                    </div>
                </div>
                <table class="table-bordered table" id="datagrid" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Customer</th>
                            <th>Nama Toko</th>
                            <th>No Invoice</th>
                            <th>Cara Bayar</th>
                            <th>Sisa Piutang</th>
                            <th>No Kwitansi</th>
                            <th>Tanggal Bayar</th>
                            <th>Nominal Bayar</th>
                            <th>Nama Sales</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="add-pembayaran-page"></div>
        <div class="detail-produk-page"></div>
    </div>
@endsection

@section('js')
    <script>
        
    </script>
    <script>
        function addPembayaran() {
            $.post("{!! route('form-add-pembayaran') !!}").done(function(data) {
                if (data.status == 'success') {
                    $('.add-pembayaran-page').html('');
                    $('.add-pembayaran-page').html(data.content).fadeIn();
                    $('#addPembayaran').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
            });
        }
    </script>
@endsection
