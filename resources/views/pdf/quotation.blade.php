<?php
include_once 'dbConfig.php';
session_start();
$id = $_SESSION['session_id'];
$val = $_SESSION['session_val'];
$sql = "select * from qoutes where Key_Ref = '$id'";
$result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));
$sql1 = "select * from client_details  where Key_Ref = '$id' limit 1";
$result1 = mysqli_query($db, $sql1) or die("Error in Selecting " . mysqli_error($db));
$sql2 = "select * from insurer  where Key_Ref = '$id'";
$result2 = mysqli_query($db, $sql2) or die("Error in Selecting " . mysqli_error($db));
$sql4 = "select comment from qoutecomments  where Key_Ref = '$id'";
$result4 = mysqli_query($db, $sql4) or die("Error in Selecting " . mysqli_error($db));
$result5 = mysqli_query($db, "select PaintSup,ShopSup from insurer where Key_Ref = '$id'") or die("Error in Selecting " . mysqli_error($db));

$sql3 = "select distinct
qt.Key_Ref,qt.Percent,Betterment,
sum(qt.Part*qt.Quantity)as part,
sum(qt.Labour)as labor,
sum(qt.Paint)as paint,
sum(qt.Strip)as strip, 
sum(qt.Frame)as frame,
sum(qt.Misc)as Misc,
sum(qt.sundries) as sundries ,round(sum(qt.Part+(qt.Part*ins.ShopSup)+(qt.Labour*ins.labour)+(qt.Paint*ins.Paint)+(qt.Paint*ins.PaintSup)+(qt.Strip*ins.Strip)+(qt.Frame*ins.Frame)+Misc),2)as total from qoutes qt 
inner join insurer ins on qt.Key_Ref = ins.Key_Ref where qt.Key_Ref ='$id'";
$result3 = mysqli_query($db, $sql3) or die("Error in Selecting " . mysqli_error($db));
//$emparray = array();
$refno = '';
$waste = 0;
$bt = 0;
$branch = '';
$head = '';
$note = '';
$counter = 1;
$numer = '';
$estimator = '';
$Client = '';
$Address = '';
$cellno = '';
$tel = '';
$email = '';
$veh = '';
$color = '';
$regno = '';
$vin = '';
$engino = '';
$km = '';
$insurer = '';
$insu_cell = '';
$ins_email = '';
$insu_tel = '';
$eexess = '';
$btmnt = '';
$assessa = '';
$vendaNo = '';
$claimno = '';
$rows = '';
$tbl = "";
$sql_ = '';
$sun = 0;
$consu = 0;
$st = 0;
$yr = '';
$resultxx = mysqli_query($db, "select waste from betterment where Key_Ref = '$id'") or die("Error in Selecting " . mysqli_error($db));
while($row =mysqli_fetch_assoc($resultxx))
{
    if($row['waste']!=null && $row['waste']!=''){
        $waste = $row['waste'];
    }       
}
$result_xx = mysqli_query($db, "select Oder_No from insurer where Key_Ref ='$id'") or die("Error in Selecting " . mysqli_error($db));
while ($row = mysqli_fetch_assoc($result_xx)) {
    $refno = $row['Oder_No'];
}
while ($row = mysqli_fetch_assoc($result5)) {
    $sun = $row['ShopSup'];
    $consu = $row['PaintSup'];
}
if ($val == 0 && $val != '') {
    $sql_ = "select (qt.Betterment*(qt.Part*qt.Quantity))as btn,qt.Percent,qt.Oper,qt.Description,qt.Quantity,qt.Part,(qt.Labour*ins.labour)as lb,(qt.Paint*ins.Paint)as pnt,(qt.Strip*ins.Strip)as strp,(qt.Frame*ins.Frame)as frm,Misc from qoutes qt
inner join insurer ins on qt.Key_Ref = ins.Key_Ref where qt.Key_Ref = '$id'";
} else if ($val == 1 && $val != '') {
    $sql_ = "select (qt.Betterment*(qt.Part*qt.Quantity))as btn,qt.Percent,qt.Oper,qt.Description,qt.Quantity,qt.Part,(qt.Labour)as lb,(qt.Paint)as pnt,(qt.Strip)as strp,(qt.Frame)as frm,Misc from qoutes qt where Key_Ref = '$id'";
}
$result_ = mysqli_query($db, $sql_) or die("Error in Selecting " . mysqli_error($db));
$coun = 1;
$perc = 0;
$btzs = 0;
$ttpts = 0;
$btzsa = 0;
while ($row = mysqli_fetch_assoc($result_)) {
    $opa = $row['Oper'];
    $desc = $row['Description'];
    $qt = $row['Quantity'];
    $pt = $row['Part'];
    $pnt = $row['pnt'];
    $lb = $row['lb'];
    $strp = $row['strp'];
    $frm = $row['frm'];
    $msc = $row['Misc'];
    $perc =  $row['Percent'];
    $bt = $row['btn'] / 100;
    $tbl .=  '<tr><td></td></tr><tr style="font-size:6.5;"><td style="text-align:left;width:20;">' . $coun . '</td>'
        . '<td style="text-align:left;width:50">' . $opa . '</td>'
        . '<td style="text-align:left;width:120">' . $desc . '</td>'
        . '<td style="text-align:left;width:20">' . $qt . '</td>'
        . '<td style="text-align:right;width:40">' . number_format($bt, 2) . '</td>'
        . '<td style="text-align:right">' . number_format(($pt * (1 + ($perc / 100))) * $qt, 2) . '</td>'
        . '<td style="text-align:right">' . number_format($pnt, 2) . '</td>'
        . '<td style="text-align:right">' . number_format($lb, 2) . '</td>'
        . '<td style="text-align:right">' . number_format($strp, 2) . '</td>'
        . '<td style="text-align:right">' . number_format($frm, 2) . '</td>'
        . '<td style="text-align:right">' . $msc . '</td>'
        . '</tr>';

    $coun++;
    $btzs += $bt;
    $btzsa += ($bt*1.15);
    $ttpts += (($pt * (1 + ($perc / 100))) * $qt);
}
while ($row1 = mysqli_fetch_assoc($result1)) {
    $st = $row1['status'];
    $estimator = strtoupper($row1['Estimator']);
    $Client = strtoupper($row1['Fisrt_Name']) . " " . strtoupper($row1['Last_Name']);
    $Address = strtoupper($row1['Address_1']) . " " . strtoupper($row1['Address_2']);
    $cellno = $row1['Cell_number'];
    $tel = $row1['Contact'];
    $email = $row1['Email'];
    $veh = strtoupper($row1['Make']) . " " . strtoupper($row1['Model']);
    $yr = $row1['Vehicle_year'];
    $color = strtoupper($row1['Colour']);
    $regno = strtoupper($row1['Reg_No']);
    $vin = strtoupper($row1['Chasses_No']);
    $engino = strtoupper($row1['Eng_No']);
    $branch = strtoupper($row1['branch']);
    $km = $row1['KM'];
    $date = $row1['Date'];
    if ($refno == '') {
        $refno = $row1['RO'];
    }
}
$laborRate = 0;
$paintRate = 0;
$stripRate = 0;
$frameRate = 0;
while ($row2 = mysqli_fetch_assoc($result2)) {
    $insurer = strtoupper($row2['Inserer']);
    $insu_cell = $row2['Cell'];
    $ins_email = $row2['Email'];
    $insu_tel = $row2['Contact'];
    $assessa = strtoupper($row2['Assessor']);
    $vendaNo = $row2['vendor_no'];
    $claimno = $row2['Claim_NO'];
    $laborRate = $row2['labour'];
    $paintRate = $row2['Paint'];
    $stripRate = $row2['Strip'];
    $frameRate = $row2['Frame'];
}

