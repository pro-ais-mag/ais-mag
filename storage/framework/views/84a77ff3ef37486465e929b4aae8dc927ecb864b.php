<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Billing Feature.</h4>
                <a class="btn btn-success btn-sm float-right create_branch" data-id="" href="#" title="Add Branch"><span class="fa fa-plus"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    
                                    <th>No.</th>
                                    <th>Broker</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>VAT No.</th>
                                    <th>Place</th>
                                    <th>Address</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count=1;?>
                               
                              <?php $__currentLoopData = $brokers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $broker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                
                                    <td><?php echo e($count); ?></td>
                                    <td><b><?php echo e($broker->broker); ?></b></td>
                                    <td><?php echo e($broker->contact); ?></td>
                                    <td><?php echo e($broker->email); ?></td>
                                    <td><?php echo e($broker->vat); ?></td>
                                    <td><?php echo e($broker->place); ?></td>
                                    <td><?php echo e($broker->address); ?></td>
                                    <td>
                                    <div class="btn-group">
                                        
                                        <a href="/ais-sla-ratings-edit/<?php echo e($broker->id); ?>" class="btn btn-primary btn-sm" title="Edit SLA Ratings"><span class="fa fa-search"></span></a> 
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
<?php echo $__env->make('administrator', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>