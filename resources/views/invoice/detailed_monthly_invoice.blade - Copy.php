<html>
    <head>
        <title>{{$title}}</title>
        <style>
            body {
                /* can use also 'landscape' for orientation */
                margin: 2%;
            } 
            table{
                margin: 2%;
            }

        </style>
    </head>
    <body>
        <table width='100%' cellspacing="0.00001%" cellpadding="5px">
            
            <tr>
                <td  colspan="4" style="border-bottom: 2px solid #000; font-size: 14px;"><img height="120px"width="120px" style="margin-top: 0px;" src="{{asset('assets/images/adept-logo.jpg')}}"></td>
                <td  colspan="6" style=" border-bottom: 2px solid #000; text-align: right;"><b>ADEPT ELEVATOR STORAGE AND DISTRIBUTION</b><br />6 Butterly Avenue<br />Questor<br />Hawley Road<br />Dartford<br />Kent,DA1 1JG<br /><br />Tel: 01322-626550<br />Fax: 01322-2210239</td>
            </tr>
            <!--<tr><td colspan='10' style="border-bottom:2px solid #000; font-size: 14px;" >&nbsp;</td></tr>-->
            <tr>

                <td colspan="10"><h2><center>INVOICE</center></h2></div></td>
            </tr>
            <?php $client = App\Models\Client::find($client_id); ?>
            <tr rowspan="6">
                <td  colspan="10"> <strong>CLIENT:</strong><br />
                    {{$client->client_name}}<br />
                    {{$client->client_address_line_2}}<br />
                    {{$client->city}}<br />
                    {{$client->county}}<br />
                    {{$client->postcode}}<br />
                </td>

            </tr>
            <tr><td colspan='10' >&nbsp;</td></tr>
            <tr>
                <td colspan="10" style="text-align:right;"><strong>INVOICE REPORT MONTH:&nbsp;&nbsp;&nbsp;{{Config::get('month.month')[$dateM].'  '.$dateY}}</strong></td>
            </tr>
            <tr><td colspan='10' >&nbsp;</td></tr>


            <tr>
                <th rowspan="2" colspan="1"  style="text-align:center;border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000; font-size: 14px;">JOB NO.</th>
                <th rowspan="2"colspan="1" style="text-align:center;border-top:1px solid #000;border-right:1px solid #000; font-size: 14px;">PROJECT NAME</th>
                <th rowspan="2" colspan="1" style="text-align:center;border-top:1px solid #000;border-right:1px solid #000; font-size: 14px;">CLIENT ORDER NUMBER</th>
                <th rowspan="1" colspan="4" style=" width: 25%; text-align:center;border-bottom:1px solid #000;border-top:1px solid #000;border-right:1px solid #000; font-size: 14px;">STORAGE PERIOD</th>

                <th rowspan="2" colspan="1" style="width: 10%; text-align:center;border-top:1px solid #000;border-right:1px solid #000; font-size: 14px;">STORAGE CHARGE</th>
                <th rowspan="2" colspan="1" style="text-align:center;border-top:1px solid #000;border-right:1px solid #000; font-size: 14px;">HANDLING CHARGE</th>
                <!--<th rowspan="2" colspan="1" style="text-align:center;border-bottom:1px solid #000;border-top:1px solid #000;border-right:1px solid #000; font-size: 14px;">LOADING CHARGE</th>-->
                <th rowspan="2" colspan="1" style="text-align:center;border-top:1px solid #000;border-right:1px solid #000; font-size: 14px;">TOTAL CHARGE</th>

            </tr>
            <tr>
                <th colspan="2" style="text-align:left;border-right:1px solid #000; font-size: 14px;">
                    &nbsp; FROM &nbsp;
                </th>
                <th colspan="2" style="text-align:left;border-right:1px solid #000; font-size: 14px;">
                    &nbsp;  TILL  &nbsp;
                </th>
            </tr>
            <?php $total = array();  ?>
            @foreach($jobs as $k=>$j)
            @if(in_array($j->id,$array) && count($array)>0)

            <?php 
            if ($j->job_type == "Weekly/Dimension") {
                $charge_rate = array();
                  
                $lots = \App\Models\Lot::where('job_id', $j->id)->get();
             
                $month = $dateM;
                $year = $dateY;
                
                $start_date = date($year . '-' . $month . '-01' ,  strtotime('this month'));
                $month_last   = date($year . '-' . $month . '-t', strtotime('this month'));
                
               
                $del = App\Models\Delivery::where('job_id', $j->id)->orderBy('id', 'DESC')->first();
         
                    ?>
                    @foreach($lots as $l)
                    <?php
//                      
                    $delivery_lot = App\Models\DeliveryLot::where('job_id', $j->id)->where('lot_id',$l->lot_id)->orderBy('delivery_id', 'DESC')->first();
                    $volume_delivered = App\Models\DeliveryLot::where('job_id', $j->id)->where('lot_id',$l->lot_id)->lists('volume_to_deliver')->toArray();
                   // \App\Libraries\ZnUtilities::pa($delivery_lot);
                    $charge_rate = array();
                    if($delivery_lot) {
                      
                     $delivery = App\Models\Delivery::where('id',$delivery_lot->delivery_id)->first();
                    
                      if($delivery){
                   //App\Libraries\ZnUtilities::pa($delivery);die;
                    if(strtotime($delivery->delivery_date) > strtotime($start_date)||$delivery_lot->delivery_type!="Full"&&trim(array_sum($volume_delivered))!=trim($l->volume)){
                     if($delivery_lot->delivery_type=="Full"||trim(array_sum($volume_delivered))==trim($l->volume)){
                      $till_date = $delivery->delivery_date;
                        //$loading_charge = $delivery->loading_charge;
                      }else{ //die('here');  
                          $till_date = '';
                         // $loading_charge='0.00';
                      }
                        // die('here'); 
                         // App\Libraries\ZnUtilities::pa($till_date); die;
                      $goods_in_date = $l->goods_in_date;
                    $last_date =  $goods_in_date;
                    
                     $goods_in_d = explode('-', $goods_in_date);
                      if($goods_in_d[1]==$dateM){
                        $handling_charge = $j->handling_charge;
                    }else{
                        $handling_charge = '0.00';
                    }
                    if ($goods_in_d[1] != $dateM) {
                        $goods_in_d[1] = $dateM;
                        $goods_in_da = implode('-', $goods_in_d);
                        $goods_in_date = date("Y-m-01", strtotime($goods_in_da));
                       if (date('l',  strtotime($goods_in_date)) != "Monday"){
//                           $lastmonth = date('Y-m-d', strtotime('-1 month', strtotime($goods_in_date)));
                        $goods_in_date = date('Y-m-d',strtotime($goods_in_date.'last monday'));
                          $last_date =  date('Y-m-t', strtotime('+1 month', strtotime($goods_in_date)));
                        
                       }else{
                            $last_date =  date('Y-m-t', strtotime($goods_in_date));
                       }
                    }
                    if ($goods_in_d[0] != $dateY) {

                        $goods_in_d[0] = $dateY;
                        $goods_in_da = implode('-', $goods_in_d);
                        $goods_in_date = date("Y-m-01", strtotime($goods_in_date));
                        if (date('l',  strtotime($goods_in_date)) != "Monday"){
//                           $lastmonth = date('Y-m-d', strtotime('-1 month', strtotime($goods_in_date)));
                         $goods_in_date = date('Y-m-d',strtotime($goods_in_date.'last monday'));
                          $last_date =  date('Y-m-t', strtotime('+1 month', strtotime($goods_in_date)));
                         
                       }else{
                            $last_date =  date('Y-m-t', strtotime($goods_in_date));
                       }
                    }
                 //  echo $till_date;
          
                    if ($till_date != '') {
                        $till_d = explode('-', $till_date);
                        //$check_month = substr($till_date,5,2);
                        
                        if ($till_d[1] != $dateM) {

                            $till_d[1] = $dateM;
                            $till_da = implode('-', $till_d);
                            $last_date = date("Y-m-t", strtotime($till_da));
                            if (date('l',  strtotime($last_date)) != "Sunday"){
                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday '));
                        //\App\Libraries\ZnUtilities::pa($last_sunday);die;
                            }
                              $till_date = $last_date;
                            
                        }
                        if ($till_d[0] != $dateY) {

                            $till_d[0] = $dateY;
                            $till_da = implode('-', $till_d);
                           $last_date = date("Y-m-t", strtotime($till_da));
                               if (date('l',  strtotime($last_date)) != "Sunday"){
                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday '));
                        //\App\Libraries\ZnUtilities::pa($last_sunday);die;
                               }
                              $till_date = $last_date;
                        }
                        
                        $total_vol = trim($l->volume);
                        if($total_vol!=array_sum($volume_delivered)){
                        if((isset($delivery_lot)?$delivery_lot->delivery_type:'')!='Full'){

                       $last_date= date("Y-m-t", strtotime($till_date));
                       if(date('l',strtotime($last_date))!=='Sunday'){
                       
                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday'));
                       // \App\Libraries\ZnUtilities::pa($last_date);die;
                           }
                              $till_date= $last_date;

                        } }
                    } else if ($till_date == '') {
//                        $last_date= date("Y-m-t", strtotime($goods_in_date));
//                       $last_date =  date('Y-m-t', strtotime('+1 month', strtotime($goods_in_date)));
//                        if (date('l',  strtotime($last_date)) != "Sunday"){
//                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday '));
//                        //\App\Libraries\ZnUtilities::pa($last_sunday);die;
//                        }
//                              $till_date = $last_date;
                        
                        
                         if(date('l',strtotime($last_date))!=='Sunday'){
                               $last_date= date("Y-m-t", strtotime($last_date));  
                              if(date('l',strtotime($last_date))!=='Sunday'){ 
                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday'));
                              }
                       // \App\Libraries\ZnUtilities::pa($last_date);die;
                                 
                           }else{
                           
                            $last_date = date('Y-m-t',strtotime($last_date)); 
                             if(date('l',strtotime($last_date))!=='Sunday'){ 
                            $last_date = date('Y-m-d',strtotime($last_date.'last sunday')); 
                             }
                           }
//                        echo $last_date.'newwwwwww';
                        $till_date = $last_date;
                    } 
                    
                //\App\Libraries\ZnUtilities::pa($till_date);die;
                     $monday = array();
                            $startdate = strtotime($goods_in_date);
                            $endDate = strtotime($till_date);

                            for ($i = strtotime('Monday', $startdate); $i <= $endDate; $i = strtotime('+1 week', $i)) {

                                $monday[] = (date('l Y-m-d', $i));
                            }

                            $count = count($monday);
                            // echo $count;
                            if (date('l', $startdate) != "Monday") {
                                $count = $count + 1;
   
                            }
//                           
//                               \App\Libraries\ZnUtilities::pa($till_date);
//                            \App\Libraries\ZnUtilities::pa($j->id.'  Lot'.$l->lot_id);
//                            \App\Libraries\ZnUtilities::pa('volume'.$l->volume);
//                            \App\Libraries\ZnUtilities::pa('goods_in_date'.$goods_in_date);
//                            \App\Libraries\ZnUtilities::pa('till_date'.$till_date);
//                            \App\Libraries\ZnUtilities::pa('count'.$count);
//                            \App\Libraries\ZnUtilities::pa('charge_rate'.$j->charge_rate);
//                            \App\Libraries\ZnUtilities::pa('total  '.$count*$l->volume*$j->charge_rate);
                           if($till_date){
                    $delivery_old = App\Models\Delivery::where('job_id', $j->id)->where('delivery_date','<',date($dateY.'-'.$dateM.'-01'))->orderBy('job_delivery_id','ASC')->get();    
                   $volume_delivered1 = array();
             
                    if(isset($delivery_old)){
                        
                    foreach($delivery_old as $do) {
                  
                        $dilerdatemon =explode('-',$do->delivery_date);
                       
//                         echo $dateM;
                     if(trim($dilerdatemon[1]) != trim($dateM))  { 
                    $volume_delivered1[] = App\Models\DeliveryLot::where('job_id', $j->id)->where('lot_id',$l->lot_id)->where('delivery_id',$do->id)->pluck('volume_to_deliver');           
//                     App\Libraries\ZnUtilities::pa($volume_delivered1); die;
                     }else{
                     $volume_delivered1[] ='0';   
                    }
                    }
                    }
                         
                    $charge_rate[]=$count*(trim($l->volume) - trim(array_sum($volume_delivered1)))*$j->charge_rate;
//                     \App\Libraries\ZnUtilities::pa(trim($l->volume));
//                     \App\Libraries\ZnUtilities::pa(trim(array_sum($volume_delivered1)));
                  }    }else{
                        
                        
                        
                         $till_date = '';
                        $goods_in_date = $l->goods_in_date;
                         $last_date =  $goods_in_date;
                     $goods_in_d = explode('-', $goods_in_date);
                     
                      if($goods_in_d[1]==$dateM){
                        $handling_charge = $j->handling_charge;
                    }else{
                        $handling_charge = '0.00';
                    }
                    if ($goods_in_d[1] != $dateM) {
                        $goods_in_d[1] = $dateM;
                        $goods_in_da = implode('-', $goods_in_d);
                        $goods_in_date = date("Y-m-01", strtotime($goods_in_da));
                         if (date('l',  strtotime($goods_in_date)) != "Monday"){
//                           $lastmonth = date('Y-m-d', strtotime('-1 month', strtotime($goods_in_date)));
                         $goods_in_date = date('Y-m-d',strtotime($goods_in_date.'last monday'));
                          $last_date =  date('Y-m-t', strtotime('+1 month', strtotime($goods_in_date)));
                           
                       }else{
                            $last_date =  date('Y-m-t', strtotime($goods_in_date));
                       }
                    }
                    if ($goods_in_d[0] != $dateY) {

                        $goods_in_d[0] = $dateY;
                        $goods_in_da = implode('-', $goods_in_d);
                        $goods_in_date = date("Y-m-01", strtotime($goods_in_da));
                       if (date('l',  strtotime($goods_in_date)) != "Monday"){
//                           $lastmonth = date('Y-m-d', strtotime('-1 month', strtotime($goods_in_date)));
                         $goods_in_date = date('Y-m-d',strtotime($goods_in_date.'last monday'));
                          $last_date =  date('Y-m-t', strtotime('+1 month', strtotime($goods_in_date)));
                         
                       }else{
                            $last_date =  date('Y-m-t', strtotime($goods_in_date));
                       }
                    }
                     ;
                    //$till_date = $delivery->delivery_date;
           
                    if ($till_date != '') {
                        $till_d = explode('-', $till_date);
                        //$check_month = substr($till_date,5,2);

                        if ($till_d[1] != $dateM) {

                            $till_d[1] = $dateM;
                            $till_da = implode('-', $till_d);
                            $last_date = date("Y-m-t", strtotime($till_da));
                            if (date('l',  strtotime($last_date)) != "Sunday"){
                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday '));
                        //\App\Libraries\ZnUtilities::pa($last_sunday);die;
                            }
                              $till_date = $last_date;
                        }
                        if ($till_d[0] != $dateY) {

                            $till_d[0] = $dateY;
                            $till_da = implode('-', $till_d);
                            $last_date = date("Y-m-t", strtotime($till_da));
                            if (date('l',  strtotime($last_date)) != "Sunday"){
                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday '));
                        //\App\Libraries\ZnUtilities::pa($last_sunday);die;
                            }
                              $till_date = $last_date;
                        }
                        $total_vol = trim($l->volume);
                        if($total_vol!=array_sum($volume_delivered)){
                        if((isset($delivery_lot)?$delivery_lot->delivery_type:'')!='Full'){

                       $last_date= date("Y-m-t", strtotime($till_date));
                       if(date('l',strtotime($last_date))!=='Sunday'){
                       
                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday'));
                       // \App\Libraries\ZnUtilities::pa($last_date);die;
                           }
                              $till_date= $last_date;

                        } }
//                    } else if ($till_date == '') {
////                          $last_date= date("Y-m-t", strtotime($goods_in_date));
////                      $last_date =  date('Y-m-t', strtotime('+1 month', strtotime($goods_in_date)));
//                
//                         // \App\Libraries\ZnUtilities::pa(date('l',  strtotime($last_date))));die;
//                         if (date('l',  strtotime($last_date)) != "Sunday"){
//                             
//                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday '));
//                     
//                         }
//                              $till_date = $last_date;
//                       // \App\Libraries\ZnUtilities::pa($till_date);die;
                    } 
                        else if ($till_date == '') {
                           
//                          $last_date= date("Y-m-t", strtotime($goods_in_date));
//                        $last_date =  date('Y-m-t', strtotime('+1 month', strtotime($goods_in_date)));
                       
                       if(date('l',strtotime($last_date))!=='Sunday'){
                               $last_date= date("Y-m-t", strtotime($last_date));  
                              if(date('l',strtotime($last_date))!=='Sunday'){ 
                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday'));
                              }
                       // \App\Libraries\ZnUtilities::pa($last_date);die;
                                 
                           }else{
                           
                            $last_date = date('Y-m-t',strtotime($last_date)); 
                             if(date('l',strtotime($last_date))!=='Sunday'){ 
                            $last_date = date('Y-m-d',strtotime($last_date.'last sunday')); 
                             }
                           }
//                        echo $last_date.'newwwwwww';
                        $till_date = $last_date;
//                        $till_date = date('Y-m-d',strtotime($till_date.'last sunday'));;
                        
                    } 
            
                    
                     $monday = array();
                            $startdate = strtotime($goods_in_date);
                            $endDate = strtotime($till_date);

                            for ($i = strtotime('Monday', $startdate); $i <= $endDate; $i = strtotime('+1 week', $i)) {

                                $monday[] = (date('l Y-m-d', $i));
                            }

                            $count = count($monday);
                            // echo $count;
                            if (date('l', $startdate) != "Monday") {
                                $count = $count + 1;
   
                            }
//                           
//                               \App\Libraries\ZnUtilities::pa($till_date);
//                            \App\Libraries\ZnUtilities::pa($j->id.'Lot'.$l->lot_id);
//                            \App\Libraries\ZnUtilities::pa('volume'.$l->volume);
//                            \App\Libraries\ZnUtilities::pa('goods_in_date'.$goods_in_date);
//                            \App\Libraries\ZnUtilities::pa('till_date'.$till_date);
//                            \App\Libraries\ZnUtilities::pa('count'.$count);
//                            \App\Libraries\ZnUtilities::pa('charge_rate'.$j->charge_rate);
//                            \App\Libraries\ZnUtilities::pa('total  '.$count*$l->volume*$j->charge_rate);
                            
                    $charge_rate[]= '0' *$l->volume*$j->charge_rate;
                    
                    }
                       
                    }} else{
                        $till_date = '';
                        $goods_in_date = $l->goods_in_date;
                         $last_date =  $goods_in_date;
                     $goods_in_d = explode('-', $goods_in_date);
                     
                      if($goods_in_d[1]==$dateM){
                        $handling_charge = $j->handling_charge;
                    }else{
                        $handling_charge = '0.00';
                    }
                    if ($goods_in_d[1] != $dateM) {
                        $goods_in_d[1] = $dateM;
                        $goods_in_da = implode('-', $goods_in_d);
                        $goods_in_date = date("Y-m-01", strtotime($goods_in_da));
                         if (date('l',  strtotime($goods_in_date)) != "Monday"){
//                           $lastmonth = date('Y-m-d', strtotime('-1 month', strtotime($goods_in_date)));
                         $goods_in_date = date('Y-m-d',strtotime($goods_in_date.'last monday'));
                          $last_date =  date('Y-m-t', strtotime('+1 month', strtotime($goods_in_date)));
                           
                       }else{
                            $last_date =  date('Y-m-t', strtotime($goods_in_date));
                       }
                    }
                    if ($goods_in_d[0] != $dateY) {

                        $goods_in_d[0] = $dateY;
                        $goods_in_da = implode('-', $goods_in_d);
                        $goods_in_date = date("Y-m-01", strtotime($goods_in_da));
                       if (date('l',  strtotime($goods_in_date)) != "Monday"){
//                           $lastmonth = date('Y-m-d', strtotime('-1 month', strtotime($goods_in_date)));
                         $goods_in_date = date('Y-m-d',strtotime($goods_in_date.'last monday'));
                          $last_date =  date('Y-m-t', strtotime('+1 month', strtotime($goods_in_date)));
                         
                       }else{
                            $last_date =  date('Y-m-t', strtotime($goods_in_date));
                       }
                    }
                     ;
                    //$till_date = $delivery->delivery_date;
           
                    if ($till_date != '') {
                        $till_d = explode('-', $till_date);
                        //$check_month = substr($till_date,5,2);

                        if ($till_d[1] != $dateM) {

                            $till_d[1] = $dateM;
                            $till_da = implode('-', $till_d);
                            $last_date = date("Y-m-t", strtotime($till_da));
                            if (date('l',  strtotime($last_date)) != "Sunday"){
                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday '));
                        //\App\Libraries\ZnUtilities::pa($last_sunday);die;
                            }
                              $till_date = $last_date;
                        }
                        if ($till_d[0] != $dateY) {

                            $till_d[0] = $dateY;
                            $till_da = implode('-', $till_d);
                            $last_date = date("Y-m-t", strtotime($till_da));
                            if (date('l',  strtotime($last_date)) != "Sunday"){
                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday '));
                        //\App\Libraries\ZnUtilities::pa($last_sunday);die;
                            }
                              $till_date = $last_date;
                        }
                        $total_vol = trim($l->volume);
                        if($total_vol!=array_sum($volume_delivered)){
                        if((isset($delivery_lot)?$delivery_lot->delivery_type:'')!='Full'){

                       $last_date= date("Y-m-t", strtotime($till_date));
                       if(date('l',strtotime($last_date))!=='Sunday'){
                       
                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday'));
                       // \App\Libraries\ZnUtilities::pa($last_date);die;
                           }
                              $till_date= $last_date;

                        } }
//                    } else if ($till_date == '') {
////                          $last_date= date("Y-m-t", strtotime($goods_in_date));
////                      $last_date =  date('Y-m-t', strtotime('+1 month', strtotime($goods_in_date)));
//                
//                         // \App\Libraries\ZnUtilities::pa(date('l',  strtotime($last_date))));die;
//                         if (date('l',  strtotime($last_date)) != "Sunday"){
//                             
//                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday '));
//                     
//                         }
//                              $till_date = $last_date;
//                       // \App\Libraries\ZnUtilities::pa($till_date);die;
                    } 
                        else if ($till_date == '') {
                           
//                          $last_date= date("Y-m-t", strtotime($goods_in_date));
//                        $last_date =  date('Y-m-t', strtotime('+1 month', strtotime($goods_in_date)));
                       
                       if(date('l',strtotime($last_date))!=='Sunday'){
                               $last_date= date("Y-m-t", strtotime($last_date));  
                              if(date('l',strtotime($last_date))!=='Sunday'){ 
                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday'));
                              }
                       // \App\Libraries\ZnUtilities::pa($last_date);die;
                                 
                           }else{
                           
                            $last_date = date('Y-m-t',strtotime($last_date)); 
                             if(date('l',strtotime($last_date))!=='Sunday'){ 
                            $last_date = date('Y-m-d',strtotime($last_date.'last sunday')); 
                             }
                           }
//                        echo $last_date.'newwwwwww';
                        $till_date = $last_date;
//                        $till_date = date('Y-m-d',strtotime($till_date.'last sunday'));;
                        
                    } 
            
                    
                     $monday = array();
                            $startdate = strtotime($goods_in_date);
                            $endDate = strtotime($till_date);

                            for ($i = strtotime('Monday', $startdate); $i <= $endDate; $i = strtotime('+1 week', $i)) {

                                $monday[] = (date('l Y-m-d', $i));
                            }

                            $count = count($monday);
                            // echo $count;
                            if (date('l', $startdate) != "Monday") {
                                $count = $count + 1;
   
                            }
//                           
//                               \App\Libraries\ZnUtilities::pa($till_date);
//                            \App\Libraries\ZnUtilities::pa($j->id.'Lot'.$l->lot_id);
//                            \App\Libraries\ZnUtilities::pa('volume'.$l->volume);
//                            \App\Libraries\ZnUtilities::pa('goods_in_date'.$goods_in_date);
//                            \App\Libraries\ZnUtilities::pa('till_date'.$till_date);
//                            \App\Libraries\ZnUtilities::pa('count'.$count);
//                            \App\Libraries\ZnUtilities::pa('charge_rate'.$j->charge_rate);
//                            \App\Libraries\ZnUtilities::pa('total  '.$count*$l->volume*$j->charge_rate);
                            
                    $charge_rate[]=$count* $l->volume *$j->charge_rate;
                    
                    }
                    
                  
                         ?>
                   
               

                        
                       <?php //  $delivery = App\Models\Delivery::where('job_id', $j->id)->orderBy('id', 'DESC')->first();
                    
                    
//                    if($delivery){
//                        $till_date = $delivery->delivery_date; 
//                      //  $loading_charge = $delivery->loading_charge;
//                      }else{
//                          $till_date = '';
//                          //$loading_charge='0.00';
//                      }
//                      $goods_in_date = $j->goods_in_date;
//                      $last_date = $goods_in_date;
//                      
//                    $goods_in_date_month = substr($goods_in_date,5,2);
//                    if($goods_in_date_month==$dateM){
//                        $handling_charge = $j->handling_charge;
//                    }else{
//                        $handling_charge = '0.00';
//                    }
//                    
//                     $goods_in_d = explode('-', $goods_in_date);
//
//                    if ($goods_in_d[1] != $dateM) {
//                        $goods_in_d[1] = $dateM;
//                        $goods_in_da = implode('-', $goods_in_d);
//                        $goods_in_date = date("Y-m-01", strtotime($goods_in_da));
//                        if (date('l',  strtotime($goods_in_date)) != "Monday"){
////                           $lastmonth = date('Y-m-d', strtotime('-1 month', strtotime($goods_in_date)));
//                         $goods_in_date = date('Y-m-d',strtotime($goods_in_date.'last Monday'));
//                         $last_date =  date('Y-m-t', strtotime('+1 month', strtotime($goods_in_date)));
////                          
//                       }else{
//                            $last_date =  date('Y-m-t', strtotime($goods_in_date));
//                       }
//                      
//                    }
////                     echo $goods_in_date;
////                       echo $last_date;
//                 
//                   
//                    if ($goods_in_d[0] != $dateY) {
//
//                        $goods_in_d[0] = $dateY;
//                        $goods_in_da = implode('-', $goods_in_d);
//                        $goods_in_date = date("Y-m-01", strtotime($goods_in_da));
//                       if (date('l',  strtotime($goods_in_date)) != "Monday"){
////                           $lastmonth = date('Y-m-d', strtotime('-1 month', strtotime($goods_in_date)));
//                         $goods_in_date = date('Y-m-d',strtotime($goods_in_date.'last monday'));
//                         $last_date =  date('Y-m-t', strtotime('+1 month', strtotime($goods_in_date)));
//                         
//                       }else{
//                            $last_date =  date('Y-m-t', strtotime($goods_in_date));
//                       }
//                       }
//                      
//           
//                    if ($till_date != '') {
//                        $till_d = explode('-', $till_date);
//                        //$check_month = substr($till_date,5,2);
//
//                        if ($till_d[1] != $dateM) {
//
//                            $till_d[1] = $dateM;
//                            $till_da = implode('-', $till_d);
//                            $last_date = date("Y-m-t", strtotime($till_da));
//                           if (date('l',  strtotime($last_date)) != "Sunday"){
//                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday '));
//                        //\App\Libraries\ZnUtilities::pa($last_sunday);die;
//                           }
//                              $till_date = $last_date;
//                        }
//                        if ($till_d[0] != $dateY) {
//
//                            $till_d[0] = $dateY;
//                            $till_da = implode('-', $till_d);
//                            $last_date = date("Y-m-t", strtotime($till_da));
//                             
//                           if (date('l',  strtotime($last_date)) != "Sunday"){
//                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday '));
//                        //\App\Libraries\ZnUtilities::pa($last_sunday);die;
//                           }
//                        $till_date = $last_date;
//                        }
//                        
//                    } else if ($till_date == '') {
////                          $last_date= date("Y-m-t", strtotime($goods_in_date));
////                        $last_date =  date('Y-m-t', strtotime('+1 month', strtotime($goods_in_date)));
//                       
//                       if(date('l',strtotime($last_date))!=='Sunday'){
//                       
//                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday'));
//                       // \App\Libraries\ZnUtilities::pa($last_date);die;
//                           }
//                        $till_date = $last_date;
//                        
//                    } 
//                    
//                     $lot= $j->lots; 
//              // ZnUtilities::pa($j->lots );die;
//            $deliver_lots = \App\Models\DeliveryLot::where('job_id',$j->id)->where('delivery_type','Full')->lists('lot_id')->toArray();
//               $count=array();
//          foreach($lot as $k=>$d){
//         $delivery_prev_lot = App\Models\DeliveryLot::where('job_id', $j->id)->where('lot_id',$d->lot_id)->orderBy('delivery_id', 'DESC')->first();
//           
//         if((isset($delivery_prev_lot)?$delivery_prev_lot->delivery_type:'')!="Full"){
//          $delivery_lot = \App\Models\DeliveryLot::where('job_id',$d->job_id)->where('lot_id',$d->lot_id)->lists('volume_to_deliver')->toArray();
//          
//          $delivery = \App\Models\DeliveryLot::where('job_id',$d->job_id)->where('lot_id',$d->lot_id)->orderBy('lot_id','DESC')->first();
//          $delivery_date = App\Models\Delivery::where('id',isset($delivery)?$delivery->delivery_id:'')->pluck('delivery_date');
//         
//            if($j->job_type!='Daily/Volume'){
//               $total_vol = trim($d->volume);
////
//          
//          $deliverd_lot = trim(array_sum($delivery_lot));
//         //   if($total_vol==$deliverd_lot){exit();}
//          if($total_vol!=$deliverd_lot){
//              if((isset($delivery)?$delivery->delivery_type:''!='Full' )){
//       
//             $count[] = $j->id;
//       
//             } }}
//       
//         }
//          }
//          // ZnUtilities::pa($count);die;
//          if(count($count)>0){ 
//              $last_date= date("Y-m-t", strtotime($till_date));
//               if(date('l',strtotime($last_date))!=='Sunday'){
//                       
//                               $last_date = date('Y-m-d',strtotime($last_date.'last sunday'));
//                       // \App\Libraries\ZnUtilities::pa($last_date);die;
//                           }
//             $till_date= $last_date;
//             
//         }
                 if(array_sum($charge_rate)>0) { 
                    ?>
                    
                 
                    
                  <tr>
                        <td colspan="1" style="text-align:left;border-top: 1px solid #000; border-right:1px solid #000;border-left:1px solid #000; font-size: 14px;">{{in_array($j->id,$array)? $j->id :''}} </td>
                        <td colspan="1" style="text-align:left;border-top: 1px solid #000; border-right:1px solid #000; font-size: 14px;"> {{in_array($j->id,$array)? $j->project_name :''}} </td>
                        <td colspan="1" style="text-align:left;border-top: 1px solid #000; border-right:1px solid #000; font-size: 14px;"> {{in_array($j->id,$array)? $j->client_order_number :''}}</td>

                        <td colspan="2" style="text-align:left;border-top: 1px solid #000; border-right:1px solid #000; font-size: 14px;"> {{in_array($j->id,$array)? \App\Libraries\ZnUtilities::format_date($goods_in_date,10) :''}} </td>
                        <td colspan="2" style="text-align:left;border-top: 1px solid #000;border-right:1px solid #000; font-size: 14px;">{{in_array($j->id,$array)? \App\Libraries\ZnUtilities::format_date($till_date,10) :''}} </td>
                        <td colspan="1" style="text-align:right;border-top: 1px solid #000; border-right:1px solid #000; font-size: 14px;">{{'&#163;'}}{{in_array($j->id,$array) ? number_format(array_sum($charge_rate), 2, '.', '') : '' }} </td>
                        <td colspan="1" style="text-align:right;border-top: 1px solid #000; border-right:1px solid #000; font-size: 14px;"> {{'&#163;'}}{{(in_array($j->id,$array) && $l->lot_id==1) ? $handling_charge   :'0.00'}} </td>
                        <td colspan="1" style="text-align:right;border-top: 1px solid #000; border-right:1px solid #000; font-size: 14px;"> {{'&#163;'}}{{in_array($j->id,$array)?  number_format(array_sum($charge_rate) + ($l->lot_id==1 ?$handling_charge:'0.00') , 2, '.', '') :''}}   </td>

    <?php  $total[] = array_sum($charge_rate) + ($l->lot_id==1 ?$handling_charge:'0.00') //+ $loading_charge ;   ?>
                    
                </tr>
              <?php  }  ?>
                @endforeach
                 <?php 
            } else {
                $charge_rate = array();


                $delivery = App\Models\Delivery::where('job_id', $j->id)->orderBy('id', 'DESC')->first();
            
                //\App\Libraries\ZnUtilities::pa($array); 
                $month = $dateM;
                $year = $dateY;
                 $start_date = date($year . '-' . $month . '-01', strtotime('this month'));
                  $month_last   = date($year . '-' . $month . '-t', strtotime('this month'));
                 //die('here');
                 if ($delivery) {
                     
                        $till_date = $delivery->delivery_date;
                        //$loading_charge = $delivery->loading_charge;
                 } else {
                        $till_date = '';
                        //$loading_charge = '0.00';
                    }

               
               // $last_date = date($year . '-' . $month . '-t', strtotime('this month'));
               
                    $goods_in_date = $j->goods_in_date;
                
                    $goods_in_date_month = substr($goods_in_date,5,2);
                    if($goods_in_date_month==$dateM){
                        $handling_charge = $j->handling_charge;
                    }else{
                        $handling_charge = '0.00';
                    }
                    
                    $goods_in_d = explode('-', $goods_in_date);

                    if ($goods_in_d[1] != $dateM) {
                        $goods_in_d[1] = $dateM;
                        $goods_in_da = implode('-', $goods_in_d);
                        $goods_in_date = date("Y-m-01", strtotime($goods_in_da));
                    }
                    if ($goods_in_d[0] != $dateY) {

                        $goods_in_d[0] = $dateY;
                        $goods_in_da = implode('-', $goods_in_d);
                        $goods_in_date = date("Y-m-01", strtotime($goods_in_da));
                    }
                    //$till_date = $delivery->delivery_date;
           
                    if ($till_date != '') {
                        $till_d = explode('-', $till_date);
                        //$check_month = substr($till_date,5,2);

                        if ($till_d[1] != $dateM) {

                            $till_d[1] = $dateM;
                            $till_da = implode('-', $till_d);
                            $last_date = date("Y-m-t", strtotime($till_da));
//                            
                        $till_date = $last_date;
                        }
                        if ($till_d[0] != $dateY) {

                            $till_d[0] = $dateY;
                            $till_da = implode('-', $till_d);
                            $last_date = date("Y-m-t", strtotime($till_da));
//                            
                        $till_date = $last_date;
                        }
                    } else if ($till_date == '') {
                          $last_date= date("Y-m-t", strtotime($goods_in_date));

                        $till_date = $last_date;
                    }
                    
                        $lot= $j->lots; 
              // ZnUtilities::pa($j->lots );die;
            $deliver_lots = \App\Models\DeliveryLot::where('job_id',$j->id)->where('delivery_type','Full')->lists('lot_id')->toArray();
               $count=array();
          foreach($lot as $k=>$d){
         if(!in_array($d->lot_id,$deliver_lots)){
         
          $delivery_lot = \App\Models\DeliveryLot::where('job_id',$d->job_id)->where('lot_id',$d->lot_id)->lists('volume_to_deliver')->toArray();
          
          $delivery = \App\Models\DeliveryLot::where('job_id',$d->job_id)->where('lot_id',$d->lot_id)->orderBy('lot_id','DESC')->first();
          $delivery_date = App\Models\Delivery::where('id',isset($delivery)?$delivery->delivery_id:'')->pluck('delivery_date');
         
          
             if((isset($delivery)?$delivery->delivery_type:''!='Full' )){
       
             $count[] = $j->id;
       
             } 
           
          
       
         }
          }
          // ZnUtilities::pa($count);die;
          if(count($count)>0){ 
              $last_date= date("Y-m-t", strtotime($till_date));
             $till_date= $last_date;
             
         }
                     $datetime1 = date_create($goods_in_date);
                    $datetime2 = date_create($till_date);
                    $interval = date_diff($datetime1, $datetime2);
                    $days = $interval->days + 1;

                    $vol = $j->total_volume;

                    $charge_rate = number_format($j->charge_rate * $vol * $days, "2", ".", "");
                            
//                      
//                         \App\Libraries\ZnUtilities::pa($j->id);
//                            \App\Libraries\ZnUtilities::pa('volume'.$j->total_volume);
//                            \App\Libraries\ZnUtilities::pa('goods_in_date'.$goods_in_date);
//                            \App\Libraries\ZnUtilities::pa('till_date'.$till_date);
//                            \App\Libraries\ZnUtilities::pa('count'.$days);
//                            \App\Libraries\ZnUtilities::pa('charge_rate'.$j->charge_rate);
//                            \App\Libraries\ZnUtilities::pa('total  '.$days*$j->total_volume*$j->charge_rate);
                        
                    ?>
                  

                    <tr>
                        <td colspan="1" style="text-align:left;border-top: 1px solid #000; border-right:1px solid #000;border-left:1px solid #000; font-size: 14px;">{{in_array($j->id,$array)? $j->id :''}} </td>
                        <td colspan="1" style="text-align:left;border-top: 1px solid #000; border-right:1px solid #000; font-size: 14px;"> {{in_array($j->id,$array)? $j->project_name :''}} </td>
                        <td colspan="1" style="text-align:left;border-top: 1px solid #000; border-right:1px solid #000; font-size: 14px;"> {{in_array($j->id,$array)? $j->client_order_number :''}}</td>

                        <td colspan="2" style="text-align:left;border-top: 1px solid #000; border-right:1px solid #000; font-size: 14px;"> {{in_array($j->id,$array)? \App\Libraries\ZnUtilities::format_date($goods_in_date,10) :''}} </td>
                        <td colspan="2" style="text-align:left;border-top: 1px solid #000;border-right:1px solid #000; font-size: 14px;">{{in_array($j->id,$array)? \App\Libraries\ZnUtilities::format_date($till_date,10) :''}} </td>
                        <td colspan="1" style="text-align:right;border-top: 1px solid #000; border-right:1px solid #000; font-size: 14px;">{{'&#163;'}}{{in_array($j->id,$array) ? $charge_rate:'' }} </td>
                        <td colspan="1" style="text-align:right;border-top: 1px solid #000; border-right:1px solid #000; font-size: 14px;"> {{'&#163;'}}{{in_array($j->id,$array)? $handling_charge   :''}} </td>
                        <td colspan="1" style="text-align:right;border-top: 1px solid #000; border-right:1px solid #000; font-size: 14px;"> {{'&#163;'}}{{in_array($j->id,$array)?  number_format($charge_rate + $handling_charge , 2, '.', '') :''}}   </td>

                        <?php $total[] = $charge_rate + $handling_charge //+ $loading_charge; ?>   

            </tr>
           <?php  } ?> 
            @endif
            @endforeach
           
            <tr><td colspan='10' style="border-top: 1px solid #000; font-size: 14px;" >&nbsp;</td></tr>
            <tr><td colspan='10' >&nbsp;</td></tr>
            <tr>
                <td colspan="4"> </td>
                <td colspan="4" style="text-align:left;border-bottom: 1px solid #000;border-top: 1px solid #000;border-left: 1px solid #000; font-size: 14px;"><strong>TOTAL INVOICE VALUE: </strong></td>
                <td colspan="2" style="text-align: right;border-bottom: 1px solid #000;border-top: 1px solid #000;border-right: 1px solid #000; font-size: 14px;"><strong>&#163;{{number_format(array_sum($total), 2, '.', '')}}</strong></span></td>
            </tr>

        </table>

    </body>
</html>