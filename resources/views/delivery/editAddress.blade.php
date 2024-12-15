@extends('layouts.master')

@section('content')


<div class="row">
    <div class="col-md-12">
        
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li ><a href="/delivery/{{$id}}">Delivery</a></li>
            <li  class="active"><a href="/showAddress/{{$id}}/">Address</a></li>
                <li><a href="/delivery/notes/{{$id}}/">Notes</a></li>
               <li ><a href="/delivery/lots/{{$id}}/">Select Lots To Be Delivered</a></li>
              
             </ul>
        </div>
    </div> 
</div>

<div class="row">
     <div class="col-md-6">
    <form  role="form" action="/updateAddress/{{$id}}" name='user_form' id='user_form' method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
      


       
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Address</h3>
                </div><!-- /.box-header -->

                 <div class="box-body">
                    
                        <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <h4> Delivery Address </h4>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery Address 1</label>
                                <input type="text" placeholder="Enter Address" id="delivery_address_1" name="delivery_address_1" class="form-control "  value="{{$delivery->delivery_address_1}}">

                            </div>
                        </div>
                   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery Address 2</label>
                                <input type="text" placeholder="Enter Address 2" id="delivery_address_2" name="delivery_address_2" class="form-control "  value="{{$delivery->delivery_address_2}}">
                                                                                                                                                                                                
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery City</label>
                                <input type="text" placeholder="Enter City" id="delivery_city" name="delivery_city" class="form-control "  value="{{$delivery->delivery_city}}">

                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery County</label>
                                <input type="text" placeholder="Enter County" id="delivery_county" name="delivery_county" class="form-control "  value="{{$delivery->delivery_county}}">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery Postcode</label>
                                <input type="text" placeholder="Enter Postcode" id="delivery_postcode" name="delivery_postcode" class="form-control "  value="{{$delivery->delivery_postcode}}">

                            </div>
                        </div>
                    </div>

                        <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <h4>Collection Address </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Address Name</label>
                                <input type="text" placeholder="Enter Address Name" id="collection_address_name" name="collection_address_name" class="form-control "  value="@if($delivery->collection_address_name!=''){{$delivery->collection_address_name}}@else Adept ESD  @endif">
                                                                                                                                                                    
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Address 1</label>
                                <input type="text" placeholder="Enter Address" id="collection_address_1" name="collection_address_1" class="form-control "  value="@if($delivery->collection_address_1!=''){{$delivery->collection_address_1}}@else Unit 6 Butterly Avenue @endif">

                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Address 2</label>
                                <input type="text" placeholder="Enter Address 2" id="collection_address_2" name="collection_address_2" class="form-control "  value="@if($delivery->collection_address_2!=''){{$delivery->collection_address_2}}@else Questor @endif">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection City</label>
                                <input type="text" placeholder="Enter City" id="collection_city" name="collection_city" class="form-control "  value="@if($delivery->collection_city!=''){{$delivery->collection_city}}@else Dartford @endif">

                            </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Country</label>
                                <input type="text" placeholder="Enter Country" id="collection_country" name="collection_country" class="form-control "  value="@if($delivery->collection_country!=''){{$delivery->collection_country}}@else Kent @endif">

                            </div>
                        </div>
                 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Postcode</label>
                                <input type="text" placeholder="Enter Postcode" id="collection_postcode" name="collection_postcode" class="form-control "  value="@if($delivery->postcode!=''){{$delivery->collection_postcode}}@else DA1 1JG @endif">

                            </div>
                        </div>
                    </div>

                </div><!-- /.box-body-->
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
      
    </form>
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
                          <?php  $lot_id = \App\Models\Lot::where('lot_id',$c->lot_id)->where('job_id',$c->job_id)->first();?>
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