@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Final Stages.</h4>
                <form class="form-inline float-right" method="GET" action="/search-archive-final-stage">
                    <input type="text" id="archieve_key" name="archieve_key" class="form-control form-control-sm">
                    <input type="submit" class="btn btn-success btn-sm" style="margin-left:5px;"value="Search Archive">
                </form>
                
            </div>
            <div class="card-body">
                
                <div class="row">
                <div class="table-responsive ">
                        <table class="table table-bordered table=sm" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead style="font-size:12px;">
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Cell Number</th>
                                    <th>Registration</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Estimator</th>
                                    <th>Assessor</th>
                                    <th>Insurer</th>
                                    <th>Date</th>
                                    <th>Claim</th>
                                    
                                </tr>
                            </thead>
                            <tbody style="font-size:10px;">
                                @php $i=0;@endphp    
                                @foreach($approved as $approve)
                                <tr>
                                                                    
                                    <td><a href="/final-stage-client/{{$approve->Key_Ref}}">{{$approve->Key_Ref}}</a></td>
                                    <td>{{$approve->Fisrt_Name}}</td>
                                    <td>{{$approve->Cell_number}}</td>
                                    <td>{{$approve->Reg_No}}</td>
                                    <td style="width:44px;">{{$approve->Make}}</td>
                                    <td>{{$approve->Model}}</td>
                                    <td style="width:44px;">{{$approve->Estimator}}</td>
                                    <td>{{$approve->Assessor}}</td>
                                    <td>{{$approve->Inserer}}</td>
                                    <td>{{$approve->Date}}</td>
                                    <td>{{$approve->Claim_NO}}</td>
                                    <!--<td style="width:44px;"></td>-->
                                    <!--<td style="width:44px;"></td>
                                    <td style="width:44px;"></td>
                                    <td style="width:44px;"></td>
                                    <td style="width:44px;"></td>
                                    <td style="width:44px;"></td>
                                    <td style="width:44px;"></td>-->
                                    <!--<td></td>-->
                                    
                                    <!--<td><button class="btn btn-secondart btn-sm"><span style='font-size:8px' class='fa fa-pencil'></span></button></td>-->
                                    
                                    <!--<td>
                                        <div class="btn-group">
                                        <a href="/final-stage-client/{{$approve->Key_Ref}}" class="btn btn-primary btn-sm" title="Open File Stage."><span class="fa fa-search"></span></a>
                                        
                                        </div>
                                    </td>-->
                                    
                                </tr>    
                                    @php $i++;@endphp
                                    @endforeach
                                    
                                
                                
                            </tbody>

                        </table>
                    </div>
                    
                </div>
            </div>    
</div>
@endsection