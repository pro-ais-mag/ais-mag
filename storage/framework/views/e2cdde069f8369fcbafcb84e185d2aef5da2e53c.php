<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                
                <h4 class="m-0 font-weight-bold text-primary"><?php $__currentLoopData = $sup_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($name->sup_name); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></h4><br>
                <a href="#" class="btn btn-secondary btn-sm float-right select_document" title="Add Document"><span class="fa fa-plus"></span></a>
                <form method="GET" action="/creditor-filter">
                <?php $__currentLoopData = $sup_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>               
                <input type="hidden" name="supplier_name" id="supplier_name" value="<?php echo e($name->sup_name); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="btn-group">
                <label for="creditor_from">From:</label> 
                        <input type="date" id="creditor_from" style="margin-left:10px;" name="creditor_from" class="form-control form-control-sm col-4" required>
                        <label for="creditor_to" style="margin-left:10px;">To:</label> 
                        <input type="date" id="creditor_to" style="margin-left:10px;" name="creditor_to" class="form-control form-control-sm col-4" required>
                        <input type="submit" style="margin-left:10px;" class="btn btn-success btn-sm" value="Filter">
                </form>
                </div> 
            </div>
            <div class="card-body">
                
                <div class="row">
                <div class="col-2" style="font-size:10px;">
                    <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">VAT Invoice</a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">NON VAT Invoices</a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Statement</a>
                    <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Compare Statements</a>-->
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-pop" role="tab" aria-controls="settings">Proof Of Payment</a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-rfcs" role="tab" aria-controls="settings">RFCs</a>
                    <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-compare" role="tab" aria-controls="settings">Compare RFCs</a>-->
                    </div>
                </div>
                <div class="col-10">
                    <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                    <div class="table-responsive table-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>VAT Invoice No.</th>
                                    <th>File</th>
                                    <th>Payment Date</th>
                                    <th>Total Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $inv_count=1;?> 
                               <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                                                    
                                    <td><?php echo e($inv_count); ?></td>
                                    <td><?php echo e($invoice->invoice_no); ?></td>
                                    <td><?php echo e($invoice->file); ?></td>
                                    <td><?php echo e($invoice->invoice_date); ?></td>
                                    <td>R<?php echo e(number_format($invoice->amount,2)); ?></td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="/docs/supplier_invoice/<?php echo e($invoice->file); ?>" target="_blank" class="btn btn-primary btn-sm" title="View File"><span class="fa fa-search"></span></a>
                                        
                                        </div>
                                    </td>
                                    
                                </tr>
                                <?php $inv_count++;?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                    <div class="table-responsive table-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Non VAT Invoice No.</th>
                                    <th>File</th>
                                    <th>Payment Date</th>
                                    <th>Total Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $non_count=1;?> 
                               <?php $__currentLoopData = $non_invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $non_invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                                                    
                                    <td><?php echo e($non_count); ?></td>
                                    <td><?php echo e($non_invoice->invoice_no); ?></td>
                                    <td><?php echo e($non_invoice->file); ?></td>
                                    <td><?php echo e($non_invoice->invoice_date); ?></td>
                                    <td>R<?php echo e(number_format($non_invoice->amount,2)); ?></td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="/docs/supplier_invoice/<?php echo e($non_invoice->file); ?>" target="_blank" class="btn btn-primary btn-sm" title="View File"><span class="fa fa-search"></span></a>
                                        
                                        </div>
                                    </td>
                                    
                                </tr>
                                <?php $non_count++;?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                    <div class="table-responsive table-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>File</th>
                                    <th>Payment Date</th>
                                    <th>Total Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $stat_count=1;?> 
                               <?php $__currentLoopData = $statements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                                                    
                                    <td><?php echo e($stat_count); ?></td>
                                    <td><?php echo e($statement->description); ?></td>
                                    <td><?php echo e($statement->file); ?></td>
                                    <td><?php echo e($statement->statement_date); ?></td>
                                    <td>R<?php echo e(number_format($statement->total,2)); ?></td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="/docs/supplier_statement/<?php echo e($statement->file); ?>" target="_blank" class="btn btn-primary btn-sm" title="View File"><span class="fa fa-search"></span></a>
                                        
                                        </div>
                                    </td>
                                    
                                </tr>
                                <?php $stat_count++;?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">..Compare Statement.</div>
                    <div class="tab-pane fade" id="list-pop" role="tabpanel" aria-labelledby="list-settings-list">
                    <div class="table-responsive table-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice No.</th>
                                    <th>File</th>
                                    <th>Payment Date</th>
                                    <th>Total Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $pop_count=1;?> 
                               <?php $__currentLoopData = $pops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                                                    
                                    <td><?php echo e($pop_count); ?></td>
                                    <td><?php echo e($pop->invoice_no); ?></td>
                                    <td><?php echo e($pop->file); ?></td>
                                    <td><?php echo e($pop->paymentdate); ?></td>
                                    <td>R<?php echo e(number_format($pop->total_amount,2)); ?></td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="/docs/supplier_pop/<?php echo e($pop->file); ?>" target="_blank" class="btn btn-primary btn-sm" title="View File"><span class="fa fa-search"></span></a>
                                        
                                        </div>
                                    </td>
                                    
                                </tr>
                                <?php $pop_count++;?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="list-rfcs" role="tabpanel" aria-labelledby="list-settings-list">
                    <div class="table-responsive table-sm">
                        <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice No.</th>
                                    <th>File</th>
                                    <th>Payment Date</th>
                                    <th>Total Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $rfc_count=1;?> 
                               <?php $__currentLoopData = $rfcs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rfc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                                                    
                                    <td><?php echo e($rfc_count); ?></td>
                                    <td><?php echo e($rfc->invoice_no); ?></td>
                                    <td><?php echo e($rfc->file); ?></td>
                                    <td><?php echo e($rfc->rfcdate); ?></td>
                                    <td>R<?php echo e(number_format($rfc->amount,2)); ?></td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="/docs/supplier_rfc/<?php echo e($rfc->file); ?>" class="btn btn-primary btn-sm" target="_blank" title="View File"><span class="fa fa-search"></span></a>
                                        
                                        </div>
                                    </td>
                                    
                                </tr>
                                <?php $rfc_count++;?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="list-compare" role="tabpanel" aria-labelledby="list-settings-list">..Compare RFCs.</div>
                    </div>

                </div>
                </div>
            </div>
