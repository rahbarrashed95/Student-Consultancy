<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-light">
            <tr>
                <th>{{ __('report.Sl') }}</th>
                <th>{{ __('report.Invoice No') }}</th>
                <th>{{ __('report.Date') }}</th>
                <th>{{ __('report.Category') }}</th>
                <th>{{ __('report.Customar Name') }}</th>
                <th>{{ __('report.Phone') }}</th>
                <th>{{ __('report.Quantity') }}</th>
                <th>{{ __('report.Customar Amount') }}</th>
                <th>{{ __('report.Total Customar Amount') }}</th>
                <th>{{ __('report.Worker Rate') }}</th>
                <th>{{ __('report.Total Worker Rate') }}</th>
                <th>{{ __('report.Total Profit Loss') }}</th>
            </tr>
        </thead>

        <tbody> 
            @foreach($items as $key=>$item)
            <tr>
                <td>{{ $key+1}}</td>
                <td>{{ $item->invoice_no}}</td>
                <td>{{ dateFormate($item->created_at)}}</td>
                <td>{{ $item->category}}</td>
                <td>{{ $item->customer}}</td>
                <td>{{ $item->phone}}</td>
                <td>{{ $item->quantity}}</td>
                <td>{{ $item->price}}</td>
                <td>{{ $item->sub_total}}</td>
                <td>{{ $item->p_price}}</td>
                <td>{{ $item->sub_total_p}}</td>
                <td>{{ $item->profit}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6">{{ __('report.Total') }}</th>
                <th>{{ number_format($items->sum('quantity'),2) }}</th>
                <th>{{ number_format($items->sum('price'),2) }}</th>
                <th>{{ number_format($items->sum('sub_total'),2) }}</th>
                <th>{{ number_format($items->sum('p_price'),2) }}</th>
                <th>{{ number_format($items->sum('sub_total_p'),2) }}</th>
                <th>{{ number_format($items->sum('profit'),2) }}</th>
            </tr>
        </tfoot>
    </table>
</div>
<p>{!! urldecode(str_replace("/?","?",$items->appends(Request::all())->render())) !!}</p>