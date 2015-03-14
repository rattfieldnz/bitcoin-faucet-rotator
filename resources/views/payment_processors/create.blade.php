@extends('app')

@section('content')
    <fieldset>
        <legend>
            <h1 class="page-heading">Create a new payment processor</h1>
        </legend>

        @include('payment_processors/partials/_errors')

        {!! Form::open(['route' => 'payment_processors.store','class' => 'form-horizontal']) !!}
        @include('payment_processors/partials/_form')
        {!! Form::close() !!}
    </fieldset>
@endsection