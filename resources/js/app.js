require('./bootstrap');

//Libraries
import Vue from 'vue';
import {router} from './router';
import {store} from "./store/store";

//My Components


if (document.getElementById('account')){
    const app = new Vue({
        el: '#account',
        router,
    });
}

if (document.getElementById('operations')) {
    Vue.component('user-dashboard', require('./components/operations/UserDashboard').default);
    const app = new Vue({
        el: '#operations',
        router,
        store,
    });
}
