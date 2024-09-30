<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">{{ __('product.Product Add') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('admin.products.store')}}" method="POST" id="ajax_form">
              @csrf
              <div class="row">
                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('product.Name') }}</strong>
                          <input type="text" class="form-control" name="name" placeholder="Enter name...">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('product.Product SKU') }}</strong>
                          <input type="text" class="form-control" name="sku" placeholder="Enter Sku...">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong >{{ __('product.Product Category') }}</strong>
                          <select name="category_id" class="form-control">
                              <option value="">select One</option>
                              @foreach($cats as $cat)
                              <option value="{{ $cat->id}}">{{ $cat->name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('product.Purchase Price') }} </strong>
                          <input type="number" step="any" class="form-control" name="purchase_price">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('product.Purchase Sell Price') }} </strong>
                          <input type="number" step="any" class="form-control" name="sell_price">
                      </div>
                  </div>

          

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > {{ __('product.Image') }} </strong>
                          <input type="file" class="form-control" name="image">
                      </div>
                  </div>

                  <div class="col-md-4 mb-2">
                      <div class="form-group">
                          <strong > Description </strong>
                          <textarea class="form-control" name="description"></textarea>
                      </div>
                  </div>

              </div>
              <input type="submit" value="{{ __('product.Save') }}" class="btn btn-success">
              <hr>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('product.close') }}</button>
      </div>
    </div>
  </div>