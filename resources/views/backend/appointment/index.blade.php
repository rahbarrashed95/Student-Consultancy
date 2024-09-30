@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('appointment.Appointment Page') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="">{{ __('appointment.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('appointment.Appointment List') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{ __('about.Manage Appointment') }}               
                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('about.Sl') }}</th>                                        
                                        <th>{{ __('about.Name') }}</th>                                
                                        <th>{{ __('about.Phone') }}</th>                                
                                        <th>{{ __('about.Country') }}</th>                                
                                        <th>{{ __('about.Service') }}</th>                                
                                        <th>{{ __('about.Date') }}</th>                                
                                        <th>{{ __('about.Time') }}</th>                                
                                                                    
                                        <th style="width: 125px;">{{ __('about.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>                                      
                                    
                                        <td> {{$key+1}}</td>                                                                    
                                        <td> {{$item->name}}</td>                                        
                                        <td> {{$item->phone}}</td>                                        
                                        <td> {{$item->country}}</td>                                       
                                        <td> {{$item->service}}</td>                                       
                                        <td> {{$item->date}}</td>                                       
                                        <td> {{$item->time}}</td>                                       
                                             
                                        <td>                                            
                                            @can('customers.delete')
                                                <a href="{{ route('admin.appointments.destroy',[$item->id])}}" class="delete btn-sm btn btn-danger"> 
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



