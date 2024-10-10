<div class="card p-3" id="addSalesOrder">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Sales Order</h5>
    </div>
    <div class="card-body">
        <form class="form-save">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label w-100" for="creditCardMask">Custommer</label>
                    <select id="customer_id" name="customer_id" class="select2 form-select" data-allow-clear="true">
                        <option value="{{ $data ? $data->customers->id : null }}">
                            {{ $data ? $data->customers->nama_toko : 'Select' }}</option>
                        @foreach ($customers as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_toko }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label w-100" for="tgl_invoice">Tanggal Invoice</label>
                    <div class="col-md-12">
                        <input type="date" id="tgl_invoice" name="tanggal_invoice" class="form-control dob-picker"
                            placeholder="DD-MM-YYYY" />
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label w-100" for="creditCardMask">TOP</label>
                    <select id="top" name="top" class="select2 form-select" data-allow-clear="true">
                        <option value="" selected disabled>Select</option>
                        <option value="Cash">Cash</option>
                        <option value="Kredit 7 Hari">Kredit 7 Hari</option>
                        <option value="Kredit 12 Hari">Kredit 12 Hari</option>
                        <option value="Kredit 30 Hari">Kredit 30 Hari</option>

                    </select>
                </div>
                <div id="limit-kredit-div" class="col-md-2 mb-3" style="display: none;">
                    <label class="form-label w-100" for="creditCardMask">Limit Kredit</label>
                    <div class="col-md-12">
                        <input type="number" id="formtabs-birthdate" class="form-control dob-picker"
                            placeholder="Type Here" />
                    </div>
                </div>
                <hr>
                <h5><b>Produk</b></h5>
                <div class="col-md-6">
                    <label class="form-label w-100" for="creditCardMask">Produk</label>
                    <select id="produk_id" name="produk_id" class="select2 form-select" data-allow-clear="true">
                        <option value="{{ $data ? $data->produk->id_master_produk : null }}"
                            data-harga-retail="{{ $data ? $data->produk->harga_pokok_penjualan : 0 }}"
                            data-kode-produk="{{ $data ? $data->produk->kode_produk : '' }}">
                            {{ $data ? $data->produk->nama_produk : 'Select' }}</option>
                        @foreach ($produk as $item)
                            <option value="{{ $item->id_master_produk }}"
                                data-harga-retail="{{ $item->harga_pokok_penjualan }}"
                                data-kode-produk="{{ $item->kode_produk }}">{{ $item->nama_produk }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label w-100" for="creditCardMask">Satuan</label>
                    <select id="satuan" name="satuan" class="select2 form-select" data-allow-clear="true">
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label w-100" for="harga_retail">Harga Retail</label>
                    <div class="col-md-12">
                        <input type="number" id="harga_retail" class="form-control" placeholder="Rp. 0,-" readonly />
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label w-100" for="qty">Jumlah Pembelian</label>
                    <div class="col-md-12">
                        <input type="number" id="qty" class="form-control dob-picker" placeholder="Rp. 0,-" />
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label w-100" for="discount">Discount (%)</label>
                    <div class="col-md-12">
                        <input type="number" id="discount" class="form-control dob-picker" placeholder="Rp. 0,-" />
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label w-100" for="creditCardMask">Keterangan Discount</label>
                    <div class="col-md-12">
                        <input type="text" id="formtabs-birthdate" class="form-control dob-picker" />
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <div class="mt-4"></div>
                    <button type="button" class="btn col-12 btn-primary tambah">
                        <span class="tf-icons mdi mdi-plus-box-outline me-1"></span>Tambahkan
                    </button>
                </div>
                <hr>
                <div class="col-md-12 table-responsive text-nowrap">
                    <table class="table-bordered table">
                        <thead class="table-secondary">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Produk</th>
                                <th>QTY</th>
                                <th>Satuan</th>
                                <th>Harga Satuan</th>
                                <th>Disc (%)</th>
                                <th>Sub Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot class="table-primary">
                            <tr>
                                <th colspan="2"></th>
                                <th colspan="5"><strong>Total Harga Sales Order</strong></th>
                                <th colspan="2"><strong id="total-harga">Rp. 0</strong></th>
                            </tr>
                        </tfoot>
                        <tbody id="cart-items">

                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <div class="col-lg-3 col-sm-6 col-12 mb-4">
            <div class="demo-inline-spacing">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-cancel">
                        <span class="tf-icons mdi mdi-keyboard-return me-1"></span>Kembali
                    </button>
                </div>
                <div class="btn-group">
                    <button id="submit-cart" type="button" class="btn btn-success me-sm-3 btn-submit me-1"><i
                            class="mdi mdi-check-all me-1"></i>Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.btn-cancel').click(function(e) {
        e.preventDefault();
        $('.add-sales-page').fadeOut(function() {
            $('.add-sales-page').empty();
            $('.main-page').fadeIn();
            // $('#datagrid').DataTable().ajax.reload();
        });
    });
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>

<script>
    $('#top').on('change', function() {
        var selectedTop = $(this).val();
        if (selectedTop && selectedTop.includes('Kredit')) {
            $('#limit-kredit-div').show();
        } else {
            $('#limit-kredit-div').hide();
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#produk_id').change(function() {
            var satuanSelect = $('#satuan');

            satuanSelect.empty();

            satuanSelect.append('<option value="pieces">Pieces</option>');

            satuanSelect.val('pieces');
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#produk_id').change(function() {
            var selectedOption = $(this).find(':selected');
            var hargaRetail = selectedOption.data('harga-retail');

            $('#harga_retail').val(hargaRetail);
        });
    });
