@extends('backend.partials.app')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
@endpush
@section('content')
<div class="container-fluid">
    <h3 class="mt-4">{{ __('attendance.Manage Attendance') }}</h3>
    <div class="container-fluid">
        <form method="post" id="ajax_form" action="{{ route('admin.attendance.store')}}">
            @csrf
            <div class="page slide-page">     
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label> {{ __('attendance.Date') }} </label>
                            <input type="text" name="date" class="form-control date" value="{{ date('d-m-Y')}}">
                        </div>
                    </div>                    
                </div>
     
            <div class="row">
                <div class="col-sm-12 row mt-5">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <tr>
                                <th>{{ __('attendance.Sl') }}</th>
                                <th>{{ __('attendance.Name') }}</th>
                                <th>{{ __('attendance.Phone') }}</th>
                                <th>{{ __('attendance.Attendance Type') }}</th>
                                <th>{{ __('attendance.Attendance Time') }}</th>
                            </tr>

                            @foreach($employees as $key=>$emp)
                            <tr>
                                <td>  {{ $key+1}}</td>
                                <td>  {{ $emp->name}}</td>
                                <td>  {{ $emp->phone}}</td>
                                <td>
                                    <select name="status[]" class="form-control">
                                        <option value="1">{{ __('attendance.Present') }}</option>
                                        <option value="0">{{ __('attendance.Absent') }}</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="time" name="check_in[]" value="{{ date('H:i:s')}}">
                                    <input type="hidden" name="ids[]" value="{{ $emp->id}}">
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>

                </div>
            </div>
            <div class="field btns">
                
                <button type="submit" class="btn btn-primary btn-sm"> {{ __('attendance.Save') }} </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@endpush
