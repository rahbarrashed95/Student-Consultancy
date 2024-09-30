@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('about.About Page') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="">{{ __('about.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('about.About Page') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('about.Manage About Page') }} 

                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('about.Sl') }}</th>                                        
                                        <th>{{ __('about.Title') }}</th>                                
                                        <th>{{ __('about.Thumbnail') }}</th>                                
                                                                    
                                        <th style="width: 125px;">{{ __('about.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>                                      
                                    
                                        <td> {{$key+1}}</td>                                                                    
                                        <td> {{$item->title}}</td>                                        
                                        <td>
                                            <img src="{{ asset('backend/about/'. $item->thumbnail) }}" width="80">
                                        </td>       
                                        <td>
                                            @can('customers.edit')
                                            <a href="{{ route('admin.abouts.edit',[$item->id])}}" class="btn-sm btn_modal btn btn-primary"> 
                                                <i class="fa fa-edit "></i></a>
                                            @endcan
                                            @can('customers.delete')
                                                <a href="{{ route('admin.abouts.destroy',[$item->id])}}" class="delete btn-sm btn btn-danger"> 
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



