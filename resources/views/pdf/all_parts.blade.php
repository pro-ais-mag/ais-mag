<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print All Parts</title>
</head>
<body>
<table style="font-family:; font-size:11px;width:100%;">
<tr><td></td> <td style="width:160px;"></td><td></td> <td></td></tr>

<tr><td><h2><u>PARTS LIST</u></h2></td> <td style="width:160px;"></td><td></td><td></td></tr>
<tr><td></td> <td style="width:160px;"></td><td></td> <td></td></tr>

<tr><td style="width:70px;text-align:right;"><b>Owner</b></td><td style="width:210px;">:{{strtoupper($owner)}}</td><td style="text-align:right;"><b>Inserer</b></td> <td>:{{strtoupper($insurer)}}</td></tr>
<tr><td style="text-align:right;"><b>Vehicle</b></td><td>:{{strtoupper($vehicle)}}</td><td style="text-align:right;"><b>Claim NO</b></td> <td>:{{$Claim_NO}}</td></tr>
<tr><td style="text-align:right;"><b>Reg No.</b></td><td>:{{strtoupper($reg)}}</td><td style="text-align:right;"><b>Assessor</b></td><td>:{{strtoupper($Assessor)}}</td></tr>
<tr>
<td style="width:70px;text-align:right;"><b>VIN</b> 	</td> 
<td style="width:210px;">:{{strtoupper($Chasses_No)}}</td>
    <td><b></b> </td>
</tr>
</table>
</hr>
<table style="width:100%;">
   <thead> 
        <tr>
            <th>No.</th>
            <th></th>
            <th>Description</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Outwork</th>
        </tr>
   </thead>
   <hr/>
   <tbody style="font-size:10px;text-align:center;">
        @php $count=1;@endphp    
        @foreach($parts_info as $parts)
        <tr>
            <td>{{$count}}</td>
            <td>{{$parts->Oper}}</td>
            <td>{{$parts->Description}}</td>
            <td>{{$parts->Quantity}}</td>
            <td>:R{{$parts->Part}}</td>
            <td>{{$parts->Misc}}</td>
        </tr>
        @php $count++;@endphp
        @endforeach
   </tbody>     
</table>

</body>
</html>