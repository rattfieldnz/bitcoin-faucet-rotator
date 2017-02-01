@if((new \Helpers\Functions\Ads())->get() != null)
<div id="ads row">
    {!! (new \Helpers\Functions\Ads())->get() !!}
</div>
@endif