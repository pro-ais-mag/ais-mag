<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card-header py-1">
                <h4 class="m-0 font-weight-bold text-primary">Final Costing. - <?php echo e($key); ?></h4>
               
</div>
<?php $__currentLoopData = $neo_client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="row">
    <div class="btn-group">
    
        <a href="/print-final-notation/<?php echo e($client->Key_Ref); ?>" class="btn btn-primary btn-sm" title="Notification Of Diffrence" target="_blank">Notification Of Differance</a>
        <!--<a href="#" class="btn btn-warning btn-sm" title="Alignment" style="margin-left:5px;">W / Alignment</a>-->
        <a href="#" class="btn btn-success btn-sm release_register" title="Released" style="margin-left:5px;">Released Register</a>
        <a href="/print-client-invoice/<?php echo e($client->Key_Ref); ?>" class="btn btn-info btn-sm" title="Invoice To Client" style="margin-left:5px;" target="_blank">Invoice To Client</a>
        <a href="#" class="btn btn-danger btn-sm final_stage_additionals" data-id="<?php echo e($client->Key_Ref); ?>" title="Additionals" style="margin-left:5px;">Additionals</a>
        <!--<a href="#" class="btn btn-danger btn-sm" title="Sign Off" style="margin-left:5px;">Sign Off</a>-->
        
        <button class="btn btn-warning btn-sm dropdown-toggle btn-float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-dropup-auto="false" style="margin-left:5px;">
                                    Print Previews
        </button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="/print-final-costing-total/<?php echo e($client->Key_Ref); ?>" target="_blank">No Water Mark</a>
            <a class="dropdown-item" href="/print-final-costing-all-figure/<?php echo e($client->Key_Ref); ?>" target="_blank">All in Figure</a>
            <a class="dropdown-item" href="/print-final-costing-no-extra/<?php echo e($client->Key_Ref); ?>" target="_blank">No Extra</a>
            <a class="dropdown-item" href="/print-time-sheet/<?php echo e($client->Key_Ref); ?>" target="_blank">Time Sheet</a>
        </div>                           

        <div class="dropdown mr-1">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left:5px;">
      View More
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
      <a class="dropdown-item rfc_modals" data-id="<?php echo e($client->Key_Ref); ?>" href="#">RFC</a>
      <a class="dropdown-item purchase_modals" data-id="<?php echo e($client->Key_Ref); ?>" href="#">POP</a>
      <a class="dropdown-item statements_modals" data-id="<?php echo e($client->Key_Ref); ?>" href="#">Statement</a>
      <a class="dropdown-item" href="/print-consumables/<?php echo e($client->Key_Ref); ?>" target="_blank">Consumables</a>
      <a class="dropdown-item" href="/print-itemized/<?php echo e($client->Key_Ref); ?>" target="_blank">Itemized Consumables</a>
    </div>
    
  </div>
        
        <?php if($check_signed->isEmpty() && $sign==0): ?>
        <div>
        <div class="form-check md" style="margin-left:10px;">
            <input class="form-check-input signed" type="checkbox" id="signed" name="signed" data-id="<?php echo e($client->Key_Ref); ?>" disabled>
            <label class="form-check-label" for="signed">
            Signed
            </label>
        </div>
        </div>
        <?php elseif(!$check_signed->isEmpty() && $sign==0): ?>
        <div>
        <div class="form-check md" style="margin-left:10px;">
            <input class="form-check-input signed" type="checkbox" id="signed" name="signed" data-id="<?php echo e($client->Key_Ref); ?>" checked='true' disabled>
            <label class="form-check-label" for="signed">
            Signed
            </label>
        </div>
        </div>
        <?php elseif($check_signed->isEmpty() && $sign==1): ?>
        <div>
        <div class="form-check md" style="margin-left:10px;">
            <input class="form-check-input signed" type="checkbox" id="signed" name="signed" data-id="<?php echo e($client->Key_Ref); ?>">
            <label class="form-check-label" for="signed">
            Signed
            </label>
        </div>
        </div>
        <?php elseif(!$check_signed->isEmpty() && $sign==1): ?>
        <div>
        <div class="form-check md" style="margin-left:10px;">
            <input class="form-check-input signed" type="checkbox" id="signed" name="signed" data-id="<?php echo e($client->Key_Ref); ?>" checked>
            <label class="form-check-label" for="signed">
            Signed
            </label>
        </div>
        </div>
        <?php endif; ?>

        <?php if($check_closed->isEmpty() && $close==0): ?>
        <div>
        <div class="form-check md" style="margin-left:10px;">
            <input class="form-check-input closed" type="checkbox" id="closed" name="closed" data-id="<?php echo e($client->Key_Ref); ?>" disabled>
            <label class="form-check-label" for="close">
            Close Record
            </label>
        </div>
        </div>
        <?php elseif($check_closed->isEmpty() && $close==1): ?>
        <div>
        <div class="form-check md" style="margin-left:10px;">
            <input class="form-check-input closed" type="checkbox" id="closed" name="closed" data-id="<?php echo e($client->Key_Ref); ?>">
            <label class="form-check-label" for="close">
            Close Record
            </label>
        </div>
        </div>
        <?php elseif(!$check_closed->isEmpty() && $close==0): ?>
        <div>
        <div class="form-check md" style="margin-left:10px;">
            <input class="form-check-input closed" type="checkbox" id="closed" name="closed" data-id="<?php echo e($client->Key_Ref); ?>" checked='true' disabled>
            <label class="form-check-label" for="closed">
            Close Record
            </label>
        </div>
        </div>
        <?php elseif(!$check_closed->isEmpty() && $close==1): ?>
        <div>
        <div class="form-check md" style="margin-left:10px;">
            <input class="form-check-input closed" type="checkbox" id="closed" name="closed" data-id="<?php echo e($client->Key_Ref); ?>" checked="true">
            <label class="form-check-label" for="closed">
            Close Record
            </label>
        </div>
        </div>
        <?php endif; ?>        
    </div>    
