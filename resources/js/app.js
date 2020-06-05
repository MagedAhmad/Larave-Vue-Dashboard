/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('admin-lte');
window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform'

import moment from 'moment'

window.Form = Form

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

let routes = [
    { path: '/dashboard', component: require('./views/Dashboard.vue').default },
    { path: '/profile', component: require('./views/Profile.vue').default },
    { path: '/users', component: require('./views/Users.vue').default }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

Vue.filter('date', function(data) {
    return moment(data).format("MMM Do YYYY")
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('dashboard', require('./views/Dashboard.vue').default);
Vue.component('profile', require('./views/Profile.vue').default);
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});
