@extends('app')

@section('title', $main_meta->title)

@section('description', $main_meta->description)

@section('keywords', $main_meta->keywords)

@section('content')
<h1 id="page-heading">Welcome to the Bitcoin Faucet Rotator</h1>

<nav id="navcontainer">
    <ul id="navlist">
        <li><a class="btn btn-primary btn-lg" id="first_faucet" title="First Faucet" role="button">First</a></li>
        <li><a class="btn btn-primary btn-lg" id="previous_faucet" title="Previous Faucet" role="button">Previous</a></li>
        <li><a class="btn btn-primary btn-lg" id="current" href="" target="_blank" title="Current Faucet (opens in new window)" role="button">Current</a></li>
        <li><a class="btn btn-primary btn-lg" id="reload_current" title="Reload Current Faucet" role="button">Reload Current</a></li>
        <li><a class="btn btn-primary btn-lg" id="next_faucet" title="Next Faucet" role="button">Next</a></li>
        <li><a class="btn btn-primary btn-lg" id="last_faucet" title="Last Faucet" role="button">Last</a></li>
        <li><a class="btn btn-primary btn-lg" id="list_of_faucets" href="/faucets" title="List of Faucets" role="button">List of Faucets</a></li>
    </ul>
</nav>

<iframe sandbox="allow-forms allow-scripts allow-pointer-lock allow-same-origin" src="" id="rotator-iframe"></iframe>
<script src="js/rotator.js"></script>
@endsection

@section('google_analytics')
    @include('partials.google_analytics')
@stop