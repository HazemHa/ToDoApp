/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import Vuetify from 'vuetify'
//import App from '../views/App.vue'
import 'vuetify/dist/vuetify.min.css'
import Toaster from 'v-toaster'
// You need a specific loader for CSS files
import 'v-toaster/dist/v-toaster.css'

import ListOfTask from './components/listOfTasks.vue'
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(Vuetify)
Vue.component('listTasks', ListOfTask);
Vue.use(Toaster, {timeout: 5000})

const app = new Vue({
    el: '#app',
    components: {
    },
    methods: {}
});
