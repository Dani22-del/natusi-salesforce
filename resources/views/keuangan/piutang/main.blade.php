@extends('components.app')

@section('css')
@endsection

@section('content')
    <div class="row gy-4">
        <h4 class="fw-bold mb-2 py-3">
            <span class="text-muted fw-light">Keuangan /</span> Piutang
        </h4>
        <div class="main-page card p-3">
            <div class="card-datatable text-nowrap p-3">
                <div class="col-lg-3 col-sm-6 col-12 mb-4">
                    <div class="demo-inline-spacing">
                        <button type="button" onclick="addPiutang()" class="btn btn-sm btn-primary"><i
                                class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru</button>
                        <button type="button" onclick="detailStock()" class="btn btn-sm btn-warning"><i
                                class="mdi mdi-import me-1"></i> Import</button>
                        <button type="button" onclick="detailStock()" class="btn btn-sm btn-secondary"><i
                                class="mdi mdi-export me-1"></i> Export</button>
                        <button type="button" onclick="detailProduk()" class="btn btn-sm btn-danger"><i
                                class="mdi mdi-delete me-1"></i> Hapus Semua</button>
                    </div>
                </div>
                <table class="datatables-users table" id="datagrid" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Customer</th>
                            <th>Nama Toko</th>
                            <th>No Invoice</th>
                            <th>Tanggal Invoice</th>
                            <th>Kode Sales</th>
                            <th>Nama Sales</th>
                            <th>Nominal Invoice</th>
                            <th>Sisa Piutang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="add-piutang-page"></div>
        <div class="detail-produk-page"></div>
    </div>
@endsection

@section('js')
    <script>
        function loadCSS(href) {
            var link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = href;
            document.head.appendChild(link);
        }

        // Fungsi untuk memuat ulang JS
        function loadScript(src, callback) {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = src;
            script.onload = callback;
            document.head.appendChild(script);
        }

        function addPiutang() {
            $('.main-page').hide();
            $.post("{!! route('form-add-piutang') !!}")
                .done(function(data) {
                    console.log(data)
                    if (data.status == 'success') {
                        $('.add-piutang-page').html(data.content).fadeIn();
                        loadCSS('{{ asset('assets/vendor/libs/select2/select2.css') }}');
                        loadCSS('{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}');
                        loadCSS('{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}');

                        // Pastikan JS yang dibutuhkan dimuat ulang dan diinisialisasi
                        loadScript('{{ asset('assets/vendor/libs/select2/select2.js') }}', function() {
                            $('.s2').select2();
                            $('.select2').select2();
                        });

                        loadScript('{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}');
                        loadScript('{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}', function() {
                            $('.datepicker').flatpickr();
                        });
                    } else {
                        $('.main-page').show();
                    }
                });
        }
    </script>
@endsection
