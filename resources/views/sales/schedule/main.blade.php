@extends('components.app')

@section('css')
@endsection

@section('content')
    <div class="row gy-4">
        <h4 class="fw-bold mb-2 py-3">
            <span class="text-muted fw-light">Sales /</span>  {{ $data['title'] }}
        </h4>
        <div class="main-page card p-3">
            <div class="card-datatable text-nowrap p-3">
                <div class="col-lg-3 col-sm-6 col-12 mb-4">
                    <div class="demo-inline-spacing">
                        <div class="btn-group">
                            <button type="button" onclick="addSchedule()" class="btn btn-primary"><i
                                    class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru</button>
                            <button type="button" onclick="detailSchedule()" class="btn btn-warning"><i
                                    class="mdi mdi-plus-box-multiple-outline me-1"></i> Detail Schedule</button>
                        </div>
                    </div>
                </div>
                <table  id="datagrid" class="table-bordered table" style="width: 100%">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Sales</th>
                            <th>Nama Toko</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="add-schedule-page"></div>
        <div class="detail-schedule-page"></div>
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
          ajax: "{{ route('schedule') }}",
    
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
                  data: 'sales',
                  name: 'nama_lengkap',
                  render: function(data, type, row) {
                      return '<p style="color:black">' + data.nama_lengkap + '</p>';
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
                  data: 'tanggal',
                  name: 'tanggal',
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
  
        function addSchedule() {
            $.post("{!! route('form-add-schedule') !!}").done(function(data) {
                if (data.status == 'success') {
                    // $('.add-schedule-page').html('');
                    $('.add-schedule-page').html(data.content).fadeIn();
                    $('#addSchedule').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
            });
        }
        function editForm(id) {
            $.post("{!! route('form-add-schedule') !!}", {
                id: id
            }).done(function(data) {
                console.log(data)
                if (data.status == 'success') {
                    // $('.add-schedule-page').html('');
                    $('.add-schedule-page').html(data.content).fadeIn();
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
                    $.post("{!! route('destroy-schedule-sales') !!}", {
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
    </script>
@endsection
