@foreach($item->categories as $line)
<div class="row category_rows" data-id="{{ $line->category->id }}" style="border: 1px solid #000;">
	<div class="col-md-12">
		<p>{{ $line->category->name }}</p>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<label> {{ __('cloth.Quantity') }} </label>
			<input type="number" class="form-control quantity" name="quantity[]" value="{{$line->quantity}}"> 
			<input type="hidden" class="form-control" name="category_id[]" value="{{ $line->category_id}}">
			<input type="hidden" class="form-control" name="line_id[]" value="{{ $line->id}}">
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<label> {{ __('cloth.Price') }} </label>
			<input type="number" class="form-control price" name="price[]" value="{{ $line->price}}">
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
			<textarea name="descriptions[]" class="form-control">{{ $line->description}}</textarea>
		</div>
	</div>


	<div class="col-md-12">

		<br><p> {{ __('cloth.measurement') }} :</p>
		<div class="row mt-2">
			@foreach($line->measurements as $mea)
			<div class="col-md-1">
				<div class="form-group">
					<label> {{ $mea->measurement->name}} </label>
					<input type="text" name="measurements[{{$line->category_id}}][{{$mea->measurement_id}}]" class="form-control" value="{{ $mea->value}}">
				</div>
			</div>
			@endforeach
		</div>
	</div>

	<div class="col-md-12">
		<br><p> {{ __('cloth.style') }} :</p>
		<div class="row mt-2">
			@foreach($line->category->designs as $des)

			@php
				$check=$line->designs()->where('design_id', $des->id)->first();
			@endphp
			<div class="col-md-2">
				<div class="form-check">
				  <input {{$check?'checked':''}} class="form-check-input {{ $line->category->id }}_design" name="designs[{{$line->category->id}}][{{$des->id}}]" type="checkbox" value="{{$des->customer_amount}}" id="{{ $des->id }}">
				  <label class="form-check-label" for="{{$des->id}}">{{$des->name}} :{{$des->customer_amount}}
				  </label>
				</div>

			</div>
			@endforeach
		</div>
		<p> {{ __('cloth.Total') }} : <span class="row_total">0</span></p>
	</div>
	<a class="btn btn-danger btn-sm remove_cat"> {{ __('cloth.Remove') }} </a>
</div>
@endforeach