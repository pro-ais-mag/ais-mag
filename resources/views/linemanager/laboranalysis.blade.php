@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Labour Analysis.</h4>
                <a class="btn btn-info float-right add_item_stock" data-id="" href="#" title="Add To Order"><span class="fa fa-plus"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#No.</th>
                                    <th>Reference</th>
                                    <th></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                             @php $count=1;@endphp
                             @foreach($jobs as $job)
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{$job->Key_Ref}}</td>
                                    <td>
                                    <div class="btn-group">
                                        <a href="/line-manager-analysis-view/{{$job->Key_Ref}}" class="btn btn-primary" title="View"><span class="fa fa-search"></span></a>
                                        <a href="/print-line-manager/{{$job->Key_Ref}}" style="margin-left:5px;" class="btn btn-success" data-id="" title="Print Timesheet"><span class="fa fa-print"></span></a> 
                                        <a href="/line-manager-sms/{{$job->Key_Ref}}" style="margin-left:5px;" class="btn btn-info" data-id="" title="W.I.P"><span class="fa fa-comments"></span></a>
                                        <a href="/line-manager-notes/{{$job->Key_Ref}}" style="margin-left:5px;" class="btn btn-warning" data-id="" title="Notes"><span class="fa fa-edit"></span></a>
                                        <a href="/line-manager-docs/{{$job->Key_Ref}}" style="margin-left:5px;" class="btn btn-secondary" data-id="" title="Docs"><span class="fa fa-paperclip"></span></a>
                                        <a href="/line-manager-photos/{{$job->Key_Ref}}" style="margin-left:5px;" class="btn btn-danger" data-id="" title="Addtionals Photos"><span class="fa fa-camera"></span></a>
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