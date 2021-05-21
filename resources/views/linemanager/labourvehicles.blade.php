@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Labour Analysis</h4>

                <!-- ####### ADD NAVIGATION BUTTONS  [ 19 MAY 2021 ] -->
                <br>
                <a href="javascript:history.go(-1)" class="btn btn-danger btn-sm" title="Back To Precosting List">Back</a> 

                <form class="form-inline float-right" method="GET" action="/search-archive-labor">
                    <input type="text" id="labor_archieve_key" name="labor_archieve_key" class="form-control form-control-sm">
                    <input type="submit" class="btn btn-success btn-sm" style="margin-left:5px;"value="Search Archive">
                </form>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive table-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reference</th>
                                    <th>Registration</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Year</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @php $car_count=1;@endphp

                            <tbody>
                                  
                                  @foreach($car as $vehicle)            
                                  <tr>
                                    <td>{{$car_count}}</td>
                                    <td>{{$vehicle->Key_Ref}}</td>
                                    <td>{{$vehicle->Reg_No}}</td>
                                    <td>{{$vehicle->Make}}</td>
                                    <td>{{$vehicle->Model}}</td>
                                    <td>{{$vehicle->Vehicle_year}}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="/line-manager-analysis-view/{{$vehicle->Key_Ref}}" class="btn btn-primary btn-sm" title="View Worksheet"><span class="fa fa-search"></span></a> 
                                        </div>
                                    </td>
                                  </tr>               
                                 @php $car_count++;@endphp              
                                 @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
</div>
@endsection