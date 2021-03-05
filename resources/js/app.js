require('./bootstrap');

window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('post-component', require('./components/PostComponent.vue').default);
Vue.component('editar-component', require('./components/PostComponent.vue').default);

const app = new Vue({
    el: '#app',
});