@extends('app')

@section('title', 'List of Bitcoin Faucets (' . count($faucets).') | FreeBTC.website')

@section('description', 'This page lists all bitcoin faucets currently on the system, with sortable columns. There are ' . count($faucets) . ' faucets listed.')

@section('keywords', 'Free Bitcoins, Bitcoin Faucets, Get Free Bitcoins, Satoshis, Free BTC Website')

@section('content')
    <h1 id="page-heading">Current Faucets</h1>
    @if (Session::has('success_message_delete'))
        <div class="alert alert-success">
            <span class="fa fa-thumbs-o-up fa-2x space-right"></span>
            {{ Session::get('success_message_delete') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped bordered tablesorter" id="faucets_table">
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
                    <td>
                        {!! link_to_route('faucets.show', $faucet->name, array($faucet->slug)) !!}
                        @if(Auth::check())
                            <br><a class="btn btn-primary btn-width-small" href="/faucets/{{ $faucet->slug}}/edit/">
                                <span class="button-font-small">Edit</span>
                            </a>

                            <a class="btn btn-primary btn-width-small" id="confirm" data-toggle="modal" href="#" data-target="#delFaucet{{ $faucet->slug}}" data-id="{{ $faucet->slug }}">
                                <span class="button-font-small">Delete</span>
                            </a>
                            <?php $slug = $faucet->slug ?>
                            @include('faucets/partials/_modal_delete_faucet')
                        @endif

                    </td>
                    <td>{{ $faucet->interval_minutes }}</td>
                    <td>{{ $faucet->min_payout }}</td>
                    <td>{{ $faucet->max_payout }}</td>
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
    </div>

    @if(Auth::check())

    @endif

    <script src="/js/jquery.tablesorter.min.js"></script>
    <script src="/js/tablesorter_custom_code.js"></script>
@endsection

@section('google_analytics')
    @include('partials.google_analytics')
@stop