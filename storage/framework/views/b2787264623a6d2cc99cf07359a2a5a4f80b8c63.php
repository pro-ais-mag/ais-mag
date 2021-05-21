<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="_token" content="<?php echo e(csrf_token()); ?>"/>
  <title>A.I.S | Administrator</title>

  <!-- Custom fonts for this template-->
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="icon" href="/img/mag_icon.PNG">  
  <!-- Custom styles for this template-->
  <link href="/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav navbar-nav bg-gradient-primary text-sm sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/administrator">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas"></i>
        </div>
        <div class="sidebar-brand-text mx-3">AIS<sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="/administrator">
          <i class="fas fa-fw fa-home"></i>
          <span>Administrator Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Administrator Features
      </div>

     
 <!-- Divider -->
 <hr class="sidebar-divider">
         <!-- Nav Item -  Body Side Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQuickPrint" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Administrator Dash</span>
        </a>
        <div id="collapseQuickPrint" class="collapse" aria-labelledby="headingQuickPrint" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Administration</h6>
            <a class="collapse-item" href="/billing">Billing</a>
            <a class="collapse-item" href="/users">Users</a>
            <a class="collapse-item" href="/ais">A.I.S Users</a>   
          </div>
        </div>
      </li>
        
      

      <hr class="sidebar-divider">

        <!-- Nav Item -  Body Side Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQuotaions" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-clipboard-check"></i>
          <span>Quotations Dash</span>
        </a>
        <div id="collapseQuotaions" class="collapse" aria-labelledby="headingQuotaions" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Quotations</h6>
            <a class="collapse-item" href="/create-quote">Create Quote</a>
            <a class="collapse-item" href="/allquotes">Quotes</a>
            <a class="collapse-item" href="/authorized">Authorized</a>
            <!--<a class="collapse-item" href="/quoted">Quotes</a>-->   
            <!--<a class="collapse-item" href="/unquoted">Unquoted</a>-->
            <a class="collapse-item" href="/printSalvage" target="_blank">Print Salvage</a>
            <a class="collapse-item pre_bookings" href="#prebookings">Print Prebookings</a>
            <a class="collapse-item" href="/assessor">Assessors</a>
            <!--<a class="collapse-item" href="/proforma-invoice">Proforma Invoice</a>-->
          </div>
        </div>
      </li>
<hr class="sidebar-divider">

<!-- Nav Item -  Body Side Menu -->
<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConsumerables" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-luggage-cart"></i>
          <span>Consumables Dash</span>
        </a>
        <div id="collapseConsumerables" class="collapse" aria-labelledby="headingQuotaions" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Consumables</h6>
            <a class="collapse-item" href="/consumerable-stock">Stock</a>
            <a class="collapse-item" href="/comsumerable-order-stock">Order Stock</a>
            <a class="collapse-item" href="/consumerable-invoice">Upload Invoice</a>   
            <a class="collapse-item" href="/consumerable-supplier">Supplier</a>
            <a class="collapse-item" href="/consumerable-inventory-stock">Inventory Stock</a>
            <a class="collapse-item" href="/consumer-parts-requesation">Requesation Of Stores</a>
          </div>
        </div>
      </li>

<hr class="sidebar-divider">

<!--Nav Item Body Side Menu -->
<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseParts" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Parts Dash</span>
        </a>
        <div id="collapseParts" class="collapse" aria-labelledby="headingQuotaions" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Parts</h6>
           <!-- <a class="collapse-item" href="/parts">Ordering</a>
            <a class="collapse-item" href="#">Additional </a>-->
            <a class="collapse-item" href="/pre-costing">Pre Costing</a>
            <!--<a class="collapse-item" href="/stores">Stores</a>-->
            
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">
<!-- Nav Item -  Body Side Menu -->

<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomerCare" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-user-check"></i>
          <span>Customer Care Dash</span>
        </a>
        <div id="collapseCustomerCare" class="collapse" aria-labelledby="headingQuotaions" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Customer Care</h6>
            <a class="collapse-item" href="/customer-care-clients">View Customer</a>
            <!--<a class="collapse-item" href="/customer-care-edit">Edit Customers</a>
            <a class="collapse-item" href="/customer">Get Customers</a>-->
            
            
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">

<!-- Nav Item -  Body Side Menu -->

<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFinalStage" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-thumbs-up"></i>
          <span>Final Stage Dash</span>
        </a>
        <div id="collapseFinalStage" class="collapse" aria-labelledby="headingQuotaions" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Final Stage</h6>
            <a class="collapse-item" href="/final-stage">View Vehicles</a>
         </div>
        </div>
      </li>      

      <hr class="sidebar-divider">

<!-- Nav Item -  Body Side Menu -->

<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCreditors" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-receipt"></i>
          <span>Creditors Dash</span>
        </a>
        <div id="collapseCreditors" class="collapse" aria-labelledby="headingQuotaions" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Creditors</h6>
            <a class="collapse-item" href="/creditors">View Creditors</a>
         </div>
        </div>
      </li>    

      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCarRental" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-car-alt"></i>
          <span>Car Rental Dash</span>
        </a>
        <div id="collapseCarRental" class="collapse" aria-labelledby="headingQuotaions" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Car Rentals</h6>
            <a class="collapse-item" href="http://192.168.0.185:8080/BCR/" target="_blank">Buyline</a>
         </div>
        </div>
      </li>    
<hr class="sidebar-divider">

<!-- Nav Item -  Body Side Menu -->
<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLineManager" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-tools"></i>
          <span>Line Manager Dash</span>
        </a>
        <div id="collapseLineManager" class="collapse" aria-labelledby="headingLineManager" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Line Manager</h6>
            <a class="collapse-item" href="/line-manager-employees">Employee Timesheet</a>
            <a class="collapse-item" href="/line-manager-analysis">Labour Analysis</a>
            <a class="collapse-item" href="/driver-current-location">Driver Tracking</a>
           </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

        <!-- Nav Item -  Body Side Menu -->
        <li class="nav-item">
        <a class="nav-link" href="/logout" >
          <i class="fas fa-fw fa-power-off"></i>
          <span>Log Off</span>
        </a>
        
      </li>

      
      <!-- Divider -->
      <hr class="sidebar-divider">
      
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
<br>
      <!-- Main Content -->
      <div id="content">

        
        
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          
          <?php echo $__env->yieldContent('content'); ?>
            
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 <!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- Add New Inventory Modal -->
<div class="modal fade" id="add_new_inventory_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm" role="document">
      <div class="modal-content"  style="font-size:10px;">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Add New Inventory.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" style="font-size:10px;">
          <div class="form-group">
            <form action="/consumerable-add-new-inventory" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

              <label for="description">Description:</label>
                <input type="text" id="inventory_idescription" name="inventory_description" class="form-control form-control-sm" required>
          </div>
          <div class="form-group">
            <label for="description">Category:</label>
              <select id="inventory_cate" name="inventory_cate" class="form-control form-control-sm" required>
                <option value="">Select</option>
                <option value="Sundries">Sundries</option>
                <option value="Paint Supplies">Paint Supplies</option>
                <option value="Waste Disposal">Waste Disposal</option>
                <option value="Inhouse Stock">Inhouse Stock</option>
                <option value="Tools">Tools</option>
                <option value="Equipment">Equipment</option>
              </select>
          </div>
          <div class="form-group">
            <label for="description">Amount/Unit:</label>
              <input type="text" id="inventory_unit" name="inventory_unit" class="form-control form-control-sm" required>
          </div>
          <div class="form-group">
            <label for="description">Quantity:</label>
              <input type="number" id="inventory_quan" name="inventory_quan" class="form-control form-control-sm" required>
          </div>
          <div class="form-group">
            <label for="description">Supplier:</label>
              <input type="text" id="inventory_supplier" name="inventory_supplier" class="form-control form-control-sm" required>
          </div>
          <div class="form-group">
            <label for="description">Icon:</label>
              <input type="file" id="inventory_icon" name="inventory_icon" class="form-control form-control-sm" required>
          </div>
          <div class="form-group">
            <label for="description">Branch:</label>
              <select id="inventory_branch" name="inventory_branch" class="form-control form-control-sm" required>
                <option selected="" disabled="">Select Branch</option>
                <option value="Selby">Selby</option>
                <option value="Longmeadow">Longmeadow</option>
                <option value="The Glen">The Glen </option>
                <option value="The Glen Eastcliff">The Glen Eastcliff</option>
              </select>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="Add Stock">
          </form>
        </div>
      </div>
    </div>
</div>


<!-- End New Inventory Modal -->

<!-- Statement Modals-->
<div class="modal fade" id="statements_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm" role="document">
      <div class="modal-content"  style="font-size:10px;">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Statements.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" style="font-size:10px;">
          <input type="hidden" id="id_stat" name="ïd_stat">
            <div class="form-group">
              <label for="stat_from">From:</label>
                <input type="date" id="stat_from" name="stat_from" class="form-control form-control-sm" required>
            </div>
            <div class="form-group">
              <label for="stat_to">To:</label>
                <input type="date" id="stat_to" name="stat_to" class="form-control form-control-sm" required>
            </div>
            <div id="statement_details">
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <a href="#" class="btn btn-success btn-sm fetch_statements"><span class="fa fa-print"></span>Print</a>
          
        </div>
      </div>
    </div>
</div>
<!-- End Statements Modal -->

<!-- Manage POP-->

<div class="modal fade" id="purchase_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-sm" role="document">
      <div class="modal-content"  style="font-size:10px;">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Proof Of Purchase.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" style="font-size:10px;">
          <input type="hidden" id="id_purchase" name="ïd_purchase">
            <div class="form-group">
              <label for="purchase_from">From:</label>
                <input type="date" id="purchase_from" name="purchase_from" class="form-control form-control-sm" required>
              </div>
              <div class="form-group">
              <label for="purchase_to">To:</label>
                <input type="date" id="purchase_to" name="purchase_to" class="form-control form-control-sm" required>
                
              </div>
              <div id="purchase_details"></div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
              <a href="#" class="btn btn-success btn-sm fetch_pop"><span class="fa fa-print"></span>Print</a>
              
            </div>
        </div>
    </div>
