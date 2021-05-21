<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\qoutes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class QuotationsController extends Controller
{
    
    public function index(){
        $auth_quotes=DB::table('client_details')->where('status','1')->count();
        $total_quotes=DB::table('client_details')->count();
        $unauth_quotes=DB::table('client_details')->where('status','0')->count();
        $towed=DB::table('towing_history')->where('Key_Ref','!=','NULL')->count();
        $client_count=DB::table('client_details');
        //Year 2018
        $jan_2018=DB::table('client_details')->whereYear('dr_date','2018')->whereMonth('dr_date','1')->count();
        $feb_2018=DB::table('client_details')->whereYear('dr_date','2018')->whereMonth('dr_date','2')->count();
        $mar_2018=DB::table('client_details')->whereYear('dr_date','2018')->whereMonth('dr_date','3')->count();
        $apr_2018=DB::table('client_details')->whereYear('dr_date','2018')->whereMonth('dr_date','4')->count();
        $may_2018=DB::table('client_details')->whereYear('dr_date','2018')->whereMonth('dr_date','5')->count();
        $jun_2018=DB::table('client_details')->whereYear('dr_date','2018')->whereMonth('dr_date','6')->count();
        $jul_2018=DB::table('client_details')->whereYear('dr_date','2018')->whereMonth('dr_date','7')->count();
        $aus_2018=DB::table('client_details')->whereYear('dr_date','2018')->whereMonth('dr_date','8')->count();
        $sep_2018=DB::table('client_details')->whereYear('dr_date','2018')->whereMonth('dr_date','9')->count();
        $oct_2018=DB::table('client_details')->whereYear('dr_date','2018')->whereMonth('dr_date','10')->count();
        $nov_2018=DB::table('client_details')->whereYear('dr_date','2018')->whereMonth('dr_date','11')->count();
        $dec_2018=DB::table('client_details')->whereYear('dr_date','2018')->whereMonth('dr_date','12')->count();
        //Year 2019
        $jan_2019=DB::table('client_details')->whereYear('dr_date','2019')->whereMonth('dr_date','1')->count();
        $feb_2019=DB::table('client_details')->whereYear('dr_date','2019')->whereMonth('dr_date','2')->count();
        $mar_2019=DB::table('client_details')->whereYear('dr_date','2019')->whereMonth('dr_date','3')->count();
        $apr_2019=DB::table('client_details')->whereYear('dr_date','2019')->whereMonth('dr_date','4')->count();
        $may_2019=DB::table('client_details')->whereYear('dr_date','2019')->whereMonth('dr_date','5')->count();
        $jun_2019=DB::table('client_details')->whereYear('dr_date','2019')->whereMonth('dr_date','6')->count();
        $jul_2019=DB::table('client_details')->whereYear('dr_date','2019')->whereMonth('dr_date','7')->count();
        $aus_2019=DB::table('client_details')->whereYear('dr_date','2019')->whereMonth('dr_date','8')->count();
        $sep_2019=DB::table('client_details')->whereYear('dr_date','2019')->whereMonth('dr_date','9')->count();
        $oct_2019=DB::table('client_details')->whereYear('dr_date','2019')->whereMonth('dr_date','10')->count();
        $nov_2019=DB::table('client_details')->whereYear('dr_date','2019')->whereMonth('dr_date','11')->count();
        $dec_2019=DB::table('client_details')->whereYear('dr_date','2019')->whereMonth('dr_date','12')->count();
        //Year 2020
        $jan=DB::table('client_details')->whereYear('dr_date','2020')->whereMonth('dr_date','1')->count();
        $feb=DB::table('client_details')->whereYear('dr_date','2020')->whereMonth('dr_date','2')->count();
        $mar=DB::table('client_details')->whereYear('dr_date','2020')->whereMonth('dr_date','3')->count();
        $apr=DB::table('client_details')->whereYear('dr_date','2020')->whereMonth('dr_date','4')->count();
        $may=DB::table('client_details')->whereYear('dr_date','2020')->whereMonth('dr_date','5')->count();
        $jun=DB::table('client_details')->whereYear('dr_date','2020')->whereMonth('dr_date','6')->count();
        $jul=DB::table('client_details')->whereYear('dr_date','2020')->whereMonth('dr_date','7')->count();
        $aus=DB::table('client_details')->whereYear('dr_date','2020')->whereMonth('dr_date','8')->count();
        $sep=DB::table('client_details')->whereYear('dr_date','2020')->whereMonth('dr_date','9')->count();
        $oct=DB::table('client_details')->whereYear('dr_date','2020')->whereMonth('dr_date','10')->count();
        $nov=DB::table('client_details')->whereYear('dr_date','2020')->whereMonth('dr_date','11')->count();
        $dec=DB::table('client_details')->whereYear('dr_date','2020')->whereMonth('dr_date','12')->count();

        $prebooking_alert=DB::table('pre_booking')->where('booking_date1','=','N/A')->orWhere('booking_date2','=','N/A')->orWhere('booking_date3','=','N/A')->orWhere('booking_date4','=','N/A')->count();
        return view('reception.receptionkpi',['auth_total'=>$auth_quotes,'total_quotes'=>$total_quotes,'unauth_total'=>$unauth_quotes,'towed_totals'=>$towed,'jan'=>$jan,'feb'=>$feb,'mar'=>$mar,'apr'=>$apr,'may'=>$may,'jun'=>$jun,'jul'=>$jul,'aus'=>$aus,'sep'=>$sep,'oct'=>$oct,'nov'=>$nov,'dec'=>$dec,'jan_2019'=>$jan_2019,'feb_2019'=>$feb_2019,'mar_2019'=>$mar_2019,'apr_2019'=>$apr_2019,'may_2019'=>$may_2019,'jun_2019'=>$jun_2019,'jul_2019'=>$jul_2019,'aus_2019'=>$aus_2019,'sep_2019'=>$sep_2019,'oct_2019'=>$sep_2019,'nov_2019'=>$nov_2019,'dec_2019'=>$dec_2019,'jan_2018'=>$jan_2018,'feb_2018'=>$feb_2018,'mar_2018'=>$mar_2018,'apr_2018'=>$apr_2018,'may_2018'=>$may_2018,'jun_2018'=>$jun_2018,'jul_2018'=>$jul_2018,'aus_2018'=>$aus_2018,'sep_2018'=>$sep_2018,'oct_2018'=>$sep_2018,'nov_2018'=>$nov_2018,'dec_2018'=>$dec_2018,'alert'=>$prebooking_alert]);
    }

    public function authorized_quotes(){

        //Get Dashoard User
        $stocks=DB::table('stock')->get();
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $branch_code=Auth::user()->comp_code;
        //Authorised Quotes
        /*$authorized=DB::table('client_details')
                            ->leftjoin('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                            ->leftjoin('pre_bookings','client_details.Key_Ref','=','pre_bookings.Key_Ref')
                            ->leftjoin('qoutes','client_details.Key_Ref','=','qoutes.Key_Ref')
                            ->where('client_details.status','=','1')
                            ->select('client_details.Date','client_details.Key_Ref','client_details.Reg_No','client_details.Fisrt_Name','client_details.Last_Name','client_details.id_number','client_details.BirthDate','client_details.Cell_number','client_details.Email','client_details.Address_1','client_details.Address_2','client_details.Address_3','pre_bookings.booking_date','client_details.Make','client_details.Model','insurer.Inserer','client_details.status')
                            ->distinct('client_details.Key_Ref')
                            ->orderBy('client_details.ID','desc')
                            ->limit(1000)
                            ->get();
        */

        if($branch_code!=='MGA1001'){
        $authorized=DB::select('SELECT DISTINCT * FROM (SELECT cd.Date,cd.Key_Ref,cd.Reg_No,cd.Fisrt_Name,cd.Last_Name,cd.id_number, cd.BirthDate,cd.Cell_number,

        cd.Email,cd.Address_1, 
        cd.Address_2,cd.Address_3,
        cd.Make,cd.Model,ins.Inserer,cd.`status`,qt.Key_Ref AS Ref
        FROM client_details cd LEFT JOIN insurer ins
        ON cd.Key_Ref = ins.Key_Ref 
        
        LEFT JOIN qoutes qt ON cd.Key_Ref = qt.Key_Ref WHERE cd.status="1"
        ORDER BY cd.id DESC LIMIT 10000)AS tbl');
        }else{
            $authorized=DB::table('client_details')
            ->leftjoin('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
            ->leftjoin('qoutes','client_details.Key_Ref','=','qoutes.Key_Ref')
            ->select('client_details.Date','client_details.Key_Ref','client_details.Reg_No','client_details.Fisrt_Name','client_details.Last_Name','client_details.id_number','client_details.BirthDate','client_details.Cell_number','client_details.Email','client_details.Address_1','client_details.Address_2','client_details.Address_3','client_details.Make','client_details.Model','insurer.Inserer','client_details.status','qoutes.Key_Ref as Ref')
            ->where('client_details.Key_Ref','LIKE','MGA'.'%')
            ->where('client_details.status','=','1')
            ->orderBy('client_details.id','desc')
            ->get();
        }
        $prebooking_alert=DB::table('pre_booking')->where('booking_date1','=','N/A')->orWhere('booking_date2','=','N/A')->orWhere('booking_date3','=','N/A')->orWhere('booking_date4','=','N/A')->count();                        
        return view('reception.authorized',['details'=>$authorized,'alert'=>$prebooking_alert,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);    
                        
    }

    public function unquoted(){
        
        //Get Dashboard User
        $stocks=DB::table('stock')->get();
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        //Unquoted Query
        $unquoted=DB::table('client_details')
                      
                      ->leftjoin('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                      ->leftjoin('pre_bookings','client_details.Key_Ref','=','pre_bookings.Key_Ref')
                      ->leftjoin('qoutes','client_details.Key_Ref','=','qoutes.Key_Ref')
                      ->leftjoin('towing_history','client_details.Key_Ref','=','towing_history.Key_Ref')->whereNotNull('towing_history.Key_Ref')->where('client_details.status','=','0')
                      ->select('client_details.Date','client_details.Key_Ref','client_details.Reg_No','client_details.Fisrt_Name','client_details.Last_Name','client_details.id_number','client_details.BirthDate','client_details.Cell_number','client_details.Email','client_details.Address_1','client_details.Address_2','client_details.Address_3','pre_bookings.booking_date','client_details.Make','client_details.Model','insurer.Inserer','client_details.status','qoutes.Key_Ref as Ref')
                      ->distinct()
                      //->groupBy('client_details.Date')
                      ->orderBy('client_details.ID','desc')
                      ->limit(500)
                      ->get();
                      $prebooking_alert=DB::table('pre_booking')->where('booking_date1','=','N/A')->orWhere('booking_date2','=','N/A')->orWhere('booking_date3','=','N/A')->orWhere('booking_date4','=','N/A')->count();    
        return view('reception.unquoted',['details'=>$unquoted,'alert'=>$prebooking_alert,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
    }   
    
    public function all_quotes(){
        //Get Dashboard User
        #$stocks=DB::table('stock')->get();
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $branch_code=Auth::user()->comp_code;
        /*
            $allqoutes=DB::table('client_details')
                            ->leftjoin('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                            ->leftjoin('qoutes','client_details.Key_Ref','=','qoutes.Key_Ref')
                            ->select('client_details.Date','client_details.Key_Ref','client_details.Reg_No','client_details.Fisrt_Name','client_details.Last_Name','client_details.id_number','client_details.BirthDate','client_details.Cell_number','client_details.Email','client_details.Address_1','client_details.Address_2','client_details.Address_3','client_details.Make','client_details.Model','insurer.Inserer','client_details.status','qoutes.Key_Ref as Ref')
                            ->distinct()
                            ->orderBy('client_details.id','desc')
                            ->limit(1000)
                            ->get();
                            */
        if($branch_code!=='MGA1001'){
            
        $allqoutes=DB::select('SELECT DISTINCT * FROM (SELECT cd.Date,cd.Key_Ref,cd.Reg_No,cd.Fisrt_Name,cd.Last_Name,cd.id_number, cd.BirthDate,cd.Cell_number,

        cd.Email,cd.Address_1, 
        cd.Address_2,cd.Address_3,
        cd.Make,cd.Model,ins.Inserer,ins.Claim_NO,cd.`status`,qt.Key_Ref AS Ref
        FROM client_details cd LEFT JOIN insurer ins
        ON cd.Key_Ref = ins.Key_Ref 
        
        LEFT JOIN qoutes qt ON cd.Key_Ref = qt.Key_Ref 
        ORDER BY cd.id DESC LIMIT 2000)AS tbl');

        }else{        
            $allqoutes=DB::table('client_details')
            ->leftjoin('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
            ->leftjoin('qoutes','client_details.Key_Ref','=','qoutes.Key_Ref')
            ->select('client_details.Date','client_details.Key_Ref','client_details.Reg_No','client_details.Fisrt_Name','client_details.Last_Name','client_details.id_number','client_details.BirthDate','client_details.Cell_number','client_details.Email','client_details.Address_1','client_details.Address_2','client_details.Address_3','client_details.Make','client_details.Model','insurer.Inserer','client_details.status','qoutes.Key_Ref as Ref')
            ->where('client_details.Key_Ref','LIKE','MGA'.'%')
            ->distinct('client_details.Key_Ref')
            ->orderBy('client_details.id','desc')
            ->get();
        
        }                            
        $prebooking_alert=DB::table('pre_booking')->where('booking_date1','=','N/A')->orWhere('booking_date2','=','N/A')->orWhere('booking_date3','=','N/A')->orWhere('booking_date4','=','N/A')->count();
        return view('reception.allquotes',['details'=>$allqoutes,'alert'=>$prebooking_alert,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);                    
    }

    public function quoted(){

        //Get Dashboard User
        $stocks=DB::table('stock')->get();
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $branch_code=Auth::user()->comp_code;

        if($branch_code!='MGA1001'){

        //All Quoted Query
            $quoted=DB::table('client_details')
                        ->leftjoin('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                        ->leftjoin('pre_bookings','client_details.Key_Ref','=','pre_bookings.Key_Ref')
                        ->leftjoin('qoutes','client_details.Key_Ref','=','qoutes.Key_Ref')->where('client_details.status','=','0')
                        ->distinct('client_details.Key_Ref')
                        ->orderBy('client_details.ID','desc')
                        ->limit(500)
                        ->get();
        }else{
            $quoted=DB::table('client_details')
                        ->leftjoin('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                        ->leftjoin('pre_bookings','client_details.Key_Ref','=','pre_bookings.Key_Ref')
                        ->leftjoin('qoutes','client_details.Key_Ref','=','qoutes.Key_Ref')->where('client_details.status','=','0')
                        ->where('client_details.Key_Ref','LIKE','MGA%')
                        ->distinct('client_details.Key_Ref')
                        ->orderBy('client_details.ID','desc')
                        ->limit(500)
                        ->get();
        }                
                        $prebooking_alert=DB::table('pre_booking')->where('booking_date1','=','N/A')->orWhere('booking_date2','=','N/A')->orWhere('booking_date3','=','N/A')->orWhere('booking_date4','=','N/A')->count();    
        return view('reception.quoted',['details'=>$quoted,'alert'=>$prebooking_alert,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);                
    }

    public function open_quotation($key_ref){
        //Get Dashboard
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $authorize=Auth::user()->authorize;
        $assessor=DB::table('assessors')->orderBy('Names','ASC')->get();
        $insu_broker=DB::table('broker_table')->orderBy('broker','ASC')->get();
        $towing_info=DB::table('towin_table')->get();
        $branch=DB::table('branch')->get();
        $client_details=DB::table('client_details')
                                ->where('client_details.Key_Ref','=',$key_ref)
                                ->leftjoin('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                                ->leftjoin('pre_bookings','client_details.Key_Ref','=','pre_bookings.Key_Ref')
                                ->leftjoin('towing_history','client_details.Key_Ref','=','towing_history.Key_Ref')
                                ->select('client_details.KM','client_details.Chasses_No','client_details.Date','client_details.Key_Ref','client_details.Reg_No','client_details.Fisrt_Name','client_details.Last_Name','client_details.id_number','client_details.BirthDate','client_details.Cell_number','client_details.Email','client_details.Address_1','client_details.Address_2','client_details.Address_3','pre_bookings.booking_date','client_details.Make','client_details.Model','insurer.Inserer','client_details.status','towing_history.*','client_details.Eng_No','client_details.Colour','client_details.Vehicle_year','client_details.Address_1','client_details.Address_2','client_details.Address_3','client_details.Estimator','client_details.branch','client_details.Eng_No','insurer.Contact as ins_contact','insurer.Email as ins_email','insurer.Claim_NO as ins_claim','insurer.ClerkName','insurer.Assessor_Email','insurer.Assessor_Cell','insurer.Assessor_comp','towing_history.tel as tow_tel','towing_history.email as tow_email')
                                ->get();	
        $ins_count=DB::table('insurer')->where('Key_Ref',$key_ref)->get();
        if(count($ins_count)>0){
            foreach($ins_count as $count){
                $in=$count;
            }
        }                        
                                $prebooking_alert=DB::table('pre_booking')->where('booking_date1','=','N/A')->orWhere('booking_date2','=','N/A')->orWhere('booking_date3','=','N/A')->orWhere('booking_date4','=','N/A')->count();                        
        return view('quotations.details',['branches'=>$branch,'key'=>$key_ref,'clients_details'=>$client_details,'alert'=>$prebooking_alert,'assessor'=>$assessor,'brokers'=>$insu_broker,'towing_info'=>$towing_info,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final,'authorize'=>$authorize]);
    }

    public function create_client(){

        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $assessor=DB::table('assessors')->orderBy('Names','ASC')->get();
        $branches=DB::table('branch')->get();
        $insu_broker=DB::table('broker_table')->orderBy('broker','ASC')->get();
        $towing_info=DB::table('towin_table')->get();
        return view('quotations.createclient',['branches'=>$branches,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'assessor'=>$assessor,'brokers'=>$insu_broker,'towing_info'=>$towing_info,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
    }

    # [ CURRENT UPDATES TODAY ]
    public function client_quote($key_ref){
        $client_details=DB::table('client_details')
                            ->where('Key_Ref','=',$key_ref)
                            ->select('Fisrt_Name','Key_Ref','Reg_No','Last_Name','Email','Date','Make','Model')
                            ->get();
        $oper=DB::table('oper')->get();

        //$quote_client=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        $quote_client=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->orderBy('count', 'Asc')->orderBy('id', 'Asc')->get();


        $prebooking_alert=DB::table('pre_booking')->where('booking_date1','=','N/A')->orWhere('booking_date2','=','N/A')->orWhere('booking_date3','=','N/A')->orWhere('booking_date4','=','N/A')->count();                    
        
        $check_waste=DB::table('betterment')
                        ->where('Key_Ref','=',$key_ref)
                        ->where('waste','=','80')
                        ->get();

        $client_photos=DB::table('track_photos')->where('Key_Ref','=',$key_ref)->get();                
        
        $check_covid=DB::table('qoutes')
                            ->where('Key_Ref','=',$key_ref)  
                            ->where('Description','=','Covid-19/Sanitizer')
                            ->get();                
        
        $check_polish=DB::table('qoutes')
                          ->where('Key_Ref','=',$key_ref)  
                          ->where('Description','=','Polish')
                          ->where('Oper','=','Inhouse')  
                          ->get();

        $check_agreed=DB::table('client_details')
                            ->where('Key_Ref','=',$key_ref)
                            ->where('agreed_only','=','1')
                            ->get();

        $check_auth=DB::table('client_details')
                            ->where('Key_Ref','=',$key_ref)
                            ->where('status','=','1')
                            
                            ->get();
        $authorize=Auth::user()->authorize;
        return view('quotations.vehicle',['client_photos'=>$client_photos,'check_covid'=>$check_covid,'key'=>$key_ref,'client_details'=>$client_details,'oper'=>$oper,'alert'=>$prebooking_alert,'quote'=>$quote_client,'check_waste'=>$check_waste,'check_auth'=>$check_auth,'check_polish'=>$check_polish,'check_agreed'=>$check_agreed,'authorize'=>$authorize]);                    
    }


    
    public function searchPart(Request $request){
        
        $part=array();
        $part_name=$request->description;
        $part_info=DB::table('parts')->select('*')->where('part',$part_name)->limit('1')->get();
        foreach($part_info as $part_va):
        $part[0]=$part_va->new;
        $part[1]=$part_va->labour;
        $part[2]=$part_va->repair_restore;
        $part[3]=$part_va->spray;
        $part[4]=$part_va->inhouse;
        $part[5]=$part_va->outwork;
        endforeach;
        
        return $part;
    }

    public function assessor_info_auto(Request $request){
        
        $asses=array();
        $name=$request->name;
        $ass_info=DB::table('assessors')->where('Names','=',$name)->limit(1)->get();
        foreach($ass_info as $ass_va):
        $asses[0]=$ass_va->Email;
        $asses[1]=$ass_va->Cell;
        $asses[2]=$ass_va->Company;
        
        endforeach;
        
        return $asses;
    }

    public function broker_info_auto(Request $request){
        
        $broke=array();
        $broker=$request->name;
        $broker_info=DB::table('broker_table')->where('broker','=',$broker)->limit(1)->get();
        foreach($broker_info as $broker_va):
        $broke[0]=$broker_va->email;
        $broke[1]=$broker_va->contact;
        
        
        endforeach;
        
        return $broke;
    }

    public function tow_info_auto(Request $request){
        
        $tow=array();
        $tower=$request->name;
        $tow_info=DB::table('towin_table')->where('towing','=',$tower)->limit(1)->get();
        foreach($tow_info as $tow_va):
        $tow[0]=$tow_va->address;
        $tow[1]=$tow_va->contact;
        
        
        endforeach;
        
        return $tow;
    }

    public function save_quote_money(Request $request){
        $key_ref=$request->ref;
        $opa=$request->opa;
        $desc=$request->desc;
        if(empty($desc)){
            $desc='';
        }
        $qty=$request->qty;
        if(empty($qty)){
            $qty=0;
        }
        $part= $request->part;
        if(empty($part)){
            $part=0;
        }
        $labor=$request->labor;
        if(empty($labor)){
            $labor=0;
        }
        $paint=$request->paint;
        if(empty($paint)){
            $paint=0;
        }
        $strip=$request->strip;
        if(empty($strip)){
            $strip=0;
        }
        $frame=$request->frame;
        if(empty($frame)){
            $frame=0;
        }
        $bett=$request->bett;
        if(empty($bett)){
            $bett=0;
        }
        $mark=$request->mark;
        if(empty($mark)){
            $mark=0;
        }
        
        $outwork=$request->outwork;
        if(empty($outwork)){
            $outwork=0;
        }

        $rates=DB::table('insurer')
                        ->where('Key_Ref','=',$key_ref)
                        ->get();
        foreach($rates as $rate){
            $labor_rate=$rate->labour;
            $paint_rate=$rate->Paint;
            $strip_rate=$rate->Strip;
            $frame_rate=$rate->Frame;

        }                

        $part=$part+($mark * $part/100);

        $m_labor=$labor/$labor_rate;
        $m_paint=$paint/$paint_rate;
        $m_strip=$strip/$strip_rate;
        $m_frame=$frame/$frame_rate;

        $date=date('Y-m-d');
        DB::table('qoutes')->insert([
            ['Key_Ref'=>$key_ref,'Oper'=>$opa,'Description'=>$desc,'Quantity'=>$qty,'Betterment'=>$bett,'Part'=>$part,'Labour'=>$m_labor,'Paint'=>$m_paint,'Strip'=>$m_strip,'Frame'=>$m_frame,'Misc'=>$outwork,'MarkUp'=>$mark,'MoneyTime'=>'','MarkUp2'=>0.00,'Date'=>$date,'yes'=>'','no'=>'','notdone'=>'','Column 27'=>'','repair'=>'','new'=>'','Close_RO'=>'','Inv_Date'=>'','qoute_type'=>0,'sundries'=>0]
        ]);  

        return back()->with(['message'=>'Part Successfully Added To Quote.']);
    }

    public function save_quote(Request $request){
        $key_ref=$request->ref;
        $opa=$request->opa;
        $desc=$request->desc;
        if(empty($desc)){
            $desc='';
        }
        $qty=$request->qty;
        if(empty($qty)){
            $qty=0;
        }
        $part= $request->part;
        if(empty($part)){
            $part=0;
        }
        $labor=$request->labor;
        if(empty($labor)){
            $labor=0;
        }
        $paint=$request->paint;
        if(empty($paint)){
            $paint=0;
        }
        $strip=$request->strip;
        if(empty($strip)){
            $strip=0;
        }
        $frame=$request->frame;
        if(empty($frame)){
            $frame=0;
        }
        $bett=$request->bett;
        if(empty($bett)){
            $bett=0;
        }
        $mark=$request->mark;
        if(empty($mark)){
            $mark=0;
        }
        
        $outwork=$request->outwork;
        if(empty($outwork)){
            $outwork=0;
        }
        $part=$part+($mark*$part/100);
        $date=date('Y-m-d');
        DB::table('qoutes')->insert([
            ['Key_Ref'=>$key_ref,'Oper'=>$opa,'Description'=>$desc,'Quantity'=>$qty,'Betterment'=>$bett,'Part'=>$part,'Labour'=>$labor,'Paint'=>$paint,'Strip'=>$strip,'Frame'=>$frame,'Misc'=>$outwork,'Percent'=>$mark,'MoneyTime'=>'','MarkUp2'=>0.00,'Date'=>$date,'yes'=>'','no'=>'','notdone'=>'','Column 27'=>'','repair'=>'','new'=>'','Close_RO'=>'','Inv_Date'=>'','qoute_type'=>0,'sundries'=>0]
        ]);  

        return back()->with(['message'=>'Part Successfully Added To Quote.']);         
       
    }

    //Update Neo 2021-03-02   
    public function save_quote_money_edit(Request $request){
        $key_ref=$request->key_ref;
        $id=$request->id;
        $opa=$request->oper;
        $desc=$request->desc;
        $qty=$request->qty;
        $part= $request->part;
        $labor=$request->labor;
        $paint=$request->paint;
        $strip=$request->strip;
        $frame=$request->frame;
        $bett=$request->bett;
        $mark=$request->mark;
        $outwork=$request->out;

        //var_dump( $id ); die;

        //var_dump( $key_ref . " : " . $id   . " : " .   $opa  . " : " . $desc . " : " . $qty  . " : " .  $part  . " : " .  $labor  
       // . " : " . $paint . " : " . $strip  . " : " . $frame  . " : " .  $bett  . " : " . $mark . " : " . $outwork); die;
        
        
        $rates=DB::table('insurer')
                        ->where('Key_Ref','=',$key_ref)
                        ->get();

       // var_dump( $rates ); die;

        $labor_rate=300;
        $paint_rate=300;
        $strip_rate=300;
        $frame_rate=300;
        foreach($rates as $rate){


            $labor_rate=$rate->labour;
            $paint_rate=$rate->Paint;
            $strip_rate=$rate->Strip;
            $frame_rate=$rate->Frame;

        }                


        //var_dump(  ); die;

        $m_labor=$labor/$labor_rate;
        $m_paint=$paint/$paint_rate;
        $m_strip=$strip/$strip_rate;
        $m_frame=$frame/$frame_rate;

        $date=date('Y-m-d');

      
    //$update = DB::table('qoutes')->where('id','=',$id)->update(['Oper'=>$oper,'Description'=>$desc,'Quantity'=>$qty,'Part'=>$part,'Labour'=>$labor,'Paint'=>$paint,'Strip'=>$strip,'Frame'=>$frame,'Misc'=>$outwork,'Betterment'=>$bett,'Percent'=>$markup]);





    //$update = DB::table('qoutes')->where('id','=',$id)->update(['Oper'=>$opa,'Description'=>$desc,'Quantity'=>$qty,'Betterment'=>$bett,'Part'=>$part,'Labour'=>$m_labor,'Paint'=>$m_paint,'Strip'=>$m_strip,'Frame'=>$m_frame,'Misc'=>$outwork,'Percent'=>$mark,'MoneyTime'=>'','MarkUp2'=>0.00,'Date'=>$date,'yes'=>'','no'=>'','notdone'=>'','Column 27'=>'','repair'=>'','new'=>'','Close_RO'=>'','Inv_Date'=>'','qoute_type'=>0,'sundries'=>0]);
      
      $update = DB::table('qoutes')->where('id','=',$id)->update(['Oper'=>$opa,'Description'=>$desc,'Quantity'=>$qty,'Part'=>$part,'Labour'=>$m_labor,'Paint'=>$m_paint,'Strip'=>$m_strip,'Frame'=>$m_frame,'Misc'=>$outwork,'Betterment'=>$bett,'Percent'=>$mark ]);

                //return back()->with(['message'=>'Edit Part Successfully.']); 
        
        var_dump( $update ); die;

        if( $update ){
            return 1;
        }else{
            return 0;
        }
                
    }

    # [ CURRENT UPDATED ]
    public function edit_quote(Request $request){
        
        $id=$request->id;
        $oper=$request->oper;
        $desc=$request->desc;
        $qty=$request->qty;
        $part=$request->part;
        $labor=$request->labor;
        $paint=$request->paint;
        $strip=$request->strip;
        $frame=$request->frame;
        $bett=$request->bett;
        $markup=$request->mark;
        $outwork=$request->out;
       
        $update = DB::table('qoutes')->where('id','=',$id)->update(['Oper'=>$oper,'Description'=>$desc,'Quantity'=>$qty,'Part'=>$part,'Labour'=>$labor,'Paint'=>$paint,'Strip'=>$strip,'Frame'=>$frame,'Misc'=>$outwork,'Betterment'=>$bett,'Percent'=>$markup]);
        if($update){
            echo 1;
        }else{
            echo 0;
        }
        

    }


    #[ EDIT QOUTE IN MONEY ]
    public function edit_quote_money(Request $request){

            $id=$request->id;
            $key_ref=$request->ref;
            $oper=$request->oper;
            $desc=$request->desc;
            $qty=$request->qty;
            $part= $request->part;
            $labor=$request->labor;
            $paint=$request->paint;
            $strip=$request->strip;
            $frame=$request->frame;
            $bett=$request->bett;
            $markup=$request->mark;
            $outwork=$request->out;
    
            $rates=DB::table('insurer')
                            ->where('Key_Ref','=',$key_ref)
                            ->get();
        
            foreach($rates as $rate){
                $labor_rate=$rate->labour;
                $paint_rate=$rate->Paint;
                $strip_rate=$rate->Strip;
                $frame_rate=$rate->Frame;
    
            }  
    
            $m_labor=$labor/$labor_rate;
            $m_paint=$paint/$paint_rate;
            $m_strip=$strip/$strip_rate;
            $m_frame=$frame/$frame_rate;
    
            $date=date('Y-m-d');
            $update = DB::table('qoutes')->where('id','=',$id)->update(['Oper'=>$oper,'Description'=>$desc,'Percent'=>$markup,'Quantity'=>$qty,'Part'=>$part,'Labour'=>$m_labor,'Paint'=>$m_paint,'Strip'=>$m_strip,'Frame'=>$m_frame,'Misc'=>$outwork,'Betterment'=>$bett]);
    
            if($update){
                echo 1;
            }else{
                echo 0;
            }
     
    
    }



    public function delete_quote($id){
        
        DB::table('qoutes')->where('id','=',$id)->delete();
        return back()->with(['message'=>'Part Removed Successfully.']);
    }

    public function assessor(){
        //Get Dashboard User
        $stocks=DB::table('stock')->get();
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        //Assessor Query
        $assessor_details=DB::table('assessors')
                                ->orderBy('Names','desc')
                                ->distinct()
                                ->get();
                                $prebooking_alert=DB::table('pre_booking')->where('booking_date1','=','N/A')->orWhere('booking_date2','=','N/A')->orWhere('booking_date3','=','N/A')->orWhere('booking_date4','=','N/A')->count();                        
        return view('reception.assessors',['assessors'=>$assessor_details,'alert'=>$prebooking_alert,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
    }

    public function edit_assessor(Request $request){
        $id=$request->id;
        $name=$request->name;
        $cell=$request->cell;
        $email=$request->email;
        $tel=$request->tel;
        $company=$request->company;

        DB::table('assessors')
        ->where('id','=',$id)
        ->update(['Names'=>$name,'Cell'=>$cell,'Email'=>$email,'Tel'=>$tel,'Company'=>$company]);
        return back()->with(['message'=>'Assessor Edited Successfully.']);
    }

    public function delete_assessor($id){
        DB::table('assessors')->where('id','=',$id)->delete();
        
        return back()->with(['message'=>'Assessor Removed Successfully.']);
    }

    public function save_assessor(Request $request){
        
        $name=$request->assessor_create_fullname;
        $cell=$request->assessor_create_cell;
        $email=$request->assessor_create_email;
        $tel=$request->assessor_create_tell;
        $company=$request->assessor_create_company;
        DB::table('assessors')->insert([
            ['Names'=>$name,'Cell'=>$cell,'Email'=>$email,'Tel'=>$tel,'Company'=>$company]
        ]);
        
        return back()->with(['message'=>'Assessor Created Successfully.']);
    }

     public function autocomplete(Request $request){
        $query=$request->get('term','');
        $parts=DB::table('parts')->where('part','LIKE','%'.$query.'%')->get();
        $data=array();
        
        foreach($parts as $part){
            $data[]=array('value'=>$part->part,'id'=>$part->id);

        }
        if(count($data)):
            return $data;
    else:
            return ['value'=>'No Results Found','id'=>''];
    endif;        
    }

    public function prebooking($count){
        $prebooking_details=DB::table('pre_booking')
                                    ->Where('booking_date2','=','N/A')->orWhere('booking_date3','=','N/A')->orWhere('booking_date4','=','N/A')
                                    ->leftjoin('client_details','pre_booking.Key_Ref','=','client_details.Key_Ref')
                                    ->select('client_details.Fisrt_Name','client_details.Last_Name','client_details.Cell_number','client_details.Email','client_details.Key_Ref','client_details.Contact','pre_booking.comment','pre_booking.id')
                                    ->get();
        
        return view('reception.prebooking',['prebooking_details'=>$prebooking_details,'alert'=>$count]);
    }
           
    public function prebooking_notes(Request $request){
        $id=$request->id_prebooking;
        $comment=$request->notes;
        DB::table('pre_booking')
              ->where('id',$id)
              ->update(['comment'=>$comment]);
              
        return back()->with(['message'=>'Pre-booking Notes Edited Successfully.']);
    }   

    public function proforma(){
        //Get Dashboard User
        $stocks=DB::table('stock')->get();
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $prebooking_alert=DB::table('pre_booking')->where('booking_date1','=','N/A')->orWhere('booking_date2','=','N/A')->orWhere('booking_date3','=','N/A')->orWhere('booking_date4','=','N/A')->count();                        
        return view('reception.proforma',['alert'=>$prebooking_alert,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
    }

    public function create_client_quotes(Request $request){
        $name=$request->name;
        $last=$request->lastname;
        $id_no=$request->id_number;
        if(empty($id_no)){
            $id_no='';
        }
        $dob=$request->dob;
        $cell=$request->mobile;
        $email=$request->client_email;
        if(empty($email)){
            $email='';
        }
        $street=$request->street;
        if(empty($street)){
            $street='';
        }
        $suburb=$request->surburb;
        if(empty($suburb)){
            $suburb='';
        }
        $city=$request->city;
        if(empty($city)){
            $city='';
        }
        $estimator=$request->estimator;
        $branch=$request->branch;

        $reg=$request->registration;
        $vin=$request->vin_number;
        $engine_no=$request->engine_number;
        if(empty($engine_no)){
            $engine_no='';
        }
        $make=$request->make;
        $model=$request->model;
        $odometer=$request->odometer;
        if(empty($odometer)){
            $odometer='';
        }
        $color=$request->colour;
        if(empty($color)){
            $color='';
        }
        $year=$request->year;
        if(empty($year)){
            $year='';
        }
        $booking=$request->booking;
        if(empty($booking)){
            $booking='';
        }
        $quote_date=$request->quote_date;

        $insurace_type=$request->insurance_type;
        $insuror=$request->insuror;
        if(empty($insuror)){
            $insuror='';
        }
        $ins_cell=$request->contact_number;
        if(empty($ins_cell)){
            $ins_cell='';
        }
        $ins_email=$request->insurance_email;
        if(empty($ins_email)){
            $ins_email='';
        }
        $claim_no=$request->claim_number;
        if(empty($claim_no)){
            $claim_no='';
        }
        $clerk_ref=$request->clerk_ref;
        if(empty($clerk_ref)){
            $clerk_ref='';
        }
        $assessor=$request->assessor;
        if(empty($assessor)){
            $assessor='';
        }
        $ass_email=$request->assessor_email;
        if(empty($ass_email)){
            $ass_email='';
        }
        $ass_no=$request->assessor_no;
        if(empty($ass_no)){
            $ass_no='';
        }
        $ass_comp=$request->assessor_company;
        if(empty($ass_comp)){
            $ass_comp='';
        }

        $towed=$request->towed;
        if(empty($towed)){
            $towed='';
        }
        
        $towed_by=$request->towed_by;
        if(empty($towed_by)){
            $towed_by='';
        }
        $towed_cell=$request->tow_contact_number;
        if(empty($towed_cell)){
            $towed_cell='';
        }
        $towed_email=$request->tow_email;
        if(empty($towed_email)){
            $towed_email='';
        }
        $towed_fee=$request->tow_fee;
        if(empty($towed_fee)){
            $towed_fee='0';
        }
        $towed_status=$request->towed_status;
        if(empty($towed_status)){
            $towed_status='';
        }
        $date=date('Y-m-d');
        $key='';
        if($branch==1){
           $key=DB::table('client_details')->select('Key_Ref')->where('Key_Ref','LIKE','MS%')->limit(1)->latest('dr_date')->first(); 
        }elseif($branch==2){
            $key=DB::table('client_details')->select('Key_Ref')->where('Key_Ref','LIKE','ML%')->limit(1)->latest('dr_date')->first(); 
        }elseif($branch==3){
            $key=DB::table('client_details')->select('Key_Ref')->where('Key_Ref','LIKE','MGC%')->limit(1)->latest('dr_date')->first();
        }elseif($branch==4){
            $key=DB::table('client_details')->select('Key_Ref')->where('Key_Ref','LIKE','MGL%')->limit(1)->latest('dr_date')->first();
        }elseif($branch==5){
            $key=DB::table('client_details')->select('Key_Ref')->where('Key_Ref','LIKE','MGA%')->limit(1)->latest('dr_date')->first();
        }


        $result=$key->Key_Ref;
        if($branch==4 ||$branch==3 ||$branch==5){
        $sub=substr($key->Key_Ref,3);    
        }else{
        $sub=substr($key->Key_Ref,2);
        }
        //return $sub;
        $number_id=$sub +1;

        $id_status='';
        $id='';
        if($branch==1){
            $id='MS'.$number_id;
            $id_status=1;
         }elseif($branch==2){
             $id='ML'.$number_id;
             $id_status=2;
         }elseif($branch==3){
             $id='MGC'.$number_id;
             $id_status=3;
         }elseif($branch==4){
            $id='MGL'.$number_id;
            $id_status=4;
         }elseif($branch==5){
            $id='MGA'.$number_id;
            $id_status=5;
         }
         //return $id_status;
         $branch_info=DB::table('branch')->where('id','=',$id_status)->where('status','=','1')->limit(1)->get();

         //return $branch_info->branch_credits;
         foreach($branch_info as $info){
            $bra_id=$info->id; 
            $bra_credit=$info->branch_credits;
            $branch_name=substr($info->branch_name,4);
         }

         //Temp
        

         if($bra_credit >0){
            $left=$bra_credit - 1;     
            DB::table('client_details')->insert([
                ['Fisrt_Name'=>$name,'Last_Name'=>$last,'id_number'=>$id_no,'BirthDate'=>$dob,'Estimator'=>$estimator,'Email'=>$email,'Address_1'=>$street,'Address_2'=>$suburb,'Address_3'=>$city,'Cell_Number'=>$cell,'Vehicle_year'=>$year,'Make'=>$make,'Colour'=>$color,'Model'=>$model,'Key_Ref'=>$id,'Reg_No'=>$reg,'Eng_No'=>$engine_no,'date'=>$date,'duration'=>'0','branch'=>$branch_name,'towed_by'=>$towed_by,'Vat_No'=>'15','Refered_by'=>'','Contact'=>'','Fax'=>'','Style'=>'','Come_Back_Status'=>'','Internal_work'=>'','Chasses_No'=>'','KM'=>'','Repair_Type'=>'','RO'=>'','RODATE'=>'','job_card_no'=>'','Payable'=>'0.00','signature'=>'','Inv_Date'=>'','User'=>'','tel_home'=>'','tel_work'=>'','Company'=>'','title'=>'','Notes'=>'','booked_yes'=>'','booked_no'=>'','done_no'=>'','insuranceKey'=>'','checklist_by'=>'','recieving'=>'','Convert_'=>'']
            ]);
            DB::table('insurer')->insert([
                ['Inserer'=>$insuror,'Phone'=>$ins_cell,'Email'=>$ins_email,'Claim_No'=>$claim_no,'Oder_No'=>$odometer,'Key_Ref'=>$id,'Assessor'=>$assessor,'Assessor_Cell'=>$ass_no,'Assessor_Email'=>$ass_email,'Assessor_comp'=>$ass_comp,'id'=>'0','Specify'=>'','rateTable'=>'','Address_1'=>$street,'Address_2'=>$suburb,'Address_3'=>$city,'Vat_No'=>15,'Fax'=>0,'Contact'=>0,'Cell'=>$cell,'Policy'=>0,'Broker'=>'','broker_no'=>0,'broker_email'=>'','ClerkName'=>$clerk_ref,'ClerkTel'=>0,'Assessor_Tel'=>0,'Assessor_Ref'=>0,'Date_Assesed'=>0,'Authorised_Date'=>0,'vendor_no'=>0,'Convert'=>0,'PO'=>0]
            ]);
            DB::table('towing_history')->insert([
                ['Key_Ref'=>$id,'first_name'=>$name,'last_name'=>$last,'reg_no'=>$reg,'make'=>$make,'model'=>$model,'vin'=>$vin,'km'=>'','insurer'=>$insuror,'claim_no'=>$claim_no,'towing_fee1'=>$towed_fee,'name'=>$towed_by,'email'=>$towed_email,'tel'=>$towed_cell,'date'=>$date,'assessor'=>$assessor,'assessor_cell'=>$ass_no,'assessor_email'=>$ass_email,'address'=>'','city'=>'','zip'=>'','att_to'=>'','vat_no'=>'0']
            ]);
            DB::table('branch')->where('id','=',$bra_id)->update(['branch_credits'=>$left]);
         }else{
            return back()->with(['warning'=>"You Don't Have Enough Credits, Contact Your Serevice Provider"]);
         }
         
        return redirect()->route('client_quote',['id'=>$id,'message'=>'New Quote Sucessfully Created!']);
    }

    public function select_vehicle(Request $request){
        $id=$request->quote_id;
        $type=$request->car_type;
        if($type=='DoubleCab'){
            return redirect()->route('exterior',['id'=>$id]);
        }elseif($type=='Hatchback'){
            return redirect()->route('hatch_exterior',['id'=>$id]);
        }elseif($type=='3Door'){
            return redirect()->route('2door_exterior',['id'=>$id]);
        }else{
        return back()->with(['message'=>"Selection Doesn't Exist"]);
        }
    }

    public function authorize_quote(Request $request){
        $id=$request->id_auth;
        $date=$request->auth_date;

        DB::table('client_details')
                ->where('Key_Ref','=',$id)
                ->update(['RODATE'=>$date,'status'=>'1']);

        return back()->with(['message'=>"Vehicle Has Been Authorised"]);        
    }

    public function agreed_quote(Request $request){
                $key_ref=$request->id;
                DB::table('client_details')
                    ->where('Key_Ref','=',$key_ref)
                    ->update(['agreed_only'=>'1']);
        return back()->with(['message'=>"Client Agreed Only"]);
    }

    public function waste_quote(Request $request){
            $user=Auth::user()->username;
            $key_ref=$request->id;
            $date=date('Y-m-d');
            $check=DB::table('betterment')
                    ->where('Key_Ref','=',$key_ref)
                    ->get();
            if($check->isEmpty()){
                DB::table('betterment')->insert([
                  ['Betterment1'=>0,'Betterment'=>0,'Key_Ref'=>$key_ref,'Excess_1'=>0,'Excess_2'=>0,'waste'=>80,'polish'=>0,'tow'=>0,'sundries1'=>0,'sundries2'=>0,'paintshop1'=>0,'paintshop2'=>0,'labour'=>0,'paint'=>0,'Private_work'=>0,'Additional_1'=>0,'Additional_2'=>0,'Additional_3'=>0,'Additional_4'=>0,'Deposit'=>0,'status'=>'','user'=>$user,'date'=>'','TotalAmount'=>0,'time'=>'','id'=>'0','Authorised0'=>$date,'Authorised1'=>$date]
            ]);
                return back()->with(['message'=>'Client Betterment Created And Updated']);
            }else{
                DB::table('betterment')
                    ->where('Key_Ref','=',$key_ref)
                    ->update(['waste'=>'80']);
                    return back()->with(['message'=>'Betterment Updated']);
            }        

    }

    public function polish_quote(Request $request){
        $key_ref=$request->id;
        $date=date('Y-m-d');
        DB::table('qoutes')->insert([
            ['Key_Ref'=>$key_ref,'Oper'=>'Inhouse','Description'=>'Polish','Quantity'=>1,'Part'=>0,'Labour'=>0,'Paint'=>0,'Strip'=>0,'Frame'=>0,'Misc'=>250,'MarkUp'=>0,'MoneyTime'=>'','MarkUp2'=>0.00,'Date'=>$date,'yes'=>'','no'=>'','notdone'=>'','Column 27'=>'','repair'=>'','new'=>'','Close_RO'=>'','Inv_Date'=>'','qoute_type'=>0,'sundries'=>0]

            ]);
        return back()->with(['message'=>'Client Vehicle To Be Polished']);    
    }

    public function covid_quote(Request $request){
        $key_ref=$request->id;
        $date=date('Y-m-d');
        $ins=DB::table('insurer')->where('Key_Ref','=',$key_ref)->get();
        $covid=0;
        foreach($ins as $cov){
            $covid=$cov->covid;
        }
        DB::table('qoutes')->insert([
            ['Key_Ref'=>$key_ref,'Oper'=>'','Description'=>'Covid-19/Sanitizer','Quantity'=>0,'Part'=>0,'Labour'=>0,'Paint'=>0,'Strip'=>0,'Frame'=>0,'Misc'=>$covid,'MarkUp'=>0,'MoneyTime'=>'','MarkUp2'=>0.00,'Date'=>$date,'yes'=>'','no'=>'','notdone'=>'','Column 27'=>'','repair'=>'','new'=>'','Close_RO'=>'','Inv_Date'=>'','qoute_type'=>0,'sundries'=>0]

            ]);
            

        return back()->with(['message'=>'Client Vehicle To Be Sanitized']);

    }

    public function covid_unquote(Request $request){
        $key_ref=$request->id;
        $date=date('Y-m-d');
        DB::table('qoutes')
               ->where('Key_Ref','=',$key_ref) 
               ->where('Description','=','Covid-19/Sanitizer')
               ->delete(); 

        
        return back()->with(['message'=>'Polished Successfully Removed']);
    }

    public function unauthorize_quote(Request $request){
        $id=$request->id_auth;
        $date=$request->auth_date;

        DB::table('client_details')
                ->where('Key_Ref','=',$id)
                ->update(['status'=>'0']);

        return back()->with(['message'=>"Vehicle Is Now Unauthorised"]);        
    }

    public function unagreed_quote(Request $request){
        $key_ref=$request->id;
        DB::table('client_details')
            ->where('Key_Ref','=',$key_ref)
            ->update(['agreed_only'=>'0']);

        return back()->with(['message'=>'Client Has Unagreed Only']);
    }

    public function unwaste_quote(Request $request){
        $user=Auth::user()->username;
        $key_ref=$request->id;
        $date=date('Y-m-d');
        DB::table('betterment')
                ->where('Key_Ref','=',$key_ref)
                ->update(['waste'=>'0']);
                return back()->with(['message'=>'Waste And Disposal Successfully Removed']);
              

    }
    public function unpolish_quote(Request $request){
        $key_ref=$request->id;
        $date=date('Y-m-d');
        DB::table('qoutes')
               ->where('Key_Ref','=',$key_ref) 
               ->where('Oper','=','Inhouse')
               ->where('Description','=','Polish')
               ->delete(); 

        
        return back()->with(['message'=>'Polished Successfully Removed']);    
    }

    # [ CURRENT LOADED UPDATES ]
    public function view_quote_money($key_ref){
        $client_details=DB::table('client_details')
                            ->where('Key_Ref','=',$key_ref)
                            ->select('Fisrt_Name','Key_Ref','Reg_No','Last_Name','Email','Date','Make','Model')
                            ->get();
                            
        $money_quote=DB::table('insurer')
                            ->where('insurer.Key_Ref','=',$key_ref)
                            ->join('qoutes','insurer.Key_Ref','=','qoutes.Key_Ref')
                            ->select('qoutes.Key_Ref','qoutes.Oper','qoutes.Description','qoutes.Strip',
                                'qoutes.Part','qoutes.Labour','qoutes.Paint','qoutes.Frame','qoutes.Misc',
                                'qoutes.MarkUp','qoutes.Percent','qoutes.Quantity','qoutes.Betterment','qoutes.id','insurer.labour as ins_labour','insurer.Paint as ins_paint','insurer.Strip as ins_strip','insurer.Frame as ins_frame',
                                'insurer.ShopSup','insurer.PaintSup')
                            ->orderBy('qoutes.count', 'Asc')->orderBy('qoutes.id', 'Asc')->get(); 
        
        $oper=DB::table('oper')->get();
                            
        $check_waste=DB::table('betterment')
                            ->where('Key_Ref','=',$key_ref)
                            ->where('waste','=','80')
                            ->get();
            
        $check_polish=DB::table('qoutes')
                              ->where('Key_Ref','=',$key_ref)  
                              ->where('Description','=','Polish')
                              ->where('Oper','=','Inhouse')  
                              ->get();
    
        $check_agreed=DB::table('client_details')
                                ->where('Key_Ref','=',$key_ref)
                                ->where('agreed_only','=','1')
                                ->get();
    
        $check_auth=DB::table('client_details')
                                ->where('Key_Ref','=',$key_ref)
                                ->where('status','=','1')
                                
                                ->get();
        $authorize=Auth::user()->authorize;
        return view('quotations.money',['key'=>$key_ref,'quote'=>$money_quote,'oper'=>$oper,'check_waste'=>$check_waste,'check_auth'=>$check_auth,'check_polish'=>$check_polish,'check_agreed'=>$check_agreed,'client_details'=>$client_details,'authorize'=>$authorize]);                        
    }

    public function previous(){
        return redirect()->back();
    }

    public function view_proforma($id){
        $proform=DB::table('towing_history')
                        ->where('Key_Ref','=',$id)
                        ->get();
        return view('quotations.proforma',['key'=>$id,'proforma'=>$proform]);    
    }

    public function remove_track_photo($id){
        DB::table('track_photos')
                ->where('id','=',$id)
                ->delete();
                return back()->with(['message'=>'Image Successfully Removed!']);
    }

    public function proforma_save(Request $request){
        $key_ref=$request->proforma_id;
        $storage=$request->storage_days;
        $admin=$request->admin_days;
        $security=$request->security_days;
        $tow_fee=$request->towing_fee;
        $release_fee=$request->release_fee;
        $dis_fee=$request->discount_fee;
        $paid=$request->paid;
        $pay_meth=$request->payment_method;
        $pay_comment=$request->payment_comment;

        DB::table('towing_history')
              ->where('Key_Ref','=',$key_ref)
              ->update(['towing_fee1'=>$tow_fee,'storage'=>$storage,'admin'=>$admin,'security'=>$security,'discount'=>$dis_fee,
              'status'=>$paid,'payment'=>$pay_meth,'comment'=>$pay_comment,'release_fee'=>$release_fee]);
              return back()->with(['message'=>'Proforma Invoice Saved!']);
              //return redirect()->route('print-proforma-invoice',['id'=>$key_ref]);
    }

    public function proforma_write_off(Request $request){
        $key_ref=$request->id;
        $status=$request->status;
        DB::table('towing_history')
                ->where('Key_Ref','=',$key_ref)
                ->update(['writeoff'=>$status]);
                return back()->with(['message'=>'The Car Has Been Written Off']);
    }

    public function proforma_write_off_remove(Request $request){
        $key_ref=$request->id;
        $status=$request->status;
        DB::table('towing_history')
                ->where('Key_Ref','=',$key_ref)
                ->update(['writeoff'=>$status]);
                return back()->with(['message'=>'The Car Has Been Removed From Write Off List']);   
    }

    public function proforma_rate(Request $request){

    }

    public function edit_client_quotes(Request $request){
        $key_ref=$request->ref;
        $name=$request->name_edit;
        $last=$request->lastname_edit;
        $id_no=$request->id_number_edit;
        if(empty($id_no)){
            $id_no='';
        }
        $dob=$request->dob_edit;
        $cell=$request->mobile_edit;
        $email=$request->client_email_edit;
        if(empty($email)){
            $email='';
        }
        $street=$request->street_edit;
        if(empty($street)){
            $street='';
        }
        $suburb=$request->surburb_edit;
        if(empty($suburb)){
            $suburb='';
        }
        $city=$request->city_edit;
        if(empty($city)){
            $city='';
        }
        $estimator=$request->estimator_edit;
        $branch=$request->branch_edit;
        
        $reg=$request->registration_edit;
        $vin=$request->vin_number_edit;
        if(empty($vin)){
            $vin=0;
        }
        $engine_no=$request->engine_number_edit;
        if(empty($engine_no)){
            $engine_no='';
        }
        $make=$request->make_edit;
        $model=$request->model_edit;
        $odometer=$request->odometer_edit;
        if(empty($odometer)){
            $odometer='0';
        }
        $color=$request->colour_edit;
        if(empty($color)){
            $color='';
        }
        $year=$request->year_edit;
        if(empty($year)){
            $year='';
        }
        $booking=$request->booking_edit;
        if(empty($booking)){
            $booking='';
        }
        $quote_date=$request->quote_date_edit;

        $insurace_type=$request->insurance_type_edit;

        $insuror=$request->insuror_edit;
        if(empty($insuror)){
            $insuror='';
        }
        $ins_cell=$request->contact_number_edit;
        if(empty($ins_cell)){
            $ins_cell='';
        }
        $ins_email=$request->insurance_email_edit;
        if(empty($ins_email)){
            $ins_email='';
        }
        $claim_no=$request->claim_number_edit;
        if(empty($claim_no)){
            $claim_no='';
        }
        $clerk_ref=$request->clerk_ref_edit;
        if(empty($clerk_ref)){
            $clerk_ref='';
        }
        $assessor=$request->assessor_edit;
        if(empty($assessor)){
            $assessor='';
        }
        $ass_email=$request->assessor_email_edit;
        if(empty($ass_email)){
            $ass_email='';
        }
        $ass_no=$request->assessor_no_edit;
        if(empty($ass_no)){
            $ass_no='';
        }
        $ass_comp=$request->assessor_company_edit;
        if(empty($ass_comp)){
            $ass_comp='';
        }

        $towed=$request->towed_edit;
        if(empty($towed)){
            $towed='';
        }
        
        $towed_by=$request->towed_by_edit;
        if(empty($towed_by)){
            $towed_by='';
        }
        $towed_cell=$request->tow_contact_number_edit;
        if(empty($towed_cell)){
            $towed_cell='';
        }
        $towed_email=$request->tow_email_edit;
        if(empty($towed_email)){
            $towed_email='';
        }
        $towed_fee=$request->tow_fee_edit;
        if(empty($towed_fee)){
            $towed_fee='0';
        }
        $towed_status=$request->towed_status_edit;
        if(empty($towed_status)){
            $towed_status='';
        }
        $date=date('Y-m-d');
        

          //return $id_status;
          $branch_info=DB::table('branch')->where('branch_name','=',$branch)->limit(1)->get();

          //return $branch_info->branch_credits;
          foreach($branch_info as $info){
             $bra_id=$info->id; 
             $bra_credit=$info->branch_credits;
             $branch_name=$info->branch_name;
          }


        DB::table('client_details')->where('Key_Ref','=',$key_ref)->update([
            'Fisrt_Name'=>$name,'Last_Name'=>$last,'id_number'=>$id_no,'BirthDate'=>$dob,'Estimator'=>$estimator,'Email'=>$email,'Address_1'=>$street,'Address_2'=>$suburb,'Address_3'=>$city,'Cell_Number'=>$cell,'Vehicle_year'=>$year,'Make'=>$make,'Colour'=>$color,'Model'=>$model,'Reg_No'=>$reg,'Eng_No'=>$engine_no,'date'=>$date,'branch'=>$branch,'towed_by'=>$towed_by,'Vat_No'=>15,'Chasses_No'=>$vin,'KM'=>$odometer
        ]);

        DB::table('insurer')->where('Key_Ref','=',$key_ref)->update(
            ['Inserer'=>$insuror,'Phone'=>$ins_cell,'Email'=>$ins_email,'Claim_No'=>$claim_no,'Oder_No'=>$odometer,'Assessor'=>$assessor,'Assessor_Cell'=>$ass_no,'Assessor_Email'=>$ass_email,'Assessor_comp'=>$ass_comp,'Address_1'=>$street,'Address_2'=>$suburb,'Address_3'=>$city,'Cell'=>$cell,'ClerkName'=>$clerk_ref]
        );

        DB::table('towing_history')->where('Key_Ref','=',$key_ref)->update(
            ['Key_Ref'=>$key_ref,'first_name'=>$name,'last_name'=>$last,'reg_no'=>$reg,'make'=>$make,'model'=>$model,'vin'=>$vin,'km'=>'','insurer'=>$insuror,'claim_no'=>$claim_no,'towing_fee1'=>$towed_fee,'name'=>$towed_by,'email'=>$towed_email,'tel'=>$towed_cell,'date'=>$date,'assessor'=>$assessor,'assessor_cell'=>$ass_no,'assessor_email'=>$ass_email,'address'=>'','city'=>'','zip'=>'','att_to'=>'','vat_no'=>'0']
        );
        
        return back()->with(['message'=>'Client Details Have Been Successfully Updated.']);
    }

    public function all_with_auth(){
        $stocks=DB::table('stock')->get();
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        
    
            $allqoutes=DB::table('client_details')
                            ->leftjoin('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                            ->leftjoin('qoutes','client_details.Key_Ref','=','qoutes.Key_Ref')->orwhere('client_details.status','=','0')
                            ->select('client_details.Date','client_details.Key_Ref','client_details.Reg_No','client_details.Fisrt_Name','client_details.Last_Name','client_details.id_number','client_details.BirthDate','client_details.Cell_number','client_details.Email','client_details.Address_1','client_details.Address_2','client_details.Address_3','client_details.Make','client_details.Model','insurer.Inserer','client_details.status','qoutes.Key_Ref as Ref')
                            ->distinct()
                            ->orderBy('client_details.id','desc')
                            ->limit(1000)
                            ->get();
                            
                            return view('reception.allquotes',['details'=>$allqoutes,'alert'=>$prebooking_alert,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);                    

    }

    public function wip_sms($id){
        $towing=DB::table('sms_event')->where('stage_no','1')->get();
        $client_details=DB::table('client_details')->where('Key_Ref',$id)->get();
        $sms_tow_event=DB::table('sms_eventlog')->where('Key_Ref',$id)->where('stage_no','1')->get();
        foreach($client_details as $client){
            $reg_no=$client->Reg_No;
            $cell_no=$client->Cell_number;

        }
        $booking=DB::table('sms_event')->where('stage_no','3')->get();
        $sms_booking_event=DB::table('sms_eventlog')->where('Key_Ref',$id)->where('stage_no','3')->get();

        $business=DB::table('sms_event')->where('stage_no','17')->get();
        $sms_business_event=DB::table('sms_eventlog')->where('Key_Ref',$id)->where('stage_no','17')->get();
        return view('quotations.wipsms',['key'=>$id,'towing_sms'=>$towing,'reg'=>$reg_no,'cell_no'=>$cell_no,'sms_tow_event'=>$sms_tow_event,'booking_sms'=>$booking,'sms_booking_event'=>$sms_booking_event,'sms_business_event'=>$sms_business_event,'business_sms'=>$business]);    
    }

    public function send_sms(Request $request){
        $id=$request->wip_id_sms;
        $key_ref=$request->key_ref_sms;
        $cell=$request->cell_no_sms;
        $message=$request->sms_message_sms;
        $reg=$request->sms_reg_no_sms;
        $title=$request->sms_title_sms;
        $date=date('Y-m-d');
        $time=date('H:i:s');
        $username=Auth::user()->username;

        
        $mail = new PHPMailer();
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

    public function quote_photo_email(Request $request){



        return back()->with(['message'=>'Email Successfully Sent.']);
    }

    
    public function send_email_photo(Request $request){
    set_time_limit(0);
    $pics=$request->photoArr;    
    $ref = $request->ref;
    $picArr = array();//$_POST['photoArr'];
    $em_arr=$request->emarr;    
    foreach ($pics as $item){
    array_push($picArr, $item);
    }
    $immm = array();

    foreach ($em_arr as $email){
    //
    $mail                = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.motoraccidentgroup.co.za';
    $mail->Port = 25;
    //$mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "photos@motoraccidentgroup.co.za";
    $mail->Password = "M@G@2517";
    $mail->setFrom("photos@motoraccidentgroup.co.za", 'Motor Accident Group');
    $mail->addReplyTo('info@motoraccidentgroup.co.za', 'Motor Accident Group');
    $mail->addAddress($email, '');
    $mail->Subject = 'VEHICLE IMAGES';
	//$mail->addAttachment('../images/mag.png');
    $mail->AltBody    = "";
    $mail->MsgHTML("Please find the vehicle images attached below.<br>Regards<br>Motor Accident Group.");
    $mail->IsHTML(true);

    for($i=0;$i<count($pics);$i++){
        $id = $pics[$i];
        $url = '';

        $result = DB::select("select url from securityphotos where id=? and Key_Ref=?",[$id,$ref]);
        if(count($result)>0){  
        foreach($result as $row)
        {
        $url = $row->url;
    }
    }else{
        $result = DB::select("select picture_name from track_photos where id=? and Key_Ref=?",[$id,$ref]);
    
    foreach($result as $row)
    {
        $url = $row->picture_name;
    }
}
if(file_exists('/images/mag_photos/'.$ref.'/'.$url)){
    $img =    compress_image('/images/mag_photos/'.$ref.'/'.$url, $url, 10);
    $mail->AddEmbeddedImage( $img, 'Image'.$i); 
    array_push($immm,$img);
}else{
    $mail->AddEmbeddedImage('/images/mag_security/'.$ref.'/'.$url, 'Image'.$i); 
}
}

if (!$mail->send()) {
echo 1;
}else {
echo 0;
}

$mail->clearAddresses();

foreach ($immm as $imm) {
    unlink($imm);
} 
}

function compress_image($source_url, $destination_url, $quality) {

    $info = getimagesize($source_url);

     if ($info['mime'] == 'image/jpeg')
           $image = imagecreatefromjpeg($source_url);

     elseif ($info['mime'] == 'image/gif')
           $image = imagecreatefromgif($source_url);

   elseif ($info['mime'] == 'image/png')
           $image = imagecreatefrompng($source_url);

     imagejpeg($image, $destination_url, $quality);
 return $destination_url;
 }
    }

    public function search_archive(Request $request){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;

        $id=$request->archieve_key;
        $info=DB::table('client_details')
                      ->select('*','Key_Ref AS Ref')  
                      ->where('Key_Ref','=',$id)
                      ->orWhere('Reg_No','LIKE','%'.$id.'%')
                      ->get();  

        return view('reception.allquotes', ['details' => $info,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
    }

function create_insurer(Request $request){
    $broker=$request->broker_name;
    $contact=$request->broker_contact;
    $email=$request->broker_email;
    $vat=$request->broker_vat;
    $place=$request->broker_area;
    $address=$request->broker_address;
    if(empty($vat)){
            $vat='';
        }
    if(empty($place)){
            $place='';
    }
    if(empty($address)){
        $address='';
    }
    DB::table('broker_table')->insert([
        ['broker'=>$broker,'contact'=>$contact,'email'=>$email,'vat'=>$vat,'place'=>$place,'address'=>$address]
    ]);
    return back()->with(['message'=>'Insurance Company Successfully Created']);    

}

public function upload_quoted_photos(Request $request){
    $key_ref=$request->ref;
    foreach($request->file('image') as $image)
            {
                $path='images/mag_photos/';
                $path.=$key_ref;
                $name=$image->getClientOriginalName();
                $image->move(public_path($path), $name);  
                //$data[] = $name;  
                DB::table('track_photos')->insert([
                    ['Key_Ref'=>$key_ref,'picture_name'=>$name,'picture_comment'=>'','category' => '']
                ]);
            }
    return back()->with(['message'=>'Quoted Pictures Uploaded']);  
}



      #ADD A NEW LINE ON THE DATABASE
      public function add_new_line( Request $request ){

        $id = $request->id;
        $key_ref = $request->Key_Ref;
        $date=date("Y-m-d");
        $count = 0;

        $count_value =  DB::table('qoutes')->where('id','=',$id)->value('count');
        /*
        if( $count_value == 999999999 ){
            $count = $id;
        }else{
            $count = $count_value;
        }
        */

        $count = ( $count_value == 999999999 ) ? $id : $count_value;

        $save = DB::table('qoutes')->insert(['Key_Ref'=>$key_ref,'Oper'=>'','Description'=>'','Quantity'=>0,'Betterment'=>0,'Part'=>0,'Labour'=>0,'Paint'=>0,'Strip'=>0,'Frame'=>0,'Misc'=>0,'MarkUp'=>0,'MoneyTime'=>'','MarkUp2'=>0.00,'Date'=>$date,'yes'=>'','no'=>'','notdone'=>'','Column 27'=>'','repair'=>'','new'=>'','Close_RO'=>'','Inv_Date'=>'','qoute_type'=>0,'sundries'=>0, 'count'=> $count ]);
        if( $save ){
           $update = DB::table('qoutes')->where('id','=',$id)->update(['count'=>$count]);
           return 1;

        }else{
           return 0;
        }

    }
    
    public function delete_quotes(Request $request){
        $id=$request->delete_id;
        DB::table('qoutes')->where('id','=',$id)->delete();
        return back()->with(['message'=>'Part Removed Successfully.']);
    }







    
}
