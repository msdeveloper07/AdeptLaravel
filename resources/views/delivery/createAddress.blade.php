@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><a href="/delivery/{{$id}}">Delivery</a></li>
                <li class="active"><a href="/createDeliveryAddress/{{$id}}">Address</a></li>
                <li ><a href="/delivery/notes/{{$id}}/">Notes</a></li>
                <li ><a href="/delivery/lots/{{$id}}/">Select Lots To Be Delivered</a></li>
            </ul>
        </div><!-- nav-tabs-custom -->
    </div><!-- /.col -->
</div>


<div class="row">
    <form  role="form" action='/storeAddress/{{$id}}' name='user_form' id='user_form' method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Delivery Address</h3>
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
                                <input type="text" placeholder="Enter Address" id="delivery_address_1" name="delivery_address_1" class="form-control "  value="{{Input::old('delivery_address_1')}}">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery Address 2</label>
                                <input type="text" placeholder="Enter Address 2" id="delivery_address_2" name="delivery_address_2" class="form-control "  value="{{Input::old('delivery_address_2')}}">

                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery City</label>
                                <input type="text" placeholder="Enter City" id="delivery_city" name="delivery_city" class="form-control "  value="{{Input::old('delivery_city')}}">

                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery County</label>
                                <input type="text" placeholder="Enter County" id="delivery_county" name="delivery_county" class="form-control "  value="{{Input::old('delivery_county')}}">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery Postcode</label>
                                <input type="text" placeholder="Enter Postcode" id="delivery_postcode" name="delivery_postcode" class="form-control "  value="{{Input::old('delivery_postcode')}}">

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
                                <input type="text" placeholder="Enter Address Name" id="collection_address_name" name="collection_address_name" class="form-control "  value="Adept ESD">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Address 1</label>
                                <input type="text" placeholder="Enter Address" id="collection_address_1" name="collection_address_1" class="form-control "  value="Unit 6 Butterly Avenue">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Address 2</label>
                                <input type="text" placeholder="Enter Address 2" id="collection_address_2" name="collection_address_2" class="form-control "  value="Questor">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection City</label>
                                <input type="text" placeholder="Enter City" id="collection_city" name="collection_city" class="form-control "  value="Dartford">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Country</label>
                                <input type="text" placeholder="Enter Country" id="collection_country" name="collection_country" class="form-control "  value="Kent">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Postcode</label>
                                <input type="text" placeholder="Enter Postcode" id="collection_postcode" name="collection_postcode" class="form-control "  value="DA1 1JG">

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