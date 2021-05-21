<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>

<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Administrator Dashboard.</h4>
            </div><br>
<!--Quotation-->
<!--Graphs -->
  <div class="row">   
<img src="dash/dashboard.png" alt="Dashboard" width="100%" height="800">
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>