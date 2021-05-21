@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Employees</h4>

                <!-- ## ADD THE BACK BUTTON [ 20 MAY 2021 ] -->
                <br>
                <a href="javascript:history.go(-1)" class="btn btn-danger btn-sm" title="Back To Precosting List">Back</a>

                <a class="btn btn-secondary float-right" data-id="" href="#" title="Print Worksheet"><span class="fa fa-print"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0" style="font-size:10px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Cell No.</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                             @php $count=1;@endphp   
                            <tbody>
                                @foreach($employees as $emp)        
                                  <tr>
                                  <td>{{$count}}</td>         
                                  <td>{{$emp->use_username}}</td>
                                  <td>{{$emp->user_email}}</td>
                                  <td>{{$emp->user_cell}}</td>
                                  <td><a href="#" class="btn btn-primary btn-sm print_sheet" data-id="{{$emp->use_username}}" title="View Timesheet"><span class="fa fa-search"></span></a></td>
                                </tr>
                                @php $count++;@endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
</div>


@endsection