@extends('customercare')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Car Release Feedback Dashboard</h1>
  
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Feedback.</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="#tickets" class="h5 mb-0 font-weight-bold text-gray-800">{{$total}}</a></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Happy.</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="#resolved" class="h5 mb-0 font-weight-bold text-gray-800">{{$happy}}</a></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-thumbs-up fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Unavaible.</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a href="#impress" class="h5 mb-0 font-weight-bold text-gray-800">{{$unavailable}}</a></div>
              </div>
              <div class="col">
                <div class="progress progress-sm mr-2">
                  <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-phone-slash fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

   <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Workmanship.</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="#overdue" class="h5 mb-0 font-weight-bold text-gray-800">{{$workman}}</a></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-tools fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          


  <!--End Row-->
</div>

<div class="row">
 <!-- Pending Requests Card Example -->
 <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Communication.</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="#overdue" class="h5 mb-0 font-weight-bold text-gray-800">{{$comm}}</a></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comment-dots fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

 <!-- Pending Requests Card Example -->
 <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Other.</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="#overdue" class="h5 mb-0 font-weight-bold text-gray-800">{{$other}}</a></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-question-circle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>            
</div>

<!--Pie Chart-->
<div class="row">
<div class="col-xl-8 col-lg-8">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Feedbcack Stats.</h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <div class="dropdown-header">Dropdown Header:</div>
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
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


@endsection