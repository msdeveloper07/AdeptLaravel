@extends('layouts.master')

@section('content')




<div class="row">
    <form  role="form" action='/goodsin' name='user_form' id='user_form' method="post">
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
                                <label for="InputTitle">Goods In Number</label>
                                <input type="text" id="goodsin_number" name="goodsin_number" value="{{$goodsin_number}}" class="form-control " readonly>
                            </div>
                        </div>
                    </div>
                       <div class="row">
                      <div class="col-md-8">
                            <div class="form-group">
                                <label for="InputTitle">Project Name</label>
                                <input type="text" placeholder="Enter Project Name" id="project_name" name="project_name" class="form-control "  value="{{Input::old('project_name')}}">

                            </div>
                        </div>
                       </div>
                      <div class="col-md-8">
                            <div class="form-group">
                                <label for="InputTitle">Client Name</label>
                                <select name="client_name" id="client_id" class="form-control" >
                                    <option value="">Please Select</option>
                                  @foreach($clients as $u)
                               
                                  <option {{Input::old('client_name')==$u->id?'selected="selected"':''}} value="{{$u->id}}">{{$u->client_name}} </option>
                            @endforeach

                                   
                                </select>  
                               
                            </div>
                        </div>


                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Client Order Number</label>
                                <input type="text" placeholder="Order Number" id="client_order_number" name="client_order_number" class="form-control "  value="{{Input::old('client_order_number')}}">

                            </div>
                        </div>
                  
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Goods In Type</label>
                                <select name="goodsin_type" id="goodsin_type" class="form-control " >
                                    <option value="">Please Select</option>
                                   @foreach(Config::get('extras.job_type') as $c)
                                <option {{Input::old('goodsin_type')==$c?'selected="selected"':''}}  value='{{$c}}'>{{$c}}</option>
                                @endforeach                             
                                </select>    
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Supplier Name</label>
                                 <select name="supplier_id" id="supplier_id" class="form-control " >
                                    <option value="">Select Supplier</option>
                                   @foreach($suppliers as $s)
                                   <option {{Input::old('supplier_id')==$s->id?'selected="selected"':''}}  value='{{$s->id}}'>{{$s->supplier_name}}</option>
                                @endforeach                             
                                </select>   
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Haulage Company Name</label>
                                <input type="text" placeholder="Haulage Company Name" id="haulage_company_name" name="haulage_company_name" class="form-control "  value="{{Input::old('haulage_company_name')}}">

                            </div>
                        </div>
                    </div>    

                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Goods In Date</label>
                                <input type="text" placeholder="Goods In Date" id="goods_in_date" name="goods_in_date" class="form-control " value="{{Input::old('goods_in_date')}}" >

                            </div>
                  
                 
                        </div>
                            <div id="total_vol" > 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Total Volume</label>
                                <input type="text" placeholder="Total Volume" id="total_volume" name="total_volume" class="form-control " value="{{Input::old('total_volume')}}" >

                            </div>
                        </div>
                            </div>  
                        </div>


                            <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Handling Charge</label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gbp"></i></span>
                                <input type="text" placeholder="Handling Charges" id="handling_charge" name="handling_charge" class="form-control "  value="{{Input::old('handling_charge')}}">
                            </div>
                        </div>
                            </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Charge Rate</label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gbp"></i></span>
                                <input type="text" placeholder="Enter Charges" id="charge_rate" name="charge_rate" class="form-control "  value="{{Input::old('charge_rate')}}">
                            </div>
                        </div>
                            </div>

                            </div>
                    </div>
                 
                        <div id="div_" style="display:none">
                            
                                <input type="hidden" id="weekly_charge_rate"  value="{{App\Models\Setting::where('setting_name', 'weekly_charge_rate')->first()->setting_value}}">
                            </div> 
                        <div id="div__" style="display:none">
                                     
                            <input type="hidden" id="daily_charge_rate"  value="{{App\Models\Setting::where('setting_name', 'daily_charge_rate')->first()->setting_value}}">
                            </div> 
                       
                     


             <!-- /.box-body -->

                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection