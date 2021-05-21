<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Billing</title>
</head>
<body>
    
<table border="0">
<tr>
<td><img src="img/PICT.png" width="150px;" height="150px;"></td>
<td style="text-align:right;font-size:23px;" width="500px;"><b>TAX INVOICE</b></td>
</tr>
</table>
<br>
<table border="0" style="font-size:12px;margin-left:-300px;">

<tr>
<th style="width:750px;">Platinum ICT (Pty) LTD</th>
<th style="width:100px;">Page</th>
<th style="width:100px;">Page 1/1</th>
</tr>

<tr>
<th style="width:430px;">VAT No: 4380274177</th>
<th style="width:100px;">Number</th>
<th style="width:100px;">PICT00 <?php echo e($invoice_id); ?></th>
</tr>

<tr>
<th style="width:430px;">Reg: 2014/281031/07</th>
<th style="width:100px;">Invoice No</th>
<th style="width:100px;"><?php echo e($branch); ?><?php echo e($inv); ?></th>
</tr>

<tr>
<th style="width:430px;">Unit 6b Monpark Center</th>
<th style="width:100px;">Date Invoiced</th>
<th style="width:100px;"><?php echo e($date_invoiced); ?></th>
</tr>

<tr>
<th style="width:430px;">76 Skilpad Street</th>
<th style="width:100px;">Due Date</th>
<th style="width:100px;"><?php echo e($due_date); ?></th>
</tr>

<tr>
<th style="width:430px;">Monument Park, Pretoria</th>
<th style="width:100px;">Sales Rep</th>
<th style="width:100px;">A.I.S</th>
</tr>

<tr>
<th style="width:430px;">0181</th>
<th style="width:100px;">Print Date</th>
<th style="width:100px;"><?php echo e($print_date); ?></th>
</tr>

</table>

<h5>Invoice To:</h5>
<h6><?php echo e($val_1); ?></h6>
<h6><?php echo e($val_2); ?></h6>
<h6><?php echo e($val_3); ?></h6>
<h6><?php echo e($val_4); ?></h6>

<table border="0" style="font-size:12px;margin-top:-20px;">
<tr style="background-color:#c7c7c7;">
<th style="width:330px;">Description</th>
<th style="width:100px;">Quantity</th>
<th style="width:100px;">Unit Price</th>
<th style="width:100px;">Total Price</th>
</tr>

<tr>
<td><?php echo e($description); ?></td>
<td><?php echo e($quantity); ?></td>
<td>R <?php echo e($unit_price); ?></td>
<td>R <?php echo e($total_price); ?></td>
</tr>

<tr>
<td colspan="4" style="silver;height:400px;"></td>
</tr>

<tr style="background-color:#c7c7c7;">
<td colspan="2" rowspan="4"><?php echo e($details); ?></td>
<td>SUB TOTAL</td>
<td>R <?php echo e($total_price); ?></td>
</tr>

<tr>
<td>VAT@15%</td>
<td>R<?php echo e(number_format($vat,2)); ?></td>
</tr>

<tr style="background-color:#c7c7c7;">
<td>TOTAL</td>
<td>R<?php echo e(number_format($total_price+$vat,2)); ?></td>
</tr>
</table>
</body>
</html>