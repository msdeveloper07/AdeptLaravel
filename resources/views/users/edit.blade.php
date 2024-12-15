@extends('layouts.master')

@section('content')




<div class="row">
    <form  role="form" action="/users/{{$id}}" name='user_form' id='user_form' method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="_method" value="PUT">


        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">General</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="InputTitle">Full Name</label>
                            <input type="text" placeholder="Full name" id="name" name="name" class="form-control required" value="{{$user->name}}">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                       <div class="col-md-8">
                           <div class="form-group">
                              <label for="InputTitle">Email</label>
                              <input type="email" placeholder="Ex: you@abc.com" id="email" name="email" class="form-control required"  value="{{$user->email}}">
                            </div>
                       </div>
                   </div>
                   
                   
                    
                    
                    <div class="row">
    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="InputTitle">User Group</label>
                                <select name="user_group_id" id="user_group_id" class="form-control required">
                                    <option value="">Please Select</option>
                                     
                              @foreach($usergroup as $u)
                                <option {{$u->id==$user->user_group_id?'selected="selected"':''}} value="{{$u->id}}">{{$u->user_group_name}} </option>
                                @endforeach
                         
                                </select>    
                            </div>
                        </div>
                       
                    </div>
                    
                     <div class="row" > 
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="InputEmail">User Status</label>
                                <label class="radio-inline">
                                    <input type="radio" {{$user->user_status=='active' ? 'checked="checked"':''}} name="user_status" value="active"   id="user_status_active"  checked="checked">Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" {{$user->user_status=='deactive'?'checked="checked"':''}} name="user_status" value="deactive" id="user_status_active" >Deactive
                                </label>


                            </div>
                        </div>
                    </div>
                     
                     
                    
                    
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection