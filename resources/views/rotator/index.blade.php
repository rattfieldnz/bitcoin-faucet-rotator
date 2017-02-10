@extends('app')

@if($mainMeta)
@section('title', $mainMeta->title)

@section('description', $mainMeta->description)

@section('keywords', $mainMeta->keywords)
@endif

@section('content')

    @if($mainMeta)
<h1 class="page-heading">{{ $mainMeta->page_main_title }}</h1>
@endif
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


<div class="row" id="main_page_content">
    <div class="col-lg-12">
        @if($mainMeta)
         {!! $mainMeta->page_main_content !!}
            @endif
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
