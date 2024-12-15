@extends('layouts.master')

@section('content')


<div class="row">
    <form  role="form" action="/clients/{{$id}}" name='user_form' id='user_form' method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="_method" value="PUT">


        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">General</h3>
                </div><!-- /.box-header -->

                 <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="InputTitle">Client Name</label>
                                <input type="text" placeholder="Client Name" id="client_name" name="client_name" class="form-control " value="{{$client->client_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="InputTitle">Contact Name</label>
                                <input type="text" placeholder="Contact Name" id="contact_name" name="contact_name" class="form-control "  value="{{$client->contact_name}}">
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="InputTitle">Address Line 1</label>
                                <input type="text" placeholder="Enter Address" id="client_address_line_1" name="client_address_line_1" class="form-control "  value="{{$client->client_address_line_1}}">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="InputTitle">Address Line 2</label>
                                <input type="text" placeholder="Enter Address 2" id="client_address_line_2" name="client_address_line_2" class="form-control "  value="{{$client->client_address_line_2}}">

                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">City</label>
                                <input type="text" placeholder="Enter City" id="city" name="city" class="form-control "  value="{{$client->city}}">

                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">County</label>
                                <input type="text" placeholder="Enter County" id="county" name="county" class="form-control "  value="{{$client->county}}">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="InputTitle">Postcode</label>
                                <input type="text" placeholder="Enter Postcode" id="postcode" name="postcode" class="form-control "  value="{{$client->postcode}}">

                            </div>
                        </div>




                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="InputTitle">Phone</label>
                                <input type="text" placeholder="Enter Phone" id="phone" name="phone" class="form-control "  value="{{$client->phone}}">

                            </div>
                        </div>


                    

                    </div>
                    <div class="row">

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="InputTitle">Email</label>
                                <input type="email" placeholder="Enter Email" id="email" name="email" class="form-control "  value="{{$client->email}}">

                            </div>
                        </div>

                    </div>


                    <div class="row" > 
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="InputEmail">Client Status</label>
                                <label class="radio-inline">
                                    <input {{$client->client_status=='active' ? 'checked="checked"':''}} type="radio" name="client_status" value="active"   id="client_status_active"  checked="checked">Active
                                </label>
                                <label class="radio-inline">
                                    <input {{$client->client_status=='deactive' ? 'checked="checked"':''}} type="radio" name="client_status" value="deactive" id="client_status_active" >Deactive
                                </label>


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