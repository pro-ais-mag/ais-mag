@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-1">
                
                <h4 class="m-0 font-weight-bold text-primary">New Client</h4><br>
             
                
            </div>
            <div class="card-body">
                
                <div class="row">
                <div class="col-2">
                    <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Client & Vehicle Details</a>
                    <!--<a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">NON VAT Invoices</a>-->
                    <!--<a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Vehicle Details</a>-->
                    <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Compare Statements</a>-->
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-pop" role="tab" aria-controls="settings">Insurance & Towing Details</a>
                    <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-rfcs" role="tab" aria-controls="settings">Towing Details</a>-->
                    <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-compare" role="tab" aria-controls="settings">Compare RFCs</a>-->
                    </div>
                </div>
                <div class="col-10">
                    <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                    <fieldset> <h5 style="color:red;">Client Details</h5></fieldset>
                    <div class="container" style="background-color:#c0c2c4;border-radius:25px;">
                        <form method="post" action="/new_client_qoutes">
                    {{csrf_field()}} 
                        <div class="row">
                        
                            <div class="form-group col-2">
                                <label for="proof_branch">First Name<span style="color:red;">&#42;</span></label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group col-2">
                                <label for="proof_image">Last Name<span style="color:red;">&#42;</span></label>
                                <input type="text" name="lastname" id="lastname" class="form-control" required>
                            </div>
                            <div class="form-group col-2">
                                <label for="proof_image">ID Number:</label>
                                <input type="text" name="id_number" id="id_number" class="form-control">
                            </div>
                            <div class="form-group col-3">
                                <label for="odb">DOB</label>
                                <input type="date" name="dob" id="odb" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-2">
                                <label for="proof_branch">Cell Number<span style="color:red;">&#42;</span></label>
                                <input type="text" name="mobile" id="mobile" class="form-control" required>
                            </div>
                            <div class="form-group col-2">
                                <label for="proof_image">Email Address:</label>
                                <input type="email" name="client_email" id="client_email" class="form-control">
                            </div>
                            <div class="form-group col-2">
                                <label for="proof_image">Street:</label>
                                <input type="text" name="street" id="street" class="form-control">
                            </div>
                            <div class="form-group col-2">
                                <label for="proof_image">Suburb:</label>
                                <input type="text" name="surburb" id="surburb" class="form-control">
                            </div>
                            <div class="form-group col-2">
                                <label for="proof_image">City:</label>
                                <input type="text" name="city" id="city"  class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-2">
                                    <label for="proof_image">Estimator<span style="color:red;">&#42;</span></label>
                                    <input type="text" name="estimator" id="estimator" class="form-control">
                            </div>
                            <div class="form-group col-3">
                                <label for="proof_image">Branch<span style="color:red;">&#42;</span></label>
                                <select name="branch" id="branch" class="form-control" required>
                                    <option value="">--Select Branch--</option>
                                    <option value="1">Selby</option>
                                    <option value="2">Longmeadow</option>
                                    <option value="3">The Glen</option>
                                </select>
                            </div>
                        </div><br>
                    </div><br>
                        <fieldset> <h5 style="color:red;">Vehicle Details</h5></fieldset>
                          <div class="container" style="background-color:#c0c2c4;border-radius:25px;">  
                            <div class="row">
                                <div class="form-group col-2">
                                    <label for="proof_branch">Registration<span style="color:red;">&#42;</span></label>
                                    <input type="text" name="registration" id="registration" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label for="proof_image">VIN:</label>
                                    <input type="text" name="vin_number" id="vin_number" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label for="proof_image">Engine No:</label>
                                    <input type="text" name="engine_number" id="engine_number" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label for="proof_image">Make:<span style="color:red;">&#42;</span></label>
                                    <input type="text" name="make" id="make" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label for="proof_image">Model:<span style="color:red;">&#42;</span></label>
                                    <input type="text" name="model" id="model" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label for="proof_image">Odometer:</label>
                                    <input type="text" name="odometer" id="odometer" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-2">
                                    <label for="proof_branch">Color</label>
                                    <input type="text" name="colour" id="colour" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label for="proof_image">Year:</label>
                                    <input type="text" name="year" id="year" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label for="proof_image">Booking Date:</label>
                                    <input type="date" name="booking" id="booking" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label for="proof_image">Quote Date:<span style="color:red;">&#42;</span></label>
                                    <input type="date" name="quote_date" id="quote_date" class="form-control">
                                </div>
                                
                            </div>
                          </div>  <br>
                        <div class="btn-group">
                            <input type="submit" id="client_vehicle" name="client_vehicle" class="btn btn-success float-right" value="Save">
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">..Compare Statement.</div>
                    <div class="tab-pane fade" id="list-pop" role="tabpanel" aria-labelledby="list-settings-list">
                    <fieldset> <h5 style="color:red;">Insurance Details</h5></fieldset>
                        <div class="container" style="background-color:#c0c2c4;border-radius:25px;">
                        <div class="row">
                            <div class="form-group col-2">
                                <label for="proof_image">Insurance Type<span style="color:red;">&#42;</span></label>
                                <select name="insurance_type" id="insurance_type" class="form-control">
                                    <option value="1">Private</option>
                                    <option value="2">Insurance</option>
                                    <option value="3">Dealership</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="proof_image" style="color:white;">Insurer Name</label>
                                <select name="insuror" id="insuror" class="form-control" disabled>
                                <option value="">Select Insurer</option>
                                @foreach($brokers as $broker)
                                  <option value="{{$broker->broker}}">{{$broker->broker}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="proof_image">Insurer Contact</label>
                                <input type="text" name="contact_number" id="contact_number" class="form-control" disabled>
                            </div>
                            <div class="form-group col-3">
                                <label for="proof_image">Insurer Email</label>
                                <input type="text" name="insurance_email" id="insurance_email" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-2">
                                <label for="proof_image">Claim Number</label>
                                <input type="text" name="claim_number" id="claim_number" class="form-control" disabled>
                            </div>
                            <div class="form-group col-4">
                                <label for="proof_image">Clerk Reference</label>
                                <input type="text" name="clerk_ref" id="clerk_ref" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="row">    
                            <div class="form-group col-3">
                                <label for="proof_image">Assessor</label>
                                <select name="assessor" id="assessor" class="form-control auto_assessor" disabled>
                                <option value="">Select Assessor</option>
                                @foreach($assessor as $asessor)
                                    <option value="{{$asessor->Names}}">{{$asessor->Names}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="proof_image">Assessor Email</label>
                                <input type="email" name="assessor_email" id="assessor_email" class="form-control" disabled>
                            </div>
                            <div class="form-group col-2">
                                <label for="proof_image">Assessor Contact</label>
                                <input type="text" name="assessor_no" id="assessor_no" class="form-control" disabled>
                            </div>
                            
                            <div class="form-group col-3">
                                <label for="proof_image">Assessor Company</label>
                                <input type="text" name="assessor_company" id="assessor_company" class="form-control" disabled>
                            </div>
                        </div>
                        </div><br>    
                        <fieldset> <h5 style="color:red;">Towing Details</h5></fieldset>
                        <div class="container" style="background-color:#c0c2c4;border-radius:25px;">
                        
                            <div class="row">
                                <div class="form-group col-2">
                                    <label for="proof_image">Towed?<span style="color:red;">&#42;</span></label>
                                    <select name="towed" id="towed" class="form-control">
                                    <option value="2">No</option>
                                    <option value="1">Yes</option>
                                    </select>    
                                </div>
                                <div class="form-group col-3">
                                    <label for="proof_image">Towed By?</label>
                                    <select name="towed_by" id="towed_by" class="form-control" required disabled>
                                        <option >Towed By</option>
                                        @foreach($towing_info as $tow)
                                            <option value="{{$tow->towing}}">{{$tow->towing}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                <div class="form-group col-2">
                                    <label for="proof_image">Contact</label>
                                    <input type="text" name="tow_contact_number" id="tow_contact_number" class="form-control" disabled>
                                </div>
                                <div class="form-group col-3">
                                    <label for="proof_image">Email</label>
                                    <input type="email" name="tow_email" id="tow_email" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="proof_image">Fee</label>
                                    <input type="text" name="tow_fee" id="tow_fee" class="form-control" disabled>
                                </div>
                                <div class="form-group col-3">
                                    <label for="proof_image">Status</label>
                                    <select name="towed_status" id="towed_status" class="form-control" required disabled>
                                        <option value="1">Open</option>
                                        <option value="2">Open & Auth</option>
                                        <option value="3">Closed</option>
                                    </select>
                                </div>
                            </div>
                            </div><br>    
                            <div class="btn-group">
                                <input type="submit" class="btn btn-success" name="all_info" id="all_info" value="Save">
                            </div>
                        
                    </form>
                    </div>
                    
                    <div class="tab-pane fade" id="list-compare" role="tabpanel" aria-labelledby="list-settings-list">Towing Details</div>
                    </div>

                </div>
                </div>
            </div>
@endsection            