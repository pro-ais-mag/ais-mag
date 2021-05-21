<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">

                 <!-- ## ADD THE BACK BUTTON [ 20 MAY 2021 ] -->
                 <a href="javascript:history.go(-1)" class="btn btn-danger btn-sm" title="Back To Previous Location">Back</a>

                <center>
                    <h5 class="font-weight-bold text-primary"><u>Time Sheet : <?php echo e($user); ?> </u></h5> 
                    <h7><b>Date</b> <b  class="text-danger text-danger"> :<?php echo e($from); ?> - <?php echo e($to); ?> </b></h7>
                </center>

                <!--
                <h5 class="m-0 font-weight-bold text-primary text-center"><u>Time Sheet : <?php echo e($user); ?> </u></h5>
                <h7 class="m-0 text-danger text-danger text-center" style="margin-top:10px;"><b>Date  :<?php echo e($from); ?> - <?php echo e($to); ?> </b></h7> 
                 -->

                 <!-- ## ADD THE BACK BUTTON [ 20 MAY 2021 ] -->
                 <a class="btn btn-secondary float-right btn-sm user_timesheet" data-user="<?php echo e($user); ?>" data-from="<?php echo e($from); ?>" data-to="<?php echo e($to); ?>" href="/print-employee-timesheet/<?php echo e($user); ?>/<?php echo e($from); ?>/<?php echo e($to); ?>" target="_blank" title="Print Timesheet"><span class="fa fa-print"></span>Print General Work Timesheet</a>
                
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