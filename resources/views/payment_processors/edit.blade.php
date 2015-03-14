@extends('app')

@section('content')
    <fieldset>
        <legend>
            <h1 class="page-heading">Edit '{{ $payment_processor->name }}'</h1>
        </legend>

        @include('payment_processors/partials/_errors')

        {!! Form::model( $payment_processor, ['method' => 'PATCH', 'route' => ['payment_processors.update', $payment_processor->id],'class' => 'form-horizontal']); !!}
        @include('payment_processors/partials/_form')
        {!! Form::close() !!}
    </fieldset>
@endsection