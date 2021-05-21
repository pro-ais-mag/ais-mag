<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
class AdministratorController extends Controller
{
    public function index(){
        return view('administrator.dashboard');
    }

    public function graphs(){
        //Customer Care

        $feedback_total=DB::table('client_feedback')->count();
        $total_happy=DB::table('client_feedback')->where('comment_type','=','Happy')->count();
        $total_unavailable=DB::table('client_feedback')->where('comment_type','=','Unavailable')->count();
        $total_workman=DB::table('client_feedback')->where('comment_type','=','Workmanship')->count();
        $total_comm=DB::table('client_feedback')->where('comment_type','=','Communication')->count();
        $total_other=DB::table('client_feedback')->where('comment_type','=','Other')->count();

        //End Of Customer Care

        //return view('administrator.administratorkpi',['total'=>$feedback_total,'happy'=>$total_happy,'unavailable'=>$total_unavailable,'workman'=>$total_workman,'comm'=>$total_comm,'other'=>$total_other]);
        
        //Comsumerables KPI
        $highest=DB::table('stock')
                        ->select('description','quantity')
                        ->orderBy('quantity','desc')
                        ->limit(5)
                        ->get();
        $lowest=DB::table('stock')
                        ->select('description','quantity')
                        ->orderBy('quantity','asc')
                        ->limit(5)
                        ->get();
        
                        $total_products=DB::table('stock')->count();                
        //End Comsumerables KPI   

        //Line Manager KPI
       $total_users=DB::table('user')->count();
        $admin_users=DB::table('user')->where('use_username','LIKE','%'.'Admin'.'%')->count();
        $driver_users=DB::table('user')->where('use_username','LIKE','%'.'Driver'.'%')->count();
        $workshop_users=$total_users-($admin_users+$driver_users);
        //End Of Line Manger KPI

        //Quotations
        $auth_quotes=DB::table('client_details')->where('status','1')->count();
        $total_quotes=DB::table('client_details')->count();
        $unauth_quotes=DB::table('client_details')->where('status','0')->count();
        $towed=DB::table('towing_history')->where('Key_Ref','!=','NULL')->count();
        $client_count=DB::table('client_details');
        //End Quotaion

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

        //End 2029

        //Year 2018
        $jan_2018=DB::table('client_details')->whereYear('dr_date','2021')->whereMonth('dr_date','1')->count();
        $feb_2018=DB::table('client_details')->whereYear('dr_date','2021')->whereMonth('dr_date','2')->count();
        $mar_2018=DB::table('client_details')->whereYear('dr_date','2021')->whereMonth('dr_date','3')->count();
        $apr_2018=DB::table('client_details')->whereYear('dr_date','2021')->whereMonth('dr_date','4')->count();
        $may_2018=DB::table('client_details')->whereYear('dr_date','2021')->whereMonth('dr_date','5')->count();
        $jun_2018=DB::table('client_details')->whereYear('dr_date','2021')->whereMonth('dr_date','6')->count();
        $jul_2018=DB::table('client_details')->whereYear('dr_date','2021')->whereMonth('dr_date','7')->count();
        $aus_2018=DB::table('client_details')->whereYear('dr_date','2021')->whereMonth('dr_date','8')->count();
        $sep_2018=DB::table('client_details')->whereYear('dr_date','2021')->whereMonth('dr_date','9')->count();
        $oct_2018=DB::table('client_details')->whereYear('dr_date','2021')->whereMonth('dr_date','10')->count();
        $nov_2018=DB::table('client_details')->whereYear('dr_date','2021')->whereMonth('dr_date','11')->count();
        $dec_2018=DB::table('client_details')->whereYear('dr_date','2021')->whereMonth('dr_date','12')->count();

        //Estimator Performance
        $array_numbers=array();
        $estimator=DB::table('users')->where('position','=','Estimator')->get();
        foreach($estimator as $esti){
                  $men=DB::table('client_details')
                            ->where('Estimator','=',$esti->username)
                            ->select(DB::raw("count(Key_Ref) as count_quotes"),'Estimator')
                            ->whereYear('dr_date','2021')
                            ->groupBy(DB::raw('MONTH(dr_date)'),'Estimator')
                            ->get();
                           foreach($men as $yes){ 
                                array_push($array_numbers,$yes->count_quotes);            
                           }     
        }


        $estimator_per=DB::table('users')
                            ->where('users.position','=','Estimator')
                            ->join('client_details','users.username','=','client_details.Estimator')
                            ->select('client_details.Estimator',DB::raw("count(client_details.Key_Ref) as count_quotes"))
                            ->whereYear('client_details.dr_date','2021')
                            ->orderBy(DB::raw('MONTH(client_details.dr_date)'))
                            ->groupBy('client_details.Estimator',DB::raw('MONTH(client_details.dr_date)'))
                            ->get();
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Branch Performances
        $perform_selby=DB::table('client_details')
                            ->where('branch','=','Selby')
                            ->whereYear('Date','2021')
                            ->select('branch',DB::raw("count(Key_Ref) as selby_quote"),DB::raw('MONTH(Date) as month'))
                            ->orderBy(DB::raw('MONTH(Date)'))
                            ->groupBy('branch',DB::raw('MONTH(Date)'))
                            ->get();

        $selby_arr=array();
            foreach($perform_selby as $selby){
                      array_push($selby_arr,$selby->selby_quote);
                  }                    
               
        $perform_glen=DB::table('client_details')
                  ->where('branch','=','The Glen')
                  ->whereYear('Date','2021')
                  ->select('branch',DB::raw("count(Key_Ref) as glen_quote"),DB::raw('MONTH(Date) as month'))
                  ->orderBy(DB::raw('MONTH(Date)'))
                  ->groupBy('branch',DB::raw('MONTH(Date)'))
                  ->get();

        $glen_arr=array();
            foreach($perform_glen as $glen){
                array_push($glen_arr,$glen->glen_quote);
            }          

        $perform_longmeadow=DB::table('client_details')
                  ->where('branch','=','Longmeadow')
                  ->whereYear('Date','2021')
                  ->select('branch',DB::raw("count(Key_Ref) as longmeadow_quote"),DB::raw('MONTH(Date) as month'))
                  ->orderBy(DB::raw('MONTH(Date)'))
                  ->groupBy('branch',DB::raw('MONTH(Date)'))
                  ->get();

        $longmeadow_arr=array();
            foreach($perform_longmeadow as $longmeadow){
                array_push($longmeadow_arr,$longmeadow->longmeadow_quote);
            } 
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////
      //Estimator Performance
          //Alfie  
          $alfie_jan=DB::table('client_details')->where('Estimator','LIKE','%Alfie%')->whereYear('Date','2021')->whereMonth('Date','1')->count();
          $alfie_feb=DB::table('client_details')->where('Estimator','LIKE','%Alfie%')->whereYear('Date','2021')->whereMonth('Date','2')->count();  
          $alfie_mar=DB::table('client_details')->where('Estimator','LIKE','%Alfie%')->whereYear('Date','2021')->whereMonth('Date','3')->count(); 
          $alfie_apr=DB::table('client_details')->where('Estimator','LIKE','%Alfie%')->whereYear('Date','2021')->whereMonth('Date','4')->count();
          $alfie_may=DB::table('client_details')->where('Estimator','LIKE','%Alfie%')->whereYear('Date','2021')->whereMonth('Date','5')->count();  
          $alfie_jun=DB::table('client_details')->where('Estimator','LIKE','%Alfie%')->whereYear('Date','2021')->whereMonth('Date','6')->count();
          $alfie_jul=DB::table('client_details')->where('Estimator','LIKE','%Alfie%')->whereYear('Date','2021')->whereMonth('Date','7')->count();
          $alfie_aus=DB::table('client_details')->where('Estimator','LIKE','%Alfie%')->whereYear('Date','2021')->whereMonth('Date','8')->count();
          $alfie_sep=DB::table('client_details')->where('Estimator','LIKE','%Alfie%')->whereYear('Date','2021')->whereMonth('Date','9')->count();
          $alfie_oct=DB::table('client_details')->where('Estimator','LIKE','%Alfie%')->whereYear('Date','2021')->whereMonth('Date','10')->count();
          $alfie_nov=DB::table('client_details')->where('Estimator','LIKE','%Alfie%')->whereYear('Date','2021')->whereMonth('Date','11')->count();
          $alfie_dec=DB::table('client_details')->where('Estimator','LIKE','%Alfie%')->whereYear('Date','2021')->whereMonth('Date','12')->count();
      //Estimator Zahid
          $zahid_jan=DB::table('client_details')->where('Estimator','LIKE','Zahid')->whereYear('Date','2021')->WhereMonth('Date','1')->count();        
          $zahid_feb=DB::table('client_details')->where('Estimator','LIKE','Zahid')->whereYear('Date','2021')->WhereMonth('Date','2')->count();
          $zahid_mar=DB::table('client_details')->where('Estimator','LIKE','Zahid')->whereYear('Date','2021')->WhereMonth('Date','3')->count();
          $zahid_apr=DB::table('client_details')->where('Estimator','LIKE','Zahid')->whereYear('Date','2021')->WhereMonth('Date','4')->count();
          $zahid_may=DB::table('client_details')->where('Estimator','LIKE','Zahid')->whereYear('Date','2021')->WhereMonth('Date','5')->count();
          $zahid_jun=DB::table('client_details')->where('Estimator','LIKE','Zahid')->whereYear('Date','2021')->WhereMonth('Date','6')->count();
          $zahid_jul=DB::table('client_details')->where('Estimator','LIKE','Zahid')->whereYear('Date','2021')->WhereMonth('Date','7')->count();
          $zahid_aus=DB::table('client_details')->where('Estimator','LIKE','Zahid')->whereYear('Date','2021')->WhereMonth('Date','8')->count();
          $zahid_sep=DB::table('client_details')->where('Estimator','LIKE','Zahid')->whereYear('Date','2021')->WhereMonth('Date','9')->count();
          $zahid_oct=DB::table('client_details')->where('Estimator','LIKE','Zahid')->whereYear('Date','2021')->WhereMonth('Date','10')->count();
          $zahid_nov=DB::table('client_details')->where('Estimator','LIKE','Zahid')->whereYear('Date','2021')->WhereMonth('Date','11')->count();
          $zahid_dec=DB::table('client_details')->where('Estimator','LIKE','Zahid')->whereYear('Date','2021')->WhereMonth('Date','12')->count();
      //Estimator Walter
          $walter_jan=DB::table('client_details')->where('Estimator','LIKE','%ZAHID - W%')->whereYear('Date','2021')->whereMonth('Date','1')->count();  
          $walter_feb=DB::table('client_details')->where('Estimator','LIKE','%ZAHID - W%')->whereYear('Date','2021')->whereMonth('Date','2')->count();
          $walter_mar=DB::table('client_details')->where('Estimator','LIKE','%ZAHID - W%')->whereYear('Date','2021')->whereMonth('Date','3')->count();
          $walter_apr=DB::table('client_details')->where('Estimator','LIKE','%ZAHID - W%')->whereYear('Date','2021')->whereMonth('Date','4')->count();
          $walter_may=DB::table('client_details')->where('Estimator','LIKE','%ZAHID - W%')->whereYear('Date','2021')->whereMonth('Date','5')->count();
          $walter_jun=DB::table('client_details')->where('Estimator','LIKE','%ZAHID - W%')->whereYear('Date','2021')->whereMonth('Date','6')->count();
          $walter_jul=DB::table('client_details')->where('Estimator','LIKE','%ZAHID - W%')->whereYear('Date','2021')->whereMonth('Date','7')->count();  
          $walter_aus=DB::table('client_details')->where('Estimator','LIKE','%ZAHID - W%')->whereYear('Date','2021')->whereMonth('Date','8')->count();
          $walter_sep=DB::table('client_details')->where('Estimator','LIKE','%ZAHID - W%')->whereYear('Date','2021')->whereMonth('Date','9')->count();
          $walter_oct=DB::table('client_details')->where('Estimator','LIKE','%ZAHID - W%')->whereYear('Date','2021')->whereMonth('Date','10')->count();
          $walter_nov=DB::table('client_details')->where('Estimator','LIKE','%ZAHID - W%')->whereYear('Date','2021')->whereMonth('Date','11')->count();
          $walter_dec=DB::table('client_details')->where('Estimator','LIKE','%ZAHID - W%')->whereYear('Date','2021')->whereMonth('Date','12')->count();
      //Estimator John      
          $john_jan=DB::table('client_details')->where('Estimator','LIKE','%John%')->whereYear('Date','2021')->whereMonth('Date','1')->count();
          $john_feb=DB::table('client_details')->where('Estimator','LIKE','%John%')->whereYear('Date','2021')->whereMonth('Date','2')->count();  
          $john_mar=DB::table('client_details')->where('Estimator','LIKE','%John%')->whereYear('Date','2021')->whereMonth('Date','3')->count();
          $john_apr=DB::table('client_details')->where('Estimator','LIKE','%John%')->whereYear('Date','2021')->whereMonth('Date','4')->count();
          $john_may=DB::table('client_details')->where('Estimator','LIKE','%John%')->whereYear('Date','2021')->whereMonth('Date','5')->count();
          $john_jun=DB::table('client_details')->where('Estimator','LIKE','%John%')->whereYear('Date','2021')->whereMonth('Date','6')->count();
          $john_jul=DB::table('client_details')->where('Estimator','LIKE','%John%')->whereYear('Date','2021')->whereMonth('Date','7')->count();
          $john_aus=DB::table('client_details')->where('Estimator','LIKE','%John%')->whereYear('Date','2021')->whereMonth('Date','8')->count();
          $john_sep=DB::table('client_details')->where('Estimator','LIKE','%John%')->whereYear('Date','2021')->whereMonth('Date','9')->count();
          $john_oct=DB::table('client_details')->where('Estimator','LIKE','%John%')->whereYear('Date','2021')->whereMonth('Date','10')->count();
          $john_nov=DB::table('client_details')->where('Estimator','LIKE','%John%')->whereYear('Date','2021')->whereMonth('Date','11')->count();
          $john_dec=DB::table('client_details')->where('Estimator','LIKE','%John%')->whereYear('Date','2021')->whereMonth('Date','12')->count();
      //Estimator Shane
          $shane_jan=DB::table('client_details')->where('Estimator','LIKE','%Barney%')->whereYear('Date','2021')->whereMonth('Date','1')->count();
          $shane_feb=DB::table('client_details')->where('Estimator','LIKE','%Barney%')->whereYear('Date','2021')->whereMonth('Date','2')->count();  
          $shane_mar=DB::table('client_details')->where('Estimator','LIKE','%Barney%')->whereYear('Date','2021')->whereMonth('Date','3')->count();
          $shane_apr=DB::table('client_details')->where('Estimator','LIKE','%Barney%')->whereYear('Date','2021')->whereMonth('Date','4')->count();
          $shane_may=DB::table('client_details')->where('Estimator','LIKE','%Barney%')->whereYear('Date','2021')->whereMonth('Date','5')->count();
          $shane_jun=DB::table('client_details')->where('Estimator','LIKE','%Barney%')->whereYear('Date','2021')->whereMonth('Date','6')->count();
          $shane_jul=DB::table('client_details')->where('Estimator','LIKE','%Barney%')->whereYear('Date','2021')->whereMonth('Date','7')->count();
          $shane_aus=DB::table('client_details')->where('Estimator','LIKE','%Barney%')->whereYear('Date','2021')->whereMonth('Date','8')->count();
          $shane_sep=DB::table('client_details')->where('Estimator','LIKE','%Barney%')->whereYear('Date','2021')->whereMonth('Date','9')->count();
          $shane_oct=DB::table('client_details')->where('Estimator','LIKE','%Barney%')->whereYear('Date','2021')->whereMonth('Date','10')->count();
          $shane_nov=DB::table('client_details')->where('Estimator','LIKE','%Barney%')->whereYear('Date','2021')->whereMonth('Date','11')->count();
          $shane_dec=DB::table('client_details')->where('Estimator','LIKE','%Barney%')->whereYear('Date','2021')->whereMonth('Date','12')->count();
     /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   
     //Estimated Time
     $avg_estimated_jan=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','1')->get();
     $avg_estimated_jan_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','1')->count();
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
     $avg_estimated_feb=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','2')->get();
     $avg_estimated_feb_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','2')->count();
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
     $avg_estimated_mar=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','3')->get();
     $avg_estimated_mar_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','3')->count();
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
     $avg_estimated_apr=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','4')->get();
     $avg_estimated_apr_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','4')->count();
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
     $avg_estimated_may=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','5')->get();
     $avg_estimated_may_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','5')->count();
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
     $avg_estimated_jun=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','6')->get();
     $avg_estimated_jun_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','6')->count();
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
     $avg_estimated_jul=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','7')->get();
     $avg_estimated_jul_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','7')->count();
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
     $avg_estimated_aug=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','8')->get();
     $avg_estimated_aug_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','8')->count();
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
     $avg_estimated_sep=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','9')->get();
     $avg_estimated_sep_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','9')->count();
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
     $avg_estimated_oct=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','10')->get();
     $avg_estimated_oct_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','10')->count();
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
     $avg_estimated_nov=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','11')->get();
     $avg_estimated_nov_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','11')->count();
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
     $avg_estimated_dec=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','12')->get();
     $avg_estimated_dec_count=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','12')->count();
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
     $avg_actual_jan=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','1')->whereNotNull('release_date')->get();
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
     $avg_actual_feb=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','2')->whereNotNull('release_date')->get();
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
     $avg_actual_mar=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','3')->whereNotNull('release_date')->get();
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
     $avg_actual_apr=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','4')->whereNotNull('release_date')->get();
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
     $avg_actual_may=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','5')->whereNotNull('release_date')->get();
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
     $avg_actual_jun=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','6')->whereNotNull('release_date')->get();
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
     $avg_actual_jul=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','7')->whereNotNull('release_date')->get();
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
     $avg_actual_aug=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','8')->whereNotNull('release_date')->get();
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
     $avg_actual_sep=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','9')->whereNotNull('release_date')->get();
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
     $avg_actual_oct=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','10')->whereNotNull('release_date')->get();
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
     $avg_actual_nov=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','11')->whereNotNull('release_date')->get();
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
     $avg_actual_dec=DB::table('client_details')->where('status','=','1')->whereYear('dr_date','2021')->whereMonth('dr_date','12')->whereNotNull('release_date')->get();
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

     /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     $convert_auth=DB::table('client_details')
                           ->where('status','=','1')  
                           ->select(DB::raw("count(Key_Ref) as count_auth"),DB::raw('MONTH(Date) as month'))
                           ->whereYear('Date','2021')
                           ->groupBy(DB::raw('MONTH(Date)'))
                           ->get();

        $convert_quoted=DB::table('client_details')
                            ->where('status','=','0') 
                            ->whereYear('Date','2021')
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
         ////////////////////////////////////////
        $date=\Carbon\Carbon::today()->subday(30);
        
        //Prebooking
        $prebooking_alert=DB::table('pre_booking')->where('booking_date1','=','N/A')->orWhere('booking_date2','=','N/A')->orWhere('booking_date3','=','N/A')->orWhere('booking_date4','=','N/A')->count();
        //End Prebooking

        //Passing To View

        
        return view('administrator.administratorkpi',['highest'=>$highest,'lowest'=>$lowest,'count_products'=>$total_products,'auth_total'=>$auth_quotes,'total_quotes'=>$total_quotes,'unauth_total'=>$unauth_quotes,'towed_totals'=>$towed,'jan'=>$jan,'feb'=>$feb,'mar'=>$mar,'apr'=>$apr,'may'=>$may,'jun'=>$jun,'jul'=>$jul,'aus'=>$aus,'sep'=>$sep,'oct'=>$oct,'nov'=>$nov,'dec'=>$dec,'jan_2019'=>$jan_2019,'feb_2019'=>$feb_2019,'mar_2019'=>$mar_2019,'apr_2019'=>$apr_2019,'may_2019'=>$may_2019,'jun_2019'=>$jun_2019,'jul_2019'=>$jul_2019,'aus_2019'=>$aus_2019,'sep_2019'=>$sep_2019,'oct_2019'=>$sep_2019,'nov_2019'=>$nov_2019,'dec_2019'=>$dec_2019,'jan_2018'=>$jan_2018,'feb_2018'=>$feb_2018,'mar_2018'=>$mar_2018,'apr_2018'=>$apr_2018,'may_2018'=>$may_2018,'jun_2018'=>$jun_2018,'jul_2018'=>$jul_2018,'aus_2018'=>$aus_2018,'sep_2018'=>$sep_2018,'oct_2018'=>$sep_2018,'nov_2018'=>$nov_2018,'dec_2018'=>$dec_2018,'total_users'=>$total_users,'total_workshop'=>$workshop_users,'total_admin'=>$admin_users,'total_drivers'=>$driver_users,'total'=>$feedback_total,'happy'=>$total_happy,'unavailable'=>$total_unavailable,'workman'=>$total_workman,'comm'=>$total_comm,'other'=>$total_other,'estimator_per'=>$estimator_per,'estimator_p'=>$array_numbers,'convert_auth'=>$auth_arr,'convert_quoted'=>$quoted_arr,'selby_quote_count'=>$selby_arr,'glen_quote_count'=>$glen_arr,'longmeadow_quote_count'=>$longmeadow_arr,'alfie_jan'=>$alfie_jan,'alfie_feb'=>$alfie_feb,'alfie_mar'=>$alfie_mar,'alfie_apr'=>$alfie_may,'alfie_may'=>$alfie_may,'alfie_jun'=>$alfie_jun,'alfie_jul'=>$alfie_jul,'alfie_aus'=>$alfie_aus,'alfie_sep'=>$alfie_sep,'alfie_oct'=>$alfie_oct,'alfie_nov'=>$alfie_nov,'alfie_dec'=>$alfie_dec,'zahid_jan'=>$zahid_jan,'zahid_feb'=>$zahid_feb,'zahid_mar'=>$zahid_mar,'zahid_apr'=>$zahid_apr,'zahid_may'=>$zahid_may,'zahid_jun'=>$zahid_jun,'zahid_jul'=>$zahid_jul,'zahid_aus'=>$zahid_aus,'zahid_sep'=>$zahid_sep,'zahid_oct'=>$zahid_oct,'zahid_nov'=>$zahid_nov,'zahid_dec'=>$zahid_dec,'walter_jan'=>$walter_jan,'walter_feb'=>$walter_feb,'walter_mar'=>$walter_mar,'walter_apr'=>$walter_apr,'walter_may'=>$walter_may,'walter_jun'=>$walter_jun,'walter_jul'=>$walter_jul,'walter_aus'=>$walter_aus,'walter_sep'=>$walter_sep,'walter_oct'=>$walter_oct,'walter_nov'=>$walter_nov,'walter_dec'=>$walter_dec,'john_jan'=>$john_jan,'john_feb'=>$john_feb,'john_mar'=>$john_mar,'john_apr'=>$john_apr,'john_may'=>$john_may,'john_jun'=>$john_jun,'john_jul'=>$john_jul,'john_aus'=>$john_aus,'john_sep'=>$john_sep,'john_oct'=>$john_oct,'john_nov'=>$john_nov,'john_dec'=>$john_dec,'shane_jan'=>$shane_jan,'shane_feb'=>$shane_feb,'shane_mar'=>$shane_mar,'shane_apr'=>$shane_apr,'shane_may'=>$shane_may,'shane_jun'=>$shane_jun,'shane_jul'=>$shane_jul,'shane_aus'=>$shane_aus,'shane_sep'=>$shane_sep,'shane_oct'=>$shane_oct,'shane_nov'=>$shane_nov,'shane_dec'=>$shane_dec,'avg_jan'=>$avg_jan,'avg_feb'=>$avg_feb,'avg_mar'=>$avg_mar,'avg_apr'=>$avg_apr,'avg_may'=>$avg_may,'avg_jun'=>$avg_jun,'avg_jul'=>$avg_jul,'avg_aug'=>$avg_aug,'avg_sep'=>$avg_sep,'avg_oct'=>$avg_oct,'avg_nov'=>$avg_nov,'avg_dec'=>$avg_dec,'avg_act_jan'=>$avg_act_jan,'avg_act_feb'=>$avg_act_feb,'avg_act_mar'=>$avg_act_mar,'avg_act_apr'=>$avg_act_apr,'avg_act_may'=>$avg_act_may,'avg_act_jun'=>$avg_act_jun,'avg_act_jul'=>$avg_act_jul,'avg_act_aug'=>$avg_act_aug,'avg_act_sep'=>$avg_act_sep,'avg_act_oct'=>$avg_act_oct,'avg_act_nov'=>$avg_act_nov,'avg_act_dec'=>$avg_act_dec]);
    }

