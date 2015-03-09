@extends('app')

@section('content')
    {{ $submit_button_text = "Submit Faucet" }}
    <fieldset>
        <legend>
            <h1 class="page-heading">Create a new faucet</h1>
        </legend>
            {!! Form::open(['route' => 'faucets.store','class' => 'form-horizontal']) !!}
            @include('faucets/partials/_form')
            {!! Form::close() !!}
    </fieldset>
@endsection