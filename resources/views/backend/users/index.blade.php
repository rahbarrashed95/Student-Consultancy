@extends('backend.partials.app')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Users</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Users List</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Manage Users
        </div>
        <div class="card-body">

            <div class="row mb-2">
                <div class="col-xl-4">
                    <div class="">

                        @can('users.create')
                        <a type="button" href="{{route('admin.users.create')}}" class="btn btn-danger mb-2 me-2">
                                <i class="fas fa-plus"></i> Add New User</a>
                        @endif


                    </div>
                </div><!-- end col-->
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" >
                    <thead class="table-light">
                        <tr>
                            <th> Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th style="width: 125px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @foreach($user->getRoleNames() as $role)
                                    <span class="badge bg-success">{{$role}}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('users.edit')

                                @endcan
                            </td>
                            <td>
                            @can('users.edit')
                            <a title="Edit" href="{{ route('admin.users.edit',[$user->id])}}" class="action-icon">
                                <i class="fas fa-edit"></i></a>
                            @endcan
                            @can('users.delete')
                                <a title="Delete" href="{{ route('admin.users.destroy',[$user->id])}}" class="delete btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$users->links()}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title"> Manage Users</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col"><input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="..."></th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Gmail</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row"><input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="..."></td>
                                    <td>
                                        <div class="d-flex align-items-center">Mayor Kelly </div>
                                    </td>
                                    <td>mayorkrlly@gmail.com</td>
                                    <td><span class="badge bg-primary-transparent">Team Lead</span></td>
                                    <td>
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 fs-15"> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success text-light"><i class="fas fa-edit"></i></a> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></a> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row"><input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="..."></td>
                                    <td>
                                        <div class="d-flex align-items-center">Mayor Kelly </div>
                                    </td>
                                    <td>mayorkrlly@gmail.com</td>
                                    <td><span class="badge bg-primary-transparent">Team Lead</span></td>
                                    <td>
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 fs-15"> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success text-light"><i class="fas fa-edit"></i></a> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></a> </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Manage Users</h6>
                        <div class="dropdown mb-2">
                            <a type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg text-muted pb-3px">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7" style="">
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye icon-sm me-2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    <span class="">View</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 icon-sm me-2">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                    <span class="">Edit</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash icon-sm me-2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                    <span class="">Delete</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer icon-sm me-2">
                                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                        <rect x="6" y="14" width="12" height="8"></rect>
                                    </svg>
                                    <span class="">Print</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download icon-sm me-2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                    </svg>
                                    <span class="">Download</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Name</th>
                                    <th class="pt-0">Gmail</th>
                                    <th class="pt-0">Role</th>
                                    <th class="pt-0">Status</th>
                                    <th class="pt-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Admin</td>
                                    <td>admin@admin.com</td>
                                    <td><span class="badge bg-success">admin</span></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="hstack gap-2 fs-15"> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success text-light"><i class="fas fa-edit"></i></a> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></a> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Worker</td>
                                    <td>worker@admin.com</td>
                                    <td><span class="badge bg-info">worker</span></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="hstack gap-2 fs-15"> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success text-light"><i class="fas fa-edit"></i></a> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></a> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Worker</td>
                                    <td>worker@admin.com</td>
                                    <td><span class="badge bg-info">worker</span></td>
                                    <td><span class="badge bg-danger">Not Active</span></td>
                                    <td>
                                        <div class="hstack gap-2 fs-15"> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success text-light"><i class="fas fa-edit"></i></a> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></a> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Worker</td>
                                    <td>worker@admin.com</td>
                                    <td><span class="badge bg-info">worker</span></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="hstack gap-2 fs-15"> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success text-light"><i class="fas fa-edit"></i></a> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></a> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Worker</td>
                                    <td>worker@admin.com</td>
                                    <td><span class="badge bg-info">worker</span></td>
                                    <td><span class="badge bg-danger">Not Active</span></td>
                                    <td>
                                        <div class="hstack gap-2 fs-15"> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success text-light"><i class="fas fa-edit"></i></a> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></a> </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Manage Users</h6>
                        <div class="dropdown mb-2">
                            <a type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg text-muted pb-3px">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7" style="">
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye icon-sm me-2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    <span class="">View</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 icon-sm me-2">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                    <span class="">Edit</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash icon-sm me-2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                    <span class="">Delete</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer icon-sm me-2">
                                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                        <rect x="6" y="14" width="12" height="8"></rect>
                                    </svg>
                                    <span class="">Print</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download icon-sm me-2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                    </svg>
                                    <span class="">Download</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 table-bordered">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Name</th>
                                    <th class="pt-0">Gmail</th>
                                    <th class="pt-0">Role</th>
                                    <th class="pt-0">Status</th>
                                    <th class="pt-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Admin</td>
                                    <td>admin@admin.com</td>
                                    <td><span class="badge bg-success">admin</span></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="hstack gap-2 fs-15"> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success text-light"><i class="fas fa-edit"></i></a> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></a> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Worker</td>
                                    <td>worker@admin.com</td>
                                    <td><span class="badge bg-info">worker</span></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="hstack gap-2 fs-15"> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success text-light"><i class="fas fa-edit"></i></a> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></a> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Worker</td>
                                    <td>worker@admin.com</td>
                                    <td><span class="badge bg-info">worker</span></td>
                                    <td><span class="badge bg-danger">Not Active</span></td>
                                    <td>
                                        <div class="hstack gap-2 fs-15"> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success text-light"><i class="fas fa-edit"></i></a> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></a> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Worker</td>
                                    <td>worker@admin.com</td>
                                    <td><span class="badge bg-info">worker</span></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <div class="hstack gap-2 fs-15"> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success text-light"><i class="fas fa-edit"></i></a> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></a> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Worker</td>
                                    <td>worker@admin.com</td>
                                    <td><span class="badge bg-info">worker</span></td>
                                    <td><span class="badge bg-danger">Not Active</span></td>
                                    <td>
                                        <div class="hstack gap-2 fs-15"> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success text-light"><i class="fas fa-edit"></i></a> <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></a> </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

