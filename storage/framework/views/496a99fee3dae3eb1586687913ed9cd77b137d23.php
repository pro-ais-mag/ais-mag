<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                
                <h4 class="m-0 font-weight-bold text-primary">Key Ref : <?php echo e($id); ?></h4><br>
                <a href="#" class="btn btn-secondary btn-sm float-right select_document" title="Add Document"><span class="fa fa-plus"></span></a>
                <a href="/print-pre-costing/<?php echo e($id); ?>" class="btn btn-primary btn-sm float-right" target="_blank" title="Print Precosting" style="margin-right:5px;"><span class="fa fa-print"></span></a>
                <a href="#" class="btn btn-success btn-sm create_new_supplier float-right" title="Create New Supplier" style="margin-right:5px;"><span class="fa fa-user"></span></a>
                <?php $__currentLoopData = $client_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <div class="input-group mb-3 col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="font-size:10px;height:26px;" id="basic-addon1">Reg</span>
                        </div>
                        <input type="text" class="form-control form-control-sm" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo e($client->Reg_No); ?>" style="font-size:10px;" readonly>
                    </div>
                    <div class="input-group mb-3 col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1" style="font-size:10px;height:26px;">Client</span>
                        </div>
                        <input type="text" class="form-control form-control-sm" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo e($client->Fisrt_Name); ?> <?php echo e($client->Last_Name); ?>" style="font-size:10px;" readonly>
                    </div>
                    <div class="input-group mb-3 col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1" style="font-size:10px;height:26px;">Model</span>
                        </div>
                        <input type="text" class="form-control form-control-sm" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo e($client->Model); ?>" style="font-size:10px;" disabled>
                    </div>
                    <div class="input-group mb-3 col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"  style="font-size:10px;height:26px;">Claim No.</span>
                        </div>
                        <input type="text" class="form-control form-control-sm" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo e($client->Claim_No); ?>" style="font-size:10px;" disabled>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            </div>
            <div class="card-body">
                
                <div class="row">
                <div class="col-2"  style="font-size:10px;">
                    <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Parts</a>
                    <a class="list-group-item list-group-item-action" id="list-additionals-list" data-toggle="list" href="#list-additionals" role="tab" aria-controls="additionals">Additionals</a>
                    <!--<a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">NON VAT Invoices</a>-->
                    <!--<a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Approved Quotes</a>-->
                    <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Compare Statements</a>-->
                    <a class="list-group-item list-group-item-action" id="list-doc-list" data-toggle="list" href="#list-doc" role="tab" aria-controls="list-doc-list">Documents</a>
                    <a class="list-group-item list-group-item-action" id="list-ordering-list" data-toggle="list" href="#list-ordering" role="tab" aria-controls="settings">Ordering</a>
                    <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-wip" role="tab" aria-controls="settings">W.I.P</a>-->
                    <a class="list-group-item list-group-item-action" id="list-status-list" data-toggle="list" href="#list-status" role="tab" aria-controls="settings">Ordering Status</a>
                    </div>
                </div>
                <div class="col-10" style="font-size:10px;">
                    <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:10px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Oper</th>
                                    <th>Mark Up</th>
                                    <th>Landing Price</th>
                                    <th>Saving</th>
                                    <th>Additonal</th>
                                    <th>Quoted Price</th>
                                    <th>Actual Price</th>
                                    <th>Part Received?</th>
                                </tr>
                            </thead>
                            <?php echo $table_body;?>
                                
                        </table>
                        <br><br>
                        <table class="table table-sm" style="font-size:10px;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Oper</th>
                                    <th scope="col">Additional Part</th>
                                    <th scope="col">Landing Price</th>
                                    <th scope="col">Saving</th>
                                    <th scope="col">Additional</th>
                                    <th scope="col">Quoted Price</th>
                                    <th scope="col">Actual Price</th>
                                    <th scope="col">Part Received?</th>    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count_additionals=1;?>
                                <?php $__currentLoopData = $additions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($count_additionals); ?></td>
                                    <td><?php echo e($additional->Oper); ?></td>
                                    <td><?php echo e($additional->Description); ?></td>
                                    <td><?php echo e($additional->Part); ?><a href="#" class="btn btn-primary btn-sm edit_landing" data-key_ref="<?php echo e($id); ?>" data-id="<?php echo e($additional->id); ?>"  data-price="<?php echo e($additional->Part); ?>" title="Edit Landing Price" style="margin-left:10px;"><span class="fa fa-edit"></span></a></td>
                                    <td><?php echo e($additional->Part_sales); ?></td>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo e($additional->Part); ?></td>
                                    <td>
                                        <a href="#" title="Status" class="btn btn-info btn-sm"><span class="fa fa-info"></span></a>
                                        <a href="#" title="RFC" class="btn btn-warning btn-sm"><span class="fa fa-history"></span></a>
                                    </td>
                                </tr>
                                <?php $count_additionals++;?>    
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="list-additionals" role="tabpanel" aria-labelledby="list-additionals-list">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:10px;">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Oper</th>
                                    <th>Percentage</th>
                                    <th>Quantity</th>
                                    <th>Part</th>
                                    <th>Labor</th>
                                    <th>Paint</th>
                                    <th>Frame</th>
                                    <th>R&R</th>
                                    <th>Outwork</th>
                                    <th>In Hse</th>
                                    <th>Betterment</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               <form method="POST" action="/pre-costing-additionals">
                               <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="proc_id" id="proc_id" value="<?php echo e($id); ?>">
                                <tr>
                                                                    
                                    <td><input type="text" name="precost_description" id="precost_description" required></td>
                                    <td><select name="precost_oper" id="precost_oper" required>
                                            <option value="">Select Operation</option>
                                            <?php $__currentLoopData = $operations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($oper->oper); ?>"><?php echo e($oper->oper); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td><input type="number"  style="width:50px;" step="0.01" min="0.00" name="precost_perc" id="precost_perc" required></td>
                                    <td><input type="number" style="width:50px;" min="0" name="precost_quan" id="precost_quan" required></td>
                                    <td><input type="text" style="width:100px;" min="0" name="precost_part" id="precost_part" required></td>
                                    <td><input type="text" style="width:50px;" min="0" name="precost_labor" id="precost_labor" required></td>
                                    <td><input type="text" style="width:50px;" min="0" name="precost_paint" id="precost_paint" required></td>
                                    <td><input type="text" style="width:50px;" min="0" name="precost_frame" id="precost_frame" required></td>
                                    <td><input type="text" style="width:50px;" min="0" name="precost_rr" id="precost_rr" required></td>
                                    <td><input type="text" style="width:50px;" min="0" name="precost_outwork" id="precost_outwork" required></td>
                                    <td><input type="text" style="width:50px;" min="0" name="precost_hse" id="precost_hse" required></td>
                                    <td><input type="text" style="width:50px;" min="0" name="precost_bett" id="precost_bett" required></td>
                                    <td>
                                        <div class="btn-group">
                                        <input type="submit" class="btn btn-success btn-sm" value="Save">
                                        
                                        </div>
                                    </td>
                                    
                                </tr>
                                </form>
                            </tbody>

                        </table>
                        <table class="table table-sm" style="font-size:10px;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Oper</th>
                                    <th scope="col">Landing Price</th>
                                    <th scope="col">Saving</th>
                                    <th scope="col">Additional</th>
                                    <th scope="col">Quoted Price</th>
                                    <th scope="col">Actual Price</th>
                                    <th scope="col">Part Received?</th>    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count_additionals=1;?>
                                <?php $__currentLoopData = $additions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($count_additionals); ?></td>
                                    <td><?php echo e($additional->Oper); ?></td>
                                    <td><?php echo e($additional->Part); ?><a href="#" class="btn btn-primary edit_landing btn-sm" data-key_ref="<?php echo e($id); ?>" data-id="<?php echo e($additional->id); ?>"  data-price="<?php echo e($additional->Part); ?>" title="Edit Landing Price" style="margin-left:10px;"><span class="fa fa-edit"></span></a></td>
                                    <td><?php echo e($additional->Part_sales); ?></td>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo e($additional->Part); ?></td>
                                    <td>
                                        <a href="#" title="Status" class="btn btn-info btn-sm"><span class="fa fa-info"></span></a>
                                        <a href="#" title="RFC" class="btn btn-warning btn-sm"><span class="fa fa-history"></span></a>
                                    </td>
                                </tr>
                                <?php $count_additionals++;?>    
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="list-doc" role="tabpanel" aria-labelledby="list-doc-list">
                    <div class="table-responsive table-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Filename</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Upload By</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $count_docs=1;?> 
                               <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                                                    
                                    <td><?php echo e($count_docs); ?></td>
                                    <td><a href="/docs/uploaded/<?php echo e($id); ?>/<?php echo e($doc->url); ?>" target="_blank"><?php echo e($doc->url); ?></a></td>
                                    <td><?php echo e($doc->Description); ?></td>
                                    <td><?php echo e($doc->date); ?></td>
                                    <td><?php echo e($doc->time); ?></td>
                                    <td><?php echo e($doc->user); ?></td>
                                    <td>
                                        <div class="btn-group">
                                        
                                        <a href="/delete-docs-precosting/<?php echo e($doc->id); ?>" class="btn btn-danger btn-sm" title="Delete File"><span class="fa fa-trash"></span></a>
                                        
                                        </div>
                                    </td>
                                    
                                </tr>
                                <?php $count_docs++;?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>
                        <a href="#AddNewDocument" class="btn btn-success btn-sm add_precosting_doc" title="Add New Document">Add New Document</a>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                    <div class="table-responsive table-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Quotes</th>
                                    <th>Date</th>
                                    <th></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                               <?php $count_pre_quotes=1;?> 
                               <?php $__currentLoopData = $pre_quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pre_quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                                                    
                                    <td><?php echo e($count_pre_quotes); ?></td>
                                    <td><a href="#FileUrl" target="_blank"><?php echo e($pre_quote->url); ?></a></td>
                                    <td><?php echo e($pre_quote->Date); ?></td>
                                   
                                    <td>
                                        <div class="btn-group">
                                        
                                        <a href="/delete-docs-prequotes/<?php echo e($pre_quote->id); ?>" class="btn btn-danger btn-sm" title="Delete File"><span class="fa fa-trash"></span></a>
                                        
                                        </div>
                                    </td>
                                    
                                </tr>
                                <?php $count_docs++;?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                        </table>
                        <a href="#AddNewDocument" class="btn btn-success btn-sm add_precosting_doc" title="Add New Document">Add New Document</a>
                    </div>
                    
                    
                    </div>
                    <div class="tab-pane fade" id="list-ordering" role="tabpanel" aria-labelledby="list-ordering-list">
                      <div class="row">  
                        <div class="card shadow mb-3 col-6">
                            <div class="card-body">
                            <form method="POST" action="/pre-costing-order">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="key" id="key" value="<?php echo e($id); ?>">
                            <div class="row">  
                        <select class="custom-select" id="order_parts" name="order_parts[]" style="font-size:10px;" multiple="multiple"  required>
                        <option selected>Open this select menu</option>
                        <?php $__currentLoopData = $storage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($parts->Description); ?>"><?php echo e($parts->Description); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                        </select>
                        
                      </div>  
                      <br>
                        <div class="row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="order_suppliers" style="font-size:10px;">Suppliers</label>
                                </div>
                                <select class="custom-select form-control-sm" id="order_suppliers" style="font-size:10px;" required>
                                    <option selected>Select Supplier</option>
                                    <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($supplier->sup_key); ?>"><?php echo e($supplier->sup_name); ?></option> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                      <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="font-size:10px;">Comments</span>
                            </div>
                            <textarea class="form-control form-control-sm" style="font-size:10px;" rows="5" aria-label="With textarea" name="order_comments" id="order_comments" required></textarea>
                      </div>
                      </div>  
                      <br>
                      <div class="row">
                      <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="font-size:10px;">Notes</span>
                            </div>
                            <textarea class="form-control form-control-sm" style="font-size:10px;" rows="5" aria-label="With textarea" name="order_notes" id="order_notes" required></textarea>
                      </div>
                      </div>
                            </div>
                        </div> 
                        <div class="card shadow mb-3 col-6">
                            <div class="card-body">
                                <div class="row">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="font-size:10px;height:26px;">Suppliers Name</span>
                                        </div>
                                            <input type="text" class="form-control form-control-sm" style="font-size:10px;" placeholder="Supplier Name" aria-label="order_supplier" aria-describedby="order_supplier" id="order_supplier" name="order_supplier" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="font-size:10px;height:26px;">Supplier Email</span>
                                        </div>
                                            <input type="email" class="form-control form-control-sm" style="font-size:10px;" placeholder="Email" aria-label="order_email_supplier" aria-describedby="order_email_supplier" name="order_email_supplier" id="order_email_supplier" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="order_email" style="font-size:10px;height:26px;">Sender Email</span>
                                        </div>
                                            <input type="email" class="form-control form-control-sm" style="font-size:10px;" aria-label="order_email" aria-describedby="order_email" id="order_email_sender" name="order_email_sender" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="order_branch" style="font-size:10px;height:26px;">Branch Tel</span>
                                        </div>
                                            <input type="text" class="form-control form-control-sm" style="font-size:10px;" aria-label="order_branch_tel" name="order_branch_tel" id="order_branch_tel" aria-describedby="order_branch" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="order_follow1" style="font-size:10px;height:26px;">Follow Up 1</span>
                                        </div>
                                            <input type="date" class="form-control form-control-sm" style="font-size:10px;" aria-label="order_follow1" aria-describedby="order_follow1" name="order_follow1" id="order_follow1" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="order_follow2" style="font-size:10px;height:26px;">Follow Up 2</span>
                                        </div>
                                            <input type="date" class="form-control form-control-sm" style="font-size:10px;" aria-label="order_follow2" aria-describedby="order_follow2" name="order_follow2" id="order_follow2" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="order_follow3" style="font-size:10px;height:26px;">Follow Up 3</span>
                                        </div>
                                            <input type="date" class="form-control form-control-sm" style="font-size:10px;" aria-label="order_follow3" name="order_follow3" id="order_follow3" aria-describedby="basic-addon1" required>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <input type="submit" class="btn btn-success btn-sm float-right" value="Save">
                        <!--Send The Email-->
                      </div>   
                      </form>
                    </div>
                    <div class="tab-pane fade" id="list-rfcs" role="tabpanel" aria-labelledby="list-settings-list">
                    <div class="table-responsive">
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
                              
                                <tr>
                                                                    
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="#" class="btn btn-primary btn-sm" target="_blank" title="View File"><span class="fa fa-search"></span></a>
                                        
                                        </div>
                                    </td>
                                    
                                </tr>
                                
                            </tbody>

                        </table>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="list-status" role="tabpanel" aria-labelledby="list-status">
                    
                    <table class="table table-sm" style="font-size:10px;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date/Time</th>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Order No.</th>
                                    
                                    <th scope="col">File</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Comments</th>
                                    <th scope="col">Credits</th>
                                    <th scope="col">Action</th>    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count_orders=1;?>
                                <?php $__currentLoopData = $confirmed_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($count_orders); ?></td>
                                    <td><?php echo e($orders->date); ?></td>
                                    <td><?php echo e($orders->Supplier); ?></td>
                                    <td><?php echo e($orders->order_number); ?></td>
                                    <td><a href="/docs/uploaded/<?php echo e($orders->url); ?>" target="_blank"><?php echo e($orders->url); ?></a></td>
                                    <?php if($orders->mail_status=="Sent"): ?>
                                    <td style="color:green;"><b><?php echo e($orders->mail_status); ?></b></td>    
                                    <?php else: ?>    
                                    <td style="color:red;"><b><?php echo e($orders->mail_status); ?></b></td>
                                    <?php endif; ?>
                                    <td><?php echo e($orders->comment); ?></td>
                                    <td><a href="#" class="btn btn-primary btn-sm create_create_notes" id="credit_no" data-order_no="<?php echo e($orders->order_number); ?>" data-order_id="<?php echo e($orders->id); ?>" title="Credits Notes">Credit Notes</a></td>
                                    <td>
                                        
                                        <a href="/pre-costing-order-email/<?php echo e($orders->id); ?>" title="Send Mail" class="btn btn-success btn-sm"><span class="fa fa-envelope"></span></a>
                                        <a href="/pre-costing-order-email-delete/<?php echo e($orders->id); ?>" title="Delete Mail" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                                    </td>
                                </tr>
                                <?php $count_orders++;?>    
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    </div>

                </div>
                </div>
            </div>