</div><br>
<div class="row" style="margin-bottom:10px;">

  <!--- # COMMENT OUT
  <a href="#" class="btn btn-dark btn-sm final_notes" data-id="<?php echo e($client->Key_Ref); ?>">Notes</a>
  <a href="#" class="btn btn-dark btn-sm final_docs" data-id="<?php echo e($client->Key_Ref); ?>" style="margin-left:10px;">Documents</a>
  <a href="#" class="btn btn-dark btn-sm final_update_client" data-id="<?php echo e($client->Key_Ref); ?>" style="margin-left:10px;">Client Details</a>
  <a href="#" class="btn btn-dark btn-sm final_wheel_alignment" data-id="<?php echo e($client->Key_Ref); ?>" style="margin-left:10px;">Wheel Alignment</a>
  <a href="#" class="btn btn-dark btn-sm final_photos" data-id="<?php echo e($client->Key_Ref); ?>" style="margin-left:10px;">Photos</a>
  <a href="#" class="btn btn-dark btn-sm final_ordering" data-id="<?php echo e($client->Key_Ref); ?>" style="margin-left:10px;">Ordering</a>
  --->

  <!-- #ADDED THE BACK BUTTON. FOR SIMPPLE REDIRECTION -->
  <a href="/final-stage" class="btn btn-primary btn-sm">Back</a>  
  <a href="#" class="btn btn-dark btn-sm final_notes" data-id="<?php echo e($client->Key_Ref); ?>" style="margin-left:10px;">Notes</a>
  <a href="#" class="btn btn-dark btn-sm final_docs" data-id="<?php echo e($client->Key_Ref); ?>" style="margin-left:10px;">Documents</a>
  <a href="#" class="btn btn-dark btn-sm final_update_client" data-id="<?php echo e($client->Key_Ref); ?>" style="margin-left:10px;">Client Details</a>
  <a href="#" class="btn btn-dark btn-sm final_wheel_alignment" data-id="<?php echo e($client->Key_Ref); ?>" style="margin-left:10px;">Wheel Alignment</a>
  <a href="#" class="btn btn-dark btn-sm final_photos" data-id="<?php echo e($client->Key_Ref); ?>" style="margin-left:10px;">Photos</a>
  <a href="#" class="btn btn-dark btn-sm final_ordering" data-id="<?php echo e($client->Key_Ref); ?>" style="margin-left:10px;">Ordering</a>


  
