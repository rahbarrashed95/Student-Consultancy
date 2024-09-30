@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Dignification</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('staff.Dashboard') }}</a></li>
            <li class="breadcrumb-item active">Dignification</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Dignification
                @can('employees.create')
                <a href="{{ route('admin.employee_types.create')}}" class="btn btn-primary btn-sm btn_modal"> {{ __('staff.Dignification Add') }}  </a>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('staff.Sl') }}</th>
                                        <th>{{ __('staff.Dignification Type') }}</th>
                                        <th style="width: 125px;">{{ __('staff.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>
                                        <td> {{$key+1}}</td>
                                        <td> {{$item->name}}</td>
                                        
                                        <td>
                                            @can('employees.edit')
                                            <a href="{{ route('admin.employee_types.edit',[$item->id])}}" class="action-icon btn_modal"> 
                                                <i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('employees.delete')
                                                <a href="{{ route('admin.employee_types.destroy',[$item->id])}}" class="delete action-icon"> 
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

