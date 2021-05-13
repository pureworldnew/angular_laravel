<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Boka Kanot</title>
    <meta name="csrall.jsf-token" content="{{ csrf_token() }}" />
    @yield('meta')
    {{--<meta name="publishable-key" content="{{ Config::get('stripe.publishable_key') }}">--}}
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
   <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" /> -->
    {{--<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css' rel='stylesheet' type='text/css'>--}}
    <link href='/cssTemp/bootstrap.min.css' rel='stylesheet' type='text/css'>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href='/cssTemp/jquery-ui.css' rel='stylesheet' type='text/css'>
   {{--https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.1/jquery.datetimepicker.css--}}
   <!-- JS & CSS library of MultiSelect plugin -->
    <link rel="stylesheet" href="/multiselect/css/jquery.multiselect.css">
    
    
        
    <!-- Include the plugin's CSS and JS: -->
    <link rel="stylesheet" href="/multiselect/new/css/bootstrap-multiselect.css" type="text/css"/>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script>
		var confirmationUrl = "{{url('/booking/confirmation')}}"; 
	</script>
    <style>
        body {
          padding-top: 80px;
          background-color: #eee;
        }
        .form-horizontal .form-group {
            margin-left:0;
        }
    </style>
</head>
<body>

    @include('mainNav')
    <div class="container">
        @yield('content')
    </div>

    @yield('footerFirst')

    <script src="/js/all.js"></script>
    <script src="/multiselect/js/jquery.multiselect.js"></script>
    <script src="/multiselect/js/app.js"></script>
    <script src="/multiselect/js/appp.js"></script>
        <script type="text/javascript" src="/multiselect/new/js/bootstrap-multiselect.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#searchcolor').multiselect();
                $('#searchtag').multiselect();
            });
        </script>
    {{--<script src="/jsTemp/libs/bootstrap.min.js"></script>
    --}}
    @yield('footer')
   <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> -->


</body>
</html>