</div>

<!-- End Of POP-->

<!-- Manage RFC-->

<div class="modal fade" id="rfc_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-sm" role="document">
      <div class="modal-content"  style="font-size:10px;">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">RFC.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" style="font-size:10px;">
            <input type="hidden" id="id_rfc" name="ïd_rfc">
        
          <div id="rfc_details"></div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <!--<a href="#" class="btn btn-success btn-sm fetch_pop"><span class="fa fa-print"></span>Print</a>-->
          
        </div>
      </div>
    </div>
</div>

<!-- End Of RFC-->

<!-- Add Final Stage Addition Modal -->

<div class="modal fade" id="final_stage_additional_adds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content"  style="font-size:10px;">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;text-align:center;">Create New Additional.</h5>
          <a href="#" class="btn btn-primary btn-sm send_final_additional_email" data-id="" title="Send Quotation Email" style="margin-left:20px;"><span class="fa fa-envelope"></span> Email</a>
          <a href="#" class="btn btn-secondary btn-sm" title="Send Images" style="margin-left:10px;"><span class="fa fa-image"></span> Add Images</a>
          <a href="#" class="btn btn-warning btn-sm" title="Save Additional Quotation" style="margin-left:10px;"><span class="fa fa-save"> Save Quote</span></a>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" style="font-size:10px;">
          <form method="POST" action="/final-stage-add-create">
          <?php echo csrf_field(); ?>

          <div class="row">
              <textarea class="form-control form-control-sm" id="add_comment" name="add_comment" row="5" required></textarea>
          </div>  
          <br>
          <table class="table table-sm" style="font-size:10px;">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Description</th>
                <th scope="col">Oper</th>
                <th scope="col">Percentage</th>
                <th scope="col">Quantity</th>
                <th scope="col">Part</th>
                <th scope="col">Paint</th>
                <th scope="col">Frame</th>
                <th scope="col">Labor</th>
                <th scope="col">R & R</th>
                <th scope="col">Outwork</th>
                <th scope="col">Inhouse</th>
                <th scope="col">Betterment</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <input type="hidden" id="add_id" name="add_id">
              
              <tr>
                  <td><input type="text" name="add_desc" id="add_desc" class="form-control form-control-sm" required></td>
                  <td><select id="add_oper" name="add_oper" class="form-control form-control-sm" required>
                    
                  </select></td>
                  <td><input type="number" name="add_percent" id="add_percent" class="form-control form-control-sm" required></td>
                  <td><input type="number" name="add_quan" id="add_quan" class="form-control form-control-sm" required></td>
                  <td><input type="text" name="add_part" id="add_part" class="form-control form-control-sm" required></td>
                  <td><input type="text" name="add_paint" id="add_paint" class="form-control form-control-sm" required></td>
                  <td><input type="text" name="add_frame" id="add_frame" class="form-control form-control-sm" required></td>
                  <td><input type="text" name="add_labor" id="add_labor" class="form-control form-control-sm" required></td>
                  <td><input type="text" name="add_rnr" id="add_rnr" class="form-control form-control-sm" required></td>
                  <td><input type="text" name="add_outwork" id="add_outwork" class="form-control form-control-sm" required></td>
                  <td><input type="text" name="add_inhouse" id="add_inhouse" class="form-control form-control-sm" required></td>
                  <td><input type="text" name="add_bett" id="add_bett" class="form-control form-control-sm" required></td>
                  <td>
                  <div class="btn-group">
                    <input type="submit" class="btn btn-success btn-sm" style="margin-left:5px;" value="Save"> 
                  </div>  
                  </td>
              </tr>
            </form>
            </tbody>
          </table>                    
        </div>
        <div id="addition_parts"></div> 
      </div>
    </div>
</div>
<!-- End Add Final Stage Additional Modal -->

<!-- Additionals Modal -->
<div class="modal fade" id="final_stage_additional_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document" style="width:900px;">
      <div class="modal-content"  style="font-size:10px;">
        <div class="modal-header bg-danger">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;text-align:center;">Additionals.</h5>
          
          
          <div class="btn-group">
            <a href="#" class="btn btn-success btn-sm final_stage_additional_add" data-id="<?php echo e($key); ?>" title="Add New Additional"><span class="fa fa-plus"></span></a> 
            <button class="btn btn-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-dropup-auto="false" style="margin-left:5px;">
                                    Print Previews
            </button>
            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="/print-final-costing-total/<?php echo e($key); ?>" target="_blank">No Water Mark</a>
              <a class="dropdown-item" href="/print-final-costing-all-figure/<?php echo e($key); ?>" target="_blank">All in Figure</a>
              <a class="dropdown-item" href="/print-final-costing-no-extra/<?php echo e($key); ?>" target="_blank">No Extra</a>
              <a class="dropdown-item" href="/print-time-sheet/<?php echo e($key); ?>" target="_blank">Time Sheet</a>
            </div>
          </div>
        </div>
        <div class="modal-body" style="font-size:10px;">
        <input type="hidden" id="id_rfc" name="ïd_rfc">
        
          <div id="additionals_details"></div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <!--<a href="#" class="btn btn-success btn-sm fetch_pop"><span class="fa fa-print"></span>Print</a>-->
          
        </div>
      </div>
    </div>
</div>
<!-- End Additional Modal-->

<!-- Additional Send Email Modal -->
<div class="modal fade" id="final_stage_email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content sm">
        <div class="modal-header bg-primary">
          <h7 class="modal-title" id="exampleModalLabel" style="color:white;">Send Email.</h7>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form> 
          <?php echo csrf_field(); ?>

        <div class="modal-body" style="font-size:10px;">
          <input type="hidden" name="final_stage_email_id" id="final_stage_email_id">
          <!--<div class="form-group">-->
          
          <div class="form-group">
          <label for="final_stage_address">Email Address:</label>
            <input type="email" id="final_stage_address" name="final_stage_address" class="form-control form-control-sm" > 
          </div>
                    
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary btn-sm" value="Send">
        </div>
        </form>
      </div>
    </div>
  </div>

<!-- End Additional Modal -->


<!-- 1.) -->

<!-- Consumables Modals-->
<!--Stock Plus Modal-->
<div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Stock.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id_stock" id="id_stock">
            <input type="hidden" name="current" id="current"> 
          <div class="form-group">
          <label for="description">Description:</label>
            <input type="text" id="description" name="description" class="form-control" readonly>
          </div>
          <div class="form-group">
          <label for="catergory">Catergory:</label>
            <input type="text" id="catergory" name="catergory" class="form-control" readonly> 
          </div>
          <div class="form-group">
          <label for="quan">Quantity:</label>
            <input type="text" id="quan" name="quan" class="form-control"> 
          </div> 
          <div class="form-group">
          <label for="price">Price:</label>
            <input type="text" id="price" name="price" class="form-control" readonly> 
          </div>
          <div class="form-group">
          <label for="supplier">Supplier:</label>
            <input type="text" id="supplier" name="supplier" class="form-control" readonly> 
          </div>
          <div class="form-group">
          <label for="branch_minus">Branch:</label>
            <select name="branch_minus" id="branch_minus" class="form-control">
                <option value="The Glen">The Glen</option>
                <option value="Selby">Selby</option>
                <option value="Longmeadow">Longmeadow</option>
            </select> 
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-success add_stock_save" href="#" data-dismiss="modal">+Add Stock</a>
        </div>
      </div>
    </div>
  </div>

  

<!--Minus Modal Supplies-->
<div class="modal fade" id="stockMinusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Stock Minus.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id_stock_minus" id="id_stock_minus"> 
            <input type="hidden" name="current_minus" id="current_minus">
          <div class="form-group">
          <label for="description_minus">Description:</label>
            <input type="text" id="description_minus" name="description_minus" class="form-control" readonly>
          </div>
          <div class="form-group">
          <label for="catergory_minus">Catergory:</label>
            <input type="text" id="catergory_minus" name="catergory_minus" class="form-control" readonly> 
          </div>
          <div class="form-group">
          <label for="quan_minus">Quantity:</label>
            <input type="text" id="quan_minus" name="quan_minus" class="form-control"> 
          </div> 
          <div class="form-group">
          <label for="price_minus">Price:</label>
            <input type="text" id="price_minus" name="price_minus" class="form-control" readonly> 
          </div>
          <div class="form-group">
          <label for="supplier_minus">Supplier:</label>
            <input type="text" id="supplier_minus" name="supplier_minus" class="form-control" readonly> 
          </div>
          <div class="form-group">
          <label for="branch_minus">Branch:</label>
            <select name="branch_minus" id="branch_minus" class="form-control">
                <option value="The Glen">The Glen</option>
                <option value="Selby">Selby</option>
                <option value="Longmeadow">Longmeadow</option>
            </select> 
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger minus_stock_save" href="#">Proceed</a>
        </div>
      </div>
    </div>
  </div>

  <!--Send Email Order Stock Modal-->
<div class="modal fade" id="orderStockEmailkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Order Stock Email.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id_stock" id="id_stock">
            <input type="hidden" name="current" id="current"> 
          <div class="form-group">
          <label for="supplier_email">Supplier Email:</label>
            <input type="text" id="supplier_email" name="supplier_email" class="form-control" readonly>
          </div>
          <div class="form-group">
          <label for="catergory">Order No:</label>
            <input type="text" id="orderNo_email" name="orderNo_email" class="form-control" readonly> 
          </div>
                    
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-info send_order_email" href="#" data-dismiss="modal">Send Email</a>
        </div>
      </div>
    </div>
  </div>
