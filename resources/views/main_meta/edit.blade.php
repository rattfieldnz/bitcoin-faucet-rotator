@extends('app')

@section('content')

    <h1 class="page-heading">Manage Main Meta</h1>
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
    @include('main_meta/partials/_errors')

    {!! Form::model( $main_meta, ['method' => 'PATCH', 'route' => ['main_meta.update', $main_meta],'class' => 'form-horizontal']) !!}
    @include('main_meta/partials/_form')
    {!! Form::close() !!}
@endsection