while ($row = mysqli_fetch_assoc($result)) {
    $eexess = $row['Excess_1'];
    $btmnt = $row['Betterment'];
    $numer = $row['Key_Ref'];
    $counter++;
}
$ct = 1;
while ($row4 = mysqli_fetch_assoc($result4)) {
    $note .= '<tr>'
        . '<td style="text-align:left;width:200;border-top: 1px solid lightgrey;border-bottom: 1px solid lightgrey;border-top: 1px solid lightgrey;border-right: 1px solid lightgrey">' . $ct . ' ' . $row4['comment'] . '</td>'
        //. '<td style="text-align:left;width:50;border-top: 1px solid lightgrey;border-bottom: 1px solid lightgrey;">'.$row4["date"].'</td>'
        . '</tr>';
    $ct++;
}

$partsTotal = 0;
$laborTotal = 0;
$paintTotal = 0;
$stripTotal = 0;
$frameTotal = 0;
$outwrkTotal = 0;
$sundriesTotal = 0;
$consusTotal = 0;
$subTotal = 0;
$tax = 0.15;
$actualTotal = 0;
$per = 0;
$keyR = '';
$betamnt = 0;
$beta = 0;
$btzs_ = $btzs * 1.15;
$btzsa = number_format($btzsa, 2);

while ($row3 = mysqli_fetch_assoc($result3)) {
    $per = $row3['Percent'];
    $partsTotal = $row3['part'] * (1 + ($per / 100));
    $laborTotal = $row3['labor'];
    $paintTotal = $row3['paint'];
    $stripTotal = $row3['strip'];
    $frameTotal = $row3['frame'];
    $outwrkTotal = $row3['Misc'];
    $betamnt = $row3['Betterment'] / 100 * $ttpts;
    $beta = number_format($row3['Betterment'], 2);
    $consusTotal = $paintTotal * $consu / 100;
    $subTotal = $row3['total'];
    $keyR = $row3['Key_Ref'];
}
$sundriesTotal = $ttpts * ($sun / 100);
$laborT = number_format($laborTotal, 1);
$paintT = number_format($paintTotal, 1);
$stripT = number_format($stripTotal, 1);
$frameT = number_format($frameTotal, 1);
$frameT_ =  number_format($frameTotal * $frameRate, 2);
$stripT_ = number_format($stripTotal * $stripRate, 2);
$paintT_ = number_format($paintTotal * $paintRate, 2);
$laborT_ = number_format($laborTotal * $laborRate, 2);
$partsTotal_ = number_format($ttpts, 2);
$consusTotal_ = number_format($paintTotal * $paintRate * ($consu / 100), 2);
$sundriesTotal_ = number_format($sundriesTotal, 2);
$outwrkTotal_ = number_format($outwrkTotal, 2);
$tt12 = $ttpts + $waste + ($laborTotal * $laborRate) + ($paintTotal * $paintRate) + ($stripTotal * $stripRate) + ($frameTotal * $frameRate) + $outwrkTotal + ($paintTotal * $paintRate * ($consu / 100)) + $sundriesTotal;
$tt12_ = number_format($tt12 * 1.15, 2);
$tax_ =  number_format($tt12 * $tax, 2);
$ttdx = number_format($tt12, 2);
$tt12__ = number_format(($tt12 * 1.15) * 0.5, 2);
$tt12___ = number_format(($tt12 * 1.15) * 0.5, 2);
$waste_ = number_format($waste,2);
$tbl .=  '<tfoot><tr><td></td></tr><tr><td style="text-align:left;font-size:7;width:26;"><b>Total</b></td>'
    . '<td style="text-align:left;width:50;"></td>'
    . '<td style="text-align:left;width:115;"></td>'
    . '<td style="text-align:left;"></td>'
    . '<td style="text-align:right;font-size:6"><b>' . number_format($btzs, 2) . '</b></td>'
    . '<td style="text-align:right;font-size:6"><b>' . number_format($ttpts, 2) . '</b></td>'
    . '<td style="text-align:right;font-size:6"><b>' . $paintT_ . '</b></td>'
    . '<td style="text-align:right;font-size:6"><b>' . $laborT_ . '</b></td>'
    . '<td style="text-align:right;font-size:6"><b>' . $stripT_ . '</b></td>'
    . '<td style="text-align:right;font-size:6"><b>' . $frameT_ . '</b></td>'
    . '<td style="text-align:right;font-size:6"><b>' . $outwrkTotal_ . '</b></td>'
    . '</tr></tfoot>';

