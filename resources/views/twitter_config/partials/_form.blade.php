{!! Form::hidden('user_id', Auth::user()->id) !!}
<div class="form-group">
    {!! Form::label('consumer_key', 'Consumer Key:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('consumer_key', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('consumer_key_secret', 'Consumer Key Secret:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('consumer_key_secret', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('access_token', 'Access Token:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('access_token', null, ['class' => 'form-control', 'min' => 0]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('access_token_secret', 'Access Token Secret:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('access_token_secret', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        {!! Form::submit("Save Configuration", ['class' => 'btn btn-lg btn-primary pull-left'] ) !!}
    </div>
</div>