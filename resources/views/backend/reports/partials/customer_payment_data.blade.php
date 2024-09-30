<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-light">
            <tr>
                <th>{{ __('report.Sl') }}</th>
                <th>{{ __('report.Invoice No') }}</th>
                <th>{{ __('report.Date') }}</th>
                <th>{{ __('report.Customar Name') }}</th>
                <th>{{ __('report.Phone') }}</th>
                <th>{{ __('report.Created By') }}</th>
                <th> {{ __('report.Note') }} </th>
                <th>{{ __('report.Amount') }}</th>
                <th>{{ __('report.Category') }}</th>
            </tr>
        </thead>

        <tbody> 
            @foreach($items as $key=>$item)
            <tr>
                <td>{{ $key+1}}</td>
                <td>{{ $item->invoice_no}}</td>
                <td>{{ dateFormate($item->date)}}</td>
                <td>{{ $item->supplier}}</td>
                <td>{{ $item->phone}}</td>
                <td>{{ $item->name}}</td>
                <td>{{ $item->note}}</td>
                <td>{{ $item->amount}}</td>
                <td>{{ $item->type}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="7">{{ __('report.Total') }}</th>
                <th>{{ number_format($items->sum('amount'),2) }}</th>
            </tr>
        </tfoot>
    </table>
</div>
<p>{!! urldecode(str_replace("/?","?",$items->appends(Request::all())->render())) !!}</p>