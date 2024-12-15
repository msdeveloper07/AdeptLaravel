@extends('layouts.master')

@section('content')


<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active"><a href="/jobs/{{$id}}/">General</a></li>
               <li><a href="/jobs/{{$id}}/edit">Edit Job</a></li>
               <li><a href="/jobs/createLot/{{$id}}">Manage Lots</a></li>

                
            </ul>
        </div><!-- nav-tabs-custom -->
    </div><!-- /.col -->
</div>

<div class="row">
    

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">General</h3>
                
<!--                    <a class="btn btn-primary pull-right" href="/jobs/invoiceJob/{{$id}}" >Job Invoice</a>-->
                </div><!-- /.box-header -->

                <div class="box-body">
                     <div class="row">
                        <div class="col-md-8">
                            <label>Job Number</label>
                            <p class="form-control">{{$job->id}}</p> 
                       
                         </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <label>Project Name</label>
                            <p class="form-control">{{$job->project_name}}</p> 
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                        <label>Client Name</label>
                               <p class="form-control">{{$job->clientId->client_name}}</p> 
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                         <label>Client Order Number</label>
                               <p class="form-control">{{$job->client_order_number}}</p> 
                         </div>
                        <div class="col-md-6">
                         <label>Job Type</label>
                               <p class="form-control">{{$job->job_type}}</p> 
                         </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-6">
                         <label>Supplier Name</label>
                               <p class="form-control">{{$suppliers}}</p> 
                         </div>
                   
                        <div class="col-md-6">
                         <label>Haulage Comapany Name</label>
                               <p class="form-control">{{$job->haulage_company_name}}</p> 
                         </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-6">
                         <label>Goods In Date</label>
                               <p class="form-control">{{\App\Libraries\ZnUtilities::format_date($job->goods_in_date,10)}}</p> 
                         </div>
                        
                        <?php if($job->job_type=='Daily/Volume'){ ?>
                        <div class="col-md-6">
                         <label>Total Volume</label>
                               <p class="form-control">{{$job->total_volume}}</p> 
                         </div>
                        <?php } ?>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-6">
                            <label>Handling Charge</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gbp"></i></span>
                                <p class="form-control">{{$job->handling_charge}}</p> 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Charge Rate</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gbp"></i></span>
                                <p class="form-control">{{$job->charge_rate}}</p> 
                            </div>
                        </div>

                    </div>
                    
                           
                </div><!-- /.box-body -->


                <div class="box-footer">
                    <a href="/jobs/{{$id}}/edit" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
      <div class="col-md-6">
            <form class="form-inline" action="/lotAction" method="post" name="actions_form" id="actions_form">

                <div class="box box-danger">
                     <div class="box-header">
                            <h3 class="box-title">All Lots</h3>
                                 <a class='btn btn-default pull-right <?php if(count($lots)==0){echo 'disabled'; } ?>' href="/jobs/labelPrint/{{$job_id}}/" target='_blank'>Print All Labels</a>
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
                                <th style="width:5%;">Job No.</th>
                                <th>Item Name</th>
                                <th style="width:13%;">Damage In</th>
                                <th style="width:5%;">Location</th>
                              <?php if($job->job_type=='Weekly/Dimension'){?>
                                <th style="width:5%;">Volume</th>
                                <?php }?>
                                <th style="width:5%;">Lot Label</th>
                               
                                <th style="width:10%;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lots as $c)
                            <tr>
                               
                                <td  data-title="Lot Number"> {{$c->lot_id}} </td>
                             
                                <td  data-title="Job Number"> {{$c->job_id}} </td>
                                
                                   <?php $item_name = \App\Models\Item::where('id',$c->item_id)->pluck('item_name'); ?>
                                <td  data-title="Item Name"> {{isset($item_name)?$item_name:''}} </td>
                                
                                <td  data-title="Damage In">{{$c->damage_in}}</td>

                                <td  data-title="loction">{{$c->location}}</td>
                                
                                     <?php if($job->job_type=='Weekly/Dimension'){?>
                                <td  data-title="volume">{{$c->volume}}</td>
                                <?php } ?>
                                 <td  data-title="lot label" style="text-align: center;"><a class='btn btn-default btn-sm' href="/jobs/printSingleLot/{{$c->id}}/" target="_blank">Print</a></td>

                                <td>
                                    <a href="/jobs/editLot/{{$c->id}}/"><i class="fa fa-pencil-square fa-lg"></i>&nbsp;Edit</a>

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

@stop

