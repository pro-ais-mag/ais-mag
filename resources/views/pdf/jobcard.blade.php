<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Card</title>
    <style>
.page-break {
    page-break-after: always;
}

.col-6{
    width: 50%;
}
.row:after {
  content: "";
  display: table;
  clear: both;
}
.column {
  float: left;
  width: 50%;
  padding: 10px;
  
}
</style>
</head>
<body>
<table>
   <tr>
        <td style="width:50"></td> 
        <td>
            <table style="font-size:8;">
                <tr>
                    <td style="width:100;"><b>Fullname</b></td>
                    <td style="width:150;">: {{$name}}</td>
                    <td style="width:100;"><b>Reg No.</b></td>
                    <td style="width:150;">: {{$reg}}</td>
                </tr>
                <tr>
                    <td style="width:100;"><b>Vehicle</b></td>
                    <td style="width:150;">: {{$model}}</td>
                    <td style="width:100;"><b>Odometer</b></td>
                    <td style="width:150;">: {{$kms}}</td>
                </tr>
                <tr>
                    <td style="width:100;"><b>Chassis</b></td>
                    <td style="width:150;">: {{$chassis}}</td>
                    <td style="width:100;"><b>Insurer</b></td>
                    <td style="width:150;">: {{$insurer}}</td>
                </tr>
                <tr>
                    <td style="width:100;"><b>Date</b></td>
                    <td style="width:150;">: {{$ro}}</td>
                    <td style="width:100;"><b></b></td>
                    <td style="width:150;"></td>
                </tr>
                
            </table>
        </td> 
   </tr>
</table>
<h3 style="font-size:12;text-align:center;"><b>Track Number: {{$ref}}</b></h3><br>
<hr>
        <div class="row">
        <div class="column">
            <table style="font-size:9px;border:solid black 1px;">
                <tr>
                    <td colspan="4" style="font-size:12px;text-align:center;"><b>JOB CARD</b></td>
                </tr>
                <tr>
                    <td style="background-color:green;color:#fff;width:70;"><b>Parts</b></td>
                    <td style="background-color:green;color:#fff;width:150;"><b>Assigned</b></td>
                    <td style="background-color:green;color:#fff;width:30;">&nbsp;</td>
                    <td style="background-color:green;color:#fff;width:30;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                @php echo $tblpart;@endphp
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="background-color:green;color:#fff;width:70;"><b>Labour</b></td>
                    <td style="background-color:green;color:#fff;width:150;"><b>Assigned</b></td>
                    <td style="background-color:green;color:#fff;width:30;"><b>Hrs</b></td>
                    <td style="background-color:green;color:#fff;width:30;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                @php echo $tbllabor;@endphp
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="background-color:green;color:#fff;width:70;"><b>Paint</b></td>
                    <td style="background-color:green;color:#fff;width:150;"><b>Assigned</b></td>
                    <td style="background-color:green;color:#fff;width:30;"><b>Hrs</b>&nbsp;</td>
                    <td style="background-color:green;color:#fff;width:30;">&nbsp;</td>
                </tr>
                <tr>
                    <td></td>&nbsp;
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                @php echo $tblpaint;@endphp
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="background-color:green;color:#fff;width:70px;"><b>Strip</b></td>
                    <td style="background-color:green;color:#fff;width:150px;"><b>Assigned</b></td>
                    <td style="background-color:green;color:#fff;width:30px;"><b>Hrs</b></td>
                    <td style="background-color:green;color:#fff;width:30px;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                @php echo $tblstrip;@endphp
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="background-color:green;color:#fff;width:70;"><b>Outwork</b></td>
                    <td style="background-color:green;color:#fff;width:150;"><b>Assigned</b></td>
                    <td style="background-color:green;color:#fff;width:30;"><b>Hrs</b></td>
                    <td style="background-color:green;color:#fff;width:30;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                @php echo $tbloutwrk;@endphp
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                
                                        
            </table>
        </div>
        <div class="column">
            <table border="0" style="font-size:10px;margin-left:25px;width:100%;border:solid black 1px;">          
                
                <tr>
                    <td colspan="6" style="font-size:12px;text-align:center;border-color:transparant;"><b>TIME SHEET</b></td>
                </tr>
                
                <tr style="background-color:green;color:#fff;">
                    <td colspan="4" style="font-size:8px;text-align:center;border-color:transparant;"><b>ASSEMBLY</b></td>
                    <td colspan="2" style="text-align:right;border-style:none"><b style="color:#fff;font-size:8px;">{{$ttlStrip}} Hours</b></td>
                </tr>                
                <tr style="height:8px;">
                    <td style="color:#333;border:solid black 1px;">Strip For P/B</td>
                    <td style="color:#F0F0F0;border:solid black 1px;">Date</td>
                    <td style="color:#F0F0F0;border:solid black 1px;">S-Time</td>
                    <td style="color:#F0F0F0;border:solid black 1px;">F-Time</td>
                    <td style="color:#F0F0F0;border:solid black 1px;">Name</td>
                    <td style="color:#F0F0F0;border:solid black 1px;">A-Time</td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Strip For P/B</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Assembler</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
               
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Assembler</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>                
                <tr style="background-color:green;color:#fff;">
                    <td colspan="6" style="font-size:8px;text-align:center;border-color:transparant;"><b>MECHANICAL</b></td>                   
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Strip Mechanical</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
               
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Mechanical</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
               
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Mechanical</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>               
                <tr style="background-color:green;color:#fff;">
                    <td colspan="4" style="font-size:8px;text-align:center;border-color:transparant;"><b>REPAIR/P/B (LABOR)</b></td>
                    <td colspan="2" style="text-align:right;border-style:none;"><b style="color:#fff;font-size:10;">{{$ttlLabor}} Hours</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">SET ON JIG</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
               
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Panel P/B</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
            
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Panel P/B</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
               
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;;">Panel P/B</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
               
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Panel P/B</td>
                    <td style="color:#F0F0F0;border:solid black 1px;;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
                <tr style="background-color:green;color:#fff;">
                    <td colspan="6" style="font-size:8px;text-align:center;border-color:transparant;"><b>BUMPERS AND LOOSE PARTS</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Rep+</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Prep+</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
				<tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Paint+</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
                <tr style="background-color:green;color:#fff;">
                    <td colspan="4" style="font-size:8px;text-align:center;border-color:transparant;"><b>PAINT</b></td>
                    <td colspan="2" style="text-align:right;border-style:none;"><b style="color:#fff;font-size:8px;">{{$ttlPaint}} Hours</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Prep For Primer</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
                
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Spray Primer</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
                
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Flatting Primer</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Flatting Primer</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>       
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Check For Paint</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
                
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Masking</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:8px;">Paint Vehicle</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
                <tr style="background-color:light-green;color:#fff;">
                    <td colspan="6" style="font-size:12px;text-align:center;border-color:transparant;background-color:grey;"><b>COME BACK</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:6;">Prep For Painting</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:6px;">Painting</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>A-Time</b></td>
                </tr>
                <tr style="background-color:green;color:#fff;">
                    <td colspan="6" style="font-size:8;text-align:center;border-color:transparant;"><b>OUTWORK</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:6;">Electrical</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Yes</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>No</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Where</b></td>
                </tr>
               
                <tr>
                    <td style="color:#333;border-style:none;font-size:6;">Diagnostics</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Yes</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>No</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Where</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:6;">W/A</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Yes</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>No</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Where</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:6;">Regas</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Yes</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>No</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Where</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:6;">Other</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Yes</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>No</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Where</b></td>
                </tr>                     
                <tr style="background-color:green;color:#fff;">
                    <td colspan="4" style="font-size:8;text-align:center;border-color:transparant;"><b>POLISH</b></td>
                    <td colspan="2" style="text-align:right;border-style:none;"><b style="color:#fff;font-size:10;">(2 Hours)</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:6px;">Flat For Polish</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#111;border:solid black 1px;"><b>1 hr</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:6px;">Polish</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#111;border:solid black 1px;"><b>1 hr</b></td>
                </tr>                
                <tr style="background-color:green;color:#fff;">
                    <td colspan="4" style="font-size:8;text-align:center;border-color:transparant;"><b>CLEANING</b></td>
                    <td colspan="2" style="text-align:right;border-style:none;"><b style="color:#fff;font-size:10;">(1.5 Hours)</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:6;">Clean</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#111;border:solid black 1px;"><b>1 hr</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:6;">Clean</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#111;border:solid black 1px;"><b>0.5 hr</b></td>
                </tr>
                <tr style="background-color:green;color:#fff;">
                    <td colspan="6" style="font-size:8;text-align:center;border-color:transparant;"><b>QUALITY CONTROL</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:5;">Passed/Failed</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Status</b></td>
                </tr>
                <tr>
                    <td style="color:#333;border-style:none;font-size:6;">Q.C Report</td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
                    <td style="color:#F0F0F0;border:solid black 1px;"><b>Status</b></td>
                </tr>-->
            </table>
        </div>
        </div>
<div class="page-break"></div>
<div class="row">
<table cellspacing="2" border="0" style="font-size:10px;font-family: Verdana , Verdana;width:100%;border-collapse: separate;border:solid black 1px;">
    <tr style="background-color:green;color:#fff;">
        <td colspan="6" style="font-size:12px;text-align:center;border-color:transparant;"><b>STORES/CONSUMABLES</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;border:solid black 1px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>   
            
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>   
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>   
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>   
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>   
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>   
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>   
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>   
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>   
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>   
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>    
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>  
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>  
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>  
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>  
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>
    <tr>
        <td style="color:#333;border-style:none;font-size:10px;">Material</td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Quantity</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Given By</b></td>
    </tr>     
