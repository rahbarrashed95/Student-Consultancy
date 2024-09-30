@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">  Payment </h3>
        
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('staff.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> Payment List</li>
        </ol>

        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('staff.Sl') }}</th> 
                                        <th>Date</th>
                                        <th>Member Name</th>
                                        <th>Member Phone</th>
                                        <th>Method</th>
                                        <th>Amount</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>
                                        <td> {{$key+1}}</td>
                                        <td> {{dateFormate($item->date)}}</td>
                                        <td> {{$item->membership?$item->membership->name:''}}</td>
                                        <td> {{$item->membership?$item->membership->phone:''}}</td>
                                        
                                        <td> {{$item->method}}</td>
                                        <td> {{$item->amount}}</td>
                                        
                                        <td> {{$item->note}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
                
@endsection

