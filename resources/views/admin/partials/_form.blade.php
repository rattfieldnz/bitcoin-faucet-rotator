{!! Form::hidden('is_admin', Auth::user()->is_admin) !!}
<div class="form-group">
    {!! Form::label('user_name', 'User Name:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('user_name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('first_name', 'First Name:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('last_name', 'Last Name:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('email', 'Email:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('password', 'Password:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::password('password', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('password_confirmation', 'Password Confirmation:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::password('password_confirmation', null,['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-lg-10 pull-right">
        <p>The password must be at least 10 and no more than 20 characters in length.</p>
        <p>The password must also pass the following rules:</p>
        <ul>
            <li>Contain at least 2 upper-case letters.</li>
            <li>Contain at least 2 lower-case letters.</li>
            <li>Contain at least 2 numerical digits.</li>
            <li>Contain at least 2 special characters.</li>
        </ul>
    </div>
</div>

<div class="form-group">
    {!! Form::label('bitcoin_address', 'Bitcoin Address:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('bitcoin_address', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group" id="submit">
    <div class="col-lg-10 col-lg-offset-2">
        {!! Form::submit("Submit", ['class' => 'btn btn-lg btn-primary pull-left'] ) !!}
    </div>
</div>