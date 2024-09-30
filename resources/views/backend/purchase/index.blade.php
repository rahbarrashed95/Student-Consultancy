@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('purchase.Purchase') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('purchase.Dashboard') }}</a></li>
            <li class="breadcrumb-item active">{{ __('purchase.Purchase List') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('purchase.Manage Purchase') }}
                @if(auth()->user()->can('purchases.create'))
                <a href="{{ route('admin.purchases.create')}}" class="btn btn-primary btn-sm">{{ __('purchase.Purchase Add') }}</a>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            

                            <div  class="col-md-3 no-print">
                                <input type="text" id="search" class="form-control" placeholder="{{ __('purchase.Search') }}">
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 mt-2" id="order_data">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('purchase.Sl') }}</th>
                                        <th>{{ __('purchase.Invoice No') }}</th>
                                        <th>{{ __('purchase.Date') }}</th>
                                        <th>{{ __('purchase.Supplier Name') }}</th>
                                        <th>{{ __('purchase.Amount') }}</th>
                                        
                                        <th>{{ __('purchase.Note') }}</th>
                                        <th>{{ __('purchase.Status') }}</th>
                                        <th style="width: 125px;">{{ __('purchase.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>
                                        <td> {{$key+1}}</td>
                                        <td> {{$item->invoice_no}}</td>
                                        <td> {{$item->date}}</td>
                                        <td> {{$item->contact?$item->contact->name:''}}</td>
                                        <td> {{$item->amount}}</td>
                                        <td> {{$item->note}}</td>
                                        <td> {{$item->payment_status}}</td>
                                        
                                        <td>
                                            @can('purchases.edit')
                                            <a href="{{ route('admin.purchases.edit',[$item->id])}}" class="action-icon"> 
                                                <i class="fa fa-edit"></i></a>

                                            <a href="{{ route('admin.order_payments.edit',[$item->id])}}" class="action-icon btn_modal"> 
                                                <i class="fa fa-edit"></i>
                                            </a>
                                                
                                            @endcan
                                            @can('purchases.delete')
                                                <a href="{{ route('admin.purchases.destroy',[$item->id])}}" class="delete action-icon"> 
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
</main>
                
@endsection

@push('js')

@endpush