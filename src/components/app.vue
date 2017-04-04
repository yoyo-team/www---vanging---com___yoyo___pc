<template>
    <div  class="container">
        <h1 id="app_header">YOYO笔记</h1>
        <br>
        <yoyo-nav></yoyo-nav>
        <hr>
        <yoyo-panels></yoyo-panels>
        <class-hot-point-modal></class-hot-point-modal>
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
                    'yoyo-panels':require('./panels.vue'),
                    'class-hot-point-modal':require('../modals/class_hot_point.vue')
                }
        }
</script>
<style scoped>
    *
    {
        font-family:微软雅黑,"Helvetica Neue",Helvetica,Arial,sans-serif;
    }
</style>
