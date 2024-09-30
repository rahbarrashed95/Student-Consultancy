@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('feature.Feature') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('feature.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('feature.Feature List') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('feature.Manage Feature') }} 

                @if(auth()->user()->can('feature.create'))
                <a href="{{ route('admin.feature.create',['type'=>'feature'])}}" class="btn btn-primary btn-sm btn_modal">
                        {{ __('feature.Feature Add') }}
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
                                        <th>{{ __('feature.Sl') }}</th>                                        
                                        <th>{{ __('feature.Feature Title') }}</th>                                        
                                        <th>{{ __('feature.Feature Description') }}</th>                                      
                                        <th style="width: 125px;">{{ __('feature.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>                                      
                                    
                                        <td> {{$key+1}}</td>                                                                    
                                        <td> {{$item->feature_title}}</td>                                        
                                        <td> {{$item->feature_description}}</td>                                     
                                        <td>
                                            @can('customers.edit')
                                            <a href="{{ route('admin.feature.edit',[$item->id])}}" class="btn-sm btn_modal btn btn-primary"> 
                                                <i class="fa fa-edit "></i></a>
                                            @endcan
                                            @can('customers.delete')
                                                <a href="{{ route('admin.feature.destroy',[$item->id])}}" class="delete btn-sm btn btn-danger"> 
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



