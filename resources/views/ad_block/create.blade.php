@extends('app')

@section('content')
    <fieldset id="adblock_config_form">

        @include('ad_block/partials/_errors')

        {!! Form::open(['route' => 'ad_block_config.store','class' => 'form-horizontal']) !!}
            @include('ad_block/partials/_form')
        {!! Form::close() !!}
    </fieldset>
@endsection