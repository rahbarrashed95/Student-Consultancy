@php
    $due=$employee->salary- $employee->thismonth->sum('amount');
@endphp
<div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"> {{$employee->name}} {{ __('staff.Salary Payment') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        <form id="ajax_form" action="{{ route('admin.storeEmployeePayment',[$employee->id])}}" method="post">
            @csrf
            <div class="modal-body">
              <div class="row">

                <div class="col-sm-12 d-none">
                    <div class="form-group">
                        <label>{{ __('staff.Select') }}</label>
                        <select class="form-control" name="type">
                            <option value="salary"> Salary </option>
                           
                        </select>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>{{ __('staff.Method') }}</label>
                        <select class="form-control" name="method">
                            @foreach(getMethods() as $key=>$m)
                            <option value="{{$key}}">{{ $m}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="form-group">
                        <label>{{ __('staff.Salary') }}</label>
                        <input type="number" step="any" name="amount" class="form-control" value="{{ $due}}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label> {{ __('staff.Date') }}</label>
                        <input type="date" class="form-control date" name="date" value="{{ date('Y-m-d')}}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label> {{ __('staff.Note') }} </label>
                        <textarea class="form-control" name="note"></textarea>
                    </div>
                </div>

          
              </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">{{ __('staff.Save') }}</button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('staff.close') }}</button>
            </div>
      </form>
    </div>
</div>