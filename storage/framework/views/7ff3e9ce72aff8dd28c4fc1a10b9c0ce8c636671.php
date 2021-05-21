<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pre Booking Print</title>
    
</head>
<style>
tr:nth-child(even) td {
background-color: #D3D3D3 !important;
-webkit-print-color-adjust: exact;
}
</style>

<body>
    <div style="text-align:center;text-style:underline;color:red;text-size:16px;text-decoration:underline;"><b><h4>Pre-Booking List</h4></b></div>
    <h5 style="text-align:center;text-style:underline;color:red;text-size:16px;"><b><?php echo e($from_date); ?> - <?php echo e($to_date); ?></b></h5>
    <br>
    <table>
        <thead style="background-color:#D3D3D3;text-decoration:underline;font-size:12px">
            <tr>
                <th>#</th>
                <th>Ref</th>
                <th>Client</th>
                <th>Cell Number</th>
                <th>Reg No</th>
                <th>Make</th>
                <th>Estimator</th>
                <th>Insurer</th>
                <th>Booking Date(1)</th>
                <th>Booking Date(2)</th>
                <th>Booking Date(3)</th>
                <th>Booking Date(4)</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody style="text-size:8px;font-size:10px;text-align:center;">
        <?php $counter=1;?>
        <?php $__currentLoopData = $prebooking_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pre_booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
        <tr>
            <td><?php echo e($counter); ?></td>
            <td><?php echo e($pre_booking->Key_Ref); ?></td>
            <td><?php echo e($pre_booking->Fisrt_Name); ?> - <?php echo e($pre_booking->Last_Name); ?></td>
            <td><?php echo e($pre_booking->Cell_number); ?></td>
            <td><?php echo e($pre_booking->Reg_No); ?></td>
            <td><?php echo e($pre_booking->Make); ?> - <?php echo e($pre_booking->Model); ?></td>
            <td><?php echo e($pre_booking->Estimator); ?></td>
            <td><?php echo e($pre_booking->Inserer); ?></td>
            <td><?php echo e($pre_booking->booking_date1); ?></td>
            <td><?php echo e($pre_booking->booking_date2); ?></td>
            <td><?php echo e($pre_booking->booking_date3); ?></td>
            <td><?php echo e($pre_booking->booking_date4); ?></td>
            <td style="width:155px"><?php echo e($pre_booking->comment); ?></td>
        </tr>
        <?php $counter++;?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</body>


</html>    
