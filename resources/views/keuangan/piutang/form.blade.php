<div class="card p-3" id="addSales" tabindex="-1" aria-hidden="true">
    <div class="card-header align-items-center justify-content-center mb-4 flex text-center">
        <h5 class="mb-0">Tambah Data Piutang</h5>
        <span class="text-muted">Isi denngan lengkap form berikut ini!</span>
    </div>
    <div class="card-body">
        <form class="row g-4 form-save" onsubmit="return false">
            <input type="hidden" value="{{ $data ? $data->id_master_sales : null }}" name="id">
            <div class="row">
                <div class="col-6">
                    <div class="form-floating form-floating-outline">
                        <select id="customer_id" name="customer_id" class="select2 form-select" data-allow-clear="true">
                            @if ($data && $data->customer)
                                <option value="{{ $data->customer->id }}" selected
                                    data-nama="{{ $data->customer->nama_toko }}">
                                    {{ $data->customer->nama_toko }}
                                </option>
                            @else
                                <option disabled selected>Pilih Customer</option>
                            @endif
                            @foreach ($customer as $item)
                                <option data-nama="{{ $item->kode_customer }} - {{ $item->nama_toko }}"
                                    value="{{ $item->id }}">
                                    {{ $item->kode_customer }} - {{ $item->nama_toko }}</option>
                            @endforeach
                        </select>
                        <label for="customer_id">Pilih Customer</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="no_invoice" name="no_invoice" class="form-control" />
                        <label for="no_invoice">No Invoice</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="kode_customer" name="kode_customer" class="form-control" readonly />
                        <label for="kode_customer">Kode Customer</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating form-floating-outline">
                        <input type="date" id="tgl_invoice" name="tgl_invoice" class="form-control" />
                        <label for="tgl_invoice">Tanggal Invoice</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating form-floating-outline">
                        <select id="sales_id" name="sales_id" class="select2 form-select" data-allow-clear="true">
                            @if ($data && $data->sales)
                                <option value="{{ $data->sales->id_master_sales }}" selected
                                    data-nama="{{ $data->sales->nama_lengkap }}">
                                    {{ $data->sales->nama_lengkap }}
                                </option>
                            @else
                                <option disabled selected>Pilih Sales</option>
                            @endif
                            @foreach ($sales as $item)
                                <option data-nama="{{ $item->kode_sales }} - {{ $item->nama_lengkap }}"
                                    value="{{ $item->id_master_sales }}">
                                    {{ $item->kode_sales }} - {{ $item->nama_lengkap }}</option>
                            @endforeach
                        </select>
                        <label for="sales_id">Pilih Sales</label>
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="number" id="nominal_invoice" class="form-control" name="nominal_invoice"
                                min="0" />
                            <label for="nominal_invoice">Nominal Invoice</label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="kode_sales" name="kode_sales" class="form-control" readonly />
                        <label for="kode_sales">Kode Sales</label>
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="number" id="total_bayar" class="form-control" name="total_bayar"
                                min="0" />
                            <label for="total_bayar">Total Bayar</label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                </div>
                <div class="col-6 mb-3">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="sisa_piutang" class="form-control" name="sisa_piutang" readonly />
                            <label for="sisa_piutang">Sisa Piutang</label>
                        </div>
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
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#customer_id').on('change', function() {
            var nama = $(this).find('option:selected').data('nama');
            var selectedNama = nama.split(' - ')[0];
            $('#kode_customer').val(selectedNama);
        });

        $('#sales_id').on('change', function() {
            var sales = $(this).find('option:selected').data('nama');
            var selectedSales = sales.split(' - ')[0];
            $('#kode_sales').val(selectedSales);
        });

        var initialNamaProduk = $('#customer_id').find('option:selected').data('nama');
        if (initialNamaProduk) {
            $('#kode_customer').val(initialNamaProduk);
        }

        var initialNamaSales = $('#sales_id').find('option:selected').data('nama');
        if (initialNamaSales) {
            $('#kode_sales').val(initialNamaSales);
        }
    });
</script>

<script>
    $(document).ready(function() {
        function calculateSisaPiutang() {
            var nominalInvoice = parseFloat($('#nominal_invoice').val()) || 0;
            var totalBayar = parseFloat($('#total_bayar').val()) || 0;
            var sisaPiutang = nominalInvoice - totalBayar;
            $('#sisa_piutang').val(sisaPiutang);
        }

        $('#nominal_invoice, #total_bayar').on('input', function() {
            calculateSisaPiutang();
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
                url: "{{ route('store-piutang') }}",
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
                    $('#addSales').modal('hide');
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
