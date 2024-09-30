<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-light">
            <tr>
                <th>{{ __('report.Sl') }}</th>
                <th>{{ __('report.Product Name') }}</th>
                <th>{{ __('report.Product SKU') }}</th>
                <th>{{ __('report.Total Purchase') }}</th>
                <th>{{ __('report.Total sell') }}</th>
                <th>{{ __('report.Current Stock') }}</th>
                <th>{{ __('report.Purchase Amount') }}</th>
                <th>{{ __('report.Total Purchase Amount') }}</th>
                <th>{{ __('report.Total Sell Amount') }}</th>
            </tr>
        </thead>

        <tbody> 
            @foreach($items as $key=>$item)
            <tr>
                <td>{{ $key+1}}</td>
                <td>{{ $item->name}}</td>
                <td>{{ $item->sku}}</td>
                <td>{{ $item->total_purchase}}</td>
                <td>{{ $item->total_sell}}</td>
                <td>{{ $item->quantity}}</td>
                <td>{{ $item->purchase_price}}</td>
                <td>{{$item->quantity * $item->purchase_price}}</td>
                <td>{{ $item->sell_price}}</td>
                
                
                
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">{{ __('report.Total') }}</th>
                <th>{{ number_format($items->sum('total_purchase'),2) }}</th>
                <th>{{ number_format($items->sum('total_sell'),2) }}</th>
                <th>{{ number_format($items->sum('quantity'),2) }}</th>
                <th>{{ number_format($items->sum('purchase_price'),2) }}</th>
                <th>
                    @php
                    $pp = $items->sum('purchase_price');
                    $q = $items->sum('quantity');
                    $t_pp= $q*$pp;
                    @endphp
                    {{$t_pp}}
                </th>
                <th>{{ number_format($items->sum('sell_price'),2) }}</th>
                
                
                
            </tr>
        </tfoot>
    </table>
</div>
<p>{!! urldecode(str_replace("/?","?",$items->appends(Request::all())->render())) !!}</p>