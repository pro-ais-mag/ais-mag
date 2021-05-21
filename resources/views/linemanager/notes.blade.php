@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Notes - {{$keys}}</h4>
                <a class="btn btn-success float-right" data-id="{{$keys}}" href="#" title="Add Notes"><span class="fa fa-plus"></span></a>
                <a class="btn btn-primary float-right" style="margin-right:10px;" target="_blank" data-id="{{$key}}" href="/print-line-manager-notes/{{$keys}}" title="Print Notes"><span class="fa fa-print"></span></a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Added By</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $count=1;@endphp 
                            
                                @foreach($notes as $note)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$note->user}}</td>
                                        <td>{{$note->date}}</td>
                                        <td>{{$note->time}}</td>
                                        <td><b>{{$note->note}}</b></td>                               
                                    </tr>
                                @php $count++;@endphp   
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                </div><br>

                <div class="row">
                <div class="table">
                            <table class="table table-striped" id="dataTables" width="100%" cellspacing="0" style="font-size:12px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sent By</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>SMS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $counts=1;@endphp 
                                @foreach($smses as $sms)
                                    <tr>
                                        <td>{{$counts}}</td>
                                        <td>{{$sms->user}}</td>
                                        <td>{{$sms->sent_date}}</td>
                                        <td>{{$sms->sent_time}}</td>
                                        <td>{{$sms->message}}</td>                                
                                    </tr>
                                @php $counts++;@endphp   
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                </div>
            </div>
</div>



@endsection