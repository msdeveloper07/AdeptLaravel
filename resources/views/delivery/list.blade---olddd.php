@extends('layouts.master')

@section('content')



<form class="form-inline" action="/deliveryAction" method="post" name="actions_form" id="actions_form">
      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

<div class="box box-danger">
    
        
    <div class="box-body">
         <div class="row">
             <div class="col-md-3">
               <div class="form-group">
                   <select id="clients" name="clients" style="width:130%;" class="form-control">
                       <option value="">Select Client</option>
                       @foreach($clients as $c)     
                       <option value={{$c->id}} > {{$c->client_title}}</option>
                        @endforeach  
                        </select>
                     </div>
             </div>
             
                    
             <div class="col-md-3">
                 
               <div class="form-group  pull-right">
                  Search Delivery <select id="search_by_date" name="search_by_date" class="form-control" onchange="Search(this.value)">
                            <option {{$search_by_date=='delivery_number'?'selected="selected"':''}} value="delivery_number">Delivery Number</option>
                            <option {{$search_by_date=='collection_date'?'selected="selected"':''}} value="collection_date">Collection Date</option>
                            <option {{$search_by_date=='delivery_date'?'selected="selected"':''}} value="delivery_date">Delivery Date</option>
                        </select>
             </div>
             </div>
          <div class="col-md-2">
              <div class="input-group" >
           <input type="text" class="form-control pull-right"  name="search_date" onchange="Datechange(this.val)" id="search_date" value="" placeholder="Select Date" aria-describedby="basic-addon2">
           <span class="input-group-addon" id="cal"><i class="fa fa-calendar"></i></span>
              </div>
          </div>
             
             
                <div class="col-md-2">
                  
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                                
                        <div class="input-group">
                            <input type="text" class="form-control" id="search" name="search" value="{{isset($search)?$search:''}}" placeholder="Search Delivery" aria-describedby="basic-addon2">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default btn-flat">Find</button>
                            </span>
                        </div>
                      
                </div>

                <div class="col-md-2">
                    <a href="/delivery/create" class="btn btn-primary btn-flat">Add New Delivery</a>
                </div>

            </div>
        
        <div class="row">&nbsp;
    </div>    
            <div class="row">
   
               <div class="col-md-4">
               Select Job Number <div class="form-group">
                   <select id="jobs" name="jobs" style="width:100%; " class="form-control">
                         
                       <option value=''>Select Job</option>
                       
                        </select>
</div>
                   </div>
        </div>
    </div>    

</div>


<div class='table-responsive'>
    <table id="delivery_table" class="table table-hover table-bordered pull-left table-striped table-condensed admin-user-table">
    <thead>
        <tr>
            <th>Delivery Number</th>
            <th>Job Id</th>
            <th>Collection Date</th>
            <th>Delivery Date</th>
             <th>&nbsp;</th>
           
           
       </tr>
     </thead>
     <tbody>
        
       <tr>

       </tr>
     
    </tbody>


</table>
      {!! $deliveries->render() !!}
</div>


</form>
    


@endsection

