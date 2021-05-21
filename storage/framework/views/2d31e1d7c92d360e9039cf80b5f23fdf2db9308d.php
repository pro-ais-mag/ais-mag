<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>A.I.S</title>

  <!-- Custom fonts for this template-->
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="icon" href="/img/mag_icon.PNG">  
  
  <!-- Custom styles for this template-->
  <link href="/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="/css/sidepanel.css" rel="stylesheet">
  

  <!--Side Panel CSS-->
  <link rel="stylesheet" href="/side_css/reset.css"> <!-- CSS reset -->
	
  <!--<link rel="stylesheet" href="/side_css/sidestyle.css">--> <!-- Resource style -->
	<link rel="stylesheet" href="/side_css/demo.css"> <!-- Demo style -->
  

<!--Maping script-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>             
<script type="text/javascript" src="/src/redist/when.js"></script>
<script type="text/javascript" src="/src/core.js"></script>
<script type="text/javascript" src="/src/graphics.js"></script>
<script type="text/javascript" src="/src/mapimage.js"></script>
<script type="text/javascript" src="/src/mapdata.js"></script>
<script type="text/javascript" src="/src/areadata.js"></script>
<script type="text/javascript" src="/src/areacorners.js"></script>
<script type="text/javascript" src="/src/scale.js"></script>
<script type="text/javascript" src="/src/tooltip.js"></script>



</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-car"></i>
        </div>
        <div class="sidebar-brand-text mx-3">AIG<sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="/hatchback/<?php echo e($key); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span><b>Hatchback Exterior<b></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/hatchbackinterior/<?php echo e($key); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span><b>Hatchback Interior<b></span></a>
      </li>  
      <!--Go Back To Quote-->
      <li class="nav-item">
        <a class="nav-link" href="/viewQuotation/<?php echo e($key); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span><b>Back To Quote<b></span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Vehicle Section Exterior
      </div>

      <!-- Nav Item - Body Front Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Body Front</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Select Front Selection</h6>
            <a class="collapse-item double_cab_bumper" href="/hatchbackfrontbumper/<?php echo e($key); ?>">Bumper</a>
            
        </div>
      </li>

      <!-- Nav Item -  Body Side Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Body Side</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Select Side Selection</h6>
            <a class="collapse-item" href="/hatchbackfrontdoor/<?php echo e($key); ?>">Front Door</a>
            <a class="collapse-item" href="/hatchbackreardoor/<?php echo e($key); ?>">Rear Door</a>
            <a class="collapse-item" href="/hatchbackfrontsuspension/<?php echo e($key); ?>">Front Suspension</a>
            <a class="collapse-item" href="/hatchbackrearsuspension/<?php echo e($key); ?>">Rear Suspension</a>
          </div>
        </div>
      </li>

      <!--Nav Item Body Rear Menu-->  
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBakkie" aria-expanded="true" aria-controls="collapseBakkie">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Body Rear</span>
        </a>
        <div id="collapseBakkie" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Select Rear Selection</h6>
            <a class="collapse-item" href="/hatchbackrearbumper/<?php echo e($key); ?>">Rear Bumper</a>
          </div>
        </div>
      </li>  



      <!-- Divider -->
      <hr class="sidebar-divider">
      <!--Nav Heading-->
      <div class="sidebar-heading">
        Vehicle Section Interior
      </div>
      
      <!--Nav Item Inner Front Menu-->  
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInnerFront" aria-expanded="true" aria-controls="collapseBakkie">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Inner Trim Front</span>
        </a>
        <div id="collapseInnerFront" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Inner Trim Front Selection</h6>
            <a class="collapse-item" href="/hatchbackEngine/<?php echo e($key); ?>">Engine</a>
            <a class="collapse-item" href="/hatchbackTransmission/<?php echo e($key); ?>">Transmission</a>
            <a class="collapse-item" href="/hatchbackair/<?php echo e($key); ?>">Air Conditioner</a>
            <a class="collapse-item" href="/hatchbackDashboard/<?php echo e($key); ?>">Dashboard</a>
          </div>
        </div>
      </li> 
      <!--End Nav-->

      <!--Nav Item Inner Side Menu-->  
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInnerSide" aria-expanded="true" aria-controls="collapseBakkie">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Inner Trim Side</span>
        </a>
        <div id="collapseInnerSide" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Inner Trim Side Selection</h6>
            <a class="collapse-item" href="/hatchbackfrontseat/<?php echo e($key); ?>">Front Seat</a>
            <a class="collapse-item" href="/hatchbackrearseat/<?php echo e($key); ?>">Rear Seat</a>
            
          </div>
        </div>
      </li> 
      <!--End Nav-->

       <!--Nav Item Inner Rear Menu-->  
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInnerRear" aria-expanded="true" aria-controls="collapseBakkie">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Inner Trim Rear</span>
        </a>
        <div id="collapseInnerRear" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Inner Trim Rear Selection</h6>
            <a class="collapse-item" href="/hatchbacExhaust/<?php echo e($key); ?>">Exhaust</a>
            <a class="collapse-item" href="/hatchbacFuel/<?php echo e($key); ?>">Fuel System</a>
          </div>
        </div>
      </li> 
      <!--End Nav-->

        <!-- Divider -->
      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQuotes" aria-expanded="true" aria-controls="collapseBakkie">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Quotations</span>
        </a>
        <div id="collapseQuotes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Quotation Selection</h6>
            <a class="collapse-item" href="/allquotes">All Quotation</a>
            <a class="collapse-item" href="/quoted">Quoted</a>
            <a class="collapse-item" href="/unquoted">Unquoted</a>
          </div>
        </div>
      </li> 

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
    <ul style="position:fixed;margin-left:1050px;background-color:#f1f1f1;">
<div>
    <button title="NEW" class="show-modal btn btn-secondary btn-sm"style="margin-top:5px;">N</button>
    <button title="REPAIR" class="operRate btn btn-secondary btn-sm" data-oper="Repair" data-key="" style="margin-top:5px;" title="Repair">R</button> 
    <button class="btn btn-secondary removeAndRepair btn-sm" data-id="R+R" data-oper="R+R" style="margin-top:5px;">R+R</button>    
    <button title="Spray" class="spray btn btn-secondary btn-sm" data-id="" data-oper="Spray" style="margin-top:5px;">SP</button> 
    <button title="ALTERNATIVE" class="alternative btn btn-secondary btn-sm" data-id="" data-oper="Alternative" style="margin-top:5px;">ALT</button>       
    <button title="INHOUSE" class="inhouse btn btn-secondary btn-sm" data-id="" data-oper="Inhouse" style="margin-top:5px;">IH</button>    
    <button title="BLEND" class="blend btn btn-secondary btn-sm" data-id="" data-oper="Blend" style="margin-top:5px;">BL</button>    
    <button class="dnA btn btn-secondary btn-sm" data-id="" data-oper="D&A" style="margin-top:5px;">D&A</button>    
    <button class="truck-modal btn btn-secondary btn-sm" data-id="" data-oper="Owned" style="margin-top:5px;">O</button>    
    <button title="CHECK" class="check btn btn-secondary btn-sm" data-id="" data-oper="Check" style="margin-top:5px;">CH</button>    
    <button title="OUTWORK"class="outwork btn btn-secondary btn-sm" data-id="" data-oper="Outwork" style="margin-top:5px;">OW</button>    
    <button title="2ND HAND" class="2ndHand btn btn-secondary btn-sm" data-id="" data-oper="2nd Hand"style="margin-top:5px;">2ND</button>    
    
</div>

    </ul>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
