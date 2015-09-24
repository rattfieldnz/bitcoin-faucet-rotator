<div class="form-group">
    {!! Form::label('title', 'Meta Title:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('description', 'Meta Description:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('description', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('keywords', 'Meta Keywords:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('keywords', null, ['class' => 'form-control', 'min' => 0]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('google_analytics_id', 'Google Analytics ID:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('google_analytics_id', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('yandex_verification', 'Yandex Verification ID:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('yandex_verification', null, ['class' => 'form-control']) !!}
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
        <script>
            CKEDITOR.replace( 'page_main_content');
        </script>
    </div>
</div>

<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        {!! Form::submit("Submit", ['class' => 'btn btn-lg btn-primary pull-left'] ) !!}
    </div>
</div>

@section('ckeditor-script')
    <script src="/assets/js/ckeditor/ckeditor.js"></script>
@endsection