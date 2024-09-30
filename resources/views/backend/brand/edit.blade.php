<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Slider Update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.brands.update',[$item->id])}}" method="POST" id="ajax_form">
              @csrf
              @method('PATCH')
              <div class="row">      
                
                 
              <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('brand.Brand Image') }} </strong>
                          <input type="file" class="form-control" name="logo">
                      </div>
                  </div>                               


              </div>

              <input type="submit" value="{{ __('brand.Update') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('brand.close') }}</button>
      </div>
    </div>
  </div>