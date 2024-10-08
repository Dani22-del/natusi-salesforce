<div class="modal fade" id="addSchedule" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content p-md-5 p-3">
            <div class="modal-body p-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-4 text-center">
                    <h3 class="address-title mb-2 pb-1">Schedule Baru</h3>
                    <p class="address-subtitle">Isi dengan lengkap form dibawah ini</p>
                </div>
                <form id="addNewAddressForm" class="row g-4 form-save" >
                    <input type="hidden" name="id" value="{{$data ? $data->id_schedule_sales :null}}">
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="date" id="tanggal" name="tanggal" value="{{ $data ? $data->tanggal : null }}"
                                class="form-control" placeholder="John" />
                            <label for="tanggal">Tanggal *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <select id="sales_id" name="sales_id" class="select2 form-select"
                                data-allow-clear="true">
                                <option value="">Pilih</option>
                                @foreach ($sales as $item)
                                <option value="{{$item->id_master_sales}}"  @if (!empty($data))
                                    @if ($item->id_master_sales == $data->sales_id)
                                        selected
                                    @endif
                                @endif>{{$item->nama_lengkap}}</option>
                                @endforeach
                            </select>
                            <label for="sales_id">Sales *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <select id="customer_id" name="customer_id" class="select2 form-select"
                                data-allow-clear="true">
                                <option value="">Pilih</option>
                                @foreach ($customer as $item)
                                <option value="{{$item->id}}" @if (!empty($data))
                                    @if ($item->id == $data->customer_id)
                                        selected
                                    @endif
                                @endif>{{$item->kode_customer}}</option>
                                @endforeach
                            </select>
                            <label for="customer_id">Customer *</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="principel_sales" name="principel_sales" 
                                class="form-control"  readonly/>
                            <label for="principel_sales">Principle Sales</label>
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
       $('#sales_id').change((e)=>{
         let value = $('#sales_id').val()
         
         $.ajax({
             url : '{{route("form-add-schedule")}}',
             method: 'POST',
             data: { sales_id:value },
             success: function(data) {
             
               console.log(data)
               const principel = $('#principel_sales')
               let principelNames = data.map(item => item.principle_name);  // Misalkan ada 'principle_name' di response
               principel.val(principelNames.join(', '));  // Menampilkan principal sales di input
             }
         })
       })
     })
    $('.btn-cancel').click(function(e) {
        e.preventDefault();
        $('.add-schedule-page').fadeOut(function() {
            $('.add-schedule-page').empty();
            $('.main-page').fadeIn();
            // $('#datagrid').DataTable().ajax.reload();
        });
    });
    $('.btn-submit').click((e) => {
        e.preventDefault()
        let obj = new FormData($('.form-save')[0])
        $.ajax({
                url: "{{ route('store-schedule-sales') }}",
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
                    $('#addSchedule').modal('hide'); // Show the modal
                    $('#datagrid').DataTable().ajax.reload();
                  
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
    

</script>