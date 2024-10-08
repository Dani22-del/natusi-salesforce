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
                            <button type="button" onclick="addSatuanProduk()" class="btn btn-primary"><i
                                    class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru</button>
                            {{-- <button type="button" onclick="detailStock()" class="btn btn-warning"><i class="mdi mdi-plus-box-multiple-outline me-1"></i> Detail Custommer</button> --}}
                        </div>
                    </div>
                </div>
                <table id="datagrid" class="table-bordered table">
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
                            <th>No</th>
                            <th>Kode Satuan</th>
                            <th>Nama Satuan</th>
                            <th>Jumlah Pieces</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="add-satuan-produk-page"></div>
        <div class="detail-satuan-produk-page"></div>
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
                ajax: "{{ route('data-satuan-produk') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kode_satuan',
                        name: 'kode_satuan',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'nama_satuan',
                        name: 'nama_satuan',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'jumlah_pieces',
                        name: 'jumlah_pieces',
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
        function addSatuanProduk() {
            $.post("{!! route('form-add-satuan-produk') !!}").done(function(data) {
                if (data.status == 'success') {
                    $('.add-satuan-produk-page').html('');
                    $('.add-satuan-produk-page').html(data.content).fadeIn();
                    $('#addSatuanProduk').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
            });
        }

        function editForm(id) {
            $.post("{!! route('form-add-satuan-produk') !!}", {
                id: id
            }).done(function(data) {
                if (data.status == 'success') {
                    $('.add-satuan-produk-page').html('');
                    $('.add-satuan-produk-page').html(data.content).fadeIn();
                    $('#addSatuanProduk').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
            });
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
                if (result.value) {
                    $.post("{!! route('destroy-satuan') !!}", {
                        id: id
                    }).done(function(data) {
                        console.log(data)
                        // console.log(id)
                        toastr.success(data.success);

                        $('.preloader').show();
                        $('#datagrid').DataTable().ajax.reload();
                    }).fail(function() {
                        toastr.error(data);

                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    toastr.warning(data);

                    $('#datagrid').DataTable().ajax.reload();
                }
            });
        };

        function detailStock() {
            $.post("{!! route('form-detail-satuan-produk') !!}").done(function(data) {
                if (data.status == 'success') {
                    $('.detail-satuan-produk-page').html('');
                    $('.detail-satuan-produk-page').html(data.content).fadeIn();
                    $('#detailStock').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
            });
        }
    </script>
@endsection
