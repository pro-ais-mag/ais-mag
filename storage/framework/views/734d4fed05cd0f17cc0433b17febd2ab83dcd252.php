<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alignment Report</title>
   
</head>
<body>

        <!--- #### START HERE  -->
        <!--- # PUT PRINT HERE -->
    <table style="font-size:18px; font-family:courier;" align="center">
        <tr><td colspan="2">
        <b>CORGHI</b>
        <br>
        <b>Wheel Alignment Report</b>
     
        </td></tr>
        </table><br/>
        <br/>
        <table style="font-size:10px; font-family:courier;">
        <tr>
            <td style="width:180px;">MAKE/MODEL</td>
            <td style="color:gray"> : <?php echo e(strtoupper($vehicle)); ?></td>
        <td style="width:120px;">VIN </td> 
        <td style="color:gray"> : <?php echo e(strtoupper($VIN)); ?></td>
        </tr>
        <tr>
            <td style="width:180px;">REGISTRATION </td>
            <td style="color:gray"> : <?php echo e(strtoupper($regNo)); ?></td>
        <td style="width:120px;">Date </td>
        <td style="color:gray"> : <?php echo e($date.' '.$time); ?></td>
        </tr>
       <tr>
        <td style="width:180px;">Odometer</td>
        <td style="color:gray"> : <?php echo e($odometer); ?></td>
        <td style="width:120px;">Ref No</td>
        <td style="color:gray"> : <?php echo e($RO); ?></td>
        </tr>
    </table>

    <br/>

<table style="font-size:10px; font-family:courier;">
     <tr>
        <td align="" style="width:100px;"><h4>Primary Angles</h4></td>
        <td align="right" colspan="2" style="width:180px;"></td>
        <td style=" width:80px;" ><b>Initial</b></td>
        <td align="" colspan="2" style="width:180px;">
        <b>Specifications</b><br/>
         <table>
         <tr>
         <td>Min</td>
         <td>Max</td>
         </tr>
        </table>
     
    </td>
    <td align="" style="width:80px;" ><b>Final</b></td>    
</tr>
 
