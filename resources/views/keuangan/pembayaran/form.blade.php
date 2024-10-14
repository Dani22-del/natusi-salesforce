<div class="modal fade" id="addPembayaran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content p-md-5 p-3">
            <div class="modal-body p-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-4 text-center">
                    <h3 class="address-title mb-2 pb-1">Schedule Baru</h3>
                    <p class="address-subtitle">Isi denngan lengkap form berikut ini!</p>
                </div>
                <form id="addNewAddressForm" class="row g-4 form-save" onsubmit="return false">
                    <input type="hidden" name="id" value="{{$data ? $data->id_pembayaran :null}}">
                    <div class="col-6">
                      <div class="form-floating form-floating-outline">
                          <select id="so_id" name="so_id" class="select2 form-select"
                              data-allow-clear="true">
                              <option value="">Select</option>
                              @foreach ($so as $item)
                              <option value="{{$item->id}}"  @if (!empty($data))
                                  @if ($item->id == $data->so_id)
                                      selected
                                  @endif
                              @endif>{{$item->no_invoice}}</option>
                              @endforeach
                          </select>
                          <label for="so_id">No-Invoice</label>
                      </div>
                  </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="date" id="tanggal" name="tanggal" value="{{$data ? $data->tanggal_bayar : null}}"
                                class="form-control" />
                            <label for="tanggal">Tanggal</label>
                        </div>
                    </div>
                   
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <select id="metode_bayar" name="metode_bayar" class="select2 form-select"
                                data-allow-clear="true">
                                <option value="{{$data ? $data->metode_bayar : null}}">{{$data ? $data->metode_bayar : "Select"}}</option>
                                <option value="Cash">Cash</option>
                                <option value="TF">TF</option>
                                <option value="Giro">Giro</option>
                                {{-- @foreach ($customer as $item)
                                <option value="{{$item->id}}" @if (!empty($data))
                                    @if ($item->id == $data->metode_bayar)
                                        selected
                                    @endif
                                @endif>{{$item->kode_customer}}</option>
                                @endforeach --}}
                            </select>
                            <label for="metode_bayar">Cara Bayar</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="number" name="nominal_bayar" id="" value="{{$data ? $data->jumlah_bayar : null}}"  class="form-control">
                            <label for="so_id">Nominal Bayar</label>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close"><i class="mdi mdi-keyboard-return me-1"></i> Cancel</button>
                        <button type="button" class="btn btn-primary btn-submit me-sm-3 me-1"><i
                                class="mdi mdi-check-all me-1"></i>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
  <script>
      $(document).ready(function() { 
         $('#so_id').change((e)=>{
           let value = $('#so_id').val()
           
           $.ajax({
               url : '{{route("form-add-pembayaran")}}',
               method: 'POST',
               data: { so_id:value },
               success: function(data) {
               
                 console.log(data)
                 const tanggal = $('#tanggal')
                 tanggal.val(data.date)
               }
           })
         })
       })
    $('.btn-submit').click((e) => {
        e.preventDefault()
        let obj = new FormData($('.form-save')[0])
        $.ajax({
                url: "{{ route('store-pembayaran') }}",
                type: 'POST',
                data: obj,
                async: true,
                cache: false,
                contentType: false,
                processData: false
            }).done((data) => {
                console.log(data)
                $('.form-save').validate(data, 'has-error')
                if (data.status == 'success') {
                    toastr.success(data.message);
                    $('.main-page').show();
                    $('#addPembayaran').modal('hide'); // Show the modal
                    $('#datagrid').DataTable().ajax.reload();
                    printSpecificArea(data.id)
                } 
            })
            .fail(function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    console.log(errors)
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
    })
    function printSpecificArea(id) {
        // console.log(id);
        window.open("{{ route('print-form','') }}/"+id);
        
        // $.ajax({
        //     url: url, // URL tampilan cetak dari Laravel
        //     success: function(data) {
        //         var printContents = data; // Isi halaman dari AJAX
        //         var originalContents = $('body').html(); // Simpan isi asli halaman

        //         $('body').html(printContents); // Ganti isi halaman dengan tampilan cetak
        //         window.print(); // Cetak halaman
        //         $('body').html(originalContents); // Kembalikan isi halaman semula
        //     },
        //     error: function(xhr, status, error) {
        //         console.log('Gagal memuat tampilan cetak: ' + error);
        //     }
        // });
    }
    
  
  </script>