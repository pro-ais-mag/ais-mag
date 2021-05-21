@extends('alluser')
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">{{$user}}'s - Dashboard.</h4>
            </div><br>
<!-- Pre Costing Stats-->
@php if($costing==1){
echo '
<div class="row">
    <div class="col-4 col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Returned Parts.</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Quotations:</div>
                <a class="dropdown-item" href="#">Enlarge</a>
                
                
                </div>
            </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
            <div class="chart-area">
                <canvas id="credit_notes" width="894px;"></canvas>
            </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-6">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Parts Stats Review</h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <div class="dropdown-header">Quotations:</div>
          <a class="dropdown-item" href="#">Enlarge</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-area">
        <canvas id="myAreaChart_parts" width="894px;"></canvas>
      </div>
    </div>
  </div>
</div>
</div>
    
</div>    
     
</div>
<!-- Personal Stats Estimator Performance-->
<div class="row">
<div class="col-4 col-lg-6">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">My Performance.- Pre-Costing</h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <div class="dropdown-header">Quotations:</div>
          <a class="dropdown-item" href="#">Enlarge</a>
          
          
        </div>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-area">
        <canvas id="buyer_performance" width="894px;"></canvas>
      </div>
    </div>
  </div>
</div>
</div>
';
}
@endphp
<!-- End Of Pre Costing Stats -->

 @php if($position=="Reception"){
    echo '
<!-- Personal Stats Estimator Performance -->
<div class="row">
<div class="col-4 col-lg-6">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Job Cards Created.</h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <div class="dropdown-header">Quotations:</div>
          <a class="dropdown-item" href="#">Enlarge</a>
          
          
        </div>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-area">
        <canvas id="myAreaChart_job_card" width="894px;"></canvas>
      </div>
    </div>
  </div>
</div>
<!-- Estimator Performance Conversion Rate-->
<div class="col-6 col-lg-6">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Pre - Booking SMS (Sent).</h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <div class="dropdown-header">Quotations:</div>
          <a class="dropdown-item" href="#">Enlarge</a>
          
          
        </div>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-area">
        <canvas id="wip_sms_stats" width="894px;"></canvas>
      </div>
    </div>
  </div>
</div>

</div>
<div class="row">
<div class="col-xl-3 col-lg-6">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Customer Satisfaction.</h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <div class="dropdown-header">Features:</div>
          <a class="dropdown-item" href="#">Enlarge</a>
          
        </div>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-pie pt-4 pb-2">
        <canvas id="myPieChartCustomerCare"></canvas>
      </div>
      <div class="mt-4 text-center small">
        <span class="mr-2">
          <i class="fas fa-circle text-success"></i> Happy
        </span>
        <span class="mr-2">
          <i class="fas fa-circle text-warning"></i> Unavaible
        </span>
        <span class="mr-2">
          <i class="fas fa-circle text-info"></i> Workmanship
        </span>
        <span class="mr-2">
          <i class="fas fa-circle text-danger"></i> Communication
        </span>
        <span class="mr-2">
          <i class="fas fa-circle text-secondary"></i> Other
        </span>
      </div>
    </div>
  </div>
</div>
</div>
';

 }   
 @endphp        
 @php if($position=='Estimator' || $quote==1){
     echo'            
<!--Quotation-->
<!--Graphs -->
<div class="row">

<!-- Quotation Overview -->
<div class="col-6 col-lg-6">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Quotation Amount Overviews</h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <div class="dropdown-header">Quotations:</div>
          <a class="dropdown-item" href="#">Enlarge</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-area">
        <canvas id="myAreaChart" width="894px;"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Estimator Performance Conversion Rate-->
<div class="col-6 col-lg-6">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Conversion Rate (2020).</h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <div class="dropdown-header">Quotations:</div>
          <a class="dropdown-item" href="#">Enlarge</a>
          
          
        </div>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-area">
        <canvas id="estimators" width="894px;"></canvas>
      </div>
    </div>
  </div>
</div>

</div>


<!-- Personal Stats Estimator Performance-->
<div class="row">
<div class="col-4 col-lg-6">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">My Performance. - Quotations</h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <div class="dropdown-header">Quotations:</div>
          <a class="dropdown-item" href="#">Enlarge</a>
          
          
        </div>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-area">
        <canvas id="estimator_performance" width="894px;"></canvas>
      </div>
    </div>
  </div>
</div>
</div>
';
 }@endphp
