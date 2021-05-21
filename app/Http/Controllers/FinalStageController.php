<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PDF;
use Config;

use TCPDF;

class FinalStageController extends Controller
{
    //

    public function index(){
         //if (!Auth::check()) {
        if( !Auth::check() ){
           return redirect('/logout');
        }
        

        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $sec_photos=array();
        $docs=array();
        $track_photos=array();
        $notes=array();
        
        $fetch_vehicles=DB::table('fetch_ApprovedQuotes')
                            ->groupBy('Key_Ref')
                            ->limit(500)    
                            ->get();

        #$fetch_vehicles=DB::select("select * FROM fetch_ApprovedQuotes group by Key_Ref LIMIT 100");

        /*
        foreach($fetch_vehicles as $vehicle){
            $sec_count=DB::table('securityphotos')
                            ->where('Key_Ref','=',$vehicle->Key_Ref)
                            ->count();
            array_push($sec_photos,$sec_count);

            $docs_count=DB::table('document')
                               ->where('Key_Ref','=',$vehicle->Key_Ref)
                               ->count() ;
            array_push($docs,$docs_count);
            
            $track_count=DB::table('track_photos')
                                ->where('Key_Ref','=',$vehicle->Key_Ref)
                                ->count();
            array_push($track_photos,$track_count);                    

            $notes_count=DB::table('notes')
                                ->where('Key_Ref','=',$vehicle->Key_Ref)
                                ->count();
            array_push($notes,$notes_count);
        }
        */
    
        return view('final_stage.getvehicles',['final'=>$final,'approved'=>$fetch_vehicles,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);


       #return view('final_stage.getvehicles',['final'=>$final,'approved'=>$fetch_vehicles,'notes'=>$notes,'sec_photos'=>$sec_photos,'docs'=>$docs,'track_photos'=>$track_photos,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
    }

    public function final_stage_client($id){
         //if (!Auth::check()) {
        if( !Auth::check() ){
           return redirect('/logout');
        }

        $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $sign=Auth::user()->sign;
        $close=Auth::user()->close;
        $result1_ =DB::select('select * from client_details WHERE Key_Ref =:id',['id'=>$id]);
        $result1_aa=DB::raw('Discount,Discount2 from qoutes where  Key_Ref=? and qoute_type ="0"',[$id]);
        $disc_val1 = 0;
        $disc_val2 = 0;
        $waste = 0;
        //Get Discount 
        foreach($result1_aa as $row){
           $disc_val1 = $row->Discount;
           $disc_val2 = $row->Discount2;
         }   
        //Get Opers and quotations 
        $result1_count=count($result1_);
        if($result1_count>0){
          $result=DB::select("select id,Percent,MarkUp2,Checked,MarkUp,Quantity,Betterment,Description,Key_Ref,Parts_sales,Part,Oper,Part,round((Part-(Parts_sales+(Parts_sales*(MarkUp/100))))*Quantity,2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price  from qoutes where Key_Ref =? and Part>0 and qoute_type = '0'",[$id]);
          $resulte=DB::select('select * from oper order by oper');
          $opt = '';
          $opti = 0;
          $option = '';
          $optionz = '';
          $optin = 0;      

          foreach($resulte as $row){
            $opt.= "<option val='".$row->oper."'>".$row->oper."</option>";
            }
            while($opti<=100){
            $option.="<option>".number_format($opti,2)."</option>";
            $opti++;
            }
            while($optin<=50){
            $optionz.="<option>".$optin."</option>";
            $optin++;
            }  

          $count = 1;
          $status='';
          $lndT = 0;
          $ptT = 0;
          $savT = 0;
          $actl = 0;
          $btmnt = 0;
          $btmnt_ = 0;
          $actual_priceT = 0;
          $chk = "";
          $actlttl = 0;
          $qtedttl = 0;
          $savettl = 0;
          $savettl2 = 0;
          $savettl3 = 0;
          $addttl = 0;
          $addttl2 = 0;
          $addttl3 = 0;
          
          $table='';

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
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{
                    $actl = $row->actual_price;
                }
            }else{
                if($row->Parts_sales<=0){
                    $actl=0;
                }else{
                    $actl = $row->Parts_sales*(($row->MarkUp2)/100);
                    if($actl>($row->Part*$row->Quantity)*(1+($row->Percent/100))){
                        $add = ($actl - ($row->Part*$row->Quantity)*(1+($row->Percent/100)));
                        $save = 0;
                    }else{
                        $add = 0;
                        $save = (($row->Part*$row->Quantity)*(1+($row->Percent/100))-$actl);
                    }
                   
                    
                }
            }//End Of if Statement
            if($row->Checked=='yes'){
                $chk ="checked";
            }else{
                $chk ="";
            }//End Of if
            $btmnt+= $actl*$row->Betterment/100;
            $btmnt_+= ($row->Part*$row->Quantity)*+(1+($row->Percent/100))*$row->Betterment/100;
            if($row->Part>0){               
                $table.= "<tr>
                         <td style='font-size:10px;'>".$count."</td>
                         <td contenteditable='true' style='font-size:10px;' id='".$row->id."' onblur='funkThisBox(this.id)'>".$row->Description."</td>
                         <td id='aEditTd_".$count."-".$row->id."' onblur='addThisOper(this.id)'><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='EditAddQtsOperNewTd_".$count."' name='".$row->Oper."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm form-control-sm' style='font-size:10px;' onchange='changeThisOper(this.lang)' onload='funkThisOper(this.name)'><option style='color:olive'>".$row->Oper."</option>".$opt."
                           </select></td>
                         <td contenteditable='true' style='font-size:10px;' id='".$row->id."_a' onblur='funkThixBox(this.id)' >".$row->Parts_sales."</td>
                         <td style='width:20px'>
                             <label>
                                 <input type='checkbox' id='".$row->id."_".$count."-' onchange='storeSomeChange(this.id)' $chk />
                                 <span></span>
                             </label>
                         </td>
                         <td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='EditAddQtsMarkUpNewTd_".$count."' name='".$row->MarkUp."_".$count."' title='".$id."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisMarkUp(this.lang,this.title)' onload='funkThisMarkUp(this.name)'><option>".$row->MarkUp."</option>".$optionz."
                           </select></td>
                         <td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='EditAddQtsMarkUpNewTd1_".$count."' name='".$row->MarkUp2."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisMarkUp_(this.lang)' onload='funkThisMarkUp_(this.name)'><option>".$row->MarkUp2."</option>".$optionz."
                           </select></td>
                         <td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='EditAddQtsBtmentNewTd_".$count."' name='".$row->Betterment."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisBtment(this.lang)' onload='funkThisBtment(this.name)'><option>".$row->Betterment."</option>".$option."
                           </select></td>
                         <td style='font-size:10px;'>".number_format($save,2)."</td>
                         <td style='font-size:10px;'>".number_format($add,2)."</td>
                         <td style='font-size:10px;'>".  number_format($qted,2)."</td>
                         <td style='font-size:10px;'>".number_format($actl,2)."</td>
                     </tr>";

                    /*
                     $table.= "<tr>
                     <td style='font-size:10px;'>".$count."</td>
                     <td contenteditable='true' style='font-size:10px;' id='".$row->id."' onblur='funkThisBox(this.id)'>".$row->Description."</td>
                     <td id='aEditTd_".$count."-".$row->id."' onblur='addThisOper(this.id)'><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='EditAddQtsOperNewTd_".$count."' name='".$row->Oper."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm form-control-sm' style='font-size:10px;' onchange='changeThisOper(this.lang)' onload='funkThisOper(this.name)'><option style='color:olive'>".$row->Oper."</option>".$opt."
                       </select></td>
                     <td contenteditable='true' style='font-size:10px;' id='".$row->id."_a' onblur='funkThixBox(this.id)' >".$row->Parts_sales."</td>
                     <td style='width:20px'>
                         <label>
                             <input type='checkbox' id='".$row->id."_".$count."-' onchange='storeSomeChange(this.id)' $chk />
                             <span></span>
                         </label>
                     </td>
                     <td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='EditAddQtsMarkUpNewTd_".$count."' name='".$row->MarkUp."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisMarkUp(this.lang)' onload='funkThisMarkUp(this.name)'><option>".$row->MarkUp."</option>".$optionz."
                       </select></td>
                     <td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='EditAddQtsMarkUpNewTd1_".$count."' name='".$row->MarkUp2."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisMarkUp_(this.lang)' onload='funkThisMarkUp_(this.name)'><option>".$row->MarkUp2."</option>".$optionz."
                       </select></td>
                     <td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='EditAddQtsBtmentNewTd_".$count."' name='".$row->Betterment."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisBtment(this.lang)' onload='funkThisBtment(this.name)'><option>".$row->Betterment."</option>".$option."
                       </select></td>
                     <td style='font-size:10px;'>".number_format($save,2)."</td>
                     <td style='font-size:10px;'>".number_format($add,2)."</td>
                     <td style='font-size:10px;'>".  number_format($qted,2)."</td>
                     <td style='font-size:10px;'>".number_format($actl,2)."</td>
                 </tr>";*/


                $count++;
                $actlttl +=$actl;
                $qtedttl +=$qted;
                $savettl +=$save;
                $addttl +=$add;
               }else{
                   $table= "<tr style='font-size:10px;'>
                         <td>".$count."</td>
                         <td></td>
                         <td></td>
                         <td>0.00</td>
                         <td style='width:20px'><input type='checkbox'/></td>
                         <td>0.00</td>
                         <td>0.00</td>
                         <td>0.00</td>
                         <td>0.00</td>
                         <td>0.00</td>
                         <td>0.00</td>
                         <td>0.00</td>
                     </tr>";
               }
          }//End of foreach loop
          
          $result1=DB::select("select * from qoutes WHERE Key_Ref=? AND Part>'0' and qoute_type = '0' ORDER BY id",[$id]);
            $ref1 = '';
            $part_id1     = '';
            $oper1        = '';
            $description1 = '';
            $percent1     = 0;
            $quantity1    = 0;
            $part1        = 0;
            $part_sales1  = 0;
            $markup1      = 0;
            $betterment1  = 0;
            $savings1     =0;
            $actual_price1=0;
            $new_savings1 =0;

            $betterment_total1  = 0;
            $part_total1        = 0;
            $actual_price_total1= 0;
            $less_saving1 = 0;
            $plus_additional1 = 0;
            $additional_price1 = 0;

          foreach($result1 as $row1){
            $ref1 = $row1->Key_Ref;
            $part_id1     = $row1->id;
            $oper1        = $row1->Oper;
            $description1 = $row1->Description;
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
           
          }//End Of Foreach 
          $ttlAdd = 0;
            $ttlAdd_ = 0;
            $savp1 = 0;
            $addp1 = 0;
            $result_x=DB::select('select * FROM additional WHERE Key_Ref=?',[$id]);
            $result_=DB::select('select * FROM additional WHERE Key_Ref=?',[$id]);

            foreach($result_x as $row){
                $savp = 0;
                $addp = 0;  
                $actup = 0;
                $qtedp = $row->Quantity*$row->Part*(1+($row->Percent/100));
                if(number_format($row->MarkUp2)==0){
                    $ttlAdd_ += ($row->Quantity*$row->Part*(1+($row->MarkUp/100)));
                }else{
                    $ttlAdd_ += ($row->Quantity*$row->Part*(($row->MarkUp2/100)));
                }
                if(number_format($row->MarkUp2)==0){
                    $actup = $row->Part_sales*(1+($row->MarkUp/100));
                }else{
                    $actup = $row->Part_sales*(($row->MarkUp2/100));
                }
                if(($qtedp-$actup)>0){
                    $savp = $qtedp-$actup;
                    $addp = 0;
                }else{
                    $savp = 0;
                    $addp = $actup-$qtedp;
                }
                $savp1 += $savp;
                $addp1 += $addp;
            }//End Of Foreach Loop 
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
            }//End Of For Each Loop
            $table.="<tr>"
            . "<td colspan='7' style='text-align: right;color: cadetblue'><strong>Total Parts</strong></td>"
            . "<td><span class='badge' style='background-color:cadetblue'><strong class='cld'>".number_format($betterment_total1,2)."</strong></span></td>"
            . "<td><span class='badge' style='background-color:cadetblue'><strong class='cld'>".number_format($savettl,2)."</strong></span></td>"
            . "<td><span class='badge' style='background-color:cadetblue'><strong class='cld'>".number_format($addttl,2)."</strong></span></td>"
            . "<td><span class='badge' style='background-color:cadetblue'><strong class='cld'>".number_format($qtedttl,2)."</strong></span></td>"
            . "<td><span class='badge' style='background-color:cadetblue'><strong class='cld'>".number_format($actlttl,2)."</strong></span></td>"
            . "</tr>";
            
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
            }//End Of Foreach loop
            $ttl = $actual_price_total+$actual_price_total1;
            $ttl1 = $qtedttl;
            $table.="<tr>"
               . "<td colspan='10' style='text-align: right;color: cadetblue'><strong>Total Additional Parts</strong></td>"
                ."<td></td>"
               . "<td><span class='badge' style='background-color:cadetblue'><strong class='cld'>".number_format($ttlAdd_,2)."</strong></span></td>"
                . "</tr>"
             . "<tr>"
               . "<td colspan='10' style='text-align: right;color: cadetblue'><strong>Sub Total Parts</strong></td>"
               . "<td><span class='badge' style='background-color:orange'><strong class='cld' id='stp'>".number_format($ttl1,2)."</strong></span></td>"
               . "<td><span class='badge' style='background-color:orange'><strong class='cld' id='stp_'>".number_format(($ttlAdd_+$actlttl),2)."</strong></span></td>"
       . "</tr>";

        $result_1=DB::select('select Key_Ref,sundries1,sundries2,paintShop1,paintShop2,Betterment,Excess_1,Excess_2 FROM betterment WHERE Key_Ref=?',[$id]);    
        $sundries1 = 0;
        $sundries2 = 0;
        $Betterment = 0;
        $Excess= 0;
        $Excess2 = 0;
        $paintSh1 = 0;
        $paintSh2 = 0;
        $idd='';
        foreach($result_1 as $row){
            $sundries1=$row->sundries1;
       $sundries2=$row->sundries2;
       $idd = $row->Key_Ref;
       $Betterment = $row->Betterment;
       $Excess = $row->Excess_1;
       $Excess2 = $row->Excess_2;
       $paintSh1 = $row->paintShop1;
       $paintSh2 = $row->paintShop2;
        }//End Of Foreach
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

        }//End Of Foreach Loop
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
        $disc_val1_1    = 0;
        $addp3=0;
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
            $disc_val1_1    = $row1->Discount;
            $disc_val1    = $row1->Discount;
            $disc_val2    = $row1->Discount2;
    
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
        }//End Of Foreach Loop
        $ttl_1 = $actual_price_total+$actual_price_total1+($sundries1);
        $ttl1_1 = $part_total1_1+($sundries1);
        $table.="<tr>"
               . "<td colspan='10' style='text-align: right;color: cadetblue'><strong>Sundries</strong></td>"
               . "<td style='font-size:10px;' contenteditable='true' id='".$id."_a'   onblur='getThisSundry(this.id)'>".number_format($sundries1,2)."</td>"
               . "<td style='font-size:10px;' contenteditable='true' id='".$id."_b'   onblur='getThisSundry_(this.id)'>".number_format($sundries2,2)."</td>"
                . "</tr>"
                . "<tr>"
               . "<td colspan='10' style='text-align: right;color: cadetblue'><strong>Total Parts</strong></td>"
               . "<td><span class='badge' style='background-color:cadetblue'><strong class='cld'>".number_format($ttl1+($sundries1),2)."</strong></span></td>"
               . "<td><span class='badge' style='background-color:cadetblue'><strong class='cld'>".number_format(($ttlAdd_)+($sundries2)+$actlttl,2)."</strong></span></td>"
                . "</tr>";

                
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
      

                #UPDATED THE QUERY STRING SOME FIELDS USED WERE MISSING
                //$resInhs=DB::select('select id,MarkUp,MarkUp2,Checked,Betterment,Description,Key_Ref,Parts_sales,Oper,Part,Misc,round(Misc-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price from qoutes where Key_Ref=? and Misc>0 and qoute_type = "0" order by id limit 8',[$id]);
                $resInhs=DB::select('select id,MarkUp,MarkUp2,Checked,Betterment,Description,Key_Ref,Parts_sales,Oper,Quantity,Percent,Part,Misc,round(Misc-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price from qoutes where Key_Ref=? and Misc>0 and qoute_type = "0" order by id limit 8',[$id]);
                $resaddInhs =DB::select('select distinct * from additional  where Key_Ref=? and (Inhouse>0 or Inhouse<0) order by id',[$id]);
                $resaddInhs1 =DB::select('select distinct * from additional  where Key_Ref=? and (Outwork>0 or Outwork<0) order by id',[$id]);

                #$resInhs=DB::select('select id,MarkUp,MarkUp2,Checked,Betterment,Description,Key_Ref,Parts_sales,Oper,Part,Misc,round(Misc-(Parts_sales+(Parts_sales*(MarkUp/100))),2)as sav,round((Parts_sales+(Parts_sales*(MarkUp/100))),2)as actual_price from qoutes where Key_Ref=? and Misc>0 and qoute_type = "0" order by id limit 8',[$id]);
                #$resaddInhs =DB::select('select distinct * from additional  where Key_Ref=? and (Inhouse>0 or Inhouse<0) order by id',[$id]);
                #$resaddInhs1 =DB::select('select distinct * from additional  where Key_Ref=? and (Outwork>0 or Outwork<0) order by id',[$id]);
                $counter=1;
                $counte = $count;
                $table.='<tr id="secRw" style="font-size:12px;">
                            <th>#</th>
                            <th>Inhouse/Outwork</th>
                            <th>Oper</th>
                            <th colspan="2">Landing Price</th>
                            <th>Nett Mark-Up(%)</th>
                            <th>Mark-Up Only(%)</th>
                            <th>Betterment(%)</th>
                            <th>Saving</th>
                            <th>Additional</th>
                            <th>Quoted Price</th>
                            <th>Actual Price</th>
                        </tr>';
                $savTotal = 0;
                $AddTotal = 0;
                $QtTotal=0;
                $actTotal = 0;
                $atct = 0;
                $chk2 = "";
                $qted2 = 0;
                $add2 = 0;
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
       
                $qted2 = $rowx->Misc;
                if(number_format($rowx->MarkUp2)==0){
                    
                    if($rowx->Parts_sales<=0){
                        $atct=0;
                    }else{
                        $atct = $rowx->actual_price;
                    }
                }else{
                    if($rowx->Parts_sales<=0){
                        $atct=0;
                    }else{
                        $atct = $rowx->Parts_sales*(($rowx->MarkUp2)/100);

                         #CORRECTED THE [ rowx ] VARIABLE NAMING ISSUE AND ADD [ Quantity, Percent ] IN THE QUERY STRING
                        if($atct >  ($rowx->Misc*$rowx->Quantity)*(1+($rowx->Percent/100)) ){
                            $add2 = ($atct - ($rowx->Misc*$rowx->Quantity)*(1+($rowx->Percent/100)));
                            $save2 = 0;
                        }else{
                            $add2 = 0;
                            $save2 = (($rowx->Misc*$rowx->Quantity)*(1+($rowx->Percent/100))-$atct);
                        
                        }

                        /*** REMOVE
                        if($atct>($row->Misc*$row->Quantity)*(1+($row->Percent/100))){
                            $add2 = ($atct - ($row->Misc*$row->Quantity)*(1+($row->Percent/100)));
                            $save2 = 0;
                        }else{
                            $add2 = 0;
                            $save2 = (($row->Misc*$row->Quantity)*(1+($row->Percent/100))-$atct);
                        }
                        ***/

                        
                    }
                    //$save2 = 0;
                    //$add2 = 0;
                }
                if($rowx->Checked=='yes'){
                    $chk2 ="checked";
                }else{
                    $chk2 ="";
                }
                $savTotal+=$save2;
                $QtTotal+= $qted2;
                $actTotal+=$atct;
                $AddTotal+=$add2;
                $table.= "<tr style='font-size:10px;'>
                        <td>".$counter."</td>
                        <td contenteditable='true' id='".$rowx->id."_' onblur='funkThissBox(this.id)'>".$rowx->Description."</td>
                        <td id='EditTd_".$counte."-".$rowx->id."' onblur='addThissOper(this.id)'><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='EditAddQtsOperNewTds_".$counte."' name='".$rowx->Oper."_".$counte."' lang='".$rowx->id."_".$counte."' class='form-control input-sm form-control-sm' onchange='changeThissOper(this.lang)' onload='funkThissOper(this.name)'><option value=".$rowx->Oper.">".$rowx->Oper."</option>".$opt."
                          </select></td>
                        <td contenteditable='true' id='".$rowx->id."_b' onblur='funkThixbBox(this.id)' >".$rowx->Parts_sales."</td>
                        <td style='width:20px'>
                            <label>
                                <input type='checkbox' id='".$rowx->id."_b".$counter."-'  onchange='storeSomeChange(this.id)' $chk2 />
                                <span></span>
                            </label>
                        </td>
                        <td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='EditAddQtsMarkUpNewTds_".$counte."' name='".$rowx->MarkUp."_".$counte."' lang='".$rowx->id."_".$counte."' class='form-control input-sm form-control-sm' onchange='changeThissMarkUpOutwork(this.lang)' onload='funkThissMarkUp(this.name)'><option>".$rowx->MarkUp."</option>".$optionz."
                          </select></td>
                          <td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='EditAddQtsMarkUpNewTds1_".$counte."' name='".$rowx->MarkUp2."_".$counte."' lang='".$rowx->id."_".$counte."' class='form-control input-sm form-control-sm' onchange='changeThissMarkUpOutwork_(this.lang)' onload='funkThissMarkUp_(this.name)'><option>".$rowx->MarkUp2."</option>".$optionz."
                          </select></td>
                        <td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='EditAddQtsBtmentNewTds_".$counte."' name='".$rowx->Betterment."_".$counte."' lang='".$rowx->id."_".$counte."' class='form-control input-sm form-control-sm' onchange='changeThissBtment(this.lang)' onload='funkThissBtment(this.name)'><option>".$rowx->Betterment."</option>".$option."
                          </select></td>
                        <td>".number_format($save2,2)."</td>
                        <td>".number_format($add2,2)."</td>
                        <td>".number_format($qted2,2)."</td>
                        <td>".number_format($atct,2)."</td>
                    </tr>";
                $counter++;
                $counte++;
            }//End Of Foreach Loop    
            $table.="<tr>"
               . "<td colspan='8' style='text-align: right;color: cadetblue'><strong>Total Misc:</strong></td>"
               
               . "<td><span class='badge' style='background-color:#808000'><strong class='cld'>".number_format($savTotal,2)."</strong></span></td>"
               . "<td><span class='badge' style='background-color:#808000'><strong class='cld'>".number_format($AddTotal,2)."</strong></span></td>"
               . "<td><span class='badge' style='background-color:#808000'><strong class='cld'>".number_format($QtTotal,2)."</strong></span></td>"
               . "<td><span class='badge' style='background-color:#808000'><strong class='cld'>".number_format($actTotal,2)."</strong></span></td>"
               . "</tr>";

               $results=DB::select('select PaintSup,bt.id,bt.Key_Ref, sum(bt.Labour*ins.labour)as lb,sum(bt.Paint*ins.Paint)as pt,((qt.lb1*ins.labour)+(qt.frm*ins.Frame)+(qt.strp*ins.Strip))as lb1,(qt.pt1*ins.Paint)as pt1  from betterment bt left join
               (select qoutes.Key_Ref,sum(qoutes.Labour)as lb1,sum(qoutes.Paint)as pt1,sum(qoutes.Frame)as frm ,sum(qoutes.Strip)as strp from qoutes where Key_Ref =:id and qoute_type = "0")as qt  on bt.Key_Ref = qt.Key_Ref
               left join insurer ins on bt.Key_Ref= ins.Key_Ref where bt.Key_Ref =:id1',['id'=>$id,'id1'=>$id]);

               $resultxx=DB::select('select labour,paint,waste from betterment where Key_Ref =?',[$id]);
               
               $tr1 = 0;
               $tr2 = 0;
               $tr1_ = 0;
               $tr2_ = 0;
               $pconsu = 0;
               $frm = 0;
               
               $plainp = 0;
               $inh = 0;
               $out = 0;
               $inhtt = 0;
               $outtt = 0;
               $ottal = 0;
               $savp2 = 0;
               $addp2 = 0; 
               $savp3 = 0;

               foreach($resaddInhs as $row){
                $actup = 0;
                $savp = 0;
                $addp = 0;        
                $qtedp = $row->Inhouse*(1+($row->Percent/100));
                if(number_format($row->MarkUp2)==0){
                    $actup = $row->Inhouse*(1+($row->MarkUp/100));
                }else{
                    $actup = $row->Inhouse*(($row->MarkUp2/100));
                }
                if(number_format($row->MarkUp2)==0){
                    $inh = $row->Inhouse*(1+($row->MarkUp/100));
                }else{
                    $inh = $row->Inhouse*(($row->MarkUp2/100));
                }
                if(($qtedp-$actup)>0){
                    $savp = $qtedp-$actup;
                    $addp = 0;
                }else{
                    $savp = 0;
                    $addp = $actup-$qtedp;
                }
                $inhtt += $inh;
                $savp2 += $savp;
                $addp2 += $addp;
               }//End Of Foreach
               foreach($resaddInhs1 as $row){
                $actup = 0;
                $savp = 0;
                $addp = 0;        
                $qtedp = $row->Outwork*(1+($row->Percent/100));
                if(number_format($row->MarkUp2)==0){
                    $out = $row->Outwork*(1+($row->MarkUp/100));
                }else{
                    $out = $row->Outwork*(($row->MarkUp2/100));
                }
                if(number_format($row->MarkUp2)==0){
                    $actup = $row->Outwork*(1+($row->MarkUp/100));
                }else{
                    $actup = $row->Outwork*(($row->MarkUp2/100));
                }
                if(($qtedp-$actup)>0){
                    $savp = $qtedp-$actup;
                    $addp = 0;
                }else{
                    $savp = 0;
                    $addp = $actup-$qtedp;
                }
                $savp3 += $savp;
                $addp3 += $addp;
                $outtt += $out;
               }//End Of Foreach Loop
               $t = 0;
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
            }//End Of Foreach Loop
            $adOutwk = $ottal+$inhtt;
            foreach($resultxx as $row){
                $tr1_  =  $row->labour;
                $tr2_  = $row->paint;
                if($row->waste!=null && $row->waste!=''){
                    $waste = $row->waste;
                } 
            }//End Of Foreach Loop


            if($paintSh2==0){
                $paintSh2 = $t*($pconsu/100);
            }
            foreach($results as $row){
                $plainp = $row->pt1;
                $pconsu = $row->PaintSup;
                //$frm = $row->frm;

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
            }//End Of For Loop
            if($paintSh1==0){
                $paintSh1 = $plainp*($pconsu/100);
              }//End Of IF
              $resq=DB::select("select ((`Part`*(1+(MarkUp/100)))*(Betterment/100))as prt, ((`Paint`))as pnt,
              ((`Outwork`*(1+(MarkUp/100)))*(Betterment/100))as utw,
              ((`Inhouse`*(1+(MarkUp/100))))as inh,
              ((`RandR`)*(Betterment/100))as rr,
              (`Labour`*(Betterment/100))as lbr,
              (`Frame`*(Betterment/100))as frm, Frame,Labour,RandR,Betterment
              from additional where Key_Ref =?",[$id]);
                $t = 0;
                $t2 = 0;
                $adbt = 0;
            foreach($resq as $row){
                $t += $row->pnt;
                $t2 +=$row->Frame+$row->RandR+$row->Labour;
                $adbt+=(($row->prt)+($row->pnt*$row->Betterment/100)+($row->utw)+($row->inh*$row->Betterment/100)+($row->rr)+($row->lbr)+($row->frm));
            }//End Of Foreach 
            $dbquery4=DB::select('select * FROM additional WHERE Key_Ref=? AND Paint>"0"',[$id]);
            $dbquery4_count=count($dbquery4);
            $total_additional2  = 0;
            $part2        = 0;
            $part_sales2  = 0;
            $markup2      = 0;

            $additional2        = $part_sales2;
            if($dbquery4_count>0){
                 foreach($dbquery4 as $dbrow4){
                    $part2        = $dbrow4->Part;
                    $part_sales2  = $dbrow4->Paint;
                    $markup2      = 0;
                
                    $additional2        = $part_sales2;
                    $total_additional2  = $total_additional2 + $additional2;
                 }//End Foreach Loop   
            }//End If
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
                    $markup1Z      = 0;
                
                    $add_savZ            = ($part_sales1Z * $markup1/100);
                    $additional1Z        = $part_sales1Z+$add_savZ;
                    $total_additional1Z  = $total_additional1Z +$part_sales1Z;     
                }//End Of Foreach loop
            }//End Of If

            $_p = ($savettl+$savettl2+$savettl3)-($addttl+$addttl2+$addttl3);
            if(number_format($_p)>0){
                $plus_additional1 = 0;
            }else{
                $plus_additional1 = ($addttl+$addttl2+$addttl3)-($savettl+$savettl2+$savettl3);
            }

            $otherLab = '<span class="badge" style="background-color:green">0.00</span>';
            if($this->getLaborShit($id)>$tr1){
                $otherLab = '<span class="badge" style="background-color:red">'.number_format($this->getLaborShit($id),2).'</span>';
            }else{
                $otherLab = '<span class="badge" style="background-color:green">'.number_format($this->getLaborShit($id),2).'</span>';
            }
            $otherOut = '<span class="badge" style="background-color:green">0.00</span>';
            if($this->getOutworkShit($id)>$QtTotal){
                $otherOut = '<span class="badge" style="background-color:red">'.number_format($this->getOutworkShit($id),2).'</span>';
            }else{
                $otherOut = '<span class="badge" style="background-color:green">'.number_format($this->getOutworkShit($id),2).'</span>';
            }
            $otherPnt = '<span class="badge" style="background-color:green">0.00</span>';
            if($this->getPaintShit($id)>$tr2){
                $otherPnt = '<span class="badge" style="background-color:red">'.number_format($this->getPaintShit($id),2).'</span>';
            }else{
                $otherPnt = '<span class="badge" style="background-color:green">'.number_format($this->getPaintShit($id),2).'</span>';
            }

            $table.="<tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Total Additional Inhouse/Outwork</strong></td>
                <td></td>
                <td style='font-size:10px;'>".number_format($adOutwk,2)."</td>
            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Total Inhouse/Outwork</strong></td>
                <td><span class='badge' style='background-color:cadetblue'><strong>".number_format($QtTotal,2)."</span>".$otherOut."</td>
                <td><span class='badge' style='background-color:cadetblue'><strong class='cld'>".number_format($actTotal+$adOutwk,2)."</span></td>

            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Total Additional Labor</strong></td>
                <td></td>
                <td style='font-size:10px;'>".number_format($t2,2)."</td>
            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Total Labor</strong></td>
                <td><span class='badge' style='background-color:cadetblue'><strong contenteditable='true' id='labIDChange' lang='".$id."' onblur='changeLabor(this.lang,this.id)' class='cld'>".number_format($tr1,2)."</span>".$otherLab."</td>
                <td><span class='badge' style='background-color:cadetblue'><strong class='cld'>".number_format($t2+$tr1,2)."</span></td>

            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Total Additional Paint</strong></td>
                <td></td>
                <td style='font-size:10px;'>".number_format($t,2)."</td>
            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Consumables</strong></td>
                <td style='font-size:10px;' contenteditable='true' id='consu1' lang='".$id."'  onblur='getThisConsume(this.lang)'>".number_format($paintSh1,2)."</td>
                <td style='font-size:10px;' contenteditable='true' id='consu2' lang='".$id."'   onblur='getThisConsume_(this.lang)'>".number_format($paintSh2,2)."</td>

            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Total Paint</strong></td>
                <td><span class='badge' style='background-color:cadetblue'><strong contenteditable='true' id='paintIDChange' lang='".$id."' onblur='changePaint(this.lang,this.id)' class='cld'>".number_format($tr2,2)."</span>".$otherPnt."</td>
                <td><span class='badge' style='background-color:cadetblue'><strong class='cld'>".number_format($t+$tr2+($paintSh2-$paintSh1),2)."</span></td>

            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Waste Disposal</strong></td>
                <td><span class='badge' style='background-color:cadetblue'><strong contenteditable='true' id='wasteIDChange' lang='".$id."' onblur='changeWaste(this.lang,this.id)' class='cld'>".number_format($waste,2)."</span></td>
                <td></td>

            </tr>";
            //Eugene Update
            $dbquery=DB::select('select vat from client_details where Key_Ref=? and vat>=1',[$id]);
            $dbquery_count=count($dbquery);
            if($dbquery_count>0){
                foreach($dbquery as $dbrow){
                    $vatVal = ($dbrow->vat);
                    $vat    = ($dbrow->vat/100);
                    $vat_contr = "<span class='badge' style='background-color:cadetblue'><strong contenteditable='true' lang='".$id."' id='vat' name='vat' onblur='updateVat(this.lang)' class='cld'>".number_format($vatVal,2)."</strong></span>";      
                }//End Foreach Loop
            }else{
                $vatVal = 15;
	            $vat    = 0.15;
	            $vat_contr = "<span class='badge' style='background-color:cadetblue'><strong contenteditable='true' lang='".$id."' id='vat' name='vat' onblur='updateVat(this.lang)' class='cld'>".number_format($vatVal,2)."</strong></span>";
            }
            $resultz=DB::select('select id, (sum(Labour)+sum(`Part`)+sum(`Paint`)+sum(`Strip`)+sum(`Strip`)+sum(`Frame`)+sum(`Misc`)+sum(`Outwork`)+sum(`Inhouse`))as sm FROM `additional` where Key_Ref =?',[$id]);
            $consu = $tr2*1/100;
            $ttl1z = $tr1+$tr2+$ttl1+$sundries1;
            $addAd = ($plus_additional1);
            $lessSav = $savettl;
            $dicp = number_format($disc_val1,2);
            $dicp2 = number_format($disc_val2,2);
            $dicv1 = (($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste))*($disc_val1/100);
            $dicv2 = ((($ttl1+$sundries1+$QtTotal+$tr1+$tr2)+($ttlAdd_+$addttl+($sundries2-$sundries1)+$adOutwk+$AddTotal+$t2+$t+($paintSh2-$paintSh1)))-($lessSav+$savTotal))*($disc_val2/100);
            $subt = ($ttl1z+$addAd-$lessSav);
            $newTol = $subt;
            $ttvat = 0;
            $newTol2=0;
            if($newTol>0){
                $ttvat = ($newTol*$vat );
                $newTol2=($newTol*$vat );
            }else{
                $ttvat = 0;
                $newTol2=($newTol);
            }
            $fTol = ($newTol2-$Excess);
            $ss = 0;
            $fs = 0;
            $ms = 0;
            $resultzn=DB::select('select qt.Key_Ref,sum(qt.Strip*ins.Strip)as ss,sum(qt.Frame*ins.Frame)as fs,sum(Misc)as ms from qoutes qt 
            left join insurer ins on qt.Key_Ref= ins.Key_Ref where qt.Key_Ref =? and qoute_type = "0"',[$id]);
            foreach($resultzn as $row){
                $ss = $row->ss;
                $fs = $row->fs;
                $ms = $row->ms;
            }
            foreach($resultz as $row){
                $v1=$vat*(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1);
                $v2=$vat*(((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$adOutwk+$AddTotal+$t2+$t+($paintSh2-$paintSh1)))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2)+($sundries2-$sundries1));
                $dis_id=$row->id;
                $table.="<tr>
                <td colspan='10' style='text-align: right;color:cadetblue;'><strong>Original Amount Of Claim</strong></td>
                <td style='font-size:10px;'>".number_format(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste),2)."</td>
                <td style='color:CornflowerBlue'></td>
            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Plus Additional Costs</strong></td>
                <td></td>
                <td style='font-size:10px;'>".number_format(($ttlAdd_+$addttl+$adOutwk+$AddTotal+$t2+$t+$plus_key_value+($paintSh2-$paintSh1)+$waste),2)."</td>
            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Less Saving</strong></td>
                <td></td>
                <td style='font-size:10px;'> - ".number_format($lessSav+$savTotal+$key_value,2)."</td>
            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Sub Total</strong></td>
                <td></td>
                <td><span class='badge' style='background-color:orange'><strong class='cld'>".number_format((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)+($ttlAdd_+$addttl+$adOutwk+$AddTotal+$t2+$t+($paintSh2-$paintSh1)))-($lessSav+$savTotal)+($sundries2-$sundries1),2)."</strong></span></td>
            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Trade Discount(%)</strong></td>
                <td style='font-size:10px;' contenteditable='true' id='disc1' lang='".$id."'   onblur='getThisDiscount(this.lang)'>".$dicp."</td>
                <td style='font-size:10px;' contenteditable='true' id='disc2' lang='".$id."'   onblur='getThisDiscount_(this.lang)'>".number_format($disc_val2,2)."</td>
            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Less Discount</strong></td>
                <td style='font-size:10px;'> - ".number_format($dicv1,2)."</td>
                <td style='font-size:10px;'> - ".number_format($dicv2,2)."</td>
            </tr>
            <tr style='font-size:10px;'>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Betterment To Client</strong></td>
            <td>".  number_format($btmnt_,2)."</td>
                <td>".number_format($btmnt+$adbt,2)."</td>
            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Sub Total</strong></td>
                <td><span class='badge' style='background-color:orange'><strong class='cld'>".number_format(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1,2)."</strong></span></td>
                <td><span class='badge' style='background-color:orange'><strong class='cld'>".number_format(((($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$waste)+($ttlAdd_+$addttl+$adOutwk+$AddTotal+$t2+$t+($paintSh2-$paintSh1)))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2)+($sundries2-$sundries1),2)."</strong></span></td>
            </tr>
			<!--eugene update-->
            <tr>
                <td colspan='10' style='text-align: right;color:white;'><strong>Value Added Tax <b color:white;>".$vat_contr."%</b></td>
                <td style='font-size:10px;'>".number_format($v1,2)."</td>
                <td style='font-size:10px;'>".number_format($v2,1)."</td>
            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Sub Total</strong></td>
                <td><span class='badge' style='background-color:orange'><strong class='cld'>".number_format($v1+(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1),2)."</strong></td>
                <td><span class='badge' style='background-color:orange'><strong class='cld'>".number_format($v2+((($ttl1+$waste+$sundries1+$QtTotal+$tr1+$tr2)+($ttlAdd_+$addttl+($sundries2-$sundries1)+$adOutwk+$AddTotal+$t2+$t+($paintSh2-$paintSh1)))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2),2)."</strong></td>
            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Excess</strong></td>
                <td style='font-size:10px;' contenteditable='true' id='fnexc1'  lang='".$id."'  onblur='getThisExcess(this.lang)'>".number_format($Excess,2)."</td>
                <td style='font-size:10px;' contenteditable='true' id='fnexc2' lang='".$id."'   onblur='getThisExcess_(this.lang)'>".number_format($Excess2,2)."</td>
            </tr>
            <tr>
                <td colspan='10' style='text-align: right;color: cadetblue'><strong>Total</strong></td>
                <td><span class='badge' style='background-color:cadetblue'><strong class='cld'>".number_format(($v1+(($ttl1+$sundries1+$QtTotal+$tr1+$tr2+$paintSh1+$waste)-$btmnt_-$dicv1))-$Excess,2)."</strong></td>
                <td><span class='badge' style='background-color:cadetblue'><strong class='cld'>".number_format($v2+((($ttl1+$waste+$sundries1+$QtTotal+$tr1+$tr2)+($ttlAdd_+$addttl+($sundries2-$sundries1)+$adOutwk+$AddTotal+$t2+$t+($paintSh2-$paintSh1)))-($lessSav+$savTotal)-$dicv2-($btmnt+$adbt)+$paintSh2)-$Excess2,2)."</strong></td>
            </tr>";
            }

        }//End Of Function 
        $client_name=DB::table('client_details')
                            ->where('client_details.Key_Ref','=',$id)
                            ->join('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                            ->select('client_details.Key_Ref','client_details.Date','client_details.Fisrt_Name','client_details.Last_Name','client_details.Model','client_details.sign_costing','client_details.Reg_NO','insurer.Assessor','insurer.Claim_NO')
                            ->get();

        $check_signed=DB::table('client_details')
                        ->where('Key_Ref','=',$id)
                        ->where('sign_costing','=','1')
                        ->get();


        $check_closed=DB::table('client_details')
                         ->where('Key_Ref','=',$id)
                         ->where('Inv_Date','!=','')
                         ->get();   
        
        $check_oper=DB::table('oper')->get(); 
        
        #COUNT THE PHOTOS
        $finalstage_photos_count=DB::table('track_photos')->where('Key_Ref','=',$id)->where('category','=','FINAL STAGE')->count();
        $wip_photos_count=DB::table('track_photos')->where('Key_Ref','=',$id)->where('category','=','Work In Progress')->count();
        $additional_photos_count=DB::table('track_photos')->where('Key_Ref','=',$id)->where('category','=','ADDITIONAL')->count();
        $security_photos_count=DB::table('securityphotos')->where('Key_Ref','=',$id)->count();

        
        return view('final_stage.client',['check_oper'=>$check_oper,'close'=>$close,'check_closed'=>$check_closed,'key'=>$id,'client_detal'=>$result1_,'check_signed'=>$check_signed,'discount'=>$result1_aa,'table'=>$table,'neo_client'=>$client_name,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing,'final'=>$final,'sign'=>$sign,'final_photo_count'=>$finalstage_photos_count,'wip_photo_count'=>$wip_photos_count,'additional_photo_count'=>$additional_photos_count,'security_photo_count'=>$security_photos_count]);

    }

    public function getRate($ref, $amount){
        $rate = 0;
        $res = DB::select("select `labour` FROM `insurer` WHERE `Key_Ref`=?",[$ref]);
        foreach($res as $row){
            $rate = ($amount * $row->labour);
        }
        return $rate;
    }
    
    public function getOutworkShit($ref){
        $outt = array();
        $res8 = DB::select("select user,datetime FROM workshop se WHERE se.Key_Ref =? AND (se.stage = '31' OR se.stage='13') ORDER BY datetime",[$ref]);
        $res8_count=count($res8);
        if ($res8_count> 0) {
            foreach($res8 as $row) {
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
            $ress1 = DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>? AND cn.Key_Ref =? limit 1",[$logtime,$ref]);
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
                foreach($ress1 as $roww) {
                    $wewant2 = $roww->datetime;
                }
                array_push($avail,($wewant2));
            }
            if ($ress2_count > 0) {
                foreach($ress2 as $roww) {
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
                $spent =  $this->getRemainingTime($logtime, $wewant) / 3600;
    
            } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                $spent =  $this->getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                $wewant =$date . ' 17:00:00'; 
            }
            array_push($outt, $spent);
            }
            return $this->getRate($ref, array_sum($outt));
        }
    }

    public function getRemainingTime($start, $end){
            // Declare and define two dates
    $date1 = strtotime($start);
    $date2 = strtotime($end);

    // Formulate the Difference between two dates
    $diff = abs($date2 - $date1);

    return $diff;
    }

    public function getLaborShit($ref){
        $stripp = array();
        $panell = array();
        $res1 = DB::select("select user,datetime FROM workshop se WHERE se.Key_Ref =? AND (se.stage = '9' OR se.stage = '31' OR se.stage = '32') ORDER BY datetime",[$ref]);
        $res1_count=count($res1);
        if ($res1_count > 0) {
        $add = 0;
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
            $ress1 =DB::select("select DISTINCT cn.datetime,cn.overtime FROM workshop cn WHERE cn.DATETIME>? AND cn.Key_Ref =? AND cn.USER =? limit 1",[$logtime,$ref,$usa]);
            $ress2 =DB::select("select DISTINCT cn.datetime,cn.overtime FROM workshop cn WHERE cn.DATETIME>? AND cn.USER =?  AND (cn.stage = '9' OR cn.stage = '31') limit 1",[$logtime,$usa]);
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
                foreach($ress1 as $roww) {
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
            }elseif(count($avail)==0 && (strtotime(date('Y-m-d H:i:s'))<strtotime($date . ' 17:00:00'))){
                $wewant = 'In Progress...';
            }
            if (strtotime(substr($wewant, 0, 10)) == strtotime($date)) {
                $spent =  $this->getRemainingTime($logtime, $wewant) / 3600;
    
            } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                $spent =  $this->getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                $wewant =$date . ' 17:00:00'; 
            }
            array_push($panell, $spent);
    }}
        $res = DB::select("select user,datetime FROM workshop se WHERE se.Key_Ref =? AND (se.stage = '7' OR se.stage='11') ORDER BY datetime",[$ref]);
        $res_count=count($res);    
        if ($res_count> 0) {
            foreach ($res as $row) {
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
                $ress1 = DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>? AND cn.Key_Ref =? limit 1",[$logtime,$ref]);
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
                    foreach($ress1 as $roww) {
                        $wewant2 = $roww->datetime;
                    }
                    array_push($avail,($wewant2));
                }
                if ($ress2_count > 0) {
                    foreach($ress2 as $roww) {
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
                    $spent =  $this->getRemainingTime($logtime, $wewant) / 3600;
        
                } else if (strtotime($wewant) > strtotime($logtime) && (strtotime(substr($wewant, 0, 10)) > strtotime($date))) {
                    $spent =  $this->getRemainingTime($logtime, $date . ' 17:00:00') / 3600;
                    $wewant =$date . ' 17:00:00'; 
                }
                array_push($stripp, $spent);
            }
        }
    
        return $this->getRate($ref,(array_sum($stripp)+ array_sum($panell)));
    }

    public function getpaintShit($ref){
        
    $res2 = DB::select("select user,datetime FROM workshop se WHERE se.Key_Ref =? AND (se.stage = '10' OR se.stage = '26' OR se.stage = '27' OR se.stage = '28' OR se.stage = '29') ORDER BY datetime",[$ref]);
    $res2_count=count($res2);
    if ($res2_count > 0) {
        foreach($res2 as $row) {
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
            $ress1 = DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>? AND cn.Key_Ref =? limit 1",[$logtime,$ref]);
            $ress2 = DB::select("select DISTINCT cn.datetime FROM workshop cn WHERE cn.DATETIME>? AND cn.USER =? limit 1",[$logtime,$usa]);
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
            if ($ress2_count > 0) {
                foreach($ress2 as $roww) {
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
       return $this->getRate($ref, array_sum($paintt), $db);
    }

    
    }

    public function update_final_oper(Request $request){
        $id=$request->id;
        $oper=$request->d;
        DB::table('qoutes')
                ->where('id','=',$id)
                ->update(['Oper'=>$oper]);
    }

    public function update_final_parts(Request $request){
        $id=$request->id;
        $des=$request->d;
        DB::table('qoutes')
                ->where('id',$id)
                ->update(['Parts_sales'=>$des]);
    }

    public function update_final_check(Request $request){
        $id = $request->dt;
        $ck = $request->check;
        DB::table('qoutes')
                ->where('id',$id)
                ->update(['Checked'=>$ck]);
    }


    public function update_final_markup(Request $request){
        $id = $request->id;
        $mark =$request->d;
       
        //return "Value:";
       // return $id;

        
        $update = DB::table('qoutes')->where('id','=',$id)->update(['MarkUp'=>$mark]);
        /*
        if($update){
          return 1;
        }else{
            return 0;
        }
        ***/

    }

    public function update_final_markup_only(Request $request){
        $id = $request->id;
        $opr = $request->d;
        DB::table('qoutes')
                ->where('id','=',$id)
                ->update(['MarkUp2'=>$opr,'MarkUp'=>0]);
        
    }

    public function update_final_betterment(Request $request){
        $id = $request->id;
        $opr = $request->d;
        DB::table('qoutes')
                ->where('id','=',$id)
                ->update(['Betterment'=>$opr]);

    }

    public function get_sundries(Request $request){
        $id = $request->id;
        $sun = $request->d;
        $exist=DB::table('betterment')->where('Key_Ref','=',$id)->get();
        if($exist==null){
            DB::table('betterment')
                ->insert(['Key_Ref'=>$id,'sundries1'=>$sun]);
        }else{
            DB::table('betterment')
                    ->where('Key_Ref','=',$id)
                    ->update(['sundries1'=>$sun]);
        }
        
    }

    public function get_sundries_(Request $request){
        $id = $request->id;
        $sun = $request->d;
        $exist=DB::table('betterment')->where('Key_Ref','=',$id)->whereNotNull('sundries2')->get();
        if($exist==null){
            DB::table('betterment')->insert(['Key_Ref'=>$id,'sundries2'=>$sun]);
        }else{
            DB::table('betterment')->where('Key_Ref','=',$id)->update(['sundries2'=>$sun]);
        }
    }

    public function update_final_labour(Request $request){
        $ref = $request->ref;
        $val = $request->val;
        $exist=DB::table('Betterment')->where('Key_Ref','=',$ref)->whereNull('labour')->get();
        if($exist==null){
            DB::table('betterment')->insert(['Key_Ref'=>$ref,'labour'=>$val]);
        }else{
            DB::table('betterment')->where('Key_Ref','=',$ref)->update(['labour'=>$val]);
        }
    }

public function update_final_consumables(Request $request){
    $id = $request->ln;
    $sun = $request->d;
    $exist=DB::table('betterment')->where('Key_Ref','=',$id)->whereNull('paintShop1')->get();
    if($exist==null){
        DB::table('betterment')->insert(['Key_Ref'=>$id,'paintShop1'=>$sun]);
    }else{
        DB::table('betterment')->where('Key_Ref','=',$id)->update(['paintShop1'=>$sun]);
    }

}

public function update_final_consumables_(Request $request){
    $id = $request->ln;
    $sun = $request->d;
    $exist=DB::table('betterment')->where('Key_Ref','=',$id)->whereNull('paintShop2')->get();
    if($exist==null){
        DB::table('betterment')->insert(['Key_Ref'=>$id,'paintShop2'=>$sun]);
    }else{
        DB::table('betterment')->where('Key_Ref','=',$id)->update(['paintShop2'=>$sun]);
    }
}

public function update_final_paint(Request $request){
    $ref = $request->ref;
    $val = $request->val;
    $exist=DB::table('betterment')->where('Key_Ref','=',$ref)->whereNull('paint')->get();
    if($exist==null){
        DB::table('betterment')->insert(['Key_Ref'=>$ref,'paint'=>$val]);
    }else{
        DB::table('betterment')->where('Key_Ref','=',$ref)->update(['paint'=>$val]);
    }
    
}

public function update_final_waste(Request $request){
    $ref = $request->ref;
    $waste = $request->waste;
    $exist=DB::table('betterment')->where('Key_Ref','=',$ref)->whereNotNull('waste')->get();
    if($exist==null){
        DB::table('betterment')->insert(['Key_Ref'=>$ref,'waste'=>$waste]);
    }else{
        DB::table('betterment')->where('Key_Ref','=',$ref)->update(['waste'=>$waste]);
    }

}

public function get_final_discount(Request $request){
    $id = $request->id;
    $disc = $request->d;
    DB::table('qoutes')->where('Key_Ref','=',$id)->update(['Discount'=>$disc]);
    
}



public function get_final_excess(Request $request){
    $id = $request->id;
    $exc = $request->d;
    $exist=DB::table('betterment')->where('Key_Ref','=',$id)->whereNull('Excess_1')->get();
    if($exist==null){
        DB::table('betterment')->insert(['Key_Ref'=>$id,'Excess_1'=>$exc]);
    }else{
        DB::table('betterment')->where('Key_Ref','=',$id)->update(['Excess_1'=>$exc]);
    }
    

}

public function get_final_excess_(Request $request){
    $id = $request->id;
    $exc = $request->d;
    $exist=DB::table('betterment')->where('Key_Ref','=',$id)->whereNull('Excess_2')->get();
    if($exist==null){
        DB::table('betterment')->insert(['Key_Ref'=>$id,'Excess_2'=>$exc]);
    }else{
        DB::table('betterment')->where('Key_Ref','=',$id)->update(['Excess_2'=>$exc]);
    }

}

public function update_final_desc(Request $request){
    $id = $request->id;
    $des = $request->d;
    DB::table('qoutes')->where('id','=',$id)->update(['Description'=>$des]);

}

public function update_final_landed(Request $request){
    $id = $request->dt;
    $ck = $request->check;
    DB::table('qoutes')->where('id',$id)->update(['Checked'=>$ck]);

}

public function update_signed(Request $request){
    $id=$request->id;
    DB::table('client_details')
                    ->where('Key_Ref','=',$id)
                    ->update(['sign_costing'=>'1']);
    return back()->with(['message'=>'Costing Has Been Signed!']);
}

public function update_unsigned(Request $request){
    $id=$request->id;
    DB::table('client_details')
                    ->where('Key_Ref','=',$id)
                    ->update(['sign_costing'=>'0']);

    return back()->with(['message'=>'Costing Has Been Unsigned!']);

}

public function statements(Request $request){
    $id=$request->id;
    $start=$request->from;
    $to=$request->to;
    $new_date = date('Y-m-d',strtotime($to."+ 4 months"));
    $data='';
    $data.='<table>';
    $dbquery=DB::select("select DISTINCT(a.Supplier),a.date FROM confirmed_orders a WHERE a.Key_Ref=?",[$id]);
    if(count($dbquery)>0){
        foreach($dbquery as $dbrow){
        
        $supplier = $dbrow->Supplier;
        /*$date     = $dbrow['date'];	
        $new_date = date('Y-m-d',strtotime($date."+ 4 months"));*/
        
        $dbquery_0   = DB::select("select * FROM supplier_statements a WHERE a.supplier=? AND (a.statement_date>=? AND a.statement_date<=?) limit 0,5",[$supplier,$start,$new_date]);
        
        
        if(count($dbquery_0)>0){
        foreach($dbquery_0 as $dbrow_0){
        $data .='
        <tr>
        <td>'.$dbrow_0->account.'</td>
        <td>'.$dbrow_0->supplier.'</td>
        <td>'.$dbrow_0->file.'</td>
        <td>'.$dbrow_0->statement_date.'</td>
        <td><a href="/docs/supplier_statements/'.$dbrow_0->file.'" target="_blank" class="btn btn-primary btn-sm"><span class="fa fa-print"></span></a></td>
        </tr>
        ';	
        }	
        }
        
        }	
        }
        $data.='</table>';
        return $data;

}

    public function pop(Request $request){

        $id   = $request->id;
        $data = "";
        $dbquery=DB::select('select * from client_details where Key_Ref=?',[$id]);

        foreach($dbquery as $dbrow){
            $reg_no = $dbrow->Reg_No;    
        }

        $data.='<table class="table table-stripped">';
        $dbquery_0=DB::select("select * FROM document a WHERE a.Description LIKE 'P.O.Ps For Invoices%' AND a.Key_Ref=?",[$id]);
        if(count($dbquery_0)>0){
            foreach($dbquery_0 as $dbrow_0){

                $url  = "/docs/email/".$dbrow_0->Key_Ref."/".$dbrow_0->url."";  
                $url1 = "/docs/supplier_pop/".$reg_no."/".$dbrow_0->url."";  
                $url2 = "/docs/uploaded/".$dbrow_0->Key_Ref."/".$dbrow_0->url."";
                $url3 = "/docs/supplier_pop/".$dbrow_0->url."";  
                
                if (!file_exists($url)) {
                $file = $url3;
                }elseif(!file_extists($url1)) {
                $file = $url2;
                }elseif(!file_exists($url2)){
                $file = $url1;
                }else{
                $file="#";    
                }
                
                $data .='
                <tr>
                <td>'.$dbrow_0->Description.'</td>
                <td>'.$dbrow_0->url.'</td>
                <td>'.$dbrow_0->date.'</td>
                <td>'.$dbrow_0->time.'</td>
                <td><a href="'.$file.'" target="_blank" class="btn btn-primary btn-sm"><span class="fa fa-print"</a></td>
                </tr>
                ';	
                }	
        }

        $data.='</table>';
        return $data;
        
    }

    public function rfcs(Request $request){
        $id=$request->id;
        $dbquery=DB::select('select * FROM credit_note a WHERE a.Key_Ref=?',[$id]);
        $data    = "";
        $file='';
        $data.='<table class="table table-sm">
        <tr>
        <th>Ref No</th>
        <th>Qty</th>
        <th>Part No</th>
        <th>Description</th>
        <th>Price</th>
        <th>Invoice No</th>
        <th>Date</th>
        <th>#</th>
        </tr>';

        if(count($dbquery)>0){
            foreach($dbquery as $dbrow){
            $file='/docs/supplier_rfc/'.$dbrow->rfcno.'';    
            $data .='
            <tr>
            <td>'.$dbrow->rfcno.'</td>
            <td>'.$dbrow->quantity.'</td>
            <td>'.$dbrow->Part_No.'</td>
            <td>'.$dbrow->Description_2.'</td>
            <td>'.$dbrow->price.'</td>
            <td>'.$dbrow->invoice_no.'</td>
            <td>'.$dbrow->date.'</td>
            <td><a href="/final-generate-rfc/'.$dbrow->id.'" target="_blank" class="btn btn-primary btn-sm" id="'.$dbrow->id.'"><span class="fa fa-print"></span><a></td>
            </tr>
            ';
                
            }	
            }

            $data.='</table>';
            return $data;
    }


    #[ CURRENT LOAD ]
    public function generate_rfc(Request $request){

        $id = $request->id ;
        $result=DB::table('credit_note')
                ->where('credit_note.id','=',$id)
                ->join('confirmed_orders','credit_note.order_number','=','confirmed_orders.order_number')
                ->select('credit_note.Key_Ref','credit_note.rfcno','credit_note.date','confirmed_orders.user','confirmed_orders.Supplier','confirmed_orders.address','confirmed_orders.order_number','credit_note.Description_2','credit_note.price','credit_note.quantity','credit_note.invoice_no','credit_note.Part_No','credit_note.comment')
                ->get();

        $ordnm = '';
        $des = '';
        $key =  '';
        $qty = '';
        $supname = '';
        $supemail = '';
        $ordnum = '';
        $user = '';
        $date = '';
        $rfcno = '';
        $partNo = '';
        $Invceno  = '';
        $price  = '';
        $comm = '';
        foreach( $result as $row )
        {
            $ordnm = $row->order_number;
            $des = $row->Description_2;
            $key =  $row->Key_Ref;
            $qty = $row->quantity;
            $supname = $row->Supplier;
            $supemail = $row->address;
            $ordnum = $row->order_number;
            $user = $row->user;
            $date = $row->date;
            $rfcno = $row->rfcno;
            $partNo = $row->Part_No;
            $Invceno  = $row->invoice_no;
            $price  = number_format($row->price*1.15,2);
            $comm = $row->comment;
        }
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
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
  
        $pdf->setFontSubsetting(true);
  
        $pdf->SetFont('dejavusans', '', 14, '', true);
  
        $pdf->AddPage();
  
        $html = <<<EOD
                <table>
                    <tr>
                        <td style="border-top: 1px solid lightgrey;border-bottom: 1px solid lightgrey;width:350">
                            <table>
                                <tr><td></td></tr>
                                <tr>
                                    <td style="text-align:center;font-size:35"><b>M.A.G</b></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;font-size:20"><b>Motor Accident Group</b></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;font-size:12"><b>Approved Auto Body Provider</b></td>
                                </tr>
                                <tr><td></td></tr>
                            </table>
                        </td>
                        <td style="border-top: 1px solid lightgrey;border-bottom: 1px solid lightgrey;width:100">
                            <table>
                                <tr><td></td></tr>
                                <tr>
                                    <td></td>
                                </tr>
                                <tr><td></td></tr>
                            </table>
                        </td>
                        <td style="border-top: 1px solid lightgrey;border-bottom: 1px solid lightgrey;font-size:7;">
                            <table>
                                <tr><td></td></tr>
                                <tr>
                                    <td style="text-align:left"><b>PO Box 38227</b></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left"><b>Booysens, 2016</b></td>
                                </tr>
                                <tr><td></td></tr>
                                <tr>
                                    <td style="text-align:left"><b>80 Booysen RD</b></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left"><b>Selby 2001</b></td>
                                </tr>
                                <tr><td></td></tr>
                                <tr>
                                    <td style="text-align:left"><b>Tel: 010 591 7550</b></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left"><b>Fax: 086 551 8450</b></td>
                                </tr>
                                <tr><td></td></tr>
                                <tr>
                                    <td style="text-align:left"><b>Email: info@motoraccidentgroup.co.za</b></td>
                                </tr>
                                <tr><td></td></tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <p style="text-align:center"><b><u>Credit Note (RFC)</u></b></p>
                <table style="font-size:8">
                    <tr>
                        <td><b>Supplier Name</b></td>
                        <td style="width:250">: $supname</td>
                        <td><b>Date</b></td>
                        <td>: $date</td>
                    </tr>
                    <tr>
                        <td><b>Supplier Email</b></td>
                        <td style="width:250">: $supemail</td>
                        <td><b>Credit Note No.</b></td>
                        <td>: $rfcno</td>
                    </tr>
                    <tr>
                        <td><b>Order Number</b></td>
                        <td style="width:250">: $ordnum</td>
                        <td><b>Reference</b></td>
                        <td>: $key</td>
                    </tr>
                    <tr>
                        <td><b>Done By</b></td>
                        <td style="width:250">: $user</td>
                        <td><b></b></td>
                        <td></td>
                    </tr>
                </table>
                <p></p>
                <table style="font-size:10;font-family:courier" border="1">
                    <tr style="background-color:lightgrey">
                        <td style="width:70"><b>Quantity</b></td>
                        <td style="width:100"><b>Part Number</b></td>
                        <td style="width:90"><b>Description</b></td>
                        <td style="width:115"><b>Invoice Number</b></td>
                        <td style="width:100"><b>Amount</b></td>
                        <td style="width:185"><b>Comment</b></td>
                    </tr>
                    <tr>
                        <td style="width:70">$qty</td>
                        <td style="width:100">$partNo</td>
                        <td style="width:90">$des</td>
                        <td style="width:115">$Invceno</td>
                        <td style="width:100">$price</td>
                        <td style="width:185">$comm</td>
                    </tr>
                </table>
                <table style="font-size:10;font-family:courier">
                    <tr><td></td><td></td></tr>
                    <tr><td></td><td></td></tr>
                    <tr><td style="border-top: 1px solid lightgrey;text-align:center;border-bottom: 1px solid lightgrey"><b>Driver</b></td><td style="border-top: 1px solid lightgrey;text-align:center;border-bottom: 1px solid lightgrey"><b>Storeman</b></td></tr>
                    <tr><td style="width:300;border-right: 1px solid lightgrey;"></td><td></td></tr>
                    <tr><td style="border-right: 1px solid lightgrey;"></td><td></td></tr>
                    <tr><td style="border-right: 1px solid lightgrey;"></td><td></td></tr>
                    <tr>
                        <td style="width:100;"><b>Driver Name</b></td>
                        <td style="width:200;border-right: 1px solid lightgrey;">:________________________</td>
                        <td style="width:150"><b>Storeman Signature</b></td>
                        <td style="width:200">:________________________</td>
                    </tr>
                    <tr><td></td><td style="border-right: 1px solid lightgrey;"></td></tr>
                    <tr><td></td><td style="border-right: 1px solid lightgrey;"></td><td style="border-bottom: 1px solid lightgrey;"></td><td style="border-bottom: 1px solid lightgrey;"></td></tr>
                    <tr><td></td><td style="border-right: 1px solid lightgrey;"></td></tr>
                    <tr>
                        <td style="width:100"><b>Registration</b></td>
                        <td style="width:200;border-right: 1px solid lightgrey;">:________________________</td>
                    </tr>
                    <tr><td></td><td style="border-right: 1px solid lightgrey;"></td></tr>
                    <tr><td></td><td style="border-right: 1px solid lightgrey;"></td></tr>
                    <tr><td></td><td style="border-right: 1px solid lightgrey;"></td></tr>
                    <tr>
                        <td style="width:100"><b>Driver Signature</b></td>
                        <td style="width:200;border-right: 1px solid lightgrey;">:________________________</td>
                    </tr>
                    <tr><td></td><td style="border-right: 1px solid lightgrey;"></td></tr>
                    <tr><td></td><td style="border-right: 1px solid lightgrey;"></td></tr>
                    <tr>
                        <td style="width:100"><b>Date</b></td>
                        <td style="width:200;border-right: 1px solid lightgrey;">:________________________</td>
                    </tr>
                    <tr><td></td><td style="width:200;border-right: 1px solid lightgrey;"></td></tr>
                    <tr><td style="border-bottom: 1px solid lightgrey;"></td><td style="border-bottom: 1px solid lightgrey;border-right: 1px solid lightgrey;"></td></tr>
                </table><p></p>
            <div style="color:#333;font-size:9;font-family: Arial, Helvetica, sans-serif;background-color:#E8E8E8">
                        <div></div>
                        <b>&nbsp;NOTE:</b>&nbsp;Once the driver has taken the part, this is an official credit note, Motor Accident Group will not be responsible for the part returned once the driver has taken the part.<br>
                        <div></div>
                    </div>
        EOD;
  
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
  
        // ---------------------------------------------------------
  
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('return for credit.pdf', 'I');

    }

    public function update_closed_record(Request $request){
        $ref = $request->id;
        $num = $request->num;
        $date = '';
        if($num==1){
            $date = date('Y-m-d');
        }elseif($num==0){
            $date = '';
        }
        DB::table('client_details')
                ->where('Key_Ref','=',$ref)
                ->update(['Inv_Date'=>$date]);

        return back()->with(['message'=>'Closed Record Updated!']);        

    }

    #MAKING CHANGE WITH THE DATA
    public function final_stage_additional(Request $request){
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Parts Additionals
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $id=$request->id;
        $result =DB::select("select distinct * from additional  where Key_Ref=? and (Part>0 or Part<0)",[$id]);
        $count = 1;
        $ttal = 0;
        $part = 0;
        $oper = DB::select("select * from oper order by oper");
        $opt = '';
        $opti = 0;
        $option = '';
        $optionz = '';
        $optin = 0;
        $table='';
        $paint_total = 0;
        
        foreach($oper as $row)
        {
            $opt.= "<option val='".$row->oper."'>".$row->oper."</option>";
        }
        while($opti<=100){
            $option.="<option>".number_format($opti,2)."</option>";
            $opti++;
        }
        while($optin<=50){
            $optionz.="<option>".number_format($optin,2)."</option>";
            $optin++;
        }
            
        
        $table.="<table class='table table-stripped table-dark' style='margin-bottom:10px;'>";
        $table.="<thead style='font-size:10px;font-weight:bold;background-color:grey;color:white;'>
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th style='125px;'>Oper</th>
                        <th colspan='2'>Landing Price</th>
                        <th>Nett+Mark-Up</th>
                        <th>Mark-Up Only</th>
                        <th>Betterment</th>
                        <th>Saving</th>
                        <th>Additional</th>
                        <th>Quoted Price</th>
                        <th>Actual Price</th>
                    </tr>
                </thead>
                <tbody>";


        foreach($result as $row)
           {
                   //$emparray[] = $row;
                    $actup = 0;
                    if($row->Checked=='yes'){
                            $chk ="checked";
                        }else{
                            $chk ="";
                        }
                        if(number_format($row->MarkUp2)==0){
                            $actup =  $row->Quantity*$row->Part*(1+($row->MarkUp/100));
                        }else{
                            $actup = $row->Quantity*$row->Part*(($row->MarkUp2/100));
                        }
                        $ttal += $actup;
                    $table.="<tr>"
                            . "<td>".$count."</td>"
                            . "<td contenteditable='true' id='".$row->id."_' lang='".$id."' onblur='funkThisAddBox(this.id,this.lang)'>".$row->Description."</td>"
                            . "<td style='150px;' id='addEditTd_".$count."-".$row->id."' onblur='addThisAddOper(this.id)'><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='addEditAddQtsOperNewTd_".$count."' name='".$row->Oper."_".$count."' title='".$id."' lang='".$row->id."_".$count."' class='form-control form-control-sm input-sm' onchange='changeThisAddOper(this.lang,this.title)' onload='funkThisAddOper(this.name)'><option style='color:olive' selected>".$row->Oper."</option>".$opt."
                              </select></td>"

                            . "<td contenteditable='true' id='".$row->id."_add' lang='".$id."' onblur='funkThixAddBox(this.id,this.lang)'>".$row->Part."</td>"

                            ."<td style='width:20px'>
                                <label>
                                    <input type='checkbox' id='".$row->id."_".$count."-' onchange='storeSomeChangeadd(this.id)' $chk />
                                    <span></span>
                                </label>
                            </td>"

                            . "<td style='width:100px;'><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='addEditAddQtsMarkUpNewTd_".$count."' title='".$id."' name='".$row->MarkUp."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisAddMarkUp(this.lang,this.title)' onload='funkThisAddMarkUp(this.name)'><option style='color:olive' selected>".$row->MarkUp."</option>".$optionz."
                              </select></td>"

                            . "<td style='width:100px;'><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='addEditAddQtsMarkUpNewTd1_".$count."' title='".$id."' name='".$row->MarkUp2."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisAddMarkUp_(this.lang,this.title)' onload='funkThisAddMarkUp_(this.name)'><option style='color:olive' selected>".$row->MarkUp2."</option>".$optionz."
                              </select></td>"
                            . "<td style='width:100px;'><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='addEditAddQtsBtmentNewTd_".$count."' title='".$id."' name='".$row->Betterment."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisAddBtment(this.lang,this.title)' onload='funkThisAddBtment(this.name)'><option style='color:olive' selected>".$row->Betterment."</option>".$option."
                              </select></td>"
                            . "<td>0.00</td>"
                            . "<td>0.00</td>"
                            . "<td>0.00</td>"
                            . "<td>".number_format($actup,2)."</td>"
                            //. "<td><button class='btn btn-xs btn-primary' id='".$row['id']."' onclick='editThisAddtStuff_1(this.id)'><span class='glyphicon glyphicon-edit'></span></button></td>"
                       . "</tr>";
                    $count++;
                }
                $table.= "<tr>"
                        . "<td colspan='11' style='text-align: right;color: cadetblue;font-size:13px;'><strong>Sub Total</strong></td>"
                        . "<td><span class='badge' style='background-color:orange;font-size:13px;'><strong class='cld'>".  number_format($ttal,2)."</strong></span></td>"
                        . "</tr>"; 
                $table.="</tbody></table>";





        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Outwork Additionals        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $result = DB::select("select distinct * from additional  where Key_Ref=? and (Outwork>0 or Outwork<0)",[$id]);
        $table.="<table class='table table-stripped table-dark' style='margin-bottom:10px;'>";
        $table.="<thead style='font-size:10px;font-weight:bold;background-color:grey;color:white;'>
                    <tr>
                        <th>#</th>
                        <th>Outwork</th>
                        <th style='125px;'>Oper</th>
                        <th colspan='2'>Landing Price</th>
                        <th>Nett+Mark-Up</th>
                        <th>Mark-Up Only</th>
                        <th>Betterment</th>
                        <th>Saving</th>
                        <th>Additional</th>
                        <th>Quoted Price</th>
                        <th>Actual Price</th>
                    </tr>
                </thead>
                <tbody>";
        $ttal=0;        
        foreach($result as $row)
        {
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
                $ttal += $actup;

                $table.= "<tr>"
                . "<td>".$count."</td>"
                . "<td contenteditable='true' id='".$row->id."' lang='".$id."' onblur='funkThisOutBox(this.id,this.lang)'>".$row->Description."</td>"

                . "<td>Outwork</td>"

                . "<td contenteditable='true' id='".$row->id."_ac' lang='".$id."' onblur='funkThixOutBox(this.id,this.lang)'>".$row->Outwork."</td>"

                ."<td style='width:20px;'><label><input type='checkbox' id='".$row->id."_".$count."-' onchange='storeSomeChangeadd(this.id)' $chk /><span></span>
                </label></td>"

                . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='outEditAddQtsMarkUpNewTd_".$count."' title='".$id."' name='".$row->MarkUp."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisOutMarkUp(this.lang,this.title)' onload='funkThisOutMarkUp(this.name)'><option style='color:olive' selected>".$row->MarkUp."</option>".$optionz."
                   </select></td>"

                . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='outEditAddQtsMarkUpNewTd1_".$count."' title='".$id."' name='".$row->MarkUp2."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisOutMarkUp_(this.lang,this.title)' onload='funkThisOutMarkUp_(this.name)'><option style='color:olive' selected>".$row->MarkUp2."</option>".$optionz."
                   </select></td>"

                . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='outEditAddQtsBtmentNewTd_".$count."' title='".$id."' name='".$row->Betterment."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisOutBtment(this.lang,this.title)' onload='funkThisOutBtment(this.name)'><option style='color:olive' selected>".$row->Betterment."</option>".$option."
                   </select></td>"

                . "<td>0.00</td>"
                . "<td>0.00</td>"
                . "<td>0.00</td>"
                . "<td>".number_format($actup,2)."</td>"
               
           . "</tr>";
                /***
           $table.= "<tr>"
                   . "<td>".$count."</td>"
                   . "<td contenteditable='true' id='".$row->id."' onblur='funkThisOutBox(this.id)'>".$row->Description."</td>"
                   . "<td>Outwork</td>"
                   . "<td contenteditable='true' id='".$row->id."_ac' onblur='funkThixOutBox(this.id)'>".$row->Outwork."</td>"
                   ."<td style='width:20px;'><label><input type='checkbox' id='".$row->id."_".$count."-' onchange='storeSomeChangeadd(this.id)' $chk /><span></span>
                   </label></td>"
                   . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='outEditAddQtsMarkUpNewTd_".$count."' name='".$row->MarkUp."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisOutMarkUp(this.lang)' onload='funkThisOutMarkUp(this.name)'><option style='color:olive' selected>".$row->MarkUp."</option>".$optionz."
                      </select></td>"
                   . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='outEditAddQtsMarkUpNewTd1_".$count."' name='".$row->MarkUp2."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisOutMarkUp_(this.lang)' onload='funkThisOutMarkUp_(this.name)'><option style='color:olive' selected>".$row->MarkUp2."</option>".$optionz."
                      </select></td>"
                   . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='outEditAddQtsBtmentNewTd_".$count."' name='".$row->Betterment."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisOutBtment(this.lang)' onload='funkThisOutBtment(this.name)'><option style='color:olive' selected>".$row->Betterment."</option>".$option."
                      </select></td>"
                   . "<td>0.00</td>"
                   . "<td>0.00</td>"
                   . "<td>0.00</td>"
                   . "<td>".number_format($actup,2)."</td>"
                  
              . "</tr>";
              ******/
           $count++;
        }
        $table.= "<tr>"
                . "<td colspan='11' style='text-align: right;color: cadetblue;font-size:13px;'><strong>Sub Total</strong></td>"
                . "<td><span class='badge' style='background-color:orange;text-align:right;font-size:13px;'><strong class='cld'>".  number_format($ttal,2)."</strong></span></td>"
           . "</tr></tbody></table>";
        



          
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Inhouse Additionals    
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $inhouse =DB::select("select distinct * from additional  where Key_Ref=? and (Inhouse>0 or Inhouse<0)",[$id]);
        $table.="<table class='table table-stripped table-dark' style='margin-bottom:10px;'>";
        $table.="<thead style='font-size:10px;font-weight:bold;background-color:grey;color:white;'>
                    <tr>

                        <th>#</th>
                        <th>Inhouse</th>
                        <th style='125px;'>Oper</th>
                        <th colspan='2'>Landing Price</th>
                        <th>Nett+Mark-Up</th>
                        <th>Mark-Up Only</th>
                        <th>Betterment</th>
                        <th>Saving</th>
                        <th>Additional</th>
                        <th>Quoted Price</th>
                        <th>Actual Price</th>


                    </tr>
                </thead>
                <tbody>";
        $ttal=0;
        foreach($inhouse as $row)
        {
                $actup = 0;
                if(number_format($row->MarkUp2)==0){
                    $actup = $row->Inhouse*(1+($row->MarkUp/100));
                }else{
                    $actup = $row->Inhouse*(($row->MarkUp2/100));
                }
                $ttal += $actup;

                $table.="<tr>"
                . "<td>".$count."</td>"
                . "<td contenteditable='true' id='".$row->id."_".$count."' lang='".$id."' onblur='funkThisInhsBox(this.id,this.lang)'>".$row->Description."</td>"

                . "<td>Inhouse</td>"

                . "<td contenteditable='true' id='".$row->id."_".$count."ap' lang='".$id."' onblur='funkThixInhsBox(this.id,this.lang)' >".$row->Inhouse."</td>"

                . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='InhsEditAddQtsMarkUpNewTd_".$count."' title='".$id."' name='".$row->MarkUp."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisInhsMarkUp(this.lang,this.title)' onload='funkThisInhsMarkUp(this.name)'><option style='color:olive' selected>".$row->MarkUp."</option>".$optionz."
                  </select></td>"


                . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='InhsEditAddQtsMarkUpNewTd1_".$count."' name='".$row->MarkUp2."_".$count."' title='".$id."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisInhsMarkUp_(this.lang,this.title)' onload='funkThisInhsMarkUp_(this.name)'><option style='color:olive' selected>".$row->MarkUp2."</option>".$optionz."
                  </select></td>"


                . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='InhsEditAddQtsBtmentNewTd_".$count."' title='".$id."' name='".$row->Betterment."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisInhsBtment(this.lang,this.title)' onload='funkThisInhsBtment(this.name)'><option style='color:olive' selected>".$row->Betterment."</option>".$option."
                  </select></td>"

                . "<td>0.00</td>"
                . "<td>0.00</td>"
                . "<td>0.00</td>"
                . "<td>".number_format($actup,2)."</td>"
               // . "<td><button class='btn btn-xs btn-primary' name='".$row['id']."' onclick='editThisAddtStuff_3(this.name)'><span class='glyphicon glyphicon-edit'></span></button></td>"
           . "</tr>";

                /****
                $table.= "<tr>"
                   . "<td>".$count."</td>"
                   . "<td contenteditable='true' id='".$row->id."' onblur='funkThisOutBox(this.id)'>".$row->Description."</td>"
                   . "<td>Outwork</td>"
                   . "<td contenteditable='true' id='".$row->id."_ac' onblur='funkThixOutBox(this.id)'>".$row->Outwork."</td>"
                   . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='outEditAddQtsMarkUpNewTd_".$count."' name='".$row->MarkUp."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisOutMarkUp(this.lang)' onload='funkThisOutMarkUp(this.name)'><option style='color:olive' selected>".$row->MarkUp."</option>".$optionz."
                      </select></td>"
                   . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='outEditAddQtsMarkUpNewTd1_".$count."' name='".$row->MarkUp2."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisOutMarkUp_(this.lang)' onload='funkThisOutMarkUp_(this.name)'><option style='color:olive' selected>".$row->MarkUp2."</option>".$optionz."
                      </select></td>"
                   . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='outEditAddQtsBtmentNewTd_".$count."' name='".$row->Betterment."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisOutBtment(this.lang)' onload='funkThisOutBtment(this.name)'><option style='color:olive' selected>".$row->Betterment."</option>".$option."
                      </select></td>"
                   . "<td>0.00</td>"
                   . "<td>0.00</td>"
                   . "<td>0.00</td>"
                   . "<td>".number_format($actup,2)."</td>"
                  
              . "</tr>";
              *****/


            $count++;
        }
        $table.="<tr>"
                . "<td colspan='11' style='text-align: right;color: cadetblue;font-size:13px;'><strong>Sub Total</strong></td>"
                . "<td><span class='badge' style='background-color:orange;font-size:13px;'><strong class='cld'>".  number_format($ttal,2)."</strong></span></td>"
           . "</tr></tbody></table>";




        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //R+R
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $randr=DB::select("select distinct * from additional  where Key_Ref=? and (RandR>0 or RandR<0)",[$id]);        
        $table.="<table class='table table-stripped table-dark' style='margin-bottom:10px;'>";
        $table.="<thead style='font-size:10px;font-weight:bold;background-color:grey;color:white;'>
                    <tr>
                        <th>#</th>
                        <th>R+R</th>
                        <th>Oper</th>
                        <th>Landing Price</th>
                        <th>Mark-Up</th>
                        <th>Betterment</th>
                        <th>Saving</th>
                        <th>Additional</th>
                        <th>Quoted Price</th>
                        <th>Actual Price</th>

                    </tr>
                </thead>
                <tbody>";
        
                foreach($randr as $row)
                {
                   
                    $ttal += $row->RandR;

                    $table.= "<tr>"
                    . "<td>".$count."</td>"

                    . "<td contenteditable='true' id='".$row->id."_".$count."v' lang='".$id."' onblur='funkThisrrBox(this.id,this.lang)'>".$row->Description."</td>"

                    . "<td>RandR</td>"

                    . "<td contenteditable='true' id='".$row->id."_".$count."rr' lang='".$id."' onblur='funkThixrrBox(this.id,this.lang)' >".$row->RandR."</td>"

                    . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='rrEditAddQtsMarkUpNewTd-_".$count."' title='".$id."' name='".$row->MarkUp."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisrrMarkUp(this.lang,this.title)' onload='funkThisrrMarkUpjfsjhs(this.name)'><option></option>
                        </select></td>"

                    . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='rr-EditAddQtsBtmentNewTd_".$count."' title='".$id."' name='".$row->Betterment."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisrrBtment(this.lang,this.title)' onload='funkThisrrBtment(this.name)'><option style='color:olive' selected>".$row->Betterment."</option>".$option."
                        </select></td>"

                    . "<td>0.00</td>"
                    . "<td>0.00</td>"
                    . "<td>0.00</td>"
                    . "<td>".number_format($row->RandR,2)."</td>"
               . "</tr>";

                     /****
                        $table.= "<tr>"
                                . "<td>".$count."</td>"
                                . "<td contenteditable='true' id='".$row->id."_".$count."v' onblur='funkThisrrBox(this.id)'>".$row->Description."</td>"
                                . "<td>RandR</td>"
                                . "<td contenteditable='true' id='".$row->id."_".$count."rr' onblur='funkThixrrBox(this.id)' >".$row->RandR."</td>"
                                . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='rrEditAddQtsMarkUpNewTd-_".$count."' name='".$row->MarkUp."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisrrMarkUp(this.lang)' onload='funkThisrrMarkUpjfsjhs(this.name)'><option>0.00</option>
                                    </select></td>"
                                . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='rr-EditAddQtsBtmentNewTd_".$count."' name='".$row->Betterment."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisrrBtment(this.lang)' onload='funkThisrrBtment(this.name)'>".$option."
                                    </select></td>"
                                . "<td>0.00</td>"
                                . "<td>0.00</td>"
                                . "<td>0.00</td>"
                                . "<td>".number_format($row->RandR,2)."</td>"
                           . "</tr>";
                           *****/

                        $count++;
                    
                }


                $table.= "<tr>"
                        . "<td colspan='11' style='text-align: right;color: cadetblue;font-size:13px;'><strong>Sub Total</strong></td>"
                        . "<td><span class='badge' style='background-color:orange;font-size:13px;'><strong class='cld'>".  number_format($ttal,2)."</strong></span></td>"
                   . "</tr></tbody></table>";








        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Labour Additionals        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*
        $labour =DB::select("select distinct * from additional  where Key_Ref=? and Labour>0",[$id]);
        $frame=DB::select("select distinct * from additional  where Key_Ref=? and Frame>0",[$id]);*/

        $labour =DB::select("select distinct * from additional  where Key_Ref=? and (Labour>0 or Labour<0 )",[$id]);
        $frame=DB::select("select distinct * from additional  where Key_Ref=? and (Frame>0 or Frame<0)",[$id]);

        $table.="<table class='table table-stripped table-dark' style='margin-bottom:10px;'>";
        $table.="<thead style='font-size:10px;font-weight:bold;background-color:grey;color:white;'>
                    <tr>
                        
                        <th>#</th>
                        <th>Labour</th>
                        <th>Oper</th>
                        <th>Landing Price</th>
                        <th>Mark-Up</th>
                        <th>Betterment</th>
                        <th>Saving</th>
                        <th>Additional</th>
                        <th>Quoted Price</th>
                        <th>Actual Price</th>

                    </tr>
                </thead>
                <tbody>";   
                $labour_total = 0;     
                foreach($labour as $row)
                {
                   $lbm = 0;
                   $opa = 'Labor';
                   
                    //$ttal += $row->Labour;
                    $labour_total += $row->Labour;

                    $table.="<tr>"
                    . "<td>".$count."</td>"

                    . "<td contenteditable='true' id='".$row->id."_".$count."L' lang='".$id."' onblur='funkThislBox(this.id,this.lang)'>".$row->Description."</td>"

                    . "<td>".$opa."</td>"

                    . "<td contenteditable='true' id='".$row->id."_L' lang='".$id."' onblur='funkThixlBox(this.id,this.lang)' >".$row->Labour."</td>"

                    . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='lEditAddQtsMarkUpNewTd_".$count."' title='".$id."' name='".$row->MarkUp."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThislMarkUp(this.lang,this.title)' onload='funkThislMarkUpvnvn(this.name)'><option></option>
                        </select></td>"

                    . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='lEditAddQtsBtmentNewTd_".$count."' title='".$id."' name='".$row->Betterment."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThislBtment(this.lang,this.title)' onload='funkThislBtment(this.name)'><option style='color:olive' selected>".$row->Betterment."</option>".$option."
                        </select></td>"

                    . "<td>0.00</td>"
                    . "<td>0.00</td>"
                    . "<td>0.00</td>"
                    . "<td>".number_format($row->Labour,2)."</td>"
                    
               . "</tr>";

                        /*****
                        $table.="<tr>"
                                . "<td>".$count."</td>"
                                . "<td contenteditable='true' id='".$row->id."_".$count."L' onblur='funkThislBox(this.id)'>".$row->Description."</td>"
                                . "<td>".$opa."</td>"
                                . "<td contenteditable='true' id='".$row->id."_L' onblur='funkThixlBox(this.id)' >".$row->Labour."</td>"
                                . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='lEditAddQtsMarkUpNewTd_".$count."' name='".$row->MarkUp."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThislMarkUp(this.lang)' onload='funkThislMarkUpvnvn(this.name)'><option>0.00</option>
                                    </select></td>"
                                . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='lEditAddQtsBtmentNewTd_".$count."' name='".$row->Betterment."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThislBtment(this.lang)' onload='funkThislBtment(this.name)'>".$option."
                                    </select></td>"
                                . "<td>0.00</td>"
                                . "<td>0.00</td>"
                                . "<td>0.00</td>"
                                . "<td>".number_format($row->Labour,2)."</td>"
                                
                           . "</tr>";
                           *******/
                        $count++;
                }
                 
                $ttal1 = 0;
                foreach($frame as $row)
                {
                   $lbm = 0;
                   $opa = 'Frame';
                    $ttal1 += $row->Frame;

                    $table.="<tr>"
                    . "<td>".$count."</td>"

                    . "<td contenteditable='true' id='".$row->id."_".$count."F' lang='".$id."' onblur='funkThislBoxF(this.id,this.lang)'>".$row->Description."</td>"

                    . "<td>".$opa."</td>"

                    . "<td contenteditable='true' id='".$row->id."_F' lang='".$id."' onblur='funkThixlBoxF(this.id,this.lang)' >".$row->Frame."</td>"

                    . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='fEditAddQtsMarkUpNewTd_".$count."' title='".$id."' name='".$row->MarkUp."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisfMarkUp(this.lang,this.title)' onload='funkThisfMarkUpvnvn(this.name)'><option></option>
                        </select></td>"

                    . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='fEditAddQtsBtmentNewTd_".$count."' title='".$id."' name='".$row->Betterment."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisfBtment(this.lang,this.title)' onload='funkThisfBtment(this.name)'><option style='color:olive' selected>".$row->Betterment."</option>".$option."
                        </select></td>"

                    . "<td>0.00</td>"
                    . "<td>0.00</td>"
                    . "<td>0.00</td>"
                    . "<td>".number_format($row->Frame,2)."</td>"
                    
               . "</tr>";

                        /****
                        $table.="<tr>"
                                . "<td>".$count."</td>"
                                . "<td contenteditable='true' id='".$row->id."_".$count."F' onblur='funkThislBoxF(this.id)'>".$row->Description."</td>"
                                . "<td>".$opa."</td>"
                                . "<td contenteditable='true' id='".$row->id."_F' onblur='funkThixlBoxF(this.id)' >".$row->Frame."</td>"
                                . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='fEditAddQtsMarkUpNewTd_".$count."' name='".$row->MarkUp."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisfMarkUp(this.lang)' onload='funkThisfMarkUpvnvn(this.name)'><option>0.00</option>
                                    </select></td>"
                                . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='fEditAddQtsBtmentNewTd_".$count."' name='".$row->Betterment."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThisfBtment(this.lang)' onload='funkThisfBtment(this.name)'>".$option."
                                    </select></td>"
                                . "<td>0.00</td>"
                                . "<td>0.00</td>"
                                . "<td>0.00</td>"
                                . "<td>".number_format($row->Frame,2)."</td>"
                                
                           . "</tr>";
                            ******/

                        $count++;
                }
                 //$ttal1_ = $ttal1+$ttal;
                 $ttal1_ = $ttal1+$labour_total;
                $table.="<tr>"
                        . "<td colspan='9' style='text-align: right;color: cadetblue;font-size:13px;'><strong>Sub Total</strong></td>"
                        . "<td><span class='badge' style='background-color:orange;font-size:13px;'><strong class='cld'>".  number_format($ttal1_,2)."</strong></span></td>"
                   . "</tr>";



             
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Paint Additionals        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $paint =DB::select("select distinct * from additional  where Key_Ref=? and (Paint>0 or Paint<0)",[$id]);

        $table.="<table class='table table-stripped table-dark' style='margin-bottom:10px;'>";
        $table.="<thead style='font-size:10px;font-weight:bold;background-color:grey;color:white;'>
                    <tr>

                        <th>#</th>
                        <th>Paint</th>
                        <th>Oper</th>
                        <th>Landing Price</th>
                        <th>Mark-Up</th>
                        <th>Betterment</th>
                        <th>Saving</th>
                        <th>Additional</th>
                        <th>Quoted Price</th>
                        <th>Actual Price</th>


                    </tr>
                </thead>
                <tbody>";
                
                foreach($paint as $row)
                {
                   
                    //$ttal += $row->Paint;
                    $paint_total  += $row->Paint;

                    $table.= "<tr>"
                    . "<td>".$count."</td>"

                    . "<td contenteditable='true' id='".$row->id."_".$count."p' lang='".$id."' onblur='funkThispntBox(this.id,this.lang)'>".$row->Description."</td>"

                    . "<td>Paint</td>"

                    . "<td contenteditable='true' id='".$row->id."_p' lang='".$id."' onblur='funkThixpntBox(this.id,this.lang)'>".$row->Paint."</td>"

                    . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='pEditAddQtsMarkUpNewTd_".$count."' title='".$id."' name='".$row->MarkUp."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThispntMarkUp(this.lang,this.title)' onload='funkThispntMarkUpghdhgf(this.name)'><option></option>
                        </select></td>"

                    . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='pEditAddQtsBtmentNewTd_".$count."' title='".$id."' name='".$row->Betterment."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThispntBtment(this.lang,this.title)' onload='funkThispntBtment(this.name)'><option style='color:olive' selected>".$row->Betterment."</option>".$option."
                        </select></td>"

                    . "<td>0.00</td>"
                    . "<td>0.00</td>"
                    . "<td>0.00</td>"
                    . "<td>".number_format($row->Paint,2)."</td>"
                    
               . "</tr>";

                        /*****
                        $table.= "<tr>"
                                . "<td>".$count."</td>"
                                . "<td contenteditable='true' id='".$row->id."_".$count."p' onblur='funkThispntBox(this.id)'>".$row->Description."</td>"
                                . "<td>Paint</td>"
                                . "<td contenteditable='true' id='".$row->id."_p' onblur='funkThixpntBox(this.id)'>".$row->Paint."</td>"
                                . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='pEditAddQtsMarkUpNewTd_".$count."' name='".$row->MarkUp."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThispntMarkUp(this.lang)' onload='funkThispntMarkUpghdhgf(this.name)'><option>0.00</option>
                                    </select></td>"
                                . "<td><select style='background-color:#333;border-style:none;color:#ccc;font-size:10px;' id='pEditAddQtsBtmentNewTd_".$count."' name='".$row->Betterment."_".$count."' lang='".$row->id."_".$count."' class='form-control input-sm' onchange='changeThispntBtment(this.lang)' onload='funkThispntBtment(this.name)'>".$option."
                                    </select></td>"
                                . "<td>0.00</td>"
                                . "<td>0.00</td>"
                                . "<td>0.00</td>"
                                . "<td>".number_format($row->Paint,2)."</td>"
                                
                           . "</tr>";
                           *******/


                        $count++;
                }
                $table.= "<tr>"
                        . "<td colspan='9' style='text-align: right;color: cadetblue;font-size:13px;'><strong>Sub Total</strong></td>"
                        . "<td><span class='badge' style='background-color:orange;font-size:13px;'><strong class='cld'>".  number_format($paint_total,2)."</strong></span></td>"
                        . "</tr></tbody></table>";
                
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    


    return $table;
    }

    # [ NEW UPDATES ]
    # [ CURRENT UPDATE ] Added the $no line and Query
    public function fetch_additionals(Request $request){
        $id=$request->id;
        $no=$request->No;

        $table='';
        $additionals=DB::table('additional')->where('Key_Ref','=',$id)->where('No','=',$no)->get();
        $count=1;
        $table="<table class='table table-stripped' style='font-size:10px;'>";
        $table.="<thead style='font-weight:bold;'>
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Date/Time</th>
                        <th>Oper</th>
                        <th>Percentage</th>
                        <th>Quantity</th>
                        <th>Part</th>
                        <th>Paint</th>
                        <th>Frame</th>
                        <th>R & R</th>
                        <th>Outwork</th>
                        <th>Inhouse</th>
                        <th>Betterment</th>
                        <th>Comment</th>
                        <th></th>
                    </tr>
                </thead><tbody>";

        foreach($additionals as $row){
         $table.="<tr>
                    <td>".$count."</td>
                    <td>".$row->Description."</td>
                    <td>".$row->Date."</td>
                    <td>".$row->Oper."</td>
                    <td>".$row->Percent."</td>
                    <td>".$row->Quantity."</td>
                    <td>".$row->Part."</td>
                    <td>".$row->Paint."</td>
                    <td>".$row->Frame."</td>
                    <td>".$row->RandR."</td>
                    <td>".$row->Outwork."</td>
                    <td>".$row->Inhouse."</td>
                    <td>".$row->Misc."</td>
                    <td>".$row->Comments."</td>
                    <td>
                    <div class='btn-group'>
                        <a href='#' class='btn btn-primary btn-sm' title='Edit Additional' id='edit_additional' data-additional_keyref='".$id."' data-additional_id='".$row->id."' data-additional_no='".$no."'><span class='fa fa-edit'></span></a>
                        <a href='/delete-additional/".$row->id."' class='btn btn-danger btn-sm' title='Delete Additional' style='margin-left:5px;'><span class='fa fa-trash'></span></a>
                    <div>
                    </td>";

        }

        $table.="</tbody></table>";

        return $table;
    }
    

    # [ JUST UPDATED NOW ]
    # [ CURRENT UPDATE ] GET THE ADDITTIONAL TO BE EDITED/UPDATE fetch_additional_edits
    public function fetch_additional_edits(Request $request){
           
        $key_ref = $request->additional_keyref;
        $no      = $request->additional_no;
        $data    = '';
        $additional_id  = $request->additional_id;

        #$additionals=DB::table('additional')->where('Key_Ref','=',$key_ref)->where('No','=',$no)->get();
        $additionals=DB::table('additional')->where('Key_Ref','=',$key_ref)->where('No','=',$no)->where('id','=',$additional_id)->get();

            foreach($additionals as $row){
            $Id = $row->id;
            $Description = $row->Description;
            $Oper = $row->Oper;
            $Percent = $row->Percent;
            $Quantity = $row->Quantity;
            $Part = $row->Part;
            $Labour = $row->Labour;
            $Comments = $row->Comments;
            $Paint = $row->Paint;
            $Frame = $row->Frame;
            $RandR = $row->RandR;
            $Outwork = $row->Outwork;
            $Inhouse = $row->Inhouse;
            $Betterment = $row->Betterment;

            }

            $data .= '<div class="row">
                        <div class="form-group col-6">
                        <label for="description">Description:</label> 
                            <input type="hidden" id="additional_id" name="additional_id" value="'.$additional_id.'" class="form-control form-control-sm" required>

                            <input type="text" id="description" name="description" value="'.$Description.'" class="form-control form-control-sm" required>
                        </div>

                        <div class="form-group col-6">
                        <label for="paint">Paint:</label> 
                            <input type="text" id="paint" name="paint" value="'.$Paint .'" class="form-control form-control-sm" required>
                        </div>
                        </div>

                        <div class="row">
                        <div class="form-group col-6">
                        <label for="oper">Oper:</label> 
                            <input type="text" id="oper" name="oper" value="'.$Oper.'" class="form-control form-control-sm" required>
                        </div>

                        <div class="form-group col-6">
                        <label for="frame">Frame:</label> 
                            <input type="text" id="frame" name="frame" value="'.$Frame.'" class="form-control form-control-sm" required>
                        </div>
                        </div>

                        <div class="row">
                        <div class="form-group col-6">
                        <label for="percent">Percentage:</label> 
                            <input type="text" id="percent" name="percent" value="'.$Percent.'" class="form-control form-control-sm" required>
                        </div>

                        <div class="form-group col-6">
                        <label for="r_r">R&R:</label> 
                            <input type="text" id="r_r" name="r_r" value="'.$RandR.'" class="form-control form-control-sm" required>
                        </div>
                        </div>

                        <div class="row">
                        <div class="form-group col-6">
                        <label for="quantity">Quantity:</label> 
                            <input type="text" id="quantity" name="quantity" value="'.$Quantity.'" class="form-control form-control-sm" required>
                        </div>

                        <div class="form-group col-6">
                        <label for="outwork">Outwork:</label> 
                            <input type="text" id="outwork" name="outwork" value="'.$Outwork.'" class="form-control form-control-sm" required>
                        </div>
                        </div>

                        <div class="row">
                        <div class="form-group col-6">
                        <label for="part">Part:</label> 
                            <input type="text" id="part" name="part" value="'.$Part.'" class="form-control form-control-sm" required>
                        </div>

                        <div class="form-group col-6">
                        <label for="in_house">In house:</label> 
                            <input type="text" id="in_house" name="in_house" value="'.$Inhouse.'" class="form-control form-control-sm" required>
                        </div>
                        </div>

                        <div class="row">
                        <div class="form-group col-6">
                        <label for="labour">Labor:</label> 
                            <input type="text" id="labour" name="labour" value="'.$Labour.'" class="form-control form-control-sm" required>
                        </div>

                        <div class="form-group col-6">
                        <label for="betterment">Betterment:</label> 
                            <input type="text" id="betterment" name="betterment" value="'.$Betterment.'" class="form-control form-control-sm" required>
                        </div>
                        </div>

                        <div class="row">
                        <div class="form-group col-12">
                        <label for="comments">Comment:</label> 
                            
                            <textarea  id="comments" name="comments" rows="3"  class="form-control form-control-sm" required>'.$Comments.'</textarea>
                        </div>

                        </div>';


        return   $data;

    
    } 


    # [ CURRENT UPDATE ]  UPDATE THE ADDTIONALS  update_additional
    public function update_additional(Request $request){

           #UPDATE ALL
           $id =  $request->additional_id;
           $Description = $request->description;
           $Oper = $request->oper;
           $Percent = $request->percent;
           $Quantity = $request->quantity;
           $Part = $request->part;
           $Labour = $request->labour;
           $Comments = $request->comments;
           $Paint = $request->paint;
           $Frame = $request->frame;
           $RandR = $request->r_r;
           $Outwork = $request->outwork;
           $Inhouse = $request->in_house;
           $Betterment = $request->betterment;


           $update = DB::table('additional')->where('id','=',$id)->update(['Oper'=>$Oper,'Description'=>$Description,'Percent'=>$Percent,'Quantity'=>$Quantity,
            'Part'=>$Part,'Labour'=>$Labour,'Comments'=>$Comments,'Paint'=>$Paint,'Frame'=>$Frame,'RandR'=>$RandR,'Outwork'=>$Outwork,'Inhouse'=>$Inhouse,
            'Betterment'=>$Betterment ]);

           if( $update ){
              $message = "Updated successfully.";
           }else{
               $message = "Updated successfully. Please contact your manager.";;
           }

           return back()->with(['message'=>$message ]);


    }


    #[ CURRENT UPDATE ]  delete_additional
    public function delete_additional( $id ){

        #DELETE ADDITIONAL ROW
         $delete = DB::table('additional')->where('id','=',$id)->delete();
         if( $delete ){
            $message = "Table row deleted, Successfully.";
         }else{
             $message = "Failed to delete. Please contact your manager.";
         }

         return back()->with(['message'=>$message ]);



    } 
    
    
    # [ CURRENT UPDATE ]  //fetch_additionals_grouped
    /* #  | Description | Date and Time  | Action  */
    public function fetch_additionals_grouped(Request $request){
       
           $id=$request->id;
           $table='';
           $count=1;
           $date = "";
   
           $table="<table class='table table-stripped' style='font-size:10px;'>";
           $table.="<thead style='font-weight:bold;' class='thead-dark'>
                       <tr>
                           <th>#</th>
                           <th>Description</th>
                           <th>Date and Time</th>
                           <th>Action</th>
                           
                           <th></th>
                       </tr>
                   </thead><tbody>";
   
          
         #$distinct_additionals = DB::table('additional')->distinct('No')->where('Key_Ref','=',$id)->get();
         $distinct_additionals   =DB::select("select distinct No from additional where Key_Ref=?",[$id]);
       
         foreach($distinct_additionals as $row){
            $keyz = $row->No;
            #$additional_id = $row->id;
   
            $additionals=DB::table('additional')->where('Key_Ref','=',$id)->where('No','=',$keyz)->orderBy('Date','desc')->limit(1)->get();
            foreach($additionals as $row1){
                $date = $row1->Date;
           
            }
   
            $table.="<tr>
                        <td>".$count."</td>
                        <td>Additional Quote ( ".$count." )</td>
                        <td>".$date."</td>
                        <td>
                        <div class='btn-group'>
                            <button class='btn btn-primary btn-sm' id='open_final_stage_additional' data-additional_no='".$keyz."' ><span class='fa fa-open'></span>Open</button>
                            <input type='hidden' id='add_id' name='add_id' value='".$id."'>
                            
                        <div>
                        </td>
                    </tr>";
            $count++;
   
         }
   
        $table.="</tbody></table>";
        return $table;
    }


    #UPDATED THE FUNCTION [ 20 JAN ]
    public function final_stage_add_create(Request $request){

        $id=$request->add_id;
        $desc=$request->add_desc;
        $oper=$request->add_oper;
        $percent=$request->add_percent;
        $quan=$request->add_quan;
        $part=$request->add_part;
        $paint=$request->add_paint;
        $frame=$request->add_frame;
        $labor=$request->add_labor;
        $comment=$request->add_comment;
        $rnr=$request->add_rnr;
        $outwork=$request->add_outwork;
        $inhouse=$request->add_inhouse;
        $bett=$request->add_bett;
        $new_labor=0;
        $new_paint=0;
        $new_rr=0;
        $new_frame=0;

        $resul =DB::table('insurer')->where('Key_Ref','=',$id)->get();
        foreach($resul as $row)
        {
            $new_labor =$labor*$row->labour;
            $new_paint =$paint*$row->Paint;
            $rr = $rnr*$row->Strip;
            $frm = $frame*$row->Frame;        
        }  

        $numb =  DB::table('additional')->where('Key_Ref','=',$id)->orderBy('Date','desc')->distinct('No')->value('No');
        if( $numb ){
            $no = $numb + 1;
        }else{
            $no = 0;
        }


        $date=date('Y-m-d');
        DB::table('additional')->insert([ 'Key_Ref'=>$id,'Oper'=>$oper,'Outwork'=>$outwork,'Inhouse'=>$inhouse,'Description'=>$desc,'Quantity'=>$quan,
          'Betterment'=>$bett,'Part'=>$part,'Labour'=>$labor,'Paint'=>$paint,'Strip'=>0,'Frame'=>$frame,'Misc'=>$bett,
          'Date'=>$date,'Comments'=>$comment,'Labour_rate'=>0,'Frame_rate'=>0,'Strip_rate'=>0,'Paint_rate'=>0,'Percent'=>$percent,'RandR'=>$rr,
          'No'=>$no,'MarkUp'=>0,'MarkUp2'=>0,'Checked'=>'','Part_sales'=>$part ]);

        return back()->with(['message'=>'Part Successfully Added To Additional Quotes.']);
        

    }

    public function final_stage_send_email(Request $request){
        $id=$request->id;
        $user=Auth::user()->username;
        $otp = 'ORDER'.str_pad(mt_rand(0,9999),6,'0',STR_PAD_LEFT);

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

        $result=DB::select("select distinct Reg_No,Make,Model,Chasses_No,Assessor,Assessor_Email,Assessor_Tel,Inserer,Claim_NO,cd.Key_Ref from client_details cd left join insurer ins on cd.Key_Ref = ins.Key_Ref 
        where  cd.Key_Ref=?",[$id]);

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

        foreach($resulta as $rowa)
        {
            $image.='<img src="/mag_photos/'.$id.'/'.$rowa->url.'" width="900" alt=""/><br>';
        }

        #FIXED THE CLOSING EOD
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
        foreach ($_SESSION['identMails'] as $email){
    //
        $mail                = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.motoraccidentgroup.co.za';
        $mail->Port = 25;
    
        $mail->SMTPAuth = true;
        $mail->Username = "photos@motoraccidentgroup.co.za";
        $mail->Password = "M@G@2517";
        $mail->setFrom("photos@motoraccidentgroup.co.za", 'Motor Accident Group');
        $mail->addReplyTo('info@motoraccidentgroup.co.za', 'Motor Accident Group');
        $mail->addAddress($email, '');
        $mail->Subject = $vrg.' Additionals';
	
        $mail->AltBody    = "";
        $mail->MsgHTML("Please find the Additionals attached below.<br>Regards<br>Motor Accident Group.");
        $mail->IsHTML(true);
        $mail->AddAttachment($fil_name);

    if (!$mail->send()) {
    echo 1;
    }else {
    echo 0;
    }
    unlink($fil_name); 
}

    }

    #UPDATING THE HRERF URL, TO LINK TO THE PHYSICAL DOCS. IN LARAVEL
    public function final_docs(Request $request){
        $id=$request->id;
        $docs=DB::table('document')->where('Key_Ref','=',$id)->get();
        $table='';

        $table.='<table class="table table-stripped">';
        $table.='<thead><tr><th>Description</th><th>User</th><th>Date</th><th>Time</th><th></th></tr>';
        $table.='</thead><tbody>';
        foreach($docs as $doc){

            $file_name="";
            $value = substr($doc->url,0, 3);
            $path = 'docs/uploaded/'.$id.'/'.$doc->url;
            $path2 = 'http://192.168.0.185:8080/MAG_System/models/UploadedDocs/'.$id.'/'.$doc->url;
           
            if (file_exists($path)) {
              $file_name =asset('/docs/uploaded/'.$id.'/'.$doc->url);
            } else if( $value == 'INV' ){
              $file_name = 'http://192.168.0.185:8080/mag_documentions/supplier_invoices/'.$doc->url;;
            }else{
               $file_name = $path2;
            }

            $table.='<tr>';
            //$table.='<td>'.$doc->Description.'</td>';
            $table.='<td><a href="'. $file_name.'" target="_blank">'.$doc->Description.'</a></td>';
            $table.='<td>'.$doc->user.'</td>';
            $table.='<td>'.$doc->date.'</td>';
            $table.='<td>'.$doc->time.'</td>';

            //$table.='<td><a href="http://192.168.0.185:8080/MAG_System/models/UploadedDocs/'.$id.'/'.$doc->url.'" target="_blank" class="btn btn-primary btn-sm"><span class="fa fa-search"></span></a></td>';
            $table.='<td><a href="'. $file_name.'" target="_blank" class="btn btn-primary btn-sm"><span class="fa fa-search"></span></a></td>';
            $table.='</tr>';
        }
        $table.='</tbody>';
        $table.='</table>';

        return $table;

    }

    public function final_notes(Request $request){
        $id=$request->id;
        #$notes=DB::table('notes')->where('Key_Ref','=',$id)->get();
        $notes=DB::table('notes')->where('Key_Ref','=',$id)->where('status','=',0)->orderBy('id','desc')->get();
        $sms=DB::table('notes')->where('Key_Ref','=',$id)->where('status','=',1)->orderBy('id','desc')->get();
        $table='';
        $table='<div class="row">
                    <form method="POST" action="/final-stage-save-notes"> 
                        <input type="hidden" id="final_key" name="final_key" value='.$id.'>    
                           <textarea class="form-control form-control-sm font-sm" placeholder="Enter Note.." id="final_note" name="final_note" row="5" style="width:600px;"></textarea>
                        
                </div><br>
                <div class="row">
                    <!--
                    <input type="submit" class="btn btn-primary btn-sm float-right" value="Save">
                    -->
                    <input type="submit" class="btn btn-primary btn-sm float-right" id="save_notes_" value="Save">
                </div>    
        </form><br>';
        

        

        $table.='<table class="table table-stripped table-dark">';
        $table.='<thead style="font-weight:bold;"><tr><th>Note</th><th>User</th><th></th></tr>';
        $table.='</thead><tbody>';
        foreach($notes as $note){
            $table.='<tr>';
            $table.='<td>'.$note->note.'</td>';
            $table.='<td>'.$note->user.'</td>';
            $table.='<td>'.$note->date.'</td>';
            $table.='</tr>';
        }

        $table.='</tbody>';
        $table.='</table>';

        $table.='<table class="table table-stripped table-dark" style="margin-top:10px;">';
        $table.='<thead style="font-weight:bold;"><tr><th>SMS</th><th>User</th><th></th></tr>';
        $table.='</thead><tbody>';
        foreach($sms as $s){
            $table.='<tr>';
            $table.='<td>'.$s->note.'</td>';
            $table.='<td>'.$s->user.'</td>';
            $table.='<td>'.$s->date.'</td>';
            $table.='</tr>';
        }
        return $table;

    }

    public function final_stage_client_detail(Request $request){

        $id=$request->id;

        $branches=DB::table('branch')->get();

        $assessor=DB::table('assessors')->orderBy('Names','ASC')->get();
        $brokers=DB::table('broker_table')->get();
       $client_details=DB::table('client_details')
                               ->where('client_details.Key_Ref','=',$id)
                               ->leftjoin('insurer','client_details.Key_Ref','=','insurer.Key_Ref')
                               ->leftjoin('pre_bookings','client_details.Key_Ref','=','pre_bookings.Key_Ref')
                               ->leftjoin('towing_history','client_details.Key_Ref','=','towing_history.Key_Ref')
                               ->select('client_details.KM','client_details.Chasses_No','client_details.Date','client_details.Key_Ref','client_details.Reg_No','client_details.Fisrt_Name','client_details.Last_Name','client_details.id_number','client_details.BirthDate','client_details.Cell_number','client_details.Email','client_details.Address_1','client_details.Address_2','client_details.Address_3','pre_bookings.booking_date','client_details.Make','client_details.Model','insurer.Inserer','client_details.status','towing_history.*','client_details.Eng_No','client_details.Colour','client_details.Vehicle_year','client_details.Address_1','client_details.Address_2','client_details.Address_3','client_details.Estimator','client_details.branch','client_details.Eng_No','insurer.Contact as ins_contact','insurer.Email as ins_email','insurer.Claim_NO as ins_claim','insurer.Phone','insurer.ClerkName','insurer.Assessor','insurer.Assessor_Email','insurer.Assessor_Cell','insurer.Assessor_comp','towing_history.tel as tow_tel','towing_history.email as tow_email')
                               ->get();    


       $insurer_details=DB::table('insurer')->where('Key_Ref','=',$id)->get();

       $table='';

       $table='<div class="card-deck">';
        foreach($client_details as $client){           

   

       $table.='<div class="card shadow col-4">';
       $table.='<div class="card-header py-3" style="border: 1px solid grey;">';
       $table.='<h6 class="m-0 font-weight-bold text-primary">Client Details.</h6>';
       //$table.='<form action="/final-stage-edit-client" method="GET">';
       $table.='<form>';
                        
       $table.='</div>';
       $table.='<div class="card-body table-dark">';
       $table.='<input type="hidden" name="id" id="id" value="'.$id.'">'; 

       $table.='<div class="input-group sm">
           <div class="input-group-prepend" style="font-size:8px;">
                <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Name</span>
           </div>
           <input type="text" style="margin-bottom:10px;" name="name" id="name" value="'.$client->Fisrt_Name.'" class="form-control form-control-sm">
       </div>';

       $table.='<div class="input-group sm" style="font-size:8px;">
           <div class="input-group-prepend">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Lastname</span>
           </div>
       <input type="text" style="margin-bottom:10px;" name="lastname" id="lastname" value="'.$client->Last_Name.'" class="form-control form-control-sm">
       </div>';

       $table.='<div class="input-group sm" style="font-size:8px;">
           <div class="input-group-prepend">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">ID No.</span>
           </div>
           <input type="text" style="margin-bottom:10px;" name="id_number" id="id_number" value="'.$client->id_number.'" class="form-control form-control-sm">
       </div>';
                       
       $table.='<div class="input-group sm" id="dob_span">';
       $table.='<div class="input-group-prepend">';
       $table.='<span class="input-group-text sm" id="basic-addon1" style="height:32px;">DOB</span>';
       $table.='</div>';
       $table.='<input type="date" name="dob" id="odb" value="'.$client->BirthDate.'" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">';
       $table.='</div>';


       $table.='<div class="input-group sm" style="font-size:8px;">
       <div class="input-group-prepend">
           <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Mobile</span>
       </div>
       <input type="text" name="mobile" id="mobile" value="'.$client->Cell_number.'" class="form-control form-control-sm" style="margin-bottom:10px;">
       </div>';

       $table.='<div class="input-group sm" style="font-size:8px;">
        <div class="input-group-prepend">
           <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Email</span>
       </div>
       <input type="email" name="client_email" id="client_email" value="'.$client->Email.'" class="form-control form-control-sm" style="margin-bottom:10px;">
       </div>';


       $table.='<div class="input-group sm" style="font-size:8px;">
        <div class="input-group-prepend">
           <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Street</span>
       </div>  
       <input type="text" name="street" id="street" value="'.$client->Address_1.'" class="form-control form-control-sm" style="margin-bottom:10px;">
       </div>';


       $table.='<div class="input-group sm" style="font-size:8px;">
       <div class="input-group-prepend">
           <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Suburb</span>
       </div>
       <input type="text" name="surburb" id="surburb" value="'.$client->Address_2.'" class="form-control form-control-sm" style="margin-bottom:10px;">
       </div>';


       $table.='<div class="input-group sm">
       <div class="input-group-prepend" style="font-size:8px;">
           <span class="input-group-text sm" id="basic-addon1" style="height:32px;">City</span>
       </div>
       <input type="text" name="city" id="city" value="'.$client->Address_3.'" class="form-control form-control-sm" style="margin-bottom:10px;">
       </div>';


       $table.='<div class="input-group sm" style="font-size:8px;">
       <div class="input-group-prepend">
           <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Estimator</span>
       </div>
       <input type="text" name="estimator" id="estimator" value="'.$client->Estimator.'" class="form-control form-control-sm" style="margin-bottom:10px;">
       </div>';


       $table.='<div class="input-group sm">
        <div class="input-group-prepend" style="font-size:8px;">
           <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Branch</span>
       </div>
       <select name="branch" id="branch" class="form-control form-control-sm" value="'.$client->branch.'" style="margin-bottom:10px;">';

       $table.='<option selected value="'.$client->branch.'">'.$client->branch.'</option>';
       
           foreach($branches as $branch){
              $table.='<option value="'.substr($branch->branch_name,4).'">'.substr($branch->branch_name,4).'</option>';    
           }

       $table.='</select></div>';
       $table.='</div>';
       $table.='</div>';
                   
       $table.='<div class="card shadow col-4">';
       $table.='<div class="card-header py-3" style="border: 1px solid grey;">';
       $table.='<h6 class="m-0 font-weight-bold text-primary">Vehicle Details.</h6>';
       $table.='</div>';
       $table.='<div class="card-body table-dark">';

       $table.='<div class="input-group sm">
       <div class="input-group-prepend" style="font-size:8px;">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Registration</span>
           </div>
       <input type="text" name="registration" id="registration" value="'.$client->Reg_No.'" class="form-control form-control-sm" style="margin-bottom:10px;">
       </div>';

       $table.='<div class="input-group sm">
       <div class="input-group-prepend" style="font-size:8px;">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">VIN</span>
       </div>
       <input type="text" name="vin_number" id="vin_number" value="'.$client->Chasses_No.'" class="form-control form-control-sm" style="margin-bottom:10px;">
       </div>';


       $table.='<div class="input-group sm">
       <div class="input-group-prepend" style="font-size:8px;">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Eng No.</span>
       </div>
       <input type="text" name="engine_number" id="engine_number" value="'.$client->Eng_No.'" class="form-control form-control-sm" style="margin-bottom:10px;">
       </div>';


       $table.='<div class="input-group sm">
       <div class="input-group-prepend" style="font-size:8px;">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Make</span>
       </div>
       <input type="text" name="make" id="make" value="'.$client->Make.'" class="form-control form-control-sm" style="margin-bottom:10px;">
       </div>';


       $table.='<div class="input-group sm">
       <div class="input-group-prepend" style="font-size:8px;">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Model</span>
       </div> 
       <input type="text" name="model" id="model" value="'.$client->Model.'" class="form-control form-control-sm" style="margin-bottom:10px;">
       </div>';


       $table.='<div class="input-group sm">
       <div class="input-group-prepend" style="font-size:8px;">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">ODO</span>
       </div>
       <input type="text" name="odometer" id="odometer" value="'.$client->KM.'" class="form-control form-control-sm" style="margin-bottom:10px;">
       </div>';


       $table.='<div class="input-group sm">
       <div class="input-group-prepend" style="font-size:8px;">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Colour</span>
       </div> 
       <input type="text" name="colour" id="colour" value="'.$client->Colour.'" class="form-control form-control-sm"style="margin-bottom:10px;">
       </div>';


       $table.='<div class="input-group sm">
       <div class="input-group-prepend" style="font-size:8px;">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Year</span>
       </div>
       <input type="text" name="year" id="year" class="form-control form-control-sm" value="'.$client->Vehicle_year.'" style="margin-bottom:10px;">
       </div>';
                       
       $table.='</div>';
       $table.='</div>';

       $table.='<div class="card shadow col-4">';
       $table.='<div class="card-header py-3" style="border: 1px solid grey;">';
       $table.='<h6 class="m-0 font-weight-bold text-primary">Insurance Details.</h6>';
       $table.='</div>';
       $table.='<div class="card-body table-dark">';
       $table.='<div class="input-group sm">
           <div class="input-group-prepend" style="font-size:8px;">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Insurance</span>
           </div>
           <select name="insurance_type" id="insurance_type" class="form-control form-control-sm" style="margin-bottom:10px;">';

           if($client->Inserer=="Private"){
               $table.='<option value="1" selected>Private</option>';
               $table.='<option value="2">Insurance</option>';
               $table.='<option value="3">Dealership</option>';
           }else{
               $table.='<option value="2" selected>Insurance</option>';
               $table.='<option value="1">Private</option>';
               $table.='<option value="3">Dealership</option>';

           }
       $table.='</select>
       </div>';

       $table.='<div class="input-group sm">
           <div class="input-group-prepend">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Insuror</span>
           </div>
           <select name="insuror" id="insuror"  class="form-control form-control-sm" style="margin-bottom:10px;">';
       //$table.='<option value="">Select Insurer</option>';
               $table.='<option value="1">Select Insurer</option>';
               $table.='<option value="'.$client->Inserer.'" selected>'.$client->Inserer.'</option>';
                 foreach($brokers as $broker){
                       $table.=' <option value="'.$broker->broker.'">'.$broker->broker.'</option>';
                 }
                               
       $table.='</select>
       </div>';


       $table.='<div class="input-group sm">
           <div class="input-group-prepend">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">I. Contact</span>
           </div>
       <input type="text" name="contact_number" id="contact_number" value="'.$client->Phone.'" class="form-control form-control-sm" style="margin-bottom:10px;">
       </div>';


       $table.='<div class="input-group sm">
          <div class="input-group-prepend">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">I. Email</span>
           </div> 
       <input type="text" name="insurance_email" id="insurance_email" value="'.$client->ins_email.'" class="form-control form-control-sm"  style="margin-bottom:10px;">
       </div>';

       $table.='<div class="input-group sm">
           <div class="input-group-prepend">
              <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Claim No.</span>
           </div> 
       <input type="text" name="claim_number" id="claim_number" value="'.$client->ins_claim.'" class="form-control form-control-sm"  style="margin-bottom:10px;">
       </div>';


       $table.='<div class="input-group sm">
           <div class="input-group-prepend">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Clerk Ref.</span>
           </div> 
       <input type="text" name="clerk_ref" id="clerk_ref" value="'.$client->ClerkName.'" class="form-control form-control-sm"  style="margin-bottom:10px;">


       </div>';

       $table.='<div class="input-group sm">
          <div class="input-group-prepend">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Assessor</span>
           </div> 
       <select name="assessor" id="assessor" class="form-control auto_assessor form-control-sm" style="margin-bottom:10px;">';
       $table.='<option value="">Select Assessor</option>';
       $table.='<option value="'.$client->Assessor.'" selected>'.$client->Assessor.'</option>';
           foreach($assessor as $asessor){
                  $table.=' <option value="'.$asessor->Names.'">'.$asessor->Names.'</option>';
           }
       $table.='</select></div>';


       $table.='<div class="input-group sm">
          <div class="input-group-prepend">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">A.Email</span>
           </div> 
       <input type="email" name="assessor_email" id="assessor_email" value="'.$client->Assessor_Email.'" class="form-control form-control-sm"  style="margin-bottom:10px;">
       </div>';


       $table.='<div class="input-group sm">
           <div class="input-group-prepend">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">A.Contact</span>
           </div>
       <input type="text" name="assessor_no" id="assessor_no" value="'.$client->Assessor_Cell.'" class="form-control form-control-sm"  style="margin-bottom:10px;">
       </div>';


       $table.='<div class="input-group sm">
           <div class="input-group-prepend">
               <span class="input-group-text sm" id="basic-addon1" style="height:32px;">A.Company</span>
           </div> 
           <input type="text" name="assessor_company" id="assessor_company" value="'.$client->Assessor_comp.'" class="form-control form-control-sm"  style="margin-bottom:10px;">
       </div>';

       $table.='</div>';
       $table.='</div>';
       }  
       $table.='</div>';
       $table.='<div class="btn-group">';
       $table.='<button class="btn btn-primary btn-xs" id="update_final_client_details">Save</button>';
       $table.='</form>';
       $table.='</div>';

       return $table;
        
    }

    #FIXED THE INSERT QUERY
    public function final_stage_save_notes(Request $request){
            $note=$request->final_note;
            $key_ref=$request->final_key;
            $user=Auth::user()->username;
            $date=date("Y-m-d");
            $time=date('H:i:s');

            $save = DB::table('notes')->insert([ 'Key_Ref'=>$key_ref,'note'=>$note,'date'=>$date,'time'=>$time,'status'=>'0','user'=>$user,'identity'=>'' ]);  
            if( $save ){
              return 1;
            }else{
              return 0;
            }




    }

    public function final_stage_client_edit(Request $request){
        $key_ref=$request->id;
        $name=$request->name;
        $last=$request->lastname;
        $id_no=$request->id_number;
        if(empty($id_no)){
            $id_no='';
        }
        $dob=$request->dob;
        $cell=$request->mobile;
        $email=$request->client_email;
        if(empty($email)){
            $email='';
        }
        $street=$request->street;
        if(empty($street)){
            $street='';
        }
        $suburb=$request->surburb;
        if(empty($suburb)){
            $suburb='';
        }
        $city=$request->city;
        if(empty($city)){
            $city='';
        }
        $estimator=$request->estimator;
        $branch=$request->branch;

        $reg=$request->registration;
        $vin=$request->vin_number;
        $engine_no=$request->engine_number;
        if(empty($engine_no)){
            $engine_no='';
        }
        $make=$request->make;
        $model=$request->model;
        $odometer=$request->odometer;
        if(empty($odometer)){
            $odometer='';
        }
        $color=$request->colour;
        if(empty($color)){
            $color='';
        }
        $year=$request->year;
        if(empty($year)){
            $year='';
        }
        $booking=$request->booking;
        if(empty($booking)){
            $booking='';
        }
        $quote_date=$request->quote_date;

        $insurace_type=$request->insurance_type;
        $insuror=$request->insuror;
        if(empty($insuror)){
            $insuror='';
        }
        $ins_cell=$request->contact_number;
        if(empty($ins_cell)){
            $ins_cell='';
        }
        $ins_email=$request->insurance_email;
        if(empty($ins_email)){
            $ins_email='';
        }
        $claim_no=$request->claim_number;
        if(empty($claim_no)){
            $claim_no='';
        }
        $clerk_ref=$request->clerk_ref;
        if(empty($clerk_ref)){
            $clerk_ref='';
        }
        $assessor=$request->assessor;
        if(empty($assessor)){
            $assessor='';
        }
        $ass_email=$request->assessor_email;
        if(empty($ass_email)){
            $ass_email='';
        }
        $ass_no=$request->assessor_no;
        if(empty($ass_no)){
            $ass_no='';
        }
        $ass_comp=$request->assessor_company;
        if(empty($ass_comp)){
            $ass_comp='';
        }

        $towed=$request->towed;
        if(empty($towed)){
            $towed='';
        }
        
        $towed_by=$request->towed_by;
        if(empty($towed_by)){
            $towed_by='';
        }
        $towed_cell=$request->tow_contact_number;
        if(empty($towed_cell)){
            $towed_cell='';
        }
        $towed_email=$request->tow_email;
        if(empty($towed_email)){
            $towed_email='';
        }
        $towed_fee=$request->tow_fee;
        if(empty($towed_fee)){
            $towed_fee='0';
        }
        $towed_status=$request->towed_status;
        if(empty($towed_status)){
            $towed_status='';
        }
        $date=date('Y-m-d');
        

          //return $id_status;
          $branch_info=DB::table('branch')->where('branch_name','=',$branch)->limit(1)->get();

          //return $branch_info->branch_credits;
          foreach($branch_info as $info){
             $bra_id=$info->id; 
             $bra_credit=$info->branch_credits;
             $branch_name=$info->branch_name;
          }


        DB::table('client_details')->where('Key_Ref','=',$key_ref)->update([
            'Fisrt_Name'=>$name,'Last_Name'=>$last,'id_number'=>$id_no,'BirthDate'=>$dob,'Estimator'=>$estimator,'Email'=>$email,'Address_1'=>$street,'Address_2'=>$suburb,'Address_3'=>$city,'Cell_Number'=>$cell,'Vehicle_year'=>$year,'Make'=>$make,'Colour'=>$color,'Model'=>$model,'Reg_No'=>$reg,'Eng_No'=>$engine_no,'date'=>$date,'branch'=>$branch,'towed_by'=>$towed_by,'Vat_No'=>15,'Chasses_No'=>$vin,'KM'=>$odometer
        ]);

        DB::table('insurer')->where('Key_Ref','=',$key_ref)->update(
            ['Inserer'=>$insuror,'Phone'=>$ins_cell,'Email'=>$ins_email,'Claim_No'=>$claim_no,'Oder_No'=>$odometer,'Assessor'=>$assessor,'Assessor_Cell'=>$ass_no,'Assessor_Email'=>$ass_email,'Assessor_comp'=>$ass_comp,'Address_1'=>$street,'Address_2'=>$suburb,'Address_3'=>$city,'Cell'=>$cell,'ClerkName'=>$clerk_ref]
        );

        DB::table('towing_history')->where('Key_Ref','=',$key_ref)->update(
            ['Key_Ref'=>$key_ref,'first_name'=>$name,'last_name'=>$last,'reg_no'=>$reg,'make'=>$make,'model'=>$model,'vin'=>$vin,'km'=>'','insurer'=>$insuror,'claim_no'=>$claim_no,'towing_fee1'=>$towed_fee,'name'=>$towed_by,'email'=>$towed_email,'tel'=>$towed_cell,'date'=>$date,'assessor'=>$assessor,'assessor_cell'=>$ass_no,'assessor_email'=>$ass_email,'address'=>'','city'=>'','zip'=>'','att_to'=>'','vat_no'=>'0']
        );
        
        return back()->with(['message'=>'Client Details Have Been Successfully Updated.']);
    }


    #FIXING THIS FUNCTION IT WAS HARDCODED
    public function final_stage_wheel_alignment(Request $request ){
            #GET THE ID, AND USE IT TO PULL ALL THE DATA HARDCODED HERE
            $id = $request->id;    //Key_ref [ MS1010103 ]
    
            $query = DB::table('client_details')->where('Key_Ref','=',$id)->get();
            if ( count( $query )  > 0) { 
              foreach($query as $row){
                  $date     = $row->Date;
                  $Owner    = $row->Fisrt_Name;
                  $vehicle  = $row->Make." ".$row->Model;
                  $regNo    = $row->Reg_No;
                  $VIN    = $row->Chasses_No;
                  $tel    = $row->Cell_number;
                  $RO   = $row->RO;
                  $Repair_Type    = $row->Repair_Type;
              }
            }
    
          
    
            $query2 = DB::table('alignment_report_initial')->where('Key_Ref','=',$id)->get();

            if ( count( $query2 )  > 0) {
                foreach($query2 as $row){
      
                  $frame          = $row->frame;
                  $intial_1       = $row->initial_1;
                  $intial_2       = $row->initial_2;
                  $intial_3       = $row->initial_3;
                  $intial_4       = $row->initial_4;
                  $intial_5       = $row->initial_5;
                  $intial_6       = $row->initial_6;
                  $intial_7       = $row->initial_7;
                  $intial_8       = $row->initial_8;
                  $intial_9       = $row->initial_9;
                  $intial_10      = $row->initial_10;
                  $intial_11      = $row->initial_11;
                  $intial_12      = $row->initial_12;
                  $intial_13      = $row->initial_13;
                  $intial_14      = $row->initial_14;
                  $intial_15      = $row->initial_15;
                  $intial_16      = $row->initial_16;
                  $intial_17      = $row->initial_17;
                  $intial_18      = $row->initial_18;
                  $intial_19      = $row->initial_19;
                  $intial_20      = $row->initial_20;
                  $intial_21      = $row->initial_21;
                  $intial_22      = $row->initial_22;
      
                 
                  $intial_23      = $row->initial_23;
                  $intial_24      = $row->initial_24;
                  $intial_25      = $row->initial_25;
                  $intial_26      = $row->initial_26;
                  $intial_27      = $row->initial_27;
                /*$intial_23      = $row->initial_23.' mm';
                  $intial_24      = $row->initial_24.' mm';
                  $intial_25      = $row->initial_25.' mm';
                  $intial_26      = $row->initial_26.' mm';
                  $intial_27      = $row->initial_27.' mm';*/
                  $intial_28      = $row->initial_28;
                  $intial_29      = $row->initial_29;
                  $intial_30      = $row->initial_30;
      
      
                  $Specifications_1   = $row->Specifications_1;
                  $Specifications_2   = $row->Specifications_2;
                  $Specifications_3   = $row->Specifications_3;
                  $Specifications_4   = $row->Specifications_4;
                  $Specifications_5   = $row->Specifications_5;
                  $Specifications_6   = $row->Specifications_6;
                  $Specifications_7   = $row->Specifications_7;
                  $Specifications_8   = $row->Specifications_8;
                  $Specifications_9   = $row->Specifications_9;
                  $Specifications_10  = $row->Specifications_10;
                  $Specifications_11  = $row->Specifications_11;
                  $Specifications_12  = $row->Specifications_12;
                  $Specifications_1max   = $row->Specifications_1max;
                  $Specifications_2max   = $row->Specifications_2max;
                  $Specifications_3max   = $row->Specifications_3max;
                  $Specifications_4max   = $row->Specifications_4max;
                  $Specifications_5max   = $row->Specifications_5max;
                  $Specifications_6max   = $row->Specifications_6max;
                  $Specifications_7max   = $row->Specifications_7max;
                  $Specifications_8max   = $row->Specifications_8max;
                  $Specifications_9max   = $row->Specifications_9max;
                  $Specifications_10max  = $row->Specifications_10max;
                  $Specifications_11max  = $row->Specifications_11max;
                  $Specifications_12max  = $row->Specifications_12max;
      
      
                  $Specifications_13  = $row->Specifications_13;
                  $Specifications_14  = $row->Specifications_14;
                  $Specifications_15  = $row->Specifications_15;
                  $Specifications_16  = $row->Specifications_16;
                  $Specifications_17  = $row->Specifications_17;
                  $Specifications_18  = $row->Specifications_18;
                  $Specifications_19  = $row->Specifications_19;
                  $Specifications_20  = $row->Specifications_20;
      
                  /*
                  $Specifications_13  = $row->Specifications_13.'&#176;';
                  $Specifications_14  = $row->Specifications_14.'&#176;';
                  $Specifications_15  = $row->Specifications_15.'&#176;';
                  $Specifications_16  = $row->Specifications_16.'&#176;';
                  $Specifications_17  = $row->Specifications_17.'&#176;';
                  $Specifications_18  = $row->Specifications_18.'&#176;';
                  $Specifications_19  = $row->Specifications_19.'&#176;';
                  $Specifications_20  = $row->Specifications_20.'&#176;';*/
                  $Specifications_21  = $row->Specifications_21;
                  $Specifications_22  = $row->Specifications_22;
                  $Specifications_23  = $row->Specifications_23;
                  $Specifications_24  = $row->Specifications_24;
                  $Specifications_25  = $row->Specifications_25;
                  $Specifications_26  = $row->Specifications_26;
                  $Specifications_27  = $row->Specifications_27;
                  $Specifications_28  = $row->Specifications_28;
                  $Specifications_29  = $row->Specifications_29;
                  $Specifications_30  = $row->Specifications_30;
                  $Specifications_31  = $row->Specifications_31;
                  $Specifications_32  = $row->Specifications_32;
                  $Specifications_33  = $row->Specifications_33;
                  $Specifications_34  = $row->Specifications_34;
                  $Specifications_35  = $row->Specifications_35;
      
                  /*
                  $Specifications_36  = $row->Specifications_36.' mm';
                  $Specifications_37  = $row->Specifications_37.' mm';
                  $Specifications_38  = $row->Specifications_38.' mm';
                  $Specifications_39  = $row->Specifications_39.' mm';
                  $Specifications_40  = $row->Specifications_40.' mm';
                  $Specifications_41  = $row->Specifications_41.' mm';
                  $Specifications_42  = $row->Specifications_42.' mm';
                  $Specifications_43  = $row->Specifications_43.' mm';
                  $Specifications_44  = $row->Specifications_44.' mm';
                  $Specifications_45  = $row->Specifications_45.' mm';
                  $Specifications_46  = $row->Specifications_46.' mm';
                  $Specifications_47  = $row->Specifications_47.' mm';
                  $Specifications_48  = $row->Specifications_48.' mm';*/
      
                  $Specifications_36  = $row->Specifications_36;
                  $Specifications_37  = $row->Specifications_37;
                  $Specifications_38  = $row->Specifications_38;
                  $Specifications_39  = $row->Specifications_39;
                  $Specifications_40  = $row->Specifications_40;
                  $Specifications_41  = $row->Specifications_41;
                  $Specifications_42  = $row->Specifications_42;
                  $Specifications_43  = $row->Specifications_43;
                  $Specifications_44  = $row->Specifications_44;
                  $Specifications_45  = $row->Specifications_45;
                  $Specifications_46  = $row->Specifications_46;
                  $Specifications_47  = $row->Specifications_47;
                  $Specifications_48  = $row->Specifications_48;
      
      
                  $final_1       = $row->final_1;
                  $final_2       = $row->final_2;
                  $final_3       = $row->final_3;
                  $final_4       = $row->final_4;
                  $final_5       = $row->final_5;
                  $final_6       = $row->final_6;
                  $final_7       = $row->final_7;
                  $final_8       = $row->final_8;
                  $final_9       = $row->final_9;
                  $final_10      = $row->final_10;
                  $final_11      = $row->final_11;
                  $final_12      = $row->final_12;
                  $final_13      = $row->final_13;
                  $final_14      = $row->final_14;
                  $final_15      = $row->final_15;
                  $final_16      = $row->final_16;
                  $final_17      = $row->final_17;
                  $final_18      = $row->final_18;
                  $final_19      = $row->final_19;
                  $final_20      = $row->final_20;
                  $final_21      = $row->final_21;
                  $final_22      = $row->final_22;
                  $final_23      = $row->final_23;
                  $final_24      = $row->final_24;
                  $final_25      = $row->final_25;
                  $final_26      = $row->final_26;
                  $final_27      = $row->final_27;
                  $final_28      = $row->final_28;
                  $final_29      = $row->final_29;
                  $final_30      = $row->final_30;
                  $date=$row->date;
                  $odometer=$row->odometer;
                  $comments   =   $row->comments;
                  $time=$row->time;
      
      
                }
      
            }else{
      
      
                  $odometer ='';
                  $comments='';
                $time='';
              $Specifications_1 = 2.48;
              $Specifications_2 = 2.48;
              $Specifications_3 = -0.57;
              $Specifications_4 = -0.57;
              $Specifications_5 = -0.3;
              $Specifications_6 = -0.3;
              $Specifications_7 =0.18;
              $Specifications_8 = 4.18;
              $Specifications_9 = -1.57;
              $Specifications_10= -1.57;
              $Specifications_11= -0.3;
              $Specifications_12= -0.3;
              $Specifications_1max = 4.18;
              $Specifications_2max = 4.18;
              $Specifications_3max = 0.33;
              $Specifications_4max = 0.33;
              $Specifications_5max = 0.9;
              $Specifications_6max = 0.9;
              $Specifications_7max = -0.57;
              $Specifications_8max = -0.57;
              $Specifications_9max = -0.57;
              $Specifications_10max= -0.57;
              $Specifications_11max= 1.8;
              $Specifications_12max= 1.9;
      
              $Specifications_13  = '---';
              $Specifications_14  = '---';
              $Specifications_15  = '---';
              $Specifications_16  = '---';
              $Specifications_17  = '---';
              $Specifications_18  = '---';
              $Specifications_19  = '---';
              $Specifications_20  = '---';
              $Specifications_21  = '---';
              $Specifications_22  = '---';
              $Specifications_23  = '---';
              $Specifications_24  = '---';
              $Specifications_25  = '---';
              $Specifications_26  = '---';
              $Specifications_27  = '---';
              $Specifications_28  = '---';
              $Specifications_29  = '---';
              $Specifications_30  = '---';
              $Specifications_31  = '---';
              $Specifications_32  = '---';
              $Specifications_33  = '---';
              $Specifications_34  = '---';
              $Specifications_35  = '---';
              $Specifications_36  = '---';
              $Specifications_37  = '---';
              $Specifications_38  = '---';
              $Specifications_39  = '---';
              $Specifications_40  = '---';
              $Specifications_41  = '625'.' mm';
              $Specifications_42  = '625'.' mm';
              $Specifications_43  ='625'.' mm';
              $Specifications_44  = '625'.' mm';
              $Specifications_45  = '625'.' mm';
              $Specifications_46  = '625'.' mm';
              $Specifications_47  ='625'.' mm';
              $Specifications_48  ='625'.' mm';
      
              $intial_1       = 3.15;
              $intial_2       = 4.01;
              $intial_3       = -0.26;
              $intial_4       = -0.21;
              $intial_5       = -11.9;
              $intial_6       = -11.5;
              $intial_7       = 0.02;
              $intial_8       = 0.2;
              $intial_9       = -1.49;
              $intial_10      = -1.25;
              $intial_11      = 0.6;
              $intial_12      = 0.2;
              $intial_13      = 13.07;
              $intial_14      = 12.41;
              $intial_15      = 12.41;
              $intial_16      = 12.20;
              $intial_17      = '----';
              $intial_18      ='----';
              $intial_19      = '----';
              $intial_20      =  '----';
              $intial_21      = '----';
              $intial_22      =  '----';
              $intial_23      =  '-16'.' mm';
              $intial_24      =  '10'.' mm';
              $intial_25      =  '3.0'.' mm';
              $intial_26      = '-26'.' mm';
              $intial_27      =   '----';
              $intial_28      =   '----';
              $intial_29      =   '----';
              $intial_30      =   '----';
      
              $final_1       = 3.38;
              $final_2       = 3.46;
              $final_3       = -0.34;
              $final_4       = -0.33;
              $final_5       = 0.6;
              $final_6       = 0.5;
              $final_7       = 0.0;
              $final_8       = -0.0;
              $final_9       = -1.46;
              $final_10      = -1.25;
              $final_11      = 0.6;
              $final_12      = 0.3;
              $final_13      = 13.06;
              $final_14      = 12.48;
              $final_15      = 12.32;
              $final_16      = 12.15;
              $final_17      = '----';
              $final_18      = '----';
              $final_19      = '----';
              $final_20      = '----';
              $final_21      = '----';
              $final_22      = '----';
              $final_23      = '----';
              $final_24      = '----';
              $final_25      = '-16'.' mm';
              $final_26      = '10'.' mm';
              $final_27      = '3'.' mm';
              $final_28      = '----';
              $final_29      = '----';
              $final_30      = '----';
              $date = date('Y-m-d h:i:s');
              $frame='----';
            }

             
            $intial_total=$intial_5+$intial_6;
            $Specifications_total=$Specifications_5+$Specifications_6;  
            $final_total =$final_5+$final_6;
            $final_12_total = $final_7+$final_8+$final_9+$final_10+$final_11+$final_12;
            $intial_12_total =$intial_7+$intial_8+$intial_9+$intial_10+$intial_11+$intial_12;
            $Specifications_12_total = $Specifications_7+$Specifications_8+$Specifications_9+$Specifications_10+$Specifications_11+$Specifications_12;
        


        
            $token = csrf_field();

            $table='';
            $table='<div id="wheelAlignmentDiv"
            style="width:98%;padding: 10px;background-color: whitesmoke;border-style: solid;border-color: saddlebrown;max-height: 550px;overflow-y: scroll">
            <table class="tablesorter-blackice">
                <thead>
                    <tr>
                        <th>
                            <button class="btn btn-sm btn-danger" id="wheelAlignmentDivDismiss" data-dismiss="modal">Dismiss</button>
                            <!--
                            <button class="btn btn-sm btn-warning" id="wheelAlignmentDivPrint">Print</button>
                            <button class="btn btn-sm btn-warning wheelAlignmentPrint" id="'.$id.'">Print</button>
                            -->
                            
                            <a  href="/final-stage-print-wheel-alignment/'.$id.'" class="btn btn-warning btn-sm" id="'.$id.'" target="_blank">Print</a>
                        </th>
                        <th style="text-align:center;">
                            <strong><label></label>Reg No.: '.$regNo.'</strong>
                            <strong><label id="wheelAlignmentDivlblReg"></label></strong>
                        </th>
                        <th style="text-align:center;">
                            <strong><label></label>VIN: '.$VIN.'</strong>
                            <!--
                            <strong><label id="wheelAlignmentDivlblVin"></label></strong>
                            -->
                            <strong><label id="wheelAlignmentDivlblVin"></label></strong>
                        </th>
                    </tr>
                </thead>
            </table>
            <!--
            <form id="wheelAlignmentDivForm">
            -->
            <form method="POST" action="/final-stage-save-wheel-alignment">
                '.$token.'
               
                <input type="hidden" id="wheelAlignmentDivFormRef" name="wheelAlignmentDivFormRef" value="'.$id.'" />
                <table class="tablesorter-blackice">
                    <thead>
                        <tr>
                            <th colspan="4" style="text-align:center;">Primary Angles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <div class="input-group detailsEditz">
                                    <span class="input-group-addon">Date:</span>
                                    <input type="date" id="wheelAlignmentDivFormDate" name="wheelAlignmentDivFormDate"
                                        class="input-sm form-control form-control-sm" />
                                </div>
                                <div class="input-group detailsEditz">
                                    <span class="input-group-addon">Time:</span>
                                    <input type="time" id="wheelAlignmentDivFormDateTm" name="wheelAlignmentDivFormDateTm"
                                        class="input-sm form-control form-control-sm" />
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="input-group">
                                    <span class="input-group-addon">Odometer:</span>
                                    <input type="number" id="wheelAlignmentDivFormOdo" name="wheelAlignmentDivFormOdo"
                                        class="input-sm form-control form-control-sm" min="0" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:110%;text-align: center;vertical-align: middle;">Front</td>
                            <td>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="vertical-align:middle;">Caster</td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <th style="text-align:center;"></th>
                                                        <th style="text-align:center;">Initial</th>
                                                        <th colspan="2" style="text-align:center;">Specifications</th>
                                                        <th style="text-align:center;">Final</th>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align:center;"></th>
                                                        <th style="text-align:center;"></th>
                                                        <th style="text-align:center;">Min</th>
                                                        <th style="text-align:center;">Max</th>
                                                        <th style="text-align:center;"></th>
                                                    </tr>
                                                    <tr>
                                                      
                                                        <td>left</td>
                                                        <td><input type="text" id="CSwInitialLeft" name="CSwInitialLeft"
                                                                class="form-control input-sm tb form-control-sm" value="'.$intial_1.'" step="0.01">
                                                        </td>
                                                        <td><input type="text" id="CSwInitialMinleft"
                                                                name="CSwInitialMinleft" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_1.'" step="0.01"></td>
                                                        <td><input type="text" id="CSwInitialMaxleft"
                                                                name="CSwInitialMaxleft" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_1max.'" step="0.01"></td>
                                                        <td><input type="text" id="CSwInitialFinleft"
                                                                name="CSwInitialFinleft" class="form-control input-sm tb form-control-sm"
                                                                value="'.$final_1.'" step="0.01"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>right</td>
                                                        <td><input type="text" id="CSwInitialRight" name="CSwInitialRight"
                                                                class="form-control input-sm tb form-control-sm" value="'.$intial_2.'" step="0.01">
                                                        </td>
                                                        <td><input type="text" id="CSwInitialMinRight"
                                                                name="CSwInitialMinRight" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_2.'" step="0.01"></td>
                                                        <td><input type="text" id="CSwInitialMaxRight"
                                                                name="CSwInitialMaxRight" class="form-control input-sm tb"
                                                                value="'.$Specifications_2max.'" step="0.01"></td>
                                                        <td><input type="text" id="CSwInitialFinRight"
                                                                name="CSwInitialFinRight" class="form-control input-sm tb form-control-sm"
                                                                value="'.$final_2.'" step="0.01"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
    
    
                                        <tr>
                                            <td style="vertical-align:middle;">Camber</td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>left</td>
                                                        <td><input type="text" id="CMwInitialLeft" name="CMwInitialLeft"
                                                                class="form-control input-sm tb form-control-sm" value="'.$intial_3.'" step="0.01">
                                                        </td>
                                                        <td><input type="text" id="CMwInitialMinleft"
                                                                name="CMwInitialMinleft" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_3.'" step="0.01"></td>
                                                        <td><input type="text" id="CMwInitialMaxleft"
                                                                name="CMwInitialMaxleft" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_3max.'" step="0.01"></td>
                                                        <td><input type="text" id="CMwInitialFinleft"
                                                                name="CMwInitialFinleft" class="form-control input-sm tb form-control-sm"
                                                                value="'.$final_3.'" step="0.01"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>right</td>
                                                        <td><input type="text" id="CMwInitialRight" name="CMwInitialRight"
                                                                class="form-control input-sm tb form-control-sm" value="'.$intial_4.'" step="0.01">
                                                        </td>
                                                        <td><input type="text" id="CMwInitialMinRight"
                                                                name="CMwInitialMinRight" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_4.'" step="0.01"></td>
                                                        <td><input type="text" id="CMwInitialMaxRight"
                                                                name="CMwInitialMaxRight" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_4max.'" step="0.01"></td>
                                                        <td><input type="text" id="CMwInitialFinRight"
                                                                name="CMwInitialFinRight" class="form-control input-sm tb form-control-sm"
                                                                value="'.$final_4.'" step="0.01"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
    
    
                                        <tr>
                                            <td style="vertical-align:middle">Toe</td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>left</td>
                                                        <td><input type="text" id="TwInitialLeft" name="TwInitialLeft"
                                                                class="form-control input-sm tb form-control-sm" value="'.$intial_5.'" step="0.01">
                                                        </td>
                                                        <td><input type="text" id="TwInitialMinleft" name="TwInitialMinleft"
                                                                class="form-control input-sm tb form-control-sm" value="'.$Specifications_5.'" step="0.01">
                                                        </td>
                                                        <td><input type="text" id="TwInitialMaxleft" name="TwInitialMaxleft"
                                                                class="form-control input-sm tb form-control-sm" value="'.$Specifications_5max.'" step="0.01">
                                                        </td>
                                                        <td><input type="text" id="TwInitialFinleft" name="TwInitialFinleft"
                                                                class="form-control input-sm tb form-control-sm" value="'.$final_5.'" step="0.01">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>right</td>
                                                        <td><input type="text" id="TwInitialRight" name="TwInitialRight"
                                                                class="form-control input-sm tb form-control-sm" value="'.$intial_6.'" step="0.01">
                                                        </td>
                                                        <td><input type="text" id="TwInitialMinRight"
                                                                name="TwInitialMinRight" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_6.'" step="0.01"></td>
                                                        <td><input type="text" id="TwInitialMaxRight"
                                                                name="TwInitialMaxRight" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_6max.'" step="0.01"></td>
                                                        <td><input type="text" id="TwInitialFinRight"
                                                                name="TwInitialFinRight" class="form-control input-sm tb form-control-sm"
                                                                value="'.$final_6.'" step="0.01"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td style="font-size:110%;text-align: center;vertical-align: middle;">Rear</td>
                            <td>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="vertical-align:middle;">Camber</td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <th style="text-align:center;"></th>
                                                        <th style="text-align:center;">Initial</th>
                                                        <th colspan="2" style="text-align:center;">Specifications</th>
                                                        <th style="text-align:center;">Final</th>
                                                    </tr>
                                                    <tr>
                                                        <th style="text-align:center;"></th>
                                                        <th style="text-align:center;"></th>
                                                        <th style="text-align:center;">Min</th>
                                                        <th style="text-align:center;">Max</th>
                                                        <th style="text-align:center;"></th>
                                                    </tr>
    
                                                    <tr>
                                                        <td>left</td>
                                                        <td><input type="text" id="CMrInitialLeft" name="CMrInitialLeft"
                                                                class="form-control input-sm tb form-control-sm" value="'.$intial_9.'" step="0.01">
                                                        </td>
                                                        <td><input type="text" id="CMrInitialMinleft"
                                                                name="CMrInitialMinleft" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_9.'" step="0.01"></td>
                                                        <td><input type="text" id="CMrInitialMaxleft"
                                                                name="CMrInitialMaxleft" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_9max.'" step="0.01"></td>
                                                        <td><input type="text" id="CMrInitialFinleft"
                                                                name="CMrInitialFinleft" class="form-control input-sm tb form-control-sm"
                                                                value="'.$final_9.'" step="0.01"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>right</td>
                                                        <td><input type="text" id="CMrInitialRight" name="CMrInitialRight"
                                                                class="form-control input-sm tb form-control-sm" value="'.$intial_10.'" step="0.01">
                                                        </td>
                                                        <td><input type="text" id="CMrInitialMinRight"
                                                                name="CMrInitialMinRight" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_10.'" step="0.01"></td>
                                                        <td><input type="text" id="CMrInitialMaxRight"
                                                                name="CMrInitialMaxRight" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_10max.'" step="0.01"></td>
                                                        <td><input type="text" id="CMrInitialFinRight"
                                                                name="CMrInitialFinRight" class="form-control input-sm tb form-control-sm"
                                                                value="'.$final_10.'" step="0.01"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
    
                                        <tr>
                                            <td style="vertical-align:middle;">Toe</td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>left</td>
                                                        <td><input type="text" id="TrInitialLeft" name="TrInitialLeft"
                                                                class="form-control input-sm tb form-control-sm" value="'.$intial_11.'" step="0.01">
                                                        </td>
                                                        <td><input type="text" id="TrInitialMinleft" name="TrInitialMinleft"
                                                                class="form-control input-sm tb form-control-sm" value="'.$Specifications_11.'" step="0.01">
                                                        </td>
                                                        <td><input type="text" id="TrInitialMaxleft" name="TrInitialMaxleft"
                                                                class="form-control input-sm tb form-control-sm" value="'.$Specifications_11max.'" step="0.01">
                                                        </td>
                                                        <td><input type="text" id="TrInitialFinleft" name="TrInitialFinleft"
                                                                class="form-control input-sm tb form-control-sm" value="'.$final_11.'" step="0.01">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>right</td>
                                                        <td><input type="text" id="TrInitialRight" name="TrInitialRight"
                                                                class="form-control input-sm tb form-control-sm" value="'.$intial_12.'" step="0.01">
                                                        </td>
                                                        <td><input type="text" id="TrInitialMinRight"
                                                                name="TrInitialMinRight" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_12.'" step="0.01"></td>
                                                        <td><input type="text" id="TrInitialMaxRight"
                                                                name="TrInitialMaxRight" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_12max.'" step="0.01"></td>
                                                        <td><input type="text" id="TrInitialFinRight"
                                                                name="TrInitialFinRight" class="form-control input-sm tb form-control-sm"
                                                                value="'.$final_12.'" step="0.01"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
    
                                        <tr>
                                            <td style="vertical-align:middle;">Thrust Angle</td>
                                            <td colspan="2">
                                                <table>
                                                    <tr>
                                                        <td style="width:32px;"></td>
                                                        <td><input type="text" id="CSrInitialLeft" name="CSrInitialLeft"
                                                                class="form-control input-sm tb form-control-sm" value="'.$intial_7.'" step="0.01">
                                                        </td>
                                                        <td colspan="2"><input type="text" id="CSrInitialMaxleft"
                                                                name="CSrInitialMaxleft" class="form-control input-sm tb form-control-sm"
                                                                value="'.$final_7.'" step="0.01"></td>
                                                        <td colspan="4"><input type="text" id="CSrInitialRight"
                                                                name="CSrInitialRight" class="form-control input-sm tb form-control-sm"
                                                                value="'.$Specifications_7.'" step="0.01"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="tablesorter-blackice">
                    <thead>
                        <tr>
                            <th colspan="9" style="text-align:center;">Secondary Angles</th>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align:center;"></th>
                            <th colspan="4" style="text-align:center;">Specifications</th>
                            <th colspan="2" style="text-align:center;"></th>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align:center;">Initial</th>
                            <th colspan="2" style="text-align:center;">Min</th>
                            <th colspan="2" style="text-align:center;">Max</th>
                            <th colspan="2" style="text-align:center;">Final</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>left</th>
                            <th>right</th>
                            <th>left</th>
                            <th>right</th>
                            <th>left</th>
                            <th>right</th>
                            <th>left</th>
                            <th>right</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        <tr>
                            <td>SAI</td>
                            <td><input type="number" id="SAIInitialLeft" name="SAIInitialLeft"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_13.'" step="0.01"></td>
                            <td><input type="number" id="SAIInitialRight" name="SAIInitialRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_14.'" step="0.01"></td>
                            <td><input type="number" id="SAIInitialMinleft" name="SAIInitialMinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_13.'" step="0.01"></td>
                            <td><input type="number" id="SAIInitialMinRight" name="SAIInitialMinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_14.'" step="0.01"></td>
                            <td><input type="number" id="SAIInitialMaxleft" name="SAIInitialMaxleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_15.'" step="0.01"></td>
                            <td><input type="number" id="SAIInitialMaxRight" name="SAIInitialMaxRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_16.'" step="0.01"></td>
                            <td><input type="number" id="SAIInitialFinleft" name="SAIInitialFinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_13.'" step="0.01"></td>
                            <td><input type="number" id="SAIInitialFinRight" name="SAIInitialFinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_14.'" step="0.01"></td>
                        </tr>
    
                        <tr>
                            <td>Included Angles</td>
                            <td><input type="number" id="IAInitialLeft" name="IAInitialLeft"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_15.'" step="0.01"></td>
                            <td><input type="number" id="IAInitialRight" name="IAInitialRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_16.'" step="0.01"></td>
                            <td><input type="number" id="IAInitialMinleft" name="IAInitialMinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_17.'"></td>
                            <td><input type="number" id="IAInitialMinRight" name="IAInitialMinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_18.'"></td>
                            <td><input type="number" id="IAInitialMaxleft" name="IAInitialMaxleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_19.'"></td>
                            <td><input type="number" id="IAInitialMaxRight" name="IAInitialMaxRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_20.'"></td>
                            <td><input type="number" id="IAInitialFinleft" name="IAInitialFinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_15.'" step="0.01"></td>
                            <td><input type="number" id="IAInitialFinRight" name="IAInitialFinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_16.'" step="0.01"></td>
                        </tr>
    
                        <tr>
                            <td>Toe Out On Turns</td>
                            <td><input type="number" id="TOTInitialLeft" name="TOTInitialLeft"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_17.'"></td>
                            <td><input type="number" id="TOTInitialRight" name="TOTInitialRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_18.'"></td>
                            <td><input type="number" id="TOTInitialMinleft" name="TOTInitialMinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_21.'"></td>
                            <td><input type="number" id="TOTInitialMinRight" name="TOTInitialMinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_22.'"></td>
                            <td><input type="number" id="TOTInitialMaxleft" name="TOTInitialMaxleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_23.'"></td>
                            <td><input type="number" id="TOTInitialMaxRight" name="TOTInitialMaxRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_24.'" ></td>
                            <td><input type="number" id="TOTInitialFinleft" name="TOTInitialFinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_17.'"></td>
                            <td><input type="number" id="TOTInitialFinRight" name="TOTInitialFinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_18.'"></td>
                        </tr>
    
                        <tr>
                            <td>Maximum Turns</td>
                            <td><input type="number" id="MTInitialLeft" name="MTInitialLeft"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_19.'"></td>
                            <td><input type="number" id="MTInitialRight" name="MTInitialRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_20.'"></td>
                            <td><input type="number" id="MTInitialMinleft" name="MTInitialMinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_25.'"></td>
                            <td><input type="number" id="MTInitialMinRight" name="MTInitialMinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_26.'"></td>
                            <td><input type="number" id="MTInitialMaxleft" name="MTInitialMaxleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_27.'"></td>
                            <td><input type="number" id="MTInitialMaxRight" name="MTInitialMaxRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_28.'"></td>
                            <td><input type="number" id="MTInitialFinleft" name="MTInitialFinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_19.'"></td>
                            <td><input type="number" id="MTInitialFinRight" name="MTInitialFinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_20.'"></td>
                        </tr>
    
                        <tr>
                            <td>Toe Curve Change</td>
                            <td><input type="number" id="TCCInitialLeft" name="TCCInitialLeft"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_21.'"></td>
                            <td><input type="number" id="TCCInitialRight" name="TCCInitialRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_22.'" ></td>
                            <td><input type="number" id="TCCInitialMinleft" name="TCCInitialMinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_29.'" ></td>
                            <td><input type="number" id="TCCInitialMinRight" name="TCCInitialMinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_30.'" ></td>
                            <td><input type="number" id="TCCInitialMaxleft" name="TCCInitialMaxleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_31.'" ></td>
                            <td><input type="number" id="TCCInitialMaxRight" name="TCCInitialMaxRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_32.'" ></td>
                            <td><input type="number" id="TCCInitialFinleft" name="TCCInitialFinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_21.'" ></td>
                            <td><input type="number" id="TCCInitialFinRight" name="TCCInitialFinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_22.'" ></td>
                        </tr>
    
                        <tr>
                            <td>Setback</td>
                             
    
                           
                            <td><input type="number" id="SBInitialLeft" name="SBInitialLeft"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_23.'"></td>
    
    
                            <td><input type="number" id="SBInitialRight" name="SBInitialRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_24.'" step="0.01"></td>
                            <td><input type="number" id="SBInitialMinleft" name="SBInitialMinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_33.'" ></td>
                            <td><input type="number" id="SBInitialMinRight" name="SBInitialMinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_34.'"></td>
                            <td><input type="number" id="SBInitialMaxleft" name="SBInitialMaxleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_35.'"></td>
                            <td><input type="number" id="SBInitialMaxRight" name="SBInitialMaxRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_36.'"></td>
                            <td><input type="number" id="SBInitialFinleft" name="SBInitialFinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_23.'"></td>
                            <td><input type="number" id="SBInitialFinRight" name="SBInitialFinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_24.'"></td>
                        </tr>
    
                        <tr>
                            <td>Track Width Diff Wheel Base Diff</td>
                            <td><input type="number" id="TDInitialLeft" name="TDInitialLeft"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_25.'" step="0.01"></td>
                            <td><input type="number" id="TDInitialRight" name="TDInitialRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_26.'" step="0.01"></td>
                            <td><input type="number" id="TDInitialMinleft" name="TDInitialMinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_37.'" ></td>
                            <td><input type="number" id="TDInitialMinRight" name="TDInitialMinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_38.'"></td>
                            <td><input type="number" id="TDInitialMaxleft" name="TDInitialMaxleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_39.'"></td>
                            <td><input type="number" id="TDInitialMaxRight" name="TDInitialMaxRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_40.'"></td>
                            <td><input type="number" id="TDInitialFinleft" name="TDInitialFinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_25.'" step="0.01"></td>
                            <td><input type="number" id="TDInitialFinRight" name="TDInitialFinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_26.'" step="0.01"></td>
                        </tr>
    
                        <tr>
                            <td>Front Ride Height</td>
                            <td><input type="number" id="FRInitialLeft" name="FRInitialLeft"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_27.'" ></td>
                            <td><input type="number" id="FRInitialRight" name="FRInitialRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_28.'" ></td>
                            <td><input type="number" id="FRInitialMinleft" name="FRInitialMinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_41.'" step="0.01"></td>
                            <td><input type="number" id="FRInitialMinRight" name="FRInitialMinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_42.'" step="0.01"></td>
                            <td><input type="number" id="FRInitialMaxleft" name="FRInitialMaxleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_43.'" step="0.01"></td>
                            <td><input type="number" id="FRInitialMaxRight" name="FRInitialMaxRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_44.'" step="0.01"></td>
                            <td><input type="number" id="FRInitialFinleft" name="FRInitialFinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_27.'" step="0.01"></td>
                            <td><input type="number" id="FRInitialFinRight" name="FRInitialFinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_28.'" step="0.01"></td>
                        </tr>
    
                        <tr>
                            <td>Rear Ride Height</td>
                            <td><input type="number" id="RRInitialLeft" name="RRInitialLeft"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_29.'" ></td>
                            <td><input type="number" id="RRInitialRight" name="RRInitialRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$intial_30.'"  ></td>
                            <td><input type="number" id="RRInitialMinleft" name="RRInitialMinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_45.'" step="0.01"></td>
                            <td><input type="number" id="RRInitialMinRight" name="RRInitialMinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_46.'" step="0.01"></td>
                            <td><input type="number" id="RRInitialMaxleft" name="RRInitialMaxleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_47.'" step="0.01"></td>
                            <td><input type="number" id="RRInitialMaxRight" name="RRInitialMaxRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$Specifications_48.'" step="0.01"></td>
                            <td><input type="number" id="RRInitialFinleft" name="RRInitialFinleft"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_29.'" step="0.01"></td>
                            <td><input type="number" id="RRInitialFinRight" name="RRInitialFinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$final_30.'" step="0.01"></td>
                        </tr>
    
                        <tr>
                            <td colspan="8">Frame Angle</td>
                            <td><input type="number" id="FAInitialFinRight" name="FAInitialFinRight"
                                    class="form-control input-sm tb form-control-sm" value="'.$frame.'" ></td>
                        </tr>
                    </tbody>
                </table>
                <textarea style="margin-top:3px;" placeholder="Comment..." class="form-control input-sm"
                    id="wheelAlignmentDivFormTa" name="wheelAlignmentDivFormTa"></textarea>
                
                <!--
                <button class="btn btn-primary btn-sm" style="margin-top:3px;float: right">Save</button>
                -->
                <input type="submit" class="btn btn-success btn-sm float-right" value="Save">
                
    
            </form>
        </div>';
    
        return $table;
    }


    
    #PRINT THE WHEEL ALIGNMENT [ print_wheel_alignment ]
    public function print_wheel_alignment( $id ){
        #GET THE ID  [e.g MS1010103 ]
        #GET ALL THE DATA THAT IS NEEDED FROM DB

        $query = DB::table('client_details')->where('Key_Ref','=',$id)->get();
        if ( count( $query )  > 0) { 
            foreach($query as $row){
                $date     = $row->Date;
                $Owner    = $row->Fisrt_Name;
                $vehicle  = $row->Make." ".$row->Model;
                $regNo    = $row->Reg_No;
                $VIN    = $row->Chasses_No;
                $tel    = $row->Cell_number;
                $RO   = $row->RO;
                $Repair_Type    = $row->Repair_Type;
            }
        }

        

        $query2 = DB::table('alignment_report_initial')->where('Key_Ref','=',$id)->get();
        if ( count( $query2 )  > 0) {
        foreach($query2 as $row){
        $frame          = $row->frame;
        $intial_1       = $row->initial_1;
        $intial_2       = $row->initial_2;
        $intial_3       = $row->initial_3;
        $intial_4       = $row->initial_4;
        $intial_5       = $row->initial_5;
        $intial_6       = $row->initial_6;
        $intial_7       = $row->initial_7;
        $intial_8       = $row->initial_8;
        $intial_9       = $row->initial_9;
        $intial_10      = $row->initial_10;
        $intial_11      = $row->initial_11;
        $intial_12      = $row->initial_12;
        $intial_13      = $row->initial_13;
        $intial_14      = $row->initial_14;
        $intial_15      = $row->initial_15;
        $intial_16      = $row->initial_16;
        $intial_17      = $row->initial_17;
        $intial_18      = $row->initial_18;
        $intial_19      = $row->initial_19;
        $intial_20      = $row->initial_20;
        $intial_21      = $row->initial_21;
        $intial_22      = $row->initial_22;
        $intial_23      = $row->initial_23.' mm';
        $intial_24      = $row->initial_24.' mm';
        $intial_25      = $row->initial_25.' mm';
        $intial_26      = $row->initial_26.' mm';
        $intial_27      = $row->initial_27.' mm';
        $intial_28      = $row->initial_28;
        $intial_29      = $row->initial_29;
        $intial_30      = $row->initial_30;


        $Specifications_1   = $row->Specifications_1;
        $Specifications_2   = $row->Specifications_2;
        $Specifications_3   = $row->Specifications_3;
        $Specifications_4   = $row->Specifications_4;
        $Specifications_5   = $row->Specifications_5;
        $Specifications_6   = $row->Specifications_6;
        $Specifications_7   = $row->Specifications_7;
        $Specifications_8   = $row->Specifications_8;
        $Specifications_9   = $row->Specifications_9;
        $Specifications_10  = $row->Specifications_10;
        $Specifications_11  = $row->Specifications_11;
        $Specifications_12  = $row->Specifications_12;
        $Specifications_1max   = $row->Specifications_1max;
        $Specifications_2max   = $row->Specifications_2max;
        $Specifications_3max   = $row->Specifications_3max;
        $Specifications_4max   = $row->Specifications_4max;
        $Specifications_5max   = $row->Specifications_5max;
        $Specifications_6max   = $row->Specifications_6max;
        $Specifications_7max   = $row->Specifications_7max;
        $Specifications_8max   = $row->Specifications_8max;
        $Specifications_9max   = $row->Specifications_9max;
        $Specifications_10max  = $row->Specifications_10max;
        $Specifications_11max  = $row->Specifications_11max;
        $Specifications_12max  = $row->Specifications_12max;


        $Specifications_13  = $row->Specifications_13.'&#176;';
        $Specifications_14  = $row->Specifications_14.'&#176;';
        $Specifications_15  = $row->Specifications_15.'&#176;';
        $Specifications_16  = $row->Specifications_16.'&#176;';
        $Specifications_17  = $row->Specifications_17.'&#176;';
        $Specifications_18  = $row->Specifications_18.'&#176;';
        $Specifications_19  = $row->Specifications_19.'&#176;';
        $Specifications_20  = $row->Specifications_20.'&#176;';
        $Specifications_21  = $row->Specifications_21;
        $Specifications_22  = $row->Specifications_22;
        $Specifications_23  = $row->Specifications_23;
        $Specifications_24  = $row->Specifications_24;
        $Specifications_25  = $row->Specifications_25;
        $Specifications_26  = $row->Specifications_26;
        $Specifications_27  = $row->Specifications_27;
        $Specifications_28  = $row->Specifications_28;
        $Specifications_29  = $row->Specifications_29;
        $Specifications_30  = $row->Specifications_30;
        $Specifications_31  = $row->Specifications_31;
        $Specifications_32  = $row->Specifications_32;
        $Specifications_33  = $row->Specifications_33;
        $Specifications_34  = $row->Specifications_34;
        $Specifications_35  = $row->Specifications_35;
        $Specifications_36  = $row->Specifications_36.' mm';
        $Specifications_37  = $row->Specifications_37.' mm';
        $Specifications_38  = $row->Specifications_38.' mm';
        $Specifications_39  = $row->Specifications_39.' mm';
        $Specifications_40  = $row->Specifications_40.' mm';
        $Specifications_41  = $row->Specifications_41.' mm';
        $Specifications_42  = $row->Specifications_42.' mm';
        $Specifications_43  = $row->Specifications_43.' mm';
        $Specifications_44  = $row->Specifications_44.' mm';
        $Specifications_45  = $row->Specifications_45.' mm';
        $Specifications_46  = $row->Specifications_46.' mm';
        $Specifications_47  = $row->Specifications_47.' mm';
        $Specifications_48  = $row->Specifications_48.' mm';


        $final_1       = $row->final_1;
        $final_2       = $row->final_2;
        $final_3       = $row->final_3;
        $final_4       = $row->final_4;
        $final_5       = $row->final_5;
        $final_6       = $row->final_6;
        $final_7       = $row->final_7;
        $final_8       = $row->final_8;
        $final_9       = $row->final_9;
        $final_10      = $row->final_10;
        $final_11      = $row->final_11;
        $final_12      = $row->final_12;
        $final_13      = $row->final_13;
        $final_14      = $row->final_14;
        $final_15      = $row->final_15;
        $final_16      = $row->final_16;
        $final_17      = $row->final_17;
        $final_18      = $row->final_18;
        $final_19      = $row->final_19;
        $final_20      = $row->final_20;
        $final_21      = $row->final_21;
        $final_22      = $row->final_22;
        $final_23      = $row->final_23;
        $final_24      = $row->final_24;
        $final_25      = $row->final_25;
        $final_26      = $row->final_26;
        $final_27      = $row->final_27;
        $final_28      = $row->final_28;
        $final_29      = $row->final_29;
        $final_30      = $row->final_30;
        $date=$row->date;
        $odometer=$row->odometer;
        $comments   =   $row->comments;
        $time=$row->time;


        }
        }else{
            $odometer ='';
            $comments='';
            $time='';
        $Specifications_1 = 2.48;
        $Specifications_2 = 2.48;
        $Specifications_3 = -0.57;
        $Specifications_4 = -0.57;
        $Specifications_5 = -0.3;
        $Specifications_6 = -0.3;
        $Specifications_7 =0.18;
        $Specifications_8 = 4.18;
        $Specifications_9 = -1.57;
        $Specifications_10= -1.57;
        $Specifications_11= -0.3;
        $Specifications_12= -0.3;
        $Specifications_1max = 4.18;
        $Specifications_2max = 4.18;
        $Specifications_3max = 0.33;
        $Specifications_4max = 0.33;
        $Specifications_5max = 0.9;
        $Specifications_6max = 0.9;
        $Specifications_7max = -0.57;
        $Specifications_8max = -0.57;
        $Specifications_9max = -0.57;
        $Specifications_10max= -0.57;
        $Specifications_11max= 1.8;
        $Specifications_12max= 1.9;

        $Specifications_13  = '---';
        $Specifications_14  = '---';
        $Specifications_15  = '---';
        $Specifications_16  = '---';
        $Specifications_17  = '---';
        $Specifications_18  = '---';
        $Specifications_19  = '---';
        $Specifications_20  = '---';
        $Specifications_21  = '---';
        $Specifications_22  = '---';
        $Specifications_23  = '---';
        $Specifications_24  = '---';
        $Specifications_25  = '---';
        $Specifications_26  = '---';
        $Specifications_27  = '---';
        $Specifications_28  = '---';
        $Specifications_29  = '---';
        $Specifications_30  = '---';
        $Specifications_31  = '---';
        $Specifications_32  = '---';
        $Specifications_33  = '---';
        $Specifications_34  = '---';
        $Specifications_35  = '---';
        $Specifications_36  = '---';
        $Specifications_37  = '---';
        $Specifications_38  = '---';
        $Specifications_39  = '---';
        $Specifications_40  = '---';
        $Specifications_41  = '625'.' mm';
        $Specifications_42  = '625'.' mm';
        $Specifications_43  ='625'.' mm';
        $Specifications_44  = '625'.' mm';
        $Specifications_45  = '625'.' mm';
        $Specifications_46  = '625'.' mm';
        $Specifications_47  ='625'.' mm';
        $Specifications_48  ='625'.' mm';

        $intial_1       = 3.15;
        $intial_2       = 4.01;
        $intial_3       = -0.26;
        $intial_4       = -0.21;
        $intial_5       = -11.9;
        $intial_6       = -11.5;
        $intial_7       = 0.02;
        $intial_8       = 0.2;
        $intial_9       = -1.49;
        $intial_10      = -1.25;
        $intial_11      = 0.6;
        $intial_12      = 0.2;
        $intial_13      = 13.07;
        $intial_14      = 12.41;
        $intial_15      = 12.41;
        $intial_16      = 12.20;
        $intial_17      = '----';
        $intial_18      ='----';
        $intial_19      = '----';
        $intial_20      =  '----';
        $intial_21      = '----';
        $intial_22      =  '----';
        $intial_23      =  '-16'.' mm';;
        $intial_24      =  '10'.' mm';;
        $intial_25      =  '3.0'.' mm';;
        $intial_26      = '-26'.' mm';;
        $intial_27      =   '----';
        $intial_28      =   '----';
        $intial_29      =   '----';
        $intial_30      =   '----';

        $final_1       = 3.38;
        $final_2       = 3.46;
        $final_3       = -0.34;
        $final_4       = -0.33;
        $final_5       = 0.6;
        $final_6       = 0.5;
        $final_7       = 0.0;
        $final_8       = -0.0;
        $final_9       = -1.46;
        $final_10      = -1.25;
        $final_11      = 0.6;
        $final_12      = 0.3;
        $final_13      = 13.06;
        $final_14      = 12.48;
        $final_15      = 12.32;
        $final_16      = 12.15;
        $final_17      = '----';
        $final_18      = '----';
        $final_19      = '----';
        $final_20      = '----';
        $final_21      = '----';
        $final_22      = '----';
        $final_23      = '----';
        $final_24      = '----';
        $final_25      = '-16'.' mm';
        $final_26      = '10'.' mm';
        $final_27      = '3'.' mm';
        $final_28      = '----';
        $final_29      = '----';
        $final_30      = '----';
        $date = date('Y-m-d h:i:s');
        $frame='----';
        }
            
        $intial_total=$intial_5+$intial_6;
        $Specifications_total=$Specifications_5+$Specifications_6;  
        $final_total =$final_5+$final_6;
        $final_12_total = $final_7+$final_8+$final_9+$final_10+$final_11+$final_12;
        $intial_12_total =$intial_7+$intial_8+$intial_9+$intial_10+$intial_11+$intial_12;
        $Specifications_12_total = $Specifications_7+$Specifications_8+$Specifications_9+$Specifications_10+$Specifications_11+$Specifications_12;

       
        $pdf=PDF::loadview('pdf.alignment_report', [ 'date'=>$date,'Owner'=>$Owner,'vehicle'=>$vehicle,'regNo'=>$regNo,'VIN'=>$VIN,'tel'=>$tel,'RO'=>$RO,'Repair_Type'=>$Repair_Type,
        'frame'=>$frame,'intial_1'=>$intial_1,'intial_2'=>$intial_2,'intial_3'=>$intial_3,'intial_4'=>$intial_4,'intial_5'=>$intial_5,
        'intial_6'=>$intial_6,'intial_7'=>$intial_7,'intial_8'=>$intial_8,'intial_9'=>$intial_9,'intial_10'=>$intial_10,'intial_11'=>$intial_11,
        'intial_12'=>$intial_12,'intial_13'=>$intial_13,'intial_14'=>$intial_14,'intial_15'=>$intial_15,'intial_16'=>$intial_16,'intial_17'=>$intial_17,
        'intial_18'=>$intial_18,'intial_19'=>$intial_19,'intial_20'=>$intial_20,'intial_21'=>$intial_21,'intial_22'=>$intial_22,'intial_23'=>$intial_23,
        'intial_24'=>$intial_24,'intial_25'=>$intial_25,'intial_26'=>$intial_26,'intial_27'=>$intial_27,'intial_28'=>$intial_28,'intial_29'=>$intial_29,
        'intial_30'=>$intial_30,
        'Specifications_1'=>$Specifications_1,'Specifications_2'=>$Specifications_2,'Specifications_3'=>$Specifications_3,'Specifications_4'=>$Specifications_4,
        'Specifications_5'=>$Specifications_5,'Specifications_6'=>$Specifications_6,'Specifications_7'=>$Specifications_7,'Specifications_8'=>$Specifications_8,
        'Specifications_9'=>$Specifications_9,'Specifications_10'=>$Specifications_10,'Specifications_11'=>$Specifications_11,'Specifications_12'=>$Specifications_12,
        'Specifications_1max'=>$Specifications_1max,'Specifications_2max'=>$Specifications_2max,'Specifications_3max'=>$Specifications_3max,
        'Specifications_4max'=>$Specifications_4max,'Specifications_5max'=>$Specifications_5max,'Specifications_6max'=>$Specifications_6max,
        'Specifications_7max'=>$Specifications_7max,'Specifications_8max'=>$Specifications_8max,'Specifications_9max'=>$Specifications_9max,
        'Specifications_10max'=>$Specifications_10max,'Specifications_11max'=>$Specifications_11max,'Specifications_12max'=>$Specifications_12max, 
        'Specifications_13'=>$Specifications_13,'Specifications_14'=>$Specifications_14,'Specifications_15'=>$Specifications_15,'Specifications_16'=>$Specifications_16,
        'Specifications_17'=>$Specifications_17,'Specifications_18'=>$Specifications_18,'Specifications_19'=>$Specifications_19,'Specifications_20'=>$Specifications_20,
        'Specifications_21'=>$Specifications_21,'Specifications_22'=>$Specifications_22,'Specifications_23'=>$Specifications_23,'Specifications_24'=>$Specifications_24,
        'Specifications_25'=>$Specifications_25,'Specifications_26'=>$Specifications_26,'Specifications_27'=>$Specifications_27,'Specifications_28'=>$Specifications_28,
        'Specifications_29'=>$Specifications_29,'Specifications_30'=>$Specifications_30,'Specifications_31'=>$Specifications_31,'Specifications_32'=>$Specifications_32,
        'Specifications_33'=>$Specifications_33,'Specifications_34'=>$Specifications_34,'Specifications_35'=>$Specifications_35,'Specifications_36'=>$Specifications_36,
        'Specifications_37'=>$Specifications_37,'Specifications_38'=>$Specifications_38,'Specifications_39'=>$Specifications_39,'Specifications_40'=>$Specifications_40,
        'Specifications_41'=>$Specifications_41,'Specifications_42'=>$Specifications_42,'Specifications_43'=>$Specifications_43,'Specifications_44'=>$Specifications_44,
        'Specifications_45'=>$Specifications_45,'Specifications_46'=>$Specifications_46,'Specifications_47'=>$Specifications_47,'Specifications_48'=>$Specifications_48,
        'final_1'=>$final_1,'final_2'=>$final_2,'final_3'=>$final_3,'final_4'=>$final_4,'final_5'=>$final_5,'final_6'=>$final_6,'final_7'=>$final_7,
        'final_8'=>$final_8,'final_9'=>$final_9,'final_10'=>$final_10,'final_11'=>$final_11,'final_12'=>$final_12,'final_13'=>$final_13,'final_14'=>$final_14,
        'final_15'=>$final_15,'final_16'=>$final_16,'final_17'=>$final_17,'final_18'=>$final_18,'final_19'=>$final_19,'final_20'=>$final_20,'final_21'=>$final_21,
        'final_22'=>$final_22,'final_23'=>$final_23,'final_24'=>$final_24,'final_25'=>$final_25,'final_26'=>$final_26,'final_27'=>$final_27,
        'final_28'=>$final_28,'final_29'=>$final_29,'final_30'=>$final_30,'date'=>$date,'odometer'=>$odometer,'comments'=>$comments, 'time'=>$time,
        'intial_total'=>$intial_total,'Specifications_total'=>$Specifications_total,'final_total'=>$final_total,'final_12_total'=>$final_12_total,
        'intial_12_total'=>$intial_12_total,'Specifications_12_total'=>$Specifications_12_total 
        ]
        );

        return $pdf->stream('Alignment Report.pdf');
    
    }



    #CHANGED THE IMAGE FILE PATH, TO VIEW THE
    public function final_stage_photos(Request $request){

        $id       = $request->id;      //[ MS1010103 ]
        $category = $request->category;
        $table    = '';
        $process_photos = "";
        $title  = "";
        $action = ""; 

        $security    = Config::get('constants.category.security');    //SECURITY
        $additional  = Config::get('constants.category.additional');  //ADDITIONAL
        $wip         = Config::get('constants.category.wip');         //WORK IN PROGRESS
        $final_stage = Config::get('constants.category.final_stage'); //FINAL STAGE [ TAKE OUT FRO NOW ]

        switch ($category) {
          case $security:
            $title = "Security Photos";
            $action = "/line-manager-security-upload";
            $process_photos=DB::table('securityphotos')->where('Key_Ref','=',$id)->get();
            break;
          case $additional:
            $title  = "Additional Photos";
            $action = "/line-manager-additional-photo-upload";
            $process_photos = DB::table('track_photos')->where('Key_Ref','=',$id)->where('category','=',$additional)->get();
            break;
          case $wip:
            $title  = "Work In Progress Photos";
            $action = "/line-manager-upload-photo-wip";
            $process_photos = DB::table('track_photos')->where('Key_Ref','=',$id)->where('category','=',$wip)->get();

            break;
          case $final_stage:
            $title  = "Final Stage Photos";
            $action = "/line-manager-upload-photo-final-stage";
            $process_photos = DB::table('track_photos')->where('Key_Ref','=',$id)->where('category','=',$final_stage)->get();

            break;

            /*
          default:
            echo "Your favorite color is neither red, blue, nor green!";
            */
        }

        return view('final_stage.finalphotos',[ 'key' => $id,'title' => $title, 'process_photos' => $process_photos, 'action' => $action  ]);

        /*** START HERE
        $id=$request->id;
        $table='';
        $security_photos=DB::table('securityphotos')->where('Key_Ref','=',$id)->get();
        $additional_photo=DB::table('additionalphotos')->where('Key_Ref','=',$id)->get();
        $track_photo=DB::table('track_photos')->where('Key_Ref','=',$id)->get();

        $table.='<div class="row">';
        foreach($security_photos as $sec_photo){

            $path = 'images/mag_security/'.$sec_photo->Key_Ref.'/'.$sec_photo->url;
            $path2 = 'http://192.168.0.185:8080/mag_qoutation/mag_snapshot/security_images/'.$sec_photo->Key_Ref.'/'.$sec_photo->url;
             if (file_exists($path)) {
                $file_name =asset('/images/mag_security/'.$sec_photo->Key_Ref.'/'.$sec_photo->url);
            } else {
                $file_name = $path2;
            }
    
            $table.=" <div class='col-sm-2'>";
            $table.='<a class="thumbnail fancybox" rel="ligthbox" href="'.$file_name.'" target="_blank">';
            $table.='<img class="img-fluid img-thumbnail" src="'.$file_name.'" target="_blank">';
            $table.="<div class='text-center'>";
            $table.="<small class='text-muted'></small>";
            $table.="</div>";
            $table.="</a>";
            $table.='<a class="btn btn-danger" href="/line-manager-delete/"'.$sec_photo->id.'"><span class="fa fa-trash" ></span></a>';
            $table.='</div>';
            }
            foreach($additional_photo as $additional){
                $path = 'images/mag_security/'.$additional->Key_Ref.'/'.$sec_photo->url;
            $path2 = 'http://192.168.0.185:8080/mag_qoutation/photos/'.$additional->Key_Ref.'/'.$additional->url;
             if (file_exists($path)) {
                $file_name =asset('/images/mag_photos/'.$additional->Key_Ref.'/'.$additional->url);
            } else {
                $file_name = $path2;
            }
    
            $table.=" <div class='col-sm-2'>";
            $table.='<a class="thumbnail fancybox" rel="ligthbox" href="'.$file_name.'" target="_blank">';
            $table.='<img class="img-fluid img-thumbnail" src="'.$file_name.'" target="_blank">';
            $table.="<div class='text-center'>";
            $table.="<small class='text-muted'></small>";
            $table.="</div>";
            $table.="</a>";
            $table.='<a class="btn btn-danger" href="/line-manager-delete/"'.$sec_photo->id.'"><span class="fa fa-trash" ></span></a>';
            $table.='</div>';
            }
            $table.="</div>";


        return $table;
        END HERE**/

    }

    # [CUURENT UPDATE ]
    public function final_stage_ordering(Request $request){
        $id=$request->id;
        
         #ADDED VARIABLE
         $file_name = "";

        $table='';
        $count_orders=1;
        $confirmed_orders=DB::table('confirmed_orders')->where('Key_Ref','=',$id)->get(); 
        $suppliers=DB::table('supplier')->get();
        $storage=DB::table('qoutes')
                        ->leftjoin('orders',function($join){
                            $join->on('orders.Key_Ref','=','qoutes.Key_Ref')
                                    ->where('orders.Description_2','=','qoutes.Key_Ref');
                        })         
                        ->leftjoin('toberepaired',function($q){
                            $q->on('toberepaired.Key_Ref','=','qoutes.Key_Ref')
                                ->where('toberepaired.description','=','qoutes.Key_Ref');
                        })           
                        ->select('qoutes.Key_Ref','qoutes.id','qoutes.Percent','qoutes.Description','qoutes.Parts_sales','qoutes.Part','qoutes.Misc','qoutes.Oper','qoutes.Quantity','qoutes.MarkUp','qoutes.Parts_sales')
                        ->where('qoutes.Key_Ref','=',$id)
                        ->distinct('qoutes.Key_Ref')
                        ->get();

        $table='<table class="table table-sm" style="font-size:10px;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date/Time</th>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Order No.</th>
                                    
                                    <th scope="col">File</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Comments</th>
                                    <th scope="col">Credits</th>
                                    <th scope="col">Action</th>    
                                </tr>
                            </thead>
                            <tbody>';
                                
                                foreach($confirmed_orders as $orders){
                                $table.='<tr>';
                                $table.='<td>'.$count_orders.'</td>';
                                $table.='<td>'.$orders->date.'</td>';
                                $table.='<td>'.$orders->Supplier.'</td>';
                                $table.='<td>'.$orders->order_number.'</td>';

                                 #ADD THIS                            
                                 $path = 'docs/uploaded/'.$orders->url;
                                 $path2 = 'http://192.168.0.185:8080/Mag_System/models/tcpdf/examples/Orders/'.$orders->url;
                                  if (file_exists($path)) {
                                     //$file_name =$path ;
                                     $file_name =asset('/docs/uploaded/'.$orders->url);
                                 } else {
                                     $file_name = $path2;
                                 }
 
                                
                                 #FIX AND UPDATE THE HREF
                                /*
                                $table.='<td><a href="/docs/uploaded/'.$orders->url.'" target="_blank">'.$orders->url.'</a></td>';
                                http://localhost/Mag_System/models/tcpdf/examples/Orders/SL73632202008120623file.pdf

                                $table.='<td><a href="/docs/uploaded/'.$orders->url.'" target="_blank">'.$orders->url.'</a></td>';
                                */
                                
                                //$table.='<td><a href="http://192.168.0.185:8080/Mag_System/models/tcpdf/examples/Orders/'.$orders->url.'" target="_blank">'.$orders->url.'</a></td>';
                                $table.='<td><a href="'.$file_name.'" target="_blank">'.$orders->url.'</a></td>';

                                    if($orders->mail_status=="Sent"){
                                    $table.='<td style="color:green;"><b>'.$orders->mail_status.'</b></td>';    
                                    }else{    
                                    $table.='<td style="color:red;"><b>'.$orders->mail_status.'</b></td>';
                                    }    
                                    $table.='<td>'.$orders->comment.'</td>';
                                    $table.='<td><a href="#" class="btn btn-primary btn-sm create_create_notes" id="credit_no" data-order_no="'.$orders->order_number.'" data-order_id="'.$orders->id.'" title="Credits Notes">Credit Notes</a></td>';
                                    $table.='<td>';
                                        
                                    $table.='<a href="/pre-costing-order-email/'.$orders->id.'" title="Send Mail" class="btn btn-success btn-sm"><span class="fa fa-envelope"></span></a>';
                                    $table.='<a href="/pre-costing-order-email-delete/'.$orders->id.'" title="Delete Mail" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>';
                                    $table.='</td>';
                                    $table.='</tr>';
                                    $count_orders++;
                                }
                                $table.='</tbody>';
                                $table.='</table>';
                                $table.='<br>';
                                
 //$table.='<form method="POST" action="/pre-costing-order">';
 $table.='<form method="GET" action="/pre-costing-order">';
 $table.='<input type="hidden" name="final_key" id="final_key" value="'.$id.'">';

$table.='<div class="row">';

$table.='<div class="card shadow mb-3 col-6">'; 
$table.='<div class="card-body">'; 

 $table.='<div class="row">';  
       $table.='<select class="custom-select" id="final_order_parts" name="final_order_parts[]" style="font-size:10px;" multiple="multiple"  required>';
           $table.='<option selected>Open this select menu</option>';
           foreach($storage as $parts){
               $table.='<option value="'.$parts->Description.'">'.$parts->Description.'</option>';
           }    
       $table.='</select>
       </div>';
 $table.=' 
           <br>
           <div class="row">
               <div class="input-group">
                   <div class="input-group-prepend">
                       <label class="input-group-text" for="final_order_suppliers" style="font-size:10px;">Suppliers</label>
                   </div>
                   <select class="custom-select form-control-sm" id="final_order_suppliers" name="final_order_suppliers" style="font-size:10px;" required>
                         <option selected>Select Supplier</option>';
                         foreach($suppliers as $supplier){
                             $table.='<option value="'.$supplier->sup_key.'">'.$supplier->sup_name.'</option>';
                         }
           $table.='</select>
               </div>
           </div>
           <br>';

            $table.='
           <div class="row">
               <div class="input-group">
                     <div class="input-group-prepend">
                         <span class="input-group-text" style="font-size:10px;">Comments</span>
                     </div>
                     <textarea class="form-control form-control-sm" style="font-size:10px;" rows="5" aria-label="With textarea" name="final_order_comments" id="final_order_comments" required></textarea>
               </div>     
           </div> 
           <br>

           <div class="row">
               <div class="input-group">
                     <div class="input-group-prepend">
                         <span class="input-group-text" style="font-size:10px;">Notes</span>
                     </div>
                     <textarea class="form-control form-control-sm" style="font-size:10px;" rows="5" aria-label="With textarea" name="final_order_notes" id="final_order_notes" required></textarea>
               </div>
           </div>
           ';

$table.='</div></div>';


    $table.='
     <!-- #SECOND  CARD -->
     <div class="card shadow mb-3 col-6">
           <div class="card-body">
               <div class="row">
                   <div class="input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text" id="basic-addon1" style="font-size:10px;height:26px;">Suppliers Name</span>
                       </div>
                           <input type="text" class="form-control form-control-sm" style="font-size:10px;" placeholder="Supplier Name" aria-label="order_supplier" aria-describedby="order_supplier" id="final_order_supplier" name="final_order_supplier" required>
                   </div>
               </div>
               <br>
               <div class="row">
                   <div class="input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text" id="basic-addon1" style="font-size:10px;height:26px;">Supplier Email</span>
                       </div>
                           <input type="email" class="form-control form-control-sm" style="font-size:10px;" placeholder="Email" aria-label="order_email_supplier" aria-describedby="final_order_email_supplier" name="final_order_email_supplier" id="final_order_email_supplier" required>
                   </div>
               </div>
               <br>
               <div class="row">
                   <div class="input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text" id="order_email" style="font-size:10px;height:26px;">Sender Email</span>
                       </div>
                           <input type="email" class="form-control form-control-sm" style="font-size:10px;" aria-label="order_email" aria-describedby="order_email" id="final_order_email_sender" name="final_order_email_sender" required>
                   </div>
               </div>
               <br>
               <div class="row">
                   <div class="input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text" id="final_order_branch" style="font-size:10px;height:26px;">Branch Tel</span>
                       </div>
                           <input type="text" class="form-control form-control-sm" style="font-size:10px;" aria-label="order_branch_tel" name="final_order_branch_tel" id="final_order_branch_tel" aria-describedby="order_branch" required>
                   </div>
               </div>
               <br>
               <div class="row">
                   <div class="input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text" id="final_order_follow1" style="font-size:10px;height:26px;">Follow Up 1</span>
                       </div>
                           <input type="date" class="form-control form-control-sm" style="font-size:10px;" aria-label="order_follow1" aria-describedby="order_follow1" name="final_order_follow1" id="final_order_follow1" required>
                   </div>
               </div>
               <br>
               <div class="row">
                   <div class="input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text" id="order_follow2" style="font-size:10px;height:26px;">Follow Up 2</span>
                       </div>
                           <input type="date" class="form-control form-control-sm" style="font-size:10px;" aria-label="order_follow2" aria-describedby="order_follow2" name="final_order_follow2" id="final_order_follow2" required>
                   </div>
               </div>
               <br>
               <div class="row">
                   <div class="input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text" id="order_follow3" style="font-size:10px;height:26px;">Follow Up 3</span>
                       </div>
                           <input type="date" class="form-control form-control-sm" style="font-size:10px;" aria-label="order_follow3" name="final_order_follow3" id="final_order_follow3" aria-describedby="basic-addon1" required>
                   </div>
               </div>

           </div>
     </div>
       
     <input type="submit" class="btn btn-success btn-sm float-right" value="Save">
     </form>
     ';

$table.='</div>';

                               
        return $table;
    }

    
     #GET THE  [ TB: Oper ] LIST USING A DROPDOWN
     public function fetch_oper_dropdown_list(){

        //$opt = '';
        $opt = array();
        $data=DB::select('select * from oper order by oper');
        $i=0;
        foreach($data as $row){
            $opt[$i] = "<option value='".$row->oper."'>".$row->oper."</option>";
            $i++;
        }

        return $opt;

    }
    

public function update_final_bettement(Request $request){
    $id = $request->id;
    $opr = $request->d;
    DB::table('qoutes')
                ->where('id','=',$id)
                ->update(['Betterment'=>$opr]);

}

public function update_final_discount2(Request $request){
    $id = $request->id;
    $disc = $request->d;
    DB::table('qoutes')
                ->where('Key_Ref',$id)
                ->update(['Discount2'=>$disc]);
  
}

public function update_final_markup2(Request $request){
    $id = $request->id;
    $oper = $request->d;
    DB::table('qoutes')
                ->where('id','=',$id)
                ->update(['MarkUp2'=>$oper,'MarkUp'=>0]);

    /*
     DB::table('qoutes')
                ->where('id','=',$id)
                ->update(['MarkUp2'=>$oper]);
    */

}

public function update_final_consumerables(Request $request){
    $id = $request->ln;
    $sun = $request->d;
    $exist=DB::table('betterment')->where('Key_Ref','=',$id)->whereNull('paintShop1')->get();
    if($exist==null){
        DB::table('betterment')->insert(['Key_Ref'=>$id,'paintShop1'=>$sun]);
    }else{
        DB::table('betterment')->where('Key_Ref','=',$id)->update(['paintShop1'=>$sun]);
    }       
}

public function update_final_consumerables_(Request $request){
    $id = $request->ln;
    $sun = $request->d;
    $exist=DB::table('betterment')->where('Key_Ref','=',$id)->whereNull('paintShop2')->get();
    if($exist==null){
        DB::table('betterment')->insert(['Key_Ref'=>$id,'paintShop2'=>$sun]);
    }else{
        DB::table('betterment')->where('Key_Ref','=',$id)->update(['paintShop2'=>$sun]);
    } 
}

public function update_final_vat(Request $request){
    $id  = $request->id;
    $vat = $request->vat;
    DB::table('client_details')
                ->where('Key_Ref',$id)
                ->update(['vat'=>$vat]);

}

public function search_archive_finalstage(Request $request){
    $id=$request->archieve_key;
    $position=Auth::user()->position;
        $admin=Auth::user()->admin;
        $quote=Auth::user()->quote;
        $consumable=Auth::user()->consumerable;
        $customer=Auth::user()->customer_care;
        $line_manager=Auth::user()->line_manager;
        $creditor=Auth::user()->creditors;
        $costing=Auth::user()->costing;
        $final=Auth::user()->final_stage;
        $sec_photos=array();
        $docs=array();
        $track_photos=array();
        $notes=array();
        
        $fetch_vehicles=DB::table('fetch_ApprovedQuotes')
                            ->where('Key_Ref','=',$id)
                            ->orWhere('Reg_No','=',$id)
                            ->orWhere('Claim_NO','=',$id)
                            ->get();

    return view('final_stage.getvehicles',['final'=>$final,'approved'=>$fetch_vehicles,'admin'=>$admin,'quote'=>$quote,'consumable'=>$consumable,'customer'=>$customer,'line'=>$line_manager,'position'=>$position,'creditors'=>$creditor,'costing'=>$costing]);
}

public function final_stage_rate(Request $request){
    
    $key=$request->id;
    $rate_details=DB::table('insurer')
                        ->where('Key_Ref','=',$key)
                        ->get();
    $table='<form method="GET" action="/client-rate-edit">
                <input type="hidden" id="key" name="key" value="'.$key.'">';
                $table.=''.csrf_field().'';
                if($rate_details->count()>0){
                foreach($rate_details as $rate){
                $table.='<div class="row">
                    <div class="form-group col-6">
                        <label for="client_labor">Labour:</label>
                        <input type="text" class="form-control form-control-sm" id="client_labor" name="client_labor" value="'.$rate->labour.'">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_paint">Paint:</label>
                        <input type="text" class="form-control form-control-sm" id="client_paint" name="client_paint" value="'.$rate->Paint.'">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_strip">Strip:</label>
                        <input type="text" class="form-control form-control-sm" id="client_strip" name="client_strip" value="'.$rate->Strip.'">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_frame">Frame:</label>
                        <input type="text" class="form-control form-control-sm" id="client_frame" name="client_frame" value="'.$rate->Frame.'">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_sundries">Sundries:</label>
                        <input type="text" class="form-control form-control-sm" id="client_sundries" name="client_sundries" value="'.$rate->ShopSup.'">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_paint_supplies">Paint Supplies:</label>
                        <input type="text" class="form-control form-control-sm" id="client_paint_supplies" name="client_paint_supplies" value="'.$rate->PaintSup.'">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_vat">VAT:</label>
                        <input type="text" class="form-control form-control-sm" id="client_vat" name="client_vat" value="'.$rate->vat.'">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_covid">COVID - 19</label>
                        <input type="text" class="form-control form-control-sm" id="client_covid" name="client_covid" value="'.$rate->covid.'">
                    </div>
                </div>';
                
                }
            }else{
                $table.='<div class="row">
                    <div class="form-group col-6">
                        <label for="client_labor">Labour:</label>
                        <input type="text" class="form-control form-control-sm" id="client_labor" name="client_labor" value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_paint">Paint:</label>
                        <input type="text" class="form-control form-control-sm" id="client_paint" name="client_paint" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_strip">Strip:</label>
                        <input type="text" class="form-control form-control-sm" id="client_strip" name="client_strip" value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_frame">Frame:</label>
                        <input type="text" class="form-control form-control-sm" id="client_frame" name="client_frame" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_sundries">Sundries:</label>
                        <input type="text" class="form-control form-control-sm" id="client_sundries" name="client_sundries" value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_paint_supplies form-control-sm">Paint Supplies:</label>
                        <input type="text" class="form-control" id="client_paint_supplies" name="client_paint_supplies" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_vat">VAT:</label>
                        <input type="text" class="form-control form-control-sm" id="client_vat" name="client_vat" value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_covid">COVID - 19</label>
                        <input type="text" class="form-control form-control-sm" id="client_covid" name="client_covid" value="350.00">
                    </div>
                </div>
                ';
            
            

}
$table.='<div class="form-group">
<input type="submit" class="btn btn-primary btn-sm float-right" value="Edit Rates">
</div>
</div>
</form>';
return $table;
}



#[ CURRENT LOADED UPDATES ]
public function final_stage_save_wheel_alignment( Request $request){
 
    $id            = $request->wheelAlignmentDivFormRef;   
    $date          = $request->wheelAlignmentDivFormDate;
    $time          = $request->wheelAlignmentDivFormDateTm;
    $intial_1      = $request->CSwInitialLeft;
    $intial_2      = $request->CSwInitialRight;
    $intial_3      = $request->CMwInitialLeft;
    $intial_4      = $request->CMwInitialRight;
    $intial_5      = $request->TwInitialLeft;
    $intial_6      = $request->TwInitialRight;
    $intial_7      = $request->CSrInitialLeft;
    $intial_8      = 0.00;
    $intial_9      = $request->CMrInitialLeft;
    $intial_10     = $request->CMrInitialRight;
    $intial_11     = $request->TrInitialLeft;
    $intial_12     = $request->TrInitialRight;
    $intial_13     = $request->SAIInitialLeft;
    $intial_14     = $request->SAIInitialRight;
    $intial_15     = $request->IAInitialLeft;
    $intial_16     = $request->IAInitialRight;
    $intial_17     = $request->TOTInitialLeft;
    $intial_18     = $request->TOTInitialRight;
    $intial_19     = $request->MTInitialLeft;
    $intial_20     = $request->MTInitialRight;
    $intial_21     = $request->TCCInitialLeft;
    $intial_22     = $request->TCCInitialRight;
    $intial_23     = $request->SBInitialLeft;
    $intial_24     = $request->SBInitialRight;
    $intial_25     = $request->TDInitialLeft;
    $intial_26     = $request->TDInitialRight;
    $intial_27     = $request->FRInitialLeft;
    $intial_28     = $request->FRInitialRight;
    $intial_29     = $request->RRInitialLeft;
    $intial_30     = $request->RRInitialRight;
    



    $Specifications_1 = $request->CSwInitialMinleft;
    $Specifications_2 = $request->CSwInitialMinRight;
    $Specifications_3 = $request->CMwInitialMinleft;
    $Specifications_4 = $request->CMwInitialMinRight;
    $Specifications_5 = $request->TwInitialMinleft;
    $Specifications_6 = $request->TwInitialMinRight;
    $Specifications_7 = $request->CSrInitialLeft;
    $Specifications_8 = 0.00;
    //$Specifications_9 = $request->CMrwInitialMinleft;
    $Specifications_9 = '';
    $Specifications_10= $request->CMrInitialMinRight;
    $Specifications_11= $request->TrInitialMinleft;
    $Specifications_12= $request->TrInitialMinRight;

    $Specifications_1max = $request->CSwInitialMaxleft;
    $Specifications_2max = $request->CSwInitialMaxRight;
    $Specifications_3max = $request->CMwInitialMaxleft;
    $Specifications_4max = $request->CMwInitialMaxRight;
    $Specifications_5max = $request->TwInitialMaxleft;
    $Specifications_6max = $request->TwInitialMaxRight;
    $Specifications_7max = '';
    $Specifications_8max = 0.00;
    $Specifications_9max = $request->CMrInitialMaxleft;
    $Specifications_10max= $request->CMrInitialMaxRight;
    $Specifications_11max= $request->TrInitialMaxleft;
    $Specifications_12max= $request->TrInitialMaxRight;

    $Specifications_13 = $request->SAIInitialMinleft;
    $Specifications_14 = $request->SAIInitialMinRight;
    $Specifications_15 = $request->SAIInitialMaxleft;
    $Specifications_16 = $request->SAIInitialMaxRight;
    $Specifications_17 = $request->IAInitialMinleft;
    $Specifications_18 = $request->IAInitialMinRight;
    $Specifications_19 = '';

    $Specifications_20 = $request->IAInitialMaxRight;
    $Specifications_21= $request->TOTInitialMinleft;
    $Specifications_22= $request->TOTInitialMinRight;
    $Specifications_23= $request->TOTInitialMaxleft;

    $Specifications_24 = $request->TOTInitialMaxRight;
    $Specifications_25 = $request->MTInitialMinleft;
    $Specifications_26 = $request->MTInitialMinRight;
    $Specifications_27 = $request->MTInitialMaxleft;
    $Specifications_28 = $request->MTInitialMaxRight;
    $Specifications_29 = $request->TCCInitialMinleft;
    $Specifications_30 = $request->TCCInitialMinRight;
    $Specifications_31 = $request->TCCInitialMaxleft;
    $Specifications_32 = $request->TCCInitialMaxRight;
    $Specifications_33= $request->SBInitialMinleft;
    $Specifications_34= $request->SBInitialMinRight;
    $Specifications_35= $request->SBInitialMaxleft;

    $Specifications_36= $request->SBInitialMaxRight;
    $Specifications_37= $request->TDInitialMinleft;
    $Specifications_38= $request->TDInitialMinRight;
    $Specifications_39= $request->TDInitialMaxleft;

    $Specifications_40 = $request->TDInitialMaxRight;
    $Specifications_41 = $request->FRInitialMinleft;
    $Specifications_42 = $request->FRInitialMinRight;
    $Specifications_43 = $request->FRInitialMaxleft;
    $Specifications_44 = $request->FRInitialMaxRight;
    $Specifications_45 = $request->RRInitialMinleft;
    $Specifications_46 = $request->RRInitialMinRight;
    $Specifications_47 = $request->RRInitialMaxleft;
    $Specifications_48 = $request->RRInitialMaxRight;
    


    $final_1       = $request->CSwInitialFinleft;
    $final_2       = $request->CSwInitialFinRight;
    $final_3       = $request->CMwInitialFinleft;
    $final_4       = $request->CMwInitialFinRight;
    $final_5       = $request->TwInitialFinleft;
    $final_6       = $request->TwInitialFinRight;
    $final_7       = $request->CSrInitialMaxleft;
    $final_8       = 0.00;
    $final_9       = $request->CMrInitialFinleft;
    $final_10      = $request->CMrInitialFinRight;
    $final_11      = $request->TrInitialFinleft;
    $final_12      = $request->TrInitialFinRight;
    $final_13      = $request->SAIInitialFinleft;
    $final_14      = $request->SAIInitialFinRight;
    $final_15      = $request->IAInitialFinleft;
    $final_16      = $request->IAInitialFinRight;
    $final_17      = $request->TOTInitialFinleft;
    $final_18      = $request->TOTInitialFinRight;
    $final_19      = $request->MTInitialFinleft;
    $final_20      = $request->MTInitialFinRight;
    $final_21      = $request->TCCInitialFinleft;
    $final_22      = $request->TCCInitialFinRight;
    $final_23      = $request->SBInitialFinleft;
    $final_24      = $request->SBInitialFinRight;
    $final_25      = $request->TDInitialFinleft;
    $final_26      = $request->TDInitialFinRight;
    $final_27      = $request->FRInitialFinleft;
    $final_28      = $request->FRInitialFinRight;
    $final_29      = $request->RRInitialFinleft;
    $final_30      = $request->RRInitialFinRight;
    $odometer      = $request->wheelAlignmentDivFormOdo;
    $ocomments     = $request->wheelAlignmentDivFormTa;
    $frame         = $request->FAInitialFinRight;
  

$result = DB::table('alignment_report_initial')->where('Key_Ref','=',$id)->get();

$query2 = '';
$save = '';
if( count( $result ) > 0){

$query2 = "UPDATE alignment_report_initial SET date='$date', initial_1='$intial_1',initial_2='$intial_2',"
    . "initial_3='$intial_3',"
    . "initial_4='$intial_4',"
    . "initial_5='$intial_5',"
    . "initial_6='$intial_6',"
    . "initial_7='$intial_7',"
    . "initial_8='$intial_8',"
    . "initial_9='$intial_9',"
    . "initial_10='$intial_10',"
    . "initial_11='$intial_11',"
    . "initial_12='$intial_12',"
    . "initial_13='$intial_13',"
    . "initial_14='$intial_14',"
    . "initial_15='$intial_15',"
    . "initial_16='$intial_16',"
    . "initial_17='$intial_17',"
    . "initial_18='$intial_18',"
    . "initial_19='$intial_19',"
    . "initial_20='$intial_20',"
    . "initial_21='$intial_21',"
    . "initial_22='$intial_22',"
    . "initial_23='$intial_23',"
    . "initial_24='$intial_24',"
    . "initial_25='$intial_25',"
    . "initial_26='$intial_26',"
    . "initial_27='$intial_27',"
    . "initial_28='$intial_28',"
    . "initial_29='$intial_29',"
    . "initial_30='$intial_30',"
    . ""
    . "Specifications_1='$Specifications_1',"
    . "Specifications_2='$Specifications_2',"
    . "Specifications_3='$Specifications_3',"
    . "Specifications_4='$Specifications_4',"
    . "Specifications_5='$Specifications_5',"
    . "Specifications_6='$Specifications_6',"
    . "Specifications_7='$Specifications_7',"
    . "Specifications_8='$Specifications_8',"
    . "Specifications_9='$Specifications_9',"
    . "Specifications_10='$Specifications_10',"
    . "Specifications_11='$Specifications_11',"
    . "Specifications_12='$Specifications_12',"
    . ""
    . "Specifications_1max='$Specifications_1max',"
    . "Specifications_2max='$Specifications_2max',"
    . "Specifications_3max='$Specifications_3max',"
    . "Specifications_4max='$Specifications_4max',"
    . "Specifications_5max='$Specifications_5max',"
    . "Specifications_6max='$Specifications_6max',"
    . "Specifications_7max='',"
    . "Specifications_8max='$Specifications_8max',"
    . "Specifications_9max='$Specifications_9max',"
    . "Specifications_10max='$Specifications_10max',"
    . "Specifications_11max='$Specifications_11max',"
    . "Specifications_12max='$Specifications_12max',"
    . ""
    . "Specifications_13='$Specifications_13',"
    . "Specifications_14='$Specifications_14',"
    . "Specifications_15='$Specifications_15',"
    . "Specifications_16='$Specifications_16',"
    . "Specifications_17='$Specifications_17',"
    . "Specifications_18='$Specifications_18',"
    . "Specifications_19='',"
    . "Specifications_20='$Specifications_20',"
    . "Specifications_21='$Specifications_21',"
    . "Specifications_22='$Specifications_22',"
    . "Specifications_23='$Specifications_23',"
    . "Specifications_24='$Specifications_24',"
    . "Specifications_25='$Specifications_25',"
    . "Specifications_26='$Specifications_26',"
    . "Specifications_27='$Specifications_27',"
    . "Specifications_28='$Specifications_28',"
    . "Specifications_29='$Specifications_29',"
    . "Specifications_30='$Specifications_30',"
    . "Specifications_31='$Specifications_31',"
    . "Specifications_32='$Specifications_32',"
    . "Specifications_33='$Specifications_33',"
    . "Specifications_34='$Specifications_34',"
    . "Specifications_35='$Specifications_35',"
    . "Specifications_36='$Specifications_36',"
    . "Specifications_37='$Specifications_37',"
    . "Specifications_38='$Specifications_38',"
    . "Specifications_39='$Specifications_39',"
    . "Specifications_40='$Specifications_40',"
    . "Specifications_41='$Specifications_41',"
    . "Specifications_42='$Specifications_42',"
    . "Specifications_43='$Specifications_43',"
    . "Specifications_44='$Specifications_44',"
    . "Specifications_45='$Specifications_45',"
    . "Specifications_46='$Specifications_46',"
    . "Specifications_47='$Specifications_47',"
    . "Specifications_48='$Specifications_48',"
    . "final_1='$final_1',"
    . "final_2='$final_2',"
    . "final_3='$final_3',"
    . "final_4='$final_4',"
    . "final_5='$final_5',"
    . "final_6='$final_6',"
    . "final_7='$final_7',"
    . "final_8='$final_8',"
    . "final_9='$final_9',"
    . "final_10='$final_10',"
    . "final_11='$final_11',"
    . "final_12='$final_12',"
    . "final_13='$final_13',"
    . "final_14='$final_14',"
    . "final_15='$final_15',"
    . "final_16='$final_16',"
    . "final_17='$final_17',"
    . "final_18='$final_18',"
    . "final_19='$final_19',"
    . "final_20='$final_20',"
    . "final_21='$final_21',"
    . "final_22='$final_22',"
    . "final_23='$final_23',"
    . "final_24='$final_24',"
    . "final_25='$final_25',"
    . "final_26='$final_26',"
    . "final_27='$final_27',"
    . "final_27='$final_27',"
    . "final_28='$final_28',"
    . "final_29='$final_29',"
    . "final_30='$final_30',"
    . "odometer='$odometer',"
    . "frame='$frame',"
    . "comments='$ocomments',"
    . "time='$time'"
    . " WHERE Key_Ref='$id'";

     $save = DB::update($query2);


    }else if( count( $result ) == 0){

    $query2 = "INSERT INTO `alignment_report_initial`"
            . "(`initial_1`,"
            . " `initial_2`, "
            . "`initial_3`, "
            . "`initial_4`, "
            . "`initial_5`, "
            . "`initial_6`,"
            . " `initial_7`,"
            . " `initial_8`, "
            . "`initial_9`, "
            . "`initial_10`,`date`, "
            . "`time`, `Key_Ref`, "
            . "`Specifications_1`,"
            . " `Specifications_2`, "
            . "`Specifications_3`, "
            . "`Specifications_4`, "
            . "`Specifications_5`,"
            . " `Specifications_6`,"
            . " `final_1`, `final_2`,"
            . " `final_3`, `final_4`,"
            . " `final_5`, `final_6`, "
            . "`initial_11`, `initial_12`, "
            . "`initial_13`, "
            . "`initial_14`, `initial_15`, "
            . "`initial_16`, `initial_17`,"
            . " `initial_18`, "
            . "`initial_19`, `initial_20`, "
            . "`initial_21`, `initial_22`,"
            . " `initial_23`,"
            . " `initial_24`, `initial_25`,"
            . " `initial_26`, `initial_27`,"
            . " `initial_28`,"
            . " `initial_29`, `initial_30`, "
            . "`Specifications_7`, `Specifications_8`,"
            . " `Specifications_9`, `Specifications_10`, "
            . "`Specifications_11`,"
            . " `Specifications_12`, `Specifications_13`,"
            . " `Specifications_14`, `Specifications_15`, "
            . "`Specifications_16`, `Specifications_17`, "
            . "`Specifications_18`, `Specifications_19`,"
            . " `Specifications_20`, `Specifications_21`, "
            . "`Specifications_22`, `Specifications_23`, "
            . "`Specifications_24`, `Specifications_25`, "
            . "`Specifications_26`, `Specifications_27`,"
            . " `Specifications_28`, `Specifications_29`,"
            . " `Specifications_30`, `Specifications_31`,"
            . " `Specifications_32`, `Specifications_33`, "
            . "`Specifications_34`, `Specifications_35`, "
            . "`Specifications_36`, `Specifications_37`, "
            . "`Specifications_38`, `Specifications_39`, "
            . "`Specifications_40`, `Specifications_41`,"
            . " `Specifications_42`, `Specifications_43`,"
            . " `Specifications_44`, `Specifications_45`, "
            . "`Specifications_46`, `Specifications_47`, "
            . "`Specifications_48`, `Specifications_1max`, "
            . "`Specifications_2max`, `Specifications_3max`, "
            . "`Specifications_4max`, `Specifications_5max`,"
            . " `Specifications_6max`, `Specifications_7max`, "
            . "`Specifications_8max`, `Specifications_9max`, "
            . "`Specifications_10max`, `Specifications_11max`,"
            . " `Specifications_12max`, `final_7`, `final_8`, "
            . "`final_9`, `final_10`, "
            . "`final_11`, `final_12`, "
            . "`final_13`, `final_14`, "
            . "`final_15`, `final_16`, "
            . "`final_17`, `final_18`, "
            . "`final_19`, `final_20`, "
            . "`final_21`, `final_22`, "
            . "`final_23`, `final_24`, "
            . "`final_25`, `final_26`, "
            . "`final_27`, `final_28`,"
            . " `final_29`, `final_30`,"
            . " `odometer`, `frame`, `comments`) "
            . "VALUES ('$intial_1','$intial_2','$intial_3','$intial_4','$intial_5','$intial_6',"
            . "'$intial_7','$intial_8','$intial_9','$intial_10','$date','$time','$id','$Specifications_1',"
            . "'$Specifications_2','$Specifications_3','$Specifications_4',"
            . "'$Specifications_5','$Specifications_6','$final_1','$final_2','$final_3','$final_4',"
            . "'$final_5','$final_6','$intial_11','$intial_12','$intial_13','$intial_14','$intial_15',"
            . "'$intial_16','$intial_17','$intial_18','$intial_19','$intial_20','$intial_21','$intial_22',"
            . "'$intial_23','$intial_24','$intial_25','$intial_26','$intial_27','$intial_28','$intial_29',"
            . "'$intial_30','$Specifications_7','$Specifications_8','$Specifications_9','$Specifications_10',"
            . "'$Specifications_11','$Specifications_12','$Specifications_13','$Specifications_14','$Specifications_15',"
            . "'$Specifications_16','$Specifications_17','$Specifications_18','$Specifications_19','$Specifications_20',"
            . "'$Specifications_21','$Specifications_22','$Specifications_23','$Specifications_24','$Specifications_25',"
            . "'$Specifications_26','$Specifications_27','$Specifications_28','$Specifications_29','$Specifications_30',"
            . "'$Specifications_31','$Specifications_32','$Specifications_33','$Specifications_34','$Specifications_35',"
            . "'$Specifications_36','$Specifications_37','$Specifications_38','$Specifications_39','$Specifications_40',"
            . "'$Specifications_41','$Specifications_42','$Specifications_43','$Specifications_44','$Specifications_45',"
            . "'$Specifications_46','$Specifications_47','$Specifications_48','$Specifications_1max','$Specifications_2max',"
            . "'$Specifications_3max','$Specifications_4max','$Specifications_5max','$Specifications_6max','$Specifications_7max',"
            . "'$Specifications_8max','$Specifications_9max','$Specifications_10max','$Specifications_11max','$Specifications_12max',"
            . "'$final_7','$final_8','$final_9','$final_10','$final_11','$final_12','$final_13','$final_14','$final_15',"
            . "'$final_16','$final_17','$final_18','$final_19','$final_20','$final_21','$final_22','$final_23','$final_24',"
            . "'$final_25','$final_26','$final_27','$final_28','$final_29','$final_30','$odometer','$frame','$ocomments')";

            $save = DB::insert($query2);


        }


        return back()->with(['message'=>'Wheel Alignment Details Have Been Successfully Saved.']);

      

   }

    #SEND PHOTES
    public function email_photos( Request $request ){
        $real_paths = $request->real_paths; //real_paths
        $email_addr = $request->email_address;

        $mail = new PHPMailer(true);
    
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'mag.accounzi2018@gmail.com';                     // SMTP username
        $mail->Password   = '123coded';                                  // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('photos@motoraccidentgroup.co.za', 'Motor Accident Group');
        $mail->addAddress($email_addr,''); 
        $mail->addReplyTo('info@motoraccidentgroup.co.za', 'Motor Accident Group');              

        // Attachments
        foreach ( $real_paths as $path){
            $mail->addAttachment( $path );
        }

        // Content
        $mail->isHTML(true); 
        $mail->Subject = 'VEHICLE IMAGES';
        $mail->MsgHTML("Please find the vehicle images attached below.<br>Regards<br>Motor Accident Group.");
        $mail->AltBody = '';

        $mail->send();
        
        if( $mail ){
        echo 1;
        }else{
        echo 0;
        }
      }

      # [ 31 MARCH 2021 ]
      # UPDATE THE ADDITIONALS DESCRIPTION
      public function update_additional_description( Request $request ){
          $id = $request->id;
          $description = $request->d;
          $update = DB::table('additional')->where('id',$id)->update(['Description'=>$description ]);
  
          if( $update ){
             echo 1;
          }else{
             echo 0;
          }
  
      }
  
      # [ 31 MARCH 2021 ]
      # UPDATE THE ADDITIONALS OPERATION
      public function update_additional_operation( Request $request ){  
          $id = $request->id;
          $operation = $request->d;
          $update = DB::table('additional')->where('id',$id)->update(['Oper'=>$operation ]);
  
          if( $update ){
             echo 1;
          }else{
             echo 0;
          }

      }
  
  
      # [ 31 MARCH 2021 ]
      # UPDATE THE ADDITIONALS LANDING PRICE
      public function update_additional_landing_price( Request $request ){  
          $id = $request->id;
          $landing_price = $request->d;
          $update = DB::table('additional')->where('id',$id)->update(['Part'=>$landing_price ]);
  
          if( $update ){
             echo 1;
          }else{
             echo 0;
          }
      }
  
      # [ 31 MARCH 2021 ]
      # UPDATE THE ADDITIONALS CHECKBOX LANDING PRICE
      public function update_additional_landing_price_check( Request $request ){  
          $id = $request->dt;
          $check = $request->check;
          $update = DB::table('additional')->where('id',$id)->update(['Checked'=>$check ]);
  
          if( $update ){
             echo 1;
          }else{
             echo 0;
          }
  
      }
  
      # [ 31 MARCH 2021 ]
      # UPDATE THE ADDITIONALS NETT + MARK + UP
      public function update_additional_net_markup( Request $request ){  
          $id = $request->id;
          $markup = $request->d;
          $update = DB::table('additional')->where('id',$id)->update(['MarkUp'=>$markup ]);
  
          if( $update ){
             echo 1;
          }else{
             echo 0;
          }
  
      }
  
      # [ 31 MARCH 2021 ]
      # UPDATE THE ADDITIONALS MARK-UP ONLY
      public function update_additional_net_markup_only( Request $request ){
          $markup = "";
          $id = $request->id;
          $markup2 = $request->d;
          if( $markup2 > 0 ){
             //return "GREATER THAN ZERO";
             $update = DB::table('additional')->where('id',$id)->update(['MarkUp2'=>$markup2,'MarkUp'=>0]);
  
          }else{
             //return "ZERO";
             $update = DB::table('additional')->where('id',$id)->update(['MarkUp2'=>$markup2]);
  
          }
  
          if( $update ){
             echo 1;
          }else{
             echo 0;
          }

      }
  
  
  
      # [ BETTERMENT ]
      public function update_additional_betterment( Request $request ){
          $id = $request->id;
          $betterment = $request->d;
          $update = DB::table('additional')->where('id',$id)->update(['Betterment'=>$betterment ]);
  
          if( $update ){
             echo 1;
          }else{
             echo 0;
          }
  
      }



       ############################################## OUTWORK #####################################
    ## OUTWORK TAB [ 01 MARCH 2021 ]
    public function update_additional_outwork_landing_price( Request $request ){

        //var_dump( $request->id . "   :  " . $request->d ); die;
        $id = $request->id;
        $outwork = $request->d;
        $update = DB::table('additional')->where('id',$id)->update(['Outwork'=>$outwork ]);

        if( $update ){
           echo 1;
        }else{
           echo 0;
        }


    }


    
    ############################################## INHOUSE #####################################
    ## INHOUSE TAB [ 01 MARCH 2021 ]
    public function update_additional_inhouse_landing_price( Request $request ){

        //var_dump( $request->id . "   :  " . $request->d ); die;


        $id = $request->id;
        $inhouse = $request->d;
        $update = DB::table('additional')->where('id',$id)->update(['Inhouse'=>$inhouse ]);

        if( $update ){
           echo 1;
        }else{
           echo 0;
        }


    }


  
    ##############################################  R + R  #####################################
    ## R + R TAB [ 01 MARCH 2021 ]
    public function update_additional_rr_landing_price( Request $request ){

        //var_dump( $request->id . "   :  " . $request->d ); die;


        $id = $request->id;
        $r_r = $request->d;
        $update = DB::table('additional')->where('id',$id)->update(['RandR'=>$r_r ]);

        if( $update ){
           echo 1;
        }else{
           echo 0;
        }


    }



    ##############################################  LABOUR  #####################################
    ## LABOUR TAB [ 01 MARCH 2021 ]
    public function update_additional_labour_landing_price( Request $request ){

        //var_dump( $request->id . "   :  " . $request->d ); die;

        $id = $request->id;
        $labour = $request->d;
        $update = DB::table('additional')->where('id',$id)->update(['Labour'=>$labour ]);

        if( $update ){
           echo 1;
        }else{
           echo 0;
        }


    }




    ##############################################  PAINT  #####################################
    ## PAINT TAB [ 01 MARCH 2021 ]
    public function update_additional_paint_landing_price( Request $request ){

        //var_dump( $request->id . "   :  " . $request->d ); die;

        $id = $request->id;
        $paint = $request->d;
        $update = DB::table('additional')->where('id',$id)->update(['Paint'=>$paint ]);

        if( $update ){
           echo 1;
        }else{
           echo 0;
        }


    }



    # UPDATE THE CLIENT DELATIS
    public function update_final_client_details(Request $request){
    
            $key_ref=$request->ref;
            $name=$request->name_edit;
            $last=$request->lastname_edit;
            $id_no=$request->id_number_edit;
            if(empty($id_no)){
                $id_no='';
            }
            $dob=$request->dob_edit;
            $cell=$request->mobile_edit;
            $email=$request->client_email_edit;
            if(empty($email)){
                $email='';
            }
            $street=$request->street_edit;
            if(empty($street)){
                $street='';
            }
            $suburb=$request->surburb_edit;
            if(empty($suburb)){
                $suburb='';
            }
            $city=$request->city_edit;
            if(empty($city)){
                $city='';
            }
            $estimator=$request->estimator_edit;
            $branch=$request->branch_edit;
   
    
            //#VEHICLE DETAILS
            $reg=$request->registration_edit;
            $vin=$request->vin_number_edit;
            if(empty($vin)){
                $vin=0;
            }
            $engine_no=$request->engine_number_edit;
            if(empty($engine_no)){
                $engine_no='';
            }
            $make=$request->make_edit;
            $model=$request->model_edit;
            $odometer=$request->odometer_edit;
            if(empty($odometer)){
                $odometer='0';
            }
            $color=$request->colour_edit;
            if(empty($color)){
                $color='';
            }
            $year=$request->year_edit;
            if(empty($year)){
                $year='';
            }
            $booking=$request->booking_edit;
            if(empty($booking)){
                $booking='';
            }
            $quote_date=$request->quote_date_edit;
    
    
            //#INSURANCE DETAILS
            $insurace_type=$request->insurance_type_edit;
    
            $insuror=$request->insuror_edit;
            if(empty($insuror)){
                $insuror='';
            }
            $ins_cell=$request->contact_number_edit;
            if(empty($ins_cell)){
                $ins_cell='';
            }
            $ins_email=$request->insurance_email_edit;
            if(empty($ins_email)){
                $ins_email='';
            }
            $claim_no=$request->claim_number_edit;
            if(empty($claim_no)){
                $claim_no='';
            }
            $clerk_ref=$request->clerk_ref_edit;
            if(empty($clerk_ref)){
                $clerk_ref='';
            }
            $assessor=$request->assessor_edit;
            if(empty($assessor)){
                $assessor='';
            }
            $ass_email=$request->assessor_email_edit;
            if(empty($ass_email)){
                $ass_email='';
            }
            $ass_no=$request->assessor_no_edit;
            if(empty($ass_no)){
                $ass_no='';
            }
            $ass_comp=$request->assessor_company_edit;
            if(empty($ass_comp)){
                $ass_comp='';
            }
    
            $date=date('Y-m-d');
            
              //return $id_status;
              $branch_info=DB::table('branch')->where('branch_name','=',$branch)->limit(1)->get();
    
              //return $branch_info->branch_credits;
              foreach($branch_info as $info){
                 $bra_id=$info->id; 
                 $bra_credit=$info->branch_credits;
                 $branch_name=$info->branch_name;
              }
    
    
           $client_details = DB::table('client_details')->where('Key_Ref','=',$key_ref)->update([
                'Fisrt_Name'=>$name,'Last_Name'=>$last,'id_number'=>$id_no,'BirthDate'=>$dob,'Estimator'=>$estimator,'Email'=>$email,'Address_1'=>$street,'Address_2'=>$suburb,'Address_3'=>$city,'Cell_Number'=>$cell,'Vehicle_year'=>$year,'Make'=>$make,'Colour'=>$color,'Model'=>$model,'Reg_No'=>$reg,'Eng_No'=>$engine_no,'date'=>$date,'branch'=>$branch,'Vat_No'=>15,'Chasses_No'=>$vin,'KM'=>$odometer
            ]);
    
           $insurer = DB::table('insurer')->where('Key_Ref','=',$key_ref)->update(
                ['Inserer'=>$insuror,'Phone'=>$ins_cell,'Email'=>$ins_email,'Claim_No'=>$claim_no,'Oder_No'=>$odometer,'Assessor'=>$assessor,'Assessor_Cell'=>$ass_no,'Assessor_Email'=>$ass_email,'Assessor_comp'=>$ass_comp,'Address_1'=>$street,'Address_2'=>$suburb,'Address_3'=>$city,'Cell'=>$cell,'ClerkName'=>$clerk_ref]
            );
    
    
            if( $client_details && $insurer ){
                return 1;
    
            }else{
               return 0;
            }
        
    
    
        }
    

  
  


  













}