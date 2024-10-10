<div class="modal fade" id="addTarget" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content p-md-5 p-3">
            <div class="modal-body p-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-4 text-center">
                    <h3 class="address-title mb-2 pb-1">Target Sales Baru</h3>
                    <p class="address-subtitle">Isi denngan lengkap form berikut ini!</p>
                </div>
                <form class="form-save" onsubmit="return false">
                    <div class="col-9">
                        <div class="form-floating form-floating-outline">
                            <select id="sales" name="sales_id" class="select2 form-select" data-allow-clear="true">
                                <option value="{{ $data ? $data->sales->id_master_sales : null }}"
                                    data-kode-sales="{{ $data ? $data->sales->kode_sales : '' }}">
                                    {{ $data ? $data->sales->nama_lengkap : 'Select' }}
                                </option>
                                @foreach ($sales as $item)
                                    <option value="{{ $item->id_master_sales }}"
                                        data-kode-sales="{{ $item->kode_sales }}">
                                        {{ $item->nama_lengkap }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="sales">Pilih Sales</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="kodeSales" name="kode_sales" class="form-control"
                                placeholder="A0031" readonly />
                            <label for="kodeSales">Kode Sales</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="month" id="bulan" name="bulan" class="form-control"
                                placeholder="Mall Road" />
                            <label for="bulan">Bulan</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="target" name="target" class="form-control"
                                placeholder="Rp. 0,-" />
                            <label for="target">Nominal</label>
                        </div>
                    </div>
                    {{-- <div class="col-12">
                        <label class="switch">
                            <input type="checkbox" class="switch-input">
                            <span class="switch-toggle-slider">
                                <span class="switch-on"></span>
                                <span class="switch-off"></span>
                            </span>
                            <span class="switch-label">Use as a billing address?</span>
                        </label>
                    </div> --}}
                    <div class="col-12 text-end">
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close"><i class="mdi mdi-keyboard-return me-1"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary me-sm-3 me-1"><i
                                class="mdi mdi-check-all me-1"></i>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#sales').on('change', function() {
            const kodeSales = $(this).find('option:selected').data('kode-sales');
            $('#kodeSales').val(kodeSales || '');
        });
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
                    $('#addTarget').modal('hide');
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
