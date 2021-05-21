 
<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Order Stock List.</h4>
                <a class="btn btn-success btn-sm float-right create_order" href="#" title="Create Order"><span class="fa fa-plus"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:10px;">
                            <thead>
                                <tr>
                                    <th>Order no.</th>
                                    <th>Supplier</th>
                                    <th>Supplier Email</th>
                                    <th>Supplier Tel</th>
                                    <th>Supplier Cell</th>
                                    <th>Placed By</th>
                                    <th>Sender Email</th>
                                    <th>Branch</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $__currentLoopData = $stock_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock_order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($stock_order->id); ?></td>
                                    <td><?php echo e($stock_order->supplier); ?></td>
                                    <td><?php echo e($stock_order->supplier_email); ?></td>
                                    <td><?php echo e($stock_order->supplier_tel); ?></td>
                                    <td><?php echo e($stock_order->supplier_cell); ?></td>
                                    <td><?php echo e($stock_order->sender); ?></td>
                                    <td><?php echo e($stock_order->sender_email); ?></td>
                                    <td><?php echo e($stock_order->branch); ?></td>
                                    <td><?php echo e($stock_order->order_date); ?></td>
                                    <td>
                                    <div class="btn-group">
                                        <a href="/print-stock-order/<?php echo e($stock_order->id); ?>" target="_blank" class="btn btn-primary btn-sm"><span class="fa fa-print"></span></a>
                                        <a href="#" class="btn btn-info btn-sm order_stock_email" data-id='<?php echo e($stock_order->id); ?>' data-email='<?php echo e($stock_order->supplier_email); ?>'  style="margin-left:5px;"><span class="fa fa-at"></span></a>
                                        <a href="/consumerable-order-list/<?php echo e($stock_order->id); ?>" class="btn btn-secondary btn-sm" style="margin-left:5px;"><span class="fa fa-search"></span></a> 
                                    </div>
                                    </td>                                
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
</div>


<!--Create Order-->
<!-- Add To Order List-->
<div class="modal fade" id="CreateOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">


    <div class="modal-dialog" role="document" style="font-size:10px;">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Create Order.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="/consumerable-create-order">
            <?php echo e(csrf_field()); ?>

          <div class="form-group">
          <label for="order_description">Description:</label>
            <input type="text" id="order_description" name="order_description" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="order_category">Category:</label>
            <select id="order_category" name="order_category" class="form-control form-control-sm">
                <option value="">--Select--</option>
                <option value="Sundries">Sundries</option>
                <option value="Paint Supplies">Paint Supplies</option>
                <option value="Waste Disposal">Waste Disposal</option>
                <option value="Inhouse Stock">Inhouse Stock</option>
            </select>
          </div>
          <div class="form-group">
          <label for="order_amount">Amount/Unit:</label>
            <input type="number" id="order_amount" name="order_amount" class="form-control form-control-sm"> 
          </div>
          <div class="form-group">
          <label for="order_quan">Quantity:</label>
            <input type="text" id="order_quan" name="order_quan" class="form-control form-control-sm"> 
          </div> 
          <div class="form-group">
          <label for="order_supplier">Supplier:</label>
            <input type="text" id="order_supplier" name="order_supplier" class="form-control form-control-sm"> 
          </div>
          <div class="form-group">
          <label for="order_icon">Icon:</label>
            <input type="file" id="order_icon" name="order_icon" class="form-control form-control-sm"> 
          </div>
          <div class="form-group">
          <label for="order_branch">Branch:</label>
            <select id="order_branch" name="order_branch" class="form-control form-control-sm">
                <option value="Selby">Selby</option>   
                <option value="Longmeadow">Longmeadow</option>
                <option value="The Glen">The Glen</option>
            </select> 
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="+Create Stock">
        </div>
        </form>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>            
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>