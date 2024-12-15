@extends('layouts.master')

@section('content')



<div class="row">
   

        <div class="col-md-6">
             <form  role="form" action='/periods' name='user_form' id='user_form' method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="col-md-7">
                    <h3 class="box-title">Periods</h3>
                    </div>
                   
                       <div class="col-md-4">
                            <div class="form-group">
                                      <label  for="InputTitle">Start Year</label>
                                  <select name="year" class="form-control" id="" required>
                                   <option value="">Please Select Year</option>
                                     @for($i = 2000; $i <= 2030; $i++)
                                   
                                    <option value="{{$i}}">{{$i}}</option>
                                       @endfor
                                </select>
                            </div>
                        </div>
                  
                </div><!-- /.box-header -->

                <div class="box-body">
                    @for($i = 1; $i <= 12; $i++)
                    <div class="row">
                       <div class="col-md-1">
                            <div class="form-group">
                                <label  for="InputTitle">&nbsp;</label>
                                <span> {{$i}}.</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label  for="InputTitle">Start Date</label>
                               <input class="form-control StartDate" name="start_date[]" id=""  for="InputTitle" value=""  required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label  for="InputTitle">End Date</label>
                                <input class="form-control EndDate" name="end_date[]" id=""  for="InputTitle" value="" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label  for="InputTitle">Weeks</label>
                                <input class="form-control" name="weeks[]" id=""  for="InputTitle" value="" required />
                            </div>
                        </div>
                    </div>
                    @endfor
              
                
                 

                  

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
    </form>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">History</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                       <div class="row" style="display: none;">
                       <div class="col-md-1">
                            <div class="form-group">
                                <label  for="InputTitle">&nbsp;</label>
                                <span> </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label  for="InputTitle">Start Date</label>
                            
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label  for="InputTitle">End Date</label>
                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label  for="InputTitle">Weeks</label>
                               

                            </div>
                        </div>
                    </div>
                    @foreach($periods as $p)
                    <div class="row" style="display: none;">
                       <div class="col-md-1">
                            <div class="form-group">
                                <label  for="InputTitle">&nbsp;</label>
                                <span> </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
<!--                                <label  for="InputTitle">Start Date</label>-->
                              {{$p->start_date}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <!--<label  for="InputTitle">End Date</label>-->
                                  {{$p->end_date}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <!--<label  for="InputTitle">Weeks</label>-->
                                <!--<input class="form-control" name="weeks[]" id=""  for="InputTitle" value="" required />-->
                                    {{$p->number_of_weeks}}

                            </div>
                        </div>
                    </div>
                    @endforeach
              
                
                 

                  

                </div><!-- /.box-body -->

          
            </div>
        </div>
  
</div>

@endsection