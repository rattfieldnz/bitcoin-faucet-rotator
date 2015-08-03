{!! Form::open(
           [
               'route' => ['faucetLowBalance', $faucet->slug],
               'method' => 'PATCH',
               'class' => 'form-horizontal',
               'id' => 'check_faucet_low_balance_status',
               'style' => 'border: 2px solid #ccc; padding: 0.5em;'
           ]
       ) !!}
<h4>Update Low Balance Status</h4>

<p>Faucet will not show in rotator if status is set to 'Yes'.</p>
<div class="form-group">
    {!! Form::label('has_low_balance', 'Balance below 10,000 Satoshis?', ['class' => 'col-lg-2 control-label'] )  !!}
    <div class="col-lg-2">
        {!!  Form::select('has_low_balance', [1 => 'Yes', 0 => 'No'], $faucet->has_low_balance, ['class' => 'col-lg-1 form-control' ]) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-lg-1">
        {!! Form::submit("Update Low Balance Status", ['class' => 'btn btn-md btn-primary'] ) !!}
    </div>
</div>
{!! Form::close() !!}