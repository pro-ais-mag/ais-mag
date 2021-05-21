<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Final Stages.</h4>
               
            </div>
            <div class="card-body">
                
                <div class="row">
                <div class="table-responsive ">
                        <table class="table table-bordered table=sm" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead style="font-size:12px;">
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Cell Number</th>
                                    <th>Registration</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Estimator</th>
                                    <th>Assessor</th>
                                    <th>Insurer</th>
                                    <th>Date</th>
                                    <th>Claim</th>
                                    <!--<th>Photo</th>-->
                                <!--<th>Add. Photos</th>
                                    <th>Sec. Photos</th>
                                    <th>WIP Photos</th>
                                    <th>FS Photos</th>
                                    <th>Notes</th>
                                    <th>Docs</th>-->
                                    <!--<th>Edit</th>-->
                                    <!--<th></th>-->
                                </tr>
                            </thead>
                            <tbody style="font-size:10px;">
                                <?php $i=0;?>    
                                <?php $__currentLoopData = $approved; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $approve): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                                                    
                                    <td><a href="/final-stage-client/<?php echo e($approve->Key_Ref); ?>"><?php echo e($approve->Key_Ref); ?></a></td>
                                    <td><?php echo e($approve->Fisrt_Name); ?></td>
                                    <td><?php echo e($approve->Cell_number); ?></td>
                                    <td><?php echo e($approve->Reg_No); ?></td>
                                    <td style="width:44px;"><?php echo e($approve->Make); ?></td>
                                    <td><?php echo e($approve->Model); ?></td>
                                    <td style="width:44px;"><?php echo e($approve->Estimator); ?></td>
                                    <td><?php echo e($approve->Assessor); ?></td>
                                    <td><?php echo e($approve->Inserer); ?></td>
                                    <td><?php echo e($approve->Date); ?></td>
                                    <td><?php echo e($approve->Claim_NO); ?></td>
                                    <!--<td style="width:44px;"></td>-->
                                    <!--<td style="width:44px;"></td>
                                    <td style="width:44px;"></td>
                                    <td style="width:44px;"></td>
                                    <td style="width:44px;"></td>
                                    <td style="width:44px;"></td>
                                    <td style="width:44px;"></td>-->
                                    <!--<td></td>-->
                                    
                                    <!--<td><button class="btn btn-secondart btn-sm"><span style='font-size:8px' class='fa fa-pencil'></span></button></td>-->
                                    
                                    <!--<td>
                                        <div class="btn-group">
                                        <a href="/final-stage-client/<?php echo e($approve->Key_Ref); ?>" class="btn btn-primary btn-sm" title="Open File Stage."><span class="fa fa-search"></span></a>
                                        
                                        </div>
                                    </td>-->
                                    
                                </tr>    
                                    <?php $i++;?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                
                                
                            </tbody>

                        </table>
                    </div>
                    
                </div>
            </div>    
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>