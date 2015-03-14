@extends('app')

@section('content')
    <h1 class="page-heading">{{ $payment_processor->name }}</h1>
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
            <th>Payment Processor</th>
            <th>Associated Faucets</th>
            </thead>
            <tbody>
            <tr>
                <td>{!! link_to($payment_processor->url, $payment_processor->name, ['target' => 'blank']) !!}</td>
                <td>

                    <div class="accordion">
                        <h3>See Faucets</h3>
                        <div>
                            <ul class="faucet-payment-processors">
                                @foreach($payment_processor->faucets as $faucet)
                                    <li>{!! link_to_route('faucets.show', $faucet->name, array($faucet->id)) !!}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <script src="/js/accordion.js"></script>
@endsection