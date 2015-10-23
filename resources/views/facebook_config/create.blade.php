@extends('app')

@section('content')
    <fieldset id="facebook-config-fieldset">
        @include('facebook_config/partials/_config_info')

        @include('facebook_config/partials/_errors')

        {!! Form::open(['route' => 'admin.facebook_config.store','class' => 'form-horizontal']) !!}
            @include('facebook_config/partials/_form')
        {!! Form::close() !!}
    </fieldset>
@endsection