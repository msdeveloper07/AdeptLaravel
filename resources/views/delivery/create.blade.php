@extends('layouts.master')

@section('content')



<div class="row">
    <form  role="form" action='/delivery' name='user_form' id='user_form' method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">General</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label  for="InputTitle">Delivery No.</label>
                                <input class="form-control" name="job_delivery_id" id="job_delivery_id"  for="InputTitle" value="{{$job_delivery_id or ''}}" readonly />


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Client Name</label>
                                <select name="client_id" id="client_id" class="form-control ">
                                    <option value="">Please Select</option>
                                    @foreach($clients as $u)

                                    <option {{Input::old('client_id')==$u->id?'selected="selected"':''}} value="{{$u->id}}">{{$u->client_name}} </option>
                                    @endforeach


                                </select>    
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Good In Number</label>
                                <select name="goodsin_id" id="goodsin_id" class="form-control ">
                                    <option value="">Please Select</option>
                                </select>    
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Transport Order Date</label>
                                <input type="text" placeholder="Transport Order date" id="transport_order_date" name="transport_order_date" class="form-control "  value="{{Input::old('transport_order_date')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Transport Company Name</label>
                                <select name="transport_company_id" id="transport_company_id" class="form-control ">
                                    <option value="">Please Select</option>
                                    @foreach($transport_company as $u)

                                    <option {{Input::old('transport_company_id')==$u->id?'selected="selected"':''}} value="{{$u->id}}">{{$u->company_name}} </option>
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

                                              <option  {{Input::old('vehicle_type_id')==$u->id?'selected="selected"':''}} value="{{$u->id}}">{{$u->vehicle_type}} </option>
                                              @endforeach
                                        </select>                               </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Approximate Weight</label>
                                <input type="text" placeholder="Approximate Weight"  id="approximate_weight" name="approximate_weight" class="form-control "  value="{{Input::old('approximate_weight')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Date</label>
                                <input type="text"  placeholder="Collection Date" id='collection_date' name="collection_date" class="form-control "  value="{{Input::old('collection_date')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivary Date</label>
                                <input type="text"  placeholder="Delivery Date" id="delivery_date" name="delivery_date" class="form-control "  value="{{Input::old('delivery_date')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Time</label>
                                <input type="text"  placeholder="Collection Time" id='collection_time' name="collection_time" class="form-control "  value="{{Input::old('collection_time')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivary Time</label>
                                <input type="text"  placeholder="Delivery Time" id="delivery_time" name="delivery_time" class="form-control "  value="{{Input::old('delivery_time')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Agreed Price</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gbp"></i></span>
                                    <input type="text" placeholder="Agreed Price"  id="agreed_price" name="agreed_price" class="form-control "  value="{{Input::old('agreed_price')}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Site Contact Details</label>
                                <textarea  placeholder="Site Contact Details" id="site_contact_details" name="site_contact_details" class="form-control "  value="{{Input::old('site_contact_details')}}"></textarea>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Damage Out</label>
                                <textarea placeholder="Damage Out" id="damage_out" name="damage_out" class="form-control "  value="{{Input::old('damage_out')}}"></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Invoice Value</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gbp"></i></span>
                                    <input type="text" placeholder="Invoice value" id="invoice_value" name="invoice_value" class="form-control "  value="{{Input::old('invoice_value')}}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Loading Charge</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gbp"></i></span>
                                    <input type="text" placeholder="Loading Charges" id="loading_charge" name="loading_charge" class="form-control "  value="{{Input::old('loading_charge')}}">
                                </div>
                            </div>
                        </div>

                    </div>


                  

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection