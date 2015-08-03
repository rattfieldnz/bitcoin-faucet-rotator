@if (Session::has('success_message_delete'))
    <div class="alert alert-success">
        <span class="fa fa-thumbs-o-up fa-2x space-right"></span>
        {{ Session::get('success_message_delete') }}
    </div>
@endif
@if (Session::has('success_message_update_faucet_statuses_activated'))
    <div class="alert alert-success">
        <span class="fa fa-thumbs-o-up fa-2x space-right"></span>
        {{ Session::get('success_message_update_faucet_statuses_activated') }}
    </div>
@endif
@if (Session::has('success_message_update_faucet_statuses_paused'))
    <div class="alert alert-success">
        <span class="fa fa-thumbs-o-up fa-2x space-right"></span>
        {{ Session::get('success_message_update_faucet_statuses_paused') }}
    </div>
@endif
@if (Session::has('success_message_update_faucet_statuses_none'))
    <div class="alert alert-success">
        <span class="fa fa-thumbs-o-up fa-2x space-right"></span>
        {{ Session::get('success_message_update_faucet_statuses_none') }}
    </div>
@endif
