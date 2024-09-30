<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>

	<table>
		<thead>
			<tr>
				<th>Sl No</th>
				<th>Staff Name</th>
				<th>Pament Date</th>
				<th>PamentType</th>
				<th>Pament Method</th>
				<th>Pay Amount</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($query as  $history)
			<tr>
				<td></td>
				<td>{{$history->employee?$history->employee->name:''}}</td>
				
				<td>PamentType</td>
				<td>Pament Metdod</td>
				<td>Pay Amount</td>
				<td>Action</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
</body>
</html>