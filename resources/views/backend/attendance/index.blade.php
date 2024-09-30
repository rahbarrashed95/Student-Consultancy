@extends('backend.partials.app')
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4"> {{ __('attendance.Attendance') }} </h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('attendance.Dashboard') }}</a></li>
        <li class="breadcrumb-item active"> {{ __('attendance.Attendance List') }} </li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            {{ __('attendance.Attendance List') }}
            @if(auth()->user()->can('attendance.create'))
            <a href="{{ route('admin.attendance.create')}}" class="btn btn-primary btn-sm">{{ __('attendance.Attendance Add') }}</a>
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div  class="col-md-3 no-print">
                            <input type="text" id="search" class="form-control" placeholder="Search here ..">
                        </div>
                    </div>
                    
                </div>
                <div class="col-sm-12 mt-2" id="order_data">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('attendance.Sl') }}</th>
                                    <th>{{ __('attendance.Date') }}</th>
                                    <th>{{ __('attendance.Attendance Create') }}</th>
                                    <th>{{ __('attendance.Total Employees') }}</th>
                                    <th style="width: 125px;">{{ __('attendance.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $key=>$item)
                                <tr>
                                    <td> {{$key+1}}</td>
                                    <td> {{$item->date}}</td>
                                    <td> {{$item->user->name}}</td>
                                    <td> {{$item->details->count()}}</td>
                                    
                                    <td>
                                        @can('attendance.view')
                                        <a href="{{ route('admin.attendance.show',[$item->id])}}" class="action-icon"> 
                                            <i class="fa fa-eye"></i></a>
                                        @endcan

                                        @can('attendance.edit')
                                        <a href="{{ route('admin.attendance.edit',[$item->id])}}" class="action-icon"> 
                                            <i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('attendance.delete')
                                            <a href="{{ route('admin.attendance.destroy',[$item->id])}}" class="delete action-icon"> 
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
@endsection