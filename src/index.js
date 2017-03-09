var app=new Vue
(
    {
        el:'#app',
        components:
            {
                'yoyo-nav':require('./components/nav.vue'),
                'yoyo-panels':require('./components/panels.vue')
            }
    }
);