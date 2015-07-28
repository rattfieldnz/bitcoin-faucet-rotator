@extends('app')

@section('content')
   <h1 id="page-heading">Edit '{{ $payment_processor->name }}'</h1>

    @include('payment_processors/partials/_errors')

    {!! Form::model( $payment_processor, ['method' => 'PATCH', 'route' => ['payment_processors.update', $payment_processor->id],'class' => 'form-horizontal']); !!}
    @include('payment_processors/partials/_form')
    {!! Form::close() !!}
@endsection