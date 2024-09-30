<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add {{ucfirst($type)}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.visa_immigrations.store')}}" method="POST" id="ajax_form">
              @csrf
              <div class="row">
                
                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('visa_immigration.Country') }}</strong>
                          <input type="text" class="form-control" name="title" placeholder="Enter Title...">
                          <input type="hidden" name="type" value="{{$type}}">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('visa_immigration.Title') }}</strong>
                          <input type="text" class="form-control" name="title" placeholder="Enter Title...">
                          <input type="hidden" name="type" value="{{$type}}">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('visa_immigration.Bottom Title') }}</strong>
                          <input type="text" class="form-control" name="bottom_title" placeholder="Enter Bottom Title...">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('visa_immigration.Description') }} </strong>
                          <textarea class="form-control" id="description" name="description"></textarea>
                      </div>
                  </div>    
                  
                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('visa_immigration.Small Flag') }} </strong>
                          <input type="file" class="form-control" name="small_flag">
                      </div>
                  </div>     

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('visa_immigration.Flag') }} </strong>
                          <input type="file" class="form-control" name="flag">
                      </div>
                  </div>                           

                  

              </div>
              <input type="submit" value="{{ __('visa_immigration.Save') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('visa_immigration.close') }}</button>
      </div>
    </div>
  </div>
  
  <script type="text/javascript">
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>