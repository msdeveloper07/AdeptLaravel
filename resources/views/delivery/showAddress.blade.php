@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li><a href="/delivery/{{$id}}/">Delivery</a></li>
            <li class="active"><a href="/showAddress/{{$id}}/">Address</a></li>
             <li><a href="/delivery/notes/{{$id}}/">Notes</a></li>   
            <li  ><a href="/delivery/lots/{{$id}}/">Select Lots To Be Delivered</a></li>
                 
             </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Delivery Address</h3>
                    <a class="btn btn-primary pull-right" href="/editAddress/{{$id}}/">Edit</a>
                </div><!-- /.box-header -->
                    
                 <div class="box-body">
                    
                       <div class="row">

                        <div class="col-md-9">
                            <div class="form-group">
                                <h4>Delivery Address </h4>
                            </div>
                        </div>
                         
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery Address 1</label>
                                <p class="form-control" readonly >{{$delivery->delivery_address_1}}</p>

                            </div>
                        </div>
                   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery Address 2</label>
                                <p class="form-control" readonly >{{$delivery->delivery_address_2}}</p>

                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery City</label>
                                <p class="form-control" readonly >{{$delivery->delivery_city}}</p>

                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery County</label>
                                <p class="form-control" readonly >{{$delivery->delivery_county}}</p>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery Postcode</label>
                                <p class="form-control" readonly >{{$delivery->delivery_postcode}}</p>

                            </div>
                        </div>
                      
                    </div>
                       <div class="row">

                        <div class="col-md-9">
                            <div class="form-group">
                                <h4>Collection Address </h4>
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Address Name</label>
                                <p class="form-control" readonly >{{$delivery->collection_address_name}}</p>

                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Address 1</label>
                                <p class="form-control" readonly >{{$delivery->collection_address_1}}</p>

                            </div>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Address 2</label>
                                <p class="form-control" readonly >{{$delivery->collection_address_2}}</p>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection City</label>
                                <p class="form-control" readonly >{{$delivery->collection_city}}</p>

                            </div>
                        </div>
                   </div>
                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Country</label>
                                <p class="form-control" readonly >{{$delivery->collection_country}}</p>

                            </div>
                        </div>
                 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Postcode</label>
                                <p class="form-control" readonly >{{$delivery->collection_postcode}}</p>

                            </div>
                        </div>
                      
                    </div>
                   



                </div><!-- /.box-body-->
             
            </div>
        </div>
     <div class="col-md-6">
        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">Delivery Lots</h3>
            </div><!-- /.box-header -->


            <div class='table-responsive'>
                <div class="col-md-12">
                     @if(count($delivery_lots)> 0)
                <table class="table table-hover table-bordered pull-left table-striped table-condensed admin-user-table">
                    <thead>
                        <tr>

                            <th>Lot Number</th>
                            <th>Delivery</th>
                            <th>Delivery Type</th>
                            <th>Item Name</th>
                            <th>Delivery Details</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($delivery_lots as $c)
                        <tr>
                         <?php  $lot_id = \App\Models\Lot::where('lot_id',$c->lot_id)->where('goodsin_id',$c->goodsin_id)->first();?>
                            <td  data-title="Lot Number"> {{$c->lot_id}} </td>
                            <td  data-title="Delivery Id">      {{$c->delivery_id}}   </td>
                            <td  data-title="Delivery Type">{{$c->delivery_type}}</td>
                           <td  data-title="Item Name">{{$lot_id->Items->item_name}}</td>
                            <td  data-title="Delivery Detail">{{$c->delivery_details}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                      @else
                    
                    <h3>Delivery Lots Are Not Available</h3>
                    @endif
            </div>
            </div>
 
        </div>
    </div>
    
</div>

@endsection