</script>

<script>
    $(document).ready(function() {
        let cart = [];
        let counter = 1;


        function calculateSubtotal(harga, qty, disc) {
            let discountAmount = (harga * qty * disc) / 100;
            return (harga * qty) - discountAmount;
        }

        function calculateTotal() {
            let total = 0;
            cart.forEach(item => {
                total += item.subtotal;
            });
            $('#total-harga').text(`Rp. ${total.toLocaleString()}`);
        }


        $('.tambah').on('click', function() {

            console.log('Tombol sudah ditekan');


            let customerId = $('#customer_id').val();
            let produkId = $('#produk_id').val();
            let kodeProduk = $('#produk_id option:selected').data('kode-produk');
            let tanggalInvoice = $('#tgl_invoice').val();
            let top = $('#top').val();
            let limitKredit = $('#limit-kredit-div input').val();
            let produkNama = $('#produk_id option:selected').text();
            let qty = parseInt($('#qty').val());
            let satuan = $('#satuan').val();
            let hargaRetail = parseFloat($('#harga_retail').val());
            let discount = parseFloat($('#discount').val());
            let keteranganDiscount = null;

            if (!produkId || qty <= 0 || !satuan || !hargaRetail || !top || (top.includes('Kredit') && !
                    limitKredit) || !customerId || !tanggalInvoice || !discount) {
                alert('Silakan lengkapi semua data produk sebelum menambahkan produk.');
                return;
            }

            let subtotal = calculateSubtotal(hargaRetail, qty, discount);

            cart.push({
                customer_id: customerId,
                produk_id: produkId,
                kode: kodeProduk,
                tanggal_invoice: tanggalInvoice,
                top: top,
                limit_kredit: limitKredit, // This will only apply if 'Kredit' is selected
                nama: produkNama,
                qty: qty,
                satuan: satuan,
                harga: hargaRetail,
                discount: discount,
                keterangan_discount: keteranganDiscount, // Added field
                subtotal: subtotal
            });

            let row = `<tr>
                <td>${counter}</td>
                <td>${kodeProduk}</td>
                <td>${produkNama}</td>
                <td>${qty}</td>
                <td>${satuan}</td>
                <td>Rp. ${hargaRetail.toLocaleString()}</td>
                <td>${discount}%</td>
                <td>Rp. ${subtotal.toLocaleString()}</td>
                <td><button type="button" class="btn btn-danger btn-sm remove-item" data-id="${produkId}">Hapus</button></td>
            </tr>`;
            $('#cart-items').append(row);

            counter++;

            calculateTotal();

            // Reset input setelah menambahkan item
            $('#customer_id').val('').trigger('change');
            $('#produk_id').val('').trigger('change');
            $('#tgl_invoice').val('');
            $('#top').val(null).trigger('change');
            $('#satuan').val('').trigger('change');
            $('#harga_retail').val('');
            $('#qty').val('');
            $('#discount').val('');
            $('#keterangan_discount').val('');
            $('#limit-kredit-div input').val('');

            console.log("Setelah Reset:", {
                customer_id: $('#customer_id').val(),
                produk_id: $('#produk_id').val(),
                top: $('#top').val(),
                satuan: $('#satuan').val(),
                harga_retail: $('#harga_retail').val(),
                qty: $('#qty').val(),
                discount: $('#discount').val(),
                keterangan_discount: $('#keterangan_discount').val(),
                limit_kredit: $('#limit-kredit-div input').val() // Ganti jika ada ID lain
            });
        });

        $(document).on('click', '.remove-item', function() {
            let produkId = $(this).data('id');

            cart = cart.filter(item => item.id != produkId);

            $(this).closest('tr').remove();

            counter = 1;
            $('#cart-items tr').each(function() {
                $(this).find('td:first').text(counter++);
            });

            calculateTotal();
        });

        $('#submit-cart').on('click', function() {
            let customerId = $('#customer_id').val();
            let tanggalInvoice = $('#tgl_invoice').val();
            let top = $('#top').val();
            let limitKredit = $('#limit-kredit-div input').val();

            if (cart.length === 0) {
                alert('Keranjang masih kosong. Tambahkan produk sebelum menyimpan.');
                return;
            }

            $.ajax({
                url: '{{ route('store-so') }}',
                method: 'POST',
                data: {
                    cart: cart,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        cart = [];
                        $('#cart-items').empty();
                        calculateTotal();
                        $('#addSalesOrder').hide(); // Show the modal
                        $('.main-page').show();
                        $('#datagrid').DataTable().ajax.reload();
                    } else {
                        alert('Gagal menyimpan data: ' + response.message);
                    }
                },
                error: function(xhr) {
                    console.error("Error response:", xhr.responseJSON);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errorMessage = Object.values(xhr.responseJSON.errors).flat()
                            .join('\n');
                        alert("Validation error:\n" + errorMessage);
                    } else {
                        alert("An error occurred. Please check your input.");
                    }
                }
            });
        });
    });
</script>
