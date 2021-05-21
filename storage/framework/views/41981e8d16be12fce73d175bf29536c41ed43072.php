<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Supplier List.</h4>
                <a class="btn btn-success btn-sm float-right add_supplier" href="#" title="Add Supplier"><span class="fa fa-user">+</span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:10px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Supplier Name</th>
                                    <th>Sales Person</th>
                                    <th>Supplier Email</th>
                                    <th>Supplier Tel</th>
                                    <th>Supplier Cel</th>
                                    <th></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count=1;?> 
                                <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($count); ?></td>
                                    <td><?php echo e($supplier->sup_name); ?></td>
                                    <td><?php echo e($supplier->sales_person); ?></td>
                                    <td><?php echo e($supplier->sup_email); ?></td>
                                    <td><?php echo e($supplier->sup_tel); ?></td>
                                    <td><?php echo e($supplier->sup_cell); ?></td>
                                    <td><a class="btn btn-primary btn-sm edit_supplier" href="#" title="Edit Supplier" data-id="<?php echo e($supplier->id); ?>" data-name="<?php echo e($supplier->sup_name); ?>" data-salesperson="<?php echo e($supplier->sales_person); ?>" data-email="<?php echo e($supplier->sup_email); ?>" data-tel="<?php echo e($supplier->sup_tel); ?>" data-cell="<?php echo e($supplier->sup_cell); ?>"><span class="fa fa-pencil-alt"></span></a></td>
                                    
                                                                    
                                </tr>
                                <?php $count++;?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
</div>

<!--Supplier Modal-->
<div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="font-size:10px;">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Supplier Edit.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id_supplier" id="id_supplier"> 
          <div class="form-group">
          <label for="supplier_name">Supplier Name:</label>
            <input type="text" id="supplier_name" name="supplier_name" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="sales_person">Sales Person:</label>
            <input type="text" id="sales_person" name="sales_person" class="form-control form-control-sm"> 
          </div>
          <div class="form-group">
          <label for="supplier_email">Supplier Email:</label>
            <input type="text" id="supplier_email" name="supplier_email" class="form-control form-control-sm"> 
          </div> 
          <div class="form-group">
          <label for="supplier_tel">Supplier Tel:</label>
            <input type="text" id="supplier_tel" name="supplier_tel" class="form-control form-control-sm"> 
          </div>
          <div class="form-group">
          <label for="supplier_cell">Supplier Cell:</label>
            <input type="text" id="supplier_cell" name="supplier_cell" class="form-control form-control-sm"> 
          </div>
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-success btn-sm edit_supplier_save" data-dismiss="modal" href="#">Save</a>
        </div>
      </div>
    </div>
  </div>

  <!--Add New Supplier-->
  
<div class="modal fade" id="supplierAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="font-size:10px;">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Supplier Create.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="POST" action="/consumerable-supplier-create">
        <?php echo e(csrf_field()); ?>

        <div class="modal-body">
            <input type="hidden" name="id_supplier" id="id_supplier"> 
          <div class="form-group">
          <label for="supplier_name_add">Supplier Name:</label>
            <input type="Text" id="supplier_name_add" name="supplier_name_add" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="sales_person_add">Sales Person:</label>
            <input type="text" id="sales_person_add" name="sales_person_add" class="form-control form-control-sm"> 
          </div>
          <div class="form-group">
          <label for="supplier_email_add">Supplier Email:</label>
            <input type="text" id="supplier_email_add" name="supplier_email_add" class="form-control form-control-sm"> 
          </div> 
          <div class="form-group">
          <label for="supplier_tel_add">Supplier Tel:</label>
            <input type="text" id="supplier_tel_add" name="supplier_tel_add" class="form-control form-control-sm"> 
          </div>
          <div class="form-group">
          <label for="supplier_cell_add">Supplier Cell:</label>
            <input type="text" id="supplier_cell_add" name="supplier_cell_add" class="form-control form-control-sm"> 
          </div>
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="Save">
        </div>
        </form>
      </div>
    </div>
  </div>


<?php $__env->stopSection(); ?>            
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>