@extends('backend.partials.app')
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4"> {{ __('expanse_and_income.Income & Expanse') }} </h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('expanse_and_income.Dashboard') }}</a></li>
        <li class="breadcrumb-item active"> {{ __('expanse_and_income.Income & Expanse List') }} </li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            {{ __('expanse_and_income.Manage Income & Expanse') }}
            @if(auth()->user()->can('expenses.create'))
            <a href="{{ route('admin.transactions.create')}}" class="btn btn-primary btn-sm">{{ __('expanse_and_income.Income & Expanse Add') }}</a>
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div  class="col-md-3 no-print">
                            <input type="text" id="search" class="form-control" placeholder="{{ __('expanse_and_income.Search') }}........">
                        </div>
                    </div>
                    
                </div>
                <div class="col-sm-12 mt-2" id="order_data">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('expanse_and_income.Sl') }}</th>
                                    <th>{{ __('expanse_and_income.Invoice No') }}</th>
                                    <th>{{ __('expanse_and_income.Date') }}</th>
                                    <th>{{ __('expanse_and_income.Select') }}</th>
                                    <th>{{ __('expanse_and_income.Category') }}</th>
                                    <th>{{ __('expanse_and_income.Amount') }}</th>
                                    <th>{{ __('expanse_and_income.Note') }}</th>
                                    <th>{{ __('expanse_and_income.Status') }}</th>
                                    <th style="width: 125px;">{{ __('expanse_and_income.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $key=>$item)
                                <tr>
                                    <td> {{$key+1}}</td>
                                    <td> {{$item->invoice_no}}</td>
                                    <td> {{$item->date}}</td>
                                    <td> {{$item->type}}</td>
                                    <td> {{ $item->category?$item->category->name:''}}</td>
                                    <td> {{$item->amount}}</td>
                                    <td> {{$item->note}}</td>
                                    <td> {{$item->payment_status}}</td>
                                    
                                    <td>
                                        @can('expenses.edit')
                                        <a href="{{ route('admin.transactions.edit',[$item->id])}}" class="action-icon"> 
                                            <i class="fa fa-edit"></i></a>

                                        <a href="{{ route('admin.order_payments.edit',[$item->id])}}" class="action-icon btn_modal"> 
                                            <i class="fa fa-edit"></i></a>

                                        @endcan
                                        @can('expenses.delete')
                                            <a href="{{ route('admin.transactions.destroy',[$item->id])}}" class="delete action-icon"> 
                                                <i class="fa fa-trash"></i></a>
                                        @endcan

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>        
@endsection

@push('js')

@endpush