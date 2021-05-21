<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CreditorsController extends Controller
{
    

    public function index(){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $supplier=DB::table('supplier')->get();
        return view('creditors.creditors',['final'=>$final,'suppliers'=>$supplier,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
    }

    public function supplier_info($supp){
        
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;

        $sup_name=DB::table('supplier')->where('sup_key','=',$supp)->get();
        foreach($sup_name as $name){
            $supplier=$name->sup_name;
        }
        
        $pop=DB::table('supplierpop')->where('supplier','=',$supplier)->get();
        $invoice=DB::table('supplier_invoices')->where('supplier','=',$supplier)->where('vat_non','=',1)->get();
        $invoice_non=DB::table('supplier_invoices')->where('supplier','=',$supplier)->where('vat_non','=',0)->get();
        $rfc=DB::table('supplier_rfc')->where('supplier','=',$supplier)->get();
        $statement=DB::table('supplier_statements')->where('supplier','=',$supplier)->get();
        $supplier=DB::table('supplier')->get();
        $branches=DB::table('branch')->get();
        return view('creditors.info',['final'=>$final,'sup_name'=>$sup_name,'non_invoices'=>$invoice_non,'invoices'=>$invoice,'statements'=>$statement,'pops'=>$pop,'rfcs'=>$rfc,'suppliers'=>$supplier,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'branches'=>$branches]);
    }

    

    public function filter(Request $request){

        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
      $from=$request->creditor_from;
      $to=$request->creditor_to;
      $supplier=$request->supplier_name;

      $sup_name=DB::table('supplier')->where('sup_key','=',$supplier)->get();
       
      $suppliers=DB::table('supplier')->get();
      $branches=DB::table('branch')->get();
      $pop=DB::table('supplierpop')->where('supplier','=',$supplier)->whereBetween('paymentdate',[$from,$to])->get();
      $invoice=DB::table('supplier_invoices')->where('supplier','=',$supplier)->whereBetween('invoice_date',[$from,$to])->get();
      $rfc=DB::table('supplier_rfc')->where('supplier','=',$supplier)->whereBetween('rfcdate',[$from,$to])->get();
      $statement=DB::table('supplier_statements')->where('supplier','=',$supplier)->whereBetween('statement_date',[$from,$to])->get();
      $invoice_non=DB::table('supplier_invoices')->where('supplier','=',$supplier)->where('vat_non','=','0')->whereBetween('invoice_date',[$from,$to])->get();  
      return view('creditors.info',['final'=>$final,'sup_name'=>$sup_name,'invoices'=>$invoice,'non_invoices'=>$invoice_non,'statements'=>$statement,'pops'=>$pop,'rfcs'=>$rfc,'suppliers'=>$suppliers,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'branches'=>$branches]);
    }

    public function save_statement_doc(Request $request){
        
        $branch=substr($request->state_branch,4);
        $description=$request->state_description;
        $supplier=$request->state_supplier;
        $sta_date=$request->state_date;
        $accont_no=$request->state_account_no;
        $amount=$request->state_amount;
        $rebate_discount=$request->state_rebate_discount;
        $rebate_amount=$request->state_rebate_amount;
        $settle_discount=$request->state_settlement_dis;
        $settle_amount=$request->state_settlement_amount;
        $vat=$request->state_vat;
        $subtotal=$request->state_subtotal;
        $total=$request->state_total;

        $date=date('Y-m-d');
        $now=date('Y-m-d H:i:s');
        
        $file='STAT-'.$sta_date.' - '.$supplier.'.'.$request->image->getClientOriginalExtension();
        $paths='docs/supplier_statement/';
        $paths.=$supplier;
        $request->image->move(public_path($paths),$file);
        
        DB::table('supplier_statements')->insert([
            ['supplier'=>$supplier,'account'=>$accont_no,'file'=>$file,'description'=>$description,'statement_date'=>$sta_date,'date'=>$date,
            'branch'=>$branch,'amount'=>$amount,'es_discount'=>$settle_discount,'rebate_discount'=>$rebate_discount,'vat'=>$vat,'total'=>$total]
        ]);  
        return back()->with(['message'=>'Statement Document Successfully Saved.']);             
    }

    public function save_proof_doc(Request $request){
        $branch=$request->proof_branch;
        $description=$request->proof_description;
        $supplier=$request->proof_supplier;
        $pay_date=$request->proof_date;
        $pay_month=$request->proof_month;
        $pay=$request->proof_pay;
        $number=$request->proof_number;
        $invoice=$request->proof_invoice;
        $total=$request->proof_total;
        $file='POP-'.date('Y-m-d').'-'.$invoice.'.'.$request->proof_image->getClientOriginalExtension();
        $path='docs/supplier_pop/';
        $request->proof_image->move(public_path($path),$file);

        DB::table('supplierpop')->insert([
            ['branch'=>$branch,'supplier'=>$supplier,'invoice_no'=>$invoice,'file'=>$file,'description'=>$description,'method'=>$pay,
            'amount'=>$total,'total_amount'=>$total,'paymentdate'=>$pay_date,'paidmonth'=>$pay_month]
        ]);
        
        return back()->with(['message'=>'Proof Of Payment Document Successfully Saved.']);   
    }

    public function save_supplier_rfcs(Request $request){
        $branch=$request->rfcs_branch;
        $description=$request->rfcs_description;
        $supplier=$request->rfcs_supplier;
        $trackid=$request->rfcs_trackid;
        $invoice=$request->rfcs_invoice;
        $credit_note=$request->rfcs_credit;
        $date=$request->rfcs_date;
        $total=$request->rfcs_total;
        $comment=$request->rfcs_comment;
        $file='RFC-'.$supplier.date('dhis').'.'.$request->rfcs_image->getClientOriginalExtension();
        $path='docs/supplier_rfc/';
        $request->rfcs_image->move(public_path($path),$file);

        DB::table('supplier_rfc')->insert([
            ['branch'=>$branch,'file'=>$file,'description'=>$description,'supplier'=>$supplier,'rfcdate'=>$date,'amount'=>$total,'invoice_no'=>$invoice,'Key_Ref'=>$trackid,'rfcno'=>'0','comments'=>$comment]
        ]);
        return back()->with(['message'=>'Supplier RFCs Document Successfully Saved.']);

    }

   public function save_supplier_invoices(Request $request){
    $branch=substr($request->doc_branch,4);
    $image=$request->doc_invoice;
    $description=$request->doc_description;
    $vat_non=$request->doc_vat_non_vat;
    $supplier=$request->doc_supplier;
    $inv_date=$request->doc_inv_date;
    $type=$request->doc_select;
    $info=$request->doc_info;
    $inv_no=$request->doc_inv_no;
    $subtotal=$request->doc_subtotal;
    $vat=$request->doc_vat;
    $amount=$request->doc_amount;
    $total=$request->doc_total;
    $user=Auth::user()->username;
    $date = date('Y-m-d');
    $time1 = date('H:i:s');
    $timestamp = strtotime($time1) + 60*60;
    $time = date('H:i:s', $timestamp);
    $vann = 0;
    $other="";
    $other1='';
    $other2='';
    if($vat_non=='VAT'){
        $vann = 1;
    }else{
        $vann = 0;
    }
    if($type=='Track No'){
        $other = $info;
        $other1 = '';
        $other2 = '';
     }else 
         if($type=='Reg No'){
             $other1 =$info;
             $other = '';
             $other2 = '';
         }else 
         if($type=='Other'){
             $other2 = $info;
             $other = '';
             $other1 = '';
         }
         $file='INVOICE-'.$supplier.'-'.date('dhis').'.'.$request->doc_invoice->getClientOriginalExtension();
         $path='docs/supplier_invoice/';
         $image->move(public_path($path),$file);
    if($type=='Track No'){
        
        DB::table('document')->insert([
                ['Key_ref'=>$other,'url'=>$file,'date'=>$date,'time'=>$time,'Description'=>$description,'user'=>$user]

        ]);     
        DB::table('supplier_invoices')->insert([
            ['invoice_no'=>$inv_no,'vat_non'=>$vann,'supplier'=>$supplier,'file'=>$file,'description'=>$description,'invoice_date'=>$inv_date,'date'=>$date,'branch'=>$branch,'amount'=>$subtotal,'vat'=>$vat,'total'=>$total,'Key_Ref'=>$other,'Reg_No'=>$other1,'Other_id'=>$other2]    
         ]);     
     }else{
         DB::table('supplier_invoices')->insert([
            ['invoice_no'=>$inv_no,'vat_non'=>$vann,'supplier'=>$supplier,'file'=>$file,'description'=>$description,'invoice_date'=>$inv_date,'date'=>$date,'branch'=>$branch,'amount'=>$subtotal,'vat'=>$vat,'total'=>$total,'Key_Ref'=>$other,'Reg_No'=>$other1,'Other_id'=>$other2]    
         ]);
     }

     return back()->with(['message'=>'Supplier Invoice Document Successfully Saved.']);
   } 
}