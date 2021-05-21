<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                
                <h4 class="m-0 font-weight-bold text-primary">Labour Analysis - <?php echo e($key); ?></h4><br>
                <!-- <a href="/line-manager-analysis" class="btn btn-primary btn-sm float-left" title="Back To Vehicle List">Back</a> -->
                <a href="javascript:history.go(-1)" class="btn btn-danger btn-sm" title="Back To Precosting List">Back</a>

                <a href="#" class="btn btn-success btn-sm final_stage_additional_add" data-id="<?php echo e($key); ?>" title="Additionals">Additionals</a> 

                <button type="button" class="btn btn-dark btn-sm dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left:5px;">
                Photos
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                <a class="dropdown-item final_photos" data-id="<?php echo e($key); ?>" data-category="SECURITY"  href="#">Security Photos  [ <?php echo e($security_photo_count); ?> ]</a>
                <a class="dropdown-item final_photos" data-id="<?php echo e($key); ?>" data-category="FINAL STAGE" href="#">Final Photos [ <?php echo e($final_photo_count); ?> ]</a>
                <a class="dropdown-item final_photos" data-id="<?php echo e($key); ?>" data-category="ADDITIONAL" href="#">Additional Photos  [ <?php echo e($additional_photo_count); ?> ]</a>
                <a class="dropdown-item final_photos" data-id="<?php echo e($key); ?>" data-category="WORK IN PROGRESS" href="#">WIP Photos [ <?php echo e($wip_photo_count); ?> ]</a>

                </div>


                <a href="/print-consumables/<?php echo e($key); ?>" class="btn btn-danger float-right btn-sm" title="Print Consumerables" target="_blank" style="margin-left:5px;"><span class="fa fa-tags"></span> Print Consumerables</a>
                <a href="/print-time-sheet/<?php echo e($key); ?>" class="btn btn-secondary float-right btn-sm" title="Print Time Sheet" target='_blank'  style="margin-left:5px;"><span class="fa fa-print"></span> Print Time Sheet</a>
                <a href="/print-itemized/<?php echo e($key); ?>" class="btn btn-warning float-right btn-sm" title="Print Intemized LIst" target="_blank"><span class="fa fa-shopping-cart"></span> Print Intemized LIst</a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="col-2">
                        <div class="list-group" id="list-tab" role="tablist" style="font-size:12px;">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">View</a>
                        <!--<a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">NON VAT Invoices</a>-->
                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-notes" role="tab" aria-controls="messages">Notes</a>
                        <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Compare Statements</a>-->
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-documents" role="tab" aria-controls="settings">Documents</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-security-photos" role="tab" aria-controls="settings">Security Photos</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-wip-photos" role="tab" aria-controls="settings">WIP Photos</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-additionals" role="tab" aria-controls="settings">Additionals</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-additional-photos" role="tab" aria-controls="settings">Additional Photos</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-manager-wip" role="tab" aria-controls="settings">Manager WIP</a>
                        <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-itemized-consumerable" role="tab" aria-controls="settings">Intemized Consumerable</a>-->
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-client-details" role="tab" aria-controls="settings">Client Details</a>
                        <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-compare" role="tab" aria-controls="settings">Compare RFCs</a>-->
                        </div>
                    </div>
                        <div class="col-10">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                        <h5 class="text-primary" style="text-align:center;margin-bottom:10px;"><b>Consumerables</b></h5>
                                        <div class="table">
                                            <table class="table table-bordered table-sm" width="100%" cellspacing="0" style="font-size:12px;">
                                                <thead>
                                                    <tr>
                                                        <th>Description</th>
                                                        <th>Quantity</th>
                                                        <th>Recieved By</th>
                                                        <th>Date</th>
                                                        <th>Branch</th>
                                                        <th>Amount Per Unit</th>
                                                        <th>Total</th>
                                                        <!--<th><a href="#" title="Print Consumerables" class="btn btn-secondary btn-sm"><span class="fa fa-print"></span></a></th>-->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php echo $tble;?>
                                                    
                                                </tbody>

                                            </table>
                                        </div>
                                        <h5 class="text-primary" style="text-align:center;"><b>Labor</b></h5>   
                                        <div class="table">
                                            <table class="table table-bordered table-sm" width="100%" cellspacing="0" style="font-size:12px;">
                                                <thead>
                                                <tr>
                                                    <th>LABOR</th>
                                                    <th>ALLOWED TIME</th>
                                                    <th>SPENT TIME</th>
                                                    <th>ALLOWED AMOUNT</th>
                                                    <th>SPENT AMOUNT</th>
                                                    <th>SAVED AMOUNT</th>
                                                    <th>LOST AMOUNT</th>
                                                    <!--<th><a href="#" title="Print Labor Analysis" class="btn btn-secondary btn-sm"><span class="fa fa-print"></span></a></th>-->
                                                </tr>
                                                </thead>
                                                <tbody>
                                                   <?php 
                                                   echo $panel_tbl;
                                                   echo $paint_tbl;
                                                   echo $assembly_tbl;
                                                   echo $mechanical_tbl;
                                                   echo $cleaning_tbl; 
                                                   ?>
                                                        
                                                </tbody>
                                            </table>
                                        </div>
                                </div>

                                <div class="tab-pane fade show" id="list-notes" role="tabpanel" aria-labelledby="list-home-list">
                                        
                                        <div class="row">
                                                <form method="POST" action="/client-notes-add" class="form-group col-10">
                                                <?php echo e(csrf_field()); ?>

                                                <input type="hidden" id="key" name="key" value="<?php echo e($key); ?>">
                                                    <div class="form-group col-10">
                                                    <label for="client_notes">Notes:</label>
                                                            <textarea id="client_notes" name="client_notes" rows="5" class="form-control" required></textarea>
                                                    </div>
                                                    <div class="form-group float-right">
                                                        <div class="btn-group float-right">
                                                            <input type="submit" class="btn btn-success btn-sm" value="Add Notes" style="margin-right:5px;margin-left:12px;">
                                                            <a href="/print-client-note/<?php echo e($key); ?>" class="btn btn-primary btn-sm" target="_blank"><span class="fa fa-print">Print Notes.</span></a>
                                                        </div>
                                                </form>
                                                    </div>    
                                        </div>
                                        <h5 class="text-primary" style="text-align:center;"><b>Notes</b></h5>
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
                                        <h5 style="text-align:center;" class="text-primary"><b>Documents Upload</b></h5>
                                        <div class="row">
                                            <form action="/line-manager-upload-doc" class="form-control-sm" method="POST" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>

                                            <input type="hidden" name="ref" id="ref" value="<?php echo e($key); ?>">
                                            <div class="row">
                                            <div class="col-sm-5">
                                                <strong>Doc Description:</strong>
                                                <select name="description" id="description" class="form-control form-control-sm" required>
                                                <option value="">Choose Document Type</option>
                                                <?php $__currentLoopData = $doc_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($docs->description); ?>"><?php echo e($docs->description); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                                </select>
                                            </div>
                                            <div class="col-sm-5">
                                                <strong>Image:</strong>
                                                <input type="file" name="image" id="image" class="form-control-file" required>
                                            </div>
                                            <div class="col-sm-2">
                                                <br/>
                                                <button type="submit" class="btn btn-success btn-sm">Upload</button>
                                            </div>
                                            </div>
                                            </form>
                                        </div><br><br>
                                        <br>
                                        <h5 class="text-primary" style="text-align:center;"><b>Uploaded Documents</b></h5>
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
                                                    <?php 
                                                        $file_name="";  
                                                        $path = 'docs/uploaded/'.$key.'/'.$document->url;
                                                        $path2 = 'http://192.168.0.185:8080/MAG_System/models/UploadedDocs/'.$key.'/'.$document->url;
                                                        
                                                        if (file_exists($path)) {
                                                        $file_name =asset('/docs/uploaded/'.$key.'/'.$document->url);
                                                        } else {
                                                        $file_name = $path2;
                                                        }
                                                    ?>
                                                    <tr>                 
                                                        <td><?php echo e($count); ?></td>                            
                                                        <td><?php echo e($document->url); ?></td>
                                                        <td><?php echo e($document->Description); ?></td>
                                                        <td><?php echo e($document->date); ?></td>
                                                        <td><?php echo e($document->time); ?></td>
                                                        <td><?php echo e($document->user); ?></td>
                                                        <td>
                                                            <a href="<?php echo e($file_name); ?>" target="_blank" class="btn btn-primary btn-sm"><span class="fa fa-search"></span></a>
                                                            
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
                                            <div>
                                            <form action="/line-manager-security-upload" class="form-control-file" method="POST" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>

                                            <input type="hidden" name="ref" id="ref" value="<?php echo e($key); ?>">
                                            <div class="row">
                                            <div class="col-md-5">
                                                <strong>Title:</strong>
                                                <input type="text" name="title" class="form-control form-control-sm" placeholder="Title">
                                            </div>
                                            <div class="col-md-5">
                                                <strong>Image:</strong>
                                                <input type="file" name="image" class="form-control-file" required>
                                            </div>
                                            <div class="col-md-2">
                                                <br/>
                                                <button type="submit" class="btn btn-success btn-sm">Upload</button>
                                            </div>
                                            </div>
                                            </form>
                                            </div>
                                        </div><br><br>
                                        <div class="row">
                                            <div class="row text-center text-lg-left">
                                            <?php if($images->count()): ?>
                                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php 
                                            $file_name="";  
                                            $path = 'images/mag_security/'.$image->Key_Ref.'/'.$image->url;
                                            $path2 = 'http://192.168.0.185:8080/mag_qoutation/mag_snapshot/security_images/'.$image->Key_Ref.'/'.$image->url;
                                            if (file_exists($path)) {
                                            $file_name =asset('/images/mag_security/'.$image->Key_Ref.'/'.$image->url);
                                            } else {
                                                $file_name = $path2;
                                            }
                                            ?>
                                                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                                    <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo e($file_name); ?>" target="_blank">
                                                        <img class="img-fluid img-thumbnail" alt="" src="<?php echo e($file_name); ?>">
                                                        <div class='text-center'>
                                                            <small class='text-muted'></small>
                                                        </div> <!-- text-center / end -->
                                                    </a>
                                                    <a class="btn btn-danger" href="/line-manager-security-delete/<?php echo e($image->id); ?>"><span class="fa fa-trash" ></span></a>
                                                    
                                                </div> <!-- col-6 / end -->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                            
                                            <?php endif; ?>
                                            </div>
                                        </div>    
                                <!--End-->        
                                </div>

                                <div class="tab-pane fade show" id="list-wip-photos" role="tabpanel" aria-labelledby="list-home-list">
                                        <h5 class="text-primary" style="text-align:center;"><b>Work In Progress Photos</b></h5>
                                        <div class="row">
                                            <form action="/line-manager-upload-photo-wip" class="form-control-sm" method="POST" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>

                                            <input type="hidden" name="ref" id="ref" value="<?php echo e($key); ?>">
                                            <div class="row">
                                            <div class="col-md-5">
                                                <strong>Title:</strong>
                                                <input type="text" name="title" class="form-control form-control-sm" placeholder="Title">
                                            </div>
                                            <div class="col-md-5">
                                                <strong>Image:</strong>
                                                <input type="file" name="image" class="form-control-sm form-control-file" required>
                                            </div>
                                            <div class="col-md-2">
                                                <br/>
                                                <button type="submit" class="btn btn-success btn-sm">Upload</button>
                                            </div>
                                            </div>
                                            </form>
                                        </div><br><br>
                                        <div class="row">
                                            <div class="row text-center text-lg-left">
                                            <?php if($wip_photos->count()): ?>
                                            <?php $__currentLoopData = $wip_photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php 
                                            $file_name="";  
                                            $path = 'images/mag_photos/'.$image->Key_Ref.'/'.$image->picture_name;
                                            $path2 = 'http://192.168.0.185:8080/mag_qoutation/photos/'.$image->Key_Ref.'/'.$image->picture_name;
                                            if (file_exists($path)) {
                                            $file_name =asset('/images/mag_photos/'.$image->Key_Ref.'/'.$image->picture_name);
                                            } else {
                                                $file_name = $path2;
                                            }
                                            ?>

                                                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                                    <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo e($file_name); ?>" target="_blank">
                                                        <img class="img-fluid img-thumbnail" alt="" src="<?php echo e($file_name); ?>">
                                                        <div class='text-center'>
                                                            <small class='text-muted'><?php echo e($image->picture_comment); ?></small>
                                                        </div>
                                                    </a>
                                                    <a class="btn btn-danger" href="/line-manager-delete/<?php echo e($image->id); ?>"><span class="fa fa-trash" ></span></a>
                                                    
                                                </div> 

                                                <!--
                                                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                                    <a class="thumbnail fancybox" rel="ligthbox" href="/images/mag_photos/<?php echo e($image->Key_Ref); ?>/<?php echo e($image->picture_name); ?>" target="_blank">
                                                        <img class="img-fluid img-thumbnail" alt="" src="/images/mag_photos/<?php echo e($image->Key_Ref); ?>/<?php echo e($image->picture_name); ?>">
                                                        <div class='text-center'>
                                                            <small class='text-muted'></small>
                                                        </div>
                                                    </a>
                                                    <a class="btn btn-danger" href="/line-manager-delete/<?php echo e($image->id); ?>"><span class="fa fa-trash" ></span></a>
                                                    
                                                </div> 
                                        -->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                            
                                            <?php endif; ?>
                                            </div>
                                        </div>

                                </div>

                                <!-- # [ CURRENT LOADEDED ]  -->
                                <div class="tab-pane fade show" id="list-additionals" role="tabpanel" aria-labelledby="list-home-list">
                                        <h5 style="text-align:center;" class="text-primary"><b>Additionals</b></h5><br>

                                    <div class="row" style="margin-bottom:10px;">
                                      <a href="#" class="btn btn-success btn-sm final_stage_additional_add" data-id="<?php echo e($key); ?>" title="Additionals">Additionals</a> 
                                    </div>

                                    <div class="row">
                                        <form action="/line-manager-additional-quotes" method="POST">
                                        <input type="hidden" id="ref" name="ref" value="<?php echo e($key); ?>">
                                        <?php echo e(csrf_field()); ?> 
                                            <textarea style="margin-bottom:15px;" id="addition_comment" name="addition_comment" class="form-control form-control-sm" row="5" required></textarea> 
                                            <table class="table table-dark table-sm">
                                            <thead style="background-color:gray;color:white;font-size:10px;">
                                                <tr>
                                                <th>Oper</th>
                                                <th>Description</th>
                                                <!--
                                                <th>MarkUp</th>
                                                -->
                                                <th>Percent</th>
                                                <th>Bett</th>
                                                <th>Qty</th>
                                                <th>Part</th>
                                                <th>Labor</th>
                                                <th>Paint</th>
                                                <th>Strip</th>
                                                <th>Frame</th>
                                                <th>In House</th>
                                                <th>Outwork</th>
                                                <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>

                                                <td>
                                            <select id="opa" name="opa" class="form-control" style="font-size:12px;">
                                                <option value="" selected>Select Oper</option>
                                                <?php $__currentLoopData = $oper; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($opers->oper); ?>"><?php echo e($opers->oper); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="desc" id="desc" class="form-control form-control-sm"></td>
                                        <div id="part_desc" name="part_desc"></div>

                                        <td><input type="text" name="percent" id="percent" value="0" style="width:50px;font-size:12px;" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="bett" id="bett" value="0"  style="width:50px;font-size:12px;" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="qty" id="qty" value="1" style="width:50px;font-size:12px;" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="part" id="part" value="0" style="width:50px;font-size:12px;" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="labor" id="labor" value="0" style="width:50px;font-size:12px;" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="paint" id="paint" value="0" style="width:50px;font-size:12px;" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="r_r" id="r_r" value="0" style="width:50px;font-size:12px;" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="frame" id="frame" value="0" style="width:50px;font-size:12px;" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="in_house" id="in_house" value="0" style="width:50px;font-size:12px;" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="outwork" id="outwork" value="0" style="width:50px;font-size:12px;" class="form-control form-control-sm"></td>
                                        <td>
                                                      

                                        <div class="dropdown">
                                                <a class="btn btn-primary btn-sm  dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span><b>Save</b></a>
                                                <ul class="dropdown-menu">
                                                    <li> <input type="submit" name="money" id="money" class="btn" value="As Money"></li>
                                                    <li><input type="submit" name="time" id="time" class="btn" value="As Time"></li>
                                                </ul>
                                        </div>


                                        </td>



                                                    <!--##
                                                    <td>
                                                    <select id="opa" name="opa" class="form-control form-control-sm" style="font-size:12px;">
                                                    <?php $__currentLoopData = $oper; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($opers->oper); ?>"><?php echo e($opers->oper); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    </td>
                                                    <td><input type="text" name="desc" id="desc" class="form-control form-control-sm"></td>
                                                    <div id="part_desc" name="part_desc"></div>
                                                    <td><input type="text" name="mark" id="mark" style="width:50px;font-size:10px;" class="form-control form-control-sm"></td>
                                                    <td><input type="text" name="bett" id="bett"  style="width:50px;font-size:10px;" class="form-control form-control-sm"></td>
                                                    <td><input type="text" name="qty" id="qty" style="width:50px;font-size:10px;" class="form-control form-control-sm"></td>
                                                    <td><input type="text" name="part" id="part" style="width:50px;font-size:10px;" class="form-control form-control-sm"></td>
                                                    <td><input type="text" name="labor" id="labor" style="width:50px;font-size:10px;" class="form-control form-control-sm"></td>
                                                    <td><input type="text" name="paint" id="paint" style="width:50px;font-size:10px;" class="form-control form-control-sm"></td>
                                                    <td><input type="text" name="strip" id="strip" style="width:50px;font-size:10px;" class="form-control form-control-sm"></td>
                                                    <td><input type="text" name="frame" id="frame" style="width:50px;font-size:10px;" class="form-control form-control-sm"></td>
                                                    <td><input type="text" name="outwork" id="outwork" style="width:50px;font-size:10px;" class="form-control form-control-sm"></td>
                                                    <td><input type="submit" class="btn btn-success btn-sm" value="Save"></td>
                                                    ## --->



                                                </tr>
                                            </tbody>

                                            </table>
                                        </form>
                                    </div>   
                                    <table class="table table-sm">
                                            <thead class="table table-bordered table-sm" style="font-size:12px;" width="100%" cellspacing="0">
                                                <tr>
                                                <th>Oper</th>
                                                <th>Description</th>
                                                <th>MarkUp</th>
                                                <th>Bett</th>
                                                <th>Qty</th>
                                                <th>Part</th>
                                                <th>Labor</th>
                                                <th>Paint</th>
                                                <th>Strip</th>
                                                <th>Frame</th>
                                                <th>Outwork</th>
                                                <th>Comment</th>
                                                <th></th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size:12px;">
                                                <?php $add_count=1;?>
                                                <?php $__currentLoopData = $additional_quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add_quotes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <tr>
                                                    <td><?php echo e($add_quotes->Oper); ?></td>
                                                    <td><?php echo e($add_quotes->Description); ?></td>
                                                    <td><?php echo e($add_quotes->MarkUp); ?></td>
                                                    <td><?php echo e($add_quotes->Betterment); ?></td>
                                                    <td><?php echo e($add_quotes->Quantity); ?></td>
                                                    <td><?php echo e($add_quotes->Part); ?></td>
                                                    <td><?php echo e($add_quotes->Labour); ?></td>
                                                    <td><?php echo e($add_quotes->Paint); ?></td>
                                                    <td><?php echo e($add_quotes->Strip); ?></td>
                                                    <td><?php echo e($add_quotes->Frame); ?></td>
                                                    <td><?php echo e($add_quotes->Outwork); ?></td>
                                                    <td><?php echo e($add_quotes->Comments); ?></td>
                                                    <td>
                                                    <a href="#" title="Edit" class="btn-sm btn-primary"><span class="fa fa-edit"></span></a>
                                        <a href="/deleteQuote/<?php echo e($add_quotes->id); ?>" title="Delete" class="btn-sm btn-danger"><span class="fa fa-trash"></span></a>
                                                    </td>
                                                 </tr>   
                                                <?php $add_count++;?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                    </table> 
                                <!--End OFF-->
                                </div>
                                <div class="tab-pane fade show" id="list-manager-wip" role="tabpanel" aria-labelledby="list-home-list">
                                    <h5 class="text-primary" style="text-align:center;"><b>Line Manager WIP</b></h5>
                                    <div class="col-4">
                                        <table>
                                            <thead>
                                                <th colspan="2" style="text-align:center;font-size:16px;">Line Manger SMS.</th>
                                            </thead>
                                            <tbody>  
                                                <?php $__currentLoopData = $line_sms_log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><a href="#" class="btn btn-primary customercare_sms btn-sm" style="margin-bottom:5px;" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>" data-mid="<?php echo e($tow->stage_no); ?>"><?php echo e($tow->title); ?></a></td>
                                                    <td><a href="#" class="btn btn-warning edit_sms btn-sm" style="margin-bottom:5px;" data-title="<?php echo e($tow->title); ?>" data-message="<?php echo e($tow->message); ?>" data-id="<?php echo e($key); ?>"><span class="fa fa-edit"></span></a></td>    
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>  
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="list-additional-photos" role="tabpanel" aria-labelledby="list-home-list">
                                        
                                <h5 class="text-primary" style="text-align:center;"><b>Additional Photos</b></h5>
                                        <div class="row">
                                            <form action="/line-manager-additional-photo-upload" class="form-control-sm" method="POST" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>

                                            <input type="hidden" name="ref" id="ref" value="<?php echo e($key); ?>">
                                            <div class="row">
                                            <div class="col-md-5">
                                                <strong>Title:</strong>
                                                <input type="text" name="title_additional" class="form-control form-control-sm" placeholder="Additional Title">
                                            </div>
                                            <div class="col-md-5">
                                                <strong>Image:</strong>
                                                <input type="file" name="image" class="form-control-sm form-control-file" required>
                                            </div>
                                            <div class="col-md-2">
                                                <br/>
                                                <button type="submit" class="btn btn-success btn-sm">Upload Addditional</button>
                                            </div>
                                            </div>
                                            </form>
                                        </div><br><br>
                                        <div class="row">
                                            <div class="row text-center text-lg-left">
                                            <?php if($additional_photos->count()): ?>
                                            <?php $__currentLoopData = $additional_photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php 
                                            $file_name="";  
                                            $path = 'images/mag_photos/'.$image->Key_Ref.'/'.$image->picture_name;
                                            $path2 = 'http://192.168.0.185:8080/mag_qoutation/photos/'.$image->Key_Ref.'/'.$image->picture_name;
                                            if (file_exists($path)) {
                                            $file_name =asset('/images/mag_photos/'.$image->Key_Ref.'/'.$image->picture_name);
                                            } else {
                                                $file_name = $path2;
                                            }
                                            ?>

                                                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                                    <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo e($file_name); ?>" target="_blank">
                                                        <img class="img-fluid img-thumbnail" alt="" src="<?php echo e($file_name); ?>">
                                                        <div class='text-center'>
                                                            <small class='text-muted'><?php echo e($image->picture_comment); ?></small>
                                                        </div> 
                                                    </a>
                                                    <a class="btn btn-danger" href="/line-manager-delete/<?php echo e($image->id); ?>"><span class="fa fa-trash" ></span></a>
                                                    
                                                </div> 

                                                <!--
                                                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                                    <a class="thumbnail fancybox" rel="ligthbox" href="/images/mag_photos/<?php echo e($image->Key_Ref); ?>/<?php echo e($image->picture_name); ?>" target="_blank">
                                                        <img class="img-fluid img-thumbnail" alt="" src="/images/mag_photos/<?php echo e($image->Key_Ref); ?>/<?php echo e($image->picture_name); ?>">
                                                        <div class='text-center'>
                                                            <small class='text-muted'></small>
                                                        </div> 
                                                    </a>
                                                    <a class="btn btn-danger" href="/line-manager-delete/<?php echo e($image->id); ?>"><span class="fa fa-trash" ></span></a>
                                                    
                                                </div> 
                                        -->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                            
                                            <?php endif; ?>
                                            </div>
                                        </div>
                                </div>
                                <div class="tab-pane fade show" id="list-itemized-consumerable" role="tabpanel" aria-labelledby="list-home-list">
                                    <h5 class="text-primary" style="text-align:center;"><b>Itemized Consumerables</b></h5>
                                    <div class="row">
                                    <div class="table">
                                            <table class="table table-bordered table-sm" width="100%" cellspacing="0" style="font-size:12px;">
                                                <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Description</th>
                                                    <th>Quantity</th>
                                                    <th>Recieved By</th>
                                                    <th>Date</th>
                                                    <th>Branch</th>
                                                    <th>Amount Per Unit</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                
                                            </table>
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
                                    <input type="text" name="vin_number_edit" id="vin_number_edit" class="form-control form-control-sm" value="<?php echo e($client->Chasses_No); ?>" style="margin-bottom:10px;font-size:10px;">
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
                                <input type="text" name="odometer_edit" id="odometer_edit" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;" value="<?php echo e($client->KM); ?>">
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
                                    <select name="insuror" id="insuror_edit" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;">
                                        <option selected value="<?php echo e($client->Inserer); ?>"><?php echo e($client->Inserer); ?></option>
                                        <?php $__currentLoopData = $brokers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $broker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($broker->broker); ?>"><?php echo e($broker->broker); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </select>
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">I. Contact</span>
                                </div>            
                                <input type="text" name="contact_number_edit" id="contact_number_edit" value="<?php echo e($client->ins_contact); ?>" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">I. Email</span>
                                </div>    
                                <input type="text" name="insurance_email_edit" id="insurance_email_edit" value="<?php echo e($client->ins_email); ?>" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Claim No.</span>
                                </div>        
                                <input type="text" name="claim_number_edit" id="claim_number_edit" value="<?php echo e($client->ins_claim); ?>" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Clerk Ref.</span>
                                </div>        
                                <input type="text" name="clerk_ref_edit" id="clerk_ref_edit" value="<?php echo e($client->ClerkName); ?>"class="form-control form-control-sm"  style="margin-bottom:10px;font-size:10px;">
                        </div>  
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">Assessor</span>
                                </div>      
                                <select name="assessor_edit" id="assessor_edit" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;">
                                    <option value="">Select Assessor</option>
                                    <?php $__currentLoopData = $assessor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asessor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($asessor->Names); ?>"><?php echo e($asessor->Names); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </select>
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">A.Email</span>
                                </div>        
                                <input type="email" name="assessor_email_edit" id="assessor_email_edit" value="<?php echo e($client->Assessor_Email); ?>" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;">
                        </div>        
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">A.Contact</span>
                                </div>
                                <input type="text" name="assessor_no_edit" id="assessor_no_edit" value="<?php echo e($client->Assessor_Cell); ?>" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:25px;font-size:10px;">A.Company</span>
                                </div>        
                                <input type="text" name="assessor_company_edit" id="assessor_company_edit" value="<?php echo e($client->Assessor_comp); ?>" class="form-control form-control-sm" style="margin-bottom:10px;font-size:10px;">
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