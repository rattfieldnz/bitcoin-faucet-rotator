@extends('app')

@section('content')

    <fieldset id="facebook-config-fieldset">
    @include('facebook_config/partials/_config_info')

    @if (Session::has('success_message_add'))
        <div class="alert alert-success">
            <span class="fa fa-thumbs-o-up fa-2x space-right"></span>
            {{ Session::get('success_message_add') }}
        </div>
    @endif
    @if (Session::has('success_message_update'))
        <div class="alert alert-success">
            <span class="fa fa-thumbs-o-up fa-2x space-right"></span>
            {{ Session::get('success_message_update') }}
        </div>
    @endif
    @include('facebook_config/partials/_errors')

    {!! Form::model( $facebookConfig, ['method' => 'PATCH', 'route' => ['admin.facebook_config.update', $facebookConfig],'class' => 'form-horizontal']) !!}
    @include('facebook_config/partials/_form')
    {!! Form::close() !!}
    </fieldset>
@endsection