</table>
</div>
<p></p><br>
<div class="row">
<table cellspacing="2" border="0" style="font-size:10px;font-family: Verdana , Verdana;width:100%;border-collapse: separate;border:solid black 1px;">
    <tr style="background-color:green;color:#fff;">
        <td colspan="6" style="font-size:12;text-align:center;border-color:transparant;"><b>WORKSHOP CLEANING</b></td>
    </tr>    
    <tr>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Allowed Time</b></td>
    </tr>
    <tr>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Allowed Time</b></td>
    </tr>
    <tr>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Allowed Time</b></td>
    </tr>
    <tr>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Allowed Time</b></td>
    </tr>
    <tr>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Allowed Time</b></td>
    </tr>
    <tr>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Allowed Time</b></td>
    </tr>
    <tr>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Allowed Time</b></td>
    </tr>
    <tr>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Allowed Time</b></td>
    </tr>
    <tr>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Allowed Time</b></td>
    </tr>
    <tr>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Allowed Time</b></td>
    </tr>
    <tr>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Allowed Time</b></td>
    </tr>
    <tr>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>S-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Allowed Time</b></td>
    </tr>
    <tr>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Description</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Date</b></td>
        <td style="color:#E8E8E8;border:solid black 1px;"><b>S-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>F-Time</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Name</b></td>
        <td style="color:#F0F0F0;border:solid black 1px;"><b>Allowed Time</b></td>
    </tr>
    
</table>
</div>
<div class="page-break"></div>
<div class="row">
        <div class="column">
             <table width="100%" style="font-size:10px;">
                <tr>
                    <td colspan="6" style="text-align:center;font-size:12px;"> <b>Quality Control Check List</b></td>
                </tr>
                <tr style="background-color:green;color:white;">
                    <td colspan="2">Checked</td>
                    <td colspan="2">Focused</td>
                    <td colspan="2">Checked</td>
                </tr>
                <tr>
                    <td>Radio Tape</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>Head Lights LF/RF</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>Anti Freeze</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td>Air Conditioner</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>Spot Lights LF/RF</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>Rubberising</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Over Spray</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                <td colspan="6">&nbsp;</td>
                </tr>
                <tr style="background-color:green;color:white;">
                    <td colspan="2">Cleaned & Checked</td>
                    <td colspan="2">Checked</td>
                    <td colspan="2">Tighted & Checked</td>
                </tr>
                <tr>
                <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td>Door Locks</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>Flasher LF/RF</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>Battery Terminals</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>

                            
                <tr style="margin-bottom:10px;">
                    <td>Window winders</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>Tail Lights LF/RF</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>All Wheel Nuts</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                
                <tr>
                    <td>Rear Windscreen </td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>No. Plate Light </td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>Windscreen Whipper</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>

                <tr>
                    <td>Front Windscreen</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>Bumper L/R</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Mirrors/Elect or Manual</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>All Body Gaps</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Door Trim Panels</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>Jack</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Hood Lining</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>Spare Wheel</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Seat Cover</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>Boot Mat</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Carpets</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>Tools</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Seats</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>Radiator Water</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Rubber Floor Mats</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>Washer Bottle</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td >&nbsp;</td>
                    <td>Hooter</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td >&nbsp;</td>
                    <td>Park Lamps</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr style="background-color:green;color:white;">
                    <td colspan="2">Road Test</td>
                    <td colspan="2">Repair Type</td>
                    <td colspan="2">Patrol</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td>Wind Noise </td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td colspan="2">[L] [Fr] [Bk] [Top] [R] </td>
                    <td colspan="2">[E] [1/4] [1/2] [3/4] [F]</td>
                </tr>
                <tr>
                    <td>Wheel Alignment F/R</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td colspan="4">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr style="background-color:green;color:white;text-align:center;">
                    <td colspan="6">Outwork Done</td>
                </tr>
                <tr>
                    <td colspan="6" style="font-size:14px;text-align:center;">Damaged Parts Stripped NOT Quoted</td>
                </tr> 
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">1.____________________________________________________________</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">2.____________________________________________________________</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">3.____________________________________________________________</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">4.____________________________________________________________</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">5.____________________________________________________________</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">6.____________________________________________________________</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">7.____________________________________________________________</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">8.____________________________________________________________</td>
                </tr>

             </table>
        </div>
        <div class="column">
            <table style="font-size:10px;width:100%;">
                <tr>
                <td colspan="5" style="text-align:center;font-size:12px;"><b>M.A.G Processors</b></td>
                </tr>
                <tr style="font-size:12px;border:solid 1px black;">
                    <td>Department</td>
                    <td>Name</td>
                    <td>Date In</td>
                    <td>Date Out</td>
                    <td>Signature</td>
                </tr>
                <tr>
                    <td>Stripping</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Mechanical</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Panel Beating</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Primer Bay</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Preparation/Body</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Preparation/Loose Parts</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Masking Bay</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Spray</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Assembly</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Assembly Bay</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Polish Bay</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Cleaning Bay</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>1st Inspection + Assembly</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>2nd Inspection + Line Manager</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Quality Control</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                    <td style="border:solid 1px black;">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5" style="font-size:14px;text-align:center;"><b>Additional Request</b></td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5">1.____________________________________________________________</td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5">2.____________________________________________________________</td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5">3.____________________________________________________________</td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5">4.____________________________________________________________</td>
                </tr>
            </table>
        </div>
</div>
</body>
</html>