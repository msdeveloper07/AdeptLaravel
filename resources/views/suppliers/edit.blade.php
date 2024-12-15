@extends('layouts.master')

@section('content')


<div class="row">
    <form  role="form" action="/suppliers/{{$id}}" name='user_form' id='user_form' method="post">
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
                                <label for="InputTitle">Supplier Name</label>
                                <input type="text" placeholder="Supplier Name" id="supplier_name" name="supplier_name" class="form-control " value="{{$supplier->supplier_name}}">
                            </div>
                        </div>
                    </div>
                     
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="InputTitle">Contact Name</label>
                                <input type="text" placeholder="Contact Name" id="contact_name" name="contact_name" class="form-control "  value="{{$supplier->contact_name}}">
                            </div>
                        </div>
                    </div>


                  
                    <div class="row">

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="InputTitle">Email</label>
                                <input type="email" placeholder="Enter Email" id="email" name="email" class="form-control "  value="{{$supplier->email}}">

                            </div>
                        </div>

                    </div>


<!--                    <div class="row" > 
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="InputEmail">Supplier Status</label>
                                <label class="radio-inline">
                                    <input {{$supplier->supplier_status=='active' ? 'checked="checked"':''}} type="radio" name="supplier_status" value="active"   id="supplier_status_active"  checked="checked">Active
                                </label>
                                <label class="radio-inline">
                                    <input {{$supplier->supplier_status=='deactive' ? 'checked="checked"':''}} type="radio" name="supplier_status" value="deactive" id="supplier_status_active" >Deactive
                                </label>


                            </div>
                        </div>
                    </div>-->
                     
                     
                    
                    
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection