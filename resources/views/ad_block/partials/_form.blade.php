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

<p>div, b, strong, i, em, a[href|class|title|target], ul, ol, li, p[style], br, span[style], img[width|height|alt|src], iframe[src|scrolling|style], src, b, strong, h1, h2, 13, h4, h5, h6, dt, dl</p>

@section('ckeditor-script')
    <script src="/assets/js/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'ad_content');
    </script>
@endsection