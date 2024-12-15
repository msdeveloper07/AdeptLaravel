@extends('layouts.master')

@section('content')


<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><a href="/jobs/{{$job_id}}/">General</a></li>
                <li><a href="/jobs/{{$job_id}}/edit">Edit Job</a></li>
                <li  class="active"><a href="/jobs/createLot/{{$job_id}}">Manage Lots</a></li>


            </ul>
        </div><!-- nav-tabs-custom -->
    </div><!-- /.col -->
</div>

<div class="row">
    <div class="col-md-6">
        <form  role="form" action='saveLot' name='user_form' id='user_form' method="post" >
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Create Lot</h3>
                </div><!-- /.box-header -->

                <div class="box-body">

                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6" >
                            <div class="right">
                                <label for="InputTitle">Job Type</label>
                                <input type="text" id="job_type" name="job_type" value="{{$job_type}}" class="form-control " readonly>

                            </div>
                        </div>
                    </div>

                    <div class="row" >
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Lot Number</label>
                                <input type="text" id="lot_number" name="lot_number" value="{{$lot_number}}" class="form-control " readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Job Number</label>
                                <input type="text"  id="job_id" name="job_id" class="form-control" value="{{$job_id}}" readonly>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Goods In Date</label>
                                <input type="text"  id="goods_in_date" name="goods_in_date" class="form-control" value="{{\App\Libraries\ZnUtilities::format_date($job->goods_in_date,10)}}" >

                            </div>
                        </div>
                    </div>

                    <div id="dimensions">
                        <div class="row" >
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputTitle">Dimension 1(mm)</label>
                                    <input type="text" placeholder="Enter Dimension 1" id="dimension_1" name="dimension_1" class="form-control "  value="{{Input::old('dimension_1')}}">

                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputTitle">Dimension 2(mm)</label>
                                    <input type="text" placeholder="Dimension 2" id="dimension_2" name="dimension_2" class="form-control "  value="{{Input::old('dimension_2')}}">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputTitle">Dimension 3(mm)</label>
                                    <input type="text" placeholder="Enter Dimension 3" id="dimension_3" name="dimension_3" class="form-control "  value="{{Input::old('dimension_3')}}">

                                </div>
                            </div>
                        </div>
                    
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">Calculated Volume</label>
                                    <input type="text" placeholder="Enter Volume" id="volume" name="volume" class="form-control "  value="{{Input::old('volume')}}">

                                </div>
                            </div>
                      
                       </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Damage In</label>
                                <input type="text" placeholder="Damage in" id="damage_in" name="damage_in" class="form-control " value="None">

                            </div>
                        </div>
                    </div>   
                        
                     <div class="row" >
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Item</label>
                                <select name="item_id" id="item_id" class="form-control" required="required">
                                    <option value="">Please Select</option>
                                    @foreach($items as $u)

                                    <option  value="{{$u->id}}">{{$u->item_name}} </option>
                                    @endforeach

                                </select>  
                            </div>
                        </div>
                   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Location</label>
                                <input type="text" placeholder="Enter Location" id="location" name="location" class="form-control "  value="W/H/F">

                            </div>
                        </div>
                    </div>

               



                </div><!-- /.box-body -->

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
                                   <?php if($job_type=='Weekly/Dimension'){?>
                                    <th style="width:5%;">Volume</th>
                                   <?php } ?>
                                    <th style="width:5%;">Lot Label</th>

                                    <th style="width:10%;">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($lots as $c)
                                <tr>
                                   

                                    <td  data-title="Lot Number"> {{$c->lot_id}} </td>
                                    
                                    <td  data-title="Job Number"> {{$c->job_id}} </td>
                                   
                                    <td  data-title="item">{{$c->Items->item_name}}</td>
                                  
                                    <td  data-title="Damage In">{{$c->damage_in}}</td>

                                    <td  data-title="loction">{{$c->location}}</td>
                                    <?php if($job_type=='Weekly/Dimension'){?>
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

@endsection