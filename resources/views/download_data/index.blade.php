@extends('app')

@section('content')
    <h1 class="page-heading">Download Faucet Rotator Data</h1>
    <p>Here you can download the following data from this faucet rotator:</p>

    <ul>
        <li>Faucets</li>
        <li>Payment Processors</li>
        <li>Table linking both of the above</li>
        <li>Ad Block</li>
        <li>Main Meta</li>
    </ul>

<div class="form-horizontal">
    <div class="form-group">
        <div class="col-lg-4">
            <p><a href="{{ URL::route('data/download/faucets') }}" class="btn btn-lg btn-primary pull-left">Download Faucets Data</a></p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-4">
            <p><a href="{{ URL::route('data/download/payment_processors') }}" class="btn btn-lg btn-primary pull-left">Download Payment Processors Data</a></p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-4">
            <p><a href="{{ URL::route('data/download/faucets_payment_processors') }}" class="btn btn-lg btn-primary pull-left">Download Faucets/Payment Processors Linking Data</a></p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-4">
            <p><a href="{{ URL::route('data/download/ad_block') }}" class="btn btn-lg btn-primary pull-left">Download Ad Block Data</a></p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-4">
            <p><a href="{{ URL::route('data/download/main_meta') }}" class="btn btn-lg btn-primary pull-left">Download Main Meta Data</a></p>
        </div>
    </div>
</div>

@endsection