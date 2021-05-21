<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CustomerCareController extends Controller
{
    public function index(){
        
        $feedback_total=DB::table('client_feedback')->count();
        $total_happy=DB::table('client_feedback')->where('comment_type','=','Happy')->count();
        $total_unavailable=DB::table('client_feedback')->where('comment_type','=','Unavailable')->count();
        $total_workman=DB::table('client_feedback')->where('comment_type','=','Workmanship')->count();
        $total_comm=DB::table('client_feedback')->where('comment_type','=','Communication')->count();
        $total_other=DB::table('client_feedback')->where('comment_type','=','Other')->count();
        return view('customercare.customercarekpi',['total'=>$feedback_total,'happy'=>$total_happy,'unavailable'=>$total_unavailable,'workman'=>$total_workman,'comm'=>$total_comm,'other'=>$total_other]);
    }

    public function create_notes(Request $request){
      $id=$request->customer_id;
      $notes=$request->customer_care_note;
      $date=date('Y-m-d');
      $time=date('H:i:s');
      $username=Auth::user()->username;
      DB::table('notes')->insert([
        ['Key_Ref'=>$id,'note'=>$notes,'status'=>'0','user'=>$username,'date'=>$date,'time'=>$time]
    ]); 
    return back()->with(['message'=>'Comments Added Successfully.']);
    }

    public function release(){
        //The Custom Dashboard
        //Dashboard User
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        //Table Query
        $date=\Carbon\Carbon::today()->subday(30);
        $past_7=DB::table('client_details')
                        ->where('release_date','>=',$date)
                        
                        ->join('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                        ->orderBy('release_date','desc')
                        ->get();
        return view('customercare.releaselist',['final'=>$final,'past_7'=>$past_7,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
    }

  public function note(Request $request){
      $id=$request->comment_track;
      $comment=$request->comment_note;
      $comment_type=$request->comment_type;
     
      DB::table('client_feedback')->insert([
        ['Key_Ref'=>$id,'comment_type'=>$comment_type,'comment_note'=>$comment,'status'=>'1','user'=>'Developer - Neo']
    ]);
        
    
    return back()->with(['message'=>'Comments Added Successfully.']);

  }
  
  public function edit_client(){
    $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        // $customer=Auth::user()->custome\ r_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
    $client_feed=DB::table('client_details')
                       ->join('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                       ->join('client_feedback','client_details.Key_Ref','=','client_feedback.Key_Ref')
                       ->orderBy('release_date','desc')
                       ->get();
    return view('customercare.editcustomer',['final'=>$final,'customer_feedback'=>$client_feed,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);                    
  }

  public function edit_feedback_notes(Request $request){
    $ref=$request->comment_id_edit;
    $comment_note=$request->comment_note_edit;
    DB::table('client_feedback')
    ->where('id',$ref)
    ->update(['comment_note'=>$comment_note]);
    return back()->with(['message'=>'Comments Edited Successfully.']);
  }

  public function customers(){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $customer_info=DB::table('fetch_ApprovedQuotes')
                            ->leftjoin('track_photos','fetch_ApprovedQuotes.Key_Ref','=','track_photos.Key_Ref')
                            ->leftjoin('document','fetch_ApprovedQuotes.Key_Ref','=','document.Key_Ref')
                            ->leftjoin('securityphotos','fetch_ApprovedQuotes.Key_Ref','=','securityphotos.Key_Ref')
                            ->select('fetch_ApprovedQuotes.Fisrt_Name','fetch_ApprovedQuotes.Last_Name','fetch_ApprovedQuotes.Reg_No','fetch_ApprovedQuotes.Make','fetch_ApprovedQuotes.Model','fetch_ApprovedQuotes.Estimator','fetch_ApprovedQuotes.Assessor','fetch_ApprovedQuotes.Inserer','fetch_ApprovedQuotes.Date','fetch_ApprovedQuotes.Claim_NO', DB::raw("count(track_photos.picture_name) as count_track"), DB::raw("count(document.url) as count_docs"), DB::raw("count(securityphotos.url) as count_security"))
                            ->limit(5)  
                            ->get(); 
                            
    return view('customercare.customer',['final'=>$final,'customers'=>$customer_info,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);                         

  }

  public function client_details(){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
    $table='';
    $result=DB::select("select * from fetch_ApprovedQuotes limit 0,1000");
    foreach($result as $row)
{
    $id = $row->Key_Ref;
    $result1=DB::select("select distinct count(picture_name)as cnt from track_photos where Key_Ref=? AND category='WORK IN PROGRESS'",[$id]);
    
    foreach($result1 as $row1 )
    {
        $count = $row1->cnt;
    }

    $result_additional=DB::select("select distinct count(picture_name)as cnt from track_photos where Key_Ref=? AND category='ADDITIONAL'",[$id]);
    foreach($result_additional as $additional){
      $count_add=$additional->cnt;
    }

    $result_stage=DB::select("select distinct count(picture_name)as cnt from track_photos where Key_Ref=? AND category='FINAL STAGE'",[$id]);
    foreach($result_stage as $final_count){
      $count_final=$final_count->cnt;
    }

    $result2 = DB::select("select distinct count(url)as cnt from document where Key_Ref=?",[$id]);
    
    foreach($result2 as $row2)
    {
        $count1 = $row2->cnt;
    }
    $result3 = DB::select("select distinct count(url)as cnt from securityphotos where Key_Ref=?",[$id]);
    
    foreach($result3 as $row1)
    {
        $count2 = $row1->cnt;
    }
    $table.= "<tr>".
                "<td><a href='/customer-care-client-details/".$row->Key_Ref."' id='".$row->Key_Ref."' '><strong>".$row->Key_Ref."</strong></a></td>".
                //"<td>".$row["branch"]."</td>".
                "<td>".$row->Fisrt_Name."</td>".
                "<td>".$row->Last_Name."</td>".
                "<td>".$row->Reg_No."</td>".
                "<td>".$row->Make."</td>".
                "<td>".$row->Model."</td>".
                
                "<td>".$row->Date."</td>".
                
                
                "<td><button class='btn btn-sm btn-warning add_photo_customer_care' data-id='".$row->Key_Ref."'><span style='font-size:10px;' class='badge'> $count_add</span></button></td>".
                "<td><button class='btn btn-sm btn-danger secur_photo_customer_care' data-id='".$row->Key_Ref."'><span style='font-size:10px;' class='badge'> $count2</span></button></td>".
                "<td><button class='btn btn-sm btn-secondary wip_photo_customer_care' data-id='".$row->Key_Ref."'><span style='font-size:10px;' class='badge'>$count</span></button></td>".
                "<td><button class='btn btn-sm btn-info final_stage_photo_customer_care' data-id='".$row->Key_Ref."'><span style='font-size:10px;' class='badge'>$count_final</span></button></td>".
                
                "<td><button class='btn btn-sm btn-primary document_customer_care' data-id='".$row->Key_Ref."'><span style='font-size:10px;' class='badge'> $count1</span></button></td>".
           "</tr>";
  }

  return view('customercare.customer',['table'=>$table,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
  }

  public function view_client_details($key_ref){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;

        $notes=DB::table('notes')->where('Key_Ref','=',$key_ref)->get();    
        $smses=DB::table('sms_eventlog')->where('Key_Ref','=',$key_ref)->get();
        $document=DB::table('document')->where('Key_Ref','=',$key_ref)->get();
        $wip_photos=DB::table('track_photos')->where('Key_Ref','=',$key_ref)->where('category','=','WORK IN PROGRESS')->get();
        $additional_photos=DB::table('track_photos')->where('Key_Ref','=',$key_ref)->where('category','=','ADDITIONAL')->get();
        $pics=DB::table('securityphotos')->where('Key_Ref','=',$key_ref)->get();

        $client_details=DB::table('client_details')
                                ->where('client_details.Key_Ref','=',$key_ref)
                                ->orWhere('client_details.Reg_No','=',$key_ref)
                                ->leftjoin('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                                ->leftjoin('pre_bookings','client_details.Key_Ref','=','pre_bookings.Key_Ref')
                                ->leftjoin('towing_history','client_details.Key_Ref','=','towing_history.Key_Ref')
                                ->select('client_details.Date','client_details.Chasses_No','client_details.KM','client_details.Key_Ref','client_details.Reg_No','client_details.Fisrt_Name','client_details.Last_Name','client_details.id_number','client_details.BirthDate','client_details.Cell_number','client_details.Email','client_details.Address_1','client_details.Address_2','client_details.Address_3','pre_bookings.booking_date','client_details.Make','client_details.Model','insurer.Inserer','client_details.status','towing_history.*','client_details.Eng_No','client_details.Colour','client_details.Vehicle_year','client_details.Address_1','client_details.Address_2','client_details.Address_3','client_details.Estimator','client_details.branch','client_details.Eng_No','insurer.Contact as ins_contact','insurer.Phone','insurer.Assessor','insurer.Email as ins_email','insurer.Claim_NO as ins_claim','insurer.ClerkName','insurer.Assessor_Email','insurer.Assessor_Cell','insurer.Assessor_comp','towing_history.tel as tow_tel','towing_history.email as tow_email')
                                ->limit(1)
                                ->get();
        foreach($client_details as $client){
          $reg_no=$client->Reg_No;
          $cell_no=$client->Cell_number;
        }

        $payments =DB::table('payments')->where('Key_Ref',$key_ref)->get();
        
        $towing_sms=DB::table('sms_event')->where('stage_no','1')->get();
        $booking_sms=DB::table('sms_event')->where('stage_no','3')->get();
        $carhire_sms=DB::table('sms_event')->where('stage_no','18')->get();
        $ordering_sms=DB::table('sms_event')->where('stage_no','6')->get();
        $quote_sms=DB::table('sms_event')->where('stage_no','17')->get();
        $customer_sms=DB::table('sms_event')->where('stage_no','16')->orWhere('stage_no','22')->get();

        $sms_towing_event=DB::table('sms_eventlog')->where('stage_no','1')->where('Key_Ref',$key_ref)->get();
        $sms_booking_event=DB::table('sms_eventlog')->where('stage_no','3')->where('Key_Ref',$key_ref)->get();
        $sms_carhire_event=DB::table('sms_eventlog')->where('stage_no','18')->where('Key_Ref',$key_ref)->get();
        $sms_ordering_event=DB::table('sms_eventlog')->where('stage_no','6')->where('Key_Ref',$key_ref)->get();
        $sms_quote_event=DB::table('sms_eventlog')->where('stage_no','17')->where('Key_Ref',$key_ref)->get();
        $sms_customer_event=DB::table('sms_eventlog')->where('stage_no','22')->where('Key_Ref',$key_ref)->get();

        $insu_broker=DB::table('broker_table')->get();
        $assessor=DB::table('assessors')->orderBy('Names','ASC')->get();
        $branches=DB::table('branch')->get();


    return view('customercare.viewclient',['key'=>$key_ref,'payments'=>$payments,'notes'=>$notes,'smses'=>$smses,'documents'=>$document,'images'=>$pics,'wip_photos'=>$wip_photos,'additional_photos'=>$additional_photos,'clients_details'=>$client_details,'towing_sms'=>$towing_sms,'reg'=>$reg_no,'cell_no'=>$cell_no,'sms_towing_event'=>$sms_towing_event,'sms_booking_event'=>$sms_booking_event,'booking_sms'=>$booking_sms,'carhire_sms'=>$carhire_sms,'sms_carhire_event'=>$sms_carhire_event,'sms_ordering_event'=>$sms_ordering_event,'ordering_sms'=>$ordering_sms,'quote_sms'=>$quote_sms,'sms_quote_event'=>$sms_quote_event,'customer_sms'=>$customer_sms,'sms_customer_event'=>$sms_customer_event,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final,'brokers'=>$insu_broker,'assessor'=>$assessor,'branches'=>$branches]);
  }

  public function release_car($id){
    
    $date=date('Y-m-d');
    DB::table('client_details')
                ->where('Key_Ref',$id)
                ->update(['release_date'=>$date,'status'=>'1']);

    //return back()->with(['message'=>'Release Status Updated.']);
    //return redirect(route('print-taxi-clearance'))->with(['id'=>$id]); 
    return redirect()->route('print-clearance-certificate', ['id' => $id]);
  }

  public function save_customer(Request $request){
        

        $id=$request->key;
        $ex1=$request->excess_1;
        $ex2=$request->excess_2;
        $pvt=$request->private;
        $bett=$request->betterment;
        $add=$request->add_work;
        $other=$request->otherwork;

        $check=DB::table('betterment')->where('Key_Ref','=',$id)->get();
        if(count($check)>0){
          DB::table('betterment')
                ->where('Key_Ref',$id)
                ->update(['Excess_1'=>$ex1,'Excess_2'=>$ex2,'Private_work'=>$pvt,'Additional_1'=>$add,'Additional_4'=>$other]);
        }else{
          DB::table('betterment')->insert([
            ['Key_Ref'=>$id,'Excess_1'=>$ex1,'Excess_2'=>$ex2,'Private_work'=>$pvt,'Additional_1'=>$add,'Additional_4'=>$other]
        ]);
        
        }  
        return back()->with(['message'=>'Successfully Saved.']);        

  }

  public function customer_care_send_sms(Request $request){

        $id=$request->sms_stage;
        $key_ref=$request->sms_id;
        $cell=$request->sms_cell;
        $message=$request->sms_message;
        $reg=$request->sms_reg;
        $title=$request->sms_title;

        $date=date('Y-m-d');
        $time=date('H:i:s');
        $username=Auth::user()->username;

        $mail = new PHPMailer(true);
        //$mail = new PHPMailer();
        $mail->SMTPDebug = 3;  
        $mail->isHTML(true);
	      $mail->isSMTP();                                         
        $mail->Host       = 'mail.2way.co.za';                  
        $mail->SMTPAuth   = true;                                 
        $mail->Username   = '22041';                   
        $mail->Password   = 'track2';                            
        $mail->Port       = 587; 
        // Authentication
        $mail->Username   = "22041";                    // Login
        $mail->Password   = "track2";                   // Password
        $mail->Mailer = "smtp";
        // Compose
        $mail->Subject = "Motor Accident Group SMS";     // Subject (which isn't required)
        $mail->Body = "$reg".": "."$message";                        // Body of our message
        $mail->From = "track2@2way.co.za";
        // Send To

    $to  = '+27'.substr($cell,1)."@2way.co.za"; 

    DB::table('sms_eventlog')->insert([
        ['Key_Ref'=>$key_ref,'stage_no'=>$id,'title'=>$title,'message'=>$message,'status'=>'1','user'=>$username,'sent_date'=>$date,'sent_time'=>$time]
    ]);    
    $mail->AddAddress($to); 
    if(!$mail->Send()) {
        return back()->with(['message'=>'SMS Failed To Send.']);
    
    } else {
        return back()->with(['message'=>'SMS Successfully Sent.']);
    }
	
    $mail->clearAddresses();
  }

  public function customer_care_create_note(Request $request){
    $id=$request->customer_id;
    $note=$request->customer_care_note;
    DB::table('sms_eventlog')->insert([
      ['Key_Ref'=>$key_ref,'stage_no'=>$id,'title'=>$title,'message'=>$message,'status'=>'1','user'=>$username,'sent_date'=>$date,'sent_time'=>$time]
  ]);    

  return back()->with(['message'=>'Note Successfully Saved.']);
  }
  
  public function customer_care_security_photo(Request $request){
        $id=$request->id;
        $table='';
        $security_photos=DB::table('securityphotos')->where('Key_Ref','=',$id)->get();

        $table.='<div class="row">';
        foreach($security_photos as $sec_photo){
          $file_name="";  
          $path = '/images/mag_security/'.$sec_photo->Key_Ref.'/'.$sec_photo->url;
          $path2 = 'http://192.168.0.185:8080/mag_qoutation/mag_snapshot/security_images/'.$sec_photo->Key_Ref.'/'.$sec_photo->url;
          if (file_exists($path)) {
          $file_name =asset('/images/mag_security/'.$sec_photo->Key_Ref.'/'.$sec_photo->url);
          } else {
             $file_name = $path2;
          }

        $table.=" <div class='col-sm-2'>";
        $table.='<a class="thumbnail fancybox" rel="ligthbox" href="'.$file_name.'" target="_blank">';
        $table.='<img class="img-fluid img-thumbnail" src="'.$file_name.'" target="_blank">';
        $table.="<div class='text-center'>";
        $table.="<small class='text-muted'></small>";
        $table.="</div>";
        $table.="</a>";
        $table.='<a class="btn btn-danger" href="/line-manager-delete/"'.$sec_photo->id.'"><span class="fa fa-trash" ></span></a>';
        $table.='</div>';
        }
        $table.="</div>";
        return $table;
  }

  public function customer_care_additional_photo(Request $request){
    $id=$request->id;
    $table='';
    $additional_photo=DB::table('track_photos')->where('Key_Ref','=',$id)->where('category','=','ADDITIONAL')->get();
    $table.='<div class="row">';
        foreach($additional_photo as $photo){
          $file_name="";  
          $path = '/images/mag_photo/'.$photo->Key_Ref.'/'.$photo->picture_name;
          $path2 = 'http://192.168.0.185:8080/mag_qoutation/photos/'.$photo->Key_Ref.'/'.$photo->picture_name;
          if (file_exists($path)) {
          $file_name =asset('/images/mag_photo/'.$photo->Key_Ref.'/'.$photo->picture_name);
          } else {
             $file_name = $path2;
          }
        $table.=" <div class='col-sm-2'>";
        $table.='<a class="thumbnail fancybox" rel="ligthbox" href="'.$file_name.'" target="_blank">';
        $table.='<img class="img-fluid img-thumbnail" src="'.$file_name.'" target="_blank">';
        $table.="<div class='text-center'>";
        $table.="<small class='text-muted'><b>".$photo->picture_comment."</b></small>";
        $table.="</div>";
        $table.="</a>";
        $table.='<a class="btn btn-danger" href="/line-manager-delete/"'.$photo->id.'"><span class="fa fa-trash" ></span></a>';
        $table.='</div>';
        }
        $table.="</div>";
        return $table;
  }

  public function customer_care_wip_photo(Request $request){
    $id=$request->id;
    $table='';
    $track_photo=DB::table('track_photos')->where('Key_Ref','=',$id)->where('category','=','WORK IN PROGRESS')->get();
    $table.='<div class="row">';
        foreach($track_photo as $photo){
          $file_name="";  
          $path = '/images/mag_photo/'.$photo->Key_Ref.'/'.$photo->picture_name;
          $path2 = 'http://192.168.0.185:8080/mag_qoutation/photos/'.$photo->Key_Ref.'/'.$photo->picture_name;
          if (file_exists($path)) {
          $file_name =asset('/images/mag_photo/'.$photo->Key_Ref.'/'.$photo->picture_name);
          } else {
             $file_name = $path2;
          }
        $table.=" <div class='col-sm-2'>";
        $table.='<a class="thumbnail fancybox" rel="ligthbox" href="'.$file_name.'" target="_blank">';
        $table.='<img class="img-fluid img-thumbnail" src="'.$file_name.'" target="_blank">';
        $table.="<div class='text-center'>";
        $table.="<small class='text-muted'><b>".$photo->picture_comment."</b></small>";
        $table.="</div>";
        $table.="</a>";
        $table.='<a class="btn btn-danger" href="/line-manager-delete/"'.$photo->id.'"><span class="fa fa-trash" ></span></a>';
        $table.='</div>';
        }
        $table.="</div>";
        return $table;

  }

  public function customer_care_final_stage_photo(Request $request){
    $id=$request->id;
    $table='';
    $track_photo=DB::table('track_photos')->where('Key_Ref','=',$id)->where('category','=','FINAL STAGE')->get();
    $table.='<div class="row">';
        foreach($track_photo as $photo){
          $file_name="";  
          $path = '/images/mag_photo/'.$photo->Key_Ref.'/'.$photo->picture_name;
          $path2 = 'http://192.168.0.185:8080/mag_qoutation/photos/'.$photo->Key_Ref.'/'.$photo->picture_name;
          if (file_exists($path)) {
          $file_name =asset('/images/mag_photo/'.$photo->Key_Ref.'/'.$photo->picture_name);
          } else {
             $file_name = $path2;
          }
        $table.=" <div class='col-sm-2'>";
        $table.='<a class="thumbnail fancybox" rel="ligthbox" href="'.$file_name.'" target="_blank">';
        $table.='<img class="img-fluid img-thumbnail" src="'.$file_name.'" target="_blank">';
        $table.="<div class='text-center'>";
        $table.="<small class='text-muted'><b>".$photo->picture_comment."</b></small>";
        $table.="</div>";
        $table.="</a>";
        $table.='<a class="btn btn-danger" href="/line-manager-delete/"'.$photo->id.'"><span class="fa fa-trash" ></span></a>';
        $table.='</div>';
        }
        $table.="</div>";
        return $table;
  }

  public function customer_care_documents(Request $request){
    $id=$request->id;
    $table='';
    $documents=DB::table('document')->where('Key_Ref','=',$id)->get();
    $table.='<table class="table table-stripped">';
        $table.='<thead><tr><th>Description</th><th>User</th><th></th></tr>';
        $table.='</thead><tbody>';
        foreach($documents as $doc){
            $file_name="";  
            $path = 'docs/uploaded/'.$id.'/'.$doc->url;
            $path2 = 'http://192.168.0.185:8080/MAG_System/models/UploadedDocs/'.$id.'/'.$doc->url;
            $path3 = 'http://192.168.0.185:8080/mag_documentions/supplier_invoices/'.$doc->url;
              
              if(file_exists($path2)) {
                  $file_name = $path2;
              }else if(file_exists($path3)){
                 $file_name=$path3;
              }else if(file_exists($path)) {
                $file_name =asset('/docs/uploaded/'.$id.'/'.$doc->url);
              }else{
                $file_name="#";
              }
                                 
            $table.='<tr>';
            $table.='<td>'.$doc->Description.'</td>';
            $table.='<td>'.$doc->user.'</td>';
            $table.='<td><a href="'.$file_name.'" target="_blank" class="btn btn-primary btn-sm"><span class="fa fa-search"></span></a></td>';
            $table.='</tr>';
        }
        $table.='</tbody>';
        $table.='</table>';

        return $table;

  }

  public function customer_care_save_note(Request $request){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $username=Auth::user()->username;
        $notes_name='';
        $notes_name.=$username;
        $notes_name.=' - '.$position;
        $id=$request->customer_id;
        $text=$request->customer_care_note;
        $date=date('Y-m-d');
        $time=date('H:i:s');
    DB::table('notes')->insert([
      ['Key_Ref'=>$id,'note'=>$text,'date'=>$date,'time'=>$time,'status'=>0,'user'=>$username]
  ]);
    return back()->with(['message'=>'Note Has Successfully Being Saved!']);

  }

  public function customer_care_save_document(Request $request){
        $id=$request->doc_id;
        $description=$request->customer_care_doc_type;
        $user=Auth::user()->username;
        $position=Auth::user()->position;
        $images=$request->image;
        $user.='-'.$position;
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

  public function customer_care_doc_type(){
        $docs=array();
        
        $ass_info=DB::table('docs_description')->get();
        $i=0;
        foreach($ass_info as $ass_va):
        $asses[$i]=$ass_va->description;
        $i++;       
        endforeach;
        
        return $asses;
  }

  public function search_archive(Request $request){
    $id=$request->archieve_key;
    return redirect()->route('customer-care-client-details', ['id' => $id]);
  }

  public function care_archieve(Request $request){
    $position=Auth::user()->position;
    $admin=Auth::user()->admin;
    $quote=Auth::user()->quote;
    $consumable=Auth::user()->consumerable;
    $customer=Auth::user()->customer_care;
    $line_manager=Auth::user()->line_manager;
    $creditor=Auth::user()->creditors;
    $costing=Auth::user()->costing;
    $final=Auth::user()->final_stage;
    $ref=$request->archieve_key;
    $table='';
    $result=DB::select("select * from fetch_ApprovedQuotes WHERE Key_Ref=? OR Reg_No=?",[$ref,$ref]);
    foreach($result as $row)
    {
    $id = $row->Key_Ref;
    $result1=DB::select("select distinct count(picture_name)as cnt from track_photos where Key_Ref=? AND category='WORK IN PROGRESS'",[$id]);

    foreach($result1 as $row1 )
    {
        $count = $row1->cnt;
    }

    $result_additional=DB::select("select distinct count(picture_name)as cnt from track_photos where Key_Ref=? AND category='ADDITIONAL'",[$id]);
    foreach($result_additional as $additional){
      $count_add=$additional->cnt;
    }

    $result_stage=DB::select("select distinct count(picture_name)as cnt from track_photos where Key_Ref=? AND category='FINAL STAGE'",[$id]);
    foreach($result_stage as $final_count){
      $count_final=$final_count->cnt;
    }

    $result2 = DB::select("select distinct count(url)as cnt from document where Key_Ref=?",[$id]);

    foreach($result2 as $row2)
    {
        $count1 = $row2->cnt;
    }
    $result3 = DB::select("select distinct count(url)as cnt from securityphotos where Key_Ref=?",[$id]);

    foreach($result3 as $row1)
    {
        $count2 = $row1->cnt;
    }
    $table.= "<tr>".
                "<td><a href='/customer-care-client-details/".$row->Key_Ref."' id='".$row->Key_Ref."' '><strong>".$row->Key_Ref."</strong></a></td>".
                //"<td>".$row["branch"]."</td>".
                "<td>".$row->Fisrt_Name."</td>".
                "<td>".$row->Last_Name."</td>".
                "<td>".$row->Reg_No."</td>".
                "<td>".$row->Make."</td>".
                "<td>".$row->Model."</td>".
                
                "<td>".$row->Date."</td>".
                
                
                "<td><button class='btn btn-sm btn-warning add_photo_customer_care' data-id='".$row->Key_Ref."'><span style='font-size:10px;' class='badge'> $count_add</span></button></td>".
                "<td><button class='btn btn-sm btn-danger secur_photo_customer_care' data-id='".$row->Key_Ref."'><span style='font-size:10px;' class='badge'> $count2</span></button></td>".
                "<td><button class='btn btn-sm btn-secondary wip_photo_customer_care' data-id='".$row->Key_Ref."'><span style='font-size:10px;' class='badge'>$count</span></button></td>".
                "<td><button class='btn btn-sm btn-info final_stage_photo_customer_care' data-id='".$row->Key_Ref."'><span style='font-size:10px;' class='badge'>$count_final</span></button></td>".
                
                "<td><button class='btn btn-sm btn-primary document_customer_care' data-id='".$row->Key_Ref."'><span style='font-size:10px;' class='badge'> $count1</span></button></td>".
          "</tr>";
    }

    return view('customercare.customer',['table'=>$table,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
  }


}
