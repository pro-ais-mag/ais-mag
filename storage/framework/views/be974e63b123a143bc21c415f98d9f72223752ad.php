<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proforma Invoice</title>
</head>
<body>
    <table border="0">

<tr>
<td style="font-size:14px;"><b>MOTOR ACCIDENT GROUP TOWING SERVICES</b></td>
<td style="font-size:14px;"><b>Proforma Invoice</b></td>
</tr>

<tr>
<td style="width:470px;font-size:12px;">J.A MAG INVESTMENT(Pty)</td>
<td style="width:30px;font-size:12px;">Tel</td>
<td style="width:180px;font-size:10px;">:010 591 7550</td>
</tr>

<tr>
<td style="font-size:12px;">15 Richard Street</td>
<td style="font-size:12px;">Mail</td>
<td style="font-size:12px;">:towing@motoraccidentgroup.co.za</td>
</tr>

<tr>
<td style="font-size:12px;">Selby,2001</td>
<td style="font-size:12px;">Web</td>
<td style="font-size:12px;">:wwww.motoraccidentgroup.co.za</td>
</tr>

<tr>
<td style="font-size:12px;">Company VAT REG: 4860258427</td>
<td style="font-size:12px;">Inv</td>
<td style="font-size:12px;">Invoice_number</td>
</tr>

<tr>
<td style="font-size:12px;">Company REG NO: 2001/018609/23</td>
<td style="font-size:12px;">Date</td>
<td style="font-size:12px;"><?php echo e(date('Y-m-d')); ?></td>
</tr>

</table>

<br>

<table border="0">
<tr style="background-color:black;color:white;heigt:25px;">
<td style="width:202px;font-size:12px;"><b>INVOICE TO</b></td>
<td style="width:228px;font-size:12px;"><b>Client Details</b></td>
<td style="width:200px;font-size:12px;"><b>Insurance Details</b></td>
</tr>
<?php $__currentLoopData = $receipt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr style="color:gray;font-size:12px;">
<td></td>
<td>Reg: <?php echo e($details->Reg_No); ?> <br><?php echo e($details->make); ?> - <?php echo e($details->model); ?><br><?php echo e($details->Fisrt_Name); ?> - <?php echo e($details->Last_Name); ?></td>
<td>Insurer:<?php echo e($details->insurer); ?></td>
</tr>

<tr style="color:gray;font-size:12px;">
<td></td>
<td></td>
<td>Assessor:<?php echo e($details->assessor); ?><br><?php echo e($details->assessor_cell); ?><br><?php echo e($details->assessor_email); ?></td>
</tr>

<tr style="color:gray;font-size:12px;">
<td></td>
<td></td>
<td></td>
</tr>

<tr style="color:gray;font-size:12px;">
<td></td>
<td>Vin: <?php echo e($details->vin); ?></td>
<td></td>
</tr>

<tr style="color:gray;font-size:12px;">
<td>ATT:<?php echo e($details->att_to); ?></td>
<td>KM:<?php echo e($details->km); ?></td>
<td>Claim No: <?php echo e($details->claim_no); ?></td>
</tr>

<tr style="color:gray;font-size:12px;">
<td><?php echo e($details->email); ?></td>
<td></td>
<td>Order No: <?php echo e($details->towing_fee2); ?></td>
</tr>

<tr style="color:gray;font-size:12px;">
<td><?php echo e($details->tel); ?></td>
</tr>

<tr style="color:gray;font-size:12px;">
<td>Vat:<?php echo e($details->vat_no); ?></td>
</tr>
</table>

<hr>



<table border="0">
<tr style="background-color:black;color:white;height:35px;">
<td style="width:202px;font-size:12px;"><b>Description</b></td>
<td style="width:228px;font-size:12px;"><b>Rate</b></td>
<td style="width:228px;font-size:12px;"><b>Amount</b></td>
</tr>

<tr style="background-color:#e6eaf2;">
<td style="font-size:12px;">Towing Fee 1</td>
<td style="font-size:12px;">R <?php echo e(number_format($details->towing_fee1,2)); ?></td>
<td style="font-size:12px;">R<?php echo e(number_format($details->towing_fee1,2)); ?></td>
</tr>

<tr style="background-color:#e6eaf2;">
<td style="font-size:12px;">Towing Fee 2</td>
<td style="font-size:12px;">R <?php echo e(number_format($details->towing_fee2,2)); ?></td>
<td style="font-size:12px;">R <?php echo e(number_format($details->towing_fee2,2)); ?></td>
</tr>

<?php
$storage=0;
    if($details->vehicle=="Car"){
        $storage=$car;
    }elseif($details->vehicle=="Truck"){
        $storage=$truck;
    }
    $subtotal=$details->towing_fee1+$details->towing_fee2+($storage*$details->storage)+($admin*$details->admin)+($security*$details->security)+$details->release_fee;
    $discount=$subtotal *(($details->discount)/100);
    $vat=$subtotal*0.15;
    if($details->status=="0"){
        $status="Pending...";
    }else{
        $status=$details->payment;
    }    