</div>

 <!--Add Documents Modal-->
 <div class="modal fade" id="addDocumentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title" style="color:white;">Add Invoice Document.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
                  <form class="form-horizontal" role="form" method="POST" action="/creditors-invoice" enctype="multipart/form-data">
                  <?php echo e(csrf_field()); ?>

                <div class="row">                   
                  <div class="form-group col-12">
                    <label for="doc_branch">Branch:</label>
                      <select class="form-control form-control-sm" name="doc_branch" id="doc_branch" required>
                      <option value="">Select Branch</option>
                      <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($branch->branch_name); ?>"><?php echo e($branch->branch_name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                  
                      <label for="doc_invoice">Invoice:</label>
                      <input type="file" class="form-control form-control-sm" name="doc_invoice" id="doc_invoice" required>
                  </div>

                  <div class="form-group col-6">
                      
                          <label for="doc_description">Description:</label>
                          <input type="text" class="form-control form-control-sm" name="doc_description" id="doc_description" required>
                      
                  </div>
                </div>
                <div class="row">  
                  <div class="form-group col-6">
                      
                          <label for="doc_vat_non_vat">VAT/NON VAT:</label>
                          <select class="form-control form-control-sm" name="doc_vat_non_vat" id="doc_vat_non_vat" required>
                            <option value="">Select Here</option>
                            <option value="1">VAT</option>
                            <option value="0">NON VAT</option>
                          </select>  
                  </div>
                  <div class="form-group col-6">
                      
                          <label for="doc_supplier">Supplier:</label>
                          <select class="form-control form-control-sm" name="doc_supplier" id="doc_supplier" required>
                            <option value="">Select Supplier</option>
                            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($supplier->sup_name); ?>"><?php echo e($supplier->sup_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                    
                  </div>
                </div>
                <div class="row">  
                  <div class="form-group col-6">
                      
                          <label for="doc_inv_date">Invoice Date: </label>
                          <input type="date" class="form-control form-control-sm" name="doc_inv_date" id="doc_inv_date" required>
                      
                  </div>
                  <div class="form-group col-6">
                      
                          <label for="doc_select">Select:</label>
                          <select class="form-control form-control-sm" name="doc_select" id="doc_select" required>
                            <option value="">Select</option> 
                            <option value="Track No">Track No</option>
                            <option value="Reg No">Reg No</option>
                            <option value="Other">Other</option>
                          </select>  
                  </div>
                </div>
                <div class="row">  
                  <div class="form-group col-6">
                      
                          <label for="doc_info">Info:</label>
                          <input type="text" class="form-control form-control-sm" name="doc_info" id="doc_info" required>
                      
                  </div>
                  <div class="form-group col-6">
                      
                          <label for="doc_inv_no">Invoice Number: </label>
                          <input type="text" class="form-control form-control-sm" name="doc_inv_no" id="doc_inv_no" required>
                      
                  </div>
                </div>
                <div class="row">  
                  <div class="form-group col-6">
                      
                          <label for="doc_subtotal">Sub Total: </label>
                          <input type="text" class="form-control form-control-sm" name="doc_subtotal" id="doc_subtotal" required>
                      
                  </div>
                  <div class="form-group col-6">
                      
                          <label for="doc_vat">VAT(%):</label>
                          <select class="form-control form-control-sm" name="doc_vat" id="doc_vat" required>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          </select>
                           
                  </div>
                </div>
                <div class="row">  
                  <div class="form-group col-6">
                  <label for="doc_amount">Amount:</label>
                    <input type="text" class="form-control form-control-sm" name="doc_amount" id="doc_amount" required>
                  </div>
                  <div class="form-group col-6">
                      
                          <label for="doc_total">Total (Inc VAT): </label>
                          <input type="text" class="form-control form-control-sm" name="doc_total" id="doc_total" required>
                      
                  </div>
                </div>  
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="Save Document">
        </form>  
        </div>
      </div>
    </div>
  </div>

   <!--Document Select Modal-->
   <div class="modal fade" id="selectDocumentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title secondary" id="exampleModalLabel" style="color:white;">Select Document Type</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <label for="doc_type">Document:</label>
        <select class="form-control form-control-sm" name="doc_type" id="doc_type">
            <option value="">Select Document</option>
            <option value="invoices">Invoices</option>
            <option value="statement">Statements</option>
            <option value="proof">Proof Of Payments</option>
            <option value="supplier">Suppliers RFCs</option>
        </select>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-success btn-sm select_doc_type" data-dismiss="modal" href="#">Select Document</a>
        </div>
      </div>
    </div>
  </div>

  <!--Add Proof Of Payment Modal-->
  <div class="modal fade" id="proofDocumentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Add Proof Of Payment Document.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
    
    <div class="modal-body">
       <form method="POST" action="/creditor-proof"  enctype="multipart/form-data"> 
       <?php echo e(csrf_field()); ?>

        <div class="row">
            <div class="form-group col-6">
                <label for="proof_branch">Select Branch:</label>
                <select id="proof_branch" name="proof_branch" class="form-control form-control-sm" required>
                    <option value="">Select Branch</option>
                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($branch->branch_name); ?>"><?php echo e($branch->branch_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="proof_image">Statement File:</label>
                <input type="file" name="proof_image" id="proof_image" class="form-control form-control-sm" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="proof_description">Description:</label>
                <input type="text" id="proof_description" name="proof_description" class="form-control form-control-sm" required>
            </div>
            <div class="form-group col-6">
                <label for="proof_supplier">Supplier:</label>
                <select name="proof_supplier" id="proof_supplier" class="form-control form-control-sm" required>
                    <option value="">Select Supplier</option>
                    <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($supplier->sup_name); ?>"><?php echo e($supplier->sup_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="proof_date">Payment Date:</label>
                <input type="date" id="proof_date" name="proof_date" class="form-control form-control-sm" required>
            </div>
            <div class="form-group col-6">
                <label for="proof_month">Month Paid For:</label>
                <select name="proof_month" id="proof_month" class="form-control form-control-sm" required>
                    <option value="">Select Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="proof_pay">Select:</label>
                <select id="proof_pay" name="proof_pay" class="form-control form-control-sm" required>
                    <option value="">Select Here</option>
                    <option value="0">Cash</option>
                    <option value="1">Cheque</option>
                    <option value="3">Other</option>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="proof_number">:</label>
                <input type="text" name="proof_number" id="proof_number" class="form-control form-control-sm" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="proof_invoice">Invoice Number:</label>
                <input type="text" id="proof_invoice" name="proof_invoice" class="form-control form-control-sm" required>
            </div>
            <div class="form-group col-6">
                <label for="proof_total">Total (Inc VAT):</label>
                <input type="text" name="proof_total" id="proof_total" class="form-control form-control-sm" required>
            </div>
        </div>
        
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-success btn-sm" value="Save Document">
    </div>
    </form>
    </div>
  </div>  
  </div>
  </div>

  <!--Add Statement Modal-->
  <div class="modal fade" id="statementDocumentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Add Statement Document.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
    
    <div class="modal-body">
       <form method="POST" action="/creditor-statement"  enctype="multipart/form-data"> 
       <?php echo e(csrf_field()); ?>

        <div class="row">
            <div class="form-group col-6">
                <label for="state_branch">Select Branch:</label>
                <select id="state_branch" name="state_branch" class="form-control form-control-sm" required>
                    <option value="">Select Branch</option>
                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($branch->branch_name); ?>"><?php echo e($branch->branch_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="state_file">Statement File:</label>
                <input type="file" name="image" id="image" class="form-control form-control-sm" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="state_description">Description:</label>
                <input type="text" id="state_description" name="state_description" class="form-control form-control-sm" required>
            </div>
            <div class="form-group col-6">
                <label for="state_supplier">Supplier:</label>
                <select name="state_supplier" id="state_supplier" class="form-control form-control-sm" required>
                    <option value="">Select Supplier</option>
                    <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($supplier->sup_name); ?>"><?php echo e($supplier->sup_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="state_date">Statement Date:</label>
                <input type="date" id="state_date" name="state_date" class="form-control form-control-sm" required>
            </div>
            <div class="form-group col-6">
                <label for="state_account_no">Account No:</label>
                <input type="text" name="state_account_no" id="state_account_no" class="form-control form-control-sm" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="state_amount">Amount:</label>
                <input type="text" id="state_amount" name="state_amount" class="form-control form-control-sm" required>
            </div>
            <div class="form-group col-6">
                <label for="state_rebate_discount">Rebate Discount %:</label>
                <input type="text" name="state_rebate_discount" id="state_rebate_discount" class="form-control form-control-sm" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="state_rebate_amount">Rebate Amount:</label>
                <input type="text" id="state_rebate_amount" name="state_rebate_amount" class="form-control form-control-sm" required>
            </div>
            <div class="form-group col-6">
                <label for="state_settlement_dis">Early Settlement Discount %:</label>
                <input type="text" name="state_settlement_dis" id="state_settlement_dis" class="form-control form-control-sm" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="state_settlement_amount">Early Settlement Amount:</label>
                <input type="text" id="state_settlement_amount" name="state_settlement_amount" class="form-control form-control-sm" required>
            </div>
            <div class="form-group col-6">
                <label for="state_vat">VAT(%):</label>
                <select name="state_vat" id="state_vat" class="form-control form-control-sm" required>
                  <option value="">Select VAT</option>
                  <option value="14">14%</option>
                  <option value="15">15%</option>  
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="state_subtotal">Sub Total:</label>
                <input type="text" id="state_subtotal" name="state_subtotal" class="form-control form-control-sm" required>
            </div>
            <div class="form-group col-6">
                <label for="state_total">Total (Inc VAT):</label>
                <input type="text" name="state_total" id="state_total" class="form-control form-control-sm" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-success" value="Save Document">
    </div>
    </form>
    </div>
  </div>  
  </div>
  </div>

