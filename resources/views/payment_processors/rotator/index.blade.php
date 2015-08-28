@extends('app')

@section('content')
<h1 id="page-heading">{{ $paymentProcessor->name }} Faucet Rotator</h1>
<span property="{{ $paymentProcessor->slug }}" id="faucet_slug"></span>
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
        <li><a class="btn btn-primary btn-lg" id="list_of_faucets" href="/payment_processors/{{ $paymentProcessor->slug }}" title="List of Faucets" role="button">List of Faucets</a></li>
    </ul>
</nav>

<iframe sandbox="allow-forms allow-scripts allow-pointer-lock allow-same-origin" src="" id="rotator-iframe"></iframe>
<script src="/js/paymentProcessorRotator.js?{{ rand()}}"></script>

@endsection

@section('google_analytics')
    @include('partials.google_analytics')
@stop
