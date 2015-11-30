<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
	<meta name="description" content="@yield('description')">
	<meta name="keywords" content="@yield('keywords')">
	<meta name="yandex-verification" content="{{ \App\Helpers\WebsiteMeta\WebsiteMeta::seVerificationIds()['yandex_verification'] }}" />
	<meta name="msvalidate.01" content="{{ \App\Helpers\WebsiteMeta\WebsiteMeta::seVerificationIds()['bing_verification'] }}" />
    <link href="http://feeds.feedburner.com/freebtcwebsitefeed" rel="alternate" type="application/rss+xml" title="FreeBTC.Website Bitcoin Faucet Rotator Feed" />
    
    @if(env('APP_ENV') == 'local')
        <link rel="stylesheet" href="/assets/css/mainStyles.css?{{ rand()}}">
    @elseif(env('APP_ENV') == 'production')
        <link rel="stylesheet" href="/assets/css/mainStyles.min.css?{{ rand()}}">
    @endif

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
        @yield('ckeditor-script')
</head>
<body>
	
    @include('partials.nav')

    <div class="container">
	    @yield('content')
    </div>

    @include('partials.footer')

	@if(env('APP_ENV') == 'local')
		<script src="/assets/js/mainScripts.js?{{ rand()}}"></script>
	@elseif(env('APP_ENV') == 'production')
		<script src="/assets/js/mainScripts.min.js?{{ rand()}}"></script>
	@endif

    @if(\App\Helpers\WebsiteMeta\WebsiteMeta::addThisId())
        <script src="//s7.addthis.com/js/300/addthis_widget.js#pubid={{ \App\Helpers\WebsiteMeta\WebsiteMeta::addThisId() }}" async="async"></script>
    @endif
    @yield('faucet_rotator_script')
	@yield('ckeditor-script')
    @yield('google_analytics')
</body>
</html>
