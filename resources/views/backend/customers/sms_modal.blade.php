<div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">  {{ __('customar.Send SMS') }} {{$item->type}} {{$item->name}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.sendSMs',[$item->id])}}" method="POST" id="ajax_form">
              @csrf
              <div class="row">

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>{{ __('customar.SMS') }}</label>
                        <textarea placeholder="{{ __('customar.SMS') }}" name="message" class="form-control"></textarea>
                    </div>
                </div>
              </div>
              <br>
              <input type="submit" value="{{ __('customar.Save') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('customar.close') }}</button>
      </div>
    </div>
  </div>