<br>
      <!-- Main Content -->
      <div id="content">

        
        
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <?php if(session('status')): ?>
          <div class="alert alert-success">
              <?php echo e(session('status')); ?>

          </div>
        <?php endif; ?>
          <!-- Page Heading -->
          
          <?php echo $__env->yieldContent('hatchback'); ?>
            
      <!-- End of Footer -->
      <div class="container-fluid">
                    <div class="row">
                    <!--<div class="panel panel-default">
                                
                                <div class="panel-body">
                                <table class="table-bordered">
                            <thead>
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
                                    <th><span class="fa fa-cog" style="align:middle;"></span></th>
                                </tr>

                            </thead>
                                    <tr>
                                        <td><input type="text" name="oper" id="oper"></td>
                                        <td><input type="text" name="description" id="description"></td>
                                        <td><input type="text" name="markUp" id="markUp" style="width:50px;"></td>
                                        <td><input type="text" name="bett" id="bett" style="width:50px;"></td>
                                        <td><input type="text" name="qty" id="qty" style="width:50px;"></td>
                                        <td><input type="text" name="part" id="part" style="width:50px;"></td>
                                        <td><input type="text" name="labor" id="labor" style="width:50px;"></td>
                                        <td><input type="text" name="paint" id="paint" style="width:50px;"></td>
                                        <td><input type="text" name="strip" id="strip" style="width:50px;"></td>
                                        <td><input type="text" name="frame" id="frame" style="width:50px;"></td>
                                        <td><input type="text" name="outwork" id="outwork" style="width:50px;"></td>
                                        <td>
                                        <button title="New">N</button>
                                        <button title="Repair">R</button>
                                        <button title="Alternative">A</button>
                                        </td>
                                        <td>
                                        
                                        <a class="btn btn-success" href="#" style="margin-left:10px;">Save</a>
                                        
                                        </td>    
                                    </tr>    
                            </table>
                            
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>-->
                   
                   
                   <!-- Collapsable Card Photos -->
                   <!--
                            <div class="card shadow mb-4">
                                
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">Photos</h6>
                                </a>
                                
                                <div class="collapse" id="collapseCardExample">
                                <div class="card-body">
                                <img src="/img/car-repair-austin.jpg" class="img-fluid img-thumbnail" alt="..." width="200px" height="200px">
                                <img src="/img/DfOPQboUwAEQci5.jpg" class="img-fluid img-thumbnail" alt="..." width="200px" height="200px">
                                <img src="/img/78702670_2481857088766694_8409304704370081792_n.jpg" class="img-fluid img-thumbnail" alt="..." width="200px" height="200px">
                                <img src="img/MAG Background.png" class="img-fluid img-thumbnail" alt="..." width="200px" height="200px">
                                <img src="/img/car-repair-austin.jpg" class="img-fluid img-thumbnail" alt="..." width="200px" height="200px">
                                <img src="/img/car-repair-austin.jpg" class="img-fluid img-thumbnail" alt="..." width="200px" height="200px">
                                <img src="/img/car-repair-austin.jpg" class="img-fluid img-thumbnail" alt="..." width="200px" height="200px">
                                <img src="/img/car-repair-austin.jpg" class="img-fluid img-thumbnail" alt="..." width="200px" height="200px">
                                <img src="/img/DfOPQboUwAEQci5.jpg" class="img-fluid img-thumbnail" alt="..." width="200px" height="200px">
                                <img src="/img/DfOPQboUwAEQci5.jpg" class="img-fluid img-thumbnail" alt="..." width="200px" height="200px">
                                <img src="/img/DfOPQboUwAEQci5.jpg" class="img-fluid img-thumbnail" alt="..." width="200px" height="200px">
                                <img src="/img/DfOPQboUwAEQci5.jpg" class="img-fluid img-thumbnail" alt="..." width="200px" height="200px">
                                <img src="/img/DfOPQboUwAEQci5.jpg" class="img-fluid img-thumbnail" alt="..." width="200px" height="200px">
                                </div>
                                </div>
                            </div>-->

                           <!-- Collapsable Card Quote -->
                                <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <div class="success" style="display: none;"></div>
                                <a href="#collapseCardQuote" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardQuote">
                                <h6 class="m-0 font-weight-bold text-primary">View Quotation</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                            <div class="collapse" id="collapseCardQuote">
                                            <div class="card-body">
                                            <div class="table-responsive table-sm" >
                                            <table class="table table-bordered" id="quoteData" width="70%" style="font-size:12px;"cellspacing="0">
                                            <thead>
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
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                            <?php echo e(csrf_field()); ?>

                                                  <?php $__currentLoopData = $quote_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote_infos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <input type="hidden" name="key_ref" id="key_ref" value="<?php echo e($quote_infos->Key_Ref); ?>">
                                                        
                                            <tr>
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
                                                
                                                
                                                <td><div class="btn-group">
                                            <button class="btn btn-primary editQuote btn-sm" data-id="<?php echo e($quote_infos->id); ?>" data-oper="<?php echo e($quote_infos->Oper); ?>" data-desc="<?php echo e($quote_infos->Description); ?>" data-markup="<?php echo e($quote_infos->MarkUp); ?>" data-bett="<?php echo e($quote_infos->Betterment); ?>" data-qty="<?php echo e($quote_infos->Quantity); ?>" data-part="<?php echo e($quote_infos->Part); ?>" data-labour="<?php echo e($quote_infos->Labour); ?>" data-paint="<?php echo e($quote_infos->Paint); ?>" data-strip="<?php echo e($quote_infos->Strip); ?>" data-frame="<?php echo e($quote_infos->Frame); ?>" data-outwork="<?php echo e($quote_infos->Misc); ?>">
                                                <span class="fa fa-edit"></span></button>    
                                                
                                                <a class=" btn btn-danger btn-sm" href="/deleteQuote/<?php echo e($quote_infos->id); ?>" style="margin-left:5px;" data-id="<?php echo e($quote_infos->id); ?>" data-oper="<?php echo e($quote_infos->Oper); ?>" data-desc="<?php echo e($quote_infos->Description); ?>" data-markup="<?php echo e($quote_infos->MarkUp); ?>" data-bett="<?php echo e($quote_infos->Betterment); ?>" data-qty="<?php echo e($quote_infos->Quantity); ?>" data-part="<?php echo e($quote_infos->Part); ?>" data-labour="<?php echo e($quote_infos->Labour); ?>" data-paint="<?php echo e($quote_infos->Paint); ?>" data-strip="<?php echo e($quote_infos->Strip); ?>" data-frame="<?php echo e($quote_infos->Frame); ?>" data-outwork="<?php echo e($quote_infos->Misc); ?>">
                                                <span class="fa fa-trash" ></span></a>       
                                                </div></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            
                                            </tbody>
                                            </table>
                                            
                                        </div>
                                            </div>
                                </div>
                                <div class="row">
                                <button class="btn btn-warning dropdown-toggle" type="button" style="margin-left:15px;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-dropup-auto="false">
                                    Print Quote
                                  </button>
                                  <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/moneyQuote/<?php echo e($key); ?>" target="_blank">Print in Money</a>
                                    <a class="dropdown-item" href="/printQuote/<?php echo e($key); ?>" target="_blank">Print In Time</a>
                                    
                                  </div>
                                </div>
                                  <br><br>
              </div>
            </div>
        </div>
  
    
    
   <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
      <!--Remove Part-->
    <div class="modal fade" id="removePartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h3 class="modal-title" id="exampleModalLabel" style="color:white;">Remove Part</h3>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Really Want To Remove Part?</div>
            <form method="DELETE">
            <div class="form-group">
            <input type="hidden" name="part_id" id="part_id">
            <input type="text" name="part_delete" id="part_delete" class="form-control col-sm-8" disabled>
            </div>
            </form>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <input type="submit" class="btn btn-danger delete_part" href="#" data-dismiss="modal">Delete</button>
            </div>
          </div>
        </div>
    </div>  


  <div class="modal fade" id="operationsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title"></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
                  <form class="form-horizontal" role="form" method="POST">
                  <?php echo e(csrf_field()); ?>

                  <input type="hidden" name="InputKeyRef" id="InputKeyRef">
                  <input type="hidden" name="InputOper" id="InputOper">
                  
                  <div class="form-group">
                  
                      <label for="InputDesc" >Description</label>
                      <input type="text" class="form-control col-sm-6" name="InputDesc" id="InputDesc" required>
                  </div>

                  <div class="form-group">
                  
                      <label for="InputPart" >Part</label>
                      <input type="number" class="form-control col-sm-6" name="InputPart" id="InputPart" required>
                  </div>

                  <div class="form-group">
                      
                          <label for="paintInput" class="label-default">Paint: </label>
                          <input type="number" class="form-control col-sm-6"name="paintInput" id="paintInput" required>
                      
                  </div>
                  <div class="form-group">
                      
                          <label for="labourInput">Labour: </label>
                          <input type="number" class="form-control col-sm-6" name="labourInput" id="labourInput" required>
                    
                  </div>
                  <div class="form-group">
                      
                          <label for="stripInput"><h3>Strip: </h3></label>
                          <input type="number" class="form-control col-sm-6" name="stripInput" id="stripInput" required>
                    
                  </div>
                  <div class="form-group">
                      
                          <label for="frameInput">Frame: </label>
                          <input type="number" class="form-control col-sm-6" name="frameInput" id="frameInput" required>
                      
                  </div>
                  <div class="form-group">
                      
                          <label for="outworkInput">OutWork: </label>
                          <input type="number" class="form-control col-sm-6" name="outworkInput" id="outworkInput" required>
                      
                  </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-success save_oper" data-dismiss="modal" href="#">Save Quote</a>
        </div>
      </div>
    </div>
  </div>


  <!--Edit Quotation-->
  <!--Edit Modal Parts Copy-->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary" style="text-align:center">
          <h5 class="modal-title" style="color:white;text-align:centre;"></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" role="form" method="PUT">
        
        <!--<input type="hidden" name="InputKeyRef" id="InputKeyRef">
        <input type="hidden" name="InputOper" id="InputOper">-->
        <input type="hidden" name="EditId" id="EditId">
        
        <label for="EditDesc" style="font-size:14px;"><b>Description:</b></label>
            <input type="text" class="form-control form-control-sm" name="EditDesc" id="EditDesc" style="margin-bottom:5px;">
        
            <label for="EditMark" style="font-size:14px;"><b>Mark Up:</b></label>
            <input type="text" class="form-control form-control-sm" name="EditMark" id="EditMark" style="margin-bottom:5px;">

        <label for="EditBett" style="font-size:14px;"><b>Betterment:</b></label>
            <input type="text" class="form-control form-control-sm" name="EditBett" id="EditBett" style="margin-bottom:5px;">

            <label for="EditQty" style="font-size:14px;"><b>Quantity:</b></label>
            <input type="text" class="form-control form-control-sm" name="EditQty" id="EditQty" style="margin-bottom:5px;">

        <label for="EditPart" style="font-size:14px;"><b>Part:</b></label>
            <input type="text" class="form-control form-control-sm" name="EditPart" id="EditPart" style="margin-bottom:5px;">
        

        <label for="paintEdit" style="font-size:14px;"><b>Paint:</b></label>
            <input type="number" class="form-control form-control-sm" name="paintEdit" id="paintEdit" style="margin-bottom:5px;">
            
        
        <label for="labourEdit" style="font-size:14px;"><b>Labour:</b></label>
            <input type="number" class="form-control form-control-sm" name="labourEdit" id="labourEdit" style="margin-bottom:5px;">
          
        <label for="stripEdit" style="font-size:14px;"><b>Strip:</b></label>
            <input type="number" class="form-control form-control-sm" name="stripEdit" id="stripEdit" style="margin-bottom:5px;">
               
        <label for="frameEdit" style="font-size:14px;"><b>Frame:</b></label>
                <input type="number" class="form-control form-control-sm" name="frameEdit" id="frameEdit" style="margin-bottom:5px;">
        
        <label for="outworkEdit" style="font-size:14px;"><b>OutWork:</b></label>
                <input type="number" class="form-control form-control-sm" name="outworkEdit" id="outworkEdit" style="margin-bottom:5px;">
            
              
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary edit_save" data-dismiss="modal">Save</button>
        </form>
        </div>
      </div>
    </div>
