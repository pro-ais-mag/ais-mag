<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Client Rates - <?php echo e($key); ?></h4>
            </div>
            <div class="card-body">
            <form method="GET" action="/client-rate-edit">
                <input type="hidden" id="key" name="key" value="<?php echo e($key); ?>">
                <?php echo e(csrf_field()); ?>

                <?php if($rate_details->count()>0): ?> 
                <?php $__currentLoopData = $rate_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_labor">Labour:</label>
                        <input type="text" class="form-control form-control-sm" id="client_labor" name="client_labor" value="<?php echo e($rate->labour); ?>">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_paint">Paint:</label>
                        <input type="text" class="form-control form-control-sm" id="client_paint" name="client_paint" value="<?php echo e($rate->Paint); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_strip">Strip:</label>
                        <input type="text" class="form-control form-control-sm" id="client_strip" name="client_strip" value="<?php echo e($rate->Strip); ?>">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_frame">Frame:</label>
                        <input type="text" class="form-control form-control-sm" id="client_frame" name="client_frame" value="<?php echo e($rate->Frame); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_sundries">Sundries:</label>
                        <input type="text" class="form-control form-control-sm" id="client_sundries" name="client_sundries" value="<?php echo e($rate->ShopSup); ?>">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_paint_supplies">Paint Supplies:</label>
                        <input type="text" class="form-control form-control-sm" id="client_paint_supplies" name="client_paint_supplies" value="<?php echo e($rate->PaintSup); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_vat">VAT:</label>
                        <input type="text" class="form-control form-control-sm" id="client_vat" name="client_vat" value="<?php echo e($rate->vat); ?>">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_covid">COVID - 19</label>
                        <input type="text" class="form-control form-control-sm" id="client_covid" name="client_covid" value="<?php echo e($rate->covid); ?>">
                    </div>
                </div>
                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <div class="row">
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
                <?php endif; ?>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-sm float-right" value="Edit Rates">
                </div>
            </div>
        </form>
</div>
<?php $__env->stopSection(); ?>                
<?php echo $__env->make('quotations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>