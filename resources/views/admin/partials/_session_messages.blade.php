@if (Session::has('success_message_edit_admin_details'))
    <div class="alert alert-success">
        <span class="fa fa-thumbs-o-up fa-2x space-right"></span>
        {{ Session::get('success_message_edit_admin_details') }}
    </div>
@endif