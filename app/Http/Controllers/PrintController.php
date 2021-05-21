<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\qoutes;
use PDF;

use TCPDF;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PrintController extends Controller
{
    
    public function print_invoice($id,$date,$inv){

        $branch='';
        $val_1='';
        $val_2='';
        $val_3='';
        $val_4='';

        if($id==1){
            $branch = "MS";	
            $val_1  = "Motor Accident Group";
            $val_2  = "80 Booysens Road";
            $val_3  = "Selby";
            $val_4  = "2001";
            }
            
            if($id==2){
            $branch = "ML";	
            $val_1  = "Motor Accident Group";
            $val_2  = "42 Longmeadow";
            $val_3  = "Edenvale";
            $val_4  = "1609";
            }
            
            if($id==3){
            $branch = "MGC";
            $val_1  = "Motor Accident Group";
            $val_2  = "Lois Avenue";
            $val_3  = "Glen Eagles, Glenanda";
            $val_4  = "7945";	
            }
            
            if($id==4){
            $branch = "ME";	
            $val_1  = "Motor Accident Group";
            $val_2  = "80 Booysens Road";
            $val_3  = "Selby";
            $val_4  = "2001";
            }

            $dbcmd   =DB::select("select * from branch_invoice where branch_id=? and invoice_no=?",[$id,$inv]);

            $invoice_id    = '';
            $quantity      = 0;
            $unit_price    =0;
            $total_price   = 0;
            $description   = "Advanced Intelligence System";
            $date_invoiced = '';
            $vat           = 0;

            if(count($dbcmd)>0){
              foreach($dbcmd as $dbrow){
                $invoice_id    = $dbrow->id;
                $quantity      = $dbrow->quantity;
                $unit_price    = $dbrow->unit_price;
                $total_price   = $dbrow->total_price;
                $description   = "Advanced Intelligence System";
                $date_invoiced = substr($dbrow->date_invoiced,0,10);
                $vat           = ($total_price * 15 / 100);	
              }      
            }
            
            $due_date = date('Y-m-d',strtotime($date_invoiced."+ 30 day"));	
            $print_date=date('Y-m-d');
            $details  = 'Platinum Internet Communication and Telecommunications
                         FNB Business Cheque Account
                         
                         Branch Code 250655
                         
                         Account No. 62517320727
                         
                         Please reference your invoice number when processing payment';

                         $pdf=PDF::loadview('pdf.invoice',['branch'=>$branch,'val_1'=>$val_1,'val_2'=>$val_2,'val_3'=>$val_3,'val_4'=>$val_4,
                         'invoice_id'=>$invoice_id,'inv'=>$inv,'due_date'=>$due_date,'print_date'=>$print_date,'details'=>$details,'quantity'=>$quantity,'unit_price'=>$unit_price,'total_price'=>$total_price,'description'=>$description,
                         'date_invoiced'=>$date_invoiced,'vat'=>$vat]);
                         return $pdf->stream('Invoice.pdf');                

    }

    public function print_history($id,$date,$credit){
        $billing=DB::table('branch_history')
                        ->join('client_details','branch_history.Key_Ref','=','client_details.Key_Ref')
                        ->where('branch_history.date_created','>=',$date)
                        ->where('branch_history.id_ref','=',$id)
                        ->select('branch_history.Key_Ref','branch_history.amount','branch_history.date_created','client_details.Fisrt_Name','client_details.Last_Name','client_details.Reg_No','client_details.Make','client_details.Model','client_details.Estimator','client_details.status')
                        ->get();
        $quo=DB::table('branch_history')
                    ->join('qoutes','branch_history.Key_Ref','=','qoutes.Key_Ref')
                    ->where('branch_history.date_created','>=',$date)
                    ->where('branch_history.id_ref','=',$id)
                    ->select('qoutes.Description')                
                    ->get();
        
        $status_array=array();
        foreach($billing as $status_ref){
            $check_quote=DB::table('qoutes')
                               ->where('Key_Ref','=',$status_ref->Key_Ref)     
                               ->count();
                               
            if($check_quote>0){
                $status="Quoted";
            }else{
             $status="Unquoted";         
            }    
           array_push($status_array,($status));
      }
        
        

        foreach($billing as $bill){
         $quotes=DB::table('qoutes')->where('Key_Ref',$bill->Key_Ref)->get();
        }

        $pdf=PDF::loadview('pdf.billing',['billing'=>$billing,'status_array'=>$status_array])->setPaper('a4','landscape');
        return $pdf->stream('Billing.pdf');    
    }

    public function print_statement(Request $request){
        $ids=$request->id;
        $start=$request->start;
        $end=$request->end;
        $branch=DB::table('branch')->where('id','=',$ids)->get();
        $branch_inv=DB::table('branch_invoice')->where('branch_id','=',$ids)->whereBetween('date_invoiced',[$start,$end])->get();
        $print_date='';
        $branchs='';
        $val_1='';
        $val_2='';
        $val_3='';
        $val_4='';

        foreach($branch as $bran){

        $print_date ='2020/12/31';
        if($bran->id==1){
        $branchs = "MS";	
        $val_1  = "Motor Accident Group";
        $val_2  = "80 Booysens Road";
        $val_3  = "Selby";
        $val_4  = "2001";
        }

        if($bran->id==2){
        $branchs = "ML";	
        $val_1  = "Motor Accident Group";
        $val_2  = "42 Longmeadow";
        $val_3  = "Edenvale";
        $val_4  = "1609";
        }

        if($bran->id==3){
        $branchs = "MGC";
        $val_1  = "Motor Accident Group";
        $val_2  = "Lois Avenue";
        $val_3  = "Glen Eagles, Glenanda";
        $val_4  = "7945";	
        }

        if($bran->id==4){
        //$branch = "ME";	
        $branchs = "MS";	
        $val_1  = "Motor Accident Group";
        $val_2  = "80 Booysens Road";
        $val_3  = "Selby";
        $val_4  = "2001";
        }

    }


        $description   = "Advanced Intelligence System";
        $date_invoiced = date('Y-m-d');

        $due_date = date('Y-m-d',strtotime($date_invoiced."+ 30 day"));	
        $details  = 'Platinum Internet Communication and Telecommunications<br/>
                    FNB Business Cheque Account<br/>
                    Branch Code 250655<br/>
                    Account No. 62517320727<br/><br/>
                    Please reference your invoice number when processing payment';
        $total_due=0;
        $pdf=PDF::loadview('pdf.statement',['branch_invoice'=>$branch_inv,'branch'=>$branch,'val_1'=>$val_1,'val_2'=>$val_2,'val_3'=>$val_3,'val_4'=>$val_4,
        'description'=>$description,'due_date'=>$due_date,'details'=>$details,'branchs'=>$branchs,'date_invoiced'=>$date_invoiced]);
        return $pdf->stream('AIS-Statement.pdf');

    }

    public function printQuote($key_ref){
        //$quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        $client_info=DB::table('client_details')->where('Key_Ref','=',$key_ref)->limit(1)->get();
        $insurer_info=DB::table('insurer')->where('Key_Ref','=',$key_ref)->get();
        $quote_comments=DB::table('qoutecomments')->where('Key_Ref','=',$key_ref)->get();
        $paint_suppl=DB::table('insurer')->select('PaintSup','ShopSup')->where('Key_Ref','=',$key_ref)->get();
        //$partsTotal=DB::table('qoutes')->selectRaw('sum(qoutes.Part*qoutes.Quantity) as partTotal')->get();
        $partsTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Part');
        $paintTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Paint');
        $labourTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Labour');
        $stripTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Strip');
        $frameTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Frame');
        $outworkTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Misc');
        $bettTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Betterment');
        //$sundriesTotal=$paintTotal*0.1;
        
        $wasteTotal=DB::table('betterment')->where('Key_Ref','=',$key_ref)->get();
        
        if(!$wasteTotal->isEmpty()){
            foreach($wasteTotal as $waste_amo){
                $wasteTotal=$waste_amo->waste;
            }
            }else{
                $wasteTotal=0;
            }
            
            $covidTotal=0;
            $covid_total=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->where('Description','=','Covid-19/Sanitizer')->get();
            if(!$covid_total->isEmpty()){
                foreach($covid_total as $covid){
                    $covidTotal=350;
                }
            }else{
                 $covidTotal=0;
            }
            

        //$quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->orderByRaw(DB::raw("FIELD(Oper,'New','NEW','Alternative','ALTERNATIVE','Second Hand','Used','Replace','Material','Steel Mat','Other','Oem','MARMIC','TAP','PAT HINDE','United Motors','TOYOTA','Inhouse','Inhse part','Inhse Rubberize','Inhse Elec Rep','Instock Item','In Hse Trailer/Towing','In Hse W/A as Per Report','In Hse Repair','In Hse Labor','In Hse Jig','In Hse Diagnostics as per Report','In Hse Regas','In Hse Sealant','Remanuf','Remanuf In Hse','REMANUF','R+R','Repair','REPAIR','PDR','D&A','Electrical Rep','Mechanical','Service','PDI','Partial Rep','Partial Paint','Realign','Blend','Spray','Clean','Paint','Adjust','Reform','Valet','Polish','Labor','Outwork','Diagnostics','Towing Invoice','Recon','Check','Check + Report','Refit','Sundries','Handling Fee','Waste','X - ray Report','Note')ASC"))->get(); 
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();    
       
        $pdf=PDF::loadview('pdf.quotePrint',['quotations'=>$quote_info,'key'=>$key_ref,'clients'=>$client_info,'parts_total'=>$partsTotal,'insurers'=>$insurer_info,'comments'=>$quote_comments,'paint_supply'=>$paint_suppl,'paint_total'=>$paintTotal,'labour_total'=>$labourTotal,'strip_total'=>$stripTotal,'frame_total'=>$frameTotal,'outwork_total'=>$outworkTotal,'waste_total'=>$wasteTotal,'bett_total'=>$bettTotal,'covid_total'=>$covidTotal]);
        return $pdf->stream('"'.$key_ref.'-Estimate-Time".pdf');
    }


    
    public function printQuoteMoney($key_ref){
        //$quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        $client_info=DB::table('client_details')->where('Key_Ref','=',$key_ref)->limit(1)->get();
        $insurer_info=DB::table('insurer')->where('Key_Ref','=',$key_ref)->get();
        $quote_comments=DB::table('qoutecomments')->where('Key_Ref','=',$key_ref)->get();
        $paint_suppl=DB::table('insurer')->select('PaintSup','ShopSup')->where('Key_Ref','=',$key_ref)->get();
        $partsTotal=DB::table('qoutes')->selectRaw('sum(qoutes.Part*qoutes.Quantity) as partTotal')->get();
        $paintTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Paint');
        $labourTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Labour');
        $stripTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Strip');
        $frameTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Frame');
        $outworkTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Misc');
        $bettTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Betterment');
        $sundriesTotal=$paintTotal*0.1;
        $wasteTotal=DB::table('betterment')->where('Key_Ref','=',$key_ref)->get();

        $covid_new=0;
        foreach($insurer_info as $in_covid){
            $covid_new=$in_covid->covid;
        }
        if(!$wasteTotal->isEmpty()){
        foreach($wasteTotal as $waste_amo){
            $wasteTotal=$waste_amo->waste;
        }
        }else{
            $wasteTotal=0;
        }

        $covidTotal=0;
            $covid_total=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->where('Description','=','Covid-19/Sanitizer')->get();
            if(!$covid_total->isEmpty()){
                foreach($covid_total as $covid){
                    $covidTotal=$covid_new;
                }
            }else{
                 $covidTotal=0;
            }

        //$quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->orderByRaw(DB::raw("FIELD(Oper,'New','NEW','Alternative','ALTERNATIVE','Second Hand','Used','Replace','Material','Steel Mat','Other','Oem','MARMIC','TAP','PAT HINDE','United Motors','TOYOTA','Inhouse','Inhse part','Inhse Rubberize','Inhse Elec Rep','Instock Item','In Hse Trailer/Towing','In Hse W/A as Per Report','In Hse Repair','In Hse Labor','In Hse Jig','In Hse Diagnostics as per Report','In Hse Regas','In Hse Sealant','Remanuf','Remanuf In Hse','REMANUF','R+R','Repair','REPAIR','PDR','D&A','Electrical Rep','Mechanical','Service','PDI','Partial Rep','Partial Paint','Realign','Blend','Spray','Clean','Paint','Adjust','Reform','Valet','Polish','Labor','Outwork','Diagnostics','Towing Invoice','Recon','Check','Check + Report','Refit','Sundries','Handling Fee','Waste','X - ray Report','Note')ASC"))->get();
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();    
        $pdf=PDF::loadview('pdf.quotationMoney',['quotations'=>$quote_info,'key'=>$key_ref,'clients'=>$client_info,'insurers'=>$insurer_info,'comments'=>$quote_comments,'paint_supply'=>$paint_suppl,'paint_total'=>$paintTotal,'labour_total'=>$labourTotal,'strip_total'=>$stripTotal,'frame_total'=>$frameTotal,'outwork_total'=>$outworkTotal,'sundries_total'=>$sundriesTotal,'waste_total'=>$wasteTotal,'bett_total'=>$bettTotal,'covid_total'=>$covidTotal]);
        return $pdf->stream('"'.$key_ref.'-Estimate".pdf');
    }

    public function agreed_time_quote($key_ref){
         
        //$quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        $client_info=DB::table('client_details')->where('Key_Ref','=',$key_ref)->limit(1)->get();
        $insurer_info=DB::table('insurer')->where('Key_Ref','=',$key_ref)->get();
        $quote_comments=DB::table('qoutecomments')->where('Key_Ref','=',$key_ref)->get();
        $paint_suppl=DB::table('insurer')->select('PaintSup','ShopSup')->where('Key_Ref','=',$key_ref)->get();
        //$partsTotal=DB::table('qoutes')->selectRaw('sum(qoutes.Part*qoutes.Quantity) as partTotal')->get();
        $partsTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Part');
        $paintTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Paint');
        $labourTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Labour');
        $stripTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Strip');
        $frameTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Frame');
        $outworkTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Misc');
        $bettTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Betterment');
        //$sundriesTotal=$paintTotal*0.1;
        
        $wasteTotal=DB::table('betterment')->where('Key_Ref','=',$key_ref)->get();
        
        if(!$wasteTotal->isEmpty()){
            foreach($wasteTotal as $waste_amo){
                $wasteTotal=$waste_amo->waste;
            }
            }else{
                $wasteTotal=0;
            }
        
        //$quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->orderByRaw(DB::raw("FIELD(Oper,'New','NEW','Alternative','ALTERNATIVE','Second Hand','Used','Replace','Material','Steel Mat','Other','Oem','MARMIC','TAP','PAT HINDE','United Motors','TOYOTA','Inhouse','Inhse part','Inhse Rubberize','Inhse Elec Rep','Instock Item','In Hse Trailer/Towing','In Hse W/A as Per Report','In Hse Repair','In Hse Labor','In Hse Jig','In Hse Diagnostics as per Report','In Hse Regas','In Hse Sealant','Remanuf','Remanuf In Hse','REMANUF','R+R','Repair','REPAIR','PDR','D&A','Electrical Rep','Mechanical','Service','PDI','Partial Rep','Partial Paint','Realign','Blend','Spray','Clean','Paint','Adjust','Reform','Valet','Polish','Labor','Outwork','Diagnostics','Towing Invoice','Recon','Check','Check + Report','Refit','Sundries','Handling Fee','Waste','X - ray Report','Note')ASC"))->get(); 
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();    
       
        $pdf=PDF::loadview('pdf.agreedtime',['quotations'=>$quote_info,'key'=>$key_ref,'clients'=>$client_info,'parts_total'=>$partsTotal,'insurers'=>$insurer_info,'comments'=>$quote_comments,'paint_supply'=>$paint_suppl,'paint_total'=>$paintTotal,'labour_total'=>$labourTotal,'strip_total'=>$stripTotal,'frame_total'=>$frameTotal,'outwork_total'=>$outworkTotal,'waste_total'=>$wasteTotal,'bett_total'=>$bettTotal]);
        return $pdf->stream('"'.$key_ref.'".pdf');   
    }

    public function agreed_money_quote($key_ref){
        $client_info=DB::table('client_details')->where('Key_Ref','=',$key_ref)->limit(1)->get();
        $insurer_info=DB::table('insurer')->where('Key_Ref','=',$key_ref)->get();
        $quote_comments=DB::table('qoutecomments')->where('Key_Ref','=',$key_ref)->get();
        $paint_suppl=DB::table('insurer')->select('PaintSup','ShopSup')->where('Key_Ref','=',$key_ref)->get();
        $partsTotal=DB::table('qoutes')->selectRaw('sum(qoutes.Part*qoutes.Quantity) as partTotal')->get();
        $paintTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Paint');
        $labourTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Labour');
        $stripTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Strip');
        $frameTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Frame');
        $outworkTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Misc');
        $bettTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Betterment');
        $sundriesTotal=$paintTotal*0.1;
        $wasteTotal=DB::table('betterment')->where('Key_Ref','=',$key_ref)->get();
        
        if(!$wasteTotal->isEmpty()){
            foreach($wasteTotal as $waste_amo){
                $wasteTotal=$waste_amo->waste;
            }
            }else{
                $wasteTotal=0;
            }
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->orderByRaw(DB::raw("FIELD(Oper,'New','NEW','Alternative','ALTERNATIVE','Second Hand','Used','Replace','Material','Steel Mat','Other','Oem','MARMIC','TAP','PAT HINDE','United Motors','TOYOTA','Inhouse','Inhse part','Inhse Rubberize','Inhse Elec Rep','Instock Item','In Hse Trailer/Towing','In Hse W/A as Per Report','In Hse Repair','In Hse Labor','In Hse Jig','In Hse Diagnostics as per Report','In Hse Regas','In Hse Sealant','Remanuf','Remanuf In Hse','REMANUF','R+R','Repair','REPAIR','PDR','D&A','Electrical Rep','Mechanical','Service','PDI','Partial Rep','Partial Paint','Realign','Blend','Spray','Clean','Paint','Adjust','Reform','Valet','Polish','Labor','Outwork','Diagnostics','Towing Invoice','Recon','Check','Check + Report','Refit','Sundries','Handling Fee','Waste','X - ray Report','Note')ASC"))->get();
        $pdf=PDF::loadview('pdf.agreedmoney',['quotations'=>$quote_info,'key'=>$key_ref,'clients'=>$client_info,'insurers'=>$insurer_info,'comments'=>$quote_comments,'paint_supply'=>$paint_suppl,'paint_total'=>$paintTotal,'labour_total'=>$labourTotal,'strip_total'=>$stripTotal,'frame_total'=>$frameTotal,'outwork_total'=>$outworkTotal,'sundries_total'=>$sundriesTotal,'waste_total'=>$wasteTotal,'bett_total'=>$bettTotal]);
        return $pdf->stream('"'.$key_ref.'Agreed-Money".pdf');
    }

    public function auth_money_quote($key_ref){
        $client_info=DB::table('client_details')->where('Key_Ref','=',$key_ref)->limit(1)->get();
        $insurer_info=DB::table('insurer')->where('Key_Ref','=',$key_ref)->get();
        $quote_comments=DB::table('qoutecomments')->where('Key_Ref','=',$key_ref)->get();
        $paint_suppl=DB::table('insurer')->select('PaintSup','ShopSup')->where('Key_Ref','=',$key_ref)->get();
        $partsTotal=DB::table('qoutes')->selectRaw('sum(qoutes.Part*qoutes.Quantity) as partTotal')->get();
        $paintTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Paint');
        $labourTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Labour');
        $stripTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Strip');
        $frameTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Frame');
        $outworkTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Misc');
        $bettTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Betterment');
        $sundriesTotal=$paintTotal*0.1;
        $wasteTotal=DB::table('betterment')->where('Key_Ref','=',$key_ref)->get();
        
        if(!$wasteTotal->isEmpty()){
            foreach($wasteTotal as $waste_amo){
                $wasteTotal=$waste_amo->waste;
            }
            }else{
                $wasteTotal=0;
            }
        //$quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->orderByRaw(DB::raw("FIELD(Oper,'New','NEW','Alternative','ALTERNATIVE','Second Hand','Used','Replace','Material','Steel Mat','Other','Oem','MARMIC','TAP','PAT HINDE','United Motors','TOYOTA','Inhouse','Inhse part','Inhse Rubberize','Inhse Elec Rep','Instock Item','In Hse Trailer/Towing','In Hse W/A as Per Report','In Hse Repair','In Hse Labor','In Hse Jig','In Hse Diagnostics as per Report','In Hse Regas','In Hse Sealant','Remanuf','Remanuf In Hse','REMANUF','R+R','Repair','REPAIR','PDR','D&A','Electrical Rep','Mechanical','Service','PDI','Partial Rep','Partial Paint','Realign','Blend','Spray','Clean','Paint','Adjust','Reform','Valet','Polish','Labor','Outwork','Diagnostics','Towing Invoice','Recon','Check','Check + Report','Refit','Sundries','Handling Fee','Waste','X - ray Report','Note')ASC"))->get();
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();
        $pdf=PDF::loadview('pdf.authmoney',['quotations'=>$quote_info,'key'=>$key_ref,'clients'=>$client_info,'insurers'=>$insurer_info,'comments'=>$quote_comments,'paint_supply'=>$paint_suppl,'paint_total'=>$paintTotal,'labour_total'=>$labourTotal,'strip_total'=>$stripTotal,'frame_total'=>$frameTotal,'outwork_total'=>$outworkTotal,'sundries_total'=>$sundriesTotal,'waste_total'=>$wasteTotal,'bett_total'=>$bettTotal]);
        return $pdf->stream('"'.$key_ref.'"-Athorize-Money.pdf');
    }

    public function auth_time_quote($key_ref){
        $client_info=DB::table('client_details')->where('Key_Ref','=',$key_ref)->limit(1)->get();
        $insurer_info=DB::table('insurer')->where('Key_Ref','=',$key_ref)->get();
        $quote_comments=DB::table('qoutecomments')->where('Key_Ref','=',$key_ref)->get();
        $paint_suppl=DB::table('insurer')->select('PaintSup','ShopSup')->where('Key_Ref','=',$key_ref)->get();
        //$partsTotal=DB::table('qoutes')->selectRaw('sum(qoutes.Part*qoutes.Quantity) as partTotal')->get();
        $partsTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Part');
        $paintTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Paint');
        $labourTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Labour');
        $stripTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Strip');
        $frameTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Frame');
        $outworkTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Misc');
        $bettTotal=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->sum('Betterment');
        //$sundriesTotal=$paintTotal*0.1;
        
        $wasteTotal=DB::table('betterment')->where('Key_Ref','=',$key_ref)->get();
        if(!$wasteTotal->isEmpty()){
            foreach($wasteTotal as $waste_amo){
                $wasteTotal=$waste_amo->waste;
            }
            }else{
                $wasteTotal=0;
            }
        
        //$quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->orderByRaw(DB::raw("FIELD(Oper,'New','NEW','Alternative','ALTERNATIVE','Second Hand','Used','Replace','Material','Steel Mat','Other','Oem','MARMIC','TAP','PAT HINDE','United Motors','TOYOTA','Inhouse','Inhse part','Inhse Rubberize','Inhse Elec Rep','Instock Item','In Hse Trailer/Towing','In Hse W/A as Per Report','In Hse Repair','In Hse Labor','In Hse Jig','In Hse Diagnostics as per Report','In Hse Regas','In Hse Sealant','Remanuf','Remanuf In Hse','REMANUF','R+R','Repair','REPAIR','PDR','D&A','Electrical Rep','Mechanical','Service','PDI','Partial Rep','Partial Paint','Realign','Blend','Spray','Clean','Paint','Adjust','Reform','Valet','Polish','Labor','Outwork','Diagnostics','Towing Invoice','Recon','Check','Check + Report','Refit','Sundries','Handling Fee','Waste','X - ray Report','Note')ASC"))->get(); 
        $quote_info=DB::table('qoutes')->where('Key_Ref','=',$key_ref)->get();    
       
        $pdf=PDF::loadview('pdf.authtime',['quotations'=>$quote_info,'key'=>$key_ref,'clients'=>$client_info,'parts_total'=>$partsTotal,'insurers'=>$insurer_info,'comments'=>$quote_comments,'paint_supply'=>$paint_suppl,'paint_total'=>$paintTotal,'labour_total'=>$labourTotal,'strip_total'=>$stripTotal,'frame_total'=>$frameTotal,'outwork_total'=>$outworkTotal,'waste_total'=>$wasteTotal,'bett_total'=>$bettTotal]);
        return $pdf->stream('"'.$key_ref.'".pdf'); 
    }

    public function printSalvage(){
        /*$salvage_list=DB::table('client_details')
                            ->where('client_details.status','=','0')->where('towing_history.salBranch','<>','N/A')->where('towing_history.salBranch','<>','')
                            ->join('towing_history','client_details.Key_Ref','=','towing_history.Key_Ref')
                            ->join('securityphotos','client_details.Key_Ref','=','securityphotos.Key_Ref')
                            
                            ->select('client_details.Key_Ref','client_details.Reg_No','client_details.Make','client_details.Model',
                            'client_details.Estimator','client_details.status','client_details.Date','client_details.towed_by',
                            'towing_history.insurer','towing_history.writeoff','towing_history.comment','towing_history.assessor',
                            'towing_history.salBranch')
                            ->limit(2000)
                            ->distinct('securityphotos.Key_Ref')
                            ->get();*/
          $salvage_list=DB::select("select client_details.ID,client_details.Key_Ref,client_details.Reg_No,client_details.Make,client_details.Model,
          client_details.Estimator,client_details.`status`,client_details.Date,client_details.towed_by,
          towing_history.insurer,towing_history.writeoff,towing_history.`comment`,towing_history.assessor,
          towing_history.salBranch
          FROM client_details
          INNER JOIN towing_history ON client_details.Key_Ref = towing_history.Key_Ref
          WHERE client_details.`status`='0' AND towing_history.salBranch<>'N/A' AND towing_history.salBranch<>'' ORDER BY client_details.ID");                              
                            $count_photo=array();
                            $status_arr=array();
        foreach($salvage_list as $photos_ref){
                
              $count_photos=DB::table('securityphotos')
                                ->where('securityphotos.Key_Ref','=',$photos_ref->Key_Ref)  
                                ->count();
             array_push($count_photo,($count_photos)); 
        }           

        foreach($salvage_list as $status_ref){
              $check_quote=DB::table('qoutes')
                                 ->where('Key_Ref','=',$status_ref->Key_Ref)     
                                 ->count();
              if($check_quote>0){
                  $status="Quoted";
              }elseif($status_ref->writeoff==1){
               $status="Write Off";         
              }else{
               $status="N/A";   
              }    
             array_push($status_arr,($status));
        }

        

        $salvage_photo_count=DB::table('client_details')
                                    ->where('client_details.status','=','0')
                                    ->join('securityphotos','client_details.Key_Ref','=','securityphotos.Key_Ref')
                                    ->count();    
                                    
        
                                    
        $pdf=PDF::loadview('pdf.salvageList',['salvage_list'=>$salvage_list,'photos'=>$count_photo,'count_fotos'=>$count_photos,'status'=>$status_arr])->setPaper('a4','landscape');
        //turn $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Salvage List.pdf');  
        	
			                  
    }


    public function print_assessors(){
    
            $assessor_details=DB::table('assessors')
                                    ->orderBy('Names','desc')
                                    ->distinct()
                                    ->limit(200)
                                    ->get();
            $pdf=PDF::loadview('pdf.assessorList',['assessor_list'=>$assessor_details])->setPaper('a4','landscape');
            
            return $pdf->stream('Assessor List.pdf');
    }


    public function print_prebookings(Request $request){
        $from=$request->from_date;
        $to=$request->to_date;
        //$from="2019/10/01";
        //$to="2020/01/31";
        $pre_booking_details=DB::table('pre_booking')
                                    ->join('client_details','pre_booking.Key_Ref','=','client_details.Key_Ref')
                                    ->leftjoin('insurer','pre_booking.Key_Ref','=','insurer.Key_Ref')
                                    ->whereBetween('pre_booking.booking_date1',[$from,$to])
                                    ->select('pre_booking.Key_Ref','pre_booking.booking_date1','pre_booking.booking_date2','pre_booking.booking_date3','pre_booking.booking_date4',
                                    'pre_booking.comment','client_details.Fisrt_Name','client_details.Last_Name','client_details.Cell_number','client_details.Make','client_details.Model','client_details.Estimator','client_details.Reg_No','insurer.Inserer')
                                    ->get();

            $pdf=PDF::loadview('pdf.prebooking',['prebooking_details'=>$pre_booking_details,'from_date'=>$from,'to_date'=>$to])->setPaper('a4','landscape');
            return $pdf->stream('Pre Booking.pdf');
     }

   
     public function print_client_notes($key_ref){
        $notes_details=DB::table('notes')
                            ->where('Key_Ref','=',$key_ref)
                            ->get();
                
        $client_details=DB::table('client_details')->where('Key_Ref','=',$key_ref)->limit(1)->get();                    

        $pdf=PDF::loadview('pdf.notes',['note_details'=>$notes_details,'client_details'=>$client_details]);
        return $pdf->stream('Client Notes.pdf');
    }

    public function print_line_manager_note($key_ref){
        $client=DB::table('client_details')->where('Key_Ref','=',$key_ref)->limit(1)->get();
        $notes=DB::table('notes')->where('Key_Ref','=',$key_ref)->get();    
        $smses=DB::table('sms_eventlog')->where('Key_Ref','=',$key_ref)->get();
        $pdf=PDF::loadview('pdf.linemanagernotes',['notes'=>$notes,'smses'=>$smses,'client'=>$client,'key'=>$key_ref]);
        return $pdf->stream('Notes.pdf');        
    } 



    public function print_stock_order($id){
        //$stock_order_details=DB::table('stock_order')->where('id','=',$id)->get();
        //$stock_order_list=DB::table('stock_order_list')->where('order_no','=',$id)->get();
        //$pdf=PDF::loadview('pdf.stockorder',['stock_details'=>$stock_order_details,'stock_list'=>$stock_order_list]);
        //return $pdf->stream('Stock.pdf');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
   
        //set document information
        //$pdf->SetCreator(PDF_CREATOR);
        //$pdf->SetAuthor('');
        //$pdf->SetTitle('TCPDF Example 001');
        //$pdf->SetSubject('TCPDF Tutorial');
        //$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        //$pdf->SetCreator(PDF_CREATOR);
        $pdf->SetHeaderData(PDF_HEADER_TITLE."ORDER NUMBER: "."#"."$id");
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 9, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        //$pdf->AddPage();
        // add a page

        $pdf->AddPage();

        $dbquery  =DB::select("SELECT * FROM stock_order WHERE id=?",[$id]);
       

        foreach($dbquery as $row){

        $a1 = $row->supplier;
        $a2 = $row->supplier_email;
        $a3 = $row->supplier_tel;
        $a4 = $row->supplier_cell;
        $a5 = $row->sender;
        $a6 = $row->sender_email;
        $a7 = $row->branch;
        $a8 = $row->status;
        $a9 = $row->order_date;
            
        if($row->branch=="The Glen"){
        $location = "Louis Avenue, Glen Eagles, 7945, Tel:(011) 432 0163";
        }

        if($row->branch=="Longmeadow"){	
        $location = "42 Longmeadow Blvd, Edenvale, 1609, Tel:(010) 500 0350";
        }

        if($row->branch=="Selby"){
        $location = "80 Booysen Road, Selby, 2001, Tel:(011) 493-9160";
        }
            
        if($row->branch==""){
        $location = "80 Booysen Road, Selby, 2001, Tel:(011) 493-9160";
        }	
        }

        $dbquery1  =DB::select("SELECT * FROM stock_order_list WHERE order_no=?",[$id]);

        

        $html=
        '<h5 style="color:blue;">Order No:'.$id.'</h5>
        <div style="background-color:#d5e3e4;" border="1">
        
        <table style="font-family:;  font-size:11px;">
        <tr>
        <td colspan="4" align="center" style=" font-size:22px;"><b>Official Order : Motor Accident Group</b></td>
        </tr>
        <tr>
        <td colspan="4"  align="center">'.$location.'</td>
        </tr><hr>

        <tr>
        <td><h4>Placed By</h4></td>
        <td>'.":".$a5.'</td>
        <td><h4>Email Address</h4></td>
        <td>'.":".$a6.'</td>
        </tr>

        <tr>
        <td><h4>Order No.</h4></td>
        <td>'.":".$id." - ".$a7.'</td>
        <td><h4>Order Date</h4></td>
        <td>'.":".$a9.'</td>
        </tr>

        <tr>
        <td><h4>Supplier.</h4></td>
        <td>'.":".$a1.'</td>
        <td><h4>Supplier Email</h4></td>
        <td>'.":".$a2.'</td>
        </tr>

        <tr>
        <td><h4>Supplier Tel.</h4></td>
        <td>'.":".$a3.'</td>
        <td><h4>Supplier Cell</h4></td>
        <td>'.":".$a4.'</td>
        </tr>

        </table>
        </div>';
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        $html=
        '<table border="1" style="font-family:;  font-size:11px;">
        <tr><td><h4>Please supply the undermentioned goods per:</h4></td></tr>
        </table>
        ';
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        $html=
        '
        <table border="1" style="font-family:;  font-size:11px;">
        <tr style="background-color:#d5e3e4;">
        <td style="width:75px;"><h4>Quantity</h4></td>
        <td style="width:278px;"><h4>Description</h4></td>
        <td style="width:278px;"><h4>Comment</h4></td>
        </tr>
        </table>
        ';
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        if(count($dbquery1)>0){
        foreach($dbquery1 as $row1){
            
        $b2 = $row1->description;	
        $b3 = $row1->quantity;	
        $b4 = $row1->comment;	
        $b5 = $row1->status;	
        $b6 = $row1->date;	

        $html=
        '
        <table border="1" style="font-family:;  font-size:11px;">
        <tr style="background-color:white;">
        <td style="width:75px;">'.$b3.'</td>
        <td style="width:278px;">'.$b2.'</td>
        <td style="width:278px;">'.$b4.'</td>
        </tr>
        </table>
        ';
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        }	
        }

        // ---------------------------------------------------------
        $html='
        <br><br><br>

        <table style="font-family:;" border="1">
        <tr>
        <td style="width:630px;" colspan="2"><br/><br/>
        <i><b>Note: </b>To be accompanied by invoice or delivery note bearing above order <br/>No:<b>'."#".$id.'</b></i>
        <br/><h5> <i>Please note this is an official order authorised by Motor Accident Group</i></h5>
        </td>
        </tr>
        </table><br/>'
        ;
        ob_end_clean();
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        //Close and output PDF document
        $fil_name='';
        $fil_name = $id.'-file.pdf';
        //$path='http://192.168.0.185:8080/Ordering_system/tcpdf/examples/orders/attach/'.$fil_name;

        

        //$pdf->Output($fil_name,'I');

        $pdf->Output($path,'F');







    }

    public function print_line_manager($id){
        $client_details=DB::table('client_details')->where('Key_Ref','=',$id)->limit(1)->get();
        foreach($client_details as $client){
            $ref=$client->Key_Ref;
            $make=$client->Vehicle_year ." ".$client->Make." ".$client->Model;
            $reg=$client->Reg_No; 
        }
        $stripz=0;
        $panel=0;
        $panelz=0;
        $paintz=0;
        $outz=0;
        $quote_details=DB::table('qoutes')->where('Key_Ref','=',$id)->get();
        foreach($quote_details as $quote){
            $stripz+=$quote->Strip;
            if($quote->Oper!='Mechancal'){
                $panel+=$quote->Labour;
            }else{
                $mechanicz+=$quote->Labour;
            }
            if($quote->Oper=='In Hse Jig'){
                $panelz+=getRate($id,$quote->Misc);
            }
            if($quote->Oper=='Valet'){
                $clnn+=getRate($id,$quote->Misc);
            }
            $panelz+=$quote->Frame;
            $paintz+=$quote->Paint;

        }
        $elecz=0;
        $resz5=DB::table('qoutes')
                        ->where('Key_Ref','=',$id)
                        ->where('Oper','=','Custom Elect')
                        ->orWhere('Oper','=','Custom Sound')
                        ->orWhere('Oper','=','Inhse Elect Rep')
                        ->orWhere('Oper','=','Electrical Rep')
                        ->get();
         foreach($resz5 as $electtic){
            if($electtic->Oper=='Custom Elec'||$electtic->Oper=='Custom Sound'||$electtic->Oper=='Inhse Elec Rep'||$electtic->Oper=='Electrical Rep'){
                $elecz+=$electtic->Labour;
            }
         }   
         
         $resz6=DB::table('qoutes')->where('Key_Ref','=',$id)->where('Misc','>',0)->get();
         foreach($resz6 as $query){
             $outz+=$this->getRate($id,$query->Misc);
         }

         $stripzAdd=0;
         $panelzAdd=0;
         $paintzAdd=0;
         $mechaniczAdd=0;
         $outzAdd=0;
         $eleczadd=0;

         $reszAdd=DB::table('additional')->where('Key_Ref','=',$id)->get();
         foreach($reszAdd as $add){
             $stripzAdd+=$this->getRate($id,$add->Strip);
             $stripzAdd+=$this->getRate($id,$add->RandR);
             $outzAdd+=$this->getRate($id,$add->Inhouse);

             if($add->Oper!='Mechanical'){
                 $panelzAdd+=$this->getRate($id,$add->Labour);
             }else{
                 $mechaniczAdd+=$this->getRate($id,$add->Labour);
             }
             if($add->Oper=='In Hse Jig'){
                 $panelzAdd+=$this->getRate($id,$add->Misc);
             }
             if($add->Oper=='Valet'){
                 $clnn+=$this->getRate($id,$add->Misc);

             }
             $panelzAdd+=$this->getRate($id,$add->Frame);
             $paintzAdd+=$this->getRate($id,$add->Paint);

         }
         $reszAdd5=DB::table('additional')
                        ->where('Key_Ref','=',$id)
                        ->where('Oper','=','Custom Elec')
                        ->orWhere('Oper','=','Custom Sound')
                        ->orWhere('Oper','=','Inhse Elect Rep')
                        ->orWhere('Oper','=','Electrical Rep')
                        ->get();

         foreach($reszAdd5 as $elect_add){
            if($elect_add->Oper=='Custom Elec'||$elect_add->Oper=='Custom Sound'||$elect_add->Oper=='Inhse Elec Rep'||$elect_add->Oper=='Electrical Rep'){
                $eleczAdd= $this->getRate($id,$elect_add->Labour);
            }
            }
         

         $reszAdd6 =DB::table('additional')
                            ->where('Key_Ref','=',$id)
                            ->where('Oper','=','Diagnostics')
                            ->orWhere('Oper','=','In Hse Jig')
                            ->orWhere('Oper','=','In Hse W/A as Per Report')
                            ->orWhere('Oper','=','Inhse Rubberize')
                            ->orWhere('Oper','=','Quality Inspection')
                            ->orWhere('Oper','=','Quality Inspection')
                            ->get();

         foreach($reszAdd6 as $out){
             $outzAdd=$this->getRate($id,$out->Misc);
         }

         $res=DB::table('workshop')
                    ->select('user','datetime')
                    ->distinct('user')
                    ->where('Key_Ref','=',$id)
                    ->where('stage','=','7')
                    ->orWhere('stage','=','11')
                    ->orderBy('datetime','asc')
                    ->get();

        $res_count=DB::table('workshop')
                    ->distinct('user')
                    ->where('Key_Ref','=',$id)
                    ->where('stage','=','7')
                    ->orWhere('stage','=','11')
                    ->count();
            
         if($res_count>0){
            foreach($res as $res1){
                
                $usa=$res1->user;
                $rec=array();
                $logtime=$res1->datetime;
                $date=substr($res1->datetime,0,10);
                $dated=$date.' 17:00:00';
                $spent=0;
                $wewant='';
                $wewant1='';
                $wewant2='';
                $wewant3='';
                $avail=array();
                $ress=DB::table('cleaning')->where('DATETIME','>',$logtime)->distinct('datetime')->where('USER','=',$usa)->limit(1)->get();
                $ress1=DB::table('workshop')->where('DATETIME','>',$logtime)->where('Key_Ref','=',$id)->where('USER','=',$usa)->distinct('datetime')->limit(1)->get();
                $ress2=DB::table('workshop')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->limit(1)->get();

                $ress_count=DB::table('cleaning')->where('DATETIME','>',$logtime)->distinct('datetime')->where('USER','=',$usa)->count();
                $ress1_count=DB::table('workshop')->where('DATETIME','>',$logtime)->where('Key_Ref','=',$id)->where('USER','=',$usa)->count();
                $ress2_count=DB::table('workshop')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','7')->orWhere('stage','=','11')->count();


                if($ress_count >0){
                    foreach($ress as $res){
                        $wewant1=$res->datetime;
                    }
                    array_push($avail,($wewant1));
                }
                if($ress1_count>0){
                    foreach($ress1 as $res1){
                        $wewant2=$re1->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if($ress2_count>0){
                    foreach($ress2 as $res2){
                        $wewant3=$res2->datetime;
                    }
                   array_push($avail,($wewant3)); 
                }
                if(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))>strtotime($date. ' 17:00:00'))){
                    $wewant=$dated;
                }elseif(count($avail)>=1){
                    $wewant=min($avail);
                }elseif(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))<strtotime($date.' 17:00:00'))){
                    $wewant='In Progress...';
                }
                if(strtotime(substr($wewant,0,10))==strtotime($date)){
                    $spent= $this->getRemainingTime($logtime,$wewant)/3600;
                }elseif(strtotime($wewant)>strtotime($logtime) && (strtotime(substr($wewant,0,10))>strtotime($date))){
                    $spent=$this->getRemainingTime($logtime,$date. ' 17:00:00')/3600;
                    $wewant=$date.' 17:00:00';
                }
            
                array_push($panel,$spent);
                $tr1.='<tr style="font-size:8;">
                <td style="width:150">' . $usa . '</td>
                <td style="width:50">Panel</td>
                <td style="width:100">' . $logtime . '</td>
                <td style="width:100">' . $wewant . '</td>
                <td style="width:50;text-align:right"></td>
                <td style="width:50;text-align:right">' . number_format($spent, 2) . '</td>
                <td style="width:50;text-align:right">' . number_format($panelz - array_sum($panel), 2) . '</td>
            </tr>';    
            }
            $pnel=array_sum($panel);
         }
         $color='';
         if(($panelz + $panelzAdd-($pnel))<0){
             $color="red";
         }
         $tr1 .= '<tr style="font-size:8;">
            <td colspan="4" style="width:400"><b>ADDITIONAL</b></td>
            <td style="width:50;text-align:right"><b>' . number_format($panelzAdd, 2) . '</b></td>
            <td style="width:50;text-align:right"><b>' . number_format(0, 2) . '</b></td>
            <td style="width:50;text-align:right"><b>' . number_format($panelz + $panelzAdd - ($pnel), 2) . '</b></td>
        </tr>
        <tr style="font-size:8;">
            <td colspan="4" style="width:400"><b>TOTAL</b></td>
            <td style="width:50;text-align:right"><b>' . number_format($panelz + $panelzAdd, 2) . '</b></td>
            <td style="width:50;text-align:right"><b>' . number_format($pnel, 2) . '</b></td>
            <td style="width:50;text-align:right;color:'.$color.'"><b>' . number_format($panelz + $panelzAdd - ($pnel), 2) . '</b></td>
        </tr><tr><td colspan="5"></td></tr>';

         $res2=DB::table('workshop')->select('user','datetime')->where('Key_Ref','=',$id)->where('stage','=','10')->orWhere('stage','=','26')->orWhere('stage','=','27')->orWhere('stage','=','28')->orWhere('stage','=','29')->orderBy('datetime','asc')->distinct('user')->get();
         $res2_count=DB::table('workshop')->select('user','datetime')->where('Key_Ref','=',$id)->where('stage','=','10')->orWhere('stage','=','26')->orWhere('stage','=','27')->orWhere('stage','=','28')->orWhere('stage','=','29')->count();

         if($res2_count>0){
             $add=0;
             foreach($res2 as $res_2){
                 $usa=$res_2->user;
                 $rec=array();
                 $logtime=$row_2->datetime;
                 $date=substr($res_2->datetime,0,10);
                 $dated=$date.' 17:00:00';
                 $spent=0;
                 $wewant='';
                 $wewant1='';
                 $wewant2='';
                 $wewant3='';
                 $avail=array();
                 $ress=DB::table('cleaning')->distinict('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->limit(1)->get();
                 $ress1=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('Key_Ref','=',$id)->where('USER','=',$usa)->limit(1)->get();
                 $ress2=DB::table('workshop')->distinct('workshop')->where('DATETIME','>',$logtime)->where('USER','=',$usa)
                                    ->where('stage','=','10')
                                    ->orWhere('stage','=','26')
                                    ->orWhere('stage','=','27')
                                    ->orWhere('stage','=','28')
                                    ->orWhere('stage','=','29')
                                    ->limit(1)
                                    ->get();
                $ress_count=DB::table('cleaning')->distinict('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->count();
                $ress1_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('Key_Ref','=',$id)->where('USER','=',$usa)->count();
                $ress2_count=DB::table('workshop')->distinct('workshop')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','10')->orWhere('stage','=','26')->orWhere('stage','=','27')->orWhere('stage','=','28')->orWhere('stage','=','29')->count();   
                if($res_count>0){
                    foreach($ress as $res){
                        $wewant1=$res->datetime;
                    }
                    array_push($avail,($wewant1));
                }
                if($ress1_count>0){
                    foreach($ress1 as $res1){
                        $wewant2=$res1->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if($ress2_count>0){
                    foreach($ress2 as $res2){
                        $wewant3=$res2->datetime;
                    }
                    array_push($avail,($wewant3));
                }
                if(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))>strtotime($date . ' 17:00:00'))){
                    $wewant = $dated;
                }elseif(count($avail)>=1){
                    $wewant = min($avail);
                }elseif(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))<strtotime($date . ' 17:00:00'))){
                    $wewant = 'In Progress...';
                }
                if (strtotime(substr($wewant, 0, 10)) == strtotime($date)) {
                    $spent = getRemainingTime($logtime, $wewant) / 3600;
        
                } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                    $spent = getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                    $wewant =$date . ' 17:00:00'; 
                } 
                array_push($paintt, $spent);
        $tr2 .= '<tr style="font-size:8;">
                        <td style="width:150">' . $usa . '</td>
                        <td style="width:50">Paint</td>
                        <td style="width:100">' . $logtime . '</td>
                        <td style="width:100">' . $wewant . '</td>
                        <td style="width:50;text-align:right"></td>
                        <td style="width:50;text-align:right">' . number_format($spent, 2) . '</td>
                        <td style="width:50;text-align:right">' . number_format($paintz - array_sum($paintt), 2) . '</td>
                    </tr>';               
             }
             $pnt = array_sum($paintt);
         }
                $color = '';
        if((($paintz-getPolishTime($id,$db)) + $paintzAdd - ($pnt))<0){
            $color = 'red';
        }
        $tr2 .= '<tr style="font-size:8;">
            <td colspan="4" style="width:400"><b>ADDITIONAL</b></td>
            <td style="width:50;text-align:right"><b>' . number_format($paintzAdd, 2) . '</b></td>
            <td style="width:50;text-align:right"><b>' . number_format(0, 2) . '</b></td>
            <td style="width:50;text-align:right"><b>' . number_format(($paintz-getPolishTime($id,$db)) + $paintzAdd - ($pnt), 2) . '</b></td>
        </tr>
        <tr style="font-size:8;">
            <td colspan="4" style="width:400"><b>TOTAL</b></td>
            <td style="width:50;text-align:right"><b>' . number_format(($paintz-getPolishTime($id,$db)) + $paintzAdd, 2) . '</b></td>
            <td style="width:50;text-align:right"><b>' . number_format($pnt, 2) . '</b></td>
            <td style="width:50;text-align:right;color:'.$color.'"><b>' . number_format(($paintz-getPolishTime($id,$db)) + $paintzAdd - ($pnt), 2) . '</b></td>
        </tr><tr><td colspan="5"></td></tr>';

        $res4=DB::table('workshop')->select('user','datetime')->distinct('user')->where('Key_Ref','=',$id)->wher('stage','=','8')->orderBy('datetime','asc')->get();
        $res4_count=DB::table('workshop')->select('user','datetime')->distinct('user')->where('Key_Ref','=',$id)->wher('stage','=','8')->count();
        if($res4_count>0){
            $add=0;
            foreach($res4 as $res_4){
                $usa=$res_4->user;
                $rec=array();
                $logtime=$res_4->datetime;
                $date=substr($res_4->datetime,0,10);
                $dated=$date. ' 17:00:00';
                $spent=0;
                $wewant = '';
                $wewant1 = '';
                $wewant2 = '';
                $wewant3 = '';
                $avail = array();
                $ress=DB::table('cleaning')->distinict('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->limit(1)->get();
                 $ress1=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('Key_Ref','=',$id)->where('USER','=',$usa)->limit(1)->get();
                 $ress2=DB::table('workshop')->distinct('workshop')->where('DATETIME','>',$logtime)->where('USER','=',$usa)
                                    ->where('stage','=','8')
                                    ->limit(1)
                                    ->get();
                $ress_count=DB::table('cleaning')->distinict('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->count();
                $ress1_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('Key_Ref','=',$id)->where('USER','=',$usa)->count();
                $ress2_count=DB::table('workshop')->distinct('workshop')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','8')->count();

                if($ress_count>0){
                    foreach($ress as $res){
                        $wewant1=$res->datetime;
                    }
                    array_push($avail,($wewant1));
                }
                if($ress1_count>0){
                    foreach($ress1 as $res_1){
                        $wewant2=$res_1->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if($ress2_count>0){
                    foreach($ress2 as $res_2){
                        $wewant3=$res_2->datetime;
                    }
                    array_push($avail,($wewant3));
                }
                if(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))>strtotime($date . ' 17:00:00'))){
                    $wewant = $dated;
                }elseif(count($avail)>=1){
                    $wewant = min($avail);
                }elseif(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))<strtotime($date . ' 17:00:00'))){
                    $wewant = 'In Progress...';
                }
                if (strtotime(substr($wewant, 0, 10)) == strtotime($date)) {
                    $spent = getRemainingTime($logtime, $wewant) / 3600;
        
                } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                    $spent = getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                    $wewant =$date . ' 17:00:00'; 
                }
                array_push($mechanicc, $spent);
                $tr4 .= '<tr style="font-size:8;">
                    <td style="width:150">' . $usa . '</td>
                    <td style="width:50">Mechanic</td>
                    <td style="width:100">' . $logtime . '</td>
                    <td style="width:100">' . $wewant . '</td>
                    <td style="width:50;text-align:right"></td>
                    <td style="width:50;text-align:right">' . number_format($spent, 2) . '</td>
                    <td style="width:50;text-align:right">' . number_format($mechanicz - array_sum($mechanicc), 2) . '</td>
                </tr>';
            }
            $mech=array_sum($mechanicc);
        }
                $color = '';
        if(($mechanicz + $mechaniczAdd - ($mech))<0){
            $color = 'red';
        }
        $tr4 .= '<tr style="font-size:8;">
            <td colspan="4" style="width:400"><b>ADDITIONAL</b></td>
            <td style="width:50;text-align:right"><b>' . number_format($mechaniczAdd, 2) . '</b></td>
            <td style="width:50;text-align:right"><b>' . number_format(0, 2) . '</b></td>
            <td style="width:50;text-align:right"><b>' . number_format($mechanicz + $mechaniczAdd - ($mech), 2) . '</b></td>
        </tr>
        <tr style="font-size:8;">
                <td colspan="4" style="width:400"><b>TOTAL</b></td>
                <td style="width:50;text-align:right"><b>' . number_format($mechanicz + $mechaniczAdd, 2) . '</b></td>
                <td style="width:50;text-align:right"><b>' . number_format($mech, 2) . '</b></td>
                <td style="width:50;text-align:right;color:'.$color.'"><b>' . number_format($mechanicz + $mechaniczAdd - ($mech), 2) . '</b></td>
            </tr><tr><td colspan="5"></td></tr>';

        $res6=DB::table('workshop')->select('user','datetime')->distinct('datetime')->where('Key_Ref','=',$id)->where('stage','=','25')->orderBy('datetime','asc')->get();
        $res6_count=DB::table('workshop')->select('user','datetime')->distinct('datetime')->where('Key_Ref','=',$id)->where('stage','=','25')->count();
        if($res6_count>0){
            $add=0;
            foreach($res6 as $res_6){
                $usa=$res_6->user;
                $rec=array();
                $logtime=$res_6->datetime;
                $date=substr($res_6->datetime,0,10);
                $dated=$date.' 17:00:00';
                $spent = 0;
                $wewant = '';
                $wewant1 = '';
                $wewant2 = '';
                $wewant3 = '';
                $avail = array();
                $ress=DB::table('cleaning')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->limit(1)->get();
                $ress1=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('Key_Ref','=',$id)->where('USER','=',$usa)->get();
                $ress2=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','25')->get();

                $ress_count=DB::table('cleaning')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->count();
                $ress1_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('Key_Ref','=',$id)->where('USER','=',$usa)->count(); 
                $ress2_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','25')->count();  

                if($ress_count>0){
                    foreach($ress as $res){
                        $wewant1=$res->datetime;
                    }
                    array_push($avail,($wewant1));
                }
                if($ress1_count>0){
                    foreach($ress1 as $res1){
                        $wewant2=$res1->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if($ress2_count>0){
                    foreach($ress2 as $res2){
                        $wewant3=$res2->datetime;
                    }
                    array_push($avail,($wewant3));
                }
                if(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))>strtotime($date . ' 17:00:00'))){
                    $wewant = $dated;
                }elseif(count($avail)>=1){
                    $wewant = min($avail);
                }elseif(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))<strtotime($date . ' 17:00:00'))){
                    $wewant = 'In Progress...';
                }
                if (strtotime(substr($wewant, 0, 10)) == strtotime($date)) {
                    $spent = getRemainingTime($logtime, $wewant) / 3600;
        
                } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                    $spent = getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                    $wewant =$date . ' 17:00:00'; 
                }
                array_push($polishh, $spent);
                $tr6.= '<tr style="font-size:8;">
                            <td style="width:150">' . $usa . '</td>
                            <td style="width:50">Polish</td>
                            <td style="width:100">' . $logtime . '</td>
                            <td style="width:100">' . $wewant . '</td>
                            <td style="width:50;text-align:right"></td>
                            <td style="width:50;text-align:right">' . number_format($spent, 2) . '</td>
                            <td style="width:50;text-align:right">' . number_format($polishz - array_sum($polishh), 2) . '</td>
                        </tr>';
            }
            $polish = array_sum($polishh);
        }
        $color = '';
        if(($polishz - ($polish))<0){
            $color = 'red';
        }
            $tr6 .= '<tr style="font-size:8;">
                            <td colspan="4" style="width:400"><b>TOTAL</b></td>
                            <td style="width:50;text-align:right"><b>' . number_format($polishz, 2) . '</b></td>
                            <td style="width:50;text-align:right"><b>' . number_format($polish, 2) . '</b></td>
                            <td style="width:50;text-align:right;color:'.$color.'"><b>' . number_format($polishz - ($polish), 2) . '</b></td>
                        </tr><tr><td colspan="5"></td></tr>';
            
               $res7=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$id)->where('stage','=','14')->orderBy('datetime','asc')->get();                
               $res7_count=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$id)->where('stage','=','14')->count();
               if($res7_count>0){
                $add=0;
                foreach($res7 as $res_7){
                    $usa=$res_7->user;
                    $rec=array();
                    $logtime=$res_7->datetime;
                    $date=substr($res_7->datetime,0,10);
                    $dated=$date.' 17:00:00';
                    $spent = 0;
                    $wewant = '';
                    $wewant1 = '';
                    $wewant2 = '';
                    $wewant3 = '';
                    $avail = array();
                    $ress=DB::table('cleaning')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->limit(1)->get();
                    $ress1=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('Key_Ref','=',$id)->where('USER','=',$usa)->get();
                    $ress2=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','25')->get();

                    $ress_count=DB::table('cleaning')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->count();
                    $ress1_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('Key_Ref','=',$id)->where('USER','=',$usa)->count(); 
                    $ress2_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','25')->count();  

                    if($ress_count>0){
                        foreach($ress as $res){
                            $wewant1=$res->datetime;
                        }
                        array_push($avail,($wewant1));
                    }
                    if($ress1_count>0){
                        foreach($ress1 as $res1){
                            $wewant2=$res1->datetime;
                        }
                        array_push($avail,($wewant2));
                    }
                    if($ress2_count>0){
                        foreach($ress2 as $res2){
                            $wewant3=$res2->datetime;
                        }
                        array_push($avail,($wewant3));
                    }
                    if(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))>strtotime($date . ' 17:00:00'))){
                        $wewant = $dated;
                    }elseif(count($avail)>=1){
                        $wewant = min($avail);
                    }elseif(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))<strtotime($date . ' 17:00:00'))){
                        $wewant = 'In Progress...';
                    }
                    if (strtotime(substr($wewant, 0, 10)) == strtotime($date)) {
                        $spent = getRemainingTime($logtime, $wewant) / 3600;
            
                    } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                        $spent = getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                        $wewant =$date . ' 17:00:00'; 
                    }
                    array_push($cleann, $spent);
                    $tr7.= '<tr style="font-size:8;">
                                <td style="width:150">' . $usa . '</td>
                                <td style="width:50">Cleaning</td>
                                <td style="width:100">' . $logtime . '</td>
                                <td style="width:100">' . $wewant . '</td>
                                <td style="width:50;text-align:right"></td>
                                <td style="width:50;text-align:right">' . number_format($spent, 2) . '</td>
                                <td style="width:50;text-align:right">' . number_format($clnn - array_sum($cleann), 2) . '</td>
                            </tr>';

                }
                $clean = array_sum($cleann);
                }
                $color = '';
                if(($clnn - ($clean))<0){
                    $color = 'red';
                }
                $tr7 .= '<tr style="font-size:8;">
                                <td colspan="4" style="width:400"><b>TOTAL</b></td>
                                <td style="width:50;text-align:right"><b>' . number_format($clnn, 2) . '</b></td>
                                <td style="width:50;text-align:right"><b>' . number_format($clean, 2) . '</b></td>
                                <td style="width:50;text-align:right;color:'.$color.'"><b>' . number_format($clnn - ($clean), 2) . '</b></td>
                            </tr><tr><td colspan="5"></td></tr>';

                 $res9=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$id)->where('stage','=','12')->orWhere('stage','=','13')->orWhere('stage','=','30')-orderBy('datetime')->get();          
                 $res9_count=DB::table('workshop')->distinct('user')->where('Key_Ref','=',$id)->where('stage','=','12')->orWhere('stage','=','13')->orWhere('stage','=','30')-count();
                 if($res9_count>0){
                     $add=0;
                     foreach($res9 as $res_9){
                         $usa=$res_9->user;
                         $rec=array();
                         $logtime=$res_9->datetime;
                         $date=substr($res_9->datetime,0,10);
                         $dated = $date . ' 17:00:00';
                            $spent = 0;
                            $wewant = '';
                            $wewant1 = '';
                            $wewant2 = '';
                            $wewant3 = '';
                            $avail = array();
                            $ress=DB::table('cleaning')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->limit(1)->get();
                            $ress1=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('Key_Ref','=',$id)->where('USER','=',$usa)->get();
                            $ress2=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','12')->orWhere('stage','=','13')->orWhere('stage','=','31')->orWhere('stage','=','30')->limit(1)->get();
        
                            $ress_count=DB::table('cleaning')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->count();
                            $ress1_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('Key_Ref','=',$id)->where('USER','=',$usa)->count(); 
                            $ress2_count=DB::table('workshop')->distinct('datetime')->where('DATETIME','>',$logtime)->where('USER','=',$usa)->where('stage','=','25')->count();  

                            if($ress_count>0){
                                foreach($ress as $res){
                                    $wewant1=$res->datetime;
                                }
                                array_push($avail,($wewant1));
                            }
                            if($ress1_count>0){
                                foreach($ress1 as $res_1){
                                    $wewant2=$res->datetime;
                                }
                                array_push($avail,($wewant2));
                            }
                            if($ress2_count>0){
                                foreach($ress2 as $res2){
                                    $wewant3=$res->datetime;

                                }
                                array_push($avail,($wewant3));
                            }
                            if(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))>strtotime($date . ' 17:00:00'))){
                                $wewant = $dated;
                            }elseif(count($avail)>=1){
                                $wewant = min($avail);
                            }elseif(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))<strtotime($date . ' 17:00:00'))){
                                $wewant = 'In Progress...';
                            }
                            if (strtotime(substr($wewant, 0, 10)) == strtotime($date)) {
                                $spent = getRemainingTime($logtime, $wewant) / 3600;
                    
                            } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                                $spent = getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                                $wewant =$date . ' 17:00:00'; 
                            }
                            array_push($outt, $spent);
                            $tr9.= '<tr style="font-size:8;">
                            <td style="width:150">' . $usa . '</td>
                            <td style="width:50">Outwork</td>
                            <td style="width:100">' . $logtime . '</td>
                            <td style="width:100">' . $wewant . '</td>
                            <td style="width:50;text-align:right"></td>
                            <td style="width:50;text-align:right">' . number_format($spent, 2) . '</td>
                            <td style="width:50;text-align:right">' . number_format($outz - array_sum($outt), 2) . '</td>
                        </tr>';
            }
            $out = array_sum($outt);
                     
                 }
                 $tr9 .= '<tr style="font-size:8;">
                 <td colspan="4" style="width:400"><b>ADDITIONAL</b></td>
                 <td style="width:50;text-align:right"><b>' . number_format($outzAdd, 2) . '</b></td>
                 <td style="width:50;text-align:right"><b>' . number_format(0, 2) . '</b></td>
                 <td style="width:50;text-align:right"><b>' . number_format($outz + $outzAdd - ($out), 2) . '</b></td>
             </tr>
             <tr style="font-size:8;">
                 <td colspan="4" style="width:400"><b>TOTAL</b></td>
                 <td style="width:50;text-align:right"><b>' . number_format($outz + $outzAdd, 2) . '</b></td>
                 <td style="width:50;text-align:right"><b>' . number_format($out, 2) . '</b></td>
                 <td style="width:50;text-align:right"><b>' . number_format($outz + $outzAdd - ($out), 2) . '</b></td>
             </tr><tr><td colspan="5"></td></tr>';
             
             $res10=DB::table('confirmed_orders')->where('Key_Ref','=',$id)->orderBy('id','asc')->get();
             $res10_count=DB::table('confirmed_orders')->where('Key_Ref','=',$id)->count();
             if($res10>0){
                 foreach($res10 as $res_10){
                   $ord=$res_10->order_number;
                   $res10_=DB::table('orders')->distinct('orders.Description')
                                         ->join('qoutes','orders.Description_2','=','qoutes.Description_2','orders.Key_Ref','=','qoutes.Key_Ref')
                                         ->where('orders.Key_Ref','=',$id)
                                         ->where('orders.order_number','=',$ord)
                                         ->orderBy('orders.id')
                                         ->get();
                 foreach($res10_ as $roww){
                     $recei='';
                     if($roww->Part_sales>0){
                         $recei='&#10004';
                     }
                     $tr10 .= '<tr style="text-align:center;">
                                    <td style="border-bottom:1px solid #333;font-size:8;">' . $row->user . '</td>
                                    <td style="border-bottom:1px solid #333;font-size:8;">' . $row->order_number . '</td>
                                    <td style="border-bottom:1px solid #333;font-size:8;">' . $roww->Description_2 . '</td>
                                    <td style="border-bottom:1px solid #333;font-size:8;">' . $roww->quantity. '</td>
                                    <td style="border-bottom:1px solid #333;font-size:8;">' . $row->date . '</td>
                                    <td style="border-bottom:1px solid #333;font-size:12;text-align:center;color:green;">' . $recei . '</td>
                                </tr>';
                 }                        
                                          
                 }
             }

             $tr5 = '';
             $ttat = ($stripz + $panelz + ($paintz-getPolishTime($id,$db)) + $mechanicz + $clnn + $polishz + $outz +
             $stripzAdd + $panelzAdd + $paintzAdd + $mechaniczAdd + $outzAdd);
             $ttst = ($strp) + ($pnel) + ($pnt) + ($assmb) + ($mech) + ($clean) + ($polish);

             $tbl = '<h3 style="text-align:center"><b>' . $ref . '<br><span style="font-size:10;">MAKE :<span style="color:grey">'.strtoupper($make).'</span> REGISTRATION :<span style="color:grey">'.strtoupper($reg).'</span></span></b></h3><br>
                <h5 style="text-align:center">Total Allowed Time:&nbsp;' . number_format($ttat, 2) . ' hrs</h5>
                <hr>
                <h5 style="font-size:10">STRIPPING + ASSEMBLY (Remove And Replace)</h5>
                <table style="font-family: Verdana , Verdana;">
                                    <thead>
                                        <tr style="font-size:9;background-color:#333;color:#fff">
                                            <th style="width:150"><b>Name</b></th>
                                            <th style="width:50"><b>Oper</b></th>
                                            <th style="width:100"><b>Started</b></th>
                                            <th style="width:100"><b>Finished</b></th>
                                            <th style="width:50;text-align:right"><b>A-Time</b></th>
                                            <th style="width:50;text-align:right"><b>S-Time</b></th>
                                            <th style="width:50;text-align:right"><b>R-Time</b></th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size:8;">' . $tr . '</tbody></table>
                <hr>
                <h5 style="font-size:10">PANEL BEATING (Frame And Repair)</h5>
                <table style="font-family: Verdana , Verdana;">
                    <thead>
                        <tr style="font-size:9;background-color:#333;color:#fff">
                            <th style="width:150"><b>Name</b></th>
                            <th style="width:50"><b>Oper</b></th>
                            <th style="width:100"><b>Started</b></th>
                            <th style="width:100"><b>Finished</b></th>
                            <th style="width:50;text-align:right"><b>A-Time</b></th>
                            <th style="width:50;text-align:right"><b>S-Time</b></th>
                            <th style="width:50;text-align:right"><b>R-Time</b></th>
                        </tr>
                    </thead>
                    <tbody style="font-size:8;">' . $tr1 . '</tbody></table>
                    <hr>
                    <h5 style="font-size:10">PAINTING (Flatting, Masking, Preparation And Spray)</h5>
                <table style="font-family: Verdana , Verdana;">
                    <thead>
                        <tr style="font-size:9;background-color:#333;color:#fff">
                            <th style="width:150"><b>Name</b></th>
                            <th style="width:50"><b>Oper</b></th>
                            <th style="width:100"><b>Started</b></th>
                            <th style="width:100"><b>Finished</b></th>
                            <th style="width:50;text-align:right"><b>A-Time</b></th>
                            <th style="width:50;text-align:right"><b>S-Time</b></th>
                            <th style="width:50;text-align:right"><b>R-Time</b></th>
                        </tr>
                    </thead>
                    <tbody style="font-size:8;">' . $tr2 . '</tbody></table>
                    <hr>
                    <h5 style="font-size:10">MECHANICAL</h5>
                <table style="font-family: Verdana , Verdana;">
                    <thead>
                        <tr style="font-size:9;background-color:#333;color:#fff">
                            <th style="width:150"><b>Name</b></th>
                            <th style="width:50"><b>Oper</b></th>
                            <th style="width:100"><b>Started</b></th>
                            <th style="width:100"><b>Finished</b></th>
                            <th style="width:50;text-align:right"><b>A-Time</b></th>
                            <th style="width:50;text-align:right"><b>S-Time</b></th>
                            <th style="width:50;text-align:right"><b>R-Time</b></th>
                        </tr>
                    </thead>
                    <tbody style="font-size:8;">' . $tr4 . '</tbody></table>
                    <hr>
                    <h5 style="font-size:10">OUTWORK/INHOUSE (Inhouse Jig + Electrical + Quality Control)</h5>
                <table style="font-family: Verdana , Verdana;">
                    <thead>
                        <tr style="font-size:9;background-color:#333;color:#fff">
                            <th style="width:150"><b>Name</b></th>
                            <th style="width:50"><b>Oper</b></th>
                            <th style="width:100"><b>Started</b></th>
                            <th style="width:100"><b>Finished</b></th>
                            <th style="width:50;text-align:right"><b>A-Time</b></th>
                            <th style="width:50;text-align:right"><b>S-Time</b></th>
                            <th style="width:50;text-align:right"><b>R-Time</b></th>
                        </tr>
                    </thead>
                    <tbody style="font-size:8;">' . $tr9 . '</tbody></table>
                    <hr>
                    <h5 style="font-size:10">POLISHING</h5>
                <table style="font-family: Verdana , Verdana;">
                    <thead>
                        <tr style="font-size:9;background-color:#333;color:#fff">
                            <th style="width:150"><b>Name</b></th>
                            <th style="width:50"><b>Oper</b></th>
                            <th style="width:100"><b>Started</b></th>
                            <th style="width:100"><b>Finished</b></th>
                            <th style="width:50;text-align:right"><b>A-Time</b></th>
                            <th style="width:50;text-align:right"><b>S-Time</b></th>
                            <th style="width:50;text-align:right"><b>R-Time</b></th>
                        </tr>
                    </thead>
                    <tbody style="font-size:8;">' . $tr6 . '</tbody></table>
                    <hr>
                    <h5 style="font-size:10">CLEANING + VALET</h5>
                    <table style="font-family: Verdana , Verdana;">
                        <thead>
                            <tr style="font-size:9;background-color:#333;color:#fff">
                                <th style="width:150"><b>Name</b></th>
                                <th style="width:50"><b>Oper</b></th>
                                <th style="width:100"><b>Started</b></th>
                                <th style="width:100"><b>Finished</b></th>
                                <th style="width:50;text-align:right"><b>A-Time</b></th>
                                <th style="width:50;text-align:right"><b>S-Time</b></th>
                                <th style="width:50;text-align:right"><b>R-Time</b></th>
                            </tr>
                        </thead>
                        <tbody style="font-size:8;">' . $tr7 . '</tbody></table>
                    <hr>
                    <table style="font-family: Verdana , Verdana;font-size:9;">
                        <tr>
                            <td style="font-size:10"><b>TOTAL TIME SPENT</b></td>
                            <td>: <b>' . number_format($ttst, 2) . '</b> Hrs</td>
                        </tr>
                        <tr>
                            <td><b>TOTAL TIME LEFT</b></td>
                            <td>: <b>' . number_format($ttat - $ttst, 2) . '</b> Hrs</td>
                        </tr>
                    </table>
                    <hr>
                    <h5 style="font-size:10">ORDERING</h5>
                    <table style="font-family: Verdana , Verdana;font-size:9;">
                        <thead>
                            <tr style="font-size:9;background-color:#333;color:#fff">
                                <th><b>Name</b></th>
                                <th><b>ORDER NUMBER</b></th>
                                <th><b>DESCRIPTION</b></th>
                                <th><b>QUANTITY</b></th>
                                <th><b>ORDER DATE</b></th>
                                <th><b>RECEIVED</b></th>
                            </tr>
                        </thead>
                        <tbody>' . $tr10 . '
                        </tbody>
                    </table>   ';

                    $pdf=PDF::loadview('pdf.linemanager',['tabels'=>$tbl]);
                    return $pdf->stream('Line Manager.pdf');                    
            }


        
        
            
        
    

     

 
    function getRemainingTime($start, $end)
    {
    // Declare and define two dates
    $date1 = strtotime($start);
    $date2 = strtotime($end);

    // Formulate the Difference between two dates
    $diff = abs($date2 - $date1);

    return $diff;
    }

    public function print_customer_feedback(){
        $feedback_total=DB::table('client_feedback')->count();
        $total_happy=DB::table('client_feedback')->where('comment_type','=','Happy')->count();
        $total_unavailable=DB::table('client_feedback')->where('comment_type','=','Unavailable')->count();
        $total_workman=DB::table('client_feedback')->where('comment_type','=','Workmanship')->count();
        $total_comm=DB::table('client_feedback')->where('comment_type','=','Communication')->count();
        $total_other=DB::table('client_feedback')->where('comment_type','=','Other')->count();

        $client_feed=DB::table('client_details')
                       ->join('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                       ->join('client_feedback','client_details.Key_Ref','=','client_feedback.Key_Ref')
                       ->orderBy('release_date','desc')
                       ->get();
                       $pdf=PDF::loadview('pdf.customerfeedback',['feedback'=>$client_feed,'happy'=>$total_happy,'unavailiable'=>$total_unavailable,'workman'=>$total_workman,'comm'=>$total_comm,'other'=>$total_other]);
                       return $pdf->stream('Customer Feedback.pdf');
    }

    public function print_proforma_invoice($id){
        $receipt=DB::table('towing_history')   
                        ->where('towing_history.Key_Ref','=',$id)
                        ->leftjoin('client_details','towing_history.Key_Ref','=','client_details.Key_Ref')
                        ->get();
        $storage=DB::table('storage_rates')->get();
        foreach($storage as $store){
            $car_storage   = $store->car_storage;
            $truck_storage = $store->truck_storage;
            $admin_val     = $store->admin;
            $security_val  = $store->security;
        }

                       $pdf=PDF::loadview('pdf.proformainvoice',['receipt'=>$receipt,'car'=>$car_storage,'truck'=>$truck_storage,
                       'admin'=>$admin_val,'security'=>$security_val]);
                       return $pdf->stream(''.$id.'Proforma Invoice Receipt.pdf'); 
    }

    public function final_notation($id){
        
        $user_branch=Auth::user()->username;
    
        //$company_name=DB::table('branch')->where('branch_code','=',$user_branch);
        $rep = 'Motor Accident Group';
            $vin = '';
            $clmno = '';
            $vmk = '';
            $vrg = '';
            $ass = '';
            $assTel = '';
            $ins = '';
            $user = '';
            $phon = '';
            $assMail = '';
            $begin='';
            $tbl = '';
            $result=DB::select('select distinct Reg_No,Make,Model,Chasses_No,Assessor,Assessor_Email,Assessor_Tel,Inserer,Claim_NO,cd.Key_Ref from client_details cd left join insurer ins on cd.Key_Ref = ins.Key_Ref 
            where  cd.Key_Ref=?',[$id]);
            foreach($result as $row){
                $vin = $row->Chasses_No;
                $clmno = $row->Claim_NO;
                $vmk = $row->Make." ".$row->Model;
                $vrg = $row->Reg_No;
                $ass = $row->Assessor;
                $assTel = $row->Assessor_Tel;
                $assMail = $row->Assessor_Email;
            }
            $result1 =DB::select('select * from qoutes where Key_Ref =? and ((Parts_sales*(1+(MarkUp/100)))> Part or (Parts_sales*(1+(MarkUp/100)))< Part) and Parts_sales>0 and Misc=0 and round((Parts_sales*(1+(MarkUp/100))),2)<> round(Part,2)',[$id]);
            $result2 = DB::select('select * from insurer where Key_Ref =?',[$id]);
            $cn = 1;
            $parttl = 0;
            $qty = 0;
            $actttl= 0;
            $savttl= 0;
            $addttl = 0;

            foreach($result1 as $row1){
                $part =  $row1->Part;
                $qty = $row1->Quantity;
                $actual = ($row1->Parts_sales)*(1+($row1->MarkUp/100));
                $sav = 0;
                $add = 0;
                if($part>$actual){
                    $sav = $part-$actual;
                    $add = 0;
                    $savttl+=$sav;
                }else
                    if($part<$actual){
                        $sav = 0;
                        $add = $actual-$part;
                        $addttl+=$add;
                    }
                $parttl+=$part;
                $actttl+=$actual;
            
                $tbl.= '<tr style="font-family:courier;font-size:9">'
                        . '<td> '.$cn.'</td>'
                        . '<td> '.$row1->Description.'</td>'
                        . '<td> '.$row1->Oper.'</td>'
                        . '<td> '.$row1->Quantity.'</td>'
                        . '<td style="text-align:right"> '.number_format($actual,2).'</td>'
                        . '<td style="text-align:right"> '.number_format($part,2).'</td>'
                        . '<td style="text-align:right"> '.number_format($sav,2).'</td>'
                        . '<td style="text-align:right"> '.number_format($add,2).'</td>'
                        . '</tr>';
                $cn++;
            }//End For Each
            $tbl.= '<tr style="font-family:courier;font-size:9">'
                . '<td style="border-right:1px solid grey;"><b>Total</b></td>'
                . '<td style="border-right:1px solid grey;"></td>'
                . '<td style="border-right:1px solid grey;"></td>'
                . '<td style="border-right:1px solid grey;"></td>'
                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($actttl,2).'</b></td>'
                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($parttl,2).'</b></td>'
                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($savttl,2).'</b></td>'
                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($addttl,2).'</b></td>'
                . '</tr>';

            $begin.='<p></p>
            <div>
            <table style="width:1200">
                <tr>
                    <td>
                        <table style="font-size:12">
                            <tr>
                                <td><b>Motor Accident Group</b></td>
                            </tr>
                            <tr>
                                <td><b>Notification Of Differences</b></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table style="font-size:8">
                            <tr>
                                <td style="width:50"><b>REF:</b></td>
                                <td>'.$id.'</td>
                            </tr>
                            <tr>
                                <td style="width:50"><b>Email:</b></td>
                                <td>add@motoraccidentgroup.co.za</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <p></p>';
            $begin.='<table style="font-family:courier;font-size:10;width:900">
            <tr>
                <td style="width:150"><b>REPAIRER:</b></td>
                <td>'.$rep.'</td>
                <td style="width:150"><b>ASSESSOR:</b></td>
                <td>'.$ass.'</td>
            </tr>
            <tr>
                <td style="width:150"><b>VIN:</b></td>
                <td>'.$vin.'</td>
                <td style="width:150"><b>ASSESSOR TEL:</b></td>
                <td>'.$assTel.'</td>
            </tr>
            <tr>
                <td style="width:150"><b>CLAIM NO:</b></td>
                <td>'.$clmno.'</td>
                <td style="width:150"><b>INSURANCE:</b></td>
                <td>'.$ins.'</td>
            </tr>
            <tr>
                <td style="width:150"><b>VEHICLE MAKE:</b></td>
                <td>'.$vmk.'</td>
                <td style="width:150"><b>DONE BY:</b></td>
                <td>'.$user_branch.'</td>
            </tr>
            <tr>
                <td><b>VEHICLE REG:</b></td>
                <td>'.$vrg.'</td>
                <td style="width:150"><b>TELEPHONE NO:</b></td>
                <td>0112345678</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="width:150"><b>ASSESSOR MAIL:</b></td>
                <td style="width:250">'.$assMail.'</td>
            </tr>
        </table>
        </div>';    
        $pdf=PDF::loadview('pdf.notation',['table'=>$tbl,'begin'=>$begin])->setPaper('a4','landscape');
        
        return $pdf->stream('Notiation Of Difference.pdf'); 
    }


    #ADDED TWO VARIABLES [ rowx, Quantity, and   ]
    public function final_costing_total($id){

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Final Costing');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, "2", PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 8, '', true);

        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(true);
        $pdf->AddPage('P');


        $result1_aa=DB::select('select Discount,Discount2 from qoutes where  Key_Ref=? and qoute_type = "0"',[$id]);
        $disc_val1 = 0;
        $disc_val2 = 0;
        $waste = 0;
        $table_header='';
        $opt='';
        foreach($result1_aa as $row){
            $disc_val1 = $row->Discount;
            $disc_val2 = $row->Discount2;
        }//end For Each
        
        $dbquery=DB::select('select * FROM client_details WHERE Key_Ref=?',[$id]);
        $tbl1 = "";
        $count=1;
        $part_total_p2zz = 0;
        $actual_price_total_p2zz = 0;
        $plus_additional_p2zz = 0;
        $less_saving_p2zz = 0;
        $betterment_total_p2zz =0;

        foreach($dbquery as $dbrow){
            $val1   = $dbrow->Fisrt_Name;
            $val2   = $dbrow->Last_Name;
            $val3   = $dbrow->Reg_No;
            $val4   = $dbrow->Make;
            $val5   = $dbrow->Model;
            $val6   = $dbrow->Date;	
            $branch = $dbrow->branch;

            #SIGNING TEST HERE

        }//End foreach
        $dbquery1=DB::select('select * FROM insurer WHERE Key_Ref=?',[$id]);
        $val7 = '';
        $val8 = '';
        $val9 = '';
        $val10 = '';
        $betterment_total_p2 = 0;
        $less_saving_p2  = 0;
        $plus_additional_p2  = 0;
        $betterment_total_p3  = 0;
        $less_saving_p3  = 0;
        $plus_additional_p3  = 0;
        $part_total_p3  = 0;
        $actual_price_total_p3  = 0;
        $actual_price_total_p2  = 0;
        $part_total_p2  = 0;
        $vat  = 0;

        foreach($dbquery1 as $dbrow1){
            $val7 = $dbrow1->Assessor;
            $val8 = $dbrow1->Claim_NO;
            $val9 = $dbrow1->Inserer;
            $val10= $dbrow1->Assessor_Ref;	
            $vat  = $dbrow1->vat;
        }

        $labour   = 0;
        $paint    = 0;
        $strip    = 0;
        $frame    = 0;
        $outwork  = 0;

        $result=DB::select('select id,Percent,MarkUp,MarkUp2,Betterment,Quantity,Description,Key_Ref,Parts_sales,Part,Oper,Part,round(Part-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price  from qoutes where Key_Ref =? and Part>0 and qoute_type = "0" limit 0,30',[$id]);
        $resultxxx=DB::select('select id,Percent,MarkUp,MarkUp2,Betterment,Quantity,Description,Key_Ref,Parts_sales,Part,Oper,Part,round(Part-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price  from qoutes where Key_Ref =? and Part>0 and qoute_type ="0" limit 30,130',[$id]);
        $resultxxxx=DB::select('select id,Percent,MarkUp,MarkUp2,Betterment,Quantity,Description,Key_Ref,Parts_sales,Part,Oper,Part,round(Part-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price  from qoutes where Key_Ref =? and Part>0 and qoute_type = "0" limit 130,230',[$id]);
        $resulte=DB::select('select * from oper order by oper');

        foreach($resulte as $row){
            $opt.= "<option val='".$row->oper."'>".$row->oper."</option>";
        }//End Of Foreach

        $count = 1;
        $status='';
        $lndT = 0;
        $ptT = 0;
        $savT = 0;
        $actl = 0;
        $btmnt = 0;
        $btmnt_ = 0;
        $actual_priceT = 0;
        $tbl="";
        $tbl2="";
        $tblp2 = "";
        $tblp3 = "";
        $tblp2st= "";
        $actlttl = 0;
        $qtedttl = 0;
        $savettl = 0;
        $addttl = 0;
        $actlttl2 = 0;
        $qtedttl2 = 0;
        $savettl2 = 0;
        $addttl2 = 0;
        $actlttl3 = 0;
        $qtedttl3 = 0;
        $savettl3 = 0;
        $addttl3 = 0;
        $mark = 0;

        foreach($result as $row){
            $add=0;
            $save = 0;
            $qted = ($row->Part*$row->Quantity)*+(1+($row->Percent/100));
            if($row->Parts_sales<=0){
                $status = "<span class='badge' style='background-color:red'>No</span>";
            }else if($row->Parts_sales>0){
                $status = "<span class='badge' style='background-color:green'>Yes</span>";
            }if($row->actual_price>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = 0;	
                $add = ($row->actual_price - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));	
            }else if($row->actual_price<($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$row->actual_price);	
                $add = 0;	
            }
            if(number_format($row->MarkUp2)==0){
                
                $mark = 'Nett + '.$row->MarkUp.'% Mark Up';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{
                    $actl = $row->actual_price;
                }
            }else{
                $mark = $row->MarkUp2.'% Mark Up Only';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{//(Parts_sales+(Parts_sales*(MarkUp/100)))
                    $actl = $row->Parts_sales*(($row->MarkUp2)/100);
                    if($actl>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                        $add = ($actl - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));
                        $save = 0;
                    }else{
                        $add = 0;
                        $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$actl);
                    }
                }
                //$add = 0;
                //$save = 0;
            }
        $actlttl += $actl;
        $qtedttl += $qted;
        $savettl += $save;
        $addttl += $add;
        $btmnt+= $actl*$row->Betterment/100;
        $btmnt_+= ($row->Part*$row->Quantity)*+(1+($row->Percent/100))*$row->Betterment/100;
       $tbl.= '<tr>
                <td style="width:20px;">'.$count.'</td>
                <td style="width:165px">'.$row->Description.'</td>
                <td style="width:54px">'.$row->Oper.'</td>
                <td style="width:56px;">'.number_format($row->Parts_sales,2).'</td>
                <td style="width:85px;">'.$mark.'</td>
                <td style="width:56px;">'.$row->Betterment.'</td>
                <td style="width:56px;">'.number_format($save,2).'</td>
                <td style="width:56px;">'.number_format($add,2).'</td>
                <td style="width:56px;">'.number_format($qted,2).'</td>
                <td style="width:56px;">'.number_format($actl,2).'</td>
            </tr>';
       $count++;
        }//End OF Foreach
        $countp1 = 31;
        foreach($resultxxx as $row){
            $add=0;
            $save = 0;
            $qted = ($row->Part*$row->Quantity)*+(1+($row->Percent/100));
            if($row->Parts_sales<=0){
                $status = "<span class='badge' style='background-color:red'>No</span>";
            }else if($row->Parts_sales>0){
                $status = "<span class='badge' style='background-color:green'>Yes</span>";
            }if($row->actual_price>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = 0;	
                $add = ($row->actual_price - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));	
            }else if($row->actual_price<($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$row->actual_price);	
                $add = 0;	
            }
            if(number_format($row->MarkUp2)==0){
                
                $mark = 'Nett + '.$row->MarkUp.'% Mark Up';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{
                    $actl = $row->actual_price;
                }
            }else{
                $mark = $row->MarkUp2.'% Mark Up Only';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{//(Parts_sales+(Parts_sales*(MarkUp/100)))
                    $actl = $row->Parts_sales*(($row->MarkUp2)/100);
                    if($actl>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                        $add = ($actl - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));
                        $save = 0;
                    }else{
                        $add = 0;
                        $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$actl);
                    }
                }
                //$add = 0;
                //$save = 0;
            }
        $actlttl2 += $actl;
        $qtedttl2 += $qted;
        $savettl2 += $save;
        $addttl2 += $add;
        $btmnt+= $actl*$row->Betterment/100;
        $btmnt_+= ($row->Part*$row->Quantity)*+(1+($row->Percent/100))*$row->Betterment/100;
       $tblp2.= '<tr>
                <td style="width:20px;">'.$count.'</td>
                <td style="width:165px">'.$row->Description.'</td>
                <td style="width:54px">'.$row->Oper.'</td>
                <td style="width:56px;">'.number_format($row->Parts_sales,2).'</td>
                <td style="width:85px;">'.$mark.'</td>
                <td style="width:56px;">'.$row->Betterment.'</td>
                <td style="width:56px;">'.number_format($save,2).'</td>
                <td style="width:56px;">'.number_format($add,2).'</td>
                <td style="width:56px;">'.number_format($qted,2).'</td>
                <td style="width:56px;">'.number_format($actl,2).'</td>
            </tr>';
       $countp1++;
        }
        $countp2 = 131;
        foreach($resultxxxx as $row){
            $add=0;
            $save = 0;
            $qted = ($row->Part*$row->Quantity)*+(1+($row->Percent/100));
            if($row->Parts_sales<=0){
                $status = "<span class='badge' style='background-color:red'>No</span>";
            }else if($row->Parts_sales>0){
                $status = "<span class='badge' style='background-color:green'>Yes</span>";
            }if($row->actual_price>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = 0;	
                $add = ($row->actual_price - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));	
            }else if($row->actual_price<($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$row->actual_price);	
                $add = 0;	
            }
            if(number_format($row->MarkUp2)==0){
                
                $mark = 'Nett + '.$row->MarkUp.'% Mark Up';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{
                    $actl = $row->actual_price;
                }
            }else{
                $mark = $row->MarkUp2.'% Mark Up Only';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{//(Parts_sales+(Parts_sales*(MarkUp/100)))
                    $actl = $row->Parts_sales*(($row->MarkUp2)/100);
                    if($actl>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                        $add = ($actl - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));
                        $save = 0;
                    }else{
                        $add = 0;
                        $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$actl);
                    }
                }
                //$add = 0;
                //$save = 0;
            }
        $actlttl3 += $actl;
        $qtedttl3 += $qted;
        $savettl3 += $save;
        $addttl3 += $add;
        $btmnt+= $actl*$row->Betterment/100;
        $btmnt_+= ($row->Part*$row->Quantity)*+(1+($row->Percent/100))*$row->Betterment/100;
       $tblp3.= '<tr>
                <td style="width:20px;">'.$count.'</td>
                <td style="width:165px">'.$row->Description.'</td>
                <td style="width:54px">'.$row->Oper.'</td>
                <td style="width:56px;">'.number_format($row->Parts_sales,2).'</td>
                <td style="width:85px;">'.$mark.'</td>
                <td style="width:56px;">'.$row->Betterment.'</td>
                <td style="width:56px;">'.number_format($save,2).'</td>
                <td style="width:56px;">'.number_format($add,2).'</td>
                <td style="width:56px;">'.number_format($qted,2).'</td>
                <td style="width:56px;">'.number_format($actl,2).'</td>
            </tr>';
       $countp2++;
        }
        if($count<30){
            for($i=$count;$i<31;$i++){
                $tbl.= "<tr>
                    <td>".$i."</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>";
            }
        }
        $result5=DB::select('select * FROM assessors where Names=? ORDER BY `id` DESC LIMIT 0,1',[$val7]);
        $assessor_name = "";
        $assessor_cell = "";
        $assessor_email= "";
        $assessor_comp = "";
        $result5_count=count($result5);
        if($result5_count>0){
            foreach($result5 as $row5){
                $assessor_name = $row5->Names;
                $assessor_cell = $row5->Cell;
                $assessor_email= $row5->Email;
                $assessor_comp = $row5->Company;
            }
        }else{
            $assessor_name = "";
            $assessor_cell = "";
            $assessor_email= "";
            $assessor_comp = "";
        }

        #REDO FROM HERE
        $image='img/selby.PNG';

        $pdf->Image($image);
        #$width ='300px';
        $width =(int)300;
        $strText ="";
        $height =(int)20;
        $strText = str_replace("\n","<br>",$strText);

        $pdf->MultiCell($width, $height,$strText, 0, 'J', 0, 1, '', '', true, null, true);

        $html = '

        <table border="1" style="width:100%;">
        <tr>
        <td style="width:108px;"><h5>Insurance</h5></td>
        <td style="width:208px;background-color:;"><h5>'.$val9.'</h5></td>
        <td style="width:108px;"><h5>ASSESSOR</h5></td>
        <td style="width:238px;background-color:;"><h5>'.$val7.'</h5></td>
        </tr>

        <tr>
        <td style="width:108px;"><h5>INSURED</h5></td>
        <td style="width:208px;background-color:;"><h5>'.$val1." ".$val2.'</h5></td>
        <td style="width:108px;"><h5>Claim No</h5></td>
        <td style="width:238px;background-color:;"><h5>'.$val8.'</h5></td>
        </tr>

        <tr>
        <td style="width:108px;"><h5>REGISTRATION NO</h5></td>
        <td style="width:208px;background-color:;"><h5>'.$val3." ".$val2.'</h5></td>
        <td style="width:108px;"><h5>REF NO/ASSESSOR REF</h5></td>
        <td style="width:238px;background-color:;"><h5>'.$id.' / '.$val10.'</h5></td>
        </tr>

        <tr>
        <td style="width:108px;"><h5>VEHICLE</h5></td>
        <td style="width:208px;background-color:;"><h5>'.$val4." ".$val5.'</h5></td>
        <td style="width:108px;"><h5>DATE</h5></td>
        <td style="width:238px;background-color:;"><h5>'.$val6.'</h5></td>
        </tr>
        </table>
        <br>
        ';
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);



        $html = ' <table border="1" style="width:100%;font-size:7px;">
        <tr style="background-color:black;color:white;">
        <td style="width:20px;"><h4>No</h4></td>
        <td style="width:165px;"><h4>Part Description</h4></td>
        <td style="width:54px;"><h4>Oper</h4></td>
        <td style="width:56px;"><h4>Landing Price</h4></td>
        <td style="width:85px;"><h4>Mark-Up</h4></td>
        <td style="width:56px;"><h4>Betterment</h4></td>
        <td style="width:56px;"><h4>Saving</h4></td>
        <td style="width:56px;"><h4>Additional</h4></td>
        <td style="width:56px;"><h4>Quoted Price</h4></td>
        <td style="width:56px;"><h4>Actual Price</h4></td>
        </tr>
        '; #</table>

        # [ CURRENT LOADED UPDATES ]
        $table_test='';
        $ttlAdd = 0;
        $ttlAdd_ = 0;

        #$result_x =DB::select('select * FROM additional WHERE Key_Ref=? AND Part>"0"',[$id]);
        $result_x =DB::select('select * FROM additional WHERE Key_Ref=? AND (Part>0 or Part<0)',[$id]);

        foreach($result_x as $row){
            if(number_format($row->MarkUp2)==0){
                #$ttlAdd_ += $row->Quantity*$row->Part*(1+($row->MarkUp/100));
                $ttlAdd_ += ($row->Quantity*$row->Part*(1+($row->MarkUp/100)));
            }else{
                #$ttlAdd_ += $row->Quantity*$row->Part*(($row->MarkUp2/100));
                $ttlAdd_ += ($row->Quantity*$row->Part*(($row->MarkUp2/100)));
            }
        }


        #$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


       # $html=' <table border="1" style="width:100%;height:%;font-size:7px;">'.$tbl.'</table>';
        $html .= $tbl.'</table>';

        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

       
        /*
        $table_test.='
        <table border="1" style="width:100%;height:%;font-size:8px;margin-bottom:5px;border-collapse: collapse;border: 1px solid black;">'.$tbl.'</table>
        ';
        */

        $result1=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" ORDER BY id limit 0,30',[$id]); 
        $result12=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" and qoute_type = "0" ORDER BY id limit 30,130',[$id]);        
        $result13=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" and qoute_type = "0" ORDER BY id limit 130,230',[$id]);
        $result1x=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" and qoute_type = "0" ORDER BY id',[$id]);
        $ref1 = '';
        $part_id1     = '';
        $oper1        = '';
        $description1 = '';
        
        
        $betterment_total1x  = 0;
        $betterment_total1  = 0;
        $betterment_total12  = 0;
        $betterment_total13  = 0;
        $part_total1x        = 0;
        $part_total1        = 0;
        $part_total12        = 0;
        $part_total13        = 0;
        $actual_price_total1= 0;
        $actual_price_total1x= 0;
        $actual_price_total12= 0;
        $actual_price_total13= 0;
        $less_saving1x = 0;
        $less_saving1 = 0;
        $less_saving12 = 0;
        $less_saving13 = 0;
        $plus_additional1 = 0;
        $plus_additional1x = 0;
        $plus_additional12 = 0;
        $plus_additional13 = 0;
        $additional_price1 = 0;

        foreach($result1x as $row1){
            $percent1     = ($row1->Part*$row1->Percent/100);
            $quantity1    = $row1->Quantity;
            $part1        = ($row1->Part*$row1->Quantity)*(1+($row1->Percent/100));
            $part_sales1  = $row1->Parts_sales;
            $markup1      = $row1->MarkUp;
            $betterment1  = $row1->Betterment;
            
        
            $savings1     =($part_sales1 * $markup1/100);
            $actual_price1=($part_sales1 + $savings1);
            $new_savings1 =($part1 - $actual_price1);
        
            $betterment_total1  = ($betterment_total1 + $actual_price1 * $betterment1 / 100);
            $part_total1        = ($part_total1 + $part1);
            $actual_price_total1= ($actual_price_total1 + $actual_price1);
        
            if($part_sales1<=0){
                $new_savings1=$part1;	
            }
        
            if($new_savings1<0){
                $new_savings1 = 0;	
                $additional_price1 = ($actual_price1 - $part1);	
            }else{
                $additional_price1 = 0;	
            }
           $less_saving1     += $new_savings1;
           //$plus_additional1 += $additional_price1;
        }
        foreach($result1 as $row1){
            $percent1     = ($row1->Part*$row1->Percent/100);
            $quantity1    = $row1->Quantity;
            $part1        = ($row1->Part*$row1->Quantity)*(1+($row1->Percent/100));
            $part_sales1  = $row1->Parts_sales;
            $markup1      = $row1->MarkUp;
            $betterment1  = $row1->Betterment;
            
            $savings1     =($part_sales1 * $markup1/100);
            $actual_price1=($part_sales1 + $savings1);
            $new_savings1 =($part1 - $actual_price1);
        
            $betterment_total1x  = ($betterment_total1 + $actual_price1 * $betterment1 / 100);
            $part_total1x        = ($part_total1x + $part1);
            $actual_price_total1x= ($actual_price_total1x + $actual_price1);
        
            if($part_sales1<=0){
                $new_savings1=$part1;	
            }
        
            if($new_savings1<0){
                $new_savings1 = 0;	
                $additional_price1 = ($actual_price1 - $part1);	
            }else{
                $additional_price1 = 0;	
            }
           $less_saving1x     += $new_savings1;
           $plus_additional1x += $additional_price1;
        }
        foreach($result12 as $row1){
            $percent1     = ($row1->Part*$row1->Percent/100);
            $quantity1    = $row1->Quantity;
            $part1        = ($row1->Part*$row1->Quantity)*(1+($row1->Percent/100));
            $part_sales1  = $row1->Parts_sales;
            $markup1      = $row1->MarkUp;
            $betterment1  = $row1->Betterment;
            
            $savings1     =($part_sales1 * $markup1/100);
            $actual_price1=($part_sales1 + $savings1);
            $new_savings1 =($part1 - $actual_price1);
        
            $betterment_total12  = ($betterment_total1 + $actual_price1 * $betterment1 / 100);
            $part_total12        = ($part_total12 + $part1);
            $actual_price_total12= ($actual_price_total12 + $actual_price1);
        
            if($part_sales1<=0){
                $new_savings1=$part1;	
            }
        
            if($new_savings1<0){
                $new_savings1 = 0;	
                $additional_price1 = ($actual_price1 - $part1);	
            }else{
                $additional_price1 = 0;	
            }
           $less_saving12     += $new_savings1;
           $plus_additional12 += $additional_price1;
        }

        foreach($result13 as $row1){
            $percent1     = ($row1->Part*$row1->Percent/100);
            $quantity1    = $row1->Quantity;
            $part1        = ($row1->Part*$row1->Quantity)*(1+($row1->Percent/100));
            $part_sales1  = $row1->Parts_sales;
            $markup1      = $row1->MarkUp;
            $betterment1  = $row1->Betterment;
            
            $savings1     =($part_sales1 * $markup1/100);
            $actual_price1=($part_sales1 + $savings1);
            $new_savings1 =($part1 - $actual_price1);
        
            $betterment_total12  = ($betterment_total1 + $actual_price1 * $betterment1 / 100);
            $part_total12        = ($part_total12 + $part1);
            $actual_price_total12= ($actual_price_total12 + $actual_price1);
        
            if($part_sales1<=0){
                $new_savings1=$part1;	
            }
        
            if($new_savings1<0){
                $new_savings1 = 0;	
                $additional_price1 = ($actual_price1 - $part1);	
            }else{
                $additional_price1 = 0;	
            }
           $less_saving12     += $new_savings1;
           $plus_additional12 += $additional_price1; 
        }

        #THE IS $_P CODE I AM NOT SURE ABOUT
        #<table border="0" style="width:100%;font-size:7px;">
        $html ='<br>
        <table border="0" style="width:100%;font-size:7px;">
        <tr>
        <td colspan="3" style="width:268px;"></td>
        <td colspan="2" style="width:112px;"><h4>Total Parts Page 1</h4></td>
        <td colspan="0" style="background-color:silver;width:50px;"><b>R'.number_format($betterment_total1x,2).'</b></td>
        <td colspan="0" style="background-color:silver;width:60px;"><b>R'.number_format($savettl,2).'</b></td>
        <td colspan="0" style="background-color:silver;width:60px;"><b>R'.number_format($addttl,2).'</b></td>
        <td style="background-color:silver;width:60px;"><b>R'.number_format($qtedttl,2).'</b></td>
        <td colspan="1" style="background-color:silver;width:60px;"><b>R'.number_format($actlttl,2).'</b></td>
        </tr>
        <tr>
        <td colspan="3" style="width:268px;"></td>
        <td colspan="2" style="width:112px;"><h4>Total Parts Page 2</h4></td>
        <td colspan="0" style="background-color:#fff;width:50px;"><b>R'.number_format($betterment_total12,2).'</b></td>
        <td colspan="0" style="background-color:#fff;width:60px;"><b>R'.number_format($savettl2,2).'</b></td>
        <td colspan="0" style="background-color:#fff;width:60px;"><b>R'.number_format($addttl2,2).'</b></td>
        <td style="background-color:#fff;width:60px;"><b>R'.number_format($qtedttl2,2).'</b></td>
        <td colspan="1" style="background-color:#fff;width:60px;"><b>R'.number_format($actlttl2,2).'</b></td>
        </tr>
        <tr>
        <td colspan="3" style="width:268px;"></td>
        <td colspan="2" style="width:112px;"><h4>Total Parts Page 3</h4></td>
        <td colspan="0" style="background-color:silver;width:50px;"><b>R'.number_format($betterment_total13,2).'</b></td>
        <td colspan="0" style="background-color:silver;width:60px;"><b>R'.number_format($savettl3,2).'</b></td>
        <td colspan="0" style="background-color:silver;width:60px;"><b>R'.number_format($addttl3,2).'</b></td>
        <td style="background-color:silver;width:60px;"><b>R'.number_format($qtedttl3,2).'</b></td>
        <td colspan="1" style="background-color:silver;width:60px;"><b>R'.number_format($actlttl3,2).'</b></td>
        </tr>
        </table>
        ';

        #$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

       


        $result_=DB::select('select * FROM additional WHERE Key_Ref=? AND Part>"0"',[$id]);

        $part_id     = '';
        $oper        = '';
        $description = '';
        $percent     = 0;
        $quantity    = 0;
        $part        = 0;
        $part_sales  = 0;
        $markup      = 0;
        $betterment  = 0;
        $disc_val    = 0;
        
        $savings     =0;
        $actual_price=0;
        $new_savings =0;
        
        $betterment_total  = 0;
        $part_total        = 0;
        $actual_price_total= 0;
        $less_saving = 0;
        $plus_additional = 0;
        $additional_price = 0;

        foreach($result_ as $row){
            $part_id     = $row->id;
            $oper        = $row->Oper;
            $description = $row->Description;
            $percent     = ($row->Part*$row->Percent/100);
            $quantity    = $row->Quantity;
            $part        = ($row->Part+$percent);
            $part_sales  = $row->Part;
            $markup      = $row->MarkUp;
            $betterment  = $row->Betterment;
        
            $savings     =($part_sales * $markup/100);
            $actual_price=($part_sales + $savings);
            $new_savings =($part - $actual_price);
        
            $betterment_total  = ($betterment_total + $actual_price * $betterment / 100);
            $part_total        = ($part_total + $part);
            $actual_price_total= ($actual_price_total + $actual_price);
        
            if($part_sales<=0){
                $new_savings=$part;	
            }
        
            if($new_savings<0){
                $new_savings = 0;	
                $additional_price = ($actual_price - $part);	
            }else{
                $additional_price = 0;	
            }
           $less_saving     += $new_savings;
           $plus_additional += $additional_price;
        }
        $result1_=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" and qoute_type = "0" ORDER BY id',[$id]);
        $ref1_ = '';
        $part_id1_     = '';
        $oper1_        = '';
        $description1_ = '';
        $percent1_     = 0;
        $quantity1_    = 0;
        $part1_        = 0;
        $part_sales1_  = 0;
        $markup1_      = 0;
        $betterment1_  = 0;
        $disc_val1_    = 0;
        
        $savings1_     =0;
        $actual_price1_=0;
        $new_savings1_ =0;
        
        $betterment_total1_  = 0;
        $part_total1_        = 0;
        $actual_price_total1_= 0;
        $less_saving1_ = 0;
        $plus_additional1_ = 0;
        $additional_price1_ = 0;
        $resq=DB::select('select ((`Part`*(1+(MarkUp/100)))*(Betterment/100))as prt, ((`Paint`*(1+(MarkUp/100)))*(Betterment/100))as pnt,
        ((`Outwork`*(1+(MarkUp/100)))*(Betterment/100))as utw,
        ((`Inhouse`*(1+(MarkUp/100)))*(Betterment/100))as inh,
        ((`RandR`)*(Betterment/100))as rr,
        (`Labour`*(Betterment/100))as lbr,
        (`Frame`*(Betterment/100))as frm, Frame,Labour,RandR,Paint
        from additional where Key_Ref =?',[$id]);

        $t = 0;
        $t2 = 0;
        $adbt = 0;
        foreach($resq as $row){
            $t += $row->Paint;
            $t2 +=$row->Frame+$row->RandR+$row->Labour;
            $adbt+=(($row->prt)+($row->pnt)+($row->utw)+($row->inh)+($row->rr)+($row->lbr)+($row->frm));
        }

        foreach($result1_ as $row1){
            $ref1_ = $row1->Key_Ref;
            $part_id1_     = $row1->id;
            $oper1_        = $row1->Oper;
            $description1_ = $row1->Description;
            $percent1_     = ($row1->Part*$row1->Percent/100);
            $quantity1_    = $row1->Quantity;
            $part1_        = ($row1->Part+$percent1);
            $part_sales1_  = $row1->Parts_sales;
            $markup1_      = $row1->MarkUp;
            $betterment1_  = $row1->Betterment;
            $disc_val1_    = $row1->Discount;
        
            $savings1_     =($part_sales1 * $markup1/100);
            $actual_price1_=($part_sales1 + $savings1);
            $new_savings1_ =($part1 - $actual_price1);
        
            $betterment_total1_  = ($betterment_total1 + $actual_price1 * $betterment1 / 100);
            $part_total1_        = ($part_total1 + $part1);
            $actual_price_total1_= ($actual_price_total1 + $actual_price1_);
        
            if($part_sales1<=0){
                $new_savings1_=$part1_;	
            }
        
            if($new_savings1_<0){
                $new_savings1_ = 0;	
                $additional_price1_ = ($actual_price1_ - $part1_);	
            }else{
                $additional_price1_ = 0;	
            }
           $less_saving1_     += $new_savings1_;
           $plus_additional1_ += $additional_price1_;
        }
        $ttl = $actual_price_total+$actual_price_total1;
        $ttl1 = $qtedttl+$qtedttl2+$qtedttl3;
        $result_1=DB::select("select Key_Ref,sundries1,sundries2,paintShop1,paintShop2,Betterment,Excess_1,Excess_2 FROM betterment WHERE Key_Ref=?",[$id]);
        $sundries1 = 0;
        $sundries2 = 0;
        $Betterment = 0;
        $Excess= 0;
        $Excess2 = 0;
        $idd='';
        $paintSh1 = 0;
        $paintSh2 = 0;
        foreach($result_1 as $row){
            $sundries1=$row->sundries1;
            $sundries2=$row->sundries2;
            $idd = $row->Key_Ref;
            $Betterment = $row->Betterment;
            $Excess = $row->Excess_1;
            $Excess2 = $row->Excess_2;
            $paintSh1 = $row->paintShop1;
            $paintSh2 = $row->paintShop2;
        }

        $html .='
        <table border="0" style="width:100%;font-size:7px;">
        <tr>
        <td colspan="3" style="width:268px;"></td>
        <td colspan="0" style="color:maroon;width:112px;"><h4>Additional Parts</h4></td>
        <td colspan="3" style="background-color:;width:168px;"></td>
        <td style="background-color:;width:60px;"></td>
        <td colspan="2" style="background-color:;color:maroon;width:60px;">R'.number_format($ttlAdd_,2).'</td>
        </tr>
        </table>
        ';

        //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);    

        $html .='
        <table border="0" style="width:100%;font-size:7px;">
        <tr>
        <td colspan="3" style="width:268px;"></td>
        <td colspan="0" style="color:;width:112px;"><h4>Sub Total Parts</h4></td>
        <td colspan="3" style="background-color:silver;width:168px;"></td>
        <td style="background-color:silver;width:60px;"><b>R'.number_format($ttl1,2).'</b></td>
        <td colspan="2" style="background-color:silver;color:;width:60px;"><b>R'.number_format(($ttlAdd_+$actlttl+$actlttl2+$actlttl3),2).'</b></td>
        </tr>
        </table>
        ';
        #$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        


        $result2=DB::select('select * FROM additional WHERE Key_Ref=? AND Part>"0"',[$id]);
        $part_id_     = '';
        $oper_        = '';
        $description_ = '';
        $percent_     = 0;
        $quantity_    = 0;
        $part_        = 0;
        $part_sales_  = 0;
        $markup_      = 0;
        $betterment_  = 0;
        $disc_val_    = 0;
        
        $savings_     =0;
        $actual_price_=0;
        $new_savings_ =0;
        
        $betterment_total_  = 0;
        $part_total_        = 0;
        $actual_price_total_= 0;
        $less_saving_ = 0;
        $plus_additional_ = 0;
        $additional_price_ = 0;

        foreach($result2 as $row2){
            $part_id_     = $row2->id;
            $oper_        = $row2->Oper;
            $description_ = $row2->Description;
            $percent_     = ($row2->Part*$row2->Percent/100);
            $quantity_    = $row2->Quantity;
            $part_        = ($row2->Part+$percent);
            $part_sales_  = $row2->Part;
            $markup_      = $row2->MarkUp;
            $betterment_  = $row2->Betterment;
        
            $savings_     =($part_sales_ * $markup/100);
            $actual_price_=($part_sales_ + $savings);
            $new_savings_ =($part_ - $actual_price_);
        
            $betterment_total_  = ($betterment_total_ + $actual_price_ * $betterment_ / 100);
            $part_total_        = ($part_total_ + $part_);
            $actual_price_total= ($actual_price_total + $actual_price);
        
            if($part_sales_<=0){
                $new_savings_=$part_;	
            }
        
            if($new_savings_<0){
                $new_savings_ = 0;	
                $additional_price_ = ($actual_price_ - $part_);	
            }else{
                $additional_price_ = 0;	
            }
           $less_saving_     += $new_savings_;
           $plus_additional_ += $additional_price_;
        }

        $result1_1=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" and qoute_type = "0" ORDER BY id',[$id]);
        $ref1_1 = '';
        $part_id1_1     = '';
        $oper1_1        = '';
        $description1_1 = '';
        $percent1_1     = 0;
        $quantity1_1    = 0;
        $part1_1        = 0;
        $part_sales1_1  = 0;
        $markup1_1      = 0;
        $betterment1_1  = 0;
        
        $savings1_1     =0;
        $actual_price1_1=0;
        $new_savings1_1 =0;
        
        $betterment_total1_1  = 0;
        $part_total1_1        = 0;
        $actual_price_total1_1= 0;
        $less_saving1_1 = 0;
        $plus_additional1_1 = 0;
        $additional_price1_1 = 0;
        foreach($result1_1 as $row1){
            $ref1_1 = $row1->Key_Ref;
            $part_id1_1     = $row1->id;
            $oper1_1        = $row1->Oper;
            $description1_1 = $row1->Description;
            $percent1_1     = ($row1->Part*$row1->Percent/100);
            $quantity1_1    = $row1->Quantity;
            $part1_1        = ($row1->Part+$percent1);
            $part_sales1_1  = $row1->Parts_sales;
            $markup1_1      = $row1->MarkUp;
            $betterment1_1  = $row1->Betterment;
        
            $savings1_1     =($part_sales1_1 * $markup1_1/100);
            $actual_price1_1=($part_sales1_1 + $savings1_1);
            $new_savings1_1 =($part1_1 - $actual_price1_1);
        
            $betterment_total1_1  = ($betterment_total1_1 + $actual_price1_1 * $betterment1_1 / 100);
            $part_total1_1        = ($part_total1_1 + $part1_1);
            $actual_price_total1_1= ($actual_price_total1_1 + $actual_price1_1);
        
            if($part_sales1_1<=0){
                $new_savings1_1=$part1_1;	
            }
        
            if($new_savings1_1<0){
                $new_savings1 = 0;	
                $additional_price1_1 = ($actual_price1_1 - $part1_1);	
            }else{
                $additional_price1_1 = 0;	
            }
           $less_saving1_1     += $new_savings1_1;
           $plus_additional1_1 += $additional_price1_1;
        }
        $ttl_1 = $actual_price_total+$actual_price_total1+$sundries1;
        $ttl1_1 = $part_total1_1+$sundries1;

        $html .='
        <table border="0" style="width:100%;font-size:7px;">
        <tr>
        <td colspan="3" style="width:268px;"></td>
        <td colspan="0" style="width:112px;"><h4>Sundries</h4></td>
        <td colspan="3" style="background-color:;width:168px;"></td>
        <td style="background-color:;width:60px;">R'.number_format($sundries1,2).'</td>
        <td colspan="2" style="background-color:;width:60px;">R'.number_format($sundries2,2).'</td>
        </tr>
        </table>
        ';
        #$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        #[ CURRENT NOW LOAD ]
        $key_value=0;
        $plus_key_value = 0;
        if( $sundries1 > $sundries2 ){
            #ADD IN THE [ LESS Saving ]
            $key_value = $sundries1 - $sundries2; 

        }else if( $sundries2 > $sundries1 ){
            //$key_value = $sundries2 - $sundries1;

            #ADD IN THE  [ PLUS Additionals ]
            $plus_key_value = $sundries2 - $sundries1;

        }

        #REMOVED THE LINE BREAK [ 17 MAY 2021 ]
        $html .='
        <table style="width:100%;font-size:7px;">
        <tr>
        <td colspan="3" style="width:268px;"></td>
        <td colspan="0" style="width:112px;"><h4>Total Parts</h4></td>
        <td colspan="3" style="background-color:silver;width:168px;"></td>
        <td colspan="1" style="background-color:silver;width:60px;"><b>R'.number_format($ttl1+$sundries1,2).'</b></td>
        <td colspan="2" style="background-color:silver;width:60px;"><b>R'.number_format(($ttlAdd_+$actlttl+$actlttl2+$actlttl3)+($sundries2),2).'</b></td>
        </tr>
        </table><br>
        ';
        //<br>
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
      


        #ADD THE [ Quantity,Percent,  ]
        #$resInhs=DB::select('select id,MarkUp,MarkUp2,Betterment,Description,Key_Ref,Parts_sales,Oper,Part,Misc,round(Misc-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price from qoutes where Key_Ref=? and Misc>0 and qoute_type = "0" order by id limit 8',[$id]);
        $resInhs=DB::select('select id,MarkUp,MarkUp2,Betterment,Description,Key_Ref,Parts_sales,Oper,Quantity,Percent,Part,Misc,round(Misc-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price from qoutes where Key_Ref=? and Misc>0 and qoute_type = "0" order by id limit 8',[$id]);


        $counter=1;
        $counte = $count;
        
        $savTotal = 0;
        $AddTotal = 0;
        $QtTotal=0;
        $actTotal = 0;
        $atct = 0;
        $html_ = "";
        $qted2 = 0;
        $add2 = 0;
        $mark2 = '';

        $resaddInhs=DB::select("select distinct * from additional  where Key_Ref=? and (Inhouse>0 or Inhouse<0) order by id",[$id]);
        $resaddInhs1=DB::select('select distinct * from additional  where Key_Ref=? and (Outwork>0 or Outwork<0) order by id',[$id]);
        $inh = 0;
        $out = 0;
        $inhtt = 0;
        $outtt = 0;
        $ottal=0;
        foreach($resaddInhs as $row){
            if(number_format($row->MarkUp2)==0){
                $inh = $row->Inhouse*(1+($row->MarkUp/100));
            }else{
                $inh = $row->Inhouse*(($row->MarkUp2/100));
            }
            $inhtt += $inh;
        }
        foreach($resaddInhs1 as $row){
            if(number_format($row->MarkUp2)==0){
                $out = $row->Outwork*(1+($row->MarkUp/100));
            }else{
                $out = $row->Outwork*(($row->MarkUp2/100));
            }
            $outtt += $out;
        }
        $resultew=DB::select('select distinct * from additional  where Key_Ref=? and (Outwork>0 or Outwork<0)',[$id]);
        foreach($resultew as $row){
            
            $actup = 0;
            if($row->Checked=='yes'){
                    $chk ="checked";
                }else{
                    $chk ="";
                }
                if(number_format($row->MarkUp2)==0){
                    $actup = $row->Outwork*(1+($row->MarkUp/100));
                }else{
                    $actup = $row->Outwork*(($row->MarkUp2/100));
                }
                $ottal += $actup;
        }
        $adOutwk = $ottal+$inhtt;
        $table_things='';
        /*
        $table_things='
        <table style="width:100%;font-size:8px;border-collapse: collapse;border: 1px solid black;">
        <tr style="background-color:black;color:white;border: 1px solid black;">
        <td style="width:20px;border: 1px solid black;">No</td>
        <td style="width:165px;border: 1px solid black;">Inhouse/Outwor</td>
        <td style="width:54px;border: 1px solid black;">Oper</td>
        <td style="width:56px;border: 1px solid black;">Landing Price</td>
        <td style="width:85px;border: 1px solid black;">Mark-Up</td>
        <td style="width:56px;border: 1px solid black;">Betterment</td>
        <td style="width:56px;border: 1px solid black;">Saving</td>
        <td style="width:56px;border: 1px solid black;">Additional</td>
        <td style="width:56px;border: 1px solid black;">Quoted Price</td>
        <td style="width:56px;border: 1px solid black;">Actual Price</td>
        </tr>
        
        ';*/
        foreach($resInhs as $rowx){
            if($rowx->Parts_sales<=0){
                $status = "<span class='badge' style='background-color:red'>No</span>";
            }else if($rowx->Parts_sales>0){
                $status = "<span class='badge' style='background-color:green'>Yes</span>";
            }if($rowx->sav<0){
                $rowx->sav = '0.00';
                $save2 = 0;
                $add2 = ($rowx->actual_price - $rowx->Misc);
            }else{
                $add2 = '0.00';
                $save2 = $rowx->sav;
            }
    //        if($rowx['Parts_sales']<=0){
    //            $atct=0;
    //        }else{
    //            $atct = $rowx['actual_price'];
    //        }
             $qted2 = $rowx->Misc;
            if(number_format($rowx->MarkUp2)==0){
                $mark2 = 'Nett + '.$rowx->MarkUp.'% Mark Up';
               
                if($rowx->Parts_sales<=0){
                    $atct=0;
                }else{
                    $atct = $rowx->actual_price;
                }
            }else{
                $mark2 = $rowx->MarkUp2.'% Mark Up Only';
                if($rowx->Parts_sales<=0){
                    $atct=0;
                }else{//(Parts_sales+(Parts_sales*(MarkUp/100)))
                    $atct = $rowx->Parts_sales*(($rowx->MarkUp2)/100);


                    #UPDATING THE [ rowx ] AND QUANTITY AND PERCENTAGE
                    if($atct>($rowx->Misc*$rowx->Quantity)*(1+($rowx->Percent/100))){
                        $add2 = ($atct - ($rowx->Misc*$rowx->Quantity)*(1+($rowx->Percent/100)));
                        $save2 = 0;
                    }else{
                        $add2 = 0;
                        $save2 = (($rowx->Misc*$rowx->Quantity)*(1+($rowx->Percent/100))-$atct);
                    }


                    #GET THE CLIENT
                    /*
                    if($atct>($row->Misc*$row->Quantity)*(1+($row->Percent/100))){
                        $add2 = ($atct - ($row->Misc*$row->Quantity)*(1+($row->Percent/100)));
                        $save2 = 0;
                    }else{
                        $add2 = 0;
                        $save2 = (($row->Misc*$row->Quantity)*(1+($row->Percent/100))-$atct);
                    }
                    */




                }
                //$add2 = 0;
                //$save2 = 0;
            }
            $allin=0;
            $savTotal+=$save2;
            $AddTotal+=$add2;
            $QtTotal+= $qted2;
            $actTotal+=$atct;
            

           $html_.='
                <table border="1" style="width:100%;font-size:7px;">
                <tr>
                <td style="width:20px;">'.$counter.'</td>
                <td style="width:165px;">'.$rowx->Description.'</td>
                <td style="width:54px;">'.$rowx->Oper.'</td>
                <td style="width:56px;">'.$rowx->Parts_sales.'</td>
                <td style="width:85px;">'.$mark2.'</td>
                <td style="width:56px;">'.$rowx->Betterment.'%</td>
                <td style="width:56px;">R'.number_format($save2,2).'</td>
                <td style="width:56px;">R'.number_format($add2,2).'</td>
                <td style="width:56px;">R'.number_format($qted2,2).'</td>
                <td style="color:;width:56px;">R'.number_format($atct,2).'</td>
                </tr>
                </table>
                ';

        $counter++;
        }//End Of Foreach
        if($counter<8){
            for($i=$counter;$i<9;$i++){
                $html_.= '<table border="1" style="width:100%;font-size:7px;"><tr>
            <td style="width:20px;">'.$i.'</td>
            <td style="width:165px;"></td>
            <td style="width:54px;"></td>
            <td style="width:56px;"></td>
            <td style="width:85px;"></td>
            <td style="width:56px;"></td>
            <td style="width:56px;"></td>
            <td style="width:56px;"></td>
            <td style="width:56px;"></td>
            <td style="color:;width:56px;"></td>
        </tr></table>';
            }
        }

        $html__='
        <table style="width:100%;font-size:7px;">
        <tr style="background-color:black;color:white;">
        <td style="width:20px;"><h4>No</h4></td>
        <td style="width:165px;"><h4>Inhouse/Outwork</h4></td>
        <td style="width:54px;"><h4>Oper</h4></td>
        <td style="width:56px;"><h4>Landing Price</h4></td>
        <td style="width:85px;"><h4>Mark-Up</h4></td>
        <td style="width:56px;"><h4>Betterment</h4></td>
        <td style="width:56px;"><h4>Saving</h4></td>
        <td style="width:56px;"><h4>Additional</h4></td>
        <td style="width:56px;"><h4>Quoted Price</h4></td>
        <td style="width:56px;"><h4>Actual Price</h4></td>
        </tr>
        </table>
        ';  
        $pdf->writeHTMLCell(0, 0, '', '', $html__, 0, 1, 0, true, '', true);

        $pdf->writeHTMLCell(0, 0, '', '', $html_, 0, 1, 0, true, '', true);

       


        #$table_things.='</table>';
        $table_other='';
        
        $htmlx = "";
        $htmlx='<br><br>
        <table style="width:100%;font-size:7px;">
        <tr>
        <td style="color:red;text-align:center;transform: skewY(-45deg);width:268px;">&nbsp;</td>
        <td style="width:110px;"><h4>Sub Total</h4></td>
        <td style="width:60px;"></td>
        <td  style="background-color:silver;width:55px;"><b>'.number_format($savTotal,2).'</b></td>
        <td style="background-color:silver;width:55px;"><b>'.number_format($AddTotal,2).'</b></td>
        <td  style="background-color:silver;width:65px;"><b>'.number_format($QtTotal,2).'</b></td>
        <td  style="background-color:silver;width:60px;"><b>R'.number_format($actTotal,2).'</b></td>
        </tr>
        <tr>
        <td colspan="3" style="width:268px;"></td>
        <td colspan="0" style="width:112px;"><h4>Outwork Sav/Add</h4></td>
        <td colspan="3" style="background-color:#fff;text-align:right;width:168px;"></td>
        <td colspan="1" style="background-color:#fff;width:65px;"><b></b></td>
        <td colspan="2" style="background-color:#fff;width:65px;"><b>R'.number_format($adOutwk,2).'</b></td>
        </tr>
        <tr>
        <td colspan="3" style="width:268px;"></td>
        <td colspan="0" style="width:112px;"><h4>Outwork Sub Total</h4></td>
        <td colspan="3" style="background-color:silver;text-align:right;width:168px;"></td>
        <td colspan="1" style="background-color:silver;width:65px;"><b>'.number_format($QtTotal,2).'</b></td>
        <td colspan="2" style="background-color:silver;width:65px;"><b>R'.number_format($actTotal+$adOutwk,2).'</b></td>
        </tr>
        </table>
        ';
        #$pdf->writeHTMLCell(0, 0, '', '', $htmlx, 0, 1, 0, true, '', true);

       


        $results=DB::select('select PaintSup,bt.id,bt.Key_Ref, sum(bt.Labour*ins.labour)as lb,sum(bt.Paint*ins.Paint)as pt,((qt.lb1*ins.labour)+(qt.frm*ins.Frame)+(qt.strp*ins.Strip))as lb1,(qt.pt1*ins.Paint)as pt1  from betterment bt left join
        (select qoutes.Key_Ref,sum(qoutes.Labour)as lb1,sum(qoutes.Paint)as pt1,sum(qoutes.Frame)as frm ,sum(qoutes.Strip)as strp from qoutes where Key_Ref =? and qoute_type = "0")as qt  on bt.Key_Ref = qt.Key_Ref
        left join insurer ins on bt.Key_Ref= ins.Key_Ref where bt.Key_Ref =?',[$id,$id]);
        $resultxx=DB::select('select labour,paint,waste from betterment where Key_Ref =?',[$id]);
        $tr1 = 0;
        $tr2 = 0;
        $tr1_ = 0;
        $tr2_ = 0;
        $plainp = 0;

        foreach($resultxx as $row){
            $tr1_  =  $row->labour;
            $tr2_  = $row->paint;
            if($row->waste!=null && $row->waste!=''){
                $waste = $row->waste;
            } 
        }

        $pconsu = 0;
        $frm = 0;

        foreach($results as $row){
            $plainp = $row->pt1;
            $pconsu = $row->PaintSup;
            if($tr1_==0){
                $tr1 = $row->lb1;
            }else{
                $tr1 = $tr1_;
            }
            if($tr2_==0){
                if($row->pt>0){
                    $tr2 = $row->pt+$paintSh1;
                }else{
                    $tr2 = $row->pt1+$paintSh1;
                }
            }else{
                $tr2 = $tr2_;
            }
        }
        if($paintSh1==0){
            $paintSh1 = $plainp*($pconsu/100);
          }
        if($paintSh2==0){
              $paintSh2 = $t*($pconsu/100);
          }

          $dbquery4=DB::select('select * FROM additional WHERE Key_Ref=? AND Paint>"0"',[$id]);
          $total_additional2  = 0;
          $part2        = 0;
          $part_sales2  = 0;
          $markup2      = 0;
          
          $additional2        = $part_sales2;
          $dbquery4_count=count($dbquery4);
          if($dbquery4_count>0){
              foreach($dbquery4 as $dbrow4 ){
                $part2        = $dbrow4->Part;
                $part_sales2  = $dbrow4->Paint;
                $markup2      = 0;
                
                $additional2        = $part_sales2;
                $total_additional2  = $total_additional2 + $additional2;
              }
          }

          $dbquery3=DB::select('select * FROM additional WHERE Key_Ref=?',[$id]);
          $total_additional1  = 0;
          $part1Z        = '';
          $part_sales1Z  = '';
          $markup1Z      = 0;
          
          $add_sav            = '';
          $additional1        = '';
          $total_additional1Z = 0;

          $dbquery3_count=count($dbquery3);
          if($dbquery3_count>0){
              foreach($dbquery3 as $dbrow3){
                $part1Z        = $dbrow3->Part;
                $part_sales1Z  = $dbrow3->Labour;
                $markup1Z      = $dbrow3->MarkUp;
                
                $add_savZ            = ($part_sales1Z * $markup1Z/100);
                $additional1Z        = $part_sales1Z+$add_savZ;
                $total_additional1Z  = $total_additional1Z +$part_sales1Z;
              }
          }
          $check_signature=DB::table('client_details')->where('Key_Ref','=',$id)->where('sign_costing','=','1')->get();
          //$signature='<img src="img/signature.PNG" width="250px" height="60px" style="margin-top:4px;margin-left:5px;">';
          $signature='<img src="img/signature.PNG" width="250px" height="30px">';
          $images='';
          $check_signature_count=count($check_signature);
          if($check_signature_count>0){
              $images=$signature;
          }else{
              $images='';
          }

          /*
          $table_other.='
          <table style="width:100%;font-size:7px;margin-bottom:-55px;">
          <tr>
          
          <td colspan="3" rowspan="6" style="height:50px;width:268px;"><br>
          <div style="border:2px solid #5e6063;color:white;"><br><br><label style="color:black;">'.$images.'<br>MOTOR ACCIDENT GROUP:</label></div>
          </td>
          
          <td colspan="0" style="color:maroon;width:112px;"><b>Additional Labour</b></td>
          <td colspan="3" style="background-color:white;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:white;width:65px;">&nbsp;</td>
          <td colspan="2" style="background-color:white;color:maroon;width:65px;"><b>R'.number_format($t2,2).'</b></td>
          </tr>
          </table>
          ';

        <div style="border:2px solid #5e6063;color:white;"><br><br><label style="color:black;">'.$images.'<br>MOTOR ACCIDENT GROUP:</label></div>

          */


          #$htmla ='
          $htmlx .='
          <table style="width:100%;font-size:7px;margin-bottom:-55px;">
          <tr>
          
          <td colspan="3" rowspan="8" style="height:50px;width:268px;"><br>
          <div style="border:2px solid #5e6063;color:white;"><br><br>'.$images.'<label style="color:black;">MOTOR ACCIDENT GROUP:</label></div>
          </td>
          
          <td colspan="0" style="color:maroon;width:112px;"><b>Additional Labour</b></td>
          <td colspan="3" style="background-color:white;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:white;width:65px;">&nbsp;</td>
          <td colspan="2" style="background-color:white;color:maroon;width:65px;"><b>R'.number_format($t2,2).'</b></td>
          </tr>
          </table>
          ';


            #$pdf->writeHTMLCell(0, 0, '', '', $htmla, 0, 1, 0, true, '', true);
            # $pdf->writeHTMLCell(0, 0, '', '', $htmlx, 0, 1, 0, true, '', true);
            

            



            /*
          $table_other.='<table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="0" style="width:112px;"><b>Total Labour</b></td>
          <td colspan="3" style="background-color:silver;text-align:right;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($tr1,2).'</b></td>
          <td colspan="2" style="background-color:silver;width:65px;"><b>R'.number_format($tr1+$t2,2).'</b></td>
          </tr>
          </table>';
          */

          #$htmlw='
          $htmlx .='
            <table style="width:100%;font-size:7px;">
            <tr>
            <td colspan="3" style="width:268px;"></td>
            <td colspan="0" style="width:112px;"><h4>Total Labour</h4></td>
            <td colspan="3" style="background-color:silver;text-align:right;width:168px;"></td>
            <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($tr1,2).'</b></td>
            <td colspan="2" style="background-color:silver;width:65px;"><b>R'.number_format($tr1+$t2,2).'</b></td>
            </tr>
            </table>
            ';
            #$pdf->writeHTMLCell(0, 0, '', '', $htmlw, 0, 1, 0, true, '', true);
            #$pdf->writeHTMLCell(0, 0, '', '', $htmlx, 0, 1, 0, true, '', true);
             
           


            /*
          $table_other.='<table style="width:100%;font-size:7px;margin-bottom:5px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="0" style="color:maroon;width:112px;"><b>Additional Paint</b></td>
          <td colspan="3" style="background-color:white;text-align:right;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:white;width:65px;">&nbsp;</td>
          <td colspan="2" style="background-color:white;color:maroon;width:65px;"><b>R'.number_format($t,2).'</b></td>
          </tr>
          </table>
          ';*/

            $htmlx .='
            <table style="width:100%;font-size:7px;">
            <tr>
            <td colspan="3" style="width:268px;"></td>
            <td colspan="0" style="color:maroon;width:112px;"><h4><b>Additional Paint</h4></b></td>
            <td colspan="3" style="background-color:;text-align:right;width:168px;"></td>
            <td colspan="1" style="background-color:;width:65px;"></td>
            <td colspan="2" style="background-color:;color:maroon;width:65px;"><b>R'.number_format($t,2).'</b></td>
            </tr>
            </table>
            ';
            #$pdf->writeHTMLCell(0, 0, '', '', $htmlx, 0, 1, 0, true, '', true);
            


          $table_consumerables='';
          /*
          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="0" style="width:112px;"><b>Consumables</b></td>
          <td colspan="3" style="background-color:#fff;text-align:right;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:#fff;width:65px;"><b>R'.number_format($paintSh1,2).'</b></td>
          <td colspan="2" style="background-color:#fff;width:65px;"><b>R'.number_format($paintSh2,2).'</b></td>
          </tr>
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="0" style="width:112px;"><b>Total Paint</b></td>
          <td colspan="3" style="background-color:silver;text-align:right;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($tr2,2).'</b></td>
          <td colspan="2" style="background-color:silver;width:65px;"><b>R'.number_format($tr2+$t+($paintSh2-$paintSh1),2).'</b></td>
          </tr>
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="0" style="width:112px;"><b>Waste Disposal</b></td>
          <td colspan="3" style="text-align:right;width:168px;">&nbsp;</td>
          <td colspan="1" style="width:65px;"><b>R'.number_format($waste,2).'</b></td>
          <td colspan="2" style="width:65px;">&nbsp;</td>
          </tr>
          </table>
          ';
          */

          #REMOVE LINE BREAK [ 17 MAY 2021 ]
          //$htmlx .='<br><br>
          $htmlx .='
            <table style="width:100%;font-size:7px;">
            <tr>
            <td colspan="3" style="width:268px;"></td>
            <td colspan="0" style="width:112px;"><h4>Consumables</h4></td>
            <td colspan="3" style="background-color:#fff;text-align:right;width:168px;"></td>
            <td colspan="1" style="background-color:#fff;width:65px;">R'.number_format($paintSh1,2).'</td>
            <td colspan="2" style="background-color:#fff;width:65px;">R'.number_format($paintSh2,2).'</td>
            </tr>
            <tr>
            <td colspan="3" style="width:268px;"></td>
            <td colspan="0" style="width:112px;"><h4>Total Paint</h4></td>
            <td colspan="3" style="background-color:silver;text-align:right;width:168px;"></td>
            <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($tr2,2).'</b></td>
            <td colspan="2" style="background-color:silver;width:65px;"><b>R'.number_format($tr2+$t+($paintSh2-$paintSh1),2).'</b></td>
            </tr>
            <tr>
            <td colspan="3" style="width:268px;"></td>
            <td colspan="0" style="width:112px;"><h4>Waste Disposal</h4></td>
            <td colspan="3" style="text-align:right;width:168px;"></td>
            <td colspan="1" style="width:65px;"><b>R'.number_format($waste,2).'</b></td>
            <td colspan="2" style="width:65px;"></td>
            </tr>
            </table>
            ';
            #$pdf->writeHTMLCell(0, 0, '', '', $htmlx, 0, 1, 0, true, '', true);
            

          $ss = 0;
          $fs = 0;
          $ms = 0;

          $resultz=DB::select('select (sum(Labour)+sum(`Part`)+sum(`Paint`)+sum(`Strip`)+sum(`Strip`)+sum(`Frame`)+sum(`Misc`)+sum(`Outwork`)+sum(`Inhouse`))as sm FROM `additional` where Key_Ref =?',[$id]);

          $consu = $tr2*1/100;
          $ttl1z = $tr1+$tr2+($ttl1+$sundries1);
          $addAd = ($plus_additional1);
          $lessSav = $savettl+$savettl2+$savettl3;
          $dicp = number_format($disc_val1,2);
          $dicp2 = number_format($disc_val2,2);
          $dicv1 = (($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste))*($disc_val1/100);
          $dicv2 = ((($ttl1+$sundries1+$QtTotal+$tr1+$tr2)+($ttlAdd_+($addttl+$addttl2+$addttl3)+($sundries2-$sundries1)+$adOutwk+$AddTotal+$t2+$t+($paintSh2-$paintSh1)))-($lessSav+$savTotal))*($disc_val2/100);
          $subt = ($ttl1z+$addAd-$lessSav);
          $newTol = ($subt-$dicv1);
          $ttvat = 0;
          $newTol2=0;
          if($newTol>0){
              $ttvat = ($newTol*0.15);
              $newTol2=($newTol*1.15);
          }else{
              $ttvat = 0;
              $newTol2=($newTol);
          }
          $fTol = ($newTol2-$Excess);

          $resultzn=DB::select('select qt.Key_Ref,sum(qt.Strip*ins.Strip)as ss,sum(qt.Frame*ins.Frame)as fs,sum(Misc)as ms from qoutes qt 
          left join insurer ins on qt.Key_Ref= ins.Key_Ref where qt.Key_Ref =? and qoute_type = "0"',[$id]);

          foreach($resultzn as $row){
            $ss = $row->ss;
            $fs = $row->fs;
            $ms = $row->ms;
          }

          $dbquery=DB::select('select vat from client_details where Key_Ref=? and vat>=1',[$id]);
          $dbquery_count=count($dbquery);

          if($dbquery_count>0){
              foreach($dbquery as $dbrow){
                $vatVal = $dbrow->vat;
                $vat    = $dbrow->vat/100;
              }
          }else{
            $vatVal = 15;
            $vat    = 0.15;
          }

          /*
          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:white;color:maroon;width:280px;"><b>Original Amount Of Claim</b></td>
          <td colspan="1" style="background-color:white;color:maroon;width:65px;"><b>R'.number_format(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste),2).'</b></td>
          <td colspan="1" style="background-color:white;color:maroon;width:65px;">&nbsp;</td>
          </tr>
          </table>
          ';*/

          $htmlx .='
            <table  style="width:100%;font-size:7px;">
            <tr>
            <td colspan="3" style="width:268px;"></td>
            <td colspan="4" style="background-color:;color:maroon;width:280px;"><h4>Original Amount Of Claim</h4></td>
            <td colspan="1" style="background-color:;color:maroon;width:65px;"><b>R'.number_format(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste),2).'</b></td>
            <td colspan="1" style="background-color:;color:maroon;width:65px;"></td>
            </tr>
            </table>
            ';
            #$pdf->writeHTMLCell(0, 0, '', '', $htmlx, 0, 1, 0, true, '', true);
            


            /*
          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" rowspan="6" style="height:50px;width:268px;">
          <div style="border:2px solid #5e6063;color:white;"><br><br><label style="color:black;">SIGNATURE OF ASSESSOR:</label></div><br>
          DATE:<hr style=" height:1px;color:gray;">
          </td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>PLUS Additionals</b></td>
          <td colspan="1" style="background-color:silver;width:65px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format(($ttlAdd_+($addttl+$addttl2+$addttl3)+$adOutwk+$AddTotal+$t2+$t),2).'</b></td>
          </tr>
          </table>
          ';
          */

          #REMOVE LINE BREAK [ 17 MAY 2021 ]
          # [ CURRENT NOW LOAD ]
          //$htmlx .='<br><br>
          $htmlx .='
            <table style="width:100%;font-size:7px;">
            <tr>
            <td colspan="4" rowspan="6" style="height:50px;width:268px;">
            <div style="border:2px solid #5e6063;color:white;"><br><br><label style="color:black;">SIGNATURE OF ASSESSOR:</label></div><br><br>
            DATE:<hr style=" height:1px;color:gray;">
            </td>
            <td colspan="4" style="background-color:silver;width:280px;"><h4>PLUS Additionals</h4></td>
            <td colspan="1" style="background-color:silver;width:65px;"></td>
            <td colspan="1" style="background-color:silver;width:65px;">R'.number_format(($ttlAdd_+($addttl+$addttl2+$addttl3)+$adOutwk+$AddTotal+$t2+$t+$plus_key_value),2).'</td>
            </tr>
            </table>
            ';
            #$pdf->writeHTMLCell(0, 0, '', '', $htmladd, 0, 1, 0, true, '', true);
            #$pdf->writeHTMLCell(0, 0, '', '', $htmlx, 0, 1, 0, true, '', true);


            

        /*
          $table_consumerables.='
          <table style="width:100%;font-size:7px;margin-top:-75px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="width:280px;"><b>LESS Saving</b></td>
          <td colspan="1" style="width:65px;">&nbsp;</td>
          <td colspan="1" style="width:65px;"><b>-R'.number_format($lessSav+$savTotal,2).'</b></td>
          </tr>
          </table>
          ';
          $newDiff = ($ttlAdd_+($addttl+$addttl2+$addttl3)+$adOutwk+$AddTotal+$t2+$t - ($lessSav+$savTotal));
          */

          # [ CURRENT NOW LOAD ]
          $htmlx .='
            <table style="width:100%;font-size:7px;">
            <tr>
            <td colspan="3" style="width:268px;"></td>
            <td colspan="4" style="width:280px;"><h4>LESS Saving</h4></td>
            <td colspan="1" style="width:65px;"></td>
            <td colspan="1" style="width:65px;">-R'.number_format($lessSav+$savTotal+$key_value,2).'</td>
            </tr>
            </table>
            ';
            $newDiff = ($ttlAdd_+($addttl+$addttl2+$addttl3)+$adOutwk+$AddTotal+$t2+$t - ($lessSav+$savTotal+$key_value));

          

        /*
          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>SUB Total</b></td>
          <td colspan="1" style="background-color:silver;width:65px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)+($sundries2-$sundries1),2).'</b></td>
          </tr>                                                               
          </table>
          ';*/

          $htmlx .='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>SUB Total</b></td>
          <td colspan="1" style="background-color:silver;width:65px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)+($sundries2-$sundries1),2).'</b></td>
          </tr>                                                               
          </table>
          ';

          /*
           $pdf->writeHTMLCell(0, 0, '', '', $htmlx, 0, 1, 0, true, '', true);
            $pdf->Output('Final costing.pdf', 'I');
            die;
            */




            /*
          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="width:280px;"><b>%Trade Discount</b></td>
          <td colspan="1" style="width:65px;"><b>'.$dicp.'%b</></td>
          <td colspan="1" style="width:65px;"><b>'.$dicp2.'%</b></td>
          </tr>
          </table>
          ';*/

          $htmlx .='
            <table style="width:100%;font-size:7px;">
            <tr>
            <td colspan="4" style="width:268px;"></td>
            <td colspan="4" style="width:280px;"><h4>%Trade Discount</h4></td>
            <td colspan="1" style="width:65px;">'.$dicp.'%</td>
            <td colspan="1" style="width:65px;">'.$dicp2.'%</td>
            </tr>
            </table>
            ';

          


          

          /*
          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>Less Discount<b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b> - R'.number_format($dicv1,2).'</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>- R'.number_format($dicv2,2).'</b></td>
          </tr>
          </table>
          ';*/


          $htmlx .='
        <table style="width:100%;font-size:7px;">
        <tr>
        <td colspan="4" style="width:268px;"></td>
        <td colspan="4" style="background-color:silver;width:280px;"><h4>Less Discount</h4></td>
        <td colspan="1" style="background-color:silver;width:65px;"> - R'.number_format($dicv1,2).'</td>
        <td colspan="1" style="background-color:silver;width:65px;"> - R'.number_format($dicv2,2).'</td>
        </tr>
        </table>
        ';

           

       

            /*
          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="3"style="width:112px;"><b>Betterment to client</b></td>
          <td style="width:168px;"><b>Inv to client (Inc 15% VAT)</b></td>
          <td style="width:65px;">&nbsp;</td>
          <td style="width:65px;">&nbsp;</td>
          </tr>
          </table>
          ';*/

           $htmlx .='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="3"style="width:112px;"><b>Betterment to client</b></td>
          <td style="width:168px;"><b>Inv to client (Inc 15% VAT)</b></td>
          <td style="width:65px;">&nbsp;</td>
          <td style="width:65px;">&nbsp;</td>
          </tr>
          </table>
          ';



            


            /*
          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="3" style="background-color:silver;width:112px;"><b>'.number_format($btmnt,2).'</b></td>
          <td style="background-color:silver;width:168px;"><b>'.number_format(($btmnt+$adbt)*1.15,2).'</b></td>
          <td style="background-color:silver;width:65px;"><b> - '.number_format($btmnt_,2).'</b></td>
          <td style="background-color:silver;width:65px;"><b> - '.number_format($btmnt+$adbt,2).'</b></td>
          </tr>
          </table>
          ';*/

           $htmlx .='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="3" style="background-color:silver;width:112px;"><b>'.number_format($btmnt,2).'</b></td>
          <td style="background-color:silver;width:168px;"><b>'.number_format(($btmnt+$adbt)*1.15,2).'</b></td>
          <td style="background-color:silver;width:65px;"><b> - '.number_format($btmnt_,2).'</b></td>
          <td style="background-color:silver;width:65px;"><b> - '.number_format($btmnt+$adbt,2).'</b></td>
          </tr>
          </table>
          ';



           


            /*
          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;margin-bottom:-5px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="width:280px;"><b>SUB Total</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1,2).'</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2)+($sundries2-$sundries1),2).'</b></td>
          </tr>
          </table>
          ';*/

           $htmlx .='
          <table border="0" style="width:100%;font-size:7px;margin-bottom:-5px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="width:280px;"><b>SUB Total</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1,2).'</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2)+($sundries2-$sundries1),2).'</b></td>
          </tr>
          </table>
          ';

         



          $vat1 = $vat*(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1);
          $vat2 = $vat*((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2+($sundries2-$sundries1));
        
        /*
          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>'.$vatVal.'% VAT</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($vat1,2).'</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($vat2,2).'</b></td>
          </tr>
          </table>
          ';*/

          $htmlx .='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>'.$vatVal.'% VAT</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($vat1,2).'</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($vat2,2).'</b></td>
          </tr>
          </table>
          ';

           

          /*
          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" rowspan="5" style="width:268px;font-size:10px;">
          <b>'.$assessor_comp.'</b><br>
          '.$assessor_name.'-'.$assessor_cell.'-EMAIL:'.$assessor_email.'
          </td>
          <td colspan="4" style="width:280px;"><b>SUB Total</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format((($vat1+$ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1),2).'</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(((($vat2+$ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2)+($sundries2-$sundries1),2).'</b></td>
          </tr>
          </table>
          ';*/


          $htmlx .='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" rowspan="5" style="width:268px;font-size:10px;">
          <b>'.$assessor_comp.'</b><br>
          '.$assessor_name.'-'.$assessor_cell.'-EMAIL:'.$assessor_email.'
          </td>
          <td colspan="4" style="width:280px;"><b>SUB Total</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format((($vat1+$ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1),2).'</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(((($vat2+$ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2)+($sundries2-$sundries1),2).'</b></td>
          </tr>
          </table>
          ';

         


            /*
          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>Excess 1</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b> - R'.number_format($Excess,2).'</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b> - R'.number_format($Excess2,2).'</b></td>
          </tr>
          </table>
          ';*/

          $htmlx .='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>Excess 1</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b> - R'.number_format($Excess,2).'</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b> - R'.number_format($Excess2,2).'</b></td>
          </tr>
          </table>
          ';

        


          /*
          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr >
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="width:280px;color:maroon"><b>Total</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(($vat1+(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1))-$Excess,2).'</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format($vat2+((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2)+($sundries2-$sundries1)-$Excess2,2).'</b></td>
          </tr>
          </table>
          ';*/

          $htmlx .='
          <table border="0" style="width:100%;font-size:7px;">
          <tr >
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="width:280px;color:maroon"><b>Total</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(($vat1+(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1))-$Excess,2).'</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format($vat2+((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2)+($sundries2-$sundries1)-$Excess2,2).'</b></td>
          </tr>
          </table>
          ';

           
          /*
          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>1st Auth</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>Current</b></td>
          </tr>
          </table>
          ';*/

           $htmlx .='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>1st Auth</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>Current</b></td>
          </tr>
          </table>
          ';

         
          /*
          $table_consumerables.='
          <div style="black;color:gray;font-size:8px;">
          <h5>Terms And Conditions</h5>
          1. Final repair calculations must be signed by the assessor prior to delivery of vehicles as per company T&C repair times.<br>
          2. All costings are to be signed and returned within 48 hours, failure to do so will result in the client being held liable.<br>
          3. Subject to insurance claim vehicles, the owner of the vehicle shall remain liable for the repair, salvage & storage costs until the insurer makes payment on such cost.<br>
          4. Insurance companies with a current signed SLA will not be allowed to audit files not older than 12 months.<br>
          5. Insurance companies without a current signed SLA will not be allowed to conduct audit.<br>
          6. Only qualified auditors with the correct certification will be allowed to audit, provided a current signed SLA is in place with the insurance company requesting the audit.<br>
          7. Insurance assessors are not allowed a 5% settlement without SLA in place<br>
          8. Insurance allowing mark up only on parts is liable to pay the parts provider
          </div>';*/


          $htmlx .='
          <div style="black;color:gray;font-size:8px;">
          <h5>Terms And Conditions</h5>
          1. Final repair calculations must be signed by the assessor prior to delivery of vehicles as per company T&C repair times.<br>
          2. All costings are to be signed and returned within 48 hours, failure to do so will result in the client being held liable.<br>
          3. Subject to insurance claim vehicles, the owner of the vehicle shall remain liable for the repair, salvage & storage costs until the insurer makes payment on such cost.<br>
          4. Insurance companies with a current signed SLA will not be allowed to audit files not older than 12 months.<br>
          5. Insurance companies without a current signed SLA will not be allowed to conduct audit.<br>
          6. Only qualified auditors with the correct certification will be allowed to audit, provided a current signed SLA is in place with the insurance company requesting the audit.<br>
          7. Insurance assessors are not allowed a 5% settlement without SLA in place<br>
          8. Insurance allowing mark up only on parts is liable to pay the parts provider
          </div>';




           $pdf->writeHTMLCell(0, 0, '', '', $htmlx, 0, 1, 0, true, '', true);
         //$pdf->Output('Final costing.pdf', 'I');
        // die;

          $resultxxx_count=count($resultxxx);
          #$resultxxx_count= 4;
          if($resultxxx_count>0){

            $pdf->AddPage();
            $pdf->Image($image);
            #$width ='300px;';
            $width =(int)300;
            $strText ="";
            #$height ="20px";
            $height =(int)20;
            $strText = str_replace("\n","<br>",$strText);

            $pdf->MultiCell($width, $height,$strText, 0, 'J', 0, 1, '', '', true, null, true);

            $html = '
            <table border="1" style="width:100%;">
            <tr>
            <td style="width:108px;"><h5>Insurance</h5></td>
            <td style="width:208px;background-color:;"><h5>'.$val9.'</h5></td>
            <td style="width:108px;"><h5>ASSESSOR</h5></td>
            <td style="width:238px;background-color:;"><h5>'.$val7.'</h5></td>
            </tr>

            <tr>
            <td style="width:108px;"><h5>INSURED</h5></td>
            <td style="width:208px;background-color:;"><h5>'.$val1." ".$val2.'</h5></td>
            <td style="width:108px;"><h5>Claim No</h5></td>
            <td style="width:238px;background-color:;"><h5>'.$val8.'</h5></td>
            </tr>

            <tr>
            <td style="width:108px;"><h5>REGISTRATION NO</h5></td>
            <td style="width:208px;background-color:;"><h5>'.$val3." ".$val2.'</h5></td>
            <td style="width:108px;"><h5>REF NO/ASSESSOR REF</h5></td>
            <td style="width:238px;background-color:;"><h5>'.$id.' / '.$val10.'</h5></td>
            </tr>

            <tr>
            <td style="width:108px;"><h5>VEHICLE</h5></td>
            <td style="width:208px;background-color:;"><h5>'.$val4." ".$val5.'</h5></td>
            <td style="width:108px;"><h5>DATE</h5></td>
            <td style="width:238px;background-color:;"><h5>'.$val6.'</h5></td>
            </tr>
            </table>

            <br><br>

            ';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


            $html = ' <table border="1" style="width:100%;font-size:7px;">
                <tr style="background-color:black;color:white;">
                <td style="width:20px;"><h4>No</h4></td>
                <td style="width:165px;"><h4>Part Description</h4></td>
                <td style="width:54px;"><h4>Oper</h4></td>
                <td style="width:56px;"><h4>Landing Price</h4></td>
                <td style="width:85px;"><h4>Mark-Up</h4></td>
                <td style="width:56px;"><h4>Betterment</h4></td>
                <td style="width:56px;"><h4>Saving</h4></td>
                <td style="width:56px;"><h4>Additional</h4></td>
                <td style="width:56px;"><h4>Quoted Price</h4></td>
                <td style="width:56px;"><h4>Actual Price</h4></td>
                </tr>
        '; #</table>

        /*
            #$html=' <table border="1" style="width:100%;height:%;font-size:7px;">'.$tbl.'</table>';
            $html .= $tbl.'</table>';
        */

             
             $html .=$tblp3.'</table>';

            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);



             /*
              $table_header='

              <table border="1" style="width:100%;">
              <tr>
              <td style="width:108px;"><h5>Insurance</h5></td>
              <td style="width:208px;background-color:white;"><h5>'.$val9.'</h5></td>
              <td style="width:108px;"><h5>ASSESSOR</h5></td>
              <td style="width:237px;background-color:white;"><h5>'.$val7.'</h5></td>
              </tr>
              
              <tr>
              <td style="width:108px;"><h5>INSURED</h5></td>
              <td style="width:208px;background-color:white;"><h5>'.$val1." ".$val2.'</h5></td>
              <td style="width:108px;"><h5>Claim No</h5></td>
              <td style="width:237px;background-color:white;"><h5>'.$val8.'</h5></td>
              </tr>
              
              <tr>
              <td style="width:108px;"><h5>REGISTRATION NO</h5></td>
              <td style="width:208px;background-color:white;"><h5>'.$val3." ".$val2.'</h5></td>
              <td style="width:108px;"><h5>REF NO/ASSESSOR REF</h5></td>
              <td style="width:237px;background-color:white;"><h5>'.$id.' / '.$val10.'</h5></td>
              </tr>
              
              <tr>
              <td style="width:108px;"><h5>VEHICLE</h5></td>
              <td style="width:208px;background-color:white;"><h5>'.$val4." ".$val5.'</h5></td>
              <td style="width:108px;"><h5>DATE</h5></td>
              <td style="width:237px;background-color:white;"><h5>'.$val6.'</h5></td>
              </tr>
              </table>
              
              <br><br>
              
              <table style="width:100%;font-size:7px;">
              <tr style="background-color:black;color:white;">
              <td style="width:20px;"><h4>No</h4></td>
              <td style="width:165px;"><h4>Part Description</h4></td>
              <td style="width:54px;"><h4>Oper</h4></td>
              <td style="width:56px;"><h4>Landing Price</h4></td>
              <td style="width:85px;"><h4>Mark-Up</h4></td>
              <td style="width:56px;"><h4>Betterment</h4></td>
              <td style="width:56px;"><h4>Saving</h4></td>
              <td style="width:56px;"><h4>Additional</h4></td>
              <td style="width:56px;"><h4>Quoted Price</h4></td>
              <td style="width:56px;"><h4>Actual Price</h4></td>
              </tr>
              </table>
              ';
              $table_header.='<tr>
              <td colspan="5" style="width:380px;"><h4>Total Parts Page 2</h4></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($betterment_total12,2).'</b></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($less_saving12,2).'</b></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($plus_additional12,2).'</b></td>
              <td style="background-color:silver;width:56px;"><b>R'.number_format($part_total12,2).'</b></td>
              <td colspan="1" style="background-color:silver;width:56px;"><b>R'.number_format($actual_price_total12,2).'</b></td>
              </tr>';
              $table2.='<tr>
              <td colspan="5" style="width:380px;"><h4>Total Parts Page 2</h4></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($betterment_total13,2).'</b></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($less_saving13,2).'</b></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($plus_additional13,2).'</b></td>
              <td style="background-color:silver;width:56px;"><b>R'.number_format($part_total13,2).'</b></td>
              <td colspan="1" style="background-color:silver;width:56px;"><b>R'.number_format($actual_price_total13,2).'</b></td>
              </tr>';
              */


          }

         $pdf->Output('Final costing.pdf', 'I');


    }//End Of Function

    public function final_costing_no_extra($id){
        $result1_aa=DB::select('select Discount,Discount2 from qoutes where  Key_Ref=? and qoute_type = "0"',[$id]);
        $disc_val1 = 0;
        $disc_val2 = 0;
        $waste = 0;
        $table_header='';
        $opt='';
        foreach($result1_aa as $row){
            $disc_val1 = $row->Discount;
            $disc_val2 = $row->Discount2;
        }//end For Each
        
        $dbquery=DB::select('select * FROM client_details WHERE Key_Ref=?',[$id]);
        $tbl1 = "";
        $count=1;
        $part_total_p2zz = 0;
        $actual_price_total_p2zz = 0;
        $plus_additional_p2zz = 0;
        $less_saving_p2zz = 0;
        $betterment_total_p2zz =0;

        foreach($dbquery as $dbrow){
            $val1   = $dbrow->Fisrt_Name;
            $val2   = $dbrow->Last_Name;
            $val3   = $dbrow->Reg_No;
            $val4   = $dbrow->Make;
            $val5   = $dbrow->Model;
            $val6   = $dbrow->Date;	
            $branch = $dbrow->branch;	
        }//End foreach
        $dbquery1=DB::select('select * FROM insurer WHERE Key_Ref=?',[$id]);
        $val7 = '';
        $val8 = '';
        $val9 = '';
        $val10 = '';
        $betterment_total_p2 = 0;
        $less_saving_p2  = 0;
        $plus_additional_p2  = 0;
        $betterment_total_p3  = 0;
        $less_saving_p3  = 0;
        $plus_additional_p3  = 0;
        $part_total_p3  = 0;
        $actual_price_total_p3  = 0;
        $actual_price_total_p2  = 0;
        $part_total_p2  = 0;
        $vat  = 0;

        foreach($dbquery1 as $dbrow1){
            $val7 = $dbrow1->Assessor;
            $val8 = $dbrow1->Claim_NO;
            $val9 = $dbrow1->Inserer;
            $val10= $dbrow1->Assessor_Ref;	
            $vat  = $dbrow1->vat;
        }

        $labour   = 0;
        $paint    = 0;
        $strip    = 0;
        $frame    = 0;
        $outwork  = 0;

        $result=DB::select('select id,Percent,MarkUp,MarkUp2,Betterment,Quantity,Description,Key_Ref,Parts_sales,Part,Oper,Part,round(Part-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price  from qoutes where Key_Ref =? and Part>0 and qoute_type = "0" limit 0,30',[$id]);
        $resultxxx=DB::select('select id,Percent,MarkUp,MarkUp2,Betterment,Quantity,Description,Key_Ref,Parts_sales,Part,Oper,Part,round(Part-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price  from qoutes where Key_Ref =? and Part>0 and qoute_type ="0" limit 30,130',[$id]);
        $resultxxxx=DB::select('select id,Percent,MarkUp,MarkUp2,Betterment,Quantity,Description,Key_Ref,Parts_sales,Part,Oper,Part,round(Part-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price  from qoutes where Key_Ref =? and Part>0 and qoute_type = "0" limit 130,230',[$id]);
        $resulte=DB::select('select * from oper order by oper');

        foreach($resulte as $row){
            $opt.= "<option val='".$row->oper."'>".$row->oper."</option>";
        }//End Of Foreach

        $count = 1;
        $status='';
        $lndT = 0;
        $ptT = 0;
        $savT = 0;
        $actl = 0;
        $btmnt = 0;
        $btmnt_ = 0;
        $actual_priceT = 0;
        $tbl="";
        $tbl2="";
        $tblp2 = "";
        $tblp3 = "";
        $tblp2st= "";
        $actlttl = 0;
        $qtedttl = 0;
        $savettl = 0;
        $addttl = 0;
        $actlttl2 = 0;
        $qtedttl2 = 0;
        $savettl2 = 0;
        $addttl2 = 0;
        $actlttl3 = 0;
        $qtedttl3 = 0;
        $savettl3 = 0;
        $addttl3 = 0;
        $mark = 0;

        foreach($result as $row){
            $add=0;
            $save = 0;
            $qted = ($row->Part*$row->Quantity)*+(1+($row->Percent/100));
            if($row->Parts_sales<=0){
                $status = "<span class='badge' style='background-color:red'>No</span>";
            }else if($row->Parts_sales>0){
                $status = "<span class='badge' style='background-color:green'>Yes</span>";
            }if($row->actual_price>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = 0;	
                $add = ($row->actual_price - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));	
            }else if($row->actual_price<($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$row->actual_price);	
                $add = 0;	
            }
            if(number_format($row->MarkUp2)==0){
                
                $mark = 'Nett + '.$row->MarkUp.'% Mark Up';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{
                    $actl = $row->actual_price;
                }
            }else{
                $mark = $row->MarkUp2.'% Mark Up Only';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{//(Parts_sales+(Parts_sales*(MarkUp/100)))
                    $actl = $row->Parts_sales*(($row->MarkUp2)/100);
                    if($actl>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                        $add = ($actl - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));
                        $save = 0;
                    }else{
                        $add = 0;
                        $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$actl);
                    }
                }
                //$add = 0;
                //$save = 0;
            }
        $actlttl += $actl;
        $qtedttl += $qted;
        $savettl += $save;
        $addttl += $add;
        $btmnt+= $actl*$row->Betterment/100;
        $btmnt_+= ($row->Part*$row->Quantity)*+(1+($row->Percent/100))*$row->Betterment/100;
       $tbl.= '<tr>
                <td style="width:20px;">'.$count.'</td>
                <td style="width:165px">'.$row->Description.'</td>
                <td style="width:54px">'.$row->Oper.'</td>
                <td style="width:56px;">'.number_format($row->Parts_sales,2).'</td>
                <td style="width:85px;">'.$mark.'</td>
                <td style="width:56px;">'.$row->Betterment.'</td>
                <td style="width:56px;">'.number_format($save,2).'</td>
                <td style="width:56px;">'.number_format($add,2).'</td>
                <td style="width:56px;">'.number_format($qted,2).'</td>
                <td style="width:56px;">'.number_format($actl,2).'</td>
            </tr>';
       $count++;
        }//End OF Foreach
        $countp1 = 31;
        foreach($resultxxx as $row){
            $add=0;
            $save = 0;
            $qted = ($row->Part*$row->Quantity)*+(1+($row->Percent/100));
            if($row->Parts_sales<=0){
                $status = "<span class='badge' style='background-color:red'>No</span>";
            }else if($row->Parts_sales>0){
                $status = "<span class='badge' style='background-color:green'>Yes</span>";
            }if($row->actual_price>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = 0;	
                $add = ($row->actual_price - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));	
            }else if($row->actual_price<($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$row->actual_price);	
                $add = 0;	
            }
            if(number_format($row->MarkUp2)==0){
                
                $mark = 'Nett + '.$row->MarkUp.'% Mark Up';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{
                    $actl = $row->actual_price;
                }
            }else{
                $mark = $row->MarkUp2.'% Mark Up Only';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{//(Parts_sales+(Parts_sales*(MarkUp/100)))
                    $actl = $row->Parts_sales*(($row->MarkUp2)/100);
                    if($actl>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                        $add = ($actl - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));
                        $save = 0;
                    }else{
                        $add = 0;
                        $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$actl);
                    }
                }
                //$add = 0;
                //$save = 0;
            }
        $actlttl2 += $actl;
        $qtedttl2 += $qted;
        $savettl2 += $save;
        $addttl2 += $add;
        $btmnt+= $actl*$row->Betterment/100;
        $btmnt_+= ($row->Part*$row->Quantity)*+(1+($row->Percent/100))*$row->Betterment/100;
       $tblp2.= '<tr>
                <td style="width:20px;">'.$count.'</td>
                <td style="width:165px">'.$row->Description.'</td>
                <td style="width:54px">'.$row->Oper.'</td>
                <td style="width:56px;">'.number_format($row->Parts_sales,2).'</td>
                <td style="width:85px;">'.$mark.'</td>
                <td style="width:56px;">'.$row->Betterment.'</td>
                <td style="width:56px;">'.number_format($save,2).'</td>
                <td style="width:56px;">'.number_format($add,2).'</td>
                <td style="width:56px;">'.number_format($qted,2).'</td>
                <td style="width:56px;">'.number_format($actl,2).'</td>
            </tr>';
       $countp1++;
        }
        $countp2 = 131;
        foreach($resultxxxx as $row){
            $add=0;
            $save = 0;
            $qted = ($row->Part*$row->Quantity)*+(1+($row->Percent/100));
            if($row->Parts_sales<=0){
                $status = "<span class='badge' style='background-color:red'>No</span>";
            }else if($row->Parts_sales>0){
                $status = "<span class='badge' style='background-color:green'>Yes</span>";
            }if($row->actual_price>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = 0;	
                $add = ($row->actual_price - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));	
            }else if($row->actual_price<($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$row->actual_price);	
                $add = 0;	
            }
            if(number_format($row->MarkUp2)==0){
                
                $mark = 'Nett + '.$row->MarkUp.'% Mark Up';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{
                    $actl = $row->actual_price;
                }
            }else{
                $mark = $row->MarkUp2.'% Mark Up Only';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{//(Parts_sales+(Parts_sales*(MarkUp/100)))
                    $actl = $row->Parts_sales*(($row->MarkUp2)/100);
                    if($actl>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                        $add = ($actl - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));
                        $save = 0;
                    }else{
                        $add = 0;
                        $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$actl);
                    }
                }
                //$add = 0;
                //$save = 0;
            }
        $actlttl3 += $actl;
        $qtedttl3 += $qted;
        $savettl3 += $save;
        $addttl3 += $add;
        $btmnt+= $actl*$row->Betterment/100;
        $btmnt_+= ($row->Part*$row->Quantity)*+(1+($row->Percent/100))*$row->Betterment/100;
       $tblp3.= '<tr>
                <td style="width:20px;">'.$count.'</td>
                <td style="width:165px">'.$row->Description.'</td>
                <td style="width:54px">'.$row->Oper.'</td>
                <td style="width:56px;">'.number_format($row->Parts_sales,2).'</td>
                <td style="width:85px;">'.$mark.'</td>
                <td style="width:56px;">'.$row->Betterment.'</td>
                <td style="width:56px;">'.number_format($save,2).'</td>
                <td style="width:56px;">'.number_format($add,2).'</td>
                <td style="width:56px;">'.number_format($qted,2).'</td>
                <td style="width:56px;">'.number_format($actl,2).'</td>
            </tr>';
       $countp2++;
        }
        if($count<30){
            for($i=$count;$i<31;$i++){
                $tbl.= "<tr>
                    <td>".$i."</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>";
            }
        }
        $result5=DB::select('select * FROM assessors where Names=? ORDER BY `id` DESC LIMIT 0,1',[$val7]);
        $assessor_name = "";
        $assessor_cell = "";
        $assessor_email= "";
        $assessor_comp = "";
        $result5_count=count($result5);
        if($result5_count>0){
            foreach($result5 as $row5){
                $assessor_name = $row5->Names;
                $assessor_cell = $row5->Cell;
                $assessor_email= $row5->Email;
                $assessor_comp = $row5->Company;
            }
        }else{
            $assessor_name = "";
            $assessor_cell = "";
            $assessor_email= "";
            $assessor_comp = "";
        }
        $final_head='';
        //$table_header.='
        $final_head='
        <table  style="width:100%;font-size:7px;border-collapse: collapse;border: 1px solid black;">
        <tr>
        <td style="width:108px;height:12px;border: 1px solid black;">INSURANCE</td>
        <td style="width:208px;border: 1px solid black;">'.$val9.'</td>
        <td style="width:108px;border: 1px solid black;">ASSESSOR</td>
        <td style="width:238px;background-color:white;border: 1px solid black;">'.$val7.'</td>
        </tr>
        
        <tr>
        <td style="width:108px;border: 1px solid black;">INSURED</td>
        <td style="width:208px;background-color:white;border: 1px solid black;">'.$val1." ".$val2.'</td>
        <td style="width:108px;border: 1px solid black;">Claim No</td>
        <td style="width:238px;background-color:white;border: 1px solid black;">'.$val8.'</td>
        </tr>
        
        <tr>
        <td style="width:108px;border: 1px solid black;">REGISTRATION NO</td>
        <td style="width:208px;background-color:white;border: 1px solid black;">'.$val3." ".$val2.'</td>
        <td style="width:108px;border: 1px solid black;">REF NO/ASSESSOR REF</td>
        <td style="width:238px;background-color:white;border: 1px solid black;">'.$id.' / '.$val10.'</td>
        </tr>
        
        <tr>
        <td style="width:108px;border: 1px solid black;">VEHICLE</td>
        <td style="width:208px;background-color:white;border: 1px solid black;">'.$val4." ".$val5.'</td>
        <td style="width:108px;border: 1px solid black;">DATE</td>
        <td style="width:238px;background-color:white;border: 1px solid black;">'.$val6.'</td>
        </tr>
        </table>
        
        
        <table style="width:100%;font-size:10px;margin-top:5px;border-collapse: collapse;border: 1px solid black;">
        <tr style="background-color:black;color:white;">
        <td style="width:20px;border: 1px solid black;"><b>No</b></td>
        <td style="width:165px;border: 1px solid black;">Part Description</td>
        <td style="width:54px;border: 1px solid black;">Oper</td>
        <td style="width:56px;border: 1px solid black;">Landing Price</td>
        <td style="width:85px;border: 1px solid black;">Mark-Up</td>
        <td style="width:56px;border: 1px solid black;">Betterment</td>
        <td style="width:56px;border: 1px solid black;">Saving</td>
        <td style="width:56px;border: 1px solid black;">Additional</td>
        <td style="width:56px;border: 1px solid black;">Quoted Price</td>
        <td style="width:56px;border: 1px solid black;">Actual Price</td>
        </tr>
        </table>
        ';
        $table_test='';
        $ttlAdd = 0;
        $ttlAdd_ = 0;
        $result_x =DB::select('select * FROM additional WHERE Key_Ref=? AND Part>"0"',[$id]);
        foreach($result_x as $row){
            if(number_format($row->MarkUp2)==0){
                $ttlAdd_ += $row->Quantity*$row->Part*(1+($row->MarkUp/100));
            }else{
                $ttlAdd_ += $row->Quantity*$row->Part*(($row->MarkUp2/100));
            }
        }
        $table_test.='

        <table border="1" style="width:100%;height:%;font-size:8px;margin-bottom:5px;border-collapse: collapse;border: 1px solid black;">'.$tbl.'</table>
        ';
        $result1=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" ORDER BY id limit 0,30',[$id]); 
        $result12=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" and qoute_type = "0" ORDER BY id limit 30,130',[$id]);        
        $result13=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" and qoute_type = "0" ORDER BY id limit 130,230',[$id]);
        $result1x=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" and qoute_type = "0" ORDER BY id',[$id]);
        $ref1 = '';
        $part_id1     = '';
        $oper1        = '';
        $description1 = '';
        
        
        $betterment_total1x  = 0;
        $betterment_total1  = 0;
        $betterment_total12  = 0;
        $betterment_total13  = 0;
        $part_total1x        = 0;
        $part_total1        = 0;
        $part_total12        = 0;
        $part_total13        = 0;
        $actual_price_total1= 0;
        $actual_price_total1x= 0;
        $actual_price_total12= 0;
        $actual_price_total13= 0;
        $less_saving1x = 0;
        $less_saving1 = 0;
        $less_saving12 = 0;
        $less_saving13 = 0;
        $plus_additional1 = 0;
        $plus_additional1x = 0;
        $plus_additional12 = 0;
        $plus_additional13 = 0;
        $additional_price1 = 0;

        foreach($result1x as $row1){
            $percent1     = ($row1->Part*$row1->Percent/100);
            $quantity1    = $row1->Quantity;
            $part1        = ($row1->Part*$row1->Quantity)*(1+($row1->Percent/100));
            $part_sales1  = $row1->Parts_sales;
            $markup1      = $row1->MarkUp;
            $betterment1  = $row1->Betterment;
            
        
            $savings1     =($part_sales1 * $markup1/100);
            $actual_price1=($part_sales1 + $savings1);
            $new_savings1 =($part1 - $actual_price1);
        
            $betterment_total1  = ($betterment_total1 + $actual_price1 * $betterment1 / 100);
            $part_total1        = ($part_total1 + $part1);
            $actual_price_total1= ($actual_price_total1 + $actual_price1);
        
            if($part_sales1<=0){
                $new_savings1=$part1;	
            }
        
            if($new_savings1<0){
                $new_savings1 = 0;	
                $additional_price1 = ($actual_price1 - $part1);	
            }else{
                $additional_price1 = 0;	
            }
           $less_saving1     += $new_savings1;
           //$plus_additional1 += $additional_price1;
        }
        foreach($result1 as $row1){
            $percent1     = ($row1->Part*$row1->Percent/100);
            $quantity1    = $row1->Quantity;
            $part1        = ($row1->Part*$row1->Quantity)*(1+($row1->Percent/100));
            $part_sales1  = $row1->Parts_sales;
            $markup1      = $row1->MarkUp;
            $betterment1  = $row1->Betterment;
            
            $savings1     =($part_sales1 * $markup1/100);
            $actual_price1=($part_sales1 + $savings1);
            $new_savings1 =($part1 - $actual_price1);
        
            $betterment_total1x  = ($betterment_total1 + $actual_price1 * $betterment1 / 100);
            $part_total1x        = ($part_total1x + $part1);
            $actual_price_total1x= ($actual_price_total1x + $actual_price1);
        
            if($part_sales1<=0){
                $new_savings1=$part1;	
            }
        
            if($new_savings1<0){
                $new_savings1 = 0;	
                $additional_price1 = ($actual_price1 - $part1);	
            }else{
                $additional_price1 = 0;	
            }
           $less_saving1x     += $new_savings1;
           $plus_additional1x += $additional_price1;
        }
        foreach($result12 as $row1){
            $percent1     = ($row1->Part*$row1->Percent/100);
            $quantity1    = $row1->Quantity;
            $part1        = ($row1->Part*$row1->Quantity)*(1+($row1->Percent/100));
            $part_sales1  = $row1->Parts_sales;
            $markup1      = $row1->MarkUp;
            $betterment1  = $row1->Betterment;
            
            $savings1     =($part_sales1 * $markup1/100);
            $actual_price1=($part_sales1 + $savings1);
            $new_savings1 =($part1 - $actual_price1);
        
            $betterment_total12  = ($betterment_total1 + $actual_price1 * $betterment1 / 100);
            $part_total12        = ($part_total12 + $part1);
            $actual_price_total12= ($actual_price_total12 + $actual_price1);
        
            if($part_sales1<=0){
                $new_savings1=$part1;	
            }
        
            if($new_savings1<0){
                $new_savings1 = 0;	
                $additional_price1 = ($actual_price1 - $part1);	
            }else{
                $additional_price1 = 0;	
            }
           $less_saving12     += $new_savings1;
           $plus_additional12 += $additional_price1;
        }

        foreach($result13 as $row1){
            $percent1     = ($row1->Part*$row1->Percent/100);
            $quantity1    = $row1->Quantity;
            $part1        = ($row1->Part*$row1->Quantity)*(1+($row1->Percent/100));
            $part_sales1  = $row1->Parts_sales;
            $markup1      = $row1->MarkUp;
            $betterment1  = $row1->Betterment;
            
            $savings1     =($part_sales1 * $markup1/100);
            $actual_price1=($part_sales1 + $savings1);
            $new_savings1 =($part1 - $actual_price1);
        
            $betterment_total12  = ($betterment_total1 + $actual_price1 * $betterment1 / 100);
            $part_total12        = ($part_total12 + $part1);
            $actual_price_total12= ($actual_price_total12 + $actual_price1);
        
            if($part_sales1<=0){
                $new_savings1=$part1;	
            }
        
            if($new_savings1<0){
                $new_savings1 = 0;	
                $additional_price1 = ($actual_price1 - $part1);	
            }else{
                $additional_price1 = 0;	
            }
           $less_saving12     += $new_savings1;
           $plus_additional12 += $additional_price1; 
        }
        $final_pages='';
        //$table_header.=''
        $final_pages='
        <table style="width:100%;font-size:7px;border:none;margin-bottom:5px;">
        <tr>
        <td colspan="3" style="width:268px;">&nbsp;</td>
        <td colspan="2" style="width:112px;"><b>Total Parts Page 1</b></td>
        <td colspan="0" style="background-color:silver;width:50px;"><b>R'.number_format($betterment_total1x,2).'</b></td>
        <td colspan="0" style="background-color:silver;width:60px;"><b>R'.number_format($savettl,2).'</b></td>
        <td colspan="0" style="background-color:silver;width:60px;"><b>R'.number_format($addttl,2).'</b></td>
        <td style="background-color:silver;width:60px;"><b>R'.number_format($qtedttl,2).'</b></td>
        <td colspan="1" style="background-color:silver;width:60px;"><b>R'.number_format($actlttl,2).'</b></td>
        </tr>
        <tr>
        <td colspan="3" style="width:268px;"></td>
        <td colspan="2" style="width:112px;"><b>Total Parts Page 2</b></td>
        <td colspan="0" style="background-color:#fff;width:50px;"><b>R'.number_format($betterment_total12,2).'</b></td>
        <td colspan="0" style="background-color:#fff;width:60px;"><b>R'.number_format($savettl2,2).'</b></td>
        <td colspan="0" style="background-color:#fff;width:60px;"><b>R'.number_format($addttl2,2).'</b></td>
        <td style="background-color:#fff;width:60px;"><b>R'.number_format($qtedttl2,2).'</b></td>
        <td colspan="1" style="background-color:#fff;width:60px;"><b>R'.number_format($actlttl2,2).'</b></td>
        </tr>
        <tr>
        <td colspan="3" style="width:268px;"></td>
        <td colspan="2" style="width:112px;"><b>Total Parts Page 3</b></td>
        <td colspan="0" style="background-color:silver;width:50px;"><b>R'.number_format($betterment_total13,2).'</b></td>
        <td colspan="0" style="background-color:silver;width:60px;"><b>R'.number_format($savettl3,2).'</b></td>
        <td colspan="0" style="background-color:silver;width:60px;"><b>R'.number_format($addttl3,2).'</b></td>
        <td style="background-color:silver;width:60px;"><b>R'.number_format($qtedttl3,2).'</b></td>
        <td colspan="1" style="background-color:silver;width:60px;"><b>R'.number_format($actlttl3,2).'</b></td>
        </tr>
        </table>
        ';

        $result_=DB::select('select * FROM additional WHERE Key_Ref=? AND Part>"0"',[$id]);

        $part_id     = '';
        $oper        = '';
        $description = '';
        $percent     = 0;
        $quantity    = 0;
        $part        = 0;
        $part_sales  = 0;
        $markup      = 0;
        $betterment  = 0;
        $disc_val    = 0;
        
        $savings     =0;
        $actual_price=0;
        $new_savings =0;
        
        $betterment_total  = 0;
        $part_total        = 0;
        $actual_price_total= 0;
        $less_saving = 0;
        $plus_additional = 0;
        $additional_price = 0;

        foreach($result_ as $row){
            $part_id     = $row->id;
            $oper        = $row->Oper;
            $description = $row->Description;
            $percent     = ($row->Part*$row->Percent/100);
            $quantity    = $row->Quantity;
            $part        = ($row->Part+$percent);
            $part_sales  = $row->Part;
            $markup      = $row->MarkUp;
            $betterment  = $row->Betterment;
        
            $savings     =($part_sales * $markup/100);
            $actual_price=($part_sales + $savings);
            $new_savings =($part - $actual_price);
        
            $betterment_total  = ($betterment_total + $actual_price * $betterment / 100);
            $part_total        = ($part_total + $part);
            $actual_price_total= ($actual_price_total + $actual_price);
        
            if($part_sales<=0){
                $new_savings=$part;	
            }
        
            if($new_savings<0){
                $new_savings = 0;	
                $additional_price = ($actual_price - $part);	
            }else{
                $additional_price = 0;	
            }
           $less_saving     += $new_savings;
           $plus_additional += $additional_price;
        }
        $result1_=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" and qoute_type = "0" ORDER BY id',[$id]);
        $ref1_ = '';
        $part_id1_     = '';
        $oper1_        = '';
        $description1_ = '';
        $percent1_     = 0;
        $quantity1_    = 0;
        $part1_        = 0;
        $part_sales1_  = 0;
        $markup1_      = 0;
        $betterment1_  = 0;
        $disc_val1_    = 0;
        
        $savings1_     =0;
        $actual_price1_=0;
        $new_savings1_ =0;
        
        $betterment_total1_  = 0;
        $part_total1_        = 0;
        $actual_price_total1_= 0;
        $less_saving1_ = 0;
        $plus_additional1_ = 0;
        $additional_price1_ = 0;
        $resq=DB::select('select ((`Part`*(1+(MarkUp/100)))*(Betterment/100))as prt, ((`Paint`*(1+(MarkUp/100)))*(Betterment/100))as pnt,
        ((`Outwork`*(1+(MarkUp/100)))*(Betterment/100))as utw,
        ((`Inhouse`*(1+(MarkUp/100)))*(Betterment/100))as inh,
        ((`RandR`)*(Betterment/100))as rr,
        (`Labour`*(Betterment/100))as lbr,
        (`Frame`*(Betterment/100))as frm, Frame,Labour,RandR,Paint
        from additional where Key_Ref =?',[$id]);

        $t = 0;
        $t2 = 0;
        $adbt = 0;
        foreach($resq as $row){
            $t += $row->Paint;
            $t2 +=$row->Frame+$row->RandR+$row->Labour;
            $adbt+=(($row->prt)+($row->pnt)+($row->utw)+($row->inh)+($row->rr)+($row->lbr)+($row->frm));
        }

        foreach($result1_ as $row1){
            $ref1_ = $row1->Key_Ref;
            $part_id1_     = $row1->id;
            $oper1_        = $row1->Oper;
            $description1_ = $row1->Description;
            $percent1_     = ($row1->Part*$row1->Percent/100);
            $quantity1_    = $row1->Quantity;
            $part1_        = ($row1->Part+$percent1);
            $part_sales1_  = $row1->Parts_sales;
            $markup1_      = $row1->MarkUp;
            $betterment1_  = $row1->Betterment;
            $disc_val1_    = $row1->Discount;
        
            $savings1_     =($part_sales1 * $markup1/100);
            $actual_price1_=($part_sales1 + $savings1);
            $new_savings1_ =($part1 - $actual_price1);
        
            $betterment_total1_  = ($betterment_total1 + $actual_price1 * $betterment1 / 100);
            $part_total1_        = ($part_total1 + $part1);
            $actual_price_total1_= ($actual_price_total1 + $actual_price1_);
        
            if($part_sales1<=0){
                $new_savings1_=$part1_;	
            }
        
            if($new_savings1_<0){
                $new_savings1_ = 0;	
                $additional_price1_ = ($actual_price1_ - $part1_);	
            }else{
                $additional_price1_ = 0;	
            }
           $less_saving1_     += $new_savings1_;
           $plus_additional1_ += $additional_price1_;
        }
        $ttl = $actual_price_total+$actual_price_total1;
        $ttl1 = $qtedttl+$qtedttl2+$qtedttl3;
        $result_1=DB::select("select Key_Ref,sundries1,sundries2,paintShop1,paintShop2,Betterment,Excess_1,Excess_2 FROM betterment WHERE Key_Ref=?",[$id]);
        $sundries1 = 0;
        $sundries2 = 0;
        $Betterment = 0;
        $Excess= 0;
        $Excess2 = 0;
        $idd='';
        $paintSh1 = 0;
        $paintSh2 = 0;
        foreach($result_1 as $row){
            $sundries1=$row->sundries1;
            $sundries2=$row->sundries2;
            $idd = $row->Key_Ref;
            $Betterment = $row->Betterment;
            $Excess = $row->Excess_1;
            $Excess2 = $row->Excess_2;
            $paintSh1 = $row->paintShop1;
            $paintSh2 = $row->paintShop2;
        }
        //$table_header.
        $final_additionals='';
        $final_additionals='
        <table style="width:100%;font-size:7px;border:none;margin-top:-5px;">
        <tr>
        <td colspan="3" style="width:268px;">&nbsp;</td>
        <td colspan="0" style="color:maroon;width:112px;"><b>Additional Parts</b></td>
        <td colspan="3" style="background-color:white;width:168px;">&nbsp;</td>
        <td style="background-color:white;width:60px;">&nbsp;</td>
        <td colspan="2" style="background-color:white;color:maroon;width:60px;">R<b>'.number_format($ttlAdd_,2).'</b></td>
        </tr>
        </table>
        ';
        $final_additionals.='
        <table style="width:100%;font-size:7px;border:none;">
        <tr>
        <td colspan="3" style="width:268px;">&nbsp;</td>
        <td colspan="0" style="color:black;width:112px;"><b>Sub Total Parts</b></td>
        <td colspan="3" style="background-color:silver;width:168px;">&nbsp;</td>
        <td style="background-color:silver;width:60px;"><b>R'.number_format($ttl1,2).'</b></td>
        <td colspan="2" style="background-color:silver;color:black;width:60px;"><b>R'.number_format(($ttlAdd_+$actlttl+$actlttl2+$actlttl3),2).'</b></td>
        </tr>
        </table>
        ';
        $result2=DB::select('select * FROM additional WHERE Key_Ref=? AND Part>"0"',[$id]);
        $part_id_     = '';
        $oper_        = '';
        $description_ = '';
        $percent_     = 0;
        $quantity_    = 0;
        $part_        = 0;
        $part_sales_  = 0;
        $markup_      = 0;
        $betterment_  = 0;
        $disc_val_    = 0;
        
        $savings_     =0;
        $actual_price_=0;
        $new_savings_ =0;
        
        $betterment_total_  = 0;
        $part_total_        = 0;
        $actual_price_total_= 0;
        $less_saving_ = 0;
        $plus_additional_ = 0;
        $additional_price_ = 0;

        foreach($result2 as $row2){
            $part_id_     = $row2->id;
            $oper_        = $row2->Oper;
            $description_ = $row2->Description;
            $percent_     = ($row2->Part*$row2->Percent/100);
            $quantity_    = $row2->Quantity;
            $part_        = ($row2->Part+$percent);
            $part_sales_  = $row2->Part;
            $markup_      = $row2->MarkUp;
            $betterment_  = $row2->Betterment;
        
            $savings_     =($part_sales_ * $markup/100);
            $actual_price_=($part_sales_ + $savings);
            $new_savings_ =($part_ - $actual_price_);
        
            $betterment_total_  = ($betterment_total_ + $actual_price_ * $betterment_ / 100);
            $part_total_        = ($part_total_ + $part_);
            $actual_price_total= ($actual_price_total + $actual_price);
        
            if($part_sales_<=0){
                $new_savings_=$part_;	
            }
        
            if($new_savings_<0){
                $new_savings_ = 0;	
                $additional_price_ = ($actual_price_ - $part_);	
            }else{
                $additional_price_ = 0;	
            }
           $less_saving_     += $new_savings_;
           $plus_additional_ += $additional_price_;
        }

        $result1_1=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" and qoute_type = "0" ORDER BY id',[$id]);
        $ref1_1 = '';
        $part_id1_1     = '';
        $oper1_1        = '';
        $description1_1 = '';
        $percent1_1     = 0;
        $quantity1_1    = 0;
        $part1_1        = 0;
        $part_sales1_1  = 0;
        $markup1_1      = 0;
        $betterment1_1  = 0;
        
        $savings1_1     =0;
        $actual_price1_1=0;
        $new_savings1_1 =0;
        
        $betterment_total1_1  = 0;
        $part_total1_1        = 0;
        $actual_price_total1_1= 0;
        $less_saving1_1 = 0;
        $plus_additional1_1 = 0;
        $additional_price1_1 = 0;
        foreach($result1_1 as $row1){
            $ref1_1 = $row1->Key_Ref;
            $part_id1_1     = $row1->id;
            $oper1_1        = $row1->Oper;
            $description1_1 = $row1->Description;
            $percent1_1     = ($row1->Part*$row1->Percent/100);
            $quantity1_1    = $row1->Quantity;
            $part1_1        = ($row1->Part+$percent1);
            $part_sales1_1  = $row1->Parts_sales;
            $markup1_1      = $row1->MarkUp;
            $betterment1_1  = $row1->Betterment;
        
            $savings1_1     =($part_sales1_1 * $markup1_1/100);
            $actual_price1_1=($part_sales1_1 + $savings1_1);
            $new_savings1_1 =($part1_1 - $actual_price1_1);
        
            $betterment_total1_1  = ($betterment_total1_1 + $actual_price1_1 * $betterment1_1 / 100);
            $part_total1_1        = ($part_total1_1 + $part1_1);
            $actual_price_total1_1= ($actual_price_total1_1 + $actual_price1_1);
        
            if($part_sales1_1<=0){
                $new_savings1_1=$part1_1;	
            }
        
            if($new_savings1_1<0){
                $new_savings1 = 0;	
                $additional_price1_1 = ($actual_price1_1 - $part1_1);	
            }else{
                $additional_price1_1 = 0;	
            }
           $less_saving1_1     += $new_savings1_1;
           $plus_additional1_1 += $additional_price1_1;
        }
        $ttl_1 = $actual_price_total+$actual_price_total1+$sundries1;
        $ttl1_1 = $part_total1_1+$sundries1;
        $final_additionals.='
        <table border="0" style="width:100%;font-size:7px;margin-top:-3px;">
        <tr>
        <td colspan="3" style="width:268px;">&nbsp;</td>
        <td colspan="0" style="width:112px;"><b>Sundries</b></td>
        <td colspan="3" style="background-color:white:;width:168px;">&nbsp;</td>
        <td style="color:black;width:60px;"><b>R'.number_format($sundries1,2).'</b></td>
        <td colspan="2" style="background-color:white;width:60px;"><b>R'.number_format($sundries2,2).'</b></td>
        </tr>
        </table>
        ';
        $final_additionals.='
        <table style="width:100%;font-size:7px;margin-bottom:5px;">
        <tr>
        <td colspan="3" style="width:268px;">&nbsp;</td>
        <td colspan="0" style="width:112px;"><b>Total Parts</b></td>
        <td colspan="3" style="background-color:silver;width:168px;">&nbsp;</td>
        <td colspan="1" style="background-color:silver;width:60px;"><b>R'.number_format($ttl1+$sundries1,2).'</b></td>
        <td colspan="2" style="background-color:silver;width:60px;"><b>R'.number_format(($ttlAdd_+$actlttl+$actlttl2+$actlttl3)+($sundries2),2).'</b></td>
        </tr>
        </table>
        ';

        $resInhs=DB::select('select id,MarkUp,MarkUp2,Betterment,Description,Key_Ref,Parts_sales,Oper,Part,Misc,round(Misc-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price from qoutes where Key_Ref=? and Misc>0 and qoute_type = "0" order by id limit 8',[$id]);
        $counter=1;
        $counte = $count;
        
        $savTotal = 0;
        $AddTotal = 0;
        $QtTotal=0;
        $actTotal = 0;
        $atct = 0;
        $html_ = "";
        $qted2 = 0;
        $add2 = 0;
        $mark2 = '';

        $resaddInhs=DB::select("select distinct * from additional  where Key_Ref=? and (Inhouse>0 or Inhouse<0) order by id",[$id]);
        $resaddInhs1=DB::select('select distinct * from additional  where Key_Ref=? and (Outwork>0 or Outwork<0) order by id',[$id]);
        $inh = 0;
        $out = 0;
        $inhtt = 0;
        $outtt = 0;
        $ottal=0;
        foreach($resaddInhs as $row){
            if(number_format($row->MarkUp2)==0){
                $inh = $row->Inhouse*(1+($row->MarkUp/100));
            }else{
                $inh = $row->Inhouse*(($row->MarkUp2/100));
            }
            $inhtt += $inh;
        }
        foreach($resaddInhs1 as $row){
            if(number_format($row->MarkUp2)==0){
                $out = $row->Outwork*(1+($row->MarkUp/100));
            }else{
                $out = $row->Outwork*(($row->MarkUp2/100));
            }
            $outtt += $out;
        }
        $resultew=DB::select('select distinct * from additional  where Key_Ref=? and (Outwork>0 or Outwork<0)',[$id]);
        foreach($resultew as $row){
            
            $actup = 0;
            if($row->Checked=='yes'){
                    $chk ="checked";
                }else{
                    $chk ="";
                }
                if(number_format($row->MarkUp2)==0){
                    $actup = $row->Outwork*(1+($row->MarkUp/100));
                }else{
                    $actup = $row->Outwork*(($row->MarkUp2/100));
                }
                $ottal += $actup;
        }
        $adOutwk = $ottal+$inhtt;
        $table_things='';
        $table_things='
        <table style="width:100%;font-size:8px;border-collapse: collapse;border: 1px solid black;">
        <tr style="background-color:black;color:white;border: 1px solid black;">
        <td style="width:20px;border: 1px solid black;">No</td>
        <td style="width:165px;border: 1px solid black;">Inhouse/Outwor</td>
        <td style="width:54px;border: 1px solid black;">Oper</td>
        <td style="width:56px;border: 1px solid black;">Landing Price</td>
        <td style="width:85px;border: 1px solid black;">Mark-Up</td>
        <td style="width:56px;border: 1px solid black;">Betterment</td>
        <td style="width:56px;border: 1px solid black;">Saving</td>
        <td style="width:56px;border: 1px solid black;">Additional</td>
        <td style="width:56px;border: 1px solid black;">Quoted Price</td>
        <td style="width:56px;border: 1px solid black;">Actual Price</td>
        </tr>
        
        ';
        foreach($resInhs as $rowx){
            if($rowx->Parts_sales<=0){
                $status = "<span class='badge' style='background-color:red'>No</span>";
            }else if($rowx->Parts_sales>0){
                $status = "<span class='badge' style='background-color:green'>Yes</span>";
            }if($rowx->sav<0){
                $rowx->sav = '0.00';
                $save2 = 0;
                $add2 = ($rowx->actual_price - $rowx->Misc);
            }else{
                $add2 = '0.00';
                $save2 = $rowx->sav;
            }
    //        if($rowx['Parts_sales']<=0){
    //            $atct=0;
    //        }else{
    //            $atct = $rowx['actual_price'];
    //        }
             $qted2 = $rowx->Misc;
            if(number_format($rowx->MarkUp2)==0){
                $mark2 = 'Nett + '.$rowx->MarkUp.'% Mark Up';
               
                if($rowx->Parts_sales<=0){
                    $atct=0;
                }else{
                    $atct = $rowx->actual_price;
                }
            }else{
                $mark2 = $rowx->MarkUp2.'% Mark Up Only';
                if($rowx->Parts_sales<=0){
                    $atct=0;
                }else{//(Parts_sales+(Parts_sales*(MarkUp/100)))
                    $atct = $rowx->Parts_sales*(($rowx->MarkUp2)/100);
                    if($atct>($row->Misc*$row->Quantity)*(1+($row->Percent/100))){
                        $add2 = ($atct - ($row->Misc*$row->Quantity)*(1+($row->Percent/100)));
                        $save2 = 0;
                    }else{
                        $add2 = 0;
                        $save2 = (($row->Misc*$row->Quantity)*(1+($row->Percent/100))-$atct);
                    }
                }
                //$add2 = 0;
                //$save2 = 0;
            }
            $allin=0;
            $savTotal+=$save2;
            $AddTotal+=$add2;
            $QtTotal+= $qted2;
            $actTotal+=$atct;
            

        $table_things.='
                
                <tr>
                <td style="width:20px;border: 1px solid black;">'.$counter.'</td>
                <td style="width:165px;border: 1px solid black;">'.$rowx->Description.'</td>
                <td style="width:54px;border: 1px solid black;">'.$rowx->Oper.'</td>
                <td style="width:56px;border: 1px solid black;">'.$rowx->Parts_sales.'</td>
                <td style="width:85px;border: 1px solid black;">'.$mark2.'</td>
                <td style="width:56px;border: 1px solid black;">'.$rowx->Betterment.'%</td>
                <td style="width:56px;border: 1px solid black;">R'.number_format($save2,2).'</td>
                <td style="width:56px;border: 1px solid black;">R'.number_format($add2,2).'</td>
                <td style="width:56px;border: 1px solid black;">R'.number_format($qted2,2).'</td>
                <td style="color:black;width:56px;border: 1px solid black;">R'.number_format($atct,2).'</td>
                </tr>
                
                ';
        $counter++;
        }//End Of Foreach
        if($counter<8){
            for($i=$counter;$i<9;$i++){
                $table_things.= '<tr>
                    <td style="width:20px;border: 1px solid black;">'.$i.'</td>
                    <td style="width:165px;border: 1px solid black;"></td>
                    <td style="width:54px;border: 1px solid black;"></td>
                    <td style="width:56px;border: 1px solid black;"></td>
                    <td style="width:85px;border: 1px solid black;"></td>
                    <td style="width:56px;border: 1px solid black;"></td>
                    <td style="width:56px;border: 1px solid black;"></td>
                    <td style="width:56px;border: 1px solid black;"></td>
                    <td style="width:56px;border: 1px solid black;"></td>
                    <td style="color:black;width:56px;border: 1px solid black;"></td>
                </tr>';
            }
        }
        $table_things.='</table>';
        $table_other='';
        

        $table_other.='
        <table style="width:100%;font-size:7px;margin-top:5px;">
        <tr>
        <td style="color:red;text-align:center;transform: skewY(-45deg);width:268px;">&nbsp;</td>
        <td style="width:65px;"><b>Sub Total</b></td>
        <td style="background-color:silver;width:55px;"><b>'.number_format($savTotal,2).'</b></td>
        <td style="background-color:silver;width:55px;"><b>'.number_format($AddTotal,2).'</b></td>
        <td style="background-color:silver;width:65px;"><b>'.number_format($QtTotal,2).'</b></td>
        <td style="background-color:silver;width:60px;"><b>R'.number_format($actTotal,2).'</b></td>
        </tr>
        <tr>
        <td colspan="1" style="width:268px;">&nbsp;</td>
        <td colspan="0" style="width:112px;"><b>Outwork Sav/Add</b></td>
        <td colspan="2" style="background-color:#fff;text-align:right;width:168px;">&nbsp;</td>
        <td colspan="1" style="background-color:#fff;width:65px;"><b>&nbsp;</b></td>
        <td colspan="2" style="background-color:#fff;width:65px;"><b>R'.number_format($adOutwk,2).'</b></td>
        </tr>
        <tr>
        <td colspan="1" style="width:268px;">&nbsp;</td>
        <td colspan="0" style="width:112px;"><b>Outwork Sub Total</b></td>
        <td colspan="2" style="background-color:silver;text-align:right;width:170px;">&nbsp;</td>
        <td colspan="1" style="background-color:silver;width:65px;"><b>'.number_format($QtTotal,2).'</b></td>
        <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($actTotal+$adOutwk,2).'</b></td>
        </tr>
        </table>
        ';

        $results=DB::select('select PaintSup,bt.id,bt.Key_Ref, sum(bt.Labour*ins.labour)as lb,sum(bt.Paint*ins.Paint)as pt,((qt.lb1*ins.labour)+(qt.frm*ins.Frame)+(qt.strp*ins.Strip))as lb1,(qt.pt1*ins.Paint)as pt1  from betterment bt left join
        (select qoutes.Key_Ref,sum(qoutes.Labour)as lb1,sum(qoutes.Paint)as pt1,sum(qoutes.Frame)as frm ,sum(qoutes.Strip)as strp from qoutes where Key_Ref =? and qoute_type = "0")as qt  on bt.Key_Ref = qt.Key_Ref
        left join insurer ins on bt.Key_Ref= ins.Key_Ref where bt.Key_Ref =?',[$id,$id]);
        $resultxx=DB::select('select labour,paint,waste from betterment where Key_Ref =?',[$id]);
        $tr1 = 0;
        $tr2 = 0;
        $tr1_ = 0;
        $tr2_ = 0;
        $plainp = 0;

        foreach($resultxx as $row){
            $tr1_  =  $row->labour;
            $tr2_  = $row->paint;
            if($row->waste!=null && $row->waste!=''){
                $waste = $row->waste;
            } 
        }

        $pconsu = 0;
        $frm = 0;

        foreach($results as $row){
            $plainp = $row->pt1;
            $pconsu = $row->PaintSup;
            if($tr1_==0){
                $tr1 = $row->lb1;
            }else{
                $tr1 = $tr1_;
            }
            if($tr2_==0){
                if($row->pt>0){
                    $tr2 = $row->pt+$paintSh1;
                }else{
                    $tr2 = $row->pt1+$paintSh1;
                }
            }else{
                $tr2 = $tr2_;
            }
        }
        if($paintSh1==0){
            $paintSh1 = $plainp*($pconsu/100);
          }
        if($paintSh2==0){
              $paintSh2 = $t*($pconsu/100);
          }

          $dbquery4=DB::select('select * FROM additional WHERE Key_Ref=? AND Paint>"0"',[$id]);
          $total_additional2  = 0;
          $part2        = 0;
          $part_sales2  = 0;
          $markup2      = 0;
          
          $additional2        = $part_sales2;
          $dbquery4_count=count($dbquery4);
          if($dbquery4_count>0){
              foreach($dbquery4 as $dbrow4 ){
                $part2        = $dbrow4->Part;
                $part_sales2  = $dbrow4->Paint;
                $markup2      = 0;
                
                $additional2        = $part_sales2;
                $total_additional2  = $total_additional2 + $additional2;
              }
          }

          $dbquery3=DB::select('select * FROM additional WHERE Key_Ref=?',[$id]);
          $total_additional1  = 0;
          $part1Z        = '';
          $part_sales1Z  = '';
          $markup1Z      = 0;
          
          $add_sav            = '';
          $additional1        = '';
          $total_additional1Z = 0;

          $dbquery3_count=count($dbquery3);
          if($dbquery3_count>0){
              foreach($dbquery3 as $dbrow3){
                $part1Z        = $dbrow3->Part;
                $part_sales1Z  = $dbrow3->Labour;
                $markup1Z      = $dbrow3->MarkUp;
                
                $add_savZ            = ($part_sales1Z * $markup1Z/100);
                $additional1Z        = $part_sales1Z+$add_savZ;
                $total_additional1Z  = $total_additional1Z +$part_sales1Z;
              }
          }
          
          $table_other.='
          <table style="width:100%;font-size:7px;margin-bottom:-55px;">
          <tr>
          
          <td colspan="3" rowspan="6" style="height:50px;width:268px;"><br>
          <div style="border:2px solid #5e6063;color:white;><br><br><label style="color:black;">MOTOR ACCIDENT GROUP:</label></div>
          </td>
          
          <td colspan="0" style="color:maroon;width:112px;"><b>Additional Labour</b></td>
          <td colspan="3" style="background-color:white;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:white;width:65px;">&nbsp;</td>
          <td colspan="2" style="background-color:white;color:maroon;width:65px;"><b>R'.number_format($t2,2).'</b></td>
          </tr>
          </table>
          ';
          $table_other.='<table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="0" style="width:112px;"><b>Total Labour</b></td>
          <td colspan="3" style="background-color:silver;text-align:right;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($tr1,2).'</b></td>
          <td colspan="2" style="background-color:silver;width:65px;"><b>R'.number_format($tr1+$t2,2).'</b></td>
          </tr>
          </table>';
          $table_other.='<table style="width:100%;font-size:7px;margin-bottom:5px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="0" style="color:maroon;width:112px;"><b>Additional Paint</b></td>
          <td colspan="3" style="background-color:white;text-align:right;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:white;width:65px;">&nbsp;</td>
          <td colspan="2" style="background-color:white;color:maroon;width:65px;"><b>R'.number_format($t,2).'</b></td>
          </tr>
          </table>
          ';
          $table_consumerables='';
          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="0" style="width:112px;"><b>Consumables</b></td>
          <td colspan="3" style="background-color:#fff;text-align:right;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:#fff;width:65px;"><b>R'.number_format($paintSh1,2).'</b></td>
          <td colspan="2" style="background-color:#fff;width:65px;"><b>R'.number_format($paintSh2,2).'</b></td>
          </tr>
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="0" style="width:112px;"><b>Total Paint</b></td>
          <td colspan="3" style="background-color:silver;text-align:right;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($tr2,2).'</b></td>
          <td colspan="2" style="background-color:silver;width:65px;"><b>R'.number_format($tr2+$t+($paintSh2-$paintSh1),2).'</b></td>
          </tr>
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="0" style="width:112px;"><b>Waste Disposal</b></td>
          <td colspan="3" style="text-align:right;width:168px;">&nbsp;</td>
          <td colspan="1" style="width:65px;"><b>R'.number_format($waste,2).'</b></td>
          <td colspan="2" style="width:65px;">&nbsp;</td>
          </tr>
          </table>
          ';

          $ss = 0;
          $fs = 0;
          $ms = 0;

          $resultz=DB::select('select (sum(Labour)+sum(`Part`)+sum(`Paint`)+sum(`Strip`)+sum(`Strip`)+sum(`Frame`)+sum(`Misc`)+sum(`Outwork`)+sum(`Inhouse`))as sm FROM `additional` where Key_Ref =?',[$id]);

          $consu = $tr2*1/100;
          $ttl1z = $tr1+$tr2+($ttl1+$sundries1);
          $addAd = ($plus_additional1);
          $lessSav = $savettl+$savettl2+$savettl3;
          $dicp = number_format($disc_val1,2);
          $dicp2 = number_format($disc_val2,2);
          $dicv1 = (($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste))*($disc_val1/100);
          $dicv2 = ((($ttl1+$sundries1+$QtTotal+$tr1+$tr2)+($ttlAdd_+($addttl+$addttl2+$addttl3)+($sundries2-$sundries1)+$adOutwk+$AddTotal+$t2+$t+($paintSh2-$paintSh1)))-($lessSav+$savTotal))*($disc_val2/100);
          $subt = ($ttl1z+$addAd-$lessSav);
          $newTol = ($subt-$dicv1);
          $ttvat = 0;
          $newTol2=0;
          if($newTol>0){
              $ttvat = ($newTol*0.15);
              $newTol2=($newTol*1.15);
          }else{
              $ttvat = 0;
              $newTol2=($newTol);
          }
          $fTol = ($newTol2-$Excess);

          $resultzn=DB::select('select qt.Key_Ref,sum(qt.Strip*ins.Strip)as ss,sum(qt.Frame*ins.Frame)as fs,sum(Misc)as ms from qoutes qt 
          left join insurer ins on qt.Key_Ref= ins.Key_Ref where qt.Key_Ref =? and qoute_type = "0"',[$id]);

          foreach($resultzn as $row){
            $ss = $row->ss;
            $fs = $row->fs;
            $ms = $row->ms;
          }

          $dbquery=DB::select('select vat from client_details where Key_Ref=? and vat>=1',[$id]);
          $dbquery_count=count($dbquery);

          if($dbquery_count>0){
              foreach($dbquery as $dbrow){
                $vatVal = $dbrow->vat;
                $vat    = $dbrow->vat/100;
              }
          }else{
            $vatVal = 15;
            $vat    = 0.15;
          }
          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:white;color:maroon;width:280px;"><b>Original Amount Of Claim</b></td>
          <td colspan="1" style="background-color:white;color:maroon;width:65px;"><b>R'.number_format(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste),2).'</b></td>
          <td colspan="1" style="background-color:white;color:maroon;width:65px;">&nbsp;</td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" rowspan="6" style="height:50px;width:268px;">
          <div style="border:2px solid #5e6063;color:white;"><br><br><label style="color:black;">SIGNATURE OF ASSESSOR:</label></div><br>
          DATE:<hr style=" height:1px;color:gray;">
          </td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>PLUS Additionals</b></td>
          <td colspan="1" style="background-color:silver;width:65px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format(($ttlAdd_+($addttl+$addttl2+$addttl3)+$adOutwk+$AddTotal+$t2+$t),2).'</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table style="width:100%;font-size:7px;margin-top:-75px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="width:280px;"><b>LESS Saving</b></td>
          <td colspan="1" style="width:65px;">&nbsp;</td>
          <td colspan="1" style="width:65px;"><b>-R'.number_format($lessSav+$savTotal,2).'</b></td>
          </tr>
          </table>
          ';
          $newDiff = ($ttlAdd_+($addttl+$addttl2+$addttl3)+$adOutwk+$AddTotal+$t2+$t - ($lessSav+$savTotal));
          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>SUB Total</b></td>
          <td colspan="1" style="background-color:silver;width:65px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)+($sundries2-$sundries1),2).'</b></td>
          </tr>                                                               
          </table>
          ';

          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="width:280px;"><b>%Trade Discount</b></td>
          <td colspan="1" style="width:65px;"><b>'.$dicp.'%b</></td>
          <td colspan="1" style="width:65px;"><b>'.$dicp2.'%</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>Less Discount<b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b> - R'.number_format($dicv1,2).'</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>- R'.number_format($dicv2,2).'</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="3"style="width:112px;"><b>Betterment to client</b></td>
          <td style="width:168px;"><b>Inv to client (Inc 15% VAT)</b></td>
          <td style="width:65px;">&nbsp;</td>
          <td style="width:65px;">&nbsp;</td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="3" style="background-color:silver;width:112px;"><b>'.number_format($btmnt,2).'</b></td>
          <td style="background-color:silver;width:168px;"><b>'.number_format(($btmnt+$adbt)*1.15,2).'</b></td>
          <td style="background-color:silver;width:65px;"><b> - '.number_format($btmnt_,2).'</b></td>
          <td style="background-color:silver;width:65px;"><b> - '.number_format($btmnt+$adbt,2).'</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;margin-bottom:-5px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="width:280px;"><b>SUB Total</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1,2).'</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2)+($sundries2-$sundries1),2).'</b></td>
          </tr>
          </table>
          ';

          $vat1 = $vat*(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1);
          $vat2 = $vat*((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2+($sundries2-$sundries1));
        
          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>'.$vatVal.'% VAT</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($vat1,2).'</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($vat2,2).'</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" rowspan="5" style="width:268px;font-size:10px;">
          <b>'.$assessor_comp.'</b><br>
          '.$assessor_name.'-'.$assessor_cell.'-EMAIL:'.$assessor_email.'
          </td>
          <td colspan="4" style="width:280px;"><b>SUB Total</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format((($vat1+$ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1),2).'</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(((($vat2+$ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2)+($sundries2-$sundries1),2).'</b></td>
          </tr>
          </table>
          ';


          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>Excess 1</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b> - R'.number_format($Excess,2).'</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b> - R'.number_format($Excess2,2).'</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr >
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="width:280px;color:maroon"><b>Total</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(($vat1+(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1))-$Excess,2).'</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format($vat2+((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2)+($sundries2-$sundries1)-$Excess2,2).'</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>1st Auth</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>Current</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <div style="black;color:gray;font-size:8px;">
          <h5>Terms And Conditions</h5>
          1. Final repair calculations must be signed by the assessor prior to delivery of vehicles as per company T&C repair times.<br>
          2. All costings are to be signed and returned within 48 hours, failure to do so will result in the client being held liable.<br>
          3. Subject to insurance claim vehicles, the owner of the vehicle shall remain liable for the repair, salvage & storage costs until the insurer makes payment on such cost.<br>
          4. Insurance companies with a current signed SLA will not be allowed to audit files not older than 12 months.<br>
          5. Insurance companies without a current signed SLA will not be allowed to conduct audit.<br>
          6. Only qualified auditors with the correct certification will be allowed to audit, provided a current signed SLA is in place with the insurance company requesting the audit.<br>
          7. Insurance assessors are not allowed a 5% settlement without SLA in place<br>
          8. Insurance allowing mark up only on parts is liable to pay the parts provider
          </div>';
          
          $resultxxx_count=count($resultxxx);
          if($resultxxx_count>0){
              $table_header='

              <table border="1" style="width:100%;">
              <tr>
              <td style="width:108px;"><h5>Insurance</h5></td>
              <td style="width:208px;background-color:white;"><h5>'.$val9.'</h5></td>
              <td style="width:108px;"><h5>ASSESSOR</h5></td>
              <td style="width:237px;background-color:white;"><h5>'.$val7.'</h5></td>
              </tr>
              
              <tr>
              <td style="width:108px;"><h5>INSURED</h5></td>
              <td style="width:208px;background-color:white;"><h5>'.$val1." ".$val2.'</h5></td>
              <td style="width:108px;"><h5>Claim No</h5></td>
              <td style="width:237px;background-color:white;"><h5>'.$val8.'</h5></td>
              </tr>
              
              <tr>
              <td style="width:108px;"><h5>REGISTRATION NO</h5></td>
              <td style="width:208px;background-color:white;"><h5>'.$val3." ".$val2.'</h5></td>
              <td style="width:108px;"><h5>REF NO/ASSESSOR REF</h5></td>
              <td style="width:237px;background-color:white;"><h5>'.$id.' / '.$val10.'</h5></td>
              </tr>
              
              <tr>
              <td style="width:108px;"><h5>VEHICLE</h5></td>
              <td style="width:208px;background-color:white;"><h5>'.$val4." ".$val5.'</h5></td>
              <td style="width:108px;"><h5>DATE</h5></td>
              <td style="width:237px;background-color:white;"><h5>'.$val6.'</h5></td>
              </tr>
              </table>
              
              <br><br>
              
              <table style="width:100%;font-size:7px;">
              <tr style="background-color:black;color:white;">
              <td style="width:20px;"><h4>No</h4></td>
              <td style="width:165px;"><h4>Part Description</h4></td>
              <td style="width:54px;"><h4>Oper</h4></td>
              <td style="width:56px;"><h4>Landing Price</h4></td>
              <td style="width:85px;"><h4>Mark-Up</h4></td>
              <td style="width:56px;"><h4>Betterment</h4></td>
              <td style="width:56px;"><h4>Saving</h4></td>
              <td style="width:56px;"><h4>Additional</h4></td>
              <td style="width:56px;"><h4>Quoted Price</h4></td>
              <td style="width:56px;"><h4>Actual Price</h4></td>
              </tr>
              </table>
              ';
              $table_header.='<tr>
              <td colspan="5" style="width:380px;"><h4>Total Parts Page 2</h4></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($betterment_total12,2).'</b></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($less_saving12,2).'</b></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($plus_additional12,2).'</b></td>
              <td style="background-color:silver;width:56px;"><b>R'.number_format($part_total12,2).'</b></td>
              <td colspan="1" style="background-color:silver;width:56px;"><b>R'.number_format($actual_price_total12,2).'</b></td>
              </tr>';
              $table2.='<tr>
              <td colspan="5" style="width:380px;"><h4>Total Parts Page 2</h4></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($betterment_total13,2).'</b></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($less_saving13,2).'</b></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($plus_additional13,2).'</b></td>
              <td style="background-color:silver;width:56px;"><b>R'.number_format($part_total13,2).'</b></td>
              <td colspan="1" style="background-color:silver;width:56px;"><b>R'.number_format($actual_price_total13,2).'</b></td>
              </tr>';


          }

        $pdf=PDF::loadview('pdf.noextra',['tables'=>$table_test,'head'=>$final_head,'pages'=>$final_pages,'additionals'=>$final_additionals,'outwork'=>$table_things,'outwork_totals'=>$table_other,'consumables'=>$table_consumerables]);
        return $pdf->stream('Final-Cost-No-Extra.pdf'); 


    }

    public function final_costing_all_figure($id){
        $result1_aa=DB::select('select Discount,Discount2 from qoutes where  Key_Ref=? and qoute_type = "0"',[$id]);
        $disc_val1 = 0;
        $disc_val2 = 0;
        $waste = 0;
        $table_header='';
        $opt='';
        foreach($result1_aa as $row){
            $disc_val1 = $row->Discount;
            $disc_val2 = $row->Discount2;
        }//end For Each
        
        $dbquery=DB::select('select * FROM client_details WHERE Key_Ref=?',[$id]);
        $tbl1 = "";
        $count=1;
        $part_total_p2zz = 0;
        $actual_price_total_p2zz = 0;
        $plus_additional_p2zz = 0;
        $less_saving_p2zz = 0;
        $betterment_total_p2zz =0;

        foreach($dbquery as $dbrow){
            $val1   = $dbrow->Fisrt_Name;
            $val2   = $dbrow->Last_Name;
            $val3   = $dbrow->Reg_No;
            $val4   = $dbrow->Make;
            $val5   = $dbrow->Model;
            $val6   = $dbrow->Date;	
            $branch = $dbrow->branch;	
        }//End foreach
        $dbquery1=DB::select('select * FROM insurer WHERE Key_Ref=?',[$id]);
        $val7 = '';
        $val8 = '';
        $val9 = '';
        $val10 = '';
        $betterment_total_p2 = 0;
        $less_saving_p2  = 0;
        $plus_additional_p2  = 0;
        $betterment_total_p3  = 0;
        $less_saving_p3  = 0;
        $plus_additional_p3  = 0;
        $part_total_p3  = 0;
        $actual_price_total_p3  = 0;
        $actual_price_total_p2  = 0;
        $part_total_p2  = 0;
        $vat  = 0;

        foreach($dbquery1 as $dbrow1){
            $val7 = $dbrow1->Assessor;
            $val8 = $dbrow1->Claim_NO;
            $val9 = $dbrow1->Inserer;
            $val10= $dbrow1->Assessor_Ref;	
            $vat  = $dbrow1->vat;
        }

        $labour   = 0;
        $paint    = 0;
        $strip    = 0;
        $frame    = 0;
        $outwork  = 0;

        $result=DB::select('select id,Percent,MarkUp,MarkUp2,Betterment,Quantity,Description,Key_Ref,Parts_sales,Part,Oper,Part,round(Part-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price  from qoutes where Key_Ref =? and Part>0 and qoute_type = "0" limit 0,30',[$id]);
        $resultxxx=DB::select('select id,Percent,MarkUp,MarkUp2,Betterment,Quantity,Description,Key_Ref,Parts_sales,Part,Oper,Part,round(Part-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price  from qoutes where Key_Ref =? and Part>0 and qoute_type ="0" limit 30,130',[$id]);
        $resultxxxx=DB::select('select id,Percent,MarkUp,MarkUp2,Betterment,Quantity,Description,Key_Ref,Parts_sales,Part,Oper,Part,round(Part-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price  from qoutes where Key_Ref =? and Part>0 and qoute_type = "0" limit 130,230',[$id]);
        $resulte=DB::select('select * from oper order by oper');

        foreach($resulte as $row){
            $opt.= "<option val='".$row->oper."'>".$row->oper."</option>";
        }//End Of Foreach

        $count = 1;
        $status='';
        $lndT = 0;
        $ptT = 0;
        $savT = 0;
        $actl = 0;
        $btmnt = 0;
        $btmnt_ = 0;
        $actual_priceT = 0;
        $tbl="";
        $tbl2="";
        $tblp2 = "";
        $tblp3 = "";
        $tblp2st= "";
        $actlttl = 0;
        $qtedttl = 0;
        $savettl = 0;
        $addttl = 0;
        $actlttl2 = 0;
        $qtedttl2 = 0;
        $savettl2 = 0;
        $addttl2 = 0;
        $actlttl3 = 0;
        $qtedttl3 = 0;
        $savettl3 = 0;
        $addttl3 = 0;
        $mark = 0;

        foreach($result as $row){
            $add=0;
            $save = 0;
            $qted = ($row->Part*$row->Quantity)*+(1+($row->Percent/100));
            if($row->Parts_sales<=0){
                $status = "<span class='badge' style='background-color:red'>No</span>";
            }else if($row->Parts_sales>0){
                $status = "<span class='badge' style='background-color:green'>Yes</span>";
            }if($row->actual_price>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = 0;	
                $add = ($row->actual_price - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));	
            }else if($row->actual_price<($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$row->actual_price);	
                $add = 0;	
            }
            if(number_format($row->MarkUp2)==0){
                
                $mark = 'Nett + '.$row->MarkUp.'% Mark Up';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{
                    $actl = $row->actual_price;
                }
            }else{
                $mark = $row->MarkUp2.'% Mark Up Only';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{//(Parts_sales+(Parts_sales*(MarkUp/100)))
                    $actl = $row->Parts_sales*(($row->MarkUp2)/100);
                    if($actl>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                        $add = ($actl - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));
                        $save = 0;
                    }else{
                        $add = 0;
                        $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$actl);
                    }
                }
                //$add = 0;
                //$save = 0;
            }
        $actlttl += $actl;
        $qtedttl += $qted;
        $savettl += $save;
        $addttl += $add;
        $btmnt+= $actl*$row->Betterment/100;
        $btmnt_+= ($row->Part*$row->Quantity)*+(1+($row->Percent/100))*$row->Betterment/100;
       $tbl.= '<tr>
                <td style="width:20px;">'.$count.'</td>
                <td style="width:165px">'.$row->Description.'</td>
                <td style="width:54px">'.$row->Oper.'</td>
                <td style="width:56px;">'.number_format($row->Parts_sales,2).'</td>
                <td style="width:85px;">'.$mark.'</td>
                <td style="width:56px;">'.$row->Betterment.'</td>
                <td style="width:56px;">'.number_format($save,2).'</td>
                <td style="width:56px;">'.number_format($add,2).'</td>
                <td style="width:56px;">'.number_format($qted,2).'</td>
                <td style="width:56px;">'.number_format($actl,2).'</td>
            </tr>';
       $count++;
        }//End OF Foreach
        $countp1 = 31;
        foreach($resultxxx as $row){
            $add=0;
            $save = 0;
            $qted = ($row->Part*$row->Quantity)*+(1+($row->Percent/100));
            if($row->Parts_sales<=0){
                $status = "<span class='badge' style='background-color:red'>No</span>";
            }else if($row->Parts_sales>0){
                $status = "<span class='badge' style='background-color:green'>Yes</span>";
            }if($row->actual_price>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = 0;	
                $add = ($row->actual_price - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));	
            }else if($row->actual_price<($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$row->actual_price);	
                $add = 0;	
            }
            if(number_format($row->MarkUp2)==0){
                
                $mark = 'Nett + '.$row->MarkUp.'% Mark Up';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{
                    $actl = $row->actual_price;
                }
            }else{
                $mark = $row->MarkUp2.'% Mark Up Only';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{//(Parts_sales+(Parts_sales*(MarkUp/100)))
                    $actl = $row->Parts_sales*(($row->MarkUp2)/100);
                    if($actl>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                        $add = ($actl - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));
                        $save = 0;
                    }else{
                        $add = 0;
                        $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$actl);
                    }
                }
                //$add = 0;
                //$save = 0;
            }
        $actlttl2 += $actl;
        $qtedttl2 += $qted;
        $savettl2 += $save;
        $addttl2 += $add;
        $btmnt+= $actl*$row->Betterment/100;
        $btmnt_+= ($row->Part*$row->Quantity)*+(1+($row->Percent/100))*$row->Betterment/100;
       $tblp2.= '<tr>
                <td style="width:20px;">'.$count.'</td>
                <td style="width:165px">'.$row->Description.'</td>
                <td style="width:54px">'.$row->Oper.'</td>
                <td style="width:56px;">'.number_format($row->Parts_sales,2).'</td>
                <td style="width:85px;">'.$mark.'</td>
                <td style="width:56px;">'.$row->Betterment.'</td>
                <td style="width:56px;">'.number_format($save,2).'</td>
                <td style="width:56px;">'.number_format($add,2).'</td>
                <td style="width:56px;">'.number_format($qted,2).'</td>
                <td style="width:56px;">'.number_format($actl,2).'</td>
            </tr>';
       $countp1++;
        }
        $countp2 = 131;
        foreach($resultxxxx as $row){
            $add=0;
            $save = 0;
            $qted = ($row->Part*$row->Quantity)*+(1+($row->Percent/100));
            if($row->Parts_sales<=0){
                $status = "<span class='badge' style='background-color:red'>No</span>";
            }else if($row->Parts_sales>0){
                $status = "<span class='badge' style='background-color:green'>Yes</span>";
            }if($row->actual_price>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = 0;	
                $add = ($row->actual_price - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));	
            }else if($row->actual_price<($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$row->actual_price);	
                $add = 0;	
            }
            if(number_format($row->MarkUp2)==0){
                
                $mark = 'Nett + '.$row->MarkUp.'% Mark Up';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{
                    $actl = $row->actual_price;
                }
            }else{
                $mark = $row->MarkUp2.'% Mark Up Only';
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{//(Parts_sales+(Parts_sales*(MarkUp/100)))
                    $actl = $row->Parts_sales*(($row->MarkUp2)/100);
                    if($actl>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                        $add = ($actl - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));
                        $save = 0;
                    }else{
                        $add = 0;
                        $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$actl);
                    }
                }
                //$add = 0;
                //$save = 0;
            }
        $actlttl3 += $actl;
        $qtedttl3 += $qted;
        $savettl3 += $save;
        $addttl3 += $add;
        $btmnt+= $actl*$row->Betterment/100;
        $btmnt_+= ($row->Part*$row->Quantity)*+(1+($row->Percent/100))*$row->Betterment/100;
       $tblp3.= '<tr>
                <td style="width:20px;">'.$count.'</td>
                <td style="width:165px">'.$row->Description.'</td>
                <td style="width:54px">'.$row->Oper.'</td>
                <td style="width:56px;">'.number_format($row->Parts_sales,2).'</td>
                <td style="width:85px;">'.$mark.'</td>
                <td style="width:56px;">'.$row->Betterment.'</td>
                <td style="width:56px;">'.number_format($save,2).'</td>
                <td style="width:56px;">'.number_format($add,2).'</td>
                <td style="width:56px;">'.number_format($qted,2).'</td>
                <td style="width:56px;">'.number_format($actl,2).'</td>
            </tr>';
       $countp2++;
        }
        if($count<30){
            for($i=$count;$i<31;$i++){
                $tbl.= "<tr>
                    <td>".$i."</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>";
            }
        }
        $result5=DB::select('select * FROM assessors where Names=? ORDER BY `id` DESC LIMIT 0,1',[$val7]);
        $assessor_name = "";
        $assessor_cell = "";
        $assessor_email= "";
        $assessor_comp = "";
        $result5_count=count($result5);
        if($result5_count>0){
            foreach($result5 as $row5){
                $assessor_name = $row5->Names;
                $assessor_cell = $row5->Cell;
                $assessor_email= $row5->Email;
                $assessor_comp = $row5->Company;
            }
        }else{
            $assessor_name = "";
            $assessor_cell = "";
            $assessor_email= "";
            $assessor_comp = "";
        }
        $final_head='';
        //$table_header.='
        $final_head='
        <table  style="width:100%;font-size:7px;border-collapse: collapse;border: 1px solid black;">
        <tr>
        <td style="width:108px;height:12px;border: 1px solid black;">INSURANCE</td>
        <td style="width:208px;border: 1px solid black;">'.$val9.'</td>
        <td style="width:108px;border: 1px solid black;">ASSESSOR</td>
        <td style="width:238px;background-color:white;border: 1px solid black;">'.$val7.'</td>
        </tr>
        
        <tr>
        <td style="width:108px;border: 1px solid black;">INSURED</td>
        <td style="width:208px;background-color:white;border: 1px solid black;">'.$val1." ".$val2.'</td>
        <td style="width:108px;border: 1px solid black;">Claim No</td>
        <td style="width:238px;background-color:white;border: 1px solid black;">'.$val8.'</td>
        </tr>
        
        <tr>
        <td style="width:108px;border: 1px solid black;">REGISTRATION NO</td>
        <td style="width:208px;background-color:white;border: 1px solid black;">'.$val3." ".$val2.'</td>
        <td style="width:108px;border: 1px solid black;">REF NO/ASSESSOR REF</td>
        <td style="width:238px;background-color:white;border: 1px solid black;">'.$id.' / '.$val10.'</td>
        </tr>
        
        <tr>
        <td style="width:108px;border: 1px solid black;">VEHICLE</td>
        <td style="width:208px;background-color:white;border: 1px solid black;">'.$val4." ".$val5.'</td>
        <td style="width:108px;border: 1px solid black;">DATE</td>
        <td style="width:238px;background-color:white;border: 1px solid black;">'.$val6.'</td>
        </tr>
        </table>
        
        
        <table style="width:100%;font-size:10px;margin-top:5px;border-collapse: collapse;border: 1px solid black;">
        <tr style="background-color:black;color:white;">
        <td style="width:20px;border: 1px solid black;"><b>No</b></td>
        <td style="width:165px;border: 1px solid black;">Part Description</td>
        <td style="width:54px;border: 1px solid black;">Oper</td>
        <td style="width:56px;border: 1px solid black;">Landing Price</td>
        <td style="width:85px;border: 1px solid black;">Mark-Up</td>
        <td style="width:56px;border: 1px solid black;">Betterment</td>
        <td style="width:56px;border: 1px solid black;">Saving</td>
        <td style="width:56px;border: 1px solid black;">Additional</td>
        <td style="width:56px;border: 1px solid black;">Quoted Price</td>
        <td style="width:56px;border: 1px solid black;">Actual Price</td>
        </tr>
        </table>
        ';
        $table_test='';
        $ttlAdd = 0;
        $ttlAdd_ = 0;
        $result_x =DB::select('select * FROM additional WHERE Key_Ref=? AND Part>"0"',[$id]);
        foreach($result_x as $row){
            if(number_format($row->MarkUp2)==0){
                $ttlAdd_ += $row->Quantity*$row->Part*(1+($row->MarkUp/100));
            }else{
                $ttlAdd_ += $row->Quantity*$row->Part*(($row->MarkUp2/100));
            }
        }
        $table_test.='

        <table border="1" style="width:100%;height:%;font-size:8px;margin-bottom:5px;border-collapse: collapse;border: 1px solid black;">'.$tbl.'</table>
        ';
        $result1=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" ORDER BY id limit 0,30',[$id]); 
        $result12=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" and qoute_type = "0" ORDER BY id limit 30,130',[$id]);        
        $result13=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" and qoute_type = "0" ORDER BY id limit 130,230',[$id]);
        $result1x=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" and qoute_type = "0" ORDER BY id',[$id]);
        $ref1 = '';
        $part_id1     = '';
        $oper1        = '';
        $description1 = '';
        
        
        $betterment_total1x  = 0;
        $betterment_total1  = 0;
        $betterment_total12  = 0;
        $betterment_total13  = 0;
        $part_total1x        = 0;
        $part_total1        = 0;
        $part_total12        = 0;
        $part_total13        = 0;
        $actual_price_total1= 0;
        $actual_price_total1x= 0;
        $actual_price_total12= 0;
        $actual_price_total13= 0;
        $less_saving1x = 0;
        $less_saving1 = 0;
        $less_saving12 = 0;
        $less_saving13 = 0;
        $plus_additional1 = 0;
        $plus_additional1x = 0;
        $plus_additional12 = 0;
        $plus_additional13 = 0;
        $additional_price1 = 0;

        foreach($result1x as $row1){
            $percent1     = ($row1->Part*$row1->Percent/100);
            $quantity1    = $row1->Quantity;
            $part1        = ($row1->Part*$row1->Quantity)*(1+($row1->Percent/100));
            $part_sales1  = $row1->Parts_sales;
            $markup1      = $row1->MarkUp;
            $betterment1  = $row1->Betterment;
            
        
            $savings1     =($part_sales1 * $markup1/100);
            $actual_price1=($part_sales1 + $savings1);
            $new_savings1 =($part1 - $actual_price1);
        
            $betterment_total1  = ($betterment_total1 + $actual_price1 * $betterment1 / 100);
            $part_total1        = ($part_total1 + $part1);
            $actual_price_total1= ($actual_price_total1 + $actual_price1);
        
            if($part_sales1<=0){
                $new_savings1=$part1;	
            }
        
            if($new_savings1<0){
                $new_savings1 = 0;	
                $additional_price1 = ($actual_price1 - $part1);	
            }else{
                $additional_price1 = 0;	
            }
           $less_saving1     += $new_savings1;
           //$plus_additional1 += $additional_price1;
        }
        foreach($result1 as $row1){
            $percent1     = ($row1->Part*$row1->Percent/100);
            $quantity1    = $row1->Quantity;
            $part1        = ($row1->Part*$row1->Quantity)*(1+($row1->Percent/100));
            $part_sales1  = $row1->Parts_sales;
            $markup1      = $row1->MarkUp;
            $betterment1  = $row1->Betterment;
            
            $savings1     =($part_sales1 * $markup1/100);
            $actual_price1=($part_sales1 + $savings1);
            $new_savings1 =($part1 - $actual_price1);
        
            $betterment_total1x  = ($betterment_total1 + $actual_price1 * $betterment1 / 100);
            $part_total1x        = ($part_total1x + $part1);
            $actual_price_total1x= ($actual_price_total1x + $actual_price1);
        
            if($part_sales1<=0){
                $new_savings1=$part1;	
            }
        
            if($new_savings1<0){
                $new_savings1 = 0;	
                $additional_price1 = ($actual_price1 - $part1);	
            }else{
                $additional_price1 = 0;	
            }
           $less_saving1x     += $new_savings1;
           $plus_additional1x += $additional_price1;
        }
        foreach($result12 as $row1){
            $percent1     = ($row1->Part*$row1->Percent/100);
            $quantity1    = $row1->Quantity;
            $part1        = ($row1->Part*$row1->Quantity)*(1+($row1->Percent/100));
            $part_sales1  = $row1->Parts_sales;
            $markup1      = $row1->MarkUp;
            $betterment1  = $row1->Betterment;
            
            $savings1     =($part_sales1 * $markup1/100);
            $actual_price1=($part_sales1 + $savings1);
            $new_savings1 =($part1 - $actual_price1);
        
            $betterment_total12  = ($betterment_total1 + $actual_price1 * $betterment1 / 100);
            $part_total12        = ($part_total12 + $part1);
            $actual_price_total12= ($actual_price_total12 + $actual_price1);
        
            if($part_sales1<=0){
                $new_savings1=$part1;	
            }
        
            if($new_savings1<0){
                $new_savings1 = 0;	
                $additional_price1 = ($actual_price1 - $part1);	
            }else{
                $additional_price1 = 0;	
            }
           $less_saving12     += $new_savings1;
           $plus_additional12 += $additional_price1;
        }

        foreach($result13 as $row1){
            $percent1     = ($row1->Part*$row1->Percent/100);
            $quantity1    = $row1->Quantity;
            $part1        = ($row1->Part*$row1->Quantity)*(1+($row1->Percent/100));
            $part_sales1  = $row1->Parts_sales;
            $markup1      = $row1->MarkUp;
            $betterment1  = $row1->Betterment;
            
            $savings1     =($part_sales1 * $markup1/100);
            $actual_price1=($part_sales1 + $savings1);
            $new_savings1 =($part1 - $actual_price1);
        
            $betterment_total12  = ($betterment_total1 + $actual_price1 * $betterment1 / 100);
            $part_total12        = ($part_total12 + $part1);
            $actual_price_total12= ($actual_price_total12 + $actual_price1);
        
            if($part_sales1<=0){
                $new_savings1=$part1;	
            }
        
            if($new_savings1<0){
                $new_savings1 = 0;	
                $additional_price1 = ($actual_price1 - $part1);	
            }else{
                $additional_price1 = 0;	
            }
           $less_saving12     += $new_savings1;
           $plus_additional12 += $additional_price1; 
        }
        $final_pages='';
        //$table_header.=''
        $final_pages='
        <table style="width:100%;font-size:7px;border:none;margin-bottom:5px;">
        <tr>
        <td colspan="3" style="width:268px;">&nbsp;</td>
        <td colspan="2" style="width:112px;"><b>Total Parts Page 1</b></td>
        <td colspan="0" style="background-color:silver;width:50px;"><b>R'.number_format($betterment_total1x,2).'</b></td>
        <td colspan="0" style="background-color:silver;width:60px;"><b>R'.number_format($savettl,2).'</b></td>
        <td colspan="0" style="background-color:silver;width:60px;"><b>R'.number_format($addttl,2).'</b></td>
        <td style="background-color:silver;width:60px;"><b>R'.number_format($qtedttl,2).'</b></td>
        <td colspan="1" style="background-color:silver;width:60px;"><b>R'.number_format($actlttl,2).'</b></td>
        </tr>
        <tr>
        <td colspan="3" style="width:268px;"></td>
        <td colspan="2" style="width:112px;"><b>Total Parts Page 2</b></td>
        <td colspan="0" style="background-color:#fff;width:50px;"><b>R'.number_format($betterment_total12,2).'</b></td>
        <td colspan="0" style="background-color:#fff;width:60px;"><b>R'.number_format($savettl2,2).'</b></td>
        <td colspan="0" style="background-color:#fff;width:60px;"><b>R'.number_format($addttl2,2).'</b></td>
        <td style="background-color:#fff;width:60px;"><b>R'.number_format($qtedttl2,2).'</b></td>
        <td colspan="1" style="background-color:#fff;width:60px;"><b>R'.number_format($actlttl2,2).'</b></td>
        </tr>
        <tr>
        <td colspan="3" style="width:268px;"></td>
        <td colspan="2" style="width:112px;"><b>Total Parts Page 3</b></td>
        <td colspan="0" style="background-color:silver;width:50px;"><b>R'.number_format($betterment_total13,2).'</b></td>
        <td colspan="0" style="background-color:silver;width:60px;"><b>R'.number_format($savettl3,2).'</b></td>
        <td colspan="0" style="background-color:silver;width:60px;"><b>R'.number_format($addttl3,2).'</b></td>
        <td style="background-color:silver;width:60px;"><b>R'.number_format($qtedttl3,2).'</b></td>
        <td colspan="1" style="background-color:silver;width:60px;"><b>R'.number_format($actlttl3,2).'</b></td>
        </tr>
        </table>
        ';

        $result_=DB::select('select * FROM additional WHERE Key_Ref=? AND Part>"0"',[$id]);

        $part_id     = '';
        $oper        = '';
        $description = '';
        $percent     = 0;
        $quantity    = 0;
        $part        = 0;
        $part_sales  = 0;
        $markup      = 0;
        $betterment  = 0;
        $disc_val    = 0;
        
        $savings     =0;
        $actual_price=0;
        $new_savings =0;
        
        $betterment_total  = 0;
        $part_total        = 0;
        $actual_price_total= 0;
        $less_saving = 0;
        $plus_additional = 0;
        $additional_price = 0;

        foreach($result_ as $row){
            $part_id     = $row->id;
            $oper        = $row->Oper;
            $description = $row->Description;
            $percent     = ($row->Part*$row->Percent/100);
            $quantity    = $row->Quantity;
            $part        = ($row->Part+$percent);
            $part_sales  = $row->Part;
            $markup      = $row->MarkUp;
            $betterment  = $row->Betterment;
        
            $savings     =($part_sales * $markup/100);
            $actual_price=($part_sales + $savings);
            $new_savings =($part - $actual_price);
        
            $betterment_total  = ($betterment_total + $actual_price * $betterment / 100);
            $part_total        = ($part_total + $part);
            $actual_price_total= ($actual_price_total + $actual_price);
        
            if($part_sales<=0){
                $new_savings=$part;	
            }
        
            if($new_savings<0){
                $new_savings = 0;	
                $additional_price = ($actual_price - $part);	
            }else{
                $additional_price = 0;	
            }
           $less_saving     += $new_savings;
           $plus_additional += $additional_price;
        }
        $result1_=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" and qoute_type = "0" ORDER BY id',[$id]);
        $ref1_ = '';
        $part_id1_     = '';
        $oper1_        = '';
        $description1_ = '';
        $percent1_     = 0;
        $quantity1_    = 0;
        $part1_        = 0;
        $part_sales1_  = 0;
        $markup1_      = 0;
        $betterment1_  = 0;
        $disc_val1_    = 0;
        
        $savings1_     =0;
        $actual_price1_=0;
        $new_savings1_ =0;
        
        $betterment_total1_  = 0;
        $part_total1_        = 0;
        $actual_price_total1_= 0;
        $less_saving1_ = 0;
        $plus_additional1_ = 0;
        $additional_price1_ = 0;
        $resq=DB::select('select ((`Part`*(1+(MarkUp/100)))*(Betterment/100))as prt, ((`Paint`*(1+(MarkUp/100)))*(Betterment/100))as pnt,
        ((`Outwork`*(1+(MarkUp/100)))*(Betterment/100))as utw,
        ((`Inhouse`*(1+(MarkUp/100)))*(Betterment/100))as inh,
        ((`RandR`)*(Betterment/100))as rr,
        (`Labour`*(Betterment/100))as lbr,
        (`Frame`*(Betterment/100))as frm, Frame,Labour,RandR,Paint
        from additional where Key_Ref =?',[$id]);

        $t = 0;
        $t2 = 0;
        $adbt = 0;
        foreach($resq as $row){
            $t += $row->Paint;
            $t2 +=$row->Frame+$row->RandR+$row->Labour;
            $adbt+=(($row->prt)+($row->pnt)+($row->utw)+($row->inh)+($row->rr)+($row->lbr)+($row->frm));
        }

        foreach($result1_ as $row1){
            $ref1_ = $row1->Key_Ref;
            $part_id1_     = $row1->id;
            $oper1_        = $row1->Oper;
            $description1_ = $row1->Description;
            $percent1_     = ($row1->Part*$row1->Percent/100);
            $quantity1_    = $row1->Quantity;
            $part1_        = ($row1->Part+$percent1);
            $part_sales1_  = $row1->Parts_sales;
            $markup1_      = $row1->MarkUp;
            $betterment1_  = $row1->Betterment;
            $disc_val1_    = $row1->Discount;
        
            $savings1_     =($part_sales1 * $markup1/100);
            $actual_price1_=($part_sales1 + $savings1);
            $new_savings1_ =($part1 - $actual_price1);
        
            $betterment_total1_  = ($betterment_total1 + $actual_price1 * $betterment1 / 100);
            $part_total1_        = ($part_total1 + $part1);
            $actual_price_total1_= ($actual_price_total1 + $actual_price1_);
        
            if($part_sales1<=0){
                $new_savings1_=$part1_;	
            }
        
            if($new_savings1_<0){
                $new_savings1_ = 0;	
                $additional_price1_ = ($actual_price1_ - $part1_);	
            }else{
                $additional_price1_ = 0;	
            }
           $less_saving1_     += $new_savings1_;
           $plus_additional1_ += $additional_price1_;
        }
        $ttl = $actual_price_total+$actual_price_total1;
        $ttl1 = $qtedttl+$qtedttl2+$qtedttl3;
        $result_1=DB::select("select Key_Ref,sundries1,sundries2,paintShop1,paintShop2,Betterment,Excess_1,Excess_2 FROM betterment WHERE Key_Ref=?",[$id]);
        $sundries1 = 0;
        $sundries2 = 0;
        $Betterment = 0;
        $Excess= 0;
        $Excess2 = 0;
        $idd='';
        $paintSh1 = 0;
        $paintSh2 = 0;
        foreach($result_1 as $row){
            $sundries1=$row->sundries1;
            $sundries2=$row->sundries2;
            $idd = $row->Key_Ref;
            $Betterment = $row->Betterment;
            $Excess = $row->Excess_1;
            $Excess2 = $row->Excess_2;
            $paintSh1 = $row->paintShop1;
            $paintSh2 = $row->paintShop2;
        }
        //$table_header.
        $final_additionals='';
        $final_additionals='
        <table style="width:100%;font-size:7px;border:none;margin-top:-5px;">
        <tr>
        <td colspan="3" style="width:268px;">&nbsp;</td>
        <td colspan="0" style="color:maroon;width:112px;"><b>Additional Parts</b></td>
        <td colspan="3" style="background-color:white;width:168px;">&nbsp;</td>
        <td style="background-color:white;width:60px;">&nbsp;</td>
        <td colspan="2" style="background-color:white;color:maroon;width:60px;">R<b>'.number_format($ttlAdd_,2).'</b></td>
        </tr>
        </table>
        ';
        $final_additionals.='
        <table style="width:100%;font-size:7px;border:none;">
        <tr>
        <td colspan="3" style="width:268px;">&nbsp;</td>
        <td colspan="0" style="color:black;width:112px;"><b>Sub Total Parts</b></td>
        <td colspan="3" style="background-color:silver;width:168px;">&nbsp;</td>
        <td style="background-color:silver;width:60px;"><b>R'.number_format($ttl1,2).'</b></td>
        <td colspan="2" style="background-color:silver;color:black;width:60px;"><b>R'.number_format(($ttlAdd_+$actlttl+$actlttl2+$actlttl3),2).'</b></td>
        </tr>
        </table>
        ';
        $result2=DB::select('select * FROM additional WHERE Key_Ref=? AND Part>"0"',[$id]);
        $part_id_     = '';
        $oper_        = '';
        $description_ = '';
        $percent_     = 0;
        $quantity_    = 0;
        $part_        = 0;
        $part_sales_  = 0;
        $markup_      = 0;
        $betterment_  = 0;
        $disc_val_    = 0;
        
        $savings_     =0;
        $actual_price_=0;
        $new_savings_ =0;
        
        $betterment_total_  = 0;
        $part_total_        = 0;
        $actual_price_total_= 0;
        $less_saving_ = 0;
        $plus_additional_ = 0;
        $additional_price_ = 0;

        foreach($result2 as $row2){
            $part_id_     = $row2->id;
            $oper_        = $row2->Oper;
            $description_ = $row2->Description;
            $percent_     = ($row2->Part*$row2->Percent/100);
            $quantity_    = $row2->Quantity;
            $part_        = ($row2->Part+$percent);
            $part_sales_  = $row2->Part;
            $markup_      = $row2->MarkUp;
            $betterment_  = $row2->Betterment;
        
            $savings_     =($part_sales_ * $markup/100);
            $actual_price_=($part_sales_ + $savings);
            $new_savings_ =($part_ - $actual_price_);
        
            $betterment_total_  = ($betterment_total_ + $actual_price_ * $betterment_ / 100);
            $part_total_        = ($part_total_ + $part_);
            $actual_price_total= ($actual_price_total + $actual_price);
        
            if($part_sales_<=0){
                $new_savings_=$part_;	
            }
        
            if($new_savings_<0){
                $new_savings_ = 0;	
                $additional_price_ = ($actual_price_ - $part_);	
            }else{
                $additional_price_ = 0;	
            }
           $less_saving_     += $new_savings_;
           $plus_additional_ += $additional_price_;
        }

        $result1_1=DB::select('select * FROM qoutes WHERE Key_Ref=? AND Part>"0" and qoute_type = "0" ORDER BY id',[$id]);
        $ref1_1 = '';
        $part_id1_1     = '';
        $oper1_1        = '';
        $description1_1 = '';
        $percent1_1     = 0;
        $quantity1_1    = 0;
        $part1_1        = 0;
        $part_sales1_1  = 0;
        $markup1_1      = 0;
        $betterment1_1  = 0;
        
        $savings1_1     =0;
        $actual_price1_1=0;
        $new_savings1_1 =0;
        
        $betterment_total1_1  = 0;
        $part_total1_1        = 0;
        $actual_price_total1_1= 0;
        $less_saving1_1 = 0;
        $plus_additional1_1 = 0;
        $additional_price1_1 = 0;
        foreach($result1_1 as $row1){
            $ref1_1 = $row1->Key_Ref;
            $part_id1_1     = $row1->id;
            $oper1_1        = $row1->Oper;
            $description1_1 = $row1->Description;
            $percent1_1     = ($row1->Part*$row1->Percent/100);
            $quantity1_1    = $row1->Quantity;
            $part1_1        = ($row1->Part+$percent1);
            $part_sales1_1  = $row1->Parts_sales;
            $markup1_1      = $row1->MarkUp;
            $betterment1_1  = $row1->Betterment;
        
            $savings1_1     =($part_sales1_1 * $markup1_1/100);
            $actual_price1_1=($part_sales1_1 + $savings1_1);
            $new_savings1_1 =($part1_1 - $actual_price1_1);
        
            $betterment_total1_1  = ($betterment_total1_1 + $actual_price1_1 * $betterment1_1 / 100);
            $part_total1_1        = ($part_total1_1 + $part1_1);
            $actual_price_total1_1= ($actual_price_total1_1 + $actual_price1_1);
        
            if($part_sales1_1<=0){
                $new_savings1_1=$part1_1;	
            }
        
            if($new_savings1_1<0){
                $new_savings1 = 0;	
                $additional_price1_1 = ($actual_price1_1 - $part1_1);	
            }else{
                $additional_price1_1 = 0;	
            }
           $less_saving1_1     += $new_savings1_1;
           $plus_additional1_1 += $additional_price1_1;
        }
        $ttl_1 = $actual_price_total+$actual_price_total1+$sundries1;
        $ttl1_1 = $part_total1_1+$sundries1;
        $final_additionals.='
        <table border="0" style="width:100%;font-size:7px;margin-top:-3px;">
        <tr>
        <td colspan="3" style="width:268px;">&nbsp;</td>
        <td colspan="0" style="width:112px;"><b>Sundries</b></td>
        <td colspan="3" style="background-color:white:;width:168px;">&nbsp;</td>
        <td style="color:black;width:60px;"><b>R'.number_format($sundries1,2).'</b></td>
        <td colspan="2" style="background-color:white;width:60px;"><b>R'.number_format($sundries2,2).'</b></td>
        </tr>
        </table>
        ';
        $final_additionals.='
        <table style="width:100%;font-size:7px;margin-bottom:5px;">
        <tr>
        <td colspan="3" style="width:268px;">&nbsp;</td>
        <td colspan="0" style="width:112px;"><b>Total Parts</b></td>
        <td colspan="3" style="background-color:silver;width:168px;">&nbsp;</td>
        <td colspan="1" style="background-color:silver;width:60px;"><b>R'.number_format($ttl1+$sundries1,2).'</b></td>
        <td colspan="2" style="background-color:silver;width:60px;"><b>R'.number_format(($ttlAdd_+$actlttl+$actlttl2+$actlttl3)+($sundries2),2).'</b></td>
        </tr>
        </table>
        ';

        $resInhs=DB::select('select id,MarkUp,MarkUp2,Betterment,Description,Key_Ref,Parts_sales,Oper,Part,Misc,round(Misc-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price from qoutes where Key_Ref=? and Misc>0 and qoute_type = "0" order by id limit 8',[$id]);
        $counter=1;
        $counte = $count;
        
        $savTotal = 0;
        $AddTotal = 0;
        $QtTotal=0;
        $actTotal = 0;
        $atct = 0;
        $html_ = "";
        $qted2 = 0;
        $add2 = 0;
        $mark2 = '';

        $resaddInhs=DB::select("select distinct * from additional  where Key_Ref=? and (Inhouse>0 or Inhouse<0) order by id",[$id]);
        $resaddInhs1=DB::select('select distinct * from additional  where Key_Ref=? and (Outwork>0 or Outwork<0) order by id',[$id]);
        $inh = 0;
        $out = 0;
        $inhtt = 0;
        $outtt = 0;
        $ottal=0;
        foreach($resaddInhs as $row){
            if(number_format($row->MarkUp2)==0){
                $inh = $row->Inhouse*(1+($row->MarkUp/100));
            }else{
                $inh = $row->Inhouse*(($row->MarkUp2/100));
            }
            $inhtt += $inh;
        }
        foreach($resaddInhs1 as $row){
            if(number_format($row->MarkUp2)==0){
                $out = $row->Outwork*(1+($row->MarkUp/100));
            }else{
                $out = $row->Outwork*(($row->MarkUp2/100));
            }
            $outtt += $out;
        }
        $resultew=DB::select('select distinct * from additional  where Key_Ref=? and (Outwork>0 or Outwork<0)',[$id]);
        foreach($resultew as $row){
            
            $actup = 0;
            if($row->Checked=='yes'){
                    $chk ="checked";
                }else{
                    $chk ="";
                }
                if(number_format($row->MarkUp2)==0){
                    $actup = $row->Outwork*(1+($row->MarkUp/100));
                }else{
                    $actup = $row->Outwork*(($row->MarkUp2/100));
                }
                $ottal += $actup;
        }
        $adOutwk = $ottal+$inhtt;
        $table_things='';
        $table_things='
        <table style="width:100%;font-size:8px;border-collapse: collapse;border: 1px solid black;">
        <tr style="background-color:black;color:white;border: 1px solid black;">
        <td style="width:20px;border: 1px solid black;">No</td>
        <td style="width:165px;border: 1px solid black;">Inhouse/Outwor</td>
        <td style="width:54px;border: 1px solid black;">Oper</td>
        <td style="width:56px;border: 1px solid black;">Landing Price</td>
        <td style="width:85px;border: 1px solid black;">Mark-Up</td>
        <td style="width:56px;border: 1px solid black;">Betterment</td>
        <td style="width:56px;border: 1px solid black;">Saving</td>
        <td style="width:56px;border: 1px solid black;">Additional</td>
        <td style="width:56px;border: 1px solid black;">Quoted Price</td>
        <td style="width:56px;border: 1px solid black;">Actual Price</td>
        </tr>
        
        ';
        foreach($resInhs as $rowx){
            if($rowx->Parts_sales<=0){
                $status = "<span class='badge' style='background-color:red'>No</span>";
            }else if($rowx->Parts_sales>0){
                $status = "<span class='badge' style='background-color:green'>Yes</span>";
            }if($rowx->sav<0){
                $rowx->sav = '0.00';
                $save2 = 0;
                $add2 = ($rowx->actual_price - $rowx->Misc);
            }else{
                $add2 = '0.00';
                $save2 = $rowx->sav;
            }
    //        if($rowx['Parts_sales']<=0){
    //            $atct=0;
    //        }else{
    //            $atct = $rowx['actual_price'];
    //        }
             $qted2 = $rowx->Misc;
            if(number_format($rowx->MarkUp2)==0){
                $mark2 = 'Nett + '.$rowx->MarkUp.'% Mark Up';
               
                if($rowx->Parts_sales<=0){
                    $atct=0;
                }else{
                    $atct = $rowx->actual_price;
                }
            }else{
                $mark2 = $rowx->MarkUp2.'% Mark Up Only';
                if($rowx->Parts_sales<=0){
                    $atct=0;
                }else{//(Parts_sales+(Parts_sales*(MarkUp/100)))
                    $atct = $rowx->Parts_sales*(($rowx->MarkUp2)/100);
                    if($atct>($row->Misc*$row->Quantity)*(1+($row->Percent/100))){
                        $add2 = ($atct - ($row->Misc*$row->Quantity)*(1+($row->Percent/100)));
                        $save2 = 0;
                    }else{
                        $add2 = 0;
                        $save2 = (($row->Misc*$row->Quantity)*(1+($row->Percent/100))-$atct);
                    }
                }
                //$add2 = 0;
                //$save2 = 0;
            }
            $allin=0;
            $savTotal+=$save2;
            $AddTotal+=$add2;
            $QtTotal+= $qted2;
            $actTotal+=$atct;
            

        $table_things.='
                
                <tr>
                <td style="width:20px;border: 1px solid black;">'.$counter.'</td>
                <td style="width:165px;border: 1px solid black;">'.$rowx->Description.'</td>
                <td style="width:54px;border: 1px solid black;">'.$rowx->Oper.'</td>
                <td style="width:56px;border: 1px solid black;">'.$rowx->Parts_sales.'</td>
                <td style="width:85px;border: 1px solid black;">'.$mark2.'</td>
                <td style="width:56px;border: 1px solid black;">'.$rowx->Betterment.'%</td>
                <td style="width:56px;border: 1px solid black;">R'.number_format($save2,2).'</td>
                <td style="width:56px;border: 1px solid black;">R'.number_format($add2,2).'</td>
                <td style="width:56px;border: 1px solid black;">R'.number_format($qted2,2).'</td>
                <td style="color:black;width:56px;border: 1px solid black;">R'.number_format($atct,2).'</td>
                </tr>
                
                ';
        $counter++;
        }//End Of Foreach
        if($counter<8){
            for($i=$counter;$i<9;$i++){
                $table_things.= '<tr>
                    <td style="width:20px;border: 1px solid black;">'.$i.'</td>
                    <td style="width:165px;border: 1px solid black;"></td>
                    <td style="width:54px;border: 1px solid black;"></td>
                    <td style="width:56px;border: 1px solid black;"></td>
                    <td style="width:85px;border: 1px solid black;"></td>
                    <td style="width:56px;border: 1px solid black;"></td>
                    <td style="width:56px;border: 1px solid black;"></td>
                    <td style="width:56px;border: 1px solid black;"></td>
                    <td style="width:56px;border: 1px solid black;"></td>
                    <td style="color:black;width:56px;border: 1px solid black;"></td>
                </tr>';
            }
        }
        $table_things.='</table>';
        $table_other='';
        

        $table_other.='
        <table style="width:100%;font-size:7px;margin-top:5px;">
        <tr>
        <td style="color:red;text-align:center;transform: skewY(-45deg);width:268px;">&nbsp;</td>
        <td style="width:65px;"><b>Sub Total</b></td>
        <td style="background-color:silver;width:55px;"><b>'.number_format($savTotal,2).'</b></td>
        <td style="background-color:silver;width:55px;"><b>'.number_format($AddTotal,2).'</b></td>
        <td style="background-color:silver;width:65px;"><b>'.number_format($QtTotal,2).'</b></td>
        <td style="background-color:silver;width:60px;"><b>R'.number_format($actTotal,2).'</b></td>
        </tr>
        <tr>
        <td colspan="1" style="width:268px;">&nbsp;</td>
        <td colspan="0" style="width:112px;"><b>Outwork Sav/Add</b></td>
        <td colspan="2" style="background-color:#fff;text-align:right;width:168px;">&nbsp;</td>
        <td colspan="1" style="background-color:#fff;width:65px;"><b>&nbsp;</b></td>
        <td colspan="2" style="background-color:#fff;width:65px;"><b>R'.number_format($adOutwk,2).'</b></td>
        </tr>
        <tr>
        <td colspan="1" style="width:268px;">&nbsp;</td>
        <td colspan="0" style="width:112px;"><b>Outwork Sub Total</b></td>
        <td colspan="2" style="background-color:silver;text-align:right;width:170px;">&nbsp;</td>
        <td colspan="1" style="background-color:silver;width:65px;"><b>'.number_format($QtTotal,2).'</b></td>
        <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($actTotal+$adOutwk,2).'</b></td>
        </tr>
        </table>
        ';

        $results=DB::select('select PaintSup,bt.id,bt.Key_Ref, sum(bt.Labour*ins.labour)as lb,sum(bt.Paint*ins.Paint)as pt,((qt.lb1*ins.labour)+(qt.frm*ins.Frame)+(qt.strp*ins.Strip))as lb1,(qt.pt1*ins.Paint)as pt1  from betterment bt left join
        (select qoutes.Key_Ref,sum(qoutes.Labour)as lb1,sum(qoutes.Paint)as pt1,sum(qoutes.Frame)as frm ,sum(qoutes.Strip)as strp from qoutes where Key_Ref =? and qoute_type = "0")as qt  on bt.Key_Ref = qt.Key_Ref
        left join insurer ins on bt.Key_Ref= ins.Key_Ref where bt.Key_Ref =?',[$id,$id]);
        $resultxx=DB::select('select labour,paint,waste from betterment where Key_Ref =?',[$id]);
        $tr1 = 0;
        $tr2 = 0;
        $tr1_ = 0;
        $tr2_ = 0;
        $plainp = 0;

        foreach($resultxx as $row){
            $tr1_  =  $row->labour;
            $tr2_  = $row->paint;
            if($row->waste!=null && $row->waste!=''){
                $waste = $row->waste;
            } 
        }

        $pconsu = 0;
        $frm = 0;

        foreach($results as $row){
            $plainp = $row->pt1;
            $pconsu = $row->PaintSup;
            if($tr1_==0){
                $tr1 = $row->lb1;
            }else{
                $tr1 = $tr1_;
            }
            if($tr2_==0){
                if($row->pt>0){
                    $tr2 = $row->pt+$paintSh1;
                }else{
                    $tr2 = $row->pt1+$paintSh1;
                }
            }else{
                $tr2 = $tr2_;
            }
        }
        if($paintSh1==0){
            $paintSh1 = $plainp*($pconsu/100);
          }
        if($paintSh2==0){
              $paintSh2 = $t*($pconsu/100);
          }

          $dbquery4=DB::select('select * FROM additional WHERE Key_Ref=? AND Paint>"0"',[$id]);
          $total_additional2  = 0;
          $part2        = 0;
          $part_sales2  = 0;
          $markup2      = 0;
          
          $additional2        = $part_sales2;
          $dbquery4_count=count($dbquery4);
          if($dbquery4_count>0){
              foreach($dbquery4 as $dbrow4 ){
                $part2        = $dbrow4->Part;
                $part_sales2  = $dbrow4->Paint;
                $markup2      = 0;
                
                $additional2        = $part_sales2;
                $total_additional2  = $total_additional2 + $additional2;
              }
          }

          $dbquery3=DB::select('select * FROM additional WHERE Key_Ref=?',[$id]);
          $total_additional1  = 0;
          $part1Z        = '';
          $part_sales1Z  = '';
          $markup1Z      = 0;
          
          $add_sav            = '';
          $additional1        = '';
          $total_additional1Z = 0;

          $dbquery3_count=count($dbquery3);
          if($dbquery3_count>0){
              foreach($dbquery3 as $dbrow3){
                $part1Z        = $dbrow3->Part;
                $part_sales1Z  = $dbrow3->Labour;
                $markup1Z      = $dbrow3->MarkUp;
                
                $add_savZ            = ($part_sales1Z * $markup1Z/100);
                $additional1Z        = $part_sales1Z+$add_savZ;
                $total_additional1Z  = $total_additional1Z +$part_sales1Z;
              }
          }
          $table_other.='
          <table style="width:100%;font-size:7px;margin-bottom:-55px;">
          <tr>
          
          <td colspan="3" rowspan="6" style="height:50px;width:268px;"><br>
          <div style="border:2px solid #5e6063;color:white;"><br><br><label style="color:black;">MOTOR ACCIDENT GROUP:</label></div>
          </td>
          
          <td colspan="0" style="color:maroon;width:112px;"><b>Additional Labour</b></td>
          <td colspan="3" style="background-color:white;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:white;width:65px;">&nbsp;</td>
          <td colspan="2" style="background-color:white;color:maroon;width:65px;"><b>R'.number_format($t2,2).'</b></td>
          </tr>
          </table>
          ';
          $table_other.='<table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="0" style="width:112px;"><b>Total Labour</b></td>
          <td colspan="3" style="background-color:silver;text-align:right;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($tr1,2).'</b></td>
          <td colspan="2" style="background-color:silver;width:65px;"><b>R'.number_format($tr1+$t2,2).'</b></td>
          </tr>
          </table>';
          $table_other.='<table style="width:100%;font-size:7px;margin-bottom:5px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="0" style="color:maroon;width:112px;"><b>Additional Paint</b></td>
          <td colspan="3" style="background-color:white;text-align:right;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:white;width:65px;">&nbsp;</td>
          <td colspan="2" style="background-color:white;color:maroon;width:65px;"><b>R'.number_format($t,2).'</b></td>
          </tr>
          </table>
          ';
          $table_consumerables='';
          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="0" style="width:112px;"><b>Consumables</b></td>
          <td colspan="3" style="background-color:#fff;text-align:right;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:#fff;width:65px;"><b>R'.number_format($paintSh1,2).'</b></td>
          <td colspan="2" style="background-color:#fff;width:65px;"><b>R'.number_format($paintSh2,2).'</b></td>
          </tr>
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="0" style="width:112px;"><b>Total Paint</b></td>
          <td colspan="3" style="background-color:silver;text-align:right;width:168px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($tr2,2).'</b></td>
          <td colspan="2" style="background-color:silver;width:65px;"><b>R'.number_format($tr2+$t+($paintSh2-$paintSh1),2).'</b></td>
          </tr>
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="0" style="width:112px;"><b>Waste Disposal</b></td>
          <td colspan="3" style="text-align:right;width:168px;">&nbsp;</td>
          <td colspan="1" style="width:65px;"><b>R'.number_format($waste,2).'</b></td>
          <td colspan="2" style="width:65px;">&nbsp;</td>
          </tr>
          </table>
          ';

          $ss = 0;
          $fs = 0;
          $ms = 0;

          $resultz=DB::select('select (sum(Labour)+sum(`Part`)+sum(`Paint`)+sum(`Strip`)+sum(`Strip`)+sum(`Frame`)+sum(`Misc`)+sum(`Outwork`)+sum(`Inhouse`))as sm FROM `additional` where Key_Ref =?',[$id]);

          $consu = $tr2*1/100;
          $ttl1z = $tr1+$tr2+($ttl1+$sundries1);
          $addAd = ($plus_additional1);
          $lessSav = $savettl+$savettl2+$savettl3;
          $dicp = number_format($disc_val1,2);
          $dicp2 = number_format($disc_val2,2);
          $dicv1 = (($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste))*($disc_val1/100);
          $dicv2 = ((($ttl1+$sundries1+$QtTotal+$tr1+$tr2)+($ttlAdd_+($addttl+$addttl2+$addttl3)+($sundries2-$sundries1)+$adOutwk+$AddTotal+$t2+$t+($paintSh2-$paintSh1)))-($lessSav+$savTotal))*($disc_val2/100);
          $subt = ($ttl1z+$addAd-$lessSav);
          $newTol = ($subt-$dicv1);
          $ttvat = 0;
          $newTol2=0;
          if($newTol>0){
              $ttvat = ($newTol*0.15);
              $newTol2=($newTol*1.15);
          }else{
              $ttvat = 0;
              $newTol2=($newTol);
          }
          $fTol = ($newTol2-$Excess);

          $resultzn=DB::select('select qt.Key_Ref,sum(qt.Strip*ins.Strip)as ss,sum(qt.Frame*ins.Frame)as fs,sum(Misc)as ms from qoutes qt 
          left join insurer ins on qt.Key_Ref= ins.Key_Ref where qt.Key_Ref =? and qoute_type = "0"',[$id]);

          foreach($resultzn as $row){
            $ss = $row->ss;
            $fs = $row->fs;
            $ms = $row->ms;
          }

          $dbquery=DB::select('select vat from client_details where Key_Ref=? and vat>=1',[$id]);
          $dbquery_count=count($dbquery);

          if($dbquery_count>0){
              foreach($dbquery as $dbrow){
                $vatVal = $dbrow->vat;
                $vat    = $dbrow->vat/100;
              }
          }else{
            $vatVal = 15;
            $vat    = 0.15;
          }
          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:white;color:maroon;width:280px;"><b>Original Amount Of Claim</b></td>
          <td colspan="1" style="background-color:white;color:maroon;width:65px;"><b>R'.number_format(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste),2).'</b></td>
          <td colspan="1" style="background-color:white;color:maroon;width:65px;">&nbsp;</td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" rowspan="6" style="height:50px;width:268px;">
          <div style="border:2px solid #5e6063;color:white;"><br><br><label style="color:black;">SIGNATURE OF ASSESSOR:</label></div><br>
          DATE:<hr style=" height:1px;color:gray;">
          </td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>PLUS Additionals</b></td>
          <td colspan="1" style="background-color:silver;width:65px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format(($ttlAdd_+($addttl+$addttl2+$addttl3)+$adOutwk+$AddTotal+$t2+$t),2).'</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table style="width:100%;font-size:7px;margin-top:-75px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="width:280px;"><b>LESS Saving</b></td>
          <td colspan="1" style="width:65px;">&nbsp;</td>
          <td colspan="1" style="width:65px;"><b>-R'.number_format($lessSav+$savTotal,2).'</b></td>
          </tr>
          </table>
          ';
          $newDiff = ($ttlAdd_+($addttl+$addttl2+$addttl3)+$adOutwk+$AddTotal+$t2+$t - ($lessSav+$savTotal));
          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>SUB Total</b></td>
          <td colspan="1" style="background-color:silver;width:65px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)+($sundries2-$sundries1),2).'</b></td>
          </tr>                                                               
          </table>
          ';

          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="width:280px;"><b>%Trade Discount</b></td>
          <td colspan="1" style="width:65px;"><b>'.$dicp.'%b</></td>
          <td colspan="1" style="width:65px;"><b>'.$dicp2.'%</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>Less Discount<b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b> - R'.number_format($dicv1,2).'</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>- R'.number_format($dicv2,2).'</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="3"style="width:112px;"><b>Betterment to client</b></td>
          <td style="width:168px;"><b>Inv to client (Inc 15% VAT)</b></td>
          <td style="width:65px;">&nbsp;</td>
          <td style="width:65px;">&nbsp;</td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="3" style="background-color:silver;width:112px;"><b>'.number_format($btmnt,2).'</b></td>
          <td style="background-color:silver;width:168px;"><b>'.number_format(($btmnt+$adbt)*1.15,2).'</b></td>
          <td style="background-color:silver;width:65px;"><b> - '.number_format($btmnt_,2).'</b></td>
          <td style="background-color:silver;width:65px;"><b> - '.number_format($btmnt+$adbt,2).'</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;margin-bottom:-5px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="width:280px;"><b>SUB Total</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1,2).'</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2)+($sundries2-$sundries1),2).'</b></td>
          </tr>
          </table>
          ';

          $vat1 = $vat*(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1);
          $vat2 = $vat*((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2+($sundries2-$sundries1));
        
          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="4" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>'.$vatVal.'% VAT</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($vat1,2).'</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>R'.number_format($vat2,2).'</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" rowspan="5" style="width:268px;font-size:10px;">
          <b>'.$assessor_comp.'</b><br>
          '.$assessor_name.'-'.$assessor_cell.'-EMAIL:'.$assessor_email.'
          </td>
          <td colspan="4" style="width:280px;"><b>SUB Total</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format((($vat1+$ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1),2).'</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(((($vat2+$ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2)+($sundries2-$sundries1),2).'</b></td>
          </tr>
          </table>
          ';


          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;"><b>Excess 1</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b> - R'.number_format($Excess,2).'</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b> - R'.number_format($Excess2,2).'</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr >
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="width:280px;color:maroon"><b>Total</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format(($vat1+(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1))-$Excess,2).'</b></td>
          <td colspan="1" style="width:65px;color:maroon"><b>R'.number_format($vat2+((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$addttl2+$addttl3+$adOutwk+$AddTotal+$t2+$t))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2)+($sundries2-$sundries1)-$Excess2,2).'</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <table border="0" style="width:100%;font-size:7px;">
          <tr>
          <td colspan="3" style="width:268px;">&nbsp;</td>
          <td colspan="4" style="background-color:silver;width:280px;">&nbsp;</td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>1st Auth</b></td>
          <td colspan="1" style="background-color:silver;width:65px;"><b>Current</b></td>
          </tr>
          </table>
          ';

          $table_consumerables.='
          <div style="black;color:gray;font-size:8px;">
          <h5>Terms And Conditions</h5>
          1. Final repair calculations must be signed by the assessor prior to delivery of vehicles as per company T&C repair times.<br>
          2. All costings are to be signed and returned within 48 hours, failure to do so will result in the client being held liable.<br>
          3. Subject to insurance claim vehicles, the owner of the vehicle shall remain liable for the repair, salvage & storage costs until the insurer makes payment on such cost.<br>
          4. Insurance companies with a current signed SLA will not be allowed to audit files not older than 12 months.<br>
          5. Insurance companies without a current signed SLA will not be allowed to conduct audit.<br>
          6. Only qualified auditors with the correct certification will be allowed to audit, provided a current signed SLA is in place with the insurance company requesting the audit.<br>
          7. Insurance assessors are not allowed a 5% settlement without SLA in place<br>
          8. Insurance allowing mark up only on parts is liable to pay the parts provider
          </div>';
          
          $resultxxx_count=count($resultxxx);
          if($resultxxx_count>0){
              $table_header='

              <table border="1" style="width:100%;">
              <tr>
              <td style="width:108px;"><h5>Insurance</h5></td>
              <td style="width:208px;background-color:white;"><h5>'.$val9.'</h5></td>
              <td style="width:108px;"><h5>ASSESSOR</h5></td>
              <td style="width:237px;background-color:white;"><h5>'.$val7.'</h5></td>
              </tr>
              
              <tr>
              <td style="width:108px;"><h5>INSURED</h5></td>
              <td style="width:208px;background-color:white;"><h5>'.$val1." ".$val2.'</h5></td>
              <td style="width:108px;"><h5>Claim No</h5></td>
              <td style="width:237px;background-color:white;"><h5>'.$val8.'</h5></td>
              </tr>
              
              <tr>
              <td style="width:108px;"><h5>REGISTRATION NO</h5></td>
              <td style="width:208px;background-color:white;"><h5>'.$val3." ".$val2.'</h5></td>
              <td style="width:108px;"><h5>REF NO/ASSESSOR REF</h5></td>
              <td style="width:237px;background-color:white;"><h5>'.$id.' / '.$val10.'</h5></td>
              </tr>
              
              <tr>
              <td style="width:108px;"><h5>VEHICLE</h5></td>
              <td style="width:208px;background-color:white;"><h5>'.$val4." ".$val5.'</h5></td>
              <td style="width:108px;"><h5>DATE</h5></td>
              <td style="width:237px;background-color:white;"><h5>'.$val6.'</h5></td>
              </tr>
              </table>
              
              <br><br>
              
              <table style="width:100%;font-size:7px;">
              <tr style="background-color:black;color:white;">
              <td style="width:20px;"><h4>No</h4></td>
              <td style="width:165px;"><h4>Part Description</h4></td>
              <td style="width:54px;"><h4>Oper</h4></td>
              <td style="width:56px;"><h4>Landing Price</h4></td>
              <td style="width:85px;"><h4>Mark-Up</h4></td>
              <td style="width:56px;"><h4>Betterment</h4></td>
              <td style="width:56px;"><h4>Saving</h4></td>
              <td style="width:56px;"><h4>Additional</h4></td>
              <td style="width:56px;"><h4>Quoted Price</h4></td>
              <td style="width:56px;"><h4>Actual Price</h4></td>
              </tr>
              </table>
              ';
              $table_header.='<tr>
              <td colspan="5" style="width:380px;"><h4>Total Parts Page 2</h4></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($betterment_total12,2).'</b></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($less_saving12,2).'</b></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($plus_additional12,2).'</b></td>
              <td style="background-color:silver;width:56px;"><b>R'.number_format($part_total12,2).'</b></td>
              <td colspan="1" style="background-color:silver;width:56px;"><b>R'.number_format($actual_price_total12,2).'</b></td>
              </tr>';
              $table2.='<tr>
              <td colspan="5" style="width:380px;"><h4>Total Parts Page 2</h4></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($betterment_total13,2).'</b></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($less_saving13,2).'</b></td>
              <td colspan="0" style="background-color:silver;width:56px;"><b>R'.number_format($plus_additional13,2).'</b></td>
              <td style="background-color:silver;width:56px;"><b>R'.number_format($part_total13,2).'</b></td>
              <td colspan="1" style="background-color:silver;width:56px;"><b>R'.number_format($actual_price_total13,2).'</b></td>
              </tr>';


          }

        $pdf=PDF::loadview('pdf.allinfigure',['tables'=>$table_test,'head'=>$final_head,'pages'=>$final_pages,'additionals'=>$final_additionals,'outwork'=>$table_things,'outwork_totals'=>$table_other,'consumables'=>$table_consumerables]);
        return $pdf->stream('Final-Cost-All-Figure.pdf'); 


    }

    public function print_timesheet($id){

        $ref =$id;
        $timeSpent = array();
        $timeQted = array();
        $time = array();
        $qted = array();
        $time = array_merge($this->passRate($ref), $timeSpent);
        $qted = array_merge($this->getQuoted($ref),$timeQted);
        //quoted money totals..................
        $laborRate = 0;
        $paintRate = 0;
        $stripRate = 0;
        $frameRate = 0;
        $outwrkTotal = 0;
        $saved = number_format(0,2);
        $lost = number_format(0,2);
        $saved1 = number_format(0,2);
        $lost1 = number_format(0,2);
        $saved2 = number_format(0,2);
        $lost2 = number_format(0,2);
        $saved3 = number_format(0,2);
        $lost3 = number_format(0,2);
        $saved4 = number_format(0,2);
        $lost4 = number_format(0,2);
        $saved5 = number_format(0,2);
        $lost5 = number_format(0,2);
        $saved6 = number_format(0,2);
        $lost6 = number_format(0,2);
        $saved7 = number_format(0,2);
        $lost7 = number_format(0,2);
        $saved8 = number_format(0,2);
        $lost8 = number_format(0,2);
        $saved9 = number_format(0,2);
        $lost9 = number_format(0,2);
        $color = '';
        $color1 = '';
        $color2 = '';
        $color3 = '';
        $color4 = '';
        $color5 = '';
        $color6 = '';
        $color7 = '';
        $color8 = '';
        $color9 = '';
        $color10 = '';
        $color11 = '';
        $color12 = '';
        $color13 = '';
        $color14 = '';
        $color15 = '';
        $color16 = '';
        $color17 = '';
        $color18 = '';
        $color19 = '';
        $color20 = '';
        $color21 = '';
        $tbl = '';
        
        $veh = '';
        $reg = '';

        $reggg =DB::select('select * FROM client_details  WHERE Key_Ref =?',[$id]);

        foreach($reggg as $row){
            $veh = strtoupper($row->Make." ".$row->Model);
            $reg = strtoupper($row->Reg_No);
        }

       $reszz=DB::select('select labour,Paint,Strip,Frame FROM insurer  WHERE Key_Ref =?',[$id]);
       $reszz_count=count($reszz);
       if($reszz_count>0){
        foreach($reszz as $row){
            if($row->labour>0){
                $laborRate = $row->labour;
            } 
            if($row->Paint>0){
                $paintRate = $row->Paint;
            } 
            if($row->Strip>0){
                $stripRate = $row->Strip;
            } 
            if($row->Frame>0){
                $frameRate = $row->Frame;
            }
            }
        }
        if(($qted['strp']*$stripRate)>($time['strp']*$stripRate)){
            $saved = (($qted['strp']*$stripRate)-($time['strp']*$stripRate));
            $color = 'green'; 
            $color1 = '';   
        }elseif(($qted['strp']*$stripRate)<($time['strp']*$stripRate)){
            $lost = (($time['strp']*$stripRate)-($qted['strp']*$stripRate));
            $color1 = 'red';
            $color = '';
        }
        if(($qted['pnt']*$paintRate)>($time['pnt']*$paintRate)){
            $saved1 = (($qted['pnt']*$paintRate)-($time['pnt']*$paintRate));
            $color2 = 'green'; 
            $color3 = '';   
        }elseif(($qted['pnt']*$paintRate)<($time['pnt']*$paintRate)){
            $lost1 = (($time['pnt']*$paintRate)-($qted['pnt']*$paintRate));
            $color3 = 'red';
            $color2 = '';
        }
        if(($qted['pnel']*$laborRate)>($time['pnel']*$laborRate)){
            $saved2 = (($qted['pnel']*$laborRate)-($time['pnel']*$laborRate));
            $color4 = 'green'; 
            $color5 = '';   
        }elseif(($qted['pnel']*$laborRate)<($time['pnel']*$laborRate)){
            $lost2 = (($time['pnel']*$laborRate)-($qted['pnel']*$laborRate));
            $color5 = 'red';
            $color4 = '';
        }
        if(($qted['ass']*$laborRate)>($time['ass']*$laborRate)){
            $saved3 = (($qted['ass']*$laborRate)-($time['ass']*$laborRate));
            $color6 = 'green'; 
            $color7 = '';   
        }elseif(($qted['ass']*$laborRate)<($time['ass']*$laborRate)){
            $lost3 = (($time['ass']*$laborRate)-($qted['ass']*$laborRate));
            $color7 = 'red';
            $color6 = '';
        }
        if(($qted['mech']*$laborRate)>($time['mech']*$laborRate)){
            $saved4 = (($qted['mech']*$laborRate)-($time['mech']*$laborRate));
            $color8 = 'green'; 
            $color9 = '';   
        }elseif(($qted['mech']*$laborRate)<($time['mech']*$laborRate)){
            $lost4 = (($time['mech']*$laborRate)-($qted['mech']*$laborRate));
            $color9 = 'red';
            $color8 = '';
        }
        
        if(($qted['out']*$laborRate)>($time['out']*$laborRate)){
            $saved6 = (($qted['out']*$laborRate)-($time['out']*$laborRate));
            $color12 = 'green'; 
            $color13 = '';   
        }elseif(($qted['out']*$laborRate)<($time['out']*$laborRate)){
            $lost6 = (($time['out']*$laborRate)-($qted['out']*$laborRate));
            $color13 = 'red';
            $color12 = '';
        }
        if(2>($time['pol']*$laborRate)){
            $saved7 = (($this->getPolishTime($ref)*$laborRate)-($time['pol']*$laborRate));
            $color14 = 'green'; 
            $color15 = '';   
        }elseif(($this->getPolishTime($ref)*$laborRate)<($time['pol']*$laborRate)){
            $lost7 = (($time['pol']*$laborRate)-(2*$laborRate));
            $color15 = 'red';
            $color14 = '';
        }
        if((2*$laborRate)>($time['cln']*$laborRate)){
            $saved8 = ((2*$laborRate)-($time['cln']*$laborRate));
            $color16 = 'green'; 
            $color17 = '';   
        }elseif((2*$laborRate)<($time['cln']*$laborRate)){
            $lost8 = (($time['cln']*$laborRate)-(2*$laborRate));
            $color17 = 'red';
            $color16 = '';
        }

        if(($this->getConsumedSundries($ref)+$this->getPaintSupplies($ref)+80)>($this->getSpentSupplies($ref))){
            $saved9 = number_format(($this->getConsumedSundries($ref)+$this->getPaintSupplies($ref)+80)-($this->getSpentSupplies($ref)),2);
            $color18 = 'green'; 
            $color19 = '';   
        }elseif(($this->getConsumedSundries($ref)+$this->getPaintSupplies($ref)+80)<($this->getSpentSupplies($ref))){
            $lost9 = number_format(($this->getSpentSupplies($ref))-($this->getConsumedSundries($ref)+$this->getPaintSupplies($ref)+80),2);
            $color19 = 'red';
            $color18 = '';
        }

                if(((4*$laborRate)+($qted['out']*$laborRate)+($qted['mech']*$laborRate)+($qted['ass']*$laborRate)+($qted['pnel']*$laborRate)+($qted['pnt']*$paintRate)+($qted['strp']*$stripRate))>
        (($time['cln']*$laborRate)+($time['pol']*$laborRate)+($time['out']*$laborRate)+($time['mech']*$laborRate)+($time['ass']*$laborRate)+($time['pnel']*$laborRate)+($time['pnt']*$paintRate)+($time['strp']*$stripRate))){
            
            $color20 = 'green'; 
            $color21 = '';   
        }elseif(((4*$laborRate)+($qted['out']*$laborRate)+($qted['mech']*$laborRate)+($qted['ass']*$laborRate)+($qted['pnel']*$laborRate)+($qted['pnt']*$paintRate)+($qted['strp']*$stripRate))<
        (($time['cln']*$laborRate)+($time['pol']*$laborRate)+($time['out']*$laborRate)+($time['mech']*$laborRate)+($time['ass']*$laborRate)+($time['pnel']*$laborRate)+($time['pnt']*$paintRate)+($time['strp']*$stripRate))){
        
            $color21 = 'red';
            $color20 = '';
        }

        $ttlsaved = number_format($saved+$saved1+$saved2+$saved3+$saved4+$saved5+$saved6+$saved7+$saved8,2);
        $ttllost = number_format($lost+$lost1+$lost2+$lost3+$lost4+$lost5+$lost6+$lost7+$lost8,2);
        $test='';
        //Create Table
        $tbl =  '<table style="font-size:9" width="100%">
        <thead>
            <tr><td colspan="7" style="text-align:center;background-color:#F0F0F0;color:#333;font-size:15;width:570px"><b>'.$ref.' LABOR</b></td></tr>
            <tr>
                <td colspan="4" style="text-align:center;background-color:#F0F0F0;color:#333;font-size:10;"><b>VEHICLE :'.$veh.'</b></td>
                <td colspan="3" style="text-align:center;background-color:#F0F0F0;color:#333;font-size:10;"><b> REGISTRATION :'.$reg.'</b></td>
            </tr>
            <tr><td colspan="7" style="width:570"></td></tr>
            <tr style="border-bottom:1px solid #333">
                <th style="width:100;border-bottom:1px solid #333"><b>LABOR</b></th>
                <th style="width:80;border-bottom:1px solid #333"><b>ALLOWED TIME</b></th>
                <th style="width:80;border-bottom:1px solid #333"><b>SPENT TIME</b></th>
                <th style="width:80;border-bottom:1px solid #333;text-align:right"><b>ALLOWED AMOUNT</b></th>
                <th style="width:80;border-bottom:1px solid #333;text-align:right"><b>SPENT AMOUNT</b></th>
                <th style="width:80;border-bottom:1px solid #333;text-align:right"><b>SAVED AMOUNT</b></th>
                <th style="width:70;border-bottom:1px solid #333;text-align:right"><b>LOST AMOUNT</b></th>
            </tr>
        </thead>';
        $test='<tbody>
            <tr>
                <td style="width:100;border-bottom:1px solid #333">STRIPPING (R+R)</td>
                <td style="width:80;border-bottom:1px solid #333">'.number_format($qted['strp'],2).' Hours</td>
                <td style="width:80;border-bottom:1px solid #333">'.number_format($time['strp'],2).' Hours</td>
                <td style="width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($qted['strp']*$stripRate,2).'</td>
                <td style="width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($time['strp']*$stripRate,2).'</td>
                <td style="color:'.$color.';width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($saved,2).'</td>
                <td style="color:'.$color1.';width:70;border-bottom:1px solid #333;text-align:right">R '.number_format($lost,2).'</td>
            </tr>
            <tr>
                <td style="width:100;border-bottom:1px solid #333">PAINT</td>
                <td style="width:80;border-bottom:1px solid #333">'.number_format($qted['pnt'],2).' Hours</td>
                <td style="width:80;border-bottom:1px solid #333">'.number_format($time['pnt'],2).' Hours</td>
                <td style="width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($qted['pnt']*$paintRate,2).'</td>
                <td style="width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($time['pnt']*$paintRate,2).'</td>
                <td style="color:'.$color2.';width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($saved1,2).'</td>
                <td style="color:'.$color3.';width:70;border-bottom:1px solid #333;text-align:right">R '.number_format($lost1,2).'</td>
            </tr>
            <tr>
                <td style="width:100;border-bottom:1px solid #333">PANEL</td>
                <td style="width:80;border-bottom:1px solid #333">'.number_format($qted['pnel'],2).' Hours</td>
                <td style="width:80;border-bottom:1px solid #333">'.number_format($time['pnel'],2).' Hours</td>
                <td style="width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($qted['pnel']*$laborRate,2).'</td>
                <td style="width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($time['pnel']*$laborRate,2).'</td>
                <td style="color:'.$color4.';width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($saved2,2).'</td>
                <td style="color:'.$color5.';width:70;border-bottom:1px solid #333;text-align:right">R '.number_format($lost2,2).'</td>
            </tr>
            
            <tr>
                <td style="width:100;border-bottom:1px solid #333">MECHANICAL</td>
                <td style="width:80;border-bottom:1px solid #333">'.number_format($qted['mech'],2).' Hours</td>
                <td style="width:80;border-bottom:1px solid #333">'.number_format($time['mech'],2).' Hours</td>
                <td style="width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($qted['mech']*$laborRate,2).'</td>
                <td style="width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($time['mech']*$laborRate,2).'</td>
                <td style="color:'.$color8.';width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($saved4,2).'</td>
                <td style="color:'.$color9.';width:70;border-bottom:1px solid #333;text-align:right">R '.number_format($lost4,2).'</td>
            </tr>            
            <tr>
                <td style="width:100;border-bottom:1px solid #333">OUTWORK</td>
                <td style="width:80;border-bottom:1px solid #333">'.number_format($qted['out'],2).' Hours</td>
                <td style="width:80;border-bottom:1px solid #333">'.number_format($time['out'],2).' Hours</td>
                <td style="width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($qted['out']*$laborRate,2).'</td>
                <td style="width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($time['out']*$laborRate,2).'</td>
                <td style="color:'.$color12.';width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($saved6,2).'</td>
                <td style="color:'.$color13.';width:70;border-bottom:1px solid #333;text-align:right">R '.number_format($lost6,2).'</td>
            </tr>
            <tr>
                <td style="width:100;border-bottom:1px solid #333">POLISHING</td>
                <td style="width:80;border-bottom:1px solid #333">'.number_format($this->getPolishTime($ref),2).' Hours</td>
                <td style="width:80;border-bottom:1px solid #333">'.number_format($time['pol'],2).' Hours</td>
                <td style="width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($this->getPolishTime($ref)*$laborRate,2).'</td>
                <td style="width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($time['pol']*$laborRate,2).'</td>
                <td style="color:'.$color14.';width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($saved7,2).'</td>
                <td style="color:'.$color15.';width:70;border-bottom:1px solid #333;text-align:right">R '.number_format($lost7,2).'</td>
            </tr>
            <tr>
                <td style="width:100;border-bottom:1px solid #333">CLEANING</td>
                <td style="width:80;border-bottom:1px solid #333">'.number_format(2,2).' Hours</td>
                <td style="width:80;border-bottom:1px solid #333">'.number_format($time['cln'],2).' Hours</td>
                <td style="width:80;border-bottom:1px solid #333;text-align:right">R '.number_format(2*$laborRate,2).'</td>
                <td style="width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($time['cln']*$laborRate,2).'</td>
                <td style="color:'.$color16.';width:80;border-bottom:1px solid #333;text-align:right">R '.number_format($saved8,2).'</td>
                <td style="color:'.$color17.';width:70;border-bottom:1px solid #333;text-align:right">R '.number_format($lost8,2).'</td>
            </tr>
            <tr>
                <th style="width:100;border-bottom:1px solid #333"><b>TOTAL</b></th>
                <th style="width:80;border-bottom:1px solid #333"><b>'.number_format(4+$qted['out']+$qted['mech']+$qted['ass']+$qted['pnt']+$qted['pnel']+$qted['strp'],2).' Hours</b></th>
                <th style="width:80;border-bottom:1px solid #333"><b>'.number_format($time['cln']+$time['pol']+$time['out']+$time['mech']+$time['ass']+$time['pnt']+$time['pnel']+$time['strp'],2).' Hours</b></th>
                <th style="width:80;border-bottom:1px solid #333;text-align:right"><b>R '.number_format((4*$laborRate)+($qted['out']*$laborRate)+($qted['mech']*$laborRate)+($qted['ass']*$laborRate)+($qted['pnel']*$laborRate)+($qted['pnt']*$paintRate)+($qted['strp']*$stripRate),2).'</b></th>
                <th style="width:80;border-bottom:1px solid #333;text-align:right"><b>R '.number_format(($time['cln']*$laborRate)+($time['pol']*$laborRate)+($time['out']*$laborRate)+($time['mech']*$laborRate)+($time['ass']*$laborRate)+($time['pnel']*$laborRate)+($time['pnt']*$paintRate)+($time['strp']*$stripRate),2).'</b></th>
                <th style="color:'.$color20.';width:80;border-bottom:1px solid #333;text-align:right"><b>R '.$ttlsaved.'</b></th>
                <th style="color:'.$color21.';width:70;border-bottom:1px solid #333;text-align:right"><b>R '.$ttllost.'</b></th>
            </tr>
        </tbody>
    </table>';
    $pdf=PDF::loadview('pdf.timesheet',['table'=>$tbl]);
    return $pdf->stream('Neo Menoe.pdf');

    }//End OF Function

    public function getQuoted($ref)
    {
        $stripz = 0;
        $panelz = 0;
        $paintz = 0;
        $assemblyz = 0;
        $mechanicz = 0;
        $outz = 0;
        $elecz = 0;
        $clnn = 0;
        $resz = DB::select("select * FROM `qoutes` WHERE `Key_Ref`=?",[$ref]);
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
        $resz5 =DB::select("select * FROM `qoutes` WHERE `Key_Ref`=? 
        AND (Oper = 'Custom Elec' OR Oper = 'Custom Sound' OR Oper = 'Inhse Elec Rep'
        OR Oper = 'Electrical Rep')",[$ref]);

        foreach($resz5 as $row) {
            if($row->Oper=='Custom Elec' ||$row->Oper=='Custom Sound'
            ||$row->Oper=='Inhse Elec Rep' ||$row->Oper=='Electrical Rep'){
                $elecz += $row->Labour;
            }
        }
        $resz6 =DB::select("select * FROM `qoutes` WHERE `Key_Ref`=? 
        AND Misc>'0'",[$ref]);
        foreach($resz6 as $row) {
            $outz += $this->getRate($ref, $row->Misc);
        }
    
        return array('strp' => ($stripz), 'pnel' => ($panelz), 'pnt' => ($paintz-$this->getPolishTime($ref)),
            'ass' => ($assemblyz), 'mech' => ($mechanicz),'out' => ($outz+$elecz));
    }

    public function getRate($ref, $amount){
        $rate = 0;
        $res = DB::select("select `labour` FROM `insurer` WHERE `Key_Ref`=?",[$ref]);
        foreach($res as $row){
            $rate = ($amount * $row->labour);
        }
        return $rate;
    }

    public function getPolishTime($ref){
        $time = 0;
        $res = DB::select("select  `paint` FROM `qoutes` WHERE `Key_Ref`=? and paint>0",[$ref]);
        foreach($res as $row) {
            $time += 1/3;
        }
        return $time;
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

    public function getSpentSupplies($id){
        $res = DB::select("select * FROM stock_history WHERE Key_Ref =?",[$id]);
        $prize = 0;
        foreach($res as $row) {    
            $prize += ($row->price * $row->quantity);
        }
        return $prize;
        }

       public function passRate($ref)
        {
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
            $res = DB::select("select user,datetime FROM workshop se WHERE se.Key_Ref =? AND (se.stage = '7' OR se.stage='11') ORDER BY datetime",[$ref]);
            $res_count=count($res);
            if ($res_count > 0) {
                foreach($res as $row) {
                    $usa = $row->user;
                    $rec = array();
                    $logtime = $row->datetime;
                    $date = substr($row->datetime, 0, 10);
                    $dated = $date . ' 17:00:00';
                    $spent = 0;
                    $wewant = '';
                    $wewant1 = '';
                    $wewant2 = '';
                    $wewant3 = '';
                    $avail = array();
                    $ress = DB::select("select DISTINCT cn.datetime FROM cleaning cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                    $ress1 =DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>? AND cn.Key_Ref =? limit 1",[$logtime,$ref]);
                    $ress2 = DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                    $ress_count=count($ress);
                    $ress1_count=count($ress1);
                    $ress2_count=count($ress2);
                    if ($ress_count > 0) {
                        foreach ($ress as $roww) {
                            $wewant1 = $roww->datetime;
                        }
                        array_push($avail,($wewant1));
                    }
                    
                    if ($ress1_count > 0) {
                        foreach ($ress1 as $roww) {
                            $wewant2 = $roww->datetime;
                        }
                        array_push($avail,($wewant2));
                    }

                    if ($ress2_count > 0) {
                        foreach ($ress2 as $roww) {
                            $wewant3 = $roww->datetime;
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
        
            $res1 = DB::select("select user,datetime FROM workshop se WHERE se.Key_Ref =? AND (se.stage = '9' OR se.stage = '31' OR se.stage = '32') ORDER BY datetime",[$ref]);
            $res1_count=count($res1);
            if ($res1_count > 0) {
                foreach ($res1 as $row) {
                    $usa = $row->user;
                $rec = array();
                $logtime = $row->datetime;
                $date = substr($row->datetime, 0, 10);
                $dated = $date . ' 17:00:00';
                $spent = 0;
                $wewant = '';
                $wewant1 = '';
                $wewant2 = '';
                $wewant3 = '';
                $avail = array();
                $ress = DB::select("select DISTINCT cn.datetime FROM cleaning cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                $ress1 =DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>'? AND cn.Key_Ref =? limit 1",[$logtime,$ref]);
                $ress2 =DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                $ress_count=count($ress);
                $ress1_count=count($ress1);
                $ress2_count=count($ress2);
                if ($ress_count > 0) {
                    foreach($ress as $roww) {
                        $wewant1 = $roww->datetime;
                    }
                    array_push($avail,($wewant1));
                }
                if ($ress1_count > 0) {
                    foreach ($ress1 as $roww) {
                        $wewant2 = $roww->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if (count($ress2) > 0) {
                    foreach ($ress2 as $roww) {
                        $wewant3 = $roww->datetime;
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
                array_push($panell, $spent);
                }
                $pnel = array_sum($panell);
            }
            $res2 = DB::select("select user,datetime FROM workshop se WHERE se.Key_Ref =? AND (se.stage = '10' OR se.stage = '26' OR se.stage = '27' OR se.stage = '28' OR se.stage = '29') ORDER BY datetime",[$ref]);
            if (count($res2) > 0) {
                foreach ($res2 as $row) {
                    $usa = $row->user;
                    $rec = array();
                    $logtime = $row->datetime;
                    $date = substr($row->datetime, 0, 10);
                    $dated = $date . ' 17:00:00';
                    $spent = 0;
                    $wewant = '';
                    $wewant1 = '';
                    $wewant2 = '';
                    $wewant3 = '';
                    $avail = array();
                    $ress = DB::select("select DISTINCT cn.datetime FROM cleaning cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                    $ress1 =DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>'? AND cn.Key_Ref =? limit 1",[$logtime,$ref]);
                    $ress2 =DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                    if (count($ress) > 0) {
                        foreach($ress as $roww) {
                            $wewant1 = $roww->datetime;
                        }
                        array_push($avail,($wewant1));
                    }
                    if (count($ress1) > 0) {
                        foreach($ress1 as $roww) {
                            $wewant2 = $roww->datetime;
                        }
                        array_push($avail,($wewant2));
                    }
                    if (count($ress2) > 0) {
                        foreach ($ress2 as $roww) {
                            $wewant3 = $roww->datetime;
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
                    array_push($paintt, $spent);
                }
                $pnt = array_sum($paintt);
            }
        
            $res4 =DB::select("select user,datetime FROM workshop se WHERE se.Key_Ref =? AND se.stage = '8' ORDER BY datetime",[$ref]);
            if (count($res4) > 0) {
                foreach ($res4 as $row) {
                    $usa = $row->user;
                $rec = array();
                $logtime = $row->datetime;
                $date = substr($row->datetime, 0, 10);
                $dated = $date . ' 17:00:00';
                $spent = 0;
                $wewant = '';
                $wewant1 = '';
                $wewant2 = '';
                $wewant3 = '';
                $avail = array();
                $ress = DB::select("select DISTINCT cn.datetime FROM cleaning cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                $ress1 =DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>'? AND cn.Key_Ref =? limit 1",[$logtime,$ref]);
                $ress2 =DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                if (count($ress) > 0) {
                    foreach ($ress as $roww) {
                        $wewant1 = $roww->datetime;
                    }
                    array_push($avail,($wewant1));
                }
                if (count($ress1) > 0) {
                    foreach ($ress1 as $row) {
                        $wewant2 = $roww->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if (count($ress2) > 0) {
                    foreach ($ress2 as $roww) {
                        $wewant3 = $roww->datetime;
                    }
                    array_push($avail,($wewant3));
                }
                
                if(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))>strtotime($date . ' 17:00:00'))){
                    $wewant = $dated;
                }elseif(count($avail)>=1){
                    $wewant = min($avail);
                }
                if (strtotime(substr($wewant, 0, 10)) == strtotime($date)) {
                    $spent =$this->getRemainingTime($logtime, $wewant) / 3600;
        
                } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                    $spent = $this->getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                    $wewant =$date . ' 17:00:00'; 
                }
                array_push($mechanicc, $spent);
                }
                $mech = array_sum($mechanicc);
            }
        
            $res5 = DB::select("select user,datetime FROM workshop se WHERE se.Key_Ref =? AND se.stage = '14' ORDER BY datetime",[$ref]);
            if (count($res5) > 0) {
                foreach ($res5 as $row) {
                    $usa = $row->user;
                    $rec = array();
                    $logtime = $row->datetime;
                    $date = substr($row->datetime, 0, 10);
                    $dated = $date . ' 17:00:00';
                    $spent = 0;
                    $wewant = '';
                    $wewant1 = '';
                    $wewant2 = '';
                    $wewant3 = '';
                    $avail = array();
                    $ress = DB::select("select DISTINCT cn.datetime FROM cleaning cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                    $ress1 =DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>'? AND cn.Key_Ref =? limit 1",[$logtime,$ref]);
                    $ress2 =DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                    if (count($ress) > 0) {
                        foreach ($ress as $roww) {
                            $wewant1 = $roww->datetime;
                        }
                        array_push($avail,($wewant1));
                    }
                    if (count($ress1) > 0) {
                        foreach ($ress1 as $roww) {
                            $wewant2 = $roww->datetime;
                        }
                        array_push($avail,($wewant2));
                    }
                    if (count($ress2) > 0) {
                        foreach ($ress2 as $roww) {
                            $wewant3 = $roww->datetime;
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
        
            $res6 =DB::select("select user,datetime FROM workshop se WHERE se.Key_Ref =? AND se.stage = '25' ORDER BY datetime",[$ref]);
            if (count($res6) > 0) {
                foreach ($res6 as $row) {
                    $usa = $row->user;
                $rec = array();
                $logtime = $row->datetime;
                $date = substr($row->datetime, 0, 10);
                $dated = $date . ' 17:00:00';
                $spent = 0;
                $wewant = '';
                $wewant1 = '';
                $wewant2 = '';
                $wewant3 = '';
                $avail = array();
                $ress = DB::select("select DISTINCT cn.datetime FROM cleaning cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                $ress1 =DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>'? AND cn.Key_Ref =? limit 1",[$logtime,$ref]);
                $ress2 =DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                if (count($ress) > 0) {
                    foreach($ress as $roww) {
                        $wewant1 = $roww->datetime;
                    }
                    array_push($avail,($wewant1));
                }
                if (count($ress1) > 0) {
                    foreach ($ress1 as $roww) {
                        $wewant2 = $roww->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if (count($ress2) > 0) {
                    foreach ($ress2 as $roww) {
                        $wewant3 = $roww->datetime;
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
                $polish = array_sum($polishh);
            }
        
            $res7 = DB::select("select user,datetime FROM workshop se WHERE se.Key_Ref =? AND se.stage = '30' ORDER BY datetime",[$ref]);
            if (count($res7) > 0) {
                foreach ($res7 as $row) {
                    $usa = $row->user;
                    $rec = array();
                    $logtime = $row->datetime;
                    $date = substr($row->datetime, 0, 10);
                    $dated = $date . ' 17:00:00';
                    $spent = 0;
                    $wewant = '';
                    $wewant1 = '';
                    $wewant2 = '';
                    $wewant3 = '';
                    $avail = array();
                    $ress = DB::select("select DISTINCT cn.datetime FROM cleaning cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                        $ress1 =DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>'? AND cn.Key_Ref =? limit 1",[$logtime,$ref]);
                        $ress2 =DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                    if (count($ress) > 0) {
                        foreach ($ress as $roww) {
                            $wewant1 = $roww->datetime;
                        }
                        array_push($avail,($wewant1));
                    }
                    if (count($ress1) > 0) {
                        foreach ($ress1 as $roww) {
                            $wewant2 = $roww->datetime;
                        }
                        array_push($avail,($wewant2));
                    }
                    if (count($ress2) > 0) {
                        foreach ($ress2 as $roww) {
                            $wewant3 = $roww->datetime;
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
        
            $res8 = DB::select("select user,datetime FROM workshop se WHERE se.Key_Ref =? AND (se.stage = '31' OR se.stage='13') ORDER BY datetime",[$ref]);
            if (count($res8) > 0) {
                foreach ($res8 as $row) {
                    $usa = $row->user;
                $rec = array();
                $logtime = $row->datetime;
                $date = substr($row->datetime, 0, 10);
                $dated = $date . ' 17:00:00';
                $spent = 0;
                $wewant = '';
                $wewant1 = '';
                $wewant2 = '';
                $wewant3 = '';
                $avail = array();
                $ress = DB::select("select DISTINCT cn.datetime FROM cleaning cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                $ress1 =DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>'? AND cn.Key_Ref =? limit 1",[$logtime,$ref]);
                $ress2 =DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
                if (count($ress) > 0) {
                    foreach ($ress as $roww) {
                        $wewant1 = $roww->datetime;
                    }
                    array_push($avail,($wewant1));
                }
                if (count($ress1) > 0) {
                    foreach ($ress1 as $roww) {
                        $wewant2 = $roww->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if (count($ress2) > 0) {
                    foreach ($ress2 as $roww) {
                        $wewant3 = $roww->datetime;
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
            // return ($strp / 3600) + ($pnel / 3600) + ($pnt / 3600) + ($assmb / 3600) + ($mech / 3600) +
            //     ($clean / 3600) + ($polish / 3600) + ($elec / 3600) + ($out / 3600);
        
            return array('strp' => ($strp), 'pnel' => ($pnel), 'pnt' => ($pnt),
                'ass' => ($assmb), 'mech' => ($mech),
                'cln' => ($clean), 'pol' => ($polish), 'out' => ($out)+($elec));
        }
        
   
    public function timesheet_labour($id){
            $html='';

            $dbquery   = DB::select("select * from client_details where Key_Ref=?",[$id]);


        if(count($dbquery)>0){
            foreach($dbquery as $dbrow){

            $reg   = $dbrow->Reg_No;    
            $make  = $dbrow->Make;    
            $model = $dbrow->Model;    

            }    
        }

        $html='

                <h3 style="text-align:center;">'.$id.'</h3>
                <h6 style="text-align:center;">Make: '.$make.' '.$model.' Registration: '.$reg.'</h6>
                <hr/>

                    <h4>Panel Shop</h4>

                    <table border="0">
                        <tr style="background-color:black;color:white;font-size:10;">
                            <th style="width:150px;">Name</th>
                            <th style="width:150px;">Oper</th>
                            <th style="width:100px;">Started</th>
                            <th style="width:100px;">Finished</th>
                            <th style="width:60px;">A-Time</th>
                            <th style="width:60px;">S-Time</th>
                            <th style="width:60px;">R-Time</th>
                        </tr>
                    </table>
';

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
        $no=0;
        $allowed_final=0;

        //get allowed
        $dbquery   =DB::select("select * from qoutes where Key_Ref=?",[$id]);


            if(count($dbquery)>0){
            foreach($dbquery as $dbrow){

            $allowed        += $dbrow->Labour;
            $allowed_stage  += ($dbrow->Labour / 5);

            }    
            }
        //get labour rate
        $dbqueryR   = DB::select("select * from insurer where Key_Ref=?",[$id]);

            if(count($dbqueryR)>0){
            foreach($dbqueryR as $dbrowR){

            $rate  += $dbrowR->labour;

            }    
            }
        //get allowed quality control
        $dbquery   = DB::select("select * from qoutes where Key_Ref=? and (Oper='Inhouse' or Oper='Quality Inspection')",[$id]);

            if(count($dbquery)>0){
            foreach($dbquery as $dbrow){

            $allowed_qc  += ($dbrow->Misc / $rate/5);

            }    
            }
        //get additional allowed
        $dbqueryA   = DB::select("select * from additional where Key_Ref=?",[$id]);


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
    $dbquery   = DB::select("select * from clocking_history where Key_Ref=? and stage='Panel Shop'",[$id]);


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

                if($title=="Stripping"){
                $allowed_stage = $allowed_stage;    
                $allowed_stage1 = $allowed_stage;    
                }elseif($title=="Panel Beating Car"){
                $allowed_stage = $allowed_stage;  
                $allowed_stage1 = $allowed_stage;  
                }elseif($title=="Panel Beating Truck"){
                $allowed_stage = $allowed_stage;  
                $allowed_stage1 = $allowed_stage;  
                }elseif($title=="Jig"){
                $allowed_stage = $allowed_stage;  
                $allowed_stage1 = $allowed_stage;  
                }elseif($title=="Loose Part"){
                $allowed_stage = $allowed_stage;  
                $allowed_stage1 = $allowed_stage;  
                }elseif($title=="Panel Shop Quality Control"){
                $allowed_stage = $allowed_qc;    
                $qc = $qc + $allowed_qc;
                }

$html.= '
<table>
<tr style="font-size:10px;">
<td style="width:150px;">'.$user.'</td>
<td style="width:150px;">'.$title.'</td>
<td style="width:100px;">'.$start.'</td>
<td style="width:100px;">'.$end.'</td>
<td style="width:60px;">'.number_format($allowed_stage,2).'</td>
<td style="width:60px;">'.number_format($s_t,2).'</td>
<td style="width:60px;color:'.$remaining_color.'">'.number_format($t_r,2).'</td>
</tr>
</table>
';

}
}

$html.= '
<table>
<tr style="font-size:10px;">
<td style="width:150px;"><b>Additional</b></td>
<td style="width:150px;">&nbsp;</td>
<td style="width:100px;">&nbsp;</td>
<td style="width:100px;">&nbsp;</td>
<td style="width:60px;"><b>'.number_format($additional,2).'</b></td>
<td style="width:60px;"><b>'.number_format($spent,2).'</b></td>
<td style="width:60px;"><b>'.number_format($additional-$spent,2).'</b></td>
</tr>

<tr style="font-size:10px;">
<td colspan="4"><b>Allowed Time</b></td>
<td><b>'.number_format($allowed+$allowed_qc,2).'</b></td>
<td><b>'.number_format($spent,2).'</b></td>
<td><b>'.number_format($allowed+$allowed_qc-$spent,2).'</b></td>
</tr>

<tr hidden style="font-size:10px;">
<td colspan="4"><b>Total</b></td>
<td><b>'.number_format($allowed+$additional+$allowed_qc,2).'</b></td>
<td><b>'.number_format($spent,2).'</b></td>
<td><b>'.number_format($allowed+$allowed_qc+$additional-$spent,2).'</b></td>
</tr>
</table>
<hr/>
';

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$html.='
<h4>Paint Shop</h4>

<table border="0">
<tr style="background-color:black;color:white;font-size:12px;">
<th style="width:150px;">Name</th>
<th style="width:150px;">Oper</th>
<th style="width:100px;">Started</th>
<th style="width:100px;">Finished</th>
<th style="width:60px;">A-Time</th>
<th style="width:60px;">S-Time</th>
<th style="width:60px;">R-Time</th>
</tr>
</table>
';


$allowed       = 0;
$spent         = 0;
$rate          = 0;
$add           = 0;
$add1          = 0;
$additional    = 0;
$allowed_stage = 0;

//get allowed
$dbquery   =DB::select("select * from qoutes where Key_Ref=?",[$id]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed        += ($dbrow->Paint);
$allowed_stage  += ($dbrow->Paint / 6);

}    
}
//get labour rate
$dbqueryR   = DB::select("select * from insurer where Key_Ref=?",[$id]);


if(count($dbqueryR)>0){
foreach($dbqueryR as $dbrowR){

$rate  += $dbrowR->labour;

}    
}
//get additional allowed
$dbqueryA   = DB::select("select * from additional where Key_Ref=?",[$id]);


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
$dbquery   = DB::select("select * from clocking_history where Key_Ref=? and stage='Paint Shop'",[$id]);


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

$html.='
<table>
<tr style="font-size:10px;">
<td style="width:150px;">'.$user.'</td>
<td style="width:150px;">'.$title.'</td>
<td style="width:100px;">'.$start.'</td>
<td style="width:100px;">'.$end.'</td>
<td style="width:60px;">'.number_format($allowed_stage,2).'</td>
<td style="width:60px;">'.number_format($s_t,2).'</td>
<td style="width:60px;color:'.$remaining_color.'">'.number_format($t_r,2).'</td>
</tr>
</table>
';

}
}

$html.='
<table>
<tr style="font-size:10px;">
<td style="width:150px;"><b>Additional</b></td>
<td style="width:150px;">&nbsp;</td>
<td style="width:100px;">&nbsp;</td>
<td style="width:100px;">&nbsp;</td>
<td style="width:60px;"><b>'.number_format($additional,2).'</b></td>
<td style="width:60px;"><b>'.number_format($spent,2).'</b></td>
<td style="width:60px;"><b>'.number_format($additional-$spent,2).'</b></td>
</tr>

<tr style="font-size:10px;">
<td colspan="4"><b>Allowed Time</b></td>
<td><b>'.number_format($allowed-2,2).'</b></td>
<td><b>'.number_format($spent,2).'</b></td>
<td><b>'.number_format($allowed-$spent-2,2).'</b></td>
</tr>

<tr style="font-size:10px;">
<td colspan="4"><b>Total</b></td>
<td><b>'.number_format($allowed+$additional-2,2).'</b></td>
<td><b>'.number_format($spent,2).'</b></td>
<td><b>'.number_format($allowed+$additional-$spent-2,2).'</b></td>
</tr>
</table>
<hr/>
';

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$html .='
<h4>Assembly</h4>

<table border="0">
<tr style="background-color:black;color:white;font-size:10px;">
<th style="width:150px;">Name</th>
<th style="width:150px;">Oper</th>
<th style="width:100px;">Started</th>
<th style="width:100px;">Finished</th>
<th style="width:60px;">A-Time</th>
<th style="width:60px;">S-Time</th>
<th style="width:60px;">R-Time</th>
</tr>
</table>
';


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
$dbquery   = DB::select("select * from qoutes where Key_Ref=?",[$id]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed        += $dbrow->Strip;
$allowed_stage  += ($dbrow->Strip / 2);

}    
}
//get labour rate
$dbqueryR   = DB::select("select * from insurer where Key_Ref=?",[$id]);


if(count($dbqueryR)>0){
foreach($dbqueryR as $dbrowR){

$rate  += $dbrowR->labour;

}    
}
//get allowed outwork
$dbquery   = DB::select("select * from qoutes where Key_Ref=? and (Oper='Electrical Rep' or Oper='Diagnistics')",[$id]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed_out        += $dbrow->Misc / $rate;
$allowed_stage_out  += ($dbrow->Misc / $rate / 2);

}    
}
//get allowed quality control
$dbquery   = DB::select("select * from qoutes where Key_Ref=? and (Oper='Inhouse' or Oper='Quality Inspection')",[$id]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed_qc  += ($dbrow->Misc / $rate/5);

}    
}
//get additional allowed
$dbqueryA   = DB::select("select * from additional where Key_Ref=?",[$id]);


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
$dbquery   = DB::select("select * from clocking_history where Key_Ref=? and stage='Assembly'",[$id]);


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

if($no==1){
$allowed_final = $allowed_stage;   
$t_r   = $allowed_stage-$s_t; 
}elseif($no==2){
$allowed_final = $allowed_stage;    
$t_r   = $allowed_stage-$s_t; 
}elseif($no==3){
$allowed_final = $allowed_stage_out;
$t_r   = $allowed_stage_out-$s_t; 
}elseif($no==4){
$allowed_final = $allowed_stage_out;   
$t_r   = $allowed_stage_out-$s_t;  
}

if($t_r<0){
$remaining_color = "red";    
}else{
$remaining_color = "green";
}

if($title=="Stripping"){
$allowed_final = $allowed_final;    
$allowed_final1 = $allowed_final;    
}elseif($title=="Assembly"){
$allowed_final = $allowed_final;
$allowed_final1 = $allowed_final;
}elseif($title=="Electrical"){
$allowed_final = $allowed_final;
$allowed_final1 = $allowed_final;
}elseif($title=="Diagnosis"){
$allowed_final = $allowed_final;
$allowed_final1 = $allowed_final;
}elseif($title=="Assembly Quality Control"){
$allowed_final = $allowed_qc; 
$qc = $qc + $allowed_qc;
}

$html.='
<table>
<tr style="font-size:10px;">
<td style="width:150px;">'.$user.'</td>
<td style="width:150px;">'.$title.'</td>
<td style="width:100px;">'.$start.'</td>
<td style="width:100px;">'.$end.'</td>
<td style="width:60px;">'.number_format($allowed_final,2).'</td>
<td style="width:60px;">'.number_format($s_t,2).'</td>
<td style="width:60px;color:'.$remaining_color.'">'.number_format($t_r,2).'</td>
</tr>
</table>
';

}
}

$html.='
<table >
<tr style="font-size:10px;">
<td style="width:150px;"><b>Additional</b></td>
<td style="width:150px;">&nbsp;</td>
<td style="width:100px;">&nbsp;</td>
<td style="width:100px;">&nbsp;</td>
<td style="width:60px;"><b>'.number_format($additional,2).'</b></td>
<td style="width:60px;"><b>'.number_format($spent,2).'</b></td>
<td style="width:60px;"><b>'.number_format($additional-$spent,2).'</b></td>
</tr>

<tr style="font-size:10px;">
<td colspan="4"><b>Allowed Time</b></td>
<td><b>'.number_format($allowed+$qc+$allowed_out,2).'</b></td>
<td><b>'.number_format($spent,2).'</b></td>
<td><b>'.number_format($allowed+$qc-$spent,2).'</b></td>
</tr>

<tr style="font-size:10px;">
<td colspan="4"><b>Total</b></td>
<td><b>'.number_format($allowed+$qc+$additional+$allowed_out,2).'</b></td>
<td><b>'.number_format($spent,2).'</b></td>
<td><b>'.number_format($allowed+$qc+$additional+$allowed_out-$spent,2).'</b></td>
</tr>
</table>
<hr/>
';

// -----------------------------------------------------------------------------------------------------------------
$html.='
<h4>Mechanical</h4>

<table border="0">
<tr style="background-color:black;color:white;font-size:10px;">
<th style="width:150px;">Name</th>
<th style="width:150px;">Oper</th>
<th style="width:100px;">Started</th>
<th style="width:100px;">Finished</th>
<th style="width:60px;">A-Time</th>
<th style="width:60px;">S-Time</th>
<th style="width:60px;">R-Time</th>
</tr>
</table>
';


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
$dbquery   = DB::select("select * from qoutes where Key_Ref=? and Oper='Mechanical'",[$id]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed        += $dbrow->Labour;
$allowed_stage  += ($dbrow->Labour / 2);

}    
}
//get labour rate
$dbqueryR   = DB::select("select * from insurer where Key_Ref=?",[$id]);


if(count($dbqueryR)>0){
foreach($dbqueryR as $dbrowR){

$rate  += $dbrowR->labour;

}    
}
//get allowed quality control
$dbquery   = DB::select("select * from qoutes where Key_Ref=? and (Oper='Inhouse' or Oper='Quality Inspection')",[$id]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed_qc  += ($dbrow->Misc / $rate/5);

}    
}
//get additional allowed
$dbqueryA   = DB::select("select * from additional where Key_Ref=? and Oper='Mechanical'",[$id]);


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
$dbquery   = DB::select("select * from clocking_history where Key_Ref=? and stage='Mechanical'",[$id]);


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

if($title=="Stripping"){
$allowed_stage = $allowed_stage;    
$allowed_stage1 = $allowed_stage;    
}elseif($title=="Mechanical"){
$allowed_stage = $allowed_stage;
$allowed_stage1 = $allowed_stage;
}elseif($title=="Mechanical Quality Control"){
$allowed_stage = $allowed_qc; 
$qc = $qc + $allowed_qc;
}

$html.='
<table>
<tr style="font-size:10px;">
<td style="width:150px;">'.$user.'</td>
<td style="width:150px;">'.$title.'</td>
<td style="width:100px;">'.$start.'</td>
<td style="width:100px;">'.$end.'</td>
<td style="width:60px;">'.number_format($allowed_stage,2).'</td>
<td style="width:60px;">'.number_format($s_t,2).'</td>
<td style="width:60px;color:'.$remaining_color.'">'.number_format($t_r,2).'</td>
</tr>
</table>
';

}
}

$html.='
<table style="font-size:10px;">
<tr >
<td style="width:150px;"><b>Additional</b></td>
<td style="width:150px;">&nbsp;</td>
<td style="width:100px;">&nbsp;</td>
<td style="width:100px;">&nbsp;</td>
<td style="width:60px;"><b>'.number_format($additional,2).'</b></td>
<td style="width:60px;"><b>'.number_format($spent,2).'</b></td>
<td style="width:60px;"><b>'.number_format($additional-$spent,2).'</b></td>
</tr>

<tr>
<td colspan="4"><b>Allowed Time</b></td>
<td><b>'.number_format($allowed + $qc,2).'</b></td>
<td><b>'.number_format($spent,2).'</b></td>
<td><b>'.number_format($allowed+$qc-$spent,2).'</b></td>
</tr>

<tr>
<td colspan="4"><b>Total</b></td>
<td><b>'.number_format($allowed+$qc+$additional,2).'</b></td>
<td><b>'.number_format($spent,2).'</b></td>
<td><b>'.number_format($allowed+$additional+$qc-$spent,2).'</b></td>
</tr>
</table>
<hr/>
';


$html.='
<h4>Cleaning</h4>

<table border="0">
<tr style="background-color:black;color:white;font-size:10px;">
<th style="width:150px;">Name</th>
<th style="width:150px;">Oper</th>
<th style="width:100px;">Started</th>
<th style="width:100px;">Finished</th>
<th style="width:60px;">A-Time</th>
<th style="width:60px;">S-Time</th>
<th style="width:60px;">R-Time</th>
</tr>
</table>
';


$allowed    = 0;
$spent      = 0;
$rate       = 0;
$add        = 0;
$add1       = 0;
$additional = 0;
$allowed_qc = 0;
$qc         = 0;

//get labour rate
$dbqueryR   = DB::select("select * from insurer where Key_Ref=?",[$id]);


if(count($dbqueryR)>0){
foreach($dbqueryR as $dbrowR){

$rate  += $dbrowR->labour;

}    
}
//get allowed quality control
$dbquery   = DB::select("select * from qoutes where Key_Ref=? and (Oper='Inhouse' or Oper='Quality Inspection')",[$id]);


if(count($dbquery)>0){
foreach($dbquery as $dbrow){

$allowed_qc  += ($dbrow->Misc / $rate/5);

}    
}

$allowed = 2;
$allowed_stage = 2;

//get time management
$dbquery   = DB::select("select * from clocking_history where Key_Ref=? and stage='Cleaning'",[$id]);


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

if($title=="Cleaning"){
$allowed_stage = $allowed_stage;    
}elseif($title=="Line Manager Quality Control"){
$allowed_stage = $allowed_qc;    
$qc = $qc + $allowed_qc;
}elseif($title=="Quality Control"){
$allowed_stage = $allowed_qc;    
$qc = $qc + $allowed_qc;
}

$html.='
<table>
<tr style="font-size:10px;">
<td style="width:150px;">'.$user.'</td>
<td style="width:150px;">'.$title.'</td>
<td style="width:100px;">'.$start.'</td>
<td style="width:100px;">'.$end.'</td>
<td style="width:60px;">'.number_format($allowed_stage,2).'</td>
<td style="width:60px;">'.number_format($s_t,2).'</td>
<td style="width:60px;color:'.$remaining_color.'">'.number_format($t_r,2).'</td>
</tr>
</table><hr/>
';

}
}

$html.='
<h4>Ordering</h4>

<table border="0">
<tr style="background-color:black;color:white;font-size:10px;">
<th style="width:150px;">Name</th>
<th style="width:80px;">Order Number</th>
<th style="width:150px;">Description</th>
<th style="width:80px;">Quantity</th>
<th style="width:80px;">Order Date</th>
<th style="width:80px;">Received</th>
</tr>
</table>
';


$dbquery = DB::select("select a.order_number,a.user,b.Description_2,b.quantity,b.date,c.Parts_sales
            FROM confirmed_orders a
            INNER JOIN orders b ON a.order_number=b.order_number
            INNER JOIN qoutes c ON b.Description_2=c.Description
            WHERE a.Key_Ref=? AND c.Key_Ref=?",[$id,$id]);



if(count($dbquery)>0){
foreach($dbquery as $dbrow){

if($dbrow->Parts_sales>0){
$received = "&#10004;";
}else{
$received = "";    
}

$html.= '
<table>
<tr style="font-size:10px;">
<td style="width:150px;">'.$dbrow->user.'</td>
<td style="width:80px;text-align:center;">'.$dbrow->order_number.'</td>
<td style="width:150px;">'.$dbrow->Description_2.'</td>
<td style="width:80px;text-align:center;">'.$dbrow->quantity.'</td>
<td style="width:80px;text-align:center;">'.$dbrow->date.'</td>
<td style="width:80px;text-align:center;">'.$received.'</td>
</tr>
</table>
';    

}    
}
                $pdf=PDF::loadview('pdf.timesheet',['table'=>$html]);
                return $pdf->stream(''.$id.'-Timesheet.pdf');
        }//End Of Function

    public function release_vehicle(Request $request){
        
        $no    = 1;
        $date1 = $request->date1;
        $date2 = $request->date2;

        $html='';
        $html='
        <h1 style="text-align:center;">Motor Accident Group</h1>
        <h4 style="text-align:center;">All Released Vehicles from: '.$date1.' to: '.$date2.'</h4>
        
        <table style="background-color:black;color:white;">
        <tr style="font-size:12px;">
        <th style="width:25px;">No</th>
        <th style="width:70px;">Key Ref</th>
        <th style="width:80px;">First Name</th>
        <th style="width:80px;">Last Name</th>
        <th style="width:80px;">Reg Number</th>
        <th style="width:80px;">Make</th>
        <th style="width:80px;">Insuarance</th>
        <th style="width:80px;">Claim No</th>
        <th style="width:80px;">Costing</th>
        <th style="width:80px;">Clearance</th>
        <th style="width:80px;">Invoice</th>
        <th style="width:80px;">Recieve Date</th>
        <th style="width:80px;">Release Date</th>
        </tr>
        </table>
        ';

        $dbquery=DB::select("select DISTINCT a.Key_Ref,a.date,b.Fisrt_Name,b.Last_Name,b.Cell_number,b.Reg_No,b.Make,b.Model,b.recive_date,c.Inserer,c.Claim_NO
        FROM csi_table a 
        INNER JOIN client_details b ON a.Key_Ref=b.Key_Ref
        INNER JOIN insurer c ON b.Key_Ref=c.Key_Ref
        WHERE a.date>=? AND a.date<=?",[$date1,$date2]);

        if(count($dbquery)>0){
            foreach($dbquery as $dbrow){
            
            $dbquery_1=DB::select("select * FROM qoutes a WHERE a.Key_Ref=? AND a.Parts_sales>1",[$dbrow->Key_Ref]);
                        
            if(count($dbquery_1)>0){
            $costing_status = '<img src="img/checked.png" width="15" height="15">';
            $color          = "#deffe2;";
            }else{
            $costing_status = '<img src="img/unchecked.png" width="15" height="15">';
            $color          = "#feffdb;";
            }
            
            $dbquery_2   = DB::select("select * FROM document a WHERE a.Description='Signed Clearance Certificate' AND a.Key_Ref=?",[$dbrow->Key_Ref]);
            
            
            if(count($dbquery_2)>0){
            $clearance_status = '<img src="img/checked.png" width="15" height="15">';	
            }else{
            $clearance_status = '<img src="img/unchecked.png" width="15" height="15">';	
            }
            
            $dbquery_3 =DB::select("select * FROM document a WHERE a.Description='Invoice' AND a.Key_Ref=?",[$dbrow->Key_Ref]);
            
            
            if(count($dbquery_3)>0){
            $invoice_status = '<img src="img/checked.png" width="15" height="15">';	
            }else{
            $invoice_status = '<img src="img/unchecked.png" width="15" height="15">';	
            }
            
            
            $html.='
            
            <table>
            <tr style="background-color:'.$color.';font-size:10px;">
            <td style="width:25px;">'.$no.'</td>
            <td style="width:70px;">'.$dbrow->Key_Ref.'</td>
            <td style="width:80px;">'.$dbrow->Fisrt_Name.'</td>
            <td style="width:80px;">'.$dbrow->Last_Name.'</td>
            <td style="width:80px;">'.$dbrow->Reg_No.'</td>
            <td style="width:80px;">'.$dbrow->Make."-".$dbrow->Model.'</td>
            <td style="width:80px;">'.$dbrow->Inserer.'</td>
            <td style="width:80px;">'.$dbrow->Claim_NO.'</td>
            <td style="width:80px;">'.$costing_status.'</td>
            <td style="width:80px;">'.$clearance_status.'</td>
            <td style="width:80px;">'.$invoice_status.'</td>
            <td style="width:80px;">'.$dbrow->recive_date.'</td>
            <td style="width:80px;">'.$dbrow->date.'</td>
            </tr>
            </table><hr/>
            ';
            
            $no++;
            	
            }
            }
            $pdf=PDF::loadview('pdf.releaseregister',['table'=>$html])->setPaper('a4','landscape');

            return $pdf->stream('Release Register.pdf');      
    } 

        public function invoice_client($id){
            
            $dbquery  = DB::select("select * FROM client_details WHERE Key_Ref=?",[$id]);

            
            $val7  = '';
            $val8  = '';
            $val1='';
            $val2='';
            $val3='';
            $val4='';
            $val5='';
            $val6='';
            $branch='';
            $excess1=0;
            $private_work=0;
            $additional_1=0;
            $additional_3=0;
            $html='';
            $html_2='';
            $html_3='';
            $html_4='';
            foreach($dbquery as $dbrow){

            $val1   = $dbrow->Fisrt_Name;
            $val2   = $dbrow->Last_Name;
            $val3   = $dbrow->Reg_No;
            $val4   = $dbrow->Make;
            $val5   = $dbrow->Model;
            $val6   = $dbrow->Date;	
            $branch = $dbrow->branch;	

            }

            $dbquery1  = DB::select("select * FROM insurer WHERE Key_Ref=?",[$id]);

           

            foreach($dbquery1 as $dbrow1){

            $val7 = $dbrow1->Assessor;
            $val8 = $dbrow1->Claim_NO;
                        
            }

            $labour   = 0;
            $paint    = 0;
            $strip    = 0;
            $frame    = 0;
            $outwork  = 0;

            $l_query=DB::select("select * FROM qoutes WHERE Key_Ref=? AND Part>='0'",[$id]);

            if(count($l_query)>0){

            foreach($l_query as $l_row){

            $labour   +=$l_row->Labour;
            $paint    +=$l_row->Paint;
            $strip    +=$l_row->Strip;
            $frame    +=$l_row->Frame;
            $outwork  +=$l_row->Misc;
                
            }
                
            } 

            $result4=DB::select("select * FROM betterment where Key_Ref =? ORDER BY `id` DESC LIMIT 0,1",[$id]);
            

            if (count($result4) > 0) {

            foreach($result4 as $row2){
                
            $excess1      = $row2->Excess_1;
            $excess2      = $row2->Excess_2;
            $sundries1    = $row2->sundries1;
            $sundries2    = $row2->sundries2;
            $raw_labour   = $row2->labour;
            $raw_paint    = $row2->paint;
            $private_work = $row2->Private_work;
            $additional_1 = $row2->Additional_1;
            $additional_3 = $row2->Additional_2; 
            }
            } 

            $result5     =DB::select("select * FROM assessors where Names=? ORDER BY `id` DESC LIMIT 0,1",[$val7]);
            

            if (count($result5) > 0) {

            foreach($result5 as $row5){
                
            $assessor_name = $row5->Names;
            $assessor_cell = $row5->Cell;
            $assessor_email= $row5->Email;
            $assessor_comp = $row5->Company;

            }
            }else{
            $assessor_name = "";
            $assessor_cell = "";
            $assessor_email= "";
            $assessor_comp = "";		
            }

            $image='img/betterment.PNG';

            /*$pdf->Image($image);
            $width ='300px;';
            $strText ="";
            $height	="20px";
            $strText = str_replace("\n","<br>",$strText);

            $pdf->MultiCell($width, $height,$strText, 0, 'J', 0, 1, '', '', true, null, true);*/
            // Print text using writeHTMLCell()
            $html = '
            
            <table border="0" style="width:100%;font-size:10px;font-weight: bold;border-collapse: collapse;border: 1px solid black;margin-bottom:-25px;">
            <tr>
            <td style="border: 1px solid black;">REPAIRER</td>
            <td style="border: 1px solid black;">MOTOR ACCIDENT GROUP</td>
            <td style="border: 1px solid black;">ASSESSOR</td>
            <td style="border: 1px solid black;">'.$val7.'</td>
            </tr>

            <tr>
            <td style="border: 1px solid black;">INSURED</td>
            <td style="border: 1px solid black;">'.$val1." ".$val2.'</td>
            <td style="width:108px;border: 1px solid black;">Claim No</td>
            <td style="width:208px;border: 1px solid black;">'.$val8.'</td>
            </tr>

            <tr>
            <td style="width:108px;border: 1px solid black;">REGISTRATION NO</td>
            <td style="width:208px;border: 1px solid black;">'.$val3." ".$val2.'</td>
            <td style="width:108px;border: 1px solid black;">REFERENCE NO</td>
            <td style="width:208px;border: 1px solid black;">'.$id.'</td>
            </tr>

            <tr>
            <td style="width:108px;border: 1px solid black;">VEHICLE</td>
            <td style="width:208px;border: 1px solid black;">'.$val4." ".$val5.'</td>
            <td style="width:108px;border: 1px solid black;">DATE</td>
            <td style="width:208px;border: 1px solid black;">'.$val6.'</td>
            </tr>
            </table>

            <br><br>

            <table style="width:100%;font-size:8px;">
            <tr style="background-color:black;color:white;">
            <td style="width:50px;">No.</td>
            <td style="width:383px;">Description</td>
            <td style="width:100px;">Amount Exl VAT</td>
            <td style="width:100px;">VAT</td>
            </tr>
            </table>
            
            ';
            
            $no = 1;
            $betterment_total   = 0;
            $betterment_vat     = 0;
            $part_total         = 0;
            $actual_price_total = 0;
            $plus_additional    = 0;
            $less_saving        = 0;

            $dbquery2  = DB::select("select * FROM qoutes WHERE Key_Ref=? AND Part>'0' ORDER BY id LIMIT 0,30",[$id]);
            

            if(count($dbquery2)>0){

            foreach($dbquery2 as $dbrow2 ){

            $part_id     = $dbrow2->id;
            $oper        = $dbrow2->Oper;
            $description = $dbrow2->Description;
            $percent     = ($dbrow2->Part*$dbrow2->Percent/100);
            $quantity    = $dbrow2->Quantity;
            $part        = ($dbrow2->Part);
            $part_sales  = $dbrow2->Parts_sales;
            $markup      = $dbrow2->MarkUp;
            $betterment  = $dbrow2->Betterment;
            $disc_val    = $dbrow2->Discount;
                
            $savings     =($part_sales * $markup/100);
            $actual_price=($part_sales + $savings);
            $new_savings =($part - $actual_price);

            $betterment_total += ($part * ($betterment / 100));
            $betterment_vat    = ($betterment_total*15/100);
            $part_total        = ($part_total + $part);
            $actual_price_total= ($actual_price_total + $actual_price);

            if($part_sales<=0){
            $new_savings=$part;	
            }

            if($new_savings<0){
            $new_savings = 0;	
            $additional_price = ($actual_price - $part);	
            }else{
            $additional_price = 0;	
            }

            if($actual_price>0){
            $color = "green";	
            }else{
            $color = "red";	
            }

            $less_saving     += $new_savings;
            $plus_additional += $additional_price;

            $no++;
            }
            }

            $excess1_vat = ($excess1*15/100);

            $html_2='
            <table border="0" style="width:100%;font-size:10px;font-weight:bold;">
            <tr>
            <td style="width:50px;">1</td>
            <td style="width:382px;">Betterment to Client</td>
            <td style="width:100px;">'.number_format($betterment_total,2).'</td>
            <td style="width:100px;">'.number_format($betterment_vat,2).'</td>
            </tr>
            <tr>
            <td style="width:50px">2</td>
            <td style="width:382px">Excess to client</td>
            <td style="width:100px">'.number_format($excess1,2).'</td>
            <td style="width:100px">'.number_format(0,2).'</td>
            </tr>
            <tr>
            <td style="width:50px">3</td>
            <td style="width:382px">Other Work</td>
            <td style="width:100px">'.number_format($other=$private_work+$additional_1+$additional_3,2).'</td>
            <td style="width:100px">'.number_format(0,2).'</td>
            </tr>
            <tr ><td colspan="4">&nbsp;</td></tr>
            <tr>
            <td colspan="4" style="height:10px;border-top:0.5px solid black;">&nbsp;</td>
            </tr>
            <hr>
            <tr >
            <td colspan="2">&nbsp;</td>
            <td >SUB TOTAL</td>
            <td >R'.number_format($betterment_total+$excess1+$other,2).'</h3></td>
            </tr>
            <tr>
            <td colspan="2">&nbsp;</td>
            <td >VAT TOTAL</td>
            <td >R'.number_format($betterment_vat,2).'</td>
            </tr>
            <tr>
            <td colspan="2">&nbsp;</td>
            <td colspan="0">TOTAL</td>
            <td colspan="0">R'.number_format($betterment_total+$excess1+$betterment_vat+$other,2).'</td>
            </tr>
            </table><br>
            ';
            

            $on=" owner's";

            $html_3='
            <table style="font-size:10px; color:gray;border:solid 2px gray;width:100%;">
            <tr><td>&nbsp;</td><td&nbsp;></td></tr>
            <tr><td colspan="2" style="text-align:center;font-size:12px;"><u>Terms And Conditions</u></td></tr>
            <tr><td style="width:23px;"></td><td style="width:87%;"></td></tr>
            <tr><td><b>1</b></td><td>All vehicles  remains the property of Motor Accident Group untill paid in full</td></tr>
            <tr><td><b>2</b></td><td>M.A.G Quotation is valid for 30 days and does not include hidden or latents defects</td></tr>
            <tr><td><b>3</b></td><td>M.A.G will take no responsibility for loss due to fire or theft unforeseen circumstances</td></tr>
            <tr><td><b>4</b></td><td>M.A.G will take no responsibility for all glass that is removed and fitted at the vehicle'.$on.' risk</td></tr>
            <tr><td><b>5</b></td><td>M.A.G will take no responsibility for Alarm, Cameras, SD cards that are left in the vehicle: this is vehicle '.$on.' responsibility</td></tr>
            <tr><td><b>6</b></td><td>Insurance Excess and Payments is payable in cash before vehicle release</td></tr>
            <tr><td><b>7</b></td><td>Credit Card transaction are subject to 5% transaction fee</td></tr>
            <tr><td><b>8</b></td><td>The storage is charged for light commercial at R250/day</td></tr>
            <tr><td><b>9</b></td><td>Storage is charged for heavy commercial at R455/day</td></tr>
            <tr><td><b>10</b></td><td>No work will commence without a signed quotation and payments reflecting a 30% in our account </td></tr>
            <tr><td><b>11</b></td><td>By signing this quotation the client agrees to the terms and conditions of sale and payments terms</td></tr>
            <tr><td><b>12</b></td><td>60 days after completion - vehicle will be sold for defray cost</td></tr>
            <tr><td><b>13</b></td><td>Insurance companies without Service Level Agreement are not allowed to Audit</td></tr>
            <tr><td><b>14</b></td><td>Insurance companies are not allowed discount without signed Service Level Agreement</td></tr>
            <tr><td><b>15</b></td><td>If goods are of inferior quality, unsafe or defective the consumer may return the product within
            a period of six months at the<br/> expense of the supplier</td></tr>
            <tr><td><b>16</b></td><td>Suppliers are obliged to repair, refund or replace the failed, defective or unsafe products.</td></tr>
            <tr><td>17)</td><td>Payments to be done to  <b>First National Bank: 62616112827 Branch Code 250655 or  </b></td></tr>
            <tr><td>18)</td><td>Payments to be done to  <b>Starndard Bank: 281711623 Branch Code 051100</b></td></tr>
            <tr><td>19)</td><td>All proof of payments to be emailed to <b>info@motoracccidentgroup.co.za</b></td></tr>
            <tr><td>20)</td><td>Insurance Assessors are not allowed a 5% settlement without SLA in place</td></tr>
            <tr><td>21)</td><td>Costings to be signed by assessor prior to delivery as per company terms and conditions repair times - Subject to Costings</td></tr>
            <tr>
            <td>
            22)
            </td>
            <td>
            If a vehicle is insured the owner of the vehicle shall remain liable for the repair, salvage and storage costs until the insurer makes payments of such costs.
            </td>
            </tr>
            </table><br><br>
            ';
            

            

            $html_4= '
            <table style="font-size:10px; color:gray;border:solid 2px gray;width:100%;">
            <tr><td></td><td></td></tr>
            <tr><td colspan="2"><u>Banking Details</u></td></tr>
            <tr><td colspan="2" style="font-size:8px; color:green;  font-family: "Times New Roman", Times, serif;><i>To facilitate Payments please used the relevant Bank for release of a Vehicle Immediately</i></td></tr>
            <tr style="font-size:12px; color:green;"><td style="width:50%"><b><u>First National Bank </u></b></td><td style="width:50%;"><b><u>Standard Bank</u></b></td></tr>
            <tr><td colspan="2">&nbsp;</tr>
            <tr style="font-size:12px; color:gray;"><td> Cheque Account No:62616112827 </td><td>Cheque Account No :281711623</td></tr>
            <tr style="font-size:12px;color:gray;"><td>Branch:  Southdale (24-205)</td><td> Branch : 051001</td></tr>
            <tr style="font-size:12px;color:gray;"><td> For and behalf of : Motor Accident Group</td><td>For and behalf of : Motor Accident Group</td></tr>
            <tr><td colspan="2">&nbsp;</td></tr>
            </table><br><br>
            SIGNATURE:__________________________<br/>

            ';
            $pdf=PDF::loadview('pdf.clientinvoice',['table'=>$html_2,'tbl3'=>$html,'terms'=>$html_3,'banking'=>$html_4]);
            return $pdf->stream(''.$id.'Client-Invoices.pdf');  

        }//End Of Function

        public function clearance_certificate($id){
            $html='';
            $branch = '';
            $resultxx = DB::select("select branch from client_details where Key_Ref =?",[$id]);
            foreach($resultxx as $row)
            {
               $branch =  $row->branch;
            }
            if($branch=='LONGMEADOW'){
                $image = "img/Longmeadow.png";
            }else
                if($branch=='THE GLEN'){
                    $image = "img/glen.png";
                }else{
                    $image = "img/_blank.png";
                }
            
            $res  = DB::select("select * FROM insurer Where Key_Ref=?",[$id]);
            
            if (count($res) > 0) { 
            foreach($res as $row1){
                
                $insurer	= $row1->Inserer;
            
                $claimNo	= $row1->Claim_NO;
                $rateTable	= $row1->rateTable;
            }
            }else{
                $insurer	= 'Not specifired';
                $claimNo	= 'Not specifired';
            }
            
            $result3 =DB::select("select * FROM insurer Where Key_Ref=?",[$id]);
            
            
            if (count($result3) > 0) {
            
            foreach($result3 as $rateRow){
                $vat = $rateRow->vat/100;
                $LabourRate = $rateRow->labour;
                $PaintRate	= $rateRow->Paint;
                $StripRate	= $rateRow->Strip;
                $FrameRate	= $rateRow->Frame;
                $Supp		= $rateRow->ShopSup;
                $PaintSup	= $rateRow->PaintSup;
            }
            }
            
            $result = DB::select("select * FROM client_details Where Key_Ref=?",[$id]);
            $Owner = '';
            if (count($result) > 0) { 
            foreach($result as $row){
                $date 			= $row->Date;
                $Owner 			= $row->Fisrt_Name." ".$row->Last_Name;
                $vehicle 		= $row->Make." ".$row->Model;
                $regNo			= $row->Reg_No;
                $job_card_no   	= $row->job_card_no;
                $RO				= $row->RO;
                
                
                
            
            }
            if(isset($prod_key)){
                $prod_ref =$prod_ref;
            }else{
                $prod_ref =$id;
            }
            $html='<img src="'.$image.'">';
            
            $html.='<h5><b>CLEARANCE CERTIFICATE NO.'.$id.'</b></h5><table style="font-size:12px;font-weight:bold;">
                
                    <tr><td width="350px">Insurer/Owner 		</td>		<td>: '.strtoupper ($Owner).'</td></tr>
                    <tr><td>Make & Model 	</td>		<td>: '.strtoupper ($vehicle).'</td></tr>
                    <tr><td>Reg No 		</td>		<td>: '.strtoupper ($regNo).'</td></tr>
                    <tr><td>Insurer 	</td>		<td>: '.strtoupper ($insurer).'</td></tr>
                    <tr><td>Claim NO 	</td>		<td>: '.strtoupper ($claimNo).'</td></tr>
                
                </table>';
            
            
            
            }
            
            
            
            $result4 =DB::select("select * FROM betterment where Key_Ref = ?",[$id]);
            
            
            if (count($result4) > 0) {
            
            foreach($result4 as $row2){
                 $Betterment	=	$row2->Betterment;
                 $Exc			=	$row2->Excess_1;
                 $Excess_2 		=	$row2->Excess_2;
                 $Private		=	$row2->Private_work;
            }
            }else{
                 $Private='0.00';
                  $Exc='0.00';
                  $Excess_2='0.00';
            }
            
            
            $html.='<br/>
            
            <b><u><h4>Payment Due In Respect Of:</h4></u></b><br/>
            <p style="font-family:;font-size:12px;margin-top:-25px;">Private :<font color="gray" size="12px"> R '. number_format($Private,2,'.',' ').'</font></p><br/>
            <p style="font-family:;font-size:12px;margin-top:-25px;">Excess 1 :<font color="gray" size="12px"> R '. $Exc.'</font></p><br/>
            <p style="font-family:;font-size:12px;margin-top:-25px;">Excess 2 :<font color="gray" size="12px"> R '. number_format($Excess_2,2,'.',' ').'</font></p><br/>
            <br/><br/>
            <p style="font-size:12px;margin-top:-25px;margin-top:-25px;">'.strtoupper($Owner).' hereby declare that the repairs to the above mentioned vehicle rendered necessary as the result
             of an accident
            have been carried out to my/our complement certification as per the authorised quote between
            the insurance company/assessor
            and the Motor Accident Group   </p>
            <br/>
            <p style="font-size:12px;margin-top:-25px;margin-top:-25px;">'.strtoupper($Owner).' herby declare that we have recieved the above 
            mentioned vehicle from the Motor Accident Group</p><br/>
            
            <p style="font-size:12px;margin-top:-25px;margin-top:-25px;">'.strtoupper($Owner).' understand that the following guarantees will apply</p><br/>';
            
            
            $Manufacturer ="Manufacturer's";
            $suppliers    ="merchant's";
            $html.='<table style="width:100%;font-size:12px;">
            <tr><td style="width:150px;">Parts Warranty   :</td> <td>Warranty as per '.$suppliers.' documentation.</td></tr>
             <tr><td></td><td></td></tr>
             
            <tr>
            <td style="width:150px;">Workmanship Warranty :</td> <td>
            Motor Accident Group hereby guarantees the proper and complete execution of the workmanship in accordance with the 
            specifications and instructions of the manufacturer and shall be free of defects for a period  of 12 months. This warranty
            does not include normal wear and tear and/or product abuse.
            </td></tr>
            
            <tr><td></td><td> </td></tr>
             
             
            <tr><td style="width:150px;">Paint Warranty   :</td> <td>Auth paint work is free from defects with a life time warranty</td></tr>
             <tr><td></td><td></td></tr>
             
            <tr><td style="width:150px;">Rust Warranty   :</td> <td>12 months or  balance of factory warranty </td></tr>
             <tr><td></td><td></td></tr>
             
            </table><br/><br><br><br><br>';
            
            $image = "____________________________";
            $fdate = "____________________________";
            $pname = "____________________________";
            $html.='<table style="font-size:12px;">
            <tr><td style="width:150px;"> Date </td><td>: '.$fdate.'</td></tr>
            </table>
            <br/>';
            $html.='<table style="font-size:12px;">
            <tr><td style="width:150px;"> Print name </td><td>: '.$pname.'</td></tr>
            </table><br/>';
            $html.='<table style="font-size:12px;">
            <tr><td style="width:150px;"> Signature  </td><td>: '.$image.' </td></tr>
            </table>';

            $pdf=PDF::loadview('pdf.clearance',['table'=>$html]);
            return $pdf->stream(''.$id.'Clearance Certificate.pdf');  
        }

        public function non_approved_repair(){
            $pdf=PDF::loadview('pdf.nonapprovedrepair');
            return $pdf->stream('Non Approved Repair.pdf'); 
        }

        public function security_check($ref){
            $reg = '';
$make = '';
$model = '';
$name = '';
$kms = '';
$chass = '';
$usa = '';
$checkdate = '';

//checklist......
$tyer_rf_make   = '';
$tyer_rf_status = '';

$tyer_lf_make   = '';
$tyer_lf_status = '';

$tyer_rr_make	= '';
$tyer_rr_status	= '';

$tyer_lr_make   = '';
$tyer_lr_status = '';

$s_wheel        = '';
$s_wheel_make   = '';
$s_wheel_status = '';

$mag_lf_descr   = '';
$mag_lf_scratch = '';

$mag_lr_descr   = '';
$mag_lr_scratch = '';

$mag_rf_descr   = '';
$mag_rf_scratch = '';

$mag_rr_descr   = '';
$mag_rr_scratch = '';

$light_lf_status= '';
$light_rf_status= '';
$light_lr_status= '';
$light_rr_status= '';

$indi_lf_status = '';
$indi_rf_status = '';
$indi_lr_status = '';
$indi_rr_status = '';

$mirr_lf_status = '';
$mirr_rf_status = '';

$upho_lf_status = '';
$upho_lf_stain  = '';

$upho_rf_status = '';
$upho_rf_stain  = '';

$upho_lr_status = '';
$upho_lr_stain  = '';

$upho_rr_status = '';
$upho_rr_stain  = '';

$comment = '';
$a1 = '';
$a2 = '';
$a3 = '';
$a4 = '';
$a5 = '';
$a6 = '';
$a7 = '';
$a8 = '';
$a9 = '';

$b1  = '';
$b2  = '';
$b3  = '';
$b4  = '';
$b5  = '';
$b6  = '';
$b7  = '';
$b8  = '';
$b9  = '';

$result = DB::select("select * from client_details where Key_Ref=?",[$ref]);
foreach($result as $row)
{
    $reg = strtoupper($row->Reg_No);
    $make = strtoupper($row->Make);
    $model = strtoupper($row->Model);
    $name = strtoupper($row->Fisrt_Name." ".$row->Last_Name);
    $kms = $row->KM;
    $chass = strtoupper($row->Chasses_No);
	$chk  = strtoupper($row->checklist_by);
}
$result_ = DB::select("select * FROM security_checklist WHERE Key_Ref=?",[$ref]);
if(count($result_)>0){
    foreach($result_ as $row)
    {
        $usa = strtoupper($row->user);
        $checkdate = $row->check_date;
        //checklist......................
        $tyer_rf_make   = $row->tyer_rf_make;
        $tyer_rf_status = $row->tyer_rf_status;

        $tyer_lf_make   = $row->tyer_lf_make;
        $tyer_lf_status = $row->tyer_lf_status;

        $tyer_rr_make	= $row->tyer_rr_make;
        $tyer_rr_status	= $row->tyer_rr_status;

        $tyer_lr_make   = $row->tyer_lr_make;
        $tyer_lr_status = $row->tyer_lr_status;

        $s_wheel        = $row->s_wheel;
        $s_wheel_make   = $row->s_wheel_make;
        $s_wheel_status = $row->s_wheel_status;

        $mag_lf_descr   = $row->mag_lf_descr;
        $mag_lf_scratch = $row->mag_lf_scratch;

        $mag_lr_descr   = $row->mag_lr_descr;
        $mag_lr_scratch = $row->mag_lr_scratch;

        $mag_rf_descr   = $row->mag_rf_descr;
        $mag_rf_scratch   = $row->mag_rf_scratch;

        $mag_rr_descr   = $row->mag_rr_descr;
        $mag_rr_scratch = $row->mag_rr_scratch;

        $light_lf_status= $row->light_lf_status;
        $light_rf_status= $row->light_rf_status;
        $light_lr_status= $row->light_lr_status;
        $light_rr_status= $row->light_rr_status;

        $indi_lf_status = $row->indi_lf_status;
        $indi_rf_status = $row->indi_rf_status;
        $indi_lr_status = $row->indi_lr_status;
        $indi_rr_status = $row->indi_rr_status;

        $mirr_lf_status = $row->mirr_lf_status;
        $mirr_rf_status = $row->mirr_rf_status;

        $upho_lf_status = $row->upho_lf_status;
        $upho_lf_stain  = $row->upho_lf_stain;

        $upho_rf_status = $row->upho_rf_status;
        $upho_rf_stain  = $row->upho_rf_st;

        $upho_lr_status = $row->upho_lr_status;
        $upho_lr_stain  = $row->upho_lr_stain;

        $upho_rr_status = $row->upho_rr_status;
        $upho_rr_stain  = $row->upho_rr_stain;

        $comment = $row->c;

        $a1 = $row->A1;
        $a2 = $row->A2;
        $a3 = $row->A3;
        $a4 = $row->A4;
        $a5 = $row->A5;
        $a6 = $row->A6;
        $a7 = $row->A7;
        $a8 = $row->A8;
        $a9 = $row->A9;

        $b1  = $row->B1;
        $b2  = $row->B2;
        $b3  = $row->B3;
        $b4  = $row->B4;
        $b5  = $row->B5;
        $b6  = $row->B6;
        $b7  = $row->B7;
        $b8  = $row->B8;
        $b9  = $row->B9;
    }
}else{
    $image = "img/vehicle_str.png";
}
$image = "img/vehicle_str.png";
$html = '
<table>
        <tr>
            <td style="width:100">
                <table>
                    <tr><td style="font-size:16;text-align:center"><b>M.A.G</b></td></tr>
                    <tr><td style="font-size:8;text-align:center">Motor Accident Group</td></tr>
                </table>
            </td>
            <td  style="width:30"></td>
            <td  style="width:450">
                <table style="font-size:8">
                    <tr>
                        <td  style="width:70"><b>Registration</b></td>
                        <td style="color:gray;width:150">:'.$reg.'</td>
                        <td  style="width:80"><b>Odometer</b></td>
                        <td style="color:gray">:'. $kms.'</td>
                    </tr>
                    <tr>
                        <td><b>Vehicle Make</b></td>
                        <td style="color:gray">: '.$make.'</td>
                        <td><b>Chasses Number</b></td>
                        <td style="color:gray">: '.$chass.'</td>
                    </tr>
                    <tr>
                        <td><b>Vehicle Model</b></td>
                        <td style="color:gray">: '.$model.'</td>
                        <td><b>Checklist By</b></td>
                        <td style="color:gray">:'.$chk.'</td>
                    </tr>
                    <tr>
                        <td><b>Client Name</b></td>
                        <td style="color:gray">: '.$name.'</td>
                        <td><b>Checklist Date</b></td>
                        <td style="color:gray">: '.$checkdate.'</td>
                    </tr>
                </table>
            </td>
        </tr>     
</table>
<br>
<hr>
<h4 style="text-align:center;font-size:10"><b>Security Checklist On Vehicle '.$reg.'</b></h4>
<br>
<table style="font-size:8;margin-left:-50px;" cellspacing="1" >
    <tr>
        <td style="width:40;text-align:right"><b>Tyres</b></td>
        <td style="width:120;"><b>Make</b></td>
        <td style="width:120"><b>Status</b></td>
        <td style="width:50;text-align:right"><b>Upholstry</b></td>
        <td style="width:120"><b>Status</b></td>
        <td style="width:120"><b>Stained</b></td>
    </tr>
    <tr>
        <td style="width:40;text-align:right;color:gray"><b>R/F</b></td>
        <td style="border:1px solid #333"> '.$tyer_rf_make.'</td>
        <td style="border:1px solid #333"> '.$tyer_rf_status.'</td>
        <td style="width:50;text-align:right;color:gray"><b>R/F</b></td>
        <td style="border:1px solid #333">'.$upho_rf_status.'</td>
        <td style="border:1px solid #333">'.$upho_rf_stain.'</td>
    </tr>
    <tr>
        <td style="width:40;text-align:right;color:gray"><b>L/F</b></td>
        <td style="border:1px solid #333"> '.$tyer_lf_make.'</td>
        <td style="border:1px solid #333"> '.$tyer_lf_status.'</td>
        <td style="width:50;text-align:right;color:gray"><b>L/F</b></td>
        <td style="border:1px solid #333">'.$upho_lf_status.'</td>
        <td style="border:1px solid #333">'.$upho_lf_stain.'</td>
    </tr>
    <tr>
        <td style="width:40;text-align:right;color:gray"><b>R/R</b></td>
        <td style="border:1px solid #333">'.$tyer_rr_make.'</td>
        <td style="border:1px solid #333"> '.$tyer_rr_status.'</td>
        <td style="width:50;text-align:right;color:gray"><b>R/R</b></td>
        <td style="border:1px solid #333">'.$upho_rr_status.'</td>
        <td style="border:1px solid #333">'.$upho_rr_stain.'</td>
    </tr>
    <tr>
        <td style="width:40;text-align:right;color:gray"><b>L/R</b></td>
        <td style="border:1px solid #333"> '.$tyer_lr_make.'</td>
        <td style="border:1px solid #333"> '.$tyer_lr_status.'</td>
        <td style="width:50;text-align:right;color:gray"><b>L/R</b></td>
        <td style="border:1px solid #333">'.$upho_lr_status.'</td>
        <td style="border:1px solid #333">'.$upho_lr_stain.'</td>
    </tr>
</table>
<br>
<table style="font-size:8;margin-left:-50px;" cellspacing="2">
    <tr>
        <td style="width:40;text-align:right"><b>MAG</b></td>
        <td style="width:120"><b>Description</b></td>
        <td style="width:120"><b>Status</b></td>
        <td style="width:5">&nbsp;</td>
        <td style="width:120;text-align:right"><b>Accessories</b></td>
        <td style="width:120"><b>Status</b></td>
    </tr>
    <tr>
        <td style="width:40;text-align:right;color:gray"><b>R/F</b></td>
        <td style="border:1px solid #333">'.$mag_rf_descr.'</td>
        <td style="border:1px solid #333">'.$mag_rf_scratch.'</td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>Radio</b></td>
        <td style="border:1px solid #333">'.$a1.'</td>
    </tr>
    <tr>
        <td style="width:40;text-align:right;color:gray"><b>L/F</b></td>
        <td style="border:1px solid #333">'.$mag_lf_descr.'</td>
        <td style="border:1px solid #333">'.$mag_lf_scratch.'</td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>Radio Face</b></td>
        <td style="border:1px solid #333">'.$a2.'</td>
    </tr>
    <tr>
        <td style="width:40;text-align:right;color:gray"><b>R/R</b></td>
        <td style="border:1px solid #333">'.$mag_rr_descr.'</td>
        <td style="border:1px solid #333">'.$mag_rr_scratch.'</td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>CD Shuttle</b></td>
        <td style="border:1px solid #333">'.$a3.'</td>
    </tr>
    <tr>
        <td style="width:40;text-align:right;color:gray"><b>L/R</b></td>
        <td style="border:1px solid #333">'.$mag_lr_descr.'</td>
        <td style="border:1px solid #333">'.$mag_lr_scratch.'</td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>CD Player</b></td>
        <td style="border:1px solid #333">'.$a4.'</td>
    </tr>
    <tr>
        <td style="width:20;text-align:left"><b>Sp Whl</b></td>
        <td style="width:80"><b>Make</b></td>
        <td style="width:120"><b>Status</b></td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>Aerial</b></td>
        <td style="border:1px solid #333">'.$a5.'</td>
    </tr>
    <tr>
        <td style="border:1px solid #333">'.$s_wheel.'</td>
        <td style="border:1px solid #333">'.$s_wheel_make.'</td>
        <td style="border:1px solid #333">'.$s_wheel_status.'</td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>Battery</b></td>
        <td style="border:1px solid #333">'.$a6.'</td>
    </tr>
    <tr>
        <td style="width:40;text-align:right"></td>
        <td style="width:120;text-align:right"><b>Lights</b></td>
        <td style="width:120"><b>Status</b></td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>Keys</b></td>
        <td style="border:1px solid #333">'.$a7.'</td>
    </tr>
    <tr>
        <td></td>
        <td style="color:gray;text-align:right"><b>L/F</b></td>
        <td style="border:1px solid #333">'.$light_lf_status.'</td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>Service Book</b></td>
        <td style="border:1px solid #333">'.$a8.'</td>
    </tr>
    <tr>
        <td></td>
        <td style="color:gray;text-align:right"><b>R/F</b></td>
        <td style="border:1px solid #333">'.$light_rf_status.'</td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>Back Board</b></td>
        <td style="border:1px solid #333">'.$a9.'</td>
    </tr>
    <tr>
        <td></td>
        <td style="color:gray;text-align:right"><b>L/R</b></td>
        <td style="border:1px solid #333">'.$light_lr_status.'</td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>W/Spanner</b></td>
        <td style="border:1px solid #333">'.$b1.'</td>
    </tr>
    <tr>
        <td></td>
        <td style="color:gray;text-align:right"><b>R/R</b></td>
        <td style="border:1px solid #333">'.$light_rr_status.'</td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>Tools</b></td>
        <td style="border:1px solid #333">'.$b2.'</td>
    </tr>
    <tr>
        <td style="width:40;text-align:right"></td>
        <td style="width:120;text-align:right"><b>Indictator</b></td>
        <td style="width:120"><b>Status</b></td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>Jack</b></td>
        <td style="border:1px solid #333">'.$b3.'</td>
    </tr>
    <tr>
        <td></td>
        <td style="color:gray;text-align:right"><b>L/F</b></td>
        <td style="border:1px solid #333">'.$indi_lf_status.'</td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>Triangle</b></td>
        <td style="border:1px solid #333">'.$b4.'</td>
    </tr>
    <tr>
        <td></td>
        <td style="color:gray;text-align:right"><b>R/F</b></td>
        <td style="border:1px solid #333">'.$indi_rf_status.'</td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>Lock Nut</b></td>
        <td style="border:1px solid #333">'.$b5.'</td>
    </tr>
    <tr>
        <td></td>
        <td style="color:gray;text-align:right"><b>L/R</b></td>
        <td style="border:1px solid #333">'.$indi_lr_status.'</td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>Gear Lock</b></td>
        <td style="border:1px solid #333">'.$b6.'</td>
    </tr>
    <tr>
        <td></td>
        <td style="color:gray;text-align:right"><b>R/R</b></td>
        <td style="border:1px solid #333">'.$indi_rr_status.'</td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>Cig Lighter</b></td>
        <td style="border:1px solid #333">'.$b7.'</td>
    </tr>
    <tr>
        <td style="width:40;text-align:right"></td>
        <td style="width:120;text-align:right"><b>Mirror</b></td>
        <td style="width:120"><b>Status</b></td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>Car Mats</b></td>
        <td style="border:1px solid #333">'.$b8.'</td>
    </tr>
    <tr>
        <td></td>
        <td style="color:gray;text-align:right"><b>L/F</b></td>
        <td style="border:1px solid #333">'.$mirr_lf_status.'</td>
        <td style="width:5">&nbsp;</td>
        <td style="color:gray;text-align:right"><b>Centre Caps</b></td>
        <td style="border:1px solid #333">'.$b9.'</td>
    </tr>
    <tr>
        <td></td>
        <td style="color:gray;text-align:right"><b>R/F</b></td>
        <td style="border:1px solid #333">'.$mirr_rf_status.'</td>
        <td style="width:5">&nbsp;</td>
        <td ><b>&nbsp;</b></td>
        <td ><b>&nbsp;</b></td>
    </tr>
</table>
<br><br>';
$html.='<img src="'.$image.'" height="200px" width="400px" style="margin-left:150px;">';
$html.='<h5 style="color:silver;text-align:center"><b>Comments</b></h5>
<p style="font-size:12">'.$comment.'</p>';
            $pdf=PDF::loadview('pdf.securitycheck',['table'=>$html]);
            return $pdf->stream(''.$ref.'Security Checklist.pdf'); 
        }

        public function release_payment($id){
            

		
            $result = DB::select("select * FROM insurer Where Key_Ref=?",[$id]);
            
            if (count($result) > 0) { 
            foreach($result as $row1){
                $Claim_NO 		= $row1->Claim_NO;
                $rateTable		= $row1->rateTable;
            }
            }else{
                $Claim_NO 		= 'Not specifired';
            }
            $DR_NO ='';
            $result = DB::select("select * FROM client_details Where Key_Ref=?",[$id]);
            
            if (count($result) > 0) { 
            foreach($result as $row){
                $DR_NO		= $row->Key_Ref;
                $date 		= $row->Date;
                $Owner 		= $row->Fisrt_Name." ".$row->Last_Name;
                $vehicle 	= $row->Make." ".$row->Model;
                $regNo		= $row->Reg_No;
                $tel		= $row->Cell_number;
                $Repair_type= $row->Repair_Type;
                
                $Make 	= $row->Make;
                
                //$tel		= $row['Cell_number'];
                $Chasses_No	= $row->Chasses_No;
            }
            }else{
                $date 		= 'Not specifired';
                $Owner 		= 'Not specifired';
                $vehicle 	= 'Not specifired';
                $regNo		= 'Not specifired';
                $tel		= 'Not specifired';
                
            }
            $insphn = '';
            $ins = '';
            $asse = '';
            $clmNo = '';
            $result_ = DB::select("select * from insurer where Key_Ref =?",[$id]);
            foreach($result_ as $row)
            {
                $ins= $row->Inserer;
                $insphn= $row->Phone;
                $asse= $row->Assessor;
                $clmNo= $row->Claim_NO;
            }
            $test='';
            $html=
            '
            <table style="margin-bottom:10px;">
            <tr>
            <td rowspan="6" style="width:200px;text-align:center;">
            <p style="font-size:12px;font-weight:bold;">M.A.G</p>
            <p style="font-size:12px;font-weight:bold;">Motor Accident Group</p>
            <p style="font-size:12px;font-weight:bold;">PAYMENT RECIEPT</p>
            <p style="font-size:12px;">INVOICE NO : '.$DR_NO.'</p>	
            
            </td> 
            <td>&nbsp;</td>  
            <td style="font-family:arial;font-size:12px; width:70px;text-align:right;"> &nbsp;</td> 
            <td style="font-family:arial;font-size:12px;"> &nbsp;</td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td> 
            <td style="font-family:arial; color:gray; font-size:10px; width:250px;text-align:right;">Selby </td> 
            <td style="font-family:arial; color:gray; font-size:10px;"> : +27(010)591 7550 </td>
            </tr>
            
            <tr>
            <td>&nbsp;</td> 
            <td>&nbsp;</td>
            <td style="font-family:arial; color:gray; font-size:10px;text-align:right;">Longmeadow </td>
            <td style="font-family:arial; color:gray; font-size:10px;"> : +27(010)500 0350 </td>
            </tr>
            
            <tr>
            <td>&nbsp;</td>  
            <td>&nbsp;</td>
            <td style="font-family:arial; color:gray; font-size:10px;text-align:right;">The Glen </td>
            <td style="font-family:arial; color:gray; font-size:10px;"> : +27(011)432 0163 </td>
            
            </tr>
            
            
            <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>  
            <td style="font-family:arial; color:gray; font-size:10px; width:70px;text-align:right;">Email </td> 
            <td style="font-family:arial; color:gray; font-size:10px;"> : info@motoraccidentgroup.co.za </td></tr>
            
            <tr>
            <td>&nbsp;</td>   
            <td>&nbsp;</td>
            <td style="font-family:arial; color:gray; font-size:10px; width:70px;text-align:right;">Website </td> 
            <td style="font-family:arial; color:gray; font-size:10px;"> : www.motoraccidentgroup.co.za </td>
            </tr>
            </table>';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            
            $html.=
            '<table style="border:solid 1px gray;width:100%;color:gray;text-align:center;">
            <tr>
            <td style="font-size:16px;"> <b>Panel Beating .</b> <b>Spray Paint .</b>  <b>Aluminium Repair.</b>  <b>Heavy Commercial .</b>  <b>Light Commercials </b>
            
            </td>
            </tr>
            </table>';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            
            $html.='
            
            <table style="font-size:12px;margin-top:-1px;border: solid 1px gray">
            <tr>
            <td style="width:80;"> CLIENT</td>
                <td style="color:gray; width:200;"> : <i>'.$Owner.'</i></td>
            <td style="width:80;"> TEL NO</td><td style="color:gray; width:152"> : <i>'.$tel.'</i></td>
            </tr>
            <tr>
            <td> MAKE & MODEL</td>
            <td style="color:gray; width:200;"> : <i>'.$vehicle.'</i></td>
            <td> REG NO</td><td style="color:gray;"> : <i>'.$regNo.'</i></td>	
            </tr>
            <tr>
            <td> INSURER</td>
            <td style="color:gray; width:200;"> : <i>'.$ins.'</i></td>
            <td> ASSESSOR</td><td style="color:gray;"> : <i>'.$asse.'</i></td>	
            </tr>
            <tr>
            <td> INSURER PHONE</td>
            <td style="color:gray; width:200;"> : <i>'.$insphn.'</i></td>
            <td> CLAIM NUMBER</td><td style="color:gray; width:152;"> : <i>'.$clmNo.'</i></td>	
            </tr>
            </table>
            </p><br/>';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            
            
            //$no = $_GET['no'];
            $result4 	= DB::select("select * FROM betterment where Key_Ref =?",[$id]);
            
            
            if (count($result4)> 0) {
            
            foreach($result4 as $row2){
                if(isset($row2->Excess_1)){
                    $Exc	=	 $row2->Excess_1;
                }else{
                    $Exc	=0.00;
                }
                 $Deposit		=	$row2->Deposit;
                 $Private		=	$row2->Private_work;
                 $Excess_2      =	$row2->Excess_2;
                 $betterment    =	$row2->Betterment;
                 $Additional    =	$row2->Additional_1;
                 $Additional_3  = $row2->Additional_3;
                 $TotalAmount 	=  	$row2->TotalAmount;
                 if($row2->status=='CARD'){
                      $status 	=  strtoupper (''.$row2->status .'');
                      $card = $row2->status;
                 }
                if($row2->status=='CASH'){
                      $status 	=  ''.$row2->status;
                      $cash	= $row2->status;
                 }
                if($row2->status=='EFT (Including 14% Vat)'){
                      $status 	=  strtoupper (''.$row2->status .'');
                      $eft =  $row2->status; 
                 }
                 $date 			=  	$row2->date;
                 $user 			=  	$row2->user;
                     $subTotal=$Additional_3 + $Additional + $Deposit + $betterment + $Exc +  $Excess_2 + $Private;	 
            
            if(($row2->status  == 'CARD')){
                $PaymentType= 5/100;
                $TotalS=($Additional_3 + $Additional + $Deposit + $betterment + $Exc +  $Excess_2 + $Private)*$PaymentType;
                //$subTotal=$Additional_3 + $Additional + $Deposit + $betterment + $Exc +  $Excess_2 + $Private+$creditCard;
            $total=$subTotal+$TotalS;
            
            }
            }
            }else{
                 $Deposit	=   0.00;
                 $Private	=   0.00;
                 $Excess_2      =   0.00;
                 $betterment    =   0.00;
                 $Additional    =   0.00;
                 $Additional_3  =   0.00;
                 $TotalAmount 	=   0.00;
                 $Exc           =   0.00;
            }
            
            $subTotal = $Additional_3 + $Additional + $Deposit + $betterment + $Exc +  $Excess_2 + $Private;	 
            
            
                if($TotalAmount<1){
                 $TotalAmount = $Deposit;
                }
            
                   
            $result4     = DB::select("select * FROM payments where Key_Ref =?",[$id]);
            
            $balance		=0;
            $amountPaid1 	=0;
            $balance1 		=0;
            $count			=1;
            if (count($result4) > 0) {
            foreach($result4 as $row2){
                $amountPaid1+= $row2->amount;
                $balance1 	+= $row2->amount;
            $test='
            <table>
            <tr>
                <td style="width:180px;">'.$row2->date.'<font color="gray">
                <i>[  '.$row2->status.' ]</i></font>
                </td>	
                <td style="color:gray; width:100px;font-family:arial;"> R '. number_format( $row2->amount,2,'.',' ').'  </td>	
            </tr>
            </table>';	
            $count	++;
            ///$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            }
            }else{
                $amountPaid1 	=0.00;
                $balance1 		=0.00;
            }
            $html.=
            '<table style="font-size:12px;">
            <tr>
                <td style="background-color:white;color:black;width:180px;">
                
                </td>	
                
                <td style="color:gray;width:180px;font-family:arial;"> 
                
                </td>	
            </tr>
            <tr>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td style="background-color:white;color:black;width:180px;">TOTAL AMOUNT PAID</td>	
                <td style="color:gray; width:100px;font-family:arial;"><hr/>
                R '. number_format( $balance1,2,'.',' ').'<hr/>
                </td>	
            </tr>
            
            <tr>
                <td style="background-color:white; color: black;  width:180px;">Excees 1</td>	
                <td style="color:gray; width:100px;font-family:arial;"><hr/>
                R '. number_format( $Exc,2,'.',' ').'<hr/>
                </td>	
                
                    <td style="background-color:white; color:black ;  width:120px;">Private Work</td>	
                <td style="color:gray; width:100px;font-family:arial;"><hr/>
                R '. number_format( $Private,2,'.',' ').'<hr/>
                </td>
            </tr>
            
            
            <tr>
                <td style="background-color:white; color:black ;  width:180px;">Excess 2</td>	
                <td style="color:gray; width:100px;font-family:arial;"><hr/>
                R '. number_format( $Excess_2,2,'.',' ').'<hr/>
                </td>	
                
                        <td style="background-color:white; color:black ;  width:120px;">Additional Work</td>	
                <td style="color:gray; width:100px;font-family:arial;"><hr/>
                R '. number_format( $Additional,2,'.',' ').'<hr/>
                </td>
            </tr>
            
            <tr>
                <td style="background-color:white; color: black;  width:180px;">Betterment</td>	
                <td style="color:gray; width:100px;font-family:arial;"><hr/>
                R '. number_format( $betterment,2,'.',' ').'<hr/>
                </td>	
                
                        <td style="background-color:white; color:black ;  width:120px;">Other Work</td>	
                <td style="color:gray; width:100px;font-family:arial;"><hr/>
                R '. number_format( $Additional_3,2,'.',' ').'<hr/>
                </td>
            </tr>
            
            <tr>
                <td style="background-color:white; color: black;  width:180px;">TOTAL AMOUNT</td>	
                <td style="color:gray; width:100px;font-family:arial;"> R '. number_format($subTotal,2,'.',' ').'  </td>	
            </tr>
            
            <tr>
                <td style="background-color:white; color: black;  width:180px;">BALANCE DUE</td>	
                
                <td style="color:gray; width:100px;font-family:arial;"> R '. number_format($subTotal-$balance1,2,'.',' ').'  </td>	
            </tr>
            
            
            </table><br/>';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            
            $res 	= DB::select("select * FROM quality_control_check_list WHERE Key_Ref=?",[$id]);
             	
            $status ='';
            if (count($res) > 0) {
                
            foreach($res as $row){ 
            
            $Remarks = $row->Comment;//VARIABLE INITIALISED
            }
                }else{
                    $Remarks ='';
                }
            
            
            $SUPPLIER= "SUPPLIER'S";
            $html.='
            <table style="border: solid 1px black;width:100%;font-size:12px;">
              <tr>
                <td style="width:27%; color:black;">WORKMANSHIP</td>
                    <td style="color:black; width:600px;">: 12 (MONTHS)</td>
              </tr>
              <tr>
                <td style="color:black;">PARTS</td>
                <td style="color:black;">: WARRANTY AS PER '.$SUPPLIER.' DOCUMENTATION</td>
              </tr>
              <tr>
                <td style="color:black;">PAINTWORK:</td>
                <td style="color:black;">: ALL PAINTWORK IS GUARANTEED FOR A LIFETIME</td>
             </tr>
             <tr>
                <td rowspan="2" colspan="2" style="border-top:solid 2px gray;">
                <b>Remarks</b> : <font color="gray"> <i>'.$Remarks.'</i></font>
                </td>
            </tr>
            
            
            </table>';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            
            /*
            MAG TERMS AND CONDITIONS BELOW
            TABLE STYLE
            */
            $style = '"';
            $on=" owner's";
            $msg='
            <table style="font-size:10px; color:gray;border:solid 2px gray;width:100%;">
            <tr><td>&nbsp;</td><td&nbsp;></td></tr>
            <tr><td colspan="2" style="text-align:center;font-size:12px;"><u>Terms And Conditions</u></td></tr>
            <tr><td style="width:23px;"></td><td style="width:87%;"></td></tr>
            <tr><td><b>1</b></td><td>All vehicles  remains the property of Motor Accident Group untill paid in full</td></tr>
            <tr><td><b>2</b></td><td>M.A.G Quotation is valid for 30 days and does not include hidden or latents defects</td></tr>
            <tr><td><b>3</b></td><td>M.A.G will take no responsibility for loss due to fire or theft unforeseen circumstances</td></tr>
            <tr><td><b>4</b></td><td>M.A.G will take no responsibility for all glass that is removed and fitted at the vehicle'.$on.' risk</td></tr>
            <tr><td><b>5</b></td><td>M.A.G will take no responsibility for Alarm, Cameras, SD cards that are left in the vehicle: this is vehicle '.$on.' responsibility</td></tr>
            <tr><td><b>6</b></td><td>Insurance Excess and Payments is payable in cash before vehicle release</td></tr>
            <tr><td><b>7</b></td><td>Credit Card transaction are subject to 5% transaction fee</td></tr>
            <tr><td><b>8</b></td><td>The storage is charged for light commercial at R250/day</td></tr>
            <tr><td><b>9</b></td><td>Storage is charged for heavy commercial at R455/day</td></tr>
            <tr><td><b>10</b></td><td>No work will commence without a signed quotation and payments reflecting a 30% in our account </td></tr>
            <tr><td><b>11</b></td><td>By signing this quotation the client agrees to the terms and conditions of sale and payments terms</td></tr>
            <tr><td><b>12</b></td><td>60 days after completion - vehicle will be sold for defray cost</td></tr>
            <tr><td><b>13</b></td><td>Insurance companies without Service Level Agreement are not allowed to Audit</td></tr>
            <tr><td><b>14</b></td><td>Insurance companies are not allowed discount without signed Service Level Agreement</td></tr>
            <tr><td><b>15</b></td><td>If goods are of inferior quality, unsafe or defective the consumer may return the product within
            a period of six months at the<br/> expense of the supplier</td></tr>
            <tr><td><b>16</b></td><td>Suppliers are obliged to repair, refund or replace the failed, defective or unsafe products.</td></tr>
            <tr><td>17)</td><td>Payments to be done to  <b>First National Bank: 62616112827 Branch Code 250655 or  </b></td></tr>
            <tr><td>18)</td><td>Payments to be done to  <b>Starndard Bank: 281711623 Branch Code 051100</b></td></tr>
            <tr><td>19)</td><td>All proof of payments to be emailed to <b>info@motoracccidentgroup.co.za</b></td></tr>
            <tr><td>20)</td><td>Insurance Assessors are not allowed a 5% settlement without SLA in place</td></tr>
            <tr><td>21)</td><td>Costings to be signed by assessor prior to delivery as per company terms and conditions repair times - Subject to Costings</td></tr>
            <tr>
            <td>
            22)
            </td>
            <td>
            If a vehicle is insured the owner of the vehicle shall remain liable for the repair, salvage and storage costs until the insurer makes payments of such costs.
            </td>
            </tr>
            </table><br><br>';
            
            
            $html .= ''.$msg;
            //$pdf->writeHTML($html, true, false, false, false, '');
            //$total70 = (70/100) * $total;
            //$total30 = (30/100) * $total;
            
            $html .= '<br><table style="font-size:10px; color:gray;border:solid 2px gray;width:100%;">
            <tr><td></td><td></td></tr>
            <tr><td colspan="2"><u>Banking Details</u></td></tr>
            <tr><td colspan="2" style="font-size:8px; color:green;  font-family: "Times New Roman", Times, serif;><i>To facilitate Payments please used the relevant Bank for release of a Vehicle Immediately</i></td></tr>
            <tr style="font-size:12px; color:green;"><td style="width:50%"><b><u>First National Bank </u></b></td><td style="width:50%;"><b><u>Standard Bank</u></b></td></tr>
            <tr><td colspan="2">&nbsp;</tr>
            <tr style="font-size:12px; color:gray;"><td> Cheque Account No:62616112827 </td><td>Cheque Account No :281711623</td></tr>
            <tr style="font-size:12px;color:gray;"><td>Branch:  Southdale (24-205)</td><td> Branch : 051001</td></tr>
            <tr style="font-size:12px;color:gray;"><td> For and behalf of : Motor Accident Group</td><td>For and behalf of : Motor Accident Group</td></tr>
            <tr><td colspan="2">&nbsp;</td></tr>
            </table><br><br>';
            //$pdf->writeHTML($html, true, false, false, false, '');		
            
            ///////////////////////////////////////////////////////////////////////signature
            //$path = "../../../../final_receipt/TCPDF/examples/doc_signs/".$id."/"."signature.png";
            
            //if(file_exists($path)){
            //$image = "SIGNATURE:".'<img src="'.$path.'" width="170px" height="25px">';	
            //}else{
            //$image = "SIGNATURE:_______________________";
            //}
            ///////////////////////////////////////////////////////////////////////// 
                    
            $html.='
            <br>
            <table style="border: solid 1px black; width:100%; height:70px;font-size:12px;" >
                
                <tr>
                        <td style="width:300px; color:black;" ></td>
                        <td style="width:90px; color:black;" >Date</td>
                        <td>: ________________________</td>
                </tr>
                <tr>
                        <td style="width:50px; color:black;" ></td>
                        <td style="width:50px; color:black;"> &nbsp;</td>
                        <td>&nbsp;</td>
                </tr>
                <tr>
                        <td style="width:300px; color:black;" ></td>
                        <td style="width:90px; color:black;">Recieved by </td>
                        <td>: ________________________</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
            </table>'.'<br/>'.'
            <table>
                <tr>
                
                        <td style="width:180px; color:black; font-size:7;">Customer care : (010)591 7550</td>
                        <td style="color:black; font-size:7;">C/K : 2006/056312/23</td>
            
                </tr>
            
            </table>
            <br><br>
            ';
            $pdf=PDF::loadview('pdf.releasepayment',['table'=>$html]);
            return $pdf->stream(''.$id.'Release Payment.pdf'); 
        }

        public function taxi_clearance($id){
            $insured    = '';
                $vehicle    = '';
                $reg        = '';
                $insurer    = '';
                $claim_no   = '';
                $excess     = '';
                $betterment = '';
            $taxis=DB::select("select a.RODATE,a.Fisrt_Name,a.Last_Name,a.Reg_No,a.Make,a.Model,b.Inserer,b.Claim_NO,c.Excess_1,c.Betterment
            FROM client_details a 
            INNER JOIN insurer b ON a.Key_Ref=b.Key_Ref
            LEFT JOIN betterment c ON b.Key_Ref=c.Key_Ref
            WHERE a.Key_Ref=?",[$id]);
            if(count($taxis)>0){
                foreach($taxis as $dbrow){
                
                $insured    = $dbrow->Fisrt_Name." ".$dbrow->Last_Name;
                $vehicle    = $dbrow->Make." ".$dbrow->Model;	
                $reg        = $dbrow->Reg_No;
                $insurer    = $dbrow->Inserer;
                $claim_no   = $dbrow->Claim_NO;
                $excess     = $dbrow->Excess_1;
                $betterment = $dbrow->Betterment;
                }	
                }
            $pdf=PDF::loadview('pdf.taxiclearance',['key'=>$id,'insured'=>$insured,'vehicle'=>$vehicle,'reg'=>$reg,'insurer'=>$insurer,'claim_no'=>$claim_no,'excess'=>$excess,'betterment'=>$betterment]);
            return $pdf->stream(''.$id.'-SA Taxi Clearance.pdf'); 
        }

        public function old_mutual($id){
            $old_mutual=DB::select("select a.RODATE,a.Fisrt_Name,a.Last_Name,a.Reg_No,a.Email,a.Cell_number,a.Address_1,a.Address_2,a.Address_3,a.Date,b.Claim_NO
            FROM client_details a 
            INNER JOIN insurer b ON a.Key_Ref=b.Key_Ref
            LEFT JOIN betterment c ON b.Key_Ref=c.Key_Ref
            WHERE a.Key_Ref=?",[$id]);
            if(count($old_mutual)>0){
                foreach($old_mutual as $dbrow){
                
                $insured    = $dbrow->Fisrt_Name." ".$dbrow->Last_Name;
                $email      = $dbrow->Email;
                $claim_no   = $dbrow->Claim_NO;
                $cell       = $dbrow->Cell_number;
                $Address_1  = $dbrow->Address_1;
                $Address_2  = $dbrow->Address_2;
                $Address_3  = $dbrow->Address_3;
                $date  = $dbrow->Date;
                }	
                }
            $pdf=PDF::loadview('pdf.oldmutual',['key'=>$id,'insured'=>$insured,'email'=>$email,'claim_no'=>$claim_no,'cell'=>$cell,'Address_1'=>$Address_1,'Address_2'=>$Address_2,'Address_3'=>$Address_3,'date'=>$date]);
            return $pdf->stream(''.$id.'-Old Mutual.pdf');
        }
        public function customer_care_invoice(Request $request){
                $id          = $request->invoice_key;
                $inv_to      = $request->to;
                $inv_address = $request->address;
                $inv_vat     = $request->invoice_vat;
                $inv_desc    = $request->invoice_description;
                $inv_amount  = $request->invoice_amount;
                $inv_discount= $request->invoice_discount;
                $inv_date    = date('d-m-Y');
                $inv_time    = date('H:i:s');

                $key_ref     = 'N/A';
                $branch      = 'N/A';
                $Reg_No      = 'N/A';
                $Make        = 'N/A';
                $Model       = 'N/A';
                $Chasses_No  = 'N/A';
                $Inserer     = 'N/A';
                $Claim_NO    = 'N/A';
                $Excess_1    = 'N/A';
                $customer    = 'N/A';
                $address     = 'N/A';
                $city        = 'N/A';
                $code        = 'N/A';
                $vat_no      = 'N/A';

                       $dbquery   =DB::select("select a.Key_Ref,a.Fisrt_Name,a.Last_Name,a.Address_1,a.Address_2,a.Address_3,a.Vat_No,a.branch,a.Reg_No,a.Make,a.Model,a.Chasses_No,a.KM,b.Inserer,
                            b.Claim_NO,d.Excess_1,c.customer,c.address,c.city,c.code,c.vat_no
                            FROM client_details a 
                            INNER JOIN insurer b ON a.Key_Ref=b.Key_Ref
                            LEFT JOIN invoice_table c ON b.invoice_id=c.id
                            LEFT JOIN betterment d ON b.Key_Ref=d.Key_Ref
                            WHERE a.Key_Ref=?",[$id]);  
                

                if(count($dbquery)>0){
                foreach($dbquery as $dbrow){
                $key_ref     = $dbrow->Key_Ref;
                $branch      = $dbrow->branch;
                $Fisrt_Name  = $dbrow->Fisrt_Name;
                $Last_Name   = $dbrow->Last_Name;
                $Reg_No      = $dbrow->Reg_No;
                $Make        = $dbrow->Make;
                $Model       = $dbrow->Model;
                $Chasses_No  = $dbrow->Chasses_No;
                $Inserer     = $dbrow->Inserer;
                $Claim_NO    = $dbrow->Claim_NO;
                $Excess_1    = $dbrow->Excess_1;
                $customer    = $dbrow->customer;
                $address     = $dbrow->address;
                $city        = $dbrow->city;
                $code        = $dbrow->code;
                $vat_no      = $dbrow->vat_no;
                $Vat_No1     = $dbrow->Vat_No;
                $vin_no      = $dbrow->KM;

                $Address_1   = $dbrow->Address_1;
                $Address_2   = $dbrow->Address_2;
                $Address_3   = $dbrow->Address_3;

                }
                }else{
                $key_ref     = 'N/A';
                $branch      = 'N/A';
                $Reg_No      = 'N/A';
                $Make        = 'N/A';
                $Model       = 'N/A';
                $Chasses_No  = 'N/A';
                $Inserer     = 'N/A';
                $Claim_NO    = 'N/A';
                $Excess_1    = 'N/A';
                $customer    = 'N/A';
                $address     = 'N/A';
                $city        = 'N/A';
                $code        = 'N/A';
                $vat_no      = 'N/A';
                $vin_no      = 'N/A';   
                }			

                if($branch=="Selby"){
                $comp_name   = "M.A.G - Selby";
                $comp_place  = "Selby 2001";
                $comp_street = "80 Booysens RD";
                $comp_tel    = "010 591 7550";
                $comp_email   = "info@motoraccidentgroup.co.za";
                }elseif($branch=="Longmeadow"){
                $comp_name   = "M.A.G - Longmeadow";
                $comp_place  = "42 Longmeadow Boulevard";
                $comp_street = "Edenvale 1609";
                $comp_tel    = "010 500 0350";
                $comp_email  = "info@lm.motoraccidentgroup.co.za";
                }elseif($branch=="The Glen"){
                $comp_name   = "M.A.G - The Glen";
                $comp_place  = "Lois Avenue";
                $comp_street = "Glen Eagles, Glenanda 7945";
                $comp_tel    = " 011 432 0163";
                $comp_email  = "info@glen.motoracidentgroup.co.za";
                }elseif($branch=="Glen"){
                $comp_name   = "M.A.G - The Glen";
                $comp_place  = "Lois Avenue";
                $comp_street = "Glen Eagles, Glenanda 7945";
                $comp_tel    = " 011 432 0163";
                $comp_email  = "info@glen.motoracidentgroup.co.za";
                }else{
                $comp_name   = "M.A.G - Selby";
                $comp_place  = "Selby 2001";
                $comp_street = "80 Booysens RD";
                $comp_tel    = "010 591 7550";
                $comp_email   = "info@motoraccidentgroup.co.za";
                }
        $pdf=PDF::loadview('pdf.printinvoice',['key_ref'=>$key_ref,'branch'=>$branch,'Reg_No'=>$Reg_No,'Make'=>$Make,'Chassess_NO'=>$Chasses_No,'Inserer'=>$Inserer,'Claim_NO'=>$Claim_NO,'Excess_1'=>$Excess_1,'customer'=>$customer,'address'=>$address,'city'=>$city,'vat_no'=>$vat_no,'comp_name'=>$comp_name,'comp_place'=>$comp_place,'comp_street'=>$comp_street,'comp_tel'=>$comp_tel,'comp_email'=>$comp_email,'inv_to'=>$inv_to,'inv_address'=>$inv_address,'Model'=>$Model,'inv_vat'=>$inv_vat,'vin_no'=>$vin_no,'id'=>$id,'inv_desc'=>$inv_desc,'inv_amount'=>$inv_amount,'inv_discount'=>$inv_discount]);
            return $pdf->stream(''.$id.'-Invoice.pdf');
        }

        public function print_order(Request $request){
            

            $pdf=PDF::loadview('pdf.order');
            return $pdf->stream(''.$id.'-Order.pdf');
        }





          #UPDATE THE QUERIES HERE [ 12 MAY 2021 ]
          public function print_precosting($id){



            // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Nicola Asuni');
            $pdf->SetTitle('Precosting');
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
            
            // set default header data
            //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'Proforma Invoice', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
            
            $pdf->setFooterData(array(0,64,0), array(0,64,128));
            
            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            
            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            
            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            
            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            
            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            
            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }
            
            // ---------------------------------------------------------
            
            // set default font subsetting mode
            $pdf->setFontSubsetting(true);
            
            // Set font
            // dejavusans is a UTF-8 Unicode font, if you only need to
            // print standard ASCII chars, you can use core fonts like
            // helvetica or times to reduce file size.
            $pdf->SetFont('dejavusans', '', 8, '', true);
            
            // Add a page
            // This method has several options, check the source code documentation for more information.
            $pdf->AddPage();
            
            $key_ref=$id;
            
            
            $count = 1;
            $status='';
            //$add=0;
            $lndT = 0;
            $ptT = 0;
            $savT = 0;
            $actl = 0;
            $btmnt = 0;
            $btmnt_ = 0;
            $actual_priceT = 0;
            $tbl="";
            $tbl2="";
            $tblp2 = "";
            $tblp3 = "";
            $tblp2st= "";
            $html_2="";
            $actlttl = 0;
            $qtedttl = 0;
            $savettl = 0;
            $addttl = 0;
            $actlttl2 = 0;
            $qtedttl2 = 0;
            $savettl2 = 0;
            $addttl2 = 0;
            $actlttl3 = 0;
            $qtedttl3 = 0;
            $savettl3 = 0;
            $addttl3 = 0;
            $mark = 0;
            $counter=1;
            $counte = $count;
            
            $savTotal = 0;
            $AddTotal = 0;
            $QtTotal=0;
            $actTotal = 0;
            $atct = 0;
            $html_ = "";
            $qted2 = 0;
            $add2 = 0;
            $mark2 = '';
            $html_1='';
            $insurance='';
            $assessor='';
            $insured='';
            $claim='';
            $reg='';
            $ref='';
            $vehicle='';
            
            //Actual Query
            
            $sql_get=DB::select('select id,Percent,MarkUp,MarkUp2,Betterment,Quantity,Description,Key_Ref,Parts_sales,Part,Oper,Part,round(Part-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price  from qoutes where Key_Ref =? and qoute_type ="0" limit 0,40',[$id]);
            
                        $sql_get2=DB::select('select Discount,Discount2 from qoutes where  Key_Ref=? and qoute_type ="0"',[$id]);
                        $sql_client=DB::table('client_details')
                                               ->join('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                                               ->select('client_details.Reg_No','client_details.Model','client_details.Make','insurer.Claim_NO','insurer.Inserer','insurer.Assessor','insurer.Key_Ref')
                                               ->where('client_details.Key_Ref','=',$id)
                                               ->get();
            
               

            if(count($sql_client)>0){
            foreach($sql_client as $dbrow){
            
            $insurance=$dbrow->Inserer;
            $assessor=$dbrow->Assessor;
            $insured=$dbrow->Inserer;
            $claim=$dbrow->Claim_NO;
            $reg=$dbrow->Reg_No;
            $ref=$dbrow->Key_Ref;
            $vehicle=$dbrow->Make.' '.$dbrow->Model;
            
            }
            }
            
            $html = 
            '<h1 style="color:black;font-weight:bold;text-align:center;">Motor Accident Group</h1>
            <h4 style="text-align:center;">PRE COSTING</h4>
            <table style="font-size:8px;font-weight:bold;border-collapse:collapse;border: 1px solid black;width:100%;">
            <tr>
            <td style="border: solid 1px black;">Insurance</td>
            <td style="border: solid 1px black;">'.$insurance.'</td>
            <td style="border: solid 1px black;">Assessors</td>
            <td style="border: solid 1px black;">'.$assessor.'</td>
            </tr>
            <tr>
            <td style="border: solid 1px black;">Insured</td>
            <td style="border: solid 1px black;">'.$insured.'</td>
            <td style="border: solid 1px black;">Claim No.</td>
            <td style="border: solid 1px black;">'.$claim.'</td>
            </tr>
            <tr>
            <td style="border: solid 1px black;">Registration</td>
            <td style="border: solid 1px black;">'.$reg.'</td>
            <td style="border: solid 1px black;">Ref No.</td>
            <td style="border: solid 1px black;">'.$ref.'</td>
            </tr>
            <tr>
            <td style="border: solid 1px black;">Vehicle</td>
            <td style="border: solid 1px black;">'.$vehicle.'</td>
            <td style="border: solid 1px black;">Date</td>
            <td style="border: solid 1px black;"></td>
            </tr>
            </table><br><h2>Quoted</h2><br>';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            
            $html_1='<table>
                    <thead>
                        <tr style="font-weight:bold;font-size:8px;background-color:black;color:white;text-align:center;">
                            <th style="border: solid 1px black;" width="20px">No.</th>
                            <th style="border: solid 1px black;" width="80px">Part Description</th>
                            <th style="border: solid 1px black;" width="80px">Oper</th>
                            <th style="border: solid 1px black;" width="50px">Landing Price</th>
                            <th style="border: solid 1px black;" width="100px">Mark-Up</th>
                            <th style="border: solid 1px black;" width="60px">Betterment</th>
                            <th style="border: solid 1px black;" width="60px">Saving</th>
                            <th style="border: solid 1px black;" width="80px">Additional</th>
                            <th style="border: solid 1px black;" width="80px">Quoted Price</th>
                            <th style="border: solid 1px black;">Actual Price</th>
                        </tr>
                    </thead>
                    <tbody>';

                        if($sql_get>0){
                        foreach($sql_get as $row){
            
                        $add=0;
                        $save = 0;
                        $qted = ($row->Part*$row->Quantity)*+(1+($row->Percent/100));
                        if($row->Parts_sales<=0){
                           $status = "<span class='badge' style='background-color:red'>No</span>";
                        }else if($row->Parts_sales>0){
                           $status = "<span class='badge' style='background-color:green'>Yes</span>";
                        }if($row->actual_price>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                            $save = 0;  
                            $add = ($row->actual_price -($row->Part*$row->Quantity)*(1+($row->Percent/100)));   
                        }else if($row->actual_price<($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                            $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$row->actual_price);   
                            $add = 0;   
                        }
                        if(number_format($row->MarkUp2)==0){
                           $mark = 'Nett + '.$row->MarkUp.'% Mark Up';
                            if($row->Parts_sales<=0){
                                $actl=0;
                            }else{
                                $actl = $row->actual_price;
                            }
                        }else{
                           $mark = $row->MarkUp2.'% Mark Up Only';
                            if($row->Parts_sales<=0){
                                $actl=0;
                            }else{//(Parts_sales+(Parts_sales*(MarkUp/100)))
                                $actl = $row->Parts_sales*(($row->MarkUp2)/100);
                               if($actl>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                                $add = ($actl - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));                                                      $save = 0;
                               }else{
                                $add = 0;
                                $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$actl);
                               }
                            }
                                                           //$add = 0;
                                                           //$save = 0;
                        }
                            $actlttl += $actl;
                            $qtedttl += $qted;
                            $savettl += $save;
                            $addttl += $add;
                            $btmnt+= $actl*$row->Betterment/100;
                            $btmnt_+= ($row->Part*$row->Quantity)*+(1+($row->Percent/100))*$row->Betterment/100;
                                   $html_1.= '<tr style="font-size:8px;text-align:left;">
                                   <td style="border: solid 1px black;" width="20px">'.$count.'</td>
                                   <td style="border: solid 1px black;" width="80px">'.$row->Description.'</td>
                                   <td style="border: solid 1px black;" width="80px">'.$row->Oper.'</td>
                                   <td style="border: solid 1px black;" width="50px">'.number_format($row->Parts_sales,2).'</td>
                                   <td style="border: solid 1px black;" width="100px">'.$mark.'</td>
                                   <td style="border: solid 1px black;" width="60px">'.$row->Betterment.'</td>
                                   <td style="border: solid 1px black;" width="60px">'.number_format($save,2).'</td>
                                   <td style="border: solid 1px black;" width="80px">'.number_format($add,2).'</td>
                                   <td style="border: solid 1px black;" width="80px">'.number_format($qted,2).'</td>
                                   <td style="border: solid 1px black;">'.number_format($actl,2).'</td>
                                   </tr>';
                                   $count++;
                    }
                     if($count<30){
                          for($i=$count;$i<31;$i++){
                               $html_1.= '<tr style="font-size:8px;">
                               <td style="border: solid 1px black;" width="20px">'.$i.'</td>
                               <td style="border: solid 1px black;" width="80px"></td>
                               <td style="border: solid 1px black;" width="80px"></td>
                               <td style="border: solid 1px black;" width="50px"></td>
                               <td style="border: solid 1px black;" width="100px"></td>
                               <td style="border: solid 1px black;" width="60px"></td>
                               <td style="border: solid 1px black;" width="60px"></td>
                               <td style="border: solid 1px black;" width="80px"></td>
                               <td style="border: solid 1px black;" width="80px"></td>
                               <td style="border: solid 1px black;"></td>
                               </tr>';
                          }
                    }   
                }   
                    
                $html_1.='</tbody></table>';
            $pdf->writeHTMLCell(0, 0, '', '', $html_1, 0, 1, 0, true, '', true);
            
    
             $no=1;
            $html_additional='';
            $sql_additional=DB::select("select * from additional where Key_Ref=?",[$id]);
            $html_additional='<br><h1>Additionals</h1><br>
                               <table>
                                <thead>
                                    <tr style="font-size:8px;font-weight:bold;background-color:black;color:white;text-align:center;">
                                        <th style="border: solid 1px black;" width="20px">No.</th>
                                        <th style="border: solid 1px black;" width="80px">Inhouse/Outwork</th>
                                        <th style="border: solid 1px black;" width="80px">Oper</th>
                                        <th style="border: solid 1px black;" width="50px">Landing Price</th>
                                        <th style="border: solid 1px black;" width="100px">Mark-Up</th>
                                        <th style="border: solid 1px black;" width="80px">Betterment</th>
                                        <th style="border: solid 1px black;" width="50px">Saving</th>
                                        <th style="border: solid 1px black;" width="50px">Additional</th>
                                        <th style="border: solid 1px black;" width="50px">Quoted Price</th>
                                        <th style="border: solid 1px black;">Actual Price</th>
                                    </tr>
                                </thead><tbody>';
          
            
            
            if(count($sql_additional)>0){
            foreach($sql_additional as $dbrow){  
            
            $part=$dbrow->Part;
            $actual = ($dbrow->Part+$dbrow->Part*$dbrow->MarkUp/100);
            if($actual>$part){
              $add = (0);
              $save = 0;
            }else{
              $add  = 0;
              $save = (($dbrow->Part*$dbrow->Quantity)*(1+($dbrow->Percent/100))-$actual);
            }
            $html_additional.= '                   
                                                <tr style="font-size:8px;font-weight:bold;">
                                                <td style="border: solid 1px black;" width="20px">'.$no.'</td>
                                                <td style="border: solid 1px black;" width="80px">'.$dbrow->Description.'</td>
                                                <td style="border: solid 1px black;" width="80px">'.$dbrow->Oper.'</td>
                                                <td style="border: solid 1px black;" width="50px">'.$dbrow->Part.'</td>
                                                <td style="border: solid 1px black;" width="100px">Nett + '.number_format($dbrow->MarkUp,1).'%</td>
                                                <td style="border: solid 1px black;" width="80px">'.$dbrow->Betterment.'%</td>
                                                <td style="border: solid 1px black;" width="50px">'.number_format($save,2).'</td>
                                                <td style="border: solid 1px black;" width="50px">'.number_format($add,2).'</td>
                                                <td style="border: solid 1px black;" width="50px">'.$dbrow->Part.'</td>
                                                <td style="border: solid 1px black;">'.number_format(($dbrow->Part+$dbrow->Part*$dbrow->MarkUp/100),2).'</td>
                                                </tr>
                                                
                                                ';  
                                                $no++;
            }
            
            }
            $html_additional.='</tbody></table>';
            
            $pdf->writeHTMLCell(0,0,'','',$html_additional,0,1,0,true,'',true);
            ob_end_clean();
            $pdf->Output('Precosting.pdf', 'I');
               
            
            
        }

        public function print_non_approved_part($id){
            $name='';
            $date=date('Y-m-d');
            $vin='';
            $clients=DB::table('client_details')->where('Key_Ref','=',$id)->get();
            foreach($clients as $client){
                $name=''.$client->Fisrt_Name.' '.$client->Last_Name;
                $vin=$client->Chasses_No;
            }
            $pdf=PDF::loadview('pdf.nonapprovedpart',['name'=>$name,'date'=>$date,'vin'=>$vin]);
            return $pdf->stream(''.$id.'- Non - Approved-Parts.pdf');

        }

        public function print_consumables($id){

            $data       = '';
            $data_0     = '';
            $total_data = '';
            $no         = 1;
            $sundries   = 0;
            $paint_sup  = 0;
            $waste      = 0;
            $inhouse    = 0;

            $a_inpart   = 0;
            $a_spaint_supplies = 0;
            $a_sundries = 0;
            $a_waste    = number_format(80,2);
            $undefined  = 0;
            $oper  = 0;    
            $part  =0;  
            $paint =0;
            $total=0;
            $quantity=0;
            $catergory=0;
            $q_sundries=0;
            $q_paint_sup=0;
            $q_waste=0;
            $q_inhouse=0;
            $user='';

            $dbquery_rate= DB::select("select * from insurer where Key_Ref=?",[$id]);
            if(count($dbquery_rate)>0){
                foreach($dbquery_rate  as $dbrow_rate){

                    $rate           = $dbrow_rate->Paint;    
                    $ShopSup        = $dbrow_rate->ShopSup;    
                    $PaintSup       = $dbrow_rate->PaintSup;    
                    $PaintSupVal    = $dbrow_rate->PaintSupVal;    
                    $a_sundries_val = $dbrow_rate->ShopSupVal;
                    $a_paint_val    = $dbrow_rate->ShopSupVal;
                    }    
                    }else{
                    $ShopSup  = 1;
                    $PaintSup = 1;    
            }

            $dbquery_sup = DB::table('qoutes')->where('Key_Ref','=',$id)->get();
            if(count($dbquery_sup)>0){
                foreach($dbquery_sup as $dbrow_sup){
                
                $oper  = $dbrow_sup->Oper;    
                $part  = $part + $dbrow_sup->Part* $dbrow_sup->Quantity;  
                $paint = $paint + $dbrow_sup->Paint * $rate;  
                
                if($oper=='Instock Item'){
                $a_inpart  = $a_inpart + $dbrow_sup->Misc * $dbrow_sup->Quantity;     
                }
                
                }    
                }
            $a_sundries = ($part * $ShopSup / 100 + $a_sundries_val);
            $a_spaint_supplies = ($paint * $PaintSup / 100) + $paint * $PaintSupVal /100;

            //////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $dbquery_0=DB::select("select DISTINCT a.receiver FROM stock_history a WHERE a.Key_Ref=?",[$id]);
            foreach($dbquery_0 as $dbrow_0){
                $user = $dbrow_0->receiver;
                $dbquery=DB::select("select a.catergory,a.description,a.quantity,a.receiver,a.price,a.price*a.quantity AS total,a.date2
                FROM stock_history a WHERE Key_Ref=? and receiver=? order by a.date2 asc",[$id,$user]);
             foreach($dbquery as $dbrow){
                $total     = $dbrow->total;
                $quantity  = $dbrow->quantity;
                $catergory = $dbrow->catergory;
                
                if($catergory=='Sundries'){
                $sundries   = $sundries + $total;	
                $q_sundries = $q_sundries + $quantity;	
                }elseif($catergory=='Paint Supplies'){
                $paint_sup   = $paint_sup + $total;	
                $q_paint_sup = $q_paint_sup + $quantity;	
                }elseif($catergory=='Waste Disposal'){
                $waste = $waste + $total;	
                $q_waste = $q_waste + $quantity;
                }elseif($catergory=='Inhouse Stock'){
                $inhouse   = $inhouse + $total;	
                $q_inhouse = $q_inhouse + $quantity;
                }else{
                $undefined = $undefined + $total;    
                }
             
             $data .=
                '<tr>
                <td>'.$no.'</td>
                <td>'.$dbrow->catergory.'</td>
                <td>'.$dbrow->description.'</td>
                <td style="text-align:center;">'.$dbrow->quantity.'</td>
                <td>'.$dbrow->receiver.'</td>
                <td>'.$dbrow->price.'</td>
                <td>'.$dbrow->total.'</td>
                <td>'.$dbrow->date2.'</td>
                </tr>';

                $no++;	
                }   
            }
            
            $user_data = '';
            $user_price = 0;
            $d_sundries=0;
            $d_paint_supplies=0;
            $d_waste=0;
            $d_inhouse=0;

            $dbquery=DB::select("select DISTINCT a.receiver FROM stock_history a WHERE a.Key_Ref=?",[$id]);
            foreach($dbquery as $dbrow){
                $user_quantity = 0;
                $receiver = $dbrow->receiver;    
                
                $dbquery_data   = DB::select("select * FROM stock_history a WHERE a.Key_Ref=? AND a.receiver=?",[$id,$receiver]);
                  
                
                foreach($dbquery_data as $dbrow_data){
                
                $user_quantity = $user_quantity + $dbrow_data->quantity;    
                $user_price    = $user_price + $dbrow_data->price;    
                
                }
                
                $user_data .='
                <tr>
                <td>'.$receiver.'</td>
                <td>'.$user_quantity.'</td>
                <td>'.$user_price.'</td>
                </tr>
                ';
                
                }
                if($d_sundries<0){
                    $c_sundries = $d_sundries;    
                    }elseif($d_paint_supplies<0){
                    $c_paint_supplies = $d_paint_supplies;    
                    }elseif($d_waste<0){
                    $c_waste = $d_waste;    
                    }elseif($d_inhouse<0){
                    $c_inhouse = $d_inhouse;    
                }

             $manager = number_format($a_sundries+$a_spaint_supplies+$a_waste+$a_inpart-($sundries+$paint_sup+$waste+$inhouse),2);

            if($manager>0){
            $html = '
            <table width="100%">
            <tr style="background-color:#ff6666;font-size:12px;">
            <td style="width:185px;">Line Manager Contribution</td>
            <td style="width:754px;">'.number_format(0,2).'</td>
            </tr>
            </table>
            ';   
            }else{
            $html = '
            <table width="100%">
            <tr style="background-color:#ff6666;font-size:12px;">
            <td style="width:185px;">Line Manager Contribution</td>
            <td style="width:754px;">'.$manager.'</td>
            </tr>
            </table>
            ';
            }
            $pdf=PDF::loadview('pdf.consumables',['id'=>$id,'data'=>$data,'undefined'=>$undefined,'user'=>$user,'total'=>$total,'quantity'=>$quantity,'category'=>$catergory,
            'sundries'=>$sundries,'q_sundries'=>$q_sundries,'paint_sup'=>$paint_sup,'q_paint_sup'=>$q_paint_sup,'waste'=>$waste,'q_waste'=>$q_waste,'inhouse'=>$inhouse,'q_inhouse'=>$q_inhouse,'a_sundries'=>$a_sundries,
            'a_spaint_supplies'=>$a_spaint_supplies,'oper'=>$oper,'part'=>$part,'paint'=>$paint,'rate'=>$rate,'ShopSup'=>$ShopSup,'PaintSup'=>$PaintSup,'PaintSupVal'=>$PaintSupVal,'a_sundries_val'=>$a_sundries_val,'a_paint_val'=>$a_paint_val,'a_waste'=>$a_waste,
            'a_inpart'=>$a_inpart,'user_data'=>$user_data,'html'=>$html])->setPaper('a4','landscape');
            return $pdf->stream(''.$id.'-Itemised.pdf');
        }

        public function print_stores_rfc($id){
            $supname = "";
            $supemail = "";
            $ordnum = "";
            $key = "";
            $user = "";
            $qty = '';
            $des = '';
            $comm ='';
            $date='';
            $partNo='Part Noeis';
            $price='Price amount';
            $rfcno='rfcNo_varicable';
            $Invceno='Invceno';
            $credit_note=DB::table('credit_note')->where('p_id','=',$id)->get();

            foreach($credit_note as $credit){
                $partNo=$credit->Part_No;
                $price=$credit->price;
                $rfcno=$credit->rfcno;
                $Invceno=$credit->invoice_no;
            }

            $result=DB::table('orders')->where('id',$id)->get();

            foreach($result as $row)
                {
                    $ordnm = $row->order_number;
                    $des = $row->Description_2;
                    $key =  $row->Key_Ref;
                    $qty = $row->quantity;

                    $resultas = DB::select("select distinct Supplier,address,co.order_number,cn.Key_Ref,cn.comment,cn.date,user from confirmed_orders co inner join credit_note cn on co.Key_Ref = cn.Key_Ref where co.order_number =?",[$ordnm]);
                    foreach($resultas as $row)
                    {
                        $date=$row->date;
                        $supname = $row->Supplier;
                        $supemail = $row->address;
                        $ordnum = $row->order_number;
                        $key = $row->Key_Ref;
                        $user = $row->user;
                        $comm = $row->comment;
                    }
                }
                $pdf=PDF::loadview('pdf.storesrfc',['supname'=>$supname,'supemail'=>$supemail,'ordnum'=>$ordnm,'key'=>$key,'user'=>$user,'qty'=>$qty,'des'=>$des,'comm'=>$comm,'date'=>$date,'rfcno'=>$rfcno,'partNo'=>$partNo,'Invceno'=>$Invceno,'price'=>$price]);
                return $pdf->stream(''.$id.'-RFC-'.$ordnum.'.pdf');    


        }

        public function print_job_card($id){
            $name = '';
            $phone = '';
            $model= 'Range Rover Autobiography';
            $reg = '';
            $chassis = '';
            $kms = '';
            $brnch = 'Selby';
            $insurer = '';
            $tblpart = '';
            $tbllabor = '';
            $tblpaint = '';
            $tblstrip = '';
            $tbloutwrk = '';
            $ttlRnR = 0;
            $ttlLabor = 0;
            $ttlPaint = 0;
            $ttlStrip = 0;
            $ro = '';

            $result=DB::select('select * from qoutes where Key_Ref=? and Part>0',[$id]);
            $result1=DB::select('select * from qoutes where Key_Ref=? and Labour>0',[$id]);

            $result2 = DB::select("select * from qoutes where Key_Ref=? and Paint>0",[$id]);
            $result3 = DB::Select("select * from qoutes where Key_Ref=? and Strip>0",[$id]);
            $result4 = DB::select("select * from qoutes where Key_Ref=? and (Oper='OUTWORK' or Oper='Mechanical' or Oper='Service' OR Oper='INSTOCK' or Oper='Inhouse' or Oper='In House Part' OR Oper='Check' OR Oper='In Hse Diagnostics as per Report')",[$id]);
            $res = DB::select("select * from client_details where Key_Ref=?",[$id]);
            $res1 = DB::select("select Inserer from insurer where Key_Ref=?",[$id]);

            foreach($res as $row)
                {
                    $name = $row->Fisrt_Name." ".$row->Last_Name;
                    $phone = $row->Cell_number;
                    $model = $row->Model." ".$row->Make;
                    $reg = $row->Reg_No;
                    $chassis = $row->Chasses_No;
                    $kms = $row->KM;
                    $brnch  = $row->branch;
                    $ro = $row->RODATE;
                }    
                foreach($res1 as $row)
                {
                    $insurer = $row->Inserer;
                }
                foreach($result as $row)
                {
                    $part = $row->Oper;
                    $desc = $row->Description;
                    $tblpart .= '<tr>
                                    <td style="width:70px;font-color:red;font-weight:bold;">'.$part.'</td>
                                    <td style="width:150px;">'.$desc.'</td>
                                    <td style="width:30px;">&nbsp;</td>
                                    <td style="width:30px;border:1px solid #111;">&nbsp;</td>
                                </tr>';
                }


                foreach($result1 as $row)
                {
                    $part = $row->Oper;
                    $desc = $row->Description;
                    $tme = number_format($row->Labour/2,2);
                
                    if(strtoupper($row->Oper)=='NEW'){
                        $ttlRnR += number_format($row->Labour/2,2);
                    }
                    $ttlLabor += ($row->Labour/2);
                    $tbllabor .= ' <tr>
                                    <td style="width:70;">'.$part.'</td>
                                    <td style="width:150;">'.$desc.'</td>
                                    <td style="width:30;">'.$tme.'</td>
                                    <td style="width:30;border:1px solid #111;"></td>
                                </tr>';
                }
                foreach($result2 as $row)
                {
                    $part = $row->Oper;
                    $desc = $row->Description;
                    $tme = number_format($row->Paint/2,2);
                    if(strtoupper($row->Oper)=='NEW'){
                        $ttlRnR += number_format($row->Paint/2,2);
                    }
                    $ttlPaint += number_format($row->Paint/2,2);
                    $tblpaint .= '<tr>
                                    <td style="width:70;">'.$part.'</td>
                                    <td style="width:150;">'.$desc.'</td>
                                    <td style="width:30;">'.$tme.'</td>
                                    <td style="width:30;border:1px solid #111;"></td>
                                  </tr>';
                }
                foreach($result3 as $row)
                {
                    $part = $row->Oper;
                    $desc = $row->Description;
                    $tme = number_format($row->Strip/2,2);
                    if(strtoupper($row->Oper)=='NEW'){
                        $ttlRnR += number_format($row->Strip/2,2);
                    }
                    $ttlStrip += ($row->Strip/2);
                    $tblstrip .= ' <tr>
                                    <td style="width:70;">'.$part.'</td>
                                    <td style="width:150;">'.$desc.'</td>
                                    <td style="width:30;">'.$tme.'</td>
                                    <td style="width:30;border:1px solid #111;"></td>
                                </tr>';
                }
                foreach($result4 as $row)
                {
                    $part = $row->Oper;
                    $desc = $row->Description;
                    $tbloutwrk .= ' <tr>
                                    <td style="width:70;">'.$part.'</td>
                                    <td style="width:150;">'.$desc.'</td>
                                    <td style="width:30;"></td>
                                    <td style="width:30;border:1px solid #111;"></td>
                                </tr>';
                }
                $ttlRnR = number_format($ttlRnR,2);
                $ttlLabor = number_format($ttlLabor,2);
                $ttlPaint = number_format($ttlPaint,2);
                $ttlStrip = number_format($ttlStrip,2);

            $pdf=PDF::loadview('pdf.jobcard',['ref'=>$id,'name'=>$name,'reg'=>$reg,'model'=>$model,'kms'=>$kms,'chassis'=>$chassis,'insurer'=>$insurer,'ro'=>$ro,'tblpart'=>$tblpart,'tbllabor'=>$tbllabor,'tblpaint'=>$tblpaint,'tblstrip'=>$tblstrip,'tbloutwrk'=>$tbloutwrk,'ttlRnR'=>$ttlRnR,'ttlLabor'=>$ttlLabor,'ttlPaint'=>$ttlPaint,'ttlStrip'=>$ttlStrip]);
            return $pdf->stream(''.$id.'-Job Card.pdf');

                //$pdf=PDF::loadview('pdf.jobcoard',['supname'=>$supname,'supemail'=>$supemail,'ordnum'=>$ordnm,'key'=>$key,'user'=>$user,'qty'=>$qty,'des'=>$des,'comm'=>$comm,'date'=>$date,'rfcno'=>$rfcno,'partNo'=>$partNo,'Invceno'=>$Invceno,'price'=>$price]);
                //return $pdf->stream(''.$id.'-Job Card-.pdf');
        }

        public function print_billing_history(Request $request){
            $date=$request->date;
            $id=$request->id;
            $counter = 0;
            $total   = 0;
            $dbcmd=DB::select("SELECT a.Key_Ref,a.amount,a.date_created,b.Fisrt_Name,b.Last_Name,b.Reg_No,b.Make,b.Model,b.Estimator FROM branch_history a
                INNER JOIN client_details b ON a.Key_Ref=b.Key_Ref
                WHERE a.date_created>=? AND a.id_ref=?",[$date,$id]);


            $pdf=PDF::loadview('pdf.userbilling',['info'=>$dbcmd,'counter'=>$counter,'total'=>$total]);
            return $pdf->stream();
        }

        public function print_itemised($id){
            $data       = '';
            $data_0     = '';
            $total_data = '';
            $no         = 1;
            $sundries   = 0;
            $paint_sup  = 0;
            $waste      = 0;
            $inhouse    = 0;

            $a_inpart   = 0;
            $a_spaint_supplies = 0;
            $a_sundries = 0;
            $a_waste    = number_format(80,2);
            $undefined  = 0;
            $oper  = 0;    
            $part  =0;  
            $paint =0;
            $total=0;
            $quantity=0;
            $catergory=0;
            $q_sundries=0;
            $q_paint_sup=0;
            $q_waste=0;
            $q_inhouse=0;
            $user='';

            $dbquery_rate= DB::select("select * from insurer where Key_Ref=?",[$id]);
            if(count($dbquery_rate)>0){
                foreach($dbquery_rate  as $dbrow_rate){

                    $rate           = $dbrow_rate->Paint;    
                    $ShopSup        = $dbrow_rate->ShopSup;    
                    $PaintSup       = $dbrow_rate->PaintSup;    
                    $PaintSupVal    = $dbrow_rate->PaintSupVal;    
                    $a_sundries_val = $dbrow_rate->ShopSupVal;
                    $a_paint_val    = $dbrow_rate->ShopSupVal;
                    }    
                    }else{
                    $ShopSup  = 1;
                    $PaintSup = 1;    
            }

            $dbquery_sup = DB::table('qoutes')->where('Key_Ref','=',$id)->get();
            if(count($dbquery_sup)>0){
                foreach($dbquery_sup as $dbrow_sup){
                
                $oper  = $dbrow_sup->Oper;    
                $part  = $part + $dbrow_sup->Part* $dbrow_sup->Quantity;  
                $paint = $paint + $dbrow_sup->Paint * $rate;  
                
                if($oper=='Instock Item'){
                $a_inpart  = $a_inpart + $dbrow_sup->Misc * $dbrow_sup->Quantity;     
                }
                
                }    
                }
            $a_sundries = ($part * $ShopSup / 100 + $a_sundries_val);
            $a_spaint_supplies = ($paint * $PaintSup / 100) + $paint * $PaintSupVal /100;

            //////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $dbquery_0=DB::select("select DISTINCT a.receiver FROM stock_history a WHERE a.Key_Ref=?",[$id]);
            foreach($dbquery_0 as $dbrow_0){
                $user = $dbrow_0->receiver;
                $dbquery=DB::select("select a.catergory,a.description,a.quantity,a.receiver,a.price,a.price*a.quantity AS total,a.date2
                FROM stock_history a WHERE Key_Ref=? and receiver=? order by a.date2 asc",[$id,$user]);
             foreach($dbquery as $dbrow){
                $total     = $dbrow->total;
                $quantity  = $dbrow->quantity;
                $catergory = $dbrow->catergory;
                
                if($catergory=='Sundries'){
                $sundries   = $sundries + $total;	
                $q_sundries = $q_sundries + $quantity;	
                }elseif($catergory=='Paint Supplies'){
                $paint_sup   = $paint_sup + $total;	
                $q_paint_sup = $q_paint_sup + $quantity;	
                }elseif($catergory=='Waste Disposal'){
                $waste = $waste + $total;	
                $q_waste = $q_waste + $quantity;
                }elseif($catergory=='Inhouse Stock'){
                $inhouse   = $inhouse + $total;	
                $q_inhouse = $q_inhouse + $quantity;
                }else{
                $undefined = $undefined + $total;    
                }
             
             $data .=
                '<tr>
                <td>'.$no.'</td>
                <td>'.$dbrow->catergory.'</td>
                <td>'.$dbrow->description.'</td>
                <td style="text-align:center;">'.$dbrow->quantity.'</td>
                <td>'.$dbrow->receiver.'</td>
                <td>'.$dbrow->price.'</td>
                <td>'.$dbrow->total.'</td>
                <td>'.$dbrow->date2.'</td>
                </tr>';

                $no++;	
                }   
            }
            
            $user_data = '';
            $user_price = 0;
            $d_sundries=0;
            $d_paint_supplies=0;
            $d_waste=0;
            $d_inhouse=0;

            $dbquery=DB::select("select DISTINCT a.receiver FROM stock_history a WHERE a.Key_Ref=?",[$id]);
            foreach($dbquery as $dbrow){
                $user_quantity = 0;
                $receiver = $dbrow->receiver;    
                
                $dbquery_data   = DB::select("select * FROM stock_history a WHERE a.Key_Ref=? AND a.receiver=?",[$id,$receiver]);
                  
                
                foreach($dbquery_data as $dbrow_data){
                
                $user_quantity = $user_quantity + $dbrow_data->quantity;    
                $user_price    = $user_price + $dbrow_data->price;    
                
                }
                
                $user_data .='
                <tr>
                <td>'.$receiver.'</td>
                <td>'.$user_quantity.'</td>
                <td>'.$user_price.'</td>
                </tr>
                ';
                
                }
                if($d_sundries<0){
                    $c_sundries = $d_sundries;    
                    }elseif($d_paint_supplies<0){
                    $c_paint_supplies = $d_paint_supplies;    
                    }elseif($d_waste<0){
                    $c_waste = $d_waste;    
                    }elseif($d_inhouse<0){
                    $c_inhouse = $d_inhouse;    
                }

             $manager = number_format($a_sundries+$a_spaint_supplies+$a_waste+$a_inpart-($sundries+$paint_sup+$waste+$inhouse),2);

            if($manager>0){
            $html = '
            <table width="100%">
            <tr style="background-color:#ff6666;font-size:12px;">
            <td style="width:185px;">Line Manager Contribution</td>
            <td style="width:754px;">'.number_format(0,2).'</td>
            </tr>
            </table>
            ';   
            }else{
            $html = '
            <table width="100%">
            <tr style="background-color:#ff6666;font-size:12px;">
            <td style="width:185px;">Line Manager Contribution</td>
            <td style="width:754px;">'.$manager.'</td>
            </tr>
            </table>
            ';
            }
            $pdf=PDF::loadview('pdf.itemized',['id'=>$id,'data'=>$data,'undefined'=>$undefined,'user'=>$user,'total'=>$total,'quantity'=>$quantity,'category'=>$catergory,
            'sundries'=>$sundries,'q_sundries'=>$q_sundries,'paint_sup'=>$paint_sup,'q_paint_sup'=>$q_paint_sup,'waste'=>$waste,'q_waste'=>$q_waste,'inhouse'=>$inhouse,'q_inhouse'=>$q_inhouse,'a_sundries'=>$a_sundries,
            'a_spaint_supplies'=>$a_spaint_supplies,'oper'=>$oper,'part'=>$part,'paint'=>$paint,'rate'=>$rate,'ShopSup'=>$ShopSup,'PaintSup'=>$PaintSup,'PaintSupVal'=>$PaintSupVal,'a_sundries_val'=>$a_sundries_val,'a_paint_val'=>$a_paint_val,'a_waste'=>$a_waste,
            'a_inpart'=>$a_inpart,'user_data'=>$user_data,'html'=>$html])->setPaper('a4','landscape');
            return $pdf->stream(''.$id.'-Itemised.pdf');
        
        }

        public function print_tools_purchase($id){
            
            $name="";
            $branch="";
            $amount=0;
            $m_amount=0;
            $start_date="";

            $tools=DB::table('tools_history')->where('id','=',$id)->get();
            foreach($tools as $row){
             $name=$row->names;
             $branch=$row->branch;
             $amount=$row->amount;
             $m_amount=$row->m_amount;
             $star_date=$row->start_date;       
            }
            $pdf=PDF::loadview('pdf.toolspurchase',['names'=>$name,'branch'=>$branch,'amount'=>$amount,'m_amount'=>$m_amount,'start_date'=>$start_date]);
            return $pdf->stream('Tools Purchase.pdf');

        }



         #PRINT ADDITIONALS  [ $id,$value ]
        //public function print_additionals( $id ){
    public function print_additionals( Request $request, $id ){

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Additional Page');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));

        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins("10", PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 8, '', true);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->AddPage();

        $value = $request->value;
        $tbl2 = "";
        $watermk = "";
        $dbcmd = DB::table('client_details')->where('Key_Ref','=',$id)->get();

        foreach($dbcmd as $dbrow){
            $val1 = $dbrow->Fisrt_Name;
            $val2 = $dbrow->Last_Name;
            $val3 = $dbrow->Reg_No;
            $val4 = $dbrow->Make;
            $val5 = $dbrow->Model;
            $val6 = $dbrow->Date; 
        }

        $dbcmd1  = DB::table('insurer')->where('Key_Ref','=',$id)->get();
        foreach($dbcmd1 as $dbrow1){

            $val7 = $dbrow1->Assessor;
            $val8 = $dbrow1->Claim_NO;
            $val9 = $dbrow1->Inserer;         
        }

        $query4 =  DB::table('betterment')->where('Key_Ref','=',$id)->orderBy('id','desc')->limit(1)->get();


        if ( count($query4) > 0) {

            foreach($query4 as $row2){
                $excess1 = $row2->Excess_1;
                $excess2 = $row2->Excess_2;

            }
        } 

        
        #IMAGE
        $image='img/selby-add.PNG';
        $pdf->Image($image);
        $width =(int)300;
        $strText ="";
        $height =(int)28;
        $strText = str_replace("\n","<br>",$strText);
        $pdf->MultiCell($width, $height,$strText, 0, 'J', 0, 1, '', '', true, null, true);
       
        $html = '<br><br>
            <table border="1" style="width:100%;">
                <tr>
                <td style="width:108px;"><h5>Insurance</h5></td>
                <td style="width:208px;background-color:;"><h5>'.$val9.'</h5></td>
                <td style="width:108px;"><h5>ASSESSOR</h5></td>
                <td style="width:250px;background-color:;"><h5>'.$val7.'</h5></td>
                </tr>

                <tr>
                <td style="width:108px;"><h5>INSURED</h5></td>
                <td style="width:208px;background-color:;"><h5>'.$val1." ".$val2.'</h5></td>
                <td style="width:108px;"><h5>Claim No</h5></td>
                <td style="width:250px;background-color:;"><h5>'.$val8.'</h5></td>
                </tr>

                <tr>
                <td style="width:108px;"><h5>REGISTRATION NO</h5></td>
                <td style="width:208px;background-color:;"><h5>'.$val3." ".$val2.'</h5></td>
                <td style="width:108px;"><h5>REFERENCE NO</h5></td>
                <td style="width:250px;background-color:;"><h5>'.$id.'</h5></td>
                </tr>

                <tr>
                <td style="width:108px;"><h5>VEHICLE</h5></td>
                <td style="width:208px;background-color:;"><h5>'.$val4." ".$val5.'</h5></td>
                <td style="width:108px;"><h5>DATE</h5></td>
                <td style="width:250px;background-color:;"><h5>'.$val6.'</h5></td>
                </tr>
            </table>
            ';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            #ADDED HERE
            $html_ = '';
            $html = '<br><br>
            
            <table border="1" style="width:100%;font-size:7px;">
                <tr style="background-color:black;color:white;">
                <td style="width:20px;"><h4>No</h4></td>
                <td style="width:140px;"><h4>Part Description</h4></td>
                <td style="width:79px;"><h4>Oper</h4></td>
                <td style="width:56px;"><h4>Landing Price</h4></td>
                <td style="width:100px;"><h4>Mark-Up</h4></td>
                <td style="width:56px;"><h4>Betterment</h4></td>
                <td style="width:56px;"><h4>Saving</h5></td>
                <td style="width:56px;"><h4>Additional</h4></td>
                <td style="width:56px;"><h4>Quoted Price</h4></td>
                <td style="width:56px;"><h4>Actual Price</h4></td>
                </tr>    
            ';


            $no = 1;
            $betterment_total   = 0;
            $part_total         = 0;
            $actual_price_total = 0;
            $plus_additional    = 0;
            $less_saving        = 0;
            $ttal = 0;
            $btmnttl = 0;

            $dbcmd2 =  DB::select("SELECT * FROM additional WHERE Key_Ref=? AND (Part>0 or Part<0) ORDER BY id",[$id]);

            if( count( $dbcmd2 ) >0){

            foreach($dbcmd2 as $dbrow2){

            $part_id     = $dbrow2->id;
            $oper        = $dbrow2->Oper;
            $description = $dbrow2->Description;
            $percent     = ($dbrow2->Part*$dbrow2->Percent/100);
            $quantity    = $dbrow2->Quantity;
            $part        = ($dbrow2->Part+$percent);
            $part_sales  = $dbrow2->Part;
            $markup      = $dbrow2->MarkUp;
            $betterment  = $dbrow2->Betterment;
                
            $savings     =($part_sales * $markup/100);
            $actual_price=(($part_sales*$quantity) + $savings);
            $new_savings =($part - $actual_price);

            $betterment_total  = ($betterment_total + $actual_price * $betterment / 100);
            $part_total        = ($part_total + $part);
            $actual_price_total= ($actual_price_total + $actual_price);
            $actup = 0;
            if($part_sales<=0){
            $new_savings=0; 
            }

            if($new_savings<0){
            $new_savings = 0;   
            $additional_price = ($actual_price - $part);    
            }else{
            $additional_price = 0;  
            }

            if($actual_price>0){
            $color = "green";   
            }else{
            $color = "red"; 
            }
            if(number_format($dbrow2->MarkUp2)==0){
                $markup = 'Nett + '.$dbrow2->MarkUp.'% Mark Up';
                $actup = $dbrow2->Part*(1+($dbrow2->MarkUp/100));
            }else{
                $markup = $dbrow2->MarkUp2.'% Mark Up Only';
                $actup = $dbrow2->Part*(($dbrow2->MarkUp2/100));
            }
            $ttal += $actup;
            $btnm = $actup*$betterment/100;
            $btmnttl +=$btnm;
           
            $html.='
            <tr>
            <td style="width:20px;">'.$no.'</td>
            <td style="width:140px;">'.$description.'</td>
            <td style="width:79px;">'.$oper.'</td>
            <td style="width:56px;">'.number_format($part_sales,2).'</td>
            <td style="width:100px;">'.$markup.'</td>
            <td style="width:56px;">'.  number_format($btnm,2).'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format($actup,2).'</td>
            </tr>
            ';
            $no++;  
            $less_saving     += $new_savings;
            $plus_additional += $additional_price;

            }
            }else{
            $sundries = 0;  
            $disc_val = 0;  
            }
            $html .='</table>';
           
            
            $html .='
                <table border="0" style="width:100%;font-size:8px;">
                <tr>
                <td colspan="4" style="width:283px;"></td>
                <td colspan="0" style="width:112px;"><h4>Sub Total</h4></td>
                <td colspan="3" style="background-color:silver;width:168px;">R'.number_format($btmnttl,2).'</td>
                <td style="background-color:silver;width:56px;">R'.number_format(0,2).'</td>
                <td colspan="2" style="background-color:silver;width:56px;">R'.number_format($ttal,2).'</td>
                </tr>
                </table><br><br>
                ';

            #ADD 3
            $html .='
                <table border="1" style="width:100%;font-size:7px;">
                <tr style="background-color:black;color:white;">
                <td style="width:20px;"><h4>No</h4></td>
                <td style="width:140px;"><h4>Outwork</h4></td>
                <td style="width:79px;"><h4>Oper</h4></td>
                <td style="width:56px;"><h4>Landing Price</h4></td>
                <td style="width:100px;"><h4>Mark-Up</h4></td>
                <td style="width:56px;"><h4>Betterment</h4></td>
                <td style="width:56px;"><h4>Saving</h5></td>
                <td style="width:56px;"><h4>Additional</h4></td>
                <td style="width:56px;"><h4>Quoted Price</h4></td>
                <td style="width:56px;"><h4>Actual Price</h4></td>
                </tr>
                ';


            #ADD 4
            $no = 1;
            $betterment_total   = 0;
            $part_total         = 0;
            $actual_price_total = 0;
            $plus_additional    = 0;
            $less_saving        = 0;
            $ttalout = 0;
            $btm_total = 0;

            $dbcmd2 =  DB::select("SELECT * FROM additional WHERE Key_Ref=? AND (Outwork>0 or Outwork<0) ORDER BY id",[$id]);

            if( count($dbcmd2) >0){

            foreach($dbcmd2 as $dbrow2){

            $part_id     = $dbrow2->id;
            $oper        = $dbrow2->Oper;
            $description = $dbrow2->Description;
            $percent     = ($dbrow2->Part*$dbrow2->Percent/100);
            $quantity    = $dbrow2->Quantity;
            $part        = ($dbrow2->Outwork+$percent);
            $part_sales  = $dbrow2->Outwork;
            //$markup      = $dbrow2['MarkUp'];
            $betterment  = $dbrow2->Betterment;
                
            $savings     =($part_sales * $dbrow2->MarkUp/100);
            $actual_price=($part_sales + $savings);
            $new_savings =($part - $actual_price);

            $betterment_total  = ($betterment_total + $actual_price * $betterment / 100);
            $part_total        = ($part_total + $part);
            $actual_price_total= ($actual_price_total + $actual_price);

            if($part_sales<=0){
            $new_savings=0; 
            }

            if($new_savings<0){
            $new_savings = 0;   
            $additional_price = ($actual_price - $part);    
            }else{
            $additional_price = 0;  
            }

            if($actual_price>0){
            $color = "green";   
            }else{
            $color = "red"; 
            }
            $actup = 0;
            if(number_format($dbrow2->MarkUp2)==0){
                $markup = 'Nett + '.$dbrow2->MarkUp.'% Mark Up';
                $actup  = $dbrow2->Outwork*(1+($dbrow2->MarkUp/100));
            }else{
                $markup = $dbrow2->MarkUp2.'% Mark Up Only';
                $actup  = $dbrow2->Outwork*(($dbrow2->MarkUp2/100));
            }
            $ttalout += $actup;
            $btm  = $actup*$betterment/100;
            $btm_total+=$btm;
            #$html='
            $html .='
            <tr>
            <td style="width:20px;">'.$no.'</td>
            <td style="width:140px;">'.$description.'</td>
            <td style="width:79px;">Outwork</td>
            <td style="width:56px;">'.number_format($part_sales,2).'</td>
            <td style="width:100px;">'.$markup.'</td>
            <td style="width:56px;">'.number_format($btm,2).'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format($actup,2).'</td>
            </tr>
            ';
            $no++;  
            $less_saving     += $new_savings;
            $plus_additional += $additional_price;

            }
            }else{
            $sundries = 0;  
            $disc_val = 0;  
            }
            $html .='</table>';

            #ADD 5
            $html .='
            <table border="0" style="width:100%;font-size:8px;">
            <tr>
            <td colspan="4" style="width:283px;"></td>
            <td colspan="0" style="width:112px;"><h4>Sub Total</h4></td>
            <td colspan="3" style="background-color:silver;width:168px;">R'.number_format($btm_total,2).'</td>
            <td style="background-color:silver;width:56px;">R'.number_format(0,2).'</td>
            <td colspan="2" style="background-color:silver;width:56px;">R'.number_format($ttalout,2).'</td>
            </tr>
            </table><br><br>
            ';


            #ADD 6
            $html .='
            <table border="1" style="width:100%;font-size:7px;">
            <tr style="background-color:black;color:white;">
            <td style="width:20px;"><h4>No</h4></td>
            <td style="width:140px;"><h4>Inhouse</h4></td>
            <td style="width:79px;"><h4>Oper</h4></td>
            <td style="width:56px;"><h4>Landing Price</h4></td>
            <td style="width:100px;"><h4>Mark-Up</h4></td>
            <td style="width:56px;"><h4>Betterment</h4></td>
            <td style="width:56px;"><h4>Saving</h5></td>
            <td style="width:56px;"><h4>Additional</h4></td>
            <td style="width:56px;"><h4>Quoted Price</h4></td>
            <td style="width:56px;"><h4>Actual Price</h4></td>
            </tr>
            
            ';


            #ADD 6
            $no = 1;
            $betterment_total   = 0;
            $part_total         = 0;
            $actual_price_total = 0;
            $plus_additional    = 0;
            $less_saving        = 0;
            $ttalInh = 0;
            $btmntttl=0;

            $dbcmd2 =  DB::select("SELECT * FROM additional WHERE Key_Ref=? AND (Inhouse>0 or Inhouse<0) ORDER BY id",[$id]);

            if( count($dbcmd2) >0){    

            foreach($dbcmd2 as $dbrow2){

            $part_id     = $dbrow2->id;
            $oper        = $dbrow2->Oper;
            $description = $dbrow2->Description;
            $percent     = ($dbrow2->Inhouse*$dbrow2->Percent/100);
            $quantity    = $dbrow2->Quantity;
            $part        = ($dbrow2->Inhouse+$percent);
            $part_sales  = $dbrow2->Inhouse;
            $markup      = $dbrow2->MarkUp;
            $betterment  = $dbrow2->Betterment;
                
            $savings     =($part_sales * $markup/100);
            $actual_price=($part_sales + $savings);
            $new_savings =($part - $actual_price);

            $betterment_total  = ($betterment_total + $actual_price * $betterment / 100);
            $part_total        = ($part_total + $part);
            $actual_price_total= ($actual_price_total + $actual_price);

            if($part_sales<=0){
            $new_savings=0; 
            }

            if($new_savings<0){
            $new_savings = 0;   
            $additional_price = ($actual_price - $part);    
            }else{
            $additional_price = 0;  
            }

            if($actual_price>0){
            $color = "green";   
            }else{
            $color = "red"; 
            }
            if(number_format($dbrow2->MarkUp2)==0){
                $markup = 'Nett + '.$dbrow2->MarkUp.'% Mark Up';
                $actup = $dbrow2->Inhouse*(1+($dbrow2->MarkUp/100));
            }else{
                $markup = $dbrow2->MarkUp2.'% Mark Up Only';
                $actup = $dbrow2->Inhouse*(($dbrow2->MarkUp2/100));
            }
            $ttalInh += $actup;
            $btmnt = $betterment*$actup/100;
            $btmntttl +=$btmnt;
            #$html='
            $html .='
            <tr>
            <td style="width:20px;">'.$no.'</td>
            <td style="width:140px;">'.$description.'</td>
            <td style="width:79px;">Inhouse</td>
            <td style="width:56px;">'.number_format($part_sales,2).'</td>
            <td style="width:100px;">'.$markup.'</td>
            <td style="width:56px;">'.$btmnt.'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format($actup,2).'</td>
            </tr>
            ';
            $no++;  
            $less_saving     += $new_savings;
            $plus_additional += $additional_price;

            }
            }else{
            $sundries = 0;  
            $disc_val = 0;  
            }
            $html .='</table>';

            $html .='
            <table border="0" style="width:100%;font-size:8px;">
            <tr>
            <td colspan="4" style="width:283px;"></td>
            <td colspan="0" style="width:112px;"><h4>Sub Total</h4></td>
            <td colspan="3" style="background-color:silver;width:168px;">R'.number_format($btmntttl,2).'</td>
            <td style="background-color:silver;width:56px;">R'.number_format(0,2).'</td>
            <td colspan="2" style="background-color:silver;width:56px;">R'.number_format($ttalInh,2).'</td>
            </tr>
            </table>
            ';

        

            #ADD 6
            $html .='
            <table border="1"  style="width:100%;font-size:7px;">
            <tr style="background-color:black;color:white;">
            <td style="width:20px;"><h4>No</h4></td>
            <td style="width:140px;"><h4>R + R</h4></td>
            <td style="width:79px;"><h4>Oper</h4></td>
            <td style="width:56px;"><h4>Landing Price</h4></td>
            <td style="width:100px;"><h4>Mark-Up</h4></td>
            <td style="width:56px;"><h4>Betterment</h4></td>
            <td style="width:56px;"><h4>Saving</h5></td>
            <td style="width:56px;"><h4>Additional</h4></td>
            <td style="width:56px;"><h4>Quoted Price</h4></td>
            <td style="width:56px;"><h4>Actual Price</h4></td>
            </tr>
          
            ';


            #ADD 7
            $no = 1;
            $betterment_total   = 0;
            $part_total         = 0;
            $actual_price_total = 0;
            $plus_additional    = 0;
            $less_saving        = 0;
            $btmntttll = 0;

            $dbcmd2 =  DB::select("SELECT * FROM additional WHERE Key_Ref=? AND (RandR >0 or RandR <0)",[$id]);


            if( count($dbcmd2) >0){    

            foreach($dbcmd2 as $dbrow2){


            $part_id     = $dbrow2->id;
            $oper        = $dbrow2->Oper;
            $description = $dbrow2->Description;
            $percent     = $dbrow2->RandR;
            $quantity    = $dbrow2->Quantity;
            $part        = ($dbrow2->RandR+$percent);
            $part_sales  = $dbrow2->RandR;
            $markup      = '0.00';
            $betterment  = $dbrow2->Betterment;
                
            $savings     =($part_sales * $markup/100);
            $actual_price=($part_sales);
            $new_savings =($part - $actual_price);

            $betterment_total  = ($betterment_total + $actual_price * $betterment / 100);
            $part_total        = ($part_total + $part);
            $actual_price_total= ($actual_price_total + $actual_price);

            if($part_sales<=0){
            $new_savings=0; 
            }

            if($new_savings<0){
            $new_savings = 0;   
            $additional_price = ($actual_price - $part);    
            }else{
            $additional_price = 0;  
            }

            if($actual_price>0){
            $color = "green";   
            }else{
            $color = "red"; 
            }
            $btmn = $betterment*$actual_price/100;
            $btmntttll += $btmn;
            $html .='
            <tr>
            <td style="width:20px;">'.$no.'</td>
            <td style="width:140px;">'.$description.'</td>
            <td style="width:79px;">R + R</td>
            <td style="width:56px;">'.number_format($part_sales,2).'</td>
            <td style="width:100px;">'.$markup.'</td>
            <td style="width:56px;">'.  number_format($btmn,2).'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format($actual_price,2).'</td>
            </tr>
            ';
            $no++;  
            $less_saving     += $new_savings;
            $plus_additional += $additional_price;

            }
            }else{
            $sundries = 0;  
            $disc_val = 0;  
            }

            $html .='</table>';


            $html .='
            <table border="0" style="width:100%;font-size:8px;">
            <tr>
            <td colspan="4" style="width:283px;"></td>
            <td colspan="0" style="width:112px;"><h4>Sub Total</h4></td>
            <td colspan="3" style="background-color:silver;width:168px;">R'.number_format($btmntttll,2).'</td>
            <td style="background-color:silver;width:56px;">R'.number_format(0,2).'</td>
            <td colspan="2" style="background-color:silver;width:56px;">R'.number_format($actual_price_total,2).'</td>
            </tr>
            </table><br><br>
            ';


            #ADD 7
            $html .='
            <table border="1" style="width:100%;font-size:7px;">
            <tr style="background-color:black;color:white;">
            <td style="width:20px;"><h4>No</h4></td>
            <td style="width:140px;"><h4>Labour</h4></td>
            <td style="width:79px;"><h4>Oper</h4></td>
            <td style="width:56px;"><h4>Landing Price</h4></td>
            <td style="width:100px;"><h4>Mark-Up</h4></td>
            <td style="width:56px;"><h4>Betterment</h4></td>
            <td style="width:56px;"><h4>Saving</h5></td>
            <td style="width:56px;"><h4>Additional</h4></td>
            <td style="width:56px;"><h4>Quoted Price</h4></td>
            <td style="width:56px;"><h4>Actual Price</h4></td>
            </tr>
            
            ';
            

            #ADD 8
            $no = 1;
            $betterment_total   = 0;
            $part_total         = 0;
            $actual_price_total = 0;
            $plus_additional    = 0;
            $less_saving        = 0;
            $ttal = 0;

            # [ CURRENT LOADED UPDATES ]
            /*
            $dbcmd2 =  DB::select("SELECT distinct * FROM additional WHERE Key_Ref=? AND Labour>0 ORDER BY id",[$id]);
            $res    =  DB::select("SELECT distinct * FROM additional WHERE Key_Ref=? AND Frame>0 ORDER BY id",[$id]);*/

            $dbcmd2 =  DB::select("SELECT distinct * FROM additional WHERE Key_Ref=? AND (Labour>0 or Labour<0 ) ORDER BY id",[$id]);
            $res    =  DB::select("SELECT distinct * FROM additional WHERE Key_Ref=? AND (Frame>0 or Frame<0) ORDER BY id",[$id]);

            foreach($dbcmd2 as $dbrow2){

            $part_id     = $dbrow2->id;
            $oper        = $dbrow2->Oper;
            $description = $dbrow2->Description;
            $percent     = ($dbrow2->Labour);
            $quantity    = $dbrow2->Quantity;
            $part        = ($dbrow2->Labour+$percent);
            $part_sales  = $dbrow2->Labour;
            $markup      = '0.00';
            $betterment  = $dbrow2->Betterment;
                
            $savings     =($part_sales * $markup/100);
            $actual_price=($part_sales);
            $new_savings =($part - $actual_price);

            $betterment_total  = ($betterment_total + $actual_price * $betterment / 100);
            $part_total        = ($part_total + $part);
            $actual_price_total= ($actual_price_total + $actual_price);

            if($part_sales<=0){
            $new_savings=0; 
            }

            if($new_savings<0){
            $new_savings = 0;   
            $additional_price = ($actual_price - $part);    
            }else{
            $additional_price = 0;  
            }

            if($actual_price>0){
            $color = "green";   
            }else{
            $color = "red"; 
            }
            $lb = $dbrow2->Labour;
            $lbm = $dbrow2->Labour;
            $opa = 'Labor';
            $ttal += $dbrow2->Labour;

            $html .='
            <tr>
            <td style="width:20px;">'.$no.'</td>
            <td style="width:140px;">'.$description.'</td>
            <td style="width:79px;">'.$opa.'</td>
            <td style="width:56px;">'.number_format($lb,2).'</td>
            <td style="width:100px;">'.$markup.'</td>
            <td style="width:56px;">'.$betterment.'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format($lbm,2).'</td>
            </tr>
            
            ';
            $no++;  
            $less_saving     += $new_savings;
            $plus_additional += $additional_price;
            }


            $ttal1 = 0;

            #while($row =mysqli_fetch_assoc($res))
            foreach($res as $row){
            
                $lb = $row->Frame;
                $lbm = $row->Frame;
                $opa = 'Frame';
                $ttal1 += $row->Frame;

                $html .='
                <tr>
                <td style="width:20px;">'.$no.'</td>
                <td style="width:140px;">'.$description.'</td>
                <td style="width:79px;">'.$opa.'</td>
                <td style="width:56px;">'.number_format($lb,2).'</td>
                <td style="width:100px;">'.$markup.'</td>
                <td style="width:56px;">'.$betterment.'</td>
                <td style="width:56px;">'.number_format(0,2).'</td>
                <td style="width:56px;">'.number_format(0,2).'</td>
                <td style="width:56px;">'.number_format(0,2).'</td>
                <td style="width:56px;">'.number_format($lbm,2).'</td>
                </tr>
                ';
            }
            $html .='</table>';

            $ttal1_ = $ttal1+$ttal;
            $html .='
            <table border="0" style="width:100%;font-size:8px;">
            <tr>
            <td colspan="4" style="width:283px;"></td>
            <td colspan="0" style="width:112px;"><h4>Sub Total</h4></td>
            <td colspan="3" style="background-color:silver;width:168px;">R'.number_format($betterment_total,2).'</td>
            <td style="background-color:silver;width:56px;">R'.number_format(0,2).'</td>
            <td colspan="2" style="background-color:silver;width:56px;">R'.number_format($ttal1_,2).'</td>
            </tr>
            </table><br><br>
            ';

            
            #ADD 8
            $html .='
            <table border="1" style="width:100%;font-size:7px;">
            <tr style="background-color:black;color:white;">
            <td style="width:20px;"><h4>No</h4></td>
            <td style="width:140px;"><h4>Paint</h4></td>
            <td style="width:79px;"><h4>Oper</h4></td>
            <td style="width:56px;"><h4>Landing Price</h4></td>
            <td style="width:100px;"><h4>Mark-Up</h4></td>
            <td style="width:56px;"><h4>Betterment</h4></td>
            <td style="width:56px;"><h4>Saving</h5></td>
            <td style="width:56px;"><h4>Additional</h4></td>
            <td style="width:56px;"><h4>Quoted Price</h4></td>
            <td style="width:56px;"><h4>Actual Price</h4></td>
            </tr>
            ';


            $no = 1;
            $betterment_total   = 0;
            $part_total         = 0;
            $actual_price_total = 0;
            $plus_additional    = 0;
            $less_saving        = 0;

            #$dbcmd2  = "SELECT * FROM additional WHERE Key_Ref='$id' AND (Paint>0 or Paint<0) ORDER BY id";
            $dbcmd2 =  DB::select("SELECT * FROM additional WHERE Key_Ref=? AND (Paint>0 or Paint<0) ORDER BY id",[$id]);

            if( count( $dbcmd2 ) >0){
            foreach($dbcmd2 as $dbrow2){

            $part_id     = $dbrow2->id;
            $oper        = $dbrow2->Oper;
            $description = $dbrow2->Description;
            $percent     = ($dbrow2->Paint);
            $quantity    = $dbrow2->Quantity;
            $part        = ($dbrow2->Paint);
            $part_sales  = $dbrow2->Paint;
            $markup      = $dbrow2->MarkUp;
            $betterment  = $dbrow2->Betterment;
                
            $savings     =($part_sales * $markup/100);
            $actual_price=($part_sales);
            $new_savings =($part - $actual_price);

            $betterment_total  = ($betterment_total + $actual_price * $betterment / 100);
            $part_total        = ($part_total + $part);
            $actual_price_total= ($actual_price_total + $actual_price);

            if($part_sales<=0){
            $new_savings=0; 
            }

            if($new_savings<0){
            $new_savings = 0;   
            $additional_price = ($actual_price - $part);    
            }else{
            $additional_price = 0;  
            }

            if($actual_price>0){
            $color = "green";   
            }else{
            $color = "red"; 
            }

            $html .='
            <tr>
            <td style="width:20px;">'.$no.'</td>
            <td style="width:140px;">'.$description.'</td>
            <td style="width:79px;">Paint</td>
            <td style="width:56px;">'.number_format($part_sales,2).'</td>
            <td style="width:100px;">0.00</td>
            <td style="width:56px;">'.$betterment.'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format(0,2).'</td>
            <td style="width:56px;">'.number_format($actual_price,2).'</td>
            </tr>
            
            ';
            $no++;  
            $less_saving     += $new_savings;
            $plus_additional += $additional_price;

            }
            }else{
            $sundries = 0;  
            $disc_val = 0;  
            }
            $html .='</table>';

          

            #WATER MARK
            if( $value == 'all-figure' ){
                #ALL IN FIGURE
                $img_file ='img/watermark1.png'; 
                $pdf->Image($img_file, 0, 10, 210, 297, '', '', '', false, 300, '', false, false, 0);
                //$watermk ="ALL IN FIGURE TESTING";
                $watermk = '<tr><td style="font-size:20px;color:red;width:415;text-align:center;transform: skewY(-45deg);"><b>ALL IN FIGURE</b></td>
                            <td>            
                            <table style="color:red">
                                <tr>
                                    <td style="width:50"><b></b></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="width:100"><b>Sub Total:</b></td>
                                    <td style="width:100">_______________</td>
                                </tr>
                                <tr>
                                    <td><b>VAT(15%):</b></td>
                                    <td style="width:100">_______________</td>
                                </tr>
                                <tr>
                                    <td><b>Sub Total:</b></td>
                                    <td style="width:100">_______________</td>
                                </tr>
                                <tr>
                                    <td><b>Excess:</b></td>
                                    <td style="width:100">_______________</td>
                                </tr>
                                <tr>
                                    <td><b>Total</b></td>
                                    <td style="width:100">_______________</td>
                                </tr>
                            </table>
                           </td></tr>';  

            }else if(  $value == 'no-extra' ){
                #NO EXTRAS
                
                $img_file = 'img/watermark.png';
                $pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
                $watermk = '<tr><td style="font-size:20px;color:red;width:400;text-align:center;transform: skewY(-45deg);"><b>NO EXTRAS</b></td>
                            <td>            
                            <table style="color:red">
                                <tr>
                                    <td style="width:100"><b></b></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="width:100"><b>Sub Total:</b></td>
                                    <td style="width:100">_______________</td>
                                </tr>
                                <tr>
                                    <td><b>VAT(15%):</b></td>
                                    <td style="width:100">_______________</td>
                                </tr>
                                <tr>
                                    <td><b>Sub Total:</b></td>
                                    <td style="width:100">_______________</td>
                                </tr>
                                <tr>
                                    <td><b>Excess:</b></td>
                                    <td style="width:100">_______________</td>
                                </tr>
                                <tr>
                                    <td><b>Total</b></td>
                                    <td style="width:100">_______________</td>
                                </tr>
                            </table>
                           </td></tr>';


            }



            $html .='
            <table border="0" style="width:100%;font-size:8px;">
            <tr>
            <td colspan="4" style="width:283px;"></td>
            <td colspan="0" style="width:112px;"><h4>Sub Total</h4></td>
            <td colspan="3" style="background-color:silver;width:168px;">R'.number_format($betterment_total,2).'</td>
            <td style="background-color:silver;width:56px;">R'.number_format(0,2).'</td>
            <td colspan="2" style="background-color:silver;width:56px;">R'.number_format($actual_price_total,2).'</td>
            </tr>
            </table><br><br><br><br><br>
            <table>'. $watermk.'</table>';
           
           
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            return $pdf->Output('Additionals.pdf');



    }

    public function print_all_parts_list($id){
        $insurer_info=DB::select("SELECT * FROM insurer WHERE Key_Ref=?",[$id]);        

        if(count($insurer_info) > 0) {
            foreach($insurer_info as $row1){
			    $rateTable= $row1->rateTable;
                $Specify=$row1->rateTable;
                $insurer=$row1->Inserer;
                $Phone=$row1->Phone;
                $FaxNo=$row1->Fax;
                $Claim_NO=$row1->Claim_NO;
                $Oder_No=$row1->Oder_No;
                $Assessor=$row1->Assessor;
				}
        }


        $client_info=DB::select("SELECT * FROM client_details WHERE Key_Ref=?",[$id]);

        foreach($client_info as $row){
	        $owner= $row->Fisrt_Name;
            $vehicle=$row->Make." ". $row->Model;
            $reg= $row->Reg_No;
            $branch=$row->branch;
            $Chasses_No=$row->Chasses_No;
        }

        $parts_info=DB::select("SELECT * FROM qoutes WHERE Key_Ref=? and 
        (Oper='New' or Oper='Innouse' or Oper='Other' or Oper='Spray' or Oper='PDR' or Oper='Blend' or Oper='Used'  or Oper='Second hand' or Oper='Alternative' or Oper='Order' or Oper='Altr'or Oper='Repair'or Oper='Instock' or Oper='XXX' or Oper='In House Part' or Oper='In House Repair' or Oper='In House Elec Rep' or Oper='Remanuf' or Oper='Elect' or Oper='Material' or Oper='Service' or Oper='Partial Repair' or Oper='Partial Paint' or Oper='Realign' or Oper='R+R' or Oper='Replace' or Oper='Check' or Oper='Partial Rep' or Misc>'0')
        ORDER BY  `Oper` DESC",[$id]);
        $pdf=PDF::loadview('pdf.all_parts',['rateTable'=>$rateTable,'Specify'=>$Specify,'insurer'=>$insurer,'Phone'=>$Phone,
        'FaxNo'=>$FaxNo,'Claim_NO'=>$Claim_NO,'Oder_No'=>$Oder_No,'Assessor'=>$Assessor,'owner'=>$owner,'vehicle'=>$vehicle,
        'reg'=>$reg,'branch'=>$branch,'Chasses_No'=>$Chasses_No,'parts_info'=>$parts_info]);
        return $pdf->stream(''.$id.'-'.'Print Parts List.pdf');
    }  
    
    public function print_employee_timesheet($user,$from,$to){
        
        $user_clocking=DB::select("select * from clocking_history a WHERE a.user=? AND (a.`start`>=? AND a.`end`<=?)",[$user,$from,$to]);
        $pdf=PDF::loadview('pdf.user_timesheet',['user'=>$user,'to'=>$to,'from'=>$from,'user_clocking'=>$user_clocking])->setPaper('a4', 'landscape');
        return $pdf->stream(''.$user.'-'.'User Timesheet.pdf');
    }

    public function print_wip_report(Request $request){
      $from=$request->wip_from;
      $to=$request->wip_to;   
      $user=$request->wip_user;
      $vehicle_count=DB::select("select COUNT(DISTINCT Key_Ref) AS 'total_image' FROM track_photos WHERE user=? AND category='WORK IN PROGRESS' AND date BETWEEN ? AND ?",[$user,$from,$to]);
        $count_vehicle=0;
        foreach($vehicle_count as $row){
            $count_vehicle=$row->total_image;
        }
        $count_image=0;
        $image_count=DB::select("select COUNT(id) AS total_images FROM track_photos WHERE user=? AND category='WORK IN PROGRESS' AND date BETWEEN ? AND ?",[$user,$from,$to]);
        foreach($image_count as $rows){
            $count_image=$rows->total_images;
        }
        $count_comments=0;
        $comment_count=DB::select("select COUNT(id) AS total_comments FROM track_photos WHERE user=? AND picture_comment IS NOT NULL AND category='WORK IN PROGRESS' AND picture_comment!='NO COMMENT' AND date BETWEEN ? AND ?",[$user,$from,$to]);
        foreach($comment_count as $dbrow){
            $count_comments=$dbrow->total_comments;
        }          
      $user_wip=DB::select("select track_photos.date,track_photos.time,track_photos.stage,track_photos.Key_Ref,client_details.Make,client_details.Reg_No,track_photos.category,track_photos.picture_comment FROM track_photos LEFT JOIN client_details ON track_photos.Key_Ref = client_details.Key_Ref WHERE track_photos.user=? AND track_photos.category='WORK IN PROGRESS' AND track_photos.date BETWEEN ? AND ?",[$user,$from,$to]);
        
      $pdf=PDF::loadview('pdf.wip_report',['count_comments'=>$count_comments,'count_image'=>$count_image,'count_vehicle'=>$count_vehicle,'user'=>$user,'to'=>$to,'from'=>$from,'user_wip'=>$user_wip])->setPaper('a4', 'landscape');
        return $pdf->stream(''.$user.'-'.'WIP Photo Report.pdf');
    }

    public function print_client_invoice(Request $request){

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Nicola Asuni');
            $pdf->SetTitle('Tax Invoice');
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

            
            $pdf->setFooterData(array(0,64,0), array(0,64,128));

            
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            
            $pdf->setFontSubsetting(true);

            
            $pdf->SetFont('dejavusans', '', 8, '', true);

            
            $pdf->AddPage();

            
            $id          = $request->invoice_ref;
            $inv_to      = $request->invoice_to;
            $inv_address = $request->address;
            
            $inv_vat     = $request->inv_vat;
            $inv_desc    = $request->inv_desc;
            $inv_amount  = $request->inv_amount;
            $inv_discount= $request->inv_discount;
            $inv_date    = date('d-m-Y');
            $inv_time    = date('H:i:s');

            $key_ref     = 'N/A';
            $branch      = 'N/A';
            $Reg_No      = 'N/A';
            $Make        = 'N/A';
            $Model       = 'N/A';
            $Chasses_No  = 'N/A';
            $Inserer     = 'N/A';
            $Claim_NO    = 'N/A';
            $Excess_1    = 'N/A';
            $customer    = 'N/A';
            $address     = 'N/A';
            $city        = 'N/A';
            $code        = 'N/A';
            $vat_no      = 'N/A';

            

            $dbcmd=DB::select("SELECT a.Key_Ref,a.Fisrt_Name,a.Last_Name,a.Address_1,a.Address_2,a.Address_3,a.Vat_No,a.branch,a.Reg_No,a.Make,a.Model,a.Chasses_No,b.Inserer,
                        b.Claim_NO,d.Excess_1,c.customer,c.address,c.city,c.code,c.vat_no
                        FROM client_details a 
                        INNER JOIN insurer b ON a.Key_Ref=b.Key_Ref
                        LEFT JOIN invoice_table c ON b.invoice_id=c.id
                        LEFT JOIN betterment d ON b.Key_Ref=d.Key_Ref
                        WHERE a.Key_Ref='$id'");  
            
            

            if(count($dbcmd)>0){
            foreach($dbcmd as $dbrow){
            $key_ref     = $dbrow->Key_Ref;
            $branch      = $dbrow->branch;
            $Fisrt_Name  = $dbrow->Fisrt_Name;
            $Last_Name   = $dbrow->Last_Name;
            $Reg_No      = $dbrow->Reg_No;
            $Make        = $dbrow->Make;
            $Model       = $dbrow->Model;
            $Chasses_No  = $dbrow->Chasses_No;
            $Inserer     = $dbrow->Inserer;
            $Claim_NO    = $dbrow->Claim_NO;
            $Excess_1    = $dbrow->Excess_1;
            $customer    = $dbrow->customer;
            $address     = $dbrow->address;
            $city        = $dbrow->city;
            $code        = $dbrow->code;
            $vat_no      = $dbrow->vat_no;
            $Vat_No1     = $dbrow->Vat_No;

            $Address_1   = $dbrow->Address_1;
            $Address_2   = $dbrow->Address_2;
            $Address_3   = $dbrow->Address_3;

            }
            }else{
            $key_ref     = 'N/A';
            $branch      = 'N/A';
            $Reg_No      = 'N/A';
            $Make        = 'N/A';
            $Model       = 'N/A';
            $Chasses_No  = 'N/A';
            $Inserer     = 'N/A';
            $Claim_NO    = 'N/A';
            $Excess_1    = 'N/A';
            $customer    = 'N/A';
            $address     = 'N/A';
            $city        = 'N/A';
            $code        = 'N/A';
            $vat_no      = 'N/A';
            }			
            

            if($branch=="Selby"){
            $comp_name   = "M.A.G AutoBody Repairs - Selby";
            $comp_place  = "Selby 2001";
            $comp_street = "80 Booysens RD";
            $comp_tel    = "010 591 7550";
            $comp_email   = "info@motoraccidentgroup.co.za";
            }elseif($branch=="Longmeadow"){
            $comp_name   = "M.A.G AutoBody Repairs - Longmeadow";
            $comp_place  = "42 Longmeadow Boulevard";
            $comp_street = "Edenvale 1609";
            $comp_tel    = "010 500 0350";
            $comp_email  = "info@lm.motoraccidentgroup.co.za";
            }elseif($branch=="The Glen"){
            $comp_name   = "M.A.G Auto Care Centre The Glen";
            $comp_place  = "Lois Avenue";
            $comp_street = "Glen Eagles, Glenanda 7945";
            $comp_tel    = " 011 432 0163";
            $comp_email  = "info@glen.motoracidentgroup.co.za";
            }elseif($branch=="Glen"){
            $comp_name   = "M.A.G Auto Care Centre The Glen";
            $comp_place  = "Lois Avenue";
            $comp_street = "Glen Eagles, Glenanda 7945";
            $comp_tel    = " 011 432 0163";
            $comp_email  = "info@glen.motoracidentgroup.co.za";
            }else{
            $comp_name   = "M.A.G AutoBody Repairs - Selby";
            $comp_place  = "Selby 2001";
            $comp_street = "80 Booysens RD";
            $comp_tel    = "010 591 7550";
            $comp_email   = "info@motoraccidentgroup.co.za";
            }

            $html = 
            '
            <table>
            <tr>
            <th><h4>J.A MAG Investments (PTY)LTD</h4></th>
            <th rowspan="6" style="text-align:center;"><h2>INVOICE</h2></th>
            <th><h4>'.$comp_tel.'</h4></th>
            </tr>

            <tr>
            <th><h4>'.$comp_name.'</h4></th>
            <th><h4>086 551 8450</h4></th>
            </tr>

            <tr>
            <th><h4>'.$comp_place.'</h4></th>
            <th><h4>'.$comp_email.'</h4></th>
            </tr>

            <tr>
            <th><h4>'.$comp_street.'</h4></th>
            <th><h4>www.motoraccidentgroup.co.za</h4></th>
            </tr>

            <tr>
            <th><h4>4860258427</h4></th>
            <th><h4>'.date('Y-m-d H:i:s').'</h4></th>
            </tr>

            <tr>
            <th><h4>2016/504434/07</h4></th>
            <th><h4></h4></th>
            </tr>

            </table>
            ';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            $html = '
            <table border="1">
            <tr style="background-color:black;color:white;">
            <th><h4>Invoice To</h4></th>	
            <th></th>
            <th><h4>Vehicle Details</h4></th>
            </tr>

            <tr>
            <td>'.$inv_to.'</td>
            <td></td>
            <td>'.$Reg_No.'</td>
            </tr>

            <tr>
            <td>'.$inv_address.'</td>
            <td></td>
            <td>'.$Make.'</td>
            </tr>

            <tr>
            <td></td>
            <td></td>
            <td>'.$Model.'</td>
            </tr>

            <tr>
            <td></td>
            <td></td>
            <td></td>
            </tr>

            <tr>
            <td>'.$inv_vat.'</td>
            <td></td>
            <td></td>
            </tr>
            </table><br><br>

            <table border="1">
            <tr style="background-color:black;color:white;">
            <th><h4>Reg Number.</h4></th>
            <th><h4>Order Number</h4></th>
            <th><h4>Claim Number</h4></th>
            <th><h4>Insuarance</h4></th>
            </tr>

            <tr>
            <td>'.$Reg_No.'</td>
            <td>'.$id.'</td>
            <td>'.$Claim_NO.'</td>
            <td>'.$Inserer.'</td>
            </tr>
            </table><br><br>

            <table border="1">
            <tr style="background-color:black;color:white;">
            <th><h4>Description</h4></th>
            <th><h4>Quantity</h4></th>
            <th><h4>Rate</h4></th>
            <th><h4>Amount</h4></th>
            </tr>

            <tr>
            <td style="height:250px;">'.$inv_desc.'</td>
            <td>1</td>
            <td>'.number_format($inv_amount,2).'</td>
            <td>'.number_format($inv_amount,2).'</td>
            </tr>

            <tr>
            <td colspan="2" rowspan="4"></td>
            <td><h4>SUB TOTAL</h4></td>
            <td><h4>'.number_format($inv_amount,2).'</h4></td>
            </tr>

            <tr>
            <td><h4>VAT TOTAL</h4></td>
            <td><h4>'.number_format($inv_amount*15/100,2).'</h4></td>
            </tr>

            <tr>
            <td><h4>Discount@ '.$inv_discount.'%</h4></td>
            <td><h4>'.number_format($inv_amount*$inv_discount/100,2).'</h4></td>
            </tr>

            <tr>
            <td><h4>TOTAL</h4></td>
            <td><h4>'.number_format(($inv_amount + $inv_amount*15/100)-$inv_amount*$inv_discount/100,2).'</h4></td>
            </tr>
            </table>

            <b>PAYMENT TERMS ARE: STRICKLY 30 DAYS (USE INVOICE NUMBER AS REFERENCE)<br>
            N:B INTEREST CHARGED AT 11.5% PER MONTH/S THAT THIS INVOICE IS OUTSTANDING
            <br><br>
            FAX / EMAIL PROOF OF PAYMENT TO ATTENTION: ACCOUNTS DEPARTMENT 086 551 850 / info@motoraccidentgroup.co.za
            <br><br>
            NO CHEQUES ACCEPTED
            <br><br>
            <u>BANKING DETAILS</u><br>
            BANK: Standard Bank<br>
            BRANCH CODE: 006 005<br>
            ACC NO: 281 711 623<br>
            ACC NAME: J.A MAG Investment
            </b>

            ';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            ob_end_clean();
            if (!file_exists(__DIR__ . '../../../../models/UploadedDocs/'.$id.'/')) {
                mkdir(__DIR__ . '../../../../models/UploadedDocs/'.$id.'/', 0777, true);
            }

            // ---------------------------------------------------------
            $fil_name = "M.A.G-Invoice.pdf";
            //save invoice in database
            //$dbcmd   = "insert into document(Key_Ref,url,date,time,Description)values('$id','$fil_name','$inv_date','$inv_time','Invoice')";
            //$dbquery = $db->query($dbcmd); 
            // Close and output PDF document
            // This method has several options, check the source code documentation for more information.
            $pdf->Output('Tax Invoice.pdf', 'I');
            //$pdf->Output(__DIR__ . '../../../../models/UploadedDocs/'.$id.'/'.$fil_name, 'F');
            //============================================================+
            // END OF FILE
            //============================================================+
    }

    public function print_additional_notes($id,$no){
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetMargins("5", "5", PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	    require_once(dirname(__FILE__).'/lang/eng.php');
	    $pdf->setLanguageArray($l);
}
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage('L', 'A4');


$no = $_SESSION['identie'];
$usa = Auth::user()->username;
$otp = 'ORDER'.str_pad(mt_rand(0,9999),6,'0',STR_PAD_LEFT);
$sql = DB::select("select distinct Reg_No,Make,Model,Chasses_No,Assessor,Assessor_Email,Assessor_Tel,Inserer,Claim_NO,cd.Key_Ref from client_details cd left join insurer ins on cd.Key_Ref = ins.Key_Ref 
where  cd.Key_Ref=?",[$id]);
$rep = 'Motor Accident Group';
$vin = '';
$clmno = '';
$vmk = '';
$vrg = '';
$ass = '';
$assTel = '';
$ins = '';
$user = '';
$phon = '';
$assMail = '';
$tbl = '';
    foreach($sql as $row)
    {
        $vin = $row->Chasses_No;
        $clmno = $row->Claim_NO;
        $vmk = $row->Make." ".$row->Model;
        $vrg = $row->Reg_No;
        $ass = $row->Assessor;
        $assTel = $row->Assessor_Tel;
        $ins = $row->Inserer;
        //$user = $row['cnt'];
        //$phon = $row['cnt'];
        $assMail = $row->Assessor_Email;
    }
    $$result1 = DB::select("select * from additional where Key_Ref =? and No =?",[$id, $no]);
    $result2 =DB::select("select * from insurer where Key_Ref =?",[$id]);
    
    $cn = 1;
    $ttlpart = 0;
    $ttlpaint = 0;
    $ttllabor = 0;
    $ttlrnr = 0;
    $ttloutwk = 0;
    $ttlInhse = 0;
    $ttlpartr = 0;
    $ttlpaintr = 0;
    $ttllaborr = 0;
    $ttlrnrr = 0;
    $ttloutwkr = 0;
    $ttlInhser = 0;
    $ttlframe = 0;
    $part = 0;
    $qty = 0;
    $pat= 0;
    foreach($result2 as $row1)
    { 
        $ttlpaintr = $row1->Paint;
        $ttllaborr = $row1->labour;
    }
    foreach($result1 as $row1)
    {
        $part =  $row1->Part;
        $qty = $row1->Quantity;
       if($qty>0){
           $pat = $part;
           $ttlpart += $pat*$qty;
           $ttlpaint += $row1->Paint;
           $ttlframe += $row1->Frame;
           $ttllabor += $row1->Labour;
           $ttlrnr += $row1->RandR;
           $ttloutwk += $row1->Outwork;
           $ttlInhse += $row1->Inhouse;
       }else{
           $pat = $part;
           $ttlpart += $pat;
        $ttlpaint += $row1->Paint;
        $ttlframe += $row1->Frame;
        $ttllabor += $row1->Labour;
        $ttlrnr += $row1->RandR;
        $ttloutwk += $row1->Outwork;
        $ttlInhse += $row1->Inhouse;
       }
        $tbl.= '<tr style="font-family:courier;font-size:9">'
                . '<td> '.$cn.'</td>'
                . '<td> '.$row1->Description.'</td>'
                . '<td> '.$row1->Oper.'</td>'
                . '<td style="text-align:right"> '.number_format($pat,2).'</td>'
                . '<td style="text-align:right"> '.number_format($row1->Paint,2).'</td>'
                . '<td style="text-align:right"> '.number_format($row1->Frame,2).'</td>'
                . '<td style="text-align:right"> '.number_format($row1->Labour,2).'</td>'
                . '<td style="text-align:right"> '.number_format($row1->RandR,2).'</td>'
                . '<td style="text-align:right"> '.number_format($row1->Outwork,2).'</td>'
                . '<td style="text-align:right"> '.number_format($row1->Inhouse,2).'</td>'
                . '<td style="color:gray"><i>'.$row1->Comments.'</i></td>'
                . '</tr>';
        $cn++;
        
    }
    $tbl.= '<tr style="font-family:courier;font-size:9">'
                . '<td style="border-right:1px solid grey;"><b>Total</b></td>'
                . '<td style="border-right:1px solid grey;"></td>'
                . '<td style="border-right:1px solid grey;"></td>'
                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttlpart,2).'</b></td>'
                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttlpaint,2).'</b></td>'
                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttlframe,2).'</b></td>'
                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttllabor,2).'</b></td>'
                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttlrnr,2).'</b></td>'
                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttloutwk,2).'</b></td>'
                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttlInhse,2).'</b></td>'
                . '<td style="border-right:1px solid grey;"></td>'
                . '</tr>';
    $resulta=DB::select("select * from additionalphotos where Key_Ref=? and No =?",[$id,$no]);

$image = "";
foreach($resulta as $rowa)
{
    $image.='<img src="../../../../mag_qoutation/photos/'.$id.'/'.$rowa->url.'" width="900" alt=""/><br>';
}
$html = <<<EOD
        <p></p>
        <div>
        <table style="width:1200">
            <tr>
                <td>
                    <table style="font-size:12">
                        <tr>
                            <td><b>Motor Accident Group</b></td>
                        </tr>
                        <tr>
                            <td><b>Notification Of Additional/Savings and Differences</b></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table style="font-size:8">
                        <tr>
                            <td style="width:50"><b>REF:</b></td>
                            <td>$id</td>
                        </tr>
                        <tr>
                            <td style="width:50"><b>OTP:</b></td>
                            <td>$otp</td>
                        </tr>
                        <tr>
                            <td style="width:50"><b>Email:</b></td>
                            <td>add@motoraccidentgroup.co.za</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <p></p>
        <table style="font-family:courier;font-size:10;width:1200">
            <tr>
                <td style="width:150"><b>REPAIRER:</b></td>
                <td>$rep</td>
                <td style="width:150"><b>ASSESSOR:</b></td>
                <td>$ass</td>
            </tr>
            <tr>
                <td style="width:150"><b>VIN:</b></td>
                <td>$vin</td>
                <td style="width:150"><b>ASSESSOR TEL:</b></td>
                <td>$assTel</td>
            </tr>
            <tr>
                <td style="width:150"><b>CLAIM NO:</b></td>
                <td>$clmno</td>
                <td style="width:150"><b>INSURANCE:</b></td>
                <td>$ins</td>
            </tr>
            <tr>
                <td style="width:150"><b>VEHICLE MAKE:</b></td>
                <td>$vmk</td>
                <td style="width:150"><b>DONE BY:</b></td>
                <td>$usa</td>
            </tr>
            <tr>
                <td><b>VEHICLE REG:</b></td>
                <td>$vrg</td>
                <td style="width:150"><b>TELEPHONE NO:</b></td>
                <td>0112345678</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="width:150"><b>ASSESSOR MAIL:</b></td>
                <td style="width:250">$assMail</td>
            </tr>
        </table>
        </div>
        <p></p>
        <table border="1" style="width:1200">
            <tr style="background-color:silver;font-family:courier;font-size:9">
                <td style="width:50"><b> #</b></td>
                <td style="width:130"><b> Description</b></td>
                <td><b> Oper</b></td>
                <td style="width:80;text-align:right"><b> Parts</b></td>
                <td style="width:80;text-align:right"><b> Paint</b></td>
                <td style="width:80;text-align:right"><b> Frame</b></td>
                <td style="width:80;text-align:right"><b> Labor</b></td>
                <td style="width:80;text-align:right"><b> R&R</b></td>
                <td style="width:80;text-align:right"><b> Outwork</b></td>
                <td style="width:80;text-align:right"><b> Inhouse</b></td>
                <td style="width:160"><b> Reason why allowed</b></td>
            </tr>
            $tbl
        </table>
        
        <p style="font-family:courier;font-size:8"><b> NB: PLEASE EMAIL BACK TO M.A.G TO COMMENCE AT add@motoraccidentgroup.co.za</b></p>
        <p></p>
        <p>Signature:....................................</p>
        $image
EOD;
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$fil_name = $id."qoute".date('Ydmhs').'file.pdf';
$pdf->Output(__DIR__ .'/'.$fil_name, 'F');

}


    
    # [ CURRENT LOADED UPDATES NOW ]
    public function print_and_email_notification( Request $request ){

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetMargins("5", "5", PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->AddPage('L', 'A4');

        $id = $request->id;        //Key_Ref
        $no = $request->get_additional_no;
        $usa = Auth::user()->username;

        $email = $request->final_stage_address;

        $otp = 'ORDER'.str_pad(mt_rand(0,9999),6,'0',STR_PAD_LEFT);
        $sql = "select distinct Reg_No,Make,Model,Chasses_No,Assessor,Assessor_Email,Assessor_Tel,Inserer,Claim_NO,cd.Key_Ref from client_details cd left join insurer ins on cd.Key_Ref = ins.Key_Ref 
        where  cd.Key_Ref=?";
        $rep = 'Motor Accident Group';
        $vin = '';
        $clmno = '';
        $vmk = '';
        $vrg = '';
        $ass = '';
        $assTel = '';
        $ins = '';
        $user = '';
        $phon = '';
        $assMail = '';
        $tbl = '';
        $result=DB::select($sql,[$id]);
            //while($row =mysqli_fetch_assoc($result))
            foreach($result as $row)
            {
                $vin = $row->Chasses_No;
                $clmno = $row->Claim_NO;
                $vmk = $row->Make." ".$row->Model;
                $vrg = $row->Reg_No;
                $ass = $row->Assessor;
                $assTel = $row->Assessor_Tel;
                $ins = $row->Inserer;
                //$user = $row['cnt'];
                //$phon = $row['cnt'];
                $assMail = $row->Assessor_Email;
            }
            
           
            $result1=DB::select("select * from additional where Key_Ref =? and No =?",[$id,$no]);
            $result2=DB::select("select * from insurer where Key_Ref =?",[$id]);

            $cn = 1;
            $ttlpart = 0;
            $ttlpaint = 0;
            $ttllabor = 0;
            $ttlrnr = 0;
            $ttloutwk = 0;
            $ttlInhse = 0;
            $ttlpartr = 0;
            $ttlpaintr = 0;
            $ttllaborr = 0;
            $ttlrnrr = 0;
            $ttloutwkr = 0;
            $ttlInhser = 0;
            $ttlframe = 0;
            $part = 0;
            $qty = 0;
            $pat= 0;
            foreach($result2 as $row1)
            { 
                $ttlpaintr = $row1->Paint;
                $ttllaborr = $row1->labour;
            }

            foreach($result1 as $row1)
            {
                $part =  $row1->Part;
                $qty = $row1->Quantity;
            if($qty>0){
                $pat = $part;
                $ttlpart += $pat*$qty;
                $ttlpaint += $row1->Paint;
                $ttlframe += $row1->Frame;
                $ttllabor += $row1->Labour;
                $ttlrnr += $row1->RandR;
                $ttloutwk += $row1->Outwork;
                $ttlInhse += $row1->Inhouse;
            }else{
                $pat = $part;
                $ttlpart += $pat;
                $ttlpaint += $row1->Paint;
                $ttlframe += $row1->Frame;
                $ttllabor += $row1->Labour;
                $ttlrnr += $row1->RandR;
                $ttloutwk += $row1->Outwork;
                $ttlInhse += $row1->Inhouse;
            }
                $tbl.= '<tr style="font-family:courier;font-size:9">'
                        . '<td> '.$cn.'</td>'
                        . '<td> '.$row1->Description.'</td>'
                        . '<td> '.$row1->Oper.'</td>'
                        . '<td style="text-align:right"> '.number_format($pat,2).'</td>'
                        . '<td style="text-align:right"> '.number_format($row1->Paint,2).'</td>'
                        . '<td style="text-align:right"> '.number_format($row1->Frame,2).'</td>'
                        . '<td style="text-align:right"> '.number_format($row1->Labour,2).'</td>'
                        . '<td style="text-align:right"> '.number_format($row1->RandR,2).'</td>'
                        . '<td style="text-align:right"> '.number_format($row1->Outwork,2).'</td>'
                        . '<td style="text-align:right"> '.number_format($row1->Inhouse,2).'</td>'
                        . '<td style="color:gray"><i>'.$row1->Comments.'</i></td>'
                        . '</tr>';
                $cn++;
                
            }
            $tbl.= '<tr style="font-family:courier;font-size:9">'
                        . '<td style="border-right:1px solid grey;"><b>Total</b></td>'
                        . '<td style="border-right:1px solid grey;"></td>'
                        . '<td style="border-right:1px solid grey;"></td>'
                        . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttlpart,2).'</b></td>'
                        . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttlpaint,2).'</b></td>'
                        . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttlframe,2).'</b></td>'
                        . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttllabor,2).'</b></td>'
                        . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttlrnr,2).'</b></td>'
                        . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttloutwk,2).'</b></td>'
                        . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttlInhse,2).'</b></td>'
                        . '<td style="border-right:1px solid grey;"></td>'
                        . '</tr>';

       
        $resulta=DB::select("select * from additionalphotos where Key_Ref=? and No =?",[$id,$no]);

        $image = "";
        foreach($resulta as $rowa)
        {
            $image.='<img src="../../../../mag_qoutation/photos/'.$id.'/'.$rowa->url.'" width="900" alt=""/><br>';
        }
        $html = <<<EOD
                <p></p>
                <div>
                <table style="width:1200">
                    <tr>
                        <td>
                            <table style="font-size:12">
                                <tr>
                                    <td><b>Motor Accident Group</b></td>
                                </tr>
                                <tr>
                                    <td><b>Notification Of Additional/Savings and Differences</b></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table style="font-size:8">
                                <tr>
                                    <td style="width:50"><b>REF:</b></td>
                                    <td>$id</td>
                                </tr>
                                <tr>
                                    <td style="width:50"><b>OTP:</b></td>
                                    <td>$otp</td>
                                </tr>
                                <tr>
                                    <td style="width:50"><b>Email:</b></td>
                                    <td>add@motoraccidentgroup.co.za</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <p></p>
                <table style="font-family:courier;font-size:10;width:1200">
                    <tr>
                        <td style="width:150"><b>REPAIRER:</b></td>
                        <td>$rep</td>
                        <td style="width:150"><b>ASSESSOR:</b></td>
                        <td>$ass</td>
                    </tr>
                    <tr>
                        <td style="width:150"><b>VIN:</b></td>
                        <td>$vin</td>
                        <td style="width:150"><b>ASSESSOR TEL:</b></td>
                        <td>$assTel</td>
                    </tr>
                    <tr>
                        <td style="width:150"><b>CLAIM NO:</b></td>
                        <td>$clmno</td>
                        <td style="width:150"><b>INSURANCE:</b></td>
                        <td>$ins</td>
                    </tr>
                    <tr>
                        <td style="width:150"><b>VEHICLE MAKE:</b></td>
                        <td>$vmk</td>
                        <td style="width:150"><b>DONE BY:</b></td>
                        <td>$usa</td>
                    </tr>
                    <tr>
                        <td><b>VEHICLE REG:</b></td>
                        <td>$vrg</td>
                        <td style="width:150"><b>TELEPHONE NO:</b></td>
                        <td>0112345678</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="width:150"><b>ASSESSOR MAIL:</b></td>
                        <td style="width:250">$assMail</td>
                    </tr>
                </table>
                </div>
                <p></p>
                <table border="1" style="width:1200">
                    <tr style="background-color:silver;font-family:courier;font-size:9">
                        <td style="width:50"><b> #</b></td>
                        <td style="width:130"><b> Description</b></td>
                        <td><b> Oper</b></td>
                        <td style="width:80;text-align:right"><b> Parts</b></td>
                        <td style="width:80;text-align:right"><b> Paint</b></td>
                        <td style="width:80;text-align:right"><b> Frame</b></td>
                        <td style="width:80;text-align:right"><b> Labor</b></td>
                        <td style="width:80;text-align:right"><b> R&R</b></td>
                        <td style="width:80;text-align:right"><b> Outwork</b></td>
                        <td style="width:80;text-align:right"><b> Inhouse</b></td>
                        <td style="width:160"><b> Reason why allowed</b></td>
                    </tr>
                    $tbl
                </table>
                
                <p style="font-family:courier;font-size:8"><b> NB: PLEASE EMAIL BACK TO M.A.G TO COMMENCE AT add@motoraccidentgroup.co.za</b></p>
                <p></p>
                <p>Signature:....................................</p>
                $image
EOD;
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
       

        $document = "";
        $fil_name = "";
        $fil_name = $id."qoute".date('Ydmhs').'file.pdf';
        
        $document = $pdf->Output($fil_name, 'S');


        #final_stage_address
        #foreach ($_SESSION['identMails'] as $email){


        $mail = new PHPMailer(true);

        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'mag.accounzi2018@gmail.com';                     // SMTP username
        $mail->Password   = '123coded';                              // SMTP password

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                        // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom("photos@motoraccidentgroup.co.za", 'Motor Accident Group');
        $mail->addReplyTo('info@motoraccidentgroup.co.za', 'Motor Accident Group');
        $mail->addAddress($email, '');
        //$mail->addAddress('s.madela@gmail.com', '');

        $mail->addStringAttachment($document,$fil_name);

        // Content
        $mail->Subject = $vrg.' Additionals';

        //$mail->Body    = 'Please find the attached document.';
        $mail->MsgHTML("Please find the Additionals attached below.<br>Regards<br>Motor Accident Group.");
        $mail->IsHTML(true);
        $mail->AltBody = '';

        $mail->send();
    
        if( !$mail ){
            echo 1;
        }else{
            echo 0;
        }

        /*
        $sqlq = "UPDATE `user` SET `otp`=? WHERE `use_username`=?";
        $resulta=DB::select($sqlq ,[$otp,$usa]);*/

        $pdf->Output($fil_name, 'I');


    }


    #[ CURRENT LOADED UPDATES ]
    public function print_notification( Request $request ){

               
                // create new PDF document
                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
                $pdf->SetMargins("5", "5", PDF_MARGIN_RIGHT);
                $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);
    
                // set auto page breaks
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
                // set image scale factor
                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                    require_once(dirname(__FILE__).'/lang/eng.php');
                    $pdf->setLanguageArray($l);
                }
                $pdf->setFontSubsetting(true);
                $pdf->SetFont('dejavusans', '', 10, '', true);
                $pdf->AddPage('L', 'A4');
    
               
    
                $id = $request->id;        //Key_Ref
                //$no = $request->get_additional_no;
                $no = $request->print_additional_no;
                $usa = Auth::user()->username;
    
                $email = $request->final_stage_address;
    
                $otp = 'ORDER'.str_pad(mt_rand(0,9999),6,'0',STR_PAD_LEFT);

                #UPDATE THE CLIENT OTP  [ 07 APRIL 2021 ]
                DB::table('users')->where('username','=',$usa)->update(['otp'=>$otp]);

                $sql = "select distinct Reg_No,Make,Model,Chasses_No,Assessor,Assessor_Email,Assessor_Tel,Inserer,Claim_NO,cd.Key_Ref from client_details cd left join insurer ins on cd.Key_Ref = ins.Key_Ref 
                where  cd.Key_Ref=?";
                $rep = 'Motor Accident Group';
                $vin = '';
                $clmno = '';
                $vmk = '';
                $vrg = '';
                $ass = '';
                $assTel = '';
                $ins = '';
                $user = '';
                $phon = '';
                $assMail = '';
                $tbl = '';
                $result=DB::select($sql,[$id]);
                    foreach($result as $row)
                    {
                        $vin = $row->Chasses_No;
                        $clmno = $row->Claim_NO;
                        $vmk = $row->Make." ".$row->Model;
                        $vrg = $row->Reg_No;
                        $ass = $row->Assessor;
                        $assTel = $row->Assessor_Tel;
                        $ins = $row->Inserer;
                        //$user = $row['cnt'];
                        //$phon = $row['cnt'];
                        $assMail = $row->Assessor_Email;
                    }
                    
                   
                    
    
                    $result1=DB::select("select * from additional where Key_Ref =? and No =?",[$id,$no]);
                    $result2=DB::select("select * from insurer where Key_Ref =?",[$id]);
    
                    $cn = 1;
                    $ttlpart = 0;
                    $ttlpaint = 0;
                    $ttllabor = 0;
                    $ttlrnr = 0;
                    $ttloutwk = 0;
                    $ttlInhse = 0;
                    $ttlpartr = 0;
                    $ttlpaintr = 0;
                    $ttllaborr = 0;
                    $ttlrnrr = 0;
                    $ttloutwkr = 0;
                    $ttlInhser = 0;
                    $ttlframe = 0;
                    $part = 0;
                    $qty = 0;
                    $pat= 0;
                    foreach($result2 as $row1)
                    { 
                        $ttlpaintr = $row1->Paint;
                        $ttllaborr = $row1->labour;
                    }
    
                    foreach($result1 as $row1)
                    {
                        $part =  $row1->Part;
                        $qty = $row1->Quantity;
                       if($qty>0){
                           $pat = $part;
                           $ttlpart += $pat*$qty;
                           $ttlpaint += $row1->Paint;
                           $ttlframe += $row1->Frame;
                           $ttllabor += $row1->Labour;
                           $ttlrnr += $row1->RandR;
                           $ttloutwk += $row1->Outwork;
                           $ttlInhse += $row1->Inhouse;
                       }else{
                           $pat = $part;
                           $ttlpart += $pat;
                        $ttlpaint += $row1->Paint;
                        $ttlframe += $row1->Frame;
                        $ttllabor += $row1->Labour;
                        $ttlrnr += $row1->RandR;
                        $ttloutwk += $row1->Outwork;
                        $ttlInhse += $row1->Inhouse;
                       }
                        $tbl.= '<tr style="font-family:courier;font-size:9">'
                                . '<td> '.$cn.'</td>'
                                . '<td> '.$row1->Description.'</td>'
                                . '<td> '.$row1->Oper.'</td>'
                                . '<td style="text-align:right"> '.number_format($pat,2).'</td>'
                                . '<td style="text-align:right"> '.number_format($row1->Paint,2).'</td>'
                                . '<td style="text-align:right"> '.number_format($row1->Frame,2).'</td>'
                                . '<td style="text-align:right"> '.number_format($row1->Labour,2).'</td>'
                                . '<td style="text-align:right"> '.number_format($row1->RandR,2).'</td>'
                                . '<td style="text-align:right"> '.number_format($row1->Outwork,2).'</td>'
                                . '<td style="text-align:right"> '.number_format($row1->Inhouse,2).'</td>'
                                . '<td style="color:gray"><i>'.$row1->Comments.'</i></td>'
                                . '</tr>';
                        $cn++;
                        
                    }
                    $tbl.= '<tr style="font-family:courier;font-size:9">'
                                . '<td style="border-right:1px solid grey;"><b>Total</b></td>'
                                . '<td style="border-right:1px solid grey;"></td>'
                                . '<td style="border-right:1px solid grey;"></td>'
                                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttlpart,2).'</b></td>'
                                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttlpaint,2).'</b></td>'
                                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttlframe,2).'</b></td>'
                                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttllabor,2).'</b></td>'
                                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttlrnr,2).'</b></td>'
                                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttloutwk,2).'</b></td>'
                                . '<td style="border-right:1px solid grey;text-align:right"><b>'.number_format($ttlInhse,2).'</b></td>'
                                . '<td style="border-right:1px solid grey;"></td>'
                                . '</tr>';
    
               
    
                $resulta=DB::select("select * from additionalphotos where Key_Ref=? and No =?",[$id,$no]);
    
                $image = "";
                foreach($resulta as $rowa)
                {
                    $image.='<img src="../../../../mag_qoutation/photos/'.$id.'/'.$rowa->url.'" width="900" alt=""/><br>';
                }
                $html = <<<EOD
                        <p></p>
                        <div>
                        <table style="width:1200">
                            <tr>
                                <td>
                                    <table style="font-size:12">
                                        <tr>
                                            <td><b>Motor Accident Group</b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Notification Of Additional/Savings and Differences</b></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table style="font-size:8">
                                        <tr>
                                            <td style="width:50"><b>REF:</b></td>
                                            <td>$id</td>
                                        </tr>
                                        <tr>
                                            <td style="width:50"><b>OTP:</b></td>
                                            <td>$otp</td>
                                        </tr>
                                        <tr>
                                            <td style="width:50"><b>Email:</b></td>
                                            <td>add@motoraccidentgroup.co.za</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <p></p>
                        <table style="font-family:courier;font-size:10;width:1200">
                            <tr>
                                <td style="width:150"><b>REPAIRER:</b></td>
                                <td>$rep</td>
                                <td style="width:150"><b>ASSESSOR:</b></td>
                                <td>$ass</td>
                            </tr>
                            <tr>
                                <td style="width:150"><b>VIN:</b></td>
                                <td>$vin</td>
                                <td style="width:150"><b>ASSESSOR TEL:</b></td>
                                <td>$assTel</td>
                            </tr>
                            <tr>
                                <td style="width:150"><b>CLAIM NO:</b></td>
                                <td>$clmno</td>
                                <td style="width:150"><b>INSURANCE:</b></td>
                                <td>$ins</td>
                            </tr>
                            <tr>
                                <td style="width:150"><b>VEHICLE MAKE:</b></td>
                                <td>$vmk</td>
                                <td style="width:150"><b>DONE BY:</b></td>
                                <td>$usa</td>
                            </tr>
                            <tr>
                                <td><b>VEHICLE REG:</b></td>
                                <td>$vrg</td>
                                <td style="width:150"><b>TELEPHONE NO:</b></td>
                                <td>0112345678</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="width:150"><b>ASSESSOR MAIL:</b></td>
                                <td style="width:250">$assMail</td>
                            </tr>
                        </table>
                        </div>
                        <p></p>
                        <table border="1" style="width:1200">
                            <tr style="background-color:silver;font-family:courier;font-size:9">
                                <td style="width:50"><b> #</b></td>
                                <td style="width:130"><b> Description</b></td>
                                <td><b> Oper</b></td>
                                <td style="width:80;text-align:right"><b> Parts</b></td>
                                <td style="width:80;text-align:right"><b> Paint</b></td>
                                <td style="width:80;text-align:right"><b> Frame</b></td>
                                <td style="width:80;text-align:right"><b> Labor</b></td>
                                <td style="width:80;text-align:right"><b> R&R</b></td>
                                <td style="width:80;text-align:right"><b> Outwork</b></td>
                                <td style="width:80;text-align:right"><b> Inhouse</b></td>
                                <td style="width:160"><b> Reason why allowed</b></td>
                            </tr>
                            $tbl
                        </table>
                        
                        <p style="font-family:courier;font-size:8"><b> NB: PLEASE EMAIL BACK TO M.A.G TO COMMENCE AT add@motoraccidentgroup.co.za</b></p>
                        <p></p>
                        <p>Signature:....................................</p>
                        $image
EOD;
                $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
                
    
                $document = "";
                $fil_name = "";
                $fil_name = $id."qoute".date('Ydmhs').'file.pdf';
                
    
                $pdf->Output($fil_name, 'I');
    
    
            }

            public function print_covid_report(Request $request){
                $id=$request->covid_id;
                $from=$request->covid_from;
                $to=$request->covid_to;
                $name=$request->covid_name;
                $report=DB::table('covid_register')
                                ->where('userId','=',$id)
                                ->whereBetween('time_after',[$from,$to])
                                ->get();
                $table='';
                $signs='';
                foreach($report as $reports){
                    $table.='<tr>';
                    $table.='<td>'.$reports->time_after.'</td>';
                    $table.='<td>'.$reports->temperature.'</td>';
                    $strSymptoms='';
                    $strSymptoms_after='';
                    
                    $object=json_decode($reports->symptomsObj);
                    $object_after=json_decode($reports->symptomsObj_after);
                    if (is_array($object) || is_object($object)){
                    foreach($object as $list){
                        $type=$list->type;					
                        $status=$list->status;
                        if($list->status==true){
                        $strSymptoms.="".$type.",";			
                        }	
                        
                    }

                    }

                    if(is_array($object_after)|| is_object($object_after)){
                        foreach($object_after as $list){
                            $type=$list->type;					
                            $status=$list->status;
                        if($list->status==true){
                        $strSymptoms_after.="".$type.",";			
                        }   
                        }
                    }
                    
                    $table.='<td><b>'.$strSymptoms.'</b></td>';
                    if($reports->last24 == 0){
                        $table.='<td style="text-align:center;">No</td>';
                    }else{
                        $table.='<td style="text-align:center;color:red;">Yes</td>';
                    }
                    $table.='<td>'.$reports->temperature_after.'</td>';
                    $table.='<td><b>'.$strSymptoms_after.'</b></td>';
                    if($reports->last24_after==0){
                        $table.='<td style="text-align:center;">No</td>';
                    }else{
                        $table.='<td style="text-align:center;color:red;">Yes</td>';    
                    }
                    
                    $table.='</tr>';
                }
                $pdf=PDF::loadview('pdf.covidReport',['report'=>$table,'name'=>$name])->setPaper('a4','landscape');
                  return $pdf->stream('Covid Report.pdf');                  
            }
    


             #PRINT THE SUPPLIERS [ 17 MAY 2021 ]
        public function print_suppliers(){

            //array(width, height)   //array(400, 300)
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT,  array(600, 460), true, 'UTF-8', false);
    
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('Precosting');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    
    // set default header data
    //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'Proforma Invoice', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    
    $pdf->setFooterData(array(0,64,0), array(0,64,128));
    
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    
    // ---------------------------------------------------------
    
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);
    
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', '', 8, '', true);
    
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage();
    
    
    $suppliers=DB::table('supplier')->get();
    $html ='';
     //$html .='<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
     $html .='<h2 style="text-align:center"><b>SUPPLIERS</b></h2>

     <br><br>
     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:11px; padding:2px;">
        <thead>
            <tr style="font-weight:bold;background-color:black;color:white;">
                <th>#</th>
                <th>Supplier Name</th>
                <th>Supplier No.</th>
                <th>Contact Person</th>
                <th>Salesperson Email</th>
                <th>Account Department Email</th>
                <th>Cell Number</th>
                <!--<th>Alternative Cell Number</th> -->
    
            </tr>
        </thead>
        <tbody>';
            $count=1; 
           foreach($suppliers as $supplier){ 
            //<td>'.$supplier->cell_2.'</td>
             $html .='
            <tr>
                <td>'.$count.'</td>
                <td>'.$supplier->sup_name.'</td>
                <td>'.$supplier->sup_phone.'</td>
                <td>'.$supplier->sup_contact.'</td>
                <td>'.$supplier->sup_email.'</td>
                <td>'.$supplier->sup_fax.'</td>
                <td>'.$supplier->cell_1.'</td>
                
                
                
            </tr>';
              $count++;
            }
     $html .=' </tbody>
    
    </table>';
    
    $pdf->writeHTMLCell(0,0,'','',$html,0,1,0,true,'',true);
    ob_end_clean();
    $pdf->Output('Suppliers.pdf', 'I');
    
    
    
            }
        



#PRINT OIUT INPUT AND OUTPUT [ 18 MAY 2021 ]
   public function print_input_and_output( Request $request ){


        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT,  array(500, 400), true, 'UTF-8', false);
        //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Precosting');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'Proforma Invoice', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));

$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 8, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();


//$date = $request->date;
$date = $request->io_vattxt;


$suppliers=DB::table('supplier_invoices')->where('invoice_date','=',$date)->get();

$coun = 1;
$html = '';
$vattl = 0;
$amonttl = 0;
$totaltl = 0;


//<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:11px; padding:2px;">
//<table style="font-size:12px">

$html ='
<h2 style="text-align:center"><b>INPUT AND OUTPUT VAT '. $date .'</b></h2>

<br><br>


<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:11px; padding:2px;">
    <thead>
        <tr style="font-weight:bold;background-color:black;color:white;">
            <td><b>#</b></td>
            <td><b>Date</b></td>
            <td><b>Supplier</b></td>
            <td><b>Invoice No</b></td>
            <td><b>VAT Exclusive</b></td>
            <td><b>VAT Amount</b></td>
            <td><b>VAT Inclusive</b></td>
        </tr>
    </thead>
    <tbody>';
        
    //while($row =mysqli_fetch_assoc($res))
    foreach($suppliers as $row){
    
            $sup = $row->supplier;
            $dat = $row->invoice_date;
            $inv = $row->invoice_no;
            $vat = $row->vat;
            $amont = $row->amount;
            $total = $row->total;
            $html.= '<tr>
                        <td>'.$coun.'</td>
                        <td>'.$dat.'</td>
                        <td>'.$sup.'</td>
                        <td>'.$inv.'</td>
                        <td>'.number_format($amont,2).'</td>
                        <td>'.number_format($vat,2).'</td>
                        <td>'.number_format($total,2).'</td>
                    </tr>';
           $coun++;
           $vattl += $row->vat;
           $amonttl += $row->amount;
           $totaltl += $row->total;
   }
    $html .='<tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Total</b></td>
                <td style="background-color:silver"><b>'.number_format($amonttl,2).'</b></td>
                <td style="background-color:silver"><b>'.number_format($vattl,2).'</b></td>
                <td style="background-color:silver"><b>'.number_format($totaltl,2).'</b></td>
            </tr>

    </tbody>
</table>';


$pdf->writeHTMLCell(0,0,'','',$html,0,1,0,true,'',true);
ob_end_clean();
$pdf->Output('Input_Output_VAT.pdf', 'I');


   }
   public function print_covid_report_all(Request $request){
        $to=$request->covid_to_all;
        $from=$request->covid_from_all;

        $covid_all=DB::table('covid_register')
        ->whereBetween('time_after',[$from,$to])
        ->join('user', 'covid_register.userId', '=', 'user.use_key')
        ->select('covid_register.*', 'user.use_username')   
        ->get();

                $table='';
                $signs='';
                foreach($covid_all as $reports){
                    $table.='<tr>';
                    $table.='<td style="text-align:center;">'.$reports->time_after.'</td>';
                    $table.='<td style="text-align:center;">'.$reports->use_username.'</td>';
                    $table.='<td style="text-align:center;">'.$reports->temperature.'</td>';
                    $strSymptoms='';
                    $strSymptoms_after='';
                    
                    $object=json_decode($reports->symptomsObj);
                    $object_after=json_decode($reports->symptomsObj_after);
                    if (is_array($object) || is_object($object)){
                    foreach($object as $list){
                        $type=$list->type;					
                        $status=$list->status;
                        if($list->status==true){
                        $strSymptoms.="".$type.",";			
                        }	
                        
                    }

                    }

                    if(is_array($object_after)|| is_object($object_after)){
                        foreach($object_after as $list){
                            $type=$list->type;					
                            $status=$list->status;
                        if($list->status==true){
                        $strSymptoms_after.="".$type.",";			
                        }   
                        }
                    }
                    
                    $table.='<td style="text-align:center;"><b>'.$strSymptoms.'</b></td>';
                    if($reports->last24 == 0){
                        $table.='<td style="text-align:center;">No</td>';
                    }else{
                        $table.='<td style="text-align:center;color:red;">Yes</td>';
                    }
                    $table.='<td style="text-align:center;">'.$reports->temperature_after.'</td>';
                    
                    if($reports->last24_after==0){
                        $table.='<td style="text-align:center;">No</td>';
                    }else{
                        $table.='<td style="text-align:center;color:red;">Yes</td>';    
                    }
                    
                    $table.='</tr>';
                }
        
        $pdf=PDF::loadview('pdf.covid_all_users',['table'=>$table,'from'=>$from,'to'=>$to])->setPaper('a4', 'landscape');
        return $pdf->stream(''.$to.'-'.$from.' All Users Covid Report.pdf'); 


   }

   public function print_prebooking($id){
                        //============================================================+
            // File name   : example_001.php
            // Begin       : 2008-03-04
            // Last Update : 2013-05-14
            //
            // Description : Example 001 for TCPDF class
            //               Default Header and Footer
            //
            // Author: Nicola Asuni
            //
            // (c) Copyright:
            //               Nicola Asuni
            //               Tecnick.com LTD
            //               www.tecnick.com
            //               info@tecnick.com
            //============================================================+

            /**
             * Creates an example PDF TEST document using TCPDF
             * @package com.tecnick.tcpdf
             * @abstract TCPDF - Example: Default Header and Footer
             * @author Nicola Asuni
             * @since 2008-03-04
             */

            // Include the main TCPDF library (search for installation path).
            

            // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Nicola Asuni');
            $pdf->SetTitle('Receipt');
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

            /* set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
            $pdf->setFooterData(array(0,64,0), array(0,64,128));
            */
            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set default font subsetting mode
            $pdf->setFontSubsetting(true);

            // Set font
            // dejavusans is a UTF-8 Unicode font, if you only need to
            // print standard ASCII chars, you can use core fonts like
            // helvetica or times to reduce file size.
            $pdf->SetFont('dejavusans', '', 14, '', true);

            // Add a page
            // This method has several options, check the source code documentation for more information.
            $pdf->AddPage();


            

            $dbcmd   = DB::select("select * from client_details where Key_Ref=?",[$id]);
            
            $val1 = '';
            $val2 = '';
            foreach($dbcmd as $dbrow){

            $val1 = $dbrow->Fisrt_Name;
            $val2 = $dbrow->Last_Name;
            
            }
            
            $html ='
            <img src="img/selby.png"/>
            ';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            // Set some content to print
            $html ='

            <br/>

            <p style="font-size:14px;">
            Dear '.$val1." ".$val2.'<br/><br/>
            This is to confirm that you have booked
            your vehicle at Motor Accident Group for repairs. We thank you for your business and look
            forward to being of service to you.
            </p>

            <img src="doc_signs/'.$id.'/signature.png" width="200" height="66"/>

            <h6>'.$val1."-".$val2.'</h6>
            ';

            $dir = "receipt/".$id;

            //if(is_dir($dir)){
            //echo "directory exists";
            //}else{
            //mkdir($dir);
            //}
            // Print text using writeHTMLCell()
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            $pdf->AddPage();

            ////////////////////////////////Personal Belongings removed/////////////////////////////////////////////
            $sql_customer = DB::connection('mysql2')->select("SELECT * FROM customer WHERE Key_Ref=?",[$id]);    
            //$sql_customer =DB::select("SELECT * FROM customer WHERE Key_Ref=?",[$id]);

             if (count($sql_customer) > 0) {
                    foreach($sql_customer as $row3){
                    $Key_Ref 	= $row3->Key_Ref;
                    $cust_id	= $row3->cust_id;
                }
            }else{
                $cust_id ='';
            }
            $res= DB::connection('mysql2')->select("SELECT * FROM product WHERE cust_id=?",[$cust_id]);
               if (count($res) > 0) {
                    foreach($res as $row3){
                    $prod_ref	= $row3->prod_ref;
                    $prod_key 	= $row3->prod_key;
                }
            }

            $query_ins =DB::select("SELECT * FROM insurer Where Key_Ref=?",[$id]);
             if ($query_ins > 0) { 
            foreach($query_ins as $row1){
                
                $insurer=$row1->Inserer;
                $claimNo=$row1->Claim_NO;
                $rateTable=$row1->rateTable;
            }
            }else{
                $insurer='Not specifired';
                $claimNo='Not specifired';
            }

            $result3=DB::select("SELECT * FROM insurer");
            
                $vat = 0;
                $LabourRate =0;
                $PaintRate	= 0;
                $StripRate	= 0;
                $FrameRate	= 0;
                $Supp		= 0;
                $PaintSup	= 0;
            

            if (count($result3)>0) {
            foreach($result3 as $rateRow){
                $vat = ((int)$rateRow->vat) /100;
                $LabourRate = $rateRow->labour;
                $PaintRate	= $rateRow->Paint;
                $StripRate	= $rateRow->Strip;
                $FrameRate	= $rateRow->Frame;
                $Supp		= $rateRow->ShopSup;
                $PaintSup	= $rateRow->PaintSup;
            }
            }
            $pdf->setImageScale(1.3);
            $query2 =DB::select("SELECT * FROM client_details Where Key_Ref=?",[$id]);
            $Owner='';
            if (count($query2)>0) { 
            foreach($query2 as $row){
                $date 	= $row->Date;
                $Owner 	= $row->Fisrt_Name." ".$row->Last_Name;
                $vehicle = $row->Model;
                $regNo	= $row->Reg_No;
                $job_card_no  = $row->job_card_no;
                $RO		= $row->RO;
                if($row->branch=="Glen"){
                $image = 'img/glen.png';	
                }
                if($row->branch=="The Glen"){
                $image = 'img/glen.png';	
                }
                if($row->branch=="Longmeadow"){
                $image = 'img/Longmeadow.png';	
                }
                if($row->branch=="Selby"){
                $image = 'img/_blank.png';
                }	
                if($row->branch==""){
                $image = 'img/_blank.png';
                }	
                
                if($row->branch=="Select Branch"){
                $image = 'img/_blanky.png';
                }	
                
                $pdf->Image($image);
                $width ='300px;';
                $strText ="";
                $height	="38px";
                $strText = str_replace("\n","<br>",$strText);
                $pdf->MultiCell($width, $height,$strText, 0, 'J', 0, 1, '', '', true, null, true);

            }
            if(isset($prod_key)){
                $prod_ref =$prod_ref;
            }else{
                $prod_ref =$id;
            }
            $html=
            '<br><br><br><table>
            <tr>
            <td style=" font-size:12px;"><hr/><b>Personal Belonging Removed From Vehicle</b><hr/></td>
            </tr>
            </table>';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $html='<br/><br/><table style=" font-size:12px;">
                
                
                    <tr><td width="80px;">Vehicle 	</td><td>: '.strtoupper ($vehicle).'</td></tr>
                    <tr><td width="80px;">Reg No 	</td><td>: '.strtoupper ($regNo).'</td></tr>
                    <tr><td width="80px;">Date 		</td><td>: '.date('Y-m-d').'</td></tr>
                
                
                </table>';

            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            }




            $html='<br/>
            <p style="font-size:10px;">
            I '.$Owner.' have <b>REMOVED/ NOT REMOVED</b> all my belongings from my vehicle, any belongings left in the 
            vehicle, <b>M.A.G will not be held responsible</b> if the are missing and no claim will be made against M.A.G.
            </p><br/>';

            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $Manufacturer ="Manufacturer's";
            $suppliers    ="supplier's";
            $html='';

            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            $html ='
            <img src="doc_signs/'.$id.'/signature.png" width="200" height="66"/>
            <p style="font-size:10px;"><b>Customer Signed</b></p>
            ';

            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            //$pdf->Output(__DIR__ . '/receipt/'.$id."/"."booking-receipt".".pdf", 'F');
            // ---------------------------------------------------------

            // Close and output PDF document
            // This method has several options, check the source code documentation for more information.

            ob_end_clean();
            $pdf->Output('booking-receipt.pdf', 'I');
   }
    




        
}//End Of Controller