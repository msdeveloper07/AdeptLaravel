@extends('layouts.master')

@section('content')



<form class="form-inline" action="/goodsinAction" method="post" name="actions_form" id="actions_form">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="box box-danger">


        <div class="box-body">
            <div class="row">

                <div class="col-md-3">
                    Actions
                    <div class="form-group">
                        <select id="bulk_action" name="bulk_action" class="form-control" placeholder="Select Action"  >
                            <option value="">Select An Action</option>
                            <option value="archive">Archive Selected GoodsIn</option>
                            <option value="active">Activate Selected GoodsIn</option>

                        </select>
                    </div>

                </div>



                <div class="col-md-3">



                    <div class="input-group">
                        <input type="text" class="form-control"  name="search" value="{{isset($search)?$search:''}}" placeholder="Search GoodsIn" aria-describedby="basic-addon2">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default btn-flat">Find GoodsIn</button>
                        </span>
                    </div>

                </div>

                <div class="col-md-2">

                    <div class="form-group">
                        <select id="archive" name="Status" class="form-control" onchange="javascript:location.href = this.value;" placeholder="Select Action"  >
                            <option {{$status=='goodsin'?'selected="selected"':''}} value="/goodsin">All GoodsIn</option>
                            <option {{$status=='archiveGoodsIn'?'selected="selected"':''}} value="/archiveGoodsIn">Archived GoodsIn</option>
                            <option {{$status=='activeGoodsIn'?'selected="selected"':''}} value="/activeGoodsIn">Active GoodsIn</option>

                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <a href="/goodsin/create" class="btn btn-primary btn-flat">Add New GoodsIn </a>
                </div>
                 @if(isset($title)) 
                  <div class="col-md-2">
                    <a href="/goodsin" class="btn btn-info btn-flat">Show All GoodsIn</a>
                </div>
                 @endif

            </div>
        </div>    

    </div>


    <div class='table-responsive'>
        <table class="table table-hover table-bordered pull-left table-striped table-condensed admin-user-table">
            <thead>
                <tr>
                    <th>
                        <!-- <button id="checkall" class="btn-info">Toggle</button>-->
                        <input type="checkbox" id="checkall" class="check" value="" />
                    </th>
                    <th>GoodsIn Number</th>
                    <th>Project Name</th>
                    <th>Client Name</th>
                    <th>Client Order Number</th>
                    <th>Goods In Date</th>
                    <th>Goods In Receipt</th>
                    <th># Lots</th>
                    <th>Stock List</th>
                    <th>Status</th>
                    <th>View Delivery</th>

                    <th>&nbsp;</th>

                </tr>
            </thead>
            <tbody>
                
                @foreach($goodsin as $c)
            
                <tr>
                    <td  data-title="Select">
                        <input type="checkbox" class="check" name="cid[]" value="{{$c->id}}" id="cid{{$c->id}}" />
                    </td>

                    <td  data-title="GoodsIn Number"> {{$c->id}} </td>

                    <td  data-title="project name">
                        <a href="/goodsin/{{$c->id}}/" title="Show">{{$c->project_name}}
                        </a>
                    </td>
                    <?php $client = \App\Models\Client::where('id',$c->client_id)->first()?>
                    <td  data-title="client name">{{$client->client_name}}</td>

                    <td  data-title="client order number">{{$c->client_order_number}}</td>

                    <td  data-title="Goods in date">{{\App\Libraries\ZnUtilities::format_date($c->goods_in_date,10)}}</td>

                    <td  data-title="Goods In Receipt">
                        <a class="btn btn-default btn-sm" href="/goodsin/invoiceGoodsIn/{{$c->id}}" title="View">View
                        </a>
                        <a class='btn btn-primary btn-sm' href="/goodsin/emailTemp/{{$c->id}}/" title="Email">Email
                        </a></td>
                     <td  data-title="GoodsIn Lots">{{\App\Models\Lot::where('goodsin_id',$c->id)->count()}}
                        <a class="btn btn-default btn-sm pull-right" href="/goodsin/createLot/{{$c->id}}" title="Lots">View
                        </a>
                        </td>
                 
                     <td class="" data-title="StockList"><a class='btn btn-info btn-sm' target="_blank" href="/goodsin/printStockList/{{$c->id}}/" title="Stock List">Stock List</td>
                   
                    <td  data-title="Status" >{{$c->goodsin_status}}</td>


                <td>
                        <a href="/goodsin/show/delivery/{{$c->id}}" title="View Delivery"><i class="fa fa-eye fa-lg"></i>&nbsp;View Delivery</a>
 </td>
                  

                    <td>
                        <a href="/goodsin/{{$c->id}}/edit/" title="Edit"><i class="fa fa-pencil-square fa-lg"></i>&nbsp;Edit</a>

                    </td>
                </tr>
                           @endforeach
            </tbody>


        </table>
        {!! $goodsin->render() !!}
    </div>


</form>



@endsection