<!-- End Of Consumables Modals-->


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
            <input type="text" id="supplier_name" name="supplier_name" class="form-control form-control-sm" required>
          </div>
          <div class="form-group">
          <label for="supplier_phone">Phone:</label>
            <input type="text" id="supplier_tel" name="supplier_tel" class="form-control form-control-sm" required>
          </div>
          <div class="form-group">
          <label for="supplier_fax">Fax:</label>
            <input type="text" id="supplier_fax" name="supplier_fax" class="form-control form-control-sm" required>
          </div>
          <div class="form-group">
          <label for="supplier_phone">Email:</label>
            <input type="email" id="supplier_email" name="supplier_email" class="form-control form-control-sm" required>
          </div>
          <div class="form-group">
          <label for="supplier_phone">Contact Person:</label>
            <input type="text" id="supplier_person" name="supplier_person" class="form-control form-control-sm" required>
          </div>
          <div class="form-group">
          <label for="supplier_cell">Cell No:</label>
            <input type="text" id="supplier_cell" name="supplier_cell" class="form-control form-control-sm" required>
          </div>          
          <div class="form-group">
          <label for="supplier_alt">Alternative No:</label>
            <input type="text" id="supplier_alt" name="supplier_alt" class="form-control form-control-sm" required>
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

<!--PreBooking Modal-->

<div class="modal fade" id="prebookingsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog sm" role="document">
      <div class="modal-content sm">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Print Pre-Bookings.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/printPreBooking" method="GET" target="_blank"> 
        <div class="modal-body">
          <div class="form-group">
          <label for="from_date">From:</label>
            <input type="date" id="from_date" name="from_date" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="to_date">To:</label>
            <input type="date" id="to_date" name="to_date" class="form-control form-control-sm" > 
          </div>
                    
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary" value="Print">
        </div>
        </form>
      </div>
    </div>
  </div>
  
<!--End Of Prebooking Modal-->
<!-- Employee Timesheet Modal -->
<div class="modal fade" id="timesheetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content sm">
        <div class="modal-header bg-primary">
          <h7 class="modal-title" id="exampleModalLabel" style="color:white;">Employee Timesheet.</h7>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/line-manger-worker-timesheet" method="POST"> 
          <?php echo csrf_field(); ?>

        <div class="modal-body" style="font-size:10px;">
          <input type="hidden" name="user_time" id="user_time">
          <div class="form-group">
          <label for="from_date">From:</label>
            <input type="date" id="from_date_time" name="from_date_time" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="to_date">To:</label>
            <input type="date" id="to_date_time" name="to_date_time" class="form-control form-control-sm" > 
          </div>
                    
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary btn-sm" value="Display">
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- End Modal -->
<!--Create Invoice Modal-->

<div class="modal fade" id="createInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
    <div class="modal-dialog sm" role="document">
      <div class="modal-content sm">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Create Invoice.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/print-create-invoice" method="POST" target="_blank"> 
        <?php echo csrf_field(); ?>

        <div class="modal-body" style="font-size:12px;">
          <div class="form-group">
            <input type="hidden" id="invoice_key" name="invoice_key">
          <label for="invoice_to">Invoice To:</label>
            <input type="text" id="invoice_to" name="invoice_to" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="invoice_address">Address:</label>
            <textarea id="invoice_aaddress" name="invoice_address" class="form-control form-control-sm" row="5"></textarea> 
          </div>
          <div class="form-group">
          <label for="invoice_vat">VAT No.:</label>
            <input type="text" id="invoice_vat" name="invoice_vat" class="form-control form-control-sm">
          </div>          
          <div class="form-group">
          <label for="invoice_discount">Invoice To:</label>
            <input type="text" id="invoice_to" name="invoice_to" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="invoice_description">Description:</label>
            <textarea id="invoice_description" name="invoice_description" class="form-control form-control-sm" row="5"></textarea> 
          </div>
          <div class="form-group">
          <label for="invoice_amount">Amount:</label>
            <input type="text" id="invoice_amount" name="invoice_amount" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="invoice_discount">Discount:</label>
            <input type="text" id="invoice_discount" name="invoice_discount" class="form-control form-control-sm">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success" value="Save">
        </div>
        </form>
      </div>
    </div>
  </div>
<!--End Of Create invoice-->

<!--SMS WIP/SMS-->
<div class="modal fade" id="customerCareSmsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">WIP/SMS </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/customer-care-send-sms" method="POST"> 
        <?php echo csrf_field(); ?>

        <input type="hidden" name="sms_stage" id="sms_stage">
        <input type="hidden" name="sms_cell" id="sms_cell">
        <input type="hidden" name="sms_id" id="sms_id">
        <input type="hidden" name="sms_reg" id="sms_reg">
          <div class="row">
            <label>Title:</label>
            <input type="text" class="form-control form-control-sm" id="sms_title" name="sms_title" readonly>
          </div>
          <div class="row">
            <label>Message:</label>
            <textarea id="sms_message" name="sms_message" class="form-control form-control-sm" row="5"></textarea> 
          </div>
        </div>  
        <div class="modal-footer">
          <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="Send SMS">
          
        </div>
      </form>
      </div>
    </div>
  </div>
  <!--END WIP/SMS MODAL-->

<!-- Landing Price Modal-->
<div class="modal fade" id="landingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content sm">
        <div class="modal-header bg-primary">
          <h7 class="modal-title" id="exampleModalLabel" style="color:white;">Landing Price.</h7>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/pre-costing-landing" method="POST"> 
          <?php echo csrf_field(); ?>

        <div class="modal-body" style="font-size:10px;">
          <input type="hidden" name="stores_landing_id" id="stores_landing_id">
          <!--<div class="form-group">-->
          
          <div class="form-group">
          <label for="landing_amount">Part Amount:</label>
            <input type="number" id="stores_landing_amount" name="stores_landing_amount" class="form-control form-control-sm" > 
          </div>
                    
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary btn-sm" value="Save">
        </div>
        </form>
      </div>
    </div>
  </div>

<!--End Landing Price Modal-->

  <!-- Credit Note-->
<div class="modal fade" id="create_create_notes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content"  style="width:950px;font-size:10px;">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Create Credit Note.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" style="font-size:10px;">
        <table class="table table-sm" style="font-size:10px;">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Quantity</th>
              <th scope="col">Part No</th>
              <th scope="col">Description</th>
              <th scope="col">Price</th>
              <th scope="col">Invoice No.</th>
              <th scope="col">Date</th>
              <th scope="col">Comment</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          <form method="GET" action="/pre-costing-create-credit-note">
            <input type="hidden" id="credit_id" name="credit_id">
            <input type="hidden" id="credit_order_id" name="credit_order_id">
            <tr>
                <td><input type="number" name="credit_quan" id="credit_quan" class="form-control form-control-sm" required></td>
                <td><input type="text" name="credit_part" id="credit_part" class="form-control form-control-sm" required></td>
                <td><select name="credit_description" id="credit_description" style="width:150px;"class="form-control form-control-sm description_parts" required><option value="">--Select Parts--</option></select></td>
                <td><input type="text" name="credit_price" id="credit_price" class="form-control form-control-sm" required></td>
                <td><input type="text" name="credit_invoice" id="credit_invoice" class="form-control form-control-sm" required></td>
                <td><input type="date" name="credit_date" id="credit_date" class="form-control form-control-sm" required></td>
                <td><input type="text" name="credit_comment" id="credit_comment" class="form-control form-control-sm" required></td>
                <td>
                <div class="btn-group">
                  <a id="print_part_credit" href="#" class="btn btn-primary btn-sm" target='_blank'>Print</a> 
                  <input type="submit" class="btn btn-warning btn-sm" style="margin-left:5px;" value="RFC"> 
                </div>  
                </td>
            </tr>
          </form>
          </tbody>
        </table>                    
        </div>
        
      </div>
    </div>
</div>
<!-- End Of Credit Note Modal-->

<!-- Add New Inventory Modal -->
<div class="modal fade" id="add_new_inventory_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content"  style="width:950px;font-size:10px;">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Create Credit Note.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" style="font-size:10px;">
        <table class="table table-sm" style="font-size:10px;">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Quantity</th>
              <th scope="col">Part No</th>
              <th scope="col">Description</th>
              <th scope="col">Price</th>
              <th scope="col">Invoice No.</th>
              <th scope="col">Date</th>
              <th scope="col">Comment</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          <form method="GET" action="/pre-costing-create-credit-note">
            <input type="hidden" id="credit_id" name="credit_id">
            <input type="hidden" id="credit_order_id" name="credit_order_id">
            <tr>
                <td><input type="number" name="credit_quan" id="credit_quan" class="form-control form-control-sm" required></td>
                <td><input type="text" name="credit_part" id="credit_part" class="form-control form-control-sm" required></td>
                <td><select name="credit_description" id="credit_description" style="width:150px;"class="form-control form-control-sm description_parts" required><option value="">--Select Parts--</option></select></td>
                <td><input type="text" name="credit_price" id="credit_price" class="form-control form-control-sm" required></td>
                <td><input type="text" name="credit_invoice" id="credit_invoice" class="form-control form-control-sm" required></td>
                <td><input type="date" name="credit_date" id="credit_date" class="form-control form-control-sm" required></td>
                <td><input type="text" name="credit_comment" id="credit_comment" class="form-control form-control-sm" required></td>
                <td>
                <div class="btn-group">
                  <a id="print_part_credit" href="#" class="btn btn-primary btn-sm" target='_blank'>Print</a> 
                  <input type="submit" class="btn btn-warning btn-sm" style="margin-left:5px;" value="RFC"> 
                </div>  
                </td>
            </tr>
          </form>
          </tbody>
        </table>                    
        </div>
        
      </div>
    </div>
</div>


<!-- End New Inventory Modal -->

