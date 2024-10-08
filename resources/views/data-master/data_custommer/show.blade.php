<div class="modal fade" id="detailCustommer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content p-md-5 p-3">
            <div class="modal-body p-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-4 text-center">
                    <h3 class="address-title mb-2 pb-1">Detail Toko / Custommer</h3>
                    <p class="address-subtitle">Data Lengkap Custommer</p>
                </div>
                <form id="addNewAddressForm" class="row g-4" onsubmit="return false">
                    <div class="col-md-12">
                        <img src="{{ Storage::url($data->foto_toko) }}" height="400" style="width: 100%"
                            alt="">
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            {{-- <input type="text" id="modalAddressFirstName" name="modalAddressFirstName" class="form-control" placeholder="TKO-0001" /> --}}
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Kode Custommer"
                                    aria-label="Kode Custommer" aria-describedby="button-addon2"
                                    value="{{ $data->kode_customer }}" readonly>
                            </div>
                            {{-- <label for="modalAddressFirstName">Kode Custommer *</label> --}}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalAddressAddress1" name="modalAddressAddress1"
                                class="form-control" placeholder="Nama Toko" value="{{ $data->nama_toko }}" readonly />
                            <label for="modalAddressAddress1">Nama Toko</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="form-floating form-floating-outline">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="modalAddressState" name="modalAddressState"
                                    class="form-control" placeholder="Alamat Toko" value="{{ $data->alamat_toko }}"
                                    readonly />
                                <label for="modalAddressLandmark">Alamat Toko *</label>
                            </div>
                            {{-- <label for="modalAddressFirstName">Kode Custommer *</label> --}}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <small class="text-light fw-semibold d-block">Alamat Pengiriman</small>
                        <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input" type="radio" name="alamat_pengiriman" id="alamatToko"
                                value="alamat_toko" disabled
                                {{ $data && $data->alamat_pengiriman == 'alamat_toko' ? 'checked' : '' }} />
                            <label class="form-check-label" for="alamatToko">Alamat Toko</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="alamat_pengiriman" id="alamatLainnya"
                                value="alamat_lainnya" disabled
                                {{ $data && $data->alamat_pengiriman == 'alamat_lainnya' ? 'checked' : '' }} />
                            <label class="form-check-label" for="alamatLainnya">Alamat Lainnya</label>
                        </div>
                    </div>
                    @if (!empty($data->alamat_lainnya))
                        <div class="col-12 col-md-12">
                            <div class="form-floating form-floating-outline">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalAddressState" name="modalAddressState"
                                        class="form-control" placeholder="Alamat Toko"
                                        value="{{ $data->alamat_lainnya }}" readonly />
                                    <label for="modalAddressLandmark">Alamat Lainnya</label>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalAddressAddress1" name="modalAddressAddress1"
                                class="form-control" placeholder="Nama Pemilik" value="{{ $data->nama_pemilik }}"
                                readonly />
                            <label for="modalAddressAddress1">Nama Pemilik</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="number" id="modalAddressAddress1" name="modalAddressAddress1"
                                class="form-control" placeholder="+62 824" value="{{ $data->no_telepon }}" readonly />
                            <label for="modalAddressAddress1">No Telepon</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating form-floating-outline">
                            <select id="top" name="top" class="select2 form-select" data-allow-clear="true">
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
                    @if (!empty($data->limit_kredit) && !empty($data->jatuh_tempo))
                        <div class="col-4">
                            <div class="form-floating form-floating-outline">
                                <input type="number" id="modalAddressAddress1" name="modalAddressAddress1"
                                    class="form-control" placeholder="Rp. 0,-" value="{{ $data->limit_kredit }}"
                                    readonly />
                                <label for="modalAddressAddress1">Limit Kredit (Rp)</label>
                            </div>
                        </div>
                        <div class="col-4" id="jatuh-tempo-div">
                            <div class="form-floating form-floating-outline">
                                <input type="date" name="jatuh_tempo" id="jatuh-tempo" class="form-control"
                                    value="{{ $data->jatuh_tempo }}" readonly>
                                <label for="jatuh-tempo">Jatuh Tempo *</label>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
