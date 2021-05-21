<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="_token" content="<?php echo e(csrf_token()); ?>"/>
  <title>A.I.S | Quotation</title>

  <!-- Custom fonts for this template-->
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="icon" href="/img/mag_icon.PNG">  
  <!-- Custom styles for this template-->
  <link href="/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  
  <script type="text/javascript">
    function validateForm()
    {
    var x=document.forms["creation"]["email"].value
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
      {
      alert("Not a valid e-mail address");
      return false;
      }
    }
    </script>

    <style>
    .sidepanel  {
  width: 0;
  position: fixed;
  z-index: 1;
  height: 100%;
  top: 0;
  left: 0;
  background-color: #007ae6;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidepanel a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidepanel a:hover {
  color: #f1f1f1;
}

.sidepanel .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  color:white;
}

.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color:#444;
}

</style>
</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="font-size:10px;">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">AIS</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-home"></i>
          <span>Quotation - <?php echo e($key); ?></span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Quotation
      </div>

     

      <!-- Nav Item -  Body Side Menu -->
      
      <hr class="sidebar-divider">
         <!-- Nav Item -  Body Side Menu -->
        <!-- Nav Item -  Body Side Menu -->
        <li class="nav-item">
        <a class="nav-link" href="/create-quote" >
          <i class="fas fa-fw fa-user-plus"></i>
          <span>Create New</span>
        </a>
        
      </li>

      <hr class="sidebar-divider">
         <!-- Nav Item -  Body Side Menu -->
        <!-- Nav Item -  Body Side Menu -->
        <li class="nav-item">
        <a class="nav-link" href="/openQuotation/<?php echo e($key); ?>" >
          <i class="fas fa-fw fa-user-edit"></i>
          <span>Edit Info</span>
        </a>
        
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
        <li class="nav-item">
          <a class="nav-link" href="/print-prebooking/<?php echo e($key); ?>" target="_blank">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Booking Confirmation</span>
          </a>
        </li>


      <!-- Divider -->
      <hr class="sidebar-divider">
         <!-- Nav Item -  Body Side Menu -->
        <!-- Nav Item -  Body Side Menu -->
        <li class="nav-item">
        <a class="nav-link" href="/viewQuotation/<?php echo e($key); ?>" >
          <i class="fas fa-fw fa-money-check-alt"></i>
          <span>Quotation</span>
        </a>
        
      </li>

      <hr class="sidebar-divider">

        <!-- Nav Item -  Body Side Menu -->
        <li class="nav-item">
        <a class="nav-link" href="/client-document/<?php echo e($key); ?>" >
          <i class="fas fa-fw fa-file"></i>
          <span>Documents</span>
        </a>
        
      </li>
      <hr class="sidebar-divider">
      <!-- Nav Item -  Body Side Menu -->
      <li class="nav-item">
        <a class="nav-link" href="/client-security-photos/<?php echo e($key); ?>" >
          <i class="fas fa-fw fa-camera"></i>
          <span>Security Photos</span>
        </a>
        
      </li>

      <hr class="sidebar-divider">
      <!-- Nav Item -  Body Side Menu -->
      <li class="nav-item">
        <a class="nav-link" href="/client-notes/<?php echo e($key); ?>" >
          <i class="fas fa-fw fa-pen"></i>
          <span>Notes</span>
        </a>
        
      </li>

      <hr class="sidebar-divider">
      <!-- Nav Item -  Body Side Menu -->
      <li class="nav-item">
        <a class="nav-link" href="/client-rate/<?php echo e($key); ?>" >
          <i class="fas fa-fw fa-chart-line"></i>
          <span>Rates</span>
        </a>
        
      </li>

      <hr class="sidebar-divider">
      <!-- Nav Item -  Body Side Menu -->
      <li class="nav-item">
        <a class="nav-link" href="/view-proforma/<?php echo e($key); ?>" >
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Proforma Invoice</span>
        </a>
        
      </li>

      <hr class="sidebar-divider">
      <!-- Nav Item -  Body Side Menu -->
      <li class="nav-item">
        <a class="nav-link" href="/wip-sms/<?php echo e($key); ?>" >
          <i class="fas fa-fw fa-comments"></i>
          <span>W.I.P/SMS</span>
        </a>
        
      </li>


      <hr class="sidebar-divider">
      <!-- Nav Item -  Body Side Menu -->
      <li class="nav-item">
        <a class="nav-link" href="/allquotes" >
          <i class="fas fa-fw fa-arrow-circle-left"></i>
          <span>Return To Quotes</span>
        </a>
        
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

  <!--Select Light Weight Model-->
  
    <div class="modal fade" id="lightVehicleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Select Light Vehicle Type</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form role="form" method="GET" action="/select-vehicle">
            <input type="hidden" name="quote_id" id="quote_id">
            <label for="car_type">Select Vehicle:</label>
            <select class="form-control form-control-sm" id="car_type" name="car_type">
              <option value="3Door">3 Door</option>
              <option value="Hatchback">Hatchback</option>
              <!--<option value="SUV">SUV</option>
              <option value="Sedan">Sedan</option>
              <option value="Cabriolet">Cabriolet</option>-->
              <option value="DoubleCab">Double Cab</option>
              
            </select>
            </div>
        
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
              <input type="submit" class="btn btn-success btn-sm" id="car_submit" name="car_submit" value="Proceed">
          </form>
        </div>
      </div>
    </div>
  </div>

   <!--Select Truck Model-->
  
   <div class="modal fade" id="truckModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Select Truck Type</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <input type="hidden" name="truckquote_id" id="truckquote_id">
        <label for="truckType">Select Vehicle:</label>
        <select class="form-control" id="truckType" name="truckType">
          <option value="Truck1">Truck 1</option>
          <option value="Truck2">Truck 2</option>
          <option value="Truck3">Truck 3</option>
          <option value="Truck4">Truck 4</option>
        </select>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-success" href="/truck">Proceed</a>
        </div>
      </div>
    </div>
  </div>

  <!--Mini Bus-->
  <div class="modal fade" id="busModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Select Bus Type</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <input type="hidden" name="busquote_id" id="busquote_id">
        <label for="busType">Select Vehicle:</label>
        <select class="form-control" id="busType" name="busType">
          <option value="Bus1">Bus 1</option>
          <option value="Bus2">Bus 2</option>
          <option value="Bus3">Bus 3</option>
          <option value="Bus4">Bus 4</option>
        </select>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-success" href="/bus">Proceed</a>
        </div>
      </div>
    </div>
  </div>

  <!--SMS WIP/SMS-->
  <div class="modal fade" id="smsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">WIP/SMS </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/send-test" method="GET">
        <input type="hidden" name="wip_id_sms" id="wip_id_sms">
        <input type="hidden" name="key_ref_sms" id="key_ref_sms" >
        <input type="hidden" name="cell_no_sms" id="cell_no_sms">
        <label for="sms_reg_no_sms">Reg No:</label>  
          <input type="text" name="sms_reg_no_sms" id="sms_reg_no_sms" class="form-control form-control-sm">
        <label for="sms_track">Track ID:</label>  
          <input type="text" name="sms_track_sms" id="sms_track_sms" class="form-control form-control-sm">  
         
        <label for="sms_title_sms">Title:</label>
          <input type="text" name="sms_title_sms" id="sms_title_sms" class="form-control form-control-sm"> 
        <label for="sms_message_sms">Message:</label>  
          <textarea name="sms_message_sms" id="sms_message_sms" class="form-control form-control-sm" row="5"></textarea>
          </div>  
        <div class="modal-footer">
          <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="Send SMS">
          
        </div>
      </form>
      </div>
    </div>
  </div>

  <!-- Delete Part Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Delete Row From Quote.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/delete-quotes" method="GET">
        
          <input type="hidden" name="delete_id" id="delete_id">
            
          <div class="form-group">
          <label for="auth_date">Description:</label>
            <input type="text" id="delete_description" name="delete_description" class="form-control form-control-sm" disabled>
          </div>
                              
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-danger btn-sm" value="Delete">
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Delete Parts Modal -->

  <!--END WIP/SMS MODAL-->  

  <!--Edit Quotation-->
  <!--- START OF EDIT MODAL
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
        <form class="form-horizontal" role="form" method="PUT" id="editModalMoney" action=''>
        
  
        <input type="hidden" name="EditId" id="EditId">
        <input type="hidden" name="EditRef" id="EditRef">
        <label for="EditOper" style="font-size:10px;"><b>Operation</b></label>
        <select class="form-control form-control-sm" name="EditOper" id="EditOper" style="margin-bottom:5px;">
        
        </select>

        <label for="EditDesc" style="font-size:10px;"><b>Description:</b></label>
            <input type="text" class="form-control form-control-sm" name="EditDesc" id="EditDesc" style="margin-bottom:5px;">
        
            <label for="EditPart" style="font-size:10px;"><b>Part:</b></label>
            <input type="number" class="form-control form-control-sm" name="EditPart" step=".01" id="EditPart" style="margin-bottom:5px;">

            <label for="EditMark" style="font-size:10px;"><b>Mark Up:</b></label>
            <input type="number" class="form-control form-control-sm" name="EditMark" step=".01" id="EditMark" style="margin-bottom:5px;">

        <label for="EditBett" style="font-size:10px;"><b>Betterment:</b></label>
            <input type="number" class="form-control form-control-sm" name="EditBett" step=".01" id="EditBett" style="margin-bottom:5px;">

            <label for="EditQty" style="font-size:10px;"><b>Quantity:</b></label>
            <input type="number" class="form-control form-control-sm" name="EditQty"  id="EditQty" style="margin-bottom:5px;">

        <label for="paintEdit" style="font-size:10px;"><b>Paint:</b></label>
            <input type="number" class="form-control form-control-sm" name="paintEdit" step=".01" id="paintEdit" style="margin-bottom:5px;">
            
        
        <label for="labourEdit" style="font-size:10px;"><b>Labour:</b></label>
            <input type="number" class="form-control form-control-sm" name="labourEdit" step=".01" id="labourEdit" style="margin-bottom:5px;">
          
        <label for="stripEdit" style="font-size:10px;"><b>Strip:</b></label>
            <input type="number" class="form-control form-control-sm" name="stripEdit" step=".01" id="stripEdit" style="margin-bottom:5px;">
               
        <label for="frameEdit" style="font-size:10px;"><b>Frame:</b></label>
                <input type="number" class="form-control form-control-sm" name="frameEdit" step=".01" id="frameEdit" style="margin-bottom:5px;">
        
        <label for="outworkEdit" style="font-size:10px;"><b>OutWork:</b></label>
                <input type="number" class="form-control form-control-sm" step=".01" name="outworkEdit" id="outworkEdit" style="margin-bottom:5px;">
            
              
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary edit_save" id="edit_save_money" data-dismiss="modal">Save</button>
        </form>
        </div>
      </div>
    </div>
