@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('visa_immigration.Visa & Immigration') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="">{{ __('visa_immigration.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('visa_immigration.Visa & Immigration List') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('visa_immigration.Manage Visa & Immigration') }} 

                @if(auth()->user()->can('feature.create'))
                <a href="{{ route('admin.visa_immigrations.create',['type'=>'visa'])}}" class="btn btn-primary btn-sm btn_modal">
                        {{ __('visa_immigration.Add Visa & Immigration') }}
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
                                        <th>{{ __('visa_immigration.Sl') }}</th>                                        
                                        <th>{{ __('visa_immigration.Title') }}</th>                                        
                                        <th>{{ __('visa_immigration.Bottom Title') }}</th>                                        
                                        <th>{{ __('visa_immigration.Country') }}</th>                                      
                                        <th>{{ __('visa_immigration.Flag') }}</th>                                      
                                        <th style="width: 125px;">{{ __('visa_immigration.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>                                      
                                    
                                        <td> {{$key+1}}</td>                                                                    
                                        <td> {{$item->title}}</td>                                        
                                        <td> {{$item->bottom_title}}</td>                                     
                                        <td> {{$item->country}}</td>                                     
                                        <td> 
                                        <img src="{{ asset('backend/flag/'. $item->flag) }}" width="80">
                                        </td>                                     
                                        <td>
                                            @can('country_visa.edit')
                                            <a href="{{ route('admin.visa_immigrations.edit',[$item->id])}}" class="btn-sm btn_modal btn btn-primary"> 
                                                <i class="fa fa-edit "></i></a>
                                            @endcan
                                            @can('country_visa.delete')
                                                <a href="{{ route('admin.visa_immigrations.destroy',[$item->id])}}" class="delete btn-sm btn btn-danger"> 
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

