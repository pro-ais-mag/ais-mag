@extends('administrator')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Availiable Users</h4>
                <a class="btn btn-success btn-sm float-right create-modal-ais" data-id="" href="#" title="Create User"><span class="fa fa-plus"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive table-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    
                                    <th>User Name</th>
                                    <th>Company Code</th>
                                    <th>System Level</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count=1;@endphp
                               
                              @foreach($users as $user)
                                <tr>
                                
                                    
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->comp_code}}</td>
                                    <td>{{$user->position}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
                                    
                                    <td align="center">
                                    <div class="btn-group">
                                        <a href="/ais-delete/{{$user->id}}" class="btn btn-danger btn-sm" title="Remove User"><span class="fa fa-trash" title="Remove Item"></span></a>
                                        <a href="#editUser" class="btn btn-primary btn-sm edit-modal-ais" style="margin-left:5px;" data-id="{{$user->id}}" data-name="{{$user->username}}" data-password="{{$user->password}}" data-email="{{$user->email}}" data-dept="{{$user->position}}"  data-sign="{{$user->sign}}" data-authorize="{{$user->authorize}}" data-quote="{{$user->quote}}" data-consumables="{{$user->consumerable}}" data-customer="{{$user->customer_care}}" data-creditor="{{$user->creditors}}" data-line="{{$user->line_manager}}" data-costing="{{$user->costing}}" data-final_stage="{{$user->final_stage}}" data-code="{{$user->comp_code}}" data-close="{{$user->close}}" title="Edit User"><span class="fa fa-search"></span></a> 
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

<!--Add AIS User-->
<div class="modal fade" id="create_ais_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="font-size:10px;">
        <div class="modal-header bg-success">
          <h5 class="modal-title " id="exampleModalLabel" style="color:white;">Create AIS User</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="POST" action="/ais-create">
        {{ csrf_field() }}
        <div class="modal-body">
            <div class="row">
              <div class="form-group col-6">
              <label for="ais_username">Username:</label> 
                  <input type="text" id="ais_username" name="ais_username" class="form-control form-control-sm" required>
              </div>

              <div class="form-group col-6">
              <label for="ais_email">Email:</label> 
                  <input type="email" id="ais_email" name="ais_email" class="form-control form-control-sm" required>
              </div>
           </div>
           <div class="row">
              <div class="form-group col-6">
                <label for="ais_password">Password</label>
                    <input type="text" id="ais_password" name="ais_password" class="form-control form-control-sm" required>
              </div> 
              
              <div class="form-group col-6">
                <label for="ais_depart">Department:</label>
                    <select id="ais_depart" name="ais_depart" class="form-control form-control-sm" required>
                    
                    <option value="Consumerables">Consumerables</option>
                                        <option Value="Line Manager">Line Manager</option>
                                        <option value="Reception">Reception</option>
                                        <option value="Estimator">Estimator</option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Stores">Stores</option>
                                        <option value="Buyer">Buyer</option>
                                        <option value="Assessors">Assessors</option>
                                        

                    </select>
              </div>
           </div>
           <div class="row">
              <div class="form-group col-6">
                <label for="ais_comp_code">Company Code:</label>
                    <select id="ais_comp_code" name="ais_comp_code" class="form-control form-control-sm" required>
                    <option value="">Select Branch</option>
                    @foreach($branches as $branch)
                      <option value="{{$branch->branch_code}}">{{$branch->branch_name}}</option>
                    @endforeach
                    </select>
              </div>
              <div class="form-group col-6">
                
                <label for="ais_quote">Quote Dash?</label>
                    <select id="ais_quote" name="ais_quote" class="form-control form-control-sm">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                    </select>
                    
              </div> 
           </div>
           <div class="row">
              <div class="form-group col-6">
                <label for="ais_consumer">Consumables Dash?</label>
                    <select id="ais_consumer" name="ais_consumer" class="form-control form-control-sm" >
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                    </select>
              </div> 
              <div class="form-group col-6">
                <label for="ais_customer">Customer Dash?</label>
                    <select id="ais_customer" name="ais_customer" class="form-control form-control-sm">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                    </select>
              </div> 
           </div>
           <div class="row">
              <div class="form-group col-6">
                <label for="ais_line">Line Manager Dash?</label>
                    <select id="ais_line" name="ais_line" class="form-control form-control-sm">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                    </select>
              </div> 
              <div class="form-group col-6">
                <label for="ais_creditor">Creditors Dash?</label>
                    <select id="ais_creditor" name="ais_creditor" class="form-control form-control-sm">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                    </select>
              </div>
           </div>
           <div class="row">
            <div class="form-group col-6">
              <label for="ais_costing">Costing Dash?</label>
                  <select id="ais_costing" name="ais_costing" class="form-control form-control-sm">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div>
            <div class="form-group col-6">
              <label for="ais_costing">Final Costing Dash?</label>
                  <select id="ais_final" name="ais_final" class="form-control form-control-sm">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div>
           </div>
           <div class="row">
            <div class="form-group col-6">
              <label for="ais_final">Sign Final Costing?</label>
                  <select id="ais_sign" name="ais_sign" class="form-control form-control-sm">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div>
            <div class="form-group col-6">
              <label for="ais_auth">Authorize Car Repair?</label>
                  <select id="ais_auth" name="ais_auth" class="form-control form-control-sm">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div>
           </div>
           <div class="row">
              <div class="form-group col-6">
                <label for="ais_close">Close Record?</label>
                  <select id="ais_close" name="ais_close" class="form-control form-control-sm">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
              </div>
           </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="Save User" target="_blank">
        </div>
        </form>
      </div>
    </div>
  </div>

<!--Edit AIS Modal-->
  <div class="modal fade" id="edit_modal_ais" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="font-size:10px;">
        <div class="modal-header bg-primary">
          <h6 class="modal-title " id="exampleModalLabel" style="color:white;">Edit AIS User</h6>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="GET" action="/ais-edit">
        
        <div class="modal-body">
            <input type="hidden" id="ais_id" name="ais_id">
            <div class="row">
              <div class="form-group col-6">
              <label for="ais_username_edit">Username:</label> 
                  <input type="text" id="ais_username_edit" name="ais_username_edit" class="form-control form-control-sm" required>
              </div>

              <div class="form-group col-6">
              <label for="ais_email_edit">Email:</label> 
                  <input type="text" id="ais_email_edit" name="ais_email_edit" class="form-control form-control-sm" required>
              </div>
            </div>
           <div class="row">   
              <div class="form-group col-6">
                <label for="ais_password_edit">Password</label>
                    <input type="text" id="ais_password_edit" name="ais_password_edit" class="form-control form-control-sm" required>
              </div> 
              <div class="form-group col-6">
                <label for="ais_depart_edit">Department:</label>
                    <select id="ais_depart_edit" name="ais_depart_edit" class="form-control form-control-sm" required>
                        <option value=""></option>
                        <option value="Consumerables">Consumerables</option>
                        <option Value="Line Manager">Line Manager</option>
                        <option value="Reception">Reception</option>
                        <option value="Estimator">Estimator</option>
                        <option value="Administrator">Administrator</option>
                        <option value="Stores">Stores</option>
                        <option value="Buyer">Buyer</option>
                    </select>
              </div>
            </div>
           <div class="row">   
            <div class="form-group col-6">
              <label for="ais_comp_code_edit">Company Code:</label>
                  <select id="ais_comp_code_edit" name="ais_comp_code_edit" class="form-control form-control-sm" required>
                      @foreach($branches as $branch)
                        <option value="{{$branch->branch_code}}">{{$branch->branch_name}}</option>
                      @endforeach
                  </select>
            </div>
            <div class="form-group col-6">
              
              <label for="ais_quote_edit">Quote Dash?</label>
                  <select id="ais_quote_edit" name="ais_quote_edit" class="form-control form-control-sm" required>
                  <option value=""></option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
                  
            </div>
          </div>
          <div class="row">   
           <div class="form-group col-6">
            <label for="ais_consumer_edit">Consumables Dash?</label>
                <select id="ais_consumer_edit" name="ais_consumer_edit" class="form-control form-control-sm" required>
                <option value=""></option>
                <option value="1">Yes</option>
                <option value="0">No</option>
                </select>
           </div> 
           <div class="form-group col-6">
            <label for="ais_customer_edit">Customer Dash?</label>
                <select id="ais_customer_edit" name="ais_customer_edit" class="form-control form-control-sm" required>
                <option value=""></option>
                <option value="1">Yes</option>
                <option value="0">No</option>
                </select>
           </div> 
          </div>
          <div class="row"> 
            <div class="form-group col-6">
              <label for="ais_line_edit">Line Manager Dash?</label>
                  <select id="ais_line_edit" name="ais_line_edit" class="form-control form-control-sm" required>
                  <option value=""></option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div> 
            <div class="form-group col-6">
              <label for="ais_creditor_edit">Creditors Dash?</label>
                  <select id="ais_creditor_edit" name="ais_creditor_edit" class="form-control form-control-sm" required>
                  <option value=""></option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div>
          </div>
          <div class="row">  
           <div class="form-group col-6">
            <label for="ais_costing_edit">Costing Dash?</label>
                <select id="ais_costing_edit" name="ais_costing_edit" class="form-control form-control-sm" required>
                <option value=""></option>
                <option value="1">Yes</option>
                <option value="0">No</option>
                </select>
           </div>
           <div class="form-group col-6">
            <label for="ais_costing_edit"> Final Costing Dash?</label>
                <select id="ais_final_edit" name="ais_final_edit" class="form-control form-control-sm" required>
                <option value=""></option>
                <option value="1">Yes</option>
                <option value="0">No</option>
                </select>
           </div>
          </div>
          <div class="row"> 
            <div class="form-group col-6">
              <label for="ais_line_edit">Authorize Car Repair?</label>
                  <select id="ais_authorize_edit" name="ais_authorize_edit" class="form-control form-control-sm" required>
                  <option value=""></option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div> 
            <div class="form-group col-6">
              <label for="ais_creditor_edit">Sign Final Costing??</label>
                  <select id="ais_sign_edit" name="ais_sign_edit" class="form-control form-control-sm" required>
                  <option value=""></option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-6">
              <label for="ais_close_edit">Close Record?</label>
                <select id="ais_close_edit" name="ais_close_edit" class="form-control form-control-sm" required>
                  <option value=""></option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
            </div>
          </div> 
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary btn-sm" value="*Edit User">
          </form>
        </div>
      </div>
    </div>
  </div>

  
@endsection