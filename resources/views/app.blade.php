<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
	<meta name="description" content="@yield('description')">
	<meta name="keywords" content="@yield('keywords')">
	
	<meta property="og:url" content="{{ Illuminate\Support\Facades\Request::url() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="{{ env(ROOT_URL) }}/images/og/bitcoin.png" />
	
	<meta name="yandex-verification" content="{{ \App\Helpers\WebsiteMeta\WebsiteMeta::seVerificationIds()['yandex_verification'] }}" />
	<meta name="msvalidate.01" content="{{ \App\Helpers\WebsiteMeta\WebsiteMeta::seVerificationIds()['bing_verification'] }}" />
    <meta name="tagblog-owner-verification" content="TBVF353-8tDmwD0wW9ULQW2jZkmfmyNN1aUhCK">
	
    @if(\App\Helpers\WebsiteMeta\WebsiteMeta::feedburnerFeedUrl())
        <link href="{{ \App\Helpers\WebsiteMeta\WebsiteMeta::feedburnerFeedUrl() }}" rel="alternate" type="application/rss+xml" title="@yield('title') Feed" />
    @else
        <link href="/feed" rel="alternate" type="application/rss+xml" title="@yield('title') Feed" />
    @endif

    
    @if(env('APP_ENV') == 'local')
        <link rel="stylesheet" href="/assets/css/mainStyles.css?{{ rand()}}">
    @elseif(env('APP_ENV') == 'production')
        <link rel="stylesheet" href="/assets/css/mainStyles.min.css?{{ rand()}}">
    @endif

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="/images/bitcoin-16x16.ico">


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
	@if(\App\Helpers\WebsiteMeta\WebsiteMeta::activatedAdBlockBlocking() == true && Auth::guest())
    <script src="/assets/js/blockadblock.js"></script>
	@endif
    @yield('google_analytics')
</body>
</html>
