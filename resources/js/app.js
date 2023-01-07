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
window.Vue.component('users-select', require('./components/partials/forms/UsersSelect.vue').default);
window.Vue.component('tasks-list', require('./components/tasks/TasksList.vue').default);
window.Vue.component('avatar', require('./components/layouts/Avatar.vue').default);
window.Vue.component('status-badge', require('./components/layouts/StatusBadge.vue').default);
window.axios = require('axios')
import store from './store'
import vSelect from 'vue-select';
window.Vue.component('v-select', vSelect);
// then set it up; you can also set it when component is mounted within mounted() { ... }
import router from './router'
const app = new Vue({ router, store:store }).$mount('#app')
