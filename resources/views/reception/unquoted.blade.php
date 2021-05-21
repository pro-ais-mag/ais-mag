@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Towed Quotations.</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-mb table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style="font-size:12px;">
                            <tr>
                                
                                <th>Reference</th>
                                <th>D.Capture</th>
                                <th>Client</th>
                                <th width="50px">ID Number</th>
                                <!--<th>DOB</th>-->
                                <th>Phone</th>
                                <th>Email</th>
                                <!--<th>Address</th>-->
                                <th>Insurance</th>
                                <th>Registration</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot style="font-size:12px;">
                            <tr>
                            <th>Reference</th>
                                <th>D.Capture</th>
                                <th>Client</th>
                                <th width="50px">ID Number</th>
                                <!--<th>DOB</th>-->
                                <th>Phone</th>
                                <th>Email</th>
                                <!--<th>Address</th>-->
                                <th>Insurance</th>
                                <th>Registration</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody style="font-size:12px;">
                            @foreach($details as $client)
                                <tr>
                                       <td>{{$client->Key_Ref}}</td>
                                       <td>{{$client->Date}}</td>
                                       <td>{{$client->Fisrt_Name}} {{$client->Last_Name}}</td>
                                       <td>{{$client->id_number}}</td>
                                       <!--<td>{{$client->BirthDate}}</td>-->
                                       <td>{{$client->Cell_number}}</td>
                                       <td>{{$client->Email}}</td>
                                       <!--<td>{{$client->Address_1}}<br>{{$client->Address_2}}<br>{{$client->Address_3}}</td>-->
                                       <td>{{$client->Inserer}}</td>
                                       <td>{{$client->Reg_No}}</td>
                                       <td>{{$client->Make}}</td>
                                       <td>{{$client->Model}}</td>
                                       @if($client->status==1)
                                            <td><span class="badge" style="background:green;color:white;">Authorized</span></td>
                                         @elseif($client->Ref !='')
                                         <td><span class="badge" style="background-color:grey;color:white;">Quoted</span></td>
                                         @elseif($client->Ref =='')    
                                         <td><span class="badge" style="background-color:orange;color:white;">Unquoted</span></td>
                                         @endif
                                    <td>
                                        <div class="btn-group">
                                            <!--<a class="btn btn-success" href="" title="Open Quotation">
                                                <span class="fa fa-folder-open"></span>
                                            </a>-->
                                            <a class="btn-sm btn-primary" href="/viewQuotation/{{$client->Key_Ref}}" style="margin-left:5px;" title="View Quotation">
                                                <span class="fa fa-search"></span>
                                            </a>     
                                                      
                                                 
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>            
                    </table>
                </div>
            </div>
        </div>        
@endsection