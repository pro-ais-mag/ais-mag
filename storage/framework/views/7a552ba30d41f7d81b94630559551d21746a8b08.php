<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Creditors.</h4>

                <br>
                <a href="javascript:history.go(-1)" class="btn btn-danger btn-sm" title="Back To Precosting List">Back</a> 

                <a class="btn btn-dark btn-sm" href="/print-suppliers" target="_blank"><span class="fa fa-print"></span>Print Suppliers</a>

                 <!-- #### ORDERING PARTS BUTTONS [ 19 MAY 2021 ] -->
                 <a class="btn btn-dark btn-sm" href="/pre-costing">Ordering Parts</a>

                <a href="#" class="btn btn-success btn-sm create_new_supplier float-right" title="Create New Supplier" style="margin-right:5px;"><span class="fa fa-user"></span>Create New Supplier</a>
               
                <br/><br/>

<!--
<div class="col-sm-3">
    <form action="/print-input-and-output" method="post" target="_blank">
        <?php echo csrf_field(); ?>

   <div class="input-group">
     <input type="date" name="io_vattxt" id="io_vattxt" class="input-sm form-control"> 
     <span class="input-group-addon">
         <input type="submit" class="btn btn-primary" value="Input &amp; Output VAT">
     </span>
     
   </div>

   </form>
</div>
-->

            <!-- #### ADDING ICONS IN BUTTONS [ 19 MAY 2021 ] -->
          <form action="/print-input-and-output" method="post" target="_blank">
                        <?php echo csrf_field(); ?>

                  <div class="btn-group">
                        <label for="io_vattxt">Date:</label> 
                        <input type="date" id="io_vattxt" style="margin-left:10px;" name="io_vattxt" class="form-control form-control-sm col-5" required>
                       
                        <input type="submit" style="margin-left:10px;" class="btn btn-primary btn-sm col-5" value="Input &amp; Output VAT">
                  </div> 

          </form>

            </div>
            <div class="card-body">
                
                <div class="row">
                <div class="table-responsive table-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Supplier Name</th>
                                    <th>Supplier No.</th>
                                    <th>Supplier Fax</th>
                                    <th>Supplier Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $count=1;?> 
                               <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <tr>
                                                                    
                                    <td><?php echo e($count); ?></td>
                                    <td><?php echo e($supplier->sup_name); ?></td>
                                    <td><?php echo e($supplier->sup_phone); ?></td>
                                    <td><?php echo e($supplier->sup_fax); ?></td>
                                    <td><?php echo e($supplier->sup_email); ?></td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="/creditor/<?php echo e($supplier->sup_key); ?>" class="btn btn-primary btn-sm" title="Open Supplier Info."><span class="fa fa-search"></span></a>
                                        
                                        </div>
                                    </td>
                                    
                                </tr>
                                <?php $count++;?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>
                    </div>
                    
                </div>
            </div>    
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>