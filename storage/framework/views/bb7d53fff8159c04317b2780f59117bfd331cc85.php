<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid Report</title>
<style>
.page-break {
    page-break-after: always;
}
tr.border_bottom td {
  border-bottom:0.5pt solid black;
  font-family: "Courier New", Times, serif;
}
tr.border_bottom th{
    border-bottom:1pt solid black;
}
tr:nth-child(even) td {
background-color: #D3D3D3 !important;
-webkit-print-color-adjust: exact;
}
</style>
</head>
<body>
    <h4 style="font-weight:bold;text-align:center;">Covid-19 Register</h4>
        <h3 style="font-weight:bold;text-align:center;"><?php echo e($name); ?></h3>
    <table style="width:100%;">
        <thead style="background-color:black;color:white;font-size:12px;">
            <tr>
               <th>Date</th>    
               <th>Morning Temp.</th>     
               <th>Morning Symptoms</th>     
               <th>Morning Last 24</th>     
               <th>Afternoon Temp.</th>     
               <th>Afternoon Symptoms</th>   
               <th>Afternoon Last 24</th>   
            </tr>
        <thead>
        <tbody style="font-size:10px;">
            <?php echo $report;?>
        </tbody>
    </table>
</body>
</html>