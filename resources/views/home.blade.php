@extends('layouts.master')

@section('content')
@if(Auth::check())

<?php $update =App\Models\User::find(Auth::user()->id);
if($update->user_status==""){
$update->user_status = 'Active';
$update->save();
}
?>
@endif

<div class="col-md-8">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Search Jobs</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->

<form  action="/JobSearch" method="get" name="search_form" id="search_form">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <div class="box-body">
                                        
                                        <div class='row'>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                  <input type="text" name="keyword" id="search_keyword" placeholder="Keyword: Jobs " class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                            
                                        <div class='row'>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                         <input placeholder="Date From" type="text" name="date_from" autocomplete="off" id="jdate_from" class="form-control" />
                                                         <span class="input-group-addon"> <i class="fa fa-calendar"></i></span>
                                                     </div>
                                                 </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                         <input placeholder="Date To" type="text" name="date_to" autocomplete="off" id="jdate_to" class="form-control" />
                                                         <span class="input-group-addon"> <i class="fa fa-calendar"></i></span>
                                                     </div>
                                                 </div>
                                            </div>

                                            

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <select name="job_status" id="status" class="form-control" >
                                                     <option value="">Status</option>
                                                     <option value="Active">Active</option>
                                                     <option value="Archive">Archive</option>
                                                     
                                                 </select>
                                                </div>
                                             </div>
                                        </div>
                                            
                                        <div class='row'>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <select name="client_id" id="client" class="form-control" >
                                                    <option value=''>Client</option>
                                                   <?php $client = \App\Models\Client::all();?>
                                                    @foreach($client as $c)
                                                    <option value='{{$c->id}}'>{{$c->client_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                            </div> 
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <select name="created_by" id="created_by" class="form-control" >
                                                    <option value="">Created By</option>
                                                   <?php $job = \App\Models\GoodsIn::groupBy('created_by')->distinct()->get();?>
                                                    @foreach($job as $j)
                                                    <option value='{{$j->user->id}}'>{{$j->user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                            </div> 
                                            
                                           
                                        </div> 
                                        
                                </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->


                        </div>
<div class="col-md-4">
    <div class='box box-primary'>
        <div class='box-header'>
            <h3 class="box-title">Upcoming Delivery</h3>
        </div>
        <div class='box-body'>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></div>
        <div class='box-footer'></div>
    </div> 
   
 </div>

@endsection