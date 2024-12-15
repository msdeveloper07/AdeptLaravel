@extends('layouts.master')

@section('content')


<div class="row">
    <div class="col-md-12">
     
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active"><a href="/delivery/{{$id}}/">Delivery</a></li>
            <li><a href="/showAddress/{{$id}}/">Address</a></li>
             <li ><a href="/delivery/notes/{{$id}}/">Notes</a></li>
               <li  ><a href="/delivery/lots/{{$id}}/">Select Lots To Be Delivered</a></li>
                 
             </ul>
</div>
    </div>
</div>

<div class="row">
          <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Delivery Details</h3>
                    <a class="btn btn-primary pull-right" href="/delivery/{{$id}}/edit/">Edit</a>
                </div><!-- /.box-header -->
                    
                 <div class="box-body">
                     <div class="row">
                      <div class="col-md-4">
                            <div class="form-group">
                             <label  for="InputTitle">Delivery No.</label>
                             <p class="form-control" readonly >{{$delivery->job_delivery_id}}</p>
                            
                            </div>
                        </div>
                     </div>
                    <div class="row">
                      <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Client Name</label>
                               <p class="form-control" readonly >{{$delivery->Clientname->client_name}}</p>
  
                            </div>
                        </div>
                  
                     <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Goods In Number</label>
                                
                                <p class="form-control" readonly >{{$delivery->goodsin_id}}</p>
 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Transport Order Date</label>
                            <p class="form-control" readonly >{{\App\Libraries\ZnUtilities::format_date($delivery->transport_order_date,10)}}</p>
                            </div>
                        </div>
                        
                         <div class="col-md-6">
                            <div class="form-group">
                               <label for="InputTitle">Transport Company Name</label>
                                       <p class="form-control" readonly >{{isset($delivery->Transport->company_name)?$delivery->Transport->company_name:''}}</p>
                              </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Vehicle Type</label>
                              <p class="form-control" readonly >{{$vehicletype}}</p>
  
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Approximate Weight</label>
                                <p class="form-control" readonly >{{$delivery->approximate_weight}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Date</label>
                                <p class="form-control" readonly >{{\App\Libraries\ZnUtilities::format_date($delivery->collection_date,10)}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery Date</label>
                                <p class="form-control" readonly >{{\App\Libraries\ZnUtilities::format_date($delivery->delivery_date,10)}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Collection Time</label>
                                <p class="form-control" readonly >{{$delivery->collection_time}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Delivery Time</label>
                                <p class="form-control" readonly >{{$delivery->delivery_time}}</p>
                            </div>
                        </div>
                    </div>
                       <div class="row">
                       
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Agreed Price</label>
                                 <div class="input-group">
                                   <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gbp"></i></span>
                                <p class="form-control" readonly >{{$delivery->agreed_price}}</p>
                            </div>
                            </div>
                        </div>
<!--                    </div>
                       <div class="row">-->
                       
                       </div>
                  <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Site Contact Details</label>
                                <textarea class="form-control" readonly rows="5">{{$delivery->site_contact_details}}</textarea>

                            </div>
                        </div>

<!--                    </div>
                    <div class="row">-->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Damage Out</label>
                                <textarea class="form-control" readonly rows="5">{{$delivery->damage_out}}</textarea>

                            </div>
                        </div>
                  </div>
                     <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Invoice Value</label>
                                  <div class="input-group">
                                   <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gbp"></i></span>
                                <p class="form-control" readonly >{{$delivery->invoice_value}}</p>
                                  </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Loading Charge</label>
                                  <div class="input-group">
                                   <span class="input-group-addon" id="basic-addon1"><i class="fa fa-gbp"></i></span>
                                <p class="form-control" readonly >{{$delivery->loading_charge}}</p>
                                  </div>
                            </div>
                        </div>

                    </div>


                   



                </div><!-- /.box-body-->
             
            </div>
        </div>
    
    <div class="col-md-6">
         <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">Delivery Lots</h3>
            </div><!-- /.box-header -->


            <div class='table-responsive'>
                  <div class="col-md-12">
                       @if(count($delivery_lots)> 0)
                <table class="table table-hover table-bordered pull-left table-striped table-condensed admin-user-table">
                    <thead>
                        <tr>

                            <th>Lot Number</th>
                            <th>Delivery</th>
                            <th>Delivery Type</th>
                            <th>Item Name</th>
                            <th>Delivery Details</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($delivery_lots as $c)
                        <tr>
                            <?php  $lot_id = \App\Models\Lot::where('lot_id',$c->lot_id)->where('goodsin_id',$c->goodsin_id)->first();?>
                            <td  data-title="Lot Number"> {{$c->lot_id}} </td>
                            <td  data-title="Delivery Id">      {{$c->delivery_id}}   </td>
                            <td  data-title="Delivery Type">{{$c->delivery_type}}</td>
                            <td  data-title="Item Name">{{$lot_id->Items->item_name}}</td>
                            <td  data-title="Delivery Detail">{{$c->delivery_details}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                         @else
                    
                    <h3>Delivery Lots Are Not Available</h3>
                    @endif
            </div>
            </div>

        </div>
        
    </div>

</div>

@endsection