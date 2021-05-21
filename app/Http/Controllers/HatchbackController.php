<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;


class HatchbackController extends Controller
{
    public function index($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('hatchback.exterior',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function frontdoor($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('hatchback.frontdoor',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function frontbumper($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('hatchback.frontbumper',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function reardoor($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('hatchback.reardoor',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function rearbumper($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('hatchback.rearbumper',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function frontsuspension($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('hatchback.frontsuspension',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function rearsuspension($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
                return view('hatchback.rearsuspension',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function interior($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('hatchback.interior',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function frontseat($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('hatchback.frontseat',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function rearseat($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('hatchback.rearseat',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function aircooler($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('hatchback.aircooler',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function exhaust($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('hatchback.exhaust',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function fuel($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('hatchback.fuel',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function transmission($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('hatchback.transmission',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function engine($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('hatchback.engine',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

    public function dashboard($key_ref){
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        return view('hatchback.dashboard',['key'=>$key_ref,'quote_info'=>$quote_info]);
    }

}
