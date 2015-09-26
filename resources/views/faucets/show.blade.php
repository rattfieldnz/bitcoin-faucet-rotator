@extends('app')

@section('title', $faucet->meta_title)

@section('description', $faucet->meta_description)

@section('keywords', $faucet->meta_keywords)

@section('content')
    <h1 class="page-heading">{{ $faucet->name }}</h1>
    <p><small><a href="#disqus_thread">See comments</a></small></p>
    @if (Auth::user())

        <script>
            window.csrfToken = '<?php echo csrf_token(); ?>';
        </script>
        <p>
            <a class="btn btn-primary btn-width" href="/faucets/{{ $faucet->slug}}/edit/">
                <span class="fa fa-edit fa-1x space-right"></span><span class="button-font-size">Edit</span>
            </a>
            <a class="btn btn-primary btn-width" id="confirm" data-toggle="modal" href="#" data-target="#delFaucet{{ $faucet->slug}}" data-id="{{ $faucet->slug }}">
                <span class="fa fa-trash fa-1x space-right"></span>
                <span class="button-font-size">Delete</span>
            </a>
        </p>

        @if(Auth::check())
            @include('faucets/partials/_modal_delete_faucet')
        @endif
    @endif
    <p>{!! link_to('faucets', '&laquo; Back to list of faucets') !!}</p>
    @if (Session::has('success_message'))
        <div class="alert alert-success">
            <span class="fa fa-thumbs-o-up fa-2x space-right"></span>
            {{ Session::get('success_message') }}
        </div>
    @endif
    @if (Session::has('success_message_update_faucet_low_balance_status'))
        <div class="alert alert-success">
            <span class="fa fa-thumbs-o-up fa-2x space-right"></span>
            {{ Session::get('success_message_update_faucet_low_balance_status') }}
        </div>
    @endif
    @include('partials.ads')
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
                <th>Low Balance <br><small>(less than 10,000 SAT)</small></th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {!! link_to($faucet->url, $faucet->name, ['target' => 'blank', 'title' => $faucet->name]) !!}
                    </td>
                    <td>{{ $faucet->interval_minutes }}</td>
                    <td>{{ $faucet->min_payout }}</td>
                    <td>{{ $faucet->max_payout }}</td>
                    <td>
                        @if(count($faucet->payment_processors) == 0)
                            None. Please add one (or more) for this faucet
                        @else
                            <ul class="faucet-payment-processors">
                            @foreach($faucet->payment_processors as $payment_processor)
                                <li>{!! link_to('payment_processors/' . $payment_processor->slug, $payment_processor->name, ['target' => 'blank', 'title' => $payment_processor->name]) !!}</li>
                            @endforeach
                            </ul>
                        @endif
                    </td>
                    <td>{{ $faucet->hasRefProgram() }}</td>
                    <td>{{ $faucet->ref_payout_percent }}</td>
                    <td>{{ $faucet->comments }}</td>
                    <td>{{ $faucet->status() }}</td>
                    <td>{{ $faucet->lowBalanceStatus() }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @if($faucet->is_paused == false)
        <iframe sandbox="allow-forms allow-scripts allow-pointer-lock allow-same-origin" src="{{ $faucet->url }}" id="faucet-iframe"></iframe>
    @else
        <p>This faucet has been paused from showing in rotation.</p>

        @if(Auth::user())
            <p>You can {!! link_to('/faucets/' . $faucet->slug . '/edit', 'edit this faucet') !!} to re-enable it in rotation.</p>
        @else
            <p>Please contact the administrator if you would like this faucet re-enabled.</p>
        @endif
    @endif

    <hr>
        @include('faucets.partials.disqus')
    <hr>
@endsection

@section('google_analytics')
    @include('partials.google_analytics')
@stop