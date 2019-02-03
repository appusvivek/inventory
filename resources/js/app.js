
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import BootstrapVue from 'bootstrap-vue';
import VueRouter from 'vue-router';
import uploader from 'vue-simple-uploader';

// const uploaderConfig = {
//     // file uploader service url
//     uploadFileUrl: 'http://localost:8000/',
//     language: 'en',
//     // file delete service url
//     deleteFileUrl: 'http://localost:8000/',
//     // set the way to show upload message(upload fail message)
//     showMessage: (vue, message) => {
//         //using v-dialogs to show message
//         vue.$vDialog.alert(message, null, {messageType: 'error'});
//     }
// };

Vue.use(uploader);
Vue.use(VueRouter);
Vue.use(BootstrapVue);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.config.devtools = true;
Vue.config.performance = true;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/App.vue').default);

import App from './components/App.vue';
import Cars from './components/Cars.vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app',
    components:{
        App
    },
    render: h =>h(App)
});
