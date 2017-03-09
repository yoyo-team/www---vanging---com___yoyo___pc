<template>
    <ul class="nav nav-pills" id="app_nav">
        <li role="presentation" class="app-nav-item"
            :class="{ active : nav == '#notes' }" data-item_name="#profile_notes"
            id="nav_notes">
            <a href="#notes">我的笔记</a>
        </li>
        <li role="presentation" class="app-nav-item"
            :class="{ active : nav == '#settings' }" data-item_name="#profile_settings"
            id="nav_settings">
            <a href="#settings">个人设置</a>
        </li>
        <li role="presentation" class="app-nav-item"
            :class="{ active : nav == '#release' }" data-item_name="#profile_release"
            id="nav_release">
            <a href="#release">发布课程</a>
        </li>
        <li role="presentation" class="app-nav-item"
            :class="{ active : nav == '#feedback' }" data-item_name="#profile_feedback" id="nav_feedback">
            <a href="#feedback">意见反馈</a>
        </li>
    </ul>
</template>
<script>
    module.exports =
        {
            data: function ()
            {
                return {
                    nav:location.hash
                };
            },
            mounted:function()
            {
                var self=this;
                window.addEventListener('hashchange',function(e)
                {
                    var hash=location.hash;
                    if(['#notes','#settings','#release','#feedback'].indexOf(hash)!==-1)
                    {
                        self.nav=hash;
                    }
                })
            }
        }
</script>
<style scoped>

</style>