</div>


  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

 

<!--Operations Modal-->
 
 <div class="modal fade" id="soperationsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title"> </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" role="form" method="POST">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="InputKeyRef" id="InputKeyRef">
        <input type="hidden" name="InputOper" id="InputOper">
        
        <div class="form-group">
        
            <label for="InputDesc" >Description</label>
            <input type="text" class="form-control col-sm-6" name="InputDesc" id="InputDesc" disabled required>
        </div>

        <div class="form-group">
        
            <label for="InputPart" >Part</label>
            <input type="text" class="form-control col-sm-6" name="InputPart" id="InputPart" required>
        </div>

        <div class="form-group">
            
                <label for="paintInput" class="label-default">Paint: </label>
                <input type="number" class="form-control col-sm-6"name="paintInput" id="paintInput" required>
            
        </div>
        <div class="form-group">
            
                <label for="labourInput">Labour: </label>
                <input type="number" class="form-control col-sm-6" name="labourInput" id="labourInput" required>
          
        </div>
        <div class="form-group">
            
                <label for="stripInput"><h3>Strip: </h3></label>
                <input type="number" class="form-control col-sm-6" name="stripInput" id="stripInput" required>
          
        </div>
        <div class="form-group">
            
                <label for="frameInput">Frame: </label>
                <input type="number" class="form-control col-sm-6" name="frameInput" id="frameInput" required>
            
        </div>
        <div class="form-group">
            
                <label for="outworkInput">OutWork: </label>
                <input type="number" class="form-control col-sm-6" name="outworkInput" id="outworkInput" required>
            
        </div>
        
        
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success save_oper">Save</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>


 

  <!-- Bootstrap core JavaScript-->
  <!--<script src="/css/vendor/jquery/jquery.min.js"></script>-->
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/js/sb-admin-2.min.js"></script>
  

    <!-- Page level plugins -->
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    

    <script type="text/javascript">
      
      //Show Part Quotation
        $(document).on('click', '.operRate', function() {
            var key=$('#key_ref').val();
           $('#InputKeyRef').val(key); 
           $('#InputOper').val($(this).data('oper')); 
           $('.modal-title').text('Repair Operations');
           $('#operationsModal').modal('show');
           
        }); 


        $(document).on('click','.delete_part',function(){
          $('#part_delete').val($(this).data('desc'));
          $('#part_id').val($(this).data('id'));
           $('#removePartModal').modal('show'); 
        });  

        //Edit Quotation Part
        //Edit Quotation Part Copy
 $(document).on('click','.editQuote',function(){

$('#EditId').val($(this).data('id'));
$('#EditQty').val($(this).data('qty'));
$('#EditDesc').val($(this).data('desc'));
$('#EditPart').val($(this).data('part')); 
$('#EditMark').val($(this).data('markup'));
$('#EditBett').val($(this).data('bett'));  
$('#paintEdit').val($(this).data('paint'));
$('#labourEdit').val($(this).data('labour'));
$('#stripEdit').val($(this).data('strip'));
$('#frameEdit').val($(this).data('frame'));
$('#outworkEdit').val($(this).data('outwork'));
$('.modal-title').text('Edit Quote');
$('#editModal').modal('show');
});


