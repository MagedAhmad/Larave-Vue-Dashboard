require('./bootstrap');
require('admin-lte');
window.Vue = require('vue');

import { Form, HasError, AlertError } from 'vform'
import Swal from 'sweetalert2'
import moment from 'moment'
import Vue from 'vue'
import { router } from './utility/router'

window.Swal = Swal
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
};
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast
window.Form = Form

Vue.filter('date', function(data) {
    return moment(data).format("MMM Do YYYY")
})

Vue.component('dashboard', require('./views/Dashboard.vue').default);
Vue.component('profile', require('./views/Profile.vue').default);
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

const app = new Vue({
    el: '#app',
    router,
});