?>


<tr style="background-color:#e6eaf2;">
<td style="font-size:12px;">Storage</td>
<td style="font-size:12px;"><?php echo e($details->storage); ?> Day/s @ R:<?php echo e($storage); ?></td>
<td style="font-size:12px;">R <?php echo e(number_format($details->storage*$storage,2)); ?></td>
</tr>

<tr style="background-color:#e6eaf2;">
<td style="font-size:12px;">Admin</td>
<td style="font-size:12px;"><?php echo e($details->admin); ?> Day/s @ R:<?php echo e(number_format($admin,2)); ?></td>
<td style="font-size:12px;">R <?php echo e(number_format($details->admin * $admin,2)); ?></td>
</tr>

<tr style="background-color:#e6eaf2;">
<td style="font-size:12px;">Security</td>
<td style="font-size:12px;"><?php echo e($details->security); ?> Day/s @ R:<?php echo e(number_format($security)); ?></td>
<td style="font-size:12px;">R <?php echo e(number_format($details->security * $security,2)); ?></td>
</tr>

<tr style="background-color:#e6eaf2;">
<td style="font-size:12px;">Release Fee</td>
<td style="font-size:12px;">R <?php echo e(number_format($details->release_fee,2)); ?></td>
<td style="font-size:12px;">R <?php echo e(number_format($details->release_fee,2)); ?></td>
</tr>

<tr style="background-color:#e6eaf2;">
<td colspan="3" style="height:80px;"></td>
</tr>

<tr>
<td style="font-size:12px;">SUB TOTAL</td>
<td style="font-size:12px;">R<?php echo e(number_format($subtotal,2)); ?></td>
</tr>

<tr>
<td style="font-size:12px;">DISCOUNT %</td>
<td style="font-size:12px;">R <?php echo e(number_format($discount,2)); ?></td>
</tr>

<tr>
<td style="font-size:12px;">VAT 15%</td>
<td style="font-size:12px;">R<?php echo e(number_format($vat,2)); ?></td>
</tr>

<tr>
<td style="font-size:12px;">TOTAL</td>
<td style="font-size:12px;">R<?php echo e(number_format($subtotal-$discount+$vat,2)); ?></td>
</tr>

<tr>
<td style="font-size:12px;">PAYMENT METHOD</td>
<td style="font-size:12px;"><?php echo e($status); ?></td>
</tr>
</table>
<hr>


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<h6>BANKING DETAILS</h6>

<table border="0">

<tr style="background-color:#e6eaf2;font-size:12px;">
<td style="width:150px;">Bank</td>
<td style="width:150px;">:Standard Bank</td>
<td style="width:150px;">Bank</td>
<td style="width:150px;">:First National Bank</td>
</tr>

<tr style="background-color:#e6eaf2;font-size:12px;">
<td>Branch Code</td>
<td>:006 005</td>
<td>Branch Code</td>
<td>:42-205</td>
</tr>

<tr style="background-color:#e6eaf2;font-size:12px;">
<td>Acc No</td>
<td>:281 711 623</td>
<td>Acc No</td>
<td>:6261 611 2827</td>
</tr>

<tr style="background-color:#e6eaf2;font-size:12px;">
<td>Acc Name</td>
<td>:J.A MAG INVESTMENT</td>
<td>Acc Name</td>
<td>:J.A MAG INVESTMENT</td>
</tr>
</table>

<h6>TERMS AND CONDITIONS</h6>

<div style="border:2px solid black;color:gray;font-size:8px;">
1.Strickly c.o.d<br>
2.For providers that have accounts or SLA with motor accident group will be as per aggrement<br>
3.Interest will be charged at 11.5% after 30 days for account or SLA as per aggrement<br>
4.Fax proof of EFT to ATT:Acount department towing@motoraccidentgroup.co.za<br>
5.Any vehicle repaired or salvaged shall not be released to the owner until the repair costs and/ or salvage and storage costs have been paid in full<br>
6.M.A.G will take no responsibility for loss due to fire or theft unforeseen circumstances<br>
7.M.A.G will take no responsibility for all glass that is removed and fitted at the vehicle owners risk<br>
8.M.A.G will take no responsibility for Alarm, Cameras, SD cards that are left in the vehicle: this is vehicle owners responsibility<br>
9.Insurance Excess and Payments is payable before vehicle release<br>
10.Credit Card transaction are subject to 5% transaction fee<br>
11.The storage is charged for light vehicles at R250/day including vat<br>
12.Storage is charged for heavy vehicles at R455/day including vat<br>
13.Suppliers are obliged to repair, refund or replace the failed, defective or unsafe products<br>
14.If a vehicle is insured the owner of the vehicle shall remain liable for the repair, salvage and storage costs until the insurer makes payments of such costs<br>
15.No cheques accepted
</div>
</body>
</html>