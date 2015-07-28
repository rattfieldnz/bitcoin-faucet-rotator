<!-- Modal -->
<div class="modal fade" id="delFaucet{{$slug}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">
                    <span class="fa fa-warning fa-3x"></span>
                    <span id="id"></span>
                            <span style="padding-left: 2em;">
                                ARE YOU SURE you want to delete {!! link_to($faucet->url, $faucet->name, ['target' => '_blank']) !!} ?
                            </span>
                </h4>
            </div>
            <div class="modal-body">
                If you delete this faucet, it will be permanently removed from the system!
            </div>
            <div class="modal-footer">
                <div id="delmodelcontainer" style="float:right">

                    <div id="yes" style="float:left; padding-right:10px">
                        {!! Form::open(array('action' => array('FaucetsController@destroy', $faucet->slug), 'method' => 'DELETE')) !!}

                        {!! Form::submit('Yes', array('class' => 'btn btn-primary')) !!}

                        {!! Form::close() !!}
                    </div> <!-- end yes -->

                    <div id="no" style="float:left;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div><!-- end no -->

                </div> <!-- end delmodelcontainer -->

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->