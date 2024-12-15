@extends('layouts.blankTemplate')

@section('content')
        <div class="form-box" id="login-box">
            <div class="header">Sign Up</div>
            <form role="form" id="login_form" action="/auth/register" method="post">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="name" name="name" class="form-control required email" placeholder="Enter your name"/>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control required email" placeholder="your@email.com"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control required" placeholder="**********" >
                    </div>          
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control required" placeholder="**********" >
                    </div>          
                   
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Register</button>  
                    
                   
                   
                </div>
            </form>
        </div>


    
    
@endsection