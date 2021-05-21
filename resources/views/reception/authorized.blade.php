@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Authorized Quotations.</h4>
                <form class="form-inline float-right" method="GET" action="/search-archive">
                    <input type="text" id="archieve_key" name="archieve_key" class="form-control form-control-sm">
                    <input type="submit" class="btn btn-success btn-sm" style="margin-left:5px;"value="Search Archive">
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style="font-size:12px;">
                            <tr>
                                
                                <th>Reference</th>
                                <th>D.Capture</th>
                                <th>Client</th>
                                <th width="50px">ID Number</th>
                            <!--<th>DOB</th>-->
                                <th>Phone</th>
                                <th>Email</th>
                                <!--<th>Address</th>
                                <th>Insurance</th>-->
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
                                <!--<th>Address</th>
                                <th>Insurance</th>-->
                                <th>Registration</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody style="font-size:10px;">
                            @foreach($details as $client)
                                <tr>
                                       <td>{{$client->Key_Ref}}</td>
                                       <td>{{$client->Date}}</td>
                                       <td>{{$client->Fisrt_Name}} {{$client->Last_Name}}</td>
                                       <td>{{$client->id_number}}</td>
                                       <!--<td>{{$client->BirthDate}}</td>-->
                                       <td>{{$client->Cell_number}}</td>
                                       <td>{{$client->Email}}</td>
                                       <!--<td>{{$client->Address_1}}<br>{{$client->Address_2}}<br>{{$client->Address_3}}</td>
                                       <td>{{$client->Inserer}}</td>-->
                                       <td>{{$client->Reg_No}}</td>
                                       <td>{{$client->Make}}</td>
                                       <td>{{$client->Model}}</td>
                                       @if($client->status==1)
                                            <td><span class="badge" style="background:green;color:white;">Authorized</span></td>
                                         @elseif($client->Key_Ref!='')
                                         <td style="background-color:grey;color:white;">Quoted</td>
                                         @elseif($client->Key_Ref=='')    
                                         <td style="background-color:orange;color:white;">Quoted</td>
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