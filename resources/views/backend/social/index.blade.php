@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('social.Social List') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('social.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('social.Social List') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('social.Manage Social') }} 

                @if(auth()->user()->can('social.create'))
                <a href="{{ route('admin.social.create',['type'=>'social'])}}" class="btn btn-primary btn-sm btn_modal">
                        {{ __('social.Social Add') }}
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
                                        <th>{{ __('social.Sl') }}</th>
                                        <th>{{ __('social.Link') }}</th>                                                                                                     
                                        <th style="width: 125px;">{{ __('slider.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>                                      
                                    
                                        <td> {{$key+1}}</td>
                                        <td> {{$item->link}}</td>                                                                        
                                        <td>
                                            @can('social.edit')
                                            <a href="{{ route('admin.social.edit',[$item->id])}}" class="btn-sm btn_modal btn btn-primary"> 
                                                <i class="fa fa-edit "></i></a>
                                            @endcan
                                            @can('social.delete')
                                                <a href="{{ route('admin.social.destroy',[$item->id])}}" class="delete btn-sm btn btn-danger"> 
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

