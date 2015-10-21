@extends('app')

@section('content')
    <h1 class="page-heading">Create a new payment processor</h1>

    @include('payment_processors/partials/_errors')

    {!! Form::open(['route' => 'payment_processors.store','class' => 'form-horizontal']) !!}
    @include('payment_processors/partials/_form')
    {!! Form::close() !!}
@endsection