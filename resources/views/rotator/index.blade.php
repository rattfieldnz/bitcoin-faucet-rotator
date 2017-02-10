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
@include('partials.rotator_nav')

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
