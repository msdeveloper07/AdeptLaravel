@extends('layouts.master')

@section('content')

@if(isset($title))
<h2 class="page_header">{{$title}}</h2>
@endif

<form class="form-inline" action="/jobTypeAction" method="post" name="actions_form" id="actions_form">

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
                            <option value="delete">Delete Selected Job Type</option>
                        </select>
                     </div>
                 
             </div>
             
             
                <div class="col-md-4">
                  
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                                
                        <div class="input-group">
                            <input type="text" class="form-control"  name="search" value="{{isset($search)?$search:''}}" placeholder="Search Job Type" aria-describedby="basic-addon2">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default btn-flat">Find Job Type</button>
                            </span>
                        </div>
                      
                </div>

                <div class="col-md-2">
                    <a href="/jobtype/create" class="btn btn-primary btn-flat">Add New Job Type </a>
                </div>
              @if(isset($search)) 
             <div class="col-md-2">
                    <a href="/jobtype" class="btn btn-info btn-flat">Show All Job Types</a>
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
            <th>Job Type</th>
            
            <th>&nbsp;</th>
           
       </tr>
     </thead>
     <tbody>
        @foreach($jobtype as $c)
       <tr>
           <td  data-title="Select">
               <input type="checkbox" class="check" name="cid[]" value="{{$c->job_type_id}}" id="cid{{$c->job_type_id}}" />
           </td>

           <td  data-title="Job Type">
               <a href="/jobtype/{{$c->job_type_id}}/edit/" title="Edit">
                 {{$c->job_type}} 
               </a>
           </td>
       
           <td>
              <a href="/jobtype/{{$c->job_type_id}}/edit/" title="Edit"><i class="fa fa-pencil-square fa-lg"></i>&nbsp;Edit</a>
                  
           </td>
       </tr>
       @endforeach
    </tbody>


</table>
      {!! $jobtype->render() !!}
</div>


</form>
    


@endsection

