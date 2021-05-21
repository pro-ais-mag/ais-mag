<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing History</title>
</head>
<body>
    <h1 style="text-align:center;">Motor Accident Group</h1>
    <h4 style="text-align:center;">History Date: {{$date}}</h4>
    <table>
    <thead>
    <tr>
    <th><h4>No.</h4></th>
    <th><h4>REF.</h4></th>
    <th><h4>First Name</h4></th>
    <th><h4>Last Name</h4></th>
    <th><h4>Reg No.</h4></th>
    <th><h4>Make</h4></th>
    <th><h4>Model</h4></th>
    <th><h4>Estimator</h4></th>
    <th><h4>Amount</h4></th>
    <th><h4>Date Created</h4></th>
    </tr>
    </thead>
    <tbody>
        @foreach($infos as $info)
        <tr>
            <td>#{{$counter}}</td>
            <td>{{$info->Key_Ref}}</td>
            <td>{{$info->Fisrt_Name}}</td>
            <td>{{$info->Last_Name}}</td>
            <td>{{$info->Reg_No}}</td>
            <td>{{$info->Make}}</td>
            <td>{{$info->Model}}</td>
            <td>{{$info->Estimator}</td>
            <td>{{$info->amount}}</td>
            <td>{{$info->date_created}}</td>
            <td></td>
            
        </tr>
        @php
        $total= $total + $amount;
        $counter++;
        @endphp
        @endforeach
    </tbody>
    </table>
    <table>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td><h4>TOTAL</h4></td>
<td><h4>{{number_format($total,2)}}</h4></td>
<td><h4>QOUTES:{{$counter}}</h4></td>
</tr>
</table>
</body>
</html>