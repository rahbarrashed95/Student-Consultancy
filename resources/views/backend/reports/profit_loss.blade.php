@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4"> {{ __('report.Profit Loss') }} </h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('report.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('report.Profit Loss Report') }} </li>
        </ol>

        <div class="card mb-4">
            
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div  class="col-sm-5 no-print">
                                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span></span> <i class="fa fa-caret-down"></i>
                                </div>

                                <input type="hidden"  id="start_date">
                                <input type="hidden"  id="end_date">

                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 mt-2" id="profit_loss_data">
                        
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</main>
                
@endsection

@push('js')


<script type="text/javascript">
  $(document).ready(function () {
    

    $(function() {

        var start = moment().startOf('year');
        var end = moment().endOf('year');

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

            $("#start_date").val(start.format("YYYY-MM-DD"));
            $("#end_date").val(end.format("YYYY-MM-DD"));

            getData();
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
               'This Year': [moment().startOf('year'), moment().endOf('year')],
               'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
            
            }

        }, cb);

        cb(start, end);

    });
    

  
    function getData(){
        let start=$('#start_date').val();
        let end=$('#end_date').val();
    
        $('#profit_loss_data').html('');
        $.ajax({
            url: '{{ route("admin.reports.profitLoss")}}',
            type: 'GET',
            data:{start,end},
            dataType: 'json',
            success: function(data) {
                $('#profit_loss_data').html(data.html);

                $(document).find('.amount').each(function() {
                    let price=$(this).text();
                    price=Number(price).toLocaleString('en');
                    $(this).text(price);

                });

            }
        });
    }
  });
</script>
@endpush