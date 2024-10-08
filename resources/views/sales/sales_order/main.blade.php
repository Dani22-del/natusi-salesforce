@extends('components.app')

@section('css')
@endsection

@section('content')
    <div class="row gy-4">
        <h4 class="fw-bold mb-2 py-3">
            <span class="text-muted fw-light">Sales /</span> Sales Order (SO)
        </h4>
        <div class="main-page card p-3">
            <div class="card-datatable text-nowrap p-3">
                <div class="col-lg-3 col-sm-6 col-12 mb-4">
                    <div class="demo-inline-spacing">
                        <div class="btn-group" id="dropdown-icon-demo">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="mdi mdi-menu me-1"></i> Menu</button>
                            <ul class="dropdown-menu">
                                <li><a onclick="addSales()" class="dropdown-item d-flex align-items-center">Tambah SO</a>
                                <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Import
                                        Invoice & Driver</a>
                                <li><a onclick="detailSales()" class="dropdown-item d-flex align-items-center">Status</a>
                                <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Print
                                        Pengiriman</a>
                                <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Hapus
                                        Data</a>
                            </ul>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: auto">
                    <table id="datagrid" class="table-bordered table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Kode SO</th>
                                <th>Nama Toko</th>
                                <th>Kode Customer</th>
                                <th>Nama Sales</th>
                                <th>Kode Sales</th>
                                <th>No Inv</th>
                                <th>Tanggal Order</th>
                                <th>Total Invoice</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="add-sales-page"></div>
        <div class="detail-sales-page"></div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            var table = $('#datagrid').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    searchPlaceholder: "Ketikkan yang dicari"
                },
                ajax: "{{ route('sales-order') }}",
                columns: [{
                        data: 'kode_so',
                        name: 'kode_so'
                    },
                    {
                        data: 'customer.nama_toko',
                        name: 'customer.nama_toko'
                    },
                    {
                        data: 'kode_customer',
                        name: 'kode_customer'
                    },
                    {
                        data: 'sales.nama_lengkap',
                        name: 'sales.nama_lengkap'
                    },
                    {
                        data: 'kode_sales',
                        name: 'kode_sales'
                    },
                    {
                        data: 'no_invoice',
                        name: 'no_invoice'
                    },
                    {
                        data: 'tanggal_invoice',
                        name: 'tanggal_invoice'
                    },
                    {
                        data: 'total_invoice',
                        name: 'total_invoice'
                    },
                    {
                        data: 'status_approve',
                        name: 'status_approve'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>

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

        function addSales() {
            $('.main-page').hide();
            $('.detail-sales-page').hide();
            $.post("{!! route('form-add-sales') !!}")
                .done(function(data) {
                    if (data.status == 'success') {
                        $('.add-sales-page').html(data.content).fadeIn();
                        loadCSS('{{ asset('assets/vendor/libs/select2/select2.css') }}');
                        loadCSS('{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}');
                        loadCSS('{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}');

                        // Pastikan JS yang dibutuhkan dimuat ulang dan diinisialisasi
                        loadScript('{{ asset('assets/vendor/libs/select2/select2.js') }}', function() {
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

        function detailSales(id) {
            $('.main-page').hide();
            $.post("{!! route('form-detail-sales-order') !!}", {
                    id: id
                })
                .done(function(data) {
                    if (data.status === 'success') {
                        $('.detail-sales-page').html(data.content).fadeIn();
                    } else {
                        $('.main-page').show();
                    }
                })
                .fail(function(error) {
                    console.error("Request failed:", error);
                });
        }


        function deleteForm(id) {
            Swal.fire({
                title: "Apakah Anda yakin akan menghapus data ini ?",
                text: "Data akan dihapus dan tidak dapat diperbaharui kembali!",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus Data!',
            }).then((result) => {
                if (result.value) {
                    $.post("{!! route('destroy-so') !!}", {
                        id: id
                    }).done(function(data) {
                        console.log(data);
                        toastr.success(data.success);
                        $('.preloader').show();
                        $('#datagrid').DataTable().ajax.reload();
                    }).fail(function() {
                        toastr.error(data);
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    toastr.warning('Penghapusan dibatalkan');
                    $('#datagrid').DataTable().ajax.reload();
                }
            });
        }
    </script>
@endsection
