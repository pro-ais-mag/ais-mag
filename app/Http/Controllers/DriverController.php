<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use FarhanWazir\GoogleMaps\GMaps;


class DriverController extends Controller
{
    public function __construct(GMaps $gmap){
        $this->gmap = $gmap;
    }
    
   public function current_location(){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final;
        $table='';
        $get_drivers=DB::table('user')->where('use_username','like','%Driver%')->distinct('use_key')->get();
        $driver_arr=array();
        $count_driver=1;
        foreach($get_drivers as $drive){
            $name=$drive->use_username;
            $driver_stat=DB::table('trips')->where('driverId','=',$drive->use_key)->orderBy('id', 'desc')->limit(1)->get();
            foreach($driver_stat as $stats){
             
             $table.='<tr>';
             $table.='<td>'.$count_driver.'</td>';
             $table.='<td>'.$name.'</td>';
             $table.='<td>'.$stats->driverLat.'</td>';
             $table.='<td>'.$stats->driverLon.'</td>'; 
             $table.='<td></td>';  
             if($stats->status==0){
                 $table.='<td style="color:white;">Request</td>';   
             }elseif($stats->status==1){
                $table.='<td style="color:orange;"><b>On Route</b></td>';
             }elseif($stats->status==2){
                $table.='<td style="color:green;"><b>Completed</b></td>';
             }elseif($stats->status==3){
                $table.='<td style="color:red;"><b>Declined</b></td>';
             }
             $table.='<td><b>'.$stats->description.'</b></td>';
             $table.='<td>
                        <div class="btn-group">
                            <a href="#" title="Cancel Driver Request" data-id="'.$stats->driverId.'" data-driver="'.$name.'" class="btn-danger btn-sm driver_cancel_trip"><span class="fa fa-times-circle"></span></a>
                            <a href="/driver-new-location/'.$stats->driverId.'" title="Request Driver" style="margin-left:5px;" data-name="'.$name.'" class="btn-success btn-sm"><span class="fa fa-check-circle"></span></a>
                        </div>
                      </td>';
             $table.='</tr>';         
             $count_driver++;
            }
        } 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $gmap = new GMaps();
        $config = array();
        $config['center'] = 'Gauteng, South Africa';
        $config['zoom'] = '10';
        $config['map_height'] = '400px';
        
        $gmap->initialize($config);
        
        $marker['position'] = '80 Booysens Rd, Selby, Johannesburg';
        $marker['infowindow_content'] = ' John - Driver ';
        $gmap->add_marker($marker);

        $marker['position'] = '42 Longmeadow Boulevard, Edenvale, Johannesburg';
        $marker['infowindow_content'] = ' Lucky - Driver ';
        $gmap->add_marker($marker);

        $marker['position'] = 'Lois Avenue, Glen Eagles, Glenanda';
        $marker['infowindow_content'] = 'Orlando - Driver ';
        $gmap->add_marker($marker);
        $map = $gmap->create_map();
        

    return view('driver.driver',['table'=>$table,'map'=>$map,'driver_status'=>$driver_arr,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final,'drivers'=>$get_drivers]);
   } 

   public function new_location($id){
         $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final;
        
        $get_drivers=DB::table('user')->where('use_key','=',$id)->get();

        foreach($get_drivers as $driver){
            $driver=$driver->use_username;
        }
        $get_locations=DB::table('trips')->where('driverId','=',$id)->limit(1)->get();
        $gmap = new GMaps();
        $config = array();
        $config['center'] = 'Gauteng, South Africa';
        $config['zoom'] = '10';
        $config['map_height'] = '500px';
        foreach($get_locations as $location){
        $start='';
        $start.=$location->driverLat.','.$location->driverLon;
        $end='';
        $end.=$location->destinationLat.','.$location->destinationLon;    
        $config['directions'] = true;
        $config['directionsStart'] = $start;
        $config['directionsEnd'] =$end;
        $config['directionsDivID'] =  'directionsDiv';
        }    
        
        $gmap->initialize($config);
        $map = $gmap->create_map();
      return view('driver.destination',['id'=>$id,'driver'=>$driver,'map'=>$map,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
   }

   public function maps_test(){

    $position=Auth::user()->position;
    $admin=Auth::user()->admin;
    $quote=Auth::user()->quote;
    $consumable=Auth::user()->consumerable;
    $customer=Auth::user()->customer_care;
    $line_manager=Auth::user()->line_manager;
    $creditor=Auth::user()->creditors;
    $costing=Auth::user()->costing;
    $final=Auth::user()->final;

        $config['center'] = '80 Booysens Road, Johannesburg';
        $config['zoom'] = '14';
        $config['map_height'] = '400px';

        $gmap = new GMaps();
        $gmap->initialize($config);
     
        $map = $gmap->create_map();

    return view('driver.maptest',['map'=>$map,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);    
   }

   public function create_new_location(Request $request){

   }

   public function cancel_trip(Request $request){
    $trip_id=$request->trip_id;
    $update = DB::table('trips')->where('id','=',$trip_id)->update(['status'=>'3']);
    if($update){
        echo 1;
    }else{
        echo 0;
    }

    return back()->with(['message'=>"This Trip Has Been Cancelled!"]);
   }

}
