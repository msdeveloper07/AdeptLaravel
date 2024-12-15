@extends('layouts.blankTemplate')

@section('content')
<div class="form-box" id="login-box">
    <div class="header">Sign In</div>
    <form role="form" id="login_form" action="/auth/login" method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="body bg-gray">
            @if (count($errors) > 0)
            <div role="alert" class="alert alert-danger alert-dismissible">
                <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                <span class="icon"><i class="fa fa-times fa-fw fa-2x "></i></span>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </div>
            @endif
            <div class="form-group">
                <input type="email" name="email" class="form-control required email" placeholder="your@email.com"/>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control required" placeholder="**********" >
            </div>          

        </div>
        <div class="footer">                                                               
            <button type="submit" class="btn bg-olive btn-block">Sign me in</button>  

            <p><a href="/password/email">I forgot my password</a></p>

        </div>
    </form>
</div>




@endsection
