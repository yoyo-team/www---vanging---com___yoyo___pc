function check_class_name()
{
    do_check
    (
        'class_name',
        $("#class_name"),
        'https://nodejs.twesix.cn/yoyo/used?key=class_name&value=',
        function(res)
        {
            return res.ok;
        },
        function()
        {
            $("#class_submit")
                .attr('disabled',true)
                .removeClass('btn-success')
                .addClass('btn-default')
            ;
        },
        function()
        {
            $("#class_submit")
                .attr('disabled',false)
                .removeClass('btn-default')
                .addClass('btn-success')
            ;
        }
    )
}

function do_check(name,$ele,url,res_checker,used,unused)
{
    var timer;
    var value='';
    $ele
        .focus(function()
        {
            timer=setInterval(function()
            {
                if(value!==$ele.val())
                {
                    $.get(url+$ele.val())
                        .then(function(res)
                        {
                            res=res_checker(res);
                            if(res)
                            {
                                used();
                            }
                            else
                            {
                                unused();
                            }
                        },function(err)
                        {
                            console.log('['+new Date().getTime()+']>>>> error occurred when checking '+name);
                            console.log(err);
                        })
                }
                value=$ele.val();
            },500)
        })
        .blur(function()
        {
            clearInterval(timer);
        })
    ;
}