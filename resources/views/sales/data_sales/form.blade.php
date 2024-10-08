<div class="card p-3" id="addSales" tabindex="-1" aria-hidden="true">
    <div class="card-header align-items-center justify-content-center mb-4 flex text-center">
        <h5 class="mb-0">Tambah Data Sales</h5>
        <span class="text-muted">Isi denngan lengkap form berikut ini!</span>
    </div>
    <div class="card-body">
        <form class="form-save">
            <input type="hidden" value="{{ $data ? $data->id_master_sales : null }}" name="id">
            <div class="row">
                <div class="col-12 col-md-8 mb-3">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="nama_lengkap"
                            value="{{ $data ? $data->nama_lengkap : null }}"name="nama_lengkap" class="form-control"
                            placeholder="Jhon Doe" />
                        <label for="nama_lengkap">Nama Lengkap</label>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="kode_sales"
                            value="{{ $data ? $data->kode_sales : null }}"name="kode_sales" class="form-control"
                            placeholder="08273" />
                        <label for="kode_sales">Kode Sales</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating form-floating-outline">
                        <select id="gudang_id" name="gudang_id" class="select2 form-select" data-allow-clear="true">
                            <option value="{{ $data ? $data->gudang->id_master_gudang : null }}">
                                {{ $data ? $data->gudang->nama_gudang : 'Select' }}</option>
                            @foreach ($gudang as $item)
                                <option value="{{ $item->id_master_gudang }}">{{ $item->nama_gudang }}</option>
                            @endforeach
                            {{-- <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option> --}}
                        </select>
                        <label for="gudang">Gudang</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="no_telp" name="no_telp" value="{{ $data ? $data->no_telp : null }}"
                            class="form-control" placeholder="+62 812" />
                        <label for="no_ponsel">No Ponsel</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="email" name="email"
                            value="{{ $data ? $data->users->email : null }}" class="form-control"
                            placeholder="+62 812" />
                        <label for="email">Alamat Email</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating form-floating-outline">
                        <input type="file" id="file_foto" name="file_foto" class="form-control"
                            value="{{ $data ? $data->foto : null }}" placeholder="+62 812" />
                        <label for="file_foto">Foto Diri</label>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="username" value="{{ $data ? $data->users->name : null }}"
                            name="username" class="form-control" placeholder="jhondoe@gmail.com" />
                        <label for="modalAddressLandmark">Username</label>
                    </div>
                </div>
                <div class="col-6 form-password-toggle mb-3">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <label for="password">Password</label>
                        </div>
                        <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating form-floating-outline">
                        <select id="principle_id" name="principle_id[]" multiple="multiple" class="select2 form-select"
                            data-allow-clear="true">
                            @foreach ($principle as $item)
                                <option value="{{ $item->id_master_principal }}"
                                    @if (!empty($data)) @foreach ($data->principal_sales as $key)
                  @if ($key->principle_id == $item->id_master_principal) selected @endif
                                    @endforeach
                            @endif >{{ $item->nama_principal }}</option>
                            @endforeach
                        </select>
                        <label for="modalAddressCountry">Principle</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <small class="text-light fw-semibold d-block">Status</small>

                    <div class="form-check form-check-inline mt-2">
                        <input class="form-check-input" type="radio"
                            @if ($data ? $data->status == 'Aktif' : null) @checked(true) @endif name="status"
                            id="inlineRadio1" value="Aktif" />
                        <label class="form-check-label" for="inlineRadio1">Aktif</label>
                    </div>


                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                            @if ($data ? $data->status == 'Non-Aktif' : null) @checked(true) @endif name="status"
                            id="inlineRadio2" value="Non-Aktif" />
                        <label class="form-check-label" for="inlineRadio2">Non-Aktif</label>
                    </div>

                </div>
            </div>
        </form>
        <div class="col-12 text-end">
            <button type="reset" class="btn btn-outline-secondary btn-cancel"><i
                    class="mdi mdi-keyboard-return me-1"></i> Cancel</button>
            <button type="button" class="btn btn-primary me-sm-3 btn-submit me-1"><i
                    class="mdi mdi-check-all me-1"></i>Submit</button>
        </div>
        {{-- <div class="col-lg-3 col-sm-6 col-12 mb-4">
        <div class="demo-inline-spacing">
          <div class="btn-group">
            <button type="button" class="btn btn-primary btn-cancel">
              <span class="tf-icons mdi mdi-keyboard-return me-1"></span>Kembali
            </button>
          </div>
        </div>
      </div> --}}
    </div>
</div>

<script>
    $('.btn-cancel').click(function(e) {
        e.preventDefault();
        $('.data-sales-page').fadeOut(function() {
            $('.data-sales-page').empty();
            $('.main-page').fadeIn();
            // $('#datagrid').DataTable().ajax.reload();
        });
    });
    $('.btn-submit').click((e) => {
        e.preventDefault()
        let obj = new FormData($('.form-save')[0])
        $.ajax({
            url: "{{ route('store-sales') }}",
            type: 'POST',
            data: obj,
            async: true,
            cache: false,
            contentType: false,
            processData: false
        }).done((data) => {
            console.log(data)
            $('.form-save').validate(data, 'has-error')
            if (data.status == 'success') {
                toastr.success(data.message);
                $('#addSales').hide(); // Show the modal
                $('.main-page').show();
                $('#datagrid').DataTable().ajax.reload();
            }
        })
    })
</script>
