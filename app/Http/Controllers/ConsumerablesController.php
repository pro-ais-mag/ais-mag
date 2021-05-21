<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class ConsumerablesController extends Controller
{
    public function index(){
        $total_products=DB::table('stock')->count();
        $total_supplier=DB::table('stock_supplier')->count();
        $total_invoices=DB::table('stock_history')->count();
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

        return view('consumerables.consumerablekpi',['count_supplier'=>$total_supplier,'count_products'=>$total_products,'count_invoice'=>$total_invoices,'highest'=>$highest,'lowest'=>$lowest]);
    }

    public function stock(){

        //Get Stock Query
        $stocks=DB::table('stock')->get();

        //Get Dashboard
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        return view('consumerables.stock',['final'=>$final,'stocks'=>$stocks,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
    }

    public function supplier(){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $supplier=DB::table('stock_supplier')->get();
        return view('consumerables.supplier',['final'=>$final,'suppliers'=>$supplier,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
    }

    public function comparison(){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $compare_products=DB::table('stock')
                                ->select('supplier','description','price','quantity','branch','stock_date')
                                ->orderBy('description','asc')
                                ->get();    
        return view('consumerables.compare',['final'=>$final,'consumerables'=>$compare_products,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
    }

    public function edit_supplier(Request $request){
        

        $id=$request->id;
        $name=$request->supplier_name;
        $sales_person=$request->sales_person;
        $email=$request->supplier_email;
        $tel=$request->supplier_tel;
        $cel=$request->supplier_cell;

        DB::table('stock_supplier')
                ->where('id','=',$id)
                ->update(['sup_name'=>$name,'sales_person'=>$sales_person,'sup_email'=>$email,'sup_tel'=>$tel,'sup_cell'=>$cel]);

        return back()->with(['message'=>'Edit Supplier Successfully.']);
    }

    public function create_supplier(Request $request){
        $name=$request->supplier_name_add;
        $sales_person=$request->sales_person_add;
        $email=$request->supplier_email_add;
        $tel=$request->supplier_tel_add;
        $cel=$request->supplier_cell_add;

        DB::table('stock_supplier')->insert([
            ['sup_name'=>$name,'sales_person'=>$sales_person,'sup_email'=>$email,'sup_tel'=>$tel,'sup_cell'=>$cel]]); 
        
        return back()->with(['message'=>'Supplier Created Successfully.']);        
    }

    public function subtract_supplies(Request $request){
        $id=$request->id;
        $minus_current=$request->current;
        $number=$request->quan;
        $new_total=$minus_current - $number;
            DB::table('stock')
                ->where('id','=',$id)
                ->update(['quantity'=>$new_total]);
                return back()->with(['message'=>'Subtracted Stock Successfully.']);      
    }

    public function add_supplies(Request $request){
        $id=$request->id;
        $current=$request->current;
        $number=$request->quan;
        $new_total=$current + $number;
        
        DB::table('stock')
                ->where('id','=',$id)
                ->update(['quantity'=>$new_total]);
                return back()->with(['message'=>'Added Stock Successfully.']);
    
    }

    public function create_stock(Request $request){

        $description=$request->order_description;
        $catergory=$request->order_category;
        $amount=$request->order_amount;
        $quant=$request->order_quan;
        $supplier=$request->order_supplier;
        $icon=$request->order_icon;
        $branch=$request->order_branch;
        $date=date('Y-m-d');
        DB::table('stock')->insert([
            ['description'=>$description,'quantity'=>$quant,'price'=>$amount,'supplier'=>$supplier,'icon'=>'icon','stock_date'=>$date,'branch'=>$branch,'catergory'=>$catergory,'status'=>0]]); 
            return back()->with(['message'=>'Stock Order Created Successfully.']);    
    }

    public function order_stock(){
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
        //Order Stock Query
        $stock_order=DB::table('stock_order')->orderBy('id','desc')->limit(200)->get();
        return view('consumerables.orderstock',['final'=>$final,'stock_orders'=>$stock_order,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
    }

    public function edit_order_stock($id){
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
        $edit_orderlist=DB::table('stock_order_list')->where('order_no','=',$id)->orderBy('id','asc')->get();
        return view('consumerables.orderlist',['final'=>$final,'order_lists'=>$edit_orderlist,'order_no'=>$id,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
    }

    public function remove_order_stock($id){
        DB::table('stock_order_list')->where('id','=',$id)->delete();
        return back()->with(['message'=>'Item Deleted Successfully.']);  
    }

    public function add_order_stock(Request $request){
        $id=$request->order_no;
        $description=$request->description_add;
        $quantity=$request->quan_add;
        $comment=$request->comment_add;
        $date=date('Y-m-d');
        DB::table('stock_order_list')->insert([['order_no'=>$id,'description'=>$description,'quantity'=>$quantity,'comment'=>$comment,'status'=>'0','date'=>$date]]);
        return back()->with(['message'=>'Items Added Successfully.']);

    }

    public function invoice(){
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
        $supplier=DB::table('supplier')->where('sup_name','<>','')->orderBy('sup_name')->get();
        return view('consumerables.invoice',['final'=>$final,'suppliers'=>$supplier,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
    }

    public function save_invoice_doc(Request $request){
            $branch=$request->branch_name;
            $invoice=$request->invoice;
            $supplier=$request->supplier_invoice;
            $invoice_date=$request->invoice_date;
            $invoice_no=$request->invoice_no;
            $subtotal=$request->subtotal;
            $vat_amount=$request->vat_amount;
            $total_vat=$request->total_vat;
            $file = 'INVOICE-'.date('dhis').'-'.($invoice);
            $date = date('Y-m-d');
            $time1 = date('H:i:s');
            $timestamp = strtotime($time1) + 60*60;
            $time = date('H:i:s', $timestamp);
            $vann = 0;

            if($vat_amount>0){
                $vann = 1;
            }else{
                $vann = 0;
            }
            
            DB::table('supplier_invoices')->insert([
                ['invoice_no'=>$invoice_no,'vat_non'=>$vann,'supplier'=>$supplier,'file'=>$invoice,'description'=>'Consumables Invoice','invoice_date'=>$invoice_date,'date'=>$date,'branch'=>$branch,'amount'=>$subtotal,'vat'=>$vat_amount,'total'=>$total_vat, 'Key_Ref'=>'', 'Reg_No'=>'', 'Other_id'=>'','account'=>'']]); 

           // $target_dir = "../../mag_documentions/supplier_invoices/";
            //$target_file = $target_dir.'INVOICE-'.date('dhis').'-'.($_FILES[$invoice]);
            //$file = 'INVOICE-'.date('dhis').'-'.($_FILES[$invoice]);
            
                
            

            return back()->with(['message'=>'Invoice Uploaded Successfully.']);
    }

    public function add_to_order(Request $request){
        $id=$request->order_no;    
        $description=$request->description_add_order;
        $quantity=$request->quant_add_order;
        $comment=$request->comment_add_order;
        $date=date('Y-m-d');
        DB::table('stock_order_list')->insert([['order_no'=>$id,'description'=>$description,'quantity'=>$quantity,'comment'=>$comment,'status'=>'0','date'=>$date]]);
        return back()->with(['message'=>'Items Added To Order List Successfully.']);
    }

    public function send_email(Request $request){
        $email=$request->email;
        $order=$request->order_no;
        $orders=array("order_no"=>$order,);
        $orders=(object)$orders;
         Mail::to($email)->send(new SendMail($orders));
        return back()->with(['message'=>'Email Successfully Sent.']);
    }

    public function inventory_stock(){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
                
        $quantity   = 0;
        $amount     = 0;
        $branch     = '*';
        $branch_name="All Branches";
        $all=DB::select("select * from stock a 
        WHERE (a.catergory = 'Sundries' OR a.catergory = 'Paint Supplies' OR a.catergory = 'Inhouse Stock'
        OR a.catergory = 'Waste Disposal' OR a.catergory='N/A')
        order by description asc limit 0,1000");

        $lives=DB::select("select DISTINCT a.id,a.description,a.catergory,
        a.quantity,a.price,a.supplier,a.icon,a.stock_date,a.branch
        FROM stock a 
        INNER JOIN stock_history b ON a.id=b.stock_id
        WHERE a.id=b.stock_id AND a.quantity>0
        AND (a.catergory = 'Sundries' OR a.catergory = 'Paint Supplies' OR a.catergory = 'Inhouse Stock'
        OR a.catergory = 'Waste Disposal' OR a.catergory='N/A')");

        $deads=DB::select("select * FROM stock a WHERE a.catergory='Dead Stock'");

        $consumable_tools=DB::select("select * FROM stock a WHERE a.catergory='Tools' ORDER BY a.stock_date DESC LIMIT 0,1000");

        $branches=DB::table('branch')->get();

        $paints=DB::select("select * FROM stock_paint a ORDER BY a.date_modified DESC LIMIT 0,1000");

        $equipments=DB::select("select * FROM stock a WHERE a.catergory='Equipment' ORDER BY a.stock_date DESC LIMIT 0,1000");

        $purchases=DB::select('select * FROM tools_history a ORDER BY a.date DESC LIMIT 0,1000');

        return view('consumerables.inventory',['purchases'=>$purchases,'equipments'=>$equipments,'paints'=>$paints,'consumable_tools'=>$consumable_tools,'deads'=>$deads,'lives'=>$lives,'branch_name'=>$branch_name,'branches'=>$branches,'all'=>$all,'quantity'=>$quantity,'amount'=>$amount,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
    }

    public function inventory_branch($id){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;

        $branch=$id;
        $quantity   = 0;
        $amount     = 0;
        $branch_name=$id;
        $all=DB::select("select * from stock a where a.branch=?
        AND (a.catergory = 'Sundries' OR a.catergory = 'Paint Supplies' OR a.catergory = 'Inhouse Stock'
        OR a.catergory = 'Waste Disposal' OR a.catergory='N/A')
        order by description asc limit 0,1000",[$branch]);

        $lives=DB::select("select DISTINCT a.id,a.description,a.catergory,
        a.quantity,a.price,a.supplier,a.icon,a.stock_date,a.branch
        FROM stock a 
        INNER JOIN stock_history b ON a.id=b.stock_id
        WHERE a.branch = ? AND a.id=b.stock_id and a.quantity>0
        AND (a.catergory = 'Sundries' OR a.catergory = 'Paint Supplies' OR a.catergory = 'Inhouse Stock'
        OR a.catergory = 'Waste Disposal' OR a.catergory='N/A')",[$branch]);

        $deads=DB::select("select * FROM stock a WHERE a.catergory='Dead Stock' AND a.branch=?",[$branch]);

        $consumable_tools=DB::select("select * FROM stock a WHERE a.branch=? AND a.catergory='Tools' ORDER BY a.stock_date DESC LIMIT 0,1000",[$branch]);

        $branches=DB::table('branch')->get();

        $paints=DB::select("select * FROM stock_paint a WHERE a.branch=? ORDER BY a.date_modified DESC LIMIT 0,1000",[$branch]);

        $equipments=DB::select("select * FROM stock a WHERE a.branch=? AND a.catergory='Equipment' ORDER BY a.stock_date DESC LIMIT 0,1000",[$branch]);

        $purchases=DB::select('select * FROM tools_history a WHERE a.branch=? ORDER BY a.date DESC LIMIT 0,1000',[$branch]);

        return view('consumerables.inventory',['purchases'=>$purchases,'equipments'=>$equipments,'paints'=>$paints,'consumable_tools'=>$consumable_tools,'deads'=>$deads,'lives'=>$lives,'branch_name'=>$branch_name,'branches'=>$branches,'all'=>$all,'quantity'=>$quantity,'amount'=>$amount,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
               

    }

    public function add_new_inventory(Request $request){
        $in_desc=$request->inventory_description;
        $in_cate=$request->inventory_cate;
        $in_unit=$request->inventory_unit;
        $in_quan=$request->inventory_quan;
        $in_supplier=$request->inventory_supplier;
        $icon=$request->inventory_icon;
        $branch=$request->inventory_branch;
        $date = date('Y-m-d');
        $file=time().'.'.$request->inventory_icon->getClientOriginalExtension();
        $paths='stock_icon/';
        
        $request->inventory_icon->move(public_path($paths),$file);

        DB::table('stock')->insert([['description'=>$in_desc,'quantity'=>$in_quan,'price'=>$in_unit,'supplier'=>$in_supplier,'icon'=>$file,'stock_date'=>$date,'branch'=>$branch,'catergory'=>$in_cate]]);
        
        return back()->with(['message'=>'Items Added To Order List Successfully.']);

    }

    public function consumer_inventory_equipment_save(Request $request){
        
        $id   = $request->id;
        $price   = $request->price;
        $quantity   = $request->quantity;
        $catergory   = $request->catergory;
        $serial_no   = $request->serial_no;

        DB::table('stock')
                ->where('id','=',$id)
                ->update(['price'=>$price,'quantity'=>$quantity,'catergory'=>$catergory,'serial_no'=>$serial_no]);

        return back()->with(['message'=>'Items Edited Successfully.']);




    }


    public function consumer_inventory_equipment_sell(Request $request){
        
                $count   = 0;
                $c_names = $request->sell_fullname;
                $c_id = $request->sell_id_no;
                $c_number = $request->sell_mobile;
                $c_description = $request->sell_description;
                $c_amount = $request->sell_amount;
                $c_quantity = $request->sell_quan;
                $c_supplier = $request->sell_supplier;
                $c_branch = $request->sell_branch;
                $c_amount_m = $request->sell_amount;
                $c_date_d = $request->sell_deduction;
                $c_monthly=$request->sell_monthly;
                $stock_qty=0;    


                $dbquery_s =DB::select("select * from stock where supplier=? and description=?",[$c_supplier,$c_description]);
                

                foreach($dbquery_s as $dbrow_s){
                $stock_qty = $dbrow_s->quantity;    
                }

                $count = $stock_qty - $c_quantity;

                if($count<0){
                return back()->with(['message'=>'Request unsuccessfull, Item is out of stock']);    
                }else{
                
                DB::table('tools_history')->insert([['names'=>$c_names,'id_number'=>$c_id,'cell_number'=>$c_number,'description'=>$c_description,'amount'=>$c_amount,'quantity'=>$c_quantity,'supplier'=>$c_supplier,'branch'=>$c_branch,'m_amount'=>$c_amount_m,'start_date'=>$c_date_d]]);
                    
                

                DB::table('stock')
                ->where('supplier','=',$c_supplier)
                ->where('description','=',$c_description)
                ->update(['quantity'=>$count]);    
                
                         
                return back()->with(['message'=>'Item is successfully purchased']);   
                }
    }

    public function consumer_inventory_paint_save(Request $request){
        $id   = $request->id;
        $price   = $request->price;
        $quantity   = $request->quantity;
        $description   = $request->description;

        DB::table('stock_paint')
                    ->where('id','=',$id)
                    ->update(['amount'=>$price,'quantity'=>$quantity,'description'=>$description]);

        return back()->with(['message'=>'Items Edited Successfully.']);
    }

    public function consumer_parts_requesation(){
        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $user=Auth::user()->username;

        $counter=1;
        $ui='<ui style="list-style:none;overflow:hidden;padding:3em;overflow:hidden;padding:3em;">';

         #FIX THE QUERY TO SELECT ONE
        //$dbquery=DB::table('stock_history')->where('status','=','1')->distinct('Key_Ref')->get();
        $dbquery=DB::table('stock_history')->where('status','=','1')->where('item_status','=','0')->distinct('Key_Ref,receiver')->groupBy('receiver')->get();
        if(count($dbquery)>0){
            foreach($dbquery as $dbrow){
            
            $ui.='
            
            <li style="list-style:none;margin:1em;float:left;">
                <a href="#"  style="text-decoration:none;color:#000;background:#f6ff7a;display:block;height:20em;width:22em;padding:1em;-moz-box-shadow:5px 5px 7px rgba(33,33,33,1);
                /* Safari+Chrome */
                -webkit-box-shadow: 5px 5px 7px rgba(33,33,33,.7);
                /* Opera */
                box-shadow: 5px 5px 7px rgba(33,33,33,.7);
                -moz-transition:-moz-transform .15s linear;
                -o-transition:-o-transform .15s linear;
                -webkit-transition:-webkit-transform .15s linear;" id="'.$dbrow->Key_Ref.'" name="'.$dbrow->receiver.'">
                <b>'.strtoupper($dbrow->Key_Ref).' #'.$counter.'</b></br>
                <b>'.$dbrow->receiver.'</b></br>';
              
            

            $dbquery_1=DB::select("select * from stock_history where Key_Ref='".$dbrow->Key_Ref."' and receiver='".$dbrow->receiver."'");
            //$dbquery_1=DB::select("select * from stock_history where Key_Ref='".$dbrow->Key_Ref."' and receiver='".$dbrow->receiver."'");
                         
            foreach($dbquery_1 as $dbrow_1){
            
            $status = $dbrow_1->item_status;
            
            #ONCLICK [ APPROVE THE CONSUMABLE ITEM ]
            if($status==0){
            $status_data = '<span class="fa fa-times text-danger status_cart" id="'.$dbrow_1->id.'" data-id="'.$dbrow_1->id.'"></span>';
            }else{
            $status_data = '<span class="fa fa-check text-success status_cart" data-id="'.$dbrow_1->id.'"></span>';    
            }

            /*
            $ui.='
            <table border="1">
            <tr>
            <td style="width:100%">'.$dbrow_1->description.'</td>
            <td style="width:100%">'.$status_data.'</td>
            </tr>
            </table>
            ';
            */  

            $ui.='
            <table border="1">
            <tr>
            <td style="width:100%">'.$dbrow_1->description.'</td>
            <td style="width:100%">'.$dbrow_1->quantity.'</td>
            <td style="width:100%">'.$status_data.'</td>
            </tr>
            </table>
            '; 
            }
            
            $ui.='
            </br>
            <button class="btn btn-primary close_cart" id="'.$dbrow->Key_Ref.'" name="'.$dbrow->receiver.'" data-id="'.$dbrow->Key_Ref.'" data-receiver="'.$dbrow->receiver.'">Done</button>
            </a>
            </li> 
            ';
            
            $counter++;
            }    
            }
            
            $ui.='</ul>';

            return view('consumerables.requesation',['username'=>$user,'ui'=>$ui,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final]);
    }

    public function requesation_status(Request $request){
        $id=$request->id;
        DB::table('stock_history')
                    ->where('id','=',$id)
                    ->update(['status'=>'1']);
        return back()->with(['message'=>'Status Changed.']);

    }

    public function requesation_close(Request $request){

        #UPDATED THE QUERIES
        $id=$request->id;
        $receiver=$request->receiver;
        $dbquery=DB::table('stock_history')->where('Key_Ref','=',$id)->where('receiver','=',$receiver)->get();
        foreach($dbquery as $dbrow){

        $item_id     = $dbrow->id;
        $description = $dbrow->description;
        $supplier    = $dbrow->supplier;
        $quantity    = $dbrow->quantity;

        /*
        DB::table('stock_history')->where('id','=',$item_id)->update(['status'=>'2','item_status'=>'1']);
        DB::table('stock')->where('supplier','=',$supplier)->where('description','=',$description)->update(['quantity'=>$quantity]);
        */

         $update_stock_history = DB::table('stock_history')->where('id','=',$item_id)->update(['status'=>'2','item_status'=>'1']);
        $stock_quantity =  DB::table('stock')->where('supplier','=',$supplier)->where('description','=',$description)->value('quantity');
        $total_quantity =  $stock_quantity  - $quantity;
        
        $update_stock = DB::table('stock')->where('supplier','=',$supplier)->where('description','=',$description)->update(['quantity'=>$total_quantity]);   
        
        }

        //return back()->with(['message'=>'Closed Successfully.']);
        #CHECK IF THE UPDATE QUERIES ARE SUCCESSFUL
        if( $update_stock_history && $update_stock  ){
            return 1; 
            #PUT SLACK ERROR LOG

        }else{
            return 0;
            #PUT SLACK ERROR LOG
        }


    }


    #APPROVE THE ITEMS STATUS [ approve_items_status ]
    public function approve_items_status( Request $request ){
        $update = DB::table('stock_history')->where('id', $request->id)->update(array('item_status' => 1));
        if( $update ){
            return 1;
            #PUT SLACK ERROR LOG
        }else{
            return 0;
            #PUT SLACK ERROR LOG
        }
        
    }

    public function consumerable_create_orders(Request $request){
        
        $user=Auth::user()->username;
        $supplier=$request->order_supplier;
        $branch=$request->order_branch;
        $email=$request->order_email;
        $supem ="";
        $suptel ="";
        $supcel ="";
        $date= date('Y-m-d');
        $supplier_infos=DB::table('stock_supplier')->where('sup_name','=',$supplier)->get();
        foreach($supplier_infos as $info){
            $supem = $info->sup_email;
            $suptel =$info->sup_tel;
            $supcel =$info->sup_cell;
        }

        DB::table('stock_order')->insert([['supplier'=>$supplier,'supplier_email'=>$supem,'supplier_tel'=>$suptel,'supplier_cell'=>$supcel,'sender'=>$user,'sender_email'=>$email,'branch'=>$branch,'status'=>0,'order_date'=>$date]]);
        $query_orderNo=DB::select('select id from stock_order order by id desc limit 1');
        $ordernumber=0;

        foreach($query_orderNo as $no){
            $ordernumber=$no->id;
        }
        
        //return redirect()->route('consumerable-order-list', ['id' => $ordernumber]);
        return back()->with(['message'=>'Status Changed.']);
    }

    
    
}
