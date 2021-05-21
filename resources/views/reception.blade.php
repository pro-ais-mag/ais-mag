<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="_token" content="{{csrf_token()}}"/>
  <title>A.I.S | Reception</title>

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
        <a class="nav-link" href="/quotations">
          <i class="fas fa-fw fa-home"></i>
          <span>Reception Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Reception
      </div>

     

      <!-- Nav Item -  Body Side Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Quotes</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Select Quote Type</h6>
            <a class="collapse-item" href="/allquotes">All</a>
            <a class="collapse-item" href="/authorized">Authorized</a>
            <a class="collapse-item" href="/quoted">Quoted</a>
            <a class="collapse-item" href="/unquoted">Unquoted</a>
            
          </div>
        </div>
      </li>

      
      <!-- Divider -->
      <hr class="sidebar-divider">
         <!-- Nav Item -  Body Side Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQuickPrint" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-print"></i>
          <span>Prints</span>
        </a>
        <div id="collapseQuickPrint" class="collapse" aria-labelledby="headingQuickPrint" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Quick Print</h6>
            <a class="collapse-item" href="/printSalvage" target="_blank">Salvage List</a>
            <a class="collapse-item pre_bookings" href="#prebookings">Pre Booking</a>
               
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">

        <!-- Nav Item -  Body Side Menu -->
        <li class="nav-item">
        <a class="nav-link" href="/assessor" >
          <i class="fas fa-fw fa-user"></i>
          <span>Assessors</span>
        </a>
        
      </li>

      <hr class="sidebar-divider">

          <!-- Nav Item -  Body Side Menu -->
          <li class="nav-item">
          <a class="nav-link" href="/prebookings/{{$alert}}" >
            <i class="fas fa-fw fa-bell"></i>
            <span class="badge badge-danger badge-counter" style="margin-right:30px;">+{{$alert}}</span><span>Pre-Bookings Alert</span>
          </a>

          </li>

          <hr class="sidebar-divider">

<!-- Nav Item -  Body Side Menu -->
<li class="nav-item">
<a class="nav-link" href="/proforma-invoice" >
  <i class="fas fa-fw fa-file-invoice-dollar"></i>
    <span>Proforma Invoice</span>
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

  <!--Mini Bus-->
  <div class="modal fade" id="pre_bookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Print Pre-Booking</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
          <label for="from">From:</label>
            <input type="date" id="from" name="from">
          </div>
          <div class="form-group">
          <label for="to">To:</label>
            <input type="date" id="to" name="to"> 
          </div> 
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-success" href="#">Proceed</a>
        </div>
      </div>
    </div>
  </div>


<!--Pre Bookings-->

<div class="modal fade" id="prebookingsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title " id="exampleModalLabel" style="color:white;">Pre Bookings</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="GET" action="/printPreBooking">
        <div class="modal-body">
           <div class="form-group">
           <label for="from_date">From:</label> 
              <input type="date" id="from_date" name="from_date" class="form-control">
           </div>
           <div class="form-group">
           <label for="to_date">To:</label> 
              <input type="date" id="to_date" name="to_date" class="form-control">
           </div>   
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary" value="Print Bookings" target="_blank" >
        </div>
      </div>
    </div>
  </div>

  <!-- Pre Booking Notes-->
  <div class="modal fade" id="prebookingNotesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title " id="exampleModalLabel" style="color:white;">Pre Booking Notes</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="PUT" action="/client-prebooking-update">
        {{ csrf_field() }}
        <div class="modal-body">
            <input type="hidden" id="id_prebooking" name="id_prebooking">
           <div class="form-group">
           <label for="full_name">Full Name:</label> 
              <input type="text" id="full_name" name="full_name" class="form-control" readonly>
           </div>
           <div class="form-group">
           <label for="email">Email:</label> 
              <input type="text" id="email" name="email" class="form-control" readonly>
           </div>
           <div class="form-group">
           <label for="contatc">Contact Details:</label> 
              <input type="text" id="contact" name="contact" class="form-control" readonly>
           </div>
           <div class="form-group">
            <label for="notes">Notes:</label>
              <textarea id="notes" name="notes" rows="5" class="form-control"></textarea>
           </div>   
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary" value="Update Notes" data-dismiss="modal">
        </form>  
        </div>
      </div>
    </div>
  </div>
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

