@extends('app')

@section('title', $paymentProcessor->name . ' Faucet Rotator (' . count($paymentProcessor->faucets) . ' available faucet/s) | FreeBTC.Website')

@section('description', 'Come and get free satoshis from around ' . count($paymentProcessor->faucets) . ' faucets in the ' . $paymentProcessor->name . ' Faucet Rotator.')

@section('keywords', $paymentProcessor->meta_keywords)

@section('content')
<h1 class="page-heading">{{ $paymentProcessor->name }} Faucet Rotator</h1>
<span property="{{ $paymentProcessor->slug }}" id="faucet_slug"></span>
<p id="comments"><small><a href="#disqus_thread">See comments</a></small></p>
@include('partials.ads')
<div class="row">
    <nav id="nav-container" class="col-lg-12 center-block">
        <ul id="nav-list">
            <li>
                <a class="btn btn-primary btn-lg" id="first_faucet" title="First Faucet" role="button">
                    <span class="glyphicon glyphicon-fast-backward"></span>
                </a>
            </li>
            <li>
                <a class="btn btn-primary btn-lg" id="previous_faucet" title="Previous Faucet" role="button">
                    <span class="glyphicon glyphicon-step-backward"></span>
                </a>
            </li>
            <li>
                <a class="btn btn-primary btn-lg" id="current" href="" target="_blank" title="Current Faucet (opens in new window)" role="button">
                    <span class="glyphicon glyphicon-export"></span>
                </a>
            </li>
            <li>
                <a class="btn btn-primary btn-lg" id="reload_current" title="Reload Current Faucet" role="button">
                    <span class="glyphicon glyphicon-refresh"></span>
                </a>
            </li>
            <li>
                <a class="btn btn-primary btn-lg" id="next_faucet" title="Next Faucet" role="button">
                    <span class="glyphicon glyphicon-step-forward"></span>
                </a>
            </li>
            <li>
                <a class="btn btn-primary btn-lg" id="last_faucet" title="Last Faucet" role="button">
                    <span class="glyphicon glyphicon-fast-forward"></span>
                </a>
            </li>
            <li>
                <a class="btn btn-primary btn-lg" id="random" title="Random Faucet" role="button">
                    <span class="glyphicon glyphicon-random"></span>
                </a>
            </li>
            <li>
                <a class="btn btn-primary btn-lg" id="list_of_faucets" href="/faucets" title="List of Faucets" role="button">
                    <span class="glyphicon glyphicon-list"></span>
                </a>
            </li>
        </ul>
    </nav>
</div>

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
