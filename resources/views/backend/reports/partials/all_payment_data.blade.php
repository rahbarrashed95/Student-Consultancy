<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-light">
            <tr>
                <th>{{ __('report.Sl') }}</th>
                <th>{{ __('report.Date') }}</th>
                <th>{{ __('report.Category') }}</th>
                <th> {{ __('report.Staff Name') }} </th>
                <th>{{ __('report.Phone') }}</th>
                <th>{{ __('report.Created By') }}</th>
                <th> {{ __('report.Note') }} </th>
                <th>{{ __('report.Amount') }}</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody> 
            @foreach($items as $key=>$item)
            <tr>
                <td>{{ $key+1}}</td>
                <td>{{ dateFormate($item->date)}}</td>
                <td>{{ $item->type==null?'payment':$item->type}}</td>
                <td>{{ $item->employee}}</td>
                <td>{{ $item->phone}}</td>
                <td>{{ $item->name}}</td>
                <td>{{ $item->note}}</td>
                <td>{{ $item->amount}}</td>
                <td>
                    <a class="btn btn-sm btn-info" href="{{ route('admin.order_payments.show',[$item->id])}}">Print</a>
                </td>
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