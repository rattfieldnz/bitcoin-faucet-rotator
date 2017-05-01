@extends('app')

@section('title', 'List of Bitcoin Faucets (' . count($faucets).') | FreeBTC.website')

@section('description', 'This page lists all bitcoin faucets currently on the system, with sortable columns. There are ' . count($faucets) . ' faucets listed.')

@section('keywords', 'Free Bitcoins, Bitcoin Faucets, Get Free Bitcoins, Satoshis, Free BTC Website')

@section('content')
    <h1 class="page-heading">Current Faucets</h1>
    @if(\App\Helpers\WebsiteMeta\WebsiteMeta::disqusShortName())
        <p id="comments"><small><a href="#disqus_thread">See comments</a></small></p>
    @endif
    @include('partials.ads')
    @include('faucets/partials/_session_messages')
    @if(Auth::check())
        <div class="alert alert-info">
            <p><i class="fa fa-info-circle fa-2x space-right"></i>Tags are created when creating and editing faucets.</p>
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
                <th>Tags</th>
            </thead>
            <tbody>
            @foreach($faucets as $faucet)
                <tr>
                    <td>
                        {!! link_to_route('faucets.show', $faucet->name, array($faucet->slug), ['title' => $faucet->name]) !!}
                        @if(Auth::check())
                            <br><a class="btn btn-primary btn-width-small" href="/faucets/{{ $faucet->slug}}/edit/">
                                <span class="button-font-small">Edit</span>
                            </a>
                            <br><br>
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
                            @foreach($faucet->paymentProcessors as $paymentProcessor)
                                <li>{!! link_to_route('payment_processors.show', $paymentProcessor->name, [$paymentProcessor->slug]) !!}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $faucet->hasRefProgram() }}</td>
                    <td>{{ $faucet->ref_payout_percent }}</td>
                    <td>
                        @if(count($faucet->keywords()->get()) > 0)
                            <ul>
                                @foreach($faucet->keywords()->orderBy('keyword')->get() as $tag)
                                    <li>
                                        {!! link_to_route('tags.show', $tag->keyword, ['slug' => $tag->slug]) !!}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <ul>
                                <li>There are no tags for this faucet.</li>
                            </ul>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @if(\App\Helpers\WebsiteMeta\WebsiteMeta::disqusShortName())
        <div id="disqus_thread"></div>
        <script type="text/javascript">
            var disqus_shortname = '{{ \App\Helpers\WebsiteMeta\WebsiteMeta::disqusShortName() }}';
            var disqus_identifier = 'list-of-faucets';

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
    @endif
    <br><br>

@endsection

@section('google_analytics')
    @include('partials.google_analytics')
@stop
