<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;

class DoubleCabController extends Controller
{

            public function exterior($key_ref){

                $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                
                return view('double_cab.exterior',['key'=>$key_ref,'quote_info'=>$quote_info]);
                //return view()->first(['vehicle','double_cab.exterior'],['key'=>$key_ref,'quote_info'=>$quote_info]);
            }


            public function frontdoor($key_ref){
                $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('double_cab.frontdoor',['key'=>$key_ref,'quote_info'=>$quote_info]);
            }

            public function frontbumper($key_ref){
                $quote_info=DB::table('qoutes')->where('Key_Ref',$key_ref)->get();
                return view('double_cab.frontbumper',['key'=>$key_ref,'quote_info'=>$quote_info]);
            }

            public function frontsuspension($key_ref){
                $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('double_cab.frontsuspension',['key'=>$key_ref,'quote_info'=>$quote_info]);
            }

            public function reardoor($key_ref){
                $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('double_cab.readoor',['key'=>$key_ref,'quote_info'=>$quote_info]);
            }

            public function rearbumper($key_ref){
                $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('double_cab.rearbumper',['key'=>$key_ref,'quote_info'=>$quote_info]);
            }

            public function rearsuspension($key_ref){
                $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('double_cab.rearsuspension',['key'=>$key_ref,'quote_info'=>$quote_info]);
            }

            public function engine($key_ref){
                $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('double_cab.engine',['key'=>$key_ref,'quote_info'=>$quote_info]);
            }

            public function transmission($key_ref){
                $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('double_cab.transmission',['key'=>$key_ref,'quote_info'=>$quote_info]);
            }

            public function conditioner($key_ref){
                $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('double_cab.airconditioner',['key'=>$key_ref,'quote_info'=>$quote_info]);
            }
 
            public function dashboard($key_ref){
                $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('double_cab.dashboard',['key'=>$key_ref,'quote_info'=>$quote_info]);
            }

            public function frontseat($key_ref){
                $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('double_cab.frontseat',['key'=>$key_ref,'quote_info'=>$quote_info]);
            }

            public function rearseat($key_ref){
                $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('double_cab.rearseat',['key'=>$key_ref,'quote_info'=>$quote_info]);
            }

        public function fuel($key_ref){
                $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('double_cab.fuel',['key'=>$key_ref,'quote_info'=>$quote_info]);
            }

            public function exhaust($key_ref){
                $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('double_cab.exhaust',['key'=>$key_ref,'quote_info'=>$quote_info]);  
            }

            public function client_quote($key_ref){
                $quote_info=DB::table('qoutes')->where('Key_Ref',$key_ref)->get();
                return view('double_cab.exterior',['key'=>$key_ref,'quote_info'=>$quote_info]);
            }

            
            
}
