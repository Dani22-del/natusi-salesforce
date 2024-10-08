@extends('components.app')

@section('css')
@endsection

@section('content')
    <div class="row gy-4">
        <h4 class="fw-bold mb-2 py-3">
            <span class="text-muted fw-light">Driver /</span>  {{ $data['title'] }}
        </h4>
        <div class="main-page card p-3">
            <div class="card-datatable text-nowrap p-3">
                <div class="col-lg-3 col-sm-6 col-12 mb-4">
                    <div class="demo-inline-spacing">
                        <div class="btn-group">
                            <button type="button" onclick="addScheduleDriver()" class="btn btn-primary"><i
                                    class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru</button>
                        </div>
                    </div>
                </div>
                <table id="datagrid" class="table-bordered table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Driver</th>
                            <th>Invoice</th>
                            <th>Nama Toko</th>
                            <th>Alamat Toko</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="add-schedule-driver-page"></div>
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
                ajax: "{{ route('schedule-driver') }}",
            
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'customer',
                        name: 'kode_customer',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data.kode_customer + '</p>';
                        }
                    },
                    {
                        data: 'driver',
                        name: 'nama_lengkap',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data.nama_lengkap + '</p>';
                        }
                    },
                    {
                        data: 'so',
                        name: 'no_invoice',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data.no_invoice + '</p>';
                        }
                    },
                    {
                        data: 'customer',
                        name: 'nama_toko',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data.nama_toko + '</p>';
                        }
                    },
                    {
                        data: 'customer',
                        name: 'alamat_toko',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data.alamat_toko + '</p>';
                        }
                    },
                    {
                        data: 'status_kunjung',
                        name: 'status_kunjung',
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
        function addScheduleDriver() {
            $.post("{!! route('form-add-schedule-driver') !!}").done(function(data) {
                if (data.status == 'success') {
                    $('.add-schedule-driver-page').html('');
                    $('.add-schedule-driver-page').html(data.content).fadeIn();
                    $('#addScheduleDriver').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
            });
        }
        function editForm(id) {
            $.post("{!! route('form-add-schedule-driver') !!}", {
                id: id
            }).done(function(data) {
                console.log(data)
                if (data.status == 'success') {
                    // $('.add-schedule-page').html('');
                    $('.add-schedule-driver-page').html(data.content).fadeIn();
                    $('#addScheduleDriver').modal('show'); // Show the modal
                    
                } else {
                    $('.main-page').show();
                }
            });
        }

        function detailSchedule() {
            $.post("{!! route('form-detail-schedule') !!}").done(function(data) {
                if (data.status == 'success') {
                    $('.detail-schedule-page').html('');
                    $('.detail-schedule-page').html(data.content).fadeIn();
                    $('#addSchedule').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
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
                    $.post("{!! route('destroy-schedule-driver') !!}", {
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
