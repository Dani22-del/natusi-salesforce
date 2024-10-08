@extends('components.app')

@section('css')

@endsection

@section('content')
<div class="row gy-4">
  <h4 class="fw-bold py-3 mb-2">
    <span class="text-muted fw-light">Sales /</span> Tarcking
  </h4>
  <div class="main-page card p-3">
    <div class="card-datatable text-nowrap p-3">
      <div class="row mb-4 align-items-center">
        <div class="col-10">
          <div class="form-floating form-floating-outline">
            <select id="modalAddressCountry" name="modalAddressCountry" class="select2 form-select" data-allow-clear="true">
              <option value="">Select</option>
              <option value="Australia">Australia</option>
            </select>
            <label for="modalAddressCountry">Pilih Sales</label>
          </div>
        </div>
        <div class="col-2 d-flex justify-content-center">
          <div class="demo-inline-spacing mb-3 w-full">
            <button type="button" onclick="addSales()" class="btn btn-primary btn-md">Track</button>
          </div>
        </div>
      </div>
      <hr>
      <div class="maps mb-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15823.357878075913!2d112.4492965!3d-7.4829719!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78128791ae235d%3A0xc4eea3feb0c0127f!2sCV.%20NATUSI%20Software%20dan%20Hardware!5e0!3m2!1sid!2sid!4v1723519402460!5m2!1sid!2sid" style="width: 100%;" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <table class="dt-column-search table table-bordered mt-5">
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

@endsection
