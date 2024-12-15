@extends('layouts.master')

@section('content')


<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><a href="/delivery/{{$id}}/">Delivery</a></li>
                <li><a href="/showAddress/{{$id}}/">Address</a></li>
                <li><a href="/delivery/notes/{{$id}}/">Notes</a></li>
                <li  class="active"><a href="/delivery/lots/{{$id}}/">Select Lots To Be Delivered</a></li>
            </ul>
        </div><!-- nav-tabs-custom -->
    </div><!-- /.col -->
</div>

<div class="row">
    <form  role="form" name='user_form' id='user_form' action="/delivery/lots/save" method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="delivery_id" value="{{$id}}">
        <input type="hidden" name="goodsin_id" value="{{$delivery->goodsin_id}}">
        

              @foreach($lots as $k=>$l)
              @if($k%2==0)
              <div class="row">
              @endif
              <div class="col-md-6">
              <input type="hidden" name="lot_id[{{$l->lot_id}}]" value="{{$l->lot_id}}">
              <div id="div_{{$l->lot_id}}"  >
              <div class="box box-primary">
                @if(isset($delivery_lots)) <?php //$goodsin = App\Models\GoodsIn::find($l->goodsin_id);
                         $current_delivery = \App\Models\DeliveryLot::where('lot_id',$l->lot_id)->where('delivery_id',$id)->first();?> @endif
                   <?php if(isset($goodsin)?$goodsin->goodsin_type:''=='Weekly/Dimension'){
                         $old_vol = App\Models\DeliveryLot::where('goodsin_id', $l->goodsin_id)->where('lot_id', $l->lot_id)->lists('volume_to_deliver')->toArray();
                   $total_o = array_sum($old_vol);
                   }
                   else{
                       $old_vol = App\Models\GoodsIn::where('goodsin_id', $l->goodsin_id)->pluck('total_volume');
                      
                      $total_o = $old_vol;
                   } 
                //  echo Date('H:i:s');die;
                          //<!--@else Volume Left:{{$l->volume - $total_old}}-->
                          ?>
                 <div class="box-body">
                     <div class="row">
                      <div class="col-md-4">
                            <div class="form-group checkbox-inline">
                                <input type="checkbox" class="check" {{(in_array($l->lot_id,$prev_full_lot))&&!isset($current_delivery)?'disabled="disabled"':''}} name="cid[{{$l->lot_id}}]"  @if(isset($delivery_lots)) {{in_array($l->lot_id,$all_lots)?'checked=checked':''}} @endif id="check_{{$l->lot_id}}" value="1" onchange="Check(this.value,{{$l->lot_id}})" />
                              <span  for="check" >Lot {{$l->lot_id}}</span>
                            
                            </div>
                        </div>
                      
                         <div class="col-md-4">
                            <div class="form-group"> 
                                <label for="InputEmail">Type Of Note</label><br>
                                <label class="radio-inline">
                                    <input   type="radio" name="type_of_note[{{$l->lot_id}}]" {{(in_array($l->lot_id,$prev_full_lot))&&!isset($current_delivery)?'disabled="disabled"':''}} class="radio_{{$l->lot_id}}" @if(isset($current_delivery)) {{$current_delivery->delivery_type=='Full'?'checked=checked':''}} @endif id="Full_{{$l->lot_id}}" onchange="Radio(this.value,{{$l->lot_id}})" value="Full"   >Full
                                </label>
                                <label class="radio-inline">
                                    <input   type="radio" name="type_of_note[{{$l->lot_id}}]" {{(in_array($l->lot_id,$prev_full_lot))&&!isset($current_delivery)?'disabled="disabled"':''}} class="radio_{{$l->lot_id}}" @if(isset($current_delivery)) {{$current_delivery->delivery_type=='Part'?'checked=checked':''}} @endif id="Part_{{$l->lot_id}}" onchange="Radio(this.value,{{$l->lot_id}})" value="Part"  >Part
                                </label>
                                
                                 
                            </div>
                     </div>
                         <?php 
                         $old_volume = App\Models\DeliveryLot::where('delivery_id','!=', $id)->where('goodsin_id', $l->goodsin_id)->where('lot_id', $l->lot_id)->lists('volume_to_deliver')->toArray();
                         $old_type = App\Models\DeliveryLot::where('delivery_id',$id)->where('goodsin_id', $l->goodsin_id)->where('lot_id', $l->lot_id)->pluck('delivery_type');
                         // $total_volume = App\Models\Lot::where('goodsin_id', $request->goodsin_id)->where('lot_id', $request->lot_id[$k])->pluck('volume');
                          $total_old = array_sum($old_volume); 
                          //<!--@else Volume Left:{{$l->volume - $total_old}}-->
                          //\App\Libraries\ZnUtilities::pa($goodsin);die;
                          ?>
                         <div class="col-md-4">
                             <div class="form-group"> 
                                 <input class="form-control" name="goods_in_detail[{{$l->lot_id}}]" id="goods_in_detail_{{$l->lot_id}}" {{(in_array($l->lot_id,$prev_full_lot))&&!isset($current_delivery)?'disabled="disabled"':''}}  value="{{strip_tags($l->Items->item_name)}}" readonly />
                                 <label for="lot_detail" class="control-label">Details</label>
                                 
                                <input class="form-control" name="lot_detail[{{$l->lot_id}}]" id="lot_detail_{{$l->lot_id}}" {{(in_array($l->lot_id,$prev_full_lot))&&!isset($current_delivery)?'disabled="disabled"':''}}  value="@if(isset($current_delivery)) {{$current_delivery->delivery_details}} @endif" />
                                
                                <!--<div id="volume_div" class="control-label"  style="display:@if(isset($goodsin)?$goodsin->goodsin_type:''=='Daily/Volume') {{'none'}} @else {{'block'}}@endif"><b>Volume To Deliver(Total={{$l->volume}})</b>-->
                                <div id="volume_div" class="control-label volume_div"  ><b>Volume To Deliver(Total={{$l->volume}})</b>
                                 <input class="form-control" name="volume_to_deliver[{{$l->lot_id}}]" id="volume_to_deliver_{{$l->lot_id}}" {{(in_array($l->lot_id,$prev_full_lot))&&!isset($current_delivery)?'disabled="disabled"':''}} value="@if(isset($current_delivery)){{ $current_delivery->volume_to_deliver }}  @endif " />
                                
                              </div>
                                <input type="hidden" class="" id="goodsin_type"name='goodsin_type[{{$l->lot_id}}]'  value="{{isset($goodsin)?$goodsin->goodsin_type:''}}" />
                                <!--<input type="hidden" id="lot_id"  value="{{$l->lot_id}}" />-->
                             </div>
                         </div>
                         
                     </div>

                </div><!-- /.box-body-->
             
            </div>
              </div>
              </div>
              @if($k%2!=0)
              </div>
              @endif
              @endforeach
        
        <div class="clearfix"></div>
        <div class="form-group">
       <div class="col-md-6">
        <input type="hidden" class="" id="goodsin_type_daily"name='goodsin_type'  value="{{isset($goodsin)?$goodsin->goodsin_type:''}}" />

           
           <input type="submit" class="btn btn-primary pull-right" name="submit" value="Save">
       </div>
        <div class="col-md-6 ">
             <a class="btn btn-info" href='/printTransportOrder/{{$id}}' target="_blank" >Print Transport Order</a>&nbsp;
            <a class="btn btn-info" href='/printPickingList/{{$id}}'  target="_blank" >Print Picking List</a>&nbsp;
            <a class="btn btn-info" href='/printDelivery/{{$id}}' target="_blank" >Print Delivery</a>&nbsp;
            <a class="btn btn-info" href="/printTransportInvoiceRequest/{{$id}}" target="_blank" >Print Transport Invoice Request</a>
        </div>
        </div>
        <div class="row">
            
        </div>
    </form>
</div>

@endsection