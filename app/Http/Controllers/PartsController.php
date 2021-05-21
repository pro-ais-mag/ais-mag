<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSendMail;
use PDF;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class PartsController extends Controller
{
    public function index(){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $parts=DB::table('fetch_ApprovedQuotes')
                        ->join('track_photos','fetch_ApprovedQuotes.Key_Ref','=','track_photos.Key_Ref')
                        ->leftjoin('securityphotos','fetch_ApprovedQuotes.Key_Ref','=','securityphotos.Key_Ref')
                        ->leftjoin('document','fetch_ApprovedQuotes.Key_Ref','=','document.Key_Ref')
                        ->limit(50)
                        ->select('fetch_ApprovedQuotes.Key_Ref','fetch_ApprovedQuotes.Fisrt_Name','fetch_ApprovedQuotes.Last_Name','fetch_ApprovedQuotes.Make','fetch_ApprovedQuotes.Reg_No','fetch_ApprovedQuotes.Cell_number','fetch_ApprovedQuotes.Inserer','fetch_ApprovedQuotes.Claim_NO',DB::raw('count(track_photos.picture_name) count_track'),DB::raw('count(securityphotos.url) count_security'))
                        ->distinct('fetch_ApprovedQuotes.Key_Ref')
                        ->groupBy('securityphotos.Key_Ref')
                        
                        ->get();
        
        
        return view('parts.ordering',['parts'=>$parts,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
    }

    

    public function additional(){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $parts=DB::table('fetch_ApprovedQuotes')
                        ->join('track_photos','fetch_ApprovedQuotes.Key_Ref','=','track_photos.Key_Ref')
                        ->leftjoin('securityphotos','fetch_ApprovedQuotes.Key_Ref','=','securityphotos.Key_Ref')
                        ->select('fetch_ApprovedQuotes.Key_Ref','fetch_ApprovedQuotes.Fisrt_Name','fetch_ApprovedQuotes.Last_Name','fetch_ApprovedQuotes.Make','fetch_ApprovedQuotes.Reg_No','fetch_ApprovedQuotes.Cell_number','fetch_ApprovedQuotes.Inserer','fetch_ApprovedQuotes.Claim_NO',DB::raw('count(track_photos.picture_name) count_track'),DB::raw('count(securityphotos.url) count_security'))
                        ->distinct('fetch_ApprovedQuotes.Key_Ref')
                        ->groupBy('securityphotos.Key_Ref')
                        ->get();

        return view('parts.ordering',['parts'=>$parts,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
    }

    public function precosting(){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        /*$precosting=DB::table('client_details')
                            ->join('confirmed_orders','client_details.Key_Ref','=','confirmed_orders.Key_Ref')
                            ->join('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                            ->join('securityphotos','client_details.Key_Ref','=','securityphotos.Key_Ref')
                            ->join('track_photos','client_details.Key_Ref','=','track_photos.Key_Ref')
                            ->join('document','client_details.Key_Ref','=','document.Key_ref')
                            ->select('client_details.Key_Ref','client_details.Reg_No','client_details.Make','client_details.Model','client_details.Fisrt_Name','client_details.Last_Name','client_details.Cell_number',DB::raw('count(track_photos.picture_name) count_track'),DB::raw('count(securityphotos.url) count_security'))
                            ->where('client_details.status','=','1')
                            ->orderBy('client_details.id','desc')
                            ->groupBy('client_details.Key_Ref')
                            ->limit(200)
                            ->get();
        */
        $precosting=DB::table('client_details')
                            ->distinct('client_details.Inv_Date')
                            ->leftjoin('confirmed_orders','client_details.Key_Ref','=','confirmed_orders.Key_Ref')
                            ->leftjoin('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                            ->select('client_details.Key_Ref','client_details.Reg_No','client_details.Make','client_details.Model','client_details.Fisrt_Name','client_details.Last_Name','client_details.Cell_number','confirmed_orders.user','confirmed_orders.date','confirmed_orders.Supplier','confirmed_orders.address')
                            ->where('client_details.status','=','1')
                            ->orderBy('client_details.id','desc')
                            ->distinct('client_details.Key_Ref')
                            ->limit(1000)
                            ->get();
        
        return view('parts.precosting',['precostings'=>$precosting,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);

    }

    public function view_precosting($id){
        $count = 1;
        $status='';
        $btn = '';
        //$add=0;
        $lndT = 0;
        $ptT = 0;
        $savT = 0;
        $actual_priceT = 0;
        $ps = 0;
        $less_saving = 0;
        $plus_additional = 0;
        $part_total= 0;
        $ordered = "";
        $p = 0;
        $optin = 0;
        $optionz = 0;
        $table_body='<tbody>';

        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $storage_parts=DB::select('select distinct qt.id,qt.Percent,qt.Description as ds,qt.Key_Ref,qt.Parts_sales,qt.Part,qt.Misc,qt.Oper,qt.Quantity,qt.MarkUp,
        round((qt.Part-(qt.Parts_sales+(qt.Parts_sales*(qt.MarkUp/100))))*qt.Quantity,2)as sav,
        round((qt.Parts_sales+(qt.Parts_sales*(qt.MarkUp/100))),2)as actual_price,Description_2,tbr.description as ds1
        FROM qoutes as qt
        LEFT outer JOIN orders as od
        ON od.Key_Ref = qt.Key_Ref and Description_2 = qt.Description 
        LEFT outer JOIN toberepaired as tbr
        ON tbr.Key_Ref = qt.Key_Ref and tbr.description = qt.Description 
        where qt.Key_Ref =? and( Part>0 or Misc> 0)',[$id]);
        $storage_part=DB::table('qoutes')
                            ->leftjoin('orders',function($join){
                                $join->on('orders.Key_Ref','=','qoutes.Key_Ref')
                                        ->where('orders.Description_2','=','qoutes.Key_Ref');
                            })         
                            ->leftjoin('toberepaired',function($q){
                                $q->on('toberepaired.Key_Ref','=','qoutes.Key_Ref')
                                     ->where('toberepaired.description','=','qoutes.Key_Ref');
                            })           
                            ->select('qoutes.Key_Ref','qoutes.id','qoutes.Percent','qoutes.Description','qoutes.Parts_sales','qoutes.Part','qoutes.Misc','qoutes.Oper','qoutes.Quantity','qoutes.MarkUp','qoutes.Parts_sales')
                            ->where('qoutes.Key_Ref','=',$id)
                            ->distinct('qoutes.Key_Ref')
                            ->get();
        $precosting_docs=DB::table('document')
                                ->where('Key_Ref','=',$id)
                                ->get();

        $doc_description=DB::table('docs_description')->get();
        
        $oper=DB::table('oper')->get();

        $additions=DB::table('additional')
                            ->where('Key_Ref','=',$id)
                            ->get();

        $pre_quotes=DB::table('pre_qoutations')
                            ->where('Key_Ref','=',$id)
                            ->get();

        $suppliers=DB::table('supplier')->orderBy('sup_name','ASC')->get();                    
        
        $client_details=DB::table('client_details')
                                ->join('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                                ->select('client_details.Key_Ref','client_details.Reg_No','client_details.Model','insurer.Claim_No','client_details.Fisrt_Name','client_details.Last_Name')
                                ->where('client_details.Key_Ref','=',$id)
                                ->limit(1)
                                ->get();

        $confirmed_orders=DB::table('confirmed_orders')->where('Key_Ref','=',$id)->get();                    

                                foreach($storage_parts as $row)
                                {
                                    $add = 0;
                                    $sav = 0;
                                    if($row->Part>0){
                                        $p = $row->Part*$row->Quantity;
                                    }else{
                                        $p = $row->Misc*$row->Quantity;
                                    }
                                    if($row->Parts_sales<=0){
                                        $status = "<span class='badge' style='background-color:red;color:white;font-size:10px;'>No</span>";
                                        $btn = "<button disabled='' name='".$row->id."' class='btn btn-sm btn-warning' style='float:right;font-size:10px;' onclick='makeCreditNote(this.name)'>RFC</button>";
                                    }else if($row->Parts_sales>0){
                                        $status = "<span class='badge' style='background-color:green;color:white;font-size:10px;'>Yes</span>";
                                       $btn = "<button name='".$row->id."' class='btn btn-sm btn-warning stores_rfc' style='float:right;font-size:10px;' onclick='makeCreditNote(this.name)'>RFC</button>";
                                    }if($row->actual_price>($p*$row->Quantity)*(1+($row->Percent/100))){
                                        $sav = 0;	
                                        $add = ($row->actual_price - ($p*$row->Quantity)*(1+($row->Percent/100)));	
                                    }else if($row->actual_price<($p*$row->Quantity)*(1+($row->Percent/100))){
                                        $sav = (($p*$row->Quantity)*(1+($row->Percent/100))-$row->actual_price);	
                                        $add = 0;
                                    }
                                    //////////////////////////////////////////////
                                    if(trim($row->ds1)==trim($row->ds)){
                                        $ordered = "<span class='badge' style='float:right'>Repaired</span>";
                                        $status = "<span class='badge' style='background-color:green'>Yes</span>";
                                        $btn  = '';
                                    }else
                                    if(trim($row->Description_2)==trim($row->ds)){
                                        $ordered = "<button id='".$row->id."' class='btn btn-sm btn-success landing_parts' style='float:right;font-size:10px;' data-id='".$row->id."' onclick='getClosestText(this.id)'>Edit</button>";
                                    }else{
                                        $ordered = "<button id='".$row->id."' class='btn btn-sm btn-success landing_parts' data-id='".$row->id."' style='float:right;font-size:10px;' onclick='getClosestText(this.id)'>Edit</button>";
                                    } 
                                    while($optin<=25){
                                        $optionz.="<option>".$optin."</option>";
                                        $optin++;
                                    }
                                   $table_body.= "<tr>"
                                           . "<td>".$count."</td>"
                                           . "<td>".$row->ds."</td>"
                                           . "<td>".$row->Oper."</td>"
                                           ."<td><select class='form-control form-control-sm' style='font-size:10px;'  id='EditAddStoreMarkUpNewTd_".$count."' name='".$row->MarkUp."_".$count."' lang='".$row->id."_".$count."' class='form-control form-control-sm' onchange='changeThisStrMarkUp(this.lang)' onload='funkThisStrMarkUp(this.name)'><option value='".$row->MarkUp."'>".$row->MarkUp."</option>'".$optionz."
                                                  </select></td>"
                                           . "<td>".number_format($row->Parts_sales,2).""." ".$ordered."</td>"
                                           . "<td>".number_format($sav,2)."</td>"
                                           . "<td>".number_format($add,2)."</td>"
                                           . "<td>".number_format($p,2)."</td>"
                                           . "<td>".number_format($row->actual_price,2)."</td>"
                                           . "<td>".$status." ".$btn."</td>"
                                      . "</tr>";
                                   $count++;
                                   $ps+=$row->Parts_sales;
                                   $less_saving+=$sav;
                                   $plus_additional+=$add;
                                   $part_total+=($row->Part*$row->Quantity);
                                }
                                $table_body.="</tbody>";
                                 $table_body.="<tfooter><tr>"
                                        . "<td colspan='4'><b>Totals</b></td>"
                                        . "<td><b>".number_format($ps,2)."</b></td>"
                                        . "<td><b>".number_format($less_saving,2)."</b></td>"
                                        . "<td><b>".number_format($plus_additional,2)."</b></td>"
                                        . "<td><b>".number_format($part_total,2)."</b></td>"
                                        . "<td><b>".number_format($ps,2)."</b></td>"
                                        . "<td></td>"
                                    . "</tfooter></tr>";        
                                
                                $branches=DB::table('branch')->get();
                                
        #COUNT THE PHOTOS
        $finalstage_photos_count=DB::table('track_photos')->where('Key_Ref','=',$id)->where('category','=','FINAL STAGE')->count();
        $wip_photos_count=DB::table('track_photos')->where('Key_Ref','=',$id)->where('category','=','Work In Progress')->count();
        $additional_photos_count=DB::table('track_photos')->where('Key_Ref','=',$id)->where('category','=','ADDITIONAL')->count();
        $security_photos_count=DB::table('securityphotos')->where('Key_Ref','=',$id)->count();
                                
        return view('parts.viewprecosting',['confirmed_orders'=>$confirmed_orders,'storage'=>$storage_part,'table_body'=>$table_body,'id'=>$id,'key'=>$id,'documents'=>$precosting_docs,'descriptions'=>$doc_description,'operations'=>$oper,'additions'=>$additions,'pre_quotes'=>$pre_quotes,'suppliers'=>$suppliers,'client_details'=>$client_details,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final,'branches'=>$branches,'final_photo_count'=>$finalstage_photos_count,'wip_photo_count'=>$wip_photos_count,'additional_photo_count'=>$additional_photos_count,'security_photo_count'=>$security_photos_count]);
    }

    public function precosting_docs_upload(Request $request){
        $id=$request->precost_id;
        $description=$request->precost_desc;
        $user=Auth::user()->username;
        $date=date('Y-m-d');
        $time=date('H:i:s');
        $file=$id.'-'.$description.'.'.$request->image->getClientOriginalExtension();
        $paths='docs/uploaded/';
        $paths.=$id;
        $request->image->move(public_path($paths),$file);
        DB::table('document')->insert([
            ['Key_Ref'=>$id,'url'=>$file,'date'=>$date,'time'=>$time,'Description'=>$description,'user'=>$user]
        ]);

        return back()->with(['message'=>'Document Uploaded Successfully']);    

    }

    public function precosting_docs_delete($id){
        DB::table('document')
               ->where('id','=',$id)
               ->delete();

        return back()->with(['message'=>'Document Deleted Successfully']);       
    }

    public function precosting_additional(Request $request){
        $id=$request->proc_id;
        $desc=$request->precost_description;
        $oper=$request->precost_oper;
        $perce=$request->precost_perc;
        $quan=$request->precost_quan;
        $part=$request->precost_part;
        $labor=$request->precost_labor;
        $paint=$request->precost_paint;
        $frame=$request->precost_frame;
        $rnr=$request->precost_rr;
        $outwork=$request->precost_outwork;
        $hse=$request->precost_hse;
        $bett=$request->precost_bett;
        $real_no=0;
        $date=date('Y-m-d H:i:s');

        $no=DB::table('additional')
                    ->where('Key_Ref','=',$id)
                    ->orderBy('Date','desc')
                    ->distinct('No')
                    ->get();

        foreach($no as $real_no){
            $real_no=count($no)+1;
        }
        if(empty($real_no)){
            $real_no=0;
        }
        
        DB::table('additional')->insert([
            ['Oper'=>$oper,'Description'=>$desc,'Key_Ref'=>$id,'Part'=>$part,'Part_sales'=>$part,'Labour'=>$labor,'Strip'=>'0',
            'Paint'=>$paint,'Outwork'=>$outwork,'Inhouse'=>$hse,'Comments'=>'','Percent'=>$perce,'Quantity'=>$quan,
            'Date'=>$date,'RandR'=>'0','No'=>$real_no,'Betterment'=>$bett,'Labour_rate'=>'0','Frame_rate'=>'0','Strip_rate'=>'0',
            'Paint_rate'=>'0','MarkUp'=>'0','MarkUp2'=>'0','Frame'=>$frame,'Misc'=>'0']
        ]);

        return back()->with(['message'=>'Additional Part Added Successfully']);
    }

    public function precost_addition_edit(Request $request){
        $id=$request->landing_id;
        $price=$request->landing_price;

        DB::table('additional')
               ->where('id','=',$id)
               ->update(['Part'=>$price]); 
               
        return back()->with(['message'=>'Additional Part Edited Successfully']);
    }
    
    public function get_suppliers(Request $request){
        $asses=array();
        $name=$request->name;
        $ass_info=DB::table('supplier')->where('sup_key','=',$name)->limit(1)->get();
        foreach($ass_info as $ass_va):
        $asses[0]=$ass_va->sup_name;
        $asses[1]=$ass_va->sup_email;
        $asses[2]=$ass_va->sup_phone;
        
        endforeach;
        
        return $asses;
    }

    public function landing_cost(Request $request){
        $id=$request->stores_landing_id;
        $price=$request->stores_landing_amount;

        DB::table('qoutes')
               ->where('id','=',$id)
               ->update(['Parts_sales'=>$price]); 
               
        return back()->with(['message'=>'Price Saved!']);
    }

    #SOLVE THE SAVE ISSUE
    public function orders(Request $request){

        #LETS SEE IF IT HITS HERE
        $follow3=$request->final_order_follow3;
        if(empty($follow3)){
            $follow3='';
        }
       
                
        $order=$request->final_order_email_sender;        
        $parts=[];
        $parts=$request->final_order_parts;
        $sup_key = $request->final_order_suppliers;
        $supplier=$request->final_order_supplier;
        $comment=$request->final_order_comments;
        $notes=$request->final_order_notes;
        $supplier_email=$request->final_order_email_supplier;
        $email = $request->final_order_email_sender;
        $tel=$request->final_order_branch_tel;
        $follow=$request->final_order_follow1;
        $follow2=$request->final_order_follow2;

        
        //push_array($parts,$request->order_parts);
        $orderNum =0;
        $date = date('Y-m-d');
        $time = date('H:m:s');
        #$key=$request->key;  //final_key#
        $key=$request->final_key;  //

        

        $user=Auth::user()->username;
        
        $paths='docs/uploaded/';
        $resultp= DB::select("select order_number from orders order by order_number desc limit 0,1");
        foreach($resultp as $row)
    {
        $orderNum = ($row->order_number)+1;
    }
    $file=$key.'-'.$supplier.'-'.$orderNum.'.pdf';
    $i=0;
    foreach($parts as $part){
         DB::table('orders')->insert([
            'Description_2'=>$part,'quantity'=>'1','order_number'=>$orderNum,'Key_Ref'=>$key,'status'=>'0','credit'=>'0',
            'Part_No'=>'','Arrival'=>'','date'=>$date,'comments'=>$comment
            
        ]);  
         $reskz=DB::select('select * from orders where Key_Ref =? and order_number=?',[$key,$orderNum]);
        $i++;    
        
    }

    DB::table('confirmed_orders')->insert([
        'order_number'=>$orderNum,'Key_Ref'=>$key,'date'=>$date,'Supplier'=>$supplier,'url'=>$file,'address'=>$supplier_email,
        'user'=>$user,'follow_up_1'=>$follow,'follow_up_2'=>$follow2,'follow_up_3'=>$follow3,'user_email'=>$email,'comment'=>$comment
    ]);

    if($notes!=''){
        DB::table('notes')->insert([
            'id'=>'','Key_Ref'=>$key,'note'=>$notes,'date'=>$date,'time'=>$time,'status'=>'0','user'=>$user,'identity'=>''
       ]);
    }

    $clients=DB::table('client_details')->where('Key_Ref','=',$key)->get();
    $parts=DB::table('orders')->where('order_number','=',$orderNum)->get();
    foreach($clients as $client){
        $make=$client->Make;
        $veh_year=$client->Vehicle_year;
        $color=$client->Colour;
        $engine=$client->Eng_No;
        $vin=$client->Chasses_No;
    }



    $pdf=PDF::loadview('pdf.order',['parts'=>$parts,'make'=>$make,'veh'=>$veh_year,'color'=>$color,'engine'=>$engine,'vin'=>$vin,'follow1'=>$follow,
    'follow2'=>$follow2,'follow3'=>$follow3,'tel'=>$tel,'email'=>$email,'supplier_email'=>$supplier_email,'sender'=>$order,'notes'=>$notes,'comment'=>$comment,
    'supplier'=>$supplier,'order_no'=>$orderNum,'user'=>$user,'key'=>$key,'date'=>$date]);
    $path='docs/uploaded/';
    $path.=$file;
    $pdf->save($path);
    

    return back()->with(['message'=>'Email Ready To Be Processed!']);

    }//End Of Function
    

    #[CUURENT UPDATE ]  SEND THE EMAIL [ WITH PHPMAILER ]
    public function order_send_email($id){
     
        $confirmed=DB::table('confirmed_orders')->where('id','=',$id)->get();

        foreach($confirmed as $orders){
            $order_no=$orders->order_number;
            $path=$orders->url;
            $emailTo=$orders->address;
            $email = $orders->user_email;
            $mail_status = $orders->mail_status;

        }

        if( $mail_status == "Sent" ){
            return back()->with(['message'=>"Email already sent."]);
        }

       
        $mail = new PHPMailer(true);

        
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'mag.accounzi2018@gmail.com';                     // SMTP username
            $mail->Password   = '123coded';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($email, 'Motor Accident Group');
            $mail->addAddress($emailTo,'');   
            $mail->addReplyTo('info@motoraccidentgroup.co.za', 'Motor Accident Group');

            
            #ADDED NEW PATH
            #$path1 = '/docs/uploaded/'.$orders->url; 
            $path1 = 'docs/uploaded/'.$orders->url;           
             if (file_exists($path1)) {
                //$file_path = $path1 ;
                $file_path = realpath("C:\\xampp\htdocs\\ais\\public\\docs\\uploaded\\".$path);
            } else {
                $file_path = realpath("C:\\xampp\htdocs\\MAG_System\\models\\tcpdf\\examples\\Orders\\".$path);
            }
            // Attachments
            //$file_path = realpath("C:\\xampp\htdocs\\MAG_System\\models\\tcpdf\\examples\\Orders\\".$path);
            $mail->addAttachment( $file_path );

            // Content
            //$mail->isHTML(true); 
            $mail->Subject = 'M.A.G Order';
            $mail->Body    = 'Please find the attached document.';
            $mail->AltBody = '';

            $mail->send();
            $msg = 'Message has been sent';
             DB::table('confirmed_orders')->where('id',$id)->update(['mail_status'=>'Sent']);


          if( !$mail ){
            $msg = "Failed to send email. Please contact your manager";
          }else{
            $msg = "Email sent Successfully.";
          }

       
        return back()->with(['message'=>$msg]);


    }//End OF Function
  
    public function delete_order_email($id){

        DB::table('confirmed_orders')
               ->where('id','=',$id)
               ->delete(); 

               return back()->with(['message'=>'Order Email Has Been Deleted Successfully.']);       
    }

    public function create_supplier(Request $request){
        
        $name=$request->supplier_name;
        if(empty($name)){
            $name='';
        }
        $tel=$request->supplier_tel; 
        if(empty($tel)){
            $tel='';
        }   
        $fax=$request->supplier_fax;
        if(empty($fax)){
            $fax='';
        }    
        $email=$request->supplier_email;
        if(empty($email)){
            $email='';
        }
        $contact_name=$request->supplier_person;
        if(empty($contact_name)){
            $contact_name='';
        }
        $cell=$request->supplier_cell;
        if(empty($cell)){
            $cell='';
        }
        $alt=$request->supplier_alt;
        if(empty($alt)){
            $alt='';
        }

        DB::table('supplier')->insert([
            'sup_name'=>$name,'sup_phone'=>$tel,'sup_fax'=>$fax,'sup_email'=>$email,'sup_contact'=>$contact_name,'cell_1'=>$cell,'cell_2'=>$alt,'cell_3'=>'0'
            
        ]);

        return back()->with(['message'=>'New Supplier Created Successfully.']);       
    }

    public function credit_notes(Request $request){
        $quan=$request->credit_quan;
        $key_id=$request->credit_id;
        $p_id=$request->credit_order_id;
        $partNo=$request->credit_part;
        $description=$request->credit_description;
        $price=$request->credit_price;
        $invoice=$request->credit_invoice;
        $date=$request->credit_date;
        $comment=$request->credit_comment;
        $supname = "";
        $supemail = "";
        $ordnum = "";
        $key = "";
        $user = "";
        $qty = '';
        $des = '';

        
        $orders=DB::table('orders')->where('order_number','=',$key_id)->where('Description_2',$description)->get();
        foreach($orders as $row)
        {
            $ordnm = $row->order_number;
            $des = $row->Description_2;
            $key =  $row->Key_Ref;
            $qty = $row->quantity;
            $rfcn_='';

            $res = DB::select("select * from credit_note where Key_Ref=? order by rfcno desc limit 1",[$key]);
            if(count($res)>0){
                foreach($res as $row1)
                {
                $rfcn_ = str_replace($key.'/',"",$row1->rfcno);
                $rfcn = $key.'/'.number_format($rfcn_+1);
                }
            }else{
                $rfcn = $key.'/1';
            }

            DB::table('credit_note')->insert([
                ['Key_Ref'=>$key,'rfcno'=>$rfcn,'order_number'=>$ordnm,'p_id'=>$p_id,'Description_2'=>$des,'price'=>$price,'quantity'=>$qty,'url'=>'','Part_No'=>$partNo,'date'=>$date,'invoice_no'=>$invoice,'comment'=>$comment
                ]
            ]);
            
            DB::table('qoutes')
               ->where('Key_Ref','=',$key)
               ->where('Description','=',$des)
               ->update(['Parts_sales'=>'0.00']); 
        
    
        }


        return back()->with(['message'=>'New Credit Note Created Successfully.'.$key.'']);
    }


    #PASS THE ORDER ID, ADDED THE DROPDOWN IN THIS METHOD, TO ACCESS THE order_id
    public function get_order_parts(Request $request){
        /*
        $asses=array();
        $name=$request->order_no;
        $ass_info=DB::table('orders')->where('order_number','=',$name)->get();
        $i=0;
        foreach($ass_info as $ass_va):
        $asses[$i]=$ass_va->Description_2;
        $i++;       
        endforeach;
        
        return $asses;
        */

        $select=array();
        $name=$request->order_no;
        $orders=DB::table('orders')->where('order_number','=',$name)->get();
        $i=0;
        foreach($orders as $order):
          $select[$i] = '<option value="'. $order->id .'">'. $order->Description_2 .'</option>';
          $i++;       
        endforeach;
        
        return $select;


    }

    public function get_quantity(Request $request){
        $quan=array();
        $id=$request->id;
        $desc=$request->name;
        $ass_info=DB::table('orders')->where('order_number','=',$id)->where('Description_2','=',$desc)->get();
        $i=0;
        foreach($ass_info as $ass_va):
        $quan[0]=$ass_va->quantity;
        $quan[1]=$ass_va->id;
        $i++;       
        endforeach;
        
        return $quan;
    }


    public function get_rfc_quan(Request $request){
        
    }


    #PRINT CREDITS
    public function print_credit_parts( Request $request ){

        $id = $request->credit_description;   //Order id
        $price = number_format( $request->credit_price ,2);
        $partNo = $request->credit_part;
        $Invceno = $request->credit_invoice;
        $date = $request->credit_date;
        $supname = "";
        $supemail = "";
        $ordnum = "";
        $key = "";
        $user = "";
        $qty = '';
        $des = '';
        $comm ='';
        $rfcno = '';
    
        $results = DB::table('orders')->where('id','=',$id)->get();
        foreach($results as $result)
        {
            $ordnm = $result->order_number;
            $des   = $result->Description_2;
            $key   = $result->Key_Ref;
            $qty   = $result->quantity;

            #GET THE CREDIT NOTE
            $credit_note_value = DB::table('credit_note')->where('Key_Ref','=',$key)->orderBy('id','desc')->value('rfcno');

            $resultas = DB::table('confirmed_orders')
                        ->join('credit_note','confirmed_orders.Key_Ref','=','credit_note.Key_Ref')
                        ->select('confirmed_orders.Supplier','confirmed_orders.address','confirmed_orders.order_number','credit_note.Key_Ref','credit_note.comment','confirmed_orders.user')
                        ->distinct('confirmed_orders.Supplier')
                        ->where('confirmed_orders.order_number','=',$ordnm)
                        ->get();

            foreach($resultas as $row)
            {
                $supname   = $row->Supplier;
                $supemail = $row->address;
                $ordnum = $row->order_number;
                $key = $row->Key_Ref;
                $user = $row->user;
                $comm = $row->comment;
            }
        }
    
        $rfcno = $credit_note_value;
        
        #OUTPUT DATA
        $pdf=PDF::loadview('pdf.return_for_credit',[ 'supname'=>$supname,'date'=>$date,'supemail'=>$supemail,'rfcno'=>$rfcno,'ordnum'=>$ordnum,
            'key'=>$key,'user'=>$user,'qty'=>$qty,'partNo'=>$partNo,'des'=>$des,'Invceno'=>$Invceno,'price'=>$price,'comm'=>$comm ]);
        
        return $pdf->stream('Credit Note(RFC).pdf');
    
    }



    #SAVE AND PRINT PARTS CREDIT [ THE ONES WE ARE RETURNING BACK ]
    public function save_credit_parts( Request $request ){
            
        #SAVE AND PRINT RFC FORM    
        $quan=$request->credit_quantity;
        $key_id=$request->order_num;  //ORDR NUMBER

        //$p_id=$request->credit_order_id;
        $p_id="EMPTY";
        $partNo=$request->credit_part_no;

        //$description=$request->credit_description;
        $order_id=$request->order_id;

        $price=$request->credit_price;
        $invoice=$request->credit_invoice;
        $date=$request->credit_date;
        $comment=$request->credit_comment;
        $supname = "";
        $supemail = "";
        $ordnum = "";
        $key = "";
        $user = "";
        $qty = '';
        $des = '';
        
        $orders=DB::table('orders')->where('order_number','=',$key_id)->where('id',$order_id)->get();
        //$orders=DB::table('orders')->where('order_number','=',$key_id)->get();

    
        foreach($orders as $row)
        {
            $ordnm = $row->order_number;
            $des = $row->Description_2;
            $key =  $row->Key_Ref;
            //$qty = $row->quantity;
            $rfcn_='';

            $res = DB::select("select * from credit_note where Key_Ref=? order by id desc limit 1",[$key]);
            //$res = DB::table('credit_note')->where('Key_Ref','=',$key)->orderBy('id','desc')->value('rfcno');

            if(count($res)>0){
                foreach($res as $row1)
                {
                $rfcn_ = str_replace($key.'/',"",$row1->rfcno);
                $rfcn = $key.'/'.number_format($rfcn_+1);
                }
            }else{
                $rfcn = $key.'/1';
            }

                $save = DB::table('credit_note')->insert([ 'Key_Ref'=>$key,'rfcno'=>$rfcn,'order_number'=>$ordnm,
                'p_id'=>$p_id,'Description_2'=>$des,'price'=>$price,'quantity'=>$quan,'url'=>'','Part_No'=>$partNo,
                'date'=>$date,'invoice_no'=>$invoice,'comment'=>$comment ]);
                
            if( $save ){ 
                $update = DB::table('qoutes')->where('qoutes.Description', '=',$des)->where('qoutes.Key_Ref','=',$key)->update( ['qoutes.Parts_sales'=> 0.00 ] ); 

            }

                
        }
    
        //var_dump( $save ); die;

        #PRINT IN ROUTE [ ROUTE: print-parts-credit = print_credit_parts() ]
        if( $save ){
            #SET 1 [ True ]
            return 1;
        }else{
            #SET 0 [ False ]
            return 0;
        }
    
    
    }

    public function search_archive_precosting(Request $request){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $key=$request->precosting_archieve_key;

        /*$precosting=DB::table('client_details')
                            ->join('confirmed_orders','client_details.Key_Ref','=','confirmed_orders.Key_Ref')
                            ->join('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                            ->join('securityphotos','client_details.Key_Ref','=','securityphotos.Key_Ref')
                            ->join('track_photos','client_details.Key_Ref','=','track_photos.Key_Ref')
                            ->join('document','client_details.Key_Ref','=','document.Key_ref')
                            ->select('client_details.Key_Ref','client_details.Reg_No','client_details.Make','client_details.Model','client_details.Fisrt_Name','client_details.Last_Name','client_details.Cell_number',DB::raw('count(track_photos.picture_name) count_track'),DB::raw('count(securityphotos.url) count_security'))
                            ->where('client_details.status','=','1')
                            ->orderBy('client_details.id','desc')
                            ->groupBy('client_details.Key_Ref')
                            ->limit(200)
                            ->get();
        */
        $precosting=DB::table('client_details')
                            ->distinct('client_details.Inv_Date')
                            ->leftjoin('confirmed_orders','client_details.Key_Ref','=','confirmed_orders.Key_Ref')
                            ->leftjoin('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                            ->select('client_details.Key_Ref','client_details.Reg_No','client_details.Make','client_details.Model','client_details.Fisrt_Name','client_details.Last_Name','client_details.Cell_number','confirmed_orders.user','confirmed_orders.date','confirmed_orders.Supplier','confirmed_orders.address')
                            ->where('client_details.status','=','1')
                            ->orderBy('client_details.id','desc')
                            ->where('client_details.Key_Ref','=',$key)
                            ->orWhere('client_details.Reg_No','=',$key)
                            ->distinct('client_details.Key_Ref')
                            ->get();
        
        return view('parts.precosting',['precostings'=>$precosting,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
    }

    public function additional_parts_ordering(){


                $table='<table class="table table-sm" style="font-size:10px;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date/Time</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Order No.</th>
                        
                        <th scope="col">File</th>
                        <th scope="col">Status</th>
                        <th scope="col">Comments</th>
                        <th scope="col">Credits</th>
                        <th scope="col">Action</th>    
                    </tr>
                </thead>
                <tbody>';
                    
                    foreach($confirmed_orders as $orders){
                    $table.='<tr>';
                    $table.='<td>'.$count_orders.'</td>';
                    $table.='<td>'.$orders->date.'</td>';
                    $table.='<td>'.$orders->Supplier.'</td>';
                    $table.='<td>'.$orders->order_number.'</td>';

                    #ADD THIS                            
                    $path = 'docs/uploaded/'.$orders->url;
                    $path2 = 'http://192.168.0.185:8080/Mag_System/models/tcpdf/examples/Orders/'.$orders->url;
                    if (file_exists($path)) {
                        //$file_name =$path ;
                        $file_name =asset('/docs/uploaded/'.$orders->url);
                    } else {
                        $file_name = $path2;
                    }

                    
                    #FIX AND UPDATE THE HREF
                    /*
                    $table.='<td><a href="/docs/uploaded/'.$orders->url.'" target="_blank">'.$orders->url.'</a></td>';
                    http://localhost/Mag_System/models/tcpdf/examples/Orders/SL73632202008120623file.pdf

                    $table.='<td><a href="/docs/uploaded/'.$orders->url.'" target="_blank">'.$orders->url.'</a></td>';
                    */
                    
                    //$table.='<td><a href="http://192.168.0.185:8080/Mag_System/models/tcpdf/examples/Orders/'.$orders->url.'" target="_blank">'.$orders->url.'</a></td>';
                    $table.='<td><a href="'.$file_name.'" target="_blank">'.$orders->url.'</a></td>';

                        if($orders->mail_status=="Sent"){
                        $table.='<td style="color:green;"><b>'.$orders->mail_status.'</b></td>';    
                        }else{    
                        $table.='<td style="color:red;"><b>'.$orders->mail_status.'</b></td>';
                        }    
                        $table.='<td>'.$orders->comment.'</td>';
                        $table.='<td><a href="#" class="btn btn-primary btn-sm create_create_notes" id="credit_no" data-order_no="'.$orders->order_number.'" data-order_id="'.$orders->id.'" title="Credits Notes">Credit Notes</a></td>';
                        $table.='<td>';
                            
                        $table.='<a href="/pre-costing-order-email/'.$orders->id.'" title="Send Mail" class="btn btn-success btn-sm"><span class="fa fa-envelope"></span></a>';
                        $table.='<a href="/pre-costing-order-email-delete/'.$orders->id.'" title="Delete Mail" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>';
                        $table.='</td>';
                        $table.='</tr>';
                        $count_orders++;
                    }
                    $table.='</tbody>';
                    $table.='</table>';
                    $table.='<br>';
                    
        //$table.='<form method="POST" action="/pre-costing-order">';
        $table.='<form method="GET" action="/pre-costing-order">';
        $table.='<input type="hidden" name="final_key" id="final_key" value="'.$id.'">';

        $table.='<div class="row">';

        $table.='<div class="card shadow mb-3 col-6">'; 
        $table.='<div class="card-body">'; 

        $table.='<div class="row">';  
        $table.='<select class="custom-select" id="final_order_parts" name="final_order_parts[]" style="font-size:10px;" multiple="multiple"  required>';
        $table.='<option selected>Open this select menu</option>';
        foreach($storage as $parts){
        $table.='<option value="'.$parts->Description.'">'.$parts->Description.'</option>';
        }    
        $table.='</select>
        </div>';
        $table.=' 
        <br>
        <div class="row">
        <div class="input-group">
        <div class="input-group-prepend">
        <label class="input-group-text" for="final_order_suppliers" style="font-size:10px;">Suppliers</label>
        </div>
        <select class="custom-select form-control-sm" id="final_order_suppliers" name="final_order_suppliers" style="font-size:10px;" required>
            <option selected>Select Supplier</option>';
            foreach($suppliers as $supplier){
                $table.='<option value="'.$supplier->sup_key.'">'.$supplier->sup_name.'</option>';
            }
        $table.='</select>
        </div>
        </div>
        <br>';

        $table.='
        <div class="row">
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" style="font-size:10px;">Comments</span>
        </div>
        <textarea class="form-control form-control-sm" style="font-size:10px;" rows="5" aria-label="With textarea" name="final_order_comments" id="final_order_comments" required></textarea>
        </div>     
        </div> 
        <br>

        <div class="row">
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" style="font-size:10px;">Notes</span>
        </div>
        <textarea class="form-control form-control-sm" style="font-size:10px;" rows="5" aria-label="With textarea" name="final_order_notes" id="final_order_notes" required></textarea>
        </div>
        </div>
        ';

        $table.='</div></div>';


        $table.='
        <!-- #SECOND  CARD -->
        <div class="card shadow mb-3 col-6">
        <div class="card-body">
        <div class="row">
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="font-size:10px;height:26px;">Suppliers Name</span>
        </div>
            <input type="text" class="form-control form-control-sm" style="font-size:10px;" placeholder="Supplier Name" aria-label="order_supplier" aria-describedby="order_supplier" id="final_order_supplier" name="final_order_supplier" required>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="font-size:10px;height:26px;">Supplier Email</span>
        </div>
            <input type="email" class="form-control form-control-sm" style="font-size:10px;" placeholder="Email" aria-label="order_email_supplier" aria-describedby="final_order_email_supplier" name="final_order_email_supplier" id="final_order_email_supplier" required>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="order_email" style="font-size:10px;height:26px;">Sender Email</span>
        </div>
            <input type="email" class="form-control form-control-sm" style="font-size:10px;" aria-label="order_email" aria-describedby="order_email" id="final_order_email_sender" name="final_order_email_sender" required>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="final_order_branch" style="font-size:10px;height:26px;">Branch Tel</span>
        </div>
            <input type="text" class="form-control form-control-sm" style="font-size:10px;" aria-label="order_branch_tel" name="final_order_branch_tel" id="final_order_branch_tel" aria-describedby="order_branch" required>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="final_order_follow1" style="font-size:10px;height:26px;">Follow Up 1</span>
        </div>
            <input type="date" class="form-control form-control-sm" style="font-size:10px;" aria-label="order_follow1" aria-describedby="order_follow1" name="final_order_follow1" id="final_order_follow1" required>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="order_follow2" style="font-size:10px;height:26px;">Follow Up 2</span>
        </div>
            <input type="date" class="form-control form-control-sm" style="font-size:10px;" aria-label="order_follow2" aria-describedby="order_follow2" name="final_order_follow2" id="final_order_follow2" required>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="order_follow3" style="font-size:10px;height:26px;">Follow Up 3</span>
        </div>
            <input type="date" class="form-control form-control-sm" style="font-size:10px;" aria-label="order_follow3" name="final_order_follow3" id="final_order_follow3" aria-describedby="basic-addon1" required>
        </div>
        </div>

        </div>
        </div>

        <input type="submit" class="btn btn-success btn-sm float-right" value="Save">
        </form>
        ';

        $table.='</div>';

                
        return $table;
    }


    #ADD OTP DATA [ 07 APRIL 2021 ]
    public function otp_check(Request $request){
        $id=$request->key_ref;
        $username=Auth::user()->username;
        $otp_code=$request->otp_code;

        $exist=DB::table('users')->where('otp','=',$otp_code)->where('username','=',$username)->exists();
        if($exist){    
            return 1;
        }else{
            return 0;
        }

    
    }



    //SHOW THE ADDTIONAL ORDER SAVING
    public function otp_show_additional_order(Request $request){
        $id=$request->key_ref;
            
          #ADDED VARIABLE
          $file_name = "";
  
          //$table='';
          $count_orders=1;
          $confirmed_orders=DB::table('confirmed_orders')->where('Key_Ref','=',$id)->get(); 
          $suppliers=DB::table('supplier')->get();
          $storage= DB::table('additional')->where('Key_Ref','=',$id)->get();
  
  
  
  
  $table='';
                                  
  $table='<form method="GET" action="/pre-costing-additional-order">';
   $table.='<input type="hidden" name="final_key" id="final_key" value="'.$id.'">';
  
  $table.='<div class="row">';
  
  $table.='<div class="card shadow mb-3 col-6">'; 
  $table.='<div class="card-body">'; 
  
   $table.='<div class="row">';  
         $table.='<select class="custom-select" id="additional_order_parts" name="additional_order_parts[]" style="font-size:10px;" multiple="multiple"  required>';
             $table.='<option selected>Open this select menu</option>';
             foreach($storage as $parts){
                 $table.='<option value="'.$parts->Description.'">'.$parts->Description.'</option>';
             }    
         $table.='</select>
         </div>';
   $table.=' 
             <br>
             <div class="row">
                 <div class="input-group">
                     <div class="input-group-prepend">
                         <label class="input-group-text" for="additional_order_suppliers" style="font-size:10px;">Suppliers</label>
                     </div>
                     <select class="custom-select form-control-sm" id="additional_order_suppliers" name="additional_order_suppliers" style="font-size:10px;" required>
                           <option selected>Select Supplier</option>';
                           foreach($suppliers as $supplier){
                               $table.='<option value="'.$supplier->sup_key.'">'.$supplier->sup_name.'</option>';
                           }
             $table.='</select>
                 </div>
             </div>
             <br>';
  
              $table.='
             <div class="row">
                 <div class="input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text" style="font-size:10px;">Comments</span>
                       </div>
                       <textarea class="form-control form-control-sm" style="font-size:10px;" rows="5" aria-label="With textarea" name="additional_order_comments" id="additional_order_comments" required></textarea>
                 </div>     
             </div> 
             <br>
  
             <div class="row">
                 <div class="input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text" style="font-size:10px;">Notes</span>
                       </div>
                       <textarea class="form-control form-control-sm" style="font-size:10px;" rows="5" aria-label="With textarea" name="additional_order_notes" id="additional_order_notes" required></textarea>
                 </div>
             </div>
             ';
  
  $table.='</div></div>';
  
  
      $table.='
       <!-- #SECOND  CARD -->
       <div class="card shadow mb-3 col-6">
             <div class="card-body">
                 <div class="row">
                     <div class="input-group">
                         <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1" style="font-size:10px;height:26px;">Suppliers Name</span>
                         </div>
                             <input type="text" class="form-control form-control-sm" style="font-size:10px;" placeholder="Supplier Name" aria-label="additional_order_supplier" aria-describedby="additional_order_supplier" id="additional_order_supplier" name="additional_order_supplier" required>
                     </div>
                 </div>
                 <br>
                 <div class="row">
                     <div class="input-group">
                         <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1" style="font-size:10px;height:26px;">Supplier Email</span>
                         </div>
                             <input type="email" class="form-control form-control-sm" style="font-size:10px;" placeholder="Email" aria-label="additional_order_email_supplier" aria-describedby="additional_order_email_supplier" name="additional_order_email_supplier" id="additional_order_email_supplier" required>
                     </div>
                 </div>
                 <br>
                 <div class="row">
                     <div class="input-group">
                         <div class="input-group-prepend">
                             <span class="input-group-text" id="order_email" style="font-size:10px;height:26px;">Sender Email</span>
                         </div>
                             <input type="email" class="form-control form-control-sm" style="font-size:10px;" aria-label="additional_order_email_sender" aria-describedby="additional_order_email_sender" id="additional_order_email_sender" name="additional_order_email_sender" required>
                     </div>
                 </div>
                 <br>
                 <div class="row">
                     <div class="input-group">
                         <div class="input-group-prepend">
                             <span class="input-group-text" id="final_order_branch" style="font-size:10px;height:26px;">Branch Tel</span>
                         </div>
                             <input type="text" class="form-control form-control-sm" style="font-size:10px;" aria-label="additional_order_branch_tel" name="additional_order_branch_tel" id="additional_order_branch_tel" aria-describedby="additional_order_branch_tel" required>
                     </div>
                 </div>
                 <br>
                 <div class="row">
                     <div class="input-group">
                         <div class="input-group-prepend">
                             <span class="input-group-text" id="final_order_follow1" style="font-size:10px;height:26px;">Follow Up 1</span>
                         </div>
                             <input type="date" class="form-control form-control-sm" style="font-size:10px;" aria-label="additional_order_follow1" aria-describedby="additional_order_follow1" name="additional_order_follow1" id="additional_order_follow1" required>
                     </div>
                 </div>
                 <br>
                 <div class="row">
                     <div class="input-group">
                         <div class="input-group-prepend">
                             <span class="input-group-text" id="order_follow2" style="font-size:10px;height:26px;">Follow Up 2</span>
                         </div>
                             <input type="date" class="form-control form-control-sm" style="font-size:10px;" aria-label="additional_order_follow2" aria-describedby="additional_order_follow2" name="additional_order_follow2" id="additional_order_follow2" required>
                     </div>
                 </div>
                 <br>
                 <div class="row">
                     <div class="input-group">
                         <div class="input-group-prepend">
                             <span class="input-group-text" id="order_follow3" style="font-size:10px;height:26px;">Follow Up 3</span>
                         </div>
                             <input type="date" class="form-control form-control-sm" style="font-size:10px;" aria-label="additional_order_follow3" name="additional_order_follow3" id="additional_order_follow3" aria-describedby="basic-addon1" required>
                     </div>
                 </div>
  
             </div>
       </div>
         
       <input type="submit" class="btn btn-success btn-sm float-right" value="Save">
       </form>
       ';
      
                            
          return $table;
  
  
      }





      
    #ADDITIONAL ORDERS   [ 11 MAY 2021 ]
    public function additional_orders(Request $request){
        $follow3=$request->additional_order_follow3;
        if(empty($follow3)){
            $follow3='';
        }
       
        $order=$request->additional_order_email_sender;        
        $parts=[];
        $parts=$request->additional_order_parts;
        $sup_key = $request->additional_order_suppliers;
        $supplier=$request->additional_order_supplier;
        $comment=$request->additional_order_comments;
        $notes=$request->additional_order_notes;
        $supplier_email=$request->additional_order_email_supplier;
        $email = $request->additional_order_email_sender;
        $tel=$request->additional_order_branch_tel;
        $follow=$request->additional_order_follow1;
        $follow2=$request->additional_order_follow2;

        $orderNum =0;
        $date = date('Y-m-d');
        $time = date('H:m:s');
        $key=$request->final_key; 

        $user=Auth::user()->username;
        
        $paths='docs/uploaded/';
        $resultp= DB::select("select order_number from orders order by order_number desc limit 0,1");
        foreach($resultp as $row)
        {
            $orderNum = ($row->order_number)+1;
        }
        $file=$key.'-'.$supplier.'-'.$orderNum.'.pdf';
        $i=0;
        foreach($parts as $part){
             DB::table('orders')->insert([
                'Description_2'=>$part,'quantity'=>'1','order_number'=>$orderNum,'Key_Ref'=>$key,'status'=>'0','credit'=>'0',
                'Part_No'=>'','Arrival'=>'','date'=>$date,'comments'=>$comment
                
            ]);  
             $reskz=DB::select('select * from orders where Key_Ref =? and order_number=?',[$key,$orderNum]);
            $i++;    
            
        }

        DB::table('confirmed_orders')->insert([
            'order_number'=>$orderNum,'Key_Ref'=>$key,'date'=>$date,'Supplier'=>$supplier,'url'=>$file,'address'=>$supplier_email,
            'user'=>$user,'follow_up_1'=>$follow,'follow_up_2'=>$follow2,'follow_up_3'=>$follow3,'user_email'=>$email,'comment'=>$comment
        ]);

        if($notes!=''){
            DB::table('notes')->insert([
                'id'=>'','Key_Ref'=>$key,'note'=>$notes,'date'=>$date,'time'=>$time,'status'=>'0','user'=>$user,'identity'=>''
           ]);
        }

        $clients=DB::table('client_details')->where('Key_Ref','=',$key)->get();
        $parts=DB::table('orders')->where('order_number','=',$orderNum)->get();
        foreach($clients as $client){
            $make=$client->Make;
            $veh_year=$client->Vehicle_year;
            $color=$client->Colour;
            $engine=$client->Eng_No;
            $vin=$client->Chasses_No;
        }



        $pdf=PDF::loadview('pdf.order',['parts'=>$parts,'make'=>$make,'veh'=>$veh_year,'color'=>$color,'engine'=>$engine,'vin'=>$vin,'follow1'=>$follow,
        'follow2'=>$follow2,'follow3'=>$follow3,'tel'=>$tel,'email'=>$email,'supplier_email'=>$supplier_email,'sender'=>$order,'notes'=>$notes,'comment'=>$comment,
        'supplier'=>$supplier,'order_no'=>$orderNum,'user'=>$user,'key'=>$key,'date'=>$date]);
        $path='docs/uploaded/';
        $path.=$file;
        $pdf->save($path);
        

        return back()->with(['message'=>'Email Ready To Be Processed!']);

    }//End Of Function


  

    


    

}//End Of Class
