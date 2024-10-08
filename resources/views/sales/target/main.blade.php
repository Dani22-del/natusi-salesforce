@extends('components.app')

@section('css')
@endsection

@section('content')
    <div class="row gy-4">
        <h4 class="fw-bold mb-2 py-3">
            <span class="text-muted fw-light">Sales /</span> Target
        </h4>
        <div class="main-page card p-3">
            <div class="card-datatable text-nowrap p-3">
                <div class="col-lg-3 col-sm-6 col-12 mb-4">
                    <div class="demo-inline-spacing">
                        <div class="btn-group">
                            <button type="button" onclick="addSales()" class="btn btn-primary"><i
                                    class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru</button>
                        </div>
                    </div>
                </div>
                <table class="dt-column-search table-bordered table">
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Post</th>
                            <th>City</th>
                            <th>Date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="add-target-page"></div>
    </div>
@endsection

@section('js')
    <script>
        function addSales() {
            $.post("{!! route('form-add-data-target') !!}").done(function(data) {
                if (data.status == 'success') {
                    $('.add-target-page').html('');
                    $('.add-target-page').html(data.content).fadeIn();
                    $('#addTarget').modal('show'); // Show the modal
                } else {
                    $('.main-page').show();
                }
            });
        }

        function detailSales() {
            $.post("{!! route('form-detail-sales-order') !!}")
                .done(function(data) {
                    if (data.status == 'success') {
                        $('.detail-sales-page').html(data.content).fadeIn();
                    } else {
                        $('.main-page').show();
                    }
                });
        }
    </script>
@endsection
