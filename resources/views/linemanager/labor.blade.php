@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">GeneralWorksheet</h4>
                <a class="btn btn-secondary float-right" data-id="" href="#" title="Print Worksheet"><span class="fa fa-print"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive table-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Department</th>
                                    <th>Division</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @php $user_count=1;$user_dep_count=0;@endphp

                            <tbody>
                                @foreach($user as $employee)     
                                              
                                  <tr>
                                    <td>{{$user_count}}</td>
                                    <td>{{$employee->use_username}}</td>
                                    <td>{{$employee->dept_name}}</td>
                                    <td>{{$employee->user_fromname}}</td>
                                    <td>{{$employee->user_email}}</td>
                                    <td>{{$employee->user_cell}}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="#viewWorksheet" class="btn btn-primary btn-sm" title="View Worksheet"><span class="fa fa-search"></span></a> 
                                        </div>
                                    </td>
                                  </tr>               
                                @php $user_count++;$user_dep_count++;@endphp                  
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
</div>
@endsection