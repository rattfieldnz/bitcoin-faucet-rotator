@extends('app')

@section('content')
    <h1 class="page-heading">Current Faucets</h1>
    {!! $faucets->render() !!}
    <div class="table-responsive">
        <table class="table table-striped table bordered">
            <thead>
                <th>Faucet Name</th>
                <th>Interval (minutes)</th>
                <th>Minimum Payout (satoshis)</th>
                <th>Maximum Payout (satoshis)</th>
                <th>Payment Processor/s</th>
                <th>Referral Program?</th>
                <th>Ref. Payout %</th>
                <th>Status</th>
            </thead>
            <tbody>
            @foreach($faucets as $faucet)
                <tr>
                    <td>{!! link_to_route('faucets.show', $faucet->name, array($faucet->id)) !!}</td>
                    <td>{{ $faucet->interval_minutes }}</td>
                    <td>{{ number_format($faucet->min_payout) }}</td>
                    <td>{{ number_format($faucet->max_payout) }}</td>
                    <td>
                        <ul class="faucet-payment-processors">
                            @foreach($faucet->payment_processors as $payment_processor)
                                <li>{!! link_to_route('payment_processors.show', $payment_processor->name, array($payment_processor->id)) !!}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $faucet->hasRefProgram() }}</td>
                    <td>{{ $faucet->ref_payout_percent }}</td>
                    <td>{{ $faucet->status() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $faucets->render() !!}
    </div>
@endsection