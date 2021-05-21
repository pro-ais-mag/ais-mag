<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print All Parts</title>
</head>
<body>
<table style="font-family:; font-size:11px;width:100%;">
<tr><td></td> <td style="width:160px;"></td><td></td> <td></td></tr>

<tr><td><h2><u>PARTS LIST</u></h2></td> <td style="width:160px;"></td><td></td><td></td></tr>
<tr><td></td> <td style="width:160px;"></td><td></td> <td></td></tr>

<tr><td style="width:70px;text-align:right;"><b>Owner</b></td><td style="width:210px;">:<?php echo e(strtoupper($owner)); ?></td><td style="text-align:right;"><b>Inserer</b></td> <td>:<?php echo e(strtoupper($insurer)); ?></td></tr>
<tr><td style="text-align:right;"><b>Vehicle</b></td><td>:<?php echo e(strtoupper($vehicle)); ?></td><td style="text-align:right;"><b>Claim NO</b></td> <td>:<?php echo e($Claim_NO); ?></td></tr>
<tr><td style="text-align:right;"><b>Reg No.</b></td><td>:<?php echo e(strtoupper($reg)); ?></td><td style="text-align:right;"><b>Assessor</b></td><td>:<?php echo e(strtoupper($Assessor)); ?></td></tr>
<tr>
<td style="width:70px;text-align:right;"><b>VIN</b> 	</td> 
<td style="width:210px;">:<?php echo e(strtoupper($Chasses_No)); ?></td>
    <td><b></b> </td>
</tr>
</table>
</hr>
<table style="width:100%;">
   <thead> 
        <tr>
            <th>No.</th>
            <th></th>
            <th>Description</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Outwork</th>
        </tr>
   </thead>
   <hr/>
   <tbody style="font-size:10px;text-align:center;">
        <?php $count=1;?>    
        <?php $__currentLoopData = $parts_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($count); ?></td>
            <td><?php echo e($parts->Oper); ?></td>
            <td><?php echo e($parts->Description); ?></td>
            <td><?php echo e($parts->Quantity); ?></td>
            <td>:R<?php echo e($parts->Part); ?></td>
            <td><?php echo e($parts->Misc); ?></td>
        </tr>
        <?php $count++;?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   </tbody>     
</table>

</body>
</html>