@if(count($keywords[$i]->paymentProcessors()->get()) > 0)
    <ul>
        @foreach($keywords[$i]->paymentProcessors()->orderBy('name')->get() as $paymentProcessor)
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