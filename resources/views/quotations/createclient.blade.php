@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
@if (Session::has('warning'))
    <div class="alert alert-danger">{{ Session::get('warning') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-2">
                <h4 class="font-weight-bold text-primary">Create Quotation.</h4><h10 style="color:red;"><span style="color:red;">&#42;</span> This Indicates All The Required Fieilds</h10>
                <a href="#" class="btn btn-success btn-sm float-right create_broker" title="Add Insurer"><span class="fa fa-plus"></span></a>
            </div>
            <div class="card-body">
                <div class="row">
                    <!--Client Details-->
                        <div class="card-sm shadow mb-1 col-3">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Client Details.</h6>
                        <form action="/create-client-quote" method="POST" id="creation" >
                        {{csrf_field()}} 
                        </div>
                            <div class="card-body">
                            
                            <input type="text" style="margin-bottom:10px;" name="name" id="name" placeholder="Enter Name" class="form-control form-control-sm">
                            <input type="text" style="margin-bottom:10px;" name="lastname" id="lastname" placeholder="Enter Last Name" class="form-control form-control-sm">
                            <input type="text" style="margin-bottom:10px;" name="id_number" id="id_number" placeholder="Enter I.D" class="form-control form-control-sm">
                        
                            <div class="input-group sm" id="dob_span">
                            <div class="input-group-prepend">
                                <span class="input-group-text sm" id="basic-addon1" style="height:32px;">DOB</span>
                            </div>
                                <input type="date" name="dob" id="odb" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            <input type="text" name="mobile" id="mobile" placeholder="000-000-0000" class="form-control form-control-sm" style="margin-bottom:10px;">
                            <input type="email" name="client_email" id="client_email" placeholder="Email" class="form-control form-control-sm" style="margin-bottom:10px;">
                            <input type="text" name="street" id="street" placeholder="Street" class="form-control form-control-sm" style="margin-bottom:10px;">
                            <input type="text" name="surburb" id="surburb" placeholder="Surburb" class="form-control form-control-sm" style="margin-bottom:10px;">
                            <input type="text" name="city" id="city" placeholder="City" class="form-control form-control-sm" style="margin-bottom:10px;">
                            <input type="text" name="estimator" id="estimator" placeholder="Estimator" class="form-control form-control-sm" style="margin-bottom:10px;">
                            <select name="branch" id="branch" class="form-control form-control-sm" style="margin-bottom:10px;">
                                <option value="">--Select Branch--</option>
                                @foreach($branches as $branch)
                                    <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                @endforeach    
                            </select>
                        </div>
                    </div>
                    <!--End Details-->
                    <!--Vehicle Details-->
                            <div class="card shadow mb-3 col-3" style="margin-left:5px;">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Vehicle Details.</h6>
                        </div>
                        <div class="card-body">
                        <input type="text" name="registration" id="registration" placeholder="Enter Registration" class="form-control form-control-sm" style="margin-bottom:10px;">
                        <input type="text" name="vin_number" id="vin_number" placeholder="VIN Number" class="form-control form-control-sm" style="margin-bottom:10px;">
                        <input type="text" name="engine_number" id="engine_number" placeholder="Engine No." class="form-control form-control-sm" style="margin-bottom:10px;">
                        <input type="text" name="make" id="make" placeholder="Make" class="form-control form-control-sm" style="margin-bottom:10px;">
                        <input type="text" name="model" id="model" placeholder="Model" class="form-control form-control-sm" style="margin-bottom:10px;">
                        <input type="text" name="odometer" id="odometer" placeholder="OdoMeter" class="form-control form-control-sm" style="margin-bottom:10px;">
                        <input type="text" name="colour" id="colour" placeholder="Colour" class="form-control form-control-sm"style="margin-bottom:10px;">
                        <input type="text" name="year" id="year" class="form-control form-control-sm" placeholder="Year" style="margin-bottom:10px;">
                        <div class="input-group sm" id="booking_span">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="height:32px;" id="basic-addon1">Booking</span>
                            </div>
                                <input type="date" name="booking" id="booking" placeholder="Booking Date" class="form-control form-control-sm" aria-describedby="basic-addon1" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group input-sm" id="quote_date_span">
                            <div class="input-group-prepend input-sm">
                                <span class="input-group-text" style="height:32px;" id="basic-addon1">Quote D.</span>
                            </div>
                                <input type="date" name="quote_date" id="quote_date" placeholder="Quote Date" class="form-control form-control-sm" aria-describedby="basic-addon1" style="margin-bottom:10px;">
                        </div><br>
                        
                        </div>
                    </div>
                    <!--End Vehicles-->
                    <!--Insurance Details-->
                            <div class="card shadow mb-3 col-3" style="margin-left:5px;">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Insurance Details.</h6>
                        </div>
                        <div class="card-body">
                            <select name="insurance_type" id="insurance_type" class="form-control form-control-sm" style="margin-bottom:10px;">
                                <option value="1">Private</option>
                                <option value="2">Insurance</option>
                                <option value="3">Dealership</option>
                            </select>
                            <select name="insuror" id="insuror" class="form-control form-control-sm" disabled style="margin-bottom:10px;">
                                <option value="">Select Insurer</option>
                                @foreach($brokers as $broker)
                                  <option value="{{$broker->broker}}">{{$broker->broker}}</option>
                                @endforeach
                            </select>
                            <input type="text" name="contact_number" id="contact_number" placeholder="Insurance No." class="form-control form-control-sm" disabled style="margin-bottom:10px;">
                            <input type="text" name="insurance_email" id="insurance_email" placeholder="Insurance Email" class="form-control form-control-sm" disabled style="margin-bottom:10px;">
                            <input type="text" name="claim_number" id="claim_number" placeholder="Claim Number" class="form-control form-control-sm" disabled style="margin-bottom:10px;">
                            <input type="text" name="clerk_ref" id="clerk_ref" placeholder="Clerk Ref." class="form-control form-control-sm" disabled style="margin-bottom:10px;">
                            <select name="assessor" id="assessor" class="form-control auto_assessor form-control-sm" disabled style="margin-bottom:10px;">
                                <option value="">Select Assessor</option>
                                @foreach($assessor as $asessor)
                                    <option value="{{$asessor->Names}}">{{$asessor->Names}}</option>
                                @endforeach
                            </select>
                            <input type="email" name="assessor_email" id="assessor_email" placeholder="Assessor Email" class="form-control form-control-sm" disabled style="margin-bottom:10px;">
                            <input type="text" name="assessor_no" id="assessor_no" placeholder="Assessor No." class="form-control form-control-sm" disabled style="margin-bottom:10px;">
                            <input type="text" name="assessor_company" id="assessor_company" placeholder="Assessor Company" class="form-control form-control-sm" disabled style="margin-bottom:10px;">
                        </div>
                    </div>
                    <!--End Insurance-->
                    <!--Tow Details-->
                        <div class="card shadow mb-3 col-2" style="margin-left:5px;">
                            <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tow Details.</h6>
                            </div>
                                <div class="card-body">
                                    <select name="towed" id="towed" class="form-control form-control-sm" style="margin-bottom:10px;">
                                    <option value="2">No</option>
                                    <option value="1">Yes</option>
                                    
                                    
                                    </select>
                                    <select name="towed_by" id="towed_by" class="form-control form-control-sm" disabled style="margin-bottom:10px;">
                                        <option >Towed By</option>
                                        @foreach($towing_info as $tow)
                                            <option value="{{$tow->towing}}">{{$tow->towing}}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="tow_contact_number" id="tow_contact_number" placeholder="Tow Contact" class="form-control form-control-sm" disabled style="margin-bottom:10px;">
                                    <input type="email" name="tow_email" id="tow_email" placeholder="Tow Email" class="form-control form-control-sm" disabled style="margin-bottom:10px;">
                                    <input type="text" name="tow_fee" id="tow_fee" placeholder="Towing Fee" class="form-control form-control-sm" disabled style="margin-bottom:10px;">
                                    <select name="towed_status" id="towed_status" class="form-control form-control-sm" disabled style="margin-bottom:10px;">
                                        <option value="1">Open</option>
                                        <option value="2">Open & Auth</option>
                                        <option value="3">Closed</option>
                                    </select><br>
                                </div>
                        </div>
                    <!--End Tow-->
                </div>
                <div class="btn-group">
            <input type="submit" value="Save" class="btn btn-primary btn-sm float-right">
            </div>
            </div>
            
            </form>
            <br>
</div>
<!-- Create New Insurer -->
<div class="modal fade" id="create_new_insurer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content"  style="width:600px;font-size:10px;">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Create New Insurer.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/create-insurer" method="POST">
        {!! csrf_field() !!}
        <div class="modal-body" style="font-size:10px;">
              <div class="row">
                <div class="form-group col-12">
                    <input type="text" class="form-control form-control-sm" id="broker_name" name="broker_name" placeholder="Insurer Name" required>
                </div>    
              </div>
              <div class="row">
                <div class="form-group col-6">
                    <input type="text" class="form-control form-control-sm" id="broker_contact" name="broker_contact" placeholder="Contact No." max="10" required>
                </div>
                <div class="form-group col-6">
                    <input type="email" class="form-control form-control-sm" id="broker_email" name="broker_email" placeholder="Email Address" required>   
                </div>
              </div>
              <div class="row">
                <div class="form-group col-6">
                    <input type="text" class="form-control form-control-sm" id="broker_vat" name="broker_vat" placeholder="VAT No.">
                </div>
                <div class=" form-group col-6">
                    <input type="text" class="form-control form-control-sm" id="broker_area" name="broker_area" placeholder="Area">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-12">
                    <textarea class="form-control form-control-sm" id="broker_address" name="broker_address" placeholder="Address"></textarea>
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="Save">
        </div>
        </form>
      </div>
    </div>
</div>


@endsection