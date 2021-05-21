<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stores - RFC</title>
</head>
<body><br><br><br>
<table style="margin-left:-25px;">
            <tr>
                <td style="border-top: 1px solid lightgrey;border-bottom: 1px solid lightgrey;width:350">
                    <table>
                        <tr><td></td></tr>
                        <tr>
                            <td style="text-align:center;font-size:35"><b>M.A.G</b></td>
                        </tr>
                        <tr>
                            <td style="text-align:left;font-size:20"><b>Motor Accident Group</b></td>
                        </tr>
                        <tr>
                            <td style="text-align:left;font-size:12"><b>Approved Auto Body Provider</b></td>
                        </tr>
                        <tr><td></td></tr>
                    </table>
                </td>
                <td style="border-top: 1px solid lightgrey;border-bottom: 1px solid lightgrey;width:100">
                <br><br><br><table>
                        <tr><td></td></tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr><td></td></tr>
                    </table>
                </td>
                <td style="border-top: 1px solid lightgrey;border-bottom: 1px solid lightgrey;font-size:7;">
                    <table>
                        <tr><td></td></tr>
                        <tr>
                            <td style="text-align:left"><b>PO Box 38227</b></td>
                        </tr>
                        <tr>
                            <td style="text-align:left"><b>Booysens, 2016</b></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr>
                            <td style="text-align:left"><b>80 Booysen RD</b></td>
                        </tr>
                        <tr>
                            <td style="text-align:left"><b>Selby 2001</b></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr>
                            <td style="text-align:left"><b>Tel: 010 591 7550</b></td>
                        </tr>
                        <tr>
                            <td style="text-align:left"><b>Fax: 086 551 8450</b></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr>
                            <td style="text-align:left"><b>Email: info@motoraccidentgroup.co.za</b></td>
                        </tr>
                        <tr><td></td></tr>
                    </table>
                </td>
            </tr><br>
        </table>
        <p style="text-align:center"><b><u>Credit Note (RFC)</u></b></p>
        <table style="font-size:8">
            <tr>
                <td><b>Supplier Name</b></td>
                <td style="width:250">: {{$supname}}</td>
                <td><b>Date</b></td>
                <td>: {{$date}}</td>
            </tr>
            <tr>
                <td><b>Supplier Email</b></td>
                <td style="width:250">: {{$supemail}}</td>
                <td><b>Credit Note No.</b></td>
                <td>: {{$rfcno}}</td>
            </tr>
            <tr>
                <td><b>Order Number</b></td>
                <td style="width:250">: {{$ordnum}}</td>
                <td><b>Reference</b></td>
                <td>: {{$key}}</td>
            </tr>
            <tr>
                <td><b>Done By</b></td>
                <td style="width:250">: {{$user}}</td>
                <td><b></b></td>
                <td></td>
            </tr>
        </table>
        <p></p><br>
        <table style="font-size:10;font-family:courier;margin-left:-25px;" border="1" width="100%">
            <tr style="background-color:lightgrey">
                <td style="width:10px"><b>Quan</b></td>
                <td style="width:100"><b>Part Number</b></td>
                <td style="width:90"><b>Description</b></td>
                <td style="width:115"><b>Invoice Number</b></td>
                <td style="width:85"><b>Amount</b></td>
                <td style="width:150"><b>Comment</b></td>
            </tr>
            <tr>
                <td style="width:10px">{{$qty}}</td>
                <td style="width:100">{{$partNo}}</td>
                <td style="width:90">{{$des}}</td>
                <td style="width:115">{{$Invceno}}</td>
                <td style="width:85">{{$price}}</td>
                <td style="width:150">{{$comm}}</td>
            </tr>
        </table>
        <br><br><br>
        <table style="font-size:10;font-family:courier">
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td style="border-top: 1px solid lightgrey;text-align:center;border-bottom: 1px solid lightgrey"><b>Driver</b></td><td style="border-top: 1px solid lightgrey;text-align:right;border-bottom: 1px solid lightgrey;"><b>Storeman</b></td></tr>
            <tr><td style="width:300;border-right: 1px solid lightgrey;"></td><td>&nbsp;</td></tr>
            <tr><td style="border-right: 1px solid lightgrey;"></td><td>&nbsp;</td></tr>
            <tr><td style="border-right: 1px solid lightgrey;"></td><td>&nbsp;</td></tr>
            <tr>
                <td style="width:100;"><b>Driver Name</b></td>
                <td style="width:200;border-right: 1px solid lightgrey;">:________________________</td>
                <td style="width:150"><b>Storeman Signature</b></td>
                <td style="width:200">:________________________</td>
            </tr>
            <tr><td></td><td style="border-right: 1px solid lightgrey;"></td></tr>
            <tr><td></td><td style="border-right: 1px solid lightgrey;"></td><td style="border-bottom: 1px solid lightgrey;"></td><td style="border-bottom: 1px solid lightgrey;"></td></tr>
            <tr><td></td><td style="border-right: 1px solid lightgrey;"></td></tr>
            <tr>
                <td style="width:100"><b>Registration</b></td>
                <td style="width:200;border-right: 1px solid lightgrey;">:________________________</td>
            </tr>
            <tr><td></td><td style="border-right: 1px solid lightgrey;"></td></tr>
            <tr><td></td><td style="border-right: 1px solid lightgrey;"></td></tr>
            <tr><td></td><td style="border-right: 1px solid lightgrey;"></td></tr>
            <tr>
                <td style="width:100"><b>Driver Signature</b></td>
                <td style="width:200;border-right: 1px solid lightgrey;">:________________________</td>
            </tr>
            <tr><td></td><td style="border-right: 1px solid lightgrey;"></td></tr>
            <tr><td></td><td style="border-right: 1px solid lightgrey;"></td></tr>
            <tr>
                <td style="width:100"><b>Date</b></td>
                <td style="width:200;border-right: 1px solid lightgrey;">:________________________</td>
            </tr>
            <tr><td></td><td style="width:200;border-right: 1px solid lightgrey;"></td></tr>
            <tr><td style="border-bottom: 1px solid lightgrey;"></td><td style="border-bottom: 1px solid lightgrey;border-right: 1px solid lightgrey;"></td></tr>
        </table><p></p>
		<div style="color:#333;font-size:9;font-family: Arial, Helvetica, sans-serif;background-color:#E8E8E8">
                <div></div>
                <b>&nbsp;NOTE:</b>&nbsp;Once the driver has taken the part, this is an official credit note, Motor Accident Group will not be responsible for the part returned once the driver has taken the part.<br>
                <div></div>
            </div>
</body>
</html>