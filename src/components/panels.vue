<template>
    <div>
        <statistics v-if=" nav == '#statistics' "></statistics>
        <release v-if=" nav == '#release' "></release>
        <feedback v-if=" nav == '#feedback' "></feedback>
    </div>
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
                    if(['#statistics','#release','#feedback'].indexOf(hash)!==-1)
                    {
                        self.nav=hash;
                    }
                });
            },
            components:
                {
                    statistics:require('./statistics.vue'),
                    release:require('./release.vue'),
                    feedback:require('./feedback.vue')
                }
        }
</script>
<style scoped>

</style>
