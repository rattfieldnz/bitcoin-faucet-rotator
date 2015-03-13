<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bitcoin Faucet Rotator</title>

    <link rel="stylesheet" href="/bower_components/jquery-ui/themes/dark-hive/jquery-ui.min.css">
	<link href="/css/master-final.min.css" rel="stylesheet">
    <link href="/table_sorter_themes/blue/style.css" rel="stylesheet">
    <!-- Scripts -->
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script src="/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap.min.js"></script>

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
    @include('partials.nav')

    <div class="container">
	    @yield('content')
    </div>

    @include('partials.footer')
    
</body>
</html>
