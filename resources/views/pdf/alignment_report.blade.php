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
            <td style="color:gray"> : {{ strtoupper($vehicle) }}</td>
        <td style="width:120px;">VIN </td> 
        <td style="color:gray"> : {{ strtoupper($VIN) }}</td>
        </tr>
        <tr>
            <td style="width:180px;">REGISTRATION </td>
            <td style="color:gray"> : {{  strtoupper($regNo) }}</td>
        <td style="width:120px;">Date </td>
        <td style="color:gray"> : {{ $date.' '.$time }}</td>
        </tr>
       <tr>
        <td style="width:180px;">Odometer</td>
        <td style="color:gray"> : {{  $odometer }}</td>
        <td style="width:120px;">Ref No</td>
        <td style="color:gray"> : {{ $RO }}</td>
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
    <td align="" style=" width:80px; color:;">{{  $intial_1 }}&#176;<br/>{{  number_format($intial_2, 2, ',', ' ') }}&#176;</td>
    <td align="">{{  number_format($Specifications_1, 2, '.', ' ') }}&#176;<br/>{{  number_format($Specifications_2, 2, '.', ' ') }}&#176;</td>
    <td align="">{{ number_format($Specifications_1max, 2, '.', ' ') }}&#176;<br/>{{ number_format($Specifications_2max, 2, '.', ' ') }}&#176;</td>
    <td align="">{{  number_format($final_1, 2, '.', ' ') }}&#176;<br/>{{ number_format($final_2, 2, '.', ' ') }}&#176;</td>                  
    </tr>


   <tr><td colspan="6"></td></tr>
    
    <tr>
        <td >Camber</td>
        <td  style="color:;">Left<br/>Right</td>
        <td align="">{{ number_format($intial_3, 2, ',', ' ') }}&#176;<br/>{{ number_format($intial_4, 2, ',', ' ') }}&#176;</td>
        <td align="">{{ number_format($Specifications_3, 2, '.', ' ') }}&#176;<br/>{{ number_format($Specifications_4, 2, '.', ' ') }}&#176;</td>
        <td align="">{{ number_format($Specifications_3max, 2, '.', ' ') }}&#176;<br/>{{ number_format($Specifications_4max, 2, '.', ' ') }}&#176;</td>
        <td align="">{{ number_format($final_3, 2, '.', ' ') }}&#176;<br/>{{ number_format($final_4, 2, '.', ' ') }}&#176;</td>
    </tr>
    

<tr><td colspan="6"></td></tr>

<tr>
    <td style="color:;">Toe</td>
    <td style="color:;">Left<br/>Right</td>
    <td align="">{{ number_format($intial_5, 2, ',', ' ') }}&#176;<br/>{{ number_format($intial_6, 2, ',', ' ') }}&#176;</td>
    <td align="">{{ number_format($Specifications_5, 2, '.', ' ') }}&#176;<br/>{{ number_format($Specifications_6, 2, '.', ' ') }}&#176;</td>
    <td align="">{{ number_format($Specifications_5max, 2, '.', ' ') }}&#176;<br/>{{ number_format($Specifications_6max, 2, '.', ' ') }}&#176;</td>
    <td align="">{{ number_format($final_5, 2, '.', ' ') }}&#176;<br/>{{ number_format($final_6, 2, '.', ' ') }}&#176;</td>
</tr>
<tr>
    <td></td>
    <td><b>Total</b></td>
    <td align=""><b>{{ number_format($intial_5+$intial_6, 2, '.', ' ') }}</b></td>
    <td align=""><b>{{ number_format($Specifications_5+$Specifications_6, 2, '.', ' ') }}</b></td>
    <td align=""><b>{{ number_format($Specifications_5max+$Specifications_6max, 2, '.', ' ') }}</b></td>
    <td align=""><b>{{ number_format($final_5+$final_6, 2, '.', ' ') }}</b></td>
</tr>
  <tr><td colspan="7"></td></tr>
