<div class="modal fade" id="addStock" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content p-md-5 p-3">
            <div class="modal-body p-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-4 text-center">
                    <h3 class="address-title mb-2 pb-1">Tambah / Edit Stock</h3>
                    <p class="address-subtitle">Isi dengan lengkap form dibawah ini</p>
                </div>
                <form class="row g-4 form-save" onsubmit="return false">
                    <input type="hidden" value="{{ $data ? $data->id_master_stock : null }}" name="id_master_stock">
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <select id="produk_id" name="produk_id" class="select2 form-select" data-allow-clear="true">
                                <!-- Menampilkan opsi pertama sebagai placeholder atau nilai yang telah dipilih -->
                                @if ($data && $data->produks)
                                    <option value="{{ $data->produks->id_master_produk }}" selected
                                        data-nama="{{ $data->produks->nama_produk }}">
                                        {{ $data->produks->nama_produk }}
                                    </option>
                                @else
                                    <option disabled selected>Pilih Produk</option>
                                @endif

                                <!-- Menampilkan semua pilihan produk lainnya -->
                                @foreach ($produk as $item)
                                    <option value="{{ $item->id_master_produk }}" data-nama="{{ $item->nama_produk }}"
                                        {{ $data && $data->produk_id == $item->id_master_produk ? 'selected' : '' }}>
                                        {{ $item->nama_produk }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="produk_id">Produk *</label>
                        </div>
                    </div>


                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="nama_produk" name="nama_produk" class="form-control"
                                placeholder="Nama" readonly value="{{ $data ? $data->nama_produk : '' }}" />
                            <label for="nama_produk">Nama Produk *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="number" id="qty" name="qty" class="form-control" placeholder="Nama"
                                value="{{ $data ? $data->qty : '' }}" />
                            <label for="qty">Quantity *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="deskripsi" name="deskripsi" class="form-control"
                                placeholder="Nama" value="{{ $data ? $data->deskripsi : '' }}" />
                            <label for="deskripsi">Deskripsi </label>
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
    $(document).ready(function() {
        // Ketika pilihan produk berubah
        $('#produk_id').on('change', function() {
            var selectedNama = $(this).find('option:selected').data('nama');
            $('#nama_produk').val(selectedNama);
        });

        // Saat halaman dimuat, cek produk yang sudah dipilih
        var initialNamaProduk = $('#produk_id').find('option:selected').data('nama');
        if (initialNamaProduk) {
            $('#nama_produk').val(initialNamaProduk);
        }
    });
</script>

<script>
    $('.btn-submit').click(function(e) {
        e.preventDefault();

        var data = new FormData($('.form-save')[0]);

        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        $.ajax({
                url: "{{ route('store-stock') }}",
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
                    $('#addStock').modal('hide');
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
