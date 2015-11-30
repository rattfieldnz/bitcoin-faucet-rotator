<div class="form-group">
    {!! Form::label('title', 'Meta Title:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Lorem imsum dolor sit amet']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('description', 'Meta Description:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Lorem imsum dolor sit amet, consecter...']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('keywords', 'Meta Keywords:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('keywords', null, ['class' => 'form-control', 'min' => 0, 'placeholder' => 'keyword 1, keyword 2, keyword 3,...']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('google_analytics_id', 'Google Analytics ID:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('google_analytics_id', null, ['class' => 'form-control', 'placeholder' => 'UA-12345678-9']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('yandex_verification', 'Yandex Verification ID:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('yandex_verification', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('addthisid', 'AddThis ID:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('addthisid', null, ['class' => 'form-control', 'placeholder' => 'ra-1234567abcdefg']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('twitter_username', 'Twitter Username (without \'@\'):', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('twitter_username', null, ['class' => 'form-control', 'placeholder' => 'FreeBTCWebsite']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('feedburner_feed_url', 'FeedBurner Feed URL:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('feedburner_feed_url', null, ['class' => 'form-control', 'placeholder' => 'http://feeds.feedburner.com/yourwebsitefeed']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('bing_verification', 'Bing Verification ID:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('bing_verification', null, ['class' => 'form-control']) !!}
    </div>
</div>

<hr>

<h3>Manage main page content</h3>
<p>This content appears on the main faucet rotator page.</p>

<div class="form-group">
    {!! Form::label('page_main_title', 'Main Page Title:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('page_main_title', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('page_main_content', 'Main Page Content:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::textarea('page_main_content', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group" id="submit">
    <div class="col-lg-10 col-lg-offset-2">
        {!! Form::submit("Submit", ['class' => 'btn btn-lg btn-primary pull-left'] ) !!}
    </div>
</div>

@section('ckeditor-script')
    <script src="/assets/js/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'page_main_content');
    </script>
@endsection