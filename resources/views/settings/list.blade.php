@extends('layouts.master')

@section('content')
<h2 class="page_header">Settings</h2>
    
        <div class="row">
            
        
        <div class="col-md-4">
        <form  role="form" action='/settings' name='settings_form' id='settings_form' method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Create New Setting</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-danger">*Use underscore(_)to in place of white spaces</p>
                        </div>
                     </div>
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="InputTitle">Setting Name</label>
                            <input type="text" id="setting_name" name="setting_name" class="form-control" value="{{Input::old('setting_name')}}">
                        </div>
                    </div>
                    </div>
                    
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="InputTitle">Value</label>
                            <textarea  id="setting_value" name="setting_value" class="ckeditor">{{Input::old('setting_value')}}</textarea>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            
                            <input type="checkbox" name="is_editor"  id="is_editor" value="1"><span style="padding-left:5px;">Editor</span>
                        </div>
                    </div>
                    </div>
                    
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
                
            </div>
        
    </form>
        </div>
            
         


    
    <div class="col-md-8">
        <form  role="form" action='/settings/update' name='settings_form' id='settings_form' method="post">
         <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        

        
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Saved Settings</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                   <div class='table-responsive'>
                        <table class="table table-hover table-bordered table-striped table-condensed admin-user-table">
                            <thead>
                                <tr>
                                    <th>Setting Name</th>
                                    <th>Value</th>
                                    <th></th>
                                </tr>
                             </thead>
                            <tbody>
                                @foreach($settings as $s)
                                <tr>
                                    <td>{{$s->setting_name}}</td>
                                    <td>
                                        <textarea name="setting_value[{{$s->id}}][]" class="{{$s->is_editor==1?'ckeditor':''}}">{{$s->setting_value}}</textarea>
                                    </td>
                                    <td><input type="submit" name="submit" value="Update" class="btn btn-success btn-flat" /></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                   </div>
                </div><!-- /.box-body -->
                 <div class="box-footer">
               
                </div>
            </div>
          </form>
    </div>
    </div>
  


@endsection

