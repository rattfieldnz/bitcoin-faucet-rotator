@extends('app')

@section('content')
    <h1 class="page-heading">Current Users</h1>

    <div class="table-responsive">
        <table class="table table-striped bordered tablesorter" id="users_table">
            <thead>
            <th>User Name</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>Password</th>
            <th>Bitcoin Address</th>
            <th>User's Faucets</th>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{!! link_to_route('users.show', $user->user_name, array($user->id)) !!}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>*** Hidden ***</td>
                    <td>{{ $user->bitcoin_address }}</td>
                    <td>
                        <div class="accordion">
                            <h3>See Faucets</h3>
                            <div>
                                <ul class="user-faucets">
                                    @foreach($user->faucets as $faucet)
                                        <li>{!! link_to_route('faucets.show', $faucet->name, array($faucet->id)) !!}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script src="/js/jquery.tablesorter.min.js"></script>
    <script src="/js/tablesorter_custom_code.js"></script>
    <script src="/js/accordion.js"></script>
@endsection