$(document).ready(function()
{
    set_animations();
    check_class_name();
    display_notes();
});

function error_message(msg)
{
    $.scojs_message(msg,$.scojs_message.TYPE_ERROR)
}
function success_message(msg)
{
    $.scojs_message(msg,$.scojs_message.TYPE_OK)
}