@extends('app')

@section('content')
    <h1 class="page-heading">Current Faucets</h1>

    <table class="table table-striped table bordered">
        <thead>
        <th>ID</th>
        <th>Faucet Name</th>
        <th>Interval (minutes)</th>
        <th>Minimum Payout (satoshis)</th>
        <th>Maximum Payout (satoshis)</th>
        <th>Referral Program?</th>
        <th>Ref. Payout %</th>
        <th>Comments</th>
        <th>Status</th>
        </thead>
        <tbody>
        @foreach($faucets as $faucet)
            <tr>
                <td>{{ $faucet->id }}</td>
                <td><a href='{{ $faucet->url }}' target='_blank' title='{{ $faucet->name }}'>{{ $faucet->name }}</a></td>
                <td>{{ $faucet->interval_minutes }}</td>
                <td>{{ $faucet->min_payout }}</td>
                <td>{{ $faucet->max_payout }}</td>
                <td>{{ $faucet->hasRefProgram() }}</td>
                <td>{{ $faucet->ref_payout_percent }}</td>
                <td>{{ $faucet->comments }}</td>
                <td>{{ $faucet->status() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection