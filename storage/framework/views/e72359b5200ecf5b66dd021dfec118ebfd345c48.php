<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">W.I.P/SMS - <?php echo e($key); ?></h4>
            </div>
            <div class="card-body">
                
                <div class="row">
                <div class="col-2">
                    <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Towing</a>
                    
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Bookings</a>
                    
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-pop" role="tab" aria-controls="settings">Business Cards</a>
                    <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-rfcs" role="tab" aria-controls="settings">Seasonal Greetings</a>-->
                    
                    </div>
                </div>
                <div class="col-10">
                    <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                        
                        <div class="row">
                            <div class="col-4">
                                <table>
                                  <thead>
                                    <th colspan="2" style="text-align:center;font-size:16px;">Towing Smses</th>
                                  </thead>
                                  <tbody>  
                                    <?php $__currentLoopData = $towing_sms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><a href="#" class="btn btn-primary send_sms text-sm btn-sm" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>" data-mid="<?php echo e($tow->stage_no); ?>" data-reg="<?php echo e($reg); ?>" data-cell_no="<?php echo e($cell_no); ?>"><?php echo e($tow->title); ?></a></td>
                                        <td><a href="#" class="btn btn-warning send_sms btn-sm" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>"><span class="fa fa-edit"></span></a></td>    
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </tbody>  
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="table table-sm table-dark">
                                    <thead>
                                    <tr>
                                        <th colspan="6" style="text-align:center;">Towing SMS Sent</th>
                                    </tr>  
                                    <tr>
                                        <th>Date/Time</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>User</th>
                                    </tr>  
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $sms_tow_event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sms_tow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <tr>
                                            <td><?php echo e($sms_tow->sent_date); ?> <?php echo e($sms_tow->sent_time); ?></td>
                                            <td><?php echo e($sms_tow->title); ?></td>
                                            <td><?php echo e($sms_tow->status); ?></td>
                                            <td><?php echo e($sms_tow->user); ?></td>
                                          </tr>  
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-profile-list">
                        
                        <div class="row">
                            <div class="col-4">
                            <table>
                                  <thead>
                                    <th colspan="2" style="text-align:center;font-size:16px;">Bookings</th>
                                  </thead>
                                  <tbody>  
                                    <?php $__currentLoopData = $booking_sms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><a href="#" class="btn btn-primary send_sms text-sm btn-sm" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>" data-mid="<?php echo e($tow->stage_no); ?>" data-reg="<?php echo e($reg); ?>" data-cell_no="<?php echo e($cell_no); ?>"><?php echo e($tow->title); ?></a></td>
                                        <td><a href="#" class="btn btn-warning send_sms btn-sm" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>"><span class="fa fa-edit"></span></a></td>    
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
                                        <?php $__currentLoopData = $sms_booking_event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sms_booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <tr>
                                            <td><?php echo e($sms_booking->sent_date); ?> <?php echo e($sms_booking->sent_time); ?></td>
                                            <td><?php echo e($sms_booking->title); ?></td>
                                            <td><?php echo e($sms_booking->status); ?></td>
                                            <td><?php echo e($sms_booking->user); ?></td>
                                          </tr>  
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-pop" role="tabpanel" aria-labelledby="list-messages-list">
                        
                        <div class="row">
                            <div class="col-4">
                            <table>
                                  <thead>
                                    <th colspan="2" style="text-align:center;font-size:16px;">Business Cards</th>
                                  </thead>
                                  <tbody>  
                                    <?php $__currentLoopData = $business_sms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><a href="#" class="btn btn-primary send_sms text-sm btn-sm" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>" data-mid="<?php echo e($tow->stage_no); ?>" data-reg="<?php echo e($reg); ?>" data-cell_no="<?php echo e($cell_no); ?>"><?php echo e($tow->title); ?></a></td>
                                        <td><a href="#" class="btn btn-warning send_sms btn-sm" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>"><span class="fa fa-edit"></span></a></td>    
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </tbody>  
                                </table>
                            </div>
                            <div class="col-6">
                            <table class="table table-sm table-dark">
                                    <thead>
                                    <tr>
                                        <th colspan="6" style="text-align:center;">Business Card SMS Sent</th>
                                    </tr>  
                                    <tr>
                                        <th>Date/Time</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>User</th>
                                    </tr>  
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $sms_business_event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sms_business): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <tr>
                                            <td><?php echo e($sms_business->sent_date); ?> <?php echo e($sms_business->sent_time); ?></td>
                                            <td><?php echo e($sms_business->title); ?></td>
                                            <td><?php echo e($sms_business->status); ?></td>
                                            <td><?php echo e($sms_business->user); ?></td>
                                          </tr>  
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-rfcs" role="tabpanel" aria-labelledby="list-settings-list">
                        <h5 class="text-primary" style="text-align:center;"><b>Seasonal Greetings SMS</b></h5>
                        <div class="row">
                            <div class="col-4">
                                sms- interface
                            </div>
                            <div class="col-6">
                                sms - status
                            </div>
                        </div>
                    </div>
                    

                </div>
                </div>
            </div>
</div>
<?php $__env->stopSection(); ?>            
<?php echo $__env->make('quotations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>