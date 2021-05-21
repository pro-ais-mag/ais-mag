<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Availiable Users</h4>
                <a class="btn btn-success float-right create-modal" data-id="" href="#" title="Create User"><span class="fa fa-plus"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>From Name</th>
                                    <th>Email</th>
                                    <th>Comp Code</th>
                                    <th>Cell</th>
                                    <th>Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count=1;?>
                               
                              <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                
                                    
                                    <td><?php echo e($user->use_username); ?></td>
                                    <td><?php echo e($user->dept_name); ?></td>
                                    <td><?php echo e($user->user_fromname); ?></td>
                                    <td><?php echo e($user->user_email); ?></td>
                                    <td><?php echo e($user->comp_code); ?></td>
                                    <td><?php echo e($user->user_cell); ?></td>
                                    <td><?php echo e($user->ut_name); ?></td>
                                    <td align="center">
                                    <div class="btn-group">
                                        <a href="/user-delete/<?php echo e($user->use_key); ?>" class="btn btn-danger" title="Remove User"><span class="fa fa-trash" title="Remove Item"></span></a>
                                        <a href="#" class="btn btn-primary edit-modal" style="margin-left:5px;" data-id="<?php echo e($user->use_key); ?>" data-name="<?php echo e($user->use_username); ?>" data-dept="<?php echo e($user->ut_name); ?>" data-cell="<?php echo e($user->user_cell); ?>" data-from="<?php echo e($user->user_fromname); ?>" data-pin="<?php echo e(md5($user->use_password)); ?>" title="Edit User"><span class="fa fa-search"></span></a> 
                                    </div>
                                    </td>                                
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $count++;?>
                                
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
</div>

 <!--Add New User-->
 <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Create New User.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="/user-create">
          <?php echo e(csrf_field()); ?>

            
          <div class="row">   
          <div class="form-group col-6">
          <label for="create_name">Name:</label>
            <input type="text" id="create_name" name="create_name" class="form-control">
          </div>
          <div class="form-group col-6">
          <label for="create_comp_code">Company Code:</label>
            <input type="text" id="create_comp_code" name="create_comp_code" value="MAG1001" class="form-control" readonly> 
          </div> 
          </div>

          <div class="row">   
          <div class="form-group col-6">
          <label for="create_department">Department:</label>
            <select id="create_department" name="create_department" class="form-control">
              <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($department->dept_key); ?>"><?php echo e($department->dept_name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
            </select>
          </div>
          <div class="form-group col-6">
          <label for="create_cell">Cell Number:</label>
            <input type="text" id="create_cell" name="create_cell" class="form-control"> 
          </div> 
          </div>

          <div class="row">   
          <div class="form-group col-6">
          <label for="create_from">Name From:</label>
            <input type="text" id="create_from" name="create_from" class="form-control">
          </div>
          <div class="form-group col-6">
          <label for="create_level">Level:</label>
            <select id="create_level" name="create_level" class="form-control">
             <?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($level->ut_key); ?>"><?php echo e($level->ut_name); ?></option>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
            </select> 
          </div> 
          </div>
          <div class="row">   
          <div class="form-group col-6">
          <label for="create_email">Email:</label>
            <input type="text" id="create_email" name="create_email" class="form-control">
          </div>
          <div class="form-group col-6">
          <label for="create_pin">Pin:</label>
            <input type="text" id="create_pin" name="create_pin" class="form-control"> 
          </div> 
          </div>
          
          <div class="row">
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="booking">
                <label  for="booking">Booking</label>
            </div>
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="stripping">
                <label for="stripping">Stripping</label>
            </div>
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="mechanical">
                <label class="form-check-label" for="mechanical">Mechanical</label>
            </div>
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="panelshop">
                <label class="form-check-label" for="panelshop">Panel Shop</label>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="assembly">
                <label for="assembly">Assembly</label>
            </div>
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="diagnositic">
                <label class="form-check-label" for="diagnostic">Diagnostic</label>
            </div>
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="qualitycontrol">
                <label class="form-check-label" for="qualitycontrol">Qaulity Ctrl</label>
            </div>
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="cleaning">
                <label class="form-check-label" for="cleaning">Cleaning</label>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="polishing">
                <label class="form-check-label" for="polishing">Polishing</label>
            </div>
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="flatting">
                <label class="form-check-label" for="flatting">Flatting</label>
            </div>
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="primmer">
                <label class="form-check-label" for="primer">Primer</label>
            </div>
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="washing">
                <label class="form-check-label" for="washing">Washing</label>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="masking">
                <label class="form-check-label" for="masking">Masking</label>
            </div>
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="electrical">
                <label class="form-check-label" for="electrical">Electrical</label>
            </div>
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="jigging">
                <label class="form-check-label" for="jigging">Jigging</label>
            </div>
            
          </div>
          <br>
          
          <div class="row">
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="reception">
                <label class="form-check-label" for="reception">Reception</label>
            </div>
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="estimator">
                <label class="form-check-label" for="estimator">Estimator</label>
            </div>
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="linemanager">
                <label class="form-check-label" for="exampleCheck1">Line Manager</label>
            </div>
            <div class="form-group col-3">
            <input type="checkbox" class="form-control-md" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Administrator</label>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success" value="+Create User">
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- Edit User Modal-->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Edit User.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="GET" action="/user-edit">
          <?php echo e(csrf_field()); ?>

            
          <div class="row">   
          <div class="form-group col-6">
          <input type="hidden" id="edit_id" name="edit_id">
          <label for="edit_name">Name:</label>
            <input type="text" id="edit_name" name="edit_name" class="form-control">
          </div>
          <div class="form-group col-6">
          <label for="edit_comp_code">Company Code:</label>
            <input type="text" id="edit_comp_code" name="edit_comp_code" value="MAG1001" class="form-control" readonly> 
          </div> 
          </div>

          <div class="row">   
          <div class="form-group col-6">
          <label for="edit_department">Department:</label>
            <input type="text" id="edit_department" name="edit_department" class="form-control">
          </div>
          <div class="form-group col-6">
          <label for="edit_cell">Cell Number:</label>
            <input type="text" id="edit_cell" name="edit_cell" class="form-control"> 
          </div> 
          </div>

          <div class="row">   
          <div class="form-group col-6">
          <label for="edit_from">Name From:</label>
            <input type="text" id="edit_from" name="edit_from" class="form-control">
          </div>
          <div class="form-group col-6">
          <label for="edit_level">Level:</label>
            <input type="text" id="edit_level" name="edit_level" class="form-control">
          </div> 
          </div>
          <div class="row">   
          <div class="form-group col-6">
          <label for="edit_email">Email:</label>
            <input type="text" id="edit_email" name="edit_email" class="form-control">
          </div>
          <div class="form-group col-6">
          <label for="edit_pin">Pin:</label>
            <input type="text" id="edit_pin" name="edit_pin" class="form-control"> 
          </div> 
          </div>
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary" value="+Edit User">
          </form>
        </div>
      </div>
    </div>
  </div>


<?php $__env->stopSection(); ?>            
<?php echo $__env->make('administrator', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>