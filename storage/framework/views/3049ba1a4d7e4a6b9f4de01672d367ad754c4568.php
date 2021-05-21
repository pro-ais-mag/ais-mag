<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print WIP Report</title>
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
    <table style="font-size:12px;width:100%;">
                <tbody>
                    <tr><td style="font-size:16px;text-align:center;" colspan="2"><b>WIP REPORT - <?php echo e($user); ?></b></td></tr>   
                    <tr style="text-align:center;background-color:black;color:white;">
                        <td style="font-size:14px;background-color:black;color:white;text-align:center;">FROM: <b> <?php echo e($from); ?></b></td>
                        <td style="font-size:14px;background-color:black;color:white;text-align:center;">TO: <b><?php echo e($to); ?></b></td>
                    </tr>
                </tbody>
    </table>
     <br>
     <table width="100%">
        <thead>
            <tr style="text-align:center;background-color:black;color:white;font-size:12px;">
                <th>Track No.</th>
                <th>Make.</th>
                <th>Registration</th>
                <th>Stage</th>
                <th>Comment</th>
                <th>Date</th>
            </tr>
        </thead>     
        <tbody>
    <?php $__currentLoopData = $user_wip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>)
            <tr style="border-collapse: collapse;border: 1px solid black;text-align:center;font-size:12px;">
                <td><?php echo e($report->Key_Ref); ?></td>
                <td><?php echo e($report->Make); ?></td>
                <td><?php echo e($report->Reg_No); ?></td>
                <td><?php echo e($report->stage); ?></td>
                <td><?php echo e($report->picture_comment); ?></td>
                <td><?php echo e($report->date); ?>  <?php echo e($report->time); ?></td>
            </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
        </tbody>
     </table>
        <br>
     <table style="width:100%;font-size:12px;">
        <tbody>
        <tr>
            <td style="width:75%;text-align:right;"><b>Number Of Vehicles</b></td>
            <td style="width:25%;text-align:right;"><?php echo e($count_vehicle); ?></td>    
        </tr>
        <tr>
            <td style="width:75%;text-align:right;"><b>Total Number Of Images Taken</b></td>
            <td style="width:25%;text-align:right;"><?php echo e($count_image); ?></td>    
        </tr>
        <tr>
            <td style="width:75%;text-align:right;"><b>Total Number Of Comments</b></td>
            <td style="width:25%;text-align:right;"><?php echo e($count_comments); ?></td>    
        </tr>
        </tbody>
    </table>
</body>
</html>