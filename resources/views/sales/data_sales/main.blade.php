@extends('components.app')

@section('css')
@endsection

@section('content')
    <div class="row gy-4">
        <h4 class="fw-bold mb-2 py-3">
            <span class="text-muted fw-light">Sales /</span> {{ $data['title'] }}
        </h4>
        <div class="main-page card p-3">
            <div class="card-datatable table-responsive">
                <div class="col-lg-3 col-sm-6 col-12 mb-4">
                    <div class="demo-inline-spacing">
                        <button type="button" onclick="addSales()" class="btn btn-sm btn-primary"><i
                                class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru</button>
                    </div>
                </div>
                <table class="datatables-users table" id="datagrid" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Sales</th>
                            <th>No Telepon</th>
                            <th>Status</th>
                            <th>Nama Gudang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="data-sales-page"></div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            var table = $('#datagrid').DataTable({
                processing: true,
                serverSide: true,
                // bDestroy: true,
                language: {
                    searchPlaceholder: "Ketikkan yang dicari"
                },
                ajax: "{{ route('data-sales') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kode_sales',
                        name: 'kode_sales',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'no_telp',
                        name: 'no_telp',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'gudang',
                        name: 'nama_gudang',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data.nama_gudang + '</p>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
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
            $.post("{!! route('form-add-data-sales') !!}")
                .done(function(data) {
                    console.log(data)
                    if (data.status == 'success') {
                        $('.data-sales-page').html(data.content).fadeIn();
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

        function editForm(id) {
            $.post("{!! route('form-add-data-sales') !!}", {
                id: id
            }).done((data) => {
                console.log(data)
                if (data.status == 'success') {
                    $('.main-page').hide();
                    $('.data-sales-page').html(data.content).fadeIn();
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

            })
        }

        function deleteForm(id) {
            Swal.fire({
                title: "Apakah Anda yakin akan menghapus data ini ?",
                text: "Data akan di hapus dan tidak dapat diperbaharui kembali !",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus Data!',
            }).then((result) => {
                console.log(result)
                if (result.value) {
                    $.post("{!! route('destroy-data-sales') !!}", {
                        id: id
                    }).done(function(data) {
                        console.log(data)
                        toastr.success(data.success);

                        $('.preloader').show();
                        $('#datagrid').DataTable().ajax.reload();
                    }).fail(function() {
                        toastr.error(data);

                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    toastr.warning(result.dismiss);
                    $('.preloader').show();
                    $('#datagrid').DataTable().ajax.reload();
                }
            });
        };
    </script>
@endsection
