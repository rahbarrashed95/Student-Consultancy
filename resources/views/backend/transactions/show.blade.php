@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"> {{ __('expanse_and_income.Order') }} </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('expanse_and_income.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('expanse_and_income.Order Details') }} </li>
        </ol>

        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        @foreach($item->categories as $cat)
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>{{ __('expanse_and_income.Item Name') }}</th>
                                                <th>{{ __('expanse_and_income.Quantity') }}</th>
                                                <th>{{ __('expanse_and_income.Price') }}</th>
                                                <th>{{ __('expanse_and_income.Sub Total') }}</th>
                                            </tr>
                                        </thead> 
                                        <tbody>

                                            <tr>
                                                <td>{{ $cat->category->name}}</td>
                                                <td>{{ $cat->quantity}}</td>
                                                <td>{{ $cat->price}}</td>
                                                <td>{{ $cat->quantity* $cat->price}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <p>{{ __('expanse_and_income.Measurement') }}:</p>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="table-light">
                                            
                                            <tr>
                                                @foreach($cat->measurements as $mea)
                                                <th>{{ $mea->measurement->name}}</th>
                                                @endforeach
                                            </tr>
                                            
                                        </thead>
                                        <tbody>

                                            
                                            <tr>
                                                @foreach($cat->measurements as $mea)
                                                <td>{{ $mea->value}}</td>
                                                @endforeach
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>


                                <!-- end table-responsive -->

                            </div>
                        </div>
                        @endforeach
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>{{ __('expanse_and_income.Product Name') }}</th>
                                                <th>{{ __('expanse_and_income.Quantity') }}</th>
                                                <th>{{ __('expanse_and_income.Price') }}</th>
                                                <th>{{ __('expanse_and_income.Sub Total') }}</th>
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
                                <h4 class="header-title mb-3">{{ __('expanse_and_income.Order Details') }} #{{ $item->invoice_no}}</h4>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="table-light">
                                        <tr>
                                            <th>{{ __('expanse_and_income.Description') }}</th>
                                            <th>{{ __('expanse_and_income.Price') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{ __('expanse_and_income.Grand Total') }} :</td>
                                            <td>{{ $item->final_amount}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('expanse_and_income.Service charge') }} :</td>
                                            <td>{{ $item->service_charge}}</td>
                                        </tr>
                                       

                                        @if($item->discount_amount)
                                        <tr>
                                            <td>{{ __('expanse_and_income.Discount') }} : </td>
                                            <td>{{ $item->discount_amount}}</td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <th>{{ __('expanse_and_income.Total') }} :</th>
                                            <th>{{ $item->final_amount}}</th>
                                        </tr>

                                        <tr>
                                            <th>{{ __('expanse_and_income.Total Paid') }}:</th>
                                            <th>{{$item->payments->sum('amount')}}</th>
                                        </tr>

                                        <tr>
                                            <th>{{ __('expanse_and_income.Total Due') }}:</th>
                                            <th>{{ $item->final_amount - $item->payments->sum('amount')}}</th>
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
                                <h4 class="header-title mb-3">{{ __('expanse_and_income.Customer Info:') }}</h4>

                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <p class="mb-2"><span class="fw-bold me-2">{{ __('expanse_and_income.Customer') }}:</span> {{$item->customer->name}}</p>
                                        <p class="mb-2"><span class="fw-bold me-2">{{ __('expanse_and_income.Phone') }}:</span> {{$item->customer->phone}}</p>
                                        <p class="mb-2"><span class="fw-bold me-2">{{ __('expanse_and_income.Email') }}:</span> {{$item->customer->email}}</p>
                                        <p class="mb-2"><span class="fw-bold me-2">{{ __('expanse_and_income.Address') }}:</span> {{$item->customer->address}}</p>
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
                                <h4 class="header-title mb-3">{{ __('expanse_and_income.Payment Info:') }}</h4>

                                
                                <div class="text-center">
                                    <table class="table">
                                        <tr>
                                            <th>{{ __('expanse_and_income.Method') }}</th>
                                            <th>{{ __('expanse_and_income.Amount') }}</th>
                                            <th>{{ __('expanse_and_income.Note') }}</th>
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

