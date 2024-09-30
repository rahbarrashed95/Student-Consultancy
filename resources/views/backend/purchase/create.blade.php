@extends('backend.partials.app')
@push('css')
@endpush

@section('content')
<main>
    <div class="container-fluid">
            <h1 class="mt-4"> {{ __('purchase.Purchase Add') }} </h1>
                
            <div class="container-fluid">
                <form method="post" id="ajax_form" action="{{ route('admin.purchases.store')}}">
                    @csrf
                    <div class="page slide-page">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> Supplier</label>
                                    <select class="form-control select2" name="contact_id" style="width:90%">
                                        <option value="">{{ __('purchase.Select') }}</option>
                                        @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id}}"> {{ $supplier->name}}- {{ $supplier->phone}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label> {{ __('purchase.Invoice No') }} </label>
                                    <input type="text" name="invoice_no" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label> {{ __('purchase.Date') }} </label>
                                    <input type="text" name="date" class="form-control date" value="{{ date('d-m-Y')}}">
                                </div>
                            </div>

                            
                            

                            
                        </div>
                
                    <div class="row">
                        <div class="col-sm-12 mb-4 row">
                            <div class="title">{{ __('purchase.Product Search') }}</div>
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <input type="text" id="product_search" class="form-control" style="background: #eee;" placeholder="{{ __('purchase.Product Search') }} .........">
                            </div>

                        </div>
                        <hr>
                        <div class="col-sm-12 row justify-content-center mb-4">
                            <div class="col-sm-8">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('purchase.Product Name') }}</th>
                                            <th>{{ __('purchase.Quantity') }}</th>
                                            <th>{{ __('purchase.Price') }}</th>
                                            <th>{{ __('purchase.Sub Total') }}</th>
                                            <th>{{ __('purchase.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="product_data">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label> {{ __('purchase.Info') }} </label>
                                <textarea class="form-control" name="note"></textarea>
                            </div>
                        </div>

                        
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label> {{ __('purchase.Total Amount') }} </label>
                                <input type="number" step="any" name="amount" class="form-control final_amount">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 row mt-5">
                            <div class="title"> {{ __('purchase.Payment Info:') }} </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>{{ __('purchase.Method') }}</label>
                                    <select class="form-control" name="method">
                                        @foreach(getMethods() as $key=>$m)
                                        <option value="{{$key}}">{{ $m}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>{{ __('purchase.Amount') }}</label>
                                    <input type="number" step="any" name="pay_amount" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> {{ __('purchase.Note') }} </label>
                                    <textarea class="form-control" name="pay_note"></textarea>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="field btns">
                        
                        <button class="submit">{{ __('purchase.Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
</main>

@endsection

@push('js')
<script type="text/javascript">


    //
    const products=[];
    var product_url = "{{ route('admin.getPurchaseProduct') }}";
    $("#product_search" ).autocomplete({
        selectFirst: true, //here
        minLength: 2,
        source: function( request, response ) {
          $.ajax({
            url: product_url,
            type: 'GET',
            dataType: "json",
            data: {search: request.term},
            success: function( data ) {
                
                if (data.length ==0) {
                    toastr.error('Product Not Found');
                }
                else if (data.length ==1) {

                    if(products.indexOf(data[0].id) ==-1){
                        productEntry(data[0]);
                        products.push(data[0].id);
                    }
                    
                    $('#product_search').val('');


                    
                }else if (data.length >1) {
                    response(data);
                }
            }
          });
        },
        select: function (event, ui) {
           
           if(products.indexOf(ui.item.id) ==-1){
                productEntry(ui.item);
                products.push(ui.item.id);
            }

           $('#product_search').val('');
           return false;
        }
    });

    function productEntry(item){

        $.ajax({
            url: '{{ route("admin.purchaseProductEntry")}}',
            type: 'GET',
            dataType: "json",
            data: {id:item.id},
            success: function( res ) {
                    
                if (res.html) {
                    $('tbody#product_data').append(res.html);
                    calculateSum();
                }
                
            }
        });
    }


    $(document).on('click',".remove",function(e) {
        var whichtr = $(this).closest("tr");
        whichtr.remove();  
        calculateSum();    
    });


    $(document).on('blur',".quantity, .unit_price",function(e) {

        calculateSum();    
    });


    function calculateSum() {


        let sub_total=0;

        let tblrows = $("#product_data tr");
        tblrows.each(function (index) {
            let tblrow = $(this);

            let product_qty=Number(tblrow.find('td input.quantity').val());
            let product_amount=Number(tblrow.find('td input.unit_price').val());

            let product_row_total=(product_qty *product_amount);
            tblrow.find('td.row_total').text(product_row_total.toFixed(2));
            sub_total+=product_row_total;
         
            
        });

        $('input.final_amount').val(sub_total.toFixed(2));
    }


  
</script>

@endpush
