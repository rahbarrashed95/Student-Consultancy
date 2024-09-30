@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Settings </h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('account.Dashboard') }}</a></li>
            <li class="breadcrumb-item active">Settings</li>
        </ol>


        <div class="card mb-4">
   
            <div class="card-body">
                <form action="{{route('admin.business.store')}}" method="POST" enctype="multipart/form-data" id="ajax_form">
                    @csrf
                    <div class="row">
                
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="last_name">{{ __('account.Site Name') }}</strong>
                                <input type="text" id="last_name" class="form-control" name="name" placeholder="Full name..." value="{{ $item?$item->name:'' }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="email">{{ __('account.Email Address') }}</strong>
                                <input type="text" id="email" class="form-control" name="email" placeholder="Email Address" value="{{ $item?$item->email:'' }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="contact"> {{ __('account.Contact Number') }} </strong>
                                <input type="text" id="contact" class="form-control" name="contact" placeholder="Contact Number " value="{{ $item?$item->contact:'' }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="alternative_conatct">{{ __('account.Contact Phone') }} </strong>
                                <input type="text" id="alternative_conatct" class="form-control" name="alternative_conatct" placeholder="ALterNative Contact Number " value="{{ $item?$item->alternative_conatct:'' }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="alternative_conatct"> {{ __('account.Address') }} </strong>
                                <textarea placeholder="Address" name="address" class="form-control">{{ $item?$item->address:'' }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="alternative_conatct"> {{ __('account.Description') }} </strong>
                                <textarea placeholder="Description" name="note" class="form-control">{{ $item?$item->note:'' }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="alternative_conatct"> {{ __('account.Site Logo') }} </strong>
                                <input type="file" name="logo" class="form-control">
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

