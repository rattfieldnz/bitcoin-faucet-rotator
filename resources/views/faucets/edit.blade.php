@extends('app')

@section('content')
    <h1 id="page-heading">Edit '{{ $faucet->name }}'</h1>

    @include('faucets/partials/_errors')

    {!! Form::model( $faucet, ['method' => 'PATCH', 'route' => ['faucets.update', $faucet->id],'class' => 'form-horizontal']); !!}
    @include('faucets/partials/_form')
    {!! Form::close() !!}
@endsection