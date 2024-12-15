@extends('layouts.master')

@section('content')



@if(isset($title))
<h2 class="page_header">{{$title}}</h2>
@endif


<div class="box box-danger">
    <form class="form-inline" action="/deliverySearch" method="post" name="actions_form" id="actions_form">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <?php
        if (isset($job_id)) {
            $client_id = App\Models\GoodsIn::where('goodsin_id', $job_id)->pluck('client_id');
            $job = App\Models\GoodsIn::where('client_id', $client_id)->get();
        }
        ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <select id="clients" name="clients" style="width:130%;" class="form-control">
                            <option value="">Select Client</option>
                            @foreach($clients as $c)     
                            <option <?php if (isset($client_id)) { ?>{{$client_id==$c->id?'selected="selected"':''}}<?php } ?>value='{{$c->id}}'> {{$c->client_name}}</option>
                            @endforeach  
                        </select>
                    </div>
                </div>

               
                <div class="col-md-2">
                    <div class="form-group">

                        <select id="search_by_date" name="search_by_date" class="form-control" onchange="Search(this.value)">
                            <option {{$search_by_date=='delivery_number'?'selected="selected"':''}} value="delivery_number">Delivery Number</option>
                            <option {{$search_by_date=='collection_date'?'selected="selected"':''}} value="collection_date">Collection Date</option>
                            <option {{$search_by_date=='delivery_date'?'selected="selected"':''}} value="delivery_date">Delivery Date</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group" >
                        <input type="text" class="form-control "  name="search_date" onchange="Datechange(this.val)" id="search_date" value="" placeholder="Select Date" aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="cal"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>


                <div class="col-md-2">

                    <div class="input-group">
                        <input type="text" class="form-control" id="search" onkeypress="return isNumberKey(event)" name="search" value="{{isset($search)?$search:''}}" placeholder="Search Delivery" aria-describedby="basic-addon2">
                    </div>
                </div>


                <div class="col-md-1">
                    <div class="input-group">
                        <input id="search_btn" class="btn btn-primary btn-flat" type="submit" value="Search" name="search_btn">
                    </div>
                </div>


            </div>
          
            <div class="row">&nbsp; </div>
            
            <div class="row">
                 <div class="col-md-8">
                     Select Job Number &nbsp;<div class="form-group">
                       <select id="jobs" name="jobs" style="width:100%;"  class="form-control">
                            <?php if (isset($job_id)) {
                                ?>
                                @foreach($job as $j)
                                <option {{$j->id==$job_id?'selected="selected"':''}}  value='{{$j->id}}'>{{$j->id}}</option> 
                                @endforeach
<?php } else {
    ?>
                                <option  value=''> Job</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
              
                 
                <div class="col-md-2 pull-right">
                    <a href="/delivery/create" class="btn btn-primary btn-flat pull-right">Add New Delivery</a>
                </div>
                  @if(isset($search)||isset($project_name))
                <div class="col-md-2">
                    <a href="/delivery" class="btn btn-info btn-flat">Show All Deliveries</a>
                </div>  
                 @endif
            </div> 
           


        </div>
    </form>

</div>


<div class='table-responsive'>
    <table id="delivery_table" class="table table-hover table-bordered pull-left table-striped table-condensed admin-user-table">
        <thead>
            <tr>

                <th>Project Name</th>
                <th>Job Id</th>
                <th>Delivery Number</th>
                 <!--<th>Delivery Id</th>-->
                <th>Collection Date</th>
                <th>Delivery Date</th>
                <th>&nbsp;</th>


            </tr>
        </thead>
        <tbody>

            <tr>
                @foreach($deliveries as $c)
            <tr>
     <!--           <td  data-title="Select">
                    <input type="checkbox" class="check" name="cid[]" value="{{$c->id}}" id="cid{{$c->id}}" />
                </td>-->

                 <?php $project_name = App\Models\GoodsIn::where('goodsin_id', $c->goodsin_id)->pluck('project_name'); ?>
                <td  data-title="Project Name">
                    <a href="/delivery/{{$c->id}}/" title="Show">{{$project_name}}</a> </td>
                <td  data-title="Job Id"> {{$c->goodsin_id}}</td>
                <td  data-title="Delivery Number">
                    {{$c->job_delivery_id}}

                </td>

                <td  data-title="Collection Date"> {{\App\Libraries\ZnUtilities::format_date($c->collection_date,10)}}</td>


                <td  data-title="Delivery Date">{{\App\Libraries\ZnUtilities::format_date($c->delivery_date,10)}}</td>


                <td>
                    <a href="/delivery/{{$c->id}}/edit/" title="Edit"><i class="fa fa-pencil-square fa-lg"></i>&nbsp;Edit</a>
                    &nbsp;&nbsp;
                    <a href='/duplicateDelivery/{{$c->id}}' title='Duplicate'><i class='fa fa-files-o fa-lg'></i>&nbsp;Duplicate</a>    
                </td>
            </tr>
            @endforeach

            </tr>

        </tbody>


    </table>
    {!! $deliveries->render() !!}
</div>






@endsection

