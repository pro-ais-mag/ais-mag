<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Order | Print</title>
<head>    
<body>
<div style="background-color:#d5e3e4;" border="1">
<table style="font-family:;  font-size:11px;">
<tr>
<td colspan="6" align="center" style="font-size:22px;margin-left:200px;"><b>Official Order : Motor Accident Group</b></td>
</tr>
<tr>
<?php $location="";?>
<?php $__currentLoopData = $stock_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
$branch=$stock->branch;

<?php if($stock->branch="The Glen"): ?>
    $location="Louis Avenue, Glen Eagles, 7945, Tel:(011) 432 0163";
<?php elseif($stock->branch="Longmeadow"): ?>
    $location="42 Longmeadow Blvd, Edenvale, 1609, Tel:(010) 500 0350";    
<?php elseif($stock->branch="Selby"): ?>
    $location="80 Booysen Road, Selby, 2001, Tel:(011) 493-9160";
<?php endif; ?>    

<td colspan="4"  align="center"><?php echo e($location); ?></td>
</tr><hr>

<tr>
<td style="width:10px;"><h4>Placed By</h4></td>
<td><?php echo e($stock->sender); ?></td>
<td><h4>Email Address</h4></td>
<td><?php echo e($stock->supplier_email); ?></td>
</tr>

<tr>
<td><h4>Order No.</h4></td>
<td><?php echo e($stock->id); ?></td>
<td><h4>Order Date</h4></td>
<td><?php echo e($stock->order_date); ?></td>
</tr>

<tr>
<td><h4>Supplier.</h4></td>
<td><?php echo e($stock->supplier); ?></td>
<td><h4>Supplier Email</h4></td>
<td><?php echo e($stock->supplier_email); ?></td>
</tr>

<tr>
<td><h4>Supplier Tel.</h4></td>
<td><?php echo e($stock->supplier_tel); ?></td>
<td><h4>Supplier Cell</h4></td>
<td><?php echo e($stock->supplier_cell); ?></td>
</tr>

</table>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<table border="1" style="font-family:;font-size:11px;">
<tr><td><h4>Please supply the undermentioned goods per:</h4></td></tr>
</table>
<table border="1" style="font-family:;font-size:11px;">
<tr style="background-color:#d5e3e4;">
<td style="width:75px;"><h4>Quantity</h4></td>
<td style="width:278px;"><h4>Description</h4></td>
<td style="width:278px;"><h4>Comment</h4></td>
</tr>
</table>
<table border="1" style="font-family:;font-size:11px;">
<?php $__currentLoopData = $stock_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr style="background-color:white;color:black;text-align:center;">
<td style="width:75px;"><?php echo e($list->quantity); ?></td>
<td style="width:278px;"><?php echo e($list->description); ?></td>
<td style="width:278px;"><?php echo e($list->comment); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<br><br><br><br><br><br><br>

<table style="font-family:;" border="1">

<tr>
<td style="width:630px;" colspan="2"><br/><br/>
<i><b>Note: </b>To be accompanied by invoice or delivery note bearing above order <br/>No:#<b></b></i>
<br/><h5> <i>Please note this is an official order authorised by Motor Accident Group</i></h5>
</td>
</tr>
</table><br/>
</body>
</html>