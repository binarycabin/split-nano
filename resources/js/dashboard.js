require('./bootstrap');

window.Vue = require('vue');
window.toastr = require('toastr');

Vue.component('address-group-items', require('./components/AddressGroupItemsComponent.vue').default);

const app = new Vue({
    el: '#app',
});