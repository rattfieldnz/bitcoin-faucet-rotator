@extends('app')

@section('content')
        <h1 class="page-heading">Admin Account Details</h1>
        <br>
        @if(Auth::user() != null)
            @if(Auth::user()->is_admin == true)
                <h1 class="pull-right">
                    <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.edit') !!}">Edit Details</a>
                </h1>
                <div class="clearfix"></div>
            @endif
        @endif
        @include('admin/partials/_session_messages')
        <div class="table-responsive">
            <table class="table bordered admin-details">
                <tr>
                    <th>User Name</th>
                    <td>{{ $user->user_name }}</td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td>{{ $user->first_name }}</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>{{ $user->last_name }}</td>
                </tr>
                <tr>
                    <th>Email Address</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>*** Hidden ***</td>
                </tr>
                <tr>
                    <th>Bitcoin Address</th>
                    <td>{{ $user->bitcoin_address }}</td>
                </tr>
            </table>
        </div>
@endsection