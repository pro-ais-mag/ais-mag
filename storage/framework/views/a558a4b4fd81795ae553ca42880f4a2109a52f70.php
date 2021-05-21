<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Driver Current Locations.</h4>
                
            </div>
            <div class="card-body">
              <div class="row">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Driver Username</th>
                            <th>Current Latitude</th>
                            <th>Current Longitude</th>
                            <th>Current Location</th>
                            <th>Status</th>
                            <th>&nbsp</th>
                        </tr>
                    </thead>
                    <tbody style="font-size:12px;">
                    <?php $count=1;?>
                    <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $driver_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($count); ?></td>
                            <td><?php echo e($driver->use_username); ?></td>
                            <td><?php echo e($driver_info->initiallat); ?></td>
                            <td><?php echo e($driver_info->initiallon); ?></td>
                            <td></td>
                            <?php if($driver_info->status==0): ?>
                            <td style="color:red;"><b>Busy</b></td>
                            <td><a href='#' class="btn btn-danger btn-sm"><span class="fa fa-exclamation-circle new-destination-btn"></span></a></td>
                            <?php else: ?>
                            <td style="color:green;"><b>Availiable For New Destination</b></td>
                            <td><span class="fa fa-plus new-destination-btn"></span></td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                    $count++;?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>    
                <?php echo $map['js']; ?>

                <?php echo $map['html']; ?>

               
                    
              </div>  
            </div>
</div>
<script>
    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>