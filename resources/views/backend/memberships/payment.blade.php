@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4"> Membership </h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('staff.Dashboard') }}</a></li>
            <li class="breadcrumb-item active">Membership Payment</li>
        </ol>

        <div class="card mb-4">
            
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <select class="form-control select2" name="membership_id" id="membership_id">
                                <option value=""> Select One</option>
                                @foreach($items as $item)
                                <option value="{{$item->id}}"> {{$item->name}} - {{$item->phone}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12" id="form_data">

                    </div>
                </div>
                
            </div>
        </div>
    </div>
</main>
@endsection

@push('js')
<script type="text/javascript">
    
    $('#membership_id').on('change', function(){

        let id=$(this).val();
        let url="{{ route('admin.memberships.getPayment')}}";
        if(id){

            $.ajax({
               type:'GET',
               url:url,
               data:{id},
               success:function(res){
                  $('div#form_data').html(res.html);
               }
            });

        }
    })
</script>
@endpush




