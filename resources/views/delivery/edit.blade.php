@extends('layouts.master')

@section('content')


<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li  class="active"><a href="/delivery/{{$id}}">Delivery</a></li>
                <li ><a href="/showAddress/{{$id}}">Address</a></li>
                  <li ><a href="/delivery/notes/{{$id}}/">Notes</a></li>
                <li ><a href="/delivery/lots/{{$id}}/">Select Lots To Be Delivered</a></li>
                 
            </ul>
        </div><!-- nav-tabs-custom -->
    </div><!-- /.col -->
</div>

<div class="row">
    <div class="col-md-6">
        <form  role="form" action="/delivery/{{$id}}" name='user_form' id='user_form' method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="_method" value="PUT">


           
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Delivery</h3>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label  for="InputTitle">Delivery No.</label>
                                    <input class="form-control" name="job_delivery_id" id="job_delivery_id"  for="InputTitle" value="{{$delivery->job_delivery_id}}" readonly />

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Client Name</label>
                                    <p name="client_id" id="client_id" class="form-control"  value=""readonly>{{$delivery->Clientname->client_name}}</p>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Good In Number</label>
                                    <input name="goodsin_id" id="goodsin_id" class="form-control" value="{{$delivery->goodsin_id}}" readonly>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Transport Order Date</label>
                                    <input type="text" placeholder="Transport Order date" id="transport_order_date" name="transport_order_date" class="form-control "  value="{{\App\Libraries\ZnUtilities::format_date($delivery->transport_order_date,10)}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Transport Company Name</label>
                                    <select name="transport_company_id" id="transport_company_id" class="form-control ">
                                        <option value="">Please Select</option>
                                        @foreach($transport_company as $u)

                                        <option  {{$u->id==$delivery->transport_company_id?'selected="selected"':''}} value="{{$u->id}}">{{$u->company_name}} </option>
                                        @endforeach


                                    </select>    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Type Of Vehicle</label>
                                        <select name="vehicle_type_id" id="vehicle_type_id" class="form-control ">
                                            <option value="">Please Select</option>
                                              @foreach($vehicletype as $u)

                                              <option  {{$u->id==$delivery->vehicle_type_id?'selected="selected"':''}} value="{{$u->id}}">{{$u->vehicle_type}} </option>
                                              @endforeach
                                        </select>    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Approximate Weight</label>
                                    <input type="text" placeholder="Approximate Weight"  id="approximate_weight" name="approximate_weight" class="form-control "  value="{{$delivery->approximate_weight}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Collection Date</label>
                                    <input type="text"  placeholder="Collection Date" id='collection_date' name="collection_date" class="form-control "  value="{{\App\Libraries\ZnUtilities::format_date($delivery->collection_date,10)}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Delivery Date</label>
                                    <input type="text"  placeholder="Delivery Date" id="delivery_date" name="delivery_date" class="form-control "  value="{{\App\Libraries\ZnUtilities::format_date($delivery->delivery_date,10)}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Collection Time</label>
                                    <input type="text"  placeholder="Collection Time" id='collection_time' name="collection_time" class="form-control "  value="{{$delivery->collection_time}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Delivery Time</label>
                                    <input type="text"  placeholder="Delivery Time" id="delivery_time" name="delivery_time" class="form-control "  value="{{$delivery->delivery_time}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Agreed Price</label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gbp"></i></span>
                                        <input type="text" placeholder="Agreed Price" id="agreed_price" name="agreed_price" class="form-control "  value="{{$delivery->agreed_price}}">
                                    </div>
                                </div>
                            </div></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Site Contact Details</label>
                                    <textarea  placeholder="Site Contact Details" id="site_contact_details" name="site_contact_details" class="form-control "  value="">{{$delivery->site_contact_details}}</textarea>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Damage Out</label>
                                    <textarea placeholder="Damage Out" id="damage_out" name="damage_out" class="form-control "  value="">{{$delivery->damage_out}}</textarea>

                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Invoice Value</label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gbp"></i></span>
                                        <input type="text" placeholder="Invoice value" id="invoice_value" name="invoice_value" class="form-control "  value="{{$delivery->invoice_value}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Loading Charge</label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gbp"></i></span>
                                        <input type="text" placeholder="Loading Charges" id="loading_charge" name="loading_charge" class="form-control "  value="{{$delivery->loading_charge}}">
                                    </div>
                                </div>
                            </div>

                        </div>

<!--
                        <div class="row" > 
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label for="InputEmail">Type Of Note</label><br>
                                    <label class="radio-inline">
                                        <input {{$delivery->type_of_note=='delivery_note' ? 'checked="checked"':''}}  type="radio" name="type_of_note" value="delivery_note"   id="type_of_note"  checked="checked">Delivery Note
                                    </label>
                                    <label class="radio-inline">
                                        <input {{$delivery->type_of_note=='collection_note' ? 'checked="checked"':''}} type="radio" name="type_of_note" value="collection_note" id="type_of_note" >Collection Note
                                    </label>


                                </div>
                            </div>
                        </div>-->



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