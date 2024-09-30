@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Permissions</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Permissions Update</li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Permissions Update
            </div>
            <div class="card-body">
                

                <form action="{{route('admin.permissions.update', $permission->id)}}" method="POST" id="ajax_form">
                    @csrf
                    @method('PUT')
                    <div class="row">
            
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="name">Name</strong>
                                <input type="text" id="name" class="form-control" name="name" placeholder="name..." value="{{$permission->name}}">
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