</div>
  
END OF EDIT MODAL --->

  <!-- Bootstrap core JavaScript-->
 
  <!--<script src="/js/jquery.js"></script>
  <script src="/js/jquery.min.js"></script>-->

  <!--<script src="/vendor/jquery/jquery.min.js"></script>-->

  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  
  <script src="/js/jquery-3.2.1.min.js"></script>
  <!--<script src="/vendor/jquery/jquery.js"></script>-->
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="http://demo.expertphp.in/js/jquery-ui.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="/js/sb-admin-2.min.js"></script>
  

    <!-- Page level plugins -->
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/js/demo/datatables-demo.js"></script>

    
<!--Custom Javascripts-->
<script type="text/javascript">
      
      //light vehicle Select
        $(document).on('click', '.show-modal', function() {
           $('#quote_id').val($(this).data('id')); 
           $('#lightVehicleModal').modal('show');
        });

      //Sms Show Modal
        $(document).on('click', '.send_sms', function() {
           $('#wip_id_sms').val($(this).data('mid'));
           $('#key_ref_sms').val($(this).data('id'));
           $('#sms_track_sms').val($(this).data('id'));
           $('#sms_title_sms').val($(this).data('title'));
           $('#sms_message_sms').val($(this).data('message')); 
           $('#sms_reg_no_sms').val($(this).data('reg'));
           $('#cell_no_sms').val($(this).data('cell_no'));
           $('#smsModal').modal('show');
        });  

      //Delete From Quote
      $(document).on('click','.deleteQuote',function(){
        $('#delete_id').val($(this).data('id'));
        $('#delete_description').val($(this).data('description'));
        $('#deleteModal').modal('show');
      });  

      //Proforma Invoice Modal
      $(document).on('click', '.storage-modal', function() {
           $('#id_storage').val($(this).data('id')); 
           $('#storage_modal').modal('show');
       });    

      //Truck Vehicle Select 
        $(document).on('click', '.truck-modal', function() {
           $('#truckquote_id').val($(this).data('id')); 
           $('#truckModal').modal('show');
       }); 

       //Bus Vehicle Select
       $(document).on('click', '.bus-modal', function() {
           $('#busquote_id').val($(this).data('id'));  
           $('#busModal').modal('show');
       });

      //Bus Vehicle Select
      $(document).on('click', '.bus-modal', function() {
           $('#busquote_id').val($(this).data('id'));  
           $('#smsModal').modal('show');
       }); 

       //Divert To Exterior View Double Cab
       $('.modal-footer').on('click', '.car_select', function() {
        
              $.ajax({
                  type:'GET',
                  url: '/selectCar',
                  dataType: 'json',
                  data: {
                      'quote_id': $('#quote_id').val(),
                      'type':$('#car_type').val(),
                  },
                  
              });
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



//Edit Quotation Part
$(document).on('click','.editQuote',function(){

    var id = $(this).attr('id');
    var oper = $('#EditOper_'+id).val();
    var desc = $('#EditDesc_'+id).val() 
    var mark = $('#EditMark_'+id).val();
    var bett = $('#EditBett_'+id).val();
    var qty = $('#EditQty_'+id).val();
    var part = $('#EditPart_'+id).val();
    var labor = $('#labourEdit_'+id).val();
    var paint = $('#paintEdit_'+id).val();
    var strip = $('#stripEdit_'+id).val();
    var frame = $('#frameEdit_'+id).val();
    var out = $('#outworkEdit_'+id).val();

     $.ajax({
         type:'GET',
         url: '/editQuote',
         data: {
                id:id,
                oper:oper,
                 desc:desc,
                 mark:mark,
                 bett:bett,
                  qty:qty,
                 part:part,
                labor:labor,
                paint:paint,
                strip:strip,
                frame:frame,
                  out:out
                                
          },
          success:function(data){
              if( data == 1 ){
                 //alert("Quote Successfully Updated." + id);
                 alert("Quote Successfully Updated.");
                 location.reload(true);
              }
              
                  
          }

                       
    });


});


//Edit Quotation in Money for the Part
$(document).on('click','.editMoneyQuote',function(){

    var id = $(this).attr('id');
    var oper = $('#EditOper_'+id).val();
    var desc = $('#EditDesc_'+id).val(); 
    var mark = $('#EditMark_'+id).val();
    var bett = $('#EditBett_'+id).val();
    var qty = $('#EditQty_'+id).val();
    var part = $('#EditPart_'+id).val();
    var labor = $('#labourEdit_'+id).val();
    var paint = $('#paintEdit_'+id).val();
    var strip = $('#stripEdit_'+id).val();
    var frame = $('#frameEdit_'+id).val();
    var out = $('#outworkEdit_'+id).val();
    var ref =  $('#ref').val();

     $.ajax({
         type:'GET',
         url: '/editMoneyQuote',
         data: {
                id:id,
                ref:ref,
                oper:oper,
                 desc:desc,
                 mark:mark,
                 bett:bett,
                  qty:qty,
                 part:part,
                labor:labor,
                paint:paint,
                strip:strip,
                frame:frame,
                  out:out
                                
          },
          success:function(data){
              if( data == 1 ){
                 alert("Quote Successfully Updated.");
                 location.reload(true);
              }
              
          }
    });

});








$(document).on('click','.edit_money',function(){
  $("#editModalMoney").submit();
    //location.reload(true);
}); 


//Authorized Quotation
$(document).on('change','.auth_check',function(){
  var id_auth=$(this).data('id');
  if($(this).is(':checked')){
    $('#id_auth').val($(this).data('id'));
    $('#auth_modal').modal('show');
  }else{
    $.ajax({
             type:'POST',
             url: '/unauthorize-quote',
             data: {
               '_token':"<?php echo e(csrf_token()); ?>",
               'id_auth':id_auth,

             }
            
      });
  location.reload(true);
  }

});  

//Waste Disposal
$(document).on('change','.waste',function(){
  var id=$(this).data('id');
  if($(this).is(':checked')){
    
    $.ajax({
             type:'POST',
             url: '/waste-quote',
             data: {
               '_token':"<?php echo e(csrf_token()); ?>",
               'id':id,

             }
            
});
location.reload(true);
}else{
  $.ajax({
             type:'POST',
             url: '/unwaste-quote',
             data: {
               '_token':"<?php echo e(csrf_token()); ?>",
               'id':id,

             }
            
});
location.reload(true);
}
});

//Polish
$(document).on('change','.polish',function(){
  var polish_id=$(this).data('id');
  if($(this).is(':checked')){
    $.ajax({
       type:'POST',
       url:'/polish-quote',
       data:{
         '_token':"<?php echo e(csrf_token()); ?>",
         'id':polish_id,
         
       } 
    });
    location.reload(true);
  }else{
    $.ajax({
       type:'POST',
       url:'/unpolish-quote',
       data:{
         '_token':"<?php echo e(csrf_token()); ?>",
         'id':polish_id,
       } 
    });
    location.reload(true);
  }
});

//Covid-19
$(document).on('change','.covid',function(){
  var covid_id=$(this).data('id');
  if($(this).is(':checked')){
    $.ajax({
       type:'POST',
       url:'/covid-quote',
       data:{
         '_token':"<?php echo e(csrf_token()); ?>",
         'id':covid_id,
         
       } 
    });
    location.reload(true);
  }else{
    $.ajax({
       type:'POST',
       url:'/covid-unquote',
       data:{
         '_token':"<?php echo e(csrf_token()); ?>",
         'id':covid_id,
       } 
    });
    location.reload(true);
  }
});

//Agreed Only
$(document).on('change','.agreed_only',function(){
  var agreed_id=$(this).data('id');
  if($(this).is(':checked')){
    $.ajax({
      type:'POST',
      url:'/agreed-quote',
      data:{
        '_token':"<?php echo e(csrf_token()); ?>",
        'id':agreed_id,
      },

    });
    location.reload(true);
  }else{
    $.ajax({
      type:'POST',
      url:'/unagreed-quote',
      data:{
        '_token':"<?php echo e(csrf_token()); ?>",
        'id':agreed_id,
      },

    });
    location.reload(true);
  }
});

//Working Screen Select
$('#inwhat').change(function() {
  var work=$('#inwhat').val();
  var id =$(this).data('id');
  if(work==1){
  window.location='/view-quote-money/'+id;
  
  }
  else if(work==2){
    window.location='/viewQuotation/'+id;
  }
});



//Proforma Invoice Write Off
$(document).on('change','.write_off',function(){
  var write_off=$(this).data('id');
  if($(this).is(':checked')){
    $.ajax({
      type:'POST',
      url:'/proforma-write-off',
      data:{
        '_token':"<?php echo e(csrf_token()); ?>",
        'id':write_off,
        'status':'1',
      },

    });
    location.reload(true);
  }else{
    $.ajax({
      type:'POST',
      url:'/proforma-write-off-remove',
      data:{
        '_token':"<?php echo e(csrf_token()); ?>",
        'id':write_off,
        'status':'0',
      },

    });
    location.reload(true);
  }
});
  </script>



  <!--End Of Custom Scripts-->

  <script>
   $(document).ready(function() {
    src = "<?php echo e(route('autocomplete')); ?>";
     $("#description").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: src,
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                   
                }
            });
        },
        minLength: 3,
       
    });
});

