@extends('administrator')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Covid-19 Register.</h4>
                <a class="btn btn-success btn-sm float-right covid_user_register_all" data-id="" href="#" title="Print All Users"><span class="fa fa-print"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>From Name</th>
                                    <th>Email</th>
                                    <th>Comp Code</th>
                                    <th>Cell</th>
                                    <th>Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count=1;@endphp
                               
                              @foreach($users as $user)
                                <tr>
                                
                                    
                                    <td>{{$user->use_username}}</td>
                                    <td>{{$user->dept_name}}</td>
                                    <td>{{$user->user_fromname}}</td>
                                    <td>{{$user->user_email}}</td>
                                    <td>{{$user->comp_code}}</td>
                                    <td>{{$user->user_cell}}</td>
                                    <td>{{$user->ut_name}}</td>
                                    <td align="center">
                                    <div class="btn-group">
                                        <a href="/user-delete/{{$user->use_key}}" class="btn btn-danger btn-sm" title="Remove User"><span class="fa fa-trash" title="Remove Item"></span></a>
                                        <a href="#" class="btn btn-primary btn-sm covid_user_register" style="margin-left:5px;" data-id="{{$user->use_key}}" data-name="{{$user->use_username}}" data-dept="{{$user->ut_name}}" data-cell="{{$user->user_cell}}" data-from="{{$user->user_fromname}}" data-pin="{{md5($user->use_password)}}" title="Print Report"><span class="fa fa-print"></span></a> 
                                    </div>
                                    </td>                                
                                </tr>
                                @endforeach
                                @php $count++;@endphp
                                
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
</div>


<!-- Covid 19 Register -->
<!--Edit AIS Modal-->
<div class="modal fade" id="covid_user_register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="font-size:10px;">
        <div class="modal-header bg-primary">
          <h6 class="modal-title " id="exampleModalLabel" style="color:white;">Covid-19 User</h6>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="GET" action="/print-covid-report" target="_blank">
        
        <div class="modal-body">
            <input type="hidden" id="covid_id" name="covid_id">
            <div class="row" style="margin-bottom:10px;">
                
                <div class="col-12">
                <label>Name:</label>
                    <input type="text" id="covid_name" name="covid_name" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                <label>From:</label>
                    <input type="date" name="covid_from" id="covid_from" class="form-control form-control-sm">
                </div>
                <div class="col-6">
                <label>To:</label>
                    <input type="date" name="covid_to" id="covid_to" class="form-control form-control-sm">
                </div>
            </div>              
           
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary btn-sm" value="*Print Report">
          </form>
        </div>
      </div>
    </div>
  </div>
<!--End Of Personal Register -->
<!-- All Users Register -->
<div class="modal fade" id="covid_user_register_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="font-size:10px;">
        <div class="modal-header bg-success">
          <h6 class="modal-title " id="exampleModalLabel" style="color:white;">Covid-19 All Users</h6>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="GET" action="/print-covid-report-all-users" target="_blank">
        
        <div class="modal-body">
            
            <div class="row">
                <div class="col-6">
                <label>From:</label>
                    <input type="date" name="covid_from_all" id="covid_from_all" class="form-control form-control-sm">
                </div>
                <div class="col-6">
                <label>To:</label>
                    <input type="date" name="covid_to_all" id="covid_to_all" class="form-control form-control-sm">
                </div>
            </div>              
           
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="*Print Report">
          </form>
        </div>
      </div>
    </div>
  </div>


<!--End All Users Register -->

@endsection