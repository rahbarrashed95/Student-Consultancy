<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"> Membership Add</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.membership_types.store')}}" method="POST" id="ajax_form">
              @csrf
              <div class="row">
                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('staff.Name') }}</strong>
                          <input type="text" class="form-control" name="name" placeholder="{{ __('staff.Name') }}">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >Amount</strong>
                          <input type="text" class="form-control" name="amount" placeholder="Amount">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong> Duration (months)</strong>
                          <input type="number" name="duration" class="form-control">
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