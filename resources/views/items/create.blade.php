@extends('layouts.master')

@section('content')




<div class="row">
    <form  role="form" action='/items' name='user_form' id='user_form' method="post">
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
                                <label for="InputTitle">Item Name</label>
                                <input type="text" placeholder="Item Name" id="item_name" name="item_name" class="form-control " value="{{Input::old('item_name')}}">
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