<!-- Sell Equipment Modal -->
<div class="modal fade" id="consu_sell_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content sm">
        <div class="modal-header bg-danger">
          <h7 class="modal-title" id="exampleModalLabel" style="color:white;">Consumable Tools Purchase.</h7>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/consumer-inventory-equipment-sell" method="POST"> 
          <?php echo csrf_field(); ?>

        <div class="modal-body" style="font-size:10px;">
          <div class="row">
            
            <div class="form-group col-4">
            <label for="sell_fullname">Full Name:</label>
              <input type="text" name="sell_fullname" class="form-control form-control-sm" id="sell_fullname" required>
            </div>
            <div class="form-group col-4">
            <label for="sell_id_no">ID No:</label>
            <input type="text" name="sell_id_no" id="sell_id_no" class="form-control form-control-sm" required>
            </div>
            <div class="form-group col-4">
            <label>Mobile:</label>
            <input type="text" name="sell_mobile" id="sell_mobile" class="form-control form-control-sm" required>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-4">
            <label>Description:</label>
            <input type="text" name="sell_description" class="form-control form-control-sm" id="sell_description" required>
            </div>
            <div class="form-group col-4">
            <label>Amount:</label>
            <input type="text" name="sell_amount" id="sell_amount" class="form-control form-control-sm" required>
            </div>
            <div class="form-group col-4">
            <label>Quantity:</label>
            <input type="number" name="sell_quan" id="sell_quan" class="form-control form-control-sm" required>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-4">
            <label>Supplier:</label>
            <input type="text" name="sell_supplier" class="form-control form-control-sm" id="sell_supplier" required>
            </div>
            <div class="form-group col-4">
            <label>Monthly:</label>
            <input type="number" max="31" name="sell_monthly" id="sell_monthly" class="form-control form-control-sm" required>
            </div>
            <div class="form-group col-4">
            <label>Deduction Date:</label>
            <input type="date" name="sell_deduction" id="sell_deduction" class="form-control form-control-sm" required>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-4">
              <label>Branch:</label>
              <select class="form-control form-control-sm" id="sell_branch" name="sell_branch" required>
                <option value="" disabled selected>Select Branch</option>
                <option value="Selby">Selby</option>
                <option value="Longmeadow">Longmeadow</option>
                <option value="The Glen">The Glen</option>
                <option value="The Glen Eastcliff">The Glen Eastcliff</option>
              </select> 
            </div>
          </div>                 
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="Save">
        </div>
        </form>
      </div>
    </div>
  </div>


<!-- End Sell Equipment Modal -->
<!-- Shortcuts Modal-->
<div class="modal fade" id="shortcut_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content"  style="width:950px;font-size:10px;">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Shortcuts.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" style="font-size:10px;">
        <div id="shortcut" name="shortcut"></div>                    
        </div>
        
      </div>
    </div>
</div>


<!--End Shortcut Modal -->

<!-- Create Note Customer Care-->
<div class="modal fade" id="create_customercare_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content"  style="width:600px;font-size:10px;">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Create Customer Care.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="" method="GET">
        <input hidden="customer_id" name="customer_id">
        <div class="modal-body" style="font-size:10px;">
              <div class="row">
              <textarea class="form-control" id="customer_care_note" name="customer_care_note" row="5" required></textarea>
              </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="Save">
        </div>
        </form>
      </div>
    </div>
</div>

<!-- End Create Note Customer Care -->
 <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------> 
  <!--<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>-->
  <!--<script src="/vendor/jquery/jquery-3.2.1.min.js"></script>-->
  <script src="/vendor/jquery/jquery.min.js"></script>
  
  <!--Socket.io cdn-->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.0/socket.io.js'></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- End Of Socket.IO CDN -->


  <!-- Core plugin JavaScript-->
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
  
  <!-- Custom scripts for all pages-->
  <script src="/js/sb-admin-2.min.js"></script>
  <script src="/js/jquery.validate.js"></script>

    <!-- Page level plugins -->
    <script src="/vendor/chart.js/Chart.min.js"></script>
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/js/demo/datatables-demo.js"></script>
    <!--<script src="/js/demo/chart-pie-demo.js"></script>-->
    <!--<script src="/js/demo/chart-area-demo.js"></script>-->
    <script src="/vendor/chart.js/Chart.min.js"></script>
    <script type="text/javascript">
    $(document).on('click', '.create-modal', function() {
            $('#addUserModal').modal('show');
    }); 
    /*$(document).ready(()=>{
      var socket = io("http://127.0.0.1:3000");
      $(document).on('click','.new-destination-btn', function(){
        /*socket.emit("acceptTrip",driverId,initiotorId,destinationLat,destinationLon,destination,(response)=>{
          if(response)
            //do something
            
          else
            //there was an error
        })
        socket.emit("neoConnection",(res)=>{
          alert(res);
        })
      });
    })*/

    $(document).on('click','.create_new_supplier',function(){
      $('#create_new_supplier_kModal').modal('show');
    });  

    $(document).on('click','.statements_modals',function(){
      $('#id_stat').val($(this).data('id'));
      $('#statements_modal').modal('show');
    });

    $(document).on('click','.purchase_modals',function(){
      $('#id_purchase').val($(this).data('id'));  
      $('#purchase_modal').modal('show');
    });

    $(document).on('click','.consu_sell',function(){
      $('#sell_description').val($(this).data('desc'));
      $('#sell_supplier').val($(this).data('supp'));
      $('#sell_amount').val($(this).data('price'));
      $('#consu_sell_modal').modal('show');
    });


    $(document).on('click','.rfc_modals',function(){
      $('#id_rfc').val($(this).data('id'));
      $('#rfc_modal').modal('show');
      var id =$(this).data('id');
      $.ajax({
      type:'GET',
      url :'/final-rfcs',
      //dataType:'json',
      data:{
      'id':id,
       
    },  
    success: function(data) {
    $('#rfc_details').html(data);
    },
  
  });
    });

    $(document).on('click','.final_stage_additional_add',function(){

      $('#final_stage_additional_modal').modal('hide');
      $('#final_stage_additional_adds').modal('show');
      $('#add_id').val($(this).data('id'));
      var id=$(this).data('id');
      $.ajax({
      type:'GET',
      url :'/fetch-additionals',
      //dataType:'json',
      data:{
      'id':id,
       
      },  
      success: function(data) {
      $('#addition_parts').html(data);
     },
  
  });

    });

    $(document).on('click','.send_final_additional_email',function(){
      $('#final_stage_additional_adds').modal('hide');
      $('#final_stage_email_id').val($(this).data('id'));
      
      $('#final_stage_email').modal('show'); 
    });

    $(document).on('click','.edit-modal',function(){
        $('#edit_id').val($(this).data('id'));   
         $('#edit_name').val($(this).data('name'));
         $('#edit_department').val($(this).data('dept'));
         $('#edit_cell').val($(this).data('cell'));
         $('#edit_from').val($(this).data('from'));
         $('#edit_level').val($(this).data('cell'));  
         $('#edit_email').val($(this).data(''));
         $('#edit_pin').val($(this).data('pin'));
        $('#editUserModal').modal('show');
    });    

    $(document).on('click','.create-modal-ais',function(){
      $('#create_ais_Modal').modal('show');
    });

    $(document).on('click','.customercare_sms',function(){
      $('#sms_id').val($(this).data('id')); 
      $('#sms_title').val($(this).data('title'));
      $('#sms_message').val($(this).data('message')); 
      $('#sms_reg').val($(this).data('reg'));
      $('#sms_cell').val($(this).data('cell_no'));
      $('#sms_stage').val($(this).data('mid'));
      $('#customerCareSmsModal').modal('show');
    });

    $(document).on('click','.print_sheet',function(){
      $('#user_time').val($(this).data('id'));
      $('#timesheetModal').modal('show');
    });

    $(document).on('click','.create_create_notes',function() {
            var order_no=$(this).data('order_no');
            var html="";
            
            var select="<option value=''>--Select Parts--</option>";
           $.ajax({
            type:'GET',
            url: '/pre-costing-get-order-parts',
            data: {'order_no':order_no},
            success:function(data){
              
         for (var i = 0; i < data.length; i++) {
         html='<option value="' +data[i]+'">'+ data[i]+'</option>';
         select=select+html;   
         }
              $('#credit_description').html(select);
                         
            }  
            });

            $('#credit_id').val($(this).data('order_no'));
            $('#create_create_notes').modal('show');        
        });

    $(document).on('click','.landing_parts',function(){
      $('#stores_landing_id').val($(this).data('id'));
      $('#landingModal').modal('show');
    });

    $(document).on('click','.create-invoice',function(){
      $('#invoice_key').val($(this).data('id'));  
      $('#createInvoiceModal').modal('show');
    });

    $(document).on('click','.edit-modal-ais',function(){
      $('#ais_id').val($(this).data('id')); 
      $('#ais_username_edit').val($(this).data('name')); 
      $('#ais_email_edit').val($(this).data('email')); 
      $('#ais_depart_edit').val($(this).data('dept'));
      $('#ais_comp_code_edit').val($(this).data('code'));
      $('#ais_quote_edit').val($(this).data('quote'));
      $('#ais_consumer_edit').val($(this).data('consumables'));
      $('#ais_sign_edit').val($(this).data('sign'));
      $('#ais_line_edit').val($(this).data('line'));
      $('#ais_customer_edit').val($(this).data('customer'));
      
      $('#ais_creditor_edit').val($(this).data('creditor'));
      $('#ais_costing_edit').val($(this).data('costing'));
      $('#ais_authorize_edit').val($(this).data('authorize'));
      $('#ais_final_edit').val($(this).data('final_stage'));
      $('#ais_close_edit').val($(this).data('close'));

      $('#edit_modal_ais').modal('show');
    });

    $(document).on('click','.statement-modal',function(){
      $('#stat_id').val($(this).data('id'));
      $('#statement_modal').modal('show');
    });

    $(document).on('click','.create_branch',function(){
      $('#create_branch_modal').modal('show');
    });
    
    $(document).on('click','.add_new_inventory',function(){

      $('#add_new_inventory_modal').modal('show');
    });

    $(document).on('click','.add_credits',function(){
      $('#credit_id').val($(this).data('id'));
      $('#credit_branch').val($(this).data('branch'));
      $('#credit_current').val($(this).data('credit'));
      $('#add_credits_modal').modal('show');
    });

     $(document).on('click','.billing_active',function(){
      var status=$(this).data('status');
      var id=$(this).data('id');
      $.ajax({
      type:'GET',
      url:'/ais-account-setting',
      dataType:'json',
      data:{
        'id':id,
        'status':status,
                  
      },
      });
      location.reload(true);
     });

     $(document).on('click','.print_statement',function(){
       $.ajax({
      type:'GET',
      url:'/print-branch-statement',
      dataType:'json',
      data:{
        'id':$('#stat_id').val(),
        'start':$('#ais_start').val(),
        'end':$('#ais_end').val(),
                  
      },
      });

     });
     
