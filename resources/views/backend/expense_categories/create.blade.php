<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"> {{ __('expanse_and_income.Category Add') }} </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.expense_categories.store')}}" method="POST" id="ajax_form">
              @csrf
              <div class="row">
                  <div class="col-md-12 mb-2">
                      <div class="form-group">
                          <strong >{{ __('expanse_and_income.Name') }}</strong>
                          <input type="text" class="form-control" name="name" placeholder="{{ __('expanse_and_income.Name') }}...">
                      </div>
                  </div>

              </div>
              <input type="submit" value="{{ __('expanse_and_income.Save') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('expanse_and_income.close') }}</button>
      </div>
    </div>
  </div>