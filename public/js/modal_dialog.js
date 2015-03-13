$(function() {
    $("#dialog").dialog({
        modal: true,
        resizable: false,
        buttons: {
            "Yes!": function() {
                $(this).dialog("confirm");
            },
            "No!": function() {
                $(this).dialog("close");
            }
        }
    });
});