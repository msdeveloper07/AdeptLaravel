<html>
    <head>
        <title>{{$title}}</title>
        <style>
             body {
             /* can use also 'landscape' for orientation */
            
             } 
             table{
                 margin: 1%;
             }

        </style>
    </head>
    <body>
        <table cellspacing="0" cellpadding="0">
            
          
         
        
            <tr>
                <td  colspan="2" style=""><img height="120px"width="120px" style="margin-top: 0px;" src="{{asset('assets/images/adept-logo.jpg')}}"></td>
                <td  colspan="2" style=" text-align: right;"><b>ADEPT ELEVATOR STORAGE AND DISTRIBUTION</b> <br />6 Butterly Avenue<br />Questor<br />Hawley Road<br />Dartford<br />Kent,DA1 1JG<br /><br />Tel: 01322-626550<br />Fax: 01322-2210239</td>
            </tr>
            <tr><td colspan='5' >&nbsp;</td></tr>
            <tr>
                
                <td colspan="4"><h2><center>PICKING LIST</center></h2></div></td>
            </tr>

             <tr>
                  <td colspan="2" width='50%'> <strong>GOODS IN NUMBER:&nbsp;{{$goodsin->goodsin_id}}</strong></td>
             </tr>
             <tr><td colspan='4' >&nbsp;</td></tr>
            <tr>
                <td colspan="2" width='50%'><strong>PROJECT NAME:&nbsp;{{$goodsin->project_name}}</strong></td>
            </tr>
            <tr><td colspan='4' >&nbsp;</td></tr>
            <tr>
                <td colspan="2" width='50%'><strong>DELIVERY DATE:&nbsp;{{\App\Libraries\ZnUtilities::format_date($delivery->delivery_date,10)}}</strong></td>
            </tr>
            <tr><td colspan='4' >&nbsp;</td></tr>
            <tr><td colspan='4' >&nbsp;</td></tr>
                <th colspan="1" width='25%' style="text-align:left;"><strong>LOT NUMBER</strong></th>
                <th colspan="1" width='25%' style="text-align:left;  "><strong>LOT NAME</strong></th>
                <th colspan="1" width='25%' style="text-align:left; "><strong>PART DELIVERY INFO</strong></th>
                <th colspan="1" style="text-align:right;">LOCATION </th>
                
          @foreach($lots as $k=>$l)
          
            <tr><td colspan='4' style="border-bottom: 2px solid #000; ">&nbsp;</td></tr>
              <!--<tr><td colspan='4' >&nbsp;</td></tr>-->
            <?php $location = App\Models\Lot::where('lot_id',$l->lot_id)->where('goodsin_id',$l->goodsin_id)->pluck('location');?>
            <tr>
                <td colspan="1" width='25%' style="text-align:left; border-right: 1px solid #000; ">{{$l->lot_id}}</strong></td>
                <td colspan="1" width='25%' style="text-align:left; border-right: 1px solid #000; ">{{$l->goods_in_details}}</td>
                <td colspan="1" width='25%' style="text-align:left; border-right: 1px solid #000; ">{{$l->delivery_details}}</td>
                <td colspan="1" style="text-align:right;"></td>
                       
            </tr>
            
             <tr><td colspan='4' >&nbsp;</td></tr>
            <tr>
                <td colspan="2" width='50%' style="text-align:left">VERIFY GOODS IN NUMBER<br><input type="text" readonly/></td>
                <td colspan="2" style="text-align:right;">VERIFY PROJECT NAME<br><input type="text" readonly/></td>
                       
            </tr>
           @endforeach
           
           
        </table>
         
    </body>
</html>