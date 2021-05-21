<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Note</title>
    <style>
tr:nth-child(even) td {
background-color: #D3D3D3 !important;
-webkit-print-color-adjust: exact;
}
</style>
</head>
<body>
<div style="text-align:center;text-style:underline;color:red;text-size:16px;text-decoration:underline;"><b><h1>Client Note</h1></b></div><br>
        <table style="font-size:8;color:black;text-align:center;">
            <tr style="font-size:8;color:black">
                @foreach($client_details as $client)
                <td style="font-size:12"><b>CLIENT:</b></td>
                <td style="color:gray;font-size:10;"><b>{{$client->Fisrt_Name}} <br>{{$client->Last_Name}}</b></td>
                <td style="font-size:12"><b>REG NO.:</b></td>
                <td style="color:gray;font-size:10;"><b>{{$client->Reg_No}}</b></td>
                <td style="font-size:12"><b>TRACK ID:</b></td>
                <td style="color:gray;font-size:10;"><b>{{$client->Key_Ref}}</b></td>
                @endforeach
            </tr>
        </table>

    <p style="font-size:10;"><b>Notes</b></p>
        <table style="font-size:6;color:black;">
            <tr style="background-color:gray;font-size:12;color:white;text-align:center;">
                <td style="width:40px"><b>#</b></td>
                <td style="width:70px"><b>Date</b></td>
                <td style="width:70px"><b>Time</b></td>
                <td style="width:400px"><b>Notes</b></td>
                <td style="width:100px"><b>Added By</b></td>
            </tr>
            <tbody >
                @php $counter=1;@endphp
                @foreach($note_details as $notes)
                <tr style="text-align:center;font-size:10;">
                    <td>{{$counter}}</td>
                    <td>{{$notes->date}}</td>
                    <td>{{$notes->time}}</td>
                    <td>{{$notes->note}}</td>
                    <td>{{$notes->user}}</td>
                </tr>
                @endforeach
            </tbody>
        </table> 
</body>
</html>