<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class LineManagerController extends Controller
{
    public function index(){
        //Get User Permissions
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $total_users=DB::table('user')->count();
        $admin_users=DB::table('user')->where('use_username','LIKE','%'.'Admin'.'%')->count();
        $driver_users=DB::table('user')->where('use_username','LIKE','%'.'Driver'.'%')->count();
        $workshop_users=$total_users-($admin_users+$driver_users);
        
        return view('linemanager.linemanagerkpi',['total_users'=>$total_users,'total_workshop'=>$workshop_users,'total_admin'=>$admin_users,'total_drivers'=>$driver_users]);

    }

    public function timesheet(){
        
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
        //Query
        $employee_detail=DB::table('user')->select('use_username','user_cell','userLevel')->get();
        return view('linemanager.timesheet',['employees'=>$employee_detail,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
    }

    public function general(Request $request){
        //Get User Permissions
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;

        $id=$request->general_id;
        $from=$request->general_from;
        $to=$request->general_to;
        $tbod='';
        $work_details=DB::table('cleaning')
                            ->where('user','=',$id)
                            ->whereBetween('datetime',[$from,$to])
                            ->distinct('places')
                            ->get();
        $array_endtime=array();
        $count=1; 
      foreach($work_details as $end){
          $endtime=DB::table('cleaning')->select('datetime')->where('id','>',$end->id)->where('user','=',$end->user)->min('datetime');
          $time_spent=abs(strtotime($end->datetime) - strtotime($endtime))/3600;
          $time_remind=(number_format(0.50-$time_spent,2));  
          $tbod.='<tr><td>'.$count.'</td><td>'.$end->user.'</td><td>'.$end->place.'</td><td>'.$end->datetime.'</td><td>'.$endtime.'</td><td>'.number_format($time_spent,2).'<b> Hours</b></td><td>'.$time_remind.' <b>Hours</b></td></tr>';
          $count++;
      }
        
        
       return view('linemanager.general',['table'=>$tbod]);  
    }


    public function workshop(Request $request){
        //Get User Permissions
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;

        $id=$request->workshop_id;
        $from=$request->workshop_from;
        $to=$request->workshop_to;
        $tbod='';
        $array_endtime=array();
        $work_details=DB::table('workshop')
                            ->where('user','=',$id)
                            ->whereBetween('datetime',[$from,$to])
                            ->distinct('user','Key_Ref')
                            ->get();
        
       $count=1; 
      foreach($work_details as $end){
          $endtime=DB::table('workshop')->select('datetime')->where('id','>',$end->id)->where('user','=',$end->user)->min('datetime');
          $time_spent=abs(strtotime($end->datetime) - strtotime($endtime))/3600;
          $time_remind=(number_format(3.00-$time_spent,2));
          $tbod.='<tr><td>'.$count.'</td><td>'.$end->user.'</td><td>'.$end->Key_Ref.'</td><td>'.$end->datetime.'</td><td>'.$endtime.'</td><td>'.number_format($time_spent,2).'<b> Hours</b></td><td>'.$time_remind.' <b>Hours</b></td></tr>';
          $count++;
      }
        
        
       return view('linemanager.workshop',['work_details'=>$work_details,'user'=>$id,'end_time'=>$array_endtime,'table_workshop'=>$tbod]);  
    }


    public function labor(){
        //Customer Dashboard 
         $position=Auth::user()->position;
         $admin=Auth::user()->admin;
         $quote=Auth::user()->quote;
         $consumable=Auth::user()->consumerable;
         $customer=Auth::user()->customer_care;
         $line_manager=Auth::user()->line_manager;
         $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $jobs=DB::table('qoutes')->select('Key_Ref')->distinct('Key_Ref')->orderBy('id','desc')->limit(500)->get();
        return view('linemanager.laboranalysis',['jobs'=>$jobs,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
    }



    public function view_labour($key_ref){
        //Labour Analysis Variables
        $stripz = 0;
        $panelz = 0;
        $paintz = 0;
        $assemblyz = 0;
        $mechanicz = 0;
        $outz = 0;
        $elecz = 0;
        $clnn = 0;


        //Get User Permissions
         $position=Auth::user()->position;
         $admin=Auth::user()->admin;
         $quote=Auth::user()->quote;
         $consumable=Auth::user()->consumerable;
         $customer=Auth::user()->customer_care;
         $line_manager=Auth::user()->line_manager;
         $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing; 
        $final=Auth::user()->final_stage;   

         //Get Paint Sundries Info
        $consumerables=DB::table('stock_history')->where('Key_Ref','=',$key_ref)->get();
        $paintTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Paint');
        $paintRate=DB::table('insurer')->select('Paint')->where('Key_Ref','=',$key_ref)->get();
        $consus=DB::table('insurer')->select('PaintSup')->where('Key_Ref','=',$key_ref)->get();
        $paint_rate_qt=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();

        //Get Sundries Info
        $qt_sundries=DB::table('qoutes')
                            ->join('insurer','qoutes.Key_Ref','=','insurer.Key_Ref')
                            ->where('qoutes.Key_Ref','=',$key_ref)
                            ->select('qoutes.Quantity','qoutes.Part','qoutes.Percent','insurer.ShopSup')
                            ->get();

        //Get Labour Analsis Info
        $la_analysis=DB::table('insurer')->where('Key_Ref','=',$key_ref)->get();

        //Get Labour Analysis Quotation
        $la_qt=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();    
        
        //Get Laboour Analysis Electrical Work
        $la_qt_elect=DB::table('qoutes')
                            ->where('Key_Ref','=',$key_ref)
                            ->where('Oper','=','Custom Elect')
                            ->orWhere('Oper','=','Custom Sound')
                            ->orWhere('Oper','=','Inhse Elec Rep')
                            ->orWhere('Oper','=','Electrical Rep')
                            ->get();
        
        //Get Labour Analysis Misc
        $la_qt_out=DB::table('qoutes')
                            ->where('Key_Ref','=',$key_ref) 
                            ->where('Misc','>',0)
                            ->get();

        //Get Labour Anaylsis Panel                    
        foreach($la_qt as $la_quotes){
            $stripz=$la_quotes->Strip;
            if($la_quotes->Oper!="Mechanical"){
                $panelz+=$la_quotes->Labour;
            }else{
                $mechanicz+=$la_quotes->Labour;
            }
            if($la_quotes->Oper=="In Hse Jig"){
                $panell="";
            }
            
        }

        //end of Query

        //Tesing Query
        $quotation_info=$this->getQuoted($key_ref);
        $time_array=$this->passRate($key_ref);                    
        return view('linemanager.laborview',['time'=>$time,'quotation_test'=>$quotation_info,'sundry_info'=>$qt_sundries,'consus'=>$consus,'consumerables'=>$consumerables,'paintTotal'=>$paintTotal,'paintRate'=>$paintRate,'rate_paint'=>$paint_rate_qt,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
    }

   
 public function getQuoted($key_ref){
            $stripz = 0;
            $panelz = 0;
            $paintz = 0;
            $assemblyz = 0;
            $mechanicz = 0;
            $outz = 0;
            $elecz = 0;
            $clnn = 0;

            $resz=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();

            foreach($resz as $row){
                $stripz += $row->Strip;
                if($row->Oper!='Mechanical'){
                    $panelz += $row->Labour;
                }else{
                    $mechanicz += $row->Labour;
                }
                if($row->Oper=='In Hse Jig') {
                    $panelz +=$this->getRate($ref, $row->Misc);
                } 
                if($row->Oper=='Valet') {
                    $clnn += $this->getRate($ref, $row->Misc);
                }  
                $panelz += $row->Frame;
                $paintz += $row->Paint;
            }


            foreach($resz as $row) {
                $stripz += $row->Strip;
                if($row->Oper!='Mechanical'){
                    $panelz += $row->Labour;
                }else{
                    $mechanicz += $row->Labour;
                }
                if($row->Oper=='In Hse Jig') {
                    $panelz += $this->getRate($ref, $row->Misc);
                } 
                if($row->Oper=='Valet') {
                    $clnn += $this->getRate($ref, $row->Misc);
                }  
                $panelz += $row->Frame;
                $paintz += $row->Paint;
            }
            $resz5=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->where('Oper','=','Cutom Elect')->orWhere('Oper','=','Custom Sound')->orWhere('Oper','=','Inhse Elec Rep')->orWhere('Oper','=','Electrical Rep')->get();
            foreach($resz5 as $row){
                if($row->Oper=='Custom Elec'||$row->Oper=='Custom Sound'||$row->Oper=='Inhse Elec Rep'||$row->Oper=='Electrical Rep'){
                    $elecz=$row->Labour;    
                }
            }
           $resz6=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->where('Misc','>',0)->get();
            foreach($resz6 as $row){
                $outz+=$this->getRate($key_ref, $row->Misc);
            }
              return array('strp' => ($stripz), 'pnel' => ($panelz), 'pnt' => ($paintz- $this->getPolishTime($key_ref)),
                'ass' => ($assemblyz), 'mech' => ($mechanicz),'out' => ($outz+$elecz));
 }

     public function getRemainingTime($start, $end)
            {
                // Declare and define two dates
                $date1 = strtotime($start);
                $date2 = strtotime($end);

                // Formulate the Difference between two dates
                $diff = abs($date2 - $date1);

                return $diff;
            }

     public function passRate($key_ref){
                 //Labor View Please Improve At A Later Staged
        $stripp = array();
        $panell = array();
        $paintt = array();
        $mechanicc = array();
        $cleann = array();
        $polishh = array();
        $elecc = array();
        $outt = array();
        $strp = 0;
        $pnel = 0;
        $pnt = 0;
        $assmb = 0;
        $mech = 0;
        $clean = 0;
        $polish = 0;
        $elec = 0;
        $out = 0; 

        //Strip
        $res=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$key_ref)->where('stage','=','7')->orWhere('stage','=','11')->orderBy('datetime','asc')->get();
        $res_count=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$key_ref)->where('stage','=','7')->orWhere('stage','=','11')->count();
        if($res_count>0){
            foreach($res as $row){
                $usa=$row->user;
                $rec=array();
                $logtime=$row->datetime;
                $date=substr($row->datetime,0,10);
                $dated=$date.' 17:00:00';
                $spent=0;
                $wewant='';
                $wewant1='';
                $wewant2='';
                $wewant3='';
                $avail=array();
                $ress=DB::table('cleaning')->distinct('datetime')->where('DATETIME','=',$logtime)->where('USER','=',$usa)->get();
                $ress_count=DB::table('cleaning')->distinct('datetime')->where('DATETIME','=',$logtime)->where('USER','=',$usa)->count();
                $ress1=DB::table('workshop')->distinct('datetime')->where('DATETIME','=',$logtime)->where('Key_Ref','=',$key_ref)->where('USER','=',$usa)->limit(1)->get();
                $ress1_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','=',$logtime)->where('Key_Ref','=',$key_ref)->where('USER','=',$usa)->count();
                $ress2=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->limit(1)->get();
                $ress2_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->limit(1)->count();

                if($ress_count>0){
                    foreach($ress as $roww){
                        $wewant1=$roww->datetime;
                    }
                    array_push($avail,($wewant1));
                }
                if($ress1_count>0){
                    foreach($ress1 as $roww){
                        $wewant2=$roww->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if($ress2_count>0){
                    foreach($ress2 as $roww){
                        $wewant3=$roww->datetime;
                    }
                    array_push($avail,($wewant3));
                }
                if(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))>strtotime($date . ' 17:00:00'))){
                    $wewant = $dated;
                }elseif(count($avail)>=1){
                    $wewant = min($avail);
                }
                if (strtotime(substr($wewant, 0, 10)) == strtotime($date)) {
                    $spent = $this->getRemainingTime($logtime, $wewant) / 3600;
        
                } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                    $spent = $this->getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                    $wewant =$date . ' 17:00:00'; 
                }
                    array_push($stripp, $spent);
            }     
            $strp = array_sum($stripp);
    
        }

        //End Strip

        //Paint
        $res1=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$key_ref)->where('stage','=','9')->orWhere('stage','=','31')->orWhere('stage','=','32')->orderBy('datetime','asc')->get();
        $res1_count=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$key_ref)->where('stage','=','9')->orWhere('stage','=','31')->orWhere('stage','=','32')->count();
       
        if($res1_count>0){
            foreach($res1 as $row){
                $usa=$row->user;
                $rec=array();
                $logtime=$row->datetime;
                $date=substr($row->datetime,0,10);
                $dated=$date.' 17:00:00';
                $spent=0;
                $wewant='';
                $wewant1='';
                $wewant2='';
                $wewant3='';
                $avail=array();
                $ress=DB::table('cleaning')->distinct('datetime')->where('DATETIME','=',$logtime)->where('USER','=',$usa)->get();
                $ress_count=DB::table('cleaning')->distinct('datetime')->where('DATETIME','=',$logtime)->where('USER','=',$usa)->count();
                $ress1=DB::table('workshop')->distinct('datetime')->where('DATETIME','=',$logtime)->where('Key_Ref','=',$key_ref)->where('USER','=',$usa)->limit(1)->get();
                $ress1_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','=',$logtime)->where('Key_Ref','=',$key_ref)->where('USER','=',$usa)->count();
                $ress2=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->limit(1)->get();
                $ress2_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->limit(1)->count();

                if($ress_count>0){
                    foreach($ress as $roww){
                        $wewant1=$roww->datetime;
                    }
                    array_push($avail,($wewant1));
                }
                if($ress1_count>0){
                    foreach($ress1 as $roww){
                        $wewant2=$roww->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if($ress2_count>0){
                    foreach($ress2 as $roww){
                        $wewant3=$roww->datetime;
                    }
                    array_push($avail,($wewant3));
                }
                if(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))>strtotime($date . ' 17:00:00'))){
                    $wewant = $dated;
                }elseif(count($avail)>=1){
                    $wewant = min($avail);
                }
                if (strtotime(substr($wewant, 0, 10)) == strtotime($date)) {
                    $spent = getRemainingTime($logtime, $wewant) / 3600;
        
                } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                    $spent = getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                    $wewant =$date . ' 17:00:00'; 
                }
                array_push($panell, $spent);
                $pnel=array_sum($panell);
            }     
            $strp = array_sum($stripp);
    
        }        


        //End Paint

        //Mechanic
        $res4=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$key_ref)->where('stage','=','8')->orderBy('datetime','asc')->get();
        $res4_count=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$key_ref)->where('stage','=','8')->count();
        if($res4_count>0){
            foreach($res4 as $row){
                $usa=$row->user;
                $rec=array();
                $logtime=$row->datetime;
                $date=substr($row->datetime,0,10);
                $dated=$date.' 17:00:00';
                $spent=0;
                $wewant='';
                $wewant1='';
                $wewant2='';
                $wewant3='';
                $avail=array();
                $ress=DB::table('cleaning')->distinct('datetime')->where('DATETIME','=',$logtime)->where('USER','=',$usa)->get();
                $ress_count=DB::table('cleaning')->distinct('datetime')->where('DATETIME','=',$logtime)->where('USER','=',$usa)->count();
                $ress1=DB::table('workshop')->distinct('datetime')->where('DATETIME','=',$logtime)->where('Key_Ref','=',$key_ref)->where('USER','=',$usa)->limit(1)->get();
                $ress1_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','=',$logtime)->where('Key_Ref','=',$key_ref)->where('USER','=',$usa)->count();
                $ress2=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->limit(1)->get();
                $ress2_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->limit(1)->count();

                if($ress_count>0){
                    foreach($ress as $roww){
                        $wewant1=$roww->datetime;
                    }
                    array_push($avail,($wewant1));
                }
                if($ress1_count>0){
                    foreach($ress1 as $roww){
                        $wewant2=$roww->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if($ress2_count>0){
                    foreach($ress2 as $roww){
                        $wewant3=$roww->datetime;
                    }
                    array_push($avail,($wewant3));
                }
                if(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))>strtotime($date . ' 17:00:00'))){
                    $wewant = $dated;
                }elseif(count($avail)>=1){
                    $wewant = min($avail);
                }
                if (strtotime(substr($wewant, 0, 10)) == strtotime($date)) {
                    $spent = getRemainingTime($logtime, $wewant) / 3600;
        
                } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                    $spent = getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                    $wewant =$date . ' 17:00:00'; 
                }
                    array_push($mechanicc, $spent);
            }     
            $mech = array_sum($mechanicc);
    
        }
        //End Mechanic

        //Cleaning
        $res5=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$key_ref)->where('stage','=','14')->orderBy('datetime','asc')->get();
        $res5_count=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$key_ref)->where('stage','=','14')->count();
        if($res5_count>0){
            foreach($res5 as $row){
                $usa=$row->user;
                $rec=array();
                $logtime=$row->datetime;
                $date=substr($row->datetime,0,10);
                $dated=$date.' 17:00:00';
                $spent=0;
                $wewant='';
                $wewant1='';
                $wewant2='';
                $wewant3='';
                $avail=array();
                $ress=DB::table('cleaning')->distinct('datetime')->where('DATETIME','=',$logtime)->where('USER','=',$usa)->get();
                $ress_count=DB::table('cleaning')->distinct('datetime')->where('DATETIME','=',$logtime)->where('USER','=',$usa)->count();
                $ress1=DB::table('workshop')->distinct('datetime')->where('DATETIME','=',$logtime)->where('Key_Ref','=',$key_ref)->where('USER','=',$usa)->limit(1)->get();
                $ress1_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','=',$logtime)->where('Key_Ref','=',$key_ref)->where('USER','=',$usa)->count();
                $ress2=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->limit(1)->get();
                $ress2_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->limit(1)->count();

                if($ress_count>0){
                    foreach($ress as $roww){
                        $wewant1=$roww->datetime;
                    }
                    array_push($avail,($wewant1));
                }
                if($ress1_count>0){
                    foreach($ress1 as $roww){
                        $wewant2=$roww->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if($ress2_count>0){
                    foreach($ress2 as $roww){
                        $wewant3=$roww->datetime;
                    }
                    array_push($avail,($wewant3));
                }
                if(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))>strtotime($date . ' 17:00:00'))){
                    $wewant = $dated;
                }elseif(count($avail)>=1){
                    $wewant = min($avail);
                }
                if (strtotime(substr($wewant, 0, 10)) == strtotime($date)) {
                    $spent = $this->getRemainingTime($logtime, $wewant) / 3600;
        
                } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                    $spent = $this->getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                    $wewant =$date . ' 17:00:00'; 
                }
                    array_push($cleann, $spent);
            }     
            $clean = array_sum($cleann);
    
        }
        //End Cleaning
        //Polish
        $res6=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$key_ref)->where('stage','=','25')->orderBy('datetime','asc')->get();
        $res6_count=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$key_ref)->where('stage','=','25')->count();
        if($res6_count>0){
            foreach($res6 as $row){
                $usa=$row->user;
                $rec=array();
                $logtime=$row->datetime;
                $date=substr($row->datetime,0,10);
                $dated=$date.' 17:00:00';
                $spent=0;
                $wewant='';
                $wewant1='';
                $wewant2='';
                $wewant3='';
                $avail=array();
                $ress=DB::table('cleaning')->distinct('datetime')->where('DATETIME','=',$logtime)->where('USER','=',$usa)->get();
                $ress_count=DB::table('cleaning')->distinct('datetime')->where('DATETIME','=',$logtime)->where('USER','=',$usa)->count();
                $ress1=DB::table('workshop')->distinct('datetime')->where('DATETIME','=',$logtime)->where('Key_Ref','=',$key_ref)->where('USER','=',$usa)->limit(1)->get();
                $ress1_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','=',$logtime)->where('Key_Ref','=',$key_ref)->where('USER','=',$usa)->count();
                $ress2=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->limit(1)->get();
                $ress2_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->limit(1)->count();

                if($ress_count>0){
                    foreach($ress as $roww){
                        $wewant1=$roww->datetime;
                    }
                    array_push($avail,($wewant1));
                }
                if($ress1_count>0){
                    foreach($ress1 as $roww){
                        $wewant2=$roww->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if($ress2_count>0){
                    foreach($ress2 as $roww){
                        $wewant3=$roww->datetime;
                    }
                    array_push($avail,($wewant3));
                }
                if(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))>strtotime($date . ' 17:00:00'))){
                    $wewant = $dated;
                }elseif(count($avail)>=1){
                    $wewant = min($avail);
                }
                if (strtotime(substr($wewant, 0, 10)) == strtotime($date)) {
                    $spent = $this->getRemainingTime($logtime, $wewant) / 3600;
        
                } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                    $spent = $this->getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                    $wewant =$date . ' 17:00:00'; 
                }
                    array_push($polishh, $spent);
            }     
            $strp = array_sum($polishh);
    
        }
        //End Polish
        //Electrical
        $res7=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$key_ref)->where('stage','=','30')->orderBy('datetime','asc')->get();
        $res7_count=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$key_ref)->where('stage','=','30')->count();
        if($res7_count>0){
            foreach($res7 as $row){
                $usa=$row->user;
                $rec=array();
                $logtime=$row->datetime;
                $date=substr($row->datetime,0,10);
                $dated=$date.' 17:00:00';
                $spent=0;
                $wewant='';
                $wewant1='';
                $wewant2='';
                $wewant3='';
                $avail=array();
                $ress=DB::table('cleaning')->distinct('datetime')->where('DATETIME','=',$logtime)->where('USER','=',$usa)->get();
                $ress_count=DB::table('cleaning')->distinct('datetime')->where('DATETIME','=',$logtime)->where('USER','=',$usa)->count();
                $ress1=DB::table('workshop')->distinct('datetime')->where('DATETIME','=',$logtime)->where('Key_Ref','=',$key_ref)->where('USER','=',$usa)->limit(1)->get();
                $ress1_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','=',$logtime)->where('Key_Ref','=',$key_ref)->where('USER','=',$usa)->count();
                $ress2=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->limit(1)->get();
                $ress2_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->limit(1)->count();

                if($ress_count>0){
                    foreach($ress as $roww){
                        $wewant1=$roww->datetime;
                    }
                    array_push($avail,($wewant1));
                }
                if($ress1_count>0){
                    foreach($ress1 as $roww){
                        $wewant2=$roww->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if($ress2_count>0){
                    foreach($ress2 as $roww){
                        $wewant3=$roww->datetime;
                    }
                    array_push($avail,($wewant3));
                }
                if(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))>strtotime($date . ' 17:00:00'))){
                    $wewant = $dated;
                }elseif(count($avail)>=1){
                    $wewant = min($avail);
                }
                if (strtotime(substr($wewant, 0, 10)) == strtotime($date)) {
                    $spent = $this->getRemainingTime($logtime, $wewant) / 3600;
        
                } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                    $spent = $this->getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                    $wewant =$date . ' 17:00:00'; 
                }
                    array_push($elecc, $spent);
            }     
            $elec = array_sum($elecc);
    
        }
        //End Electrical
        //Out
        $res8=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$key_ref)->where('stage','=','31')->orWhere('stage','=','13')->orderBy('datetime','asc')->get();
        $res8_count=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$key_ref)->where('stage','=','31')->orWhere('stage','=','13')->count();
        if($res8_count>0){
            foreach($res8 as $row){
                $usa=$row->user;
                $rec=array();
                $logtime=$row->datetime;
                $date=substr($row->datetime,0,10);
                $dated=$date.' 17:00:00';
                $spent=0;
                $wewant='';
                $wewant1='';
                $wewant2='';
                $wewant3='';
                $avail=array();
                $ress=DB::table('cleaning')->distinct('datetime')->where('DATETIME','=',$logtime)->where('USER','=',$usa)->get();
                $ress_count=DB::table('cleaning')->distinct('datetime')->where('DATETIME','=',$logtime)->where('USER','=',$usa)->count();
                $ress1=DB::table('workshop')->distinct('datetime')->where('DATETIME','=',$logtime)->where('Key_Ref','=',$key_ref)->where('USER','=',$usa)->limit(1)->get();
                $ress1_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','=',$logtime)->where('Key_Ref','=',$key_ref)->where('USER','=',$usa)->count();
                $ress2=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->limit(1)->get();
                $ress2_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->limit(1)->count();

                if($ress_count>0){
                    foreach($ress as $roww){
                        $wewant1=$roww->datetime;
                    }
                    array_push($avail,($wewant1));
                }
                if($ress1_count>0){
                    foreach($ress1 as $roww){
                        $wewant2=$roww->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if($ress2_count>0){
                    foreach($ress2 as $roww){
                        $wewant3=$roww->datetime;
                    }
                    array_push($avail,($wewant3));
                }
                if(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))>strtotime($date . ' 17:00:00'))){
                    $wewant = $dated;
                }elseif(count($avail)>=1){
                    $wewant = min($avail);
                }
                if (strtotime(substr($wewant, 0, 10)) == strtotime($date)) {
                    $spent = $this->getRemainingTime($logtime, $wewant) / 3600;
        
                } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                    $spent = $this->getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                    $wewant =$date . ' 17:00:00'; 
                }
                    array_push($outt, $spent);
            }     
            $out = array_sum($outt);
    
        }
        //End Out
        //This Nonesense Ends Herr
        return array('strp' => ($strp), 'pnel' => ($pnel), 'pnt' => ($pnt),
        'ass' => ($assmb), 'mech' => ($mech),
        'cln' => ($clean), 'pol' => ($polish), 'out' => ($out)+($elec));
}
    
    public function sms_customer($key_ref){
        //Get User Permissions
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $stage=19;
        $sms=DB::table("sms_event")->select('*')
                           ->whereNotIn('title',function($query){
                            $query->select('title')->from('sms_eventlog')->where('Key_Ref','=','.$key_ref.')->where('stage_no','=','.$stage.')->where('status','<>','0');
                            })
                            ->where('stage_no','=',$stage)
                            ->orderBy('title','asc')
                            ->get();

        $sms_event=DB::table('sms_eventlog')->join('stages','sms_eventlog.stage_no','=','stages.No')->where('sms_eventlog.Key_Ref','=',$key_ref)->where('sms_eventlog.stage_no','=',$stage)->orderBy('stages.No','asc')->get();                    
        return view('linemanager.sms',['key'=>$key_ref,'sms'=>$sms,'client_sms'=>$sms_event,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);


    }

    public function line_manager_notes($key_ref){
        //Get User Permissions
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;

        $notes=DB::table('notes')->where('Key_Ref','=',$key_ref)->get();    
        $smses=DB::table('sms_eventlog')->where('Key_Ref','=',$key_ref)->get();

        return view('linemanager.notes',['notes'=>$notes,'smses'=>$smses,'keys'=>$key_ref,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
    }

    public function getRate($key_ref, $amount)
    {
        $rate = 0;
        $res=DB::table('insurer')->select('labour')->where('Key_Ref','=',$key_ref)->get();
        $res_count=DB::table('insurer')->select('labour')->where('Key_Ref','=',$key_ref)->count();
        foreach($res as $ress){
            $rate=($amount/$ress->labour);
        }
        
        return $rate;
    }

    public function getPolishTime($key_ref){
        $time = 0;
        $res=DB::table('qoutes')->select('paint')->where('Key_Ref','=',$key_ref)->where('paint','>',0)->get();
        foreach($res as $ress){
            $time+=1/3;
        }
        return $time;
    }

    public function line_manager_photos($id){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;

        $key_ref=$id;
        $pics=DB::table('track_photos')->where('Key_Ref','=',$key_ref)->get();   
        return view('linemanager.photo',['images'=>$pics,'id'=>$key_ref,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
    }

    public function line_manager_upload(Request $request){
        
       
        $key_ref=$request->ref;
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;

        $title=$request->title;
        $path='images/mag_photos/';
        $path.=$key_ref;
        $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
        $image=$input['image'];
        $request->image->move(public_path($path), $input['image']);
        

        DB::table('track_photos')->insert([
            ['Key_Ref'=>$key_ref,'picture_name'=>$image,'picture_comment'=>'']
        ]);
        $pics=DB::table('track_photos')->where('Key_Ref','=',$key_ref)->get();    
        return back()->with(['message'=>'Image Uploaded Successfully']);
        //return view('linemanager.photo',['images'=>$pics,'id'=>$key_ref,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position]);
    }

    public function line_manager_upload_photo_additional(Request $request){
        $key_ref=$request->ref;
        $title=$request->title;
        $path='images/mag_photos/';
        $path.=$key_ref;
        $image='additional-';
        $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
        $image.=$input['image'];
        $request->image->move(public_path($path), $image);
        DB::table('track_photos')->insert([
            ['Key_Ref'=>$key_ref,'picture_name'=>$image,'picture_comment'=>'','category'=>'ADDITIONAL']
        ]);
        return back()->with(['message'=>'Additional Image Uploaded Successfully']);
    }

    public function line_manager_upload_photo_wip(Request $request){
        $key_ref=$request->ref;
        $title=$request->title;
        $path='images/mag_photos/';
        $path.=$key_ref;
        $image='WIP-';
        $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
        $image.=$input['image'];
        $request->image->move(public_path($path), $image);
        DB::table('track_photos')->insert([
            ['Key_Ref'=>$key_ref,'picture_name'=>$image,'picture_comment'=>'','category'=>'Work In Progress']
        ]);
        return back()->with(['message'=>'Work In Progress Image Uploaded Successfully']);
    }

    public function line_manger_delete_photo($id){

        DB::table('track_photos')->where('id','=',$id)->delete();
        return back()->with(['message'=>'Image Deleted Successfully']);
        
    }

    public function line_manager_docs($id){
        $key_ref=$id;
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $document=DB::table('document')->where('Key_Ref','=',$key_ref)->get();
        $doc_types=DB::table('docs_description')->get();
        return view('linemanager.docs',['documents'=>$document,'doc_types'=>$doc_types,'id'=>$key_ref,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
    }

    public function line_manager_docs_upload(Request $request){
        $id=$request->ref;
        $description=$request->description;
        $user=Auth::user()->username;
        $date=date('Y-m-d');
        $time=date('H:i:s');
        $file=$id.'-'.$description.'-'.date('Y-m-d').'.'.$request->image->getClientOriginalExtension();
        $path='docs/uploaded/';
        //$path= realpath("C:\\xampp\\htdocs\\MAG_System\\models\\UploadedDocs\\".$id."\\");
        #$path= realpath("C:\\xampp\\htdocs\\MAG_System\\models\\UploadedDocs\\TESING_FOLDER");   
        //$path='http://192.168.0.185:8080/MAG_System/models/UploadedDocs/'.$id.'';
    /* if (!file_exists($path)) {
            
            $var = mkdir('TESTING_FOLDER');
            $path= realpath("C:\\xampp\\htdocs\\MAG_System\\models\\UploadedDocs\\".$var."\\");
            
        }*/
        #$path= realpath("C:\\xampp\\htdocs\\MAG_System\\models\\UploadedDocs\\".$id."\\");
        #$path.=$id;
        $path.=$id.'/';
        
        $request->image->move($path,$file);
        DB::table('document')->insert([
            ['Key_Ref'=>$id,'url'=>$file,'date'=>$date,'time'=>$time,'Description'=>$description,'user'=>$user]
        ]);
        return back()->with(['message'=>'Document Uploaded Successfully']);    

    }

    public function general_work(){
        //$key_ref=$id;
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;

        $user_general=DB::table('user')
                            ->join('list_department','user.dept_key','=','list_department.dept_key')
                            ->get();
       
        return view('linemanager.labor',['user'=>$user_general,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
    }

    public function labours(){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final;
        $car=DB::table('client_details')
                       ->where('status','=','1')
                       ->distinct('Key_Ref') 
                       ->orderBy('ID','desc')
                       ->limit(500)
                       ->get();
                       return view('linemanager.labourvehicles',['car'=>$car,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);               
    }

    public function labours_details($key_ref){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final;
///////////////////////////////////////////////////////////////////////////////
$total = 0;
$tbl='';
$res = DB::select("select * FROM stock_history WHERE Key_Ref =?",[$key_ref]);
foreach ($res as $row) {
    $tbl .= '<tr>
                <td>' . $row->description . '</td>
                <td>' . $row->quantity. '</td>
                <td>' . $row->receiver . '</td>                
                <td>' . $row->date2. '</td>
                <td>' . $row->branch . '</td>
                <td style="text-align:right">' .  number_format($row->price, 2) . '</td>
                <td style="text-align:right">' .  number_format($row->price * $row->quantity, 2) . '</td>       
          </tr>';
    $total += ($row->price * $row->quantity);
}
$tbl .= '<tr>
    <td colspan="6" style="text-align:right"><b>Total</b></td>
    <td style="text-align:right">' . number_format($total,2) . '</td>
</tr>
<tr>
    <td colspan="6" style="text-align:right"><b>Sundries</b></td>
    <td style="text-align:right">' . number_format($this->getConsumedSundries($key_ref),2) . '</td>
</tr>
<tr>
    <td colspan="6" style="text-align:right"><b>Paint Supplies</b></td>
    <td style="text-align:right">' .   number_format($this->getPaintSupplies($key_ref),2) . '</td>
</tr>
<tr>
    <td colspan="6" style="text-align:right"><b>Waste Disposal</b></td>
    <td style="text-align:right">' .number_format(80,2) . '</td>
</tr>
<tr>
    <td colspan="6" style="text-align:right"><b>Allowed</b></td>
    <td style="text-align:right">'.number_format($this->getConsumedSundries($key_ref)+$this->getPaintSupplies($key_ref)+80,2).'</td>
</tr>';

$panel_html      = '';
$paint_html      = '';
$assembly_html   = '';
$mechanical_html = '';
$cleaning_html   = '';
//panel shop
$allowed       = 0;
$spent         = 0;
$rate          = 0;
$add           = 0;
$add1          = 0;
$additional    = 0;
$allowed_stage = 0;
$allowed_qc    = 0;
$qc            = 0;
$allowed_stage1= 0;

//get allowed
$dbquery   =DB::select("select * from qoutes where Key_Ref=?",[$key_ref]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed        += $dbrow->Labour;
$allowed_stage  += ($dbrow->Labour / 5);

}    
}
//get labour rate
$dbqueryR   = DB::select("select * from insurer where Key_Ref=?",[$key_ref]);

if(count($dbqueryR)>0){
foreach($dbqueryR as $dbrowR){

$rate  += $dbrowR->labour;

}    
}
//get allowed quality control
$dbquery   = DB::select("select * from qoutes where Key_Ref=? and (Oper='Inhouse' or Oper='Quality Inspection')",[$key_ref]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed_qc  += ($dbrow->Misc / $rate/5);

}    
}
//get additional allowed
$dbqueryA   =DB::select("select * from additional where Key_Ref=?",[$key_ref]);


if(count($dbqueryA)>0){
foreach($dbqueryA as $dbrowA){

if($dbrowA->Labour>10){
$add += ($dbrowA->Labour / $rate);   
}else{
$add1 += $dbrowA->Labour;    
}

$additional = $add + $add1;

}    
}
//get time management
$dbquery   = DB::select("select * from clocking_history where Key_Ref=? and stage='Panel Shop'",[$key_ref]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){
   
$title  = $dbrow->title;    
$stage  = $dbrow->stage;    
$start  = $dbrow->start;    
$end    = $dbrow->end;    
$user   = $dbrow->user;    

$time1 = strtotime($start);
$time2 = strtotime($end);

$diff = $time2-$time1;
$s_t  = ($diff/3600);

$spent += $s_t;
$t_r   = $allowed_stage-$s_t;

if($end=="N/A"){
$end   = "In Progress";
$s_t   = 0;
$t_r   = 0;
$spent = 0;
}

if($t_r<0){
$remaining_color = "red";    
}else{
$remaining_color = "green";
}

$amount_lost  = 0;
$amount_saved = 0;
$amount_diff = ($rate * $allowed)+($additional+$allowed_qc) - ($rate * $spent);

if($amount_diff<0){
$amount_lost  = $amount_diff;    
}else{
$amount_saved = $amount_diff;    
}

$panel_html ='
<tr>
<td>PANEL SHOP</td>
<td>'.number_format($allowed+$additional+$allowed_qc,2).'</td>
<td>'.number_format($spent,2).'</td>
<td>'.number_format($rate * $allowed+$additional+$allowed_qc,2).'</td>
<td>'.number_format($rate * $spent,2).'</td>
<td>'.number_format($amount_saved,2).'</td>
<td>'.number_format($amount_lost,2).'</td>
</tr>
';
}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$allowed       = 0;
$spent         = 0;
$rate          = 0;
$add           = 0;
$add1          = 0;
$additional    = 0;
$allowed_stage = 0;

//get allowed
$dbquery   = DB::select("select * from qoutes where Key_Ref=?",[$key_ref]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed        += ($dbrow->Paint);
$allowed_stage  += ($dbrow->Paint / 6);

}    
}
//get labour rate
$dbqueryR   = DB::select("select * from insurer where Key_Ref=?",[$key_ref]);


if(count($dbqueryR)>0){
foreach($dbqueryR as $dbrowR){

$rate  += $dbrowR->labour;

}    
}
//get additional allowed
$dbqueryA   = DB::select("select * from additional where Key_Ref=?",[$key_ref]);


if(count($dbqueryA)>0){
foreach($dbqueryA as $dbrowA){

if($dbrowA->Paint>10){
$add += ($dbrowA->Paint / $rate);   
}else{
$add1 += $dbrowA->Paint;    
}

$additional = $add + $add1;

}    
}
//get time management
$dbquery   = DB::select("select * from clocking_history where Key_Ref=? and stage='Paint Shop'",[$key_ref]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){
   
$title  = $dbrow->title;    
$start  = $dbrow->start;    
$end    = $dbrow->end;    
$user   = $dbrow->user;    

$time1 = strtotime($start);
$time2 = strtotime($end);

$diff = $time2-$time1;
$s_t  = ($diff/3600);

$spent += $s_t;
$t_r   = $allowed_stage-$s_t;

if($end=="N/A"){
$end = "In Progress";
$s_t = 0;
$t_r = 0;
$spent = 0;
}

if($t_r<0){
$remaining_color = "red";    
}else{
$remaining_color = "green";
}

$amount_lost  = 0;
$amount_saved = 0;
$amount_diff = $rate * $allowed+$additional+$allowed_qc - $rate * $spent;

if($amount_diff<0){
$amount_lost  = $amount_diff;    
}else{
$amount_saved = $amount_diff;    
}

$paint_html ='
<tr>
<td>PAINT SHOP</td>
<td>'.number_format($allowed+$additional+$allowed_qc,2).'</td>
<td>'.number_format($spent,2).'</td>
<td>'.number_format($rate * $allowed+$additional+$allowed_qc,2).'</td>
<td>'.number_format($rate * $spent,2).'</td>
<td>'.number_format($amount_saved,2).'</td>
<td>'.number_format($amount_lost,2).'</td>
</tr>
';

}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$allowed            = 0;
$spent              = 0;
$rate               = 0;
$add                = 0;
$add1               = 0;
$additional         = 0;
$allowed_stage      = 0;
$allowed_stage1     = 0;
$allowed_out        = 0;
$allowed_qc         = 0;
$allowed_stage_out  = 0;
$t_r                = 0;
$qc                 = 0;
//get allowed
$dbquery   = DB::select("select * from qoutes where Key_Ref=?",[$key_ref]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed        += $dbrow->Strip;
$allowed_stage  += ($dbrow->Strip / 2);

}    
}
//get labour rate
$dbqueryR   = DB::select("select * from insurer where Key_Ref=?",[$key_ref]);


if(count($dbqueryR)>0){
foreach($dbqueryR as $dbrowR){

$rate +=$dbrowR->labour;

}    
}
//get allowed outwork
$dbquery   = DB::select("select * from qoutes where Key_Ref=? and (Oper='Electrical Rep' or Oper='Diagnistics')",[$key_ref]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed_out        += $dbrow->Misc/ $rate;
$allowed_stage_out  += ($dbrow->Misc / $rate / 2);

}    
}
//get allowed quality control
$dbquery   = DB::select("select * from qoutes where Key_Ref=? and (Oper='Inhouse' or Oper='Quality Inspection')",[$key_ref]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed_qc  += ($dbrow->Misc / $rate/5);

}    
}
//get additional allowed
$dbqueryA   = DB::select("select * from additional where Key_Ref=?",[$key_ref]);


if(count($dbqueryA)>0){
foreach($dbqueryA as $dbrowA){

if($dbrowA->RandR>10){
$add += ($dbrowA->RandR / $rate);   
}else{
$add1 += $dbrowA->RandR;    
}

$additional = $add + $add1;

}    
}
//get time management
$dbquery   = DB::select("select * from clocking_history where Key_Ref=? and stage='Assembly'",[$key_ref]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){
   
$title  = $dbrow->title;    
$start  = $dbrow->start;    
$end    = $dbrow->end;    
$user   = $dbrow->user;    

$time1 = strtotime($start);
$time2 = strtotime($end);

$diff = $time2-$time1;
$s_t  = ($diff/3600);

$spent += $s_t;

if($end=="N/A"){
$end = "In Progress";
$s_t = 0;
$t_r = 0;
$spent = 0;
}

if($t_r<0){
$remaining_color = "red";    
}else{
$remaining_color = "green";
}

$amount_lost  = 0;
$amount_saved = 0;
$amount_diff = $rate * $allowed+$additional+$allowed_qc - $rate * $spent;

if($amount_diff<0){
$amount_lost  = $amount_diff;    
}else{
$amount_saved = $amount_diff;    
}

$assembly_html='
<tr>
<td>ASSEMBLY</td>
<td>'.number_format($allowed+$additional+$allowed_qc,2).'</td>
<td>'.number_format($spent,2).'</td>
<td>'.number_format($rate * $allowed+$additional+$allowed_qc,2).'</td>
<td>'.number_format($rate * $spent,2).'</td>
<td>'.number_format($amount_saved,2).'</td>
<td>'.number_format($amount_lost,2).'</td>
</tr>
';

}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$allowed        = 0;
$spent          = 0;
$rate           = 0;
$add            = 0;
$add1           = 0;
$additional     = 0;
$allowed_stage  = 0;
$allowed_stage1 = 0;
$qc             = 0;
$allowed_qc     = 0;

//get allowed
$dbquery   = DB::select("select * from qoutes where Key_Ref=? and Oper='Mechanical'",[$key_ref]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed        += $dbrow->Labour;
$allowed_stage  += ($dbrow->Labour / 2);

}    
}
//get labour rate
$dbqueryR   = DB::select("select * from insurer where Key_Ref=?",[$key_ref]);


if(count($dbqueryR)>0){
foreach($dbqueryR as $dbrowR){

$rate  += $dbrowR->labour;

}    
}
//get allowed quality control
$dbquery   = DB::select("select * from qoutes where Key_Ref=? and (Oper='Inhouse' or Oper='Quality Inspection')",[$key_ref]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed_qc  += ($dbrow->Misc / $rate/5);

}    
}
//get additional allowed
$dbqueryA   = DB::select("select * from additional where Key_Ref=? and Oper='Mechanical'",[$key_ref]);


if(count($dbqueryA)>0){
foreach($dbqueryA as $dbrowA){

if($dbrowA->Labour>10){
$add += ($dbrowA->Labour / $rate);   
}else{
$add1 += $dbrowA->Labour;    
}

$additional = $add + $add1;

}    
}
//get time management
$dbquery   = DB::select("select * from clocking_history where Key_Ref=? and stage='Mechanical'",[$key_ref]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){
   
$title  = $dbrow->title;    
$start  = $dbrow->start;    
$end    = $dbrow->end;    
$user   = $dbrow->user;    

$time1 = strtotime($start);
$time2 = strtotime($end);

$diff = $time2-$time1;
$s_t  = ($diff/3600);

$spent += $s_t;
$t_r   = $allowed_stage-$s_t;

if($end=="N/A"){
$end = "In Progress";
$s_t = 0;
$t_r = 0;
$spent = 0;
}

if($t_r<0){
$remaining_color = "red";    
}else{
$remaining_color = "green";
}

$amount_lost  = 0;
$amount_saved = 0;
$amount_diff = $rate * $allowed+$additional+$allowed_qc - $rate * $spent;

if($amount_diff<0){
$amount_lost  = $amount_diff;    
}else{
$amount_saved = $amount_diff;    
}

$mechanical_html.='
<tr>
<td>MECHANICAL</td>
<td>'.number_format($allowed+$additional+$allowed_qc,2).'</td>
<td>'.number_format($spent,2).'</td>
<td>'.number_format($rate * $allowed+$additional+$allowed_qc,2).'</td>
<td>'.number_format($rate * $spent,2).'</td>
<td>'.number_format($amount_saved,2).'</td>
<td>'.number_format($amount_lost,2).'</td>
</tr>
';

}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$allowed    = 0;
$spent      = 0;
$rate       = 0;
$add        = 0;
$add1       = 0;
$additional = 0;
$allowed_qc = 0;
$qc         = 0;

//get labour rate
$dbqueryR   = DB::select("select * from insurer where Key_Ref=?",[$key_ref]);


if(count($dbqueryR)>0){
foreach($dbqueryR as $dbrowR){

$rate  += $dbrowR->labour;

}    
}
//get allowed quality control
$dbquery   = DB::select("select * from qoutes where Key_Ref=? and (Oper='Inhouse' or Oper='Quality Inspection')",[$key_ref]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed_qc  += ($dbrow->Misc / $rate/5);

}    
}

$allowed = 2;
$allowed_stage = 2;

//get time management
$dbquery   = DB::select("select * from clocking_history where Key_Ref=? and stage='Cleaning'",[$key_ref]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){
   
$title  = $dbrow->title;    
$start  = $dbrow->start;    
$end    = $dbrow->end;    
$user   = $dbrow->user;    

$time1 = strtotime($start);
$time2 = strtotime($end);

$diff = $time2-$time1;
$s_t  = ($diff/3600);

$spent += $s_t;
$t_r   = $allowed_stage-$s_t;

if($end=="N/A"){
$end = "In Progress";
$s_t = 0;
$t_r = 0;
$spent = 0;
}

if($t_r<0){
$remaining_color = "red";    
}else{
$remaining_color = "green";
}

$amount_lost  = 0;
$amount_saved = 0;
$amount_diff = $rate * $allowed+$additional+$allowed_qc - $rate * $spent;

if($amount_diff<0){
$amount_lost  = $amount_diff;    
}else{
$amount_saved = $amount_diff;    
}

$cleaning_html.='
<tr>
<td>CLEANING</td>
<td>'.number_format($allowed+$additional+$allowed_qc,2).'</td>
<td>'.number_format($spent,2).'</td>
<td>'.number_format($rate * $allowed+$additional+$allowed_qc,2).'</td>
<td>'.number_format($rate * $spent,2).'</td>
<td>'.number_format($amount_saved,2).'</td>
<td>'.number_format($amount_lost,2).'</td>
</tr>
';
}
}

////////////////////////////////////////////////////////////////////////////////
        $consumerables=DB::table('stock_history')->where('Key_Ref','=',$key_ref)->get();
        $paintTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Paint');
        $paintRate=DB::table('insurer')->select('Paint')->where('Key_Ref','=',$key_ref)->get();
        $consus=DB::table('insurer')->select('PaintSup')->where('Key_Ref','=',$key_ref)->get();
        $paint_rate_qt=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        $notes=DB::table('notes')->where('Key_Ref','=',$key_ref)->get();    
        $smses=DB::table('sms_eventlog')->where('Key_Ref','=',$key_ref)->get();
        $doc_types=DB::table('docs_description')->get();
        $document=DB::table('document')->where('Key_Ref','=',$key_ref)->get();
        $wip_photos=DB::table('track_photos')->where('Key_Ref','=',$key_ref)->where('category','=','Work In Progress')->get();
        $additional_photos=DB::table('track_photos')->where('Key_Ref','=',$key_ref)->where('category','=','ADDITIONAL')->get();
        $pics=DB::table('securityphotos')->where('Key_Ref','=',$key_ref)->get();   
        $oper=DB::table('oper')->get();
        $additionasls=DB::table('additional')->where('Key_Ref','=',$key_ref)->get();
        $assessor=DB::table('assessors')->orderBy('Names','ASC')->get();
        $insu_broker=DB::table('broker_table')->get();
        $towing_info=DB::table('towin_table')->get();
        $client_details=DB::table('client_details')
                                ->where('client_details.Key_Ref','=',$key_ref)
                                ->leftjoin('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                                ->leftjoin('pre_bookings','client_details.Key_Ref','=','pre_bookings.Key_Ref')
                                ->leftjoin('towing_history','client_details.Key_Ref','=','towing_history.Key_Ref')
                                ->select('client_details.Date','client_details.Chasses_No','client_details.KM','client_details.Vehicle_year','client_details.Key_Ref','client_details.Reg_No','client_details.Fisrt_Name','client_details.Last_Name','client_details.id_number','client_details.BirthDate','client_details.Cell_number','client_details.Email','client_details.Address_1','client_details.Address_2','client_details.Address_3','pre_bookings.booking_date','client_details.Make','client_details.Model','insurer.Inserer','client_details.status','towing_history.*','client_details.Eng_No','client_details.Colour','client_details.Vehicle_year','client_details.Address_1','client_details.Address_2','client_details.Address_3','client_details.Estimator','client_details.branch','client_details.Eng_No','insurer.Contact as ins_contact','insurer.Email as ins_email','insurer.Claim_NO as ins_claim','insurer.ClerkName','insurer.Assessor_Email','insurer.Assessor_Cell','insurer.Assessor_comp','towing_history.tel as tow_tel','towing_history.email as tow_email')
                                ->limit(1)
                                ->get();
        $sms_lm_event=DB::table('sms_event')->where('stage_no','=','19')->get();

         #ADDED THE PHOTOS TABLE [ 19 MAY 2021 ]

        #COUNT THE PHOTOS
        $finalstage_photos_count=DB::table('track_photos')->where('Key_Ref','=',$key_ref)->where('category','=','FINAL STAGE')->count();
        $wip_photos_count=DB::table('track_photos')->where('Key_Ref','=',$key_ref)->where('category','=','Work In Progress')->count();
        $additional_photos_count=DB::table('track_photos')->where('Key_Ref','=',$key_ref)->where('category','=','ADDITIONAL')->count();
        $security_photos_count=DB::table('securityphotos')->where('Key_Ref','=',$key_ref)->count();


        return view('linemanager.labourdetails',['line_sms_log'=>$sms_lm_event,'panel_tbl'=>$paint_html,'paint_tbl'=>$paint_html,'assembly_tbl'=>$assembly_html,'mechanical_tbl'=>$assembly_html,'cleaning_tbl'=>$cleaning_html,'tble'=>$tbl,'clients_details'=>$client_details,'brokers'=>$insu_broker,'assessor'=>$assessor,'towing_info'=>$towing_info,'key'=>$key_ref,'consumerables'=>$consumerables,'notes'=>$notes,'smses'=>$smses,'doc_types'=>$doc_types,'documents'=>$document,'images'=>$pics,'wip_photos'=>$wip_photos,'additional_photos'=>$additional_photos,'additional_quotes'=>$additionasls,'oper'=>$oper,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final,'final_photo_count'=>$finalstage_photos_count,'wip_photo_count'=>$wip_photos_count,'additional_photo_count'=>$additional_photos_count,'security_photo_count'=>$security_photos_count]);
        
    }

    public function getConsumedSundries($ref){
        $ttpts = 0;
        $sun = 0;
        
        $result_=DB::select("select (qt.Betterment*(qt.Part*qt.Quantity))as btn,qt.Percent,qt.Oper,qt.Description,qt.Quantity,qt.Part,(qt.Labour*ins.labour)as lb,(qt.Paint*ins.Paint)as pnt,(qt.Strip*ins.Strip)as strp,(qt.Frame*ins.Frame)as frm,Misc from qoutes qt
        inner join insurer ins on qt.Key_Ref = ins.Key_Ref where qt.Key_Ref =?",[$ref]);
        
        
        
        
        $result5 = DB::select("select PaintSup,ShopSup from insurer where Key_Ref =?",[$ref]);
        foreach($result_ as $row) {
            
            $qt = $row->Quantity;
            $pt = $row->Part;        
            $perc =  $row->Percent;        
            $ttpts += (($pt * (1 + ($perc / 100))) * $qt);
        }
        foreach($result5 as $row) {
            $sun = $row->ShopSup;
        }
        
        return ($ttpts * ($sun / 100));
    }

    public function getPaintSupplies($ref){
        $result3 = DB::select("select distinct
        qt.Key_Ref,qt.Percent,Betterment,
        sum(qt.Part*qt.Quantity)as part,
        sum(qt.Labour)as labor,
        sum(qt.Paint)as paint,
        sum(qt.Strip)as strip, 
        sum(qt.Frame)as frame,
        sum(qt.Misc)as Misc,
        sum(qt.sundries) as sundries ,round(sum(qt.Part+(qt.Part*ins.ShopSup)+(qt.Labour*ins.labour)+(qt.Paint*ins.Paint)+(qt.Paint*ins.PaintSup)+(qt.Strip*ins.Strip)+(qt.Frame*ins.Frame)+Misc),2)as total from qoutes qt 
        inner join insurer ins on qt.Key_Ref = ins.Key_Ref where qt.Key_Ref =?",[$ref]);
        $result2 =DB::select("select * from insurer  where Key_Ref =?",[$ref]);
        $result5 =DB::select("select PaintSup,ShopSup from insurer where Key_Ref =?",[$ref]);
        $paintTotal = 0;
        $paintRate = 0;
        $consu = 0;
        foreach ($result3 as $row3) {
            $paintTotal = $row3->paint;
        }
        foreach ($result2 as $row2) {
            $paintRate = $row2->Paint;
        }
        foreach ($result5 as $row) {
            $consu = $row->PaintSup;
        }
        $consusTotal_ = ($paintTotal * $paintRate * ($consu / 100));
        return $consusTotal_;
    }

    public function line_manager_security_upload(Request $request){
        $key_ref=$request->ref;
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;

        $title=$request->title;
        $path='images/mag_security/';
        $path.=$key_ref;
        $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
        $image=$input['image'];
        $request->image->move(public_path($path), $input['image']);
        

        DB::table('securityphotos')->insert([
            ['Key_Ref'=>$key_ref,'url'=>$image]
        ]);
           
        return back()->with(['message'=>'Security Image Uploaded Successfully']);
    }

    public function security_delete($id){
        DB::table('securityphotos')->where('id','=',$id)->delete();
        return back()->with(['message'=>'Image Deleted Successfully']);
    }


    //[ CURRENT FIX ]
    public function additional_quote(Request $request){

        $opa = "";
        if( $request->opa ){
            $opa = $request->opa;
        }else{
            $opa = $request->oper; 
        }
        $comment=$request->addition_comment;
        $key_ref=$request->ref;
        $desc=$request->desc;
        $qty=$request->qty;
        $part= $request->part;
        $labor=$request->labor;
        $paint=$request->paint;
        $frame=$request->frame;
        $bett=$request->bett;
        $percent=$request->percent;
        $outwork=$request->outwork;
        $date=date('Y-m-d');
        $rr=$request->r_r;  //rr
        $inhouse=$request->in_house;

        $new_labor=0;
        $new_paint=0;
        $new_rr=0;
        $new_frame=0;
        
        if( $request->time ){

            $resul =DB::table('insurer')->where('Key_Ref','=',$key_ref)->get();
            foreach($resul as $row)
            {
                $labor = $labor*$row->labour;
                $paint = $paint*$row->Paint;
                $rr    = $rr*$row->Strip;
                $frame = $frame*$row->Frame;  
                  
            } 
        }


    $numb =  DB::table('additional')->where('Key_Ref','=',$key_ref)->orderBy('No','desc')->distinct('No')->value('No');
    //$numb =  DB::table('additional')->where('Key_Ref','=',$key_ref)->orderBy('Date','desc')->distinct('No')->limit(1)->value('No');
   
    if( $numb > 0 ){
        $no = $numb + 1;
        
    }else{
        $no = 0;
    }


        DB::table('additional')->insert([ 'Key_Ref'=>$key_ref,'Oper'=>$opa,'Outwork'=>$outwork,'Inhouse'=>$inhouse,'Description'=>$desc,'Quantity'=>$qty,
          'Betterment'=>$bett,'Part'=>$part,'Labour'=>$labor,'Paint'=>$paint,'Strip'=>0,'Frame'=>$frame,'Misc'=>$bett,
          'Date'=>$date,'Comments'=>$comment,'Labour_rate'=>0,'Frame_rate'=>0,'Strip_rate'=>0,'Paint_rate'=>0,'Percent'=>$percent,'RandR'=>$rr,
          'No'=>$no,'MarkUp'=>0,'MarkUp2'=>0,'Checked'=>'','Part_sales'=>$part ]);

        return back()->with(['message'=>'Part Successfully Added To Additional Quotes.']);
       



        /*
        $comment=$request->addition_comment;
        $key_ref=$request->ref;
        $opa=$request->opa;
        $desc=$request->desc;
        $qty=$request->qty;
        $part= $request->part;
        $labor=$request->labor;
        $paint=$request->paint;
        $strip=$request->strip;
        $frame=$request->frame;
        $bett=$request->bett;
        $mark=$request->mark;
        $outwork=$request->outwork;
        $date=date('Y-m-d');
        DB::table('additional')->insert([
            ['Key_Ref'=>$key_ref,'Oper'=>$opa,'Outwork'=>$outwork,'Inhouse'=>0,'Description'=>$desc,'Quantity'=>$qty,'Betterment'=>$bett,'Part'=>$part,'Labour'=>$labor,'Paint'=>$paint,'Strip'=>$strip,'Frame'=>$frame,'Misc'=>$bett,'MarkUp'=>$mark,'Date'=>$date,'Comments'=>$comment,'Labour_Rate'=>0,'Frame_Rate'=>0,'Strip_Rate'=>0,'Paint_Rate'=>0,'Percent'=>0,'RandR'=>0,'No'=>0,'MarkUp'=>0,'MarkUp2'=>0,'Checked'=>'','Part_sales'=>0]
        ]);
        return back()->with(['message'=>'Part Successfully Added To Additional Quotes.']);
        */

    }
    

    public function get_all_users(){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final;

        $employees=DB::table('user')->get();

        return view('linemanager.worker',['final'=>$final,'employees'=>$employees,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
    }

    public function worker_timesheet(Request $request){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final;

        $user = $request->user_time;
        $type=$request->worker_type;
        $to=$request->to_date_time;
        $to.=' 17:30:00';
        $from=$request->from_date_time;
        $from.=' 07:00:00';

        $html = '';
        $spent=0;
        $allowed_stage=0;

        $dbquery   =DB::select("select * from clocking_history a WHERE a.user=? AND (a.`start`>=? AND a.`end`<=?)",[$user,$from,$to]);
        if(count($dbquery)>0){
            foreach($dbquery as $dbrow){
               
            $title  = $dbrow->title;    
            $stage  = $dbrow->stage;    
            $start  = $dbrow->start;    
            $end    = $dbrow->end;    
            $user   = $dbrow->user;    
            $track  = $dbrow->Key_Ref;

            $time1 = strtotime($start);
            $time2 = strtotime($end);
            
            $diff = $time2-$time1;
            $s_t  = ($diff/3600);
            
            $spent += $s_t;
            $t_r   = $allowed_stage-$s_t;
            
            if($end=="N/A"){
            $end   = "In Progress";
            $s_t   = 0;
            $t_r   = 0;
            $spent = 0;
            }
            $html .= '
                        <tr>
                        <td style="width:140">'.$user.'</td>
                        <td style="width:140">'.$stage.'</td>
                        <td style="width:130">'.$start.'</td>
                        <td style="width:130">'.$end.'</td>
                        <td style="width:40">'.number_format($s_t,2).'</td>
                        <td style="width:40">'.$track.'</td>
                        </tr>
                        ';

                        }
                        }
        $table='';
        $table='
        <table table-bordered table-sm" width="100%" cellspacing="0" style="font-size:10px;">
        <tr style="font-weight:bold;">
        <th>NAME</th>
        <th>JOB</th>
        <th>STARTED</th>
        <th>FINISHED</th>
        <th>TIME TAKEN</th>
        <th>Track No</th>
        </tr>
        '.$html.'
        </table>
        ';
        return view('linemanager.timesheetemployee',['from'=>$from,'to'=>$to,'table'=>$table,'user'=>$user,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);               
    }

    public function search_archive_labor(Request $request){
        $id=$request->labor_archieve_key;
        
        $id_info=DB::table('client_details')
                      ->select('*','Key_Ref AS Ref')  
                      ->where('Key_Ref','=',$id)
                      ->orWhere('Reg_No','=',$id)
                      ->get();  
        if(count($id_info)>0){              
        return redirect()->route('line-manager-analysis-view', ['id' => $id]);
        }else{
            return back()->with(['message'=>"Track No. Or Reg No Doesn't Exist"]);   
        }

    }

    public function search_report(){
        $wip_user_arr = array();
        $data=DB::select('SELECT * FROM user WHERE userLevel="300" ORDER BY use_username ASC');
        foreach($data as $row){
            $userid = $row->use_username;
            $name = $row->use_username;
            $wip_user_arr[] = array("id" => $userid, "name" => $name);
            
        }
    // encoding array to json format
        return json_encode($wip_user_arr);
    }


    # [ CURRENT LOADED UPDATES ]
    public function line_manager_upload_photo_final_stage(Request $request){
        $key_ref=$request->ref;
        $title=$request->title;
        $path='images/mag_photos/';
        $path.=$key_ref;
        $image='final_stage-';
        $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
        $image.=$input['image'];
        $request->image->move(public_path($path), $image);
        DB::table('track_photos')->insert([
            ['Key_Ref'=>$key_ref,'picture_name'=>$image,'picture_comment'=>'','category' => 'FINAL STAGE']
        ]);
        return back()->with(['message'=>'Work In Progress Image Uploaded Successfully']);
    }

    public function search_archieve_labours(Request $request){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final;
        $key=$request->labor_archieve_key;

        $car=DB::table('client_details')
                       ->where('status','=','1')
                       ->where('Key_Ref','=',$key)
                       ->orWhere('Reg_No','=',$key)
                       ->distinct('Key_Ref') 
                       ->orderBy('ID','desc')
                       
                       ->get();
        return view('linemanager.labourvehicles',['car'=>$car,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);               
    }


    
}