    public function users(){

        
        $levels=DB::table('user_type')->get();
        $department=DB::table('list_department')->get();
        $users=DB::table('user')
                    ->leftjoin('list_department','user.dept_key','=','list_department.dept_key')
                    ->leftjoin('user_type','user.userLevel','=','user_Type.userLevel')
                    ->where('user.use_username','<>','')
                    ->orderBy('user.use_username')
                    ->get();
        return view('administrator.user',['users'=>$users,'levels'=>$levels,'departments'=>$department]);            
    }

    public function user_delete($id){
        DB::table('user')->where('use_key','=',$id)->delete();
        return back()->with(['message'=>'User Deleted Successfully.']);
    }

    public function ais_credits(Request $request){
        $total=0;
        $id=$request->credit_id;
        $add=$request->credit_add;
        $curr=$request->credit_current;
        $total=$add+$curr;
        DB::table('branch')
                ->where('id','=',$id)
                ->update(['branch_credits'=>$total]);
         
        return back()->with(['message'=>'Credits Added Successfully.']);        
    }   

    public function create_user(Request $request){
        $pin=md5($request->create_pin);
        $company=$request->create_comp_code;
        $name=$request->create_name;
        $department=$request->create_department;
        $from_name=$request->create_from;
        $email=$request->create_email;
        $cell=$request->create_cell;
        $level=$request->create_level;

        DB::table('user')->insert([['use_username'=>$name,'use_password'=>$pin,'user_fromname'=>$from_name,'user_email'=>$email,'dept_key'=>$department,'user_cell'=>$cell,'userLevel'=>$level,'otp'=>'njggu']]);
        return back()->with(['message'=>'User Added Successfully.']);
    }

