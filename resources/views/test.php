<?php

require_once('tcpdf_include.php');
include_once 'dbConfig.php'; 
session_start();
$id     = $_SESSION['id_1_'];
$parts = $_SESSION['$parts'];
$sup =$_SESSION['$sup'];
$supem =$_SESSION['$supem'];
$senderEM =$_SESSION['$senderEM'];
$brancTel =$_SESSION['$brancTel'];
$foloUP1 =$_SESSION['$foloUP1'];
$foloUP2 =$_SESSION['$foloUP2'];
$foloUP3 =$_SESSION['$foloUP3'];
$usa = $_SESSION['ordUsa'];

$comms = $_SESSION['$comms'];
$nots = $_SESSION['$nots'];
$date = date('Y-m-d');
$time = date('H:m:s');
$tbtr = '';
$note_comment = '';
$sqpl = "select order_number from orders order by order_number desc limit 0,1";
    $resultp = mysqli_query($db, $sqpl) or die("Error in Selecting " . mysqli_error($db));
    $orderNum =0;
    while($row =mysqli_fetch_assoc($resultp))
    {
        $orderNum = ($row['order_number']+1);
    }
    $orderNum1 =  $orderNum;
for($i=0;$i<count($parts);$i++){
    mysqli_query($db, "INSERT INTO `confirmed_orders`(`order_number`, `Key_Ref`, `date`, `Supplier`,`url`, "
            . "`address`,`user`, `follow_up_1`, `follow_up_2`, `follow_up_3`,`user_email`,`comment`)"
            . " VALUES ('$orderNum1','$id','$date','$sup','','$supem','$usa','$foloUP1','$foloUP2','$foloUP3','$senderEM','$nots')");
    mysqli_query($db, "INSERT INTO `orders`(`Description_2`, `quantity`, `order_number`, `Key_Ref`, `status`, `credit`,"
            . " `Part_No`, `Arrival`, `date`, `comments`) VALUES ('$parts[$i]','1','$orderNum','$id','0','0','','','$date','$comms')");
    
    
    
    if($nots!=''){
        mysqli_query($db, "INSERT INTO `notes`(`id`, `Key_Ref`, `note`, `date`, `time`, `status`, `user`, `identity`) VALUES ('','$id','$nots','$date','$time','0','$usa','')");
        mysqli_query($qdb, "INSERT INTO `notes`(`id`, `Key_Ref`, `note`, `date`, `time`, `status`, `user`, `identity`) VALUES ('','$id','$comms','$date','$time','0','$usa','')");
    }
    
}
$sqlk = "select * from orders where Key_Ref = '$id' and order_number='$orderNum'";
$reskz = mysqli_query($db, $sqlk) or die("Error in Selecting " . mysqli_error($db));

$cnt = 0;
while($row =mysqli_fetch_assoc($reskz))
{
    $des = $row['Description_2'];
    $re = mysqli_query($db,"select Quantity as cnt from qoutes where Key_Ref = '$id' and Description = '$des' " ) or die("Error in Selecting " . mysqli_error($db));
    while($row1 =mysqli_fetch_assoc($re))
    {
        $cnt = $row1['cnt'];
    }
    $tbtr.='<tr>'
            . '<td style="width:100px;" align="center"> '.$cnt.'</td>'
            . '<td style="width:300px;"> '.strtoupper($row['Description_2']).'</td>'
            . '<td style="width:230px;"> '.$row['comments'].'</td>'
            . '</tr>';
}
$sqln = "select * from confirmed_orders where Key_Ref = '$id' and order_number='$orderNum'";
$reskn = mysqli_query($db, $sqln) or die("Error in Selecting " . mysqli_error($db));
//$tablez.='<table border="1">';
while($row =mysqli_fetch_assoc($reskn))
{
    $note_comment .= $row['comment']."<br>";
}
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
   


