@extends('backend.partials.app')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
@endpush

@section('content')
<main>
    <div class="container-fluid">
            <h3 class="mt-4"> {{ __('attendance.Attendance Update') }}</h3>
                
            <div class="container-fluid">
                <form method="post" id="ajax_form" action="{{ route('admin.attendance.update',[$item->id])}}">
                    @csrf
                    @method('PATCH')
                    <div class="page slide-page">     
                        <div class="row">
   
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> {{ __('attendance.Attendance Update') }} </label>
                                    <input type="text" name="date" class="form-control date" value="{{ $item->date}}">
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
                                    @php
                                        $check=$item->details()->where('member_id', $emp->id)->first();
                                    @endphp
                                    <tr>
                                        <td>  {{ $key+1}}</td>
                                        <td>  {{ $emp->name}}</td>
                                        <td>  {{ $emp->phone}}</td>
                                        <td>
                                            <select name="status[]" class="form-control">
                                                <option value="1" {{ $check && $check->status =='1'?'selected':''}}>Present</option>
                                                <option value="0" {{ $check && $check->status =='0'?'selected':''}}>Absent</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="time" step="any" name="check_in[]" value="{{ date('H:i:s', strtotime($check?$check->check_in: date('H:i:s')))}}">
                                            <input type="hidden" name="ids[]" value="{{ $emp->id}}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>

                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-sm">{{ __('attendance.Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
</main>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@endpush
