import VueRouter from 'vue-router'
import Vue from 'vue'

Vue.use(VueRouter)

let routes = [
    { path: '/admin', component: require('../views/Dashboard.vue').default },
    { path: '/admin/profile', component: require('../views/Profile.vue').default },
    { path: '/admin/users', component: require('../views/Users.vue').default },
    { path: '/admin/permissions', component: require('../views/Permissions.vue').default },
]

export const router = new VueRouter({
    mode: 'history',
    routes
})