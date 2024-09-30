@extends('backend.partials.app')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Permission </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Permission  List</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Manage Permission 
        </div>
        <div class="card-body">

            @can('permissions.create')
            <div class="row mb-2">
                <div class="col-xl-4">
                    <div class="">
                        
                        <a type="button" href="{{route('admin.permissions.create')}}" class="btn btn-danger mb-2 me-2">
                                <i class="fas fa-plus"></i> Add New Permission</a>
                    
                    </div>
                </div><!-- end col-->
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Permission</th>
                            <th style="width: 125px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                        <tr>
                            <td>{{$permission->name}}</td>
                            <td>
                            @can('permissions.edit')
                            <a href="{{ route('admin.permissions.edit',[$permission->id])}}" class="action-icon"> <i class="fa fa-edit"></i></a>
                            @endcan
                            @can('permissions.delete')
                                <a href="{{ route('admin.permissions.destroy',[$permission->id])}}" class="delete action-icon"> <i class="fa fa-trash"></i></a>
                            @endcan
                           
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$permissions->links()}}
            </div>
        </div>
    </div>
</div>
                
@endsection

