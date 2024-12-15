@extends('layouts.master')

@section('content')
@if(isset($title))
<h2 class="page_header">{{$title}}</h2>
@endif


<form class="form-inline" action="/transporterAction" method="post" name="actions_form" id="actions_form">

<div class="box box-danger">
    
        
    <div class="box-body">
         <div class="row">
             
             <div class="col-md-4">
                     Actions
                     <div class="form-group">
                        <select id="bulk_action" name="bulk_action" class="form-control" placeholder="Select Action"  >
                            <option value="">Select An Action</option>
                            <option value="delete">Delete Selected Transport Company</option>
                        </select>
                     </div>
                 
             </div>
             
             
                <div class="col-md-3">
                  
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                                
                        <div class="input-group">
                            <input type="text" class="form-control"  name="search" value="{{isset($search)?$search:''}}" placeholder="Search Transport Co." aria-describedby="basic-addon2">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default btn-flat">Find Transport Co.</button>
                            </span>
                        </div>
                      
                </div>

                <div class="col-md-2">
                    <a href="/transporter/create" class="btn btn-primary btn-flat">Add New Transport Company</a>
                </div>
              @if(isset($search)) 
               <div class="col-md-3">
                    <a href="/transporter" class="btn btn-info btn-flat">Show All Transport Companies</a>
                </div>
              @endif
            </div>
    </div>    
   
</div>


<div class='table-responsive'>
    <table class="table table-hover table-bordered pull-left table-striped table-condensed admin-user-table">
    <thead>
        <tr>
            <th>
            <!-- <button id="checkall" class="btn-info">Toggle</button>-->
            <input type="checkbox" id="checkall" class="check" value="" />
            </th>
            <th>Company Name</th>
            <th>Address</th>
            <th>City</th>
            <th>County</th>
            <th>&nbsp;</th>
           
       </tr>
     </thead>
     <tbody>
        @foreach($transporter as $c)
       <tr>
           <td  data-title="Select">
               <input type="checkbox" class="check" name="cid[]" value="{{$c->id}}" id="cid{{$c->id}}" />
           </td>

           <td  data-title="Company Name">
               <a href="/transporter/{{$c->id}}/edit/" title="Edit">
                 {{$c->company_name}} 
               </a>
           </td>
           
           <td  data-title="Address_1"> {{$c->address_line_1}}</td>
          
           <td  data-title="City">{{$c->city}}</td>
           <td  data-title="State">{{$c->county}}</td>
  
         
           <td>
              <a href="/transporter/{{$c->id}}/edit/" title="Edit"><i class="fa fa-pencil-square fa-lg"></i>&nbsp;Edit</a>
                  
           </td>
       </tr>
       @endforeach
    </tbody>


</table>
      {!! $transporter->render() !!}
</div>


</form>
    


@endsection

