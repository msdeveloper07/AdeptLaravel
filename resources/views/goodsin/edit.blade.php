@extends('layouts.master')

@section('content')



<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li><a href="/goodsin/{{$goodsin_id}}/">General</a></li>
               <li  class="active"><a href="/goodsin/{{$goodsin_id}}/edit">Edit Goods In</a></li>
               <li><a href="/goodsin/createLot/{{$goodsin_id}}">Manage Lots</a></li>

                
            </ul>
        </div><!-- nav-tabs-custom -->
    </div><!-- /.col -->
</div>
<div class="row">
      <div class="col-md-6">
    <form  role="form" action="/goodsin/{{$goodsin_id}}" name='user_form' id='user_form' method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="_method" value="PUT">

      
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Goods In</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="InputTitle">Goods In Number</label>
                                <input type="text" id="goodsin_number" name="goodsin_number" class="form-control " value="{{$goodsin->goodsin_id}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                                <label for="InputTitle">Project Name</label>
                                <input type="text" placeholder="Enter Project Name" id="project_name" name="project_name" class="form-control "  value="{{$goodsin->project_name}}">

                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="InputTitle">Client Name</label>
                            <select name="client_name" id="client_id" class="form-control ">
                                <option value="">Please Select</option>
                                @foreach($client as $u)

                                <option  {{$u->id==$goodsin->client_id?'selected="selected"':''}} value="{{$u->id}}">{{$u->client_name}} </option>
                                @endforeach

                            </select>    
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Client Order Number</label>
                                <input type="text" placeholder="Order Number" id="client_order_number" name="client_order_number" class="form-control "  value="{{$goodsin->client_order_number}}">

                            </div>
                        </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Goods In Type</label>
                                <select name="goodsin_type" id="goodsin_type" class="form-control ">
                                    <option value="">Please Select</option>
                                   @foreach(Config::get('extras.job_type') as $c)
                                <option {{$goodsin->goodsin_type==$c?'selected="selected"':''}} value='{{$c}}'>{{$c}}</option>
                                @endforeach                             
                                </select>    
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Supplier Name</label>
                                 <select name="supplier_id" id="supplier_id" class="form-control ">
                                    <option value="">Select Supplier</option>
                                   @foreach($suppliers as $s)
                                   <option  {{$goodsin->supplier_id==$s->id?'selected="selected"':''}} value='{{$s->id}}'>{{$s->supplier_name}}</option>
                                @endforeach                             
                                </select>   
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Haulage Company Name</label>
                                <input type="text" placeholder="Haulage Company Name" id="haulage_company_name" name="haulage_company_name" class="form-control "  value="{{$goodsin->haulage_company_name}}">

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Goods In Date</label>
                                <input type="text" placeholder="Goods In Date" id="goods_in_date" name="goods_in_date" class="form-control "  value="{{\App\Libraries\ZnUtilities::format_date($goodsin->goods_in_date,10)}}">

                            </div>
                        </div>
                         <div id="total_vol" >
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Total Volume</label>
                                <input type="text" placeholder="Total Volume" id="total_volume" name="total_volume" class="form-control " value="{{$goodsin->total_volume}}" >

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
                                <input type="text" placeholder="Handling Charges" id="handling_charge" name="handling_charge" class="form-control "  value="{{$goodsin->handling_charge}}">
                            </div>
                        </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Charge Rate</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gbp"></i></span>
                                <input type="text" placeholder="Enter Charges" id="charge_rate" name="charge_rate" class="form-control "  value="{{$goodsin->charge_rate}}">
                            </div>
                        </div>
                        </div>

                    </div>

                </div><!-- /.box-body -->
                <div id="div_" style="display:none">
                            
                                <input type="hidden" id="weekly_charge_rate"  value="{{App\Models\Setting::where('setting_name', 'weekly_charge_rate')->first()->setting_value}}">
                            </div> 
                        <div id="div__" style="display:none">
                                     
                            <input type="hidden" id="daily_charge_rate"  value="{{App\Models\Setting::where('setting_name', 'daily_charge_rate')->first()->setting_value}}">
                            </div> 
                
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
     <div class="col-md-6">
            <form class="form-inline" action="/lotAction" method="post" name="actions_form" id="actions_form">

                <div class="box box-danger">
                     <div class="box-header">
                            <h3 class="box-title">All Lots</h3>
                                 <a class='btn btn-default pull-right <?php if(count($lots)==0){echo 'disabled'; } ?>' href="/goodsin/labelPrint/{{$goodsin_id}}/" target='_blank'>Print All Labels</a>
                        </div>

                    <div class="box-body">
                      <div class="row">

                                </div>

                                </div>
                          <div class="box-body">
                   @if(count($lots)>0)           
                <div class='table-responsive'>
                    <table class="table table-hover table-bordered pull-left table-striped table-condensed admin-user-table">
                        <thead>
                            <tr>
                                
                                <th style="width:5%;">Lot No.</th>
                                <th style="width:5%;">Goods In No.</th>
                                <th >Item Name</th>
                                <th style="width:13%;">Damage In</th>
                                <th style="width:5%;">Location</th>
                                <!--<th>Volume</th>-->
                                <th style="width:5%;">Lot Label</th>
                               <th style="width:10%;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lots as $c)
                            <tr>
                                
                                <td  data-title="Lot Number"> {{$c->lot_id}} </td>
                                 
                                <td  data-title="Goods In Number"> {{$c->goodsin_id}} </td>
                                 <?php $item_name = \App\Models\Item::where('id',$c->item_id)->pluck('item_name'); ?>
                                <td  data-title="Item Name"> {{isset($item_name)?$item_name:''}} </td>
                                
                                <td  data-title="Damage In">{{$c->damage_in}}</td>

                                <td  data-title="loction">{{$c->location}}</td>

                                <!--<td  data-title="volume">{{$c->volume}}</td>-->
       
                                <td  data-title="lot label" style="text-align: center;"><a class='btn btn-default btn-sm' href="/goodsin/printSingleLot/{{$c->id}}/" target="_blank">Print</a></td>


                                <td>
                                    <a href="/goodsin/editLot/{{$c->id}}/"><i class="fa fa-pencil-square fa-lg"></i>&nbsp;Edit</a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>


                    </table>

                </div>
                   @else
                <h3>Lots Are Not Available</h3>
                   @endif
                    </div></div>
            </form>


        </div>
</div>

@endsection