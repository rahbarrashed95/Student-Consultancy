<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"> {{ __('customar.Customar Update') }} </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.customers.update',[$item->id])}}" method="POST" id="ajax_form">
              @csrf
              @method('PATCH')
              <div class="row">
                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('customar.Customar Name') }}</strong>
                          <input type="text" class="form-control" name="name" placeholder="Enter name..." value="{{ $item->name}}">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('customar.Email') }}</strong>
                          <input type="mail" class="form-control" name="email" placeholder="Enter Email..." value="{{ $item->email}}">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('customar.Phone') }}</strong>
                          <input type="text" class="form-control" name="phone" placeholder="Enter Phone..." value="{{ $item->phone}}">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('customar.Image') }} </strong>
                          <input type="file" class="form-control" name="image">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('customar.Address') }} </strong>
                          <textarea class="form-control" name="address">{{ $item->address}}</textarea>
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('customar.Info') }}</strong>
                          <textarea class="form-control" name="info">{{ $item->info}}</textarea>
                      </div>
                  </div>

                  <!-- <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('customar.opening Balance') }} </strong>
                          <input class="form-control" name="openning_balance" type="number" value="{{ $item->openning_balance}}">
                      </div>
                  </div> -->

              </div>

              <input type="submit" value="{{ __('customar.Update') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('customar.close') }}</button>
      </div>
    </div>
  </div>