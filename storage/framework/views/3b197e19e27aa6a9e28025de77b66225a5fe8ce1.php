<?php $__env->startSection('maps'); ?>
<!-- Google Maps JS Scripts -->
<script type='text/javascript'>
            var centreGot = false;
</script>
<?php echo $map['js']; ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Driver Current Locations.</h4>
                
            </div>
            <div class="card-body">
               <h5>Map Here:</h5> <?php echo $map['html']; ?>

            </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>