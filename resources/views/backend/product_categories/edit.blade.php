<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"> {{ __('category.Category Update') }} </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.product_categories.update',[$item->id])}}" method="POST" id="ajax_form">
              @csrf
              @method('PATCH')
              <div class="row">
                  <div class="col-md-12 mb-2">
                      <div class="form-group">
                          <strong >{{ __('category.Name') }}</strong>
                          <input type="text" class="form-control" name="name" placeholder="{{ __('category.Name') }}" value="{{ $item->name}}">
                      </div>
                  </div>

                  
                  
                  <div class="col-md-12 mb-2">
                      <div class="form-group">
                          <strong > {{ __('category.Image') }} </strong>
                          <input type="file" class="form-control" name="image">
                      </div>
                  </div>

                  

              </div>

              <input type="submit" value="{{ __('category.Update') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('category.close') }}</button>
      </div>
    </div>
  </div>