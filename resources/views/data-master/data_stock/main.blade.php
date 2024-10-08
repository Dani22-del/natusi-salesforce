@extends('components.app')

@section('css')
@endsection

@section('content')
    <div class="row gy-4">
        <h4 class="fw-bold mb-2 py-3">
            <span class="text-muted fw-light">Data Master /</span> Stock Produk
        </h4>
        <div class="main-page card p-3">
            <div class="card-datatable text-nowrap p-3">
                <div class="col-lg-3 col-sm-6 col-12 mb-4">
                    <div class="demo-inline-spacing">
                        <button type="button" onclick="addStock()" class="btn btn-sm btn-primary"><i
                                class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru</button>
                        <button type="button" onclick="detailStock()" class="btn btn-sm btn-warning"><i
                                class="mdi mdi-import me-1"></i> Import</button>
                        <button type="button" onclick="detailStock()" class="btn btn-sm btn-secondary"><i
                                class="mdi mdi-export me-1"></i> Export</button>
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
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="add-stock-page"></div>
        <div class="detail-stock-page"></div>
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
                ajax: "{{ route('data-stock') }}",
                columns: [{
                        data: 'produk', // This should correspond to the name of the relationship
                        name: 'produk.kode_produk', // Adjust this to use the relationship
                        render: function(data) {
                            return '<p style="color:black">' + (data ? data.kode_produk : 'N/A') +
                                '</p>';
                        }
                    },
                    {
                        data: 'nama_produk',
                        name: 'nama_produk',
                        render: function(data) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'qty',
                        name: 'qty',
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
        function addStock() {
            $.post("{!! route('form-add-stock') !!}").done(function(data) {
                if (data.status == 'success') {
                    $('.add-stock-page').html('');
                    $('.add-stock-page').html(data.content).fadeIn();
                    $('#addStock').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
            });
        }

        function editForm(id) {
            $.post("{!! route('form-add-stock') !!}", {
                id_master_stock: id
            }).done(function(data) {
                if (data.status == 'success') {
                    $('.add-stock-page').html('');
                    $('.add-stock-page').html(data.content).fadeIn();
                    $('#addStock').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
            });
        }

        function detailStock() {
            $.post("{!! route('form-detail-stock') !!}").done(function(data) {
                if (data.status == 'success') {
                    $('.detail-stock-page').html('');
                    $('.detail-stock-page').html(data.content).fadeIn();
                    $('#detailStock').modal('show'); // Show the modal
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
                    $.post("{!! route('destroy-stock') !!}", {
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
