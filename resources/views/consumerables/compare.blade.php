@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Price Comparison</h4>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Supplier</th>
                                    <th>Description</th>
                                    <th>Price Per Unit</th>
                                    <th>Quantity</th>
                                    <th>Branch</th>
                                    <th>Date</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php $count=1;@endphp 
                                @foreach($consumerables as $compare)
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{$compare->supplier}}</td>
                                    <td>{{$compare->description}}</td>
                                    <td>{{$compare->price}}</td>
                                    <td>{{$compare->quantity}}</td>
                                    <td>{{$compare->branch}}</td>
                                    <td>{{$compare->stock_date}}</td>
                                    
                                                                    
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