@extends('administrator')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Billing Feature.</h4>
                <a class="btn btn-success btn-sm float-right create_branch" data-id="" href="#" title="Add Branch"><span class="fa fa-plus"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    
                                    <th>No.</th>
                                    <th>Broker</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>VAT No.</th>
                                    <th>Place</th>
                                    <th>Address</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count=1;@endphp
                               
                              @foreach($brokers as $broker)
                                <tr>
                                
                                    <td>{{$count}}</td>
                                    <td><b>{{$broker->broker}}</b></td>
                                    <td>{{$broker->contact}}</td>
                                    <td>{{$broker->email}}</td>
                                    <td>{{$broker->vat}}</td>
                                    <td>{{$broker->place}}</td>
                                    <td>{{$broker->address}}</td>
                                    <td>
                                    <div class="btn-group">
                                        
                                        <a href="/ais-sla-ratings-edit/{{$broker->id}}" class="btn btn-primary btn-sm" title="Edit SLA Ratings"><span class="fa fa-search"></span></a> 
                                    </div>
                                    </td>                                
                                </tr>
                               
                                @php $count++;@endphp
                                @endforeach 
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
</div>
@endsection