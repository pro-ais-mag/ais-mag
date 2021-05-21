<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Feedback Print</title>
    
</head>
<style>
tr:nth-child(even) td {
background-color: #D3D3D3 !important;
-webkit-print-color-adjust: exact;
}
</style>

<body>
    <div style="text-align:center;text-style:underline;color:red;text-size:16px;text-decoration:underline;"><b><h1>Motor Accident Group</h1></b></div>

    <br>
    <table>
        <thead style="background-color:#D3D3D3;text-decoration:underline;">
            <tr>
                <th>#</th>
                <th>Ref</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Reg No</th>
                <th>Make</th>
                <th>Model</th>
                <th>Comment Type</th>
                <th>Comment Notes</th>
                                
            </tr>
        </thead>
        <tbody style="text-size:8px;font-size:12px">
        @php $counter=1;@endphp
        @php $total=0;@endphp
        @foreach($feedback as $bill)    
        <tr>
            <td>{{$counter}}</td>
            <td>{{$bill->Key_Ref}}</td>
            <td>{{$bill->Fisrt_Name}}</td>
            <td>{{$bill->Last_Name}}</td>
            <td>{{$bill->Reg_No}}</td>
            <td>{{$bill->Make}}</td>
            <td>{{$bill->Model}}</td>
            <td>R {{$bill->comment_type}}</td>
            <td>{{$bill->comment_note}}</td>
            
        </tr>
        @php $counter++;@endphp
        @endforeach
        </tbody>
    </table>
    <br><br>
    <div style="text-align:center;text-style:underline;color:red;text-size:16px;text-decoration:underline;"><b><h1>Client Feedback Stats</h1></b></div>
    <table>
        <thead style="background-color:#D3D3D3;text-decoration:underline;width:300px;">
                <tr>
                    <th>Happy</th>
                    <th>Unavailiable</th>
                    
                    
                    <th>Workmanship</th>
                    <th>Communication</th>
                    <th>Other</th>
                </tr>
        </thead>
        <tbody style="text-size:8px;font-size:12px;text-align:center;width:300px;color:red;">
                <tr>
                    <td>{{$happy}}</td>
                    <td>{{$unavailiable}}</td>
                    
                    <td>{{$workman}}</td>
                    <td>{{$comm}}</td>
                    <td>{{$other}}</td>
                    
                </tr>
        </tbody>
    </table>
</body>


</html>    
