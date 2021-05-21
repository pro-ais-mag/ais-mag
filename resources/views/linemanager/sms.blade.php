@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">W.I.P - {{$key}}</h4>
                <a class="btn btn-info float-right add_item_stock" data-id="" href="#" title="Add To Order"><span class="fa fa-plus"></span></a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive col-8">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sent Date</th>
                                        <th>Sent Time</th>
                                        <th>Sms Title</th>
                                        <th>Status</th>
                                        <th>User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $count=1;$status='';@endphp 
                                
                                    @foreach($client_sms as $client)    
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$client->sent_date}}</td>
                                        <td>{{$client->sent_time}}</td>
                                        <td>{{$client->title}}</td>
                                        <td>
                                        @if($client->status==0){
                                            $status="<span class='badge badge-danger' style='background-color:maroon;font-size:10px'>Failed</span>";
                                        }elseif($client->status==1){
                                            $status="<span class='badge badge-success' style='background-color:green;font-size:10px'>Sent</span>";
                                        }elseif($client->status==2){
                                            $status="<span class='badge badge-secondary' style='background-color:orange;font-size:10px'>Not Sent (Done)</span>";
                                        }
                                        @endif;    
                                        @php echo $status;@endphp
                                                                                </td>
                                        <td>{{$client->user}}</td>                                
                                    </tr>
                                    @php $count++;@endphp   
                                    @endforeach
                                
                                </tbody>

                            </table>
                        </div>
                    <div class="card col-4">
                    @foreach($sms as $event)
                    <tr>
                    <td>
                    <div class="btn-group" style="margin-top:5px;">
                    <a title='{{$event->message}}' href="#" data-toggle='tooltip' data-placement='top' class='btn btn-sm lgBtns'   id='{{$event->id}}' lang='{{$event->stage_no}}' style='border-radius:0px 10px 10px 0px;background-color:cadetblue;color:#fff;width:75%;text-align:left'>{{$event->title}}<span class='badge' style='float:right'>send</span></a>
                    <a class='btn btn-sm btn-primary' href="#" name='{{$event->id}}' lang='{{$event->stage_no}}' style='margin-left:5px;'><span class='fa fa-plus'></span></a>
                    <a class='btn btn-sm btn-warning'  href="#"  name='{{$event->id}}' lang='{{$event->stage_no}}' style='margin-left:5px;' ><span class='fa fa-edit'></a>
                    <a class='btn btn-sm btn-danger'  href="#"  name='{{$event->id}}' lang='{{$event->stage_no}}'style='margin-left:5px;'><span class='fa fa-trash'></a>
                    </div>
                    </td>
                    </tr>
                    <br>            
                    @endforeach
                    </div>
                   
                </div>   

            </div>
                     
@endsection