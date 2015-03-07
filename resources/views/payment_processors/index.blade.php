@extends('app')

@section('content')
    <h1 class="page-heading">Current Payment Processors</h1>

    <div class="table-responsive">

        {!! $payment_processors->render() !!}
        <table class="table table-striped bordered tablesorter" id="payment_processors_table">
            <thead>
            <th>Payment Processor Name</th>
            </thead>
            <tbody>
            @foreach($payment_processors as $payment_processor)
                <tr>
                    <td>{!! link_to_route('payment_processors.show', $payment_processor->name, array($payment_processor->id)) !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $payment_processors->render() !!}
    </div>
    <script src="/js/accordion.js"></script>
    <script src="/js/jquery.tablesorter.min.js"></script>
    <script src="/js/tablesorter_custom_code.js"></script>
@endsection