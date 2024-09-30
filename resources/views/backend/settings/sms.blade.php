@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Sms Setting</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Sms Setting Manage</li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Sms Setting Manage
            </div>
            <div class="card-body">
                <form action="{{route('admin.sms_settings.store')}}" method="POST" enctype="multipart/form-data" id="ajax_form">
                    @csrf
                    <div class="row">
                
                        <div class="col-md-3">
                            <div class="form-group">
                                <strong >Url </strong>
                                <input type="text" class="form-control" name="url" value="{{ $item?$item->url:'' }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <strong >send to parameter</strong>
                                <input type="text" class="form-control" name="send_to" value="{{ $item?$item->send_to:'' }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <strong >message parameter</strong>
                                <input type="text" class="form-control" name="message" value="{{ $item?$item->message:'' }}">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <strong for="alternative_conatct">Method </strong>
                                <select name="method" class="form-control">
                                    <option value="post" {{ $item && $item->method=='post' ?'selected':''}}>POST</option>
                                    <option value="get" {{ $item && $item->method=='get' ?'selected':''}}>GET</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="alternative_conatct"> Key Name 1 </strong>
                                <input type="text" class="form-control" name="key_1" value="{{ $item?$item->key_1:'' }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="alternative_conatct"> Key Value 1 </strong>
                                <input type="text" class="form-control" name="key_value_1" value="{{ $item?$item->key_value_1:'' }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="alternative_conatct"> Key Name 2 </strong>
                                <input type="text" class="form-control" name="key_2" value="{{ $item?$item->key_2:'' }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="alternative_conatct"> Key Value 2 </strong>
                                <input type="text" class="form-control" name="key_value_2" value="{{ $item?$item->key_value_2:'' }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="alternative_conatct"> Key Name 3 </strong>
                                <input type="text" class="form-control" name="key_3" value="{{ $item?$item->key_3:'' }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="alternative_conatct"> Key Value 3 </strong>
                                <input type="text" class="form-control" name="key_value_3" value="{{ $item?$item->key_value_3:'' }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="alternative_conatct"> Key Name 4 </strong>
                                <input type="text" class="form-control" name="key_4" value="{{ $item?$item->key_4:'' }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="alternative_conatct"> Key Value 4 </strong>
                                <input type="text" class="form-control" name="key_value_4" value="{{ $item?$item->key_value_4:'' }}">
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

