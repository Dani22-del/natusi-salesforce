<div class="card p-3" id="addPerusahaan" tabindex="-1" aria-hidden="true">
    <div class="card-header align-items-center justify-content-center mb-4 flex text-center">
        <h5 class="mb-0">Tambah Data Perusahaan</h5>
        <span class="text-muted">Isi dengan lengkap form berikut ini!</span>
    </div>
    <div class="card-body">
        <form class="form-save">
            <input type="hidden" value="{{ $data ? $data->id_master_perusahaan : null }}" name="id">
            <div class="row">
                <div class="col-12 col-md-8 mb-3">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="nama_perusahaan"
                            value="{{ $data ? $data->nama_perusahaan : null }}"name="nama_perusahaan"
                            class="form-control" />
                        <label for="nama_perusahaan">Nama Perusahaan *</label>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="nomor_telepon_perusahaan"
                            value="{{ $data ? $data->nomor_telepon_perusahaan : null }}"name="nomor_telepon_perusahaan"
                            class="form-control" />
                        <label for="nomor_telepon_perusahaan">Nomor Telepon Perusahaan *</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="alamat_perusahaan"
                            value="{{ $data ? $data->alamat_perusahaan : null }}"name="alamat_perusahaan"
                            class="form-control" />
                        <label for="alamat_perusahaan">Alamat Perusahaan *</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="jenis_perusahaan" name="jenis_perusahaan"
                            value="{{ $data ? $data->jenis_perusahaan : null }}" class="form-control" />
                        <label for="jenis_perusahaan">Jenis Perusahaan *</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="nama_pic" name="nama_pic"
                            value="{{ $data ? $data->nama_pic : null }}" class="form-control" />
                        <label for="nama_pic">Nama Pic *</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating form-floating-outline">
                        <input type="number" id="nomor_hp_pic" name="nomor_hp_pic" class="form-control"
                            value="{{ $data ? $data->nomor_hp_pic : null }}" />
                        <label for="nomor_hp_pic">Nomor Hp Pic *</label>
                    </div>
                </div>
                <div class="col-6 col-md-6 mb-3">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="username" value="{{ $data ? $data->users->name : null }}"
                            name="username" class="form-control" placeholder="jhondoe@gmail.com" />
                        <label for="modalAddressLandmark">Username *</label>
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
                <div class="col-6 form-password-toggle mb-3">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <label for="password">Password *</label>
                        </div>
                        <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <small class="text-light fw-semibold d-block">Status</small>

                    <div class="form-check form-check-inline mt-2">
                        <input class="form-check-input" type="radio"
                            @if ($data ? $data->users->status == 'Aktif' : null) @checked(true) @endif name="status"
                            id="inlineRadio1" value="Aktif" />
                        <label class="form-check-label" for="inlineRadio1">Aktif</label>
                    </div>


                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                            @if ($data ? $data->users->status == 'Non-Aktif' : null) @checked(true) @endif name="status"
                            id="inlineRadio2" value="Non-Aktif" />
                        <label class="form-check-label" for="inlineRadio2">Non-Aktif</label>
                    </div>

                </div>
            </div>
        </form>
        <div class="col-12 text-end">
            <button type="reset" class="btn btn-outline-secondary btn-cancel"><i
                    class="ri-arrow-left-s-line me-1"></i> Cancel</button>
            <button type="button" class="btn btn-primary me-sm-3 btn-submit me-1"><i
                    class="ri-check-line me-1"></i>Submit</button>
        </div>
    </div>
</div>

<script>
    $('.btn-cancel').click(function(e) {
        e.preventDefault();
        $('.add-perusahaan-page').fadeOut(function() {
            $('.add-perusahaan-page').empty();
            $('.main-page').fadeIn();
            // $('#datagrid').DataTable().ajax.reload();
        });
    });
    $('.btn-submit').click((e) => {
        e.preventDefault()
        let obj = new FormData($('.form-save')[0])
        $.ajax({
                url: "{{ route('store-perusahaan') }}",
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
                    $('#addPerusahaan').hide(); // Show the modal
                    $('.main-page').show();
                    $('#datagrid').DataTable().ajax.reload();
                } 
            })
            .fail(function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    console.log(errors)
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
    })
</script>