<!--Custom Javascripts-->
<script type="text/javascript">
      
      //light vehicle Select
        $(document).on('click', '.show-modal', function() {
           $('#quote_id').val($(this).data('id')); 
           $('#lightVehicleModal').modal('show');
        }); 

      //Truck Vehicle Select 
        $(document).on('click', '.truck-modal', function() {
           $('#truckquote_id').val($(this).data('id')); 
           $('#truckModal').modal('show');
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
        $('#notes').val($(this).data('notes'))
          $('#prebookingNotesModal').modal('show');
       });

       //Print Pre Booking
       $(document).on('click','.pre_bookings',function(){
        $('#prebookingsModal').modal('show');
       });

       //Bus Vehicle Select
       $(document).on('click', '.pre_booking', function() {
           $('#busquote_id').val($(this).data('id'));  
           $('pre_bookingModal').modal('show');
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

      $('.modal-footer').on('click','.editassessor',function(){
        $.ajax({
          type:'PUT',
          url :'/editAssessor',
          dataType:'json',
          data:{
            '_token':"{{ csrf_token() }}",
            'id':$('#assessor_id').val(),
            'name':$('#assessor_fullname').val(),
            'company':$('#assessor_company').val(),
            'tel':$('#assessor_tell').val(),
            'cell':$('#assessor_cell').val(),
            'email':$('#assessor_email').val(),
          },
        });
      });    

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

      $('.modal-footer').on('click','.createassessor',function(){
        $.ajax({
          type:'POST',
          url :'/createAssessor',
          dataType:'json',
          data:{
            '_token':"{{ csrf_token() }}",
            'name':$('#assessor_create_fullname').val(),
            'company':$('#assessor_create_company').val(),
            'tel':$('#assessor_create_tell').val(),
            'cell':$('#assessor_create_cell').val(),
            'email':$('#assessor_create_email').val(),  
          },
        });
      });



  </script>
  <script type="text/javascript">
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Quotations Stats
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Towed", "Unauthorised", "Authorised"],
    datasets: [{
      data: [@php echo $towed_totals;@endphp,@php echo $unauth_total;@endphp ,@php echo $auth_total;@endphp ],
      backgroundColor: ['#d9534f', '#f0ad4e', '#5cb85c'],
      hoverBackgroundColor: ['#c9302c', '#ec971f', '#449d44'],
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
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Area Chart Example
var densityCanvas = document.getElementById("myAreaChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 10;

var densityData = {
  label: '2018',
  data: [@php echo $jan_2018;@endphp,@php echo $feb_2018;@endphp,@php echo $mar_2018;@endphp,@php echo $apr_2018;@endphp,@php echo $may_2018;@endphp,@php echo $jun_2018;@endphp,@php echo $jul_2018;@endphp,@php echo $aus_2018;@endphp,@php echo $sep_2018;@endphp,@php echo $oct_2018;@endphp,@php echo $nov_2018;@endphp,@php echo $dec_2018;@endphp],
  backgroundColor: 'rgba(0, 99, 132, 0.6)',
  borderWidth: 0,
  yAxisID: "y-axis-density"
};

var gravityData = {
  label: '2019',
  data: [@php echo $jan_2019;@endphp,@php echo $feb_2019;@endphp,@php echo $mar_2019;@endphp,@php echo $apr_2019;@endphp,@php echo $may_2019;@endphp,@php echo $jun_2019;@endphp,@php echo $jul_2019;@endphp,@php echo $aus_2019;@endphp,@php echo $sep_2019;@endphp,@php echo $oct_2019;@endphp,@php echo $nov_2019;@endphp,@php echo $dec_2019;@endphp],
  backgroundColor: 'rgba(99, 132, 0, 0.6)',
  borderWidth:0,
  padding:{
    right:50
  },
  yAxisID: "y-axis-gravity"
};
var thisData = {
  label: '2020',
  data: [@php echo $jan;@endphp,@php echo $feb;@endphp,@php echo $mar;@endphp,@php echo $apr;@endphp,@php echo $may;@endphp,@php echo $jun;@endphp,@php echo $jul;@endphp,@php echo $aus;@endphp,@php echo $sep;@endphp,@php echo $oct;@endphp,@php echo $nov;@endphp,@php echo $dec;@endphp],
  backgroundColor: '#ed1313',
  borderWidth: 0,
  padding:{
    right:50
    },
  yAxisID: "y-axis-air"
};

var planetData = {
  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug","Sep","Oct","Nov","Dec"],
  datasets: [densityData, gravityData,thisData]
};

var chartOptions = {
  scales: {
    xAxes: [{
      barPercentage: 2,
      categoryPercentage:0.8
    }],
    yAxes: [{
      id: "y-axis-density"
    }, {
      id: "y-axis-gravity"
    },{
      id: "y-axis-air"
    }]
  }
};

var barChart = new Chart(densityCanvas, {
  type: 'bar',
  data: planetData,
  options: chartOptions
});


</script>
</body>
</html>  