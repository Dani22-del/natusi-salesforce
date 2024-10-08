@extends('components.app')

@section('css')
@endsection

@section('content')
    <div class="row gy-4">
        <h4 class="fw-bold mb-2 py-3">
            <span class="text-muted fw-light">Data Master /</span> Produk
        </h4>
        <div class="main-page card p-3">
            <div class="card-datatable  table-responsive pt-0 text-nowrap p-3">
                <div class="col-lg-3 col-sm-6 col-12 mb-4">
                    <div class="demo-inline-spacing">
                        <button type="button" onclick="addProduk()" class="btn btn-sm btn-primary"><i
                                class="ri-add-circle-line me-1"></i> Tambah Baru</button>
                        <button type="button"  class="btn btn-sm btn-warning"><i class="ri-import-fill me-1"></i> Import</button>
                        <button type="button"  class="btn btn-sm btn-secondary"><i class="ri-export-fill me-1"></i> Export</button>
                    </div>
                </div>
                <table class="table-bordered table " style="width:100%;" id="datagrid">
                    <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Principle</th>
                          <th>Kode</th>
                          <th>Nama Produk</th>
                          <th>Harga Pokok Penjualan</th>
                          <th>Harga Tempo</th>
                          <th>Gudang</th>
                          <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="add-produk-page"></div>
        <div class="detail-produk-page"></div>
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
          ajax: "{{ route('data-produk') }}",

          columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
          {
            data: 'principle',
            name: 'nama_principal',
            render: function(data, type, row) {
              return '<p style="color:black">' + data.nama_principal + '</p>';
            }
          },
          {
            data: 'kode_produk',
            name: 'kode_produk',
            render: function(data, type, row) {
              return '<p style="color:black">' + data + '</p>';
            }
          },
          {
            data: 'nama_produk',
            name: 'nama_produk',
            render: function(data, type, row) {
              return '<p style="color:black">' + data + '</p>';
            }
          },
          {
            data: 'harga_pokok_penjualan',
            name: 'harga_pokok_penjualan',
            render: function(data, type, row) {
              return '<p style="color:black">' + data + '</p>';
            }
          },
          {
            data: 'harga_tempo',
            name: 'harga_tempo',
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

  function addProduk() {
    $('.main-page').hide();
    $.post("{!! route('form-add-produk') !!}").done(function(data) {
      console.log(data)
      if (data.status == 'success') {
        // $('.add-produk-page').html('');
        $('.add-produk-page').html(data.content).fadeIn();
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
    $.post("{!!  route('form-add-produk') !!}",{id:id}).done((data)=>{
      console.log(data)
      if(data.status == 'success'){
        $('.add-produk-page').html(data.content).fadeIn();
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
 
      function detailProduk(id) {
        $('.main-page').hide();
        $.post("{!!  route('form-detail-produk') !!}",{id:id}).done((data)=>{
          console.log(data)
          if(data.status == 'success'){
            $('.add-produk-page').html(data.content).fadeIn();
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
              $.post("{!! route('destroy-produk') !!}",{id:id}).done(function(data){
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
