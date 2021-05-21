@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Pre-Booking Alerts</h4>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style="font-size:12px;">
                            <tr>
                                
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Cell No.</th>
                                <th>Email</th>
                                <th>Notes</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody style="font-size:10px;">
                        @php $count=1;@endphp
                        @foreach($prebooking_details as $details)
                          <tr>
                              <td>{{$count}}</td>
                              <td>{{$details->Fisrt_Name}} {{$details->Last_Name}}</td>
                              <td>{{$details->Cell_number}}</td>
                              <td>{{$details->Email}}</td>
                              <td>{{$details->comment}}</td>
                              <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary add_prebooking_notes" href="#" data-id="{{$details->id}}" data-full="{{$details->Fisrt_Name}} {{$details->Last_Name}}" data-contact="{{$details->Cell_number}}" data-email="{{$details->Email}}" data-notes="{{$details->comment}}" title="Add Notes"><span class="fa fa-edit"></span></a> 
                                </div>
                              </td>  
                          </tr>
                        @php $count++;@endphp    
                        @endforeach
                        </tbody>
                    </table>    
</div>



@endsection                