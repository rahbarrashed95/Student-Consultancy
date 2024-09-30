<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Social Update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.faqs.update',[$item->id])}}" method="POST" id="ajax_form">
              @csrf
              @method('PATCH')
              <div class="row">      
                
                <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('faq.Question') }}</strong>
                          <input type="text" class="form-control" name="question" value="{{ $item->question }}" placeholder="Enter Question...">                          
                      </div>
                  </div>

                  <div class="col-md-12 mb-2">
                      <div class="form-group">
                          <strong >{{ __('faq.Answer') }}</strong>
                          <textarea class="form-control" id="description" name="answer">{{ $item->answer }}</textarea>                          
                      </div>
                  </div>    

              </div>

              <input type="submit" value="{{ __('faq.Update') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('faq.close') }}</button>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>