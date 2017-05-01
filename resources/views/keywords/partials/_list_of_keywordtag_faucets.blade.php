@if(count($keywords[$i]->faucets()->get()) > 0)
    <ul>
        @foreach($keywords[$i]->faucets()->orderBy('name')->get() as $faucet)
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