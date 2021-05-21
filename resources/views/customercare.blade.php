<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="_token" content="{{csrf_token()}}"/>
  <title>A.I.S | Customer Care</title>

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
        <a class="nav-link" href="/customer-care">
          <i class="fas fa-fw fa-home"></i>
          <span>Customer Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Customer Care
      </div>

     

      <!-- Nav Item -  Body Side Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-user-plus"></i>
          <span>Client Details</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Select Feature</h6>
            <a class="collapse-item" href="/customer-care-release">View Customers</a>
            <a class="collapse-item" href="#">Edit Customers</a>
            
            
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
    <script src="/vendor/chart.js/Chart.min.js"></script>
    <!--Customer Javascript-->
    
    
<script type="text/javascript">
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Quotations Stats
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Happy", "Unavaible", "Workmanship","Communication","Other"],
    datasets: [{
      data: [@php echo $happy;@endphp ,@php echo $workman;@endphp,@php echo $workman;@endphp,@php echo $comm;@endphp,@php echo $other;@endphp],
      backgroundColor: ['#1cc88a', '#f0ad4e', '#36b9cc','#e74a3b','#858796'],
      hoverBackgroundColor: ['#17a673', '#ec971f', '#2c9faf','#e02d1b','#717384'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

</script>
<script type="text/javascript">
     //Add comments
     $(document).on('click','.add_comment',function(){
            $('#comment_track').val($(this).data('id'));
           $('#comment_name').val($(this).data('name')); 
           $('#commentModal').modal('show');     
        });
    </script>
  </body>
  </html>  