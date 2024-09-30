<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add {{ucfirst($type)}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.customers.store')}}" method="POST" id="ajax_form">
              @csrf
              <div class="row">
                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('customar.Customar Name') }}</strong>
                          <input type="text" class="form-control" name="name" placeholder="Enter name...">
                          <input type="hidden" name="type" value="{{$type}}">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('customar.Email') }}</strong>
                          <input type="mail" class="form-control" name="email" placeholder="Enter Email...">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('customar.Phone') }}</strong>
                          <input type="text" class="form-control" name="phone" placeholder="Enter Phone...">
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
                          <textarea class="form-control" name="address"></textarea>
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('customar.Info') }}</strong>
                          <textarea class="form-control" name="info"></textarea>
                      </div>
                  </div>

                  <!-- <div class="col-md-12 mb-2">
                      <div class="form-group">
                          <strong >{{ __('customar.opening Balance') }}</strong>
                          <input class="form-control" name="openning_balance" type="number">
                      </div>
                  </div> -->

                  

              </div>
              <input type="submit" value="{{ __('customar.Save') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('customar.close') }}</button>
      </div>
    </div>
  </div>