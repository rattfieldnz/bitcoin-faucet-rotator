@extends('app')

@section('content')
   <h1 class="page-heading">Edit '{{ $paymentProcessor->name }}'</h1>

    @include('payment_processors/partials/_errors')

    {!! Form::model( $paymentProcessor, ['method' => 'PATCH', 'route' => ['payment_processors.update', $paymentProcessor->id],'class' => 'form-horizontal']) !!}
    @include('payment_processors/partials/_form')
    {!! Form::close() !!}
@endsection