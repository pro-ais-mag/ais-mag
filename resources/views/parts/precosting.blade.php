@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Pre Costing Parts.</h4>

                 <!-- #### ADDING THE BACK BUTTONS [ 19 MAY 2021 ] -->
                 <br>
                <a href="javascript:history.go(-1)" class="btn btn-danger btn-sm" title="Back To Previous Location">Back</a>

                <form class="form-inline float-right" method="GET" action="/search-archive-precosting">
                    <input type="text" id="precosting_archieve_key" name="precosting_archieve_key" class="form-control form-control-sm">
                    <input type="submit" class="btn btn-success btn-sm" style="margin-left:5px;"value="Search Archive">
                </form>
            </div>
            <div class="card-body">
                
                <div class="row">
                <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:10px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Reg No.</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Client</th>
                                    <th>Cell No.</th>
                                    <!--<th>Photos</th>
                                    <th>Sec Photos</th>
                                    <th>Docs</th>
                                    <th>Notes</th> -->
                                    <th></th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php $count=1;@endphp
                                @foreach($precostings as $pre)
                                <tr>
                                    <td>{{$count}}</td>
                                    <td><a href="/view-precosting/{{$pre->Key_Ref}}">{{$pre->Key_Ref}}</a></td>
                                    <td>{{$pre->Reg_No}}</td>    
                                    <td>{{$pre->Make}}</td>                                
                                    <td>{{$pre->Model}}</td>
                                    <td>{{$pre->Fisrt_Name}} {{$pre->Last_Name}}</td>
                                    <td>{{$pre->Cell_number}}</td>
                                    
                                    <td>
                                        <div class="btn-group">
                                        <a href="/view-precosting/{{$pre->Key_Ref}}" class="btn btn-primary btn-sm" data-id='' data-name='' title="View Client"><span class="fa fa-search"></span></a>
                                        
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