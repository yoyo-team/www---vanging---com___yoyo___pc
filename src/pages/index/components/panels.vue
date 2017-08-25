<template>
    <div>
        <statistics v-if=" nav == '#statistics' "></statistics>
        <release v-if=" nav == '#release' "></release>
        <feedback v-if=" nav == '#feedback' "></feedback>
    </div>
</template>
<script>
    export default
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
                    statistics:require('./panels/statistics.vue'),
                    release:require('./panels/release.vue'),
                    feedback:require('./panels/feedback.vue')
                }
        }
</script>
<style scoped>

</style>
