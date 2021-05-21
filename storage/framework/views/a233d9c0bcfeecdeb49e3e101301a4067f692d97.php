<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>

<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Labour Analysis</h4>
                <a class="btn btn-secondary float-right" data-id="" href="#" title="Print Worksheet"><span class="fa fa-print"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive table-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reference</th>
                                    <th>Registration</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Year</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php $car_count=1;?>

                            <tbody>
                                  
                                  <?php $__currentLoopData = $car; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>            
                                  <tr>
                                    <td><?php echo e($car_count); ?></td>
                                    <td><?php echo e($vehicle->Key_Ref); ?></td>
                                    <td><?php echo e($vehicle->Reg_No); ?></td>
                                    <td><?php echo e($vehicle->Make); ?></td>
                                    <td><?php echo e($vehicle->Model); ?></td>
                                    <td><?php echo e($vehicle->Vehicle_year); ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="/line-manager-analysis-view/<?php echo e($vehicle->Key_Ref); ?>" class="btn btn-primary btn-sm" title="View Worksheet"><span class="fa fa-search"></span></a> 
                                        </div>
                                    </td>
                                  </tr>               
                                 <?php $car_count++;?>              
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>