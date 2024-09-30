@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('product.Product') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('product.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('product.Product List') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('product.Manage Product') }}

                @can('product_categories.create')
                <a href="{{ route('admin.products.create')}}" class="btn btn-primary btn-sm btn_modal">{{ __('product.Product Add') }}</a>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('product.Sl') }}</th>
                                        <th>{{ __('product.Product Name') }}</th>
                                        <th>{{ __('product.Product SKU') }}</th>
                                        <th>{{ __('product.Product Category') }}</th>
                                        <th>{{ __('product.Purchase Price') }}</th>
                                        <th>{{ __('product.Purchase Sell Price') }}</th>
                                        <th>Description</th>
                                        <th>{{ __('product.Image') }}</th>
                                        <th>{{ __('product.Stock') }}</th>
                                        <th style="width: 125px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>
                                        <td> {{$key+1}}</td>
                                        <td> {{$item->name}}</td>
                                        <td> {{$item->sku}}</td>
                                        <td> {{$item->category->name}}</td>
                                        <td> {{$item->purchase_price}}</td>
                                        <td> {{$item->sell_price}}</td>
                                        <td> {{$item->description}}</td>
                                        
                                        <td>
                                            <img src="{{ getImage('products',$item->image)}}" width="80">
                                        </td>
                                        <td>{{$item->quantity}}</td>
                                        
                                        <td>
                                            @can('products.edit')
                                            <a href="{{ route('admin.products.edit',[$item->id])}}" class="action-icon btn_modal"> 
                                                <i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('products.delete')
                                                <a href="{{ route('admin.products.destroy',[$item->id])}}" class="delete action-icon"> 
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

