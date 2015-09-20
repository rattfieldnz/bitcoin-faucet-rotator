@extends('app')

@section('title', 'List of Payment Processors ('. count($payment_processors) . ') | FreeBTC.website')

@section('description', "This page lists all bitcoin faucets' payment processors currently on the system, with sortable columns. There are " . count($payment_processors) . " processors listed.")

@section('keywords', 'Free Bitcoins, Bitcoin Faucets, Xapo, MicroWallet, BlockChain, Paytoshi, FaucetBox')

@section('content')
    <h1 id="page-heading">Current Payment Processors</h1>
    <p id="comments"><small><a href="#disqus_thread">See comments</a></small></p>

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
            <th>Associated Faucet Rotator</th>
            </thead>
            <tbody>
            @foreach($payment_processors as $payment_processor)
                <tr>
                    <td>{!! link_to_route('payment_processors.show', $payment_processor->name, array($payment_processor->slug), ['title' => $payment_processor->name]) !!}</td>
                    <td><a class="btn btn-primary btn-lg" href="{!! URL::to('/payment_processors/' . $payment_processor->slug . '/rotator/') !!}" title="Surf {{ $payment_processor->name }} Faucets" role="button">Surf {{ $payment_processor->name }} Faucets</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    <div id="disqus_thread"></div>
    <script type="text/javascript">
        var disqus_shortname = 'freebtcwebsite';
        var disqus_identifier = 'list-of-payment-processors';

        (function() {
            var dsq = document.createElement('script');
            dsq.type = 'text/javascript';
            dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] ||
            document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>
        Please enable JavaScript to view the
        <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a>
    </noscript>
    <a href="http://disqus.com" class="dsq-brlink">
        comments powered by <span class="logo-disqus">Disqus</span>
    </a>
    <script src="/js/accordion.js"></script>
    <script src="/js/jquery.tablesorter.min.js"></script>
    <script src="/js/tablesorter_custom_code.js"></script>
@endsection

@section('google_analytics')
    @include('partials.google_analytics')
@stop