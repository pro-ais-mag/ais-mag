<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>

<div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                <h4 class="m-0 font-weight-bold text-primary col-11">Quotation Details - <?php echo e($key); ?></h4>
                <button class="btn-info btn-sm pull-right openbtn" style="font-size:12px;margin-left:90%;" onclick="openNav()">Quoted Photos</button>  
                </div>
<br>
              <div id="mySidepanel" class="sidepanel">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <form method="POST" action="/quote-photo-email">
                <?php echo e(csrf_field()); ?>

                  <div class="form-check" style="margin-left:45px;">
                      <input class="form-check-input picCheckQted" type="checkbox" id="selectAllChk" name="selectAllChk" onchange="selectOrUnselectAllQted(this.id)">
                        <label class="form-check-label" for="photos" style="margin-left:30px;">
                          <p style="color:white;">Select All</p>
                        </label>
                  </div>
                
                <?php if($client_photos->count()>0): ?>
                    <?php $__currentLoopData = $client_photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php
                      $file_name="";
                      
                        
                        $path = 'images/mag_photos/'.$photo->Key_Ref.'/'.$photo->picture_name;
                        $path2 = 'http://192.168.0.185:8080/mag_qoutation/photos/'.$photo->Key_Ref.'/'.$photo->picture_name;
                        if (file_exists($path)) {
                          $file_name =asset('/images/mag_photos/'.$photo->Key_Ref.'/'.$photo->picture_name);

                        } else {
                          $file_name = $path2;
                        }

                        
                      ?>    
                        <div>
                            <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo e($file_name); ?>" target="_blank">
                                <img class="img-fluid img-thumbnail" src="<?php echo e($file_name); ?>" target="_blank">
                                <div class='text-center'>
                                    <small class='text' style="color:white;font-size:10px;"><?php echo e($photo->picture_comment); ?></small>
                                </div> <!-- text-center / end -->
                            </a>
                            <div class="row">
                              <div class="btn-group">
                                <a class="btn btn-danger btn-sm" href="#" title="Delete Image" style="font-size:12px;color:white;margin-left:40px;">Remove</a>       
                                  <div class="form-check" style="margin-left:10px;">
                                      <input class="form-check-input picCheckQted" type="checkbox" id="photos[]" name="photos[]" >
                                      <label class="form-check-label" for="photos" style="margin-left:30px;">
                                        <p style="color:white;">Selected</p>
                                      </label>
                                  </div>
                              </div>         
                            </div>  
                        </div> <!-- col-6 / end -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                <?php endif; ?><br>
                <div class="row">
                    <div class="form-group">
                      <div class="col-12">  
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="photo_only" name="photo_only" style="margin-left:5px;">
                                  <label class="form-check-label" for="photo_only" style="margin-left:30px;">
                                    <p style="color:white;font-size:12px;">Photos Only</p>
                                  </label>
                              </div>
                      </div>
                      <div class="col-12">        
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="photo_quote" name="photo_quote" style="margin-left:5px;">
                                  <label class="form-check-label" for="photo_quote" style="margin-left:30px;">
                                    <p style="color:white;font-size:12px;">Quote</p>
                                  </label>
                              </div>
                      </div>        
                    </div>
                </div>
                <div class="row">
                  <div class="col-11">
                  <input type="email" class="form-control form-control-sm" id="photo_email" name="photo_email" placeholder="Enter Recipient Email" style="margin-left:10px;">
                  </div>
                </div><br>
                <div class="row">
                  <div class="btn-group">
                    <input type="submit" class="btn btn-success btn-sm " value="Send Email" style="font-size:14px;margin-left:105px;color:white;">
                    <!--<a href="javascript:void(0)" class="btn btn-danger btn-sm closebtn" onclick="closeNav()" style="font-size:12px;margin-left:5px;color:white;">Cancel</a>  -->
                  </div>
                </div>  
                </form><br>
              </div>
              <div class="form-row">
 

                
                <div class="form-group col-sm-2">
                <select name="inwhat" id="inwhat" data-id="<?php echo e($key); ?>"class="form-control form-control-sm">
                    <option value="0">Work In</option>
                    <option value="1">Money</option>
                    <option value="2" selected>Time</option>
                </select>
                  
                </div>
                <!-- Waste Checked-->
                <?php if($check_waste->isEmpty()): ?>
                <div class="form-group col-sm-2">
                  <div>
                    <div class="form-check">
                      <input class="form-check-input waste" data-id="<?php echo e($key); ?>" type="checkbox" id="waste" name="waste">
                      <label class="form-check-label" for="waste" >
                        Waste Disposal
                      </label>
                    </div>
                  </div>
                </div>
                <?php else: ?>
                <div class="form-group col-sm-2">
                  <div>
                    <div class="form-check">
                      <input class="form-check-input waste" data-id="<?php echo e($key); ?>" type="checkbox" id="waste" name="waste" checked>
                      <label class="form-check-label" for="waste" >
                        Waste Disposal
                      </label>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <!--End Of Waste Checked-->
                <!-- Covid-19 Checked-->
                <?php if($check_covid->isEmpty()): ?>
                <div class="form-group col-sm-2">
                  <div>
                    <div class="form-check">
                      <input class="form-check-input covid" data-id="<?php echo e($key); ?>" type="checkbox" id="covid" name="covid">
                      <label class="form-check-label" for="covid" >
                        Covid - 19
                      </label>
                    </div>
                  </div>
                </div>
                <?php else: ?>
                <div class="form-group col-sm-2">
                  <div>
                    <div class="form-check">
                      <input class="form-check-input covid" data-id="<?php echo e($key); ?>" type="checkbox" id="covid" name="covid" checked>
                      <label class="form-check-label" for="covid" >
                        Covid- 19
                      </label>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <!-- End-->
                <!-- Polish Checked-->
                <?php if($check_polish->isEmpty()): ?>
                <div class="form-group col-sm-1">
                  <div>
                    <div class="form-check">
                      <input class="form-check-input polish" data-id="<?php echo e($key); ?>" type="checkbox" id="polish" name="polish">
                      <label class="form-check-label" for="polish">
                        Polish
                      </label>
                    </div>
                  </div>
                </div>
                <?php else: ?>
                <div class="form-group col-sm-1">
                  <div>
                    <div class="form-check">
                      <input class="form-check-input polish" data-id="<?php echo e($key); ?>" type="checkbox" id="polish" name="polish" checked>
                      <label class="form-check-label" for="polish">
                        Polish
                      </label>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <!--End Of Polish Checked-->
                <!--Agreed Only Checked-->
                <?php if($check_agreed->isEmpty()): ?>
                <div class="form-group col-sm-2">
                  <div>
                    <div class="form-check">
                      <input class="form-check-input agreed_only" type="checkbox" data-id="<?php echo e($key); ?>" id="agreed" name="agreed">
                      <label class="form-check-label" for="agreed">
                        Agreed Only?
                      </label>
                    </div>
                  </div>
                </div>
                <?php else: ?>
                <div class="form-group col-sm-2">
                  <div>
                    <div class="form-check">
                      <input class="form-check-input agreed_only" type="checkbox" data-id="<?php echo e($key); ?>" id="agreed" name="agreed" checked>
                      <label class="form-check-label" for="agreed">
                        Agreed Only?
                      </label>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <!--End Of Agreed Only Checked-->

                <!--Check Authorised-->
                <?php if($check_auth->isEmpty() && $authorize==1): ?>
                <div class="form-group col-sm-1">
                  <div>
                    <div class="form-check">
                      <input class="form-check-input auth_check" type="checkbox" id="auth_check" name="auth_check" data-id="<?php echo e($key); ?>">
                      <label class="form-check-label" for="authorized">
                        Authorized?
                      </label>
                    </div>
                  </div>
                </div>
                <?php elseif(!$check_auth->isEmpty() && $authorize==1): ?>
                <div class="form-group col-sm-1">
                  <div>
                    <div class="form-check">
                      <input class="form-check-input auth_check" type="checkbox" id="auth_check" name="auth_check" data-id="<?php echo e($key); ?>" checked>
                      <label class="form-check-label" for="authorized">
                        Authorized?
                      </label>
                    </div>
                  </div>
                </div>
                <?php elseif($check_auth->isEmpty() && $authorize==0): ?>
                <div class="form-group col-sm-1">
                  <div>
                    <div class="form-check">
                      <input class="form-check-input auth_check" type="checkbox" id="auth_check" name="auth_check" data-id="<?php echo e($key); ?>" disabled>
                      <label class="form-check-label" for="authorized">
                        Authorized?
                      </label>
                    </div>
                  </div>
                </div>
                <?php elseif(!$check_auth->isEmpty() && $authorize==0): ?>
                <div class="form-group col-sm-1">
                  <div>
                    <div class="form-check">
                      <input class="form-check-input auth_check" type="checkbox" id="auth_check" name="auth_check" data-id="<?php echo e($key); ?>" checked='true' disabled>
                      <label class="form-check-label" for="authorized">
                        Authorized?
                      </label>
                    </div>
                  </div>
                </div>

                <?php endif; ?>
                <!--End Of Authorised Check-->
                
                <?php if($check_auth->isEmpty() && $check_agreed->isEmpty()): ?>
                <div class="form-group col-sm-1">
                <button class="btn btn-warning btn-sm dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-dropup-auto="false">
                                    Print
                                  </button>
                                  <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/moneyQuote/<?php echo e($key); ?>" target="_blank">Preview in Money</a>
                                    <a class="dropdown-item" href="/printQuote/<?php echo e($key); ?>" target="_blank">Preview In Time</a>
                                    <a class="dropdown-item" href="/print-non-approved-part/<?php echo e($key); ?>" target="_blank">Preview Non Approved Parts</a>
                                    <a class="dropdown-item" href="/print-all-parts-list/<?php echo e($key); ?>" target="_blank">Preview All Parts</a>
                                    <a class="dropdown-item" href="/print-job-card/<?php echo e($key); ?>" target="_blank">Preview Job Card</a>
                </div>
                <?php elseif(!$check_auth->isEmpty() && $check_agreed->isEmpty()): ?>
                <div class="form-group col-sm-1">
                <button class="btn btn-warning btn-sm dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-dropup-auto="false">
                                    Print
                                  </button>
                                  <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/print-auth-money/<?php echo e($key); ?>" target="_blank">Preview in Money</a>
                                    <a class="dropdown-item" href="/print-auth-time/<?php echo e($key); ?>" target="_blank">Preview In Time</a>
                                    <a class="dropdown-item" href="/print-non-approved-part/<?php echo e($key); ?>" target="_blank">Preview Non Approved Parts</a>
                                    <a class="dropdown-item" href="/print-all-parts-list/<?php echo e($key); ?>" target="_blank">Preview All Parts</a>
                                    <a class="dropdown-item" href="/print-job-card/<?php echo e($key); ?>" target="_blank">Preview Job Card</a>
                </div>
                <?php elseif(!$check_agreed->isEmpty() && $check_auth->isEmpty()): ?>
                <div class="form-group col-sm-2">
                <button class="btn btn-warning btn-sm dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-dropup-auto="false">
                                    Print
                                  </button>
                                  <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/print-agreed-money/<?php echo e($key); ?>" target="_blank">Preview in Money</a>
                                    <a class="dropdown-item" href="/print-agreed-time/<?php echo e($key); ?>" target="_blank">Preview In Time</a>
                                    <a class="dropdown-item" href="/print-non-approved-part/<?php echo e($key); ?>" target="_blank">Preview Non Approved Parts</a>
                                    <a class="dropdown-item" href="/print-all-parts-list/<?php echo e($key); ?>" target="_blank">Preview All Parts</a>
                                    <a class="dropdown-item" href="/print-job-card/<?php echo e($key); ?>" target="_blank">Preview Job Card</a>
                </div>
                <?php elseif(!$check_agreed->isEmpty() && !$check_auth->isEmpty()): ?>

                
                <div class="form-group col-sm-2">
                <button class="btn btn-warning btn-sm dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-dropup-auto="false">
                                    Print
                                  </button>
                                  <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/print-auth-money/<?php echo e($key); ?>" target="_blank">Preview in Money</a>
                                    <a class="dropdown-item" href="/print-auth-time/<?php echo e($key); ?>" target="_blank">Preview In Time</a>
                                    <a class="dropdown-item" href="/print-non-approved-part/<?php echo e($key); ?>" target="_blank">Preview Non Approved Parts</a>
                                    <a class="dropdown-item" href="/print-all-parts-list/<?php echo e($key); ?>" target="_blank">Preview All Parts</a>
                                    <a class="dropdown-item" href="/print-job-card/<?php echo e($key); ?>" target="_blank">Preview Job Card</a>            
                </div>  
                <?php endif; ?>
                </div>
              </div> 
             

                
            </div>
            <div class="btn-group col-2">
              <!--
              <a href="/allquotes" class="btn btn-danger btn-sm" title="Previous Page"><span class="fa fa-backward"> Back</span></a>
              -->

              <a href="javascript:history.go(-1)" class="btn btn-danger btn-sm" title="Previous Page"><span class="fa fa-backward"> Back</span></a>
            </div>
            <div class="card-body">
                <div class="row">
                <div class="table-responsive">
                <table class="table-sm table-bordered table-dark" style="font-size:10px;" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Ref</th>
                      <th>Date</th>
                      <th>Client</th>
                      <th>Registration</th>
                      <th>Make</th>
                      <th>Model</th>
                      
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  <?php echo e(csrf_field()); ?>

                                <?php $__currentLoopData = $client_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($client->Key_Ref); ?></td>
                                        <td><?php echo e($client->Date); ?></td>
                                        <td><?php echo e($client->Fisrt_Name); ?></td>
                                        <td><?php echo e($client->Reg_No); ?></td>
                                        <td><?php echo e($client->Model); ?></td>
                                        <td><?php echo e($client->Make); ?></td>
                                        
                                        <!--<td><div class="btn-group">-->
                                       <!--<a class="btn btn-primary" title="Double Cab" data-id="<?php echo e($client->Key_Ref); ?>" data-vehicle="double" href="/exterior/<?php echo e($client->Key_Ref); ?>">
                                        <span class="fa fa-car"></span></a> 
                                        <a class="btn btn-success" title="Hatchback" style="margin-left:5px;" data-id="<?php echo e($client->Key_Ref); ?>" href="/hatchback/<?php echo e($client->Key_Ref); ?>">
                                        <span class="fa fa-car-side"></span></a>    
                                        <a class="btn btn-danger" title="Single Cab" style="margin-left:5px;" data-id="<?php echo e($client->Key_Ref); ?>" href="/singlecab/<?php echo e($client->Key_Ref); ?>">
                                        <span class="fa fa-bus"></span></a>
                                        </div>
                                        <div class="btn-group" style="margin-top:5px;">  
                                        <a class="btn btn-warning" title="3 Door" data-id="<?php echo e($client->Key_Ref); ?>" href="/2door/<?php echo e($client->Key_Ref); ?>">
                                        <span class="fa fa-bus"></span></a>
                                        <a class="btn btn-info" title="Mini Bus" style="margin-left:5px;" data-id="<?php echo e($client->Key_Ref); ?>" href="/minibus/<?php echo e($client->Key_Ref); ?>">
                                        <span class="fa fa-shuttle-van"></span></a>-->
                                        <td>
                                            <a class="btn-sm btn-success btn-sm show-modal" title="Graphics" data-id="<?php echo e($client->Key_Ref); ?>" href="#">Graphics</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
                  
              </div>      
                </div>
                <br>
                <div class="row">
                    <table class="table-sm table-bordered table-dark" style="font-size:10px;">
                      <thead style="background-color:gray;color:white;">
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
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <form method="POST" action="/saveQuote">
                          <?php echo e(csrf_field()); ?>

                          <input type="hidden" id="ref" name="ref" value="<?php echo e($key); ?>">
                          <td>
                            <select id="opa" name="opa" class="form-control form-control-sm" style="font-size:10px;" required>
                            <?php $__currentLoopData = $oper; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($opers->oper); ?>"><?php echo e($opers->oper); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </td>
                          <td><input type="text" name="desc" id="desc" class="form-control form-control-sm" style="width:120px;font-size:10px;" required></td>
                          <div id="part_desc" name="part_desc" ></div>
                          <td><input type="text" name="mark" id="mark" style="width:50px;font-size:10px;" class="form-control form-control-sm" required></td>
                          <td><input type="text" name="bett" id="bett"  style="width:50px;font-size:10px;" class="form-control form-control-sm" required></td>
                          <td><input type="number" name="qty" id="qty" style="width:50px;font-size:10px;" class="form-control form-control-sm" required></td>
                          <td><input type="text" name="part" id="part" style="width:100px;font-size:10px;" class="form-control form-control-sm" required></td>
                          <td><input type="text" name="labor" id="labor" style="width:50px;font-size:10px;" class="form-control form-control-sm" required></td>
                          <td><input type="text" name="paint" id="paint" style="width:50px;font-size:10px;" class="form-control form-control-sm" required></td>
                          <td><input type="text" name="strip" id="strip" style="width:50px;font-size:10px;" class="form-control form-control-sm" required></td>
                          <td><input type="text" name="frame" id="frame" style="width:50px;font-size:10px;" class="form-control form-control-sm" required></td>
                          <td><input type="text" name="outwork" id="outwork" style="width:50px;font-size:10px;" class="form-control form-control-sm" required></td>
                          <td><input type="submit" class="btn btn-success btn-sm" value="Save"></td>
                          </form>
                        </tr>
                      </tbody>
                    </table>
                    
                </div>
                
                <br>
                <table class="table table-sm table-dark" style="font-size:10px;" id="workin" name="workin">
                            <thead class="thead-dark thead-sm">
                                <tr style="font-size:10px;">
                                    <th scope="col" colspan="2">#</th>
                                    <th scope="col">Oper</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Mark Up</th>
                                    <th scope="col">Bett</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Part</th>
                                    <th scope="col">Labor</th>
                                    <th scope="col">Paint</th>
                                    <th scope="col">Strip</th>
                                    <th scope="col">Frame</th>
                                    <th scope="col">Outwork</th>    
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <?php 
                              $q_counter=1;
                            ?>
                            <tbody>
                                <?php $__currentLoopData = $quote; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote_infos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr style="font-size:10px;">
                                  <td><?php echo e($q_counter); ?></td>

                                  <td>
                                  <a href="#" class="btn btn-info btn-sm add_new_line_qoute" data-qoute_line_id="<?php echo e($quote_infos->id); ?>" data-key_ref="<?php echo e($key); ?>" title="Add Qoute"><span class="fa fa-plus"></span></a>
                                </td>

                                  <td>
                                    <select name="EditOper_<?php echo e($quote_infos->id); ?>" id="EditOper_<?php echo e($quote_infos->id); ?>"  class="form-control form-control-sm" style="font-size:10px;" required>
                                      <option value="<?php echo e($quote_infos->Oper); ?>" selected><?php echo e($quote_infos->Oper); ?></option>

                                      <?php $__currentLoopData = $oper; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($opers->oper); ?>"><?php echo e($opers->oper); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                                  </td>

                                 
                                  <td ><input type="text" class="form-control form-control-sm" name="EditDesc_<?php echo e($quote_infos->id); ?>" id="EditDesc_<?php echo e($quote_infos->id); ?>" value="<?php echo e($quote_infos->Description); ?>" style="width:120px;margin-bottom:5px;font-size:10px;"></td>
                                  <td><input type="text" class="form-control form-control-sm" name="EditMark_<?php echo e($quote_infos->id); ?>" id="EditMark_<?php echo e($quote_infos->id); ?>" value="<?php echo e($quote_infos->Percent); ?>" style="width:50px;margin-bottom:5px;font-size:10px;"></td>
                                  <td><input type="text" class="form-control form-control-sm" name="EditBett_<?php echo e($quote_infos->id); ?>" id="EditBett_<?php echo e($quote_infos->id); ?>" value="<?php echo e($quote_infos->Betterment); ?>" style="width:50px;margin-bottom:5px;font-size:10px;"></td>
                                  <td><input type="text" class="form-control form-control-sm" name="EditQty_<?php echo e($quote_infos->id); ?>" id="EditQty_<?php echo e($quote_infos->id); ?>" value="<?php echo e($quote_infos->Quantity); ?>" style="width:50px;margin-bottom:5px;font-size:10px;"></td>
                                  <td><input type="text" class="form-control form-control-sm" name="EditPart_<?php echo e($quote_infos->id); ?>" id="EditPart_<?php echo e($quote_infos->id); ?>" value="<?php echo e($quote_infos->Part); ?>" style="width:70px;margin-bottom:5px;font-size:10px;"></td>
                                  <td><input type="text" class="form-control form-control-sm" name="labourEdit_<?php echo e($quote_infos->id); ?>" id="labourEdit_<?php echo e($quote_infos->id); ?>" value="<?php echo e(number_format($quote_infos->Labour,2)); ?>" style="width:50px;margin-bottom:5px;font-size:10px;"></td>
                                  <td><input type="text" class="form-control form-control-sm" name="paintEdit_<?php echo e($quote_infos->id); ?>" id="paintEdit_<?php echo e($quote_infos->id); ?>" value="<?php echo e(number_format($quote_infos->Paint,2)); ?>" style="width:50px;margin-bottom:5px;font-size:10px;"></td>  
                                  <td><input type="text" class="form-control form-control-sm" name="stripEdit_<?php echo e($quote_infos->id); ?>" id="stripEdit_<?php echo e($quote_infos->id); ?>" value="<?php echo e(number_format($quote_infos->Strip,2)); ?>" style="width:50px;margin-bottom:5px;font-size:10px;"></td>
                                  <td><input type="text" class="form-control form-control-sm" name="frameEdit_<?php echo e($quote_infos->id); ?>" id="frameEdit_<?php echo e($quote_infos->id); ?>" value="<?php echo e(number_format($quote_infos->Frame,2)); ?>" style="width:50px;margin-bottom:5px;font-size:10px;"></td>
                                  <td><input type="text" class="form-control form-control-sm" name="outworkEdit_<?php echo e($quote_infos->id); ?>" id="outworkEdit_<?php echo e($quote_infos->id); ?>" value="<?php echo e(number_format($quote_infos->Misc,2)); ?>" style="width:50px;margin-bottom:5px;font-size:10px;"></td>

                                                  
                                  <td>
                                      <div class="btn-group">
                                      <a href="#" title="Edit" class="btn btn-primary btn-sm  editQuote" id="<?php echo e($quote_infos->id); ?>">
                                        <span class="fa fa-edit"></span></a>
                                      <a href="#" title="Delete" style="margin-left:5px;" class="btn btn-danger btn-sm deleteQuote" data-id="<?php echo e($quote_infos->id); ?>" data-description="<?php echo e($quote_infos->Description); ?>"><span class="fa fa-trash"></span></a>
                                      </div>

                                  </td>
                                </tr>

                                <!--## START HERE 
                                <tr style="font-size:10x;">
                                <td><?php echo e($q_counter); ?></td>
                                <td><?php echo e($quote_infos->Oper); ?></td>
                                                <td ><?php echo e($quote_infos->Description); ?></td>
                                                <td><?php echo e($quote_infos->MarkUp); ?></td>
                                                <td><?php echo e($quote_infos->Betterment); ?></td>
                                                <td><?php echo e($quote_infos->Quantity); ?></td>
                                                <td><?php echo e($quote_infos->Part); ?></td>
                                                <td><?php echo e(number_format($quote_infos->Labour,2)); ?></td>
                                                <td><?php echo e(number_format($quote_infos->Paint,2)); ?></td>  
                                                <td><?php echo e(number_format($quote_infos->Strip,2)); ?></td>
                                                <td><?php echo e(number_format($quote_infos->Frame,2)); ?></td>
                                                <td><?php echo e(number_format($quote_infos->Misc,2)); ?></td>
                                    <td>
                                        <a href="#" title="Edit" class="btn btn-primary btn-sm  editQuote" data-id="<?php echo e($quote_infos->id); ?>" data-oper="<?php echo e($quote_infos->Oper); ?>" data-desc="<?php echo e($quote_infos->Description); ?>" data-markup="<?php echo e($quote_infos->MarkUp); ?>" data-bett="<?php echo e(number_format($quote_infos->Betterment,2)); ?>" data-qty="<?php echo e(number_format($quote_infos->Quantity,2)); ?>" data-part="<?php echo e(number_format($quote_infos->Part,2)); ?>" data-labour="<?php echo e(number_format($quote_infos->Labour,2)); ?>" data-paint="<?php echo e(number_format($quote_infos->Paint,2)); ?>" data-strip="<?php echo e(number_format($quote_infos->Strip,2)); ?>" data-frame="<?php echo e(number_format($quote_infos->Frame,2)); ?>" data-outwork="<?php echo e(number_format($quote_infos->Misc,2)); ?>"><span class="fa fa-edit"></span></a>
                                        <a href="/deleteQuote/<?php echo e($quote_infos->id); ?>" title="Delete" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                                    </td>
                                </tr>
                                END HERE ##--->

                                <?php
                                  $q_counter++;
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
            </div>

</div>                


    <div class="modal fade" id="auth_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Select Date Authorized.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/authorize-quote" method="POST">
        <?php echo e(csrf_field()); ?>

          <input type="hidden" name="id_auth" id="id_auth">
            
          <div class="form-group">
          <label for="auth_date">Authorized Date:</label>
            <input type="date" id="auth_date" name="auth_date" class="form-control">
          </div>
                              
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary" value="Date Saved">
        </div>
        </form>
      </div>
    </div>
  </div>

  

<script type="text/javascript">
document.getElementById('qty').value = '1';
document.getElementById('mark').value='0';
document.getElementById('bett').value='0';
document.getElementById('part').value='0';
document.getElementById('labor').value='0';
document.getElementById('paint').value='0';
document.getElementById('strip').value='0';
document.getElementById('frame').value='0';
document.getElementById('outwork').value='0';


$('').on('click')
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('quotations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>