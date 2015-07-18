@extends('app')

@section('content')
    <fieldset>
        <legend>
            <h1 class="page-heading">Manage Main Meta</h1>
        </legend>

        @include('main_meta/partials/_errors')

            {!! Form::model( $main_meta, ['method' => 'PATCH', 'route' => ['main_meta.update', $main_meta->id],'class' => 'form-horizontal']) !!}
            @include('main_meta/partials/_form')
            {!! Form::close() !!}
    </fieldset>
@endsection