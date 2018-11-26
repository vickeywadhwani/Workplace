
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue');

 import VueRouter from 'vue-router';
 Vue.use(VueRouter);
 Vue.prototype.$apihost = 'http://workplace.test/api/';

 import VueAxios from 'vue-axios';
 import axios from 'axios';
 import App from './App.vue';
 Vue.use(VueAxios, axios);
 import VeeValidate from 'vee-validate';
 Vue.use(VeeValidate);

 import HomeComponent from './components/ListComponent.vue';
 import AddComponent from './components/AddComponent.vue';
 import EditComponent from './components/EditComponent.vue';

 const routes = [
   {
       name: 'home',
       path: '/',
       component: HomeComponent
   },
   {
       name: 'Add',
       path: '/add',
       component: AddComponent
   },
   {
       name: 'workplace',
       path: '/workplace/:id',
       component: EditComponent
   }
 ];

 const router = new VueRouter({ mode: 'history', routes: routes});
 const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');
