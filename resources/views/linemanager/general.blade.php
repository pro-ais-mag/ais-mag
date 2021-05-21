@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary"></h4>
                <a class="btn btn-secondary float-right" data-id="" href="#" title="Print Worksheet"><span class="fa fa-print"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Place</th>
                                    <th>Started</th>
                                    <th>Finished</th>
                                    <th>Time Taken</th>
                                    <th>Time Remaining</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php echo $table;@endphp                    
                                                                
                               
                             
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
</div>
@endsection