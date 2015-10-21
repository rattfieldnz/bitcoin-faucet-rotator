@extends('app')

@section('title', $main_meta->title)

@section('description', $main_meta->description)

@section('keywords', $main_meta->keywords)

@section('content')

<h1 class="page-heading">{{ $main_meta->page_main_title }}</h1>
@include('partials.ads')
<nav id="navcontainer">
    <ul id="navlist">
        <li><a class="btn btn-primary btn-lg" id="first_faucet" title="First Faucet" role="button">First</a></li>
        <li><a class="btn btn-primary btn-lg" id="previous_faucet" title="Previous Faucet" role="button">Previous</a></li>
        <li><a class="btn btn-primary btn-lg" id="current" href="" target="_blank" title="Current Faucet (opens in new window)" role="button">Current</a></li>
        <li><a class="btn btn-primary btn-lg" id="reload_current" title="Reload Current Faucet" role="button">Reload Current</a></li>
        <li><a class="btn btn-primary btn-lg" id="next_faucet" title="Next Faucet" role="button">Next</a></li>
        <li><a class="btn btn-primary btn-lg" id="last_faucet" title="Last Faucet" role="button">Last</a></li>
        <li><a class="btn btn-primary btn-lg" id="random" title="Random Faucet" role="button">Random</a></li>
        <li><a class="btn btn-primary btn-lg" id="list_of_faucets" href="/faucets" title="List of Faucets" role="button">List of Faucets</a></li>
    </ul>
</nav>

<iframe sandbox="allow-forms allow-scripts allow-pointer-lock allow-same-origin" src="" id="rotator-iframe"></iframe>


<div class="row" id="main_page_content">
    <div class="col-lg-12">
         {!! $main_meta->page_main_content !!}
    </div>
</div>
@endsection

@section('faucet_rotator_script')
    @if(env('APP_ENV') == 'local')
        <script src="/assets/js/rotator.js?{{ rand()}}"></script>
    @elseif(env('APP_ENV') == 'production')
        <script src="/assets/js/rotator.min.js?{{ rand()}}"></script>
    @endif
@endsection

@section('google_analytics')
    @include('partials.google_analytics')
@stop
