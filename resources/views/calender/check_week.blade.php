@extends('layouts.master')

@section('content')



<div class="row">
    <form  role="form" action='/checkWeek' name='user_form' id='checkWeek' method="post">
        <input type="hidden" id="token" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">General</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                  
                   

                     
               
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputTitle">Select Date</label>
                                <input type="text" placeholder=""  name="select_month" class="form-control checkWeekDate"  value="">
                            </div>
                        </div>
                      
                       
                    </div>
                    <div class='row'>
                          <div class="col-md-2">
                            <div class="form-group">
                                 <label for="InputTitle">&nbsp;</label>
                                <button  name="select_month"  class="form-control submitForm" >Submit</button>
                                <!--<button class="btn btn-primary form-control" id="checkWeek"  type="submit">Submit</button>-->
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                 <label for="InputTitle">&nbsp;</label>
                               <button  name="select_month"  class="form-control resetForm" >Reset</button>
                            </div>
                        </div>
                    </div>
                    
                  
                    <div class="row" id="show_data" style="display: none;">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="InputTitle">Total Week</label>
                                <input type="text" placeholder=""  name="total_week" id="total_week" class="form-control" readonly  value="">
                            </div>
                        </div>
                       
                   
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="InputTitle">First Monday</label>
                                <input type="text" placeholder=""  name="start_date" id="start_date" class="form-control" readonly value="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="InputTitle">Last Sunday</label>
                                <input type="text" placeholder=""  name="start_date" id="end_date" class="form-control" readonly value="">
                            </div>
                        </div>
                       
                    </div>
                 
                 
              
                    

                


                  

                </div><!-- /.box-body -->

<!--                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>-->
            </div>
        </div>
    </form>
</div>

@endsection