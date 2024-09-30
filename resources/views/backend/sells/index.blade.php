@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"> Sell</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"> Sell List </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                @if(auth()->user()->can('sells.create'))
                <a href="{{ route('admin.sells.create')}}" class="btn btn-primary btn-sm">Add Sell</a>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            

                            <div  class="col-md-3 no-print">
                                <input type="text" id="search" class="form-control" placeholder="Search here ..">
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 mt-2" id="order_data">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('cloth.Sl') }}</th>
                                        <th>{{ __('cloth.Invoice No') }}</th>
                                        <th>{{ __('cloth.Date') }}</th>
                                        <th>{{ __('cloth.Supplier Name') }}</th>
                                        <th>{{ __('cloth.Amount') }}</th>
                                        <th> Discount </th>
                                        
                                        <th>{{ __('cloth.Note') }}</th>
                                        <th>{{ __('cloth.Status') }}</th>
                                        <th style="width: 125px;">{{ __('cloth.Action') }}</th>
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
                                        <td> {{$item->discount_amount}}</td>
                                        <td> {{$item->note}}</td>
                                        <td> {{$item->payment_status}}</td>
                                        
                                        <td>
                                            @can('sells.view')
                                            <a href="{{ route('admin.sells.show',[$item->id])}}" class="action-icon"> 
                                                <i class="fa fa-eye"></i></a>
                                                
                                            <a href="{{ route('admin.sellInvoice',[$item->id])}}" class="action-icon"> 
                                                <i class="fa fa-print"></i>
                                            </a>
                                            
                                            
                                            @endcan

                                            @can('sells.edit')
                                            <a href="{{ route('admin.sells.edit',[$item->id])}}" class="action-icon"> 
                                                <i class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.order_payments.edit',[$item->id])}}" class="action-icon btn_modal"> 
                                                <i class="fa fa-edit"></i></a>
                                                
                                            @endcan
                                            @can('sells.delete')
                                                <a href="{{ route('admin.sells.destroy',[$item->id])}}" class="delete action-icon"> 
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