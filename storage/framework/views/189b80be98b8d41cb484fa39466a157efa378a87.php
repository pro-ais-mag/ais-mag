<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Creditors.</h4>
               
            </div>
            <div class="card-body">
                
                <div class="row">
                <div class="table-responsive table-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Supplier Name</th>
                                    <th>Supplier No.</th>
                                    <th>Supplier Fax</th>
                                    <th>Supplier Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $count=1;?> 
                               <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <tr>
                                                                    
                                    <td><?php echo e($count); ?></td>
                                    <td><?php echo e($supplier->sup_name); ?></td>
                                    <td><?php echo e($supplier->sup_phone); ?></td>
                                    <td><?php echo e($supplier->sup_fax); ?></td>
                                    <td><?php echo e($supplier->sup_email); ?></td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="/creditor/<?php echo e($supplier->sup_key); ?>" class="btn btn-primary btn-sm" title="Open Supplier Info."><span class="fa fa-search"></span></a>
                                        
                                        </div>
                                    </td>
                                    
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