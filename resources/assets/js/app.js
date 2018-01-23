
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.WebTorrent = require('webtorrent/webtorrent.min')
window.dragDrop = require('drag-drop')
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('send-component', require('./components/SendComponent.vue'));
Vue.component('receive-component', require('./components/ReceiveComponent.vue'));

const app = new Vue({
    el: '#app'
});
