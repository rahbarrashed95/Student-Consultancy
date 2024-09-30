<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">{{ __('cloth.Invoice No') }} #{{$item->invoice_no}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.order_payments.update',[$item->id])}}" method="POST" id="ajax_form">
              @csrf
              @method('PATCH')
              <div class="row">
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>{{ __('cloth.Method') }}</label>
                        <select class="form-control" name="method">
                            @foreach(getMethods() as $key=>$m)
                            <option value="{{$key}}">{{ $m}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>{{ __('cloth.Transaction No') }}</label>
                        <input type="text" name="transaction_no" class="form-control">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>{{ __('cloth.Amount') }}</label>
                        <input type="number" step="any" name="amount" class="form-control" value="{{$due}}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label> {{ __('cloth.Note') }} </label>
                        <textarea class="form-control" name="note"></textarea>
                    </div>
                </div>


              </div>
              <br>
              <input type="submit" value="{{ __('cloth.Save') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('cloth.close') }}</button>
      </div>
    </div>
  </div>