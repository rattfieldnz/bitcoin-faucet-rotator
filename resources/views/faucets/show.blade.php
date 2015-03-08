@extends('app')

@section('content')
    <h1 class="page-heading">{{ $faucet->name }}</h1>
    @if (Auth::user())
        <p>{!! link_to_route('faucets.edit', 'Edit this faucet', $faucet->id) !!}</p><br>
    @endif
    <p>{!! link_to('faucets', '&laquo; Back to list of faucets') !!}</p>
    <p>{!! link_to('payment_processors', '&laquo; Back to list of payment processors') !!}</p>

    <div class="table-responsive">
        <table class="table table-striped table bordered">
            <thead>
                <th>Faucet URL</th>
                <th>Interval (minutes)</th>
                <th>Minimum Payout (satoshis)</th>
                <th>Maximum Payout (satoshis)</th>
                <th>Payment Processor/s</th>
                <th>Referral Program?</th>
                <th>Ref. Payout %</th>
                <th>Comments</th>
                <th>Status</th>
            </thead>
            <tbody>
                <tr>
                    <td>{!! link_to($faucet->url, $faucet->name, ['target' => 'blank']) !!}</td>
                    <td>{{ $faucet->interval_minutes }}</td>
                    <td>{{ number_format($faucet->min_payout) }}</td>
                    <td>{{ number_format($faucet->max_payout) }}</td>
                    <td>
                        <ul class="faucet-payment-processors">
                        @foreach($faucet->payment_processors as $payment_processor)
                            <li>{!! link_to($payment_processor->url, $payment_processor->name, ['target' => 'blank']) !!}</li>
                        @endforeach
                        </ul>
                    </td>
                    <td>{{ $faucet->hasRefProgram() }}</td>
                    <td>{{ $faucet->ref_payout_percent }}</td>
                    <td>{{ $faucet->comments }}</td>
                    <td>{{ $faucet->status() }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <iframe sandbox="allow-forms allow-scripts allow-pointer-lock allow-same-origin" src="{{ $faucet->url }}" id="faucet-iframe"></iframe>

@endsection