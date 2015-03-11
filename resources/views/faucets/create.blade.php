@extends('app')

@section('content')
    <fieldset>
        <legend>
            <h1 class="page-heading">Create a new faucet</h1>
        </legend>
            {!! Html::ul($errors->all()) !!}
            {!! Form::open(['route' => 'faucets.store','class' => 'form-horizontal']) !!}
            @include('faucets/partials/_form')
            {!! Form::close() !!}
    </fieldset>
@endsection