@extends('layouts.master')

@section('content')



<div class="row">
    <form  role="form" action='/userGroups' name='user_form' id='user_form' method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">General</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="InputTitle">User Group Name</label>
                            <input type="text" placeholder="Enter User Group Name" id="user_group_name" name="user_group_name" class="form-control required" value="{{Input::old('name')}}">
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

@stop