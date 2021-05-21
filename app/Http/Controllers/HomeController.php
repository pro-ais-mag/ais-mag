<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        return view('administrator.user',['admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
    }
    public function time_estimator($ref){
        $time=DB::table('qoutes')->where('Key_Ref','=',$ref)->get();
        $days=0;
        $out=0;
        foreach($time as $convert){
            $days +=$convert->Labour/8;
            $days +=$convert->Strip/8;
            $days +=$convert->Paint/2/8;
            if($convert->Misc>0){
            $out +=2;
            }
        }
        return ceil(($days*2.5)+$out);
    }
    public function users(){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $user=Auth::user()->username;
        if($position!='Administrator'){
        return view('administrator.user',['user'=>$user,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
        }else{
        return redirect()->route('administrator');
        }
    }


    public function userss(){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $user=Auth::user()->username;
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
        //End 2018

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
        //End 2018

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
        //End 2020

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $convert_auth=DB::table('client_details')
                           ->where('status','=','1')  
                           ->select(DB::raw("count(Key_Ref) as count_auth"),DB::raw('MONTH(Date) as month'))
                           ->whereYear('Date','2020')
                           ->groupBy(DB::raw('MONTH(Date)'))
                           ->get();

        $convert_quoted=DB::table('client_details')
                            ->where('status','=','0') 
                            ->whereYear('Date','2020')
                            ->select(DB::raw('count(Key_Ref) as count_quoted'),DB::raw('MONTH(Date) as month_quoted'))
                            ->groupBy(DB::raw('MONTH(Date)'))
                            ->get();
                            
        
                $auth_arr=array();
                foreach($convert_auth as $auth){
                    array_push($auth_arr,$auth->count_auth);
                }        
                
                $quoted_arr=array();
                foreach($convert_quoted as $quoted){
                    array_push($quoted_arr,$quoted->count_quoted);
                }

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

          $esti_jan=DB::table('client_details')->where('Estimator','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','1')->count();
          $esti_feb=DB::table('client_details')->where('Estimator','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','2')->count();  
          $esti_mar=DB::table('client_details')->where('Estimator','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','3')->count();
          $esti_apr=DB::table('client_details')->where('Estimator','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','4')->count();
          $esti_may=DB::table('client_details')->where('Estimator','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','5')->count();
          $esti_jun=DB::table('client_details')->where('Estimator','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','6')->count();
          $esti_jul=DB::table('client_details')->where('Estimator','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','7')->count();
          $esti_aus=DB::table('client_details')->where('Estimator','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','8')->count();
          $esti_sep=DB::table('client_details')->where('Estimator','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','9')->count();
          $esti_oct=DB::table('client_details')->where('Estimator','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','10')->count();
          $esti_nov=DB::table('client_details')->where('Estimator','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','11')->count();
          $esti_dec=DB::table('client_details')->where('Estimator','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','12')->count();        

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Reception Job Card Stats
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
          $reception_jan=DB::table('document')->where('user','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','1')->where('Description','=','Job Card')->count();
          $reception_feb=DB::table('document')->where('user','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','2')->where('Description','=','Job Card')->count();  
          $reception_mar=DB::table('document')->where('user','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','3')->where('Description','=','Job Card')->count();
          $reception_apr=DB::table('document')->where('user','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','4')->where('Description','=','Job Card')->count();
          $reception_may=DB::table('document')->where('user','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','5')->where('Description','=','Job Card')->count();
          $reception_jun=DB::table('document')->where('user','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','6')->where('Description','=','Job Card')->count();
          $reception_jul=DB::table('document')->where('user','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','7')->where('Description','=','Job Card')->count();
          $reception_aus=DB::table('document')->where('user','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','8')->where('Description','=','Job Card')->count();
          $reception_sep=DB::table('document')->where('user','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','9')->where('Description','=','Job Card')->count();
          $reception_oct=DB::table('document')->where('user','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','10')->where('Description','=','Job Card')->count();
          $reception_nov=DB::table('document')->where('user','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','11')->where('Description','=','Job Card')->count();
          $reception_dec=DB::table('document')->where('user','LIKE','%'.$user.'%')->whereYear('Date','2020')->whereMonth('Date','12')->where('Description','=','Job Card')->count();
        
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////        
        //Reception WIP Stats
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $reception_jan_wip=DB::table('sms_eventlog')->where('user','LIKE','%'.$user.'%')->whereYear('sent_date','2020')->whereMonth('sent_date','1')->count();
        $reception_feb_wip=DB::table('sms_eventlog')->where('user','LIKE','%'.$user.'%')->whereYear('sent_date','2020')->whereMonth('sent_date','2')->count();  
        $reception_mar_wip=DB::table('sms_eventlog')->where('user','LIKE','%'.$user.'%')->whereYear('sent_date','2020')->whereMonth('sent_date','3')->count();
        $reception_apr_wip=DB::table('sms_eventlog')->where('user','LIKE','%'.$user.'%')->whereYear('sent_date','2020')->whereMonth('sent_date','4')->count();
        $reception_may_wip=DB::table('sms_eventlog')->where('user','LIKE','%'.$user.'%')->whereYear('sent_date','2020')->whereMonth('sent_date','5')->count();
        $reception_jun_wip=DB::table('sms_eventlog')->where('user','LIKE','%'.$user.'%')->whereYear('sent_date','2020')->whereMonth('sent_date','6')->count();
        $reception_jul_wip=DB::table('sms_eventlog')->where('user','LIKE','%'.$user.'%')->whereYear('sent_date','2020')->whereMonth('sent_date','7')->count();
        $reception_aus_wip=DB::table('sms_eventlog')->where('user','LIKE','%'.$user.'%')->whereYear('sent_date','2020')->whereMonth('sent_date','8')->count();
        $reception_sep_wip=DB::table('sms_eventlog')->where('user','LIKE','%'.$user.'%')->whereYear('sent_date','2020')->whereMonth('sent_date','9')->count();
        $reception_oct_wip=DB::table('sms_eventlog')->where('user','LIKE','%'.$user.'%')->whereYear('sent_date','2020')->whereMonth('sent_date','10')->count();
        $reception_nov_wip=DB::table('sms_eventlog')->where('user','LIKE','%'.$user.'%')->whereYear('sent_date','2020')->whereMonth('sent_date','11')->count();
        $reception_dec_wip=DB::table('sms_eventlog')->where('user','LIKE','%'.$user.'%')->whereYear('sent_date','2020')->whereMonth('sent_date','12')->count();      
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
        //Reception Customer Care Stats
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $feedback_total=DB::table('client_feedback')->count();
        $total_happy=DB::table('client_feedback')->where('comment_type','=','Happy')->count();
        $total_unavailable=DB::table('client_feedback')->where('comment_type','=','Unavailable')->count();
        $total_workman=DB::table('client_feedback')->where('comment_type','=','Workmanship')->count();
        $total_comm=DB::table('client_feedback')->where('comment_type','=','Communication')->count();
        $total_other=DB::table('client_feedback')->where('comment_type','=','Other')->count();
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Line Manager Time Stats
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $code=Auth::user()->comp_code;
        $mag_code='';
        $act_branch='';        
        $branch_code=DB::table('branch')->where('branch_code',$code)->get();
        foreach($branch_code as $branch){
            $mag_code=$branch->branch_name;
        }
        $act_branch=substr($mag_code,4);
        
        $avg_estimated_jan=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','1')->where('branch',$act_branch)->get();
        $avg_estimated_jan_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','1')->where('branch',$act_branch)->count();
        $result_jan=0;
            foreach($avg_estimated_jan as $est_jan){
                $result_jan+=$this->time_estimator($est_jan->Key_Ref);
        }
        if($avg_estimated_jan_count>0){
            $avg_jan=number_format($result_jan/$avg_estimated_jan_count,0);
        }else{
            $avg_jan=0;
        }
        //Estimate Average Feb
        $avg_estimated_feb=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','2')->where('branch',$act_branch)->get();
        $avg_estimated_feb_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','2')->where('branch',$act_branch)->count();
        $result_feb=0;
            foreach($avg_estimated_feb as $est_feb){
            $result_feb+=$this->time_estimator($est_feb->Key_Ref);
        }
        if($avg_estimated_feb_count>0){
            $avg_feb=number_format($result_feb/$avg_estimated_feb_count,0);
            }else{
                $avg_feb=0;
        }
     //$avg_feb=number_format($result_feb/$avg_estimated_feb_count,2);
     
     //Estimate Average March
     $avg_estimated_mar=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','3')->where('branch',$act_branch)->get();
     $avg_estimated_mar_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','3')->where('branch',$act_branch)->count();
     $result_mar=0;
     foreach($avg_estimated_mar as $est_mar){
         $result_mar+=$this->time_estimator($est_mar->Key_Ref);
     }
     if($avg_estimated_mar_count>0){
        $avg_mar=number_format($result_mar/$avg_estimated_mar_count,0);
        }else{
            $avg_mar=0;
        }
     //$avg_mar=number_format($result_mar/$avg_estimated_mar_count,2);

     //Estimate Average April
     $avg_estimated_apr=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','4')->where('branch',$act_branch)->get();
     $avg_estimated_apr_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','4')->where('branch',$act_branch)->count();
     $result_apr=0;
     foreach($avg_estimated_apr as $est_apr){
         $result_apr+=$this->time_estimator($est_apr->Key_Ref);
     }
     //$avg_apr=number_format($result_apr/$avg_estimated_apr_count,2);
     if($avg_estimated_apr_count>0){
        $avg_apr=number_format($result_apr/$avg_estimated_apr_count,0);
        }else{
            $avg_apr=0;
        }

     //Estimate May
     $avg_estimated_may=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','5')->where('branch',$act_branch)->get();
     $avg_estimated_may_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','5')->where('branch',$act_branch)->count();
     $result_may=0;
     foreach($avg_estimated_may as $est_may){
         $result_may+=$this->time_estimator($est_may->Key_Ref);
     }
     //$avg_may=number_format($result_may/$avg_estimated_may_count,2);
     if($avg_estimated_may_count>0){
        $avg_may=number_format($result_may/$avg_estimated_may_count,0);
        }else{
            $avg_may=0;
        }
     //Estimate June
     $avg_estimated_jun=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','6')->where('branch',$act_branch)->get();
     $avg_estimated_jun_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','6')->where('branch',$act_branch)->count();
     $result_jun=0;
     foreach($avg_estimated_jun as $est_jun){
         $result_jun+=$this->time_estimator($est_jun->Key_Ref);
     }
     //$avg_jun=number_format($result_jun/$avg_estimated_jun_count,2);
     if($avg_estimated_jun_count>0){
        $avg_jun=number_format($result_jun/$avg_estimated_jun_count,0);
        }else{
            $avg_jun=0;
        }

     //Estimate July
     $avg_estimated_jul=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','7')->where('branch',$act_branch)->get();
     $avg_estimated_jul_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','7')->where('branch',$act_branch)->count();
     $result_jul=0;
     foreach($avg_estimated_jul as $est_jul){
         $result_jul+=$this->time_estimator($est_jul->Key_Ref);
     }
     //$avg_jul=number_format($result_jul/$avg_estimated_jul_count,2);
     if($avg_estimated_jul_count>0){
        $avg_jul=number_format($result_jul/$avg_estimated_jul_count,0);
        }else{
            $avg_jul=0;
        }
     //Estimate Aug
     $avg_estimated_aug=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','8')->where('branch',$act_branch)->get();
     $avg_estimated_aug_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','8')->where('branch',$act_branch)->count();
     $result_aug=0;
     foreach($avg_estimated_aug as $est_aug){
         $result_aug+=$this->time_estimator($est_aug->Key_Ref);
     }
     if($avg_estimated_aug_count>0){
     $avg_aug=number_format($result_aug/$avg_estimated_aug_count,2);
     }else{
     $avg_aug=0;    
     }   
     //Estimate Sep
     $avg_estimated_sep=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','9')->where('branch',$act_branch)->get();
     $avg_estimated_sep_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','9')->where('branch',$act_branch)->count();
     $result_sep=0;
     foreach($avg_estimated_sep as $est_sep){
         $result_sep+=$this->time_estimator($est_sep->Key_Ref);
     }
     //$avg_sep=number_format($result_sep/$avg_estimated_sep_count,2);
     if($avg_estimated_sep_count>0){
        $avg_sep=number_format($result_sep/$avg_estimated_sep_count,0);
        }else{
            $avg_sep=0;
        }
     //Estimate Oct
     $avg_estimated_oct=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','10')->where('branch',$act_branch)->get();
     $avg_estimated_oct_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','10')->where('branch',$act_branch)->count();
     $result_oct=0;
     foreach($avg_estimated_oct as $est_oct){
         $result_oct+=$this->time_estimator($est_oct->Key_Ref);
     }
     //$avg_oct=number_format($result_oct/$avg_estimated_oct_count,2);
     if($avg_estimated_oct_count>0){
        $avg_oct=number_format($result_oct/$avg_estimated_oct_count,0);
        }else{
            $avg_oct=0;
        }
     //Estimate November
     $avg_estimated_nov=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','11')->where('branch',$act_branch)->get();
     $avg_estimated_nov_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','11')->where('branch',$act_branch)->count();
     $result_nov=0;
     foreach($avg_estimated_nov as $est_nov){
         $result_nov+=$this->time_estimator($est_nov->Key_Ref);
     }
     //$avg_nov=number_format($result_nov/$avg_estimated_nov_count,2);
     if($avg_estimated_nov_count>0){
        $avg_nov=number_format($result_nov/$avg_estimated_nov_count,0);
        }else{
            $avg_nov=0;
        }
     //Estimate December
     $avg_estimated_dec=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','12')->where('branch',$act_branch)->get();
     $avg_estimated_dec_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','12')->where('branch',$act_branch)->count();
     $result_dec=0;
     foreach($avg_estimated_dec as $est_dec){
         $result_dec+=$this->time_estimator($est_dec->Key_Ref);
     }
     if($avg_estimated_dec_count>0){
     $avg_dec=number_format($result_dec/$avg_estimated_dec_count,2);
     }else{
         $avg_dec=0;
     }

     //Actual Repair Time Jan
     $avg_actual_jan=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','1')->whereNotNull('release_date')->where('branch',$act_branch)->get();
     $actual_jan=0;
     foreach($avg_actual_jan as $act_jan){
         $arrive= new DateTime($act_jan->dr_date);
         $release=new DateTime($act_jan->release_date);
         $interval=$arrive->diff($release);
         $actual_jan+=$interval->format('%a');
     }
     if($actual_jan>0){
        $avg_act_jan=$actual_jan/$avg_estimated_jan_count;
        }else{
        $avg_act_jan=0;
        }
     

     //Actual Repair Time Feb
     $avg_actual_feb=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','2')->whereNotNull('release_date')->where('branch',$act_branch)->get();
     $actual_feb=0;
     foreach($avg_actual_feb as $act_feb){
         $arrive= new DateTime($act_feb->dr_date);
         $release=new DateTime($act_feb->release_date);
         $interval=$arrive->diff($release);
         $actual_feb+=$interval->format('%a');
     }
     if($actual_feb>0){
        $avg_act_feb=$actual_feb/$avg_estimated_feb_count;
        }else{
        $avg_act_feb=0;
        }

     //Actual Repair Time March
     $avg_actual_mar=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','3')->whereNotNull('release_date')->where('branch',$act_branch)->get();
     $actual_mar=0;
     foreach($avg_actual_mar as $act_mar){
         $arrive= new DateTime($act_mar->dr_date);
         $release=new DateTime($act_mar->release_date);
         $interval=$arrive->diff($release);
         $actual_mar+=$interval->format('%a');
     }
     if($actual_mar>0){
        $avg_act_mar=$actual_mar/$avg_estimated_mar_count;
        }else{
            $avg_act_mar=0;
        }
     
     //Actual Repair Time April
     $avg_actual_apr=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','4')->whereNotNull('release_date')->where('branch',$act_branch)->get();
     $actual_apr=0;
     foreach($avg_actual_apr as $act_apr){
         $arrive= new DateTime($act_apr->dr_date);
         $release=new DateTime($act_apr->release_date);
         $interval=$arrive->diff($release);
         $actual_apr+=$interval->format('%a');
     }
     if($actual_apr>0){
        $avg_act_apr=$actual_apr/$avg_estimated_apr_count;
        }else{
            $avg_act_apr=0;
        }
     
     //Actual Repair Time May
     $avg_actual_may=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','5')->whereNotNull('release_date')->where('branch',$act_branch)->get();
     $actual_may=0;
     foreach($avg_actual_may as $act_may){
         $arrive= new DateTime($act_may->dr_date);
         $release=new DateTime($act_may->release_date);
         $interval=$arrive->diff($release);
         $actual_may+=$interval->format('%a');
     }

     if($actual_may>0){
        $avg_act_may=$actual_may/$avg_estimated_may_count;
        }else{
            $avg_act_may=0;
        }

     //Actual Repair Time June
     $avg_actual_jun=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','6')->whereNotNull('release_date')->where('branch',$act_branch)->get();
     $actual_jun=0;
     foreach($avg_actual_jun as $act_jun){
         $arrive= new DateTime($act_jun->dr_date);
         $release=new DateTime($act_jun->release_date);
         $interval=$arrive->diff($release);
         $actual_jun+=$interval->format('%a');
     }
     if($actual_jun>0){
        $avg_act_jun=$actual_jun/$avg_estimated_jun_count;
        }else{
            $avg_act_jun=0;
        }

     //Actual Repair Time July
     $avg_actual_jul=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','7')->whereNotNull('release_date')->where('branch',$act_branch)->get();
     $actual_jul=0;
     foreach($avg_actual_jul as $act_jul){
         $arrive= new DateTime($act_jul->dr_date);
         $release=new DateTime($act_jul->release_date);
         $interval=$arrive->diff($release);
         $actual_jul+=$interval->format('%a');
     }
     if($actual_jul>0){
        $avg_act_jul=$actual_jul/$avg_estimated_jul_count;
        }else{
            $avg_act_jul=0;
        }

     //Actual Repair Time Aug
     $avg_actual_aug=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','8')->whereNotNull('release_date')->where('branch',$act_branch)->get();
     $actual_aug=0;
     foreach($avg_actual_aug as $act_aug){
         $arrive= new DateTime($act_aug->dr_date);
         $release=new DateTime($act_aug->release_date);
         $interval=$arrive->diff($release);
         $actual_aug+=$interval->format('%a');
     }
     if($actual_aug>0){
        $avg_act_aug=$actual_aug/$avg_estimated_aug_count;
        }else{
            $avg_act_aug=0;
        }

     //Actual Repair Time Sep
     $avg_actual_sep=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','9')->whereNotNull('release_date')->where('branch',$act_branch)->get();
     $actual_sep=0;
     foreach($avg_actual_sep as $act_sep){
         $arrive= new DateTime($act_sep->dr_date);
         $release=new DateTime($act_sep->release_date);
         $interval=$arrive->diff($release);
         $actual_sep+=$interval->format('%a');
     }
     if($actual_sep>0){
        $avg_act_sep=$actual_sep/$avg_estimated_sep_count;
        }else{
            $avg_act_sep=0;
        }

     //Actual Repair Time Oct
     $avg_actual_oct=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','10')->whereNotNull('release_date')->where('branch',$act_branch)->get();
     $actual_oct=0;
     foreach($avg_actual_oct as $act_oct){
         $arrive= new DateTime($act_oct->dr_date);
         $release=new DateTime($act_oct->release_date);
         $interval=$arrive->diff($release);
         $actual_oct+=$interval->format('%a');
     }
     if($actual_oct>0){
        $avg_act_oct=$actual_oct/$avg_estimated_oct_count;
        }else{
            $avg_act_oct=0;
        }

     //Actual Repair Time Nov
     $avg_actual_nov=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','11')->whereNotNull('release_date')->where('branch',$act_branch)->get();
     $actual_nov=0;
     foreach($avg_actual_nov as $act_nov){
         $arrive= new DateTime($act_nov->dr_date);
         $release=new DateTime($act_nov->release_date);
         $interval=$arrive->diff($release);
         $actual_nov+=$interval->format('%a');
     }
     if($actual_nov>0){
        $avg_act_nov=$actual_nov/$avg_estimated_nov_count;
        }else{
            $avg_act_nov=0;
        }

     //Actual Repair Time Dec
     $avg_actual_dec=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2020')->whereMonth('dr_date','12')->whereNotNull('release_date')->where('branch',$act_branch)->get();
     $actual_dec=0;
     foreach($avg_actual_dec as $act_dec){
         $arrive= new DateTime($act_dec->dr_date);
         $release=new DateTime($act_dec->release_date);
         $interval=$arrive->diff($release);
         $actual_dec+=$interval->format('%a');
     }
     if($actual_dec>0){
        $avg_act_dec=$actual_oct/$avg_estimated_dec_count;
        }else{
            $avg_act_dec=0;
        }
        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Line Manager Time Duration Stages Per Month
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $current_month=date('m');
        $panel_time_start=0;
        $stage_panel=DB::table('clocking_history')->where('stage','Panel Shop')->whereMonth('start',$current_month)->sum('start');
        $stage_paaint=DB::table('clocking_history')->where('stage','Paint Shop')->whereMonth('start',$current_month)->sum('start');
        $stage_assembly=DB::table('clocking_history')->where('stage','Assembly')->whereMonth('start',$current_month)->sum('start');
        $stage_mechanical=DB::table('clocking_history')->where('stage','Mechanical')->whereMonth('start',$current_month)->sum('start');
        $stage_cleaning=DB::table('clocking_history')->where('stage','Cleaning')->whereMonth('start',$current_month)->sum('start');

        $stage_panel_end=DB::table('clocking_history')->where('stage','Panel Shop')->whereMonth('start',$current_month)->sum('end');
        $stage_paaint_end=DB::table('clocking_history')->where('stage','Paint Shop')->whereMonth('start',$current_month)->sum('end');
        $stage_assembly_end=DB::table('clocking_history')->where('stage','Assembly')->whereMonth('start',$current_month)->sum('end');
        $stage_mechanic_end=DB::table('clocking_history')->where('stage','Mechanical')->whereMonth('start',$current_month)->sum('end');
        $stage_cleaning_end=DB::table('clocking_history')->where('stage','Cleaning')->whereMonth('start',$current_month)->sum('end');

        
        //$interval_panel=Carbon::parse($stage_panel)->diffInHours(Carbon::parse($stage_panel_end));
        //$interval_paint=$stage_paaint->diffInHours($stage_paaint_end);    
        //$interval_assembly=$stage_assembly->diffInHours($stage_assembly_end);
        //$interval_mechanic=$stage_mechanical->diffInHours($stage_mechanic_end);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Line Manager Current Vehicles Worked On
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $current_vehicles=DB::table('clocking_history')->whereYear('start','2020')->whereMonth('start','07')->distinct('Key_Ref')->count();

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Stores Credit Notes Stats
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $credit_notes_jan=DB::table('credit_note')->whereYear('date','2020')->whereMonth('date','1')->count();
        $credit_notes_feb=DB::table('credit_note')->whereYear('date','2020')->whereMonth('date','2')->count();
        $credit_notes_mar=DB::table('credit_note')->whereYear('date','2020')->whereMonth('date','3')->count();
        $credit_notes_apr=DB::table('credit_note')->whereYear('date','2020')->whereMonth('date','4')->count();
        $credit_notes_may=DB::table('credit_note')->whereYear('date','2020')->whereMonth('date','5')->count();
        $credit_notes_jun=DB::table('credit_note')->whereYear('date','2020')->whereMonth('date','6')->count();
        $credit_notes_jul=DB::table('credit_note')->whereYear('date','2020')->whereMonth('date','7')->count();
        $credit_notes_aug=DB::table('credit_note')->whereYear('date','2020')->whereMonth('date','8')->count();
        $credit_notes_sep=DB::table('credit_note')->whereYear('date','2020')->whereMonth('date','9')->count();
        $credit_notes_oct=DB::table('credit_note')->whereYear('date','2020')->whereMonth('date','10')->count();
        $credit_notes_nov=DB::table('credit_note')->whereYear('date','2020')->whereMonth('date','11')->count();
        $credit_notes_dec=DB::table('credit_note')->whereYear('date','2020')->whereMonth('date','12')->count();
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Stores Recived ,On Route,Ordered
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $orders_jan=DB::table('orders')->whereYear('date','2020')->whereMonth('date','1')->count();
        $orders_feb=DB::table('orders')->whereYear('date','2020')->whereMonth('date','2')->count();
        $orders_mar=DB::table('orders')->whereYear('date','2020')->whereMonth('date','3')->count();
        $orders_apr=DB::table('orders')->whereYear('date','2020')->whereMonth('date','4')->count();
        $orders_may=DB::table('orders')->whereYear('date','2020')->whereMonth('date','5')->count();
        $orders_jun=DB::table('orders')->whereYear('date','2020')->whereMonth('date','6')->count();
        $orders_jul=DB::table('orders')->whereYear('date','2020')->whereMonth('date','7')->count();
        $orders_aug=DB::table('orders')->whereYear('date','2020')->whereMonth('date','8')->count();
        $orders_sep=DB::table('orders')->whereYear('date','2020')->whereMonth('date','9')->count();
        $orders_oct=DB::table('orders')->whereYear('date','2020')->whereMonth('date','10')->count();
        $orders_nov=DB::table('orders')->whereYear('date','2020')->whereMonth('date','11')->count();
        $orders_dec=DB::table('orders')->whereYear('date','2020')->whereMonth('date','12')->count();

        $confirmed_jan=DB::table('confirmed_orders')->whereYear('date','2020')->whereMonth('date','1')->count();
        $confirmed_feb=DB::table('confirmed_orders')->whereYear('date','2020')->whereMonth('date','2')->count();
        $confirmed_mar=DB::table('confirmed_orders')->whereYear('date','2020')->whereMonth('date','3')->count();
        $confirmed_apr=DB::table('confirmed_orders')->whereYear('date','2020')->whereMonth('date','4')->count();
        $confirmed_may=DB::table('confirmed_orders')->whereYear('date','2020')->whereMonth('date','5')->count();
        $confirmed_jun=DB::table('confirmed_orders')->whereYear('date','2020')->whereMonth('date','6')->count();
        $confirmed_jul=DB::table('confirmed_orders')->whereYear('date','2020')->whereMonth('date','7')->count();
        $confirmed_aug=DB::table('confirmed_orders')->whereYear('date','2020')->whereMonth('date','8')->count();
        $confirmed_sep=DB::table('confirmed_orders')->whereYear('date','2020')->whereMonth('date','9')->count();
        $confirmed_oct=DB::table('confirmed_orders')->whereYear('date','2020')->whereMonth('date','10')->count();
        $confirmed_nov=DB::table('confirmed_orders')->whereYear('date','2020')->whereMonth('date','11')->count();
        $confirmed_dec=DB::table('confirmed_orders')->whereYear('date','2020')->whereMonth('date','12')->count();

        
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Stores Personal Stats
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $buyer_jan=DB::table('confirmed_orders')->where('user','LIKE','%'.$user.'%')->whereYear('date','2020')->whereMonth('date','1')->count();
        $buyer_feb=DB::table('confirmed_orders')->where('user','LIKE','%'.$user.'%')->whereYear('date','2020')->whereMonth('date','2')->count();
        $buyer_mar=DB::table('confirmed_orders')->where('user','LIKE','%'.$user.'%')->whereYear('date','2020')->whereMonth('date','3')->count();
        $buyer_apr=DB::table('confirmed_orders')->where('user','LIKE','%'.$user.'%')->whereYear('date','2020')->whereMonth('date','4')->count();
        $buyer_may=DB::table('confirmed_orders')->where('user','LIKE','%'.$user.'%')->whereYear('date','2020')->whereMonth('date','5')->count();
        $buyer_jun=DB::table('confirmed_orders')->where('user','LIKE','%'.$user.'%')->whereYear('date','2020')->whereMonth('date','6')->count();
        $buyer_jul=DB::table('confirmed_orders')->where('user','LIKE','%'.$user.'%')->whereYear('date','2020')->whereMonth('date','7')->count();
        $buyer_aug=DB::table('confirmed_orders')->where('user','LIKE','%'.$user.'%')->whereYear('date','2020')->whereMonth('date','8')->count();
        $buyer_sep=DB::table('confirmed_orders')->where('user','LIKE','%'.$user.'%')->whereYear('date','2020')->whereMonth('date','9')->count();
        $buyer_oct=DB::table('confirmed_orders')->where('user','LIKE','%'.$user.'%')->whereYear('date','2020')->whereMonth('date','10')->count();
        $buyer_nov=DB::table('confirmed_orders')->where('user','LIKE','%'.$user.'%')->whereYear('date','2020')->whereMonth('date','11')->count();
        $buyer_dec=DB::table('confirmed_orders')->where('user','LIKE','%'.$user.'%')->whereYear('date','2020')->whereMonth('date','12')->count();

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Stores Personal Additionals Stats
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //RFC Created Stats
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if($position!='Administrator'){

        return view('alluserapi',['user'=>$user,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final,'jan'=>$jan,'feb'=>$feb,'mar'=>$mar,'apr'=>$apr,'may'=>$may,'jun'=>$jun,'jul'=>$jul,'aus'=>$aus,'sep'=>$sep,'oct'=>$oct,'nov'=>$nov,'dec'=>$dec,'jan_2019'=>$jan_2019,'feb_2019'=>$feb_2019,'mar_2019'=>$mar_2019,'apr_2019'=>$apr_2019,'may_2019'=>$may_2019,'jun_2019'=>$jun_2019,'jul_2019'=>$jul_2019,'aus_2019'=>$aus_2019,'sep_2019'=>$sep_2019,'oct_2019'=>$sep_2019,'nov_2019'=>$nov_2019,'dec_2019'=>$dec_2019,'jan_2018'=>$jan_2018,'feb_2018'=>$feb_2018,'mar_2018'=>$mar_2018,'apr_2018'=>$apr_2018,'may_2018'=>$may_2018,'jun_2018'=>$jun_2018,'jul_2018'=>$jul_2018,'aus_2018'=>$aus_2018,'sep_2018'=>$sep_2018,'oct_2018'=>$sep_2018,'nov_2018'=>$nov_2018,'dec_2018'=>$dec_2018,'convert_auth'=>$auth_arr,'convert_quoted'=>$quoted_arr,'esti_jan'=>$esti_jan,'esti_feb'=>$esti_feb,'esti_mar'=>$esti_mar,'esti_apr'=>$esti_apr,'esti_may'=>$esti_may,'esti_jun'=>$esti_jun,'esti_jul'=>$esti_jul,'esti_aus'=>$esti_aus,'esti_sep'=>$esti_sep,'esti_oct'=>$esti_oct,'esti_nov'=>$esti_nov,'esti_dec'=>$esti_dec,'reception_jan'=>$reception_jan,'reception_feb'=>$reception_feb,'reception_mar'=>$reception_mar,'reception_apr'=>$reception_apr,'reception_may'=>$reception_may,'reception_jun'=>$reception_jun,'reception_jul'=>$reception_jul,'reception_aus'=>$reception_aus,'reception_sep'=>$reception_sep,'reception_oct'=>$reception_oct,'reception_nov'=>$reception_nov,'reception_dec'=>$reception_dec,'reception_jan_wip'=>$reception_jan_wip,'reception_feb_wip'=>$reception_feb_wip,'reception_mar_wip'=>$reception_mar_wip,'reception_apr_wip'=>$reception_apr_wip,'reception_may_wip'=>$reception_may_wip,'reception_jun_wip'=>$reception_jun_wip,'reception_jul_wip'=>$reception_jul_wip,'reception_aus_wip'=>$reception_aus_wip,'reception_sep_wip'=>$reception_sep_wip,'reception_oct_wip'=>$reception_oct_wip,'reception_nov_wip'=>$reception_nov_wip,'reception_dec_wip'=>$reception_dec_wip,'feedback_total'=>$feedback_total,'total_happy'=>$total_happy,'total_unavailable'=>$total_unavailable,'total_workman'=>$total_workman,'total_comm'=>$total_comm,'total_other'=>$total_other,'avg_jan'=>$avg_jan,'avg_feb'=>$avg_feb,'avg_mar'=>$avg_mar,'avg_apr'=>$avg_apr,'avg_may'=>$avg_may,'avg_jun'=>$avg_jun,'avg_jul'=>$avg_jul,'avg_aug'=>$avg_aug,'avg_sep'=>$avg_sep,'avg_oct'=>$avg_oct,'avg_nov'=>$avg_nov,'avg_dec'=>$avg_dec,'avg_act_jan'=>$avg_act_jan,'avg_act_feb'=>$avg_act_feb,'avg_act_mar'=>$avg_act_mar,'avg_act_apr'=>$avg_act_apr,'avg_act_may'=>$avg_act_may,'avg_act_jun'=>$avg_act_jun,'avg_act_jul'=>$avg_act_jul,'avg_act_aug'=>$avg_act_aug,'avg_act_sep'=>$avg_act_sep,'avg_act_oct'=>$avg_act_oct,'avg_act_nov'=>$avg_act_nov,'avg_act_dec'=>$avg_act_dec,'stage_panel'=>$stage_panel,'stage_paaint'=>$stage_paaint,'stage_assembly'=>$stage_assembly,'stage_mechanical'=>$stage_mechanical,'stage_cleaning'=>$stage_cleaning,'car_in'=>$current_vehicles,'credit_notes_jan'=>$credit_notes_jan,'credit_notes_feb'=>$credit_notes_feb,'credit_notes_mar'=>$credit_notes_mar,
        'credit_notes_apr'=>$credit_notes_apr,'credit_notes_may'=>$credit_notes_may,'credit_notes_jun'=>$credit_notes_jun,'credit_notes_jul'=>$credit_notes_jul,'credit_notes_aug'=>$credit_notes_aug,'credit_notes_sep'=>$credit_notes_sep,'credit_notes_oct'=>$credit_notes_oct,'credit_notes_nov'=>$credit_notes_nov,'credit_notes_dec'=>$credit_notes_dec,
        'orders_jan'=>$orders_jan,'orders_feb'=>$orders_feb,'orders_mar'=>$orders_mar,'orders_apr'=>$orders_apr,'orders_may'=>$orders_may,'orders_jun'=>$orders_jun,'orders_jul'=>$orders_jul,'orders_aug'=>$orders_aug,'orders_sep'=>$orders_sep,'orders_oct'=>$orders_oct,'orders_nov'=>$orders_nov,'orders_dec'=>$orders_dec,
        'confirmed_jan'=>$confirmed_jan,'confirmed_feb'=>$confirmed_feb,'confirmed_mar'=>$confirmed_mar,'confirmed_apr'=>$confirmed_apr,'confirmed_may'=>$confirmed_may,'confirmed_jun'=>$confirmed_jun,'confirmed_jul'=>$confirmed_jul,'confirmed_aug'=>$confirmed_aug,'confirmed_sep'=>$confirmed_sep,'confirmed_oct'=>$confirmed_oct,'confirmed_nov'=>$confirmed_nov,'confirmed_dec'=>$confirmed_dec,
        'buyer_jan'=>$buyer_jan,'buyer_feb'=>$buyer_feb,'buyer_mar'=>$buyer_mar,'buyer_apr'=>$buyer_apr,'buyer_may'=>$buyer_may,'buyer_jun'=>$buyer_jun,'buyer_jul'=>$buyer_jul,'buyer_aug'=>$buyer_aug,'buyer_sep'=>$buyer_sep,'buyer_oct'=>$buyer_oct,'buyer_nov'=>$buyer_nov,'buyer_dec'=>$buyer_dec]);
        }else{
            return redirect()->route('administrator');
            
        }
    }

    public function change_repairer(Request $request){
        $id=$request->key_ref;
        DB::table('betterment')->where('Key_Ref','=',$id)->update(['paintShop1'=>$sun]);
    }

    public function change_name_surname(Request $request){
        $name=$request->name;
        $id=$request->id;
        $pos=strpos($name,' ');
        $length=strlen($name);
        $first=substr($name,0,$pos);
        $last=substr($name,$pos+1,$length-$pos);
        DB::table('client_details')->where('Key_Ref','=',$id)->update(['Fisrt_Name'=>$first,'Last_Name'=>$last]);
        return back()->with(['message'=>'Successfully Saved.']);
    }

    public function change_reg(Request $request){
        $reg=$request->reg;
        $id=$request->id;
        DB::table('client_details')->where('Key_Ref','=',$id)->update(['Reg_No'=>$reg]);

    }

    public function change_model(Request $request){
        $id=$request->id;
        $model=$request->model;
        DB::table('client_details')->where('Key_Ref','=',$id)->update(['Model'=>$model]);
    }

    public function change_assessor(Request $request){
        $id=$request->id;
        $assessor=$request->assessor;
        DB::table('insurer')->where('Key_Ref','=',$id)->update(['Assessor'=>$assessor]);
    }

    public function change_claim_no(Request $request){
        $id=$request->id;
        $claim_no=$request->claim;

        DB::table('insurer')->where('Key_Ref','=',$id)->update(['Claim_NO'=>$claim_no]);
    }

    public function change_final_date(Request $request){
        $id=$request->id;
        $date=$request->date;
        DB::table('client_details')->where('Key_Ref','=',$id)->update(['Date'=>$date]);
        
    }
}
