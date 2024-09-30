@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4"> Membership </h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('staff.Dashboard') }}</a></li>
            <li class="breadcrumb-item active">Membership List</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Membership
                @can('memberships.create')
                <a href="{{ route('admin.memberships.create')}}" class="btn btn-primary btn-sm">Membership Add</a>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 no-print mb-2">
                        <div class="row">
                            <div  class="col-md-2">
                                <label> Entry Start</label>
                                <input type="text" id="start" class="form-control date" autocomplete="off">
                            </div>

                            <div  class="col-md-2">
                                <label> Entry End</label>
                                <input type="text" id="end" class="form-control date" autocomplete="off">
                            </div>

                            <div  class="col-md-2">
                                <label> Expired at Start</label>
                                <input type="text" id="exstart" class="form-control date" autocomplete="off">
                            </div>

                            <div  class="col-md-2">
                                <label> Expired at End</label>
                                <input type="text" id="exend" class="form-control date" autocomplete="off">
                            </div>

                            <div  class="col-md-3">
                                <label> Search</label>
                                <input type="text" id="search" class="form-control" placeholder=" {{ __('order.Search') }} ..">
                            </div>

                            <div class="col-md-3">
                                      <label>Membership Type </label>
                                        <select class="form-control select2" id="type_id">
                                          <option value=""> {{ __('staff.Select') }}</option>
                                            @foreach($types as $type)
                                            
                                            <option value="{{$type->id}}">{{ $type->name}}</option>
                                            @endforeach
                                        </select>
                              </div>

                            <div  class="col-md-1">
                                <button class="mt-4 btn btn-sm btn-primary" id="search_btn"> Search</button>
                            </div>

                        </div>
                        
                    </div>
                    <hr>
                    <div class="col-md-12 bt-2" id="member_data">
                        

                    </div>
                </div>
                
            </div>
        </div>
    </div>
</main>
                
@endsection

@push('js')


<script type="text/javascript">
  $(document).ready(function () {
    
    getData();
    $('#search').keyup(function(){
        getData();
    });

    $('#search_btn').click(function(){
        getData();
    });

    $('#type_id').change(function(){
        getData();
    });
    
    
    $(document).on('click', ".pagination a", function(e) {
        e.preventDefault();

        $('li').removeClass('active');
        $(this).parent('li').addClass('active');

        var page = $(this).attr('href').split('page=')[1];
        getData(page);
    });
  
    function getData(page=null){
        let q=$('#search').val();
        let start=$('#start').val();
        let end=$('#end').val();

        let exstart=$('#exstart').val();
        let exend=$('#exend').val();

        let type_id=$('#type_id').val();
    
        $('#member_data').html('');
        $.ajax({
            url: '{{ route("admin.memberships.index")}}?page='+page,
            type: 'GET',
            data:{q,start,end,exstart,exend,type_id},
            dataType: 'json',
            success: function(data) {
                $('#member_data').html(data.html);
            }
        });
    }
  });
</script>
@endpush