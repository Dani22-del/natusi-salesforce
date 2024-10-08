@extends('components.app')

@section('css')
@endsection

@section('content')
    <div class="row gy-4">
        <h4 class="fw-bold mb-2 py-3">
            <span class="text-muted fw-light">Data Master /</span> {{ $data['title'] }}
        </h4>
        <div class="main-page card p-3">
            <div class="card-datatable table-responsive pt-0 text-nowrap p-3">
                <div class="col-lg-3 col-sm-6 col-12 mb-4">
                    <div class="demo-inline-spacing">
                        <div class="btn-group">
                            <button type="button" onclick="addPerusahaan()" class="btn btn-sm btn-primary"><i
                                    class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru</button>
                            {{-- <button type="button" onclick="detailProduk()" class="btn btn-warning"><i class="mdi mdi-plus-box-multiple-outline me-1"></i> Detail Custommer</button> --}}
                        </div>
                    </div>
                </div>
                <table id="datagrid" class="table-bordered table" style="width: 100%">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Nomor Telepon Perusahaan</th>
                            <th>Alamat Perusahaan</th>
                            <th>Jenis Perusahaan</th>
                            <th>Nama Pic</th>
                            <th>Nomor Hp Pic</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="add-perusahaan-page"></div>
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
                ajax: "{{ route('data-perusahaan') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_perusahaan',
                        name: 'nama_perusahaan',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'nomor_telepon_perusahaan',
                        name: 'nomor_telepon_perusahaan',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'alamat_perusahaan',
                        name: 'alamat_perusahaan',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'jenis_perusahaan',
                        name: 'jenis_perusahaan',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'nama_pic',
                        name: 'nama_pic',
                        render: function(data, type, row) {
                            return '<p style="color:black">' + data + '</p>';
                        }
                    },
                    {
                        data: 'nomor_hp_pic',
                        name: 'nomor_hp_pic',
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
        function addPerusahaan() {
            $('.main-page').hide();
            $.post("{!! route('form-add-perusahaan') !!}").done(function(data) {
            console.log(data)
            if (data.status == 'success') {
                // $('.add-produk-page').html('');
                $('.add-perusahaan-page').html(data.content).fadeIn();
                // $('#addProduk').modal('show'); // Show the modal
                loadCSS('{{asset('assets/vendor/libs/select2/select2.css')}}');
                loadCSS('{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}');
                loadCSS('{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}');

                // Pastikan JS yang dibutuhkan dimuat ulang dan diinisialisasi
                loadScript('{{asset('assets/vendor/libs/select2/select2.js')}}', function() {
                    $('.select2').select2();
                });

                loadScript('{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}');
                loadScript('{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}', function() {
                    $('.datepicker').flatpickr();
                });
            
            } else {
                $('.main-page').show();
            }
            });
        }

        function editForm(id){
            $('.main-page').hide();
            $.post("{!!  route('form-add-perusahaan') !!}",{id:id}).done((data)=>{
            console.log(data)
            if(data.status == 'success'){
                $('.add-perusahaan-page').html(data.content).fadeIn();
                loadCSS('{{asset('assets/vendor/libs/select2/select2.css')}}');
                loadCSS('{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}');
                loadCSS('{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}');

                // Pastikan JS yang dibutuhkan dimuat ulang dan diinisialisasi
                loadScript('{{asset('assets/vendor/libs/select2/select2.js')}}', function() {
                    $('.select2').select2();
                });

                loadScript('{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}');
                loadScript('{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}', function() {
                    $('.datepicker').flatpickr();
                });
            } else {
                $('.main-page').show();
            }

            })
        }
 
    //   function detailProduk(id) {
    //     $('.main-page').hide();
    //     $.post("{!!  route('form-detail-produk') !!}",{id:id}).done((data)=>{
    //       console.log(data)
    //       if(data.status == 'success'){
    //         $('.add-produk-page').html(data.content).fadeIn();
    //         loadCSS('{{asset('assets/vendor/libs/select2/select2.css')}}');
    //         loadCSS('{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}');
    //         loadCSS('{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}');

    //         // Pastikan JS yang dibutuhkan dimuat ulang dan diinisialisasi
    //         loadScript('{{asset('assets/vendor/libs/select2/select2.js')}}', function() {
    //             $('.select2').select2();
    //         });

    //         loadScript('{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}');
    //         loadScript('{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}', function() {
    //             $('.datepicker').flatpickr();
    //         });
    //       } else {
    //         $('.main-page').show();
    //       }

    //     })
    //   }
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
              $.post("{!! route('destroy-perusahaan') !!}",{id:id}).done(function(data){
                console.log(data)
                toastr.success(data.success);

                $('.preloader').show();
                $('#datagrid').DataTable().ajax.reload();
                }).fail(function() {
                  toastr.error(data);

                });
              }else if (result.dismiss === Swal.DismissReason.cancel) {
                toastr.warning(result.dismiss);
                $('.preloader').show();
                $('#datagrid').DataTable().ajax.reload();
              }
            });
        }; 
    </script>
@endsection
