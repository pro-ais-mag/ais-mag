@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Customer Feedback</h4>
                <a href="/print-customer-feedback" class="btn btn-secondary float-right" title="Print Customer Stats" target="_blank"><span class="fa fa-print"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Release Date</th>
                                    <th>Track No.</th>
                                    <th>Registration</th>
                                    <th>Vehicle</th>
                                    <th>Client</th>
                                    <th>Client Cell</th>
                                    <th>Insurance</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count=1;@endphp
                                @foreach($past_7 as $past)
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{$past->release_date}}</td>
                                    <td>{{$past->Key_Ref}}</td>    
                                    <td>{{$past->Reg_No}}</td>                                
                                    <td>{{$past->Model}}</td>
                                    <td>{{$past->Fisrt_Name}} {{$past->Last_Name}}</td>
                                    <td>{{$past->Cell_number}}</td>
                                    <td>{{$past->Inserer}}</td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="#" class="btn btn-success add_comment" data-id='{{$past->Key_Ref}}' data-name='{{$past->Fisrt_Name}}  {{$past->Last_Name}}' title="Add Comment"><span class="fa fa-comment"></span></a>
                                        
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

<!--Add Comment-->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Client Comments.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <form method="POST" action="/customer-care-note">
              {{csrf_field()}}
              <input type="hidden" id="comment_id" name="comment_id">
            <label for="comment_track">Track No.</label>

                <input type="text" id="comment_track" name="comment_track" class="form-control">
            </div>
            <div class="form-group">
            <label for="comment_name">Client:</label>
                <input type="text" id="comment_name" name="comment_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="comment_type">Comment Type:</label>
                <select id="comment_type" name="comment_type" class="form-control">
                    <option value="">--Select Type--</option>
                    <option value="Unavailable">Unavailable</option>
                    <option value="Happy">Happy</option>
                    <option value="Repair Duration">Repair Duration</option>
                    <option value="Service">Service</option>
                    <option value="Workmanship">Workmanship</option>
                    <option value="Communication">Communication</option>
                    <option value="Other">Other</option>
                </select> 
            </div>
            <div class="form-group">
                <lable for="comment_note">Comment Notes</label>
                    <textarea id="comment_note" name="comment_note" row="5" class="form-control"></textarea>
            </div>
            
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success" value="Add Comment">
          <form>
        </div>
      </div>
    </div>
  </div>




@endsection