$pdf->SetHeaderData("", "", ""."REF NO : "."$id", "", array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 9, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
//$pdf->AddPage();
// add a page


$pdf->AddPage();



  

$table		 = 'qoutes';
$order_number=$orderNum;
$query 	= "SELECT * FROM insurer WHERE Key_Ref='$id'";
$result = $db->query($query);

if 		($result->num_rows > 0) {
while	($row1 = $result->fetch_assoc()){
			
$rateTable 	= $row1['rateTable'];
$Specify 	= $row1['rateTable'];
$insurer 	= $row1['Inserer'];
$Phone 		= $row1['Phone'];
$FaxNo 		= $row1['Fax'];
$Claim_NO 	= $row1['Claim_NO'];
$Oder_No 	= $row1['Oder_No'];
$Assessor 	= $row1['Assessor'];

				}
}
$user_email_ = '';
$date1 = '';
$cell = '';
$sql1="SELECT * FROM confirmed_orders WHERE Key_Ref='$id' and order_number='$order_number'";
		$res1 = mysqli_query($db,$sql1);
		if ($res1->num_rows > 0) {
				while($row1 = $res1->fetch_assoc()){
					$follow_up_2=$row1['follow_up_2'];
					$follow_up_1=$row1['follow_up_1'];
					$follow_up_3=$row1['follow_up_3'];
					$user_1     =$row1['user'];
                                        $date1     =$row1['date'];
					$user_email_ =$row1['user_email'];
					$cell		 =$row1['cell'];
				}
		}else{
					$follow_up_2="";
					$follow_up_1="";
					$follow_up_3="";
					$user_1   ="";
		}
$sql 	= "SELECT * FROM client_details WHERE Key_Ref='$id'";

$res = mysqli_query($db,$sql);
$owner 		=   '';
$vehicle 	=   '';
$reg 		=   '';
$branch 	=   '';
$Chasses_No     =   '';
$Make		=   '';
$Model		=   '';
$Engine         =   '';
$Vehicle_year   =   '';
$location = '';
$Colour = '';
$code = '';
while($row = $res->fetch_assoc()){
	
$owner 		=   $row['Fisrt_Name'];
$vehicle 	=   $row['Make']." ". $row['Model'];
$reg 		=   $row['Reg_No'];
$branch 	=   $row['branch'];
$Chasses_No     =   $row['Chasses_No'];
$Make		=   $row['Make'];
$Model		=   $row['Model'];
$Engine         =   $row['Eng_No'];
$Vehicle_year   =   $row['Vehicle_year'];

$Colour	=$row['Colour'];

if($row['branch']=="Glen"){
$image = 'images/glen.png';	
$location = "Louis Avenue, Glen Eagles, 7945, Tel:(011) 432 0163";
$title    = "MAG Customs";
$f_title = 'style="font-size: 0px; margin: 0px;"';
}

if($row['branch']=="The Glen"){
$image = 'images/glen.png';	
$location = "Louis Avenue, Glen Eagles, 7945, Tel:(011) 432 0163";
$title    = "MAG Customs";
$f_title = 'style="font-size: 0px; margin: 0px;"';
}

if($row['branch']=="Longmeadow"){
$image = 'images/Longmeadow.png';	
$location = "42 Longmeadow Blvd, Edenvale, 1609, Tel:(010) 500 0350";
$title    = "Motor Accident Group";
$f_title = "";
}

if($row['branch']=="Selby"){
$image = 'images/_blank.png';
$location = "80 Booysen Road, Selby, 2001, Tel:(011) 493-9160";
$title    = "Motor Accident Group";
$f_title = "";
}	

if($row['branch']==""){
$image = 'images/_blank.png';
$location = "80 Booysen Road, Selby, 2001, Tel:(011) 493-9160";
$title    = "Motor Accident Group";
$f_title = "";
}	

if($row['branch']=='Glen'){
	$code='GL';
}
if($row['branch']=='The Glen'){
	$code='GL';
}
if($row['branch'] =='Selby'){
	$code='SL';
}
if($row['branch']=='Longmeadow'){
	$code='LM';
}
//$pdf->Image($image);
}
$sup_name = $_SESSION['$sup'] ;
$query 	= "SELECT * FROM supplier WHERE sup_name='$sup_name'";
$result = $db->query($query);
if ($result->num_rows > 0) {
	  /*
		Loop Fetching data from supplier data table
		*/
		while($row1 = $result->fetch_assoc()){
		/*
		Fetched data from supplier data table
		*/
		$sup_name 	 = $row1['sup_name'];
		$sup_phone 	 = $row1['sup_phone'];
		$fax 	 = $row1['sup_fax'];
		IF(isset($row1['sup_email'])){
			$sup_email 	 = $row1['sup_email'];
		}IF(!($row1['sup_email'])){
			$sup_email 	 = $row1['sup_fax'];
		}
		
		$sup_contact = $row1['sup_contact'];
		$enabled 	 = $row1['enabled'];
		}
}else{
	$sup_phone 	 = "";
    $fax 	     = "";
}
$order_number = $orderNum;
$sup_name1 	 = $_SESSION['$sup'] ;
//$sup_phone1  = $_GET['sup_phone'];80 Booysen Road, Selby, 2001, Tel:(011) 493-9160	
$sup_email1  = $_SESSION['$supemail'] ;
		

if(!($sup_name1)){
	$error ='<tr><td colspan="4" align="center" style="font-size:15px; color:red;">
	<b>Error : This not an Offial Order "Supplier Name" is required</b>
	</td> </tr>';
}else{
	$error='';
}

if(!($sup_email1)){
	$error ='<tr><td colspan="4" align="center" style="font-size:15px; color:red;">
	<b>Error : This not an Offial Order "Supplier Email" is required
	</b></td> </tr>';
}else{
	$error='';
}

if(!($Chasses_No)){
	$error ='<tr><td colspan="4" align="center" style="font-size:15px; color:red;">
	Error : This not an Offial Order "VIN" is required</td> </tr>';
}else{
	$error='';
}

$tmain=
'<div style="background-color:#d5e3e4;" border="1">
<table style="font-family:;  font-size:11px;">
'.$error.'
<tr><td colspan="4" align="center" style=" font-size:22px;"><b>Official Order : '.$title.' </b></td> </tr>
<tr><td colspan="4"  align="center">'.$location.'</td></tr>
<tr><td colspan="4"><hr style="border-style:dashed;"/></td></tr>
<tr><td><b>Placed by</b>	</td> <td style="width:160px;">: '.$user_1 .'</td><td style="width:90px;"><b>Email</b> 	</td> <td style="width:200px;">: '.$user_email_.'</td></tr>
<tr><td><b>Cell	</b></td> <td style="width:160px;">: '.$cell.'</td><td><b>Date</b> 	</td> <td>: '.$date1.'</td></tr>
<tr><td colspan="4"></td></tr>
<tr><td><b>Vehicle</b> </td> <td>: '.strtoupper ($Make." ".$Model).'</td><td><b>Vehicle Year</b> 	</td> <td>: '.$Vehicle_year.'	</td></tr>
<tr><td><b>Color</b> 	</td> <td>: '. strtoupper ($Colour).'</td><td><b>VIN</b> 	</td> <td>: '.strtoupper ($Chasses_No).'</td></tr>
<tr><td><b>Engine No</b> 	</td> <td>: '. strtoupper ($Engine).'</td><td><b>Reference</b> 	</td> <td>: '.strtoupper ($id).'</td></tr>

</table>
</div>';
$html =$tmain;
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$html='
<div style="background-color:#d5e3e4;" border="1">
<table style="font-size:10px;">
<tr>
	<td style="width:100px;"><b>Supplier</a></td> 
	<td style="width:250px;">: '. strtoupper ($sup_name1).'</td>
	<td style="width:80px;"></td>
	<td></td>
</tr>
<tr>
	<td style="width:100px;"><b>To</b></td> 
	<td>: '. $sup_email1.'</td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td style="width:100px;"><b>Tel</b></td> 
	<td>: '. $sup_phone.'</td>
	<td style="width:80px;"><b>Fax</b> </td>
	<td style="width:180px;">: '.$fax.'</td>
</tr>
</table>
</div>';	
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$table='
<table style="font-family:;" border="1">
<tr>
<td style="width:630px;" colspan="2">
<b>Please supply the undermentioned goods per:</b>
</td>
</tr>
<tr>

<td style="width:100px; background-color:#d5e3e4; font-size:14px;"><b>Quantity</b></td>
<td style="width:300px; background-color:#d5e3e4; font-size:14px;"><b>Description</b></td>
<td style="width:230px; background-color:#d5e3e4; font-size:14px;"><b>Comment</b></td>

</tr>
</table>'; 

$pdf->writeHTMLCell(0, 0, '', '', $table, 0, 1, 0, true, '', true);


$tablez='<table border="1">'
        . $tbtr
        . '</table>';
$pdf->writeHTMLCell(0, 0, '', '', $tablez, 0, 1, 0, true, '', true);
	

$html = '
<br><br>
<table border="1">
<tr>
<td style="text-align:center; background-color:#d5e3e4;">Notes</td>
</tr>
<tr>
<td>'.$note_comment.'</td>
</tr>
</table>
<br><br>
';
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// ---------------------------------------------------------
$html='<table style="font-family:;" border="1">
<tr>
<td style="width:630px;" colspan="2">
<i><h4>Note: To be accompanied by invoice or delivery note bearing above order No:'.$id.'</h4></i>
<li><h4>Please Note Invoice Must Be Made To '.$title.' With Order Number To Be Paid</h4></li>
<br/><h5 '.$f_title.' > <i>Follow up date : '.$follow_up_1.'</i>&nbsp; &nbsp;&nbsp;<i> Follow up date :  '.$follow_up_2.'</i>&nbsp;&nbsp;&nbsp; <i> Follow up date : '.$follow_up_3.'</i></h5>
</td>
</tr>

</table><br/>'
;
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

if(!($sup_name1)){
	$error ="This not an Offial Order Supplier Name is required";
}else{
	$error='';
}

if(!($sup_email1)){
	$error ="Error : This not an Offial Order Supplier Email is required";
}else{
	$error='';
}

if(!($Chasses_No)){
	$error ="Error : This not an Offial Order VIN is required";
}else{
	$error='';
}


$error ='<h1>'.$error.'</h1>';
$pdf->writeHTMLCell(0, 0, '', '', $error, 0, 1, 0, true, '', true);

//Close and output PDF document
$fil_name = $code.$order_number.date('Ydmhs').'file.pdf';

$dates = date('y-m-d');
//$pdf->Output('Orders/'.$fil_name, 'F');
$pdf->Output(__DIR__."/Orders/".$fil_name, 'F');
$sqlz = "select * from confirmed_orders where `order_number`='$order_number'";

$resz = mysqli_query($db, $sqlz) or die("Error in Selecting " . mysqli_error($db));
$sqlq = "";
if($fil_name!=''){
    if($resz->num_rows > 0){
        $sqlq = "UPDATE `confirmed_orders` SET `url`='$fil_name' WHERE `order_number`='$order_number'";
    }else{
        $sqlq = "INSERT INTO `confirmed_orders`(`order_number`, `Key_Ref`, `date`, `Supplier`, `url`)"
                . " VALUES ('$order_number','$id','$dates','$sup_name1','$fil_name')";
    }
}
mysqli_query($db, $sqlq);



