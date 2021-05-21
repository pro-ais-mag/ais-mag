<?php $__env->startSection('content'); ?>
    
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>

<div class="card shadow mb-4">
            <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Requesation Board. - <?php echo e($username); ?></h4><br>
                <div class="row">
                    <div class="btn-group float-right"> 
                        <!--<a href="#" style="margin-left:5px;" class="btn btn-secondary btn-sm" title="Add New"><span class="fa fa-plus"></span></a>      -->
                    </div>
                </div>
            </div>
            <div class="card-body">
            <?php echo $ui;?>
            </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>