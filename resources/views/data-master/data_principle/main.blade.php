@extends('components.app')

@section('css')
@endsection

@section('content')
    <div class="row gy-4">
        <h4 class="fw-bold mb-2 py-3">
            {{-- <span class="text-muted fw-light">Data Master /</span> Principle --}}
            <span class="text-muted fw-light">Data Master /</span> {{ $data['title'] }}
        </h4>
        <div class="main-page card p-3">
            <div class="card-datatable text-nowrap p-3">
                <div class="col-lg-3 col-sm-6 col-12 mb-4">
                    <div class="demo-inline-spacing">
                        <div class="btn-group">
                            <button type="button" onclick="addPrinciple()" class="btn btn-primary"><i
                                    class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru</button>
                            {{-- <button type="button" onclick="detailCustommer()" class="btn btn-warning"><i class="mdi mdi-plus-box-multiple-outline me-1"></i> Detail Custommer</button> --}}
                        </div>
                    </div>
                </div>
                <table id="datagrid" class="table-bordered table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Principal</th>
                            <th>Nama Principal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
        <div class="add-principle-page"></div>
        <div class="detail-custommer-page"></div>
    </div>
@endsection

@section('js')
    <script>
        if (typeof jQuery !== 'undefined') {
            console.log('jQuery Loaded');
        } else {
            console.log('not loaded yet');
        }
        $(function() {
            var table = $('#datagrid').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    searchPlaceholder: "Ketikkan yang dicari"
                },
                ajax: "{{ route('data-principle') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kode_principal',
                        name: 'kode_principal',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'nama_principal',
                        name: 'nama_principal',
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
    <script type="text/javascript">
        function addPrinciple() {
            $.post("{!! route('form-add-principle') !!}").done(function(data) {
                if (data.status == 'success') {
                    $('.add-principle-page').html('');
                    $('.add-principle-page').html(data.content).fadeIn();
                    $('#addPrinciple').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
            });
        }

        function editForm(id) {
            $.post("{!! route('form-add-principle') !!}", {
                id: id
            }).done(function(data) {
                if (data.status == 'success') {
                    $('.add-principle-page').html('');
                    $('.add-principle-page').html(data.content).fadeIn();
                    $('#addPrinciple').modal('show'); // Show the modal
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
                    $.post("{!! route('destroy-Principle') !!}", {
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
                    toastr.warning(data);

                    $('#datagrid').DataTable().ajax.reload();
                }
            });
        };
    </script>
@endsection
