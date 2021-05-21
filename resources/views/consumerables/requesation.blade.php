@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
    
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="card shadow mb-4">
            <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Requesation Board. - {{$username}}</h4><br>
                <div class="row">
                    <div class="btn-group float-right"> 
                        <!--<a href="#" style="margin-left:5px;" class="btn btn-secondary btn-sm" title="Add New"><span class="fa fa-plus"></span></a>      -->
                    </div>
                </div>
            </div>
            <div class="card-body">
            @php echo $ui;@endphp
            </div>
</div>
@endsection


