@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"> {{ __('expanse_and_income.Category') }}  </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('expanse_and_income.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('expanse_and_income.Category List') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('expanse_and_income.Manage Category') }}
                @can('expenses.create')
                <a href="{{ route('admin.expense_categories.create')}}" class="btn btn-primary btn-sm btn_modal float-right"> {{ __('expanse_and_income.Category Add') }} </a>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('expanse_and_income.Sl') }}</th>
                                        <th>{{ __('expanse_and_income.Category') }}</th>
                                        <th style="width: 125px;">{{ __('expanse_and_income.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>
                                        <td> {{$key+1}}</td>
                                        <td> {{$item->name}}</td>
                                        
                                        <td>
                                            @can('expenses.edit')
                                            <a href="{{ route('admin.expense_categories.edit',[$item->id])}}" class="action-icon btn_modal"> 
                                                <i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('expenses.delete')
                                                <a href="{{ route('admin.expense_categories.destroy',[$item->id])}}" class="delete action-icon"> 
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

