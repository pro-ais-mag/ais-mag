<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>

<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Client Notes - <?php echo e($key); ?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                <form method="POST" action="/client-notes-add" class="form-group col-10">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" id="key" name="key" value="<?php echo e($key); ?>">
                    <div class="form-group col-10">
                    <label for="client_notes">Notes:</label>
                            <textarea id="client_notes" name="client_notes" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="form-group float-right">
                        <div class="btn-group float-right">
                            <input type="submit" class="btn btn-success btn-sm" value="Add Notes" style="margin-right:5px;margin-left:12px;">
                            <a href="/print-client-note/<?php echo e($key); ?>" class="btn btn-primary btn-sm" target="_blank"><span class="fa fa-print">Print Notes.</span></a>
                        </div>
                        </form>
                    </div>    
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-dark" style="font-size:10px;" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Notes</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Added</th> 
                                </tr>
                            </thead>
                            </tbody>
                               <?php $count=1;?> 
                               <?php $__currentLoopData = $client_notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($count); ?></td>
                                    <td><?php echo e($notes->note); ?></td>
                                    <td><?php echo e($notes->date); ?></td>
                                    <td><?php echo e($notes->time); ?></td>
                                    <td><?php echo e($notes->user); ?></td> 
                                </tr>
                                <?php $count++;?> 
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                            </tbody>
                        </table>
                    </div>
                    
                </div><br>
                <div class="row">
                <h2 class="text text-primary" style="text-align:center;"><b>Sent Smses.</b></h2>
                    <table class="table table-stripped table-dark" style="font-size:10px;">
                        <thead style="font-weight:bold;">
                            <tr>
                                <th>#</th>
                                <th>SMS</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $count_sms=1;?>
                        <?php $__currentLoopData = $smses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($count_sms); ?></td>
                                <td><?php echo e($sms->message); ?></td>
                                <td><?php echo e($sms->sent_date); ?></td>
                                <td><?php echo e($sms->sent_time); ?></td>
                                <td><?php echo e($sms->user); ?></td>
                            </tr>
                        <?php $count_sms++;?>    
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
                
            
</div>
<?php $__env->stopSection(); ?>            
<?php echo $__env->make('quotations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>