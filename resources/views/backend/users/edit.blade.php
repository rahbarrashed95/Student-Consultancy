@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Users Update</li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Users Update
            </div>
            <div class="card-body">
                

                <form action="{{route('admin.users.update', $user->id)}}" method="POST" id="ajax_form">
                    @csrf
                    @method('PUT')
                    <div class="row">
            
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="name">Name</strong>
                                <input type="text" id="name" class="form-control" name="name" placeholder="name..." value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="email">Email</strong>
                                <input type="email" id="email" class="form-control" name="email" readonly value="{{$user->email}}">
                            </div>
                        </div>
             
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="password">Password</strong>
                                <input type="password" id="password" class="form-control" name="password" placeholder="Password..." autocomplete="off" autofocus="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="role">Role</strong>
                                 <select name="role" id="role" class="form-control">
                                    <option value="" disabled selected>Choose a Role</option>
                                    @foreach($roles as $role)
                                            <option value="{{$role->name}}" @if($role->name == $user->hasRole($role))  selected @endif>{{$role->name}}</option>
                                               
                                    @endforeach
                                 </select>   
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="submit" value="Update" class="btn btn-success">
                    <hr>
                </form>
            </div>
        </div>
    </div>
</main>
                
@endsection

