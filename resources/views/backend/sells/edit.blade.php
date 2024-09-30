@extends('backend.partials.app')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
@endpush

@section('content')
<main>
    <div class="container-fluid">
            <h3 class="mt-4">Sell Update</h3>
                
            <div class="container-fluid">
                <form method="post" id="ajax_form" action="{{ route('admin.sells.update',[$item->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="page slide-page">
                    <div class="title">{{ __('cloth.Customer Account Info:') }}</div>
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>{{ __('cloth.Customer') }}</label>
                                    <select class="form-control select2" name="contact_id" style="width:90%">
                                        <option value="">Select One</option>
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id}}" {{ $customer->id==$item->contact_id?'selected':''}}> {{ $customer->name}}- {{ $customer->phone}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> {{ __('purchase.Invoice No') }} </label>
                                    <input type="text" name="invoice_no" class="form-control"
                                    value="{{$item->invoice_no}}">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> {{ __('cloth.Date') }} </label>
                                    <input type="text" name="date" class="form-control date" value="{{$item->date}}">
                                </div>
                            </div>
                 

                        </div>
                   
                        <div class="row">
                            <div class="col-sm-12 mb-4 row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <input type="text" id="product_search" class="form-control" style="background: #eee;" placeholder="Search Product ..">
                                </div>
                                <div class="col-md-2">
                                    <select id="product_price" class="form-control">
                                        <option value="sell_price">{{ __('cloth.Regular Price') }}</option>
                                        <option value="whole_sell_price">{{ __('cloth.Whole Sell Price') }}</option>
                                    </select>
                                </div>

                            </div>
                            
                            <hr>
                            <div class="col-sm-12 row justify-content-center mb-4">
                                <div class="col-sm-8">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>{{ __('cloth.Product Name') }}</th>
                                                <th>{{ __('cloth.Quantity') }}</th>
                                                <th>{{ __('cloth.Price') }}</th>
                                                <th>{{ __('cloth.Sub Total') }}</th>
                                                <th>{{ __('cloth.Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="product_data">
                                            @foreach($item->lines as $line)
                                            <tr>
                                                <td>{{$line->product->name}}</td>
                                                <td>
                                                    <input class="form-control quantity" name="quantity[]" type="number" value="{{$line->quantity}}" required min="1"/>
                                                    <input type="hidden" name="product_id[]" value="{{$line->product_id}}"/>
                                                    <input type="hidden" name="line_id[]" value="{{$line->id}}"/>
                                                    <input type="hidden" name="p_price[]" value="{{$line->p_price}}"/>
                                                </td>
                                                <td><input class="form-control unit_price" name="unit_price[]" type="number" value="{{$line->price}}" required/></td>
                                                <td class="row_total">{{$line->price * $line->quantity}}</td>
                                                <td><a class="remove btn btn-sm btn-danger"> - </a></td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label> {{ __('cloth.Note') }}</label>
                                    <textarea class="form-control" name="note">{{$item->note}}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label> Discount Amount </label>
                                    <input type="number" step="any" name="discount_amount" value="{{$item->discount_amount}}" class="form-control discount_amount">
                                </div>
                            </div>
                            
                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>{{ __('cloth.Total Amount') }}</label>
                                    <input type="number" step="any" value="{{$item->amount + $item->discount_amount}}" name="amount" class="form-control final_amount">
                                </div>
                            </div>
                        </div>
                    
                    @foreach($item->payments as $pay)
                    <div class="row">
                        <div class="col-sm-12 row mt-5">
                            <div class="title">{{ __('cloth.Payment Info:') }}</div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>{{ __('cloth.Method') }}</label>
                                    <select class="form-control" name="method[]">
                                        @foreach(getMethods() as $key=>$m)
                                        <option value="{{$key}}" {{$key==$pay->method?'selected':''}}>{{ $m}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>{{ __('cloth.Amount') }}</label>
                                    <input type="number" step="any" name="pay_amount[]" class="form-control" value="{{ $pay->amount}}">
                                    <input type="hidden" name="pay_id[]" value="{{ $pay->id}}">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label> {{ __('cloth.Note') }}</label>
                                    <textarea class="form-control" name="pay_note[]">{{ $pay->note}}</textarea>
                                </div>
                            </div>


                        </div>
                    </div>
                    @endforeach
                    <div class="field btns mt-2">
                        
                        <button class="submit">{{ __('cloth.Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
</main>

@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){

        getCustomer();
        calculateSum();
    });
    //
    const products=[];
    var product_url = "{{ route('admin.getSellProduct') }}";
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
            url: '{{ route("admin.sellProductEntry")}}',
            type: 'GET',
            dataType: "json",
            data: {id:item.id,product_price:$('#product_price').val()},
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


    $(document).on('blur',".quantity, .unit_price, .discount_amount",function(e) {

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
        
        let discount=Number($('input.discount_amount').val());
        
        sub_total-=discount;
        $('input.final_amount').val(sub_total.toFixed(2));
    }

    

  
</script>

@endpush
