@extends('components.app')

@section('css')

@endsection

@section('content')
    <div class="row gy-4">
        <h4 class="fw-bold mb-2 py-3">
            <span class="text-muted fw-light">Keuangan /</span> {{ $data['title'] }}
            
        </h4>
        <div class="main-page card p-3">
            <div class="card-datatable text-nowrap p-3 table-responsive">
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
                            {{-- <th>Sisa Piutang</th> --}}
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
            $(function() {
        var table = $('#datagrid').DataTable({
            processing: true,
            serverSide: true,
            language: {
                searchPlaceholder: "Ketikkan yang dicari"
            },
            ajax: "{{ route('pembayaran') }}",
        
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
                    data: 'customer',
                    name: 'nama_toko',
                    render: function(data, type, row) {
                        return '<p style="color:black">' + data.nama_toko + '</p>';
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
                    data: 'metode_bayar',
                    name: 'metode_bayar',
                    render: function(data, type, row) {
                        return '<p style="color:black">' + data + '</p>';
                    }
                },
                {
                    data: 'no_kwitansi',
                    name: 'no_kwitansi',
                    render: function(data, type, row) {
                        return '<p style="color:black">' + data + '</p>';
                    }
                },
                {
                    data: 'tanggal_bayar',
                    name: 'tanggal_bayar',
                    render: function(data, type, row) {
                        return '<p style="color:black">' + data + '</p>';
                    }
                },
                {
                    data: 'jumlah_bayar',
                    name: 'jumlah_bayar',
                    render: function(data, type, row) {
                        return '<p style="color:black">' + data + '</p>';
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
                    data: 'sales',
                    name: 'status',
                    render: function(data, type, row) {
                        return '<p style="color:black">' + data.status + '</p>';
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
        function editForm(id) {
            $.post("{!! route('form-add-pembayaran') !!}", {
                id: id
            }).done(function(data) {
                console.log(data)
                if (data.status == 'success') {
                    $('.add-pembayaran-page').html('');
                    $('.add-pembayaran-page').html(data.content).fadeIn();
                    $('#addPembayaran').modal('show'); // Show the modal
                    
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
                    $.post("{!! route('destroy-pembayaran') !!}", {
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
