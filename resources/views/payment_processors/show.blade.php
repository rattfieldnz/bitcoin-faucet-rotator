@extends('app')

@section('title', $paymentProcessor->meta_title)

@section('description', $paymentProcessor->meta_description)

@section('keywords', $paymentProcessor->meta_keywords)

@section('content')
    <h1 class="page-heading">{{ $paymentProcessor->name }}</h1>
    <p id="comments"><small><a href="#disqus_thread">See comments</a></small></p>

    @if (Auth::user())
        <script>
            window.csrfToken = '<?php echo csrf_token(); ?>';
        </script>
        <p>
            <a class="btn btn-primary btn-width" href="/payment_processors/{{ $paymentProcessor->slug}}/edit/">
                <span class="fa fa-edit fa-1x space-right"></span><span class="button-font-size">Edit</span>
            </a>
            <a class="btn btn-primary btn-width" id="confirm" data-toggle="modal" href="#" data-target="#delPaymentProcessor" data-id="{{ $paymentProcessor->slug }}">
                <span class="fa fa-trash fa-1x space-right"></span>
                <span class="button-font-size">Delete</span>
            </a>
        </p>

        <!-- Modal -->
        <div class="modal fade" id="delPaymentProcessor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">
                            <span class="fa fa-warning fa-3x"></span>
                            <span id="id"></span>
                            <span style="padding-left: 2em;">
                                ARE YOU SURE you want to delete {!! link_to($paymentProcessor->url, $paymentProcessor->name, ['target' => '_blank']) !!} ?
                            </span>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <p>If you delete this payment processor, it will be permanently removed from the system!</p>
                        <p>Any faucets that only has this payment processor will need a new one (or more).</p>
                    </div>
                    <div class="modal-footer">
                        <div id="delmodelcontainer" style="float:right">

                            <div id="yes" style="float:left; padding-right:10px">
                                {!! Form::open(array('action' => array('PaymentProcessorsController@destroy', $paymentProcessor->slug), 'method' => 'DELETE')) !!}

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

    <p>{!! link_to('payment_processors', '&laquo; Back to list of payment processors') !!}</p>

    @if (Session::has('success_message'))
        <div class="alert alert-success">
            <span class="fa fa-thumbs-o-up fa-2x space-right"></span>
            {{ Session::get('success_message') }}
        </div>
    @endif
    @include('partials.ads')
    <div class="table-responsive">
        <table class="table table-striped table bordered">
            <thead>
            <th>Payment Processor</th>
            <th>Associated Faucets</th>
            <th>Rotator</th>
            </thead>
            <tbody>
            <tr>
                <td>{!! link_to($paymentProcessor->url, $paymentProcessor->name, ['target' => 'blank', 'title' => $paymentProcessor->name]) !!}</td>
                <td>
                    <ul class="faucet-payment-processors">
                        @foreach($paymentProcessor->faucets as $faucet)
                            <li>{!! link_to_route('faucets.show', $faucet->name, array($faucet->slug), ['title' => $faucet->name]) !!}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a class="btn btn-primary btn-lg" id="rotator" href="/payment_processors/{{ $paymentProcessor->slug }}/rotator" title="View the faucet rotator for '{{ $paymentProcessor->name }}' faucets." role="button">Go to Rotator</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <hr>
        @include('payment_processors.partials.disqus')
    <hr>

    <script src="/js/accordion.js"></script>
@endsection

@section('google_analytics')
    @include('partials.google_analytics')
@stop