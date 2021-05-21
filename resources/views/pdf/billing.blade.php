<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Billing History</title>
    
</head>
<style>
tr:nth-child(even) td {
background-color: #D3D3D3 !important;
-webkit-print-color-adjust: exact;
}
</style>

<body>
    <div style="text-align:center;text-style:underline;color:red;text-size:16px;text-decoration:underline;"><b>Motor Accident Group</h1></div>

    <br>
    <table>
        <thead style="background-color:black;color:white;font-weight:bold;font-size:12px;">
            <tr>
                <th>No.</th>
                <th>Ref</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Reg No</th>
                <th width="150px">Make</th>
                <th width="150px">Model</th>
                <th width="100px">Estimator</th>
                <th>Amount</th>
                <th>Date Created</th>
                <th>Quote Status</th>
                <th width="100px">Auth</th>
                
            </tr>
        </thead>
        <tbody style="text-size:8px;font-size:12px;text-align:center;">
        @php $counter=1;$count_array=0;@endphp
        @php $total=0;@endphp
        
        @foreach($billing as $bill)    
        @php
        
        if(empty($status_array[$count_array])):
            $foto=0;
        else:
            $foto=$status_array[$count_array];
        endif;
        @endphp
        <tr>
            <td># {{$counter}}</td>
            <td>{{$bill->Key_Ref}}</td>
            <td>{{$bill->Fisrt_Name}}</td>
            <td>{{$bill->Last_Name}}</td>
            <td>{{$bill->Reg_No}}</td>
            <td>{{$bill->Make}}</td>
            <td>{{$bill->Model}}</td>
            <td>{{$bill->Estimator}}</td>
            <td>R {{$bill->amount}}</td>
            <td>{{$bill->date_created}}</td>
            <td>{{$foto}}</td>
            @if($bill->status==0)
              <td style="color:red;"><b>Not Authorized</b></td>  
            @else
            <td style="color:black;"><b>Authorized</b></td>    
            @endif
            
        </tr>
        @php $counter++; $total=$total+$bill->amount; $count_array++;@endphp
        @endforeach
        </tbody>
    </table>
    <table style="font-size:12px;">
<tr>
<td width="830px">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="5">&nbsp;</td>
<td><b>TOTAL</b></td>
<td>R {{number_format($total,2)}}</td>
</tr>
<tr>
<td colspan="5">&nbsp;</td>
<td><b>QUOTES:</b></td>
<td>{{$count_array}}</td>
</tr>
</table>
</body>


</html>    
