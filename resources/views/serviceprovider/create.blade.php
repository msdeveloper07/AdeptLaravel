@extends('layouts.master')

@section('content')




<div class="row">
    <form  role="form" action='/serviceProviders' name='user_form' id='user_form' method="post">
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
                                <label for="InputTitle">Service Provider</label>
                                <input type="text" placeholder="Service Provider" id="service_provider" name="service_provider" class="form-control " value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">SP Address 1</label>
                                <input type="text" placeholder="Service Provider Address 1" id="sp_address_1" name="sp_address_1" class="form-control " value="">
                            </div>
                        </div>
                   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">SP Address 2</label>
                                <input type="text" placeholder="Service Provider Address 2" id="sp_address_2" name="sp_address_2" class="form-control " value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">SP City</label>
                                <input type="text" placeholder="Service Provider City" id="sp_city" name="sp_city" class="form-control " value="">
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">SP Postcode</label>
                                <input type="text" placeholder="Service Provider Postcode" id="sp_postcode" name="sp_postcode" class="form-control " value="">
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