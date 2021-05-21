<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Availiable Users</h4>
                <a class="btn btn-success btn-sm float-right create-modal-ais" data-id="" href="#" title="Create User"><span class="fa fa-plus"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive table-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    
                                    <th>User Name</th>
                                    <th>Company Code</th>
                                    <th>System Level</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count=1;?>
                               
                              <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                
                                    
                                    <td><?php echo e($user->username); ?></td>
                                    <td><?php echo e($user->comp_code); ?></td>
                                    <td><?php echo e($user->position); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><?php echo e($user->created_at); ?></td>
                                    
                                    <td align="center">
                                    <div class="btn-group">
                                        <a href="/ais-delete/<?php echo e($user->id); ?>" class="btn btn-danger btn-sm" title="Remove User"><span class="fa fa-trash" title="Remove Item"></span></a>
                                        <a href="#editUser" class="btn btn-primary btn-sm edit-modal-ais" style="margin-left:5px;" data-id="<?php echo e($user->id); ?>" data-name="<?php echo e($user->username); ?>" data-password="<?php echo e($user->password); ?>" data-email="<?php echo e($user->email); ?>" data-dept="<?php echo e($user->position); ?>"  data-sign="<?php echo e($user->sign); ?>" data-authorize="<?php echo e($user->authorize); ?>" data-quote="<?php echo e($user->quote); ?>" data-consumables="<?php echo e($user->consumerable); ?>" data-customer="<?php echo e($user->customer_care); ?>" data-creditor="<?php echo e($user->creditors); ?>" data-line="<?php echo e($user->line_manager); ?>" data-costing="<?php echo e($user->costing); ?>" data-final_stage="<?php echo e($user->final_stage); ?>" data-code="<?php echo e($user->comp_code); ?>" data-close="<?php echo e($user->close); ?>" title="Edit User"><span class="fa fa-search"></span></a> 
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

<!--Add AIS User-->
<div class="modal fade" id="create_ais_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="font-size:10px;">
        <div class="modal-header bg-success">
          <h5 class="modal-title " id="exampleModalLabel" style="color:white;">Create AIS User</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="POST" action="/ais-create">
        <?php echo e(csrf_field()); ?>

        <div class="modal-body">
            <div class="row">
              <div class="form-group col-6">
              <label for="ais_username">Username:</label> 
                  <input type="text" id="ais_username" name="ais_username" class="form-control form-control-sm" required>
              </div>

              <div class="form-group col-6">
              <label for="ais_email">Email:</label> 
                  <input type="email" id="ais_email" name="ais_email" class="form-control form-control-sm" required>
              </div>
           </div>
           <div class="row">
              <div class="form-group col-6">
                <label for="ais_password">Password</label>
                    <input type="text" id="ais_password" name="ais_password" class="form-control form-control-sm" required>
              </div> 
              
              <div class="form-group col-6">
                <label for="ais_depart">Department:</label>
                    <select id="ais_depart" name="ais_depart" class="form-control form-control-sm" required>
                    
                    <option value="Consumerables">Consumerables</option>
                                        <option Value="Line Manager">Line Manager</option>
                                        <option value="Reception">Reception</option>
                                        <option value="Estimator">Estimator</option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Stores">Stores</option>
                                        <option value="Buyer">Buyer</option>
                                        

                    </select>
              </div>
           </div>
           <div class="row">
              <div class="form-group col-6">
                <label for="ais_comp_code">Company Code:</label>
                    <select id="ais_comp_code" name="ais_comp_code" class="form-control form-control-sm" required>
                    <option value="">Select Branch</option>
                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($branch->branch_code); ?>"><?php echo e($branch->branch_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
              </div>
              <div class="form-group col-6">
                
                <label for="ais_quote">Quote Dash?</label>
                    <select id="ais_quote" name="ais_quote" class="form-control form-control-sm">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                    </select>
                    
              </div> 
           </div>
           <div class="row">
              <div class="form-group col-6">
                <label for="ais_consumer">Consumables Dash?</label>
                    <select id="ais_consumer" name="ais_consumer" class="form-control form-control-sm" >
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                    </select>
              </div> 
              <div class="form-group col-6">
                <label for="ais_customer">Customer Dash?</label>
                    <select id="ais_customer" name="ais_customer" class="form-control form-control-sm">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                    </select>
              </div> 
           </div>
           <div class="row">
              <div class="form-group col-6">
                <label for="ais_line">Line Manager Dash?</label>
                    <select id="ais_line" name="ais_line" class="form-control form-control-sm">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                    </select>
              </div> 
              <div class="form-group col-6">
                <label for="ais_creditor">Creditors Dash?</label>
                    <select id="ais_creditor" name="ais_creditor" class="form-control form-control-sm">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                    </select>
              </div>
           </div>
           <div class="row">
            <div class="form-group col-6">
              <label for="ais_costing">Costing Dash?</label>
                  <select id="ais_costing" name="ais_costing" class="form-control form-control-sm">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div>
            <div class="form-group col-6">
              <label for="ais_costing">Final Costing Dash?</label>
                  <select id="ais_final" name="ais_final" class="form-control form-control-sm">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div>
           </div>
           <div class="row">
            <div class="form-group col-6">
              <label for="ais_final">Sign Final Costing?</label>
                  <select id="ais_sign" name="ais_sign" class="form-control form-control-sm">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div>
            <div class="form-group col-6">
              <label for="ais_auth">Authorize Car Repair?</label>
                  <select id="ais_auth" name="ais_auth" class="form-control form-control-sm">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div>
           </div>
           <div class="row">
              <div class="form-group col-6">
                <label for="ais_close">Close Record?</label>
                  <select id="ais_close" name="ais_close" class="form-control form-control-sm">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
              </div>
           </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="Save User" target="_blank">
        </div>
        </form>
      </div>
    </div>
  </div>

