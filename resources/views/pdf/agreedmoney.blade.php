<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agreed Quote Print</title>
    <style>
            /** 
            * Define the width, height, margins and position of the watermark.
            **/
            #watermark {
                position: fixed;

                /** 
                    Set a position in the page for your image
                    This should center it vertically
                **/
                bottom:   10cm;
                left:     5.5cm;

                /** Change image dimensions**/
                width:    8cm;
                height:   8cm;

                /** Your watermark should be behind every content**/
                z-index:  -1000;
            }
        </style>
</head>
<body>
    <div style="text-align:center;"><b>Motor Accident Group</b></div>
    <img src="img/letter_head.png">
        <p style="text-align:center;font-size:8"><b>AGREED QUOTE</b><br> <span style="font-size:7">Date: {{date('Y-m-d')}}</span></p>
        <table style="font-size:7">
            @foreach($clients as $client)
            <tr>
               <td style="width:80;"><b>Quote No</b></td>
               <td style="font-size:7;width:250">:{{$key}}</td>
               <td style="width:70;"><b>REFERENCE</b></td>
               <td style="font-size:7;width:150;">:</td>
            </tr>
            <tr>
               <td style="width:80;"><b>ESTIMATOR</b></td>
               <td style="font-size:7;width:250">: {{strtoupper($client->Estimator)}}</td>
               <td style="width:70;"><b>VEHICLE/YEAR</b></td>
               <td style="font-size:7;width:150">: {{strtoupper($client->Make)}}  {{$client->Model}}</td>
            </tr>
            <tr>
               <td style="width:80;"><b>CLIENT</b></td>
               <td style="font-size:7;width:250">: {{strtoupper($client->Fisrt_Name)}}  {{strtoupper($client->Last_Name)}}</td>
               <td style="width:70;"><b>COLOR</b></td>
               <td style="font-size:7;width:150">: {{strtoupper($client->Colour)}}</td>
            </tr>
            <tr>
               <td style="width:80;"><b>ADDRESS</b></td>
               <td style="font-size:7;width:250">: {{strtoupper($client->Address_1)}} {{strtoupper($client->Address_2)}}</td>
               <td style="width:70;"><b>REG NO</b></td>
               <td style="font-size:7;width:150">: {{strtoupper($client->Reg_No)}}</td>
            </tr>
            <tr>
               <td style="width:80;"><b>CONTACT</b></td>
               <td style="font-size:7;width:250">: {{strtoupper($client->Contact)}}</td>
               <td style="width:70;"><b>VIN</b></td>
               <td style="font-size:7;width:150">: {{strtoupper($client->Chasses_No)}}</td>
            </tr>
            <tr>
               <td style="width:80;"><b>CELL 2</b></td>
               <td style="font-size:7;width:250">: {{strtoupper($client->Cell_number)}}</td>
               <td style="width:70;"><b>ENG NO</b></td>
               <td style="font-size:7;width:150">: {{strtoupper($client->Eng_No)}}</td>
            </tr>
            <tr>
               <td style="width:80;"><b>EMAIL</b></td>
               <td style="font-size:7;width:250">: {{strtoupper($client->Email)}}</td>
               <td style="width:70;"><b>ODOMETER</b></td>
               <td style="font-size:7;width:150">: {{strtoupper($client->KM)}}</td>
            </tr>
            @endforeach
            @foreach($insurers as $insurer)
            <tr>
               <td style="width:80;"><b>EXCESS</b></td>
               <td style="font-size:7;width:250">: 0.00</td>
               <td style="width:70;"><b>INSURANCE</b></td>
               <td style="font-size:7;width:150">: {{$insurer->Inserer}}</td>
            </tr>
            <tr>
               <td style="width:80;"><b>ASSESSOR</b></td>
               <td style="font-size:7;width:250">: {{$insurer->Assessor}}</td>
               <td style="width:70;"><b>PHONE</b></td>
               <td style="font-size:7;width:150">: {{$insurer->Contact}}</td>
            </tr>
            <tr>
               <td style="width:80;"><b>VENDOR NUMBER</b></td>
               <td style="font-size:7;width:250">:{{$insurer->vendor_no}}</td>
               <td style="width:70;"><b>EMAIL</b></td>
               <td style="font-size:7;width:150">: {{$insurer->Email}}</td>
            </tr>
            <tr>
               <td style="width:80;"><b></b></td>
               <td style="width:250;"></td>
               <td style="width:70;"><b>CLAIM NO</b></td>
               <td style="font-size:7;width:150;">: {{$insurer->Claim_NO}}</td>
            </tr>
            @php $laborRate=$insurer->labour; $paintRate=$insurer->Paint;$stripRate=$insurer->Strip;$frameRate=$insurer->Frame;$paintSupply=$insurer->PaintSup;$shopSupply=$insurer->ShopSup;$waste=$waste_total;@endphp
            
            @endforeach
            
        </table><br><br>
        <div id="watermark">
            <img src="img/agreed.png" height="100%" width="100%" />
        </div>
        <table style="font-size:7;width:520">
            <thead>
                <tr style="background-color:lightgrey">
                    <td style="width:20;font-size:7;text-align:left;"><b>#</b></td>
                    <td style="width:50;font-size:7;text-align:left;"><b>Oper</b></td>
                    <td style="width:120;font-size:7;text-align:left;"><b>Description</b></td>
                    <td style="width:20;font-size:7;text-align:left;"><b>Qty</b></td>
                    <td style="width:40;font-size:7;text-align:right;"><b>Bett</b></td>
                    <td style="font-size:7;text-align:right;"><b>Part</b></td>
                    <td style="font-size:7;text-align:right;"><b>Paint</b></td>
                    <td style="font-size:7;text-align:right;"><b>Labor</b></td>
                    <td style="font-size:7;text-align:right;"><b>Strip</b></td>
                    <td style="font-size:7;text-align:right;"><b>Frame</b></td>
                    <td style="font-size:7;text-align:right;"><b>Inhse/Out</b></td>
                </tr>
            </thead>
           <tr><td></td></tr>
           @php $count=1;$overallPaint=0;$overalLabour=0;$overallStrip=0;$overallFrame=0;$overallOutwork=0;$parts=0;@endphp
           @foreach($quotations as $quotes)
            <tr style="font-size:6.5;"><td style="text-align:left;width:20;">{{$count}}</td>
                <td style="text-align:left;width:50">{{$quotes->Oper}}</td>
                <td style="text-align:left;width:120">{{$quotes->Description}}</td>
                <td style="text-align:left;width:20">{{$quotes->Quantity}}</td>
                <td style="text-align:right;width:40">{{$quotes->Betterment}}</td>
                <td style="text-align:right">{{number_format($quotes->Part +($quotes->Part * ($quotes->Percent/100)),2)}}</td>
                <td style="text-align:right">{{number_format($quotes->Paint * $paintRate,2)}}</td>
                <td style="text-align:right">{{number_format($quotes->Labour * $laborRate,2)}}</td>
                <td style="text-align:right">{{number_format($quotes->Strip * $stripRate,2)}}</td>
                <td style="text-align:right">{{number_format($quotes->Frame * $frameRate,2)}}</td>
                <td style="text-align:right">{{number_format($quotes->Misc,2)}}</td>
            </tr>
            @php $count++;$overallPaint=$overallPaint+($quotes->Paint * $paintRate);$overalLabour=$overalLabour+($quotes->Labour * $laborRate);$overallStrip=$overallStrip+($quotes->Strip * $stripRate); $overallOutwork=$overallOutwork+($quotes->Misc);$parts=($quotes->Quantity*($quotes->Part +($quotes->Part * ($quotes->Percent/100))))+$parts;@endphp
            @endforeach
            <tfoot><tr><td></td></tr><tr><td style="text-align:left;font-size:7;width:26;"><b>Total</b></td>
                <td style="text-align:left;width:50;"></td>
                <td style="text-align:left;width:115;"></td>
                <td style="text-align:left;"></td>
                <td style="text-align:right;font-size:6"><b></b></td>
                <td style="text-align:right;font-size:6"><b>{{number_format($parts,2)}}</b></td>
                <td style="text-align:right;font-size:6"><b>{{number_format($overallPaint,2)}}</b></td>
                <td style="text-align:right;font-size:6"><b>{{number_format($overalLabour,2)}}</b></td>
                <td style="text-align:right;font-size:6"><b>{{number_format($overallStrip,2)}}</b></td>
                <td style="text-align:right;font-size:6"><b>{{number_format($overallFrame,2)}}</b></td>
                <td style="text-align:right;font-size:6"><b>{{number_format($overallOutwork,2)}}</b></td>
            </tr></tfoot>  

        </table><br>
        <div>
            <table style="font-size:7">
                <thead>
                    <tr>
                        <td><b></b></td>
                        <td><b></b></td>
                    </tr>
                </thead>
                
                <tr>
                    <td style="width:320">
                        <table  style="font-size:7;">
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <tr>
                                <td style="width:75">Authorized Date:</td>
                                <td style="width:180">..................................................</td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                                <td style="width:60">Authorized By:</td>
                                <td style="width:200">..................................................</td>
                            </tr> 
                            <tr><td></td></tr>
                            <tr>
                                <td style="width:50">Signature:</td>
                                <td style="width:205">..................................................</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width:150">
                        <table>
                            <tr>
                                <td style="width:140">Parts</td>
                                  <td style="text-align:right;width:60">R {{number_format($parts,2)}}</td>
                            </tr>
                            <tr>
                                <td style="width:140">{{number_format($labour_total,1)}} hrs Labor @ R {{$laborRate}}/hr</td>
                                <td style="text-align:right;width:60">R {{number_format($labour_total * $laborRate,2)}}</td>
                            </tr>
                            <tr>
                                <td style="width:140">{{number_format($paint_total,2)}} hrs Paint @ R {{$paintRate}}/hr</td>
                                <td style="text-align:right;width:60">R {{number_format($paint_total * $paintRate,2)}}</td>
                            </tr>
                            <tr>
                                <td style="width:140">{{number_format($strip_total,2)}} hrs Strip/Assembly @ R {{$stripRate}}/hr</td>
                                <td style="text-align:right;width:60">R {{number_format($strip_total * $stripRate,2)}}</td>
                            </tr>
                            <tr>
                                <td style="width:140">{{number_format($frame_total,2)}} hrs Frame @ R {{$frameRate}}/hr</td>
                                <td style="text-align:right;width:60">R {{number_format($frame_total * $frameRate,2)}}</td>
                            </tr> 
                            <tr>
                                <td style="width:140">Outwork </td>
                                <td style="text-align:right;width:60">R {{number_format($outwork_total,2)}}</td>
                            </tr>
                            <tr>
                                <td style="width:140">Sundries </td>
                                <td style="text-align:right;width:60">R {{number_format($parts*($shopSupply/100),2)}}</td>
                            </tr>
                            <tr>
                                <td style="width:140">Paint Supplies </td>
                                <td style="text-align:right;width:60">R {{number_format($paint_total * $paintRate*($paintSupply/100),2)}}</td>
                            </tr>
                            <tr>
                                <td style="width:140">Waste Disposal </td>
                                <td style="text-align:right;width:60">R {{number_format($waste,2)}}</td>
                            </tr>
                            <tr>
                                <td style="width:140;"><b>Sub Total </b></td>
                                <td style="text-align:right;width:60;"><b>R {{number_format(($labour_total*$laborRate)+($paint_total*$paintRate)+($strip_total*$stripRate)+($frame_total*$frameRate)+$sundries_total+$outwork_total+($paint_total*$paintRate*($paintSupply/100)),2)}}</b></td>
                            </tr>
                            <tr>
                                <td style="width:140">VAT @ 15% </td>
                                <td style="text-align:right;width:60">R {{number_format(((($labour_total*$laborRate)+($paint_total*$paintRate)+($strip_total*$stripRate)+($frame_total*$frameRate)+($parts*($shopSupply/100))+$outwork_total+($paint_total*$paintRate*($paintSupply/100)) +$parts)*0.15),2)}}</td>
                            </tr>
                            <tr>
                                <td style="width:140">Betterment (Inc VAT) </td>
                                <td style="text-align:right;width:60">R {{number_format($bett_total+($bett_total*0.15),2)}}</td>
                            </tr>
                            @php 
                            $subtotal=($labour_total*$laborRate)+($paint_total*$paintRate)+($strip_total*$stripRate)+($frame_total*$frameRate)+($parts*($shopSupply/100))+$outwork_total+($paint_total*$paintRate*($paintSupply/100))+$parts+$waste;
                            $vat_subtotal=((($labour_total*$laborRate)+($paint_total*$paintRate)+($strip_total*$stripRate)+($frame_total*$frameRate)+($parts*($shopSupply/100))+$outwork_total+($paint_total*$paintRate*($paintSupply/100)) +$parts+$waste)*0.15);
                            
                            @endphp
                            <tr>
                                <td style="width:140;"><b>Total</b></td>
                                <td style="text-align:right;width:60;"><b>R{{number_format($subtotal+$vat_subtotal,2)}} </b></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr><td></td></tr>
                </table>
                 <table style="font-size:7;font-family:Verdana,verdana">
                <tr><td style="font-size:9"><b>Notes</b></td></tr>
                    @php $comment_count=1;@endphp
                    @foreach($comments as $comment)
                    <tr>
                         <td style="text-align:left;width:200;border-top: 1px solid lightgrey;border-bottom: 1px solid lightgrey;border-top: 1px solid lightgrey;border-right: 1px solid lightgrey">{{$comment_count}}.{{$comments}}</td>
                         <!--<td style="text-align:left;width:50;border-top: 1px solid lightgrey;border-bottom: 1px solid lightgrey;">V_COMMENT_DATE</td>-->
                    </tr>
                    @php $comment_count++;@endphp
                    @endforeach
                <tr><td></td></tr>
                <tr>
                    <td style="text-align:center;width:500;font-size:10;color:gray"><b>Terms and Conditions</b></td>
                </tr>
                <tr><td></td></tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>1.</b> Vehicle repaired or salvaged shall not be released to the owner until the repair costs and/ or salvage and storage costs have been paid in full.</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>2.</b> M.A.G Quotation is valid for 30 days and does not include hidden or latents defects</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>3.</b> M.A.G will take no responsibility for loss due to fire or theft unforeseen circumstances</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>4.</b> M.A.G will take no responsibility for all glass that is removed and fitted at the vehicle owner's risk</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>5.</b> M.A.G will take no responsibility for Alarm, Cameras, SD cards that are left in the vehicle: this is vehicle owner's responsibility</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>6.</b> Insurance Excess and Payments is payable before vehicle release</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>7.</b> Credit Card transaction are subject to 5% transaction fee</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>8.</b> The storage is charged for light vehicles at R250/day including vat</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>9.</b> Storage is charged for heavy vehicles at R455/day including vat</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>10.</b> No work will commence without a signed quotation and payments reflecting a 30% in our account applies only for (C.O.D) clients</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>11.</b> By acceepting this quotation the client agrees to the terms and conditions of repairs and payments terms</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>12.</b> 60 days after completion - vehicle will be sold for defray cost</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>13.</b> Insurance companies without Service Level Agreement are not allowed to Audit</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>14.</b> Insurance companies are not allowed settlement discount without signed Service Level Agreement</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>15.</b> Suppliers are obliged to repair, refund or replace the failed, defective or unsafe products</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>16.</b> Payments to be done to <b style="color:black">First National Bank: 62616112827 Branch Code 250655</b> or</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>17.</b> Payments to be done to <b style="color:black">Starndard Bank: 281711623 Branch Code 051001</b></td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>18.</b> All proof of payments to be emailed to info@motoracccidentgroup.co.za</td>
                </tr>
                <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>19.</b> Insurance Assessors are not allowed a 5% settlement without SLA in place</td>
                </tr>
                 <tr style="color:gray">
                    <td style="width:520;font-size:6;font-family: Verdana , Verdana;"><b>20.</b> Costings to be signed by assessor prior to delivery as per company terms and conditions repair times - Subject to Costings</td>
                </tr>
                 <tr style="color:gray">
                    <td style="width:200;font-size:6;font-family: Verdana , Verdana;"><b>21.</b> If a vehicle is insured the owner of the vehicle shall remain liable for the repair, salvage and storage costs until the insurer makes payments of such costs.</td>
                </tr>
                <tr><td></td></tr>
                <tr style="color:gray"><td><b>Payment Terms for C.O.D Clients</b></td></tr>
                <tr style="font-size:7;color:grey;">
                    <td >50% on acceptance of quote: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>R{{number_format((($subtotal+$vat_subtotal)/2),2)}}</b></td>
                    <td></td>
                </tr>
                <tr style="font-size:7;color:grey;">
                    <td>50% Balance to be paid on date of completion:     &nbsp;&nbsp;&nbsp;<b>R{{number_format((($subtotal+$vat_subtotal)/2),2)}}</b></td>
                    <td></td>
                </tr>
                <tr><td></td></tr>
                
            </table>
        </div>
</body>
</html>