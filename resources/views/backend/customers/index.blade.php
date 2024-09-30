@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('customar.Customer') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('customar.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('customar.Customer List') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('customar.Manage Customer') }} 

                @if(auth()->user()->can('customers.create'))
                <a href="{{ route('admin.customers.create',['type'=>'customer'])}}" class="btn btn-primary btn-sm btn_modal">
                        {{ __('customar.Customer Add') }}
                </a>
                @endif
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
                                        <th>{{ __('customar.Image') }}</th>
                                        <th>{{ __('customar.Info') }}</th>
                                        <th>{{ __('customar.Address') }}</th>
                                        <th style="width: 125px;">{{ __('customar.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>
                                        @php
                                            $due=0;
                                        @endphp
                                    
                                        <td> {{$key+1}}</td>
                                        <td> {{$item->name}}</td>
                                        <td> {{$item->email}}</td>
                                        <td> {{$item->phone}}</td>
                                        <td>
                                            <img src="{{ getImage('customers',$item->image)}}" width="80">
                                        </td>
                                        <td> {{$item->info}}</td>
                                        <td> {{$item->address}}</td>
                                        
                                        <td>
                                            @can('customers.edit')
                                            <a href="{{ route('admin.customers.edit',[$item->id])}}" class="btn-sm btn_modal btn btn-primary"> 
                                                <i class="fa fa-edit "></i></a>
                                            @endcan
                                            @can('customers.delete')
                                                <a href="{{ route('admin.customers.destroy',[$item->id])}}" class="delete btn-sm btn btn-danger"> 
                                                    <i class="fa fa-trash "></i></a>
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

