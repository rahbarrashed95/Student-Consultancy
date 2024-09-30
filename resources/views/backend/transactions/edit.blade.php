@extends('backend.partials.app')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
@endpush

@section('content')
<main>
    <div class="container-fluid">
            <h3 class="mt-4"> {{ __('expanse_and_income.Income & Expanse Update') }} </h3>
                
            <div class="container-fluid">
                <form method="post" id="ajax_form" action="{{ route('admin.transactions.update',[$item->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="page slide-page">
        
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>{{ __('expanse_and_income.Category') }}</label>
                                    <select class="form-control" name="expense_category_id">
                                        <option value="">{{ __('expanse_and_income.Select') }}</option>
                                        @foreach($cats as $cat)
                                        <option value="{{ $cat->id}}" {{ $cat->id==$item->expense_category_id ?'selected':''}}> {{ $cat->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>{{ __('expanse_and_income.Income & Expanse Category') }}</label>
                                    <select class="form-control" name="type">
                                        <option value="income" {{ $item->type=='income' ?'selected':''}}>{{ __('expanse_and_income.Income') }}</option>
                                        <option value="expense" {{ $item->type=='expense' ?'selected':''}}>{{ __('expanse_and_income.Expanse') }}</option>
                                       
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> {{ __('expanse_and_income.Date') }} </label>
                                    <input type="text" name="date" class="form-control date" value="{{ date('d-m-Y')}}">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> {{ __('expanse_and_income.Invoice No') }} </label>
                                    <input type="text" name="invoice_no" class="form-control" value="{{ $item->invoice_no}}">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>{{ __('expanse_and_income.Total Amount') }}</label>
                                    <input type="number" step="any" name="amount" value="{{ $item->amount}}" class="form-control final_amount">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label> {{ __('expanse_and_income.Note') }} </label>
                                    <textarea class="form-control" name="note">{{ $item->note}}</textarea>
                                </div>
                            </div>
                            
                        </div>
         
        
               
                    
                    @foreach($item->payments as $pay)
                    <div class="row">
                        <div class="col-sm-12 row mt-5">
                            <div class="title">{{ __('expanse_and_income.Payment Info:') }}</div>
                            
                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>{{ __('expanse_and_income.Method') }}</label>
                                    <select class="form-control" name="method">
                                        @foreach(getMethods() as $key=>$m)
                                        <option value="{{$key}}">{{ $m}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>{{ __('expanse_and_income.Paid Amount') }}</label>
                                    <input type="number" step="any" name="pay_amount[]" class="form-control" value="{{ $pay->amount}}">
                                    <input type="hidden" name="pay_id[]" value="{{ $pay->id}}">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label> {{ __('expanse_and_income.Note') }} </label>
                                    <textarea class="form-control" name="pay_note[]">{{ $pay->note}}</textarea>
                                </div>
                            </div>


                        </div>
                    </div>
                    @endforeach

                    <div class="field btns">
                        
                        <button class="submit">{{ __('expanse_and_income.Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
</main>

@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@endpush