<html>
    <head>
        <title>{{$title}}</title>
        <style type="text/css">
            body{
                font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
                font-size: 12px;
            }
            table td * {
                vertical-align: middle;
                margin: 8px 0;
            }
            </style>
    
    </head>
    
    <body>
        

<table class="" width='55%' cellspacing="0" cellpadding="0">
    @if($title=='Label Print')
            @foreach($all_lots as $l)
         <tr>
                <td colspan="4" >THIS EQUIPMENT BELONGS TO:</td>
            </tr>
             
            <tr>
                
                <td colspan="4"><h1>{{$goodsin->clientId->client_title}}</h1></div></td>
            </tr>
            <tr>
                
                <td  colspan="1" style="font-size: 10px;">PROJECT NAME:</td>
                <td colspan="3"><span style="text-align:left; font-size: 40px;">{{$goodsin->project_name}}</span></td>
            </tr>
             
            <tr>
                
                <td colspan="1" style="font-size: 10px;">LOT NUMBER:</td>
                <td colspan="1"><span style="font-size: 23px;">LOT NO. &nbsp;<b style="font-size: 23px;">{{$l->lot_id}}</b></span> </td>
                <td colspan="2"><span style="font-size: 10px; text-align: left;">OF</span>&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 23px;">{{$total_lots}}</b></td>
                
                
               
            </tr>
              <tr>
                
                  <td colspan="1" style="font-size: 10px;">DESCRIPTION:&nbsp;</td>
                  <td colspan="3"><span style="font-size: 20px;">{!! $l->Items->item_name !!}</span></td>
               
            </tr>
              <tr>
                
                  <td colspan="1" style="font-size: 10px;">STOREAGE LOCATION:</td>
                  <td colspan="1"><span style="font-size:45px;">{{$l->location}}</span></td>
                  <td colspan="1" style="font-size: 10px;">ADEPT ESD JOB NO.</td>
                  <td colspan="1"><h2>{{$l->goodsin_id}}</h2></td>
                  
               
            </tr>
      
           <tr>
                
                  <td colspan="4" >&nbsp;</td>
                
            </tr>
          
           <tr>
                
                  <td colspan="4" style="font-size: 13px;">EQUIPMENT STORED BY ADEPT ESD TEL.020-8312-9007</td>
                
            </tr>
             <tr>
                
                  <td colspan="4" >&nbsp;</td>
                
            </tr>
            <tr>
                
                  <td colspan="4" >&nbsp;</td>
                
            </tr> 
            <tr>
                
                  <td colspan="4" >&nbsp;</td>
                
            </tr> 
            <tr>
                
                  <td colspan="4" >&nbsp;</td>
                
            </tr>
         <tr>
                
                  <td colspan="4" >&nbsp;</td>
                
            </tr>
            <tr>
                
                  <td colspan="4" >&nbsp;</td>
                
            </tr>
      @endforeach
      @else
            <tr>
                <td colspan="4" >THIS EQUIPMENT BELONGS TO:</td>
            </tr>
             
            <tr>
                
                <td colspan="4"><h1>{{$goodsin->clientId->client_title}}</h1></div></td>
            </tr>
            <tr>
                
                <td  colspan="1" style="font-size: 10px;">PROJECT NAME:</td>
                <td colspan="3"><span style="text-align:left; font-size: 40px;">{{$goodsin->project_name}}</span></td>
            </tr>
             
            <tr>
                
                <td colspan="1" style="font-size: 10px;">LOT NUMBER:</td>
                <td colspan="1"><span style="font-size: 23px;">LOT NO. &nbsp;<b style="font-size: 23px;">{{$all_lots->lot_id}}</b></span> </td>
                <td colspan="2"><span style="font-size: 10px; text-align: left;">OF</span>&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 23px;">{{$total_lots}}</b></td>
                
                
               
            </tr>
              <tr>
                
                  <td colspan="1" style="font-size: 10px;">DESCRIPTION:&nbsp;</td>
                  <td colspan="3"><span style="font-size: 20px;">{!! $all_lots->Items->item_name !!}</span></td>
               
            </tr>
              <tr>
                
                  <td colspan="1" style="font-size: 10px;">STOREAGE LOCATION:</td>
                  <td colspan="1"><span style="font-size:45px;">{{$all_lots->location}}</span></td>
                  <td colspan="1" style="font-size: 10px;">ADEPT ESD JOB NO.</td>
                  <td colspan="1"><h2>{{$all_lots->goodsin_id}}</h2></td>
                  
               
            </tr>
      
           <tr>
                
                  <td colspan="4" >&nbsp;</td>
                
            </tr>
          
           <tr>
                
                  <td colspan="4" style="font-size: 13px;">EQUIPMENT STORED BY ADEPT ESD TEL.020-8312-9007</td>
                
            </tr>
             <tr>
                
                  <td colspan="4" >&nbsp;</td>
                
            </tr>
            <tr>
                
                  <td colspan="4" >&nbsp;</td>
                
            </tr> 
            <tr>
                
                  <td colspan="4" >&nbsp;</td>
                
            </tr> 
            <tr>
                
                  <td colspan="4" >&nbsp;</td>
                
            </tr>
         <tr>
                
                  <td colspan="4" >&nbsp;</td>
                
            </tr>
            @endif
        </table>


    </body>
</html>
