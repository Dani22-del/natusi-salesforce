<div class="modal fade" id="addSchedule" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content p-md-5 p-3">
            <div class="modal-body p-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-5 text-center">
                    <h3 class="address-title mb-2 pb-1">Detail Sales Schedule</h3>
                    <p class="address-subtitle">Informasi beserta peta target customer</p>
                </div>
                <form id="addNewAddressForm" class="row g-4" onsubmit="return false">
                    <div class="row">
                        <div class="col-6">
                            <div class="schedule lh-1">
                                <p class="mb-1">Schedule</p>
                                <h6>Senin, 26 Oktober 2024</h6>
                            </div>
                            <div class="sales lh-1">
                                <p class="mb-1">Sales</p>
                                <h6>SL12 - AHMAD FAUZI</h6>
                            </div>
                            <div class="toko lh-1">
                                <p class="mb-1">Nama Toko (Custommer)</p>
                                <h6>toko Prima Utama</h6>
                            </div>
                            <div class="status lh-1">
                                <p class="mb-1">Status</p>
                                <h6 class="text-danger">BELUM</h6>
                            </div>
                            <div class="alamat lh-1">
                                <p class="mb-1">Schedule</p>
                                <h6>Jalan Merdeka No. 123, Kelurahan Harmoni, Kecamatan Sejahtera, Kota Bahagia, Kode
                                    Pos 12345</h6>
                            </div>
                            <div class="telepon lh-1">
                                <p class="mb-1">No. Telepn Toko</p>
                                <h6>081456778552</h6>
                            </div>
                            <div class="pemilik lh-1">
                                <p class="mb-1">Pemilik Toko</p>
                                <h6>ISKANDAR</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15823.357878075913!2d112.4492965!3d-7.4829719!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78128791ae235d%3A0xc4eea3feb0c0127f!2sCV.%20NATUSI%20Software%20dan%20Hardware!5e0!3m2!1sid!2sid!4v1723519402460!5m2!1sid!2sid"
                                width="350" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close"><i class="mdi mdi-keyboard-return me-1"></i> Cancel</button>
                        {{-- <button type="submit" class="btn btn-primary me-sm-3 me-1"><i class="mdi mdi-check-all me-1"></i>Submit</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
