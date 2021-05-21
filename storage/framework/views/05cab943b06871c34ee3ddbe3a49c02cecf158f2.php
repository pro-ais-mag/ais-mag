<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Proforma Invoice - <?php echo e($key); ?></h4>
                <a class="btn btn-warning float-right btn-sm storage-modal" data-id="<?php echo e($key); ?>" href="#">Storage Rates</a>
                <div class="form-group col-md-2 float-right">
                  <div>
                  <?php $__currentLoopData = $proforma; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($proform->writeoff==1): ?>
                    <div class="form-check">
                      <input class="form-check-input write_off" data-id="<?php echo e($key); ?>" type="checkbox" id="write_off" name="write_off" checked>
                      <label class="form-check-label" for="write_off">
                        Write Off
                      </label>
                    </div>
                  <?php else: ?>
                  <div class="form-check">
                      <input class="form-check-input write_off" data-id="<?php echo e($key); ?>" type="checkbox" id="write_off" name="write_off">
                      <label class="form-check-label" for="write_off">
                        Write Off
                      </label>
                    </div>
                  <?php endif; ?>  
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="card-sm shadow mb-1 col-4">
                            <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Days.</h6>
                            <form action="/proforma-save" method="POST">
                            <?php echo e(csrf_field()); ?>

                            </div>
                                <div class="card-body">
                                <input type="hidden" name="proforma_id" id="proforma_id" value="<?php echo e($key); ?>">
                                <!--Storage Days-->
                                <div class="input-group sm" id="storage_days">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon" style="height:32px;">Storage Days:</span>
                                </div>
                                    <input type="number" name="storage_days" id="storage_days" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;" required>
                                </div>
                                <!--Admin Days-->
                                <div class="input-group sm" id="admin_days">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Admin Days:</span>
                                </div>
                                    <input type="number" name="admin_days" id="admin_days" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;" required>
                                </div>
                                <!-- Security Days-->
                                <div class="input-group sm" id="security_days">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Security Days:</span>
                                </div>
                                    <input type="number" name="security_days" id="security_days" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;" required>
                                </div>

                                
                            </div>
                    </div>
                    
                    <div class="card-sm shadow mb-1 col-4">
                            <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Towing.</h6>
                            
                        
                            </div>
                                <div class="card-body">
                                <!--Towing Fee-->
                                <div class="input-group sm" id="towing_fee">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Towing Fee R:</span>
                                </div>
                                    <input type="number" name="towing_fee" id="towing_fee" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;" required>
                                </div>
                                <!--Release Fee-->
                                <div class="input-group sm" id="release_fee">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Release Fee R:</span>
                                </div>
                                    <input type="number" name="release_fee" id="release_fee" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;" required>
                                </div>
                                <!--Discount Fee-->
                                <div class="input-group sm" id="discount_fee">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Discount %:</span>
                                </div>
                                    <input type="number" name="discount_fee" id="discount_fee" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;" required>
                                </div>
                            </div>
                    </div>
                    <div class="card-sm shadow mb-1 col-4">
                            <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Payments.</h6>
                            
                        
                            </div>
                                <div class="card-body">
                                
                                <div class="input-group sm" id="paid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Paid?</span>
                                </div>
                                    <select type="paid" name="paid" id="paid" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;" required>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="input-group sm" id="payment_method">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Payment Method:</span>
                                </div>
                                    <select name="payment_method" id="payment_method" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;" required>
                                        <option value="Cash">Cash</option>
                                        <option value="Card">Card</option>
                                        <option value="EFT">EFT</option>
                                    </select>
                                </div>
                                <div class="input-group sm" id="payment_comment">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:215px;">Comment:</span>
                                </div>
                                    <textarea name="payment_comment" id="payment_comment" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;" rows="10"></textarea>
                                </div>
                            </div>
                            
                    </div>
                    
                </div>
                <div class="btn btn-group float-right">
                <input type="submit" name="proforma_save" id="proforma_save" class="btn btn-primary float-right btn-sm" value="Save">
                <?php if(count($proforma)>0){
                echo '<a style="margin-left:10px;" class="btn btn-success btn-sm" title="Print Proforma" target="_blank" href="/print-proforma-invoice/'.$key.'">Print</a>';
                //echo count($proforma);
                }
                ?>
                </div>
                </form>
</div>            

<div class="modal fade" id="storage_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Storage Rates.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/" method="POST">
        <?php echo e(csrf_field()); ?>

          <input type="hidden" name="id_storage" id="id_storage">
            
          <div class="form-group">
          <label for="storage_insurance">Insurance:</label>
            <input type="text" id="storage_insurance" name="storage_insurance" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="amount_storage">Amount/Day:</label>
            <input type="number" id="amount_storage" name="amount_storage" class="form-control form-control-sm">
          </div>
          <div class="form-group form-group-sm">
          <label for="amount_charge">Charge After:</label>
            <input type="number" id="amount_charge" name="amount_charge" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="max_charge">Max Charge:</label>
            <input type="number" id="max_charge" name="max_charge" class="form-control form-control-sm">
          </div>                    
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-warning btn-sm" value="Save">
        </div>
        </form>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('quotations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>