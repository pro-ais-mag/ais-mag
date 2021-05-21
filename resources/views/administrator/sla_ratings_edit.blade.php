@extends('administrator')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">SLA Ratings - {{$name}}.</h4>
                <a class="btn btn-danger btn-sm" href="javascript:history.go(-1)" style="margin-top:10px;">Back</a>
            </div>
            <div class="card-body">
                
                <div class="row">
                            <!--NSR-->
                        <div class="card-sm shadow mb-1 col-3">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">NSR-Non Structural Repair.</h6>
                        <form action="#" method="POST" id="creation" >
                        {{csrf_field()}} 
                        </div>
                            <div class="card-body">

                            <div class="input-group sm" id="nsr_in_span">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">In.Labour</span>
                                </div>
                                    <input type="number" name="nsr_labour_in" id="nsr_labour_in" step="any" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" id="nsr_in_paint">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">In.Paint</span>
                                </div>
                                    <input type="number" name="nsr_paint_in" step="any" id="nsr_paint_in" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" id="nsr_in_paint">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Out.Labour</span>
                                </div>
                                    <input type="number" name="nsr_labour_out" step="any" id="nsr_labour_out" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" id="nsr_in_paint">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">In.Paint</span>
                                </div>
                                    <input type="number" name="nsr_paint_out" step="any" id="nsr_paint_out" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                                
                            
                        </div>
                    </div>
                    <!--End NSR-->
                    <!--ASR-->
                            <div class="card-sm shadow mb-1 col-3">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">ASR-Advance Structural Repair.</h6>
                        
                        
                        </div>
                            <div class="card-body">
                            
                            <div class="input-group sm" id="nsr_in_span">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">In.Labour</span>
                                </div>
                                    <input type="number" name="asr_labour_in" id="asr_labour_in" step="any" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" id="nsr_in_paint">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">In.Paint</span>
                                </div>
                                    <input type="number" name="asr_paint_in" step="any" id="asr_paint_in" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" id="nsr_in_paint">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Out.Labour</span>
                                </div>
                                    <input type="number" name="nsr_labour_out" step="any" id="nsr_labour_out" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" id="nsr_in_paint">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">In.Paint</span>
                                </div>
                                    <input type="number" name="nsr_paint_out" step="any" id="nsr_paint_out" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            
                        </div>
                    </div>
                    <!--End ASR-->
                    <!--MSR-Major Structural Reapir-->
                    <div class="card-sm shadow mb-1 col-3">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">MSR-Major Structural Reapir.</h6>
                        
                        
                        </div>
                            <div class="card-body">
                            
                                                   
                            <div class="input-group sm" id="nsr_in_span">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">In.Labour</span>
                                </div>
                                    <input type="number" name="nsr_labour_in" id="nsr_labour_in" step="any" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" id="nsr_in_paint">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">In.Paint</span>
                                </div>
                                    <input type="number" name="nsr_paint_in" step="any" id="nsr_paint_in" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" id="nsr_in_paint">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Out.Labour</span>
                                </div>
                                    <input type="number" name="nsr_labour_out" step="any" id="nsr_labour_out" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" id="nsr_in_paint">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">In.Paint</span>
                                </div>
                                    <input type="number" name="nsr_paint_out" step="any" id="nsr_paint_out" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            
                        </div>
                    </div>
                    <!--End MSR-Major Structural Reapir-->
                    <!--SR-Specialised Repair-->
                            <div class="card-sm shadow mb-1 col-3">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">SR-Specialised Repair.</h6>
                        
                        
                        </div>
                            <div class="card-body">
                            
                            <div class="input-group sm" id="nsr_in_span">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">In.Labour</span>
                                </div>
                                    <input type="number" name="nsr_labour_in" id="nsr_labour_in" step="any" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" id="nsr_in_paint">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">In.Paint</span>
                                </div>
                                    <input type="number" name="nsr_paint_in" step="any" id="nsr_paint_in" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" id="nsr_in_paint">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">Out.Labour</span>
                                </div>
                                    <input type="number" name="nsr_labour_out" step="any" id="nsr_labour_out" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            <div class="input-group sm" id="nsr_in_paint">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm" id="basic-addon1" style="height:32px;">In.Paint</span>
                                </div>
                                    <input type="number" name="nsr_paint_out" step="any" id="nsr_paint_out" class="form-control form-control-sm"  aria-describedby="basic-addon1" style="margin-bottom:10px;">
                            </div>
                            
                        </div>
                    </div>
                    <!--End SR-Specialised Repair-->
                </div>
            </div>
</div>
@endsection                