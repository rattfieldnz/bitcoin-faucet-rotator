@extends('app')

@section('content')
    <h1 class="page-heading">Create New Tags</h1>

    @include('keywords/partials/_errors')

    {!! Form::open(['route' => 'keywords.store','class' => 'form-horizontal']) !!}
        @include('keywords/partials/_form')
    {!! Form::close() !!}
@endsection