/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// import axios
window.axios = require('axios')
import store from './store'

// then set it up; you can also set it when component is mounted within mounted() { ... }
axios.defaults.headers.common = {'Content-Type': 'application/json','Accept': 'application/json','Authorization': `Bearer ${store.state.auth.token}`}

import router from './router'
const app = new Vue({ router, store:store }).$mount('#app')
