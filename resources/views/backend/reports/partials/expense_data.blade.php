<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-light">
            <tr>
                <th>{{ __('order.Sl') }}</th>
                <th>Ref No </th>
                <th>{{ __('order.Date') }}</th>
                <th>{{ __('order.Created By') }}</th>
                <th>{{ __('order.Total Amount') }}</th>
                <th>{{ __('order.Paid Amount') }}</th>
                <th> Note </th>
            </tr>
        </thead>

        <tbody> 
            @foreach($items as $key=>$item)
            <tr>
                <td>{{ $key+1}}</td>
                <td>{{ $item->invoice_no}}</td>
                <td> {{date('d-M-Y', strtotime($item->date))}}</td>
                <td>{{ $item->name}}</td>
                <td>{{ $item->amount}}</td>
                <td>{{ $item->payments->sum('amount')}}</td>
                <td>{{ $item->note}}</td>
                
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">{{ __('order.Total') }}</th>
                <th>{{ number_format($items->sum('amount'),2) }}</th>
            </tr>
        </tfoot>
    </table>
</div>
<p>{!! urldecode(str_replace("/?","?",$items->appends(Request::all())->render())) !!}</p>