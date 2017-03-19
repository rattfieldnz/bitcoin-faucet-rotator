<h1 class="page-heading">Manage Ad block Configuration</h1>

<p>Due to bitcoin faucets already having copious amounts of ads, this is the only ad block configurable on this site. This ad block appears in the following locations:</p>

<ul>
    <li>Main faucet rotator page</li>
    <li>Individual faucet rotator pages for each payment processor</li>
    <li>Individual faucets</li>
    <li>Individual payment processors</li>
</ul>
{!! Form::hidden('user_id', Auth::user()->id) !!}
<div class="form-group">
    <h2>{!! Form::label('ad_content', 'Ad Block Content:', ['class' => 'control-label', 'style' => 'margin-left:0.5em;']) !!}</h2>
    <div class="col-lg-12">
        {!! Form::textarea('ad_content', null, ['class' => 'form-control']) !!}
        <p>Only the following iframe sources are supported at this time:</p>
        <ul>
            <li>mellowads.com</li>
            <li>coinurl.com</li>
            <li>a-ads.com</li>
            <li>ad.a-ads.com</li>
            <li>bee-ads.com</li>
        </ul>
        <p>Need more to be supported? <a href="mailto:emailme@robertattfield.com?Subject=RE:%20Bitcoin%20Faucet%20Rotator%20Script%20(rattfieldnz/bitcoin-faucet-rotator)%20%E2%80%93%20I%20need%20more%20iframe%20and%20ad%20sources%20to%20be%20supported">Contact support</a> to request your desired URL's.</p>

    </div>
</div>

<div class="form-group">
    <div class="col-lg-12">
        {!! Form::submit("Save Ad Block", ['class' => 'btn btn-lg btn-primary pull-left'] ) !!}
    </div>
</div>

<hr>
<br>
<p>The following HTML properties are allowed:</p>

<h3>HTML</h3>

<p>div, b, strong, i, em, a[href|class|title|target], ul, ol, li, p[style], br, span[style], img[width|height|alt|src], iframe[src|scrolling|style], src, b, strong, h1, h2, h3, h4, h5, h6, dt, dl</p>

@section('ckeditor-script')
    <script src="/assets/js/ckeditor/ckeditor.js?{{ rand() }}"></script>
    <script>
        CKEDITOR.replace('ad_content');
    </script>
@endsection