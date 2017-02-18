@extends('app')

@section('content')
    <fieldset id="twitter-config-fieldset">
        @include('twitter_config/partials/_config_info')

        @include('twitter_config/partials/_errors')

        {!! Form::open(['route' => 'twitter_config.store','class' => 'form-horizontal']) !!}
            @include('twitter_config/partials/_form')
        {!! Form::close() !!}
    </fieldset>
@endsection