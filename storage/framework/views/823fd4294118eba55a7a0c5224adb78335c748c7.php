<html>
<head>
<title>Statements</title>
</head>
<body>
<table border="0">
<tr>
<td><img src="img/PICT.png" width="150px;" height="150px;"></td>
<td><h1 style="text-align:right;font-size:23px;width:450px;">STATEMENT</h1></td>
</tr>
</table>

<table border="0" style="font-size:12px;margin-left:-330px;">

<tr style="width:630px;height:10px;">
<th style="width:800px;height:10px;">Platinum ICT (Pty) LTD</th>
<th style="width:100px;height:10px;">Page</th>
<th style="width:100px;height:10px;">Page 1/1</th>
</tr>

<tr style="width:430px;height:10px;">
<th style="width:430px;height:10px;">VAT No: 4380274177</th>
<th style="width:100px;height:10px;">Cust Id</th>
<th style="width:100px;height:10px;"><?php echo e($branchs); ?></th>
</tr>

<tr style="width:430px;">
<th style="width:430px;height:10px;">Reg: 2014/281031/07</th>
<th style="width:100px;height:10px;">Date</th>
<th style="width:100px;height:10px;"><?php echo e($date_invoiced); ?></th>
</tr>

<tr style="width:430px;height:10px;">
<th style="width:430px;height:10px;">Unit 6b Monpark Center</th>
<th style="width:100px;height:10px;">Print Date</th>
<th style="width:100px;height:10px;">&nbsp;</th>
</tr>

<tr style="width:430px;height:10px;">
<th style="width:430px;">76 Skilpad Street</th>
</tr>

<tr style="width:430px;height:10px;">
<th style="width:430px;">Monument Park, Pretoria</th>

</tr>

<tr style="width:430px;height:10px;">
<th style="width:430px;">0181</th>
</tr>

</table>

<h4>Invoice To:</h4>
<h5><?php echo e($val_1); ?></h5>
<h5><?php echo e($val_2); ?></h5>
<h5><?php echo e($val_3); ?></h5>
<h5><?php echo e($val_4); ?></h5>

<table border="0">
<tr style="background-color:#c7c7c7;">
<th style="width:100px;">Date</th>
<th style="width:150px;">Reference</th>
<th style="width:230px;">Description</th>
<th style="width:100px;">Debit</th>
<th style="width:100px;">Credit</th>
</tr>

<?php $total_due=0;?>
<?php $__currentLoopData = $branch_invoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch_inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td><?php echo e($branch_inv->date_invoiced); ?></td>
<td>PIC<?php echo e($branch_inv->id); ?></td>
<td>Advanced Intelligence System</td>   
<td>R<?php echo e(number_format(($branch_inv->total_price) + ($branch_inv->total_price*0.15),2)); ?></td>
<td></td>
</tr>
<?php $total_due+=$branch_inv->total_price + ($branch_inv->total_price*0.15); ?>

 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<tfoot>
<tr style="background-color:#c7c7c7;">
<td colspan="3">&nbsp;</td>
<td><b>Amount Due:</b></td>
<td>R <?php echo e($total_due); ?> </td>
</tr>
</tfoot>
</table>
</body>
</html>
