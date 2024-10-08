@extends('components.app')

@section('css')

@endsection

@section('content')
<div class="row gy-4">
  <h4 class="fw-bold py-3 mb-2">
    Toko Tidak Order
    {{-- <span class="text-muted fw-light">Data Master /</span>  --}}
  </h4>
  <div class="main-page card p-3">
    <div class="card-datatable text-nowrap p-3">
      <div class="col-lg-3 col-sm-6 col-12 mb-4">
          <div class="demo-inline-spacing">
            <button type="button" onclick="addProduk()" class="btn btn-sm btn-primary"><i class="mdi mdi-plus-box-multiple-outline me-1"></i> Tambah Baru</button>
            <button type="button" onclick="detailStock()" class="btn btn-sm btn-warning"><i class="mdi mdi-import me-1"></i> Import</button>
            <button type="button" onclick="detailStock()" class="btn btn-sm btn-secondary"><i class="mdi mdi-export me-1"></i> Export</button>
            <button type="button" onclick="detailProduk()" class="btn btn-sm btn-danger"><i class="mdi mdi-delete me-1"></i> Hapus Semua</button>
          </div>
        </div>
      <table class="dt-column-search table table-bordered">
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
  <div class="add-produk-page"></div>
  <div class="detail-produk-page"></div>
</div>
@endsection

@section('js')

@endsection
