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
    {!! Form::label('google_analytics_code', 'Minimum Payout (satoshis):', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::textarea('google_analytics_code', null, ['class' => 'form-control', 'min' => 0]) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        {!! Form::submit($submit_button_text, ['class' => 'btn btn-lg btn-primary pull-left'] ) !!}
    </div>
</div>