    public function search_pin(){
        $result='';
        $pin1='';
        do{
        $pin1 = str_pad(mt_rand(1,9999),4,'0',STR_PAD_LEFT);
        $pin = md5($pin1);
        $sql = "select distinct * from user where use_password = '$pin'";
        $result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));
        }
        while($result->num_rows >0);
        if($result->num_rows == 0){
            echo $pin1;
        }
    }

    public function create_branch(Request $request){
        $inv_no=$request->ais_invoice_no;
        $name="MAG ";
        $name.=$request->ais_branch_name;
        $code=$request->ais_branch_code;
        $contact=$request->ais_branch_contact;
        $email=$request->ais_branch_email;
        $credits=$request->ais_branch_credits;
        $price=$request->ais_branch_price;
        $date=date('Y-m-d');

        DB::table('branch')->insert([['invoice_no'=>$inv_no,'branch_name'=>$name,'branch_code'=>$code,'branch_contact'=>$contact,'branch_email'=>$email,'branch_credits'=>$credits,'credit_price'=>$price,'status'=>'1','date_modified'=>$date]]);
        return back()->with(['message'=>'AIS Branch Created Successfully.']);
    }

    public function edit_user(Request $request){
        $id=$request->edit_id;
        $pin=md5($request->edit_pin);
        $name=$request->edit_name;
        $email=$request->edit_email;
        $cell=$request->edit_cell;
        DB::table('user')
        ->where('use_key','=',$id)
        ->update(['use_username'=>$name,'user_cell'=>$cell,'user_email'=>$email]);
        return back()->with(['message'=>'User Edited Successfully.']);
    }

    public function billing(){
        $billing=DB::select('select * from branch order by id asc limit 0,5');

        return view('administrator.billing',['billing'=>$billing]);
    }

    public function ais_user(){
        $users=DB::table('users')->get();
        $branches=DB::table('branch')->get();
        return view('administrator.ais_users',['users'=>$users,'branches'=>$branches]);
    }

    public function ais_user_delete($id){
        DB::table('users')->where('id','=',$id)->delete();
        return back()->with(['message'=>'A.I.S User Deleted Successfully.']);
    }

    public function ais_create_user(Request $request){
        $username=$request->ais_username;
        $email=$request->ais_email;
        $password=bcrypt($request->ais_password);
        $com=$request->ais_comp_code;
        $quote=$request->ais_quote;
        $customer=$request->ais_customer;
        $consumer=$request->ais_consumer;
        $line=$request->ais_line;
        $creditor=$request->ais_creditor;
        $costing=$request->ais_costing;
        $department=$request->ais_depart;
        $final=$request->ais_final;
        $sign=$request->ais_sign;
        $auth=$request->ais_auth;
        $close=$request->ais_close;
        
        DB::table('users')->insert([['username'=>$username,'password'=>$password,'email'=>$email,'comp_code'=>$com,'position'=>$department,'admin'=>'0','quote'=>$quote,'consumerable'=>$consumer,'customer_care'=>$customer,'line_manager'=>$line,'costing'=>$costing,'creditors'=>$creditor,'final_stage'=>$final,'sign'=>$sign,'authorize'=>$auth,'close'=>$close]]);
        return back()->with(['message'=>'User Added Successfully.']);
    }

    public function ais_edit_user(Request $request){
        $id=$request->ais_id;
        $username=$request->ais_username_edit;
        $email=$request->ais_email_edit;
        $password=bcrypt($request->ais_password_edit);
        $com=$request->ais_comp_code_edit;
        $quote=$request->ais_quote_edit;
        $customer=$request->ais_customer_edit;
        $consumer=$request->ais_consumer_edit;
        $line=$request->ais_line_edit;
        $costing=$request->ais_costing_edit;
        $creditor=$request->ais_creditor_edit;
        $department=$request->ais_depart_edit;
        $final=$request->ais_final_edit;
        $auth=$request->ais_authorize_edit;
        $sign=$request->ais_sign_edit;
        $close=$request->ais_close_edit;
        
        DB::table('users')
        ->where('id','=',$id)
        ->update(['username'=>$username,'password'=>$password,'email'=>$email,'comp_code'=>$com,'position'=>$department,'quote'=>$quote,'consumerable'=>$consumer,'customer_care'=>$customer,'line_manager'=>$line,'costing'=>$costing,'creditors'=>$creditor,'final_stage'=>$final,'sign'=>$sign,'authorize'=>$auth,'close'=>$close]);
        return back()->with(['message'=>'AIS User Edited Successfully.']);

    }
    
    public function ais_account_settings(Request $request){
        $id=$request->id;
        $status=$request->status;
        if($status==1){
           $changed=0;
        }elseif ($status==0) {
           $changed=1; 
        }

        DB::table('branch')
                ->where('id','=',$id)
                ->update(['status'=>$changed]);
                return back()->with(['message'=>'Account Status Successfully Changed.']);        
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

    public function statement(Request $request){
        $ids=$request->id;
        $start=$request->start;
        $end=$request->end;
        $branch=DB::table('branch')->where('id','=',$ids)->get();
        $branch_inv=DB::table('branch_invoice')->where('branch_id','=',$ids)->whereBetween('date_invoiced',[$start,$end])->get();
        $pdf=PDF::loadview('pdf.statement',['branch_invoice'=>$branch_inv,'branch'=>$branch]);
        return $pdf->stream('AIS-Statement.pdf');
    }

    public function sla_ratings(){
        $brokers=DB::table('broker_table')->orderBy('broker','asc')->get();
        return view('administrator.sla_rating',['brokers'=>$brokers]);
    }

    public function sla_ratings_edit($id){
        $brokers=DB::table('broker_table')->where('id','=',$id)->get();
        $broker_name='';
        foreach($brokers as $broke){
            $broker_name=$broke->broker;
        }
        return view('administrator.sla_ratings_edit',['brokers'=>$brokers,'name'=>$broker_name]);
    }

    public function covid_register(){
        $users=DB::select("select distinct * from user u left join list_department ld on u.dept_key=ld.dept_key"
        ." left join covid_register covid on u.use_key=covid.userId"
        . " left join user_type ut on u.userLevel = ut.userLevel where use_username<>'' order by use_username");
        return view('administrator.covid_register',['users'=>$users]);
    }

    

}
