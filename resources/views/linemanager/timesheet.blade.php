@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">General Work Timesheets.</h4>
                <a class="btn btn-info float-right add_item_stock" data-id="" href="#" title="Add To Order"><span class="fa fa-plus"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Cell No.</th>
                                    <th>User Level</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              @php $count=1;@endphp 
                              @foreach($employees as $details)

                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{$details->use_username}}</td>
                                    <td>{{$details->user_cell}}</td>
                                    <td>{{$details->userLevel}}</td>
                                    <td>
                                    <div class="btn-group">
                                        <!--<a href="#" class="btn btn-warning driver" data-id="{{$details->use_username}}" title="Driver"><span class="fa fa-truck-loading"></span></a>-->
                                        <a href="#" style="margin-left:5px;" class="btn btn-success workshop" data-id="{{$details->use_username}}" title="Work Shop"><span class="fa fa-tools"></span></a> 
                                        <a href="#" style="margin-left:5px;" class="btn btn-danger general" data-id="{{$details->use_username}}" title="General Work"><span class="fa fa-user-tag"></span></a>
                                        <!--<a href="#" style="margin-left:5px;" class="btn btn-info print" data-id="{{$details->use_username}}" title="Print"><span class="fa fa-print"></span></a>-->
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

<!--Work Shop-->

<div class="modal fade" id="WorkShopModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Work Shop</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <form method="GET" action="/line-manager-workshop">
              <input type="hidden" id="workshop_id" name="workshop_id">
            <label for="workshop_from">From:</label>

                <input type="date" id="workshop_from" name="workshop_from" class="form-control">
            </div>
            <div class="form-group">
            <label for="workshop_to">To:</label>
                <input type="date" id="workshop_to" name="workshop_to" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success" value="Display">
          </form>
        </div>
      </div>
    </div>
  </div>



<!--General Worker-->
  <div class="modal fade" id="GeneralModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">General Worker.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="GET" action="/line-manager-general">
            <div class="form-group">
            <input type="hidden" id="general_id" name="general_id">
            <label for="general_from">From:</label>
                <input type="date" id="general_from" name="general_from" class="form-control">
            </div>
            <div class="form-group">
            <label for="general_to">To:</label>
                <input type="date" id="general_to" name="general_to" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-danger" value="Display">
        </div>
        </form>
      </div>
    </div>
  </div>

  <!--Print-->
  <div class="modal fade" id="PrintModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Print.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
            <label for="print_from">From:</label>
                <input type="date" id="print_from" name="print_from" class="form-control">
            </div>
            <div class="form-group">
            <label for="print_to">To:</label>
                <input type="date" id="print_to" name="print_to" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-print" href="#">Display</a>
        </div>
      </div>
    </div>
  </div>


@endsection            