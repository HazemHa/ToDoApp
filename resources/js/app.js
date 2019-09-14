/***
First we will load all of this project 'sJavaScript dependencies which *
includes Vue and other libraries.It is agreat starting point when *
building robust, powerful web applications using Vue and Laravel.*/
require('./bootstrap');
import Vue from 'vue'
import Vuetify from 'vuetify'
//import App from '../views/App.vue'
import 'vuetify/dist/vuetify.min.css'
import Toaster from 'v-toaster'
// You need a specific loader for CSS files
import 'v-toaster/dist/v-toaster.css'

import ListOfTask from './components/listOfTasks.vue'
import Task from './components/task.vue'

/**
 * Next, we will create a fresh Vue application
 instance and attach it to* the page. Then, you may begin adding components to this application* or customize the JavaScript scaffolding to fit your unique needs. */
Vue.use(Vuetify)
Vue.component('task', Task);
Vue.component('listTasks', ListOfTask);

const app = new Vue({
    el: '#app',
    components: {
        ListOfTask,
        Task
    },
    methods: {}
});;
