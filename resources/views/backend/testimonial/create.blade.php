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
          <form action="{{route('admin.testimonials.store')}}" method="POST" id="ajax_form">
              @csrf
              <div class="row">                 

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('testimonial.Name') }}</strong>
                          <input type="text" class="form-control" name="name" placeholder="Enter Name...">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('testimonial.Designation') }}</strong>
                          <input type="text" class="form-control" name="designation" placeholder="Enter designation...">
                      </div>
                  </div>

                  <div class="col-md-12 mb-2">
                      <div class="form-group">
                          <strong > {{ __('testimonial.Description') }} </strong>
                          <textarea class="form-control" id="description" name="description"></textarea>
                      </div>
                  </div>   
                  
                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('testimonial.Image') }}</strong>
                          <input type="file" class="form-control" name="image">
                      </div>
                  </div>                
                
                 
              </div>
              <input type="submit" value="{{ __('testimonial.Save') }}" class="btn btn-success">
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