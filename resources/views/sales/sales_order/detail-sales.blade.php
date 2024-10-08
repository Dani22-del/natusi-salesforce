<div class="card p-3">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h6 class="mb-0"><strong>Detail Sales Order (SO)</strong></h6>
    </div>
    <div class="card-body">
        <div class="card p-4" style="background-color: #EFEFEF">
            <div class="row">
                <div class="col-md-6">
                    <table>
                        <tbody class="text-dark lh-lg">
                            <tr>
                                <td colspan="2">No.SO</td>
                                <td>:</td>
                                <td>{{ $salesOrder->kode_so }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">No. Invoice</td>
                                <td>:</td>
                                <td>{{ $salesOrder->no_invoice }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Tanggal Invoice</td>
                                <td>:</td>
                                <td>{{ $salesOrder->tanggal_invoice }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Nama Sales</td>
                                <td>:</td>
                                <td>{{ $salesOrder->sales->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Nama Toko</td>
                                <td>:</td>
                                <td>{{ $salesOrder->customer->nama_toko }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Nama Pemilik Toko</td>
                                <td>:</td>
                                <td>{{ $salesOrder->customer->nama_pemilik }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table>
                        <tbody class="text-dark lh-lg">
                            <tr>
                                <td colspan="2">Alamat Toko</td>
                                <td>:</td>
                                <td></td>
                                <td>{{ $salesOrder->customer->alamat_toko }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">TOP</td>
                                <td>:</td>
                                <td></td>
                                <td>{{ $salesOrder->top }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Limit Kredit</td>
                                <td>:</td>
                                <td></td>
                                <td>{{ $salesOrder->limit_kredit ?? ' - ' }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Status SO</td>
                                <td>:</td>
                                <td></td>
                                <td>{{ $salesOrder->status_approve }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Catatan</td>
                                <td>:</td>
                                <td></td>
                                <td>{{ $salesOrder->catatan ?? ' - ' }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Tanda Tangan</td>
                                <td>:</td>
                                <td></td>
                                <td>{{ $salesOrder->tanda_tangan ?? ' - ' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <h5><strong>Item Order</strong></h5>
        </div>
        <div class="col-md-12 g-4 mb-3 mt-3 flex">
            <button type="button" class="btn btn-primary btn-cancel">
                <span class="tf-icons mdi mdi-printer-outline me-1"></span>Cetak Invoice
            </button>
            <button type="button" class="btn btn-success btn-cancel">
                <span class="tf-icons mdi mdi-check-all me-1"></span>Terima SO
            </button>
            <button type="button" class="btn btn-danger btn-cancel">
                <span class="tf-icons mdi mdi-alpha-x-box-outline me-1"></span>Tolak SO
            </button>
        </div>
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
                        <th colspan="2"><strong>Rp. {{ number_format($totalHarga, 0, ',', '.') }}</strong></th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($salesOrder->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->produk->kode }}</td> <!-- Ganti 'kode' sesuai dengan kolom yang ada di tabel produk -->
                            <td>{{ $item->produk->nama_produk }}</td> <!-- Ganti 'nama_produk' sesuai dengan kolom yang ada di tabel produk -->
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->produk->satuan }}</td> <!-- Ganti 'satuan' sesuai dengan kolom yang ada di tabel produk -->
                            <td>Rp. {{ number_format($item->produk->harga_pokok_penjualan, 0, ',', '.') }}</td> <!-- Ganti 'harga_pokok_penjualan' sesuai dengan kolom yang ada di tabel produk -->
                            <td>{{ $item->discount }}</td>
                            <td>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            <td><!-- Aksi jika ada --></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="col-lg-3 col-sm-6 col-12 mb-4">
            <div class="demo-inline-spacing">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-cancel">
                        <span class="tf-icons mdi mdi-keyboard-return me-1"></span>Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNewAddress" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
            <div class="modal-content p-md-5 p-3">
                <div class="modal-body p-md-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="mb-4 text-center">
                        <h3 class="address-title mb-2 pb-1">Item Order</h3>
                        <p class="address-subtitle">Nama Toko</p>
                    </div>
                    <form id="addNewAddressForm" class="row g-4" onsubmit="return false">

                        <div class="col-12">
                            {{-- <div class="row">
                <div class="col-md mb-md-0 mb-3">
                  <div class="form-check custom-option custom-option-icon">
                    <label class="form-check-label custom-option-content" for="customRadioHome">
                      <span class="custom-option-body">
                        <i class="mdi mdi-home-outline"></i>
                        <span class="custom-option-title">Home</span>
                        <small> Delivery time (9am – 9pm) </small>
                      </span>
                      <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="customRadioHome" checked />
                    </label>
                  </div>
                </div>
                <div class="col-md mb-md-0 mb-3">
                  <div class="form-check custom-option custom-option-icon">
                    <label class="form-check-label custom-option-content" for="customRadioOffice">
                      <span class="custom-option-body">
                        <i class='mdi mdi-briefcase-outline'></i>
                        <span class="custom-option-title"> Office </span>
                        <small> Delivery time (9am – 5pm) </small>
                      </span>
                      <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="customRadioOffice" />
                    </label>
                  </div>
                </div>
              </div> --}}
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="modalAddressFirstName" name="modalAddressFirstName"
                                    class="form-control" placeholder="Sunlight" />
                                <label for="modalAddressFirstName">Nama Produk</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="modalAddressLastName" name="modalAddressLastName"
                                    class="form-control" placeholder="Doe" />
                                <label for="modalAddressLastName">Deskripsi</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-floating form-floating-outline">
                                <input type="number" id="modalAddressAddress1" name="modalAddressAddress1"
                                    class="form-control" placeholder="1" />
                                <label for="modalAddressAddress1">Quantity</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-floating form-floating-outline">
                                <input type="number" id="modalAddressAddress1" name="modalAddressAddress1"
                                    class="form-control" placeholder="1" />
                                <label for="modalAddressAddress1">Satuan</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="modalAddressLastName" name="modalAddressLastName"
                                    class="form-control" placeholder="Rp. 0,-" />
                                <label for="modalAddressLastName">Harga Satuan</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" id="modalAddressLastName" name="modalAddressLastName"
                                    class="form-control" placeholder="Rp. 0,-" />
                                <label for="modalAddressLastName">Total Harga</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" inputmode="numeric" id="modalAddressLastName"
                                    name="modalAddressLastName" class="form-control" placeholder="%" />
                                <label for="modalAddressLastName">Discount</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="number" inputmode="numeric" id="modalAddressLastName"
                                    name="modalAddressLastName" class="form-control" placeholder="Rp. 0,-" />
                                <label for="modalAddressLastName">Harga Akhir</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="modalAddressLastName" name="modalAddressLastName"
                                    class="form-control" placeholder="(%)" />
                                <label for="modalAddressLastName">Keterangan Discount</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="switch">
                                <input type="checkbox" class="switch-input">
                                <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                </span>
                                <span class="switch-label">Use as a billing address?</span>
                            </label>
                        </div>
                        <div class="col-12 text-end">
                            <button type="reset" class="btn btn-secondary tf-icons mdi mdi-chevron-double-left me-1"
                                data-bs-dismiss="modal" aria-label="Close">Kembali</button>
                            <button type="submit"
                                class="btn btn-success me-sm-3 tf-icons mdi mdi-file-check-outline me-1">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $('.btn-cancel').click(function(e) {
        e.preventDefault();
        $('.detail-sales-page').fadeOut(function() {
            $('.detail-sales-page').empty();
            $('.main-page').fadeIn();
            $('.detail-sales-page').hide()
            // $('#datagrid').DataTable().ajax.reload();
        });
    });
</script>