</div>

 <!--Add Documents Modal-->
 <div class="modal fade" id="addDocumentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document" >
      <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title" style="color:white;">Add Invoice Document.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
                  <form method="POST"  action="/creditors-invoice" enctype="multipart/form-data">
                  <?php echo e(csrf_field()); ?>

                  <div class="row">                 
                    <div class="form-group col-12">
                  
                      <label for="doc_branch">Branch:</label>
                      <select class="form-control form-control-sm" name="doc_branch" id="doc_branch" required>
                      <option value=""> Select Branch </option>
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
                        <input type="text" class="form-control form-control-sm" name="doc_amount" id="doc-amount" required>
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
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header secondary bg-secondary">
          <h5 class="modal-title secondary" id="exampleModalLabel" style="color:white;text-align:center;">Select Document Type</h5>
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
          <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-secondary btn-sm select_doc_type" data-dismiss="modal" href="#">Select Document</a>
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
                <select id="proof_branch" name="proof_branch" class="form-control" required>
                    <option value="">Select Branch</option>
                    <option value="Selby">Selby</option>
                    <option value="Longmeadow">Longmeadow</option>
                    <option value="The Glen">The Glen</option>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="proof_image">Statement File:</label>
                <input type="file" name="proof_image" id="proof_image" class="form-control-file" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="proof_description">Description:</label>
                <input type="text" id="proof_description" name="proof_description" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="proof_supplier">Supplier:</label>
                <select name="proof_supplier" id="proof_supplier" class="form-control" required>
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
                <input type="date" id="proof_date" name="proof_date" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="proof_month">Month Paid For:</label>
                <select name="proof_month" id="proof_month" class="form-control" required>
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
                <select id="proof_pay" name="proof_pay" class="form-control" required>
                    <option value="">Select Here</option>
                    <option value="0">Cash</option>
                    <option value="1">Cheque</option>
                    <option value="3">Other</option>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="proof_number">:</label>
                <input type="text" name="proof_number" id="proof_number" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="proof_invoice">Invoice Number:</label>
                <input type="text" id="proof_invoice" name="proof_invoice" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="proof_total">Total (Inc VAT):</label>
                <input type="text" name="proof_total" id="proof_total" class="form-control" required>
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
                <option value=""> Select Branch </option>
                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($branch->branch_name); ?>"><?php echo e($branch->branch_name); ?></option>>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="state_file">Statement File:</label>
                <input type="file" name="image" id="image" class="form-control form-control-sm fform-control-file-sm" required>
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
        <input type="submit" class="btn btn-success btn-sm" value="Save Document">
    </div>
    </form>
    </div>
  </div>  
  </div>
  </div>

<!--Add Supplier RFC Modal-->
<div class="modal fade" id="rfcsDocumentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
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
                        <option value="<?php echo e($branch->branch_name); ?>"><?php echo e($branch->branch_name); ?></option>
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

  <!--Add Documents Precosting-->
   
<div class="modal fade" id="precostingDocsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Add New Document</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/save-docs-precosting" method="POST"  enctype="multipart/form-data">
        <div class="modal-body">
            <input type="hidden" name="precost_id" id="precost_id" value="<?php echo e($id); ?>">
            <?php echo csrf_field(); ?>

          <div class="form-group">
          <label for="image">File:</label>
            <input type="file" id="image" name="image" class="form-control form-control-sm" required>
          </div>
          <div class="form-group">
          <label for="precost_desc">Order No:</label>
            <select id="precost_desc" name="precost_desc" class="form-control form-control-sm" required>
                <?php $__currentLoopData = $descriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $desc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <option value="<?php echo e($desc->description); ?>"><?php echo e($desc->description); ?></option>   
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select> 
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

<!--Edit Landing Price -->
<div class="modal fade" id="editLandingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Edit Landing Price</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/pre-costing-additionals-edit" method="POST">
        <div class="modal-body">
            <input type="hidden" name="landing_id" id="landing_id">
            <input type="hidden" name="landing_part" id="landing_part">
            <?php echo csrf_field(); ?>

          <div class="form-group">
          <label for="landing_price">Landing Price:</label>
            <input type="text" id="landing_price" name="landing_price" class="form-control form-control-sm" required>
          </div>
                              
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary btn-sm" value="Edit Price">
        </div>
        </form>
      </div>
    </div>
  </div>  
  <!--Add New Supplier-->
  <div class="modal fade" id="create_new_supplier_kModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document" style="font-size:10px;">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Create New Supplier.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/pre-costing-create-supplier" method="POST">  
          <?php echo csrf_field(); ?>

          <div class="form-group">
          <label for="supplier_name">Supplier Name:</label>
            <input type="text" id="supplier_name" name="supplier_name" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="supplier_phone">Phone:</label>
            <input type="text" id="supplier_tel" name="supplier_tel" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="supplier_fax">Fax:</label>
            <input type="text" id="supplier_fax" name="supplier_fax" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="supplier_phone">Email:</label>
            <input type="email" id="supplier_email" name="supplier_email" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="supplier_phone">Contact Person:</label>
            <input type="text" id="supplier_person" name="supplier_person" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="supplier_cell">Cell No:</label>
            <input type="text" id="supplier_cell" name="supplier_cell" class="form-control form-control-sm">
          </div>          
          <div class="form-group">
          <label for="supplier_alt">Alternative No:</label>
            <input type="text" id="supplier_alt" name="supplier_alt" class="form-control form-control-sm">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="Save New Supplier">
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- End Create New Supplier Modal-->
<?php $__env->stopSection(); ?>                
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>