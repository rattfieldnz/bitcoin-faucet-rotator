@extends('app')

@section('content')
        <h1 class="page-heading">Admin Account Details</h1>
        <br>
        @if (Session::has('success_message_edit'))
            <div class="alert alert-success">
                <span class="fa fa-thumbs-o-up fa-2x space-right"></span>
                {{ Session::get('success_message_edit') }}
            </div>
        @endif
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