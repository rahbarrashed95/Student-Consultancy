@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('brand.Brand') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('brand.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('brand.Brand List') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('brand.Manage Brand') }} 

                @if(auth()->user()->can('brand.create'))
                <a href="{{ route('admin.brands.create',['type'=>'brand'])}}" class="btn btn-primary btn-sm btn_modal">
                        {{ __('brand.Brand Add') }}
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
                                        <th>{{ __('brand.Sl') }}</th>                                       
                                        <th>{{ __('brand.Brand Image') }}</th>                                      
                                                                          
                                        <th style="width: 125px;">{{ __('brand.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>                                      
                                    
                                        <td> {{$key+1}}</td>                                                                        
                                        <td>
                                            <img src="{{ asset('backend/brand/'. $item->logo) }}" width="80">
                                        </td>                                    
                                       
                                        <td>
                                            @can('brand.edit')
                                            <a href="{{ route('admin.brands.edit',[$item->id])}}" class="btn-sm btn_modal btn btn-primary"> 
                                                <i class="fa fa-edit "></i></a>
                                            @endcan
                                            @can('brand.delete')
                                                <a href="{{ route('admin.brands.destroy',[$item->id])}}" class="delete btn-sm btn btn-danger"> 
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

