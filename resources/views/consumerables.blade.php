<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="_token" content="{{csrf_token()}}"/>
  <title>A.I.S | Consumerables</title>

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
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">AIS<sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="/consumerables">
          <i class="fas fa-fw fa-home"></i>
          <span>Consumer Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Consumerables
      </div>

     

        
      

      <hr class="sidebar-divider">

        <!-- Nav Item -  Body Side Menu -->
        <li class="nav-item">
        <a class="nav-link" href="/consumerable-stock" >
          <i class="fas fa-fw fa-folder"></i>
          <span>Stock</span>
        </a>
        
      </li>

      
            <hr class="sidebar-divider">

    <!-- Nav Item -  Body Side Menu -->
    <li class="nav-item">
    <a class="nav-link" href="/comsumerable-order-stock" >
    <i class="fas fa-fw fa-list"></i>
        <span>Order Stock</span>
    </a>

    </li>    

        <hr class="sidebar-divider">

    <!-- Nav Item -  Body Side Menu -->
    <li class="nav-item">
      <a class="nav-link" href="#" >
      <i class="fas fa-fw fa-file-upload"></i>
          <span>Upload Invoice</span>
      </a>

    </li>
    <hr class="sidebar-divider">

<!-- Nav Item -  Body Side Menu -->
<li class="nav-item">
<a class="nav-link" href="/consumerable-supplier" >
<i class="fas fa-fw fa-dollar-sign"></i>
    <span>Supplier</span>
</a>

</li>
           <hr class="sidebar-divider">

    <!-- Nav Item -  Body Side Menu -->
  <!--  <li class="nav-item">
    <a class="nav-link" href="/consumerable-compare" >
    <i class="fas fa-fw fa-chart-bar"></i>
        <span>Price Comparison</span>
    </a>

    </li>-->

      <!-- Divider -->
      <!--<hr class="sidebar-divider">-->

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
          
          @yield('content')
            
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
          <a class="btn btn-primary" href="#">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!--Select Light Weight Model-->
  
    <div class="modal fade" id="lightVehicleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Select Light Vehicle Type</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form role="form" method="GET">
            <input type="hidden" name="quote_id" id="quote_id">
            <label for="car_type">Select Vehicle:</label>
            <select class="form-control" id="car_type" name="car_type">
              <option value="3Door">3 Door</option>
              <option value="Hatchback">Hatchback</option>
              <option value="SUV">SUV</option>
              <option value="Sedan">Sedan</option>
              <option value="Cabriolet">Cabriolet</option>
              <option value="DoubleCab">Double Cab</option>
              
            </select>
            </div>
        </form>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          
          <button class="btn btn-success car_select" id="car_submit" name="car_submit" data-dismiss="modal">Proceed</button>
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

  <!--Add Item Order Stock-->
  <div class="modal fade" id="addItemkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Add Item To Order</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="/consumerable-order-list-add">
          {{csrf_field()}}
            <input type="hidden" name="order_no" id="order_no">
             
          <div class="form-group">
          <label for="description_add">Description:</label>
            <input type="text" id="description_add" name="description_add" class="form-control">
          </div>
          <div class="form-group">
          <label for="quan_add">Quantity:</label>
            <input type="number" id="quan_add" name="quan_add" class="form-control"> 
          </div> 
          <div class="form-group">
          <label for="comment_add">Comment:</label>
            <input type="text" id="comment_add" name="comment_add" class="form-control"> 
          </div>
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success" value="+Add Item">
          </form>
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
          <a class="btn btn-success minus_stock_save" href="#">Proceed</a>
        </div>
      </div>
    </div>
  </div>


  
<!--<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>-->
  <script src="/vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--<script src="/vendor/jquery/jquery.min.js"></script>-->
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
  
  <!-- Custom scripts for all pages-->
  <script src="/js/sb-admin-2.min.js"></script>
  

    <!-- Page level plugins -->
    <script src="/vendor/chart.js/Chart.min.js"></script>
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/js/demo/datatables-demo.js"></script>
    <!--<script src="/js/demo/chart-pie-demo.js"></script>-->
    <!--<script src="/js/demo/chart-area-demo.js"></script>-->

<!--Custom Javascripts-->
<script type="text/javascript">
        //Add Item Order Stock
        $(document).on('click','.add_item_stock',function(){
          $('#order_no').val($(this).data('id'));
          $('#addItemkModal').modal('show');
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
          
      
  </script>
  

</body>
</html>  