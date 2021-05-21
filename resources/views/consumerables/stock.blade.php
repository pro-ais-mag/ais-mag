@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Stock List</h4>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:10px;">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Catergory</th>
                                    <th>Quantity</th>
                                    <th>Amount Per Unit</th>
                                    <th>Supplier</th>
                                    <th>Date</th>
                                    <th>Branch</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stocks as $stock)
                                <tr>
                                    <td>{{$stock->description}}</td>
                                    <td>{{$stock->catergory}}</td>
                                    <td>{{$stock->quantity}}</td>
                                    <td>{{$stock->price}}</td>
                                    <td>{{$stock->supplier}}</td>
                                    <td>{{$stock->stock_date}}</td>
                                    <td>{{$stock->branch}}</td>
                                    <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-success btn-sm add_stock" data-id="{{$stock->id}}" data-quantity="{{$stock->quantity}}" data-decription="{{$stock->description}}" data-catergory="{{$stock->catergory}}" data-price="{{$stock->price}}" data-supplier="{{$stock->supplier}}" data-date="{{$stock->stock_date}}"><span class="fa fa-plus"></span></a>
                                        <a href="#" class="btn btn-danger btn-sm minus_stock" data-id="{{$stock->id}}" data-quantity="{{$stock->quantity}}" data-decription="{{$stock->description}}" data-catergory="{{$stock->catergory}}" data-price="{{$stock->price}}" data-supplier="{{$stock->supplier}}" data-date="{{$stock->stock_date}}" style="margin-left:5px;"><span class="fa fa-minus"></span></a> 
                                    </div>
                                    </td>                                
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
</div>

<!--Add Item Order Stock-->
<div class="modal fade" id="addItemkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="font-size:10px;">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;font-size:10px;">Add Item To Order</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="/consumerable-order-list-add">
          {{csrf_field()}}
            <input type="hidden" name="order_no" id="order_no">
             
          <div class="form-group">
          <label for="description_add">Description:</label>
            <input type="text" id="description_add" name="description_add" class="form-control form-control-sm">
          </div>
          <div class="form-group">
          <label for="quan_add">Quantity:</label>
            <input type="number" id="quan_add" name="quan_add" class="form-control form-control-sm"> 
          </div> 
          <div class="form-group">
          <label for="comment_add">Comment:</label>
            <input type="text" id="comment_add" name="comment_add" class="form-control form-control-sm"> 
          </div>
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success btn-sm" value="+Add Item">
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection            