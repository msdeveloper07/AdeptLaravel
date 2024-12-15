@extends('layouts.master')

@section('content')




<div class="row">
    <form  role="form" action='/transporter' name='user_form' id='user_form' method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">General</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="InputTitle">Transport Company Name</label>
                                <input type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control " value="{{Input::old('company_name')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Address Line 1</label>
                                <input type="text" placeholder="Enter Address" id="address_line_1" name="address_line_1" class="form-control "  value="{{Input::old('address_line_1')}}">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Address Line 2</label>
                                <input type="text" placeholder="Enter Address 2" id="address_line_2" name="address_line_2" class="form-control "  value="{{Input::old('address_line_2')}}">

                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="InputTitle">City</label>
                                <input type="text" placeholder="Enter City" id="city" name="city" class="form-control "  value="{{Input::old('city')}}">

                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="InputTitle">County</label>
                                <input type="text" placeholder="Enter County" id="county" name="county" class="form-control "  value="{{Input::old('county')}}">

                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="InputTitle">Postcode</label>
                                <input type="text" placeholder="Enter Postcode" id="postcode" name="postcode" class="form-control "  value="{{Input::old('postcode')}}">

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