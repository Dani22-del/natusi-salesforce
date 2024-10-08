@extends('components.app')

@section('css')
@endsection

@section('content')
    <div class="row gy-4">
        <h4 class="fw-bold mb-2 py-3">
            <span class="text-muted fw-light">Data Master /</span> {{ $data['title'] }}
        </h4>
        <div class="main-page card p-3">
            <div class="card-datatable text-nowrap p-3">
                <div class="col-lg-3 col-sm-6 col-12 mb-4">
                    <div class="demo-inline-spacing">
                        <div class="btn-group">
                            <button type="button" onclick="addDriver()" class="btn btn-sm btn-primary">
                                <i class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru
                            </button>
                        </div>
                    </div>
                </div>
                <table id="datagrid" class="table-bordered table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Driver</th>
                            <th>Username</th>
                            <th>No Telepon</th>
                            <th>Status</th>
                            <th>Nama Gudang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="add-driver-page"></div>
        <div class="detail-driver-page"></div>
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
                ajax: "{{ route('data-driver') }}",
                
                columns: [{
                        data: 'kode_driver',
                        name: 'kode_driver',
                        render: function(data) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap',
                        render: function(data) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'users',
                        name: 'name',
                        render: function(data) {
                            return '<p style="color:black">' + data.name + '</p>';
                        }
                    },
                    {
                        data: 'no_telp',
                        name: 'no_telp',
                        render: function(data) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'users',
                        name: 'status',
                        render: function(data) {
                            return '<p style="color:black">' + data.status + '</p>';
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
                    }
                ]
                
            });
        });
    </script>
    <script>
        function addDriver() {
            $.post("{!! route('form-add-driver') !!}").done(function(data) {
                if (data.status == 'success') {
                    $('.add-driver-page').html('');
                    $('.add-driver-page').html(data.content).fadeIn();
                    $('#addDriver').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
            });
        }

        function editForm(id) {
            $.post("{!! route('form-add-driver') !!}", {
                id: id
            }).done(function(data) {
                if (data.status == 'success') {
                    $('.add-driver-page').html('');
                    $('.add-driver-page').html(data.content).fadeIn();
                    $('#addDriver').modal('show'); // Show the modal
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
                    $.post("{!! route('destroy-driver') !!}", {
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
