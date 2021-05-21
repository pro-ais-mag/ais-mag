<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pre Booking Print</title>
    
</head>
<style>
tr:nth-child(even) td {
background-color: #D3D3D3 !important;
-webkit-print-color-adjust: exact;
}
</style>

<body>
    <div style="text-align:center;text-style:underline;color:red;text-size:16px;text-decoration:underline;"><b><h4>Pre-Booking List</h4></b></div>
    <h5 style="text-align:center;text-style:underline;color:red;text-size:16px;"><b>{{$from_date}} - {{$to_date}}</b></h5>
    <br>
    <table>
        <thead style="background-color:#D3D3D3;text-decoration:underline;font-size:12px">
            <tr>
                <th>#</th>
                <th>Ref</th>
                <th>Client</th>
                <th>Cell Number</th>
                <th>Reg No</th>
                <th>Make</th>
                <th>Estimator</th>
                <th>Insurer</th>
                <th>Booking Date(1)</th>
                <th>Booking Date(2)</th>
                <th>Booking Date(3)</th>
                <th>Booking Date(4)</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody style="text-size:8px;font-size:10px;text-align:center;">
        @php $counter=1;@endphp
        @foreach($prebooking_details as $pre_booking)    
        <tr>
            <td>{{$counter}}</td>
            <td>{{$pre_booking->Key_Ref}}</td>
            <td>{{$pre_booking->Fisrt_Name}} - {{$pre_booking->Last_Name}}</td>
            <td>{{$pre_booking->Cell_number}}</td>
            <td>{{$pre_booking->Reg_No}}</td>
            <td>{{$pre_booking->Make}} - {{$pre_booking->Model}}</td>
            <td>{{$pre_booking->Estimator}}</td>
            <td>{{$pre_booking->Inserer}}</td>
            <td>{{$pre_booking->booking_date1}}</td>
            <td>{{$pre_booking->booking_date2}}</td>
            <td>{{$pre_booking->booking_date3}}</td>
            <td>{{$pre_booking->booking_date4}}</td>
            <td style="width:155px">{{$pre_booking->comment}}</td>
        </tr>
        @php $counter++;@endphp
        @endforeach
        </tbody>
    </table>

</body>


</html>    
