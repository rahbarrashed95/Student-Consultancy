@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('slider.Slider') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('slider.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('slider.Slider List') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('slider.Manage Slider') }} 

                @if(auth()->user()->can('sliders.create'))
                <a href="{{ route('admin.sliders.create',['type'=>'slider'])}}" class="btn btn-primary btn-sm btn_modal">
                        {{ __('slider.Slider Add') }}
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
                                        <th>{{ __('slider.Sl') }}</th>
                                        <th>{{ __('slider.Sub Title') }}</th>
                                        <th>{{ __('slider.Title') }}</th>
                                        <th>{{ __('slider.Slider Image') }}</th>                                        
                                        <th>{{ __('slider.Human Image') }}</th>                                        
                                        <th>{{ __('slider.Layer1 Image') }}</th>                                        
                                        <th>{{ __('slider.Layer2 Image') }}</th>                                        
                                        <th>{{ __('slider.Layer3 Image') }}</th>                                        
                                        <th style="width: 125px;">{{ __('slider.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>                                      
                                    
                                        <td> {{$key+1}}</td>
                                        <td> {{$item->sub_title}}</td>
                                        <td> {{$item->title}}</td>                                        
                                        <td>
                                            <img src="{{ asset('backend/sliders/'. $item->slider_image) }}" width="80">
                                        </td>                                     
                                        <td>
                                            <img src="{{ asset('backend/sliders/'. $item->human_image) }}" width="80">
                                        </td>                                     
                                        <td>
                                            <img src="{{ asset('backend/sliders/'. $item->layer1_image) }}" width="80">
                                        </td>                                     
                                        <td>
                                            <img src="{{ asset('backend/sliders/'. $item->layer2_image) }}" width="80">
                                        </td>                                     
                                        <td>
                                            <img src="{{ asset('backend/sliders/'. $item->layer3_image) }}" width="80">
                                        </td>                                     
                                        
                                        <td>
                                            @can('customers.edit')
                                            <a href="{{ route('admin.sliders.edit',[$item->id])}}" class="btn-sm btn_modal btn btn-primary"> 
                                                <i class="fa fa-edit "></i></a>
                                            @endcan
                                            @can('customers.delete')
                                                <a href="{{ route('admin.sliders.destroy',[$item->id])}}" class="delete btn-sm btn btn-danger"> 
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

