<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-light">
            <tr>
                <th>{{ __('cloth.Sl') }}</th>
                <th>{{ __('cloth.Invoice No') }}</th>
                <th>{{ __('cloth.Date') }}</th>
                <th>{{ __('cloth.Customer') }}</th>
                <th>{{ __('cloth.Phone') }}</th>
                <th>{{ __('cloth.Created By') }}</th>
                <th>{{ __('cloth.Status') }}</th>
                <th>{{ __('cloth.Payment Status') }}</th>
                <th>{{ __('cloth.Amount') }}</th>
                <th>{{ __('cloth.Paid Amount') }}</th>
                <th>{{ __('cloth.Deliver') }}</th>
                <th style="width: 155px;">{{ __('cloth.Action') }}</th>
            </tr>
        </thead>

        <tbody> 
            @foreach($items as $key=>$item)
            <tr>
                <td>{{ $key+1}}</td>
                <td>{{ $item->invoice_no}}</td>
                <td>{{ $item->order_date}}</td>
                <td>{{ $item->customer_name}}</td>
                <td>{{ $item->phone}}</td>
                <td>{{ $item->name}}</td>
                <td>{{ $item->status}}</td>
                <td>{{ $item->payment_status}}</td>
                <td>{{ $item->final_amount}}</td>
                <td>{{ $item->payments->sum('amount')}}</td>

                <td>
                    @if($item->status=='receive')
                    <a href="{{ route('admin.getOrderDelivery',[$item->id])}}" class="btn_modal btn btn-sm btn-success"> 
                        {{ __('cloth.Deliver') }}
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.orders.show',[$item->id])}}" class="action-icon"> 
                        <i class="fa fa-eye"></i></a>

                    @can('orders.create')
                    <a href="{{ route('admin.copyOrder',[$item->id])}}" class="action-icon"> 
                        {{ __('cloth.Copy') }}    
                    </a>
                    @endcan
                    
                    @can('orders.edit')
                    <a href="{{ route('admin.orders.edit',[$item->id])}}" class="action-icon"> 
                        <i class="fa fa-edit"></i></a>
                    @if($item->payment_status !='paid')
                    <a href="{{ route('admin.order_payments.edit',[$item->id])}}" class="action-icon btn_modal"> 
                        <i class="fa fa-list"></i></a>
                    @endif
                    @endcan
                    @can('orders.delete')
                        <a href="{{ route('admin.orders.destroy',[$item->id])}}" class="delete action-icon"> 
                            <i class="fa fa-trash"></i></a>
                    @endcan

                    

                    <a class="btn btn-info btn-sm" href="{{ route('admin.customerPrint',[$item->id])}}">{{ __('cloth.Customer Print') }}</a>

                    <div class="dropdown mt-1">
                      <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('cloth.Office Print') }}
                      </button>

                      

                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                        @foreach($item->categories as $cat)
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.officePrint',[$cat->id])}}"> {{$cat->category->name}} </a>
                        </li>
                        @endforeach

                        

                      </ul>
                    </div>

                    <div class="dropdown mt-1">
                      <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('cloth.Karigor Print') }}
                      </button>

                      

                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach($item->categories as $cat)
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.officePrint',[$cat->id])}}"> {{$cat->category->name}} </a>
                        </li>
                        @endforeach
                      </ul>
                    </div>

                </td>
                
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="8">{{ __('cloth.Total') }}</th>
                <th>{{ number_format($items->sum('final_amount'),2) }}</th>
            </tr>
        </tfoot>
    </table>
</div>
<p>{!! urldecode(str_replace("/?","?",$items->appends(Request::all())->render())) !!}</p>