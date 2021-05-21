@extends('administrator')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Billing Feature.</h4>
                <a class="btn btn-success btn-sm float-right create_branch" data-id="" href="#" title="Add Branch"><span class="fa fa-plus"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    
                                    <th>No.</th>
                                    <th>Branch</th>
                                    <th>Credits</th>
                                    <th>Auth/Account</th>
                                    <th>Status</th>
                                    <th>Date Modified</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count=1;@endphp
                               
                              @foreach($billing as $bill)
                                <tr>
                                
                                    <td>{{$count}}</td>
                                    <td><b>{{$bill->branch_name}}</b></td>
                                    @if($bill->branch_credits< 30)
                                    <td style="background-color:#e74a3b;color:white;text-align:center;">{{$bill->branch_credits}}</td>
                                    @else
                                    <td style="background-color:#1cc88a;color:white;text-align:center;">{{$bill->branch_credits}}</td>
                                    @endif
                                    @if($bill->status==0 || $bill->status==0)
                                    <td><a class="btn btn-warning btn-sm billing_active" href="#" data-id="{{$bill->id}}" data-status="{{$bill->status}}" >Suspended</a></td>
                                    @else
                                    <td><a class="btn btn-success btn-sm billing_active" href="#" data-id="{{$bill->id}}" data-status="{{$bill->status}}"> Active</a></td>
                                    @endif
                                    @if($bill->status==0 || $bill->status==0)
                                    <td style="color:#e74a3b;"><b>Suspended</b></td>
                                    @else
                                    <td style="color:#1cc88a;"><b>Active</b></td>
                                    @endif
                                    <td><b>{{$bill->date_modified}}</b></td>
                                    <td><a href="#"  class="btn btn-secondary btn-sm add_credits" data-id="{{$bill->id}}" data-branch="{{$bill->branch_name}}" data-credit="{{$bill->branch_credits}}" title="Add Credits"><span class="fa fa-dollar-sign"></span> Add Credits</a></td>
                                    <td><a href="/invoice/{{$bill->id}}/{{$bill->date_modified}}/{{$bill->invoice_no}}" target="_blank"  class="btn btn-info btn-sm" title="Invoice"><span class="fa fa-file-invoice-dollar" title="Invoice"></span> Invoice</a></td>
                                    <td><a href="/history/{{$bill->id}}/{{$bill->date_modified}}/{{$bill->branch_credits}}"  target="_blank" class="btn btn-warning btn-sm" title="History"><span class="fa fa-history" title="Remove Item"></span> History</a></td>
                                    <td align="center">
                                    <div class="btn-group">
                                        
                                        <a href="#" class="btn btn-primary btn-sm statement-modal" style="margin-left:5px;" data-id="{{$bill->id}}" title="Statement"><span class="fa fa-receipt "></span> Statement</a> 
                                    </div>
                                    </td>                                
                                </tr>
                               
                                @php $count++;@endphp
                                @endforeach 
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
</div>
<!--Billing Statement-->
<div class="modal fade" id="statement_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title " id="exampleModalLabel" style="color:white;">AIS Statement</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/print-branch-statement" method="GET" target="_blank"> 
           <div class="form-group">
           <input type="hidden" id="stat_id" name="stat_id">
           <label for="ais_start">Start Date:</label> 
              <input type="date" id="ais_start" name="ais_start" class="form-control font-control-sm">
           </div>

           <div class="form-group">
           <label for="ais_end">End Date:</label> 
              <input type="date" id="ais_end" name="ais_end" class="form-control font-control-sm">
           </div>
           
            
           
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary btn-sm"value="Print">
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Create Company Credit-->
  <div class="modal fade" id="create_branch_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md text-sm" style="font-size:12px;" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h6 class="modal-title " id="exampleModalLabel" style="color:white;">AIS Add Branch</h6>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="form-group">
           <form method="POST" action="/ais-create-branch">
           {{ csrf_field() }}
           <label for="ais_invoice_no">Invoice No:</label> 
              <input type="text" id="ais_invoice_no" name="ais_invoice_no" class="form-control form-control-sm">
           </div>

           <div class="form-group">
           <label for="ais_branch_name">Branch Name:</label> 
              <input type="text" id="ais_branch_name" name="ais_branch_name" class="form-control form-control-sm">
           </div>
           <div class="form-group">
           <label for="ais_branch_code">Branch Code:</label> 
              <input type="text" id="ais_branch_code" name="ais_branch_code" class="form-control form-control-sm">
           </div>
           <div class="form-group">
           <label for="ais_branch_contact">Branch Contact:</label> 
              <input type="text" id="ais_branch_contact" name="ais_branch_contact" class="form-control form-control-sm">
           </div>
           <div class="form-group">
           <label for="ais_branch_email">Branch Email:</label> 
              <input type="email" id="ais_branch_email" name="ais_branch_email" class="form-control form-control-sm">
           </div> 
           <div class="form-group">
           <label for="ais_branch_credits">Branch Credits:</label> 
              <input type="number" id="ais_branch_credits" name="ais_branch_credits" class="form-control form-control-sm">
           </div>
           <div class="form-group">
           <label for="ais_branch_price">Branch Credit Price:</label> 
              <input type="number" id="ais_branch_price" name="ais_branch_price" class="form-control form-control-sm">
           </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="Create Branch">
        </div>
        </form>
      </div>
    </div>
  </div>

  <!--Add Credits-->
  <div class="modal fade" id="add_credits_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="font-size:10px;" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title " id="exampleModalLabel" style="color:white;text-align:center;">AIS Add Credits.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="form-group">
           <form method="GET" action="/ais-add-credits">
           <input type="hidden" id="credit_id" name="credit_id">
           <label for="credit_branch">Branch:</label> 
              <input type="text" id="credit_branch" name="credit_branch" class="form-control form-control-sm" readonly>
           </div>

           <div class="form-group">
           <label for="credit_current">Current Credits</label> 
              <input type="text" id="credit_current" name="credit_current" class="form-control form-control-sm" readonly>
           </div>
           <div class="form-group">
           <label for="credit_add">Add Credits:</label> 
              <input type="number" id="credit_add" name="credit_add" class="form-control form-control-sm">
           </div>
            
           
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-secondary btn-sm" value="Add Credits">
        </div>
        </form>
      </div>
    </div>
  </div>

@endsection