<tr><td colspan="7" ></td></tr>
<tr>
<td rowspan="6" style="width:100px;" >
<br/>
<h1>Front</h1>
</td>
    <td align="" style=" width:100px; color:;" >Caster</td>
    <td style=" width:80px; color:;">Left<br/>Right&nbsp;&nbsp; </td>
    <td align="" style=" width:80px; color:;"><?php echo e($intial_1); ?>&#176;<br/><?php echo e(number_format($intial_2, 2, ',', ' ')); ?>&#176;</td>
    <td align=""><?php echo e(number_format($Specifications_1, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($Specifications_2, 2, '.', ' ')); ?>&#176;</td>
    <td align=""><?php echo e(number_format($Specifications_1max, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($Specifications_2max, 2, '.', ' ')); ?>&#176;</td>
    <td align=""><?php echo e(number_format($final_1, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($final_2, 2, '.', ' ')); ?>&#176;</td>                  
    </tr>


   <tr><td colspan="6"></td></tr>
    
    <tr>
        <td >Camber</td>
        <td  style="color:;">Left<br/>Right</td>
        <td align=""><?php echo e(number_format($intial_3, 2, ',', ' ')); ?>&#176;<br/><?php echo e(number_format($intial_4, 2, ',', ' ')); ?>&#176;</td>
        <td align=""><?php echo e(number_format($Specifications_3, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($Specifications_4, 2, '.', ' ')); ?>&#176;</td>
        <td align=""><?php echo e(number_format($Specifications_3max, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($Specifications_4max, 2, '.', ' ')); ?>&#176;</td>
        <td align=""><?php echo e(number_format($final_3, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($final_4, 2, '.', ' ')); ?>&#176;</td>
    </tr>
    

<tr><td colspan="6"></td></tr>

<tr>
    <td style="color:;">Toe</td>
    <td style="color:;">Left<br/>Right</td>
    <td align=""><?php echo e(number_format($intial_5, 2, ',', ' ')); ?>&#176;<br/><?php echo e(number_format($intial_6, 2, ',', ' ')); ?>&#176;</td>
    <td align=""><?php echo e(number_format($Specifications_5, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($Specifications_6, 2, '.', ' ')); ?>&#176;</td>
    <td align=""><?php echo e(number_format($Specifications_5max, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($Specifications_6max, 2, '.', ' ')); ?>&#176;</td>
    <td align=""><?php echo e(number_format($final_5, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($final_6, 2, '.', ' ')); ?>&#176;</td>
</tr>
<tr>
    <td></td>
    <td><b>Total</b></td>
    <td align=""><b><?php echo e(number_format($intial_5+$intial_6, 2, '.', ' ')); ?></b></td>
    <td align=""><b><?php echo e(number_format($Specifications_5+$Specifications_6, 2, '.', ' ')); ?></b></td>
    <td align=""><b><?php echo e(number_format($Specifications_5max+$Specifications_6max, 2, '.', ' ')); ?></b></td>
    <td align=""><b><?php echo e(number_format($final_5+$final_6, 2, '.', ' ')); ?></b></td>
</tr>
  <tr><td colspan="7"></td></tr>
<tr>
<td rowspan="4" style="width:100px;">
<br/>
<h1>Rear</h1>
</td>
    <td align="" style="color:;">Camber</td>
    <td style="color:;">Left<br/>Right</td>
    <td align=""><?php echo e(number_format($intial_9, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($intial_10, 2, '.', ' ')); ?>&#176;</td>
    <td align=""><?php echo e(number_format($Specifications_9, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($Specifications_10, 2, '.', ' ')); ?>&#176;</td>
    <td align=""><?php echo e(number_format($Specifications_9max, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($Specifications_10max, 2, '.', ' ')); ?>&#176;</td>
    <td align=""><?php echo e(number_format($final_9, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($final_10, 2, '.', ' ')); ?>&#176;</td>
</tr>

<tr><td colspan="5"></td></tr>

<tr>
    <td  style="color:;">Toe</td>
    <td style="color:;">Left<br/>Right</td>
    <td align=""><?php echo e(number_format($intial_11, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($intial_12, 2, '.', ' ')); ?>&#176;</td>
    <td align=""><?php echo e(number_format($Specifications_11, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($Specifications_12, 2, '.', ' ')); ?>&#176;</td>
    <td align=""><?php echo e(number_format($Specifications_11max, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($Specifications_12max, 2, '.', ' ')); ?>&#176;</td>
    <td align=""><?php echo e(number_format($final_11, 2, '.', ' ')); ?>&#176;<br/><?php echo e(number_format($final_12, 2, '.', ' ')); ?>&#176;</td>
</tr>
<tr>
    <td align="center" style="color:;"></td>
    <td style="color:;"><b>Total</b></td>
    <td align=""><b><?php echo e(number_format($intial_11+$intial_12, 2, '.', ' ')); ?></b></td>
    <td align="" style="width:90px;"><b><?php echo e(number_format($Specifications_11+$Specifications_12, 2, '.', ' ')); ?></b></td>
    <td align="" style="width:90px;"><b><?php echo e(number_format($Specifications_11max+$Specifications_11max, 2, '.', ' ')); ?></b></td>
    <td align=""><b><?php echo e(number_format($final_11+$final_12, 2, '.', ' ')); ?></b></td>
</tr>

<tr>

    <!-- #MADE UPDATES HERE  -->
    <td ><b>Thrust Angle</b></td>
    <td style="color:;"></td>
    <td align=""></td>
    <td align=""><?php echo e(number_format($intial_7, 2, '.', ' ')); ?></td>
    <td align=""></td>
    <!--
    <td align="center" colspan="2" style="width:180px;"><?php echo e(number_format($Specifications_7, 2, '.', ' ')); ?></td>
    -->
    <td align=""><?php echo e(number_format($Specifications_7, 2, '.', ' ')); ?></td>
    <td  align=""><?php echo e(number_format($final_7, 2, '.', ' ')); ?></td>
</tr>
</table><br/>

<br/>

<br/><table  style="font-size:10px; font-family:courier;">
    <tr>
        <td style="width:200px;" ><h4>Secondary Angles</h4></td>
        <td style="width:50px;"></td>
        <td align="right"><b>Initial</b></td>
        <td align="right" colspan="2" style="width:150px;"><b>Specifications</b><br/>
        <table>
        <tr>
          <td>Min</td>
          <td>Max</td>
        </tr>
        </table>
    </td>
       
        <td style="width:80px;" align="right"><b>Final</b></td>
    </tr>
    <tr><td colspan="6"></td></tr>
    <tr>
        <td>SAI</td>
        <td>Left <br/>Right</td>
        <td align="right"><?php echo e(number_format($intial_13, 2, '.', ' ')); ?>&#176;<br/><?php echo e($intial_14); ?>&#176;</td>
       <td align="right"><?php echo e($Specifications_13); ?><br/><?php echo e($Specifications_14); ?>

       </td>
        <td align="right"><?php echo e($Specifications_15); ?><br/><?php echo e($Specifications_16); ?>

        </td>
        <td align="right"><?php echo e(number_format($final_13, 2, '.', ' ')); ?>&#176;<br/><?php echo e($final_14); ?>&#176;
        </td>
        
    </tr> 
    <tr>
    <td colspan="6"></td>
    </tr>
     <tr>
        <td>Included Angles</td>
        <td>Left <br/>Right</td>
        <td align="right"><?php echo e($intial_15); ?>&#176;<br/><?php echo e($intial_16); ?>&#176;</td>
       <td align="right"><?php echo e($Specifications_17); ?><br/><?php echo e($Specifications_18); ?>

       </td>
        <td align="right"><?php echo e($Specifications_19); ?><br/><?php echo e($Specifications_20); ?>

        </td>
        <td align="right"><?php echo e($final_15); ?>&#176;<br/><?php echo e($final_16); ?>&#176;
        </td>
    </tr> 
    <tr>
    <td colspan="6"></td>
    </tr>
      <tr>
        <td>Toe Out On Turns</td>
        <td>Left <br/>Right</td>
        <td align="right"><?php echo e($intial_17); ?><br/><?php echo e($intial_18); ?></td>
       <td align="right"><?php echo e($Specifications_21); ?><br/><?php echo e($Specifications_22); ?>

       </td>
        <td align="right"><?php echo e($Specifications_23); ?><br/><?php echo e($Specifications_24); ?>

        </td>
        <td align="right"><?php echo e($final_17); ?><br/><?php echo e($final_18); ?>

        </td>
    </tr> 
    <tr>
    <td colspan="6"></td>
    </tr>
     <tr>
        <td>Maximum Turns</td>
        <td>Left <br/>Right</td>
        <td align="right"><?php echo e($intial_19); ?><br/><?php echo e($intial_20); ?></td>
       <td align="right"><?php echo e($Specifications_25); ?><br/><?php echo e($Specifications_26); ?>

       </td>
        <td align="right"><?php echo e($Specifications_27); ?><br/><?php echo e($Specifications_28); ?>

        </td>
        <td align="right"><?php echo e($final_19); ?><br/><?php echo e($final_20); ?>

        </td>
    </tr> 
    <tr>
    <td colspan="6"></td>
    </tr>
     <tr>
        <td>Toe Curve Change</td>
        <td>Left <br/>Right</td>
        <td align="right"><?php echo e($intial_21); ?><br/><?php echo e($intial_22); ?></td>
       <td align="right"><?php echo e($Specifications_29); ?><br/><?php echo e($Specifications_30); ?>

       </td>
        <td align="right"><?php echo e($Specifications_31); ?><br/><?php echo e($Specifications_32); ?>

        </td>
        <td align="right"><?php echo e($final_21); ?><br/><?php echo e($final_22); ?>

        </td>
    </tr> 
    <tr>
    <td colspan="6"></td>
    </tr>
     <tr>
        <td>Setback</td>
        <td>Left <br/>Right</td>
        <td align="right"><?php echo e($intial_23); ?><br/><?php echo e($intial_24); ?></td>
       <td align="right"><?php echo e($Specifications_33); ?><br/><?php echo e($Specifications_34); ?>

       </td>
        <td align="right"><?php echo e($Specifications_35); ?><br/><?php echo e($Specifications_36); ?>

        </td>
        <td align="right"><?php echo e($final_23); ?><br/><?php echo e($final_24); ?>

        </td>
    </tr> 
    <tr>
    <td colspan="6"></td>
    </tr>
     <tr>
         <td>Track Width Diff<br>Wheel Base Diff</td>
        <td></td>
        <td align="right"><?php echo e($intial_25); ?><br/><?php echo e($intial_26); ?></td>
       <td align="right"><?php echo e($Specifications_37); ?><br/><?php echo e($Specifications_38); ?>

       </td>
        <td align="right"><?php echo e($Specifications_39); ?><br/><?php echo e($Specifications_40); ?>

        </td>
        <td align="right"><?php echo e($final_25); ?><br/><?php echo e($final_26); ?>

        </td>
    </tr> 
     <tr>
        <td>Front Ride Height</td>
        <td>Left <br/>Right</td>
        <td align="right"><?php echo e($intial_27); ?><br/><?php echo e($intial_28); ?></td>
       <td align="right"><?php echo e($Specifications_41); ?><br/><?php echo e($Specifications_42); ?>

       </td>
        <td align="right"><?php echo e($Specifications_43); ?><br/><?php echo e($Specifications_44); ?>

        </td>
        <td align="right"><?php echo e($final_27); ?><br/><?php echo e($final_28); ?>

        </td>
    </tr> 
    <tr>
    <td colspan="6"></td>
    </tr>
     <tr>
        <td>Rear Ride Height</td>
        <td>Left <br/>Right</td>
        <td align="right"><?php echo e($intial_29); ?><br/><?php echo e($intial_30); ?></td>
       <td align="right"><?php echo e($Specifications_45); ?><br/><?php echo e($Specifications_46); ?>

       </td>
        <td align="right"><?php echo e($Specifications_47); ?> <br/> <?php echo e($Specifications_48); ?>

        </td>
        <td align="right"><?php echo e($final_29); ?><br/><?php echo e($final_30); ?>

        </td>
    </tr>
     <tr>
        <td>Frame Angle</td>
        <td></td>
        <td align="right"></td>
       <td align="right">
       </td>
        <td align="right">
        </td>
        <td align="right"><?php echo e($frame); ?>

        </td>
    </tr>
    </table>
    <br/>
    <p align="center" style="font-family:courier; ">
    <b>ALIGNMENT GUARANTEED FOR 7 DAYS ONLY DUE TO <BR/>POOR ROAD CONDITIONS</b></p>
    
    <p style="font-family:courier; "><b>Comments : </b><br/>
        <font color="gray">
            <?php echo e($comments); ?>

       </font>
  </p>;






</body>
</html>