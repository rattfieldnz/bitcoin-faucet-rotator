@extends('app')

@section('content')

    @include('twitter_config/partials/_config_info')

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
    @include('twitter_config/partials/_errors')

    {!! Form::model( $twitterConfig, ['method' => 'PATCH', 'route' => ['admin.twitter_config.update', $twitterConfig],'class' => 'form-horizontal']) !!}
    @include('twitter_config/partials/_form')
    {!! Form::close() !!}
@endsection