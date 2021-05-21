<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                
                <h4 class="m-0 font-weight-bold text-primary">Customer Care. - <?php echo e($key); ?></h4><br>
                <div class="form-group col-sm-2 float-center">
                <button class="btn btn-success btn-sm dropdown-toggle btn-float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-dropup-auto="false">
                                    Print Previews
                                  </button>
                                  <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/print-clearance-certificate/<?php echo e($key); ?>" target="_blank">Clearance Certificate</a>
                                    <a class="dropdown-item" href="/print-job-card/<?php echo e($key); ?>" target="_blank">Job Card</a>
                                    <a class="dropdown-item" href="/print-non-approved-repair" target="_blank">Non-Approved Repair</a>
                                    <a class="dropdown-item" href="/print-taxi-clearance/<?php echo e($key); ?>" target="_blank">S.A Taxi Clearance</a>
                                    <a class="dropdown-item" href="/print-old-mutual/<?php echo e($key); ?>" target="_blank">Omisure Clearance</a>
                                    <!--<a class="dropdown-item" href="/print-security-checklist/<?php echo e($key); ?>" target="_blank">Security Check List</a>-->
                                    <!--<a class="dropdown-item" href="#" target="_blank">Invoice Details</a>-->
                                    <a class="dropdown-item create-invoice" href="#" data-id="<?php echo e($key); ?>">Create Invoice</a>
                                    <a class="dropdown-item" href="/print-release-payment/<?php echo e($key); ?>" target="_blank">Payment Receipt</a>
                                    
                </div>
                
            </div><br>

            <div class="card-body">
                
                <div class="row">
                    <div class="col-2">
                        <div class="list-group" id="list-tab" role="tablist" style="font-size:10px;">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Payments</a>
                        <!--<a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">NON VAT Invoices</a>-->
                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-notes" role="tab" aria-controls="messages">Notes</a>
                        <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Compare Statements</a>-->
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-documents" role="tab" aria-controls="settings">Documents</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-security-photos" role="tab" aria-controls="settings">Security Photos</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-wip-photos" role="tab" aria-controls="settings">WIP Photos</a>
                        <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-additionals" role="tab" aria-controls="settings">Additionals</a>-->
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-additional-photos" role="tab" aria-controls="settings">Additional Photos</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-wip-sms" role="tab" aria-controls="settings">WIP SMSes</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-client-details" role="tab" aria-controls="settings">Client Details</a>
                        <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-compare" role="tab" aria-controls="settings">Compare RFCs</a>-->
                        </div>
                    </div>
                        <div class="col-10">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                    <div class="row">
                                      <div class="col-5">  
                                      <form action="/customer-care-save" method="POST">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" id="key" name="key" value="<?php echo e($key); ?>">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="excess_1" style="font-size:10px;">Excess 1:</label>
                                                    <input type="number" name="excess_1" id="excess_1" class="form-control form-control-sm"  value="" style="font-size:10px;">
                                                </div>
                                                        
                                                <div class="col-6">
                                                    <label for="private" style="font-size:10px;">Private:</label>
                                                    <input type="number" name="private" id="private" class="form-control form-control-sm"  value="" style="font-size:10px;">
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="excess_2" style="font-size:10px;">Excess 2:</label>
                                                    <input type="number" name="excess_2" id="excess_2" class="form-control form-control-sm"  value="" style="font-size:10px;">
                                                </div>
                                                        
                                                <div class="col-6">
                                                    <label for="private" style="font-size:10px;">Additional Work:</label>
                                                    <input type="number" name="add_work" id="add_work" class="form-control form-control-sm"  value="" style="font-size:10px;">
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="excess_1" style="font-size:10px;">Betterment:</label>
                                                    <input type="number" name="betterment" id="betterment" class="form-control form-control-sm"  value="" style="font-size:10px;">
                                                </div>
                                                        
                                                <div class="col-6">
                                                    <label for="private" style="font-size:10px;">Otherwork:</label>
                                                    <input type="number" name="otherwork" id="otherwork" class="form-control form-control-sm"  value="" style="font-size:10px;">
                                                </div>

                                            </div><br>
                                            <div class="row">
                                                <div class="col-12">
                                                    <textarea id="comment" name="comment" class="form-control form-control-sm" row="3" style="font-size:10px;"></textarea>
                                                </div>
                                            </div><br>
                                            <input type="submit" class="btn btn-success btn-sm float-right" value="Save">

                                      </div>
                                      </form>
                                      <div class="col-7">
                                         
                                         <div class="row">
                                            <table class="table table-bordered table-sm" style="font-size:10px;">
                                               <thead>
                                                   <tr>
                                                       <th>Date</th>
                                                       <th>Amount</th>
                                                       <th>Payment Method</th>
                                                       <th>User</th>
                                                       <th>&nbsp;</th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                   <?php if(count($payments)>0): ?> 
                                                   <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <tr>
                                                       <td><?php echo e($pay->date); ?></td>
                                                       <td><?php echo e($pay->amount); ?></td>
                                                       <td><?php echo e($pay->status); ?></td>
                                                       <td><?php echo e($pay->user); ?></td>
                                                       <td>
                                                           <div class="btn-group">
                                                               <a class="btn btn-primary btn-sm" href="#" data-id="<?php echo e($pay->id); ?>"><span class="fa fa-edit"></span></a>
                                                                <a class="btn btn-danger btn-sm" href="#" data-id="<?php echo e($pay->id); ?>" style="margin-left:5px;"><span class="fa fa-trash"></span></a>
                                                           </div>
                                                       </td>
                                                   </tr>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   <?php else: ?>
                                                   <tr>
                                                       <td>&nbsp;</td>
                                                       <td>&nbsp;</td>
                                                       <td>&nbsp;</td>
                                                       <td>&nbsp;</td>
                                                       <td>
                                                           No Actions
                                                       </td>
                                                   </tr>
                                                   <?php endif; ?> 
                                               </tbody> 
                                            </table> 
                                         </div>
                                         <div class="row">
                                             <div class="col-6">
                                             <label for="total_amount" style="font-size:10px;">Total Amount:</label>
                                             <input type="number" id="total_amount" name="total_amount" class="form-control form-control-sm" style="font-size:10px;">
                                            </div>
                                         </div>
                                         <div class="row">
                                             <div class="col-6">
                                             <label for="total_paid" style="font-size:10px;">Total Paid:</label>
                                             <input type="number" id="total_paid" name="total_paid" class="form-control form-control-sm" style="font-size:10px;">
                                            </div>
                                         </div>
                                         <div class="row">
                                             <div class="col-6">
                                             <label for="balance" style="font-size:10px;">Balance:</label>
                                             <input type="number" id="balance" name="balance" class="form-control form-control-sm" style="font-size:10px;">
                                            </div>
                                         </div>
                                         <div class="row">
                                             <div class="col-6">
                                             <label for="total_payment" style="font-size:10px;">Payment:</label>
                                             <input type="number" id="total_payment" name="total_payment" class="form-control form-control-sm" style="font-size:10px;">
                                            </div>
                                         </div>
                                         <div class="row">
                                             <div class="col-6">
                                             <label for="total_method" style="font-size:10px;">Payment Method:</label>
                                             <select id="total_method" name="total_method" class="form-control form-control-sm" style="font-size:10px;">
                                                <option value="">Select Method</option>
                                                <option value="Card">Card</option>
                                                <option value="EFT">EFT</option>
                                                <option value="Cash">Cash</option>
                                             </select>
                                            </div>
                                         </div><br>
                                         <div class="row">
                                             <div class="btn-group">
                                                 <a class="btn btn-primary btn-sm  float-right" href="/customer-care-release/<?php echo e($key); ?>" target='_blank'>Release & Print Release</a>
                                                 <input type="submit" id="payment" name="payment" value="Perform Payment" class="btn btn-success btn-sm float-right font-sm" style="margin-left:5px;">
                                             </div>
                                         </div>
                                      </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade show" id="list-notes" role="tabpanel" aria-labelledby="list-home-list">
                                        
                                       
                                        <h5 class="text-primary" style="text-align:center;"><b>Notes</b></h5>
                                        <a class="btn btn-success btn-sm float-right customer_care_save_note" data-id="<?php echo e($key); ?>" style="margin-bottom:5px;" href="#" title="Add New Note"><span class="fa fa-plus"></span></a>
                                        <div class="table">
                                            <table class="table table-bordered table-sm" width="100%" cellspacing="0" style="font-size:12px;">
                                                <thead>
                                                <tr>
                                                    <th>Added By</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Notes</th>
                                                    
                                                </tr>
                                                </thead>
                                                <tbody>
                                                
                                                <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        
                                                        <td><?php echo e($note->user); ?></td> 
                                                        <td><?php echo e($note->note); ?></td>
                                                        <td><?php echo e($note->date); ?></td>
                                                        <td><?php echo e($note->time); ?></td>
                                                        
                                                    </tr>
                                                    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <h5 class="text-primary" style="text-align:center"><b>SMSes</b></h5>
                                        <div class="table">
                                            <table class="table table-bordered table-sm" width="100%" cellspacing="0" style="font-size:12px;">
                                                <thead>
                                                <tr>
                                                    <th>Sent By</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Message</th>
                                                    
                                                </tr>
                                                </thead>
                                                <tbody>
                                                
                                                <?php $__currentLoopData = $smses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        
                                                        <td><?php echo e($sms->user); ?></td> 
                                                        <td><?php echo e($sms->sent_date); ?></td>
                                                        <td><?php echo e($sms->sent_time); ?></td>
                                                        <td><?php echo e($sms->message); ?></td>
                                                        
                                                    </tr>
                                                    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                                                </tbody>
                                            </table>
                                        </div>

                                </div>

                                <div class="tab-pane fade show" id="list-documents" role="tabpanel" aria-labelledby="list-home-list">
                                        
                                        <h5 class="text-primary" style="text-align:center;"><b>Uploaded Documents</b></h5>
                                        <a class="btn btn-success btn-sm float-right customer_care_save_document" data-id="<?php echo e($key); ?>" href="#" style="margin-bottom:5px;" title="Upload New Document"><span class="fa fa-plus"></span></a>
                                        <div class="table">
                                            <table class="table table-bordered table-sm" id="" width="100%" cellspacing="0" style="font-size:12px;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Filename</th>
                                                        <th>Description</th>
                                                        <th>Date Modified</th>
                                                        <th>Time</th>
                                                        <th>Modified By</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <?php $count=1;?>
                                                <tbody>
                                                    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>                 
                                                        <td><?php echo e($count); ?></td>                            
                                                        <td><?php echo e($document->url); ?></td>
                                                        <td><?php echo e($document->Description); ?></td>
                                                        <td><?php echo e($document->date); ?></td>
                                                        <td><?php echo e($document->time); ?></td>
                                                        <td><?php echo e($document->user); ?></td>
                                                        <td>
                                                            <a href="/docs/uploaded/<?php echo e($document->Key_Ref); ?>/<?php echo e($document->url); ?>" target="_blank" class="btn btn-primary btn-sm"><span class="fa fa-search"></span></a>
                                                            
                                                        </td>    
                                                    </tr>
                                                    <?php $count++;?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                                                </tbody>

                                            </table>
                                        </div>    
                                </div>

                                <div class="tab-pane fade show" id="list-security-photos" role="tabpanel" aria-labelledby="list-home-list">
                                        <h5 class="text-primary" style="text-align:center;"><b>Security Photos</b></h5>
                                    <div class="row">
                                            <div class="row text-center text-lg-left">
                                            <?php if($images->count()>0): ?>
                                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                                    <a class="thumbnail fancybox" rel="ligthbox" href="/images/mag_security/<?php echo e($image->Key_Ref); ?>/<?php echo e($image->url); ?>" target='_blank'>
                                                        <img class="img-fluid img-thumbnail" alt="" src="/images/mag_security/<?php echo e($image->Key_Ref); ?>/<?php echo e($image->url); ?>" target='_blank'>
                                                        <div class='text-center'>
                                                            <small class='text-muted'></small>
                                                        </div>
                                                    </a>
                                                    <a class="btn btn-danger" href="/line-manager-security-delete/<?php echo e($image->id); ?>"><span class="fa fa-trash" ></span></a>
                                                    
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                            <?php endif; ?>
                                            </div>
                                        </div>    
                                <!--End-->        
                                </div>

                                <div class="tab-pane fade show" id="list-wip-photos" role="tabpanel" aria-labelledby="list-home-list">
                                        <h5 class="text-primary" style="text-align:center;"><b>Work In Progress Photos</b></h5>
                                        
                                        <div class="row">
                                            <div class="row text-center text-lg-left">
                                            <?php if($wip_photos->count() >0): ?>
                                            <?php $__currentLoopData = $wip_photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                                    <a class="thumbnail fancybox" rel="ligthbox" href="/images/mag_photos/<?php echo e($image->Key_Ref); ?>/<?php echo e($image->picture_name); ?>" target="_blank">
                                                        <img class="img-fluid img-thumbnail" alt="" src="/images/mag_photos/<?php echo e($image->Key_Ref); ?>/<?php echo e($image->picture_name); ?>" target='_blank'>
                                                        <div class='text-center'>
                                                            <small class='text-muted'></small>
                                                        </div> <!-- text-center / end -->
                                                    </a>
                                                    <a class="btn btn-danger" href="/line-manager-delete/<?php echo e($image->id); ?>"><span class="fa fa-trash" ></span></a>
                                                    
                                                </div> <!-- col-6 / end -->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                            <?php endif; ?>
                                            </div>
                                        </div>

                                </div>

                                
                                <div class="tab-pane fade show" id="list-additional-photos" role="tabpanel" aria-labelledby="list-home-list">
                                        
                                <h5 class="text-primary" style="text-align:center;"><b>Additional Photos</b></h5>
                                        
                                        <div class="row">
                                            <div class="row text-center text-lg-left">
                                            <?php if($additional_photos->count()): ?>
                                            <?php $__currentLoopData = $additional_photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                                    <a class="thumbnail fancybox" rel="ligthbox" href="/images/mag_photos/<?php echo e($image->Key_Ref); ?>/<?php echo e($image->picture_name); ?>" target="_blank">
                                                        <img class="img-fluid img-thumbnail" alt="" src="/images/mag_photos/<?php echo e($image->Key_Ref); ?>/<?php echo e($image->picture_name); ?>" target="_blank">
                                                        <div class='text-center'>
                                                            <small class='text-muted'></small>
                                                        </div> <!-- text-center / end -->
                                                    </a>
                                                    <a class="btn btn-danger" href="/line-manager-delete/<?php echo e($image->id); ?>"><span class="fa fa-trash" ></span></a>
                                                    
                                                </div> <!-- col-6 / end -->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                            
                                            <?php endif; ?>
                                            </div>
                                        </div>
                                </div>
                                <div class="tab-pane fade show" id="list-wip-sms" role="tabpanel" aria-labelledby="list-wip-sms">
                                        
                                <h5 class="text-primary" style="text-align:center;"><b>WIP/SMS</b></h5>
                                        
                                        <div class="row">
                                            <div class="row text-center text-lg-left">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#towing">Towing</a>
                                                    </li>
                                                    <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#business">Business Card</a>
                                                    </li>
                                                    <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#booking">Booking</a>
                                                    </li>
                                                    <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#carhire">Car Hire</a>
                                                    </li>
                                                    <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#order">Ordering</a>
                                                    </li>
                                                    <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#additional">Customer Care</a>
                                                    </li>

                                                </ul>
                                                <div class="tab-content">
                                                    <div id="towing" class="container tab-pane active"><br>
                                                    <div class="row">
                                                        <div class="col-4">
                                                        <table>
                                                            <thead>
                                                                <th colspan="2" style="text-align:center;font-size:16px;">Towing</th>
                                                            </thead>
                                                            <tbody>  
                                                                <?php $__currentLoopData = $towing_sms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td><a href="#" class="btn btn-primary customercare_sms text-sm btn-sm" style="margin-bottom:5px;" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>" data-mid="<?php echo e($tow->stage_no); ?>" data-reg="<?php echo e($reg); ?>" data-cell_no="<?php echo e($cell_no); ?>"><?php echo e($tow->title); ?></a></td>
                                                                    <td><a href="#" class="btn btn-warning edit_sms btn-sm" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>"><span class="fa fa-edit"></span></a></td>    
                                                                </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </tbody>  
                                                        </table>
                                                        </div>
                                                        <div class="col-6">
                                                        <table class="table table-sm table-dark">
                                                                <thead>
                                                                <tr>
                                                                    <th colspan="6" style="text-align:center;">Booking SMS Sent</th>
                                                                </tr>  
                                                                <tr>
                                                                    <th>Date/Time</th>
                                                                    <th>Title</th>
                                                                    <th>Status</th>
                                                                    <th>User</th>
                                                                </tr>  
                                                                </thead>
                                                                <tbody>
                                                                    <?php $__currentLoopData = $sms_towing_event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sms_towing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><?php echo e($sms_towing->sent_date); ?> <?php echo e($sms_towing->sent_time); ?></td>
                                                                        <td><?php echo e($sms_towing->title); ?></td>
                                                                        <td><?php echo e($sms_towing->status); ?></td>
                                                                        <td><?php echo e($sms_towing->user); ?></td>
                                                                    </tr>  
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    
                                                    </div>
                                                    <div id="business" class="container tab-pane fade"><br>
                                                    <h3>Quotes</h3>
                                                        <div class="row">
                                                            <div class="col-4">
                                                            <table>
                                                            <thead>
                                                                <th colspan="2" style="text-align:center;font-size:16px;">Business Card</th>
                                                            </thead>
                                                            <tbody>  
                                                                <?php $__currentLoopData = $quote_sms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td><a href="#" class="btn btn-primary customercare_sms btn-sm" style="margin-bottom:5px;" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>" data-mid="<?php echo e($tow->stage_no); ?>" data-reg="<?php echo e($reg); ?>" data-cell_no="<?php echo e($cell_no); ?>"><?php echo e($tow->title); ?></a></td>
                                                                    <td><a href="#" class="btn btn-warning edit_sms btn-sm" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>"><span class="fa fa-edit"></span></a></td>    
                                                                </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </tbody>  
                                                        </table>
                                                            </div>
                                                            <div class="col-8">
                                                            <table class="table table-sm table-dark">
                                                                <thead>
                                                                <tr>
                                                                    <th colspan="6" style="text-align:center;">Quotation SMS Sent</th>
                                                                </tr>  
                                                                <tr>
                                                                    <th>Date/Time</th>
                                                                    <th>Title</th>
                                                                    <th>Status</th>
                                                                    <th>User</th>
                                                                </tr>  
                                                                </thead>
                                                                <tbody>
                                                                    <?php $__currentLoopData = $sms_quote_event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sms_towing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><?php echo e($sms_towing->sent_date); ?> <?php echo e($sms_towing->sent_time); ?></td>
                                                                        <td><?php echo e($sms_towing->title); ?></td>
                                                                        <td><?php echo e($sms_towing->status); ?></td>
                                                                        <td><?php echo e($sms_towing->user); ?></td>
                                                                    </tr>  
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </tbody>
                                                            </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="booking" class="container tab-pane fade"><br>
                                                        <div class="row">
                                                            <div class="col-4">
                                                            <table>
                                                            <thead>
                                                                <th colspan="2" style="text-align:center;font-size:16px;">Booking</th>
                                                            </thead>
                                                            <tbody>  
                                                                <?php $__currentLoopData = $booking_sms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td><a href="#" class="btn btn-primary customercare_sms btn-sm" style="margin-bottom:5px;" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>" data-mid="<?php echo e($tow->stage_no); ?>" data-reg="<?php echo e($reg); ?>" data-cell_no="<?php echo e($cell_no); ?>"><?php echo e($tow->title); ?></a></td>
                                                                    <td><a href="#" class="btn btn-warning edit_sms btn-sm" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>"><span class="fa fa-edit"></span></a></td>    
                                                                </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </tbody>  
                                                            </table>
                                                            </div>
                                                            <div class="col-8">
                                                            <table class="table table-sm table-dark">
                                                                <thead>
                                                                <tr>
                                                                    <th colspan="6" style="text-align:center;">Booking SMS Sent</th>
                                                                </tr>  
                                                                <tr>
                                                                    <th>Date/Time</th>
                                                                    <th>Title</th>
                                                                    <th>Status</th>
                                                                    <th>User</th>
                                                                </tr>  
                                                                </thead>
                                                                <tbody>
                                                                    <?php $__currentLoopData = $sms_booking_event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sms_towing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><?php echo e($sms_towing->sent_date); ?> <?php echo e($sms_towing->sent_time); ?></td>
                                                                        <td><?php echo e($sms_towing->title); ?></td>
                                                                        <td><?php echo e($sms_towing->status); ?></td>
                                                                        <td><?php echo e($sms_towing->user); ?></td>
                                                                    </tr>  
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </tbody>
                                                            </table>
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    <div id="carhire" class="container tab-pane fade"><br>
                                                    <h3>Car Hire</h3>
                                                    <div class="row">
                                                            <div class="col-4">
                                                            <table>
                                                            <thead>
                                                                <th colspan="2" style="text-align:center;font-size:16px;">Car Hire</th>
                                                            </thead>
                                                            <tbody>  
                                                                <?php $__currentLoopData = $carhire_sms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td><a href="#" class="btn btn-primary customercare_sms text-sm btn-sm" style="margin-bottom:5px;" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>" data-mid="<?php echo e($tow->stage_no); ?>" data-reg="<?php echo e($reg); ?>" data-cell_no="<?php echo e($cell_no); ?>"><?php echo e($tow->title); ?></a></td>
                                                                    <td><a href="#" class="btn btn-warning edit_sms btn-sm" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>"><span class="fa fa-edit"></span></a></td>    
                                                                </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </tbody>  
                                                            </table>
                                                            </div>
                                                            <div class="col-8">
                                                            <table class="table table-sm table-dark">
                                                                <thead>
                                                                <tr>
                                                                    <th colspan="6" style="text-align:center;">Car Hire SMS Sent</th>
                                                                </tr>  
                                                                <tr>
                                                                    <th>Date/Time</th>
                                                                    <th>Title</th>
                                                                    <th>Status</th>
                                                                    <th>User</th>
                                                                </tr>  
                                                                </thead>
                                                                <tbody>
                                                                    <?php $__currentLoopData = $sms_carhire_event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sms_towing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><?php echo e($sms_towing->sent_date); ?> <?php echo e($sms_towing->sent_time); ?></td>
                                                                        <td><?php echo e($sms_towing->title); ?></td>
                                                                        <td><?php echo e($sms_towing->status); ?></td>
                                                                        <td><?php echo e($sms_towing->user); ?></td>
                                                                    </tr>  
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </tbody>
                                                            </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="order" class="container tab-pane fade"><br>
                                                    <h3>Order</h3>
                                                        <div class="row">
                                                        <div class="col-4">
                                                            <table>
                                                                <thead>
                                                                    <th colspan="2" style="text-align:center;font-size:16px;">Orders</th>
                                                                </thead>
                                                                <tbody>  
                                                                    <?php $__currentLoopData = $ordering_sms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><a href="#" class="btn btn-primary customercare_sms text-sm btn-sm" style="margin-bottom:5px;" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>" data-mid="<?php echo e($tow->stage_no); ?>" data-reg="<?php echo e($reg); ?>" data-cell_no="<?php echo e($cell_no); ?>"><?php echo e($tow->title); ?></a></td>
                                                                        <td><a href="#" class="btn btn-warning edit_sms btn-sm" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>"><span class="fa fa-edit"></span></a></td>    
                                                                    </tr>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </tbody>  
                                                                </table>
                                                        </div>
                                                        <div class="col-8">
                                                        <table class="table table-sm table-dark">
                                                                <thead>
                                                                <tr>
                                                                    <th colspan="6" style="text-align:center;">Ordering SMS Sent</th>
                                                                </tr>  
                                                                <tr>
                                                                    <th>Date/Time</th>
                                                                    <th>Title</th>
                                                                    <th>Status</th>
                                                                    <th>User</th>
                                                                </tr>  
                                                                </thead>
                                                                <tbody>
                                                                    <?php $__currentLoopData = $sms_ordering_event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sms_towing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><?php echo e($sms_towing->sent_date); ?> <?php echo e($sms_towing->sent_time); ?></td>
                                                                        <td><?php echo e($sms_towing->title); ?></td>
                                                                        <td><?php echo e($sms_towing->status); ?></td>
                                                                        <td><?php echo e($sms_towing->user); ?></td>
                                                                    </tr>  
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </tbody>
                                                            </table>
                                                        </div>        
                                                        </div>
                                                    </div>
                                                    <div id="additional" class="container tab-pane fade"><br>
                                                    <h3>Customer Care</h3>
                                                    <div class="row">
                                                        <div class="col-4">
                                                        <table>
                                                                <thead>
                                                                    <th colspan="2" style="text-align:center;font-size:16px;">Customer Care</th>
                                                                </thead>
                                                                <tbody>  
                                                                    <?php $__currentLoopData = $customer_sms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><a href="#" class="btn btn-primary customercare_sms text-sm btn-sm" style="margin-bottom:5px;" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>" data-mid="<?php echo e($tow->stage_no); ?>" data-reg="<?php echo e($reg); ?>" data-cell_no="<?php echo e($cell_no); ?>"><?php echo e($tow->title); ?></a></td>
                                                                        <td><a href="#" class="btn btn-warning edit_sms btn-sm" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>"><span class="fa fa-edit"></span></a></td>    
                                                                    </tr>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </tbody>  
                                                                </table>
                                                        </div>
                                                        <div class="col-8">
                                                        <table class="table table-sm table-dark">
                                                                <thead>
                                                                <tr>
                                                                    <th colspan="6" style="text-align:center;">Customer SMS Sent</th>
                                                                </tr>  
                                                                <tr>
                                                                    <th>Date/Time</th>
                                                                    <th>Title</th>
                                                                    <th>Status</th>
                                                                    <th>User</th>
                                                                </tr>  
                                                                </thead>
                                                                <tbody>
                                                                    <?php $__currentLoopData = $sms_customer_event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sms_towing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><?php echo e($sms_towing->sent_date); ?> <?php echo e($sms_towing->sent_time); ?></td>
                                                                        <td><?php echo e($sms_towing->title); ?></td>
                                                                        <td><?php echo e($sms_towing->status); ?></td>
                                                                        <td><?php echo e($sms_towing->user); ?></td>
                                                                    </tr>  
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="tab-pane fade show" id="list-client-details" role="tabpanel" aria-labelledby="list-home-list">
                                        <h5 class="text-primary" style="text-align:center;"><b>Update Client Details</b></h5><br>
                                        <div class="card-body">
                <div class="row" style="font-size:10px;">
                    <!--Client Details-->
                            <div class="card shadow mb-3 col-3" style="font-size:10px;">
                        <div class="card-header py-3">
                        
                        <h6 class="m-0 font-weight-bold text-primary">Client Details.</h6>
                        <?php $__currentLoopData = $clients_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <form action="/edit-client-details" method="GET">
                        <input type="hidden" id="ref" name="ref" value="<?php echo e($key); ?>">
                            <div class="card-body" style="font-size:10px;">
                            <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Name</span>
                                </div>
                                <input type="text" name="name_edit" id="name_edit" class="form-control form-control-sm" value="<?php echo e($client->Fisrt_Name); ?>" style="margin-bottom:10px;font-size:10px;">
                            </div>
                            <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Lastname</span>
                                </div>
                                <input type="text" name="lastname_edit" id="lastname_edit" class="form-control form-control-sm"  value="<?php echo e($client->Last_Name); ?>" style="margin-bottom:10px;font-size:10px;">
                            </div>
                            <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">ID No.</span>
                                </div>
                                <input type="text" name="id_number_edit" id="id_number_edit" class="form-control form-control-sm" value="<?php echo e($client->id_number); ?>" style="margin-bottom:10px;font-size:10px;">
                            </div>
                            <div class="input-group sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">DOB</span>
                            </div>
                                <input type="date" name="dob_edit" id="odb_edit" class="form-control form-control-sm" aria-describedby="basic-addon1" style="margin-bottom:10px;font-size:10px;" value="<?php echo e($client->BirthDate); ?>">
                            </div>
                            <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Mobile</span>
                                </div>
                                <input type="text" name="mobile_edit" id="mobile_edit" class="form-control form-control-sm" value="<?php echo e($client->Cell_number); ?>" style="margin-bottom:10px;font-size:10px;">
                            </div>
                            <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Email</span>
                                </div>
                                <input type="email" name="client_email_edit" id="client_email_edit" class="form-control form-control-sm" value="<?php echo e($client->Email); ?>" style="margin-bottom:10px;font-size:10px;">
                            </div>
                            <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Street</span>
                                </div>                        
                                <input type="text" name="street_edit" id="street_edit" class="form-control form-control-sm" value="<?php echo e($client->Address_1); ?>" style="margin-bottom:10px;font-size:10px;">
                            </div>
                            <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Suburb</span>
                                </div>
                                <input type="text" name="surburb_edit" id="surburb_edit" class="form-control form-control-sm" value="<?php echo e($client->Address_2); ?>" style="margin-bottom:10px;font-size:10px;">
                            </div>
                            <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">City</span>
                                </div>
                                    <input type="text" name="city_edit" id="city_edit" class="form-control form-control-sm" value="<?php echo e($client->Address_3); ?>" style="margin-bottom:10px;font-size:10px;">
                            </div>
                            <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Estimator</span>
                                </div>
                                  <input type="text" name="estimator_edit" id="estimator_edit" class="form-control form-control-sm" value="<?php echo e($client->Estimator); ?>" style="margin-bottom:10px;font-size:10px;">
                            </div>    
                            <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Branch</span>
                                </div>
                                <input type name="branch_edit" id="branch_edit" class="form-control form-control-sm" value="<?php echo e($client->branch); ?>" style="margin-bottom:10px;font-size:10px;">
                            </div>
                        </div>
                    </div>
                    <!--End Details-->
                    
                    <!--Vehicle Details-->
                    <div class="card shadow mb-3 col-3" style="margin-left:5px;">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Vehicle Details.</h6>
                        </div>
                        <div class="card-body">
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Registration</span>
                                </div>
                                <input type="text" name="registration_edit" id="registration_edit" class="form-control form-control-sm" value="<?php echo e($client->Reg_No); ?>" style="margin-bottom:10px;font-size:10px;">
                        </div>        
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">VIN</span>
                                </div>
                                    <input type="text" name="vin_number_edit" id="vin_number_edit" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Eng No.</span>
                                </div>            
                                <input type="text" name="engine_number_edit" id="engine_number_edit" value="<?php echo e($client->Eng_No); ?>" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;">
                        </div>   
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Make</span>
                                </div>
                                <input type="text" name="make_edit" id="make_edit" class="form-control form-control-sm" value="<?php echo e($client->Make); ?>" style="margin-bottom:10px;font-size:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Model</span>
                                </div>        
                                <input type="text" name="model_edit" id="model_edit" class="form-control form-control-sm" value="<?php echo e($client->Model); ?>" style="margin-bottom:10px;font-size:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">ODO</span>
                                </div>
                                <input type="text" name="odometer_edit" id="odometer_edit" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Colour</span>
                                </div>        
                                <input type="text" name="colour_edit" id="colour_edit" placeholder="Colour" class="form-control form-control-sm" value="<?php echo e($client->Colour); ?>" style="margin-bottom:10px;font-size:10px;"> 
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Year</span>
                                </div>        
                                <input type="text" name="year_edit" id="year_edit" class="form-control form-control-sm" value="<?php echo e($client->Vehicle_year); ?>" style="margin-bottom:10px;font-size:10px;">
                        </div>
                        <div class="input-group sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="height:25px;font-size:10px;" id="basic-addon1">Booking</span>
                            </div>
                                <input type="date" name="booking_edit" id="booking_edit" placeholder="Booking Date" class="form-control form-control-sm" value="<?php echo e($client->booking_date); ?>" aria-describedby="basic-addon1" style="margin-bottom:10px;font-size:10px;">
                        </div>
                        <div class="input-group input-sm">
                            <div class="input-group-prepend input-sm">
                                <span class="input-group-text" style="height:25px;font-size:10px;" id="basic-addon1">Quote D.</span>
                            </div>
                                <input type="date" name="quote_date_edit" id="quote_date_edit" placeholder="Quote Date" class="form-control form-control-sm" aria-describedby="basic-addon1" style="margin-bottom:10px;font-size:10px;" value="<?php echo e($client->Date); ?>">
                        </div><br>
                        </div>
                    </div>
                    <!--End Vehicles-->
                    
                    <!--Insurance Details-->
                    <div class="card shadow mb-3 col-3" style="margin-left:5px;">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Insurance Details.</h6>
                        </div>
                        <div class="card-body">
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Insurance</span>
                                </div>
                                <select name="insurance_type_edit" id="insurance_type_edit_edit" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;">
                                    <option value="1">Private</option>
                                    <option value="2">Insurance</option>
                                    <option value="3">Dealership</option>
                                </select>
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Insuror</span>
                                </div>        
                                    <select name="insuror" id="insuror_edit" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;" value="<?php echo e($client->Inserer); ?>">
                                        <option value="1">Select Insurer</option>
                                                                                
                                    </select>
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">I. Contact</span>
                                </div>            
                                <input type="text" name="contact_number_edit" id="contact_number_edit" value="<?php echo e($client->ins_contact); ?>"class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;" disabled>
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">I. Email</span>
                                </div>    
                                <input type="text" name="insurance_email_edit" id="insurance_email_edit" value="<?php echo e($client->ins_email); ?>" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;" disabled>
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Claim No.</span>
                                </div>        
                                <input type="text" name="claim_number_edit" id="claim_number_edit" value="<?php echo e($client->ins_claim); ?>" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;" disabled>
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Clerk Ref.</span>
                                </div>        
                                <input type="text" name="clerk_ref_edit" id="clerk_ref_edit" value="<?php echo e($client->ClerkName); ?>"class="form-control form-control-sm"  style="margin-bottom:10px;font-size:10px;" disabled>
                        </div>  
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Assessor</span>
                                </div>      
                                <select name="assessor_edit" id="assessor_edit" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;" disabled>
                                    <option value="">Select Assessor</option>
                                   
                                    
                                </select>
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">A.Email</span>
                                </div>        
                                <input type="email" name="assessor_email_edit" id="assessor_email_edit" value="<?php echo e($client->Assessor_Email); ?>" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;" disabled>
                        </div>        
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">A.Contact</span>
                                </div>
                                <input type="text" name="assessor_no_edit" id="assessor_no_edit" value="<?php echo e($client->Assessor_Cell); ?>" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;" disabled>
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">A.Company</span>
                                </div>        
                                <input type="text" name="assessor_company_edit" id="assessor_company_edit" value="<?php echo e($client->Assessor_comp); ?>" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;" disabled>
                        </div>        
                        </div>
                        
                    </div>
                    <!--End Insurance-->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>
                            </div>
                            <div class="btn-group float-right">
                                <input type="submit" value="Save" class="btn btn-primary btn-sm">
                            </div> 
                        </form>     
                            
                        </div>
                        
                </div>
                </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>