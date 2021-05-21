<?php $__env->startSection('content'); ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Administrator Dashboard.</h4>
            </div><br>
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

<!-- Estimator Performance-->
<div class="col-6 col-lg-6">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Conversion Rate (2020). - <?php echo e(number_format(array_sum($convert_auth)/array_sum($convert_quoted)*100,2)); ?>%</h6>
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
<!-- End Quotation -->
<br><br>
<!--Comsumerables-->
<div class="row">
 
</div>
<!--End Consumerables-->

<!-- Customer Care-->
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
<div class="col-xl-6 col-lg-12">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Branch Performance.</h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <div class="dropdown-header">Feature:</div>
          <a class="dropdown-item" href="#">Enlarge</a>
          
        </div>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-area">
        <canvas id="branch_performance" width="894px;"></canvas>
      </div>
    </div>
  </div>
</div>

<div class="col-xl-3 col-lg-12">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Consumables Stats</h6>
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
        <canvas id="myPieChart"></canvas>
      </div>
      <div class="mt-4 text-center small">
        <span class="mr-2">
          <i class="fas fa-circle text-success"></i> Workshop
        </span>
        <span class="mr-2">
          <i class="fas fa-circle text-warning"></i> Drivers
        </span>
        <span class="mr-2">
          <i class="fas fa-circle text-danger"></i> General 
        </span>
        
      </div>
    </div>
  </div>
</div>
</div>
<!-- End Customer Care-->

<!-- Labour Line Manager-->
<!--Graphs -->
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
<div class="col-4 col-lg-6">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Estimator Performance.</h6>
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
<!--End Labour Manager-->
</div> 

<?php $__env->stopSection(); ?>
<!--Testing-->
<?php $__env->startSection('java'); ?>    
<!--Customer KPI-->

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
      data: [<?php echo $happy;?> ,<?php echo $unavailable;?>,<?php echo $workman;?>,<?php echo $comm;?>,<?php echo $other;?>],
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
<!-- Line Manager Pie Chart-->
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
      data: [<?php echo $total_workshop;?> ,<?php echo $total_drivers;?>,<?php echo $total_admin;?>],
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

<!-- End Of Line Manager Pie chart-->
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
  data: [<?php echo $jan_2018;?>,<?php echo $feb_2018;?>,<?php echo $mar_2018;?>,<?php echo $apr_2018;?>,<?php echo $may_2018;?>,<?php echo $jun_2018;?>,<?php echo $jul_2018;?>,<?php echo $aus_2018;?>,<?php echo $sep_2018;?>,<?php echo $oct_2018;?>,<?php echo $nov_2018;?>,<?php echo $dec_2018;?>],
  backgroundColor: 'rgba(0, 99, 132, 0.6)',
  borderWidth: 0,
  yAxisID: "y-axis-density"
};

