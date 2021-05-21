@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Edit Customer Feedback.</h4>
               
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
                                    <th>Comment Type</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count=1;@endphp
                                @foreach($customer_feedback as $past)
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{$past->release_date}}</td>
                                    <td>{{$past->Key_Ref}}</td>    
                                    <td>{{$past->Reg_No}}</td>                                
                                    <td>{{$past->Model}}</td>
                                    <td>{{$past->Fisrt_Name}} {{$past->Last_Name}}</td>
                                    <td>{{$past->Cell_number}}</td>
                                    <td>{{$past->Inserer}}</td>
                                    <td><b>{{$past->comment_type}}</b></td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="#" class="btn btn-primary edit_feedback" data-ref='{{$past->id}}' data-id='{{$past->Key_Ref}}' data-name='{{$past->Fisrt_Name}}  {{$past->Last_Name}}' data-comment-type='{{$past->comment_type}}' data-note='{{$past->comment_note}}'  title="Edit Comment"><span class="fa fa-edit"></span></a>
                                        
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

<!--Edit Customer Fedback Comment-->
<div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Edit Feedback Comments.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <form method="GET" action="/customer-care-edit-update">
              {{csrf_field()}}
              <input type="hidden" id="comment_id_edit" name="comment_id_edit" >
            <label for="comment_track_edit">Track No.</label>

                <input type="text" id="comment_track_edit" name="comment_track_edit" class="form-control" readonly>
            </div>
            <div class="form-group">
            <label for="comment_name_edit">Client:</label>
                <input type="text" id="comment_name_edit" name="comment_name_edit" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="comment_type_edit">Comment Type:</label>
                <input type="text" id="comment_type_edit" name="comment_type_edit" class="form-control" readonly>
                    
               
            </div>
            <div class="form-group">
                <lable for="comment_note_edit">Comment Notes</label>
                    <textarea id="comment_note_edit" name="comment_note_edit" row="5" class="form-control"></textarea>
            </div>
            
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary" value="Edit Comment">
          <form>
        </div>
      </div>
    </div>
  </div>




@endsection