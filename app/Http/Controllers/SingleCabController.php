<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;

class SingleCabController extends Controller
{
    //
    public function index($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('singlecab.exterior',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function fuel($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('singlecab.fuel',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function transmission($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('singlecab.transmission',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }
    
    public function bumper($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('singlecab.frontbumper',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function frontdoor($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('singlecab.frontdoor',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function frontsuspension($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('singlecab.frontsuspension',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function engine($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('singlecab.engine',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function cooler($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('singlecab.cooler',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function dashboard($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('singlecab.dashboard',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function frontseat($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('singlecab.frontseat',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function exhaust($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('singlecab.exhaust',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

   public function rearsuspension($key_ref){
    $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
    return view('singlecab.rearsuspension',['key'=>$key_ref,'quote_info'=>$quote_info]);
   }
}
