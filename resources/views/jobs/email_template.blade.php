@extends('layouts.master')

@section('content')


<div class="row">

    <div class="col-md-6">
        <form  role="form" action='/jobs/emailTemplates' name='email_template_form' id='email_template_form' method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="file_path" value="{{$path}}">
            <input type="hidden" name="recipient_name" value="{{$clients->contact_name}}">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">General</h3>
                </div><!-- /.box-header -->

                <div class="box-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="InputTitle">Email</label>
                                <input type="text" placeholder="Enter Email" id="email_template" name="email_template" class="form-control" value="{{$clients->email}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="InputTitle">Subject</label>
                                <input type="text" placeholder="Subject for the Email" id="subject" name="subject" class="form-control " value="{!! \App\Models\Setting::where('setting_name','goods_in_subject')->first()->setting_value !!}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="InputTitle">Content</label>
                                <textarea class="textarea" id="content" name="content" placeholder="Email Template Text">{!! \App\Models\Setting::where('setting_name','goods_in_email_content')->first()->setting_value !!}</textarea>                                
                            </div>
                        </div>
                    </div>
                       <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"> 
                                 <label for="InputTitle">List Of Attachment</label>

                                    <table class="table table-striped table-bordered table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th style="width:15%;">File Type</th>
                                                <th>Filename</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <td><i class="fa fa-file-pdf-o"> pdf </td>
                                        <td>{{$filename}}</td>
                                        
                                        </tbody>
                                    </table>

                               
                            </div>
                        </div> 
                    </div>






                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Send</button>
                </div>
            </div>
        </form>

    </div>


</div>

@endsection