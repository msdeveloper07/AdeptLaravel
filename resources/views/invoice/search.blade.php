@extends('layouts.master')

@section('content')



<form class="form-inline"  method="post" name="actions_form" id="actions_form">

    <div class="box box-danger">
    
        <div class="box-header">
            <div class="col-md-3">
            
        </div>
      
            <div class="col-md-3">
           
                      
        </div>
     
            <div class="col-md-6" >
                  <a class="btn btn-info pull-right" style="margin: 2%;" href="/monthlyInvoice/{{$client_id}}/{{$dateM}}/{{$dateY}}" target='_blank' title="View">View Invoice PDF
                        </a>
                    
            <a class="btn btn-default pull-right" style="margin: 2%;" href="/printMonthlyInvoice/{{$client_id}}/{{$dateM}}/{{$dateY}}" target='_blank' title="Print">Print Invoice
                        </a>
                        <a class='btn btn-primary pull-right' style="margin: 2%;" href="/emailInvoice/{{$client_id}}/{{$dateM}}/{{$dateY}}"  title="Email">Email Invoice
                        </a>
        </div>
        </div>
    </div>
        <div class="box-body">
       
    <div class='table-responsive'>
        <table class="table table-hover table-bordered pull-left table-striped table-condensed admin-user-table">
           <thead>
                <tr>
                   
                    <th>Goods In Number</th>
                    <th>Project Name</th>
                    <th>Client Name</th>
                    <th>Client Order Number</th>
                    <th>Goods In Date</th>
                    <th>&nbsp;</th>
                    

                </tr>
            </thead>
            <tbody>
                <?php //App\Libraries\ZnUtilities::pa($goodsin); die; ?>
                @foreach($goodsin as $c)
                @if(in_array($c->goodsin_id,$array)&&count($array)>0)
                <tr>
                    
             
                    <td  data-title="Goods In Number">  {{in_array($c->goodsin_id,$array)?$c->goodsin_id :''}}  </td>

                    <td  data-title="project name">
                        <a href="/goodsin/{{$c->id}}/" title="Show">{{in_array($c->goodsin_id,$array)? $c->project_name :''}}
                        </a>
                    </td>

                    <td  data-title="client name">{{in_array($c->goodsin_id,$array)? $c->clientId->client_name :''}} </td>

                    <td  data-title="client order number">{{in_array($c->goodsin_id,$array)? $c->client_order_number :''}}</td>

                    <td  data-title="Goods in date"> {{in_array($c->goodsin_id,$array)? \App\Libraries\ZnUtilities::format_date($c->goods_in_date,10) :''}} </td>

                    <td  data-title="Goods In Invoice">
                        <a class="btn btn-info btn-sm" href="/detailedpdf/{{$c->goodsin_id}}/{{$client_id}}/{{$dateM}}/{{$dateY}}/" target="_blank" title="View Detailed PDF">Detailed PDF</a>
                  </td>
<!--                        <a class="btn btn-default btn-sm" href="/goodsin/printMonthlyInvoice/{{$c->id}}" title="Print">Print 
                        </a>
                        <a class='btn btn-primary btn-sm' href="/goodsin/emailInvoice/{{$c->id}}/" title="Email">Email
                        </a></td>-->
                  
                </tr>
                  @endif
                @endforeach
             
            </tbody>



        </table>
   
    </div>

            </div>
      

</form>



@endsection




