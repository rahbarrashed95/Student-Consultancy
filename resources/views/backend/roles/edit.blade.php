@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"> Roles </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"> Roles  Update</li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                 Roles  Update
            </div>
            <div class="card-body">
                <form action="{{route('admin.roles.update', $role->id)}}" method="POST" id="ajax_form">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="role">Role Name</strong>
                                <input type="text" id="role" class="form-control" name="name" placeholder="Role name..." value="{{$role->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                            <h4>Permissions</h4>
                            <label for="select_all"><input type="checkbox" id="select_all"> All Permissions</label>
                            @foreach($permissions as $permission)
                                <h6><label class="mb-1 mt-2"><input type="checkbox" class="permission-item" name="permissions[]" value="{{$permission->name}}" @if($permission->name == $permission->hasRole($role)) checked @endif> {{$permission->name}}</label></h6>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <br>
                    <input type="submit" value="Save" class="btn btn-success">
                    <hr>
                </form>
            </div>
        </div>
    </div>
</main>
                
@endsection

@push('js')
<script type="text/javascript">
        $("#select_all").change(function(){
            $(".permission-item").prop("checked", $(this).prop("checked"));
    
        });

        $(".permission-item").change(function(){
           if($(this).prop("checked") == false)
           {
                $("#select_all").prop("checked", false);
           }

          select_all();
    
        });

        function select_all()
        {
            if($('.permission-item:checked').length == $('.permission-item').length)
            {
                $("#select_all").prop("checked", true);
            }
        }

        select_all();
  
</script>

@endpush