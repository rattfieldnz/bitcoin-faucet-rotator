@extends('app')

@section('content')
    <h1 class="page-heading">Edit Admin Details</h1>
    <br>
    @if(Auth::user() != null)
        @if(Auth::user()->is_admin == true)
            <h1 class="pull-right">
                <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin') !!}">Back to Admin Profile</a>
            </h1>
            <div class="clearfix"></div>
        @endif
    @endif
    @include('faucets/partials/_errors')

    {!! Form::model( $user, ['method' => 'PATCH', 'route' => ['admin.update', $user->id],'class' => 'form-horizontal']) !!}
    @include('admin/partials/_form')
    {!! Form::close() !!}
@endsection