//Add Item Order Stock
$(document).on('click','.add_item_stock',function(){
  $('#order_no').val($(this).data('id'));
  //$('#order_na')
  $('#addItemModal').modal('show');
});

//Add Email Stock Email
$(document).on('click','.order_stock_email',function(){
$('#supplier_email').val($(this).data('email'));
$('#orderNo_email').val($(this).data('id'));
$('#orderStockEmailkModal').modal('show');
});

//Create Order 
$(document).on('click','.create_order',function(){
$('#CreateOrderModal').modal('show');
});



//Change Branch Inventory Stock





//Edit Supplier
$(document).on('click', '.edit_supplier', function() {
 $('#id_supplier').val($(this).data('id'));   
 $('#supplier_name').val($(this).data('name'));
 $('#sales_person').val($(this).data('salesperson'));
 $('#supplier_email').val($(this).data('email'));
 $('#supplier_tel').val($(this).data('tel'));
 $('#supplier_cell').val($(this).data('cell'));  
 $('#supplierModal').modal('show');
});

//Add Supplier
$(document).on('click','.add_supplier',function(){
   $('#supplierAddModal').modal('show');     
});



//Add Stock Modal
$(document).on('click','.add_stock',function(){
$('#id_stock').val($(this).data('id'));
$('#current').val($(this).data('quantity'));
$('#description').val($(this).data('decription'));
$('#catergory').val($(this).data('catergory'));
$('#quan').val($(this).data('contact'));
$('#price').val($(this).data('price'))
$('#supplier').val($(this).data('supplier'))
  $('#stockModal').modal('show');
});

//Minus Stock Modal
$(document).on('click','.minus_stock',function(){
$('#id_stock_minus').val($(this).data('id'));
$('#current_minus').val($(this).data('quantity'));
$('#description_minus').val($(this).data('decription'));
$('#catergory_minus').val($(this).data('catergory'));
$('#quan_minus').val($(this).data('contact'));
$('#price_minus').val($(this).data('price'))
$('#supplier_minus').val($(this).data('supplier'))
  $('#stockMinusModal').modal('show');
}); 



//Edit Supplier Details    
$('.modal-footer').on('click','.edit_supplier_save',function(){
$.ajax({
  type:'GET',
  url :'/consumerable-supplier-edit',
  dataType:'json',
  data:{
    'id':$('#id_supplier').val(),
    'supplier_name':$('#supplier_name').val(),
    'sales_person':$('#sales_person').val(),
    'supplier_email':$('#supplier_email').val(),
    'supplier_tel':$('#supplier_tel').val(),
    'supplier_cell':$('#supplier_cell').val(),  
  },
});
}); 

//Fetch Statements 
$('.modal-footer').on('click','.fetch_statements',function(){
$.ajax({
  type:'GET',
  url :'/statements',
  //dataType:'json',
  data:{
    'id':$('#id_stat').val(),
    'from':$('#stat_from').val(),
    'to':$('#stat_to').val(),
    
},  
success: function(data) {
    $('#statement_details').html(data);
 },
});
});


//Fetch POP
$('.modal-footer').on('click','.fetch_pop',function(){
$.ajax({
  type:'GET',
  url :'/final-pop',
  //dataType:'json',
  data:{
    'id':$('#id_purchase').val(),
    'from':$('#purchase_from').val(),
    'to':$('#purchase_to').val(),
    
},  
success: function(data) {
    $('#purchase_details').html(data);
 },
});
});

//Add Stock Function
$('.modal-footer').on('click','.add_stock_save',function(){
$.ajax({
    type:'GET',
    url:'/consumerable-stock-add',
    dataType:'json',
    data:{
      'id':$('#id_stock').val(),
      'current':$('#current').val(),
      'quan':$('#quan').val(),          
    },
});    
});

//Subtract Stock Function

$('.modal-footer').on('click','.minus_stock_save',function(){
$.ajax({
    type:'GET',
    url:'/consumerable-stock-subtract',
    dataType:'json',
    data:{
       'id':$('#id_stock_minus').val(),
       'current':$('#current_minus').val(),
      'quan':$('#quan_minus').val(),          
    },
});    
});


//Send Email Consumerables
$('.modal-footer').on('click','.send_order_email',function(){
  $.ajax({
    type:'GET',
    url:'/consumerable-email',
    dataType:'json',
    data:{
       'email':$('#supplier_email').val(),
       'order_no':$('#orderNo_email').val(),
                
    },
}); 

});

//Change Inventory Branch
//$('#inventory_branch').change(function(){
  //var branch=$("#inventory_branch").val();
  //$.ajax({
      //type:'POST',
      //url:'/consumerable-inventory-branch',
     // dataType:'json',
      //data:{
        //'_token':"<?php echo e(csrf_token()); ?>",
        //'branch':branch,
        //},
        //success:function(data){
      //    $('#dataTable').val(data[all]);
    //    },  
  //});
  //location.reload(true);
//});

//Customer Care Add Comment
//Add comments
$(document).on('click','.add_comment',function(){
$('#comment_track').val($(this).data('id'));
$('#comment_name').val($(this).data('name')); 
$('#commentModal').modal('show');     
}); 


//Edit Customer Care Feedback
$(document).on('click','.edit_feedback',function(){
  $('#comment_id_edit').val($(this).data('ref'));
  $('#comment_track_edit').val($(this).data('id'));
  $('#comment_name_edit').val($(this).data('name'));
  $('#comment_type_edit').val($(this).data('comment-type'));
  $('#comment_note_edit').val($(this).data('note'));
  $('#editCommentModal').modal('show'); 
});

//Add Item Order Stock
$(document).on('click','.add_item_stock',function(){
  $('#order_no').val($(this).data('id'));
  $('#order_na')
  $('#addItemModal').modal('show');
});

//Add Email Stock Email
$(document).on('click','.order_stock_email',function(){
$('#supplier_email').val($(this).data('email'));
$('#orderNo_email').val($(this).data('id'));
$('#orderStockEmailkModal').modal('show');
});

//Create Order 
$(document).on('click','.create_order',function(){
$('#CreateOrderModal').modal('show');
});


//Edit Supplier
$(document).on('click', '.edit_supplier', function() {
 $('#id_supplier').val($(this).data('id'));   
 $('#supplier_name').val($(this).data('name'));
 $('#sales_person').val($(this).data('salesperson'));
 $('#supplier_email').val($(this).data('email'));
 $('#supplier_tel').val($(this).data('tel'));
 $('#supplier_cell').val($(this).data('cell'));  
 $('#supplierModal').modal('show');
});

//Add Supplier
$(document).on('click','.add_supplier',function(){
$('#supplierAddModal').modal('show');     
});




//Edit Landing Price
$(document).on('click','.edit_landing',function(){
  $('#landing_price').val($(this).data('price'));
  $('#landing_id').val($(this).data('id'));
  $('#landing_part').val($(this).data('desc'));
  $('#editLandingModal').modal('show');
});

//Add Documents
$(document).on('click','.select_doc_type',function(){
  var doc=$('#doc_type').val();
  if(doc=="invoices"){
    $('#addDocumentsModal').modal('show');
  }else if(doc=="statement"){
    $('#statementDocumentModal').modal('show');  
  }else if(doc=="proof"){
    $('#proofDocumentModal').modal('show');
  }else if(doc=="supplier"){
    $('#rfcsDocumentModal').modal('show');
  }
});

//Select Document Type
$(document).on('click','.select_document',function(){
$('#selectDocumentModal').modal('show');
});

//Add Pre Costing Documentson
$(document).on('click','.add_precosting_doc',function(){
$('#precostingDocsModal').modal('show');
});

//Add Stock Modal
$(document).on('click','.add_stock',function(){
$('#id_stock').val($(this).data('id'));
$('#current').val($(this).data('quantity'));
$('#description').val($(this).data('decription'));
$('#catergory').val($(this).data('catergory'));
$('#quan').val($(this).data('contact'));
$('#price').val($(this).data('price'))
$('#supplier').val($(this).data('supplier'))
$('#stockModal').modal('show');
});

//Minus Stock Modal
$(document).on('click','.minus_stock',function(){
$('#id_stock_minus').val($(this).data('id'));
$('#current_minus').val($(this).data('quantity'));
$('#description_minus').val($(this).data('decription'));
$('#catergory_minus').val($(this).data('catergory'));
$('#quan_minus').val($(this).data('contact'));
$('#price_minus').val($(this).data('price'))
$('#supplier_minus').val($(this).data('supplier'))
$('#stockMinusModal').modal('show');
}); 



//Edit Supplier Details    
$('.modal-footer').on('click','.edit_supplier_save',function(){
$.ajax({
  type:'GET',
  url :'/consumerable-supplier-edit',
  dataType:'json',
  data:{
    'id':$('#id_supplier').val(),
    'supplier_name':$('#supplier_name').val(),
    'sales_person':$('#sales_person').val(),
    'supplier_email':$('#supplier_email').val(),
    'supplier_tel':$('#supplier_tel').val(),
    'supplier_cell':$('#supplier_cell').val(),  
  },
});
}); 

//Add Stock Function
$('.modal-footer').on('click','.add_stock_save',function(){
$.ajax({
    type:'GET',
    url:'/consumerable-stock-add',
    dataType:'json',
    data:{
      'id':$('#id_stock').val(),
      'current':$('#current').val(),
      'quan':$('#quan').val(),          
    },
});    
});

//Subtract Stock Function

$('.modal-footer').on('click','.minus_stock_save',function(){
$.ajax({
    type:'GET',
    url:'/consumerable-stock-subtract',
    dataType:'json',
    data:{
       'id':$('#id_stock_minus').val(),
       'current':$('#current_minus').val(),
      'quan':$('#quan_minus').val(),          
    },
});    
});


//Send Email Consumerables
$('.modal-footer').on('click','.send_order_email',function(){
  $.ajax({
    type:'GET',
    url:'/consumerable-email',
    dataType:'json',
    data:{
       'email':$('#supplier_email').val(),
       'order_no':$('#orderNo_email').val(),
                
    },
}); 

});


//Customer Care Add Comment
//Add comments
$(document).on('click','.add_comment',function(){
$('#comment_track').val($(this).data('id'));
$('#comment_name').val($(this).data('name')); 
$('#commentModal').modal('show');     
}); 


