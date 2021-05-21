<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Pre-Costing</title>
</head>
<body>
    <h1 style="color:black;font-weight:bold;text-align:center;">Motor Accident Group</h1>
    <h4 style="text-align:center;">PRE COSTING</h4>
    <table style="font-size:10px;font-weight:bold;border-collapse:collapse;border: 1px solid black;width:100%;">
    <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="border: solid 1px black;">Insurance</td>
            <td style="border: solid 1px black;"><?php echo e($client->Inserer); ?></td>
            <td style="border: solid 1px black;">Assessors</td>
            <td style="border: solid 1px black;"><?php echo e($client->Assessor); ?></td>
        </tr>
        <tr>
            <td style="border: solid 1px black;">Insured</td>
            <td style="border: solid 1px black;"><?php echo e($client->Inserer); ?></td>
            <td style="border: solid 1px black;">Claim No.</td>
            <td style="border: solid 1px black;"><?php echo e($client->Claim_NO); ?></td>
        </tr>
        <tr>
            <td style="border: solid 1px black;">Registration</td>
            <td style="border: solid 1px black;"><?php echo e($client->Reg_No); ?></td>
            <td style="border: solid 1px black;">Ref No.</td>
            <td style="border: solid 1px black;"><?php echo e($client->Key_Ref); ?></td>
        </tr>
        <tr>
            <td style="border: solid 1px black;">Vehicle</td>
            <td style="border: solid 1px black;"><?php echo e($client->Make); ?> <?php echo e($client->Model); ?></td>
            <td style="border: solid 1px black;">Date</td>
            <td style="border: solid 1px black;"></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
    </table><br>

    <table style="width:100%;">
        <thead style="background-color:black;color:white;font-size:10px;font-weight:bold;border-collapse:collapse;">
            <tr>
                <th>No.</th>
                <th>Part Description</th>
                <th>Oper</th>
                <th>Landing Price</th>
                <th>Mark-Up</th>
                <th>Betterment</th>
                <th>Saving</th>
                <th>Additional</th>
                <th>Quoted Price</th>
                <th>Actual Price</th>

            </tr>
        </thead>
        <tbody style="font-size:8px;">
        <?php echo $table;?>
        </tbody>
    </table><br>
    <h6 style="color:grey;font-weight:bold;text-align:center;">Additionals</h6>
    <table style="font-size:10px;">
        <thead style="width:100%;background-color:black;color:white;font-size:8px;font-weight:bold;border-collapse:collapse;">
        <tr>
                <th>No.</th>
                <th>Part Description</th>
                <th>Oper</th>
                <th>Landing Price</th>
                <th>Mark-Up</th>
                <th>Betterment</th>
                <th>Saving</th>
                <th>Additional</th>
                <th>Quoted Price</th>
                <th>Actual Price</th>

            </tr>
        </thead>
        <tbody border: solid 1px black;>
            <?php echo $table_2;?>
        </tbody>
    </table>
</body>
</html>