<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-light">
            <tr>
                <th>{{ __('order.Sl') }}</th>
                <th>{{ __('order.Invoice No') }}</th>
                <th>{{ __('order.Deliver Date') }}</th>
                <th>{{ __('order.Customer') }}</th>
                <th>{{ __('order.Phone') }}</th>
                <th>{{ __('order.Created By') }}</th>
                <th> {{ __('order.Order Status') }}</th>
                <th>{{ __('order.Payment Status') }}</th>
                <th> Order Type</th>
                <th>{{ __('order.Total Amount') }}</th>
                <th>{{ __('order.Paid Amount') }}</th>
            </tr>
        </thead>

        <tbody> 
            @foreach($items as $key=>$item)
            <tr>
                <td>{{ $key+1}}</td>
                <td>{{ $item->invoice_no}}</td>
                <td> {{date('d-M-Y', strtotime($item->delivery_date))}}</td>
                <td>{{ $item->customer_name}}</td>
                <td>{{ $item->phone}}</td>
                <td>{{ $item->name}}</td>
                <td>{{ getOrderStatus($item->status)}}</td> 
                <td>{{ $item->payment_status}}</td>
                <td>{{ $item->order_type}}</td>
                <td>{{ $item->amount}}</td>
                <td>{{ $item->payments->sum('amount')}}</td>
                
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="9">{{ __('order.Total') }}</th>
                <th>{{ number_format($items->sum('amount'),2) }}</th>
            </tr>
        </tfoot>
    </table>
</div>
<p>{!! urldecode(str_replace("/?","?",$items->appends(Request::all())->render())) !!}</p>