<tr>
<td rowspan="4" style="width:100px;">
<br/>
<h1>Rear</h1>
</td>
    <td align="" style="color:;">Camber</td>
    <td style="color:;">Left<br/>Right</td>
    <td align="">{{ number_format($intial_9, 2, '.', ' ') }}&#176;<br/>{{  number_format($intial_10, 2, '.', ' ') }}&#176;</td>
    <td align="">{{ number_format($Specifications_9, 2, '.', ' ') }}&#176;<br/>{{ number_format($Specifications_10, 2, '.', ' ') }}&#176;</td>
    <td align="">{{ number_format($Specifications_9max, 2, '.', ' ') }}&#176;<br/>{{ number_format($Specifications_10max, 2, '.', ' ') }}&#176;</td>
    <td align="">{{ number_format($final_9, 2, '.', ' ') }}&#176;<br/>{{ number_format($final_10, 2, '.', ' ') }}&#176;</td>
</tr>

<tr><td colspan="5"></td></tr>

<tr>
    <td  style="color:;">Toe</td>
    <td style="color:;">Left<br/>Right</td>
    <td align="">{{ number_format($intial_11, 2, '.', ' ') }}&#176;<br/>{{ number_format($intial_12, 2, '.', ' ') }}&#176;</td>
    <td align="">{{ number_format($Specifications_11, 2, '.', ' ') }}&#176;<br/>{{ number_format($Specifications_12, 2, '.', ' ') }}&#176;</td>
    <td align="">{{ number_format($Specifications_11max, 2, '.', ' ') }}&#176;<br/>{{ number_format($Specifications_12max, 2, '.', ' ') }}&#176;</td>
    <td align="">{{ number_format($final_11, 2, '.', ' ') }}&#176;<br/>{{ number_format($final_12, 2, '.', ' ') }}&#176;</td>
</tr>
<tr>
    <td align="center" style="color:;"></td>
    <td style="color:;"><b>Total</b></td>
    <td align=""><b>{{ number_format($intial_11+$intial_12, 2, '.', ' ') }}</b></td>
    <td align="" style="width:90px;"><b>{{ number_format($Specifications_11+$Specifications_12, 2, '.', ' ') }}</b></td>
    <td align="" style="width:90px;"><b>{{ number_format($Specifications_11max+$Specifications_11max, 2, '.', ' ') }}</b></td>
    <td align=""><b>{{ number_format($final_11+$final_12, 2, '.', ' ') }}</b></td>
</tr>

