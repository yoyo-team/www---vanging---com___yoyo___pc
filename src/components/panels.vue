<template>
    <div>
        <notes v-if=" nav == '#notes' "></notes>
        <settings v-if=" nav == '#settings' "></settings>
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
                    if(['#notes','#settings','#release','#feedback'].indexOf(hash)!==-1)
                    {
                        self.nav=hash;
                    }
                });
            },
            components:
                {
                    notes:require('./notes.vue'),
                    settings:require('./settings.vue'),
                    release:require('./release.vue'),
                    feedback:require('./feedback.vue')
                }
        }
</script>
<style scoped>

</style>