<!--Add Supplier RFC Modal-->
<div class="modal fade" id="rfcsDocumentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Add Supplier RFCs.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
    
    <div class="modal-body">
       <form method="POST" action="/creditor-supplier-rfcs"  enctype="multipart/form-data"> 
       <?php echo e(csrf_field()); ?>

        <div class="row">
            <div class="form-group col-6">
                <label for="rfcs_branch">Select Branch:</label>
                <select id="rfcs_branch" name="rfcs_branch" class="form-control form-control-sm" required>
                    <option value="">Select Branch</option>
                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($branch->branch_name); ?>"><?php echo e($branch->branch_name); ?><option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="rfcs_image">Supplier RFC File:</label>
                <input type="file" name="rfcs_image" id="rfcs_image" class="form-control form-control-sm" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="rfcs_description">Part Description:</label>
                <input type="text" id="rfcs_description" name="rfcs_description" class="form-control form-control-sm" required>
            </div>
            <div class="form-group col-6">
                <label for="rfcs_supplier">Supplier:</label>
                <select name="rfcs_supplier" id="rfcs_supplier" class="form-control form-control-sm" required>
                    <option value="">Select Supplier</option>
                    <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($supplier->sup_name); ?>"><?php echo e($supplier->sup_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="rfcs_trackid">Track ID:</label>
                <input type="text" id="rfcs_trackid" name="rfcs_trackid" class="form-control form-control-sm" required>
            </div>
            <div class="form-group col-6">
                <label for="rfcs_invoice">Invoice No:</label>
                <input type="text" name="rfcs_invoice" id="rfcs_invoice" class="form-control form-control-sm" required>
                
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="rfcs_credit">Credit Note No:</label>
                <input type="text" id="rfcs_credit" name="rfcs_credit" class="form-control form-control-sm" required>
                
            </div>
            <div class="form-group col-6">
                <label for="rfcs_date">RFC Date:</label>
                <input type="date" name="rfcs_date" id="rfcs_date" class="form-control form-control-sm" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="rfcs_total">Total (Inc VAT):</label>
                <input type="text" id="rfcs_total" name="rfcs_total" class="form-control form-control-sm" required>
            </div>
        </div>
        <div class="row">    
            <div class="form-group col-12">
                <label for="rfcs_comment">Comment:</label>
                <textarea name="rfcs_comment" id="rfcs_comment" class="form-control form-control-sm" rows="4" required></textarea>
            </div>
        </div>
        
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-success btn-sm" value="Save Document">
    </div>
    </form>
    </div>
  </div>  
  </div>
  </div>
<?php $__env->stopSection(); ?>                
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>