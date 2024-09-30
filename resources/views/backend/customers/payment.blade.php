<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"> {{$customer->name}} {{ __('customar.Add Payment') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        <form id="ajax_form" action="{{ route('admin.customerPaymentStore',[$customer->id])}}" method="post">
            @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-7">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('customar.Order No') }}</th>
                                <th>{{ __('customar.Date') }}</th>
                                <th>{{ __('customar.Amount') }}</th>
                                <th>{{ __('customar.Due') }}</th>
                                <th>{{ __('customar.Select') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sells as $sell)

                            
                            
                            <tr>
                                <td>{{ $sell->invoice_no}}</td>
                                <td>{{ dateFormate($sell->created_at)}}</td>
                                <td>{{ $sell->amount}}</td>

                                
                                <td>{{ $sell->due}}</td>
                                <td>
                                    <input class="check_price" type="checkbox" name="sell_id[]" data-price="{{ $sell->due}}" value="{{$sell->id}}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-sm-5">
                <table class="table table-bordered table-striped table-hover">
                    
                    <tbody>


                        <tr>
                            <th>{{ __('customar.Total Amount') }}:</th>
                            <td><input type="number" value="0" readonly class="form-control" name="amount" id="amount"> </td>
                        </tr>

                        <tr>
                            <th>{{ __('customar.Method') }}:</th>
                            <td>
                                <select class="form-control" name="method">
                                    @foreach(getMethods() as $key=>$m)
                                    <option value="{{$key}}">{{ $m}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <th>{{ __('customar.Account') }}:</th>
                            <td>
                                <select class="form-control" name="account_id">
                                    <option value="">Select One</option>
                                    
                                </select>
                            </td>
                        </tr>
                    
                        <tr>
                            <th>{{ __('customar.Date') }}:</th>
                            <td>
                                <input type="date" name="date" value="{{ date('Y-m-d')}}" class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <th>{{ __('customar.Transaction No') }}:</th>
                            <td>
                                <input type="text" name="transaction_no" class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <th>{{ __('customar.Note') }}:</th>
                            <td>
                                <textarea class="form-control" name="note"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

  
          </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm">{{ __('customar.Save') }}</button>
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('customar.close') }}</button>
      </div>
      </form>

    </div>
  </div>

  <script type="text/javascript">
        
        $('.check_price').click(function(){
            calSum();
        })
        function calSum(){

            let design_total=0;
            $(document).find('.check_price:checked').each(function() {
               design_total +=Number($(this).data('price'));
            });

            $('#amount').val(design_total);

        }
  </script>