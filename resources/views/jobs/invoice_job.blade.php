<html>
    <head>
        <title>GOODS IN RECEIPT</title>
     
    </head>
    <body>
        <table width='100%' cellspacing="0.00001%" cellpadding="5%">
            
          
         
        
            <tr>
                <td colspan="2" style="border-bottom: 2px solid #000;" ><img height="120px"width="120px" src="{{asset('assets/images/adept-logo.jpg')}}"></td>
                <td   colspan="2" style="border-bottom: 2px solid #000; text-align: right;"><b>ADEPT ELEVATOR STORAGE AND DISTRIBUTION</b><br />6 Butterly Avenue<br />Questor<br />Hawley Road<br />Dartford<br />Kent,DA1 1JG<br /><br />Tel: 01322-626550<br />Fax: 01322-228239</td>
            </tr>
<!--            <tr><td colspan='5' style="border-top: 2px solid #000;">&nbsp;</td></tr>-->
            <tr>
                
                <td colspan="4"><h3><center>GOODS IN RECEIPT</center></h3></div></td>
            </tr>

            <tr rowspan="6">
                
                <?php $supplier_name = App\Models\Supplier::where('id',$job->supplier_id)->pluck('supplier_name'); ?>
                <td colspan="2"><strong><u>CLIENT:</u></strong><br/>{{$client->client_name}}<br />{{$client->client_address_line_1}}<br/>{{$client->client_address_line_2}}<br/>{{$client->city}}<br/>{{$client->county}}<br/>{{$client->postcode}}</td>
                <td colspan="2" style="text-align:right; "><b><u>SUPPLIER NAME:</u></b><br/>{{$supplier_name}}<br/><strong><u>HAULAGE COMPANY:</u></strong><br/>{{$job->haulage_company_name}}<br/><br/><u><b>GOODS IN DATE:</b></u>&nbsp;&nbsp;<b>{{\App\Libraries\ZnUtilities::format_date($job->goods_in_date,10)}}</b></td>
             </tr>
            
              
           <tr> <td colspan="4">&nbsp;</td></tr>
            
</table>
              <table width='100%' cellspacing="0.00001%" cellpadding="5%">
                 <tr>
                <td colspan="1" style=" float:left; width:25%; text-align: left; "><strong>JOB NUMBER:</strong>{{$job->id}}</td>
                <td colspan="1" style=" float:center; width:40%;  text-align: center; "><b>PROJECT NAME:</b>{{$job->project_name}}</div></td>
                <td colspan="2" style=" float:right;  width:35%; text-align: right; " ><b>ORDER NUMBER:</b>{{$job->client_order_number}}</td>
               </tr>
             </table>
       <table width='100%' cellspacing="0.00001%" cellpadding="5%">
            
            <tr >
                <th colspan="1" style="width:40%; border-bottom: 1px solid #000;border-top: 1px solid #000; border-right: 1px solid #000; border-left: 1px solid #000; text-align: left; "><strong>Goods In</strong></th>
                <th colspan="1" style="width:20%; border-bottom: 1px solid #000;border-top: 1px solid #000; border-right: 1px solid #000; text-align: center;"><strong>Damage In</strong></th>
                <th colspan="1" style="width:20%; border-bottom: 1px solid #000;border-top: 1px solid #000; border-right: 1px solid #000; text-align: center;"><strong>Goods In Date</strong></th>
                <th colspan="1" style="width:20%; border-bottom: 1px solid #000;border-top: 1px solid #000; border-right: 1px solid #000; text-align: center"><strong>Volume</strong></th>
            </tr>
            <?php $total=array(); if($job->job_type==='Weekly/Dimension'){?>
           @foreach($lots as $k=>$l)
           <tr>    
          
            <td colspan="1" style=" text-align: left;   border-left: 1px solid #000;">{!! $l->Items->item_name !!}</td>
                <td colspan="1" style="text-align: center; ">{{$l->damage_in}}</td>
                <td colspan="1" style="text-align: center; ">{{\App\Libraries\ZnUtilities::format_date($l->goods_in_date,10)}}</td>
                <td colspan="1" style="text-align: center; border-right: 1px solid #000; ">{{$l->volume}}</td>
          
                
                 <?php 
                   $total[]= $l->volume; 
                   ?>
            </tr>
            
            @endforeach
            <?php  } else{?>
                 @foreach($lots as $k=>$l)
           <tr>    
          
            <td colspan="1" style="text-align: left;  border-left: 1px solid #000;">{!! $l->Items->item_name !!}</td>
                <td colspan="1" style="text-align: center; ">{{$l->damage_in}}</td>
                <td colspan="1" style="text-align: center; ">{{\App\Libraries\ZnUtilities::format_date($l->goods_in_date,10)}}</td>
                <td colspan="1" style="text-align: center; border-right: 1px solid #000; "></td>
          
                
                 
            </tr>
            
            @endforeach
            <?php
                  $total[]= $job->total_volume; 
                 
            }
             $count = count($lots);?>
            @if($count==0)<tr><td colspan='4' style="border-bottom: 1px solid #000; border-right: 1px solid #000; border-left: 1px solid #000;" ><h4>Lots are not available for this Job</h4></td></tr>
          @else
           <tr>
            <td colspan="4" style="border-top: 1px solid #000; border-right: 1px solid #000; border-left: 1px solid #000;">&nbsp;</td>
        </tr>
          @endif
         <tr>
             <td colspan="2"  style="text-align: left; border-left: 1px solid #000; "><strong>HANDLING CHARGE:</strong>&#163;{{$job->handling_charge}}</td>
             
               
             <td colspan="2" style=" border-right: 1px solid #000; text-align: right;"><strong>TOTAL STORED VOLUME:</strong> {{array_sum($total).'(cu.m.)'}}</td>
            </tr>
            <tr> <td colspan="4" style="border-left: 1px solid #000; border-right: 1px solid #000;">&nbsp;</td></tr>
         <tr>
             <td colspan="2" style="text-align: left; border-left: 1px solid #000;"><strong>RECEIPT DATE:</strong>{{\App\Libraries\ZnUtilities::format_date(date('y-m-d'),10)}}</td>
               
             <td colspan="2" style="text-align: right; border-right: 1px solid #000;"><strong>STORAGE CHARGE(@if($job->job_type==='Weekly/Dimension')Per Week @else Per day @endif):</strong>&#163;{{number_format(array_sum($total)*$job->charge_rate, 2, '.', '')}}</td>
            </tr>
              <tr>
            <td colspan="4" style="border-bottom: 1px solid #000; border-right: 1px solid #000; border-left: 1px solid #000;"></td>
        </tr>
        </table>
    </body>
</html>