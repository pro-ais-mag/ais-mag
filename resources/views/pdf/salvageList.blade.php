<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Salvage Print</title>
</head>
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
<body>

    <table border="0">
    <thead style="text-align:center;background-color:black;color:white;height:14px;">
        <tr class="border_bottom" style="font-size:12px;">
            <th style="width:30px;">NO</th>
            <th style="width:80px;">REF</th>
            <th style="width:80px;">DATE</th>
            <th style="width:100px;">REG NO</th>
            <th style="width:100px;">MAKE</th>
            <th style="width:100px;">INSURANCE</th>
            <th style="width:80px;">ESTIMATOR</th>
            <th style="width:100px;">Drive/Tow</th>
            <th style="width:80px;">#</th>
            <th style="width:30px;">STATUS</th>
            <th style="width:30px;">PHOTOS</th>
            <th style="width:155px;">COMMENT</th>
        </tr>
    </thead>
    <br>
    <tbody>
    @php $counter=1; @endphp
    @php $photo_count=0; @endphp
@foreach($salvage_list as $salvage)

<tr class="border_bottom" style="height:15px;font-size:10px;">
<td style="width:20px;font-size:10px;text-align:center;"><b>{{$counter}}<b></td>
<td style="font-size:10px;text-align:center;"><b>{{$salvage->Key_Ref}}</b></td>
<td style="font-size:10px;text-align:center;">{{ $salvage->Date }}</td>
<td style="font-size:10px;text-align:center;"><b>{{$salvage->Reg_No}}</b></td>
<td style="font-size:10px;text-align:center;">{{$salvage->Make}}</td>
<td style="font-size:10px;text-align:center;"><b>{{$salvage->insurer}}</b></td>
<td style="font-size:10px;text-align:center;">{{$salvage->Estimator}}</td>
<!--Towed By-->
@php
$towed_by=$salvage->towed_by;
if($towed_by==""):
$t_status = "Drive In";
else:
$t_status =$towed_by;

endif;
if(empty($photos[$photo_count])):
    $foto=0;
else:
    $foto=$photos[$photo_count];
endif;
@endphp
<td style="font-size:10px;text-align:center;">{{$t_status}}</td>
<td style="font-size:10px;text-align:center;">{{$salvage->salBranch}}</td>
<td style="font-size:10px;text-align:center;">{{$status[$photo_count]}}</td>
<td style="font-size:10px;text-align:center;">{{$foto}}</td>
<td style="width:145px;font-size:8px;text-align:center;">{{$salvage->comment}}</td>
</tr>
@php $counter++;@endphp
@php $photo_count++; @endphp
@endforeach
<!--Status-->





</tbody>
</table>
</body>
</html>