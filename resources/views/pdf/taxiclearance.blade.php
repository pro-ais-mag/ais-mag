<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SA Taxi Clearance</title>
</head>
<body>
<img src="img/header.png" width="700px" height="150px"/> 
<h4 style="text-align:center;">S.A TAXI CLEARANCE CERTIFICATE NO:{{$key}} </h4>

<table style="font-size:12px;">
<tr>
<td style="width:70px;"><b>DATE</b></td>
<td>:.....................................</td>
</tr>

<tr>
<td><b>Insured</b></td>
<td><b>:{{$insured}}</b></td>
</tr>

<tr>
<td><b>Vehicle</b></td>
<td><b>:{{$vehicle}}</b></td>
</tr>

<tr>
<td><b>Reg No</b></td>
<td><b>:{{$reg}}</b></td>
</tr>

<tr>
<td><b>Insurer</b></td>
<td><b>:{{$insurer}}</b></td>
</tr>

<tr>
<td><b>Claim No</b></td>
<td><b>:{{$claim_no}}</b></td>
</tr>
</table>

<p style="font-size:12px;font-weight:bold;">
<u><b>Customer to pay:</b></u>
<br>Excess and betterment(Incl. VAT) = R {{number_format($excess+$betterment,2)}} Receipt/Invoice No: {{$key}} Date: :.....................<br>

I/We hereby declare that the repairs to the above mentioned vehicle rendered necessary as the the result of the accident have been carried out
to my/our complete satisfaction as per the agreed quote between the insurance company/assessor and the repairer.



<br>I/We hereby declare that we have received all the necessary documentation(i.e warranty, etc) for the above mentioned vehicle from the repairer



<br>I/We understand that I/We have received the following guarantees for the repair undertaken on the above mentioned vehicle:

</p>

<table style="border-collapse: collapse;border: 1px solid black;font-size:12px;">
<tr>
<td style="width:80px;border: 1px solid black"><b>Workmanship</b></td>
<td style="width:240px;border: 1px solid black"><b>1 (One) Year</b></td>
<td style="width:80px;border: 1px solid black"><b>Paintwork</b></td>
<td style="width:240px;border: 1px solid black"><b>Lifetime as per paint manufactures warranty</b></td>
</tr>

<tr>
<td style="width:80px;border: 1px solid black"><b>Parts</b></td>
<td style="width:240px;border: 1px solid black"><b>Warranty as per suppliers documentation</b></td>
<td style="width:80px;border: 1px solid black"><b>Rust</b></td>
<td style="width:240px;border: 1px solid black"><b>1 (One) year or balance of factory warranty</b></td>
</tr>
</table>

<table border="0" style="font-size:12px;font-weight:bold;">
<tr>
<td style="height:25px;"></td>
</tr>

<tr>
<td style="width:80px;">Print Name:</td>
<td style="width:180px;">.....................................</td>
<td style="width:130px;">Customer Signature:</td>
<td style="width:240px;">.....................................</td>
</tr>

<tr>
<td style="width:80px;">Date:</td>
<td style="width:180px;">.....................................</td>
<td style="width:130px;">Customer:</td>
<td style="width:240px;"><table style="border:solid black;border-collapse: collapse;"><tr><td style="width:50px;border: 1px solid black;">Owner</td><td style="width:50px;border: 1px solid black;">Driver</td></tr></table></td>
</tr>

</table>

<h5>To be completed by the Panel Beater:</h5>
<table style="border-collapse: collapse;border: 1px solid black;font-size:12px;">
<tr style="border: 1px solid black;border-collapse: collapse;">
<td style="border: 1px solid black;width:150px;">Date Authorized</td>
<td style="border: 1px solid black;width:150px;">&nbsp;</td>
<td style="border: 1px solid black;width:150px;">Date Of Collection</td>
<td style="border: 1px solid black;width:150px;">&nbsp;</td>
</tr>

<tr style="border: 1px solid black;border-collapse: collapse;">
<td style="border: 1px solid black;width:200px;">Date Work Completed</td>
<td style="border: 1px solid black;width:100px;">&nbsp;</td>
<td style="border: 1px solid black;width:150px;">Days In Repair</td>
<td style="border: 1px solid black;width:150px;">&nbsp;</td>
</tr>
</table><br>
<p style="font-size:12px;font-weight:bold;">
<u>Roadworthiness:</u> Has the vehicle roadworthiness been check? :.....................................<br>
<br>Have you been advised of any issues? If yes, please state what issues were found :.....................................<br>
<br><u>Tracking Unit:</u> Has the tracking unit been checked and is it in working order?___________ Date Checked:__________________
</p>
<br>
<table style="font-size:12px;font-weight:bold;">
<tr>
<td style="height:25px;">&nbsp;</td>
</tr>

<tr>
<td style="width:140px;">Panel Beater Signature:</td>
<td style="width:180px;">.....................................</td>
<td style="width:40px;">Date:</td>
<td style="width:240px;">.....................................</td>
</tr>

<tr>
<td style="height:25px;">&nbsp;</td>
</tr>
</table>
<br><br><br>
<img src="img/footer.png" width="700px" height="75px"/>
</body>
</html>