<template>
    <div  class="container">
        <h1 id="app_header">YOYO笔记</h1>
        <br>
        <yoyo-nav></yoyo-nav>
        <hr>
        <yoyo-panels></yoyo-panels>
    </div>
</template>
<script>
    module.exports =
        {
            data: function () {
                return {};
            },
            components:
                {
                    'yoyo-nav':require('./nav.vue'),
                    'yoyo-panels':require('./panels.vue')
                }
        }
</script>
<style scoped>

</style>
