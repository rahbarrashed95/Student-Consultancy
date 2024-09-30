@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('service.Service') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="">{{ __('service.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('service.Service List') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('service.Manage Service') }} 

                @if(auth()->user()->can('service.create'))
                <a href="{{ route('admin.services.create',['type'=>'service'])}}" class="btn btn-primary btn-sm btn_modal">
                        {{ __('service.Service Add') }}
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
                                        <th>{{ __('service.Sl') }}</th>                                        
                                        <th>{{ __('service.Title') }}</th>                                
                                        <th>{{ __('service.Thumbnail') }}</th>                                
                                                                    
                                        <th style="width: 125px;">{{ __('service.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>                                      
                                    
                                        <td> {{$key+1}}</td>                                                                    
                                        <td> {{$item->title}}</td>                                        
                                        <td>
                                            <img src="{{ asset('backend/service/'. $item->thumbnail) }}" width="80">
                                        </td>       
                                        <td>
                                            @can('customers.edit')
                                            <a href="{{ route('admin.services.edit',[$item->id])}}" class="btn-sm btn_modal btn btn-primary"> 
                                                <i class="fa fa-edit "></i></a>
                                            @endcan
                                            @can('customers.delete')
                                                <a href="{{ route('admin.services.destroy',[$item->id])}}" class="delete btn-sm btn btn-danger"> 
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

<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>


                
@endsection



