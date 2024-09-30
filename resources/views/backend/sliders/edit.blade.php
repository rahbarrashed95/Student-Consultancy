<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Slider Update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.sliders.update',[$item->id])}}" method="POST" id="ajax_form">
              @csrf
              @method('PATCH')
              <div class="row">      
                
                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('slider.Sub Title') }}</strong>
                          <input type="text" class="form-control" name="sub_title" value="{{ $item->sub_title}}" placeholder="Enter Sub Title...">                          
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('slider.Title') }}</strong>
                          <input type="text" class="form-control" name="title" value="{{ $item->title}}" placeholder="Enter Title...">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('slider.Description') }} </strong>
                          <textarea class="form-control" name="description">{{ $item->description }}</textarea>
                      </div>
                  </div>    
                  
                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('slider.Slider Image') }} </strong>
                          <input type="file" class="form-control" name="slider_image">
                      </div>
                  </div>    

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('slider.Human Image') }} </strong>
                          <input type="file" class="form-control" name="human_image">
                      </div>
                  </div>    

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('slider.Layer1 Image') }} </strong>
                          <input type="file" class="form-control" name="layer1_image">
                      </div>
                  </div>  

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('slider.Layer2 Image') }} </strong>
                          <input type="file" class="form-control" name="layer2_image">
                      </div>
                  </div>       

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('slider.Layer3 Image') }} </strong>
                          <input type="file" class="form-control" name="layer3_image">
                      </div>
                  </div>


              </div>

              <input type="submit" value="{{ __('slider.Update') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('staff.close') }}</button>
      </div>
    </div>
  </div>