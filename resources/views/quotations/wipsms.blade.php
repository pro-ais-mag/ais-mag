@extends('quotations')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">W.I.P/SMS - {{$key}}</h4>
            </div>
            <div class="card-body">
                
                <div class="row">
                <div class="col-2">
                    <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Towing</a>
                    
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Bookings</a>
                    
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-pop" role="tab" aria-controls="settings">Business Cards</a>
                    <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-rfcs" role="tab" aria-controls="settings">Seasonal Greetings</a>-->
                    
                    </div>
                </div>
                <div class="col-10">
                    <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                        
                        <div class="row">
                            <div class="col-4">
                                <table>
                                  <thead>
                                    <th colspan="2" style="text-align:center;font-size:16px;">Towing Smses</th>
                                  </thead>
                                  <tbody>  
                                    @foreach($towing_sms as $tow)
                                    <tr>
                                        <td><a href="#" class="btn btn-primary send_sms text-sm btn-sm" style="margin-bottom:5px;" data-title="{{$tow->title}}" data-message="{{$tow->message}}" data-id="{{$key}}" data-mid="{{$tow->stage_no}}" data-reg="{{$reg}}" data-cell_no="{{$cell_no}}">{{$tow->title}}</a></td>
                                        <td><a href="#" class="btn btn-warning send_sms btn-sm" data-title="{{$tow->title}}" style="margin-bottom:5px;" data-message="{{$tow->message}}" data-id="{{$key}}"><span class="fa fa-edit"></span></a></td>    
                                    </tr>
                                    @endforeach
                                  </tbody>  
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="table table-sm table-dark">
                                    <thead>
                                    <tr>
                                        <th colspan="6" style="text-align:center;">Towing SMS Sent</th>
                                    </tr>  
                                    <tr>
                                        <th>Date/Time</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>User</th>
                                    </tr>  
                                    </thead>
                                    <tbody>
                                        @foreach($sms_tow_event as $sms_tow)
                                          <tr>
                                            <td>{{$sms_tow->sent_date}} {{$sms_tow->sent_time}}</td>
                                            <td>{{$sms_tow->title}}</td>
                                            <td>{{$sms_tow->status}}</td>
                                            <td>{{$sms_tow->user}}</td>
                                          </tr>  
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-profile-list">
                        
                        <div class="row">
                            <div class="col-4">
                            <table>
                                  <thead>
                                    <th colspan="2" style="text-align:center;font-size:16px;">Bookings</th>
                                  </thead>
                                  <tbody>  
                                    @foreach($booking_sms as $tow)
                                    <tr>
                                        <td><a href="#" class="btn btn-primary send_sms text-sm btn-sm" style="margin-bottom:5px;" data-title="{{$tow->title}}" data-message="{{$tow->message}}" data-id="{{$key}}" data-mid="{{$tow->stage_no}}" data-reg="{{$reg}}" data-cell_no="{{$cell_no}}">{{$tow->title}}</a></td>
                                        <td><a href="#" class="btn btn-warning send_sms btn-sm" style="margin-bottom:5px;" data-title="{{$tow->title}}" data-message="{{$tow->message}}" data-id="{{$key}}"><span class="fa fa-edit"></span></a></td>    
                                    </tr>
                                    @endforeach
                                  </tbody>  
                            </table>
                            </div>
                            <div class="col-6">
                            <table class="table table-sm table-dark">
                                    <thead>
                                    <tr>
                                        <th colspan="6" style="text-align:center;">Booking SMS Sent</th>
                                    </tr>  
                                    <tr>
                                        <th>Date/Time</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>User</th>
                                    </tr>  
                                    </thead>
                                    <tbody>
                                        @foreach($sms_booking_event as $sms_booking)
                                          <tr>
                                            <td>{{$sms_booking->sent_date}} {{$sms_booking->sent_time}}</td>
                                            <td>{{$sms_booking->title}}</td>
                                            <td>{{$sms_booking->status}}</td>
                                            <td>{{$sms_booking->user}}</td>
                                          </tr>  
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-pop" role="tabpanel" aria-labelledby="list-messages-list">
                        
                        <div class="row">
                            <div class="col-4">
                            <table>
                                  <thead>
                                    <th colspan="2" style="text-align:center;font-size:16px;">Business Cards</th>
                                  </thead>
                                  <tbody>  
                                    @foreach($business_sms as $tow)
                                    <tr>
                                        <td><a href="#" class="btn btn-primary send_sms text-sm btn-sm" style="margin-bottom:5px;" data-title="{{$tow->title}}" data-message="{{$tow->message}}" data-id="{{$key}}" data-mid="{{$tow->stage_no}}" data-reg="{{$reg}}" data-cell_no="{{$cell_no}}">{{$tow->title}}</a></td>
                                        <td><a href="#" class="btn btn-warning send_sms btn-sm" style="margin-bottom:5px;" data-title="{{$tow->title}}" data-message="{{$tow->message}}" data-id="{{$key}}"><span class="fa fa-edit"></span></a></td>    
                                    </tr>
                                    @endforeach
                                  </tbody>  
                                </table>
                            </div>
                            <div class="col-6">
                            <table class="table table-sm table-dark">
                                    <thead>
                                    <tr>
                                        <th colspan="6" style="text-align:center;">Business Card SMS Sent</th>
                                    </tr>  
                                    <tr>
                                        <th>Date/Time</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>User</th>
                                    </tr>  
                                    </thead>
                                    <tbody>
                                        @foreach($sms_business_event as $sms_business)
                                          <tr>
                                            <td>{{$sms_business->sent_date}} {{$sms_business->sent_time}}</td>
                                            <td>{{$sms_business->title}}</td>
                                            <td>{{$sms_business->status}}</td>
                                            <td>{{$sms_business->user}}</td>
                                          </tr>  
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-rfcs" role="tabpanel" aria-labelledby="list-settings-list">
                        <h5 class="text-primary" style="text-align:center;"><b>Seasonal Greetings SMS</b></h5>
                        <div class="row">
                            <div class="col-4">
                                sms- interface
                            </div>
                            <div class="col-6">
                                sms - status
                            </div>
                        </div>
                    </div>
                    

                </div>
                </div>
            </div>
</div>
@endsection            