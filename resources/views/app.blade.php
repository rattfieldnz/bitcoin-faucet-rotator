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
</head>
<body>
    @include('partials.nav')

    <div class="container">
	    @yield('content')
    </div>

    @include('partials.footer')
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-52339473-1', 'auto');
		ga('send', 'pageview');

	</script>
</body>
</html>
