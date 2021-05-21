<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itemized Consumarables</title>
    <style>
    .page_break { 
        page-break-before: always; 
    }
    </style>
</head>
<body>
    <h3 style="text-align:center;"><b>MOTOR ACCIDENT GROUP</b></h3>
    <h3 style="text-align:center;"><b>Itemized Consumables</b></h3>
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
<div class="page_break"></div>
    <h3 style="text-align:center;">CONSUMABLES REPORT</h3>

    <table width="50%" style="font-size:12px;font-weight:bold;">
    <tr style="background-color:black;color:white;">
    <td style="width:150px;">Receiver</td>
    <td style="width:80px;">Quantity</td>
    <td style="width:150px;">Amount Spent</td>
    </tr>
    <?php echo $user_data;?>
    </table>
    
    <table width="50%" style="font-size:12px;font-weight:bold;">
    <tr style="background-color:black;color:white;">
    <td style="width:150px;">Cartergory</td>
    <td style="width:80px;">Quantity</td>
    <td style="width:150px;">Amount</td>
    </tr>

    <tr>
    <td>Sundries</td>
    <td><?php echo e($q_sundries); ?></td>
    <td><?php echo e($sundries); ?></td>
    </tr>

    <tr>
    <td>Paint Supplies</td>
    <td><?php echo e($q_paint_sup); ?></td>
    <td><?php echo e($paint_sup); ?></td>
    </tr>

    <tr>
    <td>Waste Disposal</td>
    <td><?php echo e($q_waste); ?></td>
    <td><?php echo e($waste); ?></td>
    </tr>

    <tr>
    <td>Inhouse Stock</td>
    <td><?php echo e($q_inhouse); ?></td>
    <td><?php echo e($inhouse); ?></td>
    </tr>
    
    </table>

</hr><br>
<table width="100%" style="font-size:12px;">
<tr style="background-color:black;color:white;font-size:12px;font-weight:bold;">
<th>ALLOWED</th>
<th>AMOUNT</th>
<th>SPENT</th>
<th>AMOUNT</th>
<th>DIFFERENCE</th>
</tr>
<tr >
<td><b>Sundries</b></td>
<td><?php echo e(number_format($a_sundries,2)); ?></td>
<td>Sundries</td>
<td><?php echo e($sundries); ?></td>
<td><?php echo e($d_sundries = number_format($a_sundries - $sundries,2)); ?></td>
</tr>

<tr>
<td><b>Paint Supplies</b></td>
<td><?php echo e(number_format($a_spaint_supplies,2)); ?></td>
<td>Paint Supplies</td>
<td><?php echo e($paint_sup); ?></td>
<td><?php echo e($d_paint_supplies = number_format($a_spaint_supplies - $paint_sup,2)); ?></td>
</tr>

<tr>
<td><b>Waste Disposal</b></td>
<td><?php echo e(number_format($a_waste,2)); ?></td>
<td>Waste Disposal</td>
<td><?php echo e(number_format($waste,2)); ?></td>
<td><?php echo e($d_waste = number_format($a_waste - $waste,2)); ?></td>
</tr>

<tr>
<td><b>Inhouse Stock</b></td>
<td><?php echo e(number_format($a_inpart,2)); ?></td>
<td>Inhouse Stock</td>
<td><?php echo e($inhouse); ?></td>
<td><?php echo e($d_inhouse = number_format($a_inpart - $inhouse,2)); ?></td>
</tr>

<tr style="background-color:#e6e6e6;">

<td><b>Total</b></td>
<td><?php echo e(number_format($a_sundries+$a_spaint_supplies+$a_waste+$a_inpart,2)); ?></td>
<td>Total</td>
<td><?php echo e(number_format($sundries+$paint_sup+$waste+$inhouse,2)); ?></td>
<td><?php echo e(number_format($a_sundries+$a_spaint_supplies+$a_waste+$a_inpart-($sundries+$paint_sup+$waste+$inhouse),2)); ?></td>
</tr>

</table>

</br><br>
<?php echo $html;?>
</body>
</html>