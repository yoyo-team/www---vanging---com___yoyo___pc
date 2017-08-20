import root from './components/app.vue';
root._Ctor = undefined;

const userStore = window['www---vanging---com___sdk___user.store'];

new Vue
(
    {
        el : '#app',
        template : '<root></root>',
        store: userStore,
        components : { root }
    }
);