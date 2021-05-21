<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Employees</h4>
                <a class="btn btn-secondary float-right" data-id="" href="#" title="Print Worksheet"><span class="fa fa-print"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0" style="font-size:10px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Cell No.</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                             <?php $count=1;?>   
                            <tbody>
                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>        
                                  <tr>
                                  <td><?php echo e($count); ?></td>         
                                  <td><?php echo e($emp->use_username); ?></td>
                                  <td><?php echo e($emp->user_email); ?></td>
                                  <td><?php echo e($emp->user_cell); ?></td>
                                  <td><a href="#" class="btn btn-primary btn-sm print_sheet" data-id="<?php echo e($emp->use_username); ?>" title="View Timesheet"><span class="fa fa-search"></span></a></td>
                                </tr>
                                <?php $count++;?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>