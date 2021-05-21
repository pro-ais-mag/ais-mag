<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function create_client(){
        
        return view('quotations.createclient');    
    }

   public function edit_client($key_ref){

            $client_details=DB::table('client_details')
                                ->where('Key_Ref','=',$key_ref)
                                ->select('Date','Key_Ref','Reg_No','Fisrt_Name','Last_Name','id_number','BirthDate','Cell_number','Email','Address_1','Address_2','Address_3','Vehicle_year','Make','Model','Colour','Eng_No','towed_by')
                                ->get();
            $vehicle_details=DB::table('insurer')
                                ->where('Key_Ref','=',$key_ref)
                                ->get();
            $vehicle_details=DB::table('towing_history')
                                ->where('Key_Ref','=',$key_ref)
                                ->get();                                        
                                	                    
            
        return view('quotations.details',['key'=>$key_ref,'clients_details'=>$client_details]);
   }     

        public function client_rate($key){
            $rate_details=DB::table('insurer')->where('Key_Ref','=',$key)->limit(1)->get();
                                
            return view('quotations.rate',['rate_details'=>$rate_details,'key'=>$key]);
        }

        public function client_documents($key_ref){
            $descriptions=DB::table('docs_description')
                               ->orderBy('description','asc')
                               ->distinct('description')
                               ->get();

            $document=DB::table('document')
                            ->where('Key_Ref','=',$key_ref)
                            ->get();    

            return view('quotations.documents',['descriptions'=>$descriptions,'documents'=>$document,'key'=>$key_ref]);
        }

        public function client_security_photos($key_ref){
        $photos=DB::table('securityphotos')->where('Key_Ref','=',$key_ref)->get();
        $track_photos=DB::table('track_photos')->where('Key_Ref','=',$key_ref)->get();
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;

        
        return view('quotations.photo',['final'=>$final,'images'=>$photos,'track_images'=>$track_photos,'key'=>$key_ref,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
        //    return view('quotations.photo',['images'=>$photos,'key'=>$key_ref]);
        }

        public function client_rate_edit(Request $request){
            $key_ref=$request->key;
            $labour=$request->client_labor;
            $paint=$request->client_paint;
            $strip=$request->client_strip;
            $frame=$request->client_frame;
            $sundries=$request->client_sundries;
            $paint_supply=$request->client_paint_supplies;
            $vat=$request->client_vat;
            $covid=$request->client_covid;
            DB::table('insurer')
                ->where('Key_Ref','=',$key_ref)
                ->update(['labour'=>$labour,'Paint'=>$paint,'Strip'=>$strip,'Frame'=>$frame,'ShopSup'=>$sundries,'PaintSup'=>$paint_supply,'vat'=>$vat,'covid'=>$covid]); 
            return back()->with(['message'=>'Rates Updated Successfully.']);
        }

        public function client_notes($key_ref){
            $client_notes=DB::table('notes')
                                ->where('Key_Ref','=',$key_ref)
                                ->where('status','=','0')
                                ->distinct()
                                ->get();
            $smses=DB::table('sms_eventlog')->where('Key_Ref','=',$key_ref)->get();                    
            return view('quotations.notes',['key'=>$key_ref,'client_notes'=>$client_notes,'smses'=>$smses]);
        } 
        
        public function insert_client_notes(Request $request){
            $note=$request->client_notes;
            $key_ref=$request->key;
            $user=Auth::user()->username;
            $date=date("Y-m-d");
            $time=date('H:i:s');

            DB::table('notes')->insert([
                ['Key_Ref'=>$key_ref,'note'=>$note,'date'=>$date,'time'=>$time,'status'=>'0','user'=>$user,'identity'=>'']
            ]);  
            return back()->with(['message'=>'Notes Updated Successfully.']);      
        }

        public function client_security_photo(){

        }

        public function client_save_document($key_ref){
            

        }

}
