/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import UsersIndex from './components/users/Index.vue';
import UserCreate from './components/users/Create.vue';
import UserEdit from './components/users/Edit.vue';

const routes = [
    {
        path: '/',
        components: {
            usersIndex: UsersIndex
        }
    },
    {path: '/admin/users/create', component: UserCreate, name: 'createUser'},
    {path: '/admin/users/edit/:id', component: UserEdit, name: 'editUser'},
]

const router = new VueRouter({ routes })

const app = new Vue({ router }).$mount('#app')
