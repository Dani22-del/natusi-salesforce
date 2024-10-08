
<div class="card p-3" id="addProduk" tabindex="-1"  aria-hidden="false" aria-modal="true">
  <div class="card-header flex text-center align-items-center justify-content-center mb-4">
    <h5 class="mb-0">Detail Produk</h5>
    <span class="text-muted">Data Lengkap Produk</span>
  </div>
  <div class="card-body">
    <form class="form-save">
      <div class="col-12 mb-3">
        <img src="{{ asset('storage/' . $data->foto_produk) }}" style="width: 100%; height:264px; object-fit: cover; border-radius:5px">
        
      </div>
      <input type="hidden" value="{{ $data ? $data->id_master_produk : null}}" name="id">
      <div class="row">
        <div class="col-6 mb-3">
          <div class="form-floating form-floating-outline">
            <select id="principle_id" name="principle_id" class="select2 form-select" data-allow-clear="true" disabled>
              <option value="{{$data? $data->principle->id_master_principal :null}}">{{$data ? $data->principle->nama_principal : "Pilih"}}</option>
              @foreach ($principle as $item)
              <option value="{{$item->id_master_principal}}">{{$item->nama_principal}}</option>
              @endforeach
            </select>
            <label for="principle_id">Principle *</label>
          </div>
        </div>
        <div class="col-6 ">
          <div class="form-floating form-floating-outline">
            <input type="text" id="kode_produk" name="kode_produk" value="{{ $data ? $data->kode_produk : null}}" class="form-control" placeholder="Kode Produk" disabled />
            <label for="kode_produk">Kode Produk *</label>
          </div>
        </div>
        <div class="col-6 mb-3">
          <div class="form-floating form-floating-outline">
            <input type="text" id="nama_produk" name="nama_produk" class="form-control" placeholder="Placeholder" value="{{ $data ? $data->nama_produk : null}}" disabled />
            <label for="nama_produk">Nama Produk *</label>
          </div>
        </div>
        <div class="col-6">
          <div class="form-floating form-floating-outline">
            <input type="number" id="harga_pokok_penjualan" value="{{ $data ? $data->harga_pokok_penjualan : null}}" name="harga_pokok_penjualan" class="form-control" placeholder="Placeholder" disabled />
            <label for="harga_pokok_penjualan">Harga Pokok Penjualan (Harga Jual Retail) *</label>
          </div>
        </div>
        <div class="col-6 mb-3">
          <div class="form-floating form-floating-outline">
            <input type="number" id="harga_tempo" name="harga_tempo"value="{{ $data ? $data->harga_tempo : null}}" class="form-control" placeholder="Placeholder" disabled/>
            <label for="harga_tempo">Harga Tempo *</label>
          </div>
        </div>
        <div class="col-6 ">
          <div class="form-floating form-floating-outline">
            <select id="satuan" name="satuan[]" class="select2 form-select" multiple="multiple" data-allow-clear="true" disabled>
              
              @foreach($produk as $item)
              <option value="{{$item->id_master_satuan}}"@if (!empty($data))
                  @foreach ($data->satuan as $key)
                      @if ($key->satuan_id == $item->id_master_satuan )
                          selected
                      @endif
                  @endforeach
              @endif>{{$item->satuan_produk}}</option>
              @endforeach
            </select>
            <label for="satuan">Satuan *</label>
          </div>
        </div>
        <div class="col-6 mb-3">
          <div class="form-floating form-floating-outline">
            <select id="gudang" name="gudang" class="select2 form-select" data-allow-clear="true" disabled>
              <option value="{{$data? $data->gudang->id_master_gudang :null}}">{{$data ? $data->gudang->nama_gudang : "Pilih"}}</option>
              @foreach ($gudang as $item)
              <option value="{{$item->id_master_gudang}}">{{$item->nama_gudang}}</option>
              @endforeach
            </select>
            <label for="gudang">Gudang *</label>
          </div>
        </div>
        <div class="col-6 mb-3">
          <div class="form-floating form-floating-outline">
            <input type="text" id="keterangan" name="keterangan"value="{{ $data ? $data->keterangan : null}}" class="form-control" placeholder="Placeholder"disabled/>
            <label for="keterangan">Keterangan *</label>
          </div>
        </div>
      </div>
    </form>
    <div class="col-12 text-end">
      <button type="reset" class="btn btn-outline-secondary btn-cancel" ><i class="ri-arrow-left-s-line me-1"></i> Cancel</button>
    </div>
  </div>
</div>

<script>
 
   $('.btn-cancel').click(function(e){
    e.preventDefault();
    $('.add-produk-page').fadeOut(function(){
      $('.add-produk-page').empty();
      $('.main-page').fadeIn();
      // $('#datagrid').DataTable().ajax.reload();
    });
});

</script>

