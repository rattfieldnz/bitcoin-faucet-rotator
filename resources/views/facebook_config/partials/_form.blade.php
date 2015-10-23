{!! Form::hidden('user_id', Auth::user()->id) !!}
<div class="form-group">
    {!! Form::label('app_id', 'App ID:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('app_id', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('app_secret', 'App Secret:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('app_secret', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('access_token', 'Access Token:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('access_token', null, ['class' => 'form-control', 'min' => 0]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('facebook_id', 'Page, User, or Group ID:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('facebook_id', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        {!! Form::submit("Save Configuration", ['class' => 'btn btn-lg btn-primary pull-left'] ) !!}
    </div>
</div>