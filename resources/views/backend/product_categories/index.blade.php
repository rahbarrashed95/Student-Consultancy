@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">{{ __('category.Category') }} </h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('category.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('category.Category List') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('category.Manage Category') }}
                @can('product_categories.edit')
                <a href="{{ route('admin.product_categories.create')}}" class="btn btn-primary btn-sm btn_modal">{{ __('category.Category Add') }}</a>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('category.Sl') }}</th>
                                        <th>{{ __('category.Name') }}</th>
                                        <th>{{ __('category.Image') }}</th>
                                        <th style="width: 125px;">{{ __('category.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>
                                        <td> {{$key+1}}</td>
                                        <td> {{$item->name}}</td>
                                        <td>
                                            <img src="{{ getImage('product_categories',$item->image)}}" width="80">
                                        </td>
                                        
                                        <td>
                                            @can('product_categories.edit')
                                            <a href="{{ route('admin.product_categories.edit',[$item->id])}}" class="action-icon btn_modal"> 
                                                <i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('product_categories.delete')
                                                <a href="{{ route('admin.product_categories.destroy',[$item->id])}}" class="delete action-icon"> 
                                                    <i class="fa fa-trash"></i></a>
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

