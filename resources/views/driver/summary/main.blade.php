@extends('components.app')

@section('css')

@endsection

@section('content')
<div class="row">
  <div class="col">
    <h4 class="fw-bold py-3 mb-2">
      <span class="text-muted fw-light">Driver /</span> Summary
    </h4>
    <div class="card mb-3 P-2">
      <div class="card-header">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-personal" role="tab" aria-selected="true">Summary</button>
          </li>
          <li class="nav-item">
            <button class="nav-link " data-bs-toggle="tab" data-bs-target="#form-tabs-account" role="tab" aria-selected="false">Detail Call</button>
          </li>
        </ul>
      </div>

      <div class="tab-content">
        {{-- TAB 1 --}}
        <div class="tab-pane fade active show" id="form-tabs-personal" role="tabpanel">
          <div class="row">
            <div class="col-md-2">
              <label class="form-label w-100" for="creditCardMask">Jenis Summary</label>
              <select id="formtabs-country" class="select2 form-select" data-allow-clear="true">
                <option value="">Select</option>
                <option value="Australia">Australia</option>
              </select>
            </div>
            <div class="col-md-2 ">
              <label class="form-label w-100" for="creditCardMask">Pilih Driver</label>
              <select id="formtabs-country" class="select2 form-select" data-allow-clear="true">
                <option value="">Select</option>
                <option value="Australia">Australia</option>
              </select>
            </div>
            <div class="col-md-4 ">
              <label class="form-label w-100" for="creditCardMask">Rentang Tanggal</label>
              <div class="form-floating form-floating-outline">
                <input type="text" id="bs-rangepicker-basic" class="form-control" />
                <label for="bs-rangepicker-basic">Basic</label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="mt-4"></div>
              <button type="button" class="btn col-9 btn-primary btn-cancel">
                <span class="tf-icons mdi mdi-subdirectory-arrow-right me-1"></span>Lihat
              </button>
            </div>
            <div class="col-md-2">
              <div class="mt-4"></div>
              <button type="button" class="btn col-9 btn-primary btn-cancel">
                <span class="tf-icons mdi mdi-printer-outline me-1"></span>Cetak
              </button>
            </div>
            <hr class="mt-4" style="border-top: 1px dashed black;"/>

            <div>
              <h5>Laporan Pencapaian Target Value</h5>
            </div>
            <table class="table table-bordered">
              <tr>
                <td>CALL PLAN</td>
                <td>0</td>
              </tr>
              <tr>
                <td>CALL</td>
                <td>0</td>
              </tr>
              <tr>
                <td>JUMLAH FAKTUR</td>
                <td>0</td>
              </tr>
              <tr>
                <td>CANCEL</td>
                <td>0</td>
              </tr>
              <tr>
                <td>COLLECTION</td>
                <td>0</td>
              </tr>
              <tr>
                <td>JUMLAH FAKTUR CASH</td>
                <td>0</td>
              </tr>
              <tr>
                <td>JUMLAH FAKTUR KREDIT</td>
                <td>0</td>
              </tr>
              <tr>
                <td>FAKTUR TERKIRIM</td>
                <td>0</td>
              </tr>
              <tr>
                <td>PEMBAYARAN FAKTUR</td>
                <td>0</td>
              </tr>
            </table>
            <div class="mt-4">
              <h5>Penjualan</h5>
            </div>
            <table class="table table-bordered" style="border-radius: 80%;">
              <thead class="table-secondary">
                <tr>
                  <td>No</td>
                  <td>Nama Sales</td>
                  <td>Jumlah Faktur</td>
                  <td>Faktur Terkirim</td>
                  <td>Faktur Batal</td>
                  <td>Nominal Faktur</td>
                  <td>Nominal Faktur Terkirim</td>
                  <td>Nominal Batalan</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Airi Satou</td>
                  <td>Rp. 0,-</td>
                  <td>Rp. 0,-</td>
                  <td>Rp. 0,-</td>
                  <td>Rp. 0,-</td>
                  <td>Rp. 0,-</td>
                  <td>Madura</td>
                </tr>
              </tbody>
              <tfoot class="">
                <tr>
                  <th colspan="1"></th>
                  <th colspan="5"><strong>JUMLAH</strong></th>
                  <th><strong>Rp. 0</strong></th>
                  <th><strong>Rp. 0,-</strong></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        {{-- TAB KE 2 --}}
        <div class="tab-pane fade" id="form-tabs-account" role="tabpanel">
          <div class="row">
            <div class="col-md-2">
              <label class="form-label w-100" for="creditCardMask">Jenis Summary</label>
              <select id="formtabs-country" class="select2 form-select" data-allow-clear="true">
                <option value="">Select</option>
                <option value="Australia">Australia</option>
              </select>
            </div>
            <div class="col-md-2 ">
              <label class="form-label w-100" for="creditCardMask">Pilih Driver</label>
              <select id="formtabs-country" class="select2 form-select" data-allow-clear="true">
                <option value="">Select</option>
                <option value="Australia">Australia</option>
              </select>
            </div>
            <div class="col-md-4 ">
              <label class="form-label w-100" for="creditCardMask">Rentang Tanggal</label>
              <div class="form-floating form-floating-outline">
                <input type="text" id="bs-rangepicker-basic" class="form-control" />
                <label for="bs-rangepicker-basic">Basic</label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="mt-4"></div>
              <button type="button" class="btn col-9 btn-primary btn-cancel">
                <span class="tf-icons mdi mdi-subdirectory-arrow-right me-1"></span>Lihat
              </button>
            </div>
            <div class="col-md-2">
              <div class="mt-4"></div>
              <button type="button" class="btn col-9 btn-primary btn-cancel">
                <span class="tf-icons mdi mdi-printer-outline me-1"></span>Cetak
              </button>
            </div>
            <hr class="mt-4" style="border-top: 1px dashed black;"/>

            <div>
              <h5>Laporan Pencapaian Target Value</h5>
            </div>
            <table class="table table-bordered">
              <tr>
                <td>CALL</td>
                <td>0</td>
              </tr>
              <tr>
                <td>CALL PLAN</td>
                <td>0</td>
              </tr>
              <tr>
                <td>COLLECTION</td>
                <td>0</td>
              </tr>
              <tr>
                <td>JUMLAH FAKTUR</td>
                <td>0</td>
              </tr>
              <tr>
                <td>CANCEL</td>
                <td>0</td>
              </tr>
            </table>
            <div class="mt-4">
              <h5>Penjualan</h5>
            </div>
            <table class="table table-bordered" style="border-radius: 80%;">
              <thead class="table-secondary">
                <tr>
                  <td>No</td>
                  <td>Nama Sales</td>
                  <td>Tanggal</td>
                  <td>No Invoice</td>
                  <td>Toko</td>
                  <td>Status</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Airi Satou</td>
                  <td>Rp. 0,-</td>
                  <td>Madura</td>
                  <td>Madura</td>
                  <td>Madura</td>
                </tr>
              </tbody>
              <tfoot class="">
                <tr>
                  <th colspan="1"></th>
                  <th colspan="3"><strong>JUMLAH</strong></th>
                  <th><strong>Rp. 0</strong></th>
                  <th><strong>Rp. 0,-</strong></th>
                </tr>
              </tfoot>
            </table>
            <div class="mt-4">
              <h5>Distribusi Item Fokus</h5>
            </div>
            <table class="table table-bordered no-right-border"" style="border-radius: 80%;">
              <thead class="table-secondary">
                <tr>
                  <td>No</td>
                  <td>Nama Item</td>
                  <td>Value</td>
                  <td>Jml.Distribusi</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Airi Satou</td>
                  <td>Rp. 0,-</td>
                  <td>Madura</td>
                </tr>
              </tbody>
              <tfoot class="table-primary">
                <tr>
                  <th colspan="1"></th>
                  <th colspan="1"><strong>JUMLAH</strong></th>
                  <th><strong>Rp. 0</strong></th>
                  <th><strong>Rp. 0,-</strong></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')

@endsection
