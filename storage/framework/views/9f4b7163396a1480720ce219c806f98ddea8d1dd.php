<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assessor Print</title>
    
</head>
<style>
tr:nth-child(even) td {
background-color: #D3D3D3 !important;
-webkit-print-color-adjust: exact;
}
</style>

<body>
    <div style="text-align:center;text-style:underline;color:red;text-size:16px;text-decoration:underline;"><b><h4>Assessor Details</h4></b></div>
    
    <br>
    <table>
        <thead style="background-color:#D3D3D3;text-decoration:underline;font-size:12px;">
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Company Name</th>
                <th>Telephone</th>
                <th>Cellphone</th>
                <th>Email Address</th>
            </tr>
        </thead>
        <tbody style="font-size:10px;text-align:center;">
        <?php $__currentLoopData = $assessor_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assessor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
        <tr>
            <td><?php echo e($assessor->id); ?></td>
            <td><?php echo e($assessor->Names); ?></td>
            <td><?php echo e($assessor->Company); ?></td>
            <td><?php echo e($assessor->Tel); ?></td>
            <td><?php echo e($assessor->Cell); ?></td>
            <td><?php echo e($assessor->Email); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</body>


</html>    
