@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Stores.</h4>
                <a href="/print-customer-feedback" class="btn btn-secondary float-right" title="Print Customer Stats" target="_blank"><span class="fa fa-print"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>                                    
                                    <th>ID</th>
                                    <th>Reg No.</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Client</th>
                                    <th>Cell No.</th>
                                    <th>Order Placed By</th>
                                    <th>Order Date</th>
                                    <th>Supplier</th>
                                    <th>Supplier Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parts as $part)
                                <tr>
                                    <td>{{$part->Key_Ref}}</td>
                                    <td>{{$part->Reg_No}}</td>
                                    <td>{{$part->Make}}</td>    
                                    <td>{{$part->Fisrt_Name}} {{$part->Last_Name}}</td>                                
                                    <td>{{$part->Cell_number}}</td>
                                    <td>{{$part->Inserer}}</td>
                                    <td>{{$part->Claim_NO}}</td>
                                    <td><button class="btn-sm btn-success"><span class="badge">{{$part->count_track}}</span></button></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    
                                    
                                    <td>
                                        <div class="btn-group">
                                        <a href="#" class="btn btn-primary" data-id='' data-name='' title="View Client"><span class="fa fa-search"></span></a>
                                        
                                        </div>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    
                </div>
            </div>    
</div>
@endsection