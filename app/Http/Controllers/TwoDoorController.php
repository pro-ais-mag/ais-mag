<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;

class TwoDoorController extends Controller
{
    //
    public function index($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('2door.exterior',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function frontdoor($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('2door.door',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function frontbumper($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref',$key_ref)->get();
        return view('2door.frontbumper',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function frontsuspension($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('2door.frontsuspension',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function reardoor($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('2door.readoor',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function rearbumper($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('2door.rearbumper',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function rearsuspension($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('2door.rearsuspension',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function engine($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('2door.engine',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function transmission($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('2door.transmission',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function conditioner($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('2door.airconditioner',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function dashboard($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('2door.dashboard',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function frontseat($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('2door.frontseat',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function rearseat($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('2door.rearseat',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

public function fuel($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('2door.fuel',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function exhaust($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('2door.exhaust',['key'=>$key_ref,'quote_info'=>$quote_info]);  
    }

    public function interior($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('2door.interior',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }
}
