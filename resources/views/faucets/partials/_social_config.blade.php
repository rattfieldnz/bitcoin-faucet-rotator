<fieldset class="border">
    <legend class="border">Social Integration</legend>

    <fieldset class="border">
        <legend class="border">Twitter</legend>

        <div class="form-group">
            {!! Form::label('send_tweet', 'Send Tweet Notification?', ['class' => 'col-lg-2 control-label'] ) !!}
            <div class="col-lg-10">
                {!! Form::select('send_tweet', [true => 'Yes', false => 'No'], 0, ['class' => 'form-control']) !!}
            </div>
        </div>
    </fieldset>
</fieldset>