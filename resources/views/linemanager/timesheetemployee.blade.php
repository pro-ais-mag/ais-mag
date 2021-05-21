@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">

                 <!-- ## ADD THE BACK BUTTON [ 20 MAY 2021 ] -->
                 <a href="javascript:history.go(-1)" class="btn btn-danger btn-sm" title="Back To Previous Location">Back</a>

                <center>
                    <h5 class="font-weight-bold text-primary"><u>Time Sheet : {{$user}} </u></h5> 
                    <h7><b>Date</b> <b  class="text-danger text-danger"> :{{$from}} - {{$to}} </b></h7>
                </center>

                <!--
                <h5 class="m-0 font-weight-bold text-primary text-center"><u>Time Sheet : {{$user}} </u></h5>
                <h7 class="m-0 text-danger text-danger text-center" style="margin-top:10px;"><b>Date  :{{$from}} - {{$to}} </b></h7> 
                 -->

                 <!-- ## ADD THE BACK BUTTON [ 20 MAY 2021 ] -->
                 <a class="btn btn-secondary float-right btn-sm user_timesheet" data-user="{{$user}}" data-from="{{$from}}" data-to="{{$to}}" href="/print-employee-timesheet/{{$user}}/{{$from}}/{{$to}}" target="_blank" title="Print Timesheet"><span class="fa fa-print"></span>Print General Work Timesheet</a>
                
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table">
                        
                            @php echo $table;@endphp

                        
                    </div>
                </div>
            </div>
</div>

@endsection