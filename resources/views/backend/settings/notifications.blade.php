@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Notification Temaplte</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Notification Temaplte Manage</li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Notification Temaplte Manage
            </div>
            <div class="card-body">
                <form action="{{route('admin.notification_tamplates.store')}}" method="POST" enctype="multipart/form-data" id="ajax_form">
                    @csrf
                    <div class="row">
                
                        <div class="col-md-3">
                            <div class="form-group">
                                <strong for="alternative_conatct">Type </strong>
                                <select name="type" class="form-control">
                                    <option value="payment" {{ $item && $item->type=="payment"?'selected':''}}>Payment</option>
                                    <option value="order" {{ $item && $item->type=="order"?'selected':''}}>Order</option>
                                    <option value="sell" {{ $item && $item->type=="sell"?'selected':''}}>Sell</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-8">
                            <div class="form-group">
                                <strong >message body</strong>
                                <textarea class="form-control" name="body">{{ $item?$item->body:'' }}</textarea>
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