if ($st == '1') {
    $head = 'AUTHORIZED ASSESSED';
} else {
    $head = 'ESTIMATE';
}
require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetMargins('8', "5", "10");
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->setFontSubsetting(true);

$pdf->SetFont('dejavusans', '', 12, '', true);

$pdf->AddPage();
//$date = date('Y-m-d');
$num = '<b>0001</b>';
$header = '<b style="font-size:12">Motor Accident Group</b>';
$image = "";
if ($branch == 'LONGMEADOW') {
    $image = "images/Longmeadow.png";
} else
    if ($branch == 'THE GLEN') {
    $image = "images/glen.png";
} else {
    $image = "images/_blank.png";
}
$pdf->Image($image, 5, 15, 200, 40, '', '', '', true, 150, '', false, false, '', false, false, false);
$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

$no          = 1;
$dataTable   = "";
$currentDate = date('Y-m-d'); 
$dbcmd     = "select * from qoutes where Key_Ref='$id' and (Oper='Used' or Oper='Other' or Oper='XXX')";
$dbquery   = $db->query($dbcmd);

if($dbquery->num_rows>0){
while($dbrow=$dbquery->fetch_assoc()){

$dataTable .='
<tr>
<td>'.$no." ".$dbrow['Description'].'</td>
</tr>
';	
$no++;

}	
}

