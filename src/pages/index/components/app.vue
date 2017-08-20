<template>
    <div  class="container">
        <h1 id="app_header">YOYO笔记</h1>
        <br>
        <_nav></_nav>
        <hr>
        <panels></panels>
        <class_hot_point></class_hot_point>
    </div>
</template>
<script>

    import _nav from './nav.vue';
    import panels from './panels.vue';
    import class_hot_point from './modals/class_hot_point.vue';

    export default
        {
            data: function()
            {
                return {};
            },
            components:
                {
                    _nav,
                    panels,
                    class_hot_point,
                }
        }
</script>
<style scoped>
    *
    {
        font-family:微软雅黑,"Helvetica Neue",Helvetica,Arial,sans-serif;
    }
</style>
