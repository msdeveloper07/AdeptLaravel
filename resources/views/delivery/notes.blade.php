@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><a href="/delivery/{{$id}}">Delivery</a></li>
                <li><a href="/showAddress/{{$id}}">Address</a></li>
                <li  class="active"><a href="/delivery/notes/{{$id}}/">Notes</a></li>
                <li ><a href="/delivery/lots/{{$id}}/">Select Lots To Be Delivered</a></li>
            </ul>
        </div><!-- nav-tabs-custom -->
    </div><!-- /.col -->
</div>


<div class="row">
    <form  role="form" action='/saveDeliveryNote/{{$id}}' name='user_form' id='user_form' method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="row" > 
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="InputEmail">Type Of Note</label><br>
                                <label class="radio-inline">
                                    <input type="radio"  <?php echo (isset($delivery->delivery_note)?$delivery->delivery_note:''!=''?'checked="checked"':'');?> name="type_of_note" value="delivery_note"   id="type_of_noted" onchange="Typeofnote(this.value)" >Delivery Note
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" <?php echo (isset($delivery->collection_note)?$delivery->collection_note:''!=''?'checked="checked"':'');?> name="type_of_note" value="collection_note" id="type_of_notec" onchange="Typeofnote(this.value)">Collection Note
                                </label>
 <?php
                    $delivery_date = App\Libraries\ZnUtilities::format_date($delivery->delivery_date ,10);
                    $delivery_note = str_replace('{date}',$delivery_date , App\Models\Setting::where('setting_name', 'delivery_note')->first()->setting_value);
                    $delivery_address = $delivery->delivery_address_1 . " " . $delivery->delivery_address_2 . " " . $delivery->delivery_city . " " . $delivery->delivery_county . " " . $delivery->delivery_postcode;
                    $delivery_note = str_replace('{Delivery_address}', $delivery_address, $delivery_note);
                    ?>

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea  id="notes" name="notes"rows="7" style="width: 100%; " readonly ><?php  if($delivery->collection_note!=''){echo $delivery->collection_note;}else if($delivery->delivery_note!=''){echo $delivery->delivery_note;}?></textarea> 
                            </div>
                        </div>

                    </div>
                </div>
                <div id='div1' style="display:none">
                   
                    <input type='hidden'id='delivery_note' value='{{$delivery_note}}'>
                </div>
                <div id='div2' style="display:none" >
                 <?php $collection_note = str_replace('{date}',App\Libraries\ZnUtilities::format_date($delivery->collection_date,10), App\Models\Setting::where('setting_name', 'collection_note')->first()->setting_value); ?>
                    <input type='hidden'id='collection_note' value='{{$collection_note}}'>
                </div>

                <div class="box-footer">
                    <button class="btn btn-primary" type='submit' onclick="$('#user_form').attr('target', '_blank');">Print</button>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection