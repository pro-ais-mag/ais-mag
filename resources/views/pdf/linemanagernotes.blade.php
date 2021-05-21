<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Line Manager - Notes</title>
    <style>
tr:nth-child(even) td {
background-color: #D3D3D3 !important;
-webkit-print-color-adjust: exact;
}
</style>
</head>
<body>

    <h2 style="text-align:center;color:red;">Notes -{{$key}}</h2> 
    
        <table>
            <thead style="background-color:gray;">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Notes</th>
                    <th>Added By</th>
                </tr>
            </thead>
            <tbody>
                @php $count=1;@endphp
                @foreach($notes as $note)
                <tr>
                    <td style="width:20px;">{{$count}}</td>
                    <td style="width:80px;">{{$note->date}}</td>
                    <td style="width:80px;">{{$note->time}}</td>
                    <td style="width:300px;">{{$note->note}}</td>
                    <td style="width:200px;">{{$note->user}}</td>
                </tr>
                @php $count++;@endphp
                @endforeach
            </tbody>
        </table>
        <br><br>
        <h2 style="text-align:center;color:red;">SMSes</h2> 
        <table>
            <thead style="background-color:gray;">
                <tr>
                    <th style="width:20px;">#</th>
                    <th style="width:80px;">Date</th>
                    <th style="width:80px;">Time</th>
                    <th style="width:300px;">SMS</th>
                    <th style="width:200px;">Sent By</th>
                </tr>
            </thead>
            <tbody>
                @php $counts=1;@endphp
                @foreach($smses as $sms)
                <tr>
                    <td style="width:20px;">{{$counts}}</td>
                    <td style="width:80px;">{{$sms->sent_date}}</td>
                    <td style="width:80px;">{{$sms->sent_time}}</td>
                    <td style="width:300px;">{{$sms->message}}</td>
                    <td style="width:200px;">{{$sms->user}}</td>
                </tr>
                @php $counts++;@endphp
                @endforeach
            </tbody>
        </table>
</body>
</html>