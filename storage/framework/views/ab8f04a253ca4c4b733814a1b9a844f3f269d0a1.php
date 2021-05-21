<?php $__env->startSection('content'); ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quoted Quotations.</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-sm table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                        <thead style="font-size:12px;">
                            <tr>
                                
                                <th>Reference</th>
                                <th>D.Capture</th>
                                <th>Client</th>
                                <th width="50px">ID Number</th>
                                <!--<th>DOB</th>-->
                                <th>Phone</th>
                                <th>Email</th>
                                <!--<th>Address</th>
                                <th>Insurance</th>-->
                                <th>Registration</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot style="font-size:12px;">
                            <tr>
                            <th>Reference</th>
                                <th>D.Capture</th>
                                <th>Client</th>
                                <th width="50px">ID Number</th>
                                <!--<th>DOB</th>-->
                                <th>Phone</th>
                                <th>Email</th>
                                <!--<th>Address</th>
                                <th>Insurance</th>-->
                                <th>Registration</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody style="font-size:10px;">
                            <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                       <td><?php echo e($client->Key_Ref); ?></td>
                                       <td><?php echo e($client->Date); ?></td>
                                       <td><?php echo e($client->Fisrt_Name); ?> <?php echo e($client->Last_Name); ?></td>
                                       <td><?php echo e($client->id_number); ?></td>
                                       <!--<td><?php echo e($client->BirthDate); ?></td>-->
                                       <td><?php echo e($client->Cell_number); ?></td>
                                       <td><?php echo e($client->Email); ?></td>
                                       <!--<td><?php echo e($client->Address_1); ?><br><?php echo e($client->Address_2); ?><br><?php echo e($client->Address_3); ?></td>-->
                                       <!--<td><?php echo e($client->Inserer); ?></td>-->
                                       <td><?php echo e($client->Reg_No); ?></td>
                                       <td><?php echo e($client->Make); ?></td>
                                       <td><?php echo e($client->Model); ?></td>
                                       <!--<td><?php echo e($client->status); ?></td>-->
                                       <?php if($client->status==1): ?>
                                            <td><span class="badge" style="background:green;color:white;">Authorized</span></td>
                                         <?php elseif($client->Key_Ref!=''): ?>
                                         <td> <span class="badge"style="background-color:grey;color:white;">Quoted</td>
                                         <?php elseif($client->Key_Ref==''): ?>    
                                         <td> <span class="badge"style="background-color:orange;color:white;">Unquoted</td>
                                         <?php endif; ?>
                                    <td>
                                        <div class="btn-group">
                                            <!--<a class="btn btn-success" href="" title="Open Quotation">
                                                <span class="fa fa-folder-open"></span>
                                            </a>-->
                                            <a class="btn-sm btn-primary" href="/openQuotation/<?php echo e($client->Key_Ref); ?>" style="margin-left:5px;" title="View Quotation">
                                                <span class="fa fa-search"></span>
                                            </a>     
                                                      
                                                 
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>            
                    </table>
                </div>
            </div>
        </div>        
<?php $__env->stopSection(); ?>
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>