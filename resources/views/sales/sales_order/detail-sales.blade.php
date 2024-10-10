<div class="card p-3" id="detailSalesOrder">
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
            @if ($salesOrder->status_approve == 'Pending')
                <button type="button" class="btn btn-success btn-cancel" data-sales-order-id="{{ $salesOrder->id }}">
                    <span class="tf-icons mdi mdi-check-all me-1"></span>Terima SO
                </button>
                <button type="button" class="btn btn-danger btn-cancel" data-sales-order-id="{{ $salesOrder->id }}">
                    <span class="tf-icons mdi mdi-alpha-x-box-outline me-1"></span>Tolak SO
                </button>
            @endif

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
                            <td>{{ $item->produk->kode_produk }}</td>
                            <td>{{ $item->produk->nama_produk }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Pieces</td>
                            <td>Rp. {{ number_format($item->produk->harga_pokok_penjualan, 0, ',', '.') }}</td>
                            <td>{{ $item->discount }}</td>
                            <td>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                        data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="ri-more-2-line"></i>
                                    </button>
                                    <div class="dropdown-menu" data-popper-placement="bottom-end">
                                        <a class="dropdown-item waves-effect" href="javascript:void(0);"
                                            onclick="editForm({{ $item->id }})">
                                            <i class="ri-pencil-line me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item waves-effect" href="javascript:void(0);"
                                            onclick="deleteForm({{ $item->id }})">
                                            <i class="ri-delete-bin-7-line me-1"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="col-lg-3 col-sm-6 col-12 mb-4">
            <div class="demo-inline-spacing">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-back">
                        <span class="tf-icons mdi mdi-keyboard-return me-1"></span>Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="editOrderItemModal" tabindex="-1" aria-labelledby="editOrderItemLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrderItemLabel">Edit Order Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateOrderItemForm">
                    <input type="hidden" id="orderItemId" name="id">

                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="namaProduk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="namaProduk" name="nama_produk" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">QTY</label>
                        <input type="number" class="form-control" id="qty" name="qty">
                    </div>
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input type="text" class="form-control" id="satuan" value="Pieces" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="hargaSatuan" class="form-label">Harga Satuan</label>
                        <input type="number" class="form-control" id="hargaSatuan" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="diskon" class="form-label">Disc (%)</label>
                        <input type="number" class="form-control" id="diskon" name="diskon">
                    </div>
                    <div class="mb-3">
                        <label for="subTotal" class="form-label">Sub Total</label>
                        <input type="number" class="form-control" id="subTotal" name="sub_total" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateOrderItem()">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('.btn-back').click(function(e) {
        e.preventDefault();
        $('.detail-sales-page').fadeOut(function() {
            $('.detail-sales-page').empty();
            $('.main-page').fadeIn();
            $('.detail-sales-page').hide()
            // $('#datagrid').DataTable().ajax.reload();
        });
    });
</script>

<script>
    // Function to open the modal and populate form fields with item data
    function editForm(id) {
        $.post("{!! route('get-order-item-details') !!}", {
                id: id
            })
            .done(function(data) {
                $('#orderItemId').val(data.id);
                $('#kode').val(data.produk.kode_produk);
                $('#namaProduk').val(data.produk.nama_produk);
                $('#qty').val(data.qty);
                $('#hargaSatuan').val(data.produk.harga_pokok_penjualan);
                $('#diskon').val(data.discount);
                $('#subTotal').val(calculateSubtotal(data.qty, data.produk.harga_pokok_penjualan, data.discount));

                $('#editOrderItemModal').modal('show');

                $('#qty, #diskon').off('input').on('input', function() {
                    const qty = parseFloat($('#qty').val()) || 0;
                    const discount = parseFloat($('#diskon').val()) || 0;
                    const hargaSatuan = parseFloat($('#hargaSatuan').val());

                    $('#subTotal').val(calculateSubtotal(qty, hargaSatuan, discount));
                });
            })
            .fail(function(error) {
                console.error("Request failed:", error);
            });
    }

    function calculateSubtotal(qty, hargaSatuan, discount) {
        const subTotal = qty * hargaSatuan;
        const discountAmount = subTotal * (discount / 100);
        return (subTotal - discountAmount).toFixed(2);
    }


    function updateOrderItem() {
        const formData = $('#updateOrderItemForm').serialize();

        $.post("{!! route('update-order-item') !!}", formData)
            .done(function(response) {
                if (response.success) {
                    $('#editOrderItemModal').modal('hide');
                    $('#detailSalesOrder').hide();
                    toastr.success(response.message);
                    $('.main-page').show();
                    $('#datagrid').DataTable().ajax.reload();
                } else {
                    toastr.error(response.message);
                }
            })
            .fail(function(xhr) {
                toastr.error('Failed to update order item');
            });
    }
</script>

<script>
    $(document).on('click', '.btn-cancel', function() {
        const action = $(this).hasClass('btn-success') ? 'accept' : 'reject';
        const salesOrderId = $(this).data(
            'salesOrderId'); // Assuming you store the sales order ID in a data attribute

        $.ajax({
            url: '{{ route('update-status', $salesOrder->id) }}',
            method: 'POST',
            data: {
                action: action
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    $('#detailSalesOrder').hide(); // Show the modal
                    $('.main-page').show();
                    $('#datagrid').DataTable().ajax.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan: ' + xhr.responseJSON.message);
            }
        });
    });

    function deleteForm(id) {
        Swal.fire({
            title: "Apakah Anda yakin akan menghapus data ini ?",
            text: "Data akan dihapus dan tidak dapat diperbaharui kembali!",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Hapus Data!',
        }).then((result) => {
            if (result.value) {
                $.post("{!! route('destroy-order-item') !!}", {
                    id: id
                }).done(function(data) {
                    console.log(data);
                    toastr.success(data.metaData.message);
                    $('.preloader').show();
                    $('#datagrid').DataTable().ajax.reload();
                }).fail(function() {
                    toastr.error(data.metaData.message);
                    console.log(data.response.error);
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                toastr.warning('Penghapusan dibatalkan');
                $('#datagrid').DataTable().ajax.reload();
            }
        });
    }
</script>