$(document).on('click','.edit_save',function(){
    $.ajax({
       type:'GET',
        url: '/editQuote',
       data: {
          'id':$('#EditId').val(),
           'desc':$('#EditDesc').val(),
           'mark':$('#EditMark').val(),
           'bett':$('#EditBett').val(),
            'qty':$('#EditQty').val(),
           'part':$("#EditPart").val(),
          'labor':$("#labourEdit").val(),
          'paint':$("#paintEdit").val(),
          'strip':$("#stripEdit").val(),
          'frame':$("#frameEdit").val(),
            'out':$("#outworkEdit").val(),
                          
    },
                       
        });
        location.reload(true);
  });  

  //End Of Edit Quotes

        //Autofill Front Bumber  
        $('.parts').on('click',function(e){
          $("#InputDesc").val($(this).data('picture_id'));
        });

        //AutoFill Front Door
        $('.front_door').on('click',function(e){
          $("#InputDesc").val($(this).data('picture_id'));
        });

        //AutoFill Rear Door
        $('.rear_door').on('click',function(e){
          $("#InputDesc").val($(this).data('picture_id'));
        });

        //AutoFill Front Suspension
        $('.front_wheel').on('click',function(e){
          $("#InputDesc").val($(this).data('picture_id'));
        });  

        //Autofill Rear Suspension
        $('.rear_suspension_auto').on('click',function(e){
          $("#InputDesc").val($(this).data('picture_id'));
        });

        //AutoFill Rear Bumper
        $('.rear_parts').on('click',function(e){
          $("#InputDesc").val($(this).data('picture_id'));
        });


        //Autofill Double Engine
        $('.engine_auto').on('click',function(e){
          $("#InputDesc").val($(this).data('picture_id'));
        });

        //Autofill Transmission
        $('.transmission_auto').on('click',function(e){
          $("#InputDesc").val($(this).data('picture_id'));
        });

        //Autofill Air Condition
        $('.air_condition_auto').on('click',function(e){
          $("#InputDesc").val($(this).data('picture_id'));
        });

        //Autofill Dashboard
        $('.dashboard_auto').on('click',function(e){
          $('#InputDesc').val($(this).data('picture_id'));
        });

        //Autofill Front Seat
        $('.frontseat_auto').on('click',function(e){
          $("#InputDesc").val($(this).data('picture_id'));
        });

        //Autofill Rear Seat
        $('.backseat_auto').on('click',function(e){
          $("#InputDesc").val($(this).data('picture_id'));
        });

        //Autofill Exhaust
        $('.exhaust').on('click',function(e){
          $("#InputDesc").val($(this).data('picture_id'));
        });

        //Autofill Fuel System
        $('.fuel').on('click',function(e){
          $("#InputDesc").val($(this).data('picture_id'));
        });

        //Save Quotation
        $('.modal-footer').on('click','.save_oper',function(){
              
             $.ajax({
                        type:'POST',
                        url: '/saveQuote',
                        dataType: 'json',
                        data: {
                          '_token':"<?php echo e(csrf_token()); ?>",
                          'opa':$('#InputOper').val(),
                          'desc':$('#InputDesc').val(),
                          'mark':'0',
                          'bett':'0',
                          'qty':'1',
                          'part':$("#InputPart").val(),
                          'labor':$("#labourInput").val(),
                          'paint':$("#paintInput").val(),
                          'strip':$("#stripInput").val(),
                          'frame':$("#frameInput").val(),
                          'out':$("#outworkInput").val(),
                          'ref':$('#InputKeyRef').val(),
                        },
                        success:function(data){
                          $('div.success').show();
                          $('div.success').html('Status changed').delay(1000).fadeOut();
                          $('#InputOper').val('');
                          $('#InputPart').val('');
                        },
                       
          });
        });

        //Delete Quotation Part
        $('.modal-footer').on('click','.delete_part',function(){
          $.ajax({
                        type:'DELETE',
                        url: '/deleteQuote',
                        dataType: 'json',
                        data: {
                            'id':$('#part_id').val(),
                       },
                      success:function(data){
                        $('#quoteData').DataTable();
                      }, 
                       
        });
        });

                //Repair Modal
                $(document).on('click', '.operRate', function() {
            var key=$('#key_ref').val();
            var desc=$('#InputDesc').val();
           $('#InputKeyRef').val(key); 
           $('#InputOper').val($(this).data('oper')); 
           $('.modal-title').text('Remove And Repair');
           $.ajax({
            type:'GET',
            url: '/searchPart',
            data: {'description':desc},
            success:function(data){
              $('#InputPart').val(data[0]);
              $('#paintInput').val(data[1]);
              $('#labourInput').val(data[2]);
              $('#stripInput').val(data[3]);
              $('#frameInput').val(data[4]);
              $('#outworkInput').val(data[5]);
            }  
            });

           $('#operationsModal').modal('show');
           
        });    
     
             //R+R Modal
          $(document).on('click', '.removeAndRepair', function() {
            var key=$('#key_ref').val();
            var desc=$('#InputDesc').val();
           $('#InputKeyRef').val(key); 
           $('#InputOper').val($(this).data('oper')); 
           $('.modal-title').text('Remove And Repair');
           $.ajax({
            type:'GET',
            url: '/searchPart',
            data: {'description':desc},
            success:function(data){
              $('#InputPart').val(data[0]);
              $('#paintInput').val(data[1]);
              $('#labourInput').val(data[2]);
              $('#stripInput').val(data[3]);
              $('#frameInput').val(data[4]);
              $('#outworkInput').val(data[5]);
            }  
            });

           $('#operationsModal').modal('show');
           
        });

        //Spray Modal
        $(document).on('click', '.spray', function() {
            var key=$('#key_ref').val();
             $('#InputKeyRef').val(key); 
             $('#InputOper').val($(this).data('oper')); 
            var desc=$("#InputDesc").val();
           $('.modal-title').text('Spray');
           $.ajax({
            type:'GET',
            url: '/searchPart',
            data: {'description':desc},
            success:function(data){
              $('#InputPart').val(data[0]);
              $('#paintInput').val(data[1]);
              $('#labourInput').val(data[2]);
              $('#stripInput').val(data[3]);
              $('#frameInput').val(data[4]);
              $('#outworkInput').val(data[5]);
            }  
            });

           $('#operationsModal').modal('show');
           
        });

        //Alternative Modal
        $(document).on('click', '.alternative', function() {
          var key=$('#key_ref').val();
           $('#InputKeyRef').val(key); 
           $('#InputOper').val($(this).data('oper')); 
           $('.modal-title').text('Alternative Part');
           var desc=$("#InputDesc").val();
           $('.modal-title').text('Spray');
           $.ajax({
            type:'GET',
            url: '/searchPart',
            data: {'description':desc},
            success:function(data){
              $('#InputPart').val(data[0]);
              $('#paintInput').val(data[1]);
              $('#labourInput').val(data[2]);
              $('#stripInput').val(data[3]);
              $('#frameInput').val(data[4]);
              $('#outworkInput').val(data[5]);
            }  
            }); 

           $('#operationsModal').modal('show');
           
        });

        //Inhouse Modal  
        $(document).on('click', '.inhouse', function() {
            var key=$('#key_ref').val();
           $('#InputKeyRef').val(key); 
           $('#InputOper').val($(this).data('oper')); 
           $('.modal-title').text('Inhouse Operations');
           var desc=$("#InputDesc").val();
           $('.modal-title').text('Spray');
           $.ajax({
            type:'GET',
            url: '/searchPart',
            data: {'description':desc},
            success:function(data){
              $('#InputPart').val(data[0]);
              $('#paintInput').val(data[1]);
              $('#labourInput').val(data[2]);
              $('#stripInput').val(data[3]);
              $('#frameInput').val(data[4]);
              $('#outworkInput').val(data[5]);
            }  
            });
           $('#operationsModal').modal('show');
           
        }); 
        
        //Blend Modal
        $(document).on('click', '.blend', function() {
            var key=$('#key_ref').val();
           $('#InputKeyRef').val(key); 
           $('#InputOper').val($(this).data('oper')); 
           $('.modal-title').text('Blended Part');
           var desc=$("#InputDesc").val();
           $('.modal-title').text('Spray');
           $.ajax({
            type:'GET',
            url: '/searchPart',
            data: {'description':desc},
            success:function(data){
              $('#InputPart').val(data[0]);
              $('#paintInput').val(data[1]);
              $('#labourInput').val(data[2]);
              $('#stripInput').val(data[3]);
              $('#frameInput').val(data[4]);
              $('#outworkInput').val(data[5]);
            }  
            });
           $('#operationsModal').modal('show');
           
        });

        //D&A Modal
        $(document).on('click', '.dnA', function() {
            var key=$('#key_ref').val();
           $('#InputKeyRef').val(key); 
           $('#InputOper').val($(this).data('oper')); 
           $('.modal-title').text('Diagnos and Assess');
           var desc=$("#InputDesc").val();
           $('.modal-title').text('Spray');
           $.ajax({
            type:'GET',
            url: '/searchPart',
            data: {'description':desc},
            success:function(data){
              $('#InputPart').val(data[0]);
              $('#paintInput').val(data[1]);
              $('#labourInput').val(data[2]);
              $('#stripInput').val(data[3]);
              $('#frameInput').val(data[4]);
              $('#outworkInput').val(data[5]);
            }  
            });
           $('#operationsModal').modal('show');
           
        });

        //Check Modal  
        $(document).on('click', '.check', function() {
          var key=$('#key_ref').val();
           $('#InputKeyRef').val(key); 
           $('#InputOper').val($(this).data('oper')); 
           $('.modal-title').text('Check');
           var desc=$("#InputDesc").val();
           $('.modal-title').text('Spray');
           $.ajax({
            type:'GET',
            url: '/searchPart',
            data: {'description':desc},
            success:function(data){
              $('#InputPart').val(data[0]);
              $('#paintInput').val(data[1]);
              $('#labourInput').val(data[2]);
              $('#stripInput').val(data[3]);
              $('#frameInput').val(data[4]);
              $('#outworkInput').val(data[5]);
            }  
            });
           $('#operationsModal').modal('show');
           
        });

        //Outwork Modal  
        $(document).on('click', '.outwork', function() {
            var key=$('#key_ref').val();
           $('#InputKeyRef').val(key); 
           $('#InputOper').val($(this).data('oper')); 
           $('.modal-title').text('Outwork');
           var desc=$("#InputDesc").val();
           $('.modal-title').text('Spray');
           $.ajax({
            type:'GET',
            url: '/searchPart',
            data: {'description':desc},
            success:function(data){
              $('#InputPart').val(data[0]);
              $('#paintInput').val(data[1]);
              $('#labourInput').val(data[2]);
              $('#stripInput').val(data[3]);
              $('#frameInput').val(data[4]);
              $('#outworkInput').val(data[5]);
            }  
            });
           $('#operationsModal').modal('show');
           
        });

        //2nd Hand Modal
        $(document).on('click', '.2ndHand', function() {
            var key=$('#key_ref').val();
           $('#InputKeyRef').val(key); 
           $('#InputOper').val($(this).data('oper')); 
           $('.modal-title').text('2nd Hand');
           var desc=$("#InputDesc").val();
           $('.modal-title').text('Spray');
           $.ajax({
            type:'GET',
            url: '/searchPart',
            data: {'description':desc},
            success:function(data){
              $('#InputPart').val(data[0]);
              $('#paintInput').val(data[1]);
              $('#labourInput').val(data[2]);
              $('#stripInput').val(data[3]);
              $('#frameInput').val(data[4]);
              $('#outworkInput').val(data[5]);
            }  
            });
           $('#operationsModal').modal('show');
           
        });

        $(document).on('click','.double_cab_bumper',function(){
          //var id=$('#InputKeyRef').val();
          var neo='MGC200349';
          $.ajax({
            type:'GET',
            url: '/doublecabfrontbumper',
            data:{
              'id':neo,
            }
                                        
          });
        });


            
    </script>    
    

  </body>
  </html>  