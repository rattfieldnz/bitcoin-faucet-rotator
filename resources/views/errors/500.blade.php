@extends('app')

@section('content')
    <h1 class="page-heading">Oops!</h1>

    <p><img class="img-responsive" src="/images/500.png" width="375" height="360" alt="500 Error - Internal Server Error"></p>

    <p>Seems like the server is experiencing some technical issues. please  {!! Html::mailto('admin@freebtc.website', 'contact the site administrator') !!}. The error/s have been logged.</p><br>

    <hr>

    <p><strong>Were you looking for a faucet?</strong> If so, navigate to the {!! link_to_route('faucets.index', 'faucets') !!} section of our site.</p>

    <p><strong>Were you looking for a faucet payment processor?</strong> If so, navigate to the {!! link_to_route('payment_processors.index', 'payment processors') !!} section of our site.</p>

    <p><strong>Looking for something else?</strong> If so, please  {!! Html::mailto('admin@freebtc.website', 'contact the site administrator') !!}.</p>

@endsection