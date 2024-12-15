@extends('layouts.master')

@section('content')


<div class="row">
    <form  role="form" action="/vehicletype/{{$id}}" name='user_form' id='user_form' method="post">
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
                                <label for="InputTitle">Item Name</label>
                                <input type="text" placeholder="Item Name" id="vehicle_type" name="vehicle_type" class="form-control " value="{{$vehicletype->vehicle_type}}">
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