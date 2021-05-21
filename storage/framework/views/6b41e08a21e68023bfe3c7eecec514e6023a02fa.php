<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Order No - <?php echo e($order_no); ?></h4>
                <a class="btn btn-success btn-sm float-right add_item_stock" data-id="<?php echo e($order_no); ?>" href="#" title="Add To Order"><span class="fa fa-plus"></span></a>
                <a class="btn btn-danger btn-sm" href="/comsumerable-order-stock" title="Back To Order Stock">Back</a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:10px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Comment</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count=1;?>
                               <?php $__currentLoopData = $order_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              
                                <tr>
                                    <td><?php echo e($count); ?></td>
                                    <td><?php echo e($list->description); ?></td>
                                    <td><?php echo e($list->quantity); ?></td>
                                    <td><?php echo e($list->comment); ?></td>
                                    <td align="center">
                                    <div class="btn-group">
                                        <a href="/consumerable-order-list-remove/<?php echo e($list->id); ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash" title="Remove Item"></span></a>
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
<!-- Add To Order List-->
<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">


    <div class="modal-dialog" role="document" style="font-size:10px;">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;font-size:10px;">Add To Stock List.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="GET" action="/consumerable-orderlist-add">
            <input type="hidden" name="order_no" id="order_no">
          <div class="form-group">
          <label for="description_add_order">Description:</label>
            <input type="text" id="description_add_order" name="description_add_order" class="form-control form-control-sm">
          </div>
          
          <div class="form-group">
          <label for="quant_add_order">Quantity:</label>
            <input type="text" id="quant_add_order" name="quant_add_order" class="form-control form-control-sm"> 
          </div> 
          <div class="form-group">
          <label for="comment_add_order">Comment:</label>
            <input type="text" id="comment_add_order" name="comment_add_order" class="form-control form-control-sm"> 
          </div>
          
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="+Add To List">
        </div>
        </form>
      </div>
    </div>
  </div>


<?php $__env->stopSection(); ?>            
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>