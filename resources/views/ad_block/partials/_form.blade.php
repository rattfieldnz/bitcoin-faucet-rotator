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
<p>Only the follwing HTML and CSS properties are allowed:</p>

<h3>HTML</h3>

<p>div, b, strong, i, em, a[href|title|target], ul, ol, li, p[style], br, span[style], img[width|height|alt|src], iframe[src|scrolling|style]</p>

<h3>CSS</h3>

<p>font, font-size, font-weight, font-style, font-family, text-decoration, padding-left, color, background-color, text-align, border, width, height</p>

