<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Time Sheet</title>
    <style>
        .page-break {
            page-break-after: always;
        }
        tr.border_bottom td {
        border-bottom:0.5pt solid black;
        font-family: "Courier New", Times, serif;
        }
        tr.border_bottom th{
            border-bottom:1pt solid black;
        }
        tr:nth-child(even) td {
        background-color: #D3D3D3 !important;
        -webkit-print-color-adjust: exact;
        }
    </style>
    
</head>
<body>
    <h3 style="text-align:center;"><?php echo e($user); ?></h3>
    
    <table style="width:100%;">
        <thead>
            <tr>
                <th style="width:50%;font-weight:bold;color:red;">From:</th>
                <th style="width:50%;font-weight:bold;color:red;">To:</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align:center;">
                <td><b><?php echo e($from); ?></b></td>
                <td><b><?php echo e($to); ?></b></td>
            </tr>
        </tbody>
    </table>
    <table style="width:100%;">
        <thead style="font-weight:bold;color:white;background-color:black;">
            <tr>
                <th>Name</th>
                <th>Job</th>
                <th>Started</th>
                <th>Finished</th>
                <th>Time Taken</th>
                <th>Track No.</th>
            </tr>
        </thead>
        <tbody style="font-size:12px;text-align:center;">
            <?php $__currentLoopData = $user_clocking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clocking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <tr>
                <td><?php echo e($clocking->user); ?></td>
                <td><?php echo e($clocking->stage); ?></td>
                <td><?php echo e($clocking->start); ?></td>
                <td><?php echo e($clocking->end); ?></td>
                <td><?php echo e(number_format((strtotime($clocking->end)-strtotime($clocking->start))/3600,2)); ?> Hrs.</td>
                <td><?php echo e($clocking->Key_Ref); ?></td>
             </tr>   
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</body>
</html>