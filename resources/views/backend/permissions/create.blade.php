@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Permission</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Permission Add</li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Permission Add
            </div>
            <div class="card-body">
                <form action="{{route('admin.permissions.store')}}" method="POST" id="ajax_form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <strong for="permission">Permission Name</strong>
                                <input type="text" id="permission" class="form-control" name="name" placeholder="Enter permission name...">
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Save" class="btn btn-success">
                    <hr>
                </form>


            </div>
        </div>
    </div>
</main>
                
@endsection

