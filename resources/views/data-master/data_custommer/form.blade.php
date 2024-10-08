<div class="modal fade" id="addCustommer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content p-md-5 p-3">
            <div class="modal-body p-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-4 text-center">
                    <h3 class="address-title mb-2 pb-1">Toko / Custommer Baru</h3>
                    <p class="address-subtitle">Isi dengan lengkap form dibawah ini</p>
                </div>
                <form class="row g-4 form-save" onsubmit="return false">
                    <input type="hidden" value="{{ $data ? $data->id : null }}" name="id">
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <div class="input-group">
                                <input type="text" id="kode_customer" class="form-control"
                                    placeholder="Kode Customer" aria-label="Kode Customer" name="kode_customer"
                                    value="{{ $data ? $data->kode_customer : null }}" readonly>
                                <button class="btn btn-primary" type="button" id="generate-btn">Generate</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalAddressAddress1" class="form-control" name="nama_toko"
                                placeholder="Nama Toko" value="{{ $data ? $data->nama_toko : null }}" />
                            <label for="modalAddressAddress1">Nama Toko</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalAddressState" name="alamat_toko" class="form-control"
                                placeholder="Alamat Toko" value="{{ $data ? $data->alamat_toko : null }}" />
                            <label for="modalAddressLandmark">Alamat Toko *</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <small class="text-light fw-semibold d-block">Alamat Pengiriman</small>
                        <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input" type="radio" name="alamat_pengiriman" id="alamatToko"
                                value="alamat_toko"
                                {{ $data && $data->alamat_pengiriman == 'alamat_toko' ? 'checked' : '' }} />
                            <label class="form-check-label" for="alamatToko">Alamat Toko</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="alamat_pengiriman" id="alamatLainnya"
                                value="alamat_lainnya"
                                {{ $data && $data->alamat_pengiriman == 'alamat_lainnya' ? 'checked' : '' }} />
                            <label class="form-check-label" for="alamatLainnya">Alamat Lainnya</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-12" id="alamatLainnyaInput" style="display: none;">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalAddressState" name="alamat_lainnya" class="form-control"
                                placeholder="Alamat Lainnya" value="{{ $data ? $data->alamat_lainnya : null }}" />
                            <label for="modalAddressState">Alamat Lainnya</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalAddressAddress1" name="nama_pemilik" class="form-control"
                                placeholder="Nama Pemilik" value="{{ $data ? $data->nama_pemilik : null }}" />
                            <label for="modalAddressAddress1">Nama Pemilik</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="number" id="modalAddressAddress1" name="no_telepon" class="form-control"
                                placeholder="08" value="{{ $data ? $data->no_telepon : null }}" />
                            <label for="modalAddressAddress1">No Telepon</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating form-floating-outline">
                            <select id="top" name="top" class="select2 form-select"
                                data-allow-clear="true">
                                <option disabled selected>Pilih</option>
                                <option value="Cash" {{ $data && $data->top == 'Cash' ? 'selected' : '' }}>Cash
                                </option>
                                <option value="Kredit 7 Hari"
                                    {{ $data && $data->top == 'Kredit 7 Hari' ? 'selected' : '' }}>Kredit 7 Hari
                                </option>
                                <option value="Kredit 12 Hari"
                                    {{ $data && $data->top == 'Kredit 12 Hari' ? 'selected' : '' }}>Kredit 12 Hari
                                </option>
                                <option value="Kredit 30 Hari"
                                    {{ $data && $data->top == 'Kredit 30 Hari' ? 'selected' : '' }}>Kredit 30 Hari
                                </option>
                            </select>
                            <label for="top">TOP</label>
                        </div>
                    </div>
                    <!-- Limit Kredit -->
                    <div class="col-4" id="limit-kredit-div" style="display: none;">
                        <div class="form-floating form-floating-outline">
                            <input type="number" id="limit-kredit" name="limit_kredit" class="form-control"
                                placeholder="Rp. 0,-" value="{{ $data ? $data->limit_kredit : null }}" />
                            <label for="limit-kredit">Limit Kredit (Rp)</label>
                        </div>
                    </div>
                    <!-- Jatuh Tempo -->
                    <div class="col-4" id="jatuh-tempo-div" style="display: none;">
                        <div class="form-floating form-floating-outline">
                            <input type="date" name="jatuh_tempo" id="jatuh-tempo" class="form-control"
                                value="{{ $data ? $data->jatuh_tempo : '' }}">
                            <label for="jatuh-tempo">Jatuh Tempo *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="file" id="modalAddressAddress1" name="foto_toko" class="form-control"
                                placeholder="Foto Toko" />
                            <label for="modalAddressAddress1">Foto Toko</label>
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

<script>
    $('#generate-btn').on('click', function() {
        const prefix = 'TKO-';
        const randomNumber = Math.floor(1000 + Math.random() * 9000);
        const kodeCustomer = `${prefix}${randomNumber}`;

        $('#kode_customer').val(kodeCustomer); // Mengisi nilai ke input
    });
</script>

<script>
    $(document).ready(function() {
        $('input[name="alamat_pengiriman"]').on('change', function() {
            if ($('#alamatLainnya').is(':checked')) {
                $('#alamatLainnyaInput').show();
            } else {
                $('#alamatLainnyaInput').hide();
            }
        });
        if ($('#alamatLainnya').is(':checked')) {
            $('#alamatLainnyaInput').show();
        } else {
            $('#alamatLainnyaInput').hide();
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#top').on('change', function() {
            var selectedTop = $(this).val();
            if (selectedTop.includes('Kredit')) {
                $('#limit-kredit-div').show();
                $('#jatuh-tempo-div').show();
            } else {
                $('#limit-kredit-div').hide();
                $('#jatuh-tempo-div').hide();
            }
        });

        // Memicu event change saat halaman dimuat
        $('#top').trigger('change');
    });
</script>

<script>
    $('.btn-submit').click(function(e) {
        e.preventDefault();

        var data = new FormData($('.form-save')[0]);

        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        
        $.ajax({
                url: "{{ route('store-custommer') }}",
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
                    $('#addCustommer').modal('hide');
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
