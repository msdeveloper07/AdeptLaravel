@extends('layouts.blankTemplate')

@section('content')

<div class="form-box" id="forgot-password-box">
    <div class="header">Forgot Password</div>
    <form  role="form" method="POST" action="{{ url('/password/reset') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="token" value="{{ $token }}">
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
                <input type="email" class="form-control" name="email" placeholder="Enter Your Email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" placeholder="Choose your password" name="password">
            </div>

            <div class="form-group">
                <input type="password" class="form-control"  placeholder="Re-Enter your password" name="password_confirmation">
            </div>
        </div>
        <div class="footer">
            <button type="submit" class="btn bg-olive btn-block">Reset Password</button>
        </div>

    </form>
</div>

@endsection
