@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Users Add</li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Users Add
            </div>
            <div class="card-body">
                <form action="{{route('admin.users.store')}}" method="POST" id="ajax_form">
                    @csrf
                    <div class="row">
                
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="last_name">Full Name</strong>
                                <input type="text" id="last_name" class="form-control" name="name" placeholder="Full name..." value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="email">Email</strong>
                                <input type="email" id="email" class="form-control" name="email" placeholder="Email..." value="{{ old('email') }}">
                            </div>
                        </div>
                 
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="password">Password</strong>
                                <input type="password" id="password" class="form-control" name="password" placeholder="Password..." value="{{ old('password') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="confirm_password">Confirm Password</strong>
                                <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Re-type Password..." value="{{ old('confirm_password') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="role">Role</strong>
                                 <select name="role" id="role" class="form-control">
                                    <option value="" disabled selected>Choose a Role</option>
                                    @foreach($roles as $role)
                                            <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                 </select>  
                            </div>
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

