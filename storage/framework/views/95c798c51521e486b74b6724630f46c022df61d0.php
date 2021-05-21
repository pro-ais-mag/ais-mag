<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>

<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Pre Costing Parts.</h4>
                <a href="#" class="btn btn-secondary btn-sm float-right" title="Print Customer Stats" target="_blank"><span class="fa fa-print"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:10px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Reg No.</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Client</th>
                                    <th>Cell No.</th>
                                    <th>Order Placed By</th>
                                    <th>Order Date</th>
                                    <th>Supplier</th>
                                    <th>Supplier Email</th>
                                    <th></th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count=1;?>
                                <?php $__currentLoopData = $precostings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($count); ?></td>
                                    <td><a href="/view-precosting/<?php echo e($pre->Key_Ref); ?>"><?php echo e($pre->Key_Ref); ?></a></td>
                                    <td><?php echo e($pre->Reg_No); ?></td>    
                                    <td><?php echo e($pre->Make); ?></td>                                
                                    <td><?php echo e($pre->Model); ?></td>
                                    <td><?php echo e($pre->Fisrt_Name); ?> <?php echo e($pre->Last_Name); ?></td>
                                    <td><?php echo e($pre->Cell_number); ?></td>
                                    <td><?php echo e($pre->user); ?></td>
                                    <td><?php echo e($pre->date); ?></td>
                                    <td><?php echo e($pre->Supplier); ?></td>
                                    <td><?php echo e($pre->address); ?></td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="/view-precosting/<?php echo e($pre->Key_Ref); ?>" class="btn btn-primary btn-sm" data-id='' data-name='' title="View Client"><span class="fa fa-search"></span></a>
                                        
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