// Set some content to print
$html = <<<EOD
     <div style="text-align:center;">$header</div><br><br><br><br><br><br><br>
        <p style="text-align:center;font-size:8"><b>$head QUOTE</b><br> <span style="font-size:7">Date: $date</span></p>
        <table style="font-size:7">
            <tr>
               <td style="width:80;"><b>M.A.G Quote No</b></td>
               <td style="font-size:7;width:250">: $id</td>
               <td style="width:70;"><b>REFERENCE</b></td>
               <td style="font-size:7;width:150;">: $refno</td>
            </tr>
            <tr>
               <td style="width:80;"><b>ESTIMATOR</b></td>
               <td style="font-size:7;width:250">: $estimator</td>
               <td style="width:70;"><b>VEHICLE/YEAR</b></td>
               <td style="font-size:7;width:150">: $veh / $yr</td>
            </tr>
            <tr>
               <td style="width:80;"><b>CLIENT</b></td>
               <td style="font-size:7;width:250">: $Client</td>
               <td style="width:70;"><b>COLOR</b></td>
               <td style="font-size:7;width:150">: $color</td>
            </tr>
            <tr>
               <td style="width:80;"><b>ADDRESS</b></td>
               <td style="font-size:7;width:250">: $Address</td>
               <td style="width:70;"><b>REG NO</b></td>
               <td style="font-size:7;width:150">: $regno</td>
            </tr>
            <tr>
               <td style="width:80;"><b>CONTACT</b></td>
               <td style="font-size:7;width:250">: $cellno</td>
               <td style="width:70;"><b>VIN</b></td>
               <td style="font-size:7;width:150">: $vin</td>
            </tr>
            <tr>
               <td style="width:80;"><b>CELL 2</b></td>
               <td style="font-size:7;width:250">: $cellno</td>
               <td style="width:70;"><b>ENG NO</b></td>
               <td style="font-size:7;width:150">: $engino</td>
            </tr>
            <tr>
               <td style="width:80;"><b>EMAIL</b></td>
               <td style="font-size:7;width:250">: $email</td>
               <td style="width:70;"><b>ODOMETER</b></td>
               <td style="font-size:7;width:150">: $km</td>
            </tr>
            <tr>
               <td style="width:80;"><b>EXCESS</b></td>
               <td style="font-size:7;width:250">: $eexess</td>
               <td style="width:70;"><b>INSURANCE</b></td>
               <td style="font-size:7;width:150">: $insurer</td>
            </tr>
            <tr>
               <td style="width:80;"><b>ASSESSOR</b></td>
               <td style="font-size:7;width:250">: $assessa</td>
               <td style="width:70;"><b>PHONE</b></td>
               <td style="font-size:7;width:150">: $insu_cell</td>
            </tr>
            <tr>
               <td style="width:80;"><b>VENDOR NUMBER</b></td>
               <td style="font-size:7;width:250">:</td>
               <td style="width:70;"><b>EMAIL</b></td>
               <td style="font-size:7;width:150">: $ins_email</td>
            </tr>
            <tr>
               <td style="width:80;"><b></b></td>
               <td style="width:250;"></td>
               <td style="width:70;"><b>CLAIM NO</b></td>
               <td style="font-size:7;width:150;">: $claimno</td>
            </tr>
        </table><br><br>
        <table style="font-size:7;width:520">
            <thead>
                <tr style="background-color:lightgrey">
                    <td style="width:20;font-size:7;text-align:left;"><b>#</b></td>
                    <td style="width:50;font-size:7;text-align:left;"><b>Oper</b></td>
                    <td style="width:120;font-size:7;text-align:left;"><b>Description</b></td>
                    <td style="width:20;font-size:7;text-align:left;"><b>Qty</b></td>
                    <td style="width:40;font-size:7;text-align:right;"><b>Bett</b></td>
                    <td style="font-size:7;text-align:right;"><b>Part</b></td>
                    <td style="font-size:7;text-align:right;"><b>Paint</b></td>
                    <td style="font-size:7;text-align:right;"><b>Labor</b></td>
                    <td style="font-size:7;text-align:right;"><b>Strip</b></td>
                    <td style="font-size:7;text-align:right;"><b>Frame</b></td>
                    <td style="font-size:7;text-align:right;"><b>Inhse/Out</b></td>
                </tr>
            </thead>
                $tbl
        </table><br>
        <div>
            <table style="font-size:7">
                <thead>
                    <tr>
                        <td><b></b></td>
                        <td><b></b></td>
                    </tr>
                </thead>
                
                <tr>
                    <td style="width:320">
                        <table  style="font-size:7;">
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <tr>
                                <td style="width:75">Authorized Date:</td>
                                <td style="width:180">......................................</td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                                <td style="width:60">Authorized By:</td>
                                <td style="width:200">.............................................</td>
                            </tr> 
                            <tr><td></td></tr>
                            <tr>
                                <td style="width:50">Signature:</td>
                                <td style="width:205">..................................................</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width:150">
                        <table>
                            <tr>
                                <td style="width:140">Parts</td>
                                <td style="text-align:right;width:60">R $partsTotal_</td>
                            </tr>
                            <tr>
                                <td style="width:140">$laborT hrs Labor @ R $laborRate/hr</td>
                                <td style="text-align:right;width:60">R $laborT_</td>
                            </tr>
                            <tr>
                                <td style="width:140">$paintT hrs Paint @ R $paintRate/hr</td>
                                <td style="text-align:right;width:60">R $paintT_</td>
                            </tr>
                            <tr>
                                <td style="width:140">$stripT hrs Strip/Assembly @ R$stripRate/hr</td>
                                <td style="text-align:right;width:60">R $stripT_</td>
                            </tr>
                            <tr>
                                <td style="width:140">$frameT hrs Frame @ R $frameRate/hr</td>
                                <td style="text-align:right;width:60">R $frameT_</td>
                            </tr> 
                            <tr>
                                <td style="width:140">Outwork </td>
                                <td style="text-align:right;width:60">R $outwrkTotal_</td>
                            </tr>
                            <tr>
                                <td style="width:140">Sundries </td>
                                <td style="text-align:right;width:60">R $sundriesTotal_</td>
                            </tr>
                            <tr>
                                <td style="width:140">Paint Supplies </td>
                                <td style="text-align:right;width:60">R $consusTotal_</td>
                            </tr>
                            <tr>
                                <td style="width:140">Waste Disposal </td>
                                <td style="text-align:right;width:60">R $waste_</td>
                            </tr>
                            <tr>
                                <td style="width:140;"><b>Sub Total </b></td>
                                <td style="text-align:right;width:60;"><b>R $ttdx</b></td>
                            </tr>
                            <tr>
                                <td style="width:140">VAT @ 15% </td>
                                <td style="text-align:right;width:60">R $tax_</td>
                            </tr>
                            <tr>
                                <td style="width:140">Betterment (Inc VAT) </td>
                                <td style="text-align:right;width:60">R $btzsa</td>
                            </tr>
                            <tr>
                                <td style="width:140;"><b>Total</b></td>
                                <td style="text-align:right;width:60;"><b>R $tt12_</b></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr><td></td></tr>
                </table>
                 <table style="font-size:7;font-family:Verdana,verdana">
                <tr><td style="font-size:9"><b>Notes</b></td></tr>
                 $note
                <tr><td></td></tr>
                <tr>
                    <td style="text-align:center;width:500;font-size:10;color:gray"><b>Terms and Conditions</b></td>
                </tr>
                <tr><td></td></tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>1.</b> Vehicle repaired or salvaged shall not be released to the owner until the repair costs and/ or salvage and storage costs have been paid in full.</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>2.</b> M.A.G Quotation is valid for 30 days and does not include hidden or latents defects</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>3.</b> M.A.G will take no responsibility for loss due to fire or theft unforeseen circumstances</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>4.</b> M.A.G will take no responsibility for all glass that is removed and fitted at the vehicle owner's risk</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>5.</b> M.A.G will take no responsibility for Alarm, Cameras, SD cards that are left in the vehicle: this is vehicle owner's responsibility</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>6.</b> Insurance Excess and Payments is payable before vehicle release</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>7.</b> Credit Card transaction are subject to 5% transaction fee</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>8.</b> The storage is charged for light vehicles at R250/day including vat</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>9.</b> Storage is charged for heavy vehicles at R455/day including vat</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>10.</b> No work will commence without a signed quotation and payments reflecting a 30% in our account applies only for (C.O.D) clients</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>11.</b> By acceepting this quotation the client agrees to the terms and conditions of repairs and payments terms</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>12.</b> 60 days after completion - vehicle will be sold for defray cost</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>13.</b> Insurance companies without Service Level Agreement are not allowed to Audit</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>14.</b> Insurance companies are not allowed settlement discount without signed Service Level Agreement</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>15.</b> Suppliers are obliged to repair, refund or replace the failed, defective or unsafe products</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>16.</b> Payments to be done to <b style="color:black">First National Bank: 62616112827 Branch Code 250655</b> or</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>17.</b> Payments to be done to <b style="color:black">Starndard Bank: 281711623 Branch Code 051001</b></td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>18.</b> All proof of payments to be emailed to info@motoracccidentgroup.co.za</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>19.</b> Insurance Assessors are not allowed a 5% settlement without SLA in place</td>
                </tr>
                 <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>20.</b> Costings to be signed by assessor prior to delivery as per company terms and conditions repair times - Subject to Costings</td>
                </tr>
                 <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>21.</b> If a vehicle is insured the owner of the vehicle shall remain liable for the repair, salvage and storage costs until the insurer makes payments of such costs.</td>
                </tr>
                <tr><td></td></tr>
                <tr style="color:gray"><td><b>Payment Terms for C.O.D Clients</b></td></tr>
                <tr >
                    <td style="font-size:7;width:200;color:gray">50% on acceptance of quote:</td>
                    <td style="font-size:7;width:200;color:grey">R:$tt12__</td>
                </tr>
                <tr>
                    <td style="font-size:7;width:200;color:grey">50% Balance to be paid on date of completion:</td>
                    <td style="font-size:7;width:200;color:grey">R:$tt12___</td>
                </tr>
                <tr><td></td></tr>
                
            </table>
        </div>
		
EOD;
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

$fil_name = $numer . "qoute" . date('Ydmhs') . 'file.pdf';
$pdf->Output($fil_name, 'I');
