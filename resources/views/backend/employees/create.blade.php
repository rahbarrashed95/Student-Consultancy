<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Employee Add</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.employees.store')}}" method="POST" id="ajax_form">
              @csrf
              <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>{{ __('staff.Dignification') }}</label>
                            <select class="form-control" name="employee_type_id">
                              <option value=""> {{ __('staff.Select') }}</option>
                                @foreach($types as $type)
                                
                                <option value="{{$type->id}}">{{ $type->name}}</option>
                                @endforeach
                            </select>
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('staff.Staff Name') }}</strong>
                          <input type="text" class="form-control" name="name" placeholder="{{ __('staff.Staff Name') }}">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('staff.Salary') }} </strong>
                          <input type="number" step="any" class="form-control" name="salary">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('staff.Email') }}</strong>
                          <input type="mail" class="form-control" name="email" placeholder="Enter Email...">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('staff.Phone') }}</strong>
                          <input type="text" class="form-control" name="phone" placeholder="Enter Phone...">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('staff.Image') }} </strong>
                          <input type="file" class="form-control" name="image">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('staff.Address') }} </strong>
                          <textarea class="form-control" name="address"></textarea>
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('staff.Info') }} </strong>
                          <textarea class="form-control" name="info"></textarea>
                      </div>
                  </div>

              </div>
              <input type="submit" value="{{ __('staff.Save') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('staff.close') }}</button>
      </div>
    </div>
  </div>