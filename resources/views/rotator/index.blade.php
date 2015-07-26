@extends('app')

@section('title', $main_meta->title)

@section('description', $main_meta->description)

@section('keywords', $main_meta->keywords)

@section('content')
    <h1 class="page-heading" style="text-align: center;">Welcome to the Faucet Rotator</h1>

    <nav id="nav_buttons">
        <ul class="horizontal_list">
            <li><a class="btn btn-primary btn-lg faucet-nav" id="first_faucet" title="First Faucet" role="button">First</a></li>
            <li><a class="btn btn-primary btn-lg faucet-nav" id="previous_faucet" title="Previous Faucet" role="button">Previous</a></li>
            <li><a class="btn btn-primary btn-lg faucet-nav" id="current" href="" target="_blank" title="Current Faucet (opens in new window)" role="button">Current</a></li>
            <li><a class="btn btn-primary btn-lg faucet-nav" id="reload_current" title="Reload Current Faucet" role="button">Reload Current</a></li>
            <li><a class="btn btn-primary btn-lg faucet-nav" id="next_faucet" title="Next Faucet" role="button">Next</a></li>
            <li><a class="btn btn-primary btn-lg faucet-nav" id="last_faucet" title="Last Faucet" role="button">Last</a></li>
            <li><a class="btn btn-primary btn-lg faucet-nav" id="list_of_faucets" href="/faucets" title="List of Faucets" role="button">List of Faucets</a></li>
        </ul>
    </nav>

    <iframe sandbox="allow-forms allow-scripts allow-pointer-lock allow-same-origin" src="" id="rotator-iframe"></iframe>
    <script src="js/rotator.js"></script>
@endsection

@section('google_analytics')
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', '{{ $main_meta->google_analytics_id }}', 'auto');
        ga('send', 'pageview');
    </script>
@stop