var gravityData = {
  label: '2019',
  data: [<?php echo $jan_2019;?>,<?php echo $feb_2019;?>,<?php echo $mar_2019;?>,<?php echo $apr_2019;?>,<?php echo $may_2019;?>,<?php echo $jun_2019;?>,<?php echo $jul_2019;?>,<?php echo $aus_2019;?>,<?php echo $sep_2019;?>,<?php echo $oct_2019;?>,<?php echo $nov_2019;?>,<?php echo $dec_2019;?>],
  backgroundColor: 'rgba(99, 132, 0, 0.6)',
  borderWidth:0,
  padding:{
    right:50
  },
  yAxisID: "y-axis-gravity"
};
var thisData = {
  label: '2020',
  data: [<?php echo $jan;?>,<?php echo $feb;?>,<?php echo $mar;?>,<?php echo $apr;?>,<?php echo $may;?>,<?php echo $jun;?>,<?php echo $jul;?>,<?php echo $aus;?>,<?php echo $sep;?>,<?php echo $oct;?>,<?php echo $nov;?>,<?php echo $dec;?>],
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

<!--Quotation Pie Chart-->
<script type="text/javascript">
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Quotations Stats
var ctx = document.getElementById("myPieChartQuotation");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Towed", "Unauthorised", "Authorised"],
    datasets: [{
      data: [<?php echo $towed_totals;?>,<?php echo $unauth_total;?> ,<?php echo $auth_total;?> ],
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
<!--End Pie Chart-->
<!--End Quotations-->

<!-- Line Manager Pie Chart-->
<script type="text/javascript">
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Quotations Stats
var ctx = document.getElementById("myPieChartLineManager");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Workshop", "Driver", "General"],
    datasets: [{
      data: [<?php echo $total_workshop;?> ,<?php echo $total_drivers;?>,<?php echo $total_admin;?>],
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
<!-- End Pie Chart-->

  
<!-- Estimator Performance Line Graph-->
<script type="text/javascript">
var ctx = document.getElementById('estimators');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
            label: ['Quotes Made'],
            data: [<?php echo implode(",",$convert_quoted);?>],
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
            data: [<?php echo implode(",",$convert_auth);?>],
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
var densityCanvas = document.getElementById("branch_performance");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 10;

var densityData = {
  label: 'Selby',
  data: [<?php echo implode(",",$selby_quote_count);?>],
  backgroundColor: 'rgba(107, 52, 235,0.5)',
  borderWidth: 0,
  yAxisID: "y-axis-density"
};

var gravityData = {
  label: 'The Glen',
  data: [<?php echo implode(",",$glen_quote_count);?>],
  backgroundColor: 'rgba(255, 182, 46,0.8)',
  borderWidth:0,
  padding:{
    right:50
  },
  yAxisID: "y-axis-gravity"
};
var thisData = {
  label: 'Longmeadow',
  data: [<?php echo implode(",",$longmeadow_quote_count);?>],
  backgroundColor: 'rgba(237, 19, 19,0.8)',
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
<!-- Estimator Performance-->
<script type="text/javascript">
var ctx = document.getElementById('estimator_performance');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
            label: ['Alfie'],
            data: [<?php echo e($alfie_jan); ?>,<?php echo e($alfie_feb); ?>,<?php echo e($alfie_mar); ?>,<?php echo e($alfie_apr); ?>,<?php echo e($alfie_may); ?>,<?php echo e($alfie_jun); ?>,<?php echo e($alfie_jul); ?>,<?php echo e($alfie_aus); ?>,<?php echo e($alfie_sep); ?>,<?php echo e($alfie_nov); ?>,<?php echo e($alfie_dec); ?>],
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
        },
        {
            label: ['Walter'],
            data: [<?php echo e($walter_jan); ?>,<?php echo e($walter_feb); ?>,<?php echo e($walter_mar); ?>,<?php echo e($walter_apr); ?>,<?php echo e($walter_may); ?>,<?php echo e($walter_jun); ?>,<?php echo e($walter_jul); ?>,<?php echo e($walter_aus); ?>,<?php echo e($walter_sep); ?>,<?php echo e($walter_oct); ?>,<?php echo e($walter_nov); ?>,<?php echo e($walter_dec); ?>],
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
        },
        {
            label: ['Zahid'],
            data: [<?php echo e($zahid_jan); ?>,<?php echo e($zahid_feb); ?>,<?php echo e($zahid_mar); ?>,<?php echo e($zahid_apr); ?>,<?php echo e($zahid_may); ?>,<?php echo e($zahid_jun); ?>,<?php echo e($zahid_jul); ?>,<?php echo e($zahid_aus); ?>,<?php echo e($zahid_sep); ?>,<?php echo e($zahid_oct); ?>,<?php echo e($zahid_nov); ?>,<?php echo e($zahid_dec); ?>],
            backgroundColor: [
                'rgba(168, 50, 66,0.5)',
                'rgba(168, 50, 66,0.5)',
                'rgba(168, 50, 66,0.5)',
                'rgba(168, 50, 66,0.5)',
                'rgba(168, 50, 66,0.5)',
                'rgba(168, 50, 66,0.5)'
            ],
            borderColor: [
                'rgba(168, 50, 66,0.5)',
                'rgba(168, 50, 66,0.5)',
                'rgba(168, 50, 66,0.5)',
                'rgba(168, 50, 66,0.5)',
                'rgba(168, 50, 66,0.5)',
                'rgba(168, 50, 66,0.5)'
            ],
            borderWidth: 1
        },
        {
            label: ['John'],
            data: [<?php echo e($john_jan); ?>,<?php echo e($john_feb); ?>,<?php echo e($john_mar); ?>,<?php echo e($john_apr); ?>,<?php echo e($john_may); ?>,<?php echo e($john_jun); ?>,<?php echo e($john_jul); ?>,<?php echo e($john_aus); ?>,<?php echo e($john_sep); ?>,<?php echo e($john_oct); ?>,<?php echo e($john_nov); ?>,<?php echo e($john_dec); ?>],
            backgroundColor: [
                'rgba(222, 129, 16,0.5)',
                'rgba(222, 129, 16,0.5)',
                'rgba(222, 129, 16,0.5)',
                'rgba(222, 129, 16,0.5)',
                'rgba(222, 129, 16,0.5)',
                'rgba(222, 129, 16,0.5)'
            ],
            borderColor: [
                'rgba(222, 129, 16,0.5)',
                'rgba(222, 129, 16,0.5)',
                'rgba(222, 129, 16,0.5)',
                'rgba(222, 129, 16,0.5)',
                'rgba(222, 129, 16,0.5)',
                'rgba(222, 129, 16,0.5)'
            ],
            borderWidth: 1
        },
        {
            label: ['Barney'],
            data: [<?php echo e($shane_jan); ?>,<?php echo e($shane_feb); ?>,<?php echo e($shane_mar); ?>,<?php echo e($shane_apr); ?>,<?php echo e($shane_may); ?>,<?php echo e($shane_jun); ?>,<?php echo e($shane_jul); ?>,<?php echo e($shane_aus); ?>,<?php echo e($shane_sep); ?>,<?php echo e($shane_oct); ?>,<?php echo e($shane_nov); ?>,<?php echo e($shane_dec); ?>],
            backgroundColor: [
                'rgba(33, 5, 245,0.5)',
                'rgba(33, 5, 245,0.5)',
                'rgba(33, 5, 245,0.5)',
                'rgba(33, 5, 245,0.5)',
                'rgba(33, 5, 245,0.5)',
                'rgba(33, 5, 245,0.5)'
            ],
            borderColor: [
                'rgba(33, 5, 245,0.5)',
                'rgba(33, 5, 245,0.5)',
                'rgba(33, 5, 245,0.5)',
                'rgba(33, 5, 245,0.5)',
                'rgba(33, 5, 245,0.5)',
                'rgba(33, 5, 245,0.5)'
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
  data: [<?php echo e($avg_jan); ?>,<?php echo e($avg_feb); ?>,<?php echo e($avg_mar); ?>,<?php echo e($avg_apr); ?>,<?php echo e($avg_may); ?>,<?php echo e($avg_jun); ?>,<?php echo e($avg_jul); ?>,<?php echo e($avg_aug); ?>,<?php echo e($avg_sep); ?>,<?php echo e($avg_oct); ?>,<?php echo e($avg_nov); ?>,<?php echo e($avg_dec); ?>],
  backgroundColor: 'rgba(1,42,246,0.7)',
  borderWidth: 0,
  yAxisID: "y-axis-density"
};

var gravityData = {
  label: 'Repair Time',
  data: [<?php echo e($avg_act_jan); ?>,<?php echo e($avg_act_feb); ?>,<?php echo e($avg_act_mar); ?>,<?php echo e($avg_act_apr); ?>,<?php echo e($avg_act_may); ?>,<?php echo e($avg_act_jun); ?>,<?php echo e($avg_act_jul); ?>,<?php echo e($avg_act_aug); ?>,<?php echo e($avg_act_sep); ?>,<?php echo e($avg_act_oct); ?>,<?php echo e($avg_act_nov); ?>,<?php echo e($avg_act_dec); ?>],
  backgroundColor: 'rgba(1,246,17,0.6)',
  borderWidth:0,
  padding:{
    right:50
  },
  yAxisID: "y-axis-gravity"
};
var thisData = {
  label: 'Delayed Time',
  data: [<?php echo implode(",",$longmeadow_quote_count);?>],
  backgroundColor: 'rgba(237, 19, 19,0.8)',
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>