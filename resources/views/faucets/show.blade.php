@extends('app')

@section('content')
    <h1 class="page-heading">{{ $faucet->name }}</h1>
    @if (Auth::user())
        <script>
            window.csrfToken = '<?php echo csrf_token(); ?>';
        </script>
        <p>
            <a class="btn btn-primary btn-width" href="/faucets/{{ $faucet->id}}/edit/">
                <span class="fa fa-edit fa-1x space-right"></span><span class="button-font-size">Edit this faucet</span>
            </a>
            <a class="btn btn-primary btn-width" id="confirm" data-toggle="modal" href="#" data-target="#delFaucet" data-id="{{ $faucet->id }}">
                <span class="fa fa-trash fa-1x space-right"></span>
                <span class="button-font-size">Delete this faucet</span>
            </a>
        </p>

        <!-- Modal -->
        <div class="modal fade" id="delFaucet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">
                            <span class="fa fa-warning fa-3x"></span>
                            <span id="id"></span>
                            <span style="padding-left: 2em;">
                                ARE YOU SURE you want to delete {!! link_to($faucet->url, $faucet->name, ['target' => '_blank']) !!} ?
                            </span>
                        </h4>
                    </div>
                    <div class="modal-body">
                        If you delete this faucet, it will be permanently removed from the system!
                    </div>
                    <div class="modal-footer">
                        <div id="delmodelcontainer" style="float:right">

                            <div id="yes" style="float:left; padding-right:10px">
                                {!! Form::open(array('action' => array('FaucetsController@destroy', $faucet->id), 'method' => 'DELETE')) !!}

                                {!! Form::submit('Yes', array('class' => 'btn btn-primary')) !!}

                                {!! Form::close() !!}
                            </div> <!-- end yes -->

                            <div id="no" style="float:left;">
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </div><!-- end no -->

                        </div> <!-- end delmodelcontainer -->

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endif
    <p>{!! link_to('faucets', '&laquo; Back to list of faucets') !!}</p>
    <p>{!! link_to('payment_processors', '&laquo; Back to list of payment processors') !!}</p>
    @if (Session::has('success_message'))
        <div class="alert alert-success">
            <span class="fa fa-thumbs-o-up fa-2x space-right"></span>
            {{ Session::get('success_message') }}
        </div>
    @endif

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
                    <td>{{ $faucet->min_payout }}</td>
                    <td>{{ $faucet->max_payout }}</td>
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

    @if($faucet->is_paused == false)
        <iframe sandbox="allow-forms allow-scripts allow-pointer-lock allow-same-origin" src="{{ $faucet->url }}" id="faucet-iframe"></iframe>
    @else
        <p>This faucet has been paused from showing in rotation.</p>

        @if(Auth::user())
            <p>You can {!! link_to('/faucets/' . $faucet->id . '/edit', 'edit this faucet') !!} to re-enable it in rotation.</p>
        @else
            <p>Please contact the administrator if you would like this faucet re-enabled.</p>
        @endif
    @endif

@endsection