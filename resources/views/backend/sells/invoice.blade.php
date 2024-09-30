<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title> {{ getInfo('name')}} </title>
    
    <style>
    
    body{margin-top:20px;
        color: #2e323c;
        background: #f5f6fa;
        position: relative;
        height: 100%;
    }
    .invoice-container {
        padding: 1rem;
    }
    .invoice-container .invoice-header .invoice-logo {
        margin: 0.8rem 0 0 0;
        display: inline-block;
        font-size: 1.6rem;
        font-weight: 700;
        color: #2e323c;
    }
    .invoice-container .invoice-header .invoice-logo img {
        max-width: 130px;
    }
    .invoice-container .invoice-header address {
        font-size: 0.8rem;
        color: #9fa8b9;
        margin: 0;
    }
    .invoice-container .invoice-details {
        margin: 1rem 0 0 0;
        padding: 1rem;
        line-height: 180%;
        background: #f5f6fa;
    }
    .invoice-container .invoice-details .invoice-num {
        text-align: right;
        font-size: 0.8rem;
    }
    .invoice-container .invoice-body {
        padding: 1rem 0 0 0;
    }
    .invoice-container .invoice-footer {
        text-align: center;
        font-size: 0.7rem;
        margin: 5px 0 0 0;
    }
    
    .invoice-status {
        text-align: center;
        padding: 1rem;
        background: #ffffff;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        margin-bottom: 1rem;
    }
    .invoice-status h2.status {
        margin: 0 0 0.8rem 0;
    }
    .invoice-status h5.status-title {
        margin: 0 0 0.8rem 0;
        color: #9fa8b9;
    }
    .invoice-status p.status-type {
        margin: 0.5rem 0 0 0;
        padding: 0;
        line-height: 150%;
    }
    .invoice-status i {
        font-size: 1.5rem;
        margin: 0 0 1rem 0;
        display: inline-block;
        padding: 1rem;
        background: #f5f6fa;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
    }
    .invoice-status .badge {
        text-transform: uppercase;
    }
    
    @media (max-width: 767px) {
        .invoice-container {
            padding: 1rem;
        }
    }
    
    
    .custom-table {
        border: 1px solid #e0e3ec;
    }
    .custom-table thead {
        background: #007ae1;
    }
    .custom-table thead th {
        border: 0;
        color: #ffffff;
    }
    .custom-table > tbody tr:hover {
        background: #fafafa;
    }
    .custom-table > tbody tr:nth-of-type(even) {
        background-color: #ffffff;
    }
    .custom-table > tbody td {
        border: 1px solid #e6e9f0;
    }
    
    
    .card {
        background: #ffffff;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 0;
        margin-bottom: 1rem;
    }
    
    .text-success {
        color: #00bb42 !important;
    }
    
    .text-muted {
        color: #9fa8b9 !important;
    }
    
    .custom-actions-btns {
        margin: auto;
        display: flex;
        justify-content: flex-end;
    }
    
    .custom-actions-btns .btn {
        margin: .3rem 0 .3rem .3rem;
    }
</style>

  </head>
  <body>
    
    <div class="container">
    <div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="card-body p-0">
					<div class="invoice-container">
						<div class="invoice-header">
							<!-- Row start -->
							
							<!-- Row end -->
							<!-- Row start -->
							<div class="row gutters">
								<div class="col-xl-6 col-lg-6 col-md-12 col-xs-12">
									<a href="{{ route('admin.sells.create')}}" class="invoice-logo">
										{{ getInfo('name')}}
									</a>
								</div>
							</div>
							<!-- Row end -->
							<!-- Row start -->
							<div class="row gutters">
								<div class="col-xl-8 col-lg-8 col-md-8 col-xs-6 col-6">
									<div class="invoice-details">
										
											<h5>{{ $item->customer->name}}</h5>
											<h5>{{ $item->customer->phone}}</h5> 
											<h5>{{ $item->customer->address}}</h5> 
										
									</div>
								</div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-xs-6 col-6">
									<div class="invoice-details">
										<div class="invoice-num">
											<div> <h4>Invoice - #{{$item->invoice_no}}</h4></div>
											<div><h5>{{$item->date}}</h5></div>
										</div>
									</div>													
								</div>
							</div>
							<!-- Row end -->
						</div>
						<div class="invoice-body">
							<!-- Row start -->
							<div class="row gutters">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="table-responsive">
										<table class="table custom-table m-0">
											<thead>
												<tr>
													<th>Items</th>
													<th>Quantity</th>
													<th>Unit Price</th>
													<th>Sub Total</th>
												</tr>
											</thead>
											<tbody>
											    @foreach($item->products as $p)
												<tr>
													<td>{{ $p->product->name}}</td>
                                                    <td>{{ $p->quantity}}</td>
                                                    <td>{{ $p->price}}</td>
                                                    <td>{{ $p->quantity* $p->price}}</td>
												</tr>
												@endforeach
								
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>
														<p>
															Subtotal<br>
															@if($item->discount_amount)
															Discount
															@endif
														</p>
														<h5 class="text-success"><strong>Grand Total</strong></h5>
														<h6 class="text-primary"><strong>Total Paid</strong></h6>
														<h6 class="text-danger"><strong>Total Due</strong></h6>
													</td>			
													<td>
														<p>
															{{$item->amount}}<br>
															@if($item->discount_amount)
															{{$item->discount_amount}}
															@endif
															
															
														</p>
														<h5 class="text-success"><strong>{{ number_format($item->amount,2)}}</strong></h5>
														<h5 class="text-primary"><strong>{{ number_format($item->payments->sum('amount'),2)}}</strong></h5>
														<h5 class="text-danger"><strong> {{ number_format($item->amount - $item->payments->sum('amount'),2)}} </strong></h5>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- Row end -->
						</div>
						<div class="invoice-footer">
							<h6>Thank you for your Purchase.</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    
    <script type="text/javascript">
    <!--
    window.print();
    //-->
    </script>
  </body>
</html>