//Autofill Assessor
$('#assessor_edit').change(function() {
            var name=$("#assessor_edit").val();
           
           $.ajax({
            type:'GET',
            url: '/assessor-info',
            data: {'name':name},
            success:function(data){
              $('#assessor_email_edit').val(data[0]);
              $('#assessor_no_edit').val(data[1]);
              $('#assessor_company_edit').val(data[2]);
              
            }  
            });
                      
        });  

//Autofill Broker
$('#insuror_edit').change(function() {
            var name=$("#insuror_edit").val();
           
           $.ajax({
            type:'GET',
            url: '/broker-info',
            data: {'name':name},
            success:function(data){
              $('#insurance_email_edit').val(data[0]);
              $('#contact_number_edit').val(data[1]);
              
              
            }  
            });
                      
        });
        
 //Autofill Tower
 $('#towed_by').change(function() {
            var name=$("#towed_by_edit").val();
           
           $.ajax({
            type:'GET',
            url: '/tow-info',
            data: {'name':name},
            success:function(data){
              $('#tow_email_edit').val(data[0]);
              $('#tow_contact_number_edit').val(data[1]);
              
              
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

//Disable/Enable Insurance Edit
$('#insurance_type_edit').change(function(){
  var type_in=$('#insurance_type_edit').val();
  if(type_in=='1'){
    $('#insuror_edit').attr('disabled',true);
    $('#contact_number_edit').attr('disabled',true);
    $('#insurance_email_edit').attr('disabled',true);
    $('#claim_number_edit').attr('disabled',true);
    $('#clerk_ref_edit').attr('disabled',true);
    $('#assessor_edit').attr('disabled',true);
    $('#assessor_email_edit').attr('disabled',true);
    $('#assessor_no_edit').attr('disabled',true);
    $('#assessor_company_edit').attr('disabled',true);
  }else{
    $('#insuror_edit').attr('disabled',false);
    $('#contact_number_edit').attr('disabled',false);
    $('#insurance_email_edit').attr('disabled',false);
    $('#claim_number_edit').attr('disabled',false);
    $('#clerk_ref_edit').attr('disabled',false);
    $('#assessor_edit').attr('disabled',false);
    $('#assessor_email_edit').attr('disabled',false);
    $('#assessor_no_edit').attr('disabled',false);
    $('#assessor_company_edit').attr('disabled',false);
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

//Disable_Enable Towing Edit
$('#towed_edit').change(function(){
  var towed=$('#towed_edit').val();
  if(towed=='2'){
    $('#towed_by_edit').attr('disabled',true);
    $('#tow_contact_number_edit').attr('disabled',true);
    $('#tow_email_edit').attr('disabled',true);
    $('#tow_fee_edit').attr('disabled',true);
    $('#towed_status_edit').attr('disabled',true);
  }else{
    $('#towed_by_edit').attr('disabled',false);
    $('#tow_contact_number_edit').attr('disabled',false);
    $('#tow_email_edit').attr('disabled',false);
    $('#tow_fee_edit').attr('disabled',false);
    $('#towed_status_edit').attr('disabled',false);
  }
});
</script>
<script>
function openNav() {
  document.getElementById("mySidepanel").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidepanel").style.width = "0";
}
</script>
<script>
var photoMailQted;
function selectOrUnselectAllQted(id){      
      if($("#"+id).prop('checked') === true){
        $(".picCheckQted").trigger('click');
        $(".picCheckQted").prop("checked", true);
        
      }else{
        $(".picCheckQted").prop("checked", false);
        
        photoArr.length = 0;
      }
    }
    $(".picCheckQted").click(function(){
      if($(this).prop('checked') === true){
        photoArr.push($(this).attr('name').valueOf());
        $(this).prop("checked", true);
        
      }else{ 
        photoArr.splice(photoArr.indexOf($(this)), 1);
        if(photoArr.length==0){
          $("#selectAllChk").prop("checked", false);
          
        }
      }
    });
    
    function sendSelectedQtedPicsOnly(){
      photoMailQted = 0;
    }

    function sendSelectedQtedPicsandQt(){
      photoMailQted = 1;
    }
    function sendAllVehSelectedPhotosQted(){
      var emarr = $("#photo_email").val();
      var ref='MS1008686';
      var url;
      if(photoMailQted===0){
        url='/send-email-photo';
        }else if(photoMailQted===1){
        url='/send-email-photo';
      }
      $.ajax({
          url: url,
          type: 'POST',
          data: {
              emarr: emarr,
              photoArr: photoArr,
              ref: ref
          },
          success: function () {
            if(photoMailQted===1){
             $.get('../models/tcpdf/examples/sendphotoEmail.php');
            }
              $("#kept").fadeOut('slow');
              $("#kept").animate({top: '-1000px'});
              $("#emailPhotsDiv").animate({top: '-1000px'});
              $("#photsEmailAddress").tagsinput('removeAll');
              var msg = "<b>Successful...</b>";
              $.nok({
                  message: msg,
                  type: 'success',
                  stay: 3
              });
              $("#nok").css('margin-top', '80px');
              photoArr.splice(0, photoArr.length);
              $("#photsEmailAddressQted").tagsinput('removeAll');
              fetchQuotedPhotos();
          }
      });
    }


    //# [ ADD THE QOUTE NEW LINE ]
    $(document).on('click','.add_new_line_qoute',function(){

        var id = $(this).data('qoute_line_id');
        var Key_Ref = $(this).data('key_ref');

        $.ajax({
              type:'GET',
              url:'/qoutation-new-line',
              data:{
                id:id,Key_Ref:Key_Ref,
              },success: function(data) {

                  if( data == 1 ){
                    alert("Qoute Added Successfully");
                    location.reload(true);
                  }else{
                    alert("Failed To Add Qoute");
                  }

              }
        });
        
    });



</script>
  </body>
  </html>  