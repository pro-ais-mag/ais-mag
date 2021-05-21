<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Pre-Booking Alerts</h4>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style="font-size:12px;">
                            <tr>
                                
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Cell No.</th>
                                <th>Email</th>
                                <th>Notes</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody style="font-size:10px;">
                        <?php $count=1;?>
                        <?php $__currentLoopData = $prebooking_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                              <td><?php echo e($count); ?></td>
                              <td><?php echo e($details->Fisrt_Name); ?> <?php echo e($details->Last_Name); ?></td>
                              <td><?php echo e($details->Cell_number); ?></td>
                              <td><?php echo e($details->Email); ?></td>
                              <td><?php echo e($details->comment); ?></td>
                              <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary add_prebooking_notes" href="#" data-id="<?php echo e($details->id); ?>" data-full="<?php echo e($details->Fisrt_Name); ?> <?php echo e($details->Last_Name); ?>" data-contact="<?php echo e($details->Cell_number); ?>" data-email="<?php echo e($details->Email); ?>" data-notes="<?php echo e($details->comment); ?>" title="Add Notes"><span class="fa fa-edit"></span></a> 
                                </div>
                              </td>  
                          </tr>
                        <?php $count++;?>    
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>    
</div>



<?php $__env->stopSection(); ?>                
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>