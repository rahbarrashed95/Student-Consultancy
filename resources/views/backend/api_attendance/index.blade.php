@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"> Get Attendance</li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Users Add
            </div>
            <div class="card-body">
                <form action="{{route('admin.api-attendance.store')}}" method="POST" id="ajax_form">
                    @csrf
                    <div class="row">
                        
                        <div class="col-md-4">

                            <label for="balance_amount">{{ __('Date') }} <span class="text-danger">*</span></label>
                            <div class="form-group">
                              <input type="date" name="date" id="theDate1" class="form-control">
                
                            
                            </div>
                
                           
                            <script type="text/javascript">
                            var date = new Date();
                            var day = date.getDate();
                            var month = date.getMonth() + 1;
                            var year = date.getFullYear();
                            if (month < 10) month = "0" + month;
                            if (day < 10) day = "0" + day;
                            var today = year + "-" + month + "-" + day;
                            document.getElementById('theDate1').value = today;
                            </script>
            
            
                        </div>
        
                    </div>
                    <br>
                    <input type="submit" value="Save" class="btn btn-success">
                    <hr>
                </form>

            </div>
        </div>
    </div>
</main>
                
@endsection

