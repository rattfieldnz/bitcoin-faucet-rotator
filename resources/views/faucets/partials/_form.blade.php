<div class="form-group">
    {!! Form::label('name', 'Faucet Name:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('url', 'Faucet URL:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('url', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('meta_title', 'Faucet Meta Title:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('meta_title', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('meta_description', 'Faucet Meta Description:', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('meta_description', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('meta_keywords', 'Faucet Meta Keywords (comma separated):', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::text('meta_keywords', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('interval_minutes', 'Interval (minutes):', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::number('interval_minutes', null, ['class' => 'form-control', 'min' => 0]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('min_payout', 'Minimum Payout (satoshis):', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::number('min_payout', null, ['class' => 'form-control', 'min' => 0]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('max_payout', 'Maximum Payout (satoshis):', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::number('max_payout', null, ['class' => 'form-control', 'min' => 1]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('payment_processors[]', 'Payment Processor/s', ['class' => 'col-lg-2 control-label'] ) !!}
    <div class="col-lg-10">
        {!! Form::select('payment_processors[]', $paymentProcessors->pluck('name', 'id'),
        $paymentProcessorIds,
        ['class' => 'form-control',
        'multiple' => 'multiple'])
    !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('has_ref_program', 'Has Referral Program?', ['class' => 'col-lg-2 control-label'] )  !!}
    <div class="col-lg-10">
        {!!  Form::select('has_ref_program', [1 => 'Yes', 0 => 'No'], null, ['class' => 'form-control' ]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('ref_payout_percent', 'Referral Payout (%):', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::number('ref_payout_percent', null, ['class' => 'form-control', 'min' => 0]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('comments', 'Comments', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::textarea('comments', null, ['class' => 'form-control', 'rows' => 5]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_paused', 'Is The Faucet Paused?', ['class' => 'col-lg-2 control-label'] )  !!}
    <div class="col-lg-10">
        {!!  Form::select('is_paused', [1 => 'Yes', 0 => 'No'], null, ['class' => 'form-control' ]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('has_low_balance', 'Balance below 10,000 Satoshis?', ['class' => 'col-lg-2 control-label'] )  !!}
    <div class="col-lg-10">
        {!!  Form::select('has_low_balance', [1 => 'Yes', 0 => 'No'], null, ['class' => 'form-control' ]) !!}
    </div>
</div>

@include('faucets/partials/_social_config')

<div class="form-group" id="submit">
    <div class="col-lg-10 col-lg-offset-2">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-lg btn-primary pull-left'] ) !!}
    </div>
</div>