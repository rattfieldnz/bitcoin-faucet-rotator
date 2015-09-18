@extends('app')

@section('content')
    <fieldset>

        @include('ad_block/partials/_errors')

        {!! Form::open(['route' => 'admin.ad_block_config.store','class' => 'form-horizontal']) !!}
            @include('ad_block/partials/_form')
        {!! Form::close() !!}
    </fieldset>
@endsection