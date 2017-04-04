<template>
    <ul class="nav nav-pills" id="app_nav">
        <li role="presentation" class="app-nav-item"
            :class="{ active : nav == '#statistics' }" data-item_name="#profile_statistics"
            id="nav_notes">
            <a href="#statistics">热点统计</a>
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
                let self=this;
                window.addEventListener('hashchange',function(e)
                {
                    let hash=location.hash;
                    if(['#statistics','#release','#feedback'].indexOf(hash)!==-1)
                    {
                        self.nav=hash;
                    }
                })
            }
        }
</script>
<style scoped>

</style>
