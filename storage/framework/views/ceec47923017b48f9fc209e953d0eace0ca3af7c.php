<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            
            <div class="card-header py-2">
                <h4 class="font-weight-bold text-primary">Client Details - <?php echo e($key); ?></h4>
                
            </div>
            <div class="card-body" style="font-size:6px;">
                <div class="card-deck">
                    <!--Client Details-->
                        <div class="card shadow col-3" style="font-size:6px;">
                        <div class="card-header py-3">
                        
                        <h6 class="m-0 font-weight-bold text-primary">Client Details.</h6>
                        <?php $__currentLoopData = $clients_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <form action="/edit-client-details" method="GET">
                        <input type="hidden" id="ref" name="ref" value="<?php echo e($key); ?>">
                            <div class="card-body">
                            <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Name</span>
                                </div>
                                <input type="text" name="name_edit" id="name_edit" class="form-control form-control-sm" value="<?php echo e($client->Fisrt_Name); ?>" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Lastname</span>
                                </div>
                                <input type="text" name="lastname_edit" id="lastname_edit" class="form-control form-control-sm" value="<?php echo e($client->Last_Name); ?>" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">ID No.</span>
                                </div>
                                <input type="text" name="id_number_edit" id="id_number_edit" class="form-control form-control-sm" value="<?php echo e($client->id_number); ?>" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                            <div class="input-group-prepend">
                                <span class="input-group-text sm" id="basic-addon1" style="height:32px;">DOB</span>
                            </div>
                                <input type="date" name="dob_edit" id="odb_edit" class="form-control form-control-sm" aria-describedby="basic-addon1" style="margin-bottom:10px;" value="<?php echo e($client->BirthDate); ?>">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Mobile</span>
                                </div>
                                <input type="text" name="mobile_edit" id="mobile_edit" class="form-control form-control-sm" value="<?php echo e($client->Cell_number); ?>" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Email</span>
                                </div>
                                <input type="email" name="client_email_edit" id="client_email_edit" class="form-control form-control-sm" value="<?php echo e($client->Email); ?>" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Street</span>
                                </div>                        
                                <input type="text" name="street_edit" id="street_edit" class="form-control form-control-sm" value="<?php echo e($client->Address_1); ?>" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Suburb</span>
                                </div>
                                <input type="text" name="surburb_edit" id="surburb_edit" class="form-control form-control-sm" value="<?php echo e($client->Address_2); ?>" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">City</span>
                                </div>
                                    <input type="text" name="city_edit" id="city_edit" class="form-control form-control-sm" value="<?php echo e($client->Address_3); ?>" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Estimator</span>
                                </div>
                                  <input type="text" name="estimator_edit" id="estimator_edit" class="form-control form-control-sm" value="<?php echo e($client->Estimator); ?>" style="margin-bottom:10px;">
                            </div>    
                            <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Branch</span>
                                </div>
                                <select type name="branch_edit" id="branch_edit" class="form-control form-control-sm" style="margin-bottom:10px;">
                                <option selected value="<?php echo e($client->branch); ?>"><?php echo e($client->branch); ?></option>
                                
                                <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <option value="<?php echo e(substr($branch->branch_name,4)); ?>"><?php echo e(substr($branch->branch_name,4)); ?></option>     
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--End Details-->
                    
                    <!--Vehicle Details-->
                    <div class="card shadow col-3">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Vehicle Details.</h6>
                        </div>
                        <div class="card-body">
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Registration</span>
                                </div>
                                <input type="text" name="registration_edit" id="registration_edit" class="form-control form-control-sm" value="<?php echo e($client->Reg_No); ?>" style="margin-bottom:10px;">
                        </div>        
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">VIN</span>
                                </div>
                                    <input type="text" name="vin_number_edit" id="vin_number_edit" class="form-control form-control-sm" style="margin-bottom:10px;" value="<?php echo e($client->Chasses_No); ?>">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Eng No.</span>
                                </div>            
                                <input type="text" name="engine_number_edit" id="engine_number_edit" value="<?php echo e($client->Eng_No); ?>" class="form-control form-control-sm" style="margin-bottom:10px;">
                        </div>   
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Make</span>
                                </div>
                                <input type="text" name="make_edit" id="make_edit" class="form-control form-control-sm" value="<?php echo e($client->Make); ?>" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Model</span>
                                </div>        
                                <input type="text" name="model_edit" id="model_edit" class="form-control form-control-sm" value="<?php echo e($client->Model); ?>" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">ODO</span>
                                </div>
                                <input type="text" name="odometer_edit" id="odometer_edit" class="form-control form-control-sm" style="margin-bottom:10px;" value="<?php echo e($client->KM); ?>">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Colour</span>
                                </div>        
                                <input type="text" name="colour_edit" id="colour_edit" placeholder="Colour" class="form-control form-control-sm" value="<?php echo e($client->Colour); ?>" style="margin-bottom:10px;"> 
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Year</span>
                                </div>        
                                <input type="text" name="year_edit" id="year_edit" class="form-control form-control-sm" value="<?php echo e($client->Vehicle_year); ?>" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group sm">
                            <div class="input-group-prepend" style="font-size:8px;">
                                <span class="input-group-text" style="height:32px;" id="basic-addon1">Booking</span>
                            </div>
                                <input type="date" name="booking_edit" id="booking_edit" placeholder="Booking Date" class="form-control form-control-sm" value="<?php echo e($client->Date); ?>" aria-describedby="basic-addon1" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group input-sm">
                            <div class="input-group-prepend input-sm" style="font-size:8px;">
                                <span class="input-group-text" style="height:32px;" id="basic-addon1">Quote D.</span>
                            </div>
                                <input type="date" name="quote_date_edit" id="quote_date_edit" placeholder="Quote Date" class="form-control form-control-sm" aria-describedby="basic-addon1" style="margin-bottom:10px;" value="<?php echo e($client->Date); ?>">
                        </div><br>
                        </div>
                    </div>
                    <!--End Vehicles-->
                    
                    <!--Insurance Details-->
                    <div class="card shadow col-3">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Insurance Details.</h6>
                        </div>
                        <div class="card-body">
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Insurance</span>
                                </div>
                                  <select name="insurance_type_edit" id="insurance_type_edit" class="form-control form-control-sm" style="margin-bottom:10px;" >
                                    <?php if($client->Inserer=="Private"): ?>
                                        <option value="1" selected>Private</option>
                                        <option value="2" >Insurance</option>    
                                        <option value="3">Dealership</option>
                                    <?php else: ?>    
                                        <option value="2" selected>Insurance</option>
                                        <option value="1">Private</option>
                                        <option value="3">Dealership</option>
                                    <?php endif; ?>
                                    
                                </select>
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Insuror</span>
                                </div>        
                                    <select name="insuror_edit" id="insuror_edit" class="form-control form-control-sm" style="margin-bottom:10px;">
                                        <option value="1">Select Insurer</option>
                                        <option value="<?php echo e($client->Inserer); ?>" selected><?php echo e($client->Inserer); ?></option>
                                        <?php $__currentLoopData = $brokers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $broker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($broker->broker); ?>"><?php echo e($broker->broker); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </select>
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">I. Contact</span>
                                </div>            
                                <input type="text" name="contact_number_edit" id="contact_number_edit" value="<?php echo e($client->ins_contact); ?>"class="form-control form-control-sm" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">I. Email</span>
                                </div>    
                                <input type="text" name="insurance_email_edit" id="insurance_email_edit" value="<?php echo e($client->ins_email); ?>" class="form-control form-control-sm" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                  <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Claim No.</span>
                                </div>        
                                <input type="text" name="claim_number_edit" id="claim_number_edit" value="<?php echo e($client->ins_claim); ?>" class="form-control form-control-sm" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Clerk Ref.</span>
                                </div>        
                                <input type="text" name="clerk_ref_edit" id="clerk_ref_edit" value="<?php echo e($client->ClerkName); ?>" class="form-control form-control-sm"  style="margin-bottom:10px;">
                        </div>  
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Assessor</span>
                                </div>      
                                <select name="assessor_edit" id="assessor_edit" class="form-control form-control-sm" style="margin-bottom:10px;">
                                    <option value="">Select Assessor</option>
                                    <?php $__currentLoopData = $assessor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asessor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($asessor->Names); ?>"><?php echo e($asessor->Names); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 
                                </select>
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">A.Email</span>
                                </div>        
                                <input type="email" name="assessor_email_edit" id="assessor_email_edit" value="<?php echo e($client->Assessor_Email); ?>" class="form-control form-control-sm" style="margin-bottom:10px;">
                        </div>        
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">A.Contact</span>
                                </div>
                                <input type="text" name="assessor_no_edit" id="assessor_no_edit" value="<?php echo e($client->Assessor_Cell); ?>" class="form-control form-control-sm" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">A.Company</span>
                                </div>        
                                <input type="text" name="assessor_company_edit" id="assessor_company_edit" value="<?php echo e($client->Assessor_comp); ?>" class="form-control form-control-sm" style="margin-bottom:10px;">
                        </div>        
                        </div>
                    </div>
                    <!--End Insurance-->
                    
                    <!--Tow Details-->
                        <div class="card shadow col-3">
                            <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tow Details.</h6>
                            </div>
                                <div class="card-body">
                                <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Towed?</span>
                                </div>
                                    <select name="towed_edit" id="towed_edit" class="form-control form-control-sm" style="margin-bottom:10px;">
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                    
                                    </select>
                                </div>
                                <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">By?</span>
                                </div>    
                                    <select name="towed_by_edit" id="towed_by_edit" class="form-control form-control-sm" style="margin-bottom:10px;">
                                        <option value="">Towed By</option>
                                        <?php $__currentLoopData = $towing_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($tow->towing); ?>"><?php echo e($tow->towing); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </select>
                                </div>
                                <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Contact</span>
                                </div>    
                                    <input type="text" name="tow_contact_number_edit" id="tow_contact_number_edit" value="<?php echo e($client->tow_tel); ?>" class="form-control form-control-sm" style="margin-bottom:10px;">
                                </div>    
                                <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Email</span>
                                </div>
                                    <input type="email" name="tow_email_edit" id="tow_email_edit" value="<?php echo e($client->tow_email); ?>" class="form-control form-control-sm" style="margin-bottom:10px;">
                                </div>    
                                <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Fee</span>
                                </div>    
                                    <input type="text" name="tow_fee_edit" id="tow_fee_edit" value="<?php echo e($client->towing_fee1); ?>" class="form-control form-control-sm" style="margin-bottom:10px;">
                                </div>
                                <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">File Status</span>
                                </div>    
                                    <select name="towed_status_edit" id="towed_status_edit" class="form-control form-control-sm" style="margin-bottom:10px;">
                                        <option value="1">Open</option>
                                        <option value="2">Open & Auth</option>
                                        <option value="3">Closed</option>
                                    </select>
                                </div>
                        </div>
                    <!--End Tow-->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="btn-group">
                <input type="submit" value="Save" class="btn btn-primary">
            </div> 
            </form>   

</div>            

<?php $__env->stopSection(); ?>
<?php echo $__env->make('quotations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>