//Edit Customer Care Feedback
$(document).on('click','.edit_feedback',function(){
  $('#comment_id_edit').val($(this).data('ref'));
  $('#comment_track_edit').val($(this).data('id'));
  $('#comment_name_edit').val($(this).data('name'));
  $('#comment_type_edit').val($(this).data('comment-type'));
  $('#comment_note_edit').val($(this).data('note'));
  $('#editCommentModal').modal('show'); 
});

//Autofill Assessor
$('#assessor').change(function() {
            var name=$("#assessor").val();
           
           $.ajax({
            type:'GET',
            url: '/assessor-info',
            data: {'name':name},
            success:function(data){
              $('#assessor_email').val(data[0]);
              $('#assessor_no').val(data[1]);
              $('#assessor_company').val(data[2]);
              
            }  
            });
                      
        });  

//Autofill Broker
$('#insuror').change(function() {
            var name=$("#insuror").val();
           
           $.ajax({
            type:'GET',
            url: '/broker-info',
            data: {'name':name},
            success:function(data){
              $('#insurance_email').val(data[0]);
              $('#contact_number').val(data[1]);
              
              
            }  
            });
                      
        });
        
 //Autofill Tower
 $('#towed_by').change(function() {
            var name=$("#towed_by").val();
           
           $.ajax({
            type:'GET',
            url: '/tow-info',
            data: {'name':name},
            success:function(data){
              $('#tow_email').val(data[0]);
              $('#tow_contact_number').val(data[1]);
              
              
            }  
            });
                      
        });   

  //Disable/Enable Insurance    
$('#insurance_type').change(function(){
  var type_in=$('#insurance_type').val();
  if(type_in=='1'){
    $('#insuror').attr('disabled',true);
    $('#contact_number').attr('disabled',true);
    $('#insurance_email').attr('disabled',true);
    $('#claim_number').attr('disabled',true);
    $('#clerk_ref').attr('disabled',true);
    $('#assessor').attr('disabled',true);
    $('#assessor_email').attr('disabled',true);
    $('#assessor_no').attr('disabled',true);
    $('#assessor_company').attr('disabled',true);
  }else{
    $('#insuror').attr('disabled',false);
    $('#contact_number').attr('disabled',false);
    $('#insurance_email').attr('disabled',false);
    $('#claim_number').attr('disabled',false);
    $('#clerk_ref').attr('disabled',false);
    $('#assessor').attr('disabled',false);
    $('#assessor_email').attr('disabled',false);
    $('#assessor_no').attr('disabled',false);
    $('#assessor_company').attr('disabled',false);
  }

});

//Disable_Enable Towing
$('#towed').change(function(){
  var towed=$('#towed').val();
  if(towed=='2'){
    $('#towed_by').attr('disabled',true);
    $('#tow_contact_number').attr('disabled',true);
    $('#tow_email').attr('disabled',true);
    $('#tow_fee').attr('disabled',true);
    $('#towed_status').attr('disabled',true);
  }else{
    $('#towed_by').attr('disabled',false);
    $('#tow_contact_number').attr('disabled',false);
    $('#tow_email').attr('disabled',false);
    $('#tow_fee').attr('disabled',false);
    $('#towed_status').attr('disabled',false);
  }
});      


  //AutoFill Precosting Supplier
  $('#order_suppliers').change(function() {
            var name=$("#order_suppliers").val();
           
           $.ajax({
            type:'GET',
            url: '/pre-costing-suppliers',
            data: {'name':name},
            success:function(data){
              $('#order_supplier').val(data[0]);
              $('#order_email_supplier').val(data[1]);
              $('#order_branch_tel').val(data[2]);
              
            } 
            });
                      
  });      

//AutoFill Final Pre Ordering

$('#final_order_suppliers').change(function() {
            var name=$("#final_order_suppliers").val();
           
           $.ajax({
            type:'GET',
            url: '/pre-costing-suppliers',
            data: {'name':name},
            success:function(data){
              $('#final_order_supplier').val(data[0]);
              $('#final_order_email_supplier').val(data[1]);
              $('#final_order_branch_tel').val(data[2]);
              
            } 
            });
                      
  });    

 //Edit Assessor
 $(document).on('click', '.edit-assessor', function() {
          $('#assessor_id').val($(this).data('id'));
          $('#assessor_fullname').val($(this).data('name'));
          $('#assessor_company').val($(this).data('company'));
          $('#assessor_tell').val($(this).data('tell'));
          $('#assessor_cell').val($(this).data('cell'));
          $('#assessor_email').val($(this).data('email'));  
          $('#AssessorModal').modal('show');
       });

       //Add Assessor
       $(document).on('click','.add_assessor',function(){
          $('#AssessorAddModal').modal('show');
       });

       //Pre Booking Notes
       $(document).on('click','.add_prebooking_notes',function(){
        $('#id_prebooking').val($(this).data('id'));
        $('#full_name').val($(this).data('full'));
        $('#email').val($(this).data('email'));
        $('#contact').val($(this).data('contact'));
        $('#notes').val($(this).data('notes'));
          $('#prebookingNotesModal').modal('show');
       });

       //Print Pre Booking
       $(document).on('click','.pre_bookings',function(){
        $('#prebookingsModal').modal('show');
       });       
     
       //Edit Assessor
       $('.modal-footer').on('click','.editassessor',function(){
        $.ajax({
          type:'PUT',
          url :'/editAssessor',
          dataType:'json',
          data:{
            '_token':"<?php echo e(csrf_token()); ?>",
            'id':$('#assessor_id').val(),
            'name':$('#assessor_fullname').val(),
            'company':$('#assessor_company').val(),
            'tel':$('#assessor_tell').val(),
            'cell':$('#assessor_cell').val(),
            'email':$('#assessor_email').val(),
          },
        });
      });    

      
      

      
      //Get Print Booking
      $('.modal-footer').on('click','.print_prebooking',function(){
        $.ajax({
          type:'GET',
          url :'/printPreBooking',
          dataType:'json',
          data:{
            'from_date':$('#from_date').val(),
            'to_date':$('#to_date').val(),
          },
        });
      });

      //Create Assessor
      $('.modal-footer').on('click','.createassessor',function(){
        $.ajax({
          type:'POST',
          url :'/createAssessor',
          dataType:'json',
          data:{
            '_token':"<?php echo e(csrf_token()); ?>",
            'name':$('#assessor_create_fullname').val(),
            'company':$('#assessor_create_company').val(),
            'tel':$('#assessor_create_tell').val(),
            'cell':$('#assessor_create_cell').val(),
            'email':$('#assessor_create_email').val(),  
          },
        });
      });

      //Add Assessor
      $(document).on('click','.release_register',function(){
          $('#release_register').modal('show');
       });

 //validation Form Plus Submit
$(document).ready(function() {
  //Change Markup
  var today = new Date();
  var dd = ("0" + (today.getDate())).slice(-2);
  var mm = ("0" + (today.getMonth() +　1)).slice(-2);
  var yyyy = today.getFullYear();
  today = yyyy + '-' + mm + '-' + dd ;
  $("#final_date").attr("value", today);  
         
$('#creation').submit(function(e) {
  
  var first_name = $('#name').val();
  var last_name = $('#lastname').val();
  var mobile=$('#mobile').val();
  var estimator=$('#estimator').val();
  var branch=$('#branch').val();
  var vin_number=$('#vin_number').val();
  var eng_no=$('#engine_number').val();
  var make=$('#make').val();
  var model=$('#model').val();
  //var booking=$('#booking').val();
  var quote_date=$('#quote_date').val();
  var reg_no=$('#registration').val();
  var dob=$('#odb').val();

  $(".error").remove();

  if (dob.length < 1) {
    $('#dob_span').before('<span class="error" style="font-size:12px;color:red;">DOB Required</span>');
    e.preventDefault();
  }
  if (reg_no.length < 1) {
    $('#registration').before('<span class="error" style="font-size:12px;color:red;">Registration Required</span>');
    e.preventDefault();
  }
  if (first_name.length < 1) {
    $('#name').before('<span class="error" style="font-size:12px;color:red;">First Name Required</span>');
    e.preventDefault();
  }
  if (last_name.length < 1) {
    $('#lastname').before('<span class="error" style="font-size:12px;color:red;">Last Name Required</span>');
    e.preventDefault();
  }
  if (mobile.length < 1) {
    $('#mobile').before('<span class="error" style="font-size:12px;color:red;">Mobile No Required</span>');
    e.preventDefault();
  }
  if (estimator.length < 1) {
    $('#estimator').before('<span class="error" style="font-size:12px;color:red;">Estimator Required</span>');
    e.preventDefault();
  }
  if (branch.length < 1) {
    $('#branch').before('<span class="error" style="font-size:12px;color:red;">Branch Required</span>');
    e.preventDefault();
  }
  if (vin_number.length < 1) {
    $('#vin_number').before('<span class="error" style="font-size:12px;color:red;">VIN Number Required</span>');
    e.preventDefault();
  }
  if (eng_no.length < 1) {
    $('#engine_number').before('<span class="error" style="font-size:12px;color:red;">Engine Required</span>');
    e.preventDefault();
  }
  if (make.length < 1) {
    $('#make').before('<span  class="error" style="font-size:12px;color:red;">Make Required</span>');
    e.preventDefault();
  }
  if (model.length < 1) {
    $('#model').before('<span class="error"  style="font-size:12px;color:red;">Model Required</span>');
    e.preventDefault();
  }
  //if (booking.length < 1) {
  //  $('#booking_span').before('<span class="error"  style="font-size:12px;color:red;">Booking Date Required</span>');
  //  e.preventDefault();
  //}
  if (quote_date.length < 1) {
    $('#quote_date_span').before('<span class="error" style="font-size:12px;color:red;">Quote Date Required</span>');
    e.preventDefault();
  }
});
});

    </script>
    <script>

