@extends('backend.partials.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4"> {{ __('report.Fund Transfers') }} </h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{ __('report.Dashboard') }}</a></li>
            <li class="breadcrumb-item active"> {{ __('report.Fund Transfers Report') }} </li>
        </ol>

        <div class="card mb-4">
            
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div  class="col-md-3 no-print">
                                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span></span> <i class="fa fa-caret-down"></i>
                                </div>

                                <input type="hidden"  id="start_date">
                                <input type="hidden"  id="end_date">

                            </div>

                            <div  class="col-md-3 no-print">
                                <select class="form-control" id="type">
                                    <option value=""> {{ __('report.All') }} </option>
                                    <option value="Transfer"> {{ __('report.Transfers') }} </option>
                                    <option value="Deposit"> {{ __('report.Deposit') }} </option>
                                    <option value="Withdraw"> {{ __('report.Withdraw') }} </option>
                                </select>
                            </div>

                            <div  class="col-md-2 no-print">
                                <input type="text" id="search" class="form-control" placeholder="{{ __('report.Search') }} ..">
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 mt-2" id="transfer_data">
                        
                        
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

        var start = moment().subtract(29, 'days');
        var end = moment();

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


    $('#search').blur(function(){
        getData();
    });

    $('#type').change(function(){
        getData();
    });
    
    
    $(document).on('click', ".pagination a", function(e) {
        e.preventDefault();

        $('li').removeClass('active');
        $(this).parent('li').addClass('active');

        var page = $(this).attr('href').split('page=')[1];

        getData(page);
    });
  
    function getData(page=null){
        let q=$('#search').val();
        let start=$('#start_date').val();
        let end=$('#end_date').val();
        let type=$('#type').val();
    
        $('#transfer_data').html('');
        $.ajax({
            url: '{{ route("admin.reports.accountTransfer")}}?page='+page,
            type: 'GET',
            data:{q,start,end,type},
            dataType: 'json',
            success: function(data) {
                $('#transfer_data').html(data.html);
            }
        });
    }
  });
</script>
@endpush