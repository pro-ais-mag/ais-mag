<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="_token" content="{{csrf_token()}}"/>
  <title>A.I.S | Line Manger</title>

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
        <a class="nav-link" href="/line-manager">
          <i class="fas fa-fw fa-home"></i>
          <span>Line Mangager Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Line Manager
      </div>

     

        
      

      <hr class="sidebar-divider">

        <!-- Nav Item -  Body Side Menu -->
        <li class="nav-item">
        <a class="nav-link" href="/line-manager-timesheet" >
          <i class="fas fa-fw fa-business-time"></i>
          <span>General Work</span>
        </a>
        
      </li>

      
          <hr class="sidebar-divider">

<!-- Nav Item -  Body Side Menu -->
<li class="nav-item">
<a class="nav-link" href="/line-manager-analysis" >
  <i class="fas fa-fw fa-chart-bar"></i>
    <span>Labour Analysis</span>
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

 



 





  
  <!--<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>-->
  <!--<script src="/vendor/jquery/jquery-3.2.1.min.js"></script>-->
  <script src="/vendor/jquery/jquery.min.js"></script>
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
    <script src="/vendor/chart.js/Chart.min.js"></script>

    <script type="text/javascript">
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Quotations Stats
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Workshop", "Driver", "General"],
    datasets: [{
      data: [@php echo $total_workshop;@endphp ,@php echo $total_drivers;@endphp,@php echo $total_admin;@endphp],
      backgroundColor: ['#1cc88a', '#f0ad4e', '#e74a3b'],
      hoverBackgroundColor: ['#17a673', '#ec971f', '#e02d1b'],
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
<!--Custom Javascripts-->
<script type="text/javascript">

      //Workshop Modal
        $(document).on('click', '.workshop', function() {
           $('#workshop_id').val($(this).data('id')); 
           $('#WorkShopModal').modal('show');
       });
      
      //Genral Worker
      $(document).on('click', '.general', function() {
          $('#general_id').val($(this).data('id'));
           $('#GeneralModal').modal('show');
       });

      //Driver Modal
      $(document).on('click', '.driver', function() {
           $('#DriverModal').modal('show');
       });  

      //Print Modal
      $(document).on('click', '.print', function() {
           $('#PrintModal').modal('show');
       }); 
</script>
</body>
</html>  