function changeThisMarkUp(idz) {
            var dd = idz.substring(idz.indexOf("_"));
            var d = $("#EditAddQtsMarkUpNewTd" + dd).val();
            var id = idz.substring(0, idz.indexOf("_"));
            $.ajax({
                type:'POST',
                url: '/update-final-markup-only',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",  
                    id: id,
                    d: d
                }
                
            });
            location.reload(true);
        }
  //change Markup Only
  function changeThisMarkUp_(idz) {
            var dd = idz.substring(idz.indexOf("_"));
            var d = $("#EditAddQtsMarkUpNewTd1" + dd).val();
            var id = idz.substring(0, idz.indexOf("_"));
            if (parseInt($("#EditAddQtsMarkUpNewTd1" + dd).val()) > 0) {
                $("#EditAddQtsMarkUpNewTd" + dd).val(0);
                $("#EditAddQtsMarkUpNewTd" + dd).trigger('change');
            }
            $.ajax({
                type:'POST',
                url: '/update-final-markup',
                data: {
                    id: id,
                    d: d
                }
                
            });
            location.reload(true);
        } 
  //change Betterment
  function changeThisBtment(idz) {
            var dd = idz.substring(idz.indexOf("_"));
            var d = $("#EditAddQtsBtmentNewTd" + dd).val();
            var id = idz.substring(0, idz.indexOf("_"));
            $.ajax({
                type:'POST',
                url: '/update-final-betterment',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                    id: id,
                    d: d
                }
                
                
            });
            location.reload(true);
        }
        
  //Get The Saundries
  function getThisSundry(id) {
            var dt = id;
            var d = parseFloat($("#" + id).html()).toFixed(2);
            var e = parseFloat($("#stp").html().replace(/,/g, '')).toFixed(2);
            var f = d;
            var td = dt.substring(0, dt.indexOf("_"));
            $.ajax({
                type:'POST',
                url: '/get-sundrie',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                    id: td,
                    d: f
                }
            });
            location.reload(true);
        }      
  //Get Sundries_
  function getThisSundry_(id) {
            var dt = id;
            var d = parseFloat($("#" + id).html()).toFixed(2);

            var e = parseFloat($("#stp_").html().replace(/,/g, '')).toFixed(2);
            var f = d;
            var td = dt.substring(0, dt.indexOf("_"));
            //alert(id);
            $.ajax({
                type:'POST',
                url: '/get-sundries',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                    id: td,
                    d: f
                }
                
            });
            location.reload(true);
        }      
  //Get Labour Function
  function changeLabor(ref, id) {
    //alert('Labour');
            var val = $("#" + id).html().replace(/,/g, '');
            $.ajax({
              type:'POST',  
              url: '/update-final-labour',
              data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                    val: val,
                    ref: ref
                }
            });
            location.reload(true);
        }

