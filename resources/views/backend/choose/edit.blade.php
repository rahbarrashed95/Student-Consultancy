<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Choose Us Update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.chooses.update',[$item->id])}}" method="POST" id="ajax_form">
              @csrf
              @method('PATCH')
              <div class="row">     
           

              <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('choose.Title') }}</strong>
                          <input type="text" class="form-control" name="title" value="{{ $item->title }}" placeholder="Enter Feature Title...">
                      </div>
                  </div>

                  <div class="col-md-12 mb-2">
                      <div class="form-group">
                          <strong > {{ __('choose.Description') }} </strong>
                          <textarea class="form-control" id="description" name="description">{{ $item->description }}</textarea>
                      </div>
                  </div>   

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('choose.Icon') }}</strong>
                          <input type="file" class="form-control" name="icon">
                      </div>
                  </div>                
                               

              </div>

              <input type="submit" value="{{ __('choose.Update') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('choose.close') }}</button>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>