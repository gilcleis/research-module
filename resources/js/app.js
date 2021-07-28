/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');
 import Vue from 'vue/dist/vue'

window.Vue = require('vue').default;
 
 import App from './App.vue';
 import VueAxios from 'vue-axios';
 import VueRouter from 'vue-router';
 import axios from 'axios';
 import { routes } from './routes';
 import VueSweetalert2 from 'vue-sweetalert2';
 import 'sweetalert2/dist/sweetalert2.min.css';
 import moment from 'moment';

 

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 
 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 
Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY HH:mm')
    }
});
Vue.component('pagination', require('laravel-vue-pagination'))
 Vue.use(VueRouter);
 Vue.use(VueAxios, axios);
 Vue.use(VueSweetalert2);
  
 const router = new VueRouter({
     mode: 'history',
     routes: routes
 });
  
 const app = new Vue({
     el: '#app',
     router: router,
     render: h => h(App),
 });






