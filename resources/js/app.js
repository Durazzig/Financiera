require('./bootstrap');

window.Swal = require('sweetalert2');

window.Vue = require('vue');

Vue.component('example-component',require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});
