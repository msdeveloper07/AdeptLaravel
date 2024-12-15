@extends('layouts.master')

@section('content')

@if(isset($title))
<h2 class="page_header">{{$title}}</h2>
@endif

<form class="form-inline" action="/supplierAction" method="post" name="actions_form" id="actions_form">

<div class="box box-danger">
    
        
    <div class="box-body">
         <div class="row">
             
             <div class="col-md-4">
                     Actions
                     <div class="form-group">
                        <select id="bulk_action" name="bulk_action" class="form-control" placeholder="Select Action"  >
                            <option value="">Select An Action</option>
<!--                            <option value="blocked">Block Selected Supplier</option>
                            <option value="active">Activate Selected Supplier</option>-->
                            <option value="delete">Delete Selected Supplier</option>
                        </select>
                     </div>
                 
             </div>
             
             
                <div class="col-md-4">
                  
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                                
                        <div class="input-group">
                            <input type="text" class="form-control"  name="search" value="{{isset($search)?$search:''}}" placeholder="Search Suppliers" aria-describedby="basic-addon2">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default btn-flat">Find Supplier</button>
                            </span>
                        </div>
                      
                </div>

                <div class="col-md-2">
                    <a href="/suppliers/create" class="btn btn-primary btn-flat">Add New Supplier </a>
                </div>
              @if(isset($search)) 
               <div class="col-md-2">
                    <a href="/suppliers" class="btn btn-info btn-flat">Show All Suppliers</a>
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
            <th>Supplier Name</th>
            <th>Contact Name</th>
            <th>Email</th>
       
            <th>&nbsp;</th>
           
       </tr>
     </thead>
     <tbody>
        @foreach($suppliers as $c)
       <tr>
           <td  data-title="Select">
               <input type="checkbox" class="check" name="cid[]" value="{{$c->id}}" id="cid{{$c->id}}" />
           </td>

           <td  data-title="Supplier Name">
               <a href="/suppliers/{{$c->id}}/edit/" title="Edit">
                 {{$c->supplier_name}} 
               </a>
           </td>
           
           <td  data-title="contact"> {{$c->contact_name}}</td>
       
           <td  data-title="email">{{$c->email}}</td>
           
           <td>
              <a href="/suppliers/{{$c->id}}/edit/" title="Edit"><i class="fa fa-pencil-square fa-lg"></i>&nbsp;Edit</a>
                  
           </td>
       </tr>
       @endforeach
    </tbody>


</table>
      {!! $suppliers->render() !!}
</div>


</form>
    


@endsection

