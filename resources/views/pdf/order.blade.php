<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Print</title>
</head>
<body>
<div style="background-color:#d5e3e4;border-style: solid;">
	<table style="font-size:12px;width:100%;">

	<tr>
	<td colspan="4" align="center" style=" font-size:22px;"><b>Official Order : Motor Accident Group</b></td>
	</tr>
	<tr>
	<td colspan="4"  align="center"></td>
	</tr>
	<tr>
	<td colspan="4"><hr/></td>
	</tr>
	<tr>
	<td><b>Placed by</b></td><td style="width:160px;">:{{$user}}</td><td style="width:90px;"><b>Email</b></td><td style="width:200px;">:{{$email}}</td>
	</tr>
	<tr>
	<td><b>Cell</b></td><td style="width:160px;">:{{$tel}}</td><td><b>Date</b></td><td>:{{$date}}</td>
	</tr>
	<tr><td colspan="4"></td></tr>
	<tr><td><b>Vehicle</b> </td><td>:{{$make}}</td><td><b>Vehicle Year</b></td><td>:{{$veh}}</td></tr>
	<tr><td><b>Color</b></td> <td>:{{$color}} </td><td><b>VIN:</b></td><td>:{{$vin}}</td></tr>
	<tr><td><b>Engine No</b></td><td>:{{$engine}}</td><td><b>Reference:</b></td> <td>:{{$key}}</td></tr>

	</table>
</div>

<br>

<div style="background-color:#d5e3e4;border-style: solid" border="1">
<table style="font-size:12px;">
<tr>
	<td style="width:100px;"><b>Supplier</a></td> 
	<td style="width:250px;">:{{$supplier}} </td>
	<td style="width:80px;"></td>
	<td></td>
</tr>
<tr>
	<td style="width:100px;"><b>To</b></td> 
	<td>: {{$supplier_email}}</td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td style="width:100px;"><b>Tel</b></td> 
	<td>:{{$tel}}</td>
	<td style="width:80px;"><b>Fax</b> </td>
	<td style="width:180px;">:{{$tel}} </td>
</tr>
</table>
</div>

<br>

<table style="border-collapse: collapse;font-style: normal;border-style: solid;" border="1" width="100%">
<tr>
	<td colspan="3"><b>Please Supply The Undermentioned Goods Per:</b></td>
</tr>
<thead>
	<tr style="background-color:#d5e3e4;font-size:17px;">
		<th>Quantity</th>
		<th>Description</th>
		<th>Comment</th>
	</tr>
</thead>
	@foreach($parts as $part)
		<tr>
			<td>{{$part->quantity}}</td>
			<td>{{$part->Description_2}}</td>
			<td>{{$part->comments}}</td>
		</tr>
	@endforeach
</table><br><br>

<div style="border-style: solid" border="1">
<table width="100%">
<tr>
<td colspan="4" rowspan="3" style="font-size:14px;font-style: normal;">
	<b>Note:</b> To be accompanied by invoice or delivery note bearing above order No:<b>{{$key}}</b><br>
	Please Note Invoice Must Be Made To Motor Accident Group With Order Number To Be Paid<br><br>
	<b><u>Follow up date :</u> {{$follow1}}&nbsp;	 <u>Follow up date :</u>{{$follow2}}&nbsp;	 <u>Follow up date :{{$follow3}}</u> </b>
</td>
</tr>
</table>
@if($vin=="" || $vin==0)
<h1 style="color:red;text-align:center;"><b></b></h1>

</div>

@endif
</body>
</html>