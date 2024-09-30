<div class="row category_rows" data-id="{{ $category->id }}" style="border: 1px solid #000;">
	<div class="col-md-12">
		<p>{{ $category->name }}</p>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<label> {{ __('cloth.Quantity') }} </label>
			<input type="number" class="form-control quantity" name="quantity[]" value="1">
			<input type="hidden" class="form-control" name="category_id[]" value="{{ $category->id}}">
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<label> {{ __('cloth.Price') }} </label>
			<input type="number" class="form-control price" name="price[]" value="{{ $price}}">
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<label> {{ __('cloth.Sample') }} </label>
			<input type="file" class="form-control" name="images[]">
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<label> {{ __('cloth.Description') }} </label>
			<textarea name="descriptions[]" class="form-control"></textarea>
		</div>
	</div>

	<div class="col-md-12">
		<p> {{ __('cloth.measurement') }} :</p>
		<div class="row mt-2">
			@foreach($category->measurements as $mea)
			<div class="col-md-1">
				<div class="form-group">
					<label> {{ $mea->name}} </label>
					<input type="text" name="measurements[{{$category->id}}][{{$mea->id}}]" class="form-control">
				</div>
			</div>
			@endforeach
		</div>
	</div> 

	<div class="col-md-12">
		<p> {{ __('cloth.style') }} :</p>
		<div class="row mt-2">
			@foreach($category->designs as $des)
			<div class="col-md-2">
				<div class="form-check">
				  <input class="form-check-input {{ $category->id }}_design" name="designs[{{$category->id}}][{{$des->id}}]" type="checkbox" value="{{$des->customer_amount}}" id="{{$des->id}}">
				  <label class="form-check-label" for="{{$des->id}}">{{$des->name}} :{{$des->customer_amount}}
				  </label>
				</div>
			</div>
			@endforeach
		</div>
		<p> {{ __('cloth.Total') }} : <span class="row_total">0</span> </p>
	</div>
	<a class="btn btn-danger btn-sm remove_cat"> {{ __('cloth.Remove') }} </a>
</div>