@extends('components.app')

@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <h4 class="fw-bold mb-2 py-3">
                <span class="text-muted fw-light">Sales /</span> Summary
            </h4>
            <div class="card P-2 mb-3">
                <div class="card-header">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-personal"
                                role="tab" aria-selected="true">Summary</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-account" role="tab"
                                aria-selected="false">Detail Call</button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="form-tabs-personal" role="tabpanel">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="form-label w-100" for="creditCardMask">Jenis Summary</label>
                                <select id="jenis_summary" name="jenis_summary" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label w-100" for="creditCardMask">Pilih Sales</label>
                                <select id="sales" name="sales" class="select2 form-select" data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label w-100" for="creditCardMask">TOP</label>
                                <input type="date" value="{{ date('Y-m-d') }}" class="form-control">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label w-100" for="creditCardMask">Limit Kredit</label>
                                <div class="col-md-12">
                                    <input type="text" id="tanggal_limit" name="tanggal_limit"
                                        class="form-control dob-picker" placeholder="Type Here" />
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
                            <hr style="border-top: 1px dashed black;" />

                            <div>
                                <h5>Laporan Pencapaian Target Value</h5>
                            </div>
                            <table class="table-bordered table">
                                <tr>
                                    <td>CALL PLAN</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>CALL</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>EFF CALL</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>OUT ROUTE</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>COLLECTION</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>TT</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Giro</td>
                                    <td>0</td>
                                </tr>
                            </table>
                            <div class="mt-4">
                                <h5>Penjualan</h5>
                            </div>
                            <table class="table-bordered table" style="border-radius: 80%;">
                                <thead class="table-secondary">
                                    <tr>
                                        <td>No</td>
                                        <td>Nama Principle</td>
                                        <td>Nominal</td>
                                        <td>Toko</td>
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
                                <tfoot class="">
                                    <tr>
                                        <th colspan="1"></th>
                                        <th colspan="1"><strong>JUMLAH</strong></th>
                                        <th><strong>Rp. 0</strong></th>
                                        <th><strong>Rp. 0,-</strong></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="mt-4">
                                <h5>Distribusi Item Fokus</h5>
                            </div>
                            <table class="table-bordered no-right-border table"" style="border-radius: 80%;">
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
                    <div class="tab-pane fade" id="form-tabs-account" role="tabpanel">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="form-label w-100" for="creditCardMask">Jenis Summary</label>
                                <select id="jenis_summary_detail" name="jenis_summary_detail" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label w-100" for="creditCardMask">Pilih Sales</label>
                                <select id="sales_detail" name="sales_detail" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label w-100" for="creditCardMask">TOP</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label w-100" for="creditCardMask">Limit Kredit</label>
                                <div class="col-md-12">
                                    <input type="text" id="formtabs-birthdate" class="form-control dob-picker"
                                        placeholder="Type Here" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mt-4"></div>
                                <button type="button" class="btn col-9 btn-primary btn-cancel">
                                    Lihat<span class="tf-icons mdi mdi-subdirectory-arrow-right me-1 ms-2"></span>
                                </button>
                            </div>
                            <div class="col-md-2">
                                <div class="mt-4"></div>
                                <button type="button" class="btn col-9 btn-primary btn-cancel">
                                    <span class="tf-icons mdi mdi-printer-outline me-1"></span>Cetak
                                </button>
                            </div>
                            <hr style="border-top: 1px dashed black;" />

                            <div>
                                <h5>Laporan Pencapaian Target Value</h5>
                            </div>
                            <table class="table-bordered table">
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
                            <table class="table-bordered table" style="border-radius: 80%;">
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
                            <table class="table-bordered no-right-border table"" style="border-radius: 80%;">
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
                    <!-- Personal Info -->
                    {{-- <div class="tab-pane fade active show" id="form-tabs-personal" role="tabpanel">
            <form>
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="row">
                    <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-first-name">First Name</label>
                    <div class="col-sm-9">
                      <input type="text" id="formtabs-first-name" class="form-control" placeholder="John" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-last-name">Last Name</label>
                    <div class="col-sm-9">
                      <input type="text" id="formtabs-last-name" class="form-control" placeholder="Doe" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-country">Country</label>
                    <div class="col-sm-9">
                      <select id="formtabs-country" class="select2 form-select" data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="Australia">Australia</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Canada">Canada</option>
                        <option value="China">China</option>
                        <option value="France">France</option>
                        <option value="Germany">Germany</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Japan">Japan</option>
                        <option value="Korea">Korea, Republic of</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Russia">Russian Federation</option>
                        <option value="South Africa">South Africa</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 select2-primary">
                  <div class="row">
                    <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-language">Language</label>
                    <div class="col-sm-9">
                      <select id="formtabs-language" class="select2 form-select" multiple>
                        <option value="en" selected>English</option>
                        <option value="fr" selected>French</option>
                        <option value="de">German</option>
                        <option value="pt">Portuguese</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-birthdate">Birth Date</label>
                    <div class="col-sm-9">
                      <input type="text" id="formtabs-birthdate" class="form-control dob-picker" placeholder="YYYY-MM-DD" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-phone">Phone No</label>
                    <div class="col-sm-9">
                      <input type="text" id="formtabs-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-md-6">
                  <div class="row justify-content-end">
                    <div class="col-sm-9">
                      <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                      <button type="reset" class="btn btn-label-secondary">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div> --}}
                    <!-- Account Details -->
                    {{-- <div class="tab-pane fade" id="form-tabs-account" role="tabpanel">
            <form>
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="row">
                    <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username">Username</label>
                    <div class="col-sm-9">
                      <input type="text" id="formtabs-username" class="form-control" placeholder="john.doe" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-email">Email</label>
                    <div class="col-sm-9">
                      <div class="input-group input-group-merge">
                        <input type="text" id="formtabs-email" class="form-control" placeholder="john.doe" aria-label="john.doe" aria-describedby="formtabs-email2" />
                        <span class="input-group-text" id="formtabs-email2">@example.com</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row form-password-toggle">
                    <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-password">Password</label>
                    <div class="col-sm-9">
                      <div class="input-group input-group-merge">
                        <input type="password" id="formtabs-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="formtabs-password2" />
                        <span class="input-group-text cursor-pointer" id="formtabs-password2"><i class="mdi mdi-eye-off-outline"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row form-password-toggle">
                    <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-confirm-password">Confirm</label>
                    <div class="col-sm-9">
                      <div class="input-group input-group-merge">
                        <input type="password" id="formtabs-confirm-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="formtabs-confirm-password2" />
                        <span class="input-group-text cursor-pointer" id="formtabs-confirm-password2"><i class="mdi mdi-eye-off-outline"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-md-6">
                  <div class="row justify-content-end">
                    <div class="col-sm-9">
                      <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                      <button type="reset" class="btn btn-label-secondary">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
