@extends('components.app')

@section('css')
@endsection

@section('content')
    <div class="row gy-4">
        <h4 class="fw-bold mb-2 py-3">
            <span class="text-muted fw-light">Sales /</span> Target
        </h4>
        <div class="main-page card p-3">
            <div class="card-datatable text-nowrap p-3">
                <div class="col-lg-3 col-sm-6 col-12 mb-4">
                    <div class="demo-inline-spacing">
                        <div class="btn-group">
                            <button type="button" onclick="addSales()" class="btn btn-primary"><i
                                    class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru</button>
                        </div>
                    </div>
                </div>
                <table class="datatables-users table" id="datagrid" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Sales</th>
                            <th>Bulan Tahun</th>
                            <th>Target</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="add-target-page"></div>
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
                ajax: "{{ route('data-target') }}",

                columns: [
                    {
                        data: 'sales',
                        name: 'kode_sales',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data.kode_sales + '</p>';
                        }
                    },
                    {
                        data: 'sales',
                        name: 'nama_lengkap',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data.nama_lengkap + '</p>';
                        }
                    },
                    {
                        data: 'bulan',
                        name: 'bulan',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'target',
                        name: 'target',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data + '</p>';
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
        function addSales() {
            $.post("{!! route('form-add-data-target') !!}").done(function(data) {
                if (data.status == 'success') {
                    $('.add-target-page').html('');
                    $('.add-target-page').html(data.content).fadeIn();
                    $('#addTarget').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
            });
        }

        function detailSales() {
            $.post("{!! route('form-detail-sales-order') !!}")
                .done(function(data) {
                    if (data.status == 'success') {
                        $('.detail-sales-page').html(data.content).fadeIn();
                    } else {
                        $('.main-page').show();
                    }
                });
        }
    </script>
@endsection
