@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('feature.Feature') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="">{{ __('blog.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('blog.Blog List') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('blog.Manage Blog') }} 

                @if(auth()->user()->can('blogs.create'))
                <a href="{{ route('admin.blogs.create',['type'=>'blog'])}}" class="btn btn-primary btn-sm btn_modal">
                        {{ __('blog.Blog Add') }}
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
                                        <th>{{ __('blog.Sl') }}</th>                                        
                                        <th>{{ __('blog.Title') }}</th>                                
                                        <th>{{ __('blog.Thumbnail') }}</th>                                
                                                                    
                                        <th style="width: 125px;">{{ __('blog.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>                                      
                                    
                                        <td> {{$key+1}}</td>                                                                    
                                        <td> {{$item->title}}</td>                                        
                                        <td>
                                            <img src="{{ asset('backend/blog/'. $item->thumbnail) }}" width="80">
                                        </td>       
                                        <td>
                                            @can('customers.edit')
                                            <a href="{{ route('admin.blogs.edit',[$item->id])}}" class="btn-sm btn_modal btn btn-primary"> 
                                                <i class="fa fa-edit "></i></a>
                                            @endcan
                                            @can('customers.delete')
                                                <a href="{{ route('admin.blogs.destroy',[$item->id])}}" class="delete btn-sm btn btn-danger"> 
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



