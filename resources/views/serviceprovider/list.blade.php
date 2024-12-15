@extends('layouts.master')

@section('content')

@if(isset($title))
<h2 class="page_header">{{$title}}</h2>
@endif

<form class="form-inline" action="/serviceProviderAction" method="post" name="actions_form" id="actions_form">

<div class="box box-danger">
    
        
    <div class="box-body">
         <div class="row">
             
             <div class="col-md-4">
                     Actions
                     <div class="form-group">
                        <select id="bulk_action" name="bulk_action" class="form-control" placeholder="Select Action"  >
                            <option value="">Select An Action</option>
<!--                            <option value="blocked">Block Selected Item</option>
                            <option value="active">Activate Selected Item</option>-->
                            <option value="delete">Delete Selected Service Provider</option>
                        </select>
                     </div>
                 
             </div>
             
             
                <div class="col-md-4">
                  
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                                
                        <div class="input-group">
                            <input type="text" class="form-control"  name="search" value="{{isset($search)?$search:''}}" placeholder="Search Service Provider" aria-describedby="basic-addon2">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default btn-flat">Find Service Provider</button>
                            </span>
                        </div>
                      
                </div>

                <div class="col-md-2">
                    <a href="/serviceProviders/create" class="btn btn-primary btn-flat">Add New Service Provider </a>
                </div>
              @if(isset($search)) 
             <div class="col-md-2">
                    <a href="/serviceProviders" class="btn btn-info btn-flat">Show All Service Provider</a>
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
            <th>Service Provider</th>
            <th>Address 1</th>
            <th>Address 2</th>
            <th>City</th>
            <th>Postcode</th>
            
            <th>&nbsp;</th>
           
       </tr>
     </thead>
     <tbody>
        @foreach($serviceProviders as $c)
       <tr>
           <td  data-title="Select">
               <input type="checkbox" class="check" name="cid[]" value="{{$c->service_provider_id}}" id="cid{{$c->service_provider_id}}" />
           </td>

           <td  data-title="Service Provider">
               <a href="/serviceProviders/{{$c->service_provider_id}}/edit/" title="Edit">
                 {{$c->service_provider}} 
               </a>
           </td>
           <td  data-title="Service provider address1">
               
                 {{$c->sp_address_1}} 
           
           </td>
           <td  data-title="SP Address2">
               
                 {{$c->sp_address_2}} 
           
           </td>
           <td  data-title='SP City'>
               
                 {{$c->sp_city}} 
           
           </td>
           <td  data-title="SP Postcode">
               
                 {{$c->sp_postcode}} 
           
           </td>
       
           <td>
              <a href="/serviceProviders/{{$c->service_provider_id}}/edit/" title="Edit"><i class="fa fa-pencil-square fa-lg"></i>&nbsp;Edit</a>
                  
           </td>
       </tr>
       @endforeach
    </tbody>


</table>
      {!! $serviceProviders->render() !!}
</div>


</form>
    


@endsection

