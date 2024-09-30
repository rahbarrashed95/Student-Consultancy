<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add {{ucfirst($type)}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.social.store')}}" method="POST" id="ajax_form">
              @csrf
              <div class="row">
                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('social.Icon') }}</strong>
                          <input type="text" class="form-control" name="icon" placeholder="Enter Icon Class...">
                          <input type="hidden" name="type" value="{{$type}}">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('social.Link') }}</strong>
                          <input type="text" class="form-control" name="link" placeholder="Enter Link...">
                      </div>
                  </div>                
                  

              </div>
              <input type="submit" value="{{ __('slider.Save') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('slider.close') }}</button>
      </div>
    </div>
  </div>