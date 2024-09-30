@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('cloth.Order') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('cloth.Dashboard') }}</a></li>
            <li class="breadcrumb-item active">{{ __('cloth.Order Details') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>{{ __('cloth.Product Name') }}</th>
                                                <th>{{ __('cloth.Quantity') }}</th>
                                                <th>{{ __('cloth.Price') }}</th>
                                                <th>{{ __('cloth.Sub Total') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($item->products as $p)
                                            <tr>
                                                <td>{{ $p->product->name}}</td>
                                                <td>{{ $p->quantity}}</td>
                                                <td>{{ $p->price}}</td>
                                                <td>{{ $p->quantity* $p->price}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end col -->

                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">{{ __('cloth.Order Details') }} #{{ $item->invoice_no}}</h4>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="table-light">
                                        <tr>
                                            <th>{{ __('cloth.Description') }}</th>
                                            <th>{{ __('cloth.Price') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{ __('cloth.Grand Total') }} :</td>
                                            <td>{{ $item->amount}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('cloth.Service charge') }} :</td>
                                            <td>{{ $item->service_charge}}</td>
                                        </tr>
                                       

                                        @if($item->discount_amount)
                                        <tr>
                                            <td>{{ __('cloth.Discount') }} : </td>
                                            <td>{{ $item->discount_amount}}</td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <th>{{ __('cloth.Total') }} :</th>
                                            <th>{{ $item->amount}}</th>
                                        </tr>

                                        <tr>
                                            <th>{{ __('cloth.Paid Amount') }}:</th>
                                            <th>{{$item->payments->sum('amount')}}</th>
                                        </tr>

                                        <tr>
                                            <th>{{ __('cloth.Dui Amount') }}:</th>
                                            <th>{{ $item->amount - $item->payments->sum('amount')}}</th>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->

                            </div>
                        </div>
                    </div> <!-- end col -->


                    @if($item->customer)
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">{{ __('cloth.Customer Info:') }}</h4>

                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <p class="mb-2"><span class="fw-bold me-2">{{ __('cloth.Name') }}:</span> {{$item->customer->name}}</p>
                                        <p class="mb-2"><span class="fw-bold me-2">{{ __('cloth.Phone') }}:</span> {{$item->customer->phone}}</p>
                                        <p class="mb-2"><span class="fw-bold me-2">{{ __('cloth.Email') }}:</span> {{$item->customer->email}}</p>
                                        <p class="mb-2"><span class="fw-bold me-2">{{ __('cloth.Address') }}:</span> {{$item->customer->address}}</p>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div> <!-- end col -->
                    @endif
                    @if($item->payments->count())
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">{{ __('cloth.Payment information') }}</h4>

                                
                                <div class="text-center">
                                    <table class="table">
                                        <tr>
                                            <th>{{ __('cloth.Payment information') }}</th>
                                            <th>{{ __('cloth.Method') }}</th>
                                            <th>{{ __('cloth.Note') }}</th>
                                        </tr>
                                        @foreach($item->payments as $pay)
                                        <tr>
                                            <td>{{ $pay->method}}</td>
                                            <td>{{ $pay->amount}}</td>
                                            <td>{{ $pay->note}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div> <!-- end col -->
                    @endif


                    
                </div>
                <!-- end row -->

            </div>
        </div>
    </div>
</main>
                
@endsection

