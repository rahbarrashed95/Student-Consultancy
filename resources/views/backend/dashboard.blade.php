@extends('backend.partials.app')
@push('css')

@endpush
@section('content')

<style>
.number_div {
    border-radius: 50%;
    height: 200px;
    width: 200px;
}
.bottom_number {
    margin-top: 62px;
}
.top_text {
    font-weight: 700;
    margin-bottom: 20px;
}
</style>

<h3 class="text-dark mb-4 text-center top_text">Dashboard</h3>
<div class="row g-6 mb-6 dashboard-cards">
    <div class="col-xl-2 col-sm-6 col-12 mb-3">
        <div class="card shadow border-0 gr-primary number_div">
            <div class="card-body">
                <div class="row bottom_number">
                    <div class="col text-center">
                        <span class="h6 font-semibold text-light text-sm d-block mb-2">Total Sell</span>
                        <span class="h3 font-bold mb-0" id="total_sell">0</span>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-sm-6 col-12 mb-3">
        <div class="card shadow border-0 gr-info number_div">
            <div class="card-body bottom_number">
                <div class="row">
                    <div class="col text-center">
                        <span class="h6 font-semibold text-white text-sm d-block mb-2">Total Expense</span>
                        <span class="h3 font-bold mb-0 text-white" id="total_expense">0</span>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-sm-6 col-12 mb-3">
        <div class="card shadow border-0 gr-warning number_div">
            <div class="card-body">
                <div class="row bottom_number">
                    <div class="col text-center">
                        <span class="h6 font-semibold text-white text-sm d-block mb-2">Total Member</span>
                        <span class="h3 font-bold mb-0 text-white" id="total_member">0</span>
                    </div>                    
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-2 col-sm-6 col-12 mb-3">
        <div class="card shadow border-0 gr-primary number_div">
            <div class="card-body">
                <div class="row bottom_number">
                    <div class="col text-center">
                        <span class="h6 font-semibold text-white text-sm d-block mb-2"> Total Member Payment</span>
                        <span class="h3 font-bold mb-0" id="membership_payment">0</span>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-sm-6 col-12 mb-3">
        <div class="card shadow border-0 gr-success number_div">
            <div class="card-body">
                <div class="row bottom_number">
                    <div class="col text-center">
                        <span class="h6 font-semibold text-white text-sm d-block mb-2"> Total Member Payment</span>
                        <span class="h3 font-bold mb-0" id="membership_payment">0</span>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-sm-6 col-12 mb-3">
        <div class="card shadow border-0 gr-danger number_div">
            <div class="card-body">
                <div class="row bottom_number">
                    <div class="col text-center">
                        <span class="h6 font-semibold text-white text-sm d-block mb-2"> Total Member Payment</span>
                        <span class="h3 font-bold mb-0" id="membership_payment">0</span>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    
</div>
<div class="row mt-3">
    <div class="col-lg-5 col-md-6 col-12 mb-3">
        <div class="card rounded-3 p-3 shadow">
            <h3>Monthly Presences</h3>
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
    </div>
    <div class="col-lg-7 col-md-12 col-12 mb-3">
        <div class="card rounded-3 p-3 shadow">
            <h3>Monthly Revenue</h3>
            <div id="growth" style="height: 370px; width: 100%;"></div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
    
    $(document).ready(function(){

        let url='{{ route("admin.dashboard")}}';
        $.ajax({
           type:'GET',
           url:url,
           data:{},
           success:function(res){
                $('span#total_sell').text(res.total_sell);
                $('span#total_member').text(res.total_member);
                $('span#membership_payment').text(res.membership_payment);
                $('span#total_expense').text(res.total_expense);
           }
        });


    })
</script>
@endpush
