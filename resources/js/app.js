
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('desarrollos', require('./components/todosLosDesarrollos.vue'));
Vue.component('role', require('./components/Role.vue'));
Vue.component('user', require('./components/User.vue'));
Vue.component('categoria', require('./components/Categoria.vue'));
Vue.component('subcategoria', require('./components/Subcategoria.vue'));
Vue.component('desarrollo', require('./components/Desarrollo.vue'));
Vue.component('nuevo', require('./components/Nuevo.vue'));

const app = new Vue({
    el: '#app',
    data :{
        menu : 0,
        page : 0,
    }
});
