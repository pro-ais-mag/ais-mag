<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary text-center"><u>Time Sheet : <?php echo e($user); ?> </u></h5>
                <h7 class="m-0 text-danger text-danger text-center" style="margin-top:10px;">Date  :<?php echo e($from); ?> - <?php echo e($to); ?> </h7> 
                <a class="btn btn-secondary float-right btn-sm" href="#" title="Print Timesheet"><span class="fa fa-print"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table">
                        
                            <?php echo $table;?>

                        
                    </div>
                </div>
            </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>