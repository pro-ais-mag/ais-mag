@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'quotations')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Proforma Invoice.</h4>
                <a href="#" class="btn btn-secondary float-right" style="margin-right:5px;" title="Print Proforma"><span class="fa fa-print" target="_blank"></span></a>
            </div>
            <div class="card-body">
            <form method="POST" action="">
            <div class="row">
                    <div class="form-group col-6">
                        <label for="pro_storage">Storage Days:</label>
                        <input type="text" class="form-control" id="pro_storage" name="pro_storage" value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="pro_admin">Admin Days:</label>
                        <input type="text" class="form-control" id="pro_admin" name="pro_admin" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="pro_security">Security Days:</label>
                        <input type="text" class="form-control" id="pro_security" name="pro_security" value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="pro_towing_fee">Towing Fee R:</label>
                        <input type="text" class="form-control" id="pro_towing_fee" name="pro_towing_fee" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="pro_release_fee">Release Fee R:</label>
                        <input type="text" class="form-control" id="pro_release_fee" name="pro_release_fee" value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="pro_discount">Discount %:</label>
                        <input type="text" class="form-control" id="pro_discount" name="pro_discount" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="pro_paid">Paid:</label>
                        <select name="pro_paid" id="pro_paid" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="pro_payment">Payment Method:</label>
                        <select name="pro_payment" id="pro_payment" class="form-control">
                            <option value="cash">Cash</option>
                            <option value="eft">EFT</option>
                            <option value="card">Card</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="comments">Comments:</label>
                            <textarea class="form-control" row="5" id="comments" name="comments"></textarea>
                    </div>        
                </div>
                <div class="row">
                    <div class="btn-group">
                        <input type="submit" id="save" name="save" value="Save" class="btn btn-success float-right">
                            
                    </div>        
                </div>

            </form>
            </div>
</div>              
@endsection