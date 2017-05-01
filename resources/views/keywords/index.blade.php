@extends('app')

@section('title', 'List of Current Tags (' . count($keywords).') | FreeBTC.website')

@section('description', 'This page lists all tags used by faucets and payment processors. There are ' . count($keywords) . ' tags listed.')

@section('content')
    <h1 class="page-heading">Current Tags</h1>
    @if(\App\Helpers\WebsiteMeta\WebsiteMeta::disqusShortName())
        <p id="comments"><small><a href="#disqus_thread">See comments</a></small></p>
    @endif
    @include('partials.ads')
    @if(Auth::check())
        <div class="alert alert-info">
            <p><i class="fa fa-info-circle fa-2x space-right"></i>Tags are created when creating and editing faucets and payment processors.</p>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped bordered tablesorter" id="tags-table">
            <thead>
            <th>Tag Name</th>
            <th>Faucets Using Tag</th>
            <th>Payment Processors Using Tag</th>
            </thead>
            <tbody>
            @for($i = 0; $i < count($keywords); $i++)
                @if($i % 15 == 0 && $i != 0)
                    <tr>
                        <td colspan="4">{!! (new \Helpers\Functions\Ads())->get() !!}</td>
                    </tr>
                @else

                <tr>
                    <td>{!! link_to_route('tags.show', $keywords[$i]->keyword, [$keywords[$i]->slug]) !!}</td>
                    <td>
                        @include('keywords.partials._list_of_keywordtag_faucets')
                    </td>
                    <td>
                        @include('keywords.partials._list_of_keywordtag_payment_processors')
                    </td>
                </tr>
                @endif
            @endfor
            </tbody>
        </table>
    </div>

    @if(\App\Helpers\WebsiteMeta\WebsiteMeta::disqusShortName())
        <div id="disqus_thread"></div>
        @include('keywords.partials.disqus')
    @endif
    <br><br>

@endsection

@section('google_analytics')
    @include('partials.google_analytics')
@stop
