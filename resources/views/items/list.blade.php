@extends('layouts.master')

@section('content')

@if(isset($title))
<h2 class="page_header">{{$title}}</h2>
@endif

<form class="form-inline" action="/itemAction" method="post" name="actions_form" id="actions_form">

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
                            <option value="delete">Delete Selected Item</option>
                        </select>
                     </div>
                 
             </div>
             
             
                <div class="col-md-4">
                  
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                                
                        <div class="input-group">
                            <input type="text" class="form-control"  name="search" value="{{isset($search)?$search:''}}" placeholder="Search Items" aria-describedby="basic-addon2">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default btn-flat">Find Item</button>
                            </span>
                        </div>
                      
                </div>

                <div class="col-md-2">
                    <a href="/items/create" class="btn btn-primary btn-flat">Add New Item </a>
                </div>
              @if(isset($search)) 
                <div class="col-md-2">
                    <a href="/items" class="btn btn-info btn-flat">Show All Items</a>
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
            <th>Item Name</th>
            
            <th>&nbsp;</th>
           
       </tr>
     </thead>
     <tbody>
        @foreach($items as $c)
       <tr>
           <td  data-title="Select">
               <input type="checkbox" class="check" name="cid[]" value="{{$c->id}}" id="cid{{$c->id}}" />
           </td>

           <td  data-title="Item Title">
               <a href="/items/{{$c->id}}/edit/" title="Edit">
                 {{$c->item_name}} 
               </a>
           </td>
       
           <td>
              <a href="/items/{{$c->id}}/edit/" title="Edit"><i class="fa fa-pencil-square fa-lg"></i>&nbsp;Edit</a>
                  
           </td>
       </tr>
       @endforeach
    </tbody>


</table>
      {!! $items->render() !!}
</div>


</form>
    


@endsection

