@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('attendance.Attendance') }}  </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('attendance.Dashboard') }}</a></li>
            <li class="breadcrumb-item active">{{ __('attendance.Attendance Details') }}  {{ dateFormate($item->date)}}</li>
        </ol>

        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 mb-1">
                        <form>
                            <div class="row">
                                <div class="col-sm-4">
                                    <input class="form-control" name="q" value="{{ request('q')??''}}">
                                </div>
                                
                                <div class="col-sm-4">
                                    <button class="btn btn-sm btn-primary" type="submit"> Search</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-12">
                       
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th> Member Id </th>
                                                <th>{{ __('attendance.Name') }}</th>
                                                <th>{{ __('attendance.Phone') }}</th>
                                                <th>{{ __('attendance.Status') }}</th>
                                                <th>{{ __('attendance.Attendance Time') }}</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            @foreach($items as $line)
                                            <tr>
                                                <td>{{ $line->member->member_id}}</td>
                                                <td>{{ $line->member->name}}</td>
                                                <td>{{ $line->member->phone}}</td>
                                                <td>{{ $line->attendance_status=='1'?'Present':'Absent'}}</td>
                                                <td>{{ date('h:i:s A', strtotime($line->check_in))}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>
    </div>
</main>
                
@endsection