</div>
<div class="row">
    <div class="form-group">
    
    <div class="input-group sm" id="dob_span">
     <div class="input-group-prepend">
      <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Repairer</span>
     </div>
       <input type="text" name="repairer" id="repairer" class="form-control form-control-sm font-sm"  aria-describedby="basic-addon1"  style="font-size:10px;" value="Motor Accident Group">
     </div>
    </div>
    <div class="form-group" style="margin-left:20px;">
    <div class="input-group sm" id="dob_span">
     <div class="input-group-prepend">
      <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Client</span>
     </div>
       <input type="text" name="name_last" id="name_last" class="form-control form-control-sm font-sm"  aria-describedby="basic-addon1" value="<?php echo e($client->Fisrt_Name); ?> <?php echo e($client->Last_Name); ?>" style="font-size:10px;width:350px;">
     </div>
    </div>

    <div class="form-group" style="margin-left:20px;">
    <div class="input-group sm" id="dob_span">
     <div class="input-group-prepend">
      <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Reg No</span>
     </div>
       <input type="text" name="reg" id="reg" class="form-control form-control-sm font-sm"  aria-describedby="basic-addon1" value="<?php echo e($client->Reg_NO); ?>"  style="font-size:10px;">
     </div>
    </div>

    <div class="form-group" style="margin-left:20px;">
    <div class="input-group sm" id="dob_span">
     <div class="input-group-prepend">
      <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Vehicle</span>
     </div>
       <input type="text" name="veh" id="veh" class="form-control form-control-sm font-sm"  aria-describedby="basic-addon1" value="<?php echo e($client->Model); ?>" style="font-size:10px;">
     </div>
    </div>
</div><br>
<div class="row" style="margin-top:-25px;margin-bottom:-25px;">
<div class="form-group">
<div class="input-group sm" id="dob_span">
     <div class="input-group-prepend">
      <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Assessor</span>
     </div>
       <input type="text" name="assessed" id="assessed" class="form-control form-control-sm font-sm"  aria-describedby="basic-addon1" value="<?php echo e($client->Assessor); ?>" style="font-size:10px;">
     </div>
</div>

    <div class="form-group" style="margin-left:20px;">
    <div class="input-group sm" id="dob_span">
     <div class="input-group-prepend">
      <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Claim No</span>
     </div>
       <input type="text" name="claim" id="claim" class="form-control form-control-sm font-sm"  aria-describedby="basic-addon1" value="<?php echo e($client->Claim_NO); ?>" style="font-size:10px;">
     </div>
    </div>

    <div class="form-group" style="margin-left:20px;">
    <div class="input-group sm" id="dob_span">
     <div class="input-group-prepend">
      <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Ref No</span>
     </div>
       <input type="text" name="ref" id="ref" class="form-control form-control-sm font-sm"  aria-describedby="basic-addon1" value="<?php echo e($client->Key_Ref); ?>" style="font-size:10px;">
     </div>
    </div>
    
    <!--Start-->
    <div class="form-group" style="margin-left:20px;">
    <div class="input-group sm" id="dob_span">
     <div class="input-group-prepend">
      <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Date</span>
     </div>
       <input type="date" name="final_date" id="final_date" style="font-size:10px;" class="form-control form-control-sm font-sm"  aria-describedby="basic-addon1">
     </div>
    </div>                        
    <!--End-->
</div>
<!--End of-->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<br>
<table class="table table-dark table-sm table-hover">
    <thead style="font-size:10px;">
                <tr>
                <th>#</th>
                        <th>Description</th>
                        <th>Oper</th>
                        <th colspan="2">Landing Price</th>
                        <th>Nett Mark-Up</th>
                        <th>Mark-Up Only</th>
                        <th>Betterment</th>
                        <th>Saving</th>
                        <th>Additional</th>
                        <th>Quoted Price</th>
                        <th>Actual Price</th>
                </tr>
    </thead>      
        <tbody>

     <?php echo $table;?>
    </tbody>
</table>

<!-- Release Modal-->

<div class="modal fade" role="dialog" id="release_register" name="release_register">
<form id="register-form" method="GET" action="/print-release-register" target="_blank">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-success">
            <h5 class="modal-title" id="lineManagerModalHead" style="color:white;">Release Register</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
            </div>
            <div class="modal-body">
            
            <div class="form-group row">
            <div class="col-sm-12">
            <label for="date1">FROM:</label>    
            <input class="form-control form-control-sm" type="date" id="date1" name="date1" required/>
            </div>
            </div>    

            <div class="form-group row">
            <div class="col-sm-12">
            <label for="date2">TO:</label>    
            <input class="form-control form-control-sm" type="date" id="date2" name="date2" required/>
            </div>    
            </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-sm">Print Register</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>