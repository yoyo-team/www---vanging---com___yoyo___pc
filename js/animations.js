function set_animations()
{
    setTimeout(function()
    {
        if(location.hash==='#done_release_class')
        {
            success_message('恭喜您，课程已成功发布');
        }
        location.hash='';
    },1000);
    switch (location.hash)
    {
        case ''                :switch_item($('#nav_notes'));break;
        case '#nav_notes'      :switch_item($('#nav_notes'));break;
        case '#nav_settings'      :switch_item($('#nav_settings'));break;
        case '#nav_release'    :switch_item($('#nav_release'));break;
        case '#nav_share'      :switch_item($('#nav_share'));break;
        case '#nav_feedback'   :switch_item($('#nav_feedback'));break;
        default                :switch_item($('#nav_notes'));break;
    }
    function switch_item($this)
    {
        $this.siblings().removeClass('active').css('display','block');
        $this.addClass('active');
        var $item=$($this.attr('data-item_name'));
        $('.profile-item').fadeOut(0);
        $item.fadeIn(300);
    }
    $(".app-nav-item").click(function()
    {
        var $this=$(this);
        switch_item($this);
    });
}