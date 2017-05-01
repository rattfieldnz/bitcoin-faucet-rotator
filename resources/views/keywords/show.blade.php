@extends('app')

@section('title', 'Tag - ' . $keyword->keyword . ' | FreeBTC.website')

@section(
    'description',
    'This page shows information about the "' . $keyword->keyword . '" tag. There are ' .
    count($keyword->faucets()->get()) . ' faucets, and ' . count($keyword->paymentProcessors()->get()) .
    ' payment processors, that use this tag.'
)

@section('content')
    <h1 class="page-heading">Tag "{{ $keyword->keyword }}"</h1>
    @if(\App\Helpers\WebsiteMeta\WebsiteMeta::disqusShortName())
        <p id="comments"><small><a href="#disqus_thread">See comments</a></small></p>
    @endif
    <p>{!! link_to('tags', '&laquo; Back to list of tags') !!}</p>
    @include('partials.ads')
    <div class="table-responsive">
        <table class="table table-striped table bordered tablesorter" id="tags-table">
            <thead>
                <th>Faucets Using This Tag</th>
                <th>Payment Processors Using This Tag</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        @if(count($keyword->faucets()->get()) > 0)
                            <ul>
                                @foreach($keyword->faucets()->orderBy('name')->get() as $faucet)
                                    <li>
                                        {!! link_to_route('faucets.show', $faucet->name, ['slug' => $faucet->slug]) !!}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <ul>
                                <li>There are no faucets for this tag.</li>
                            </ul>
                        @endif
                    </td>
                    <td>
                        @if(count($keyword->paymentProcessors()->get()) > 0)
                            <ul>
                                @foreach($keyword->paymentProcessors()->orderBy('name')->get() as $paymentProcessor)
                                    <li>
                                        {!! link_to_route('payment_processors.show', $paymentProcessor->name, ['slug' => $paymentProcessor->slug]) !!}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <ul>
                                <li>There are no payment processors for this tag.</li>
                            </ul>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <hr>
        @include('keywords.partials.disqus')
    <hr>
@endsection

@section('google_analytics')
    @include('partials.google_analytics')
@stop
