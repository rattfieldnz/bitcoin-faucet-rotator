@extends('app')

@section('title', 'List of Payment Processors ('. count($payment_processors) . ') | FreeBTC.website')

@section('description', "This page lists all bitcoin faucets' payment processors currently on the system, with sortable columns. There are " . count($faucets) . " processors listed.")

@section('keywords', 'Free Bitcoins, Bitcoin Faucets, Xapo, MicroWallet, BlockChain, Paytoshi, FaucetBox')

@section('content')
    <h1 id="page-heading">Current Payment Processors</h1>

    @if (Session::has('success_message_delete'))
        <div class="alert alert-success">
            <span class="fa fa-thumbs-o-up fa-2x space-right"></span>
            {{ Session::get('success_message_delete') }}
        </div>
    @endif

    @if (Session::has('success_message_alert'))
        <div class="alert alert-info">-
            <span class="fa fa-warning fa-2x space-right"></span>
            {{ Session::get('success_message_alert') }}
        </div>
    @endif
    @include('partials.ads')
    <div class="table-responsive">

        <table class="table table-striped bordered tablesorter" id="payment_processors_table">
            <thead>
            <th>Payment Processor Name</th>
            </thead>
            <tbody>
            @foreach($payment_processors as $payment_processor)
                <tr>
                    <td>{!! link_to_route('payment_processors.show', $payment_processor->name, array($payment_processor->slug)) !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <script src="/js/accordion.js"></script>
    <script src="/js/jquery.tablesorter.min.js"></script>
    <script src="/js/tablesorter_custom_code.js"></script>
@endsection

@section('google_analytics')
    @include('partials.google_analytics')
@stop