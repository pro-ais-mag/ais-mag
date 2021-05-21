@extends('quotations')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            
            <div class="card-header py-2">
                <h4 class="font-weight-bold text-primary">Client Details - {{$key}}</h4>
                
            </div>
            <div class="card-body" style="font-size:6px;">
                <div class="card-deck">
                    <!--Client Details-->
                        <div class="card shadow col-3" style="font-size:6px;">
                        <div class="card-header py-3">
                        
                        <h6 class="m-0 font-weight-bold text-primary">Client Details.</h6>
                        @foreach($clients_details as $client)
                        </div>
                        <form action="/edit-client-details" method="GET">
                        <input type="hidden" id="ref" name="ref" value="{{$key}}">
                            <div class="card-body">
                            <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Name</span>
                                </div>
                                <input type="text" name="name_edit" id="name_edit" class="form-control form-control-sm" value="{{$client->Fisrt_Name}}" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Lastname</span>
                                </div>
                                <input type="text" name="lastname_edit" id="lastname_edit" class="form-control form-control-sm" value="{{$client->Last_Name}}" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">ID No.</span>
                                </div>
                                <input type="text" name="id_number_edit" id="id_number_edit" class="form-control form-control-sm" value="{{$client->id_number}}" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                            <div class="input-group-prepend">
                                <span class="input-group-text sm" id="basic-addon1" style="height:32px;">DOB</span>
                            </div>
                                <input type="date" name="dob_edit" id="odb_edit" class="form-control form-control-sm" aria-describedby="basic-addon1" style="margin-bottom:10px;" value="{{$client->BirthDate}}">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Mobile</span>
                                </div>
                                <input type="text" name="mobile_edit" id="mobile_edit" class="form-control form-control-sm" value="{{$client->Cell_number}}" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Email</span>
                                </div>
                                <input type="email" name="client_email_edit" id="client_email_edit" class="form-control form-control-sm" value="{{$client->Email}}" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Street</span>
                                </div>                        
                                <input type="text" name="street_edit" id="street_edit" class="form-control form-control-sm" value="{{$client->Address_1}}" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Suburb</span>
                                </div>
                                <input type="text" name="surburb_edit" id="surburb_edit" class="form-control form-control-sm" value="{{$client->Address_2}}" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">City</span>
                                </div>
                                    <input type="text" name="city_edit" id="city_edit" class="form-control form-control-sm" value="{{$client->Address_3}}" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" style="font-size:8px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Estimator</span>
                                </div>
                                  <input type="text" name="estimator_edit" id="estimator_edit" class="form-control form-control-sm" value="{{$client->Estimator}}" style="margin-bottom:10px;">
                            </div>    
                            <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Branch</span>
                                </div>
                                <select type name="branch_edit" id="branch_edit" class="form-control form-control-sm" style="margin-bottom:10px;">
                                <option selected value="{{$client->branch}}">{{$client->branch}}</option>
                                
                                @foreach($branches as $branch)
                                   <option value="{{substr($branch->branch_name,4)}}">{{substr($branch->branch_name,4)}}</option>     
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--End Details-->
                    
                    <!--Vehicle Details-->
                    <div class="card shadow col-3">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Vehicle Details.</h6>
                        </div>
                        <div class="card-body">
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Registration</span>
                                </div>
                                <input type="text" name="registration_edit" id="registration_edit" class="form-control form-control-sm" value="{{$client->Reg_No}}" style="margin-bottom:10px;">
                        </div>        
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">VIN</span>
                                </div>
                                    <input type="text" name="vin_number_edit" id="vin_number_edit" class="form-control form-control-sm" style="margin-bottom:10px;" value="{{$client->Chasses_No}}">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Eng No.</span>
                                </div>            
                                <input type="text" name="engine_number_edit" id="engine_number_edit" value="{{$client->Eng_No}}" class="form-control form-control-sm" style="margin-bottom:10px;">
                        </div>   
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Make</span>
                                </div>
                                <input type="text" name="make_edit" id="make_edit" class="form-control form-control-sm" value="{{$client->Make}}" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Model</span>
                                </div>        
                                <input type="text" name="model_edit" id="model_edit" class="form-control form-control-sm" value="{{$client->Model}}" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">ODO</span>
                                </div>
                                <input type="text" name="odometer_edit" id="odometer_edit" class="form-control form-control-sm" style="margin-bottom:10px;" value="{{$client->KM}}">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Colour</span>
                                </div>        
                                <input type="text" name="colour_edit" id="colour_edit" placeholder="Colour" class="form-control form-control-sm" value="{{$client->Colour}}" style="margin-bottom:10px;"> 
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Year</span>
                                </div>        
                                <input type="text" name="year_edit" id="year_edit" class="form-control form-control-sm" value="{{$client->Vehicle_year}}" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group sm">
                            <div class="input-group-prepend" style="font-size:8px;">
                                <span class="input-group-text" style="height:32px;" id="basic-addon1">Booking</span>
                            </div>
                                <input type="date" name="booking_edit" id="booking_edit" placeholder="Booking Date" class="form-control form-control-sm" value="{{$client->Date}}" aria-describedby="basic-addon1" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group input-sm">
                            <div class="input-group-prepend input-sm" style="font-size:8px;">
                                <span class="input-group-text" style="height:32px;" id="basic-addon1">Quote D.</span>
                            </div>
                                <input type="date" name="quote_date_edit" id="quote_date_edit" placeholder="Quote Date" class="form-control form-control-sm" aria-describedby="basic-addon1" style="margin-bottom:10px;" value="{{$client->Date}}">
                        </div><br>
                        </div>
                    </div>
                    <!--End Vehicles-->
                    
                    <!--Insurance Details-->
                    <div class="card shadow col-3">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Insurance Details.</h6>
                        </div>
                        <div class="card-body">
                        <div class="input-group sm">
                                <div class="input-group-prepend" style="font-size:8px;">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Insurance</span>
                                </div>
                                  <select name="insurance_type_edit" id="insurance_type_edit" class="form-control form-control-sm" style="margin-bottom:10px;" >
                                    @if($client->Inserer=="Private")
                                        <option value="1" selected>Private</option>
                                        <option value="2" >Insurance</option>    
                                        <option value="3">Dealership</option>
                                    @else    
                                        <option value="2" selected>Insurance</option>
                                        <option value="1">Private</option>
                                        <option value="3">Dealership</option>
                                    @endif
                                    
                                </select>
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Insuror</span>
                                </div>        
                                    <select name="insuror_edit" id="insuror_edit" class="form-control form-control-sm" style="margin-bottom:10px;">
                                        <option value="1">Select Insurer</option>
                                        <option value="{{$client->Inserer}}" selected>{{$client->Inserer}}</option>
                                        @foreach($brokers as $broker)
                                            <option value="{{$broker->broker}}">{{$broker->broker}}</option>
                                        @endforeach
                                        
                                    </select>
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">I. Contact</span>
                                </div>            
                                <input type="text" name="contact_number_edit" id="contact_number_edit" value="{{$client->ins_contact}}"class="form-control form-control-sm" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">I. Email</span>
                                </div>    
                                <input type="text" name="insurance_email_edit" id="insurance_email_edit" value="{{$client->ins_email}}" class="form-control form-control-sm" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                  <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Claim No.</span>
                                </div>        
                                <input type="text" name="claim_number_edit" id="claim_number_edit" value="{{$client->ins_claim}}" class="form-control form-control-sm" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Clerk Ref.</span>
                                </div>        
                                <input type="text" name="clerk_ref_edit" id="clerk_ref_edit" value="{{$client->ClerkName}}" class="form-control form-control-sm"  style="margin-bottom:10px;">
                        </div>  
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Assessor</span>
                                </div>      
                                <select name="assessor_edit" id="assessor_edit" class="form-control form-control-sm" style="margin-bottom:10px;">
                                    <option value="">Select Assessor</option>
                                    @foreach($assessor as $asessor)
                                        <option value="{{$asessor->Names}}">{{$asessor->Names}}</option>
                                    @endforeach
                                 
                                </select>
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">A.Email</span>
                                </div>        
                                <input type="email" name="assessor_email_edit" id="assessor_email_edit" value="{{$client->Assessor_Email}}" class="form-control form-control-sm" style="margin-bottom:10px;">
                        </div>        
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">A.Contact</span>
                                </div>
                                <input type="text" name="assessor_no_edit" id="assessor_no_edit" value="{{$client->Assessor_Cell}}" class="form-control form-control-sm" style="margin-bottom:10px;">
                        </div>
                        <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">A.Company</span>
                                </div>        
                                <input type="text" name="assessor_company_edit" id="assessor_company_edit" value="{{$client->Assessor_comp}}" class="form-control form-control-sm" style="margin-bottom:10px;">
                        </div>        
                        </div>
                    </div>
                    <!--End Insurance-->
                    
                    <!--Tow Details-->
                        <div class="card shadow col-3">
                            <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tow Details.</h6>
                            </div>
                                <div class="card-body">
                                <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Towed?</span>
                                </div>
                                    <select name="towed_edit" id="towed_edit" class="form-control form-control-sm" style="margin-bottom:10px;">
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                    
                                    </select>
                                </div>
                                <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">By?</span>
                                </div>    
                                    <select name="towed_by_edit" id="towed_by_edit" class="form-control form-control-sm" style="margin-bottom:10px;">
                                        <option value="">Towed By</option>
                                        @foreach($towing_info as $tow)
                                            <option value="{{$tow->towing}}">{{$tow->towing}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Contact</span>
                                </div>    
                                    <input type="text" name="tow_contact_number_edit" id="tow_contact_number_edit" value="{{$client->tow_tel}}" class="form-control form-control-sm" style="margin-bottom:10px;">
                                </div>    
                                <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Email</span>
                                </div>
                                    <input type="email" name="tow_email_edit" id="tow_email_edit" value="{{$client->tow_email}}" class="form-control form-control-sm" style="margin-bottom:10px;">
                                </div>    
                                <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Fee</span>
                                </div>    
                                    <input type="text" name="tow_fee_edit" id="tow_fee_edit" value="{{$client->towing_fee1}}" class="form-control form-control-sm" style="margin-bottom:10px;">
                                </div>
                                <div class="input-group sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">File Status</span>
                                </div>    
                                    <select name="towed_status_edit" id="towed_status_edit" class="form-control form-control-sm" style="margin-bottom:10px;">
                                        <option value="1">Open</option>
                                        <option value="2">Open & Auth</option>
                                        <option value="3">Closed</option>
                                    </select>
                                </div>
                        </div>
                    <!--End Tow-->
                    @endforeach
                </div>
            </div>
            <div class="btn-group">
                <input type="submit" value="Save" class="btn btn-primary">
            </div> 
            </form>   

</div>            

@endsection