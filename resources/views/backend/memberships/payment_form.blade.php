<form id="ajax_form" action="{{ route('admin.memberships.storePayment')}}" method="post">
    @csrf
    <div class="modal-body">
      <div class="row">

        <input type="hidden" name="membership_id" value="{{ $item->id}}">
        <div class="col-sm-6">
            <div class="form-group">
                <label>{{ __('staff.Method') }}</label>
                <select class="form-control" name="method">
                    @foreach(getMethods() as $key=>$m)
                    <option value="{{$key}}">{{ $m}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-sm-6">
            <div class="form-group">
                <label> Package Amount </label>
                <input type="number" step="any" name="amount" class="form-control" value="{{ $item->type->amount}}">
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label> {{ __('staff.Date') }}</label>
                <input type="date" class="form-control date" name="date" value="{{ date('Y-m-d')}}">
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label> Transaction No </label>
                <input type="text" class="form-control" name="transaction_no">
            </div>
        </div>

        

        <div class="col-sm-6">
            <div class="form-group">
                <label> {{ __('staff.Note') }} </label>
                <textarea class="form-control" name="note"></textarea>
            </div>
        </div>

  
      </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm">{{ __('staff.Save') }}</button>
    </div>
</form> 