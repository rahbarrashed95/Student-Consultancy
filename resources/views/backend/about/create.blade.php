<style>
table tbody tr td:first-child input {
    width: 118%;
    height: 33px;
    margin-top: 0%;
}
</style>

<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add {{ucfirst($type)}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.abouts.store')}}" method="POST" id="ajax_form">
              @csrf
              <div class="row">                 

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('about.Title') }}</strong>
                          <input type="text" class="form-control" name="title" placeholder="Enter Feature Title...">
                      </div>
                  </div>

                  <div class="col-md-12 mb-2">
                      <div class="form-group">
                          <strong > {{ __('about.Description') }} </strong>
                          <textarea class="form-control" id="description" name="description"></textarea>
                      </div>
                  </div>   
                  
                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('about.Header Image') }}</strong>
                          <input type="file" class="form-control" name="header_image">
                      </div>
                  </div>
                  
                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('about.Thumbnail') }}</strong>
                          <input type="file" class="form-control" name="thumbnail">
                      </div>
                  </div>                  
                 
              </div>
              <input type="submit" value="{{ __('about.Save') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('about.close') }}</button>
      </div>
    </div>
  </div>

<script type="text/javascript">
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>