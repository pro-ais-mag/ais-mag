@extends('quotations')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Client Rates - {{$key}}</h4>
            </div>
            <div class="card-body">
            <form method="GET" action="/client-rate-edit">
                <input type="hidden" id="key" name="key" value="{{$key}}">
                {{csrf_field()}}
                @if($rate_details->count()>0) 
                @foreach($rate_details as $rate)
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_labor">Labour:</label>
                        <input type="text" class="form-control form-control-sm" id="client_labor" name="client_labor" value="{{$rate->labour}}">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_paint">Paint:</label>
                        <input type="text" class="form-control form-control-sm" id="client_paint" name="client_paint" value="{{$rate->Paint}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_strip">Strip:</label>
                        <input type="text" class="form-control form-control-sm" id="client_strip" name="client_strip" value="{{$rate->Strip}}">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_frame">Frame:</label>
                        <input type="text" class="form-control form-control-sm" id="client_frame" name="client_frame" value="{{$rate->Frame}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_sundries">Sundries:</label>
                        <input type="text" class="form-control form-control-sm" id="client_sundries" name="client_sundries" value="{{$rate->ShopSup}}">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_paint_supplies">Paint Supplies:</label>
                        <input type="text" class="form-control form-control-sm" id="client_paint_supplies" name="client_paint_supplies" value="{{$rate->PaintSup}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_vat">VAT:</label>
                        <input type="text" class="form-control form-control-sm" id="client_vat" name="client_vat" value="{{$rate->vat}}">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_covid">COVID - 19</label>
                        <input type="text" class="form-control form-control-sm" id="client_covid" name="client_covid" value="{{$rate->covid}}">
                    </div>
                </div>
                
                @endforeach
                @else
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_labor">Labour:</label>
                        <input type="text" class="form-control form-control-sm" id="client_labor" name="client_labor" value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_paint">Paint:</label>
                        <input type="text" class="form-control form-control-sm" id="client_paint" name="client_paint" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_strip">Strip:</label>
                        <input type="text" class="form-control form-control-sm" id="client_strip" name="client_strip" value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_frame">Frame:</label>
                        <input type="text" class="form-control form-control-sm" id="client_frame" name="client_frame" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_sundries">Sundries:</label>
                        <input type="text" class="form-control form-control-sm" id="client_sundries" name="client_sundries" value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_paint_supplies form-control-sm">Paint Supplies:</label>
                        <input type="text" class="form-control" id="client_paint_supplies" name="client_paint_supplies" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="client_vat">VAT:</label>
                        <input type="text" class="form-control form-control-sm" id="client_vat" name="client_vat" value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="client_covid">COVID - 19</label>
                        <input type="text" class="form-control form-control-sm" id="client_covid" name="client_covid" value="350.00">
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-sm float-right" value="Edit Rates">
                </div>
            </div>
        </form>
</div>
@endsection                