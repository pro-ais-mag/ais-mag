<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Note</title>
    <style>
tr:nth-child(even) td {
background-color: #D3D3D3 !important;
-webkit-print-color-adjust: exact;
}
</style>
</head>
<body>
<div style="text-align:center;text-style:underline;color:red;text-size:16px;text-decoration:underline;"><b><h1>Client Note</h1></b></div><br>
        <table style="font-size:8;color:black;text-align:center;">
            <tr style="font-size:8;color:black">
                <?php $__currentLoopData = $client_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td style="font-size:12"><b>CLIENT:</b></td>
                <td style="color:gray;font-size:10;"><b><?php echo e($client->Fisrt_Name); ?> <br><?php echo e($client->Last_Name); ?></b></td>
                <td style="font-size:12"><b>REG NO.:</b></td>
                <td style="color:gray;font-size:10;"><b><?php echo e($client->Reg_No); ?></b></td>
                <td style="font-size:12"><b>TRACK ID:</b></td>
                <td style="color:gray;font-size:10;"><b><?php echo e($client->Key_Ref); ?></b></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </table>

    <p style="font-size:10;"><b>Notes</b></p>
        <table style="font-size:6;color:black;">
            <tr style="background-color:gray;font-size:12;color:white;text-align:center;">
                <td style="width:40px"><b>#</b></td>
                <td style="width:70px"><b>Date</b></td>
                <td style="width:70px"><b>Time</b></td>
                <td style="width:400px"><b>Notes</b></td>
                <td style="width:100px"><b>Added By</b></td>
            </tr>
            <tbody >
                <?php $counter=1;?>
                <?php $__currentLoopData = $note_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr style="text-align:center;font-size:10;">
                    <td><?php echo e($counter); ?></td>
                    <td><?php echo e($notes->date); ?></td>
                    <td><?php echo e($notes->time); ?></td>
                    <td><?php echo e($notes->note); ?></td>
                    <td><?php echo e($notes->user); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table> 
</body>
</html>