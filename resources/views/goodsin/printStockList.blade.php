<html>
    <head>
        <title>Stock List</title>
        
    </head>
    <body>
        <table width='100%' cellspacing="0%" cellpadding="5%">
            
          <tr>
                <td  colspan="2" style="border-bottom: 2px solid #000;"><img height="120px"width="120px" style="margin-top: 0px;" src="{{asset('assets/images/adept-logo.jpg')}}"></td>
                <td  colspan="3" style="border-bottom: 2px solid #000; text-align: right;"><b>ADEPT ELEVATOR STORAGE AND DISTRIBUTION</b><br />6 Butterly Avenue<br />Questor<br />Hawley Road<br />Dartford<br />Kent,DA1 1JG<br /><br />Tel: 01322-626550<br />Fax: 01322-228239</td>
            </tr>
                
<!--            <tr>
                <td colspan='5' style="border-top: 2px solid #000;">&nbsp;</td>
            </tr>-->
         <tr>
                
                <td colspan="5"><h2><center>STOCK REPORT</center></h2></div></td>
            </tr>
                        <tr><td colspan='5' >&nbsp;</td></tr>
            
            <tr>
                <td colspan="5" ><strong>PROJECT NAME:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$goodsin->project_name}}</strong></td>
            </tr>

            <tr><td colspan='5' >&nbsp;</td></tr>
            <tr><td colspan='5' >&nbsp;</td></tr>
             <tr>
                 <td colspan="5" style="text-align:right;"><strong>GOODS IN NUMBER:&nbsp;{{$goodsin->goodsin_id}}</strong></td>
             </tr>
             <tr><td colspan='5' >&nbsp;</td></tr>
            
            <tr><td colspan='5' >&nbsp;</td></tr>
            <tr>
                <td colspan="5" style='text-align:right;'><strong>GOODS IN DATE:&nbsp;{{\App\Libraries\ZnUtilities::format_date($goodsin->goods_in_date,10)}}</strong></td>
            </tr>
            <tr><td colspan='5' >&nbsp;</td></tr>
            <tr>
                <th colspan="1"  style="border-top: 1px solid #000;border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000; ">LOT</br>  NUMBER</th>
                <th colspan="1" style="border-top: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000; ">GOODS IN</br> DETAILS</th>
                <th colspan="1" style="border-top: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000; ">DELIVERY</br> COMMENTS</th>
                <th colspan="1" style="border-top: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000; ">DELIVERY</br> STATUS</th>
                <th colspan="1" style="border-top: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000; ">VOLUME </br> LEFT</th>
                
            </tr>
            <?php $count=array();?>
          @foreach($lots as $k=>$l)
         @if(!in_array($l->lot_id,$deliver_lots))
          <?php
          $delivery_lot = App\Models\DeliveryLot::where('goodsin_id',$l->goodsin_id)->where('lot_id',$l->lot_id)->lists('volume_to_deliver')->toArray();
          
          $delivery = App\Models\DeliveryLot::where('goodsin_id',$l->goodsin_id)->where('lot_id',$l->lot_id)->orderBy('lot_id','DESC')->first();
          $delivery_date = App\Models\Delivery::where('id',isset($delivery)?$delivery->delivery_id:'')->pluck('delivery_date');
         // \App\Libraries\ZnUtilities::pa($delivery_date);
          if($goodsin->goodsin_type!='Daily/Volume'){
               $total_vol = trim($l->volume);
//
          
          $deliverd_lot = trim(array_sum($delivery_lot));
         //   if($total_vol==$deliverd_lot){exit();}
          if($total_vol!=$deliverd_lot){
              if(isset($delivery)?$delivery->delivery_type:''!='Full'){
       //\App\Libraries\ZnUtilities::pa($total_vol-$deliverd_lot);
  // \App\Libraries\ZnUtilities::pa($deliverd_lot);
              $count =$l->lot_id;
            ?>
        
          <tr>
                <td colspan='1' style=" border-left: 1px solid #000;border-right: 1px solid #000;">{{$l->lot_id}}</td>
                <td colspan='1' style="border-right: 1px solid #000;">{{isset($delivery)? $delivery->goods_in_details:$l->Items->item_name}}</td>
                <td colspan='1'style="border-right: 1px solid #000;">{{ isset($delivery)? $delivery->delivery_details:'' }}</td>
                <td colspan='1'style="border-right: 1px solid #000;">{{(isset($delivery_date)?$delivery->delivery_type:'') == 'Part' ?'PART DELIVERED':'NOT DELIVERED'}}</td>
                <td colspan='1' style="border-right: 1px solid #000;"><?php if($l->goodsin_type=='Weekly/Dimension'){echo $total_vol - array_sum($delivery_lot); }?></td>
             </tr>
          <?php }} }else{
             
           //   $total_vol = trim($l->volume);
//
          
         // $deliverd_lot = trim(array_sum($delivery_lot));
         //   if($total_vol==$deliverd_lot){exit();}
          
              if(isset($delivery)?$delivery->delivery_type:''!='Full'){
       //\App\Libraries\ZnUtilities::pa($total_vol-$deliverd_lot);
  // \App\Libraries\ZnUtilities::pa($deliverd_lot);
              $count =$l->lot_id;
            ?>
        
          <tr>
                <td colspan='1' style=" border-left: 1px solid #000;border-right: 1px solid #000;">{{$l->lot_id}}</td>
                <td colspan='1' style="border-right: 1px solid #000;">{{isset($delivery)? $delivery->goods_in_details:$l->Items->item_name}}</td>
                <td colspan='1'style="border-right: 1px solid #000;">{{ isset($delivery)? $delivery->delivery_details:'' }}</td>
              <td colspan='1'style="border-right: 1px solid #000;">{{(isset($delivery_date)?$delivery->delivery_type:'') == 'Part' ?'PART DELIVERED':'NOT DELIVERED'}}</td>
                <td colspan='1' style="border-right: 1px solid #000;"></td>
             </tr>
          <?php } 
           
          }?>
            @endif
           @endforeach
            
           @if(count($count)==0)<tr><td colspan='5' ><h3>No Item in Stock!</h3></td></tr>
           @else
           <tr>
               <td colspan='5' style="border-top: 1px solid #000;">&nbsp;</td>
           </tr>
           @endif
         
          
          
        </table>
         
    </body>
</html>