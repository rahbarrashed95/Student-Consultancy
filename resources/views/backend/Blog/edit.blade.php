<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Service Update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.blogs.update',[$item->id])}}" method="POST" id="ajax_form">
              @csrf
              @method('PATCH')
              <div class="row">     
           

              <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('blog.Title') }}</strong>
                          <input type="text" class="form-control" name="title" value="{{ $item->title }}" placeholder="Enter Feature Title...">
                      </div>
                  </div>

                  <div class="col-md-12 mb-2">
                      <div class="form-group">
                          <strong > {{ __('blog.Description') }} </strong>
                          <textarea class="form-control" id="description" name="description">{{ $item->description }}</textarea>
                      </div>
                  </div>                    
                  
                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('blog.Thumbnail') }}</strong>
                          <input type="file" class="form-control" name="thumbnail">
                      </div>
                  </div>                 

              </div>

              <input type="submit" value="{{ __('blog.Update') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('blog.close') }}</button>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>