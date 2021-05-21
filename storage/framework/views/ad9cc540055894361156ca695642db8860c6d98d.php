<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Assessors.</h4>
                <button class="btn btn-success btn-sm float-right add_assessor">+Add Assessor</button>
                <a href="/printAssessor" class="btn btn-secondary btn-sm float-right" style="margin-right:5px;" title="Print Assessor List"  target="_blank"><span class="fa fa-print"></span></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead style="font-size:12px;">
                            <tr>
                                
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Company</th>
                                <th width="50px">Telephone</th>
                                <th>Cell Number</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot style="font-size:12px;">
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Company</th>
                                <th width="50px">Telephone</th>
                                <th>Cell Number</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody style="font-size:12px;">
                          <?php $__currentLoopData = $assessors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assessor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <tr>
                                <td><?php echo e($assessor->id); ?></td>
                                <td><?php echo e($assessor->Names); ?></td>
                                <td><?php echo e($assessor->Company); ?></td>
                                <td><?php echo e($assessor->Tel); ?></td>
                                <td><?php echo e($assessor->Cell); ?></td>
                                <td><?php echo e($assessor->Email); ?></td>
                                <td>
                                        <div class="btn-group">
                                            <a class="btn btn-primary btn-sm edit-assessor" href="#" title="Edit Assessors" data-id="<?php echo e($assessor->id); ?>" data-name="<?php echo e($assessor->Names); ?>" data-company="<?php echo e($assessor->Company); ?>" data-tell="<?php echo e($assessor->Tel); ?>" data-cell="<?php echo e($assessor->Cell); ?>" data-email="<?php echo e($assessor->Email); ?>" > 
                                                <span class="fa fa-user-edit"></span>
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="/deleteAssessor/<?php echo e($assessor->id); ?>" style="margin-left:5px;" title="Delete Assessors">
                                                <span class="fa fa-user-slash"></span>
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

 <!--Select Truck Model-->
  
   <div class="modal fade" id="AssessorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;text-align:center;">Edit Assessor.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <input type="hidden" name="assessor_id" id="assessor_id">
           <div class="form-group"> 
            <label for="assessor_fullname">Full Name</label>
                <input type="text" id="assessor_fullname" name="assessor_fullname" class="form-control">
           </div>     
           <div class="form-group">
            <label for="assessor_company">Company</label>
                <input type="text" id="assessor_company" name="assessor_company" class="form-control">   
           </div>
           <div class="form-group">
            <label for="assessor_tell">Tellphone</label>
                <input type="text" id="assessor_tell" name="assessor_tell" class="form-control">
           </div>
           <div class="form-group"> 
            <label for="assessor_cell">Cell Number</label>
                <input type="text" id="assessor_cell" name="assessor_cell" class="form-control">
           </div>
           <div class="form-group">
            <label for="assessor_email">Email</label>
                <input type="text" id="assessor_email" name="assessor_email" class="form-control">
           </div>                   
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary editassessor" href="#" data-dismiss="modal">Proceed</a>
        </div>
      </div>
    </div>
  </div>              

<!--Create Assessor-->

<div class="modal fade" id="AssessorAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;text-align:center;">Create Assessor.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <input type="hidden" name="assessor_id" id="assessor_id">
           <div class="form-group"> 
           <form id="create_assessor"  method="POST" action="/createAssessor">
            <?php echo e(csrf_field()); ?> 
            <label for="assessor_create_fullname">Full Name</label>
                <input type="text" id="assessor_create_fullname" name="assessor_create_fullname" class="form-control form-control-sm">
           </div>     
           <div class="form-group">
            <label for="assessor_create_company">Company</label>
                <input type="text" id="assessor_create_company" name="assessor_create_company" class="form-control form-control-sm">   
           </div>
           <div class="form-group">
            <label for="assessor_create_tell">Tellphone</label>
                <input type="text" id="assessor_create_tell" name="assessor_create_tell" class="form-control form-control-sm">
           </div>
           <div class="form-group"> 
            <label for="assessor_create_cell">Cell Number</label>
                <input type="text" id="assessor_create_cell" name="assessor_create_cell" class="form-control form-control-sm">
           </div>
           <div class="form-group">
            <label for="assessor_create_email">Email</label>
                <input type="text" id="assessor_create_email" name="assessor_create_email" class="form-control form-control-sm">
           </div>                   
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm createassessor" value="Proceed">
          </form>
        </div>
      </div>
    </div>
  </div>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>