<tr>

    <!-- #MADE UPDATES HERE  -->
    <td ><b>Thrust Angle</b></td>
    <td style="color:;"></td>
    <td align=""></td>
    <td align="">{{ number_format($intial_7, 2, '.', ' ') }}</td>
    <td align=""></td>
    <!--
    <td align="center" colspan="2" style="width:180px;">{{ number_format($Specifications_7, 2, '.', ' ') }}</td>
    -->
    <td align="">{{ number_format($Specifications_7, 2, '.', ' ') }}</td>
    <td  align="">{{ number_format($final_7, 2, '.', ' ') }}</td>
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
        <td align="right">{{ number_format($intial_13, 2, '.', ' ') }}&#176;<br/>{{ $intial_14 }}&#176;</td>
       <td align="right">{{ $Specifications_13 }}<br/>{{ $Specifications_14 }}
       </td>
        <td align="right">{{ $Specifications_15 }}<br/>{{ $Specifications_16 }}
        </td>
        <td align="right">{{ number_format($final_13, 2, '.', ' ') }}&#176;<br/>{{ $final_14 }}&#176;
        </td>
        
    </tr> 
    <tr>
    <td colspan="6"></td>
    </tr>
     <tr>
        <td>Included Angles</td>
        <td>Left <br/>Right</td>
        <td align="right">{{ $intial_15 }}&#176;<br/>{{ $intial_16 }}&#176;</td>
       <td align="right">{{ $Specifications_17 }}<br/>{{ $Specifications_18 }}
       </td>
        <td align="right">{{ $Specifications_19 }}<br/>{{ $Specifications_20 }}
        </td>
        <td align="right">{{ $final_15 }}&#176;<br/>{{ $final_16}}&#176;
        </td>
    </tr> 
    <tr>
    <td colspan="6"></td>
    </tr>
      <tr>
        <td>Toe Out On Turns</td>
        <td>Left <br/>Right</td>
        <td align="right">{{ $intial_17 }}<br/>{{ $intial_18 }}</td>
       <td align="right">{{ $Specifications_21 }}<br/>{{ $Specifications_22 }}
       </td>
        <td align="right">{{ $Specifications_23 }}<br/>{{ $Specifications_24 }}
        </td>
        <td align="right">{{ $final_17 }}<br/>{{ $final_18 }}
        </td>
    </tr> 
    <tr>
    <td colspan="6"></td>
    </tr>
     <tr>
        <td>Maximum Turns</td>
        <td>Left <br/>Right</td>
        <td align="right">{{ $intial_19 }}<br/>{{ $intial_20 }}</td>
       <td align="right">{{ $Specifications_25 }}<br/>{{ $Specifications_26 }}
       </td>
        <td align="right">{{ $Specifications_27 }}<br/>{{ $Specifications_28 }}
        </td>
        <td align="right">{{ $final_19 }}<br/>{{ $final_20 }}
        </td>
    </tr> 
    <tr>
    <td colspan="6"></td>
    </tr>
     <tr>
        <td>Toe Curve Change</td>
        <td>Left <br/>Right</td>
        <td align="right">{{ $intial_21 }}<br/>{{ $intial_22 }}</td>
       <td align="right">{{ $Specifications_29 }}<br/>{{ $Specifications_30 }}
       </td>
        <td align="right">{{ $Specifications_31 }}<br/>{{ $Specifications_32 }}
        </td>
        <td align="right">{{ $final_21 }}<br/>{{ $final_22 }}
        </td>
    </tr> 
    <tr>
    <td colspan="6"></td>
    </tr>
     <tr>
        <td>Setback</td>
        <td>Left <br/>Right</td>
        <td align="right">{{ $intial_23 }}<br/>{{ $intial_24 }}</td>
       <td align="right">{{ $Specifications_33 }}<br/>{{ $Specifications_34 }}
       </td>
        <td align="right">{{ $Specifications_35 }}<br/>{{ $Specifications_36 }}
        </td>
        <td align="right">{{ $final_23 }}<br/>{{ $final_24 }}
        </td>
    </tr> 
    <tr>
    <td colspan="6"></td>
    </tr>
     <tr>
         <td>Track Width Diff<br>Wheel Base Diff</td>
        <td></td>
        <td align="right">{{ $intial_25 }}<br/>{{ $intial_26 }}</td>
       <td align="right">{{ $Specifications_37 }}<br/>{{ $Specifications_38 }}
       </td>
        <td align="right">{{ $Specifications_39 }}<br/>{{ $Specifications_40 }}
        </td>
        <td align="right">{{ $final_25 }}<br/>{{ $final_26 }}
        </td>
    </tr> 
     <tr>
        <td>Front Ride Height</td>
        <td>Left <br/>Right</td>
        <td align="right">{{ $intial_27 }}<br/>{{ $intial_28 }}</td>
       <td align="right">{{ $Specifications_41 }}<br/>{{ $Specifications_42 }}
       </td>
        <td align="right">{{ $Specifications_43 }}<br/>{{ $Specifications_44 }}
        </td>
        <td align="right">{{ $final_27 }}<br/>{{ $final_28 }}
        </td>
    </tr> 
    <tr>
    <td colspan="6"></td>
    </tr>
     <tr>
        <td>Rear Ride Height</td>
        <td>Left <br/>Right</td>
        <td align="right">{{ $intial_29 }}<br/>{{ $intial_30 }}</td>
       <td align="right">{{ $Specifications_45 }}<br/>{{ $Specifications_46 }}
       </td>
        <td align="right">{{ $Specifications_47 }} <br/> {{ $Specifications_48 }}
        </td>
        <td align="right">{{ $final_29 }}<br/>{{ $final_30 }}
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
        <td align="right">{{ $frame }}
        </td>
    </tr>
    </table>
    <br/>
    <p align="center" style="font-family:courier; ">
    <b>ALIGNMENT GUARANTEED FOR 7 DAYS ONLY DUE TO <BR/>POOR ROAD CONDITIONS</b></p>
    
    <p style="font-family:courier; "><b>Comments : </b><br/>
        <font color="gray">
            {{ $comments }}
       </font>
  </p>;






</body>
</html>