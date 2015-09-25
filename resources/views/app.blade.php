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

    @if(env('APP_ENV') == 'local')
        <link rel="stylesheet" href="/assets/css/freebtc.css?{{ rand()}}">
    @elseif(env('APP_ENV') == 'production')
        <link rel="stylesheet" href="/assets/css/freebtc.min.css?{{ rand()}}">
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
	<!-- Hotjar Tracking Code for freebtc.website -->
	<script>
		(function(h,o,t,j,a,r){
			h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
			h._hjSettings={hjid:72229,hjsv:5};
			a=o.getElementsByTagName('head')[0];
			r=o.createElement('script');r.async=1;
			r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
			a.appendChild(r);
		})(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
	</script>
</head>
<body>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=1506179922982508";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
    @include('partials.nav')

    <div class="container">
	    @yield('content')
    </div>

    @include('partials.footer')

	@if(env('APP_ENV') == 'local')
		<script src="/assets/js/freebtc.js?{{ rand()}}"></script>
	@elseif(env('APP_ENV') == 'production')
		<script src="/assets/js/freebtc.min.js?{{ rand()}}"></script>
	@endif
    <script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50b996b14942b1fb" async="async"></script>
    @yield('faucet_rotator_script')
	@yield('ckeditor-script')
    @yield('google_analytics')
</body>
</html>
