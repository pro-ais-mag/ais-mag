<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Care Invoice</title>
</head>
<body>
<table border="0" style="font-size:12px;width:100%;">
<tr>
<td style="width:90px;">COMP NAME</td>
<td style="width:185px;">:J.A MAG Investments (PTY)LTD</td>
<td rowspan="6" style="text-align:center;"><h2>INVOICE</h2></td>
<td style="width:70px;">TEL</td>
<td style="width:185px;">:<?php echo e($comp_tel); ?></td>
</tr>

<tr>
<td>TRADING AS</td>
<td>:<?php echo e($comp_name); ?></td>
<td>ACC EMAIL</td>
<td>:asa@motoraccidentgroup.co.za</td>
</tr>

<tr>
<td>PLACE</td>
<td>:<?php echo e($comp_place); ?></td>
<td>EMAIL</td>
<td>:<?php echo e($comp_email); ?></td>
</tr>

<tr>
<td>STR NAME</td>
<td>:<?php echo e($comp_street); ?></td>
<td>WEBSITE</td>
<td>:www.motoraccidentgroup.co.za</td>
</tr>

<tr>
<td>VAT NO</td>
<td>:4860258427</td>
<td>DATE</td>
<td>:<?php echo e(date('Y-m-d')); ?></td>
</tr>

<tr>
<td>REG NO</td>
<td>:2016/504434/07</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

</table><br>




<table style="width:100%;font-size:12px;font-weight:bold;">
<tr style="background-color:black;color:white;border:solid 2px black;border-collapse: collapse;border: 1px solid black;">
<td width="33%">Invoice To</td>	
<td width="33%">&nbsp;</td>
<td>Reg No</td>
</tr>

<tr style="border:solid 2px black;">
<td><?php echo e($inv_to); ?></td>
<td>&nbsp;</td>
<td><?php echo e($Reg_No); ?></td>
</tr>

<tr style="border:solid 2px black;">
<td>Address</td>	
<td>&nbsp;</td>
<td>Make</td>
</tr>


<tr>
<td rowspan="3"><?php echo e($inv_address); ?></td>
<td>&nbsp;</td>
<td><?php echo e($Make); ?></td>
</tr>

<tr>
<td>&nbsp;</td>
<td>Model</td>
</tr>


<tr>
<td>&nbsp;</td>
<td><?php echo e($Model); ?></td>
</tr>

<tr>
<td>&nbsp;</td>	
<td>&nbsp;</td>
<td>Engine No</td>
</tr>


<tr>
<td colspan="2">&nbsp;</td>
<td><?php echo e($Chassess_NO); ?></td>
</tr>

<tr>
<td>Vat No</td>	
<td>&nbsp;</td>
<td>Kilometer</td>
</tr>


<tr>
<td><?php echo e($inv_vat); ?></td>
<td>&nbsp;</td>
<td><?php echo e($vin_no); ?></td>
</tr>
</table><br><br>

<table border="0" style="font-size:12px;width:100%;border-collapse: collapse;border: 1px solid black;">
<tr style="background-color:black;color:white;">
<th style="border: 1px solid black;">Reg Number.</th>
<th style="border: 1px solid black;">Order Number</th>
<th style="border: 1px solid black;">Claim Number</th>
<th style="border: 1px solid black;">Insuarance</th>
</tr>

<tr>
<td style="border: 1px solid black;"><?php echo e($Reg_No); ?></td>
<td style="border: 1px solid black;"><?php echo e($id); ?></td>
<td style="border: 1px solid black;"><?php echo e($Claim_NO); ?></td>
<td style="border: 1px solid black;"><?php echo e($Inserer); ?></td>
</tr>
</table><br><br>

<table border="0" style="border-collapse: collapse;border: 1px solid black;font-size:12px;font-weight:bold;width:100%;">
<tr style="background-color:black;color:white;">
<th style="border: 1px solid black;">Description</th>
<th style="border: 1px solid black;">Quantity</th>
<th style="border: 1px solid black;">Rate</th>
<th style="border: 1px solid black;">Amount</th>
</tr>

<tr>
<td style="height:250px;border: 1px solid black;"><?php echo e($inv_desc); ?></td>
<td style="border: 1px solid black;">1</td>
<td style="border: 1px solid black;">R<?php echo e(number_format($inv_amount,2)); ?></td>
<td style="border: 1px solid black;">R<?php echo e(number_format($inv_amount,2)); ?></td>
</tr>

<tr>
<td colspan="2" rowspan="4" style="border: 1px solid black;">&nbsp;</td>
<td style="border: 1px solid black;">SUB TOTAL</td>
<td style="border: 1px solid black;">R<?php echo e(number_format($inv_amount,2)); ?></td>
</tr>

<tr>
<td style="border: 1px solid black;">VAT TOTAL@ 15%</td>
<td style="border: 1px solid black;">R<?php echo e(number_format($inv_amount*15/100,2)); ?></td>
</tr>

<tr>
<td style="border: 1px solid black;">Discount@ <?php echo e($inv_discount); ?>%</td>
<td style="border: 1px solid black;">R<?php echo e(number_format($inv_amount*$inv_discount/100,2)); ?></td>
</tr>

<tr>
<td style="border: 1px solid black;">TOTAL</td>
<td style="border: 1px solid black;">R<?php echo e(number_format((($inv_amount + $inv_amount*15/100)-$inv_amount*$inv_discount/100),2)); ?></td>
</tr>
</table><br>

<p style="font-size:12px;font-weight:bold;"><b>PAYMENT TERMS ARE: STRICKLY 30 DAYS (USE INVOICE NUMBER AS REFERENCE)<br>
N:B INTEREST CHARGED AT 11.5% PER MONTH/S THAT THIS INVOICE IS OUTSTANDING
<br><br>
EMAIL PROOF OF PAYMENT TO ATTENTION: ACCOUNTS DEPARTMENT asa@motoraccidentgroup.co.za
<br><br>
NO CHEQUES ACCEPTED
<br><br>
<u>BANKING DETAILS</u><br>
BANK: Standard Bank<br>
BRANCH CODE: 006 005<br>
ACC NO: 281 711 623<br>
ACC NAME: J.A MAG Investment
</b>
</p>
</body>
</html>