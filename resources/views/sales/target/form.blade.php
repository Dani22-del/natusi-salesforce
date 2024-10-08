<div class="modal fade" id="addTarget" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content p-md-5 p-3">
            <div class="modal-body p-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-4 text-center">
                    <h3 class="address-title mb-2 pb-1">Target Sales Baru</h3>
                    <p class="address-subtitle">Isi denngan lengkap form berikut ini!</p>
                </div>
                <form id="addNewAddressForm" class="row g-4" onsubmit="return false">
                    <div class="col-9">
                        <div class="form-floating form-floating-outline">
                            <select id="sales" name="sales" class="select2 form-select" data-allow-clear="true">
                                <option value="">Select</option>
                                <option value="Australia">Australia</option>
                                <option value="Bangladesh">Bangladesh</option>
                            </select>
                            <label for="sales">Pilih Sales</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalAddressAddress1" name="modalAddressAddress1"
                                class="form-control" placeholder="A0031" />
                            <label for="modalAddressAddress1">Kode Sales</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="month" id="modalAddressAddress2" name="modalAddressAddress2"
                                class="form-control" placeholder="Mall Road" />
                            <label for="modalAddressAddress2">Bulan</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalAddressLandmark" name="modalAddressLandmark"
                                class="form-control" placeholder="Rp. 0,-" />
                            <label for="modalAddressLandmark">Nominal</label>
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
