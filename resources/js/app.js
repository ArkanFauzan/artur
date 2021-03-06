/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

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
Vue.component('register-form', require('./components/form/RegisterForm.vue').default);
Vue.component('login-form', require('./components/form/LoginForm.vue').default);

Vue.component('new-umkm', require('./components/admin/NewUmkm.vue').default); 
Vue.component('login-to-umkm', require('./components/admin/LoginToUmkm.vue').default); 
Vue.component('overview', require('./components/admin/Overview.vue').default); 

Vue.component('my-profile', require('./components/member/MyProfile.vue').default); 
Vue.component('edit-profile', require('./components/member/EditProfile.vue').default); 
Vue.component('my-product', require('./components/member/MyProduct.vue').default); 
Vue.component('add-product', require('./components/member/AddProduct.vue').default); 
Vue.component('edit-product', require('./components/member/EditProduct.vue').default); 
Vue.component('my-transaction-update', require('./components/member/MyTransactionUpdate.vue').default);

Vue.component('umkm-list', require('./components/landingpage/UmkmList.vue').default);
Vue.component('product-list', require('./components/landingpage/ProductList.vue').default); 

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#wrapper',
});
