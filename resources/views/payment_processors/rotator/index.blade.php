@extends('app')

@section('title', $paymentProcessor->name . ' Faucet Rotator (' . count($paymentProcessor->faucets) . ' available faucet/s) | FreeBTC.Website')

@section('description', 'Come and get free satoshis from around ' . count($paymentProcessor->faucets) . ' faucets in the ' . $paymentProcessor->name . ' Faucet Rotator.')

@section('keywords', $paymentProcessor->meta_keywords)

@section('content')
<h1 class="page-heading">{{ $paymentProcessor->name }} Faucet Rotator</h1>
<span property="{{ $paymentProcessor->slug }}" id="faucet_slug"></span>
<p id="comments"><small><a href="#disqus_thread">See comments</a></small></p>
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

<hr>
<div class="container">
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        @include('payment_processors.rotator.partials.disqus')
    </div>
</div>
<hr>
@endsection

@section('faucet_rotator_script')
    @if(env('APP_ENV') == 'local')
        <script src="/assets/js/paymentProcessorRotator.js?{{ rand()}}"></script>
    @elseif(env('APP_ENV') == 'production')
        <script src="/assets/js/paymentProcessorRotator.min.js?{{ rand()}}"></script>
    @endif
@endsection

@section('google_analytics')
    @include('partials.google_analytics')
@stop
