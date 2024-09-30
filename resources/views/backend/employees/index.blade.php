@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"> Employee </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('staff.Dashboard') }}</a></li>
            <li class="breadcrumb-item active">Employee List</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Employee
                @can('employees.edit')
                <a href="{{ route('admin.employees.create')}}" class="btn btn-primary btn-sm btn_modal">Employee Add</a>
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
                                        <th>Type</th>
                                        <th>{{ __('staff.Staff Name') }}</th>
                                        <th>{{ __('staff.Email') }}</th>
                                        <th>{{ __('staff.Phone') }}</th>
                                        <th>{{ __('staff.Image') }}</th>
                                        <th>{{ __('staff.Info') }}</th>
                                        <th>{{ __('staff.Address') }}</th>
                                        <th>{{ __('staff.Salary') }}</th>
                                        <th>{{ __('staff.Paid Amount') }}</th>
                                        <th>{{ __('staff.Dui Amount') }}</th>
                                        <th>{{ __('staff.Payment') }}</th>
                                        <th style="width: 125px;">{{ __('staff.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>
                                        <td> {{$key+1}}</td>
                                        <td> {{$item->type->name}}</td>
                                        <td> {{$item->name}}</td>
                                        <td> {{$item->email}}</td>
                                        <td> {{$item->phone}}</td>
                                        <td>
                                            <img src="{{ getImage('employees',$item->image)}}" width="80">
                                        </td>
                                        <td> {{$item->info}}</td>
                                        <td> {{$item->address}}</td>
                                        <td> {{$item->salary}}</td>
                                        <td> {{$item->thismonth->sum('amount')}}</td>
                                        <td> {{$item->salary- $item->thismonth->sum('amount')}}</td>
                                        <td>
                                            <a href="{{ route('admin.getEmployeePayment',[$item->id])}}" class="btn btn-success btn-sm btn_modal">{{ __('staff.Payment') }}</a>
                                       
                                        </td>
                                        
                                        <td>
                                            @can('employees.edit')
                                            <a href="{{ route('admin.employees.edit',[$item->id])}}" class="action-icon btn_modal"> 
                                                <i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('employees.delete')
                                                <a href="{{ route('admin.employees.destroy',[$item->id])}}" class="delete action-icon"> 
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

