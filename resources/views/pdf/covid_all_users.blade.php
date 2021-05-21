<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid All Users Report</title>
</head>
<body>
<h4 style="font-weight:bold;text-align:center;">Covid-19 Register All User</h4>
<h5 style="font-weight:bold;text-align:center;">Date:{{$from}} - {{$to}}</h5>    
    <table style="width:100%;">
        <thead style="background-color:black;color:white;font-size:12px;">
            <tr>
                
               <th>Date</th>    
               <th>Employee Name</th>    
               <th>Morning Temp.</th> 
               <th>Morning Symptoms</th>     
               <th>Morning Last 24</th>     
               <th>Afternoon Temp.</th>     
               <th>Afternoon Last 24</th>   
            </tr>
        <thead>
        <tbody style="font-size:10px;">
            @php echo $table;@endphp
        </tbody>
    </table>
</body>
</html>