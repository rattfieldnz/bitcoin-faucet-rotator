@extends('app')

@section('content')

    <fieldset id="adblock_config_form">
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
    @include('ad_block/partials/_errors')

    {!! Form::model( $adBlock, ['method' => 'PATCH', 'route' => ['admin.ad_block_config.update', $adBlock],'class' => 'form-horizontal']) !!}
    @include('ad_block/partials/_form')
    {!! Form::close() !!}
    </fieldset>
@endsection