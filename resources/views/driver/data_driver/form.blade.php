<div class="modal fade" id="addDriver" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content p-md-5 p-3">
            <div class="modal-body p-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-4 text-center">
                    <h3 class="address-title mb-2 pb-1">Tambah / Edit Driver</h3>
                    <p class="address-subtitle">Isi dengan lengkap form berikut ini</p>
                </div>
                <form class="row g-4 form-save" onsubmit="return false">
                    <input type="hidden" value="{{ $data ? $data->id_master_driver : null }}" name="id">
                    <input type="hidden" value="{{ $data ? $data->users->id : null }}" name="user_id">
                    <div class="col-9">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="nama_lengkap" name="nama_lengkap"
                                value="{{ $data ? $data->nama_lengkap : null }}" class="form-control"
                                placeholder="Nama Lengkap" />
                            <label for="nama_lengkap">Nama Lengkap *</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="kode_driver" name="kode_driver"
                                value="{{ $data ? $data->kode_driver : null }}" class="form-control"
                                placeholder="Kode Driver" />
                            <label for="kode_driver">Kode Driver *</label>
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
                            </select>
                            <label for="gudang_id">Gudang *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="no_telp" name="no_telp"
                                value="{{ $data ? $data->no_telp : null }}" class="form-control"
                                placeholder="No Telepon" />
                            <label for="no_telp">No Telepon *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="email" id="email" name="email"
                                value="{{ $data ? $data->users->email : null }}" class="form-control"
                                placeholder="Alamat Email" />
                            <label for="email">Email *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="file" id="foto" name="foto" class="form-control" />
                            <label for="foto">Foto Diri *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="username" name="name"
                                value="{{ $data ? $data->users->name : null }}" class="form-control"
                                placeholder="Username" />
                            <label for="username">Username *</label>
                        </div>
                    </div>
                    <div class="col-6 form-password-toggle mb-3">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                <label for="password">Password *</label>
                            </div>
                            <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close"><i class="mdi mdi-keyboard-return me-1"></i>Cancel</button>
                        <button type="button" class="btn btn-success me-sm-3 btn-submit me-1"><i
                                class="mdi mdi-check-all me-1"></i>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
<script src="{{ asset('assets/js/ui-toasts.js') }}"></script>
<script>
    $('.btn-submit').click(function(e) {
        e.preventDefault();

        var data = new FormData($('.form-save')[0]);

        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        $.ajax({
                url: "{{ route('store-driver') }}",
                type: 'POST',
                data: data,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    console.log("Sending request...");
                }
            })
            .done(function(response) {
                if (response.status === 'success') {
                    $('#addDriver').modal('hide');
                    $('#datagrid').DataTable().ajax.reload();
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                    console.log(response.errMsg);

                }
            })
            .fail(function(xhr, status, error) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        var input = $('[name="' + key + '"]');
                        input.addClass('is-invalid');
                        input.after('<div class="invalid-feedback">' + value[0] + '</div>');
                    });
                } else {
                    toastr.error('Terjadi kesalahan, silakan coba lagi.');
                    console.log("Request failed: " + status + ", " + error);
                }
            });
    });
</script>
