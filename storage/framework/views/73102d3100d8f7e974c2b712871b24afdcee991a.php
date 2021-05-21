<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Customer Care.</h4>
                <form class="form-inline float-right" method="GET" action="/customer-care-archieve">
                    <input type="text" id="archieve_key" name="archieve_key" class="form-control form-control-sm">
                    <input type="submit" class="btn btn-success btn-sm" style="margin-left:5px;"value="Search Archive">
                </form>
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