<div class="modal fade" id="detailStock" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content p-md-5 p-3">
            <div class="modal-body p-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-4 text-center">
                    <h3 class="address-title mb-2 pb-1">Detail Stock</h3>
                    {{-- <p class="address-subtitle">Isi dengan lengkap form dibawah ini</p> --}}
                </div>
                <form id="addNewAddressForm" class="row g-4" onsubmit="return false">

                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <select id="modalAddressCountry" name="modalAddressCountry" class="select2 form-select"
                                data-allow-clear="true" disabled>
                                <option value="">Pilih</option>
                                <option value="Australia">Australia</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Belarus">Belarus</option>
                            </select>
                            <label for="modalAddressCountry">Produk *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalAddressAddress1" name="modalAddressAddress1"
                                class="form-control" placeholder="Nama" disabled />
                            <label for="modalAddressAddress1">Nama Produk *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="number" id="modalAddressAddress1" name="modalAddressAddress1"
                                class="form-control" placeholder="Nama" disabled />
                            <label for="modalAddressAddress1">Quantity *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalAddressAddress1" name="modalAddressAddress1"
                                class="form-control" placeholder="Nama" disabled />
                            <label for="modalAddressAddress1">Deskripsi </label>
                        </div>
                    </div>

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
