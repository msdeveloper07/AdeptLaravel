<html>
    <head>
        <title>{{$title}}</title>
        <style>
             body {
            size: A4; /* can use also 'landscape' for orientation */
            margin: 2px;
         
            padding: 2px;

        </style>
    </head>
    <body>
        <table cellspacing="0" cellpadding="0">
            
          
         
        
            <tr>
                <td  colspan="2" ><img height="120px"width="120px" style="margin-top: 0px;" src="{{asset('assets/images/adept-logo.jpg')}}"></td>
                                <td  colspan="2" style=" text-align: right;"><b>ADEPT ELEVATOR STORAGE AND DISTRIBUTION</b> <br />6 Butterly Avenue<br />Questor<br />Hawley Road<br />Dartford<br />Kent,DA1 1JG<br /><br />Tel: 01322-626550<br />Fax: 01322-2210239</td>
            </tr>
            <tr><td colspan='5' style="border-bottom: 2px solid #000;">&nbsp;</td></tr>
            <tr>
                
                <td colspan="4"><h2><center>Transport Order</center></h2></div></td>
            </tr>

            <tr>
                <td colspan="2" width='50%'><strong><u>HAULAGE COMPANY:</u></strong><br/>ADEPT ESD<br />UNIT 6,BUTTERLY AVENUE,<br/>QUESTOR PK,<br/>DARTFORD,<br/>KENT.<br/>DA1 1JG.</td>
                
                <td colspan="2" width='50%'><table  cellspacing="0" cellpadding="5" width='100%'><tr><td style="border-bottom: 1px solid #000; border-left: 1px solid #000; border-top: 1px solid #000;"><strong>PROJECT NAME:</strong></td><td style="border-bottom: 1px solid #000; text-align: right; border-right: 1px solid #000; border-top: 1px solid #000;">{{$goodsin->project_name}}</td></tr><tr><td style=" border-bottom: 1px solid #000; border-left: 1px solid #000;"><strong>ORDER DATE:</strong></td><td style="border-bottom: 1px solid #000; text-align: right; border-right: 1px solid #000;">{{\App\Libraries\ZnUtilities::format_date($delivery->transport_order_date,10)}}</td></tr><tr><td style="border-bottom: 1px solid #000; border-left: 1px solid #000;"><STRONG>CLIENT ORDER NUMBER:</strong></td><td style="border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: right;">{{$goodsin->client_order_number}}</td></tr></table></td>
            </tr>
            <tr><td colspan='4' style="border-bottom: 2px solid #000;">&nbsp;</td></tr>
            <tr><td colspan='4' >&nbsp;</td></tr>
             <tr >
                 <th colspan="2" width='50%' style="text-align:left; border-bottom: 1px solid #000;border-top: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000; "><strong>COLLECTION ADDRESSS:</strong></th>
                 <th colspan="2" style="text-align:left; border-bottom: 1px solid #000;border-top: 1px solid #000;border-right: 1px solid #000;  "><strong>DELIVERY ADDRESS:</strong></th>
                       
            </tr>
           
            <tr>
                <td colspan="2" style=" border-bottom: 1px solid #000; border-right: 1px solid #000; border-left: 1px solid #000; text-align: left; ">{{$delivery->collection_address_name}}</br>{{$delivery->collection_address_1}}</br>{{$delivery->collection_address_2}}</br>{{$delivery->collection_city}}</br>{{$delivery->collection_country}}</br>{{$delivery->collection_postcode}}</td>
                <td colspan="2" style=" border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: left;">{{$delivery->delivery_address_1}}</br>{{$delivery->delivery_address_2}}</br>{{$delivery->delivery_city}}</br>{{$delivery->delivery_county}}</br>{{$delivery->delivery_postcode}}</td>
            </tr>
             <tr>
                 <td colspan="4" >&nbsp;</td></tr>
            
             <tr >
                 <td  colspan="4" style="text-align:center; border-bottom: 1px solid #000;border-top: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000; "><strong>GOODS:</strong></td>
                       
            </tr>
             <tr>
                <th colspan="1" width="20%" style=" border-left: 1px solid #000; border-bottom: 1px solid #000; text-align: left; ">LOT NO.</th>
                <th colspan="1" width="30%" style="  border-left: 1px solid #000; border-bottom: 1px solid #000; text-align: left; ">DESCRIPTION</th>
                <th colspan="1" width="30%" style="  border-left: 1px solid #000; border-bottom: 1px solid #000; text-align: left; ">PART DELIVERY NOTE</th>
                <th colspan="1" width="20%" style=" border-right: 1px solid #000; border-left: 1px solid #000; border-bottom: 1px solid #000; text-align: left; ">DAMAGE OUT</th>
            </tr>
            <?php $count=count($lots);?>
           @foreach($lots as $k=>$l)
           
            <tr>
                <td colspan="1" width="20%" style="  border-left: 1px solid #000; text-align: left; ">{{$l->lot_id}}</td>
                <td colspan="1" width="30%" style="  border-left: 1px solid #000; text-align: left; ">{{strip_tags($l->goods_in_details)}}</td>
                <td colspan="1" width="30%" style="  border-left: 1px solid #000; text-align: left; ">{{strip_tags($l->delivery_details)}}</td>
                <td colspan="1" width="20%" style=" border-right: 1px solid #000; border-left: 1px solid #000; text-align: left; ">{{strip_tags($l->Lot->damage_out)}}</td>
            </tr>
            @endforeach
            
               <tr><td colspan='4' style="border-top: 1px solid #000;">&nbsp;</td></tr>
            
             <tr >
                 <td colspan="1" width='25%' style="text-align:left; border-bottom: 1px solid #000;border-top: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000; "><strong>COLLECTION DATE:</strong></td>
                 <td colspan="1" width='25%' style="text-align:left; border-bottom: 1px solid #000;border-top: 1px solid #000;border-right: 1px solid #000; ">{{\App\Libraries\ZnUtilities::format_date($delivery->collection_date,10)}}</td>
                <td  colspan="1" width='25%' style="text-align:left; border-bottom: 1px solid #000;border-top: 1px solid #000;border-right: 1px solid #000;  "><strong>DELIVERY DATE:</strong></td>
                <td  colspan="1" width='25%' style="text-align:left; border-bottom: 1px solid #000;border-top: 1px solid #000;border-right: 1px solid #000;  ">{{\App\Libraries\ZnUtilities::format_date($delivery->delivery_date,10)}}</td>
                       
            </tr>
             <tr >
                 <td colspan="1" width='25%' style="text-align:left; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000; "><strong>APPROXIMATE WEIGHT:</strong></td>
                 <td colspan="1" width='25%' style="text-align:left; border-bottom: 1px solid #000;border-right: 1px solid #000; ">{{$delivery->approximate_weight}}</td>
                <td  colspan='1' width='25%' style="text-align:left; border-bottom: 1px solid #000;border-right: 1px solid #000;  "><strong>AGREED PRICE:</strong></td>
                <td  colspan="1" width='25%' style="text-align:left; border-bottom: 1px solid #000;border-right: 1px solid #000;  ">&#163;&nbsp;&nbsp;{{$delivery->agreed_price}}</td>
                       
            </tr>
            <?php $vehicle_type_id = $delivery->vehicle_type_id;
                 $vehicle_type = \App\Models\VehicleType::find($vehicle_type_id); ?>
             <tr >
                 <td colspan="1" style="text-align:left; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000; "><strong>VEHICLE TYPE:</strong></td>
                 <td colspan="3" style="text-align:left; border-bottom: 1px solid #000;border-right: 1px solid #000; ">{{ $vehicle_type->vehicle_type}}</td>
                       
            </tr>
            <tr >
                <td colspan="4" style="text-align:left; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000; "><strong>SPECIAL DELIVERY INSTRUCTIONS:</strong></td>
                       
            </tr>
            <tr >
                <td colspan="4" style="text-align:left; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000; ">{{$delivery->site_contact_details}}</td>
                       
            </tr>
             <tr >
                 <td colspan="4" style="text-align:left; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000; "><strong>SIGNED:</strong></td>
                       
            </tr>
             <?php $client_name = $goodsin->client_id;
                 $contact_name = \App\Models\Client::find($client_name); ?>
             <tr >
                 <td colspan="1" style="text-align:left; border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000; "><strong>NAME:</strong></td>
                 <td colspan="3" style="text-align:left; border-bottom: 1px solid #000;border-right: 1px solid #000; ">{{ $contact_name->contact_name}}</td>
                       
            </tr>
               
            
            
        </table>
    </body>
</html>