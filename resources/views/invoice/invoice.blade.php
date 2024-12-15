@extends('layouts.master')

@section('content')


<div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Invoice Report</h3>
            </div><!-- /.box-header -->
            <!-- form start -->

            <form  action="/invoiceSearch" method="get" name="search_form" id="search_form">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="box-body">
                     <div class="box-danger">
                    <div class='row'>
                       
                        <div class="col-md-6">
                            <div class="form-group">Client Name
                                <select name="client_id" id="client" class="form-control" >
                                   
                                    <?php $client = \App\Models\Client::all(); ?>
                                    @foreach($client as $c)
                                    <option {{old('client_id')==$c->id?'selected="selected"':''}} value='{{$c->id}}'>{{$c->client_name}}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">Select Month
                                <select id="select_month" class='form-control'name="month">
                               
                                    <option {{old('month')==1?'selected="selected"':''}} value='1'>January</option>
                                    <option {{old('month')==2?'selected="selected"':''}} value='2'>February</option>
                                    <option {{old('month')==3?'selected="selected"':''}} value='3'>March</option>
                                    <option {{old('month')==4?'selected="selected"':''}} value='4'>April</option>
                                    <option {{old('month')==5?'selected="selected"':''}} value='5'>May</option>
                                    <option {{old('month')==6?'selected="selected"':''}} value='6'>June</option>
                                    <option {{old('month')==7?'selected="selected"':''}} value='7'>July</option>
                                    <option {{old('month')==8?'selected="selected"':''}} value='8'>August</option>
                                    <option {{old('month')==9?'selected="selected"':''}} value='9'>September</option>
                                    <option {{old('month')==10?'selected="selected"':''}} value='10'>October</option>
                                    <option {{old('month')==11?'selected="selected"':''}} value='11'>November</option>
                                    <option {{old('month')==12?'selected="selected"':''}} value='12'>December</option>
                                </select>
                            </div> 
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group">Select Year
                                <select id="select_year" class='form-control'name="year">
                                    <option value=''>Select Year</option>
                                   <?php
                                        for ($i = date("Y"); $i > 2005; $i--) {
                                        $sel = ($i == date('Y')) ? 'selected' : '';
                                        echo "<option value=" . $i . " " . $sel . ">" .$i . "</option>";
                                    }
                                    ?>
                                </select>
                            </div> 
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

@endsection

