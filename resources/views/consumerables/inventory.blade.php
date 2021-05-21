@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
            
            <h4 class="m-0 font-weight-bold text-primary">Inventory Stock. - {{$branch_name}}</h4><br>
            <div class="row">
                <div class="btn-group float-right"> 
                    <select class="form-control form-control-sm change_branch" id="inventory_branch" name="inventory_branch" style="width:100px;">
                    <option value="all">All Stock</option>   
                    @foreach($branches as $branch)
                        <option value="{{substr($branch->branch_name,4)}}">{{substr($branch->branch_name,4)}}</option>
                    @endforeach
                    </select>
                    <a href="#" style="margin-left:5px;" class="btn btn-secondary btn-sm add_new_inventory"  title="Add New"><span class="fa fa-plus"></span></a>      
                </div>
            </div>    
            </div>    
                <div class="card-body">
                    <div class="row">
                                <div class="col-2" style="font-size:10px;">
                                    <div class="list-group" id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-all" role="tab" aria-controls="home">All Consumable Items</a>
                                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-live" role="tab" aria-controls="profile">Live Stock</a>
                                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-dead" role="tab" aria-controls="messages">Dead Stock</a>
                                    <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Compare Statements</a>-->
                                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-consumable-tools" role="tab" aria-controls="settings">Consumable Tools</a>
                                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-purchased" role="tab" aria-controls="settings">Purchased Tools</a>
                                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-paint" role="tab" aria-controls="settings">Paint Supplies</a>
                                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-equipment" role="tab" aria-controls="settings">Equipment</a>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="list-all" role="tabpanel" aria-labelledby="list-home-list">
                                        <h6 class="text-primary"><b>All Consumable Items.</b></h6>
                                            <div class="table-responsive table-sm">
                                                <table class="table table-bordered text-sm" id="dataTable" name="dataTable" style="font-size:12px;">
                                                    <thead>
                                                        <tr>
                                                            <th style="display:none;"></th>
                                                            <th>No.</th>
                                                            <th>Description</th>
                                                            <th>&nbsp;</th>
                                                            <th>Price</th>
                                                            <th>Quantity</th>
                                                            <th>Catergory</th>
                                                            <th>Supplier</th>
                                                            <th>Date Modified</th>
                                                            <th>&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no=1;@endphp
                                                        @foreach($all as $data)
                                                        <tr>
                                                            <td style="display:none;"><input type="hidden" name="all_id" id="all_id" value="{{$data->id}}"></td>
                                                            <td>{{$no}}</td>
                                                            <td>{{$data->description}}</td>
                                                            <td><img src="/stock_icon/{{$data->icon}}" width="40" height="40"/></td>
                                                            <td  width="120px"><input type="text" name="price{{$data->id}}" id="price{{$data->id}}" class="form-control form-control-sm" value="{{$data->price}}"></td>
                                                            <td  width="80px"><input type="text" class="form-control form-control-sm" name="quantity{{$data->id}}" id="quantity{{$data->id}}"  value="{{$data->quantity}}"></td>
                                                            <td><select class="form-control form-control-sm" name="catergory{{$data->id}}" id="catergory{{$data->id}}">
                                                                <option value="{{$data->catergory}}">{{$data->catergory}}</option>
                                                                <option value="Sundries">Sundries</option>
                                                                <option value="Paint Supplies">Paint Supplies</option>
                                                                <option value="Inhouse Stock">Inhouse Stock</option>
                                                                <option value="Waste Disposal">Waste Disposal</option>
                                                            </td>
                                                            <td>{{$data->supplier}}</td>
                                                            <td>{{$data->stock_date}}</td>
                                                            <td><a href="#" class="btn-primary btn-sm consu_func_save" title="Save" id="{{$data->id}}" data-id="{{$data->id}}"><span class="fa fa-save"></span></a></td>
                                                        </tr>        
                                                        @php $quantity = $quantity + $data->quantity;
                                                        $amount   = $amount + $data->price;
                                                        @endphp
                                                        @php $no++;@endphp    
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>R {{$amount}}</td>
                                                            <td># {{$quantity}}</td>
                                                            <td colspan="4">&nbsp;</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>    
                                        </div>
                                        <div class="tab-pane fade show" id="list-live" role="tabpanel" aria-labelledby="list-home-profile">
                                        <div class="table-responsive table-sm">
                                        <h6 class="text-primary"><b>Live Stock.</b></h6>
                                                <table class="table table-bordered text-sm" id="dataTable1" name="dataTable1" style="font-size:12px;">
                                                    <thead>
                                                        <tr>
                                                            <th style="display:none;"></th>
                                                            <th>No.</th>
                                                            <th>Description</th>
                                                            <th>&nbsp;</th>
                                                            <th>Price</th>
                                                            <th>Quantity</th>
                                                            <th>Catergory</th>
                                                            <th>Supplier</th>
                                                            <th>Date Modified</th>
                                                            <th>&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no=1;@endphp
                                                        @foreach($lives as $data)
                                                        <tr>
                                                            <td style="display:none;"><input type="hidden" name="all_id" id="all_id" value="{{$data->id}}"></td>
                                                            <td>{{$no}}</td>
                                                            <td>{{$data->description}}</td>
                                                            <td><img src="/stock_icon/{{$data->icon}}" width="40" height="40"/></td>
                                                            <td  width="120px"><input type="text" name="price{{$data->id}}" id="price{{$data->id}}" class="form-control form-control-sm" value="{{$data->price}}"></td>
                                                            <td  width="80px"><input type="text" class="form-control form-control-sm" name="quantity{{$data->id}}" id="quantity{{$data->id}}"  value="{{$data->quantity}}"></td>
                                                            <td><select class="form-control form-control-sm" name="catergory{{$data->id}}" id="catergory{{$data->id}}">
                                                                <option value="{{$data->catergory}}">{{$data->catergory}}</option>
                                                                <option value="Sundries">Sundries</option>
                                                                <option value="Paint Supplies">Paint Supplies</option>
                                                                <option value="Inhouse Stock">Inhouse Stock</option>
                                                                <option value="Waste Disposal">Waste Disposal</option>
                                                            </td>
                                                            <td>{{$data->supplier}}</td>
                                                            <td>{{$data->stock_date}}</td>
                                                            <td><a href="#" class="btn-primary btn-sm consu_func_save" id="{{$data->id}}" data-id="{{$data->id}}" title="Save"><span class="fa fa-save"></span></a></td>
                                                        </tr>        
                                                        @php $quantity = $quantity + $data->quantity;
                                                        $amount   = $amount + $data->price;
                                                        @endphp
                                                        @php $no++;@endphp    
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>R {{$amount}}</td>
                                                            <td># {{$quantity}}</td>
                                                            <td colspan="4">&nbsp;</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>    
                                        </div>
                                        <div class="tab-pane fade show" id="list-dead" role="tabpanel" aria-labelledby="list-home-profile">
                                        <h6 class="text-primary"><b>Dead Stock.</b></h6>
                                        <div class="table-responsive table-sm">
                                                <table class="table table-bordered text-sm" id="dataTable1" name="dataTable1" style="font-size:12px;">
                                                    <thead>
                                                        <tr>
                                                            <th style="display:none;"></th>
                                                            <th>No.</th>
                                                            <th>Description</th>
                                                            <th>&nbsp;</th>
                                                            <th>Price</th>
                                                            <th>Quantity</th>
                                                            <th>Catergory</th>
                                                            <th>Supplier</th>
                                                            <th>Date Modified</th>
                                                            <th>&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no=1;@endphp
                                                        @foreach($deads as $data)
                                                        <tr>
                                                            <td style="display:none;"><input type="hidden" name="all_id" id="all_id" value="{{$data->id}}"></td>
                                                            <td>{{$no}}</td>
                                                            <td>{{$data->description}}</td>
                                                            <td><img src="/stock_icon/{{$data->icon}}" width="40" height="40"/></td>
                                                            <td  width="120px"><input type="text" name="price{{$data->id}}" id="price{{$data->id}}" class="form-control form-control-sm" value="{{$data->price}}"></td>
                                                            <td  width="80px"><input type="text" class="form-control form-control-sm" name="quantity{{$data->id}}" id="quantity{{$data->id}}"  value="{{$data->quantity}}"></td>
                                                            <td><select class="form-control form-control-sm" name="catergory{{$data->id}}" id="catergory{{$data->id}}">
                                                                <option value="{{$data->catergory}}">{{$data->catergory}}</option>
                                                                <option value="Sundries">Sundries</option>
                                                                <option value="Paint Supplies">Paint Supplies</option>
                                                                <option value="Inhouse Stock">Inhouse Stock</option>
                                                                <option value="Waste Disposal">Waste Disposal</option>
                                                            </td>
                                                            <td>{{$data->supplier}}</td>
                                                            <td>{{$data->stock_date}}</td>
                                                            <td><a href="#" class="btn-primary btn-sm consu_func_save" id="{{$data->id}}" data-id="{{$data->id}}"title="Save"><span class="fa fa-save"></span></a></td>
                                                        </tr>        
                                                        @php $quantity = $quantity + $data->quantity;
                                                        $amount   = $amount + $data->price;
                                                        @endphp
                                                        @php $no++;@endphp    
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>R {{$amount}}</td>
                                                            <td># {{$quantity}}</td>
                                                            <td colspan="4">&nbsp;</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade show" id="list-consumable-tools" role="tabpanel" aria-labelledby="list-home-profile">
                                        <h6 class="text-primary"><b>Consumables Tools.</b></h6>
                                        <div class="table-responsive table-sm">
                                                <table class="table table-bordered text-sm" id="dataTable1" name="dataTable1" style="font-size:12px;">
                                                    <thead>
                                                        <th>No</th>
                                                        <th>Description</th>
                                                        <th>&nbsp;</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Catergory</th>
                                                        <th>Serial No.</th>
                                                        <th>Supplier</th>
                                                        <th>Date Modified</th>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>
                                                    </thead>
                                                    <tbody>
                                                    @php $c=1;@endphp
                                                    @foreach($consumable_tools as $dbrow)
                                                    <tr>
                                                        <td>{{$c}}</td>
                                                        <td>{{$dbrow->description}}</td>
                                                        <td><img src="/stock_icon/{{$dbrow->icon}}" width="40" height="40"/></td>
                                                        <td><input type="text" class="form-control form-control-sm" style="width:75px;" name="price{{$dbrow->id}}" id="price{{$dbrow->id}}" value="{{$dbrow->price}}"/></td>
                                                        <td><input type="text" class="form-control form-control-sm" style="width:75px;" name="quantity{{$dbrow->id}}" id="quantity{{$dbrow->id}}" value="{{$dbrow->quantity}}"/></td>
                                                        <td>
                                                        <select class="form-control form-control-sm" name="catergory{{$dbrow->id}}" id="catergory{{$dbrow->id}}" style="width:140px;">
                                                        <option value="{{$dbrow->catergory}}">{{$dbrow->catergory}}</option>
                                                        <option value="Sundries">Sundries</option>
                                                        <option value="Paint Supplies">Paint Supplies</option>
                                                        <option value="Inhouse Stock">Inhouse Stock</option>
                                                        <option value="Waste Disposal">Waste Disposal</option>
                                                        </select>
                                                        </td>
                                                        <td><input type="text" class="form-control form-control-sm" style="width:75px;" name="serial_no{{$dbrow->id}}" id="serial_no{{$dbrow->id}}" value="{{$dbrow->serial_no}}"/></td>
                                                        <td>{{$dbrow->supplier}}</td>
                                                        <td>{{$dbrow->stock_date}}</td>
                                                        <td><a href="#" class="btn btn-primary btn-sm consu_func_save" data-id="{{$dbrow->id}}" id="{{$dbrow->id}}"><span class="fa fa-save"></span></a></td>
                                                        <td><a href="#" class="btn btn-danger btn-sm consu_sell" data-desc="{{$dbrow->description}}" data-price="{{$dbrow->price}}" data-supp="{{$dbrow->supplier}}">Sell</a></td>
                                                        <!--<td><button class="btn btn-success btn-sm">Rent</button></td>-->
                                                    </tr>
                                                    @php $c++;@endphp
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                        </div>        
                                        </div>
                                        <div class="tab-pane fade show" id="list-purchased" role="tabpanel" aria-labelledby="list-home-profile">
                                        <h6 class="text-primary"><b>Purchased Stock.</b></h6>
                                        <div class="table-responsive table-sm">
                                                <table class="table table-bordered text-sm" id="dataTable1" name="dataTable1" style="font-size:12px;">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Full Names</th>
                                                            <th>ID Number</th>
                                                            <th>Contacts</th>
                                                            <th>Description</th>
                                                            <th>Price</th>
                                                            <th>Quantity</th>
                                                            <th>Supplier</th>
                                                            <th>Date Modified</th>
                                                            <th>&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $c=1;@endphp
                                                        @foreach($purchases as $dbrow)

                                                        <tr>
                                                        <td>{{$c}}</td>
                                                        <td>{{$dbrow->names}}</td>
                                                        <td>{{$dbrow->id_number}}</td>
                                                        <td>{{$dbrow->cell_number}}</td>
                                                        <td>{{$dbrow->description}}</td>
                                                        <td>{{$dbrow->amount}}</td>
                                                        <td>{{$dbrow->quantity}}</td>
                                                        <td>{{$dbrow->supplier}}</td>
                                                        <td>{{$dbrow->date}}</td>
                                                        <td><a href="/print-tools-purchase/{{$dbrow->id}}" target="_blank" class="btn btn-success btn-sm" title="Print"><span class="fa fa-print"></span> Print</a></td>
                                                        </tr>
                                                        @php $c++;@endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                        </div>        
                                        </div>
                                        <div class="tab-pane fade show" id="list-paint" role="tabpanel" aria-labelledby="list-home-profile">
                                        <div class="table-responsive table-sm">
                                                <table class="table table-bordered text-sm" id="dataTable1" name="dataTable1" style="font-size:12px;">
                                                  <thead>  
                                                    <tr>
                                                    
                                                        <th>No</th>
                                                        <th>Description</th>
                                                        <th>&nbsp;</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Size</th>
                                                        <th>Supplier</th>
                                                        <th>Date Modified</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                    
                                                  </thead>
                                                  <tbody>
                                                   @php $c=1;@endphp 
                                                   @foreach($paints as $dbrow) 
                                                  <tr>
                                                    <td>{{$c}}</td>
                                                    <td><input type="text" class="form-control form-control-sm" style="width:180px;" name="description{{$dbrow->id}}" id="description{{$dbrow->id}}" value="{{$dbrow->description}}"/></td>
                                                    <td><img src="/stock_icon/{{$dbrow->icon}}" width="40" height="40"/></td>
                                                    <td><input type="text" class="form-control form-control-sm" style="width:75px;" name="price{{$dbrow->id}}" id="price{{$dbrow->id}}" value="{{$dbrow->amount}}"/></td>
                                                    <td><input type="text" class="form-control form-control-sm" style="width:75px;" name="quantity{{$dbrow->id}}" id="quantity{{$dbrow->id}}" value="{{$dbrow->quantity}}"/></td>
                                                    <td>{{$dbrow->size}}</td>
                                                    <td>{{$dbrow->supplier}}</td>
                                                    <td>{{$dbrow->date_modified}}</td>
                                                    <td><a href="#" class="btn btn-primary btn-sm paint_func_save" id="{{$dbrow->id}}" data-id="{{$dbrow->id}}"><span class="fa fa-save"></span></a></td>
                                                  </tr>
                                                  @php $c++;@endphp
                                                  @endforeach
                                                  </tbody>  
                                                </table>
                                        </div>        
                                        </div>
                                        <div class="tab-pane fade show" id="list-equipment" role="tabpanel" aria-labelledby="list-home-profile">
                                        <div class="table-responsive table-sm">
                                                <table class="table table-bordered text-sm" id="dataTable1" name="dataTable1" style="font-size:12px;">
                                                  <thead>  
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Description</th>
                                                        <th>&nbsp;</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Catergory</th>
                                                        <th>Serial No.</th>
                                                        <th>Supplier</th>
                                                        <th>Date Modified</th>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                                                                
                                                  </thead>
                                                  <tbody>
                                                   @php $c=1;@endphp 
                                                   @foreach($equipments as $dbrow) 
                                                  <tr>
                                                  <td>{{$c}}</td>
                                                    <td>{{$dbrow->description}}</td>
                                                    <td><img src="/stock_icon/{{$dbrow->icon}}" width="40" height="40"/></td>
                                                    <td><input type="text" class="form-control form-control-sm" style="width:75px;" name="price{{$dbrow->id}}" id="price{{$dbrow->id}}" value="{{$dbrow->price}}"/></td>
                                                    <td><input type="text" class="form-control form-control-sm" style="width:75px;" name="quantity{{$dbrow->id}}" id="quantity{{$dbrow->id}}" value="{{$dbrow->quantity}}"/></td>
                                                    <td>
                                                    <select class="form-control form-control-sm" name="catergory{{$dbrow->id}}" id="catergory{{$dbrow->id}}" style="width:140px;">
                                                    <option value="{{$dbrow->catergory}}">{{$dbrow->catergory}}</option>
                                                    <option value="Sundries">Sundries</option>
                                                    <option value="Paint Supplies">Paint Supplies</option>
                                                    <option value="Inhouse Stock">Inhouse Stock</option>
                                                    <option value="Waste Disposal">Waste Disposal</option>
                                                    </select>
                                                    </td>
                                                    <td><input type="text" class="form-control form-control-sm" style="width:75px;" name="serial_no{{$dbrow->id}}" id="serial_no{{$dbrow->id}}" value="{{$dbrow->serial_no}}"/></td>
                                                    <td>{{$dbrow->supplier}}</td>
                                                    <td>{{$dbrow->stock_date}}</td>
                                                    <td><a href="#" class="btn btn-primary btn-sm consu_func_save" id="{{$dbrow->id}}" data-id="{{$dbrow->id}}"><span class="fa fa-save"></span></a></td>
                                                    <td><a class="btn btn-danger btn-sm consu_sell" href="#" data-desc="{{$dbrow->description}}" data-price="{{$dbrow->price}}" data-supp="{{$dbrow->supplier}}">Sell</a></td>
                                                    <!--<td><button class="btn btn-success btn-sm ">Rent</button></td>-->
                                                  </tr>
                                                  @php $c++;@endphp
                                                  @endforeach
                                                  </tbody>  
                                                </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>        
                    </div>
                </div>                

    </div>
@endsection