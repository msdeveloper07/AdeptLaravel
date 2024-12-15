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
          
            
        <h2 style="width:100%; "><center>TRANSPORT INVOICE REQUEST(ADEPT ESD)</center></h2>
     
        <table  width="100%" style="border:2px solid #000;" cellspacing="5px" cellpadding="5px">
          
        <tr>
                <td colspan="3" style="text-align:left;"><strong>Please produce an invoice made out to:</strong></td>
                <td colspan="1" style="text-align:right;">{{$client->client_name}}</td>
            </tr>
             <tr><td colspan='4' >&nbsp;</td></tr>
            <tr>
                
                <td colspan="3" style="text-align:left;"><strong>Provision of Transport for delivery of lift equipment to:</strong></td>
                <td colspan="1" style="text-align:right;">{{$goodsin->project_name}}</div></td>
            </tr>
             <tr><td colspan='4' >&nbsp;</td></tr>

             <tr>
                  <td colspan="2" style="text-align:left;" > <strong>GOODS IN NUMBER</strong></td>
                  <td colspan="2" style="text-align:right;">{{$goodsin->goodsin_id}}</td>
             </tr>
             <tr><td colspan='4' >&nbsp;</td></tr>
         
             <tr>
                <td colspan="2" style="text-align:left;"><strong>DELIVERY DATE</strong></td>
                <td colspan="2" style="text-align:right;">{{\App\Libraries\ZnUtilities::format_date($delivery->delivery_date,10)}}</td>
            </tr>
             <tr><td colspan='4' >&nbsp;</td></tr>
         
             <tr>
                <td colspan="2" style="text-align:left;"><strong>INVOICE VALUE</strong></td>
                <td colspan="2" style="text-align:right;">&#163;&nbsp;&nbsp;{{$delivery->invoice_value}}</td>
            </tr>
             <tr><td colspan='4' >&nbsp;</td></tr>
         
             <tr>
                <td colspan="4" style="text-align:left;"><strong>Administration to complete the following information and return along with typed invoice for checking</strong></td>
            </tr>
            <tr><td colspan='4' >&nbsp;</td></tr>
            <tr><td colspan='4' >&nbsp;</td></tr>
            <tr>
                <td colspan="4" style="text-align:left;"><strong>INVOICE NUMBER</strong></td>
            </tr>
            <tr><td colspan='4' >&nbsp;</td></tr>
            <tr>
                <td colspan="4" style="text-align:left;"><strong>INVOICE DATE</strong></td>
            </tr>
            <tr><td colspan='4' >&nbsp;</td></tr>
            <tr>
                <td colspan="4" style="text-align:left;"><strong>CHECKED</strong></td>
            </tr>
             <tr><td colspan='4' >&nbsp;</td></tr> 
             <tr><td colspan='4' >&nbsp;</td></tr>
             
             <tr><td colspan='4'>
              <table width='98%'style=" border:2px solid #000;margin: 4px; padding: 4px;" >
            
            <tr>
                <td colspan="2" style="text-align:center;"><h3><center><strong>SUB-CONTRACT TRANSPORT VERIFICATION</strong></center></h3></div></td>
            </tr>
             <tr><td colspan='2' >&nbsp;</td></tr>
           <?php $transport_company = \App\Models\Transporter::where('id',$delivery->transport_company_id)->pluck('company_name');?>
             <tr>
                
                <td colspan="1" style="text-align:left;"><strong>TRANSPORT BY</strong></td>
                <td colspan="1" style="text-align:right;">{{$transport_company}}</td>
            </tr>
             <tr><td colspan='2' >&nbsp;</td></tr>
             <tr>
                
                <td colspan="1" style="text-align:left;"><strong>AGREED PRICE</strong></td>
                <td colspan="1" style="text-align:right;"><i class="fa fa-gbp">&#163;&nbsp;&nbsp;{{$delivery->agreed_price}}</i></td>
            </tr>
             <tr><td colspan='2' >&nbsp;</td></tr>
             <tr>
                
                <td colspan="1" style="text-align:left;"><strong>INVOICE VALUE</strong></td>
<!--                <td colspan="1" style="text-align:right;"><i class="fa fa-gbp">{{$delivery->agreed_price}}</i></td>-->
            </tr>
             <tr><td colspan='2' >&nbsp;</td></tr>
             <tr>
                
                <td colspan="1" style="text-align:left;"><strong>INVOICE NUMBER</strong></td>
                <!--<td colspan="1" style="text-align:right;"><i class="fa fa-gbp">{{$delivery->agreed_price}}</i></td>-->
            </tr>
             <tr><td colspan='2' >&nbsp;</td></tr>
             <tr>
                
                <td colspan="1" style="text-align:left;"><strong>CHECKED</strong></td>
                <!--<td colspan="1" style="text-align:right;"><i class="fa fa-gbp">{{$delivery->agreed_price}}</i></td>-->
            </tr>
             
              </table>
                </td>
            </tr>
        </table>
         
    </body>
</html>