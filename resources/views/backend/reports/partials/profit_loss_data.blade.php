<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        @php
            $profit=$items->whereIn('type',['income','sell','order'])
                            ->sum('amount') - $items->whereIn('type',['purchase','expense'])
                            ->sum('amount') - $worker_total_paid -$employee_total_paid;
        @endphp
        <tbody> 
            
            <tr>
                <th> {{ __('report.Total Order Amount') }} (+)</th>
                <td class="amount">{{ $items->where('type','order')->sum('amount')}}</td>
            </tr>

            <tr>
                <th> {{ __('report.Total Product Sell Amount') }} (+)</th>
                <td class="amount">{{ $items->where('type','sell')->sum('amount')}}</td>
            </tr>

            <tr>
                <th> {{ __('report.Total Income Amount') }} (+)</th>
                <td class="amount">{{ $items->where('type','income')->sum('amount')}}</td>
            </tr>

            <tr>
                <th> {{ __('report.Total Purchase Amount') }} (-)</th>
                <td class="amount">{{ $items->where('type','purchase')->sum('amount')}}</td>
            </tr>

            <tr>
                <th> {{ __('report.Total Expense Amount') }} (-)</th>
                <td class="amount">{{ $items->where('type','expense')->sum('amount')}}</td>
            </tr>

            <tr>
                <th> {{ __('report.Total Worker Payment') }} (-)</th>
                <td class="amount">{{ $worker_total_paid }}</td>
            </tr>

            <tr>
                <th> {{ __('report.Total Employee Payment') }} (-)</th>
                <td class="amount">{{ $employee_total_paid}}</td>
            </tr>

            

            <tr class="bg-info">
                <th> {{ __('report.Total Profit Loss') }} </th>
                <td class="amount">{{ $profit }}</td>
            </tr>

            
        </tbody>
    </table>
</div>