<!--Edit AIS Modal-->
  <div class="modal fade" id="edit_modal_ais" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="font-size:10px;">
        <div class="modal-header bg-primary">
          <h6 class="modal-title " id="exampleModalLabel" style="color:white;">Edit AIS User</h6>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="GET" action="/ais-edit">
        
        <div class="modal-body">
            <input type="hidden" id="ais_id" name="ais_id">
            <div class="row">
              <div class="form-group col-6">
              <label for="ais_username_edit">Username:</label> 
                  <input type="text" id="ais_username_edit" name="ais_username_edit" class="form-control form-control-sm" required>
              </div>

              <div class="form-group col-6">
              <label for="ais_email_edit">Email:</label> 
                  <input type="text" id="ais_email_edit" name="ais_email_edit" class="form-control form-control-sm" required>
              </div>
            </div>
           <div class="row">   
              <div class="form-group col-6">
                <label for="ais_password_edit">Password</label>
                    <input type="text" id="ais_password_edit" name="ais_password_edit" class="form-control form-control-sm" required>
              </div> 
              <div class="form-group col-6">
                <label for="ais_depart_edit">Department:</label>
                    <select id="ais_depart_edit" name="ais_depart_edit" class="form-control form-control-sm" required>
                        <option value=""></option>
                        <option value="Consumerables">Consumerables</option>
                        <option Value="Line Manager">Line Manager</option>
                        <option value="Reception">Reception</option>
                        <option value="Estimator">Estimator</option>
                        <option value="Administrator">Administrator</option>
                        <option value="Stores">Stores</option>
                        <option value="Buyer">Buyer</option>
                    </select>
              </div>
            </div>
           <div class="row">   
            <div class="form-group col-6">
              <label for="ais_comp_code_edit">Company Code:</label>
                  <select id="ais_comp_code_edit" name="ais_comp_code_edit" class="form-control form-control-sm" required>
                      <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($branch->branch_code); ?>"><?php echo e($branch->branch_name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
            </div>
            <div class="form-group col-6">
              
              <label for="ais_quote_edit">Quote Dash?</label>
                  <select id="ais_quote_edit" name="ais_quote_edit" class="form-control form-control-sm" required>
                  <option value=""></option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
                  
            </div>
          </div>
          <div class="row">   
           <div class="form-group col-6">
            <label for="ais_consumer_edit">Consumables Dash?</label>
                <select id="ais_consumer_edit" name="ais_consumer_edit" class="form-control form-control-sm" required>
                <option value=""></option>
                <option value="1">Yes</option>
                <option value="0">No</option>
                </select>
           </div> 
           <div class="form-group col-6">
            <label for="ais_customer_edit">Customer Dash?</label>
                <select id="ais_customer_edit" name="ais_customer_edit" class="form-control form-control-sm" required>
                <option value=""></option>
                <option value="1">Yes</option>
                <option value="0">No</option>
                </select>
           </div> 
          </div>
          <div class="row"> 
            <div class="form-group col-6">
              <label for="ais_line_edit">Line Manager Dash?</label>
                  <select id="ais_line_edit" name="ais_line_edit" class="form-control form-control-sm" required>
                  <option value=""></option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div> 
            <div class="form-group col-6">
              <label for="ais_creditor_edit">Creditors Dash?</label>
                  <select id="ais_creditor_edit" name="ais_creditor_edit" class="form-control form-control-sm" required>
                  <option value=""></option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div>
          </div>
          <div class="row">  
           <div class="form-group col-6">
            <label for="ais_costing_edit">Costing Dash?</label>
                <select id="ais_costing_edit" name="ais_costing_edit" class="form-control form-control-sm" required>
                <option value=""></option>
                <option value="1">Yes</option>
                <option value="0">No</option>
                </select>
           </div>
           <div class="form-group col-6">
            <label for="ais_costing_edit"> Final Costing Dash?</label>
                <select id="ais_final_edit" name="ais_final_edit" class="form-control form-control-sm" required>
                <option value=""></option>
                <option value="1">Yes</option>
                <option value="0">No</option>
                </select>
           </div>
          </div>
          <div class="row"> 
            <div class="form-group col-6">
              <label for="ais_line_edit">Authorize Car Repair?</label>
                  <select id="ais_authorize_edit" name="ais_authorize_edit" class="form-control form-control-sm" required>
                  <option value=""></option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div> 
            <div class="form-group col-6">
              <label for="ais_creditor_edit">Sign Final Costing??</label>
                  <select id="ais_sign_edit" name="ais_sign_edit" class="form-control form-control-sm" required>
                  <option value=""></option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-6">
              <label for="ais_close_edit">Close Record?</label>
                <select id="ais_close_edit" name="ais_close_edit" class="form-control form-control-sm" required>
                  <option value=""></option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
            </div>
          </div> 
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary btn-sm" value="*Edit User">
          </form>
        </div>
      </div>
    </div>
  </div>

  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>