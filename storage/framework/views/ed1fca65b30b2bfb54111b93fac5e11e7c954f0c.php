<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumables</title>
</head>
<body>
<h3 style="text-align:center;"><b>MOTOR ACCIDENT GROUP</b></h3>
    <h3 style="text-align:center;"><b>Consumables</b></h3>
    <h3 style="text-align:center;"><b><?php echo e($id); ?></b></h3>

    <table width="100%" style="font-size:12px;">
        <tr style="background-color:black;color:white;font-weight:bold;">
            <th>No</th>
            <th>Cartergory</th>
            <th>Description</th>
            <th style="text-align:center;">Qty</th>
            <th>Received By</th>
            <th>Unit Price</th>
            <th>Total</th>
            <th>Date</th>
        </tr>
        <?php echo $data;?>
        <tr style="background-color:black;color:white;"><td colspan="8">&nbsp;</td></tr>

        <tr style="font-weight:bold;">
        <td colspan="5">&nbsp;</td>
        <td>Sundries</td>
        <td><?php echo e(number_format($sundries,2)); ?></td>
        <td>Allowed <?php echo e(number_format($a_sundries,2)); ?></td>
        </tr>

        <tr style="font-weight:bold;">
        <td colspan="5"></td>
        <td>Paint Supplies</td>
        <td><?php echo e(number_format($paint_sup,2)); ?></h4></td>
        <td>Allowed <?php echo e(number_format($a_spaint_supplies,2)); ?></td>
        </tr>

        <tr style="font-weight:bold;">
        <td colspan="5"></td>
        <td>Waste Disposal</td>
        <td><?php echo e(number_format($waste,2)); ?></td>
        <td>Allowed <?php echo e(number_format($a_waste,2)); ?></td>
        </tr>

        <tr style="font-weight:bold;">
        <td colspan="5"></td>
        <td>Inhouse Stock</td>
        <td><?php echo e(number_format($inhouse,2)); ?></td>
        <td>Allowed <?php echo e(number_format($a_inpart,2)); ?></td>
        </tr>

        <tr style="font-weight:bold;">
        <td colspan="5"></td>
        <td>Total Consumables</td>
        <td><?php echo e(number_format($sundries+$paint_sup+$waste+$inhouse+$undefined,2)); ?></td>
        <td>Allowed <?php echo e(number_format($a_sundries+$a_spaint_supplies+$a_waste+$a_inpart,2)); ?></td>
        </tr>

        <tr style="background-color:black;color:white;"><td colspan="8"></td></tr>
</table>
</body>
</html>