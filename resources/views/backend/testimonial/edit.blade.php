<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Testimonial Update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.testimonials.update',[$item->id])}}" method="POST" id="ajax_form">
              @csrf
              @method('PATCH')
              <div class="row">     
           
              <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('testimonial.Name') }}</strong>
                          <input type="text" class="form-control" name="name" value="{{ $item->name }}" placeholder="Enter Name...">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('testimonial.Designation') }}</strong>
                          <input type="text" class="form-control" name="designation" value="{{ $item->designation }}" placeholder="Enter designation...">
                      </div>
                  </div>

                  <div class="col-md-12 mb-2">
                      <div class="form-group">
                          <strong > {{ __('testimonial.Description') }} </strong>
                          <textarea class="form-control" id="description" name="description">{{ $item->description }}</textarea>
                      </div>
                  </div>   
                  
                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('testimonial.Image') }}</strong>
                          <input type="file" class="form-control" name="image">
                      </div>
                  </div>                                   

              </div>

              <input type="submit" value="{{ __('testimonial.Update') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('testimonial.close') }}</button>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>