
  <div class="card p-3" id="addProduk" tabindex="-1"  aria-hidden="false" aria-modal="true">
    <div class="card-header flex text-center align-items-center justify-content-center mb-4">
      <h5 class="mb-0">{{$data? 'Edit Produk' : 'Tambah Produk'}}</h5>
      <span class="text-muted">Isi dengan lengkap form berikut ini!</span>
    </div>
    <div class="card-body">
      <form class="form-save">
        <input type="hidden" value="{{ $data ? $data->id_master_produk : null}}" name="id">
        <div class="row">
          <div class="col-6 mb-3">
            <div class="form-floating form-floating-outline">
              <select id="principle_id" name="principle_id" class="select2 form-select" data-allow-clear="true" >
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
              <input type="text" id="kode_produk" name="kode_produk" value="{{ $data ? $data->kode_produk : null}}" class="form-control" placeholder="Kode Produk" />
              <label for="kode_produk">Kode Produk *</label>
            </div>
          </div>
          <div class="col-6 mb-3">
            <div class="form-floating form-floating-outline">
              <input type="text" id="nama_produk" name="nama_produk" class="form-control" placeholder="Placeholder" value="{{ $data ? $data->nama_produk : null}}" />
              <label for="nama_produk">Nama Produk *</label>
            </div>
          </div>
          <div class="col-6">
            <div class="form-floating form-floating-outline">
              <input type="number" id="harga_pokok_penjualan" value="{{ $data ? $data->harga_pokok_penjualan : null}}" name="harga_pokok_penjualan" class="form-control" placeholder="Placeholder" />
              <label for="harga_pokok_penjualan">Harga Pokok Penjualan (Harga Jual Retail) *</label>
            </div>
          </div>
          <div class="col-6 mb-3">
            <div class="form-floating form-floating-outline">
              <input type="number" id="harga_tempo" name="harga_tempo"value="{{ $data ? $data->harga_tempo : null}}" class="form-control" placeholder="Placeholder" />
              <label for="harga_tempo">Harga Tempo *</label>
            </div>
          </div>
          <div class="col-6 ">
            <div class="form-floating form-floating-outline">
              <select id="satuan" name="satuan[]" class="select2 form-select" multiple="multiple" data-allow-clear="true">
                
                @foreach($produk as $item)
                <option value="{{$item->id_master_satuan}}"@if (!empty($data))
                    @foreach ($data->satuan as $key)
                        @if ($key->satuan_id == $item->id_master_satuan )
                            selected
                        @endif
                    @endforeach
                @endif>{{$item->nama_satuan}}</option>
                @endforeach
              </select>
              <label for="satuan">Satuan *</label>
            </div>
          </div>
          <div class="col-6 mb-3">
            <div class="form-floating form-floating-outline">
              <select id="gudang" name="gudang" class="select2 form-select" data-allow-clear="true">
                <option value="{{$data? $data->gudang->id_master_gudang :null}}">{{$data ? $data->gudang->nama_gudang : "Pilih"}}</option>
                @foreach ($gudang as $item)
                <option value="{{$item->id_master_gudang}}">{{$item->nama_gudang}}</option>
                @endforeach
              </select>
              <label for="gudang">Gudang *</label>
            </div>
          </div>
          <div class="col-6 mb-3 ">
            <div class="form-floating form-floating-outline">
              {{-- <img src="{{asset('data-produk/'.$data->foto_produk) }}" alt="" style="width:100px"/> --}}
              <input type="file" id="foto_produk"  name="foto_produk" class="form-control" placeholder="Placeholder" />
              <label for="foto_produk">Foto Produk *</label>
            </div>
          </div>
          <div class="col-12 mb-3">
            <div class="form-floating form-floating-outline">
              <input type="text" id="keterangan" name="keterangan"value="{{ $data ? $data->keterangan : null}}" class="form-control" placeholder="Placeholder" />
              <label for="keterangan">Keterangan *</label>
            </div>
          </div>
        </div>
      </form>
      <div class="col-12 text-end">
        <button type="reset" class="btn btn-outline-secondary btn-cancel" ><i class="ri-arrow-left-s-line me-1"></i> Cancel</button>
        <button type="button" class="btn btn-primary me-sm-3 me-1 btn-submit"><i class="ri-check-line me-1"></i>Submit</button>
      </div>
      {{-- <div class="col-lg-3 col-sm-6 col-12 mb-4">
        <div class="demo-inline-spacing">
          <div class="btn-group">
            <button type="button" class="btn btn-primary btn-cancel">
              <span class="tf-icons mdi mdi-keyboard-return me-1"></span>Kembali
            </button>
          </div>
        </div>
      </div> --}}
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
  $('.btn-submit').click((e)=>{
    e.preventDefault()
    let obj = new FormData($('.form-save')[0])
    $.ajax({
        url: "{{ route('store-produk') }}",
        type: 'POST',
        data: obj,
        async: true,
        cache: false,
        contentType: false,
        processData: false
    }).done((data)=>{
      console.log(data)
      $('.form-save').validate(data, 'has-error')
      if(data.status == 'success'){
        toastr.success(data.message);
        $('#addProduk').hide(); // Show the modal
        $('.main-page').show();
        $('#datagrid').DataTable().ajax.reload();
      }
    })
  })
  </script>

