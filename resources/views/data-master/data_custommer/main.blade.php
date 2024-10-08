@extends('components.app')

@section('css')
@endsection

@section('content')
    <div class="row gy-4">
        <h4 class="fw-bold mb-2 py-3">
            <span class="text-muted fw-light">Data Master /</span> Custommer
        </h4>
        <div class="main-page card p-3">
            <div class="card-datatable table-responsive pt-0 text-nowrap p-3">
                <div class="col-lg-3 col-sm-6 col-12 mb-4">
                    <div class="demo-inline-spacing">
                        <button type="button" onclick="addCustommer()" class="btn btn-sm btn-primary"><i
                                class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru</button>
                    </div>
                </div>
                <table id="datagrid" class="table-bordered table" style="width: 100%">
                    {{-- <thead>
          <tr>
            <th>Kode Toko</th>
            <th>Nama Toko</th>
            <th>Nama Sales</th>
            <th>Tgl.Order</th>
            <th>No.Inv</th>
            <th>Tgl.Kirim</th>
            <th>Nama Driver</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead> --}}
                    <thead>
                        <tr>
                            <th>Kode Customer</th>
                            <th>Nama Toko</th>
                            <th>Alamat Toko</th>
                            <th>Alamat Pengiriman</th>
                            <th>Nama Pemilik</th>
                            <th>No Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="add-custommer-page"></div>
        <div class="detail-custommer-page"></div>
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
                ajax: "{{ route('data-customer') }}",
                columns: [{
                        data: 'kode_customer',
                        name: 'kode_customer',
                        render: function(data) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'nama_toko',
                        name: 'nama_toko',
                        render: function(data) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'alamat_toko',
                        name: 'alamat_toko',
                        render: function(data) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'alamat_pengiriman',
                        name: 'alamat_pengiriman',
                        render: function(data, type, row) {
                            // Menentukan apakah akan menampilkan "Alamat Toko" atau "Alamat Lainnya"
                            if (data === 'alamat_toko') {
                                return '<p style="color:black">Alamat Toko</p>';
                            } else {
                                return '<p style="color:black">Alamat Lainnya</p>';
                            }
                        }
                    },
                    {
                        data: 'nama_pemilik',
                        name: 'nama_pemilik',
                        render: function(data) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'no_telepon',
                        name: 'no_telepon',
                        render: function(data) {
                            return '<p style="color:black">' + data + '</p>';
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
        function addCustommer() {
            $.post("{!! route('form-add-custommer') !!}").done(function(data) {
                if (data.status == 'success') {
                    $('.add-custommer-page').html('');
                    $('.add-custommer-page').html(data.content).fadeIn();
                    $('#addCustommer').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
            });
        }

        function editForm(id) {
            $.post("{!! route('form-add-custommer') !!}", {
                id: id
            }).done(function(data) {
                if (data.status == 'success') {
                    $('.add-custommer-page').html('');
                    $('.add-custommer-page').html(data.content).fadeIn();
                    $('#addCustommer').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
            });
        }

        function detailCustommer(id) {
            $.post("{!! route('form-detail-custommer') !!}", {
                id: id
            }).done(function(data) {
                if (data.status == 'success') {
                    $('.detail-custommer-page').html('');
                    $('.detail-custommer-page').html(data.content).fadeIn();
                    $('#detailCustommer').modal('show'); // Show the modal
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
                    $.post("{!! route('destroy-custommer') !!}", {
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
