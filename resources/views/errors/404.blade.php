@extends('app')

@section('content')
    <h1 class="page-heading">Oops!</h1>

    <p><img class="img-responsive" src="/images/404.jpg" width="477" height="297"></p>

    <p>Seems like the page you're after has disappeared, or never existed in the first place.</p><br>

    <p><strong>Were you looking for a faucet?</strong> If so, navigate to the {!! link_to_route('faucets.index', 'faucets') !!} section of our site.</p>

    <p><strong>Were you looking for a faucet payment processor?</strong> If so, navigate to the {!! link_to_route('payment_processors', 'payment processors') !!}.</p>

    <p><strong>Looking for something else?</strong> If so, please  {!! Html::mailto('admin@freebtc.website', 'contact the site administrator') !!}.</p>

@endsection