//Get Consumerables
function getThisConsume(ln) {
            var d = parseFloat($("#consu1").html()).toFixed(2);
            var f = d;
            $.ajax({
                type:'POST',
                url: '/update-final-consumable',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                    ln: ln,
                    d: f
                }
                
            });
            location.reload(true);
        }
        function getThisConsume_(ln) {
            var d = parseFloat($("#consu2").html()).toFixed(2);
            var e = parseFloat($("#stp_").html().replace(/,/g, '')).toFixed(2);
            var f = d;
            $.ajax({
              type:'POST',
                url: '/update-final-consumables',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                  ln: ln,
                    d: f
                }
            });
            location.reload(true);
        }
        
     //Get Paint Function
     function changePaint(ref, id) {
            var val = $("#" + id).html().replace(/,/g, '');
            //alert('painting like as boss');
            $.ajax({
                type: 'POST',
                url: '/update-final-paint',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                    val: val,
                    ref: ref
                }
                
                //success: function () {
                  //  $("#getFinalStageClientDivFormId_").trigger('keyup');
                //}
            });
            location.reload(true);
        }   

      //Get Waste Function
      function changeWaste(ln, id) {
            var waste = $("#" + id).html();
            //alert('waste Here');
            $.ajax({
                type: 'post',
                url: '/update-final-waste',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                    ref: ln,
                    waste: waste
                }
                
                //success: function (res) {
                  //  $("#getFinalStageClientDivFormId_").trigger('keyup');
                //}
            });
            location.reload(true);
        }  

     //Get Discount
     function getThisDiscount(id) {
            
            var dt = id;
            var d = $("#disc1").html();
            $.ajax({
                type: 'POST',
                url: '/get-final-discount',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                    id: dt,
                    d: d,
                }
                
                //success: function (id) {
                    // alert(id);
                  //  $("#getFinalStageClientDivFormId_").trigger('keyup');
                    //reloadddpreCosting();
                //}
            });
            location.reload(true);
        }
    //Get Excess
    function getThisExcess(id) {
            var dt = id;
            var d = $("#fnexc1").html();
            $.ajax({
              type: 'POST',  
              url: '/get-final-excess',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                    id: dt,
                    d: d,
                }
                
            });
            location.reload(true);
        }

        //Update Current Operation
        function addThisOper(idz) {
            var de = idz.substring(idz.indexOf("-"));
            var d = $("#" + idz).val();
            var id = de.substring(1);
            if (d !== '') {
                $.ajax({
                    type:'POST',
                    url: '/update-final-operate',
                    data: {
                      '_token':"<?php echo e(csrf_token()); ?>",
                        id: id,
                        d: d,
                    }
                    
                });
            }
            location.reload(true);
        }
        
        //Get This Operation
        function funkThisOper(id) {
            var dd = id.substring(id.indexOf("_"));
            var d = id.substring(0, id.indexOf("_"));
            $("#EditAddQtsOperNewTd" + dd).val(d);
            
        }
        function funkThisBox(id) {
            var dt = id;
            var td = $("#" + id).html();
            $.ajax({
                type:'POST',
                url: '/update-final-desc',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                    id: dt,
                    d: td,
                }
            });
            location.reload(true);
        }

        //Change Operations
        function changeThisOper(idz) {
            var dd = idz.substring(idz.indexOf("_"));
            var d = $("#EditAddQtsOperNewTd" + dd).val();
            var id = idz.substring(0, idz.indexOf("_"));
            if ($("#EditAddQtsOperNewTd" + dd).get(0).selectedIndex === 0) {
                var v = dd;
                $("#aEditTd" + v + "-" + id).html('');
                $("#aEditTd" + v + "-" + id).attr('contenteditable', 'true');
                $("#aEditTd" + v + "-" + id).trigger('focus');
            } else {
                $.ajax({
                    type:'POST',
                    url: '/update-final-operate',
                    data: {
                       '_token':"<?php echo e(csrf_token()); ?>",
                        id: id,
                        d: d,
                    }
                });
            }
            location.reload(true);
        }

      //Landing price
      function funkThixBox(id) {
            var dt = id;
            var d = $("#" + id).html();
            //alert(dt);
            $.ajax({
               type: 'POST',
                url: '/update-final-parts',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                    id: dt,
                    d: d,
                }
            });
            location.reload(true);
        }
        //It landed
        function storeSomeChange(id) {
            var dt = id.substring(0, id.indexOf("_"));
            var check;
            if ($("#" + id).is(':checked')) {
                check = 'yes';
            } else
            if ($("#" + id).is(':not(:checked)')) {
                check = 'no';
            }
            $.ajax({
                type:'POST',
                url: '/update-final-check',
                data: {
                   '_token':"<?php echo e(csrf_token()); ?>",
                    dt: dt,
                    check: check,
                }
                
            });
            location.reload(true);
        }
        //Markup OnLoad
        function funkThisMarkUp(id) {
            var dd = id.substring(id.indexOf("_"));
            var d = id.substring(0, id.indexOf("_"));
            $("#EditAddQtsMarkUpNewTd" + dd).val(d);
            //alert($("#EditAddQtsOperNewTd"+dd).val());
            //console.log(d);
        }

        //Additional 
        function changeThissOper(idz) {
            var dd = idz.substring(idz.indexOf("_"));
            var d = $("#EditAddQtsOperNewTds" + dd).val();
            var id = idz.substring(0, idz.indexOf("_"));
            if ($("#EditAddQtsOperNewTds" + dd).get(0).selectedIndex === 0) {
                var v = dd;
                $("#EditTd" + v + "-" + id).html('');
                $("#EditTd" + v + "-" + id).attr('contenteditable', 'true');
                $("#EditTd" + v + "-" + id).trigger('focus');
            } else {
                $.ajax({
                  type: 'POST',
                  '_token':"<?php echo e(csrf_token()); ?>",
                    url: '/update-final-operate',
                    data: {
                        id: id,
                        d: d,
                    },
                    
                   
                });
            }
            location.reload(true);
        }

        //Additional Change Input
        function funkThixbBox(id) {
            var dt = id;
            var td = dt.substring(0, dt.indexOf("_"));
            var d = $("#" + id).html();
            $.ajax({
                type: 'POST',
                url: '/update-final-parts',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                    id: td,
                    d: d,
                },
                
            });
            location.reload(true);
        }

        //Mark Up Onchange
        function changeThisMarkUp(idz) {
            var dd = idz.substring(idz.indexOf("_"));
            var d = $("#EditAddQtsMarkUpNewTd" + dd).val();
            var id = idz.substring(0, idz.indexOf("_"));
            $.ajax({
                type:'POST',
                url: '/update-final-markup',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                    id: id,
                    d: d,
                }
            });
            location.reload(true);
        }
        function changeThissMarkUp(idz) {
            var dd = idz.substring(idz.indexOf("_"));
            var d = $("#EditAddQtsMarkUpNewTd" + dd).val();
            var id = idz.substring(0, idz.indexOf("_"));
            $.ajax({
                type:'POST',
                url: '/update-final-markup',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                    id: id,
                    d: d,
                }
            });
            location.reload(true);
        }
        //Markup Only Onload
        function funkThisMarkUp_(id) {
            var dd = id.substring(id.indexOf("_"));
            var d = id.substring(0, id.indexOf("_"));
            $("#EditAddQtsMarkUpNewTd1" + dd).val(d);
            alert($("#EditAddQtsOperNewTd"+dd).val());
            //console.log(d);
        }

        //Mark Up Only Onchange
        function changeThisMarkUp_(idz) {
            var dd = idz.substring(idz.indexOf("_"));
            var d = $("#EditAddQtsMarkUpNewTd1" + dd).val();
            var id = idz.substring(0, idz.indexOf("_"));
            if (parseInt($("#EditAddQtsMarkUpNewTd1" + dd).val()) > 0) {
                $("#EditAddQtsMarkUpNewTd" + dd).val(0);
                $("#EditAddQtsMarkUpNewTd" + dd).trigger('change');
            }
            $.ajax({
                type:'POST',
                url: '/update-final-markup-only',
                data: {
                  '_token':"<?php echo e(csrf_token()); ?>",
                    id: id,
                    d: d,
                }
                
            });
            location.reload(true);
        }

        //Onload Betterment
        function funkThisBtment(id) {
            var dd = id.substring(id.indexOf("_"));
            var d = id.substring(0, id.indexOf("_"));
            $("#EditAddQtsBtmentNewTd" + dd).val(d);
        }  

        //Onchange Betterment
        function changeThisBtment(idz) {
            var dd = idz.substring(idz.indexOf("_"));
            var d = $("#EditAddQtsBtmentNewTd" + dd).val();
            var id = idz.substring(0, idz.indexOf("_"));
            $.ajax({
                type:'POST',
                url: '/update-final-betterment',
                data: {
                    id: id,
                    d: d,
                }
            });
            location.reload(true);
        }

        
      $(document).on('change','.signed',function(){
        var signed_id=$(this).data('id');
      if($(this).is(':checked')){
        $.ajax({
          type:'POST',
          url:'/update-signed',
          data:{
            '_token':"<?php echo e(csrf_token()); ?>",
            'id':signed_id,
          },

        });
        location.reload(true);
      }else{
        $.ajax({
          type:'POST',
          url:'/update-unsigned',
          data:{
            '_token':"<?php echo e(csrf_token()); ?>",
            'id':signed_id,
          },

        });
        location.reload(true);
      }
    });

    //Close Record
    $(document).on('change','.closed',function(){
        var closed_id=$(this).data('id');
        var num=0;
      if($(this).is(':checked')){
        var num=1;
        $.ajax({
          type:'POST',
          url:'/update-closed',
          data:{
            '_token':"<?php echo e(csrf_token()); ?>",
            'id':closed_id,
            'num':num,
          },

        });
        location.reload(true);
      }else{
        $.ajax({
          type:'POST',
          url:'/update-closed',
          data:{
            '_token':"<?php echo e(csrf_token()); ?>",
            'id':closed_id,
            'num':num,
          },

        });
        location.reload(true);
      }
    });

    //Change Branch Inventory
    $(document).on('change','.change_branch',function(){
      var branch=$('#inventory_branch').val();
      if(branch=="all"){
        window.location.href="/consumerable-inventory-stock";
      }else{
        window.location.href="/consumerable-inventory-branch/"+branch;
      }
    });

    //Final Stage Additionals
    $(document).on('click','.final_stage_additionals',function(){
      var id=$(this).data('id');
      $('#final_stage_additional_modal').modal('show');
      $.ajax({
          type:'GET',
          url:'/final-additional',
          data:{
            
            'id':id,
          },
         
      success: function(data) {
        $('#additionals_details').html(data);
        },
        });
       });

    //Final Stage Document   
    $(document).on('click','.final_docs',function(){
      var id=$(this).data('id');
        $.ajax({
        type:'GET',
        url:'/final-docs',
        data:{
          'id':id,
        },success: function(data) {
        $('#shortcut').html(data);
      },
      });
      $('#shortcut_modal').modal('show');
    }); 

    //Final Stage Notes Shortcut
    $(document).on('click','.final_notes',function(){
      var id=$(this).data('id');
        $.ajax({
          type:'GET',
          url:'/final-notes',
          data:{
            'id':id,
        },success: function(data) {
        $('#shortcut').html(data);
      },
        });
        $('#shortcut_modal').modal('show'); 
    });

    //Final Stage Update Client Shortcut
    $(document).on('click','.final_update_client',function(){
      var id=$(this).data('id');
        $.ajax({
          type:'GET',
          url:'/final-stage-update-client',
          data:{
            'id':id,
        },success: function(data) {
        $('#shortcut').html(data);
      },
        });
        $('#shortcut_modal').modal('show'); 
    });

    //Final Stage Wheel Aligment Shortcut
    $(document).on('click','.final_wheel_alignment',function(){
      var id=$(this).data('id');
      $.ajax({
          type:'GET',
          url:'/final-stage-wheel-alignment',
          data:{
            'id':id,
        },success: function(data) {
        $('#shortcut').html(data);
      },
        });
        $('#shortcut_modal').modal('show'); 
        
    });

    //Final Stage Photos Shortcut
    $(document).on('click','.final_photos',function(){
      var id=$(this).data('id');
      $.ajax({
          type:'GET',
          url:'/final-stage-photos',
          data:{
            'id':id,
        },success: function(data) {
        $('#shortcut').html(data);
      },
        });
        $('#shortcut_modal').modal('show'); 
    });

    //Final Stage Ordering Shortcut
    $(document).on('click','.final_ordering',function(){
      var id=$(this).data('id');
      $.ajax({
          type:'GET',
          url:'/final-stage-ordering',
          data:{
            'id':id,
        },success: function(data) {
        $('#shortcut').html(data);
      },
        });
        $('#shortcut_modal').modal('show'); 
    });

    //Customer Care Security Shortcut
    $(document).on('click','.secur_photo_customer_care',function(){
      var id=$(this).data('id');
      $.ajax({
          type:'GET',
          url:'/customer-care-security-photo',
          data:{
            'id':id,
        },success: function(data) {
        $('#shortcut').html(data);
      },
        });
        $('#shortcut_modal').modal('show'); 
    });

    //Customer Care Additionals Shortcuts
    $(document).on('click','.add_photo_customer_care',function(){
      var id=$(this).data('id');
      $.ajax({
          type:'GET',
          url:'/customer-care-add-photo',
          data:{
            'id':id,
        },success: function(data) {
        $('#shortcut').html(data);
      },
        });
        $('#shortcut_modal').modal('show'); 
    });

    //Customer Care WIP Shortcuts
    $(document).on('click','.wip_photo_customer_care',function(){
      var id=$(this).data('id');
      $.ajax({
          type:'GET',
          url:'/customer-care-wip-photo',
          data:{
            'id':id,
        },success: function(data) {
        $('#shortcut').html(data);
      },
        });
        $('#shortcut_modal').modal('show'); 
    });

    //Customer Care Final Stage Shortcut
    $(document).on('click','.final_stage_photo_customer_care',function(){
      var id=$(this).data('id');
      $.ajax({
          type:'GET',
          url:'/customer-care-wip-photo',
          data:{
            'id':id,
        },success: function(data) {
        $('#shortcut').html(data);
      },
        });
        $('#shortcut_modal').modal('show'); 
    });

    //Customer Care Documents Shortcut
    $(document).on('click','.document_customer_care',function(){
      var id=$(this).data('id');
      $.ajax({
          type:'GET',
          url:'/customer-care-documents',
          data:{
            'id':id,
        },success: function(data) {
        $('#shortcut').html(data);
      },
        });
        $('#shortcut_modal').modal('show'); 
    });



    //Cunsumables Equipment Save
    $(document).on('click','.consu_func_save',function(){
      var id=$(this).data('id');
      var price     = $('#price'+id).val();
      var quantity  = $('#quantity'+id).val();
      var catergory = $('#catergory'+id).val();
      var serial_no = $('#serial_no'+id).val();
      $.ajax({
          type:'GET',
          url:'/consumer-inventory-equipment-save',
          data:{
            
            'id':id,
            'price':price,
            'quantity':quantity,
            'catergory':catergory,
            'serial_no':serial_no,
          },
            
        });
       });
    
    //Consumables Paint Save
    $(document).on('click','.paint_func_save',function(){
      var id=$(this).data('id');
      var price       = $('#price'+id).val();
      var quantity    = $('#quantity'+id).val();
      var description = $('#description'+id).val();
      $.ajax({
          type:'GET',
          url:'/consumer-inventory-paint-save',
          data:{
            
            'id':id,
            'price':price,
            'quantity':quantity,
            'description':description,
            
          },
          
        });
       }); 

    //Requesation Status Cart     
    $(document).on('click','.status_cart',function(){
      var id=$(this).data('id');
      $.ajax({
          type:'GET',
          url:'/comsumer-requesation-status',
          data:{
            
            'id':id,
            
            
          },
          
        });
        
       }); 

    /**
    //Requesation Close Cart   
    $(document).on('click','.close_cart',function(){
      var id=$(this).data('id');
      var reciever=$(this).data('receiver');
      $.ajax({
          type:'POST',
          url:'/consumer-requesation-close',
          data:{
            
            'id':id,
            'receiver':reciever,
            
          },
      });
    });
    **/


    //# REDO THE [  REQUESATION CLOSE CART ]
    $(document).on('click','.close_cart',function(){
      var id=$(this).data('id');
      var reciever=$(this).data('receiver');
      $.ajax({
          //type:'POST',
          type:'get',
          url:'/consumer-requesation-close',
          data:{'id':id,'receiver':reciever},
          success:function(data){
              if( data == 1){
                  location.reload('/consumer-parts-requesation');
              }else{
                    alert("Failed to close the the cart. Please contact your manager");
              }


          }

      });
    });


    //# APPROVE THE ITEM PURCHASED
    $(document).on('click', '.status_cart', function(){
        var id = $(this).attr('id');

        //#IF ITEM IS ALREADY APPROVED
        if( id == "" || id == null){
          alert("Item already approved");
          return;
        }

        $.ajax({
              url:'/consumerable_approve_items_status',
              method:"get",
              data:{id:id },
              dataType:"text",
              success:function(data){                
                if( data == 1){
                  location.reload('/consumer-parts-requesation');

                }else{
                    alert("Failed to approve store item. Please contact your manager");
                }
                
              }

        });
               
          
    });

//Neo Socket Test

/////////


    </script>
   <?php echo $__env->yieldContent('java'); ?>
   
</body>
</html>  