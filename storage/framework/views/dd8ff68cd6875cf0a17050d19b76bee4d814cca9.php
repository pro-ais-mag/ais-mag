<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Customer Care.</h4>
                
            </div>
            <div class="card-body">
                
                <div class="row">
                <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:10px;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Reg No.</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <!--<th>Estimator</th>
                                    <th>Assessor</th>
                                    <th>Insurer</th>-->
                                    <th>Date</th>
                                    <!--<th>Claim No.</th>
                                    <th>Photos</th>-->
                                    <th>Add Photos</th>
                                    <th>Sec Photos</th>
                                    <th>WIP Photos</th>
                                    <th>FS Photos</th>
                                    <th>Docs</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $table;?>
                                        
                            </tbody>

                        </table>
                    </div>
                    
                </div>
            </div>    
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>