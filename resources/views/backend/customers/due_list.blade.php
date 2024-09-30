@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('customar.Due Customer List') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('customar.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('customar.Due Customer List') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('customar.Manage Due Customar') }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('customar.Sl') }}</th>
                                        <th>{{ __('customar.Customar Name') }}</th>
                                        <th>{{ __('customar.Email') }}</th>
                                        <th>{{ __('customar.Phone') }}</th>
                                        <th>{{ __('customar.Address') }}</th>
                                        <th>{{ __('customar.Total Sell Amount') }}</th>
                                        <th>{{ __('customar.Total Paid') }}</th>
                                        <th>{{ __('customar.Total Due') }}</th>
                                        <th style="width: 125px;">{{ __('customar.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_due=0;

                                    @endphp
                                    @foreach($items as $key=>$item)

                                    @php
                                        $sell=$item->orders->sum('amount');
                                        $paid=$item->orders->sum('paid');
                                        $due=$sell-$paid;

                                        if($due==0){
                                            continue;
                                        }
                                        $total_due+=$due;

                                    @endphp

                                    <tr>
                                        <td> {{$key+1}}</td>
                                        <td> {{$item->name}}</td>
                                        <td> {{$item->email}}</td>
                                        <td> {{$item->phone}}</td>
                                        
                                        <td> {{$item->address}}</td>
                                        <td> {{$sell}}</td>
                                        <td> {{$paid??0}}</td>
                                        <td> {{$due}}</td>
                                        
                                        <td>
                                            <a href="{{ route('admin.customerPayment',[$item->id])}}" class="btn btn-primary btn-sm btn_modal">{{ __('customar.Add Payment') }}</a>

                                            @can('customers.edit')
                                            <a href="{{ route('admin.contactSmsModal',[$item->id])}}" class="action-icon btn_modal"> 
                                                {{ __('customar.Send SMS') }}    
                                            </a>
                                            @endcan

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7">{{ __('customar.Total') }} </th>
                                        <th> {{number_format($total_due,2)}} </th>
                                    </tr>
                                </tfoot>
                            </table>
                            
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </div>
</main>
                
@endsection

