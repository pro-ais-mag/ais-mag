<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Invoice.</h4>
            </div>
            <div class="card-body">
            <form action="/consumerable-upload" method="POST">
            <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="branch_name" class="">Branch:</label>
                            <select id="branch_name" name="branch_name" class="form-control form-control-sm">
                            <option value="Selby">Selby</option>
                            <option value="Longmeadow">Longmeadow</option>
                            <option value="The Glen">The Glen</option>
                            </select>
                    </div>
                    <div class="form-group col-6">        
                        <label for="invoice">Invoice File:</label>
                            <input type="file" name="invoice" id="invoice" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="supplier_invoice" class="">Supplier:</label>
                            <select id="supplier_invoice" name="supplier_invoice" class="form-control form-control-sm">
                            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($supplier->sup_name); ?>"><?php echo e($supplier->sup_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                    </div>
                    <div class="form-group col-6">        
                        <label for="invoice_date">Invoice Date</label>
                            <input type="date" name="invoice_date" id="invoice_date" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="invoice_no" class="">Invoice No:</label>
                            <input type="text" id="invoice_no" name="invoice_no" class="form-control form-control-sm">
                            
                    </div>
                    <div class="form-group col-6">        
                        <label for="invoice_date">Subtotal:</label>
                            <input type="number" name="subtotal" id="subtotal" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="vat_amount" class="">VAT Amount:</label>
                            <input type="number" id="vat_amount" name="vat_amount" class="form-control form-control-sm">
                            
                    </div>
                    <div class="form-group col-6">        
                        <label for="total_vat">Total (Inc Vat):</label>
                            <input type="number" name="total_vat" id="total_vat" class="form-control form-control-sm">
                    </div>
                </div><br>
                <div class="row">
                    <div class="btn-group">
                        <input type="submit" name="üpload" id="upload" value="+ Upload File" class="btn btn-success btn-sm pull-right">
                    </div>
                </div>
                <form>
            </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>