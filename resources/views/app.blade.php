<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
	<meta name="description" content="@yield('description')">
	<meta name="keywords" content="@yield('keywords')">
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
	<meta name = 'yandex-verification' content = '6bd366f4a927b8e4' />
	<meta name="msvalidate.01" content="01CE0CA0B4512F8EF0B231C935E124E1" />
</head>
<body>
    @include('partials.nav')

    <div class="container">
	    @yield('content')
    </div>

    @include('partials.footer')
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50b996b14942b1fb" async="async"></script>
    @yield('google_analytics')
</body>
</html>
