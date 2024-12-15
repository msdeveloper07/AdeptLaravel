<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">

    <title>{{$title or 'Home'}}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset("assets/css/bootstrap.min.css")}}" rel="stylesheet">
    
    <link href="{{asset("assets/css/font-awesome.min.css")}}" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="{{asset("assets/css/style.css")}}" rel="stylesheet">
    <link href="{{asset("assets/css/responsive.css")}}" rel="stylesheet">
    <link href="{{asset("assets/css/fonts.css")}}" rel="stylesheet">
    <link href="{{asset("assets/css/site.css")}}" rel="stylesheet">
     <!-- bootstrap wysihtml5 - text editor -->
     <link href="{{asset("assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}" rel="stylesheet" type="text/css" />
   
     <link href="{{asset("assets/css/bootstrap-datetimepicker.css")}}" rel="stylesheet">
     
    <!--[if lt IE 9 &!(IEMobile)]><link href="css/bootstrap-ie7.css")}}" rel="stylesheet" type="text/css" /><![endif]-->
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js")}}"></script><![endif]-->
    <script src="{{asset("assets/js/ie-emulation-modes-warning.js")}}"></script>
   
<!--    <script src="{{asset("assets/js/ugpermission.js")}}"></script>-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js")}}"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js")}}"></script>
    <![endif]-->
  </head>

  <body>

      @include('layouts.navbar')


      @include('layouts.left')
            <div class="main-section">
            <div class="container-page">
                
                
              
      @include('layouts.flashMessage')
      @yield('content')
     
            
      </div><!--/.container-page-->
      </div><!--/.main-section-->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{asset("assets/js/jquery.min.js")}}"></script>
   
    <script src="{{asset("assets/js/jquery-ui.js")}}"></script>
    <script src="{{asset("assets/js/bootstrap.min.js")}}"></script>
     <script src="{{asset("assets/js/moment.js")}}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{asset("assets/js/ie10-viewport-bug-workaround.js")}}"></script>
   
   
    <script src="{{asset("assets/js/main.js")}}"></script>
     <script src="{{asset("assets/js/bootstrap-datetimepicker.js")}}"></script>
    {{App\Libraries\ZnUtilities::load_js_files()}}
{{App\Libraries\ZnUtilities::load_js()}}
  </body>
</html>