<!-- End Quotation -->
<!-- Line Manager Stats -->
@php if($position=='Line Manager' || $line==1){
echo'            
    <div class="row">
    <div class="col-4 col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Repair Performance.</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Quotations:</div>
                <a class="dropdown-item" href="#">Enlarge</a>
                
                
                </div>
            </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
            <div class="chart-area">
                <canvas id="repair_duration" width="894px;"></canvas>
            </div>
            </div>
        </div>
        </div>
    </div> 
    </div>
';
}
@endphp
<!--End Of Line Manager Stats-->


@endsection

@section('javas')
<!--Quotations-->
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

// Area Chart Quotation
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

<!-- Estimator Performance Line Graph Conversion rate-->
<script type="text/javascript">
var ctx = document.getElementById('estimators');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
            label: ['Quotes Made'],
            data: [@php echo implode(",",$convert_quoted);@endphp],
            backgroundColor: [
                'rgba(0,0,255,0.4)',
                'rgba(0,0,255,0.4)',
                'rgba(0,0,255,0.4)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        },
        {
            label: ['Authorised'],
            data: [@php echo implode(",",$convert_auth);@endphp],
            backgroundColor: [
                'rgba(34,187,51,0.5)',
                'rgba(4, 71, 204,0.5)',
                'rgba(4, 71, 204,0.5)',
                'rgba(4, 71, 204,0.5)',
                'rgba(4, 71, 204,0.5)',
                'rgba(4, 71, 204,0.5)'
            ],
            borderColor: [
                'rgba(34,187,51,0.5)',
                'rgba(34,187,51,0.5)',
                'rgba(34,187,51,0.5)',
                'rgba(34,187,51,0.5)',
                'rgba(34,187,51,0.5)',
                'rgba(34,187,51,0.5)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
<script>
var ctx = document.getElementById('estimator_performance');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
            label: [ '{{$user}}' ],
            data: [{{$esti_jan}},{{$esti_feb}},{{$esti_mar}},{{$esti_apr}},{{$esti_may}},{{$esti_jun}},{{$esti_jul}},{{$esti_aus}},{{$esti_sep}},{{$esti_nov}},{{$esti_dec}}],
            backgroundColor: [
                'rgba(227, 247, 5,0.5)',
                'rgba(227, 247, 5,0.5)',
                'rgba(227, 247, 5,0.5)',
                'rgba(227, 247, 5,0.5)',
                'rgba(227, 247, 5,0.5)',
                'rgba(227, 247, 5,0.5)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
<!--Personally Created Job Cards-->
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

// Area Chart Quotation
var densityCanvas = document.getElementById("myAreaChart_job_card");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 10;

var densityData = {
  label:'{{$user}}',
  data: [@php echo $reception_jan;@endphp,@php echo $reception_feb;@endphp,@php echo $reception_mar;@endphp,@php echo $reception_apr;@endphp,@php echo $reception_may;@endphp,@php echo $reception_jun;@endphp,@php echo $reception_jul;@endphp,@php echo $reception_aus;@endphp,@php echo $reception_sep;@endphp,@php echo $reception_oct;@endphp,@php echo $reception_nov;@endphp,@php echo $reception_dec;@endphp],
  backgroundColor: 'rgba(0, 99, 132, 0.6)',
  borderWidth: 0,
  yAxisID: "y-axis-density"
};

var planetData = {
  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug","Sep","Oct","Nov","Dec"],
  datasets: [densityData]
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
<!-- WIP Reception SMS Stats -->
<!-- Estimator Performance Line Graph-->
<script type="text/javascript">
var ctx = document.getElementById('wip_sms_stats');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [
        {
            label: ['Client Communction'],
            data: [@php echo implode(",",$convert_auth);@endphp],
            backgroundColor: [
                'rgba(34,187,51,0.5)',
                'rgba(4, 71, 204,0.5)',
                'rgba(4, 71, 204,0.5)',
                'rgba(4, 71, 204,0.5)',
                'rgba(4, 71, 204,0.5)',
                'rgba(4, 71, 204,0.5)'
            ],
            borderColor: [
                'rgba(34,187,51,0.5)',
                'rgba(34,187,51,0.5)',
                'rgba(34,187,51,0.5)',
                'rgba(34,187,51,0.5)',
                'rgba(34,187,51,0.5)',
                'rgba(34,187,51,0.5)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>


<script type="text/javascript">
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Quotations Stats
var ctx = document.getElementById("myPieChartCustomerCare");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Happy", "Unavaible", "Workmanship","Communication","Other"],
    datasets: [{
      data: [@php echo $total_happy;@endphp ,@php echo $total_unavailable;@endphp,@php echo $total_workman;@endphp,@php echo $total_comm;@endphp,@php echo $total_other;@endphp],
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

<!--Branch Performance-->
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

// Area Chart Quotation
var densityCanvas = document.getElementById("repair_duration");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 10;

var densityData = {
  label: 'Estimated Repair Time',
  data: [{{$avg_jan}},{{$avg_feb}},{{$avg_mar}},{{$avg_apr}},{{$avg_may}},{{$avg_jun}},{{$avg_jul}},{{$avg_aug}},{{$avg_sep}},{{$avg_oct}},{{$avg_nov}},{{$avg_dec}}],
  backgroundColor: 'rgba(1,42,246,0.7)',
  borderWidth: 0,
  yAxisID: "y-axis-density"
};

var gravityData = {
  label: 'Repair Time',
  data: [{{$avg_act_jan}},{{$avg_act_feb}},{{$avg_act_mar}},{{$avg_act_apr}},{{$avg_act_may}},{{$avg_act_jun}},{{$avg_act_jul}},{{$avg_act_aug}},{{$avg_act_sep}},{{$avg_act_oct}},{{$avg_act_nov}},{{$avg_act_dec}}],
  backgroundColor: 'rgba(1,246,17,0.6)',
  borderWidth:0,
  padding:{
    right:50
  },
  yAxisID: "y-axis-gravity"
};


var planetData = {
  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug","Sep","Oct","Nov","Dec"],
  datasets: [densityData, gravityData]
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

<script type="text/javascript">
var ctx = document.getElementById('credit_notes');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [
        {
            label: ['Returned Parts'],
            data: [{{$credit_notes_jan}},{{$credit_notes_feb}},{{$credit_notes_mar}},{{$credit_notes_apr}},{{$credit_notes_may}},{{$credit_notes_jun}},{{$credit_notes_jul}},{{$credit_notes_aug}},{{$credit_notes_sep}},{{$credit_notes_oct}},{{$credit_notes_nov}},{{$credit_notes_dec}}],
            backgroundColor: [
                'rgba(78,187,51,0.5)',
                'rgba(9, 71, 204,0.5)',
                'rgba(4, 71, 204,0.5)',
                'rgba(9, 71, 204,0.5)',
                'rgba(4, 71, 204,0.5)',
                'rgba(4, 71, 204,0.5)'
            ],
            borderColor: [
                'rgba(34,187,51,0.5)',
                'rgba(34,187,51,0.5)',
                'rgba(34,187,51,0.5)',
                'rgba(34,187,51,0.5)',
                'rgba(34,187,51,0.5)',
                'rgba(34,187,51,0.5)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
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

// Area Chart Quotation
var densityCanvas = document.getElementById("myAreaChart_parts");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 10;

var densityData = {
  label: 'Ordered Parts',
  data: [{{$orders_jan}},{{$orders_feb}},{{$orders_mar}},{{$orders_apr}},{{$orders_may}},{{$orders_jun}},{{$orders_jul}},{{$orders_aug}},{{$orders_sep}},{{$orders_oct}},{{$orders_nov}},{{$orders_dec}}],
  backgroundColor: 'rgba(69, 72, 188,0.5)',
  borderWidth: 0,
  yAxisID: "y-axis-density"
};


var thisData = {
  label: 'Confirmed Orders',
  data: [{{$confirmed_jan}},{{$confirmed_feb}},{{$confirmed_mar}},{{$confirmed_apr}},{{$confirmed_may}},{{$confirmed_jun}},{{$confirmed_jul}},{{$confirmed_aug}},{{$confirmed_sep}},{{$confirmed_oct}},{{$confirmed_nov}},{{$confirmed_dec}}],
  backgroundColor: 'rgba(226, 162, 39,0.8)',
  borderWidth: 0,
  padding:{
    right:50
    },
  yAxisID: "y-axis-air"
};

var planetData = {
  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug","Sep","Oct","Nov","Dec"],
  datasets: [densityData, thisData]
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

<script>
var ctx = document.getElementById('buyer_performance');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
            label: [ '{{$user}}' ],
            data: [{{$buyer_jan}},{{$buyer_feb}},{{$buyer_mar}},{{$buyer_apr}},{{$buyer_may}},{{$buyer_jun}},{{$buyer_jul}},{{$buyer_aug}},{{$buyer_sep}},{{$buyer_oct}},{{$buyer_nov}},{{$buyer_dec}}],
            backgroundColor: [
                'rgba(227, 247, 5,0.5)',
                'rgba(227, 247, 5,0.5)',
                'rgba(227, 247, 5,0.5)',
                'rgba(227, 247, 5,0.5)',
                'rgba(227, 247, 5,0.5)',
                'rgba(227, 247, 5,0.5)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
@endsection


