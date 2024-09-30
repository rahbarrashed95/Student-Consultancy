<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Social Update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.social.update',[$item->id])}}" method="POST" id="ajax_form">
              @csrf
              @method('PATCH')
              <div class="row">      
                
                <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('social.Icon') }}</strong>
                          <input type="text" class="form-control" name="icon" value="{{ $item->icon }}" placeholder="Enter Icon Class...">                          
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('social.Link') }}</strong>
                          <input type="text" class="form-control" name="link" value="{{ $item->link }}" placeholder="Enter Link...">
                      </div>
                  </div>

              </div>

              <input type="submit" value="{{ __('slider.Update') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('staff.close') }}</button>
      </div>
    </div>
  </div>