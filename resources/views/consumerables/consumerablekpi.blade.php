@extends('consumerables')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Consumerables Dashboard</h1>
  
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Products</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="#tickets" class="h5 mb-0 font-weight-bold text-gray-800">{{$count_products}}</a></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-list fa-2x text-gray-300"></i>
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
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Suppliers</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="#resolved" class="h5 mb-0 font-weight-bold text-gray-800">{{$count_supplier}}</a></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-address-book fa-2x text-gray-300"></i>
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
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Invoices</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a href="#impress" class="h5 mb-0 font-weight-bold text-gray-800">{{$count_invoice}}</a></div>
              </div>
              <div class="col">
                <div class="progress progress-sm mr-2">
                  <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>



</div>
<div class="row">
<div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Lowest 5 Products</h6>
                </div>
                <div class="card-body">
                 @foreach($lowest as $low) 
                 <h4 class="small font-weight-bold">{{$low->description}} <span class="float-right">{{number_format($low->quantity/$count_products * 100,2)}}%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                 @endforeach 
                </div>
              </div>
</div>
<div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Highest 5 Products</h6>
                </div>
                <div class="card-body">
                @foreach($highest as $high)
                <h4 class="small font-weight-bold">{{$high->description}}<span class="float-right">{{number_format($high->quantity/$count_products * 100,2)}}%</span></h4>
                  <div class="progress mb-4">
                       <div class="progress-bar bg-success" role="progressbar" style="width: {{$high->quantity/$count_products * 100}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                @endforeach  
                </div>
              </div>
</div>              
</div>

@endsection