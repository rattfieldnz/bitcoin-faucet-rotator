@extends('app')

@section('content')
    <fieldset>
        <legend>
            <h1 class="page-heading">Edit '{{ $faucet->name }}'</h1>
        </legend>

        @include('faucets/partials/_errors')

            {!! Form::model( $faucet, ['method' => 'PATCH', 'route' => ['faucets.update', $faucet->id],'class' => 'form-horizontal']); !!}
            @include('faucets/partials/_form')
            {!! Form::close() !!}
    </fieldset>
@endsection