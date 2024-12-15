@extends('layouts.master')

@section('content')




<div class="row">
    <form  role="form" action='/jobs' name='user_form' id='user_form' method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Project Information</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Job Number</label>
                                <input type="text" id="job_number" name="job_number" value="{{$job_number}}" class="form-control " readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Job Type</label>
                                <select name="job_type" id="job_type" class="form-control " >
                                    <!--<option value="">Please Select</option>-->
                                    @foreach($job_types as $c)
                                    <option {{Input::old('job_type')==$c->job_type?'selected="selected"':''}}  value='{{$c->job_type_id}}'>{{$c->job_type}}</option>
                                    @endforeach                             
                                </select>    
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">ESD Project Ref.</label>
                                <input type="text" placeholder="Enter ESD Project Ref." id="esd_project_ref" name="project_name" class="form-control "  value="{{Input::old('esd_project_ref')}}">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Client Ref.</label>
                                <input type="text" placeholder="Enter Client Ref." id="client_ref" name="client_ref" class="form-control "  value="{{Input::old('client_ref')}}">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                             <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Site Name</label>
                                <input type="text" placeholder="Site Name" id="site_name" name="site_name" class="form-control "  value="{{Input::old('site_name')}}">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Service Provider</label>
                                <select name="service_provider_id" id="service_provider_id" class="form-control" >
                                    <!--<option value="">Please Select</option>-->
                                    @foreach($service_providers as $u)

                                    <option {{Input::old('service_provider_id')==$u->service_provider_id?'selected="selected"':''}} value="{{$u->service_provider_id}}">{{$u->service_provider}} </option>
                                    @endforeach


                                </select>  

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Address</label>
                                <input type="text" placeholder="Enter Address" id="address" name="address" class="form-control "  value="{{Input::old('address')}}">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">City</label>
                                <input type="text" placeholder="City" id="city" name="city" class="form-control "  value="{{Input::old('city')}}">

                            </div>
                        </div>
                    </div>    

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Postcode</label>
                                <input type="text" placeholder="Postcode" id="postcode" name="postcode" class="form-control " value="{{Input::old('postcode')}}" >

                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Vehicle Type</label>
                                <select name="vehicle_type" id="vehicle_type" class="form-control" >
                                    <option value="">Please Select</option>
                                    @foreach($vehicle_types as $u)

                                    <option {{Input::old('vehicle_type')==$u->vehicle_type_id?'selected="selected"':''}} value="{{$u->vehicle_type_id}}">{{$u->vehicle_type}} </option>
                                    @endforeach


                                </select>  

                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Client Name</label>
                                <select name="client_name" id="client_name" class="form-control" >
                                    <option value="">Please Select</option>
                                    @foreach($client_names as $u)

                                    <option {{Input::old('client_name')==$u->client_id?'selected="selected"':''}} value="{{$u->client_id}}">{{$u->client_name}} </option>
                                    @endforeach


                                </select>  

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Contact Name</label>
                                <select name="conatct_name" id="conatct_name" class="form-control" >
                                    <option value="">Please Select</option>
                                    @foreach($contact_names as $u)

                                    <option {{Input::old('conatct_name')==$u->conatct_name?'selected="selected"':''}} value="{{$u->client_id}}">{{$u->conatct_name}} </option>
                                    @endforeach


                                </select>  

                            </div>
                        </div>
                              </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Contact Telephone</label>
                                <input type="text" placeholder="Contact Telephone" id="contact_telepone" name="contact_telepone" class="form-control " value="{{Input::old('contact_telepone')}}" >

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Contact Email</label>
                                <input type="text" placeholder="Contact Email" id="contact_email" name="contact_email" class="form-control " value="{{Input::old('contact_email')}}" >

                            </div>
                        </div>
                              </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Site Contact Details</label>
                                <input type="text" placeholder="Site Contact Details" id="site_contact_details" name="site_contact_details" class="form-control " value="{{Input::old('site_contact_details')}}" >

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Approximate Weight</label>
                                <input type="text" placeholder="Approx. Weight" id="approximent_weight" name="approximent_weight" class="form-control " value="{{Input::old('approximent_weight')}}" >

                            </div>
                        </div>
                              </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Order Number</label>
                                <input type="text" placeholder="Order Number" id="order_number" name="order_number" class="form-control " value="{{Input::old('order_number')}}" >

                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Order Status</label>
                            <select name="order_status" id="order_status" class="form-control" >
                                <option value="">Please Select</option>
                                <option {{Input::old('order_status')=='Awaiting Order'?'selected="selected"':''}} value="Awaiting Order">Awaiting Order </option>
                                <option {{Input::old('order_status')=='Order Recieved'?'selected="selected"':''}} value="Order Recieved">Order Recieved </option>
                                     </select>  

                        </div>
                    </div>
                              </div>
                        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Address</label>


                                <input type="text" placeholder="Collection Address" id="collection_address" name="collection_address" class="form-control "  value="{{Input::old('collection_address')}}">

                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Contact</label>

                                <input type="text" placeholder="Enter Charges" id="collection_contact" name="collection_contact" class="form-control "  value="{{Input::old('collection_contact')}}">

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Date</label>


                                <input type="text" placeholder="Collection Date" id="collection_date" name="collection_date" class="form-control "  value="{{Input::old('collection_date')}}">

                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Time</label>

                                <input type="text" placeholder="Collection Time Charges" id="collection_time" name="collection_time" class="form-control "  value="{{Input::old('collection_time')}}">

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery Date</label>


                                <input type="text" placeholder="Delivery Date" id="delivery_date" name="delivery_date" class="form-control "  value="{{Input::old('delivery_date')}}">

                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery Time</label>

                                <input type="text" placeholder="Delivery Time" id="delivery_time" name="delivery_time" class="form-control "  value="{{Input::old('delivery_time')}}">

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Notes</label>


                                <textarea  placeholder="Enter Note" id="note" name="note" class="form-control "  value="{{Input::old('note')}}"></textarea>

                            </div>
                        </div>


                    </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Status</label>
                            <select name="status" id="status" class="form-control" >
                                <option value="">Please Select</option>
                                
                                <option {{Input::old('status')=='Pending'?'selected="selected"':''}} value="Pending">Pending </option>
                                <option {{Input::old('status')=='Provisionall Booked'?'selected="selected"':''}} value="Provisionall Booked">Provisionall Booked </option>
                                <option {{Input::old('status')=='Booked'?'selected="selected"':''}} value="Booked">Booked </option>
                               


                            </select>  

                        </div>
                    </div>
                </div>
                
               <div id='Site_Clearance' style='display: none;'>
             <h3 class="box-title">Site Clearance Information</h3>
               <div class="row" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Parking Arrangements</label>
                            <select name="parking_arrangements" id="parking_arrangements" class="form-control" >
                                <option value="">Please Select</option>
                                
                                <option {{Input::old('parking_arrangements')=='On Road - No Parking Restrictions'?'selected="selected"':''}} value="On Road - No Parking Restrictions">On Road - No Parking Restrictions </option>
                                <option {{Input::old('parking_arrangements')=='On Road - Single Yellow line'?'selected="selected"':''}} value="On Road - Single Yellow line">On Road - Single Yellow line </option>
                                <option {{Input::old('parking_arrangements')=='On Road - Double Yellow line'?'selected="selected"':''}} value="On Road - Double Yellow line">On Road - Double Yellow line </option>
                                <option {{Input::old('parking_arrangements')=='On Road - Red Route'?'selected="selected"':''}} value="On Road - Red Route">On Road - Red Route </option>
                                <option {{Input::old('parking_arrangements')=='On Site - No Parking restrictions'?'selected="selected"':''}} value="On Site - No Parking restrictions">On Site - No Parking restrictions</option>
                               


                            </select>  

                        </div>
                    </div>
                </div>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Waste Location</label>
                            <select name="waste_location" id="waste_location" class="form-control" >
                                <option value="">Please Select</option>
                                <option {{Input::old('waste_location')=='Adjacent to vehicle parking location.'?'selected="selected"':''}} value="Adjacent to vehicle parking location.">Adjacent to vehicle parking location.</option>
                                <option {{Input::old('waste_location')=='Same level as vehicle parking location - within 10 metres.'?'selected="selected"':''}} value="Same level as vehicle parking location - within 10 metres.">Same level as vehicle parking location - within 10 metres. </option>
                                <option {{Input::old('waste_location')=='Same level as vehicle parking location - within 20 metres.'?'selected="selected"':''}} value="Same level as vehicle parking location - within 20 metres.">Same level as vehicle parking location - within 20 metres. </option>

                            </select>  

                        </div>
                    </div>
                </div>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Waste Stream 1</label>
                            <select name="waste_stream_1" id="waste_stream_1" class="form-control" >
                                <option value="">Please Select</option>
                                <option {{Input::old('status')=='Scrap Metal (17 04 05)'?'selected="selected"':''}} value="Scrap Metal (17 04 05)">Scrap Metal (17 04 05)</option>
                                <option {{Input::old('status')=='Mixed Rubble (17 01 07)'?'selected="selected"':''}} value="Mixed Rubble (17 01 07)">Mixed Rubble (17 01 07) </option>
                                <option {{Input::old('status')=='Mixed Packaging (15 01 06)'?'selected="selected"':''}} value="Mixed Packaging (15 01 06)">Mixed Packaging (15 01 06) </option>

                            </select>  

                        </div>
                    </div>
                </div>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Waste Stream 1</label>
                            <select name="waste_stream_1" id="waste_stream_1" class="form-control" >
                                <option value="">Please Select</option>
                                <option {{Input::old('waste_stream_1')=='Scrap Metal (17 04 05)'?'selected="selected"':''}} value="Scrap Metal (17 04 05)">Scrap Metal (17 04 05)</option>
                                <option {{Input::old('waste_stream_1')=='Mixed Rubble (17 01 07)'?'selected="selected"':''}} value="Mixed Rubble (17 01 07)">Mixed Rubble (17 01 07) </option>
                                <option {{Input::old('waste_stream_1')=='Mixed Packaging (15 01 06)'?'selected="selected"':''}} value="Mixed Packaging (15 01 06)">Mixed Packaging (15 01 06) </option>

                            </select>  

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Containment 1</label>
                            <select name="containment_1" id="containment_1" class="form-control" >
                                <option value="">Please Select</option>
                                <option {{Input::old('containment_1')=='Rubble Sacks'?'selected="selected"':''}} value="Rubble Sacks>Rubble Sacks</option>
                                <option {{Input::old('containment_1')=='Restraints'?'selected="selected"':''}} value="Restraints">Restraints </option>
                                <option {{Input::old('containment_1')=='Crates'?'selected="selected"':''}} value="Crates">Crates</option>

                            </select>  

                        </div>
                    </div>
                </div>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Waste Stream 2</label>
                            <select name="waste_stream_2" id="waste_stream_2" class="form-control" >
                                <option value="">Please Select</option>
                                <option {{Input::old('waste_stream_2')=='Scrap Metal (17 04 05)'?'selected="selected"':''}} value="Scrap Metal (17 04 05)">Scrap Metal (17 04 05)</option>
                                <option {{Input::old('waste_stream_2')=='Mixed Rubble (17 01 07)'?'selected="selected"':''}} value="Mixed Rubble (17 01 07)">Mixed Rubble (17 01 07) </option>
                                <option {{Input::old('waste_stream_2')=='Mixed Packaging (15 01 06)'?'selected="selected"':''}} value="Mixed Packaging (15 01 06)">Mixed Packaging (15 01 06) </option>

                            </select>  

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Containment 2</label>
                            <select name="containment_2" id="containment_2" class="form-control" >
                                <option value="">Please Select</option>
                                <option {{Input::old('containment_2')=='Rubble Sacks'?'selected="selected"':''}} value="Rubble Sacks>Rubble Sacks</option>
                                <option {{Input::old('containment_2')=='Restraints'?'selected="selected"':''}} value="Restraints">Restraints </option>
                                <option {{Input::old('containment_2')=='Crates'?'selected="selected"':''}} value="Crates">Crates</option>

                            </select>  

                        </div>
                    </div>
                </div>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Waste Stream 3</label>
                            <select name="waste_stream_3" id="waste_stream_3" class="form-control" >
                                <option value="">Please Select</option>
                                <option {{Input::old('waste_stream_3')=='Scrap Metal (17 04 05)'?'selected="selected"':''}} value="Scrap Metal (17 04 05)">Scrap Metal (17 04 05)</option>
                                <option {{Input::old('waste_stream_3')=='Mixed Rubble (17 01 07)'?'selected="selected"':''}} value="Mixed Rubble (17 01 07)">Mixed Rubble (17 01 07) </option>
                                <option {{Input::old('waste_stream_3')=='Mixed Packaging (15 01 06)'?'selected="selected"':''}} value="Mixed Packaging (15 01 06)">Mixed Packaging (15 01 06) </option>

                            </select>  

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Containment 3</label>
                            <select name="containment_3" id="containment_3" class="form-control" >
                                <option value="">Please Select</option>
                                <option {{Input::old('containment_3')=='Rubble Sacks'?'selected="selected"':''}} value="Rubble Sacks>Rubble Sacks</option>
                                <option {{Input::old('containment_3')=='Restraints'?'selected="selected"':''}} value="Restraints">Restraints </option>
                                <option {{Input::old('containment_3')=='Crates'?'selected="selected"':''}} value="Crates">Crates</option>

                            </select>  

                        </div>
                    </div>
                </div>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Number of Operatives</label>
                             <input type="text" placeholder="Number of Operatives" id="number_of_operatives" name="number_of_operatives" class="form-control "  value="{{Input::old('number_of_operatives')}}">  

                        </div>
                    </div>
                    
                </div>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Additional Resources</label>
                            <textarea type="text" placeholder="Additional Resources" id="additional_resources" name="additional_resources" class="form-control "  value="{{Input::old('additional_resources')}}">  </textarea>>

                        </div>
                    </div>
                    
                </div>
                    
                </div>
                    
                    <h3 class="box-title">Financial Information</h3>
                     <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Agreed Price</label>
                             <input type="text" placeholder="Agreed Price" id="agreed_price" name="agreed_price" class="form-control "  value="{{Input::old('agreed_price')}}">  

                        </div>
                    </div>
                    
                </div>
                     <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Transport Charge</label>
                             <input type="text" placeholder="Transport Charge" id="transport_charge" name="transport_charge" class="form-control "  value="{{Input::old('transport_charge')}}">  

                        </div>
                    </div>
                    
                </div>
                     <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Waiting Time Charge</label>
                             <input type="text" placeholder="Waiting Time Charge" id="waiting_time_charge" name="waiting_time_charge" class="form-control "  value="{{Input::old('waiting_time_charge')}}">  

                        </div>
                    </div>
                    
                </div>
                     <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Storage Charge</label>
                             <input type="text" placeholder="Storage Charge" id="storage_charge" name="storage_charge class="form-control "  value="{{Input::old('storage_charge')}}">  

                        </div>
                    </div>
                    
                </div>
                     <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Handling Charge</label>
                             <input type="text" placeholder="Handling Charge" id="handling_charge" name="handling_charge" class="form-control "  value="{{Input::old('handling_charge')}}">  

                        </div>
                    </div>
                    
                </div>
                     <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Labour Charge</label>
                             <input type="text" placeholder="Labour Charge" id="labour_charge" name="labour_charge" class="form-control "  value="{{Input::old('labour_charge')}}">  

                        </div>
                    </div>
                    
                </div>
                     <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Waste Transfer Charge</label>
                             <input type="text" placeholder="Waste Transfer Charge" id="waste_tarnsfer_charge" name="waste_tarnsfer_charge" class="form-control "  value="{{Input::old('waste_tarnsfer_charge')}}">  

                        </div>
                    </div>
                    
                </div>
              
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Invoice Notes</label>
                            <textarea type="text" placeholder="Invoice Notes" id="invoice_notes" name="invoice_notes" class="form-control "  value="{{Input::old('invoice_notes')}}">  </textarea>

                        </div>
                    </div>
                    </div>
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputTitle">Containment 3</label>
                            <select name="containment_3" id="containment_3" class="form-control" >
                                <option value="">Please Select</option>
                                <option {{Input::old('containment_3')=='Rubble Sacks'?'selected="selected"':''}} value="Rubble Sacks>Rubble Sacks</option>
                                <option {{Input::old('containment_3')=='Restraints'?'selected="selected"':''}} value="Restraints">Restraints </option>
                                <option {{Input::old('containment_3')=='Crates'?'selected="selected"':''}} value="Crates">Crates</option>

                            </select>  

                        </div>
                    </div>
                    </div>
                    </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </div>
        </div>
        </div>
    </form>
</div>

@endsection