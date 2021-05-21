@extends((Auth::user()->position == 'Administrator') ? 'administrator' : 'alluser')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-danger center">Consumables.</h4>
                <a href="#" class="btn btn-primary float-right" title="Print Consumerables"><span class="fa fa-print"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Descriprion</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Received By</th>
                        <th scope="col">Date</th>
                        <th scope="col">Branch</th>
                        <th scope="col">Amount Per Unit</th>
                        <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($consumerables as $consumer)
                        <tr>
                            <td>{{$consumer->description}}</td>
                            <td>{{$consumer->quantity}}</td>
                            <td>{{$consumer->reciever}}</td>
                            <td>{{$consumer->date2}}</td>
                            <td>{{$consumer->branch}}</td>
                            <td>{{number_format($consumer->price,2)}}</td>
                            <td>{{number_format($consumer->price * $consumer->quantity,2)}}</td>
                        </tr>
                        @php $total += $consumer->price * $consumer->quantity;@endphp
                        @endforeach
                        <tr><td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>Total</b></td>
                            <td><b>{{number_format($total,2)}}</b></td>
                        </tr>
                        <tr><td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>Sundries</b></td>
                            <td><b>
                            @php $sundry_total=0;@endphp
                            @foreach($sundry_info as $sundry)
                                @php
                                $sundry_total+=(($sundry->Part*(1+($sundry->Percent/100)))*$sundry->Quantity);          
                                $sun=$sundry->ShopSup;    
                                @endphp
                            @endforeach
                                {{number_format(($sundry_total *($sun/100)),2)}}
                            </b></td>
                        </tr>
                        <tr><td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>Paint Supplies</b></td>
                            <td><b>
                                    @foreach($paintRate as $rate)
                                        @php $paint_rate=$rate->Paint;@endphp
                                    @endforeach
                                    @foreach($consus as $con)
                                       @php $consu=$con->PaintSup;@endphp
                                    @endforeach
                                    {{number_format(($paintTotal*$paint_rate*($consu/100)),2)}}
                            </b></td>
                        </tr>
                        <tr><td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>Waste Disposal</b></td>
                            <td><b>{{number_format(80,2)}}</b></td>
                        </tr>
                        <tr><td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>Allowed</b></td>
                            <td><b>{{number_format(($sundry_total*($sun/100))+($paintTotal*$paint_rate*($consu/100))+80,2)}}</b></td>
                        </tr>
                    </tbody>
                    </table>
                   
                </div>
            </div>    
</div>

<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-danger center">Labour.</h4>
                <a href="#" class="btn btn-primary float-right" title="Print Labor"><span class="fa fa-print"></span></a>
            </div>
            <div class="card-body">
                
                <div class="row">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Labor</th>
                        <th scope="col">Allowed Time</th>
                        <th scope="col">Spent Time</th>
                        <th scope="col">Allowed Amount</th>
                        <th scope="col">Spent Amount</th>
                        <th scope="col">Saved Amount</th>
                        <th scope="col">Lost Amount</th>
                        </tr>
                    </thead>
                    <tfoot class="tfoot-dark">
                        <tr>
                            <td><b>Totals:</b></td>
                            <td><b>V_allowed_time</b></td>
                            <td><b>v_Spent_time</b></td>
                            <td><b>v_allowed_amount</b></td>
                            <td><b>v_spent_amount</b></td>
                            <td><b>v_saved_amount</b></td>
                            <td><b>v_lost_amount</b></td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>STRIPPING (R+R)</td>
                            <td>{{number_format($quotation_test['strp'],2)}} Hours</td>
                            <td>{{number_format($time['strp'],2)}} Hours</td>
                            <td>R </td>
                            <td>R </td>
                            <td style=>R </td>
                            <td style="">R </td>
                        </tr>
                        <tr>
                            <td>PAINT</td>
                            <td> {{number_format($quotation_test['pnt'],2)}} Hours</td>
                            <td> Hours</td>
                            <td>R </td>
                            <td>R </td>
                            <td style="">R </td>
                            <td style="">R </td>
                        </tr>
                        <tr>
                            <td>PANEL</td>
                            <td> {{number_format($quotation_test['pnel'],2)}} Hours</td>
                            <td> Hours</td>
                            <td>R </td>
                            <td>R </td>
                            <td style="">R </td>
                            <td style="">R </td>
                        </tr>
                        
                        <tr>
                            <td>MECHANICAL</td>
                            <td> {{number_format($quotation_test['mech'],2)}} Hours</td>
                            <td> Hours</td>
                            <td>R </td>
                            <td>R </td>
                            <td style="">R </td>
                            <td style="">R </td>
                        </tr>            
                        <tr>
                            <td>OUTWORK</td>
                            <td>{{$quotation_test['out']}} Hours</td>
                            <td> Hours</td>
                            <td>R </td>
                            <td>R </td>
                            <td style="">R </td>
                            <td style="">R </td>
                        </tr>
                        <tr>
                            <td>POLISHING</td>
                            <td>{{number_format(0,2)}} Hours</td>
                            <td> Hours</td>
                            <td>R </td>
                            <td>R </td>
                            <td style="">R </td>
                            <td style="">R </td>
                        </tr>
                        <tr>
                            <td>CLEANING</td>
                            <td> {{number_format(2,2)}}Hours</td>
                            <td> Hours</td>
                            <td>R </td>
                            <td>R </td>
                            <td style="">R </td>
                            <td style